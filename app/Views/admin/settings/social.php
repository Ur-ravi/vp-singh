<?php $sLookup = []; foreach ($settings as $s) { $sLookup[$s->setting_key] = $s->setting_value; } ?>
<form method="POST" action="/admin/settings/social/save" class="bg-white rounded-lg shadow p-6 max-w-xl">
    <?= csrf_field() ?>
    <h3 class="font-semibold text-charcoal mb-4">Social Media Links</h3>
    <div class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label><input type="url" name="social_instagram" value="<?= esc($sLookup['social_instagram'] ?? '') ?>" placeholder="https://instagram.com/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label><input type="url" name="social_facebook" value="<?= esc($sLookup['social_facebook'] ?? '') ?>" placeholder="https://facebook.com/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label><input type="url" name="social_linkedin" value="<?= esc($sLookup['social_linkedin'] ?? '') ?>" placeholder="https://linkedin.com/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">YouTube URL</label><input type="url" name="social_youtube" value="<?= esc($sLookup['social_youtube'] ?? '') ?>" placeholder="https://youtube.com/..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <p class="text-xs text-gray-400 mt-3">Leave empty to hide the social link on the frontend.</p>
    <div class="mt-6 flex justify-end"><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Save</button></div>
</form>
