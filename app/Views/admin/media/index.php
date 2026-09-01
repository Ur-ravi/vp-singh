<div class="mb-6"><h3 class="font-medium text-gray-700 mb-3">Upload New Media</h3>
<form method="POST" action="/admin/media/upload" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-4 flex gap-4 items-end">
    <?= csrf_field() ?>
    <div class="flex-1"><input type="file" name="file" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs"></div>
    <div class="flex-1"><input type="text" name="alt_text" placeholder="Alt text" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    <button type="submit" class="bg-charcoal text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800">Upload</button>
</form></div>

<div class="flex items-center justify-between mb-4"><p class="text-sm text-gray-500"><?= $total ?? 0 ?> files</p>
<form method="GET" action="/admin/media" class="flex gap-2"><input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Search media..." class="px-3 py-2 border border-gray-300 rounded-lg text-sm"><button class="bg-bronze text-white px-4 py-2 rounded-lg text-sm">Search</button></form></div>

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
    <?php foreach ($media ?? [] as $m): ?>
        <div class="bg-white rounded-lg shadow overflow-hidden group">
            <div class="aspect-square bg-gray-100 flex items-center justify-center">
                <?php if (str_starts_with($m->file_type, 'image/')): ?>
                    <img src="/<?= esc($m->file_path) ?>" alt="<?= esc($m->alt_text) ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <i class="ri-file-line text-3xl text-gray-300"></i>
                <?php endif; ?>
            </div>
            <div class="p-2">
                <p class="text-xs text-gray-500 truncate"><?= esc($m->file_name) ?></p>
                <div class="flex gap-2 mt-1">
                    <form method="POST" action="/admin/media/delete/<?= $m->id ?>" onsubmit="return confirm('Delete?')" class="flex-1">
                        <?= csrf_field() ?>
                        <button class="text-red-400 text-xs hover:underline w-full">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php if (!empty($pager)): ?><div class="mt-4"><?= $pager->links() ?></div><?php endif; ?>
