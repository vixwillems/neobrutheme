<?php
/**
 * The template for displaying single posts.
 *
 * @package Neobrutheme
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="mb-8 border-8 border-black shadow-[12px_12px_0_0_var(--color-fg)] overflow-hidden">
    <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto grayscale hover:grayscale-0 transition-all duration-200' ) ); ?>
  </div>
  <?php endif; ?>

  <header class="mb-8 border-b-8 border-black pb-6">
    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-4 leading-none">
      <?php the_title(); ?>
    </h1>
    <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider text-black/50">
      <?php neobrutheme_posted_on(); ?>
      <span class="w-px h-4 bg-black/20"></span>
      <?php neobrutheme_posted_by(); ?>
    </div>
  </header>

  <div class="rich-text text-lg mb-10">
    <?php the_content(); ?>
  </div>

  <footer class="border-t-4 border-black pt-6">
    <?php neobrutheme_entry_footer(); ?>
  </footer>

</article>

<?php endwhile; ?>

<?php
get_footer();
