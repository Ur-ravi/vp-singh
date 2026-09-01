<!-- Practice Area Detail -->
<section class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 fade-up">
                <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Practice Area</p>
                <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-charcoal mb-6">
                    <?= esc($practice_area->title) ?>
                </h1>

                <?php if (!empty($practice_area->description)): ?>
                    <div class="prose prose-lg text-charcoal/70 leading-relaxed mb-10">
                        <?= $practice_area->description ?>
                    </div>
                <?php endif; ?>

                <a href="/book-consultation" class="inline-flex items-center gap-2 bg-charcoal text-white px-8 py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                    Book Consultation <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <!-- Sidebar -->
            <div class="fade-up">
                <div class="bg-white border border-charcoal/10 rounded-sm p-6 sticky top-24">
                    <h3 class="font-heading text-lg font-bold text-charcoal mb-4">Other Practice Areas</h3>
                    <ul class="space-y-2">
                        <?php foreach ($all_areas as $area): ?>
                            <li>
                                <a href="/<?= esc($area->slug) ?>" class="block py-2 px-3 text-sm rounded <?= $area->slug === $practice_area->slug ? 'bg-bronze/10 text-bronze font-medium' : 'text-charcoal/60 hover:bg-gray-50' ?> transition">
                                    <?= esc($area->title) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="mt-6 pt-6 border-t border-charcoal/10">
                        <p class="text-sm text-charcoal/60 mb-3">Need legal assistance?</p>
                        <a href="/book-consultation" class="block w-full bg-bronze text-white text-center py-3 rounded-sm text-sm font-medium hover:bg-bronze/90 transition">
                            Book Consultation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQs -->
<?php if (!empty($faqs)): ?>
<section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-heading text-2xl font-bold text-charcoal mb-6 fade-up">Frequently Asked Questions</h2>
        <div class="space-y-4" x-data="{ openFaq: null }">
            <?php foreach ($faqs as $faq): ?>
                <div class="border border-charcoal/10 rounded-sm fade-up">
                    <button @click="openFaq = openFaq === <?= $faq->id ?> ? null : <?= $faq->id ?>" class="w-full flex items-center justify-between p-5 text-left">
                        <span class="font-medium text-charcoal pr-4"><?= esc($faq->question) ?></span>
                        <i :class="openFaq === <?= $faq->id ?> ? 'ri-subtract-line' : 'ri-add-line'" class="text-bronze flex-shrink-0"></i>
                    </button>
                    <div x-show="openFaq === <?= $faq->id ?>" x-collapse class="px-5 pb-5">
                        <div class="text-sm text-charcoal/70 leading-relaxed"><?= $faq->answer ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
