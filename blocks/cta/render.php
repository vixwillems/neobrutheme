<?php
$heading     = $attributes['heading'] ?? '';
$button_text = $attributes['buttonText'] ?? '';
$button_url  = $attributes['buttonUrl'] ?? '';
$color       = $attributes['color'] ?? 'red';

$color_class = 'bg-[var(--color-' . $color . ')]';
?>
<section class="<?php echo esc_attr( $color_class ); ?> border-b-8 border-[var(--color-fg)] px-6 md:px-12 py-16 md:py-24">
  <div class="max-w-4xl mx-auto text-center">
    <h2 class="display-stroke text-4xl md:text-6xl uppercase tracking-tight leading-none mb-6"><?php echo esc_html( $heading ); ?></h2>
    <?php if ( $button_text && $button_url ) : ?>
      <a href="<?php echo esc_url( $button_url ); ?>" class="btn bg-[var(--color-bg)] brutalist-shadow text-lg px-8 py-4">
        <?php echo esc_html( $button_text ); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
