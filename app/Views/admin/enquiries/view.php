<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2"><div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-charcoal mb-4">Enquiry #<?= $enquiry->id ?></h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Name</span><p class="font-medium"><?= esc($enquiry->name) ?></p></div>
            <div><span class="text-gray-500">Phone</span><p class="font-medium"><?= esc($enquiry->phone ?: '—') ?></p></div>
            <div><span class="text-gray-500">Email</span><p class="font-medium"><?= esc($enquiry->email ?: '—') ?></p></div>
            <div><span class="text-gray-500">City</span><p class="font-medium"><?= esc($enquiry->city ?: '—') ?></p></div>
            <div><span class="text-gray-500">Subject</span><p class="font-medium"><?= esc($enquiry->subject ?: '—') ?></p></div>
            <div><span class="text-gray-500">Legal Matter</span><p class="font-medium"><?= esc($enquiry->legal_matter ?: '—') ?></p></div>
        </div>
        <div class="mt-4 pt-4 border-t"><span class="text-sm text-gray-500">Message</span><p class="text-sm mt-1 whitespace-pre-wrap"><?= esc($enquiry->message) ?></p></div>
        <div class="mt-4 pt-4 border-t"><span class="text-sm text-gray-500">Source</span><p class="text-xs text-gray-400 mt-1"><?= esc($enquiry->source_page ?: '—') ?></p></div>
    </div></div>
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6"><h3 class="font-semibold text-charcoal mb-4">Update</h3>
        <form method="POST" action="/admin/enquiries/update/<?= $enquiry->id ?>" class="space-y-4">
            <?= csrf_field() ?>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Status</label><select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"><option value="new" <?= $enquiry->status === 'new' ? 'selected' : '' ?>>New</option><option value="contacted" <?= $enquiry->status === 'contacted' ? 'selected' : '' ?>>Contacted</option><option value="consultation_booked" <?= $enquiry->status === 'consultation_booked' ? 'selected' : '' ?>>Consultation Booked</option><option value="converted" <?= $enquiry->status === 'converted' ? 'selected' : '' ?>>Converted</option><option value="closed" <?= $enquiry->status === 'closed' ? 'selected' : '' ?>>Closed</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label><textarea name="admin_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= esc($enquiry->admin_notes ?? '') ?></textarea></div>
            <button type="submit" class="w-full bg-charcoal text-white py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800">Update</button>
        </form></div>
        <form method="POST" action="/admin/enquiries/delete/<?= $enquiry->id ?>" onsubmit="return confirm('Delete this enquiry?')"><input type="hidden" name="_method" value="POST"><button class="w-full text-red-500 text-sm hover:underline py-2">Delete Enquiry</button></form>
        <a href="/admin/enquiries" class="block text-center text-sm text-bronze hover:underline">← Back to List</a>
    </div>
</div>
