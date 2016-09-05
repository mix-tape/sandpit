<?php
// ==========================================================================
//
//   Add home / internal body class
//
// ==========================================================================

function hibiki_body_classes($classes) {

	$classes[] = is_front_page() ? 'home' : 'internal';
	return $classes;

}

add_filter('body_class', 'hibiki_body_classes', 10, 1);
