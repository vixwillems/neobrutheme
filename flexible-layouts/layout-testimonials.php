<?php
/**
 * Flexible Content layout: Testimonials.
 *
 * Grid of testimonial cards with quote, author, and role.
 *
 * @package Neobrutheme
 */

$heading      = neo_sub( 'heading' ) ?: 'What People Say';
$testimonials = neo_sub( 'testimonials' ) ?: array();
?>

<section class="py-16 bg-[var(--color-cyan)] border-y-8 border-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php if ( $heading ) : ?>
    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-10 text-center">
      <?php echo esc_html( $heading ); ?>
    </h2>
    <?php endif; ?>

    <?php if ( $testimonials ) : ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ( $testimonials as $index => $test ) :
        $quote  = $test['quote'] ?: '';
        $author = $test['author'] ?: '';
        $role   = $test['role'] ?: '';
        $rotations = array( 'rotate-[-1deg]', 'rotate-[1deg]', '-rotate-1', 'rotate-[2deg]', '' );
        $rotation  = $rotations[ $index % count( $rotations ) ];
      ?>
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_var(--color-fg)] p-6 <?php echo esc_attr( $rotation ); ?>" data-fade-in>
        <div class="text-4xl font-black text-[var(--color-red)] mb-2">&ldquo;</div>
        <p class="font-bold leading-snug mb-4">
          <?php echo esc_html( $quote ); ?>
        </p>
        <div class="border-t-4 border-black pt-3">
          <div class="font-black text-sm uppercase tracking-wider"><?php echo esc_html( $author ); ?></div>
          <?php if ( $role ) : ?>
            <div class="text-xs font-bold text-black/60 mt-0.5"><?php echo esc_html( $role ); ?></div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</section>
