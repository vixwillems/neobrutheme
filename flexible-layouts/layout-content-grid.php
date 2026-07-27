<?php
/**
 * Flexible Content layout: Content Grid.
 *
 * Dynamic grid pulling from any post type via WP_Query.
 *
 * @package Neobrutheme
 */

$heading   = get_sub_field( 'heading' ) ?: 'Latest';
$post_type = get_sub_field( 'post_type' ) ?: 'post';
$count     = intval( get_sub_field( 'count' ) ) ?: 6;
$columns   = get_sub_field( 'columns' ) ?: '3';

$grid_class = 'grid-cols-1 md:grid-cols-2';
if ( $columns === '3' ) {
  $grid_class = 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
} elseif ( $columns === '4' ) {
  $grid_class = 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4';
}

$query = new WP_Query( array(
  'post_type'      => $post_type,
  'posts_per_page' => $count,
  'post_status'    => 'publish',
) );
?>

<section class="py-16" id="content">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php if ( $heading ) : ?>
    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-10">
      <?php echo esc_html( $heading ); ?>
    </h2>
    <?php endif; ?>

    <?php if ( $query->have_posts() ) : ?>
    <div class="grid <?php echo esc_attr( $grid_class ); ?> gap-8">
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php
        $part = 'content-post';
        if ( $post_type === 'portfolio' ) {
          $part = 'content-portfolio';
        } elseif ( $post_type === 'team' ) {
          $part = 'content-team';
        } elseif ( $post_type === 'service' ) {
          $part = 'content-service';
        }
        get_template_part( 'template-parts/' . $part );
        ?>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php wp_reset_postdata(); ?>
