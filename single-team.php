<?php
/**
 * The template for displaying single team members.
 *
 * @package Neobrutheme
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

  <div class="flex flex-col md:flex-row gap-10 items-start">

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="w-full md:w-1/3 flex-shrink-0">
      <div class="border-8 border-black shadow-[8px_8px_0_0_var(--color-fg)] overflow-hidden rounded-full aspect-square">
        <?php the_post_thumbnail( 'team-photo', array( 'class' => 'w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-200' ) ); ?>
      </div>
    </div>
    <?php endif; ?>

    <div class="flex-1">
      <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-2">
        <?php the_title(); ?>
      </h1>

      <?php if ( function_exists( 'get_field' ) ) : ?>
        <?php $role = get_field( 'role' ); ?>
        <?php if ( $role ) : ?>
          <p class="text-xl font-bold text-[var(--color-red)] mb-4"><?php echo esc_html( $role ); ?></p>
        <?php endif; ?>
      <?php endif; ?>

      <div class="rich-text text-lg mb-6">
        <?php the_content(); ?>
      </div>

      <?php if ( function_exists( 'get_field' ) ) : ?>
        <?php $email = get_field( 'email' ); ?>
        <?php if ( $email ) : ?>
          <a href="mailto:<?php echo esc_attr( $email ); ?>" class="btn bg-[var(--color-cyan)] shadow-[4px_4px_0_0_var(--color-fg)] mb-4">
            <?php echo esc_html( $email ); ?>
          </a>
        <?php endif; ?>

        <?php $social = get_field( 'social_links' ); ?>
        <?php if ( $social ) : ?>
          <div class="flex flex-wrap gap-2 mt-4">
            <?php foreach ( $social as $link ) : ?>
              <a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener" class="btn bg-white shadow-[4px_4px_0_0_var(--color-fg)]">
                <?php echo esc_html( $link['label'] ); ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

  </div>

</article>

<?php endwhile; ?>

<?php
get_footer();
