<?php
/**
 * Brutheme — Neo-Brutalist skin for the Neve framework.
 *
 * Keeps 100% of Neve's functionality (Customizer, HFG builder,
 * blog layouts, WooCommerce, EDD, mega menu) and overlays the
 * brutheme design system on top.
 *
 * @package Neobrutheme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Remove Space Grotesk from the Google Fonts CDN list so it is never
 * loaded from fonts.googleapis.com. It is self-hosted in brutheme.css.
 *
 * @param array $fonts Google font families.
 * @return array
 */
function brutheme_remove_space_grotesk_google( $fonts ) {
	unset( $fonts['Space Grotesk'] );

	return $fonts;
}
add_filter( 'neve_google_fonts_with_variants_array', 'brutheme_remove_space_grotesk_google' );

/**
 * Keep Space Grotesk out of the Customizer "Google" dropdown so it is
 * only offered under System fonts (self-hosted).
 *
 * @param array $fonts Google font family names.
 * @return array
 */
function brutheme_remove_space_grotesk_google_names( $fonts ) {
	return array_values(
		array_filter(
			$fonts,
			function ( $font ) {
				return $font !== 'Space Grotesk';
			}
		)
	);
}
add_filter( 'neve_google_fonts_array', 'brutheme_remove_space_grotesk_google_names' );

/**
 * Register Space Grotesk as a selectable "system" font so it stays
 * available in the Customizer dropdown while loading locally.
 *
 * @param array $fonts Standard font families.
 * @return array
 */
function brutheme_add_space_grotesk_standard( $fonts ) {
	if ( isset( $fonts['Space Grotesk'] ) ) {
		return $fonts;
	}

	$fonts['Space Grotesk'] = array( '400', '500', '700' );

	return $fonts;
}
add_filter( 'neve_standard_fonts_with_variants_array', 'brutheme_add_space_grotesk_standard' );

/**
 * Keep Space Grotesk selectable in the Customizer System font list.
 *
 * @param array $fonts Standard font family names.
 * @return array
 */
function brutheme_add_space_grotesk_standard_names( $fonts ) {
	if ( in_array( 'Space Grotesk', $fonts, true ) ) {
		return $fonts;
	}

	$fonts[] = 'Space Grotesk';

	return $fonts;
}
add_filter( 'neve_standard_fonts_array', 'brutheme_add_space_grotesk_standard_names' );

/**
 * Enqueue the brutheme skin stylesheet AFTER Neve's core + add-on CSS.
 */
function brutheme_enqueue_styles() {
	$deps = array( 'neve-style' );

	if ( wp_style_is( 'neve-woocommerce', 'registered' ) ) {
		$deps[] = 'neve-woocommerce';
	}
	if ( wp_style_is( 'neve-easy-digital-downloads', 'registered' ) ) {
		$deps[] = 'neve-easy-digital-downloads';
	}

	// Version by file mtime so every skin edit busts browser/CDN cache.
	$css_file = get_template_directory() . '/assets/css/brutheme.css';
	$version  = file_exists( $css_file ) ? filemtime( $css_file ) : NEVE_VERSION;

	wp_enqueue_style(
		'brutheme-style',
		get_template_directory_uri() . '/assets/css/brutheme.css',
		$deps,
		$version
	);
}
add_action( 'wp_enqueue_scripts', 'brutheme_enqueue_styles', 999 );

/**
 * Enqueue brutheme scroll animations (vanilla JS, no jQuery).
 */
function brutheme_enqueue_scripts() {
	$js_file = get_template_directory() . '/assets/js/brutheme.js';
	$version = file_exists( $js_file ) ? filemtime( $js_file ) : NEVE_VERSION;

	wp_enqueue_script(
		'brutheme-script',
		get_template_directory_uri() . '/assets/js/brutheme.js',
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'brutheme_enqueue_scripts', 999 );

/**
 * Add the brutalist skin to the block editor so editing matches the
 * front-end look and feel.
 */
function brutheme_editor_styles() {
	add_editor_style( 'assets/css/brutheme.css' );
}
add_action( 'after_setup_theme', 'brutheme_editor_styles' );

/**
 * Hide the Neve page-title header on static pages.
 *
 * The brutheme page templates build their own page header (eyebrow +
 * giant H1 + CTA) in content, so Neve's default page header would render
 * a redundant "Home" / "About Me" H1 on top of it. Unhook the renderer
 * for every static page; archives and single posts keep the standard
 * title header.
 */
function brutheme_hide_page_title() {
	if ( ! is_page() ) {
		return;
	}
	remove_all_actions( 'neve_page_header' );
}
add_action( 'neve_before_page_header', 'brutheme_hide_page_title' );

/**
 * Dequeue the Google Fonts stylesheet for Space Grotesk on the front end.
 * Font_Manager registers it at priority 200; we run afterwards.
 */
function brutheme_dequeue_google_space_grotesk() {
	wp_dequeue_style( 'neve-google-font-space-grotesk' );
	wp_deregister_style( 'neve-google-font-space-grotesk' );
}
add_action( 'wp_enqueue_scripts', 'brutheme_dequeue_google_space_grotesk', 201 );
add_action( 'enqueue_block_editor_assets', 'brutheme_dequeue_google_space_grotesk', 201 );
