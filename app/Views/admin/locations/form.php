<form method="POST" action="<?= $location ? '/admin/locations/update/'.$location->id : '/admin/locations/store' ?>" class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <?= csrf_field() ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Office Name *</label><input type="text" name="office_name" required value="<?= esc($location->office_name ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Address</label><input type="text" name="address" value="<?= esc($location->address ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">City *</label><input type="text" name="city" required value="<?= esc($location->city ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">State *</label><input type="text" name="state" required value="<?= esc($location->state ?? 'Uttar Pradesh') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">PIN</label><input type="text" name="pin" value="<?= esc($location->pin ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Phone</label><input type="text" name="phone" value="<?= esc($location->phone ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label><input type="text" name="whatsapp" value="<?= esc($location->whatsapp ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" name="email" value="<?= esc($location->email ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Google Maps URL</label><input type="url" name="google_maps_url" value="<?= esc($location->google_maps_url ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Office Hours</label><input type="text" name="office_hours" value="<?= esc($location->office_hours ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-5">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label><input type="text" name="latitude" value="<?= esc($location->latitude ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label><input type="text" name="longitude" value="<?= esc($location->longitude ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label><input type="number" name="sort_order" value="<?= $location->sort_order ?? 0 ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" <?= ($location->is_active ?? 1) ? 'checked' : '' ?> class="rounded"> Active</label></div>
    <div class="mt-6 flex justify-end gap-3"><a href="/admin/locations" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">Cancel</a><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800"><?= $location ? 'Update' : 'Create' ?></button></div>
</form>
