<?php
/**
 * The template for displaying pages (ACF Flexible Content).
 *
 * @package Neobrutheme
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

  <?php
  // Check for ACF Flexible Content layouts.
  if ( function_exists( 'have_rows' ) && have_rows( 'page_layouts', 'option' ) ) :
    while ( have_rows( 'page_layouts', 'option' ) ) :
      the_row();
      $layout = get_row_layout();
      $file   = NEOBRUTEME_DIR . '/flexible-layouts/layout-' . $layout . '.php';
      if ( file_exists( $file ) ) {
        include $file;
      }
    endwhile;
  elseif ( function_exists( 'have_rows' ) && have_rows( 'page_layouts' ) ) :
    // Per-page flexible content (if not using options page).
    while ( have_rows( 'page_layouts' ) ) :
      the_row();
      $layout = get_row_layout();
      $file   = NEOBRUTEME_DIR . '/flexible-layouts/layout-' . $layout . '.php';
      if ( file_exists( $file ) ) {
        include $file;
      }
    endwhile;
  else :
    // Fallback to standard content.
    ?>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-8">
        <?php the_title(); ?>
      </h1>
      <div class="rich-text text-lg">
        <?php the_content(); ?>
      </div>
    </div>
    <?php
  endif;
  ?>

<?php endwhile; ?>

<?php
get_footer();
