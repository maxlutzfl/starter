<?php 
/**
 * Scripts and styles
 */

add_action('wp_enqueue_scripts', 'child_frontend_scripts_and_styles', 20);
function child_frontend_scripts_and_styles() {

	// Scripts
	wp_register_script('bcore-child-theme-js', BCORE_CHILD_BASE_DIRECTORY_URI . '/resources/scripts/main.min.js', array('bcore-jquery'), null, true);

	// Styles
	wp_register_style('bcore-child-theme-css', BCORE_CHILD_BASE_DIRECTORY_URI . '/resources/styles/css/main.min.css');

	// Enqueue
	wp_enqueue_script('bcore-child-theme-js');
	wp_enqueue_style('bcore-child-theme-css');
}

