<?php
/**
 * ACF data setup — creates Settings page and populates ACF fields.
 * Run via: wp eval-file tools/setup-acf-data.php --path=/path/to/wp
 */

$page_id = get_option('page_on_front');
echo "Front page ID: {$page_id}\n";

// ── 1. Create Settings page (if it doesn't exist) ──
$existing = get_posts(array(
    'post_type'   => 'page',
    'meta_key'    => '_wp_page_template',
    'meta_value'  => 'template-settings.php',
    'numberposts' => 1,
    'fields'      => 'ids',
));

if (!empty($existing)) {
    $settings_id = $existing[0];
    echo "Settings page already exists (ID: {$settings_id})\n";
} else {
    $settings_id = wp_insert_post(array(
        'post_title'   => 'Theme Settings',
        'post_status'  => 'private',
        'post_type'    => 'page',
        'post_content' => '',
    ));
    update_post_meta($settings_id, '_wp_page_template', 'template-settings.php');
    echo "Created Settings page (ID: {$settings_id})\n";
}

// ── 2. Set color values on Settings page ──
$colors = array(
    'color_bg'     => '#FFFFFF',
    'color_fg'     => '#000000',
    'color_red'    => '#FF5C5C',
    'color_yellow' => '#FFDE59',
    'color_cyan'   => '#5CE1E6',
    'color_white'  => '#FFFFFF',
);

foreach ($colors as $field => $value) {
    update_field($field, $value, $settings_id);
}
echo "Colors set on Settings page\n";

// ── 3. Set homepage layouts on front page ──
// ACF Flexible Content: sub-fields keyed by field keys (field_hero_heading etc.)
$layouts = array(
    array(
        'acf_fc_layout'                => 'hero',
        'field_hero_heading'           => 'Neo-brutalist web design for creative studios.',
        'field_hero_subheading'        => 'Bold. Crisp. Unapologetically digital.',
        'field_hero_bg_color'          => 'cyan',
        'field_hero_show_composition'  => '1',
    ),
    array(
        'acf_fc_layout'       => 'marquee',
        'field_marquee_text'  => 'Design / Development / Strategy / Branding / ',
        'field_marquee_speed' => 'medium',
        'field_marquee_color' => 'yellow',
    ),
    array(
        'acf_fc_layout' => 'stat_cards',
        'field_stats'   => array(
            array('field_stat_number' => '140', 'field_stat_label' => 'Projects shipped', 'field_stat_color' => 'yellow', 'field_stat_shape' => 'default'),
            array('field_stat_number' => '60',  'field_stat_label' => 'Happy clients',   'field_stat_color' => 'red',    'field_stat_shape' => 'circle'),
            array('field_stat_number' => '4200','field_stat_label' => 'Coffees consumed', 'field_stat_color' => 'cyan',   'field_stat_shape' => 'diamond'),
        ),
    ),
    array(
        'acf_fc_layout'        => 'content_grid',
        'field_grid_heading'   => 'Latest work',
        'field_grid_post_type' => 'portfolio',
        'field_grid_count'     => 3,
        'field_grid_columns'   => '3',
    ),
    array(
        'acf_fc_layout'          => 'services',
        'field_services_heading' => 'What we do',
        'field_services_style'   => 'grid',
    ),
    array(
        'acf_fc_layout'      => 'testimonials',
        'field_test_heading' => 'Kind words',
        'field_testimonials' => array(
            array('field_test_quote' => 'They delivered exactly the kind of site that makes people stop scrolling.', 'field_test_author' => 'Alex R', 'field_test_role' => 'Studio Mono'),
            array('field_test_quote' => 'Fast, brutal, beautiful. Could not ask for more.', 'field_test_author' => 'Jamie K', 'field_test_role' => 'Formwork Co'),
        ),
    ),
    array(
        'acf_fc_layout'         => 'cta',
        'field_cta_heading'     => 'Let us build something bold.',
        'field_cta_button_text' => 'Start a project',
        'field_cta_button_url'  => '/about/',
        'field_cta_color'       => 'red',
    ),
);

update_field('page_layouts', $layouts, $page_id);
echo "Homepage layouts set on front page (ID: {$page_id})\n";

// ── 4. Verify ──
echo "\n=== Verification ===\n";
$v = get_field('page_layouts', $page_id);
echo "get_field type: " . gettype($v) . "\n";
if (is_array($v)) {
    echo "Layout count: " . count($v) . "\n";
    echo "First layout: " . $v[0]['acf_fc_layout'] . "\n";
}
$c = get_field('color_cyan', $settings_id);
echo "Color cyan: " . ($c ?: 'EMPTY') . "\n";

echo "\nDone! Visit the site to see the changes.\n";
