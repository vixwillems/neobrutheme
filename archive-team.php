<?php
/**
 * The template for displaying the team archive.
 *
 * @package Neobrutheme
 */

get_header();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <header class="mb-10">
    <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter">
      <?php esc_html_e( 'Team', 'neobrutheme' ); ?>
    </h1>
  </header>

  <?php if ( have_posts() ) : ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'template-parts/content', 'team' ); ?>
    <?php endwhile; ?>
  </div>

  <div class="mt-12">
    <?php the_posts_pagination(); ?>
  </div>
  <?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
  <?php endif; ?>
</div>

<?php
get_footer();
