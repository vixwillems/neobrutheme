<?php
/**
 * ACF must-use plugin loader.
 *
 * Checks if ACF is available in mu-plugins/acf/ and loads it.
 * Shows an admin notice if ACF is not found.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$acf_path = WPMU_PLUGIN_DIR . '/acf/acf.php';

if ( file_exists( $acf_path ) ) {
	require_once $acf_path;
} else {
	add_action( 'admin_notices', function () {
		echo '<div class="notice notice-error"><p>';
		echo '<strong>Neobrutheme:</strong> Advanced Custom Fields plugin not found. ';
		echo 'Please ensure <code>mu-plugins/acf/</code> exists and contains ACF.';
		echo '</p></div>';
	} );
}
