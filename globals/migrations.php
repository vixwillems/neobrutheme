<?php
/**
 * Migration methods for theme mods.
 *
 * @package migrations.php
 */

use Neve\Core\Migration_Flags;

/**
 * Get button default appearance.
 *
 * @param string $button the button type [button|secondary_button].
 *
 * @return array
 */
function neve_get_button_appearance_default( $button = 'button' ) {
	if ( $button !== 'button' ) {
		return [
			'type'                  => 'outline',
			'background'            => '',
			'backgroundHover'       => '',
			'text'                  => 'var(--nv-text-color)',
			'textHover'             => 'var(--nv-text-color)',
			'borderRadius'          => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 0,
			],
			'borderWidth'           => [
				'top'    => 4,
				'right'  => 4,
				'bottom' => 4,
				'left'   => 4,
			],
			'useShadow'             => true,
			'shadowColor'           => 'var(--nv-text-color)',
			'shadowProperties'      => [
				'blur'   => 0,
				'width'  => 4,
				'height' => 4,
			],
			'useShadowHover'        => true,
			'shadowColorHover'      => 'var(--nv-text-color)',
			'shadowPropertiesHover' => [
				'blur'   => 0,
				'width'  => 8,
				'height' => 8,
			],
		];
	}

	return [
		'type'                  => 'fill',
		'background'            => 'var(--nv-primary-accent)',
		'backgroundHover'       => 'var(--nv-primary-accent)',
		'text'                  => '#fff',
		'textHover'             => '#fff',
		'borderRadius'          => [
			'top'    => 0,
			'right'  => 0,
			'bottom' => 0,
			'left'   => 0,
		],
		'borderWidth'           => [
			'top'    => 4,
			'right'  => 4,
			'bottom' => 4,
			'left'   => 4,
		],
		'useShadow'             => true,
		'shadowColor'           => 'var(--nv-text-color)',
		'shadowProperties'      => [
			'blur'   => 0,
			'width'  => 4,
			'height' => 4,
		],
		'useShadowHover'        => true,
		'shadowColorHover'      => 'var(--nv-text-color)',
		'shadowPropertiesHover' => [
			'blur'   => 0,
			'width'  => 8,
			'height' => 8,
		],
	];
}

/**
 * Migrate the old value for the blog layout to the new values.
 */
function neve_migrate_blog_layout() {
	// Layout Setting
	$old_value = get_theme_mod( 'neve_blog_archive_layout' );
	if ( $old_value !== 'alternative' ) {
		return;
	}

	set_theme_mod( 'neve_blog_archive_layout', 'default' );
	set_theme_mod( 'neve_blog_list_alternative_layout', true );
}

/**
 * Migrate blog columns.
 */
function neve_migrate_blog_columns() {
	// Column Setting - Previously mobile was forced to 1.
	$old = get_theme_mod( 'neve_grid_layout' );
	if ( ! is_numeric( $old ) ) {
		return;
	}
	set_theme_mod(
		'neve_grid_layout',
		wp_json_encode(
			array(
				'desktop' => $old,
				'tablet'  => $old,
				'mobile'  => 1,
			)
		)
	);
}

/**
 * Run flag migrations.
 *
 * @return void
 */
function neve_run_migration_flags() {
	$migrator = new Migration_Flags( NEVE_VERSION );
	$migrator->run();
}

add_action( 'init', 'neve_migrate_blog_layout' );
add_action( 'init', 'neve_migrate_blog_columns' );
add_action( 'init', 'neve_run_migration_flags', PHP_INT_MIN );
