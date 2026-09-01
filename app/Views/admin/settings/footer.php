<form method="POST" action="/admin/settings/footer/save" class="bg-white rounded-lg shadow p-6 max-w-xl">
    <?= csrf_field() ?>
    <p class="text-sm text-gray-500 mb-4">Footer content is managed via the Footer menu and general settings. Update copyright and address in General Settings.</p>
    <div class="mt-6 flex justify-end"><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Save</button></div>
</form>
