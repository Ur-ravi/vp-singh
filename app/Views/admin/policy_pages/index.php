<div class="mb-6">
    <p class="text-sm text-gray-500">Manage your website policy pages. These appear in the footer and are important for legal compliance.</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Policy</th>
                <th class="px-4 py-3 text-left font-medium text-gray-600">Slug</th>
                <th class="px-4 py-3 text-center font-medium text-gray-600">Status</th>
                <th class="px-4 py-3 text-right font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($policies as $slug => $policy): ?>
                <tr class="hover:bg-gray-50 <?= ($policy->_needs_create ?? false) ? 'bg-yellow-50/50' : '' ?>">
                    <td class="px-4 py-3">
                        <div class="font-medium"><?= esc($policy->title) ?></div>
                        <?php if ($policy->_needs_create ?? false): ?>
                            <span class="text-xs text-amber-600">Not yet created — click Edit to add content</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-gray-500 font-mono text-xs">/<?= esc($slug) ?></td>
                    <td class="px-4 py-3 text-center">
                        <?php if ($policy->_needs_create ?? false): ?>
                            <span class="text-xs px-2 py-0.5 rounded bg-gray-100 text-gray-400">Missing</span>
                        <?php elseif ($policy->is_published): ?>
                            <span class="text-xs px-2 py-0.5 rounded bg-green-100 text-green-700">Published</span>
                        <?php else: ?>
                            <span class="text-xs px-2 py-0.5 rounded bg-gray-100 text-gray-500">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <a href="/admin/policy-pages/edit/<?= esc($slug) ?>" class="text-bronze hover:underline mr-3">Edit</a>
                        <?php if (!($policy->_needs_create ?? false)): ?>
                            <a href="/admin/policy-pages/toggle/<?= esc($slug) ?>" class="text-gray-500 hover:underline mr-3">
                                <?= $policy->is_published ? 'Unpublish' : 'Publish' ?>
                            </a>
                            <a href="/<?= esc($slug) ?>" target="_blank" class="text-blue-500 hover:underline mr-3">View</a>
                            <form method="POST" action="/admin/policy-pages/delete/<?= esc($slug) ?>" class="inline" onsubmit="return confirm('Delete this policy page? The route will still work but content will be empty.')">
                                <?= csrf_field() ?>
                                <button class="text-red-500 hover:underline text-xs">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
