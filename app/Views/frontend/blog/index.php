<section class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 fade-up">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Insights</p>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-charcoal">Blog</h1>
            <p class="mt-4 text-charcoal/60 max-w-2xl mx-auto">Legal insights and articles by V P Singh Advocate.</p>
        </div>

        <?php if (!empty($posts)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($posts as $post): ?>
                    <a href="/blog/<?= esc($post->slug) ?>" class="group bg-white border border-charcoal/10 rounded-sm overflow-hidden hover:shadow-lg transition fade-up">
                        <?php if (!empty($post->featured_image)): ?>
                            <div class="aspect-[16/10] overflow-hidden">
                                <img src="/<?= esc($post->featured_image) ?>" alt="<?= esc($post->title) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        <?php else: ?>
                            <div class="aspect-[16/10] bg-charcoal/5 flex items-center justify-center">
                                <i class="ri-article-line text-4xl text-charcoal/10"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <?php if (!empty($post->category_name)): ?>
                                <span class="text-xs tracking-wider uppercase text-bronze font-semibold"><?= esc($post->category_name) ?></span>
                            <?php endif; ?>
                            <h2 class="font-heading text-xl font-bold text-charcoal mt-2 mb-3 group-hover:text-bronze transition line-clamp-2">
                                <?= esc($post->title) ?>
                            </h2>
                            <?php if (!empty($post->excerpt)): ?>
                                <p class="text-sm text-charcoal/60 leading-relaxed line-clamp-3"><?= esc($post->excerpt) ?></p>
                            <?php endif; ?>
                            <div class="mt-4 text-xs text-charcoal/40 flex items-center gap-3">
                                <?php if (!empty($post->author_name)): ?>
                                    <span><?= esc($post->author_name) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($post->published_at)): ?>
                                    <span><?= date('M d, Y', strtotime($post->published_at)) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if (($total_pages ?? 1) > 1): ?>
                <div class="flex items-center justify-center gap-2 mt-12">
                    <?php if (($current_page ?? 1) > 1): ?>
                        <a href="/blog?page=<?= ($current_page - 1) ?>" class="px-4 py-2 border border-charcoal/20 rounded-sm text-sm font-medium text-charcoal hover:bg-charcoal hover:text-white transition">
                            <i class="ri-arrow-left-line"></i> Prev
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= ($total_pages ?? 1); $i++): ?>
                        <a href="/blog?page=<?= $i ?>" class="w-10 h-10 flex items-center justify-center rounded-sm text-sm font-medium transition <?= $i == ($current_page ?? 1) ? 'bg-charcoal text-white' : 'border border-charcoal/20 text-charcoal hover:bg-charcoal hover:text-white' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if (($current_page ?? 1) < ($total_pages ?? 1)): ?>
                        <a href="/blog?page=<?= ($current_page + 1) ?>" class="px-4 py-2 border border-charcoal/20 rounded-sm text-sm font-medium text-charcoal hover:bg-charcoal hover:text-white transition">
                            Next <i class="ri-arrow-right-line"></i>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="text-center py-12">
                <i class="ri-article-line text-5xl text-charcoal/10"></i>
                <p class="mt-4 text-charcoal/40">No blog posts yet. Check back soon.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
