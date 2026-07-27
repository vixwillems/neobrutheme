<?php
/**
 * CSS custom properties from Customizer settings.
 *
 * Outputs theme mods as CSS variables on :root, overriding
 * defaults defined in assets/css/style.css.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neobrutheme_color_custom_properties() {
	$props = array(
		// Colors.
		'bg'      => get_theme_mod( 'neobrutheme_color_bg', '#FFFFFF' ),
		'fg'      => get_theme_mod( 'neobrutheme_color_fg', '#000000' ),
		'red'     => get_theme_mod( 'neobrutheme_color_red', '#FF5C5C' ),
		'yellow'  => get_theme_mod( 'neobrutheme_color_yellow', '#FFDE59' ),
		'cyan'    => get_theme_mod( 'neobrutheme_color_cyan', '#5CE1E6' ),
		'white'   => get_theme_mod( 'neobrutheme_color_white', '#FFFFFF' ),
		// Typography.
		'body-font-weight'     => get_theme_mod( 'neobrutheme_body_font_weight', '400' ),
		'heading-font-weight'  => get_theme_mod( 'neobrutheme_heading_font_weight', '900' ),
		'heading-letter-spacing' => get_theme_mod( 'neobrutheme_heading_letter_spacing', '-0.05em' ),
		'line-height'          => get_theme_mod( 'neobrutheme_line_height', '1.6' ),
		// Buttons.
		'btn-border-width'  => get_theme_mod( 'neobrutheme_btn_border_width', '4px' ),
		'btn-shadow-size'   => get_theme_mod( 'neobrutheme_btn_shadow_size', '8px' ),
		'btn-text-transform' => get_theme_mod( 'neobrutheme_btn_text_transform', 'uppercase' ),
		// Cards.
		'card-border-width' => get_theme_mod( 'neobrutheme_card_border_width', '4px' ),
		'card-shadow-size'  => get_theme_mod( 'neobrutheme_card_shadow_size', '8px' ),
		'card-accent-color' => get_theme_mod( 'neobrutheme_card_accent_color', 'cyan' ),
		// Layout.
		'content-max-width'  => get_theme_mod( 'neobrutheme_content_max_width', '1200px' ),
		// Header.
		'header-border-width' => get_theme_mod( 'neobrutheme_header_border_width', '8px' ),
	);

	echo '<style id="neobrutheme-colors">';
	echo ':root {';
	foreach ( $props as $name => $value ) {
		printf( '--%s: %s; ', esc_attr( $name ), esc_attr( $value ) );
	}

	// Accent color resolution (needs to be a variable for CSS).
	$accent = get_theme_mod( 'neobrutheme_card_accent_color', 'cyan' );
	$accent_map = array(
		'cyan'   => 'var(--color-cyan)',
		'red'    => 'var(--color-red)',
		'yellow' => 'var(--color-yellow)',
	);
	printf( '--card-accent-color-resolved: %s; ', esc_attr( $accent_map[ $accent ] ?? 'var(--color-cyan)' ) );

	// Footer bg resolution.
	$footer_bg = get_theme_mod( 'neobrutheme_footer_bg_color', 'fg' );
	$footer_map = array(
		'fg'     => 'var(--color-fg)',
		'red'    => 'var(--color-red)',
		'cyan'   => 'var(--color-cyan)',
		'yellow' => 'var(--color-yellow)',
	);
	printf( '--footer-bg-resolved: %s; ', esc_attr( $footer_map[ $footer_bg ] ?? 'var(--color-fg)' ) );

	// Header bg resolution.
	$header_bg = get_theme_mod( 'neobrutheme_header_bg_color', 'bg' );
	$header_map = array(
		'bg'      => 'var(--color-bg)',
		'yellow'  => 'var(--color-yellow)',
		'cyan'    => 'var(--color-cyan)',
		'red'     => 'var(--color-red)',
	);
	printf( '--header-bg-resolved: %s; ', esc_attr( $header_map[ $header_bg ] ?? 'var(--color-bg)' ) );

	echo '}';
	echo '</style>' . "\n";
}
add_action( 'wp_head', 'neobrutheme_color_custom_properties', 1 );
