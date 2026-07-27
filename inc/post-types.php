<?php
/**
 * Custom post type registrations.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom post types.
 */
function neobrutheme_register_post_types() {

	// Portfolio.
	register_post_type( 'portfolio', array(
		'labels'       => array(
			'name'               => __( 'Portfolio', 'neobrutheme' ),
			'singular_name'      => __( 'Portfolio Item', 'neobrutheme' ),
			'add_new_item'       => __( 'Add New Item', 'neobrutheme' ),
			'edit_item'          => __( 'Edit Item', 'neobrutheme' ),
			'view_item'          => __( 'View Item', 'neobrutheme' ),
			'all_items'          => __( 'All Items', 'neobrutheme' ),
			'search_items'       => __( 'Search Items', 'neobrutheme' ),
			'not_found'          => __( 'No items found.', 'neobrutheme' ),
			'not_found_in_trash' => __( 'No items found in Trash.', 'neobrutheme' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-portfolio',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'      => array( 'slug' => 'portfolio' ),
		'show_in_rest' => true,
	) );

	// Team.
	register_post_type( 'team', array(
		'labels'       => array(
			'name'               => __( 'Team', 'neobrutheme' ),
			'singular_name'      => __( 'Team Member', 'neobrutheme' ),
			'add_new_item'       => __( 'Add New Member', 'neobrutheme' ),
			'edit_item'          => __( 'Edit Member', 'neobrutheme' ),
			'view_item'          => __( 'View Member', 'neobrutheme' ),
			'all_items'          => __( 'All Members', 'neobrutheme' ),
			'search_items'       => __( 'Search Members', 'neobrutheme' ),
			'not_found'          => __( 'No members found.', 'neobrutheme' ),
			'not_found_in_trash' => __( 'No members found in Trash.', 'neobrutheme' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-groups',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'      => array( 'slug' => 'team' ),
		'show_in_rest' => true,
	) );

	// Service.
	register_post_type( 'service', array(
		'labels'       => array(
			'name'               => __( 'Services', 'neobrutheme' ),
			'singular_name'      => __( 'Service', 'neobrutheme' ),
			'add_new_item'       => __( 'Add New Service', 'neobrutheme' ),
			'edit_item'          => __( 'Edit Service', 'neobrutheme' ),
			'view_item'          => __( 'View Service', 'neobrutheme' ),
			'all_items'          => __( 'All Services', 'neobrutheme' ),
			'search_items'       => __( 'Search Services', 'neobrutheme' ),
			'not_found'          => __( 'No services found.', 'neobrutheme' ),
			'not_found_in_trash' => __( 'No services found in Trash.', 'neobrutheme' ),
		),
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-megaphone',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'rewrite'      => array( 'slug' => 'services' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'neobrutheme_register_post_types' );
