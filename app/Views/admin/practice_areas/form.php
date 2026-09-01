<form method="POST" action="<?= $area ? '/admin/practice-areas/update/'.$area->id : '/admin/practice-areas/store' ?>" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <?= csrf_field() ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
            <input type="text" name="title" required value="<?= esc($area->title ?? '') ?>"
                   data-slug-source="[name=slug]"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
            <input type="text" name="slug" required value="<?= esc($area->slug ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
        <textarea name="short_description" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($area->short_description ?? '') ?></textarea>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Full Description (HTML)</label>
        <textarea name="description" rows="10" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-y font-mono"><?= esc($area->description ?? '') ?></textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Icon (remixicon name)</label>
            <input type="text" name="icon" value="<?= esc($area->icon ?? '') ?>" placeholder="e.g. scales, shield"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">CTA Label</label>
            <input type="text" name="cta_label" value="<?= esc($area->cta_label ?? 'Explore This Practice') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="<?= $area->sort_order ?? 0 ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        <input type="file" name="image" accept="image/*"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs">
        <?php if (!empty($area->image)): ?>
            <img src="/<?= esc($area->image) ?>" class="mt-2 h-16 rounded">
        <?php endif; ?>
    </div>

    <div class="flex gap-6 mt-5">
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_featured" value="1" <?= ($area->is_featured ?? 0) ? 'checked' : '' ?> class="rounded">
            Featured
        </label>
        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_published" value="1" <?= ($area->is_published ?? 1) ? 'checked' : '' ?> class="rounded">
            Published
        </label>
    </div>

    <hr class="my-5">
    <h4 class="font-medium text-gray-700 mb-3">SEO</h4>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
        <input type="text" name="seo_title" value="<?= esc($area->seo_title ?? '') ?>"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>
    <div class="mt-3">
        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
        <textarea name="seo_description" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($area->seo_description ?? '') ?></textarea>
    </div>

    <div class="mt-6 flex justify-end gap-3">
        <a href="/admin/practice-areas" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">Cancel</a>
        <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
            <?= $area ? 'Update' : 'Create' ?> Practice Area
        </button>
    </div>
</form>
