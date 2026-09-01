<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500"><?= count($posts ?? []) ?> posts</p>
    <a href="/admin/blog/create" class="bg-charcoal text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition">+ New Post</a>
</div>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Title</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Category</th>
                <th class="px-4 py-3 text-center font-medium text-gray-600">Status</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Date</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($posts ?? [] as $post): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium"><?= esc($post->title) ?></td>
                    <td class="px-4 py-3 text-gray-500"><?= esc($post->category_name ?? '—') ?></td>
                    <td class="px-4 py-3 text-center">
                        <span class="text-xs px-2 py-0.5 rounded <?= $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' ?>"><?= ucfirst($post->status) ?></span>
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs"><?= $post->published_at ? date('M d, Y', strtotime($post->published_at)) : '—' ?></td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/blog/edit/<?= $post->id ?>" class="text-bronze hover:underline mr-3">Edit</a>
                        <form method="POST" action="/admin/blog/delete/<?= $post->id ?>" class="inline" onsubmit="return confirm('Delete?')">
                            <?= csrf_field() ?>
                            <button class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
