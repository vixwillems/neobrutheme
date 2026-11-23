<?php
/**
 * Brutheme page head pattern.
 *
 * Insert at the top of a page to get the same kicker + oversized H1 +
 * lead paragraph used across the site. Edit the three text blocks after
 * inserting.
 *
 * @package Neobrutheme
 */

return array(
	'title'       => __( 'Brutheme: Page head', 'neve' ),
	'description' => __( 'A consistent brutalist page header with a kicker, oversized title and lead paragraph.', 'neve' ),
	'content'     => '<!-- wp:group {"className":"br-page-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group br-page-head"><!-- wp:paragraph {"className":"br-kicker"} -->
<p class="br-kicker">Kicker</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"br-page-title"} -->
<h1 class="wp-block-heading br-page-title">Page title</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"br-lead"} -->
<p class="br-lead">A short lead that sets up the page.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
	'categories'  => array( 'text' ),
	'keywords'    => array( 'header', 'hero', 'title', 'brutheme' ),
);
