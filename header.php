<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav class="site-nav sticky top-0 z-50 bg-white border-b-8 border-black">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 no-underline">
      <div class="flex items-center">
        <span class="w-5 h-5 rounded-full bg-[var(--color-red)] border-2 border-black"></span>
        <span class="w-5 h-5 bg-[var(--color-yellow)] -ml-1.5 border-2 border-black"></span>
        <span class="w-0 h-0 geo-triangle bg-[var(--color-cyan)] -ml-1.5" style="width:20px;height:20px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000"></span>
      </div>
      <span class="font-black uppercase text-xl tracking-tighter text-black"><?php bloginfo( 'name' ); ?></span>
    </a>

    <button id="menu-toggle" class="md:hidden flex items-center justify-center w-12 h-12 border-4 border-black bg-white text-2xl" aria-label="Toggle menu">
      <span id="menu-icon">&#9776;</span>
    </button>

    <div id="desktop-nav" class="hidden md:flex items-center gap-2">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'link_before'    => '<span class="block px-4 py-2 text-sm font-bold uppercase tracking-wider border-4 border-transparent hover:bg-[var(--color-cyan)] hover:border-black">',
        'link_after'     => '</span>',
        'depth'          => 1,
      ) );
      ?>
    </div>
  </div>

  <div id="mobile-menu" class="md:hidden hidden border-t-8 border-black bg-white">
    <div class="px-4 py-4 flex flex-col gap-2">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'container'      => false,
        'items_wrap'     => '%3$s',
        'link_before'    => '<span class="block px-4 py-3 text-sm font-bold uppercase tracking-wider border-4 border-black hover:bg-[var(--color-cyan)]">',
        'link_after'     => '</span>',
        'depth'          => 1,
      ) );
      ?>
    </div>
  </div>
</nav>

<script>
(function() {
  var toggle = document.getElementById('menu-toggle');
  var menu = document.getElementById('mobile-menu');
  var icon = document.getElementById('menu-icon');
  if (toggle && menu) {
    toggle.addEventListener('click', function() {
      var open = menu.classList.toggle('hidden');
      icon.textContent = open ? '\u2630' : '\u2715';
    });
  }
})();
</script>

<main id="primary" class="site-main">
