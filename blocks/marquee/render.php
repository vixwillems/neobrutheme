<?php
$text  = $attributes['text'] ?? '';
$speed = $attributes['speed'] ?? 'medium';
$color = $attributes['color'] ?? 'yellow';

$speed_class = 'animate-marquee';
if ( $speed === 'slow' ) $speed_class = 'animate-marquee-slow';
if ( $speed === 'fast' ) $speed_class = 'animate-marquee-fast';

$color_class = 'bg-[var(--color-' . $color . ')]';
?>
<section class="<?php echo esc_attr( $color_class ); ?> border-b-8 border-[var(--color-fg)] overflow-hidden py-4">
  <div class="<?php echo esc_attr( $speed_class ); ?> whitespace-nowrap flex">
    <?php for ( $i = 0; $i < 3; $i++ ) : ?>
      <span class="text-2xl md:text-4xl font-black uppercase tracking-tight mx-4 shrink-0"><?php echo esc_html( $text ); ?></span>
    <?php endfor; ?>
  </div>
</section>
