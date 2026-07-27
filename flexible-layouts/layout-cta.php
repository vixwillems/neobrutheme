<?php
/**
 * Flexible Content layout: Call to Action.
 *
 * Full-width colored banner with heading and button.
 *
 * @package Neobrutheme
 */

$heading     = get_sub_field( 'heading' ) ?: 'Get in Touch';
$button_text = get_sub_field( 'button_text' ) ?: 'Contact Us';
$button_url  = get_sub_field( 'button_url' ) ?: home_url( '/' );
$color       = get_sub_field( 'color' ) ?: 'red';

$bg_class = neobrutheme_color_class( $color );
?>

<section class="<?php echo esc_attr( $bg_class ); ?> border-y-8 border-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-8 display-stroke">
      <?php echo esc_html( $heading ); ?>
    </h2>
    <a href="<?php echo esc_url( $button_url ); ?>" class="btn bg-[var(--color-fg)] text-[var(--color-bg)] text-base px-8 py-4 shadow-[8px_8px_0_0_var(--color-fg)] border-[var(--color-fg)]">
      <?php echo esc_html( $button_text ); ?>
    </a>
  </div>
</section>
