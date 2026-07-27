<?php
/**
 * Custom block registration.
 *
 * Registers all neobrutheme blocks with the Block Editor.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register block category.
 */
function neobrutheme_block_category( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'neobrutheme',
				'title' => 'Neobrutheme',
				'icon'  => 'superhero',
			),
		),
		$categories
	);
}
add_filter( 'block_categories_all', 'neobrutheme_block_category' );

/**
 * Register all custom blocks.
 */
function neobrutheme_register_blocks() {
	$blocks = array(
		'hero',
		'marquee',
		'stat-cards',
		'content-grid',
		'services',
		'testimonials',
		'cta',
		'divider',
		'gallery',
		'faq',
		'pricing',
		'contact',
		'logo-wall',
		'features',
		'video',
	);

	foreach ( $blocks as $block ) {
		$block_path = NEOBRUTEME_DIR . '/blocks/' . $block . '/block.json';
		if ( file_exists( $block_path ) ) {
			register_block_type( $block_path );
		}
	}
}
add_action( 'init', 'neobrutheme_register_blocks' );

/**
 * Enqueue block editor assets.
 */
function neobrutheme_enqueue_block_editor_assets() {
	wp_enqueue_script(
		'neobrutheme-blocks',
		NEOBRUTEME_URI . '/assets/js/blocks.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components' ),
		NEOBRUTEME_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'neobrutheme_enqueue_block_editor_assets' );
