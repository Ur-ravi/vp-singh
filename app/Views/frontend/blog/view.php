<article class="py-20 md:py-28">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 fade-up">
            <ol class="flex items-center gap-2 text-sm text-charcoal/40">
                <li><a href="/" class="hover:text-bronze transition">Home</a></li>
                <li><i class="ri-arrow-right-s-line"></i></li>
                <li><a href="/blog" class="hover:text-bronze transition">Blog</a></li>
                <li><i class="ri-arrow-right-s-line"></i></li>
                <li class="text-charcoal/70"><?= esc($post->title ?? '') ?></li>
            </ol>
        </nav>

        <!-- Post Header -->
        <div class="fade-up">
            <?php if (!empty($post->category_name)): ?>
                <span class="text-xs tracking-wider uppercase text-bronze font-semibold"><?= esc($post->category_name) ?></span>
            <?php endif; ?>

            <h1 class="font-heading text-3xl md:text-4xl font-bold text-charcoal mt-2 mb-4">
                <?= esc($post->title ?? '') ?>
            </h1>

            <div class="flex items-center gap-4 text-sm text-charcoal/40 mb-8">
                <?php if (!empty($post->author_name)): ?>
                    <span>By <?= esc($post->author_name) ?></span>
                <?php endif; ?>
                <?php if (!empty($post->published_at)): ?>
                    <span><?= date('F d, Y', strtotime($post->published_at)) ?></span>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($post->featured_image)): ?>
            <div class="mb-10 fade-up">
                <img src="/<?= esc($post->featured_image) ?>" alt="<?= esc($post->title) ?>" class="w-full rounded-sm">
            </div>
        <?php endif; ?>

        <!-- Post Content -->
        <div class="prose prose-lg max-w-none text-charcoal/70 leading-relaxed fade-up">
            <?= $post->content ?? '' ?>
        </div>
    </div>
</article>

<!-- Related Posts -->
<?php if (!empty($related_posts)): ?>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-heading text-2xl font-bold text-charcoal mb-8 text-center fade-up">Related Articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($related_posts as $rp): ?>
                <a href="/blog/<?= esc($rp->slug) ?>" class="group border border-charcoal/10 rounded-sm overflow-hidden hover:shadow-lg transition fade-up">
                    <?php if (!empty($rp->featured_image)): ?>
                        <div class="aspect-[16/10] overflow-hidden">
                            <img src="/<?= esc($rp->featured_image) ?>" alt="<?= esc($rp->title) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                    <?php endif; ?>
                    <div class="p-5">
                        <h3 class="font-heading font-bold text-charcoal group-hover:text-bronze transition line-clamp-2"><?= esc($rp->title) ?></h3>
                        <p class="text-xs text-charcoal/40 mt-2"><?= date('M d, Y', strtotime($rp->published_at ?? $rp->created_at)) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
