<section class="py-20 md:py-28">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="fade-up">
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-charcoal mb-8"><?= esc($page->title) ?></h1>
            <?php if (!empty($page->content)): ?>
                <div class="prose prose-lg text-charcoal/70 leading-relaxed">
                    <?= $page->content ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($faqs)): ?>
            <div class="mt-16 fade-up">
                <h2 class="font-heading text-2xl font-bold text-charcoal mb-6">Frequently Asked Questions</h2>
                <div class="space-y-4" x-data="{ openFaq: null }">
                    <?php foreach ($faqs as $faq): ?>
                        <div class="border border-charcoal/10 rounded-sm">
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
        <?php endif; ?>
    </div>
</section>
