<?php
/**
 * Template part: Portfolio card.
 *
 * @package Neobrutheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'border-4 border-black shadow-[8px_8px_0_0_var(--color-fg)] bg-white overflow-hidden group' ); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
  <div class="overflow-hidden border-b-4 border-black">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail( 'portfolio-thumb', array( 'class' => 'w-full h-48 object-cover grayscale group-hover:grayscale-0 transition-all duration-200 group-hover:scale-105' ) ); ?>
    </a>
  </div>
  <?php endif; ?>

  <div class="p-5">
    <h2 class="text-lg font-black uppercase tracking-tighter mb-1">
      <a href="<?php the_permalink(); ?>" class="hover:text-[var(--color-red)]">
        <?php the_title(); ?>
      </a>
    </h2>

    <?php if ( function_exists( 'get_field' ) ) : ?>
      <?php $client = get_field( 'client_name' ); ?>
      <?php if ( $client ) : ?>
        <p class="text-sm font-bold text-[var(--color-cyan)] mb-2"><?php echo esc_html( $client ); ?></p>
      <?php endif; ?>

      <?php $tech = get_field( 'technologies' ); ?>
      <?php if ( $tech ) : ?>
        <div class="flex flex-wrap gap-1 mt-2">
          <?php foreach ( array_slice( $tech, 0, 3 ) as $item ) : ?>
            <span class="text-[10px] font-black uppercase tracking-wider bg-[var(--color-yellow)] border border-black px-1.5 py-0.5"><?php echo esc_html( $item['name'] ); ?></span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>

</article>
