<?php
/**
 * Custom REST API endpoints for setting ACF data.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom REST routes.
 */
function neobrutheme_register_rest_routes() {
	register_rest_route( 'neobrutheme/v1', '/set-acf-meta', array(
		'methods'             => 'POST',
		'callback'            => 'neobrutheme_set_acf_meta',
		'permission_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
		'args'                => array(
			'post_id' => array(
				'required'          => true,
				'sanitize_callback' => 'absint',
			),
			'meta_key' => array(
				'required'          => true,
				'sanitize_callback' => 'sanitize_text_field',
			),
			'meta_value' => array(
				'required' => true,
			),
		),
	) );
}
add_action( 'rest_api_init', 'neobrutheme_register_rest_routes' );

/**
 * Set ACF meta data for a post.
 *
 * @param WP_REST_Request $request Request object.
 * @return WP_REST_Response
 */
function neobrutheme_set_acf_meta( $request ) {
	$post_id    = $request->get_param( 'post_id' );
	$meta_key   = $request->get_param( 'meta_key' );
	$meta_value = $request->get_param( 'meta_value' );

	$post = get_post( $post_id );
	if ( ! $post ) {
		return new WP_REST_Response( array( 'error' => 'Post not found' ), 404 );
	}

	$result = update_post_meta( $post_id, $meta_key, $meta_value );

	if ( $result === false ) {
		return new WP_REST_Response( array( 'error' => 'Failed to update meta' ), 500 );
	}

	return new WP_REST_Response( array(
		'success' => true,
		'post_id' => $post_id,
		'meta_key' => $meta_key,
	), 200 );
}

/**
 * Register custom REST route for setting ACF options.
 */
function neobrutheme_register_acf_options_route() {
	register_rest_route( 'neobrutheme/v1', '/set-acf-option', array(
		'methods'             => 'POST',
		'callback'            => 'neobrutheme_set_acf_option',
		'permission_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
		'args'                => array(
			'option_name' => array(
				'required'          => true,
				'sanitize_callback' => 'sanitize_text_field',
			),
			'option_value' => array(
				'required' => true,
			),
		),
	) );
}
add_action( 'rest_api_init', 'neobrutheme_register_acf_options_route' );

/**
 * Set ACF option value.
 *
 * @param WP_REST_Request $request Request object.
 * @return WP_REST_Response
 */
function neobrutheme_set_acf_option( $request ) {
	$option_name  = $request->get_param( 'option_name' );
	$option_value = $request->get_param( 'option_value' );

	$result = update_option( $option_name, $option_value );

	if ( $result === false ) {
		return new WP_REST_Response( array( 'error' => 'Failed to update option' ), 500 );
	}

	return new WP_REST_Response( array(
		'success'      => true,
		'option_name'  => $option_name,
	), 200 );
}
