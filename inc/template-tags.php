<?php
/**
 * Template tags / helper functions.
 *
 * @package Neobrutheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print the post date.
 */
function neobrutheme_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on">' . $time_string . '</span>';
}

/**
 * Print the post author.
 */
function neobrutheme_posted_by() {
	printf(
		'<span class="byline">by <span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() )
	);
}

/**
 * Print the entry footer (categories, tags).
 */
function neobrutheme_entry_footer() {
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( esc_html__( ', ', 'neobrutheme' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links">%1$s %2$s</span>', esc_html__( 'In', 'neobrutheme' ), $categories_list );
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'neobrutheme' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">%1$s %2$s</span>', esc_html__( 'Tagged', 'neobrutheme' ), $tags_list );
		}
	}

	edit_post_link(
		sprintf(
			wp_kses( __( 'Edit <span class="sr-only">%s</span>', 'neobrutheme' ), array( 'span' => array( 'class' => array() ) ) ),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Return a random rotation class for sticker badges.
 *
 * @return string Tailwind rotation class.
 */
function neobrutheme_badge_rotation() {
	$rotations = array( 'rotate-[-3deg]', 'rotate-[2deg]', '-rotate-2', 'rotate-3', 'rotate-1', '-rotate-1' );
	return $rotations[ array_rand( $rotations ) ];
}

/**
 * Return a random stat shape class.
 *
 * @return string CSS class for shape.
 */
function neobrutheme_stat_shape() {
	$shapes = array( '', 'stat-shape--circle', 'stat-shape--diamond' );
	return $shapes[ array_rand( $shapes ) ];
}

/**
 * Map a color name to its CSS custom property class.
 *
 * @param string $color Color name (red, yellow, cyan, white, bg, fg).
 * @return string Tailwind background class.
 */
function neobrutheme_color_class( $color ) {
	$map = array(
		'red'    => 'bg-[var(--color-red)]',
		'yellow' => 'bg-[var(--color-yellow)]',
		'cyan'   => 'bg-[var(--color-cyan)]',
		'white'  => 'bg-[var(--color-white)]',
		'bg'     => 'bg-[var(--color-bg)]',
		'fg'     => 'bg-[var(--color-fg)]',
	);
	return isset( $map[ $color ] ) ? $map[ $color ] : 'bg-[var(--color-red)]';
}

/**
 * Map a color name to its text color class.
 *
 * @param string $color Color name.
 * @return string Tailwind text class.
 */
function neobrutheme_text_color_class( $color ) {
	$map = array(
		'red'    => 'text-[var(--color-red)]',
		'yellow' => 'text-[var(--color-yellow)]',
		'cyan'   => 'text-[var(--color-cyan)]',
		'white'  => 'text-[var(--color-white)]',
		'bg'     => 'text-[var(--color-bg)]',
		'fg'     => 'text-[var(--color-fg)]',
	);
	return isset( $map[ $color ] ) ? $map[ $color ] : 'text-[var(--color-fg)]';
}

/**
 * Get a sub-field value from the current ACF row.
 *
 * Works around ACF's get_sub_field() failing when field groups are
 * registered programmatically via acf_add_local_field_group().
 * Reads directly from the row data returned by get_row().
 *
 * @param string $name The sub-field name.
 * @param mixed  $default Default value if not found.
 * @return mixed
 */
function neo_sub( $name, $default = '' ) {
	$row = get_row();
	if ( $row && isset( $row[ $name ] ) ) {
		return $row[ $name ];
	}
	return $default;
}
