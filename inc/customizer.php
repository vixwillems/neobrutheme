<?php
/**
 * WordPress Customizer settings.
 *
 * Comprehensive theme customization via Appearance > Customize.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function neobrutheme_customize_register( $wp_customize ) {

	// ═══════════════════════════════════════════════
	// Panel: Neobrutheme Settings
	// ═══════════════════════════════════════════════
	$wp_customize->add_panel( 'neobrutheme_panel', array(
		'title'    => 'Neobrutheme Settings',
		'priority' => 30,
	) );

	// ── Section: Theme Colors ──
	$wp_customize->add_section( 'neobrutheme_colors', array(
		'title' => 'Theme Colors',
		'panel' => 'neobrutheme_panel',
	) );

	$colors = array(
		'bg'      => array( 'label' => 'Background Color', 'default' => '#FFFFFF' ),
		'fg'      => array( 'label' => 'Foreground Color', 'default' => '#000000' ),
		'red'     => array( 'label' => 'Accent Red', 'default' => '#FF5C5C' ),
		'yellow'  => array( 'label' => 'Secondary Yellow', 'default' => '#FFDE59' ),
		'cyan'    => array( 'label' => 'Accent Cyan', 'default' => '#5CE1E6' ),
		'white'   => array( 'label' => 'White', 'default' => '#FFFFFF' ),
	);

	foreach ( $colors as $id => $args ) {
		$wp_customize->add_setting( 'neobrutheme_color_' . $id, array(
			'default'           => $args['default'],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'neobrutheme_color_' . $id, array(
			'label'   => $args['label'],
			'section' => 'neobrutheme_colors',
		) ) );
	}

	// ── Section: Header & Navigation ──
	$wp_customize->add_section( 'neobrutheme_header', array(
		'title' => 'Header & Navigation',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_header_sticky', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'neobrutheme_header_sticky', array(
		'label'   => 'Sticky Header',
		'section' => 'neobrutheme_header',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'neobrutheme_header_bg_color', array(
		'default'           => 'bg',
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->add_control( 'neobrutheme_header_bg_color', array(
		'label'   => 'Header Background',
		'section' => 'neobrutheme_header',
		'type'    => 'select',
		'choices' => array(
			'bg'      => 'Background',
			'yellow'  => 'Yellow',
			'cyan'    => 'Cyan',
			'red'     => 'Red',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_header_border_width', array(
		'default'           => '8px',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_header_border_width', array(
		'label'   => 'Header Border Width',
		'section' => 'neobrutheme_header',
		'type'    => 'select',
		'choices' => array(
			'4px'  => '4px',
			'8px'  => '8px',
			'12px' => '12px',
		),
	) );

	// ── Section: Footer ──
	$wp_customize->add_section( 'neobrutheme_footer', array(
		'title' => 'Footer',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_footer_bg_color', array(
		'default'           => 'fg',
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->add_control( 'neobrutheme_footer_bg_color', array(
		'label'   => 'Footer Background',
		'section' => 'neobrutheme_footer',
		'type'    => 'select',
		'choices' => array(
			'fg'     => 'Foreground (Black)',
			'red'    => 'Red',
			'cyan'   => 'Cyan',
			'yellow' => 'Yellow',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_footer_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'neobrutheme_footer_text', array(
		'label'   => 'Footer Text',
		'section' => 'neobrutheme_footer',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'neobrutheme_footer_show_social', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'neobrutheme_footer_show_social', array(
		'label'   => 'Show Social Links',
		'section' => 'neobrutheme_footer',
		'type'    => 'checkbox',
	) );

	// ── Section: Typography ──
	$wp_customize->add_section( 'neobrutheme_typography', array(
		'title' => 'Typography',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_body_font_weight', array(
		'default'           => '400',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_body_font_weight', array(
		'label'   => 'Body Font Weight',
		'section' => 'neobrutheme_typography',
		'type'    => 'select',
		'choices' => array(
			'400' => 'Regular (400)',
			'500' => 'Medium (500)',
			'700' => 'Bold (700)',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_heading_font_weight', array(
		'default'           => '900',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_heading_font_weight', array(
		'label'   => 'Heading Font Weight',
		'section' => 'neobrutheme_typography',
		'type'    => 'select',
		'choices' => array(
			'700' => 'Bold (700)',
			'900' => 'Black (900)',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_heading_letter_spacing', array(
		'default'           => '-0.05em',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_heading_letter_spacing', array(
		'label'   => 'Heading Letter Spacing',
		'section' => 'neobrutheme_typography',
		'type'    => 'select',
		'choices' => array(
			'-0.08em' => 'Tight (-0.08em)',
			'-0.05em' => 'Default (-0.05em)',
			'-0.03em' => 'Loose (-0.03em)',
			'0'       => 'None (0)',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_line_height', array(
		'default'           => '1.6',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_line_height', array(
		'label'   => 'Body Line Height',
		'section' => 'neobrutheme_typography',
		'type'    => 'select',
		'choices' => array(
			'1.4' => 'Tight (1.4)',
			'1.6' => 'Default (1.6)',
			'1.8' => 'Loose (1.8)',
		),
	) );

	// ── Section: Buttons ──
	$wp_customize->add_section( 'neobrutheme_buttons', array(
		'title' => 'Buttons',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_btn_border_width', array(
		'default'           => '4px',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_btn_border_width', array(
		'label'   => 'Button Border Width',
		'section' => 'neobrutheme_buttons',
		'type'    => 'select',
		'choices' => array(
			'2px'  => '2px',
			'4px'  => '4px',
			'8px'  => '8px',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_btn_shadow_size', array(
		'default'           => '8px',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_btn_shadow_size', array(
		'label'   => 'Button Shadow Size',
		'section' => 'neobrutheme_buttons',
		'type'    => 'select',
		'choices' => array(
			'4px'  => '4px',
			'8px'  => '8px',
			'12px' => '12px',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_btn_text_transform', array(
		'default'           => 'uppercase',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_btn_text_transform', array(
		'label'   => 'Button Text Transform',
		'section' => 'neobrutheme_buttons',
		'type'    => 'select',
		'choices' => array(
			'uppercase' => 'Uppercase',
			'none'      => 'None',
		),
	) );

	// ── Section: Cards ──
	$wp_customize->add_section( 'neobrutheme_cards', array(
		'title' => 'Cards',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_card_border_width', array(
		'default'           => '4px',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_card_border_width', array(
		'label'   => 'Card Border Width',
		'section' => 'neobrutheme_cards',
		'type'    => 'select',
		'choices' => array(
			'2px'  => '2px',
			'4px'  => '4px',
			'8px'  => '8px',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_card_shadow_size', array(
		'default'           => '8px',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_card_shadow_size', array(
		'label'   => 'Card Shadow Size',
		'section' => 'neobrutheme_cards',
		'type'    => 'select',
		'choices' => array(
			'4px'  => '4px',
			'8px'  => '8px',
			'12px' => '12px',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_card_accent_color', array(
		'default'           => 'cyan',
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->add_control( 'neobrutheme_card_accent_color', array(
		'label'   => 'Card Accent Color',
		'section' => 'neobrutheme_cards',
		'type'    => 'select',
		'choices' => array(
			'cyan'   => 'Cyan',
			'red'    => 'Red',
			'yellow' => 'Yellow',
		),
	) );

	// ── Section: Layout ──
	$wp_customize->add_section( 'neobrutheme_layout', array(
		'title' => 'Layout',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_content_max_width', array(
		'default'           => '1200px',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_content_max_width', array(
		'label'   => 'Max Content Width',
		'section' => 'neobrutheme_layout',
		'type'    => 'select',
		'choices' => array(
			'960px'  => '960px (Narrow)',
			'1200px' => '1200px (Default)',
			'1400px' => '1400px (Wide)',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_archive_grid_columns', array(
		'default'           => '2',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_archive_grid_columns', array(
		'label'   => 'Archive Grid Columns',
		'section' => 'neobrutheme_layout',
		'type'    => 'select',
		'choices' => array(
			'1' => '1 Column',
			'2' => '2 Columns',
			'3' => '3 Columns',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_body_pattern', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'neobrutheme_body_pattern', array(
		'label'   => 'Show Body Background Pattern',
		'section' => 'neobrutheme_layout',
		'type'    => 'checkbox',
	) );

	// ── Section: General ──
	$wp_customize->add_section( 'neobrutheme_general', array(
		'title' => 'General',
		'panel' => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_site_tagline', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_site_tagline', array(
		'label'   => 'Site Tagline',
		'section' => 'neobrutheme_general',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'neobrutheme_google_analytics_id', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'neobrutheme_google_analytics_id', array(
		'label'       => 'Google Analytics ID',
		'description' => 'e.g. G-XXXXXXXXXX',
		'section'     => 'neobrutheme_general',
		'type'        => 'text',
	) );

	// ═══════════════════════════════════════════════
	// Section: Hero Defaults (per-page override via ACF)
	// ═══════════════════════════════════════════════
	$wp_customize->add_section( 'neobrutheme_hero', array(
		'title'       => 'Hero Defaults',
		'description' => 'Default hero settings. Override per-page via ACF fields.',
		'panel'       => 'neobrutheme_panel',
	) );

	$wp_customize->add_setting( 'neobrutheme_hero_bg_color', array(
		'default'           => 'cyan',
		'sanitize_callback' => 'sanitize_key',
	) );
	$wp_customize->add_control( 'neobrutheme_hero_bg_color', array(
		'label'   => 'Hero Background Color',
		'section' => 'neobrutheme_hero',
		'type'    => 'select',
		'choices' => array(
			'cyan'   => 'Cyan',
			'yellow' => 'Yellow',
			'red'    => 'Red',
		),
	) );

	$wp_customize->add_setting( 'neobrutheme_hero_show_composition', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'neobrutheme_hero_show_composition', array(
		'label'   => 'Show Composition Panel',
		'section' => 'neobrutheme_hero',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'neobrutheme_hero_title_stroke', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'neobrutheme_hero_title_stroke', array(
		'label'   => 'Use Text Stroke on Title',
		'section' => 'neobrutheme_hero',
		'type'    => 'checkbox',
	) );
}
add_action( 'customize_register', 'neobrutheme_customize_register' );

/**
 * Output Customizer preview JS.
 */
function neobrutheme_customize_preview_js() {
	wp_enqueue_script( 'neobrutheme-customizer-preview', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'neobrutheme_customize_preview_js' );
