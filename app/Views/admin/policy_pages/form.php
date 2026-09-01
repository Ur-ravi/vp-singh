<form method="POST" action="/admin/policy-pages/save" class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <?= csrf_field() ?>
    <input type="hidden" name="slug" value="<?= esc($page->slug) ?>">

    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-bronze/10 text-bronze text-xs font-medium">
            <i class="ri-shield-check-line"></i> Policy Page
        </span>
        <span class="text-sm text-gray-400 font-mono">/<?= esc($page->slug) ?></span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Page Title *</label>
            <input type="text" name="title" required value="<?= esc($page->title ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Slug (read-only)</label>
            <input type="text" value="<?= esc($page->slug ?? '') ?>" disabled
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-500 cursor-not-allowed">
        </div>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Content (HTML)</label>
        <textarea name="content" rows="20"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-y font-mono leading-relaxed"><?= esc($page->content ?? '') ?></textarea>
        <p class="text-xs text-gray-400 mt-1">You can use HTML tags for formatting: &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;a&gt;, etc.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="<?= $page->sort_order ?? 0 ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div class="flex items-end">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" <?= ($page->is_published ?? 1) ? 'checked' : '' ?> class="rounded">
                Published
            </label>
        </div>
    </div>

    <hr class="my-5">

    <h4 class="font-medium text-gray-700 mb-3">SEO</h4>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
        <input type="text" name="seo_title" value="<?= esc($page->seo_title ?? '') ?>"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>
    <div class="mt-3">
        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
        <textarea name="seo_description" rows="2"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($page->seo_description ?? '') ?></textarea>
    </div>

    <div class="mt-6 flex justify-between items-center">
        <a href="/admin/policy-pages" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
            ← Back to Policy Pages
        </a>
        <div class="flex gap-3">
            <a href="/<?= esc($page->slug) ?>" target="_blank" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
                View Live ↗
            </a>
            <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
                <?= ($page->id ?? null) ? 'Update Policy' : 'Create Policy' ?>
            </button>
        </div>
    </div>
</form>
