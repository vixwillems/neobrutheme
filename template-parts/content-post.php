<?php
/**
 * Template part: Blog post card.
 *
 * @package Neobrutheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>

  <div class="card-accent"></div>

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="overflow-hidden border-b-4 border-black">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-48 object-cover grayscale group-hover:grayscale-0 transition-all duration-200 group-hover:scale-105' ) ); ?>
    </a>
  </div>
  <?php endif; ?>

  <div class="p-5">
    <h2 class="text-lg font-black uppercase tracking-tighter mb-2 leading-tight">
      <a href="<?php the_permalink(); ?>" class="hover:text-[var(--color-red)]">
        <?php the_title(); ?>
      </a>
    </h2>

    <div class="text-xs font-bold uppercase tracking-wider text-black/50 mb-3">
      <?php neobrutheme_posted_on(); ?>
    </div>

    <?php if ( has_excerpt() || get_the_content() ) : ?>
    <p class="text-sm font-bold leading-relaxed text-black/70">
      <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?>
    </p>
    <?php endif; ?>

    <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-xs font-black uppercase tracking-wider border-b-3 border-black pb-0.5 hover:text-[var(--color-red)] hover:border-[var(--color-red)]">
      Read more &rarr;
    </a>
  </div>

</article>
