<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <a href="/admin/enquiries" class="bg-white rounded-lg shadow p-5 border-l-4 border-red-400 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">New Enquiries</p>
                <p class="text-2xl font-bold text-charcoal mt-1"><?= $new_enquiries ?? 0 ?></p>
            </div>
            <i class="ri-mail-line text-2xl text-red-400"></i>
        </div>
    </a>

    <a href="/admin/consultations" class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-400 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Pending Consultations</p>
                <p class="text-2xl font-bold text-charcoal mt-1"><?= $pending_consultations ?? 0 ?></p>
            </div>
            <i class="ri-calendar-check-line text-2xl text-yellow-400"></i>
        </div>
    </a>

    <a href="/admin/payments" class="bg-white rounded-lg shadow p-5 border-l-4 border-bronze hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Pending Payments</p>
                <p class="text-2xl font-bold text-charcoal mt-1"><?= $pending_payments ?? 0 ?></p>
            </div>
            <i class="ri-money-rupee-circle-line text-2xl text-bronze"></i>
        </div>
    </a>

    <a href="/admin/blog" class="bg-white rounded-lg shadow p-5 border-l-4 border-green-400 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Blog Posts</p>
                <p class="text-2xl font-bold text-charcoal mt-1"><?= ($published_posts ?? 0) ?> <span class="text-sm font-normal text-gray-400">/ <?= ($draft_posts ?? 0) ?> drafts</span></p>
            </div>
            <i class="ri-article-line text-2xl text-green-400"></i>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-charcoal mb-4">Quick Actions</h3>
        <div class="space-y-2">
            <a href="/admin/enquiries" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center"><i class="ri-mail-line text-red-500"></i></div>
                <div>
                    <p class="font-medium text-sm">View Enquiries</p>
                    <p class="text-xs text-gray-400">Manage incoming enquiries</p>
                </div>
            </a>
            <a href="/admin/blog/create" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center"><i class="ri-add-line text-green-500"></i></div>
                <div>
                    <p class="font-medium text-sm">Write Blog Post</p>
                    <p class="text-xs text-gray-400">Create new content</p>
                </div>
            </a>
            <a href="/admin/consultations" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-yellow-50 rounded-lg flex items-center justify-center"><i class="ri-calendar-check-line text-yellow-500"></i></div>
                <div>
                    <p class="font-medium text-sm">Manage Consultations</p>
                    <p class="text-xs text-gray-400">Review and confirm bookings</p>
                </div>
            </a>
            <a href="/admin/settings" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center"><i class="ri-settings-line text-gray-500"></i></div>
                <div>
                    <p class="font-medium text-sm">Site Settings</p>
                    <p class="text-xs text-gray-400">Configure site information</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Site Info -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-charcoal mb-4">Site Information</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Site Name</span>
                <span class="font-medium"><?= esc($site_name) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Consultation Fee</span>
                <span class="font-medium">₹<?= number_format(\App\Libraries\Settings::get('consultation_fee', '2100')) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Your Role</span>
                <span class="font-medium"><?= esc(ucfirst(str_replace('_', ' ', $auth_user->role ?? ''))) ?></span>
            </div>
            <div class="border-t pt-3 mt-3">
                <p class="text-gray-400 text-xs">Last Login</p>
                <p class="font-medium"><?= $auth_user->last_login ?? 'First login' ?></p>
            </div>
        </div>
    </div>
</div>
