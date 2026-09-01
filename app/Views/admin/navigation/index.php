<?php foreach ($menus ?? [] as $menu): ?>
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-charcoal"><?= esc($menu->name) ?> <span class="text-xs text-gray-400 font-normal">(<?= $menu->location ?>)</span></h3>
    </div>
    <?php if (!empty($menu->items)): ?>
        <table class="w-full text-sm"><thead class="border-b"><tr><th class="px-3 py-2 text-left text-gray-500">Label</th><th class="px-3 py-2 text-left text-gray-500">URL</th><th class="px-3 py-2 text-center text-gray-500">CTA</th><th class="px-3 py-2 text-center text-gray-500">Active</th><th class="px-3 py-2 text-right text-gray-500">Order</th><th class="px-3 py-2 text-right text-gray-500">Action</th></tr></thead>
        <tbody class="divide-y"><?php foreach ($menu->items as $item): ?><tr>
            <td class="px-3 py-2 font-medium"><?= esc($item->label) ?></td><td class="px-3 py-2 text-gray-500 font-mono text-xs"><?= esc($item->url) ?></td><td class="px-3 py-2 text-center"><?= $item->is_cta ? '<span class="text-xs bg-bronze text-white px-2 py-0.5 rounded">CTA</span>' : '—' ?></td><td class="px-3 py-2 text-center"><?= $item->is_active ? '✓' : '✗' ?></td><td class="px-3 py-2 text-center text-xs"><?= $item->sort_order ?></td>
            <td class="px-3 py-2 text-right"><form method="POST" action="/admin/navigation/item/delete/<?= $item->id ?>" class="inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="_method" value="POST"><button class="text-red-500 text-xs hover:underline">Delete</button></form></td>
        </tr><?php endforeach; ?></tbody></table>
    <?php else: ?><p class="text-sm text-gray-400">No items yet.</p><?php endif; ?>

    <form method="POST" action="/admin/navigation/item/store" class="mt-4 grid grid-cols-5 gap-2 items-end">
        <?= csrf_field() ?>
        <input type="hidden" name="menu_id" value="<?= $menu->id ?>">
        <input type="text" name="label" placeholder="Label" required class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
        <input type="text" name="url" placeholder="/path" required class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
        <input type="number" name="sort_order" placeholder="Order" value="0" class="px-3 py-2 border border-gray-300 rounded-lg text-sm w-16">
        <label class="flex items-center gap-1 text-xs"><input type="checkbox" name="is_cta" value="1"> CTA</label>
        <button type="submit" class="bg-bronze text-white px-4 py-2 rounded-lg text-xs font-medium">Add</button>
    </form>
</div>
<?php endforeach; ?>
