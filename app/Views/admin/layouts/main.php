<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'Admin') ?> — <?= esc($site_name ?? 'V P Singh Advocate') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        charcoal: '#1A1816',
                        ivory: '#F5EDE6',
                        bronze: '#A38366',
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-charcoal text-white flex-shrink-0 flex flex-col">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-lg font-bold">Admin Panel</h1>
                <p class="text-xs text-gray-400 mt-1">V P Singh Advocate</p>
            </div>

            <nav class="flex-1 overflow-y-auto p-3 space-y-1 text-sm">
                <a href="/admin/dashboard" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>

                <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Website</div>
                <a href="/admin/homepage" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-home-line"></i> Homepage
                </a>
                
                <a href="/admin/pages" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-file-text-line"></i> Pages
                </a>
                <a href="/admin/policy-pages" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-shield-check-line"></i> Policy Pages
                </a>
                <a href="/admin/navigation" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-menu-line"></i> Navigation
                </a>
                <a href="/admin/announcements" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-megaphone-line"></i> Announcements
                </a>

                <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Content</div>
                <a href="/admin/advocate/profile" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-user-line"></i> Advocate Profile
                </a>
                <a href="/admin/practice-areas" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-scales-3-line"></i> Practice Areas
                </a>
                <a href="/admin/locations" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-map-pin-line"></i> Locations
                </a>
                <a href="/admin/testimonials" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-chat-quote-line"></i> Testimonials
                </a>
                <a href="/admin/faqs" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-question-line"></i> FAQs
                </a>

                <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Blog</div>
                <a href="/admin/blog" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-article-line"></i> Posts
                </a>
                <a href="/admin/blog/categories" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-folder-line"></i> Categories
                </a>
                <a href="/admin/blog/tags" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-price-tag-line"></i> Tags
                </a>

                <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Business</div>
                <a href="/admin/consultations" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-calendar-check-line"></i> Consultations
                    <?php if (($new_enquiries ?? 0) + ($pending_consultations ?? 0) > 0): ?>
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5"><?= ($pending_consultations ?? 0) ?></span>
                    <?php endif; ?>
                </a>
                <a href="/admin/payments" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-money-rupee-circle-line"></i> Payments
                    <?php if (($pending_payments ?? 0) > 0): ?>
                        <span class="ml-auto bg-yellow-500 text-white text-xs rounded-full px-1.5"><?= $pending_payments ?></span>
                    <?php endif; ?>
                </a>
                <a href="/admin/enquiries" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-mail-line"></i> Enquiries
                    <?php if (($new_enquiries ?? 0) > 0): ?>
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-1.5"><?= $new_enquiries ?></span>
                    <?php endif; ?>
                </a>

                <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Tools</div>
                <a href="/admin/media" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-image-line"></i> Media Library
                </a>

                <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Settings</div>
                <a href="/admin/settings" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-settings-line"></i> General
                </a>
                <a href="/admin/settings/social" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-share-line"></i> Social Media
                </a>
                <a href="/admin/payments/qr" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-qr-code-line"></i> QR Code
                </a>
                <a href="/admin/payments/bank" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-bank-line"></i> Bank Details
                </a>
                <a href="/admin/payments/settings" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-wallet-line"></i> Payment Settings
                </a>

                <?php if ($is_super_admin ?? false): ?>
                    <div class="pt-3 pb-1 px-3 text-xs text-gray-500 uppercase tracking-wider">Admin</div>
                    <a href="/admin/users" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                        <i class="ri-team-line"></i> Users
                    </a>
                <?php endif; ?>
            </nav>

            <div class="p-3 border-t border-gray-700 text-sm">
                <a href="/" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition">
                    <i class="ri-external-link-line"></i> View Website
                </a>
                <a href="/admin/logout" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-white/10 transition text-red-400">
                    <i class="ri-logout-box-line"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-3 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-charcoal"><?= esc($page_title ?? 'Dashboard') ?></h2>
                <div class="flex items-center gap-4 text-sm text-gray-600">
                    <span class="flex items-center gap-1">
                        <i class="ri-user-line"></i>
                        <?= esc($auth_user->username ?? 'Admin') ?>
                    </span>
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium <?= ($auth_user->role ?? '') === 'super_admin' ? 'bg-bronze text-white' : 'bg-gray-200' ?>">
                        <?= esc(ucfirst(str_replace('_', ' ', $auth_user->role ?? 'editor'))) ?>
                    </span>
                </div>
            </header>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
                    <i class="ri-check-line"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center gap-2">
                    <i class="ri-error-warning-line"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <?= $content ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>