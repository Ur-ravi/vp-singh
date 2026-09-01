<form method="POST" action="<?= $testimonial ? '/admin/testimonials/update/'.$testimonial->id : '/admin/testimonials/store' ?>" class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Client Name *</label><input type="text" name="client_name" required value="<?= esc($testimonial->client_name ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Rating (1-5)</label><input type="number" name="rating" min="1" max="5" value="<?= $testimonial->rating ?? 5 ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Review *</label><textarea name="review" rows="4" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($testimonial->review ?? '') ?></textarea></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Location</label><input type="text" name="location" value="<?= esc($testimonial->location ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Source</label><input type="text" name="source" value="<?= esc($testimonial->source ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label><input type="number" name="sort_order" value="<?= $testimonial->sort_order ?? 0 ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_published" value="1" <?= ($testimonial->is_published ?? 1) ? 'checked' : '' ?> class="rounded"> Published</label></div>
    <div class="mt-6 flex justify-end gap-3"><a href="/admin/testimonials" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">Cancel</a><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800"><?= $testimonial ? 'Update' : 'Create' ?></button></div>
</form>
