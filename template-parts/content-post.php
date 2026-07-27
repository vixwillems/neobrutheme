<?php
/**
 * Template part: Blog post card.
 *
 * @package Neobrutheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'border-4 border-black shadow-[8px_8px_0_0_var(--color-fg)] bg-white overflow-hidden group' ); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="overflow-hidden border-b-4 border-black">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-48 object-cover grayscale group-hover:grayscale-0 transition-all duration-200 group-hover:scale-105' ) ); ?>
    </a>
  </div>
  <?php endif; ?>

  <div class="p-5">
    <h2 class="text-xl font-black uppercase tracking-tighter mb-2">
      <a href="<?php the_permalink(); ?>" class="hover:text-[var(--color-red)]">
        <?php the_title(); ?>
      </a>
    </h2>

    <div class="text-sm font-bold text-black/60 mb-3">
      <?php neobrutheme_posted_on(); ?>
    </div>

    <?php if ( has_excerpt() || get_the_content() ) : ?>
    <p class="text-sm font-bold leading-snug">
      <?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
    </p>
    <?php endif; ?>
  </div>

</article>
