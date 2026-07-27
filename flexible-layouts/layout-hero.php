<?php
/**
 * Flexible Content layout: Hero.
 *
 * Two-panel layout: left heading + right composition panel.
 *
 * @package Neobrutheme
 */

$heading          = get_sub_field( 'heading' ) ?: 'Hello World';
$subheading       = get_sub_field( 'subheading' );
$bg_color         = get_sub_field( 'bg_color' ) ?: 'cyan';
$show_composition = get_sub_field( 'show_composition' );

$bg_class = neobrutheme_color_class( $bg_color );
?>

<section class="border-b-8 border-black <?php echo esc_attr( $bg_class ); ?>">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="flex flex-col <?php echo $show_composition ? 'md:flex-row' : ''; ?> items-center gap-10">

      <div class="<?php echo $show_composition ? 'md:w-1/2' : 'w-full text-center'; ?>">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter display-stroke leading-[0.85] mb-6">
          <?php echo esc_html( $heading ); ?>
        </h1>
        <?php if ( $subheading ) : ?>
          <p class="text-lg md:text-xl font-bold max-w-lg <?php echo $show_composition ? '' : 'mx-auto'; ?>">
            <?php echo esc_html( $subheading ); ?>
          </p>
        <?php endif; ?>
        <div class="mt-8">
          <a href="#content" class="btn bg-[var(--color-fg)] text-[var(--color-bg)] shadow-[4px_4px_0_0_var(--color-red)]">
            <?php esc_html_e( 'Explore', 'neobrutheme' ); ?>
          </a>
        </div>
      </div>

      <?php if ( $show_composition ) : ?>
      <div class="md:w-1/2">
        <div class="hero-composition border-8 border-black shadow-[12px_12px_0_0_var(--color-fg)] bg-[var(--color-fg)]">
          <div class="shape-dot-grid"></div>
          <div class="shape shape-circle"></div>
          <div class="shape shape-sticker">
            <span class="text-2xl font-black">&#9733;</span>
          </div>
          <div class="shape shape-frame"></div>
          <div class="shape shape-triangle"></div>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>
