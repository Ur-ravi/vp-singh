<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500"><?= count($areas ?? []) ?> practice areas</p>
    <a href="/admin/practice-areas/create" class="bg-charcoal text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
        + Add Practice Area
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Title</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Slug</th>
                <th class="px-4 py-3 text-center font-medium text-gray-600">Featured</th>
                <th class="px-4 py-3 text-center font-medium text-gray-600">Published</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($areas ?? [] as $area): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium"><?= esc($area->title) ?></td>
                    <td class="px-4 py-3 text-gray-500 font-mono text-xs"><?= esc($area->slug) ?></td>
                    <td class="px-4 py-3 text-center">
                        <?= $area->is_featured ? '<span class="text-xs bg-bronze text-white px-2 py-0.5 rounded">Featured</span>' : '—' ?>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <?= $area->is_published ? '<span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded">Published</span>' : '<span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded">Draft</span>' ?>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/practice-areas/edit/<?= $area->id ?>" class="text-bronze hover:underline mr-3">Edit</a>
                        <form method="POST" action="/admin/practice-areas/delete/<?= $area->id ?>" class="inline" onsubmit="return confirm('Delete this practice area?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
