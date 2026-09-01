<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($page_title ?? 'V P Singh Advocate') ?></title>
    <?php if (!empty($meta_description)): ?>
        <meta name="description" content="<?= esc($meta_description) ?>">
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
                        heading: ['"EB Garamond"', 'serif'],
                        sans: ['"Open Sans"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .font-heading { font-family: 'EB Garamond', serif; }
        .fade-up { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* Cookie Consent Banner */
        #cookie-consent {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: #1A1816;
            color: #fff;
            padding: 16px 0;
            transform: translateY(100%);
            transition: transform 0.4s ease;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
        }
        #cookie-consent.show { transform: translateY(0); }
        @media (min-width: 768px) {
            #cookie-consent { padding: 20px 0; }
        }
    </style>
</head>
<body class="bg-ivory text-charcoal font-sans">

    <!-- Announcement Bar -->
    <?php if ($announcement ?? null): ?>
        <div class="bg-charcoal text-ivory text-center py-2 px-4 text-sm">
            <span><?= esc($announcement->text) ?></span>
            <?php if (!empty($announcement->cta_label)): ?>
                <a href="<?= esc($announcement->cta_url) ?>" class="underline font-medium ml-2 text-bronze"><?= esc($announcement->cta_label) ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-ivory/95 backdrop-blur-sm border-b border-charcoal/10" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <div>
                        <span class="text-xl md:text-2xl font-heading font-bold text-charcoal tracking-tight">V P Singh</span>
                        <span class="block text-[10px] tracking-[0.3em] uppercase text-bronze font-sans font-semibold -mt-1">Advocate</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-8">
                    <?php foreach (($header_menu ?? []) as $item): ?>
                        <?php if (($item->is_cta ?? 0)): ?>
                            <a href="<?= esc($item->url) ?>" class="bg-charcoal text-white px-5 py-2.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                                <?= esc($item->label) ?>
                            </a>
                        <?php else: ?>
                            <a href="<?= esc($item->url) ?>" class="text-sm font-medium text-charcoal/70 hover:text-charcoal transition">
                                <?= esc($item->label) ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden p-2">
                    <i :class="open ? 'ri-close-line' : 'ri-menu-line'" class="text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" x-transition class="md:hidden bg-ivory border-t border-charcoal/10">
            <nav class="px-4 py-4 space-y-1">
                <?php foreach (($header_menu ?? []) as $item): ?>
                    <a href="<?= esc($item->url) ?>" class="block py-3 px-3 text-sm font-medium rounded-lg <?= ($item->is_cta ?? 0) ? 'bg-charcoal text-white text-center mt-4' : 'hover:bg-charcoal/5' ?>">
                        <?= esc($item->label) ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-charcoal text-white/80 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <h3 class="text-xl font-heading font-bold text-white mb-1">V P Singh</h3>
                    <span class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold">Advocate</span>
                    <p class="mt-4 text-sm leading-relaxed text-white/60">
                        Professional legal consultation and representation in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/about" class="hover:text-bronze transition">About</a></li>
                        <li><a href="/practice-areas" class="hover:text-bronze transition">Practice Areas</a></li>
                        <li><a href="/blog" class="hover:text-bronze transition">Insights</a></li>
                        <li><a href="/contact" class="hover:text-bronze transition">Contact</a></li>
                        <li><a href="/book-consultation" class="hover:text-bronze transition">Book Consultation</a></li>
                    </ul>
                </div>

                <!-- Practice Areas -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Practice Areas</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/criminal-lawyer-lakhimpur-kheri" class="hover:text-bronze transition">Criminal Law</a></li>
                        <li><a href="/family-lawyer-lakhimpur-kheri" class="hover:text-bronze transition">Family Law</a></li>
                        <li><a href="/civil-lawyer-lakhimpur-kheri" class="hover:text-bronze transition">Civil Law</a></li>
                        <li><a href="/cyber-lawyer-lakhimpur-kheri" class="hover:text-bronze transition">Cyber Law</a></li>
                        <li><a href="/corporate-lawyer-lakhimpur-kheri" class="hover:text-bronze transition">Corporate Law</a></li>
                        <li><a href="/drugs-cosmetics-lawyer-lakhimpur-kheri" class="hover:text-bronze transition">Drugs & Cosmetics Law</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact</h4>
                    <ul class="space-y-3 text-sm">
                        <?php if (!empty($phone)): ?>
                            <li class="flex items-center gap-2">
                                <i class="ri-phone-line text-bronze"></i>
                                <a href="tel:<?= esc($phone) ?>" class="hover:text-bronze transition"><?= esc($phone) ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($whatsapp)): ?>
                            <li class="flex items-center gap-2">
                                <i class="ri-whatsapp-line text-bronze"></i>
                                <a href="https://wa.me/<?= esc($whatsapp) ?>" target="_blank" class="hover:text-bronze transition"><?= esc($whatsapp) ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($email)): ?>
                            <li class="flex items-center gap-2">
                                <i class="ri-mail-line text-bronze"></i>
                                <a href="mailto:<?= esc($email) ?>" class="hover:text-bronze transition"><?= esc($email) ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($address)): ?>
                            <li class="flex items-start gap-2">
                                <i class="ri-map-pin-line text-bronze mt-0.5"></i>
                                <span><?= esc($address) ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Social Links -->
                    <div class="flex gap-3 mt-4">
                        <?php if (!empty($social['instagram'])): ?>
                            <a href="<?= esc($social['instagram']) ?>" target="_blank" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-bronze transition">
                                <i class="ri-instagram-line text-sm"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($social['facebook'])): ?>
                            <a href="<?= esc($social['facebook']) ?>" target="_blank" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-bronze transition">
                                <i class="ri-facebook-fill text-sm"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($social['linkedin'])): ?>
                            <a href="<?= esc($social['linkedin']) ?>" target="_blank" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-bronze transition">
                                <i class="ri-linkedin-fill text-sm"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-white/40"><?= esc($copyright) ?></p>
                <div class="flex gap-4 text-xs text-white/40">
                    <a href="/privacy-policy" class="hover:text-bronze transition">Privacy Policy</a>
                    <a href="/terms-conditions" class="hover:text-bronze transition">Terms & Conditions</a>
                    <a href="/legal-disclaimer" class="hover:text-bronze transition">Legal Disclaimer</a>
                    <a href="/refund-cancellation-policy" class="hover:text-bronze transition">Refund Policy</a>
                    <a href="/cookie-policy" class="hover:text-bronze transition">Cookie Policy</a>
                </div>
            </div>
        </div>

        <!-- Disclaimer -->
        <div class="bg-charcoal/80 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <p class="text-[11px] text-white/30 text-center leading-relaxed"><?= esc($disclaimer) ?></p>
            </div>
        </div>
    </footer>

    <!-- Mobile Sticky CTA -->
    <div class="fixed bottom-0 left-0 right-0 md:hidden z-50 bg-white border-t border-gray-200 shadow-lg safe-bottom">
        <div class="flex">
            <?php if (!empty($phone)): ?>
                <a href="tel:<?= esc($phone) ?>" class="flex-1 flex items-center justify-center gap-1 py-3 text-sm font-medium text-charcoal hover:bg-gray-50 transition">
                    <i class="ri-phone-line text-bronze"></i> Call
                </a>
            <?php endif; ?>
            <?php if (!empty($whatsapp)): ?>
                <a href="https://wa.me/<?= esc($whatsapp) ?>" class="flex-1 flex items-center justify-center gap-1 py-3 text-sm font-medium text-charcoal hover:bg-gray-50 transition border-l border-gray-200">
                    <i class="ri-whatsapp-line text-green-500"></i> WhatsApp
                </a>
            <?php endif; ?>
            <a href="/book-consultation" class="flex-1 flex items-center justify-center gap-1 py-3 text-sm font-medium text-white bg-bronze hover:bg-bronze/90 transition">
                <i class="ri-calendar-check-line"></i> Book
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Fade-up animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

        // Auto-generate slug from title
        document.querySelectorAll('[data-slug-source]').forEach(source => {
            const target = document.querySelector(source.dataset.slugSource);
            if (target) {
                source.addEventListener('input', () => {
                    target.value = source.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                });
            }
        });

        // ============================================================
        // Cookie Consent Banner
        // ============================================================
        (function() {
            var KEY = 'vp_cookie_consent';
            var banner = document.getElementById('cookie-consent');
            if (!banner) return;

            // Only show if user hasn't made a choice yet
            if (localStorage.getItem(KEY)) return;

            // Show banner after a short delay
            setTimeout(function() { banner.classList.add('show'); }, 1000);

            // Accept button
            var acceptBtn = document.getElementById('cookie-accept');
            if (acceptBtn) {
                acceptBtn.addEventListener('click', function() {
                    localStorage.setItem(KEY, 'accepted');
                    banner.classList.remove('show');
                });
            }

            // Decline button
            var declineBtn = document.getElementById('cookie-decline');
            if (declineBtn) {
                declineBtn.addEventListener('click', function() {
                    localStorage.setItem(KEY, 'declined');
                    banner.classList.remove('show');
                });
            }
        })();
    </script>

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                <div class="flex-1">
                    <p class="text-sm text-white/80 leading-relaxed">
                        <i class="ri-cookie-line text-bronze mr-1"></i>
                        We use cookies to ensure the website functions properly and to improve your experience. By continuing to use this website, you agree to our use of cookies.
                        <a href="/cookie-policy" target="_blank" class="text-bronze hover:underline ml-1">Learn more</a>
                    </p>
                </div>
                <div class="flex items-center gap-3 flex-shrink-0">
                    <button id="cookie-decline" class="px-4 py-2 text-sm border border-white/20 text-white/70 rounded-sm hover:bg-white/10 transition">
                        Decline
                    </button>
                    <button id="cookie-accept" class="px-5 py-2 text-sm bg-bronze text-white rounded-sm hover:bg-bronze/90 transition font-medium">
                        Accept All
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
