<?php
$heading   = $attributes['heading'] ?? '';
$post_type = $attributes['postType'] ?? 'post';
$count     = $attributes['count'] ?? 6;
$columns   = $attributes['columns'] ?? '3';

$posts = get_posts( array(
  'post_type'      => $post_type,
  'posts_per_page' => $count,
  'post_status'    => 'publish',
) );

if ( empty( $posts ) ) return;

$col_class = 'md:grid-cols-' . $columns;
$template_part = 'template-parts/content-' . $post_type;
?>
<section class="px-6 md:px-12 py-12 border-b-8 border-[var(--color-fg)]">
  <div class="max-w-6xl mx-auto">
    <?php if ( $heading ) : ?>
      <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight mb-8"><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    <div class="grid grid-cols-1 <?php echo esc_attr( $col_class ); ?> gap-8" data-stagger>
      <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
        <?php get_template_part( $template_part ); ?>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
