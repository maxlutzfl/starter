<?php
add_action('wp_enqueue_scripts', 'enqueue_child_theme_scripts_styles');

function enqueue_child_theme_scripts_styles() {
	// Scripts
	wp_enqueue_script( 'bco-child-theme-scripts', get_stylesheet_directory_uri() . '/resources/scripts/main.min.js', array(), null, true );

	// Styles
	wp_enqueue_style( 'bco-child-theme-style', get_stylesheet_directory_uri() . '/resources/styles/css/main.min.css' );
}