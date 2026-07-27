<?php
/**
 * The template for displaying single services.
 *
 * @package Neobrutheme
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

  <?php if ( function_exists( 'get_field' ) ) : ?>
    <?php $icon = get_field( 'service_icon' ); ?>
    <?php if ( $icon ) : ?>
    <div class="w-20 h-20 flex items-center justify-center border-8 border-black shadow-[8px_8px_0_0_var(--color-fg)] bg-[var(--color-yellow)] text-4xl mb-6">
      <?php echo esc_html( $icon ); ?>
    </div>
    <?php endif; ?>
  <?php endif; ?>

  <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-4">
    <?php the_title(); ?>
  </h1>

  <?php if ( function_exists( 'get_field' ) ) : ?>
    <?php $price = get_field( 'price_range' ); ?>
    <?php if ( $price ) : ?>
      <div class="inline-block bg-[var(--color-red)] text-white border-4 border-black px-4 py-2 font-black text-sm uppercase tracking-wider mb-6">
        <?php echo esc_html( $price ); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="rich-text text-lg mb-10">
    <?php the_content(); ?>
  </div>

  <div class="flex justify-between items-center border-t-4 border-black pt-6">
    <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="btn bg-white shadow-[4px_4px_0_0_var(--color-fg)]">
      &larr; All Services
    </a>
  </div>

</article>

<?php endwhile; ?>

<?php
get_footer();
