<?php
/**
 * Template part: Team member card.
 *
 * @package Neobrutheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'border-4 border-black shadow-[8px_8px_0_0_var(--color-fg)] bg-white p-6 text-center group hover:-translate-y-1 transition-transform duration-200' ); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="w-28 h-28 mx-auto mb-4 rounded-full border-4 border-black overflow-hidden">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail( 'team-photo', array( 'class' => 'w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-200' ) ); ?>
    </a>
  </div>
  <?php endif; ?>

  <h2 class="text-lg font-black uppercase tracking-tighter mb-1">
    <a href="<?php the_permalink(); ?>" class="hover:text-[var(--color-red)]">
      <?php the_title(); ?>
    </a>
  </h2>

  <?php if ( function_exists( 'get_field' ) ) : ?>
    <?php $role = get_field( 'role' ); ?>
    <?php if ( $role ) : ?>
      <p class="text-sm font-bold text-[var(--color-red)]"><?php echo esc_html( $role ); ?></p>
    <?php endif; ?>
  <?php endif; ?>

</article>
