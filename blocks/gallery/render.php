<?php
$heading = $attributes['heading'] ?? '';
$images  = $attributes['images'] ?? [];
$columns = $attributes['columns'] ?? '3';

if ( empty( $images ) ) return;

$col_class = 'grid-cols-' . $columns;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="grid <?php echo esc_attr( $col_class ); ?> gap-4">
      <?php foreach ( $images as $image ) : ?>
        <div class="border-4 border-[var(--color-fg)] overflow-hidden">
          <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="w-full h-48 object-cover block" loading="lazy">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
