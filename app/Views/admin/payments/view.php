<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-6"><h3 class="font-semibold text-charcoal mb-4">Payment #<?= $payment->id ?></h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Client</span><p class="font-medium"><?= esc($payment->client_name) ?></p></div>
            <div><span class="text-gray-500">Phone</span><p class="font-medium"><?= esc($payment->mobile) ?></p></div>
            <div><span class="text-gray-500">Amount</span><p class="font-bold text-bronze text-lg">₹<?= number_format($payment->amount) ?></p></div>
            <div><span class="text-gray-500">Method</span><p class="font-medium capitalize"><?= esc(str_replace('_',' ',$payment->payment_method)) ?></p></div>
            <div><span class="text-gray-500">UTR</span><p class="font-mono"><?= esc($payment->utr_number ?: '—') ?></p></div>
            <div><span class="text-gray-500">Date</span><p class="font-medium"><?= $payment->created_at ?></p></div>
        </div>
        <?php if (!empty($payment->screenshot)): ?><div class="mt-4 pt-4 border-t"><a href="/<?= esc($payment->screenshot) ?>" target="_blank" class="inline-flex items-center gap-1 text-bronze hover:underline text-sm"><i class="ri-image-line"></i> View Payment Screenshot</a></div><?php endif; ?>
        <?php if (!empty($payment->admin_notes)): ?><div class="mt-4 pt-4 border-t"><span class="text-sm text-gray-500">Admin Notes</span><p class="text-sm mt-1"><?= esc($payment->admin_notes) ?></p></div><?php endif; ?>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-charcoal mb-4">Update Status</h3>
        <form method="POST" action="/admin/payments/update/<?= $payment->id ?>" class="space-y-4">
            <?= csrf_field() ?>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Status</label><select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"><option value="awaiting" <?= $payment->status === 'awaiting' ? 'selected' : '' ?>>Awaiting</option><option value="submitted" <?= $payment->status === 'submitted' ? 'selected' : '' ?>>Submitted</option><option value="verified" <?= $payment->status === 'verified' ? 'selected' : '' ?>>Verified</option><option value="rejected" <?= $payment->status === 'rejected' ? 'selected' : '' ?>>Rejected</option><option value="refunded" <?= $payment->status === 'refunded' ? 'selected' : '' ?>>Refunded</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label><textarea name="admin_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($payment->admin_notes ?? '') ?></textarea></div>
            <button type="submit" class="w-full bg-charcoal text-white py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Update</button>
        </form>
        <a href="/admin/payments" class="block text-center text-sm text-bronze hover:underline mt-4">← Back to List</a>
    </div>
</div>
