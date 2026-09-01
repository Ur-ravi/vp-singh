<form method="POST" action="/admin/settings/save" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <?= csrf_field() ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
            <input type="text" name="site_name" value="<?= esc(($settings[0]->setting_value ?? '') === 'site_name' ? $settings[0]->setting_value : '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"
                   placeholder="V P Singh Advocate">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tagline</label>
            <input type="text" name="tagline"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
    </div>

    <?php
        // Build settings lookup
        $sLookup = [];
        foreach ($settings as $s) { $sLookup[$s->setting_key] = $s->setting_value; }
    ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="phone" value="<?= esc($sLookup['phone'] ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp (with country code)</label>
            <input type="text" name="whatsapp" value="<?= esc($sLookup['whatsapp'] ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="<?= esc($sLookup['email'] ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee (₹)</label>
            <input type="number" name="consultation_fee" value="<?= esc($sLookup['consultation_fee'] ?? '2100') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
        <input type="text" name="address" value="<?= esc($sLookup['address'] ?? '') ?>"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Business Hours</label>
        <input type="text" name="business_hours" value="<?= esc($sLookup['business_hours'] ?? '') ?>"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
            <input type="file" name="logo" accept="image/*"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs">
            <?php if (!empty($sLookup['logo'])): ?>
                <img src="/<?= esc($sLookup['logo']) ?>" alt="Logo" class="mt-2 h-10">
            <?php endif; ?>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Favicon</label>
            <input type="file" name="favicon" accept="image/*"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs">
            <?php if (!empty($sLookup['favicon'])): ?>
                <img src="/<?= esc($sLookup['favicon']) ?>" alt="Favicon" class="mt-2 h-8">
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Copyright Text</label>
        <input type="text" name="copyright" value="<?= esc($sLookup['copyright'] ?? '') ?>"
               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>

    <div class="mt-5">
        <label class="block text-sm font-medium text-gray-700 mb-1">Legal Disclaimer</label>
        <textarea name="disclaimer" rows="3"
                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($sLookup['disclaimer'] ?? '') ?></textarea>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">
            Save Settings
        </button>
    </div>
</form>
