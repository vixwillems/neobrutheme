<?php
/**
 * Template part: Portfolio card.
 *
 * @package Neobrutheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-card' ); ?>>

  <div class="card-accent"></div>

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="overflow-hidden border-b-4 border-black">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail( 'portfolio-thumb', array( 'class' => 'w-full h-48 object-cover grayscale group-hover:grayscale-0 transition-all duration-200 group-hover:scale-105' ) ); ?>
    </a>
  </div>
  <?php else : ?>
  <div class="h-48 bg-[var(--color-yellow)] border-b-4 border-black flex items-center justify-center">
    <span class="text-4xl font-black uppercase tracking-tighter text-black/20"><?php echo mb_substr( get_the_title(), 0, 1 ); ?></span>
  </div>
  <?php endif; ?>

  <div class="p-5">
    <h2 class="text-lg font-black uppercase tracking-tighter mb-2 leading-tight">
      <a href="<?php the_permalink(); ?>" class="hover:text-[var(--color-red)]">
        <?php the_title(); ?>
      </a>
    </h2>

    <?php if ( function_exists( 'get_field' ) ) : ?>
      <?php $client = get_field( 'client_name' ); ?>
      <?php if ( $client ) : ?>
        <p class="text-xs font-bold uppercase tracking-wider text-black/50 mb-2"><?php echo esc_html( $client ); ?></p>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ( has_excerpt() || get_the_content() ) : ?>
    <p class="text-sm font-bold leading-relaxed text-black/70 mb-3">
      <?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?>
    </p>
    <?php endif; ?>

    <?php if ( function_exists( 'get_field' ) ) : ?>
      <?php $tech = get_field( 'technologies' ); ?>
      <?php if ( $tech ) : ?>
        <div class="flex flex-wrap gap-1.5 mt-2">
          <?php foreach ( array_slice( $tech, 0, 4 ) as $item ) : ?>
            <span class="text-[10px] font-black uppercase tracking-wider bg-[var(--color-cyan)] border-2 border-black px-2 py-0.5"><?php echo esc_html( $item['name'] ); ?></span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>

</article>
