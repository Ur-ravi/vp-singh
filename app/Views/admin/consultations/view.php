<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-lg shadow p-6"><h3 class="font-semibold text-charcoal mb-4">Booking Details</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Booking ID</span><p class="font-mono font-medium"><?= esc($consultation->booking_id) ?></p></div>
            <div><span class="text-gray-500">Amount</span><p class="font-bold text-bronze">₹<?= number_format($consultation->amount) ?></p></div>
            <div><span class="text-gray-500">Client</span><p class="font-medium"><?= esc($consultation->full_name) ?></p></div>
            <div><span class="text-gray-500">Phone</span><p class="font-medium"><?= esc($consultation->mobile) ?></p></div>
            <div><span class="text-gray-500">Email</span><p class="font-medium"><?= esc($consultation->email ?: '—') ?></p></div>
            <div><span class="text-gray-500">City</span><p class="font-medium"><?= esc($consultation->city ?: '—') ?></p></div>
            <div><span class="text-gray-500">Mode</span><p class="font-medium capitalize"><?= esc($consultation->consultation_mode) ?></p></div>
            <div><span class="text-gray-500">Date</span><p class="font-medium"><?= esc($consultation->preferred_date ?: '—') ?></p></div>
            <div><span class="text-gray-500">Time</span><p class="font-medium"><?= esc($consultation->preferred_time ?: '—') ?></p></div>
            <div><span class="text-gray-500">Legal Matter</span><p class="font-medium"><?= esc($consultation->legal_matter ?: '—') ?></p></div>
        </div>
        <?php if (!empty($consultation->description)): ?><div class="mt-4 pt-4 border-t"><span class="text-sm text-gray-500">Description</span><p class="text-sm mt-1"><?= esc($consultation->description) ?></p></div><?php endif; ?>
        </div>

        <?php if ($payment ?? null): ?>
        <div class="bg-white rounded-lg shadow p-6"><h3 class="font-semibold text-charcoal mb-4">Payment Information</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Method</span><p class="font-medium capitalize"><?= esc(str_replace('_', ' ', $payment->payment_method)) ?></p></div>
            <div><span class="text-gray-500">UTR</span><p class="font-mono"><?= esc($payment->utr_number ?: '—') ?></p></div>
            <div><span class="text-gray-500">Status</span><p><span class="text-xs px-2 py-0.5 rounded <?= $payment->status === 'verified' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>"><?= ucfirst($payment->status) ?></span></p></div>
        </div>
        <?php if (!empty($payment->screenshot)): ?><div class="mt-4"><a href="/<?= esc($payment->screenshot) ?>" target="_blank" class="text-bronze hover:underline text-sm">View Screenshot</a></div><?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6"><h3 class="font-semibold text-charcoal mb-4">Update Status</h3>
        <form method="POST" action="/admin/consultations/update/<?= $consultation->id ?>" class="space-y-4">
            <?= csrf_field() ?>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Booking Status</label><select name="booking_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"><option value="pending" <?= $consultation->booking_status === 'pending' ? 'selected' : '' ?>>Pending</option><option value="confirmed" <?= $consultation->booking_status === 'confirmed' ? 'selected' : '' ?>>Confirmed</option><option value="completed" <?= $consultation->booking_status === 'completed' ? 'selected' : '' ?>>Completed</option><option value="cancelled" <?= $consultation->booking_status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label><select name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"><option value="awaiting" <?= $consultation->payment_status === 'awaiting' ? 'selected' : '' ?>>Awaiting</option><option value="submitted" <?= $consultation->payment_status === 'submitted' ? 'selected' : '' ?>>Submitted</option><option value="verified" <?= $consultation->payment_status === 'verified' ? 'selected' : '' ?>>Verified</option><option value="rejected" <?= $consultation->payment_status === 'rejected' ? 'selected' : '' ?>>Rejected</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Notes</label><textarea name="notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($consultation->notes ?? '') ?></textarea></div>
            <button type="submit" class="w-full bg-charcoal text-white py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Update</button>
        </form></div>

        <a href="/admin/consultations" class="block text-center text-sm text-bronze hover:underline">← Back to List</a>
    </div>
</div>
