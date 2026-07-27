<?php
$heading  = neo_sub( 'heading' );
$features = neo_sub( 'features' );
$columns  = neo_sub( 'columns', '3' );

if ( ! $features ) return;

$col_class = 'md:grid-cols-' . $columns;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="grid grid-cols-1 <?php echo esc_attr( $col_class ); ?> gap-6">
      <?php foreach ( $features as $feature ) :
        $color = $feature['color'] ?? 'cyan';
      ?>
        <div class="card p-6">
          <div class="w-12 h-12 bg-[var(--color-<?php echo esc_attr( $color ); ?>)] border-4 border-[var(--color-fg)] mb-4 flex items-center justify-center">
            <span class="text-xl font-black"><?php echo esc_html( mb_substr( $feature['title'], 0, 1 ) ); ?></span>
          </div>
          <h3 class="text-lg font-black uppercase tracking-tight mb-2"><?php echo esc_html( $feature['title'] ); ?></h3>
          <p class="text-sm font-bold opacity-70"><?php echo esc_html( $feature['description'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
