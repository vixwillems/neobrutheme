<?php
$style = neo_sub( 'style', 'thick' );
$color = neo_sub( 'color', 'red' );

if ( $style === 'spacer' ) :
?>
<div class="py-8"></div>
<?php elseif ( $style === 'color' ) :
  $color_class = 'bg-[var(--color-' . $color . ')]';
?>
<div class="px-6 md:px-12 py-4">
  <div class="max-w-6xl mx-auto">
    <div class="h-4 <?php echo esc_attr( $color_class ); ?> border-4 border-[var(--color-fg)]"></div>
  </div>
</div>
<?php else : ?>
<div class="px-6 md:px-12 py-8">
  <div class="max-w-6xl mx-auto">
    <hr class="border-t-8 border-[var(--color-fg)]">
  </div>
</div>
<?php endif; ?>
