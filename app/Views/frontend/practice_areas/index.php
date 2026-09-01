<section class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Services</p>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-charcoal">Practice Areas</h1>
            <p class="mt-4 text-charcoal/60 max-w-2xl mx-auto">Professional legal services across multiple areas of law.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($practice_areas as $area): ?>
                <a href="/<?= esc($area->slug) ?>" class="group p-8 bg-white border border-charcoal/10 rounded-sm hover:border-bronze/30 transition fade-up">
                    <div class="w-12 h-12 rounded-full bg-ivory flex items-center justify-center mb-5 group-hover:bg-bronze/10 transition">
                        <i class="ri-<?= esc($area->icon ?? 'scales') ?>-line text-xl text-bronze"></i>
                    </div>
                    <h2 class="font-heading text-xl font-bold text-charcoal mb-3 group-hover:text-bronze transition"><?= esc($area->title) ?></h2>
                    <p class="text-sm text-charcoal/60 leading-relaxed mb-5"><?= esc($area->short_description) ?></p>
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-bronze">
                        Explore <i class="ri-arrow-right-line"></i>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
