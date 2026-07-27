<?php
/**
 * Theme setup: supports, menus, image sizes.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports.
 */
function neobrutheme_setup() {
	// Let WordPress manage the <title> tag.
	add_theme_support( 'title-tag' );

	// Featured images.
	add_theme_support( 'post-thumbnails' );

	// Custom logo.
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// HTML5 markup support.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Block editor support.
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );

	// Custom background (default white).
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );

	// Automatic feed links.
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'neobrutheme_setup' );

/**
 * Register navigation menus.
 */
function neobrutheme_menus() {
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'neobrutheme' ),
		'footer'  => esc_html__( 'Footer Navigation', 'neobrutheme' ),
	) );
}
add_action( 'after_setup_theme', 'neobrutheme_menus' );

/**
 * Register custom image sizes.
 */
function neobrutheme_image_sizes() {
	add_image_size( 'portfolio-thumb', 600, 400, true );
	add_image_size( 'team-photo', 400, 400, true );
	add_image_size( 'service-icon', 200, 200, true );
}
add_action( 'after_setup_theme', 'neobrutheme_image_sizes' );

/**
 * Register widget areas.
 */
function neobrutheme_widgets() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'neobrutheme' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Widgets in this area appear in the footer.', 'neobrutheme' ),
		'before_widget' => '<div class="footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'neobrutheme_widgets' );
