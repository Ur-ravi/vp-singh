<!-- About V P Singh -->
<section class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <div class="fade-up">
                <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">About</p>
                <h1 class="font-heading text-4xl md:text-5xl font-bold text-charcoal leading-tight mb-6">
                    V P Singh Advocate
                </h1>
                <?php if (!empty($advocate)): ?>
                    <?php if (!empty($advocate->biography)): ?>
                        <div class="prose prose-lg text-charcoal/70 leading-relaxed mb-8">
                            <?= $advocate->biography ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($advocate->education)): ?>
                        <div class="mb-6">
                            <h3 class="font-heading text-xl font-bold text-charcoal mb-3">Education</h3>
                            <p class="text-charcoal/70 leading-relaxed"><?= nl2br(esc($advocate->education)) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($advocate->experience)): ?>
                        <div class="mb-6">
                            <h3 class="font-heading text-xl font-bold text-charcoal mb-3">Experience</h3>
                            <p class="text-charcoal/70 leading-relaxed"><?= nl2br(esc($advocate->experience)) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($advocate->court_info)): ?>
                        <div class="mb-6">
                            <h3 class="font-heading text-xl font-bold text-charcoal mb-3">Court Information</h3>
                            <p class="text-charcoal/70 leading-relaxed"><?= nl2br(esc($advocate->court_info)) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($advocate->memberships)): ?>
                        <div class="mb-6">
                            <h3 class="font-heading text-xl font-bold text-charcoal mb-3">Memberships</h3>
                            <p class="text-charcoal/70 leading-relaxed"><?= nl2br(esc($advocate->memberships)) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($advocate->credentials)): ?>
                        <div class="mb-6">
                            <h3 class="font-heading text-xl font-bold text-charcoal mb-3">Credentials</h3>
                            <p class="text-charcoal/70 leading-relaxed"><?= nl2br(esc($advocate->credentials)) ?></p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="fade-up">
                <?php if (!empty($advocate) && !empty($advocate->profile_image)): ?>
                    <img src="/<?= esc($advocate->profile_image) ?>" alt="V P Singh Advocate" class="w-full rounded-sm sticky top-24">
                <?php else: ?>
                    <div class="w-full aspect-[3/4] bg-charcoal/5 rounded-sm flex items-center justify-center sticky top-24">
                        <div class="text-center">
                            <i class="ri-user-line text-8xl text-charcoal/10"></i>
                            <p class="text-sm text-charcoal/30 mt-2">Advocate Photo</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Practice Areas -->
<?php if (!empty($practice_areas)): ?>
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 fade-up">
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-charcoal">Areas of Practice</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($practice_areas as $area): ?>
                <a href="/<?= esc($area->slug) ?>" class="group p-8 border border-charcoal/10 rounded-sm hover:border-bronze/30 transition fade-up">
                    <h3 class="font-heading text-xl font-bold text-charcoal mb-3 group-hover:text-bronze transition"><?= esc($area->title) ?></h3>
                    <p class="text-sm text-charcoal/60 leading-relaxed"><?= esc($area->short_description) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="py-20 bg-charcoal text-white text-center">
    <div class="max-w-3xl mx-auto px-4 fade-up">
        <h2 class="font-heading text-3xl md:text-4xl font-bold mb-5">Need Legal Assistance?</h2>
        <p class="text-white/60 mb-8">Schedule a consultation to discuss your legal matter.</p>
        <a href="/book-consultation" class="inline-flex items-center gap-2 bg-bronze text-white px-8 py-3.5 rounded-sm text-sm font-medium hover:bg-bronze/90 transition">
            Book Consultation <i class="ri-arrow-right-line"></i>
        </a>
    </div>
</section>
