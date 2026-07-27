<?php get_header(); ?>

<section class="bg-[var(--color-cyan)] border-b-8 border-[var(--color-fg)] px-6 py-12 md:px-12">
  <div class="max-w-6xl mx-auto">
    <h1 class="display-stroke text-5xl md:text-7xl uppercase tracking-tight leading-none mb-4">Blog</h1>
    <p class="text-lg font-bold max-w-xl">Thoughts, experiments, and everything in between.</p>
  </div>
</section>

<div class="px-6 md:px-12 py-12 max-w-6xl mx-auto">
  <?php if ( have_posts() ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-stagger>
      <?php while ( have_posts() ) : the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="post-card block no-underline group">
          <div class="card-accent"></div>
          <div class="p-6 md:p-8">
            <div class="flex items-center gap-3 mb-3">
              <time class="text-xs font-black uppercase tracking-wider border-2 border-[var(--color-fg)] px-2 py-0.5" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
            </div>

            <h2 class="text-xl md:text-2xl font-black uppercase tracking-tight mb-3 group-hover:text-[var(--color-red)] transition-colors duration-100"><?php the_title(); ?></h2>

            <?php if ( has_excerpt() ) : ?>
              <p class="text-sm font-bold opacity-70 leading-relaxed mb-4"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php else : ?>
              <p class="text-sm font-bold opacity-70 leading-relaxed mb-4"><?php echo esc_html( wp_trim_words( get_the_content(), 18 ) ); ?></p>
            <?php endif; ?>

            <span class="text-xs font-black uppercase tracking-wider text-[var(--color-red)]">Read More &rarr;</span>
          </div>
        </a>
      <?php endwhile; ?>
    </div>

    <div class="mt-12 pagination">
      <?php the_posts_pagination(); ?>
    </div>
  <?php else : ?>
    <div class="border-4 border-[var(--color-fg)] bg-[var(--color-yellow)] p-8 brutalist-shadow text-center">
      <p class="text-xl font-black uppercase">No posts found — check back soon.</p>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
