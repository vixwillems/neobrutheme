<?php
/**
 * Import sample homepage with all 9 Flexible Content layouts.
 *
 * Usage (WP-CLI):
 *   wp eval-file tools/import-demo.php
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper: set an ACF option value (creates option if missing via update_option).
 */
function neo_set_option( $name, $value ) {
	update_option( $name, $value );
}

/**
 * Helper: create or find a page by slug.
 */
function neo_get_or_create_page( $slug, $title, $status = 'publish' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		return $existing->ID;
	}

	return wp_insert_post( array(
		'post_title'   => $title,
		'slug'         => $slug,
		'post_status'  => $status,
		'post_type'    => 'page',
		'post_content' => '',
	) );
}

/**
 * Build all 9 Flexible Content layouts for the homepage.
 */
function neo_build_demo_layouts() {
	return array(
		// 1 ─ Hero
		array(
			'acf_fc_layout' => 'hero',
			'title'         => 'Neo-brutalist web design for creative studios.',
			'subtitle'      => 'Bold. Crisp. Unapologetically digital.',
		),
		// 2 ─ Marquee
		array(
			'acf_fc_layout' => 'marquee',
			'text'          => 'Design / Development / Strategy / Branding / ',
		),
		// 3 ─ Stat Cards
		array(
			'acf_fc_layout' => 'stat_cards',
			'intro'         => 'We build for impact.',
			'cards'         => array(
				array( 'label' => 'Projects shipped', 'value' => '140' ),
				array( 'label' => 'Happy clients',    'value' => '60' ),
				array( 'label' => 'Coffees consumed', 'value' => '4200' ),
			),
		),
		// 4 ─ Content Grid
		array(
			'acf_fc_layout' => 'content_grid',
			'heading'       => 'Latest work',
			'columns'       => '2',
			'cards'         => array(
				array( 'title' => 'Brutalist portfolio for a type foundry',  'link' => '/portfolio/' ),
				array( 'title' => 'E-commerce redesign for a coffee roaster', 'link' => '/portfolio/' ),
			),
		),
		// 5 ─ Team Grid
		array(
			'acf_fc_layout' => 'team_grid',
			'heading'       => 'The team',
			'subtitle'      => 'Small, focused, relentless.',
		),
		// 6 ─ Services
		array(
			'acf_fc_layout' => 'services',
			'heading'       => 'What we do',
			'subtitle'      => 'End-to-end, from strategy to code.',
		),
		// 7 ─ Text + Image
		array(
			'acf_fc_layout' => 'text_image',
			'heading'       => 'Our approach',
			'text'          => "We believe restraint is a feature. Every pixel earns its place. No decoration for decoration's sake \u2014 only clear hierarchy, honest materials, and purpose.",
			'image'         => 0,
			'layout'        => 'left',
		),
		// 8 ─ Testimonials
		array(
			'acf_fc_layout' => 'testimonials',
			'heading'       => 'Kind words',
			'items'         => array(
				array(
					'quote'  => 'They delivered exactly the kind of site that makes people stop scrolling.',
					'author' => 'Alex R, Studio Mono',
				),
				array(
					'quote'  => 'Fast, brutal, beautiful. Couldn\'t ask for more.',
					'author' => 'Jamie K, Formwork Co',
				),
			),
		),
		// 9 ─ Call to Action
		array(
			'acf_fc_layout' => 'cta',
			'heading'       => 'Let\u2019s build something bold.',
			'button_label'  => 'Start a project',
			'button_url'    => '/contact/',
		),
	);
}

// ─── Run the import ──────────────────────────────────────────────────────────

echo "Importing sample homepage...\n";

// 1. Create the homepage page and set it as front page.
$page_id = neo_get_or_create_page( 'home', 'Home' );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_id );
echo "  Page created (ID {$page_id}) and set as front page.\n";

// 2. Inject Flexible Content layouts via ACF.
update_post_meta( $page_id, 'page_layouts', neo_build_demo_layouts() );
echo "  Flexible Content layouts injected (9 layouts).\n";

// 3. Set sample color options.
neo_set_option( 'color_bg',    '#FFFFFF' );
neo_set_option( 'color_fg',    '#000000' );
neo_set_option( 'color_red',   '#FF5C5C' );
neo_set_option( 'color_yellow','#FFDE59' );
neo_set_option( 'color_cyan',  '#5CE1E6' );
neo_set_option( 'color_white', '#FFFFFF' );
echo "  Color options set (default neo-brutalist palette).\n";

// 4. Create sample Portfolio items.
$portfolio_items = array(
	array( 'title' => 'Mono Type Foundry',       'excerpt' => 'Brutalist portfolio for a type foundry.' ),
	array( 'title' => 'Dawn Coffee Roasters',     'excerpt' => 'E-commerce redesign with zero decoration.' ),
	array( 'title' => 'Studio Mono',              'excerpt' => 'Agency site with geometric shape language.' ),
);

foreach ( $portfolio_items as $item ) {
	$existing = get_page_by_path( sanitize_title( $item['title'] ), OBJECT, 'portfolio' );
	if ( ! $existing ) {
		wp_insert_post( array(
			'post_title'  => $item['title'],
			'slug'        => sanitize_title( $item['title'] ),
			'post_status' => 'publish',
			'post_type'   => 'portfolio',
			'post_excerpt' => $item['excerpt'],
		) );
	}
}
echo "  " . count( $portfolio_items ) . " portfolio items created.\n";

// 5. Create sample Team members.
$team_items = array(
	array( 'title' => 'Vix Willems',   'excerpt' => 'Founder & Creative Director' ),
	array( 'title' => 'Jamie K',       'excerpt' => 'Lead Developer' ),
	array( 'title' => 'Alex R',        'excerpt' => 'Designer' ),
);

foreach ( $team_items as $item ) {
	$existing = get_page_by_path( sanitize_title( $item['title'] ), OBJECT, 'team' );
	if ( ! $existing ) {
		wp_insert_post( array(
			'post_title'   => $item['title'],
			'slug'         => sanitize_title( $item['title'] ),
			'post_status'  => 'publish',
			'post_type'    => 'team',
			'post_excerpt' => $item['excerpt'],
		) );
	}
}
echo "  " . count( $team_items ) . " team members created.\n";

// 6. Create sample Services.
$service_items = array(
	array( 'title' => 'Web Design',    'excerpt' => 'Bespoke neo-brutalist design systems.' ),
	array( 'title' => 'Development',   'excerpt' => 'WordPress, headless, performance-first.' ),
	array( 'title' => 'Strategy',      'excerpt' => 'Brand positioning and digital strategy.' ),
);

foreach ( $service_items as $item ) {
	$existing = get_page_by_path( sanitize_title( $item['title'] ), OBJECT, 'service' );
	if ( ! $existing ) {
		wp_insert_post( array(
			'post_title'   => $item['title'],
			'slug'         => sanitize_title( $item['title'] ),
			'post_status'  => 'publish',
			'post_type'    => 'service',
			'post_excerpt' => $item['excerpt'],
		) );
	}
}
echo "  " . count( $service_items ) . " services created.\n";

echo "\nDone! Visit / to see the sample homepage.\n";
echo "Remember: Settings > Permalinks > Save to flush CPT slugs.\n";
