<?php
/**
 * Brutheme animated timeline pattern.
 *
 * Insert the timeline, then edit/duplicate/reorder the
 * `.br-timeline__item` group blocks in the block editor.
 *
 * @package Neobrutheme
 */

return array(
	'title'       => __( 'Brutheme: Animated timeline', 'neve' ),
	'description' => __( 'A flowy, scroll-animated brutalist timeline with a marching colored spine. Add, duplicate or reorder the item blocks.', 'neve' ),
	'content'     => '<!-- wp:group {"className":"br-timeline"} -->
<div class="wp-block-group br-timeline"><!-- wp:group {"className":"br-timeline__item"} -->
<div class="wp-block-group br-timeline__item"><!-- wp:group {"className":"br-timeline__card"} -->
<div class="wp-block-group br-timeline__card"><!-- wp:paragraph {"className":"br-timeline__date"} -->
<p class="br-timeline__date">Year — now</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Role title</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What you did, where, and why it mattered.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"br-timeline__item"} -->
<div class="wp-block-group br-timeline__item"><!-- wp:group {"className":"br-timeline__card"} -->
<div class="wp-block-group br-timeline__card"><!-- wp:paragraph {"className":"br-timeline__date"} -->
<p class="br-timeline__date">Year — Year</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Role title</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What you did, where, and why it mattered.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"br-timeline__item"} -->
<div class="wp-block-group br-timeline__item"><!-- wp:group {"className":"br-timeline__card"} -->
<div class="wp-block-group br-timeline__card"><!-- wp:paragraph {"className":"br-timeline__date"} -->
<p class="br-timeline__date">Year — now</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Role title</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>What you did, where, and why it mattered.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
	'categories' => array( 'text' ),
	'keywords'   => array( 'timeline', 'history', 'roadmap', 'brutheme' ),
);
