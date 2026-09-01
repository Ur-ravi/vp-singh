<div class="flex items-center justify-between mb-6"><p class="text-sm text-gray-500"><?= count($qr_methods ?? []) ?> QR methods</p></div>
<form method="POST" action="/admin/payments/qr/store" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 mb-6">
    <?= csrf_field() ?>
    <h4 class="font-medium text-gray-700 mb-3">Add QR Code</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Label</label><input type="text" name="label" value="Scan to Pay" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">UPI ID</label><input type="text" name="upi_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="mt-4"><label class="block text-sm font-medium text-gray-700 mb-1">QR Image</label><input type="file" name="qr_image" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs"></div>
    <div class="mt-4"><label class="block text-sm font-medium text-gray-700 mb-1">Instructions</label><textarea name="instructions" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"></textarea></div>
    <div class="flex gap-4 mt-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_enabled" value="1" checked class="rounded"> Enabled</label><div><label class="block text-xs text-gray-500 mb-1">Order</label><input type="number" name="sort_order" value="0" class="w-20 px-3 py-1.5 border border-gray-300 rounded-lg text-sm"></div></div>
    <div class="mt-4 flex justify-end"><button type="submit" class="bg-charcoal text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800">Add QR</button></div>
</form>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($qr_methods ?? [] as $qr): ?>
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="font-medium text-sm"><?= esc($qr->label) ?></p>
                    <p class="text-xs text-gray-500 mt-1">UPI: <?= esc($qr->upi_id) ?></p>
                    <p class="text-xs mt-1"><?= $qr->is_enabled ? '<span class="text-green-600">Enabled</span>' : '<span class="text-gray-400">Disabled</span>' ?></p>
                </div>
                <form method="POST" action="/admin/payments/qr/delete/<?= $qr->id ?>" onsubmit="return confirm('Delete?')"><input type="hidden" name="_method" value="POST"><button class="text-red-500 text-xs hover:underline">Delete</button></form>
            </div>
            <?php if (!empty($qr->qr_image)): ?><img src="/<?= esc($qr->qr_image) ?>" class="mt-3 h-24 rounded"><?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
