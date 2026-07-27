<?php
/**
 * Flexible Content layout: Text + Image.
 *
 * Two-column layout with text on one side, image on the other.
 *
 * @package Neobrutheme
 */

$heading   = neo_sub( 'heading' );
$content   = neo_sub( 'content' );
$image     = neo_sub( 'image' );
$alignment = neo_sub( 'alignment' ) ?: 'right';
?>

<section class="py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col <?php echo $alignment === 'left' ? 'md:flex-row-reverse' : 'md:flex-row'; ?> gap-10 items-center">

      <?php if ( $heading || $content ) : ?>
      <div class="md:w-1/2">
        <?php if ( $heading ) : ?>
        <h2 class="text-4xl md:text-5xl font-black uppercase tracking-tighter mb-4">
          <?php echo esc_html( $heading ); ?>
        </h2>
        <?php endif; ?>
        <?php if ( $content ) : ?>
        <div class="rich-text text-lg">
          <?php echo wp_kses_post( $content ); ?>
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( $image ) : ?>
      <div class="md:w-1/2">
        <div class="border-8 border-black shadow-[8px_8px_0_0_var(--color-fg)] overflow-hidden">
          <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="w-full h-auto grayscale hover:grayscale-0 transition-all duration-200">
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
