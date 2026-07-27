<?php
/**
 * Flexible Content layout: Marquee.
 *
 * Scrolling text ticker divider.
 *
 * @package Neobrutheme
 */

$text  = neo_sub( 'text' ) ?: 'Neo-Brutalist Design';
$speed = neo_sub( 'speed' ) ?: 'medium';
$color = neo_sub( 'color' ) ?: 'yellow';

$bg_class   = neobrutheme_color_class( $color );
$speed_class = 'animate-marquee';
if ( $speed === 'slow' ) {
  $speed_class = 'animate-marquee-slow';
} elseif ( $speed === 'fast' ) {
  $speed_class = 'animate-marquee-fast';
}
?>

<section class="border-y-8 border-black <?php echo esc_attr( $bg_class ); ?> overflow-hidden py-4">
  <div class="<?php echo esc_attr( $speed_class ); ?> whitespace-nowrap flex">
    <?php for ( $i = 0; $i < 12; $i++ ) : ?>
      <span class="text-2xl md:text-4xl font-black uppercase tracking-tighter px-6">
        <?php echo esc_html( $text ); ?>
      </span>
      <span class="text-2xl md:text-4xl font-black uppercase tracking-tighter px-6 text-[var(--color-fg)]">&#9733;</span>
    <?php endfor; ?>
  </div>
</section>
