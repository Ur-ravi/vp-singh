<form method="POST" action="<?= $post ? '/admin/blog/update/'.$post->id : '/admin/blog/store' ?>" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <?= csrf_field() ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
            <input type="text" name="title" required value="<?= esc($post->title ?? '') ?>" data-slug-source="[name=slug]"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
            <input type="text" name="slug" required value="<?= esc($post->slug ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
        <textarea name="excerpt" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($post->excerpt ?? '') ?></textarea>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Content *</label>
        <textarea name="content" rows="20" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-y font-mono"><?= esc($post->content ?? '') ?></textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
                <option value="">— None —</option>
                <?php foreach ($categories ?? [] as $cat): ?>
                    <option value="<?= $cat->id ?>" <?= ($post->category_id ?? '') == $cat->id ? 'selected' : '' ?>><?= esc($cat->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
                <option value="draft" <?= ($post->status ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= ($post->status ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
            <input type="file" name="featured_image" accept="image/*"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs">
        </div>
    </div>

    <?php if (!empty($tags)): ?>
    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
        <div class="flex flex-wrap gap-3">
            <?php foreach ($tags as $tag): ?>
                <label class="flex items-center gap-1 text-sm">
                    <input type="checkbox" name="tags[]" value="<?= $tag->id ?>" <?= in_array($tag->id, $post->tag_ids ?? []) ? 'checked' : '' ?> class="rounded">
                    <?= esc($tag->name) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <hr class="my-5">
    <h4 class="font-medium text-gray-700 mb-3">SEO</h4>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
        <input type="text" name="seo_title" value="<?= esc($post->seo_title ?? '') ?>"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>
    <div class="mt-3">
        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
        <textarea name="seo_description" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($post->seo_description ?? '') ?></textarea>
    </div>

    <div class="mt-6 flex justify-end gap-3">
        <a href="/admin/blog" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">Cancel</a>
        <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
            <?= $post ? 'Update' : 'Create' ?> Post
        </button>
    </div>
</form>
