<?php
/**
 * One-time frontpage setup — call via: /wp-content/themes/neobrutheme/tools/setup-frontpage.php?key=neobrutheme-setup
 *
 * @package Neobrutheme
 */

define( 'ABSPATH', dirname( dirname( dirname( __FILE__ ) ) ) . '/' );
require_once ABSPATH . 'wp-load.php';

if ( ! is_user_logged_in() || ! current_user_can( 'edit_posts' ) ) {
	wp_die( 'Unauthorized.' );
}

if ( isset( $_GET['key'] ) && $_GET['key'] === 'neobrutheme-setup' ) {

	$layouts = array(
		array(
			'acf_fc_layout'    => 'hero',
			'heading'          => 'Neo-brutalist web design for creative studios.',
			'subheading'       => 'Bold. Crisp. Unapologetically digital.',
			'bg_color'         => 'cyan',
			'show_composition' => 1,
		),
		array(
			'acf_fc_layout' => 'marquee',
			'text'          => 'Design / Development / Strategy / Branding / ',
			'speed'         => 'medium',
			'color'         => 'yellow',
		),
		array(
			'acf_fc_layout' => 'stat_cards',
			'stats'         => array(
				array( 'number' => '140', 'label' => 'Projects shipped', 'color' => 'yellow', 'shape' => 'default' ),
				array( 'number' => '60',  'label' => 'Happy clients',    'color' => 'red',    'shape' => 'circle' ),
				array( 'number' => '4200','label' => 'Coffees consumed', 'color' => 'cyan',   'shape' => 'diamond' ),
			),
		),
		array(
			'acf_fc_layout' => 'content_grid',
			'heading'       => 'Latest work',
			'post_type'     => 'portfolio',
			'count'         => 3,
			'columns'       => '3',
		),
		array(
			'acf_fc_layout' => 'services',
			'heading'       => 'What we do',
			'style'         => 'grid',
		),
		array(
			'acf_fc_layout' => 'testimonials',
			'heading'       => 'Kind words',
			'testimonials'  => array(
				array( 'quote' => 'They delivered exactly the kind of site that makes people stop scrolling.', 'author' => 'Alex R',  'role' => 'Studio Mono' ),
				array( 'quote' => 'Fast, brutal, beautiful. Could not ask for more.',                          'author' => 'Jamie K', 'role' => 'Formwork Co' ),
			),
		),
		array(
			'acf_fc_layout'   => 'cta',
			'heading'         => 'Let us build something bold.',
			'button_text'     => 'Start a project',
			'button_url'      => '/about/',
			'color'           => 'red',
		),
	);

	// Set on the frontpage post.
	$page_id = get_option( 'page_on_front' );
	if ( $page_id ) {
		update_post_meta( $page_id, 'page_layouts', $layouts );
		echo "Set Flexible Content on frontpage (ID {$page_id}).<br>";
	}

	// Also set on the options page as fallback.
	update_option( 'page_layouts', $layouts );
	echo "Set Flexible Content on options page.<br>";

	echo "<br>Done! Visit <a href='" . esc_url( home_url( '/' ) ) . "'>the front page</a> to see the layouts.";
}
