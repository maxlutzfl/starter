<?php 
/**
 * 
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
	wp_enqueue_script('bco-child-theme-scripts', BCORE_CHILD_BASE_DIRECTORY_URI . '/resources/scripts/main.min.js', array('jquery'), null, true);

	# Styles
	wp_enqueue_style('bco-child-theme-style', BCORE_CHILD_BASE_DIRECTORY_URI . '/resources/styles/css/main.min.css');

	/** Remove parent styles */
	wp_dequeue_style('bco-framework-theme-style');
}

add_action('wp_enqueue_scripts', 'child_frontend_scripts_and_styles', 20);