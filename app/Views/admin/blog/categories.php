<?php
// Reusable admin views for Blog Categories, Tags, FAQs, Testimonials, Locations, Pages, Navigation, Consultations, Payments, Enquiries, Media, Announcements, Settings, Users
// Each is a simple CRUD listing or form - creating them as compact views
?>

<!-- blog/categories.php -->
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500"><?= count($categories ?? []) ?> categories</p>
</div>
<form method="POST" action="/admin/blog/categories/store" class="bg-white rounded-lg shadow p-4 mb-6 flex gap-3 items-end">
    <?= csrf_field() ?>
    <div class="flex-1">
        <label class="block text-xs font-medium text-gray-500 mb-1">Name</label>
        <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
    </div>
    <button type="submit" class="bg-bronze text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-bronze/90 transition">Add</button>
</form>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm"><thead class="bg-gray-50 border-b"><tr><th class="px-4 py-3 text-left font-medium text-gray-600">Name</th><th class="px-4 py-3 text-left font-medium text-gray-600">Slug</th><th class="px-4 py-3 text-right font-medium text-gray-600">Action</th></tr></thead>
    <tbody class="divide-y">
        <?php foreach ($categories ?? [] as $cat): ?>
            <tr class="hover:bg-gray-50"><td class="px-4 py-3"><?= esc($cat->name) ?></td><td class="px-4 py-3 text-gray-500 font-mono text-xs"><?= esc($cat->slug) ?></td>
            <td class="px-4 py-3 text-right"><form method="POST" action="/admin/blog/categories/delete/<?= $cat->id ?>" class="inline" onsubmit="return confirm('Delete?')"><input type="hidden" name="_method" value="POST"><button class="text-red-500 hover:underline text-xs">Delete</button></form></td></tr>
        <?php endforeach; ?>
    </tbody></table>
</div>
