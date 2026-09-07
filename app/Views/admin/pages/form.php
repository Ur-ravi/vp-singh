<form method="POST" action="<?= $page ? '/admin/pages/update/'.$page->id : '/admin/pages/store' ?>" class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label><input type="text" name="title" required value="<?= esc($page->title ?? '') ?>" data-slug-source="[name=slug]" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label><input type="text" name="slug" required value="<?= esc($page->slug ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Content (HTML)</label><textarea name="content" class="wysiwyg-editor"><?= esc($page->content ?? '') ?></textarea></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Template</label><select name="template" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm"><option value="default">Default</option><option value="home">Home</option><option value="full-width">Full Width</option></select></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label><input type="number" name="sort_order" value="<?= $page->sort_order ?? 0 ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div class="flex items-end"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_published" value="1" <?= ($page->is_published ?? 1) ? 'checked' : '' ?> class="rounded"> Published</label></div>
    </div>
    <hr class="my-5"><h4 class="font-medium text-gray-700 mb-3">SEO</h4>
    <div><label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label><input type="text" name="seo_title" value="<?= esc($page->seo_title ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    <div class="mt-3"><label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label><textarea name="seo_description" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($page->seo_description ?? '') ?></textarea></div>
    <div class="mt-6 flex justify-end gap-3"><a href="/admin/pages" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm">Cancel</a><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800"><?= $page ? 'Update' : 'Create' ?></button></div>
</form>
