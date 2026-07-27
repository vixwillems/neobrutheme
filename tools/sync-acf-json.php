<?php
/**
 * Sync ACF JSON field groups to the database.
 * Run via: wp eval-file tools/sync-acf-json.php --path=/path/to/wp
 */

if ( ! function_exists( 'acf_get_field_groups' ) ) {
	echo "ACF not active.\n";
	exit( 1 );
}

$json_dir = get_template_directory() . '/acf-json/';
$files    = glob( $json_dir . '*.json' );

if ( empty( $files ) ) {
	echo "No JSON files found in {$json_dir}\n";
	exit( 1 );
}

$synced = 0;
$skipped = 0;

foreach ( $files as $file ) {
	$json = json_decode( file_get_contents( $file ), true );
	if ( ! $json || empty( $json['key'] ) ) {
		echo "  SKIP: {$file} (invalid JSON)\n";
		$skipped++;
		continue;
	}

	// Check if field group already exists in database.
	$existing = acf_get_field_group( $json['key'] );

	if ( $existing && ! empty( $existing['ID'] ) ) {
		echo "  EXISTS: {$json['title']} (ID: {$existing['ID']})\n";
		$skipped++;
		continue;
	}

	// Import the field group.
	$json['fields'] = acf_prepare_fields_for_import( $json['fields'] ?? array() );
	$id = acf_import_field_group( $json );

	if ( $id ) {
		echo "  SYNCED: {$json['title']} (ID: {$id})\n";
		$synced++;
	} else {
		echo "  FAILED: {$json['title']}\n";
	}
}

echo "\nDone! Synced: {$synced}, Skipped: {$skipped}\n";
echo "Field groups should now appear under ACF > Field Groups.\n";
