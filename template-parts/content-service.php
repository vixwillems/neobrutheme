<?php
/**
 * Template part: Service card.
 *
 * @package Neobrutheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'border-4 border-black shadow-[8px_8px_0_0_var(--color-fg)] bg-white p-6 group hover:-translate-y-1 transition-transform duration-200' ); ?>>

  <?php if ( function_exists( 'get_field' ) ) : ?>
    <?php $icon = get_field( 'service_icon' ); ?>
    <?php if ( $icon ) : ?>
    <div class="w-14 h-14 flex items-center justify-center border-4 border-black bg-[var(--color-yellow)] text-2xl mb-4">
      <?php echo esc_html( $icon ); ?>
    </div>
    <?php endif; ?>
  <?php endif; ?>

  <h2 class="text-lg font-black uppercase tracking-tighter mb-2">
    <a href="<?php the_permalink(); ?>" class="hover:text-[var(--color-red)]">
      <?php the_title(); ?>
    </a>
  </h2>

  <?php if ( function_exists( 'get_field' ) ) : ?>
    <?php $short = get_field( 'short_description' ); ?>
    <?php if ( $short ) : ?>
      <p class="text-sm font-bold leading-snug mb-3"><?php echo esc_html( $short ); ?></p>
    <?php endif; ?>

    <?php $price = get_field( 'price_range' ); ?>
    <?php if ( $price ) : ?>
      <span class="inline-block text-xs font-black uppercase tracking-wider bg-[var(--color-red)] text-white border border-black px-2 py-0.5">
        <?php echo esc_html( $price ); ?>
      </span>
    <?php endif; ?>
  <?php endif; ?>

</article>
