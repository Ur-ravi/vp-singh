<?php
$sLookup = [];
foreach ($groups as $group => $items) {
    foreach ($items as $item) {
        $sLookup[$item->setting_key] = $item->setting_value;
    }
}
?>

<form method="POST" action="/admin/homepage/save" class="space-y-6">
    <?= csrf_field() ?>

    <!-- Hero Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-charcoal mb-4">Hero Section</h3>
        <div class="space-y-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Eyebrow</label><input type="text" name="hero_eyebrow" value="<?= esc($sLookup['hero_eyebrow'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Heading</label><input type="text" name="hero_heading" value="<?= esc($sLookup['hero_heading'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label><textarea name="hero_description" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($sLookup['hero_description'] ?? '') ?></textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Primary CTA Label</label><input type="text" name="hero_cta_label" value="<?= esc($sLookup['hero_cta_label'] ?? 'Book Consultation') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Primary CTA URL</label><input type="text" name="hero_cta_url" value="<?= esc($sLookup['hero_cta_url'] ?? '/book-consultation') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Secondary CTA Label</label><input type="text" name="hero_secondary_cta_label" value="<?= esc($sLookup['hero_secondary_cta_label'] ?? 'Talk on WhatsApp') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Secondary CTA URL</label><input type="text" name="hero_secondary_cta_url" value="<?= esc($sLookup['hero_secondary_cta_url'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Location Text</label><input type="text" name="hero_location" value="<?= esc($sLookup['hero_location'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Image Position</label><select name="hero_image_position" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm"><option value="right" <?= ($sLookup['hero_image_position'] ?? '') === 'right' ? 'selected' : '' ?>>Right</option><option value="left" <?= ($sLookup['hero_image_position'] ?? '') === 'left' ? 'selected' : '' ?>>Left</option></select></div>
                <div class="flex items-end"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="hero_visible" value="1" <?= ($sLookup['hero_visible'] ?? '1') == '1' ? 'checked' : '' ?> class="rounded"> Visible</label></div>
            </div>
        </div>
    </div>

    <!-- Introduction Section -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-charcoal mb-4">Introduction Section</h3>
        <div class="space-y-4">
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Heading</label><input type="text" name="intro_heading" value="<?= esc($sLookup['intro_heading'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Content (HTML)</label><textarea name="intro_content" rows="8" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-y font-mono"><?= esc($sLookup['intro_content'] ?? '') ?></textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">CTA Label</label><input type="text" name="intro_cta_label" value="<?= esc($sLookup['intro_cta_label'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">CTA URL</label><input type="text" name="intro_cta_url" value="<?= esc($sLookup['intro_cta_url'] ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
            </div>
            <div><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="intro_visible" value="1" <?= ($sLookup['intro_visible'] ?? '1') == '1' ? 'checked' : '' ?> class="rounded"> Visible</label></div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Save All Settings</button>
    </div>
</form>
