<form method="POST" action="<?= $user ? '/admin/users/update/'.$user->id : '/admin/users/store' ?>" class="bg-white rounded-lg shadow p-6 max-w-xl">
    <?= csrf_field() ?>
    <div class="space-y-4">
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Username</label><input type="text" name="username" value="<?= esc($user->username ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Email *</label><input type="email" name="email" required value="<?= esc($user->email ?? '') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Password <?= $user ? '(leave blank to keep)' : '*' ?></label><input type="password" name="password" <?= $user ? '' : 'required' ?> class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none"></div>
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Role</label><select name="role" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm"><option value="editor" <?= ($user->role ?? '') === 'editor' ? 'selected' : '' ?>>Editor</option><option value="super_admin" <?= ($user->role ?? '') === 'super_admin' ? 'selected' : '' ?>>Super Admin</option></select></div>
        <div><label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" <?= ($user->is_active ?? 1) ? 'checked' : '' ?> class="rounded"> Active</label></div>
    </div>
    <div class="mt-6 flex justify-end gap-3"><a href="/admin/users" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm">Cancel</a><button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800"><?= $user ? 'Update' : 'Create' ?></button></div>
</form>
