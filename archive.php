<?php
/**
 * The template for displaying archive pages.
 *
 * @package Neobrutheme
 */

get_header();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <?php if ( have_posts() ) : ?>

    <header class="mb-10">
      <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter">
        <?php the_archive_title(); ?>
      </h1>
      <?php if ( the_archive_description() ) : ?>
        <p class="mt-4 text-lg"><?php the_archive_description(); ?></p>
      <?php endif; ?>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'post' ); ?>
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
