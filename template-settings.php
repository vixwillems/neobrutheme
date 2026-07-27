<?php
/**
 * Template Name: Settings Page
 *
 * Hidden page template for theme settings (colors, general).
 * ACF field groups attach to this template.
 * This page should be set to Private in wp-admin.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Redirect non-admins to the homepage.
if ( ! current_user_can( 'edit_posts' ) ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
		<h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-8">
			<?php the_title(); ?>
		</h1>
		<div class="rich-text text-lg">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
endwhile;

get_footer();
