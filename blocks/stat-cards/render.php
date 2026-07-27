<?php
$stats = $attributes['stats'] ?? [];

if ( empty( $stats ) ) return;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-stagger>
      <?php foreach ( $stats as $stat ) :
        $shape_class = '';
        if ( ( $stat['shape'] ?? '' ) === 'circle' ) $shape_class = 'stat-shape--circle';
        if ( ( $stat['shape'] ?? '' ) === 'diamond' ) $shape_class = 'stat-shape--diamond';
      ?>
        <div class="card p-6 text-center">
          <div class="stat-shape <?php echo esc_attr( $shape_class ); ?> mx-auto mb-4 bg-[var(--color-<?php echo esc_attr( $stat['color'] ?? 'yellow' ); ?>)]">
            <span><?php echo esc_html( $stat['number'] ?? '' ); ?></span>
          </div>
          <p class="text-sm font-black uppercase tracking-wider"><?php echo esc_html( $stat['label'] ?? '' ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
