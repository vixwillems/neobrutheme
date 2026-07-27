<?php
$heading    = $attributes['heading'] ?? '';
$subheading = $attributes['subheading'] ?? '';
$bg_color   = $attributes['bgColor'] ?? 'cyan';
$show_comp  = $attributes['showComposition'] ?? true;

$color_class = 'bg-[var(--color-' . $bg_color . ')]';
?>
<section class="hero-composition <?php echo esc_attr( $color_class ); ?> border-b-8 border-[var(--color-fg)]">
  <?php if ( $show_comp ) : ?>
    <div class="shape bg-[var(--color-red)] w-[140px] h-[140px] rounded-full border-4 border-[var(--color-fg)] top-[6%] right-[10%] absolute"></div>
    <div class="shape bg-[var(--color-cyan)] w-[120px] h-[120px] border-4 border-[var(--color-fg)] top-[20%] right-[45%] absolute hidden md:block"></div>
  <?php endif; ?>

  <div class="max-w-6xl mx-auto px-6 md:px-12 py-16 md:py-24 relative z-10">
    <h1 class="display-stroke text-5xl md:text-7xl lg:text-8xl uppercase tracking-tight leading-none mb-6"><?php echo esc_html( $heading ); ?></h1>
    <?php if ( $subheading ) : ?>
      <p class="text-lg font-bold max-w-xl"><?php echo esc_html( $subheading ); ?></p>
    <?php endif; ?>
  </div>
</section>
