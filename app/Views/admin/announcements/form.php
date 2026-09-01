<form method="POST" action="<?= $announcement ? '/admin/announcements/update/'.$announcement->id : '/admin/announcements/store' ?>" class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <?= csrf_field() ?>
    <div><label class="block text-sm font-medium text-gray-700 mb-1">Announcement Text *</label><input type="text" name="text" required value="<?= esc($announcement->text ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">CTA Label</label><input type="text" name="cta_label" value="<?= esc($announcement->cta_label ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">CTA URL</label><input type="text" name="cta_url" value="<?= esc($announcement->cta_url ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label><input type="date" name="start_date" value="<?= esc($announcement->start_date ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">End Date</label><input type="date" name="end_date" value="<?= esc($announcement->end_date ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" <?= ($announcement->is_active ?? 1) ? 'checked' : '' ?> class="rounded"> Active</label></div>
    <div class="mt-6 flex justify-end gap-3"><a href="/admin/announcements" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm">Cancel</a><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800"><?= $announcement ? 'Update' : 'Create' ?></button></div>
</form>
