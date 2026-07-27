<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <?php
  // If the page has ACF Flexible Content layouts, use them (existing behavior).
  if ( function_exists( 'have_rows' ) && have_rows( 'page_layouts' ) ) :
    while ( have_rows( 'page_layouts' ) ) :
      the_row();
      $layout = get_row_layout();
      $file   = NEOBRUTEME_DIR . '/flexible-layouts/layout-' . $layout . '.php';
      if ( file_exists( $file ) ) {
        include $file;
      }
    endwhile;
  elseif ( has_blocks( get_the_content() ) ) :
    // Use Block Editor content (visual editing).
    the_content();
  else :
    // Fallback to standard content.
    $page_id  = get_the_ID();
    $hero_img = get_field( 'hero_background_image' );
  ?>

  <section
    <?php if ( $hero_img ) : ?>
      style="background-image:url('<?php echo esc_url( $hero_img['url'] ); ?>');background-size:cover;background-position:center 30%;"
    <?php endif; ?>
    class="border-b-8 border-[var(--color-fg)] px-6 py-12 md:px-12 <?php echo $hero_img ? 'bg-black text-white' : 'bg-[var(--color-yellow)]'; ?>"
  >
    <div class="max-w-6xl mx-auto">
      <p class="text-sm font-black uppercase tracking-widest mb-4 opacity-60"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?></p>
      <h1 class="display-stroke text-5xl md:text-7xl uppercase tracking-tight leading-none mb-4"><?php the_title(); ?></h1>
      <?php
        $subtitle = get_field( 'hero_subtitle' );
        if ( $subtitle ) :
      ?>
        <p class="text-lg font-bold max-w-xl <?php echo $hero_img ? 'text-white' : ''; ?>"><?php echo esc_html( $subtitle ); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <?php if ( ! empty( trim( get_the_content() ) ) ) : ?>
    <div class="px-6 md:px-12 py-12 md:py-16">
      <div class="max-w-4xl mx-auto rich-text">
        <?php the_content(); ?>
      </div>
    </div>
  <?php endif; ?>

  <?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
