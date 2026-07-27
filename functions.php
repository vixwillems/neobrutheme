<?php
/**
 * Neobrutheme functions and definitions.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NEOBRUTEME_VERSION', '1.0.0' );
define( 'NEOBRUTEME_DIR', get_template_directory() );
define( 'NEOBRUTEME_URI', get_template_directory_uri() );

// Theme setup.
require_once NEOBRUTEME_DIR . '/inc/theme-setup.php';

// Template tags / helpers.
require_once NEOBRUTEME_DIR . '/inc/template-tags.php';

// Custom post types.
require_once NEOBRUTEME_DIR . '/inc/post-types.php';

// ACF integration.
require_once NEOBRUTEME_DIR . '/inc/acf-setup.php';

// Color settings (CSS custom properties from Customizer).
require_once NEOBRUTEME_DIR . '/inc/color-settings.php';

// WordPress Customizer settings.
require_once NEOBRUTEME_DIR . '/inc/customizer.php';

// Custom REST API endpoints.
require_once NEOBRUTEME_DIR . '/inc/rest-api.php';

// Register custom blocks.
require_once NEOBRUTEME_DIR . '/inc/blocks.php';

/**
 * Enqueue scripts and styles.
 */
function neobrutheme_scripts() {
	// Tailwind compiled CSS.
	wp_enqueue_style(
		'neobrutheme-tailwind',
		NEOBRUTEME_URI . '/assets/css/tailwind.css',
		array(),
		NEOBRUTEME_VERSION
	);

	// Design system CSS.
	wp_enqueue_style(
		'neobrutheme-style',
		NEOBRUTEME_URI . '/assets/css/style.css',
		array( 'neobrutheme-tailwind' ),
		NEOBRUTEME_VERSION
	);

	// Main theme stylesheet (WP metadata + additional overrides).
	wp_enqueue_style(
		'neobrutheme-main',
		get_stylesheet_uri(),
		array( 'neobrutheme-style' ),
		NEOBRUTEME_VERSION
	);

	// Interactions JS.
	wp_enqueue_script(
		'neobrutheme-interactions',
		NEOBRUTEME_URI . '/assets/js/interactions.js',
		array(),
		NEOBRUTEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'neobrutheme_scripts' );
