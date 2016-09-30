<?php 
/**
 * @package BrandCo. Framework Child Theme
 */

# Remove parent framework theme script
function dequeue_framework_styles_and_styles() {
	wp_dequeue_script('bco-framework-theme-scripts');
}

add_action('wp_print_scripts', 'dequeue_framework_styles_and_styles');

# Enqueue child theme scripts and styles
function child_frontend_scripts_and_styles() {

	# Remove parent framework theme styles
	wp_dequeue_style('bco-framework-theme-style');

	# Scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('bco-child-theme-scripts', BCO_CHILD_BASE_DIRECTORY_URI . '/resources/scripts/main.min.js', array('jquery'), null, true);

	# Styles
	wp_enqueue_style('bco-child-theme-style', BCO_CHILD_BASE_DIRECTORY_URI . '/resources/styles/css/main.min.css');

	wp_dequeue_style('bco-framework-theme-style');

	# Google Fonts
	// if ( defined('GOOGLE_FONTS') ) {
	// 	wp_register_style( 'bco-google-font', 'https://fonts.googleapis.com/css?family=' . GOOGLE_FONTS);
	// 	wp_enqueue_style( 'bco-google-font' );
	// }
}

add_action('wp_enqueue_scripts', 'child_frontend_scripts_and_styles', 20);