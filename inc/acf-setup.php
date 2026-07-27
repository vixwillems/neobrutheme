<?php
/**
 * ACF integration: JSON sync, options pages, field group registration.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF local JSON path for version-controlled field groups.
 */
function neobrutheme_acf_json_save_point( $path ) {
	return NEOBRUTEME_DIR . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'neobrutheme_acf_json_save_point' );

function neobrutheme_acf_json_load_point( $paths ) {
	$paths[] = NEOBRUTEME_DIR . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'neobrutheme_acf_json_load_point' );

/**
 * Get the Settings page ID (the page using template-settings.php).
 * Used by color-settings.php and footer.php to read global settings.
 */
function neobrutheme_get_settings_page_id() {
	static $page_id = null;
	if ( $page_id !== null ) {
		return $page_id ?: 0;
	}
	$pages = get_posts( array(
		'post_type'   => 'page',
		'meta_key'    => '_wp_page_template',
		'meta_value'  => 'template-settings.php',
		'post_status' => 'private,publish',
		'numberposts' => 1,
		'fields'      => 'ids',
	) );
	$page_id = ! empty( $pages ) ? $pages[0] : 0;
	return $page_id;
}

/**
 * Register field groups programmatically (fallback if JSON not loaded).
 */
function neobrutheme_register_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Only register programmatically if JSON files don't exist.
	if ( file_exists( NEOBRUTEME_DIR . '/acf-json/group-options-general.json' ) ) {
		return;
	}

	// ── General Options ──
	acf_add_local_field_group( array(
		'key'      => 'group_options_general',
		'title'    => 'General Settings',
		'fields'   => array(
			array(
				'key'          => 'field_site_tagline',
				'label'        => 'Site Tagline',
				'name'         => 'site_tagline',
				'type'         => 'text',
				'instructions' => 'Displayed below the site title.',
			),
			array(
				'key'          => 'field_social_links',
				'label'        => 'Social Links',
				'name'         => 'social_links',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add Link',
				'sub_fields'   => array(
					array(
						'key'   => 'field_social_link_url',
						'label' => 'URL',
						'name'  => 'url',
						'type'  => 'url',
					),
					array(
						'key'   => 'field_social_link_label',
						'label' => 'Label',
						'name'  => 'label',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'          => 'field_footer_text',
				'label'        => 'Footer Text',
				'name'         => 'footer_text',
				'type'         => 'textarea',
				'rows'         => 3,
			),
			array(
				'key'          => 'field_google_analytics_id',
				'label'        => 'Google Analytics ID',
				'name'         => 'google_analytics_id',
				'type'         => 'text',
				'instructions' => 'Optional. e.g. G-XXXXXXXXXX',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'template-settings.php',
				),
			),
		),
	) );

	// ── Color Options ──
	acf_add_local_field_group( array(
		'key'    => 'group_options_colors',
		'title'  => 'Color Settings',
		'fields' => array(
			array(
				'key'   => 'field_color_bg',
				'label' => 'Background Color',
				'name'  => 'color_bg',
				'type'  => 'color_picker',
				'default_value' => '#FFFFFF',
			),
			array(
				'key'   => 'field_color_fg',
				'label' => 'Foreground Color',
				'name'  => 'color_fg',
				'type'  => 'color_picker',
				'default_value' => '#000000',
			),
			array(
				'key'   => 'field_color_red',
				'label' => 'Accent Red',
				'name'  => 'color_red',
				'type'  => 'color_picker',
				'default_value' => '#FF5C5C',
			),
			array(
				'key'   => 'field_color_yellow',
				'label' => 'Secondary Yellow',
				'name'  => 'color_yellow',
				'type'  => 'color_picker',
				'default_value' => '#FFDE59',
			),
			array(
				'key'   => 'field_color_cyan',
				'label' => 'Accent Cyan',
				'name'  => 'color_cyan',
				'type'  => 'color_picker',
				'default_value' => '#5CE1E6',
			),
			array(
				'key'   => 'field_color_white',
				'label' => 'White',
				'name'  => 'color_white',
				'type'  => 'color_picker',
				'default_value' => '#FFFFFF',
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'template-settings.php',
				),
			),
		),
	) );

	// ── Homepage Layout (Flexible Content) ──
	acf_add_local_field_group( array(
		'key'    => 'group_options_homepage',
		'title'  => 'Homepage Layout',
		'fields' => array(
			array(
				'key'          => 'field_page_layouts',
				'label'        => 'Page Layouts',
				'name'         => 'page_layouts',
				'type'         => 'flexible_content',
				'button_label' => 'Add Layout',
				'layouts'      => array(
					// Hero.
					array(
						'key'          => 'layout_hero',
						'name'         => 'hero',
						'title'        => 'Hero',
						'display'      => 'block',
						'sub_fields'   => array(
							array( 'key' => 'field_hero_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_hero_subheading', 'label' => 'Subheading', 'name' => 'subheading', 'type' => 'textarea', 'rows' => 2 ),
							array(
								'key'           => 'field_hero_bg_color',
								'label'         => 'Background Color',
								'name'          => 'bg_color',
								'type'          => 'select',
								'choices'       => array( 'red' => 'Red', 'yellow' => 'Yellow', 'cyan' => 'Cyan', 'white' => 'White' ),
								'default_value' => 'cyan',
							),
							array(
								'key'           => 'field_hero_show_composition',
								'label'         => 'Show Composition Panel',
								'name'          => 'show_composition',
								'type'          => 'true_false',
								'default_value' => 1,
							),
						),
					),
					// Marquee.
					array(
						'key'        => 'layout_marquee',
						'name'       => 'marquee',
						'title'      => 'Marquee',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_marquee_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ),
							array(
								'key'           => 'field_marquee_speed',
								'label'         => 'Speed',
								'name'          => 'speed',
								'type'          => 'select',
								'choices'       => array( 'slow' => 'Slow', 'medium' => 'Medium', 'fast' => 'Fast' ),
								'default_value' => 'medium',
							),
							array(
								'key'           => 'field_marquee_color',
								'label'         => 'Color',
								'name'          => 'color',
								'type'          => 'select',
								'choices'       => array( 'red' => 'Red', 'cyan' => 'Cyan', 'yellow' => 'Yellow' ),
								'default_value' => 'yellow',
							),
						),
					),
					// Stat Cards.
					array(
						'key'        => 'layout_stat_cards',
						'name'       => 'stat_cards',
						'title'      => 'Stat Cards',
						'display'    => 'block',
						'sub_fields' => array(
							array(
								'key'          => 'field_stats',
								'label'        => 'Stats',
								'name'         => 'stats',
								'type'         => 'repeater',
								'layout'       => 'table',
								'button_label' => 'Add Stat',
								'sub_fields'   => array(
									array( 'key' => 'field_stat_number', 'label' => 'Number', 'name' => 'number', 'type' => 'number' ),
									array( 'key' => 'field_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
									array(
										'key'           => 'field_stat_color',
										'label'         => 'Color',
										'name'          => 'color',
										'type'          => 'select',
										'choices'       => array( 'red' => 'Red', 'yellow' => 'Yellow', 'cyan' => 'Cyan' ),
										'default_value' => 'yellow',
									),
									array(
										'key'           => 'field_stat_shape',
										'label'         => 'Shape',
										'name'          => 'shape',
										'type'          => 'select',
										'choices'       => array( 'default' => 'Square', 'circle' => 'Circle', 'diamond' => 'Diamond' ),
										'default_value' => 'default',
									),
								),
							),
						),
					),
					// Content Grid.
					array(
						'key'        => 'layout_content_grid',
						'name'       => 'content_grid',
						'title'      => 'Content Grid',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_grid_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array(
								'key'           => 'field_grid_post_type',
								'label'         => 'Post Type',
								'name'          => 'post_type',
								'type'          => 'select',
								'choices'       => array( 'post' => 'Blog Posts', 'portfolio' => 'Portfolio', 'team' => 'Team', 'service' => 'Services' ),
								'default_value' => 'post',
							),
							array( 'key' => 'field_grid_count', 'label' => 'Number of Items', 'name' => 'count', 'type' => 'number', 'default_value' => 6 ),
							array(
								'key'           => 'field_grid_columns',
								'label'         => 'Columns',
								'name'          => 'columns',
								'type'          => 'select',
								'choices'       => array( '2' => '2', '3' => '3', '4' => '4' ),
								'default_value' => '3',
							),
						),
					),
					// Team Grid.
					array(
						'key'        => 'layout_team_grid',
						'name'       => 'team_grid',
						'title'      => 'Team Grid',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_team_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_team_count', 'label' => 'Number of Members', 'name' => 'count', 'type' => 'number', 'default_value' => 6 ),
						),
					),
					// Services.
					array(
						'key'        => 'layout_services',
						'name'       => 'services',
						'title'      => 'Services',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_services_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array(
								'key'           => 'field_services_style',
								'label'         => 'Style',
								'name'          => 'style',
								'type'          => 'select',
								'choices'       => array( 'grid' => 'Grid', 'list' => 'List' ),
								'default_value' => 'grid',
							),
						),
					),
					// Text + Image.
					array(
						'key'        => 'layout_text_image',
						'name'       => 'text_image',
						'title'      => 'Text + Image',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_ti_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_ti_content', 'label' => 'Content', 'name' => 'content', 'type' => 'wysiwyg', 'tabs' => 'visual' ),
							array( 'key' => 'field_ti_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array' ),
							array(
								'key'           => 'field_ti_alignment',
								'label'         => 'Image Alignment',
								'name'          => 'alignment',
								'type'          => 'select',
								'choices'       => array( 'left' => 'Left', 'right' => 'Right' ),
								'default_value' => 'right',
							),
						),
					),
					// Testimonials.
					array(
						'key'        => 'layout_testimonials',
						'name'       => 'testimonials',
						'title'      => 'Testimonials',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_test_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array(
								'key'          => 'field_testimonials',
								'label'        => 'Testimonials',
								'name'         => 'testimonials',
								'type'         => 'repeater',
								'layout'       => 'block',
								'button_label' => 'Add Testimonial',
								'sub_fields'   => array(
									array( 'key' => 'field_test_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 3 ),
									array( 'key' => 'field_test_author', 'label' => 'Author', 'name' => 'author', 'type' => 'text' ),
									array( 'key' => 'field_test_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text' ),
								),
							),
						),
					),
					// CTA.
					array(
						'key'        => 'layout_cta',
						'name'       => 'cta',
						'title'      => 'Call to Action',
						'display'    => 'block',
						'sub_fields' => array(
							array( 'key' => 'field_cta_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text' ),
							array( 'key' => 'field_cta_button_text', 'label' => 'Button Text', 'name' => 'button_text', 'type' => 'text' ),
							array( 'key' => 'field_cta_button_url', 'label' => 'Button URL', 'name' => 'button_url', 'type' => 'url' ),
							array(
								'key'           => 'field_cta_color',
								'label'         => 'Background Color',
								'name'          => 'color',
								'type'          => 'select',
								'choices'       => array( 'red' => 'Red', 'yellow' => 'Yellow', 'cyan' => 'Cyan' ),
								'default_value' => 'red',
							),
						),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
		),
	) );

	// ── Portfolio Item ──
	acf_add_local_field_group( array(
		'key'    => 'group_portfolio',
		'title'  => 'Portfolio Details',
		'fields' => array(
			array( 'key' => 'field_portfolio_client', 'label' => 'Client Name', 'name' => 'client_name', 'type' => 'text' ),
			array( 'key' => 'field_portfolio_date', 'label' => 'Project Date', 'name' => 'project_date', 'type' => 'date_picker', 'display_format' => 'dd/mm/yy', 'return_format' => 'Y-m-d' ),
			array( 'key' => 'field_portfolio_url', 'label' => 'Project URL', 'name' => 'project_url', 'type' => 'url' ),
			array(
				'key'          => 'field_portfolio_tech',
				'label'        => 'Technologies',
				'name'         => 'technologies',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add Technology',
				'sub_fields'   => array(
					array( 'key' => 'field_tech_name', 'label' => 'Technology', 'name' => 'name', 'type' => 'text' ),
				),
			),
			array( 'key' => 'field_portfolio_featured', 'label' => 'Featured', 'name' => 'is_featured', 'type' => 'true_false' ),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'portfolio',
				),
			),
		),
	) );

	// ── Team Member ──
	acf_add_local_field_group( array(
		'key'    => 'group_team',
		'title'  => 'Team Member Details',
		'fields' => array(
			array( 'key' => 'field_team_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text' ),
			array( 'key' => 'field_team_bio', 'label' => 'Bio', 'name' => 'bio', 'type' => 'textarea', 'rows' => 4 ),
			array( 'key' => 'field_team_email', 'label' => 'Email', 'name' => 'email', 'type' => 'email' ),
			array(
				'key'          => 'field_team_social',
				'label'        => 'Social Links',
				'name'         => 'social_links',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add Link',
				'sub_fields'   => array(
					array( 'key' => 'field_team_social_url', 'label' => 'URL', 'name' => 'url', 'type' => 'url' ),
					array( 'key' => 'field_team_social_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'team',
				),
			),
		),
	) );

	// ── Service ──
	acf_add_local_field_group( array(
		'key'    => 'group_service',
		'title'  => 'Service Details',
		'fields' => array(
			array( 'key' => 'field_service_icon', 'label' => 'Icon (emoji or class)', 'name' => 'service_icon', 'type' => 'text' ),
			array( 'key' => 'field_service_short', 'label' => 'Short Description', 'name' => 'short_description', 'type' => 'textarea', 'rows' => 3 ),
			array( 'key' => 'field_service_price', 'label' => 'Price Range', 'name' => 'price_range', 'type' => 'text' ),
			array( 'key' => 'field_service_featured', 'label' => 'Featured', 'name' => 'is_featured', 'type' => 'true_false' ),
		),
		'location' => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'service',
				),
			),
		),
	) );
}
add_action( 'acf/init', 'neobrutheme_register_field_groups' );
