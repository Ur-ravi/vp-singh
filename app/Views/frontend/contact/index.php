<section class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Contact</p>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-charcoal">Get in Touch</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div class="fade-up">
                <h2 class="font-heading text-2xl font-bold text-charcoal mb-6">V P Singh Advocate</h2>
                <p class="text-charcoal/60 mb-8">Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India</p>

                <div class="space-y-4 mb-8">
                    <?php if (!empty($phone)): ?>
                        <a href="tel:<?= esc($phone) ?>" class="flex items-center gap-3 text-sm hover:text-bronze transition">
                            <div class="w-10 h-10 rounded-full bg-ivory flex items-center justify-center"><i class="ri-phone-line text-bronze"></i></div>
                            <span><?= esc($phone) ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($whatsapp)): ?>
                        <a href="https://wa.me/<?= esc($whatsapp) ?>" class="flex items-center gap-3 text-sm hover:text-bronze transition">
                            <div class="w-10 h-10 rounded-full bg-ivory flex items-center justify-center"><i class="ri-whatsapp-line text-green-500"></i></div>
                            <span><?= esc($whatsapp) ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($email)): ?>
                        <a href="mailto:<?= esc($email) ?>" class="flex items-center gap-3 text-sm hover:text-bronze transition">
                            <div class="w-10 h-10 rounded-full bg-ivory flex items-center justify-center"><i class="ri-mail-line text-bronze"></i></div>
                            <span><?= esc($email) ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($business_hours)): ?>
                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-10 h-10 rounded-full bg-ivory flex items-center justify-center"><i class="ri-time-line text-bronze"></i></div>
                            <span><?= esc($business_hours) ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Locations -->
                <?php if (!empty($locations)): ?>
                    <?php foreach ($locations as $loc): ?>
                        <div class="bg-white border border-charcoal/10 rounded-sm p-5 mb-4">
                            <h3 class="font-heading font-bold text-charcoal mb-2"><?= esc($loc->office_name) ?></h3>
                            <p class="text-sm text-charcoal/60 mb-2"><?= esc($loc->address) ?>, <?= esc($loc->city) ?>, <?= esc($loc->state) ?> <?= esc($loc->pin) ?></p>
                            <?php if (!empty($loc->office_hours)): ?>
                                <p class="text-xs text-charcoal/40"><?= esc($loc->office_hours) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($loc->google_maps_url)): ?>
                                <a href="<?= esc($loc->google_maps_url) ?>" target="_blank" class="inline-flex items-center gap-1 text-xs text-bronze mt-2 hover:underline">
                                    <i class="ri-map-pin-line"></i> Get Directions
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Map -->
                <?php if (!empty($locations[0]->google_maps_url)): ?>
                    <div class="mt-6 rounded-sm overflow-hidden border border-charcoal/10">
                        <iframe src="<?= esc($locations[0]->google_maps_url) ?>" width="100%" height="250" style="border:0;" allowfullscreen loading="lazy"></iframe>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Contact Form -->
            <div class="fade-up">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 text-sm rounded">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/contact/submit" class="bg-white border border-charcoal/10 rounded-sm p-8 space-y-5">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Name *</label>
                            <input type="text" name="name" required value="<?= old('name') ?>"
                                   class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Phone</label>
                            <input type="tel" name="phone" value="<?= old('phone') ?>"
                                   class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">Email</label>
                            <input type="email" name="email" value="<?= old('email') ?>"
                                   class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal mb-1">City</label>
                            <input type="text" name="city" value="<?= old('city') ?>"
                                   class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Legal Matter</label>
                        <input type="text" name="legal_matter" value="<?= old('legal_matter') ?>"
                               class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Message *</label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none resize-none"><?= old('message') ?></textarea>
                    </div>

                    <button type="submit" id="contactBtn" class="w-full bg-charcoal text-white py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                        Send Enquiry
                    </button>
                </form>
                <script>
                (function(){
                    var form = document.querySelector('form[action="/contact/submit"]');
                    if(!form) return;
                    form.addEventListener('submit', function(){
                        var btn = document.getElementById('contactBtn');
                        if(btn){
                            btn.disabled = true;
                            btn.textContent = 'Sending...';
                            btn.classList.add('opacity-60','cursor-not-allowed');
                        }
                    });
                })();
                </script>
            </div>
        </div>
    </div>
</section>
