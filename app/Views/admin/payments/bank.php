<form method="POST" action="/admin/payments/bank/store" class="bg-white rounded-lg shadow p-6 mb-6">
    <?= csrf_field() ?>
    <h4 class="font-medium text-gray-700 mb-3">Add Bank Account</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Label</label><input type="text" name="label" value="Bank Transfer" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Account Holder</label><input type="text" name="account_holder" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label><input type="text" name="bank_name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Account Number</label><input type="text" name="account_number" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">IFSC</label><input type="text" name="ifsc" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Branch</label><input type="text" name="branch" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Account Type</label><select name="account_type" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm"><option>Savings</option><option>Current</option></select></div>
    </div>
    <div class="mt-4"><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_enabled" value="1" checked class="rounded"> Enabled</label></div>
    <div class="mt-4 flex justify-end"><button type="submit" class="bg-charcoal text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800">Add Bank Account</button></div>
</form>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($bank_methods ?? [] as $bank): ?>
        <div class="bg-white rounded-lg shadow p-5">
            <div class="flex items-start justify-between">
                <div><p class="font-medium text-sm"><?= esc($bank->account_holder) ?></p><p class="text-xs text-gray-500"><?= esc($bank->bank_name) ?></p><p class="text-xs font-mono mt-1">A/C: <?= esc($bank->account_number) ?></p><p class="text-xs font-mono">IFSC: <?= esc($bank->ifsc) ?></p><p class="text-xs mt-1"><?= $bank->is_enabled ? '<span class="text-green-600">Enabled</span>' : '<span class="text-gray-400">Disabled</span>' ?></p></div>
                <form method="POST" action="/admin/payments/bank/delete/<?= $bank->id ?>" onsubmit="return confirm('Delete?')"><input type="hidden" name="_method" value="POST"><button class="text-red-500 text-xs hover:underline">Delete</button></form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
