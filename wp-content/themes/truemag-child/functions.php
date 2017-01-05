<?php
function cactusthemes_scripts_styles_child_theme() {
	global $wp_styles;
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css');
}
add_action( 'wp_enqueue_scripts', 'cactusthemes_scripts_styles_child_theme' );

