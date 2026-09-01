<!-- Hero Section -->
<?php if (($hero_visible ?? '1') == '1'): ?>
<section class="relative bg-ivory overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <?php if (($hero_image_position ?? 'right') === 'right'): ?>
            <div class="fade-up">
                <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-4"><?= esc($hero_eyebrow) ?></p>
                <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal leading-tight mb-6">
                    <?= esc($hero_heading) ?>
                </h1>
                <p class="text-lg text-charcoal/60 leading-relaxed mb-8 max-w-lg">
                    <?= esc($hero_description) ?>
                </p>
                <div class="flex flex-wrap gap-4 mb-6">
                    <a href="<?= esc($hero_cta_url) ?>" class="bg-charcoal text-white px-8 py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                        <?= esc($hero_cta_label) ?>
                    </a>
                    <?php if (!empty($hero_secondary_cta_url)): ?>
                        <a href="<?= esc($hero_secondary_cta_url) ?>" class="border border-charcoal/20 text-charcoal px-8 py-3.5 rounded-sm text-sm font-medium hover:border-charcoal transition flex items-center gap-2">
                            <i class="ri-whatsapp-line text-green-500"></i>
                            <?= esc($hero_secondary_cta_label) ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (!empty($hero_location)): ?>
                    <p class="text-sm text-charcoal/40 flex items-center gap-1.5">
                        <i class="ri-map-pin-line"></i>
                        <?= esc($hero_location) ?>
                    </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="fade-up relative">
                <?php if (!empty($hero_image)): ?>
                    <img src="/<?= esc($hero_image) ?>" alt="V P Singh Advocate" class="w-full rounded-sm object-cover">
                <?php else: ?>
                    <div class="w-full aspect-[4/5] bg-charcoal/5 rounded-sm flex items-center justify-center">
                        <div class="text-center">
                            <i class="ri-user-line text-6xl text-charcoal/10"></i>
                            <p class="text-sm text-charcoal/30 mt-2">Advocate Photo</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (($hero_image_position ?? 'right') !== 'right'): ?>
            <div class="fade-up">
                <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-4"><?= esc($hero_eyebrow) ?></p>
                <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal leading-tight mb-6">
                    <?= esc($hero_heading) ?>
                </h1>
                <p class="text-lg text-charcoal/60 leading-relaxed mb-8 max-w-lg">
                    <?= esc($hero_description) ?>
                </p>
                <div class="flex flex-wrap gap-4 mb-6">
                    <a href="<?= esc($hero_cta_url) ?>" class="bg-charcoal text-white px-8 py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                        <?= esc($hero_cta_label) ?>
                    </a>
                    <?php if (!empty($hero_secondary_cta_url)): ?>
                        <a href="<?= esc($hero_secondary_cta_url) ?>" class="border border-charcoal/20 text-charcoal px-8 py-3.5 rounded-sm text-sm font-medium hover:border-charcoal transition flex items-center gap-2">
                            <i class="ri-whatsapp-line text-green-500"></i>
                            <?= esc($hero_secondary_cta_label) ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (!empty($hero_location)): ?>
                    <p class="text-sm text-charcoal/40 flex items-center gap-1.5">
                        <i class="ri-map-pin-line"></i>
                        <?= esc($hero_location) ?>
                    </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Trust Strip -->
<?php if (!empty($trust_items)): ?>
<section class="bg-charcoal text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php foreach ($trust_items as $item): ?>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-bronze/20 flex items-center justify-center flex-shrink-0">
                        <i class="ri-<?= esc($item['icon'] ?? 'check') ?>-line text-bronze"></i>
                    </div>
                    <span class="text-sm font-medium text-white/90"><?= esc($item['text'] ?? '') ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Introduction Section -->
<?php if (($intro_visible ?? '1') == '1'): ?>
<section class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl fade-up">
            <?php if (!empty($intro_heading)): ?>
                <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-charcoal leading-tight mb-8">
                    <?= esc($intro_heading) ?>
                </h2>
            <?php endif; ?>
            <?php if (!empty($intro_content)): ?>
                <div class="prose prose-lg text-charcoal/70 leading-relaxed">
                    <?= $intro_content ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($intro_cta_url)): ?>
                <a href="<?= esc($intro_cta_url) ?>" class="inline-flex items-center gap-2 mt-8 text-sm font-medium text-bronze hover:text-charcoal transition">
                    <?= esc($intro_cta_label ?? 'Learn More') ?>
                    <i class="ri-arrow-right-line"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Practice Areas Grid -->
<?php if (!empty($practice_areas)): ?>
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Services</p>
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-charcoal">Practice Areas</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($practice_areas as $area): ?>
                <a href="/<?= esc($area->slug) ?>" class="group p-8 border border-charcoal/10 rounded-sm hover:border-bronze/30 transition fade-up">
                    <div class="w-12 h-12 rounded-full bg-ivory flex items-center justify-center mb-5 group-hover:bg-bronze/10 transition">
                        <i class="ri-<?= esc($area->icon ?? 'scales') ?>-line text-xl text-bronze"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-charcoal mb-3 group-hover:text-bronze transition"><?= esc($area->title) ?></h3>
                    <p class="text-sm text-charcoal/60 leading-relaxed"><?= esc($area->short_description) ?></p>
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-bronze mt-5 group-hover:gap-3 transition-all">
                        Learn More <i class="ri-arrow-right-line"></i>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Featured Practice Area -->
<?php if (!empty($featured_practice_area)): ?>
<section class="py-20 bg-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="fade-up">
                <?php if (!empty($featured_practice_area->image)): ?>
                    <img src="/<?= esc($featured_practice_area->image) ?>" alt="<?= esc($featured_practice_area->title) ?>" class="w-full rounded-sm">
                <?php else: ?>
                    <div class="w-full aspect-[4/3] bg-charcoal/5 rounded-sm flex items-center justify-center">
                        <i class="ri-scales-3-line text-6xl text-charcoal/10"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="fade-up">
                <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">01 / Practice Area</p>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-charcoal mb-5">
                    <?= esc($featured_practice_area->title) ?>
                </h2>
                <p class="text-charcoal/60 leading-relaxed mb-8">
                    <?= esc($featured_practice_area->short_description) ?>
                </p>
                <a href="/<?= esc($featured_practice_area->slug) ?>" class="inline-flex items-center gap-2 bg-charcoal text-white px-8 py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                    <?= esc($featured_practice_area->cta_label ?? 'Explore This Practice') ?>
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Why Choose V P Singh -->
<?php if (!empty($why_items)): ?>
<section class="py-20 bg-charcoal text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Why Choose</p>
            <h2 class="font-heading text-3xl md:text-4xl font-bold">Why Choose V P Singh</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($why_items as $item): ?>
                <div class="fade-up text-center">
                    <div class="w-14 h-14 rounded-full bg-bronze/20 flex items-center justify-center mx-auto mb-5">
                        <i class="ri-<?= esc($item['icon'] ?? 'check') ?>-line text-2xl text-bronze"></i>
                    </div>
                    <h3 class="font-heading text-lg font-bold mb-3"><?= esc($item['title'] ?? '') ?></h3>
                    <p class="text-sm text-white/60 leading-relaxed"><?= esc($item['description'] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- How It Works -->
<?php if (!empty($how_it_works)): ?>
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Process</p>
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-charcoal">How It Works</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($how_it_works as $step): ?>
                <div class="fade-up relative">
                    <div class="text-4xl font-heading font-bold text-bronze/20 mb-4"><?= esc($step['number'] ?? '01') ?></div>
                    <h3 class="font-heading text-lg font-bold text-charcoal mb-3"><?= esc($step['title'] ?? '') ?></h3>
                    <p class="text-sm text-charcoal/60 leading-relaxed"><?= esc($step['description'] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Testimonials -->
<?php if (!empty($testimonials)): ?>
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Testimonials</p>
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-charcoal">What Clients Say</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach (array_slice($testimonials, 0, 3) as $testimonial): ?>
                <div class="p-8 border border-charcoal/10 rounded-sm fade-up">
                    <div class="flex gap-1 mb-4">
                        <?php for ($i = 0; $i < ($testimonial->rating ?? 5); $i++): ?>
                            <i class="ri-star-fill text-bronze text-sm"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="text-sm text-charcoal/70 leading-relaxed mb-6">"<?= esc($testimonial->review) ?>"</p>
                    <div class="border-t border-charcoal/10 pt-4">
                        <p class="font-medium text-sm text-charcoal"><?= esc($testimonial->client_name) ?></p>
                        <?php if (!empty($testimonial->location)): ?>
                            <p class="text-xs text-charcoal/40 mt-0.5"><?= esc($testimonial->location) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-20 bg-charcoal text-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center fade-up">
        <h2 class="font-heading text-3xl md:text-4xl font-bold mb-5">Schedule a Legal Consultation</h2>
        <p class="text-white/60 mb-8 text-lg">Professional legal guidance for your specific matter.</p>
        <a href="/book-consultation" class="inline-flex items-center gap-2 bg-bronze text-white px-8 py-3.5 rounded-sm text-sm font-medium hover:bg-bronze/90 transition">
            Book Consultation
            <i class="ri-arrow-right-line"></i>
        </a>
    </div>
</section>
