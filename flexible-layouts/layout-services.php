<?php
/**
 * Flexible Content layout: Services.
 *
 * Queries the service CPT and renders service cards.
 *
 * @package Neobrutheme
 */

$heading = get_sub_field( 'heading' ) ?: 'Services';
$style   = get_sub_field( 'style' ) ?: 'grid';

$query = new WP_Query( array(
  'post_type'      => 'service',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
) );

$grid_class = $style === 'list'
  ? 'grid-cols-1 max-w-3xl mx-auto'
  : 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
?>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php if ( $heading ) : ?>
    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-10">
      <?php echo esc_html( $heading ); ?>
    </h2>
    <?php endif; ?>

    <?php if ( $query->have_posts() ) : ?>
    <div class="grid <?php echo esc_attr( $grid_class ); ?> gap-8">
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'service' ); ?>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php wp_reset_postdata(); ?>
