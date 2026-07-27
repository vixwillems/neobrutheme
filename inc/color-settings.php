<?php
/**
 * Color settings: output CSS custom properties from ACF options.
 *
 * Reads color values from the ACF Color Options page and outputs
 * them as CSS custom properties on :root, overriding the defaults
 * defined in assets/css/style.css.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output CSS custom properties from ACF color options.
 */
function neobrutheme_color_custom_properties() {
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}

	$colors = array(
		'bg'     => get_field( 'color_bg', 'option' ) ?: '#FFFFFF',
		'fg'     => get_field( 'color_fg', 'option' ) ?: '#000000',
		'red'    => get_field( 'color_red', 'option' ) ?: '#FF5C5C',
		'yellow' => get_field( 'color_yellow', 'option' ) ?: '#FFDE59',
		'cyan'   => get_field( 'color_cyan', 'option' ) ?: '#5CE1E6',
		'white'  => get_field( 'color_white', 'option' ) ?: '#FFFFFF',
	);

	echo '<style id="neobrutheme-colors">';
	echo ':root {';
	foreach ( $colors as $name => $value ) {
		printf( '--color-%s: %s; ', esc_attr( $name ), esc_attr( $value ) );
	}
	echo '}';
	echo '</style>' . "\n";
}
add_action( 'wp_head', 'neobrutheme_color_custom_properties', 1 );
