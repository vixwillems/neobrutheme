<?php
/**
 * The template for displaying 404 pages.
 *
 * @package Neobrutheme
 */

get_header();
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
  <h1 class="text-[8rem] md:text-[12rem] font-black uppercase tracking-tighter leading-none display-stroke mb-8">
    404
  </h1>
  <p class="text-2xl font-bold mb-8">
    <?php esc_html_e( 'This page doesn\'t exist. Or maybe it never did.', 'neobrutheme' ); ?>
  </p>

  <div class="mb-10">
    <?php get_search_form(); ?>
  </div>

  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn bg-[var(--color-red)] text-white shadow-[4px_4px_0_0_var(--color-fg)]">
    <?php esc_html_e( 'Back to Home', 'neobrutheme' ); ?>
  </a>
</div>

<?php
get_footer();
