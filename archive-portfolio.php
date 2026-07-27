<?php get_header(); ?>

<section class="bg-[var(--color-yellow)] border-b-8 border-[var(--color-fg)] px-6 py-12 md:px-12">
  <div class="max-w-6xl mx-auto">
    <h1 class="display-stroke text-5xl md:text-7xl uppercase tracking-tight leading-none mb-4">Portfolio</h1>
    <p class="text-lg font-bold max-w-xl">A selection of projects, experiments, and things I've built.</p>
  </div>
</section>

<div class="px-6 md:px-12 py-12 max-w-6xl mx-auto">
  <?php if ( have_posts() ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-stagger>
      <?php while ( have_posts() ) : the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="portfolio-card block no-underline group">
          <div class="card-accent"></div>
          <div class="p-6 md:p-8">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="mb-6 border-4 border-[var(--color-fg)] overflow-hidden">
                <?php the_post_thumbnail( 'large', [ 'class' => 'w-full h-56 object-cover block', 'loading' => 'lazy' ] ); ?>
              </div>
            <?php else : ?>
              <div class="mb-6 border-4 border-[var(--color-fg)] bg-[var(--color-cyan)] h-56 flex items-center justify-center">
                <span class="display-stroke text-6xl"><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
              </div>
            <?php endif; ?>

            <h2 class="text-xl md:text-2xl font-black uppercase tracking-tight mb-3 group-hover:text-[var(--color-red)] transition-colors duration-100"><?php the_title(); ?></h2>

            <?php
              $excerpt = get_the_excerpt();
              if ( $excerpt ) :
            ?>
              <p class="text-sm font-bold opacity-70 leading-relaxed mb-4"><?php echo esc_html( $excerpt ); ?></p>
            <?php endif; ?>

            <?php
              $tech = get_field( 'portfolio_technologies' );
              if ( $tech && is_array( $tech ) ) :
            ?>
              <div class="flex flex-wrap gap-2">
                <?php foreach ( $tech as $t ) : ?>
                  <span class="text-xs font-black uppercase tracking-wider border-2 border-[var(--color-fg)] px-2 py-0.5 bg-[var(--color-bg)]"><?php echo esc_html( $t ); ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </a>
      <?php endwhile; ?>
    </div>

    <div class="mt-12 pagination">
      <?php the_posts_pagination(); ?>
    </div>
  <?php else : ?>
    <div class="border-4 border-[var(--color-fg)] bg-[var(--color-yellow)] p-8 brutalist-shadow text-center">
      <p class="text-xl font-black uppercase">No portfolio items yet — check back soon.</p>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
