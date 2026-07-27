<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <section class="bg-[var(--color-red)] border-b-8 border-[var(--color-fg)] px-6 py-12 md:px-12">
    <div class="max-w-4xl mx-auto">
      <div class="flex items-center gap-3 mb-4">
        <time class="text-xs font-black uppercase tracking-wider border-2 border-[var(--color-fg)] px-2 py-0.5 bg-[var(--color-bg)]" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
        <?php
          $cats = get_the_category();
          if ( ! empty( $cats ) ) :
            $cat = $cats[0];
        ?>
          <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="text-xs font-black uppercase tracking-wider border-2 border-[var(--color-fg)] px-2 py-0.5 bg-[var(--color-yellow)] hover:bg-[var(--color-bg)] transition-colors duration-100"><?php echo esc_html( $cat->name ); ?></a>
        <?php endif; ?>
      </div>
      <h1 class="display-stroke text-4xl md:text-6xl lg:text-7xl uppercase tracking-tight leading-none mb-4"><?php the_title(); ?></h1>
      <p class="text-sm font-bold opacity-70">Written by <?php the_author(); ?></p>
    </div>
  </section>

  <?php if ( has_blocks( get_the_content() ) || ! empty( trim( get_the_content() ) ) ) : ?>
    <div class="px-6 md:px-12 py-12 md:py-16">
      <div class="max-w-4xl mx-auto rich-text">
        <?php the_content(); ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="px-6 md:px-12 py-12 border-t-8 border-[var(--color-fg)]">
    <div class="max-w-4xl mx-auto">
      <?php
        $prev = get_previous_post();
        $next = get_next_post();
      ?>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php if ( $prev ) : ?>
          <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="card p-6 group text-left">
            <p class="text-xs font-black uppercase tracking-wider text-[var(--color-fg)] opacity-50 mb-2">&larr; Previous</p>
            <p class="text-lg font-black uppercase group-hover:text-[var(--color-red)] transition-colors duration-100"><?php echo esc_html( get_the_title( $prev ) ); ?></p>
          </a>
        <?php else : ?>
          <div></div>
        <?php endif; ?>
        <?php if ( $next ) : ?>
          <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="card p-6 group text-right">
            <p class="text-xs font-black uppercase tracking-wider text-[var(--color-fg)] opacity-50 mb-2">Next &rarr;</p>
            <p class="text-lg font-black uppercase group-hover:text-[var(--color-red)] transition-colors duration-100"><?php echo esc_html( get_the_title( $next ) ); ?></p>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php endwhile; ?>

<?php get_footer(); ?>
