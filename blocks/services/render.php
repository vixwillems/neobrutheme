<?php
$heading = $attributes['heading'] ?? '';
$style   = $attributes['style'] ?? 'grid';

$services = get_posts( array(
  'post_type'      => 'service',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
) );

if ( empty( $services ) ) return;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <?php if ( $style === 'list' ) : ?>
      <div class="space-y-4" data-stagger>
        <?php foreach ( $services as $service ) : setup_postdata( $service ); ?>
          <?php get_template_part( 'template-parts/content-service' ); ?>
        <?php endforeach; wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-stagger>
        <?php foreach ( $services as $service ) : setup_postdata( $service ); ?>
          <?php get_template_part( 'template-parts/content-service' ); ?>
        <?php endforeach; wp_reset_postdata(); ?>
      </div>
    <?php endif; ?>
  </div>
</section>
