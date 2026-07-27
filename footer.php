</main><!-- #primary -->

<footer class="site-footer">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-sm font-bold uppercase tracking-wider">

      <div class="flex items-center gap-4">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 no-underline">
          <div class="flex items-center">
            <span class="w-4 h-4 rounded-full bg-[var(--color-red)] border-2 border-[var(--color-bg)]"></span>
            <span class="w-4 h-4 bg-[var(--color-yellow)] -ml-1 border-2 border-[var(--color-bg)]"></span>
            <span class="w-0 h-0 geo-triangle bg-[var(--color-cyan)] -ml-1" style="width:16px;height:16px"></span>
          </div>
          <span class="text-[var(--color-bg)]"><?php bloginfo( 'name' ); ?></span>
        </a>
        <span class="opacity-70 text-[var(--color-bg)]">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
      </div>

      <?php if ( has_nav_menu( 'footer' ) ) : ?>
      <ul class="flex items-center justify-center flex-wrap gap-3 sm:gap-4 opacity-70 list-none p-0 m-0">
        <?php
        wp_nav_menu( array(
          'theme_location' => 'footer',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'link_before'    => '<span class="underline underline-offset-4 hover:text-[var(--color-red)]">',
          'link_after'     => '</span>',
          'depth'          => 1,
          'echo'           => false,
        ) );
        ?>
      </ul>
      <?php endif; ?>

    </div>

    <?php
    // Custom footer text from Customizer.
    $footer_text = get_theme_mod( 'neobrutheme_footer_text', '' );
    if ( $footer_text ) :
    ?>
    <div class="footer-text mt-4 text-center text-xs opacity-70">
      <?php echo esc_html( $footer_text ); ?>
    </div>
    <?php endif; ?>

    <?php
    // Social links from ACF settings page.
    if ( get_theme_mod( 'neobrutheme_footer_show_social', true ) && function_exists( 'get_field' ) ) :
      $settings_id = neobrutheme_get_settings_page_id();
      if ( $settings_id ) :
        $social_links = get_field( 'social_links', $settings_id );
        if ( $social_links ) :
    ?>
    <div class="mt-6 flex items-center justify-center flex-wrap gap-3 sm:gap-4 text-xs opacity-60">
      <?php foreach ( $social_links as $link ) : ?>
        <a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener" class="underline underline-offset-4 hover:text-[var(--color-red)]">
          <?php echo esc_html( $link['label'] ); ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php
      endif;
      endif;
      endif;
    ?>

  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
