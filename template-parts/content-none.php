<?php
/**
 * Template part: No results found.
 *
 * @package Neobrutheme
 */
?>

<div class="text-center py-20">
  <h2 class="text-4xl font-black uppercase tracking-tighter mb-4">
    <?php esc_html_e( 'Nothing Found', 'neobrutheme' ); ?>
  </h2>
  <p class="text-lg font-bold mb-8">
    <?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'neobrutheme' ); ?>
  </p>
  <?php get_search_form(); ?>
</div>
