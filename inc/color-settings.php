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

	$settings_id = neobrutheme_get_settings_page_id();

	$colors = array(
		'bg'     => $settings_id ? get_field( 'color_bg', $settings_id ) ?: '#FFFFFF' : '#FFFFFF',
		'fg'     => $settings_id ? get_field( 'color_fg', $settings_id ) ?: '#000000' : '#000000',
		'red'    => $settings_id ? get_field( 'color_red', $settings_id ) ?: '#FF5C5C' : '#FF5C5C',
		'yellow' => $settings_id ? get_field( 'color_yellow', $settings_id ) ?: '#FFDE59' : '#FFDE59',
		'cyan'   => $settings_id ? get_field( 'color_cyan', $settings_id ) ?: '#5CE1E6' : '#5CE1E6',
		'white'  => $settings_id ? get_field( 'color_white', $settings_id ) ?: '#FFFFFF' : '#FFFFFF',
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
