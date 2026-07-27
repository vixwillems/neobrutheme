<?php
/**
 * Flexible Content layout: Stat Cards.
 *
 * Yellow panel with stat shapes and animated counters.
 *
 * @package Neobrutheme
 */

$stats = neo_sub( 'stats' ) ?: array();
?>

<section class="bg-[var(--color-yellow)] border-b-8 border-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-wrap justify-center gap-8 md:gap-12">
      <?php foreach ( $stats as $stat ) :
        $number = $stat['number'] ?: 0;
        $label  = $stat['label'] ?: '';
        $color  = $stat['color'] ?: 'white';
        $shape  = $stat['shape'] ?: 'default';

        $shape_class = '';
        if ( $shape === 'circle' ) {
          $shape_class = 'stat-shape--circle';
        } elseif ( $shape === 'diamond' ) {
          $shape_class = 'stat-shape--diamond';
        }

        $bg_class = neobrutheme_color_class( $color );
      ?>
      <div class="text-center" data-fade-in>
        <div class="stat-shape <?php echo esc_attr( $shape_class . ' ' . $bg_class ); ?>">
          <span data-count="<?php echo esc_attr( $number ); ?>">0</span>
        </div>
        <p class="mt-3 text-sm font-black uppercase tracking-widest max-w-[120px]">
          <?php echo esc_html( $label ); ?>
        </p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
