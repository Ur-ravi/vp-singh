<form method="POST" action="/admin/advocate/profile/save" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Name *</label><input type="text" name="name" required value="<?= esc($profile->name ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Designation</label><input type="text" name="designation" value="<?= esc($profile->designation ?? 'Advocate') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Biography (HTML)</label><textarea name="biography" class="wysiwyg-editor"><?= esc($profile->biography ?? '') ?></textarea></div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label><input type="file" name="profile_image" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs"><?php if (!empty($profile->profile_image)): ?><img src="/<?= esc($profile->profile_image) ?>" class="mt-2 h-20 rounded"><?php endif; ?></div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Education</label><textarea name="education" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($profile->education ?? '') ?></textarea></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Experience</label><textarea name="experience" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($profile->experience ?? '') ?></textarea></div>
    </div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Court Information</label><textarea name="court_info" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($profile->court_info ?? '') ?></textarea></div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Memberships</label><textarea name="memberships" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($profile->memberships ?? '') ?></textarea></div>
    <div class="mt-5"><label class="block text-sm font-medium text-gray-700 mb-1">Credentials</label><textarea name="credentials" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($profile->credentials ?? '') ?></textarea></div>
    <div class="mt-6 flex justify-end"><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Save Profile</button></div>
</form>
