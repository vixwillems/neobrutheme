<?php
/**
 * Flexible Content layout: Team Grid.
 *
 * Queries the team CPT and renders member cards.
 *
 * @package Neobrutheme
 */

$heading = get_sub_field( 'heading' ) ?: 'Our Team';
$count   = intval( get_sub_field( 'count' ) ) ?: 6;

$query = new WP_Query( array(
  'post_type'      => 'team',
  'posts_per_page' => $count,
  'post_status'    => 'publish',
) );
?>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <?php if ( $heading ) : ?>
    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-10">
      <?php echo esc_html( $heading ); ?>
    </h2>
    <?php endif; ?>

    <?php if ( $query->have_posts() ) : ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'team' ); ?>
      <?php endwhile; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php wp_reset_postdata(); ?>
