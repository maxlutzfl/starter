<?php
/**
 * Scripts and Styles
 * @package bcore
 */

add_action('wp_enqueue_scripts', 'bcore_parent_scripts_and_styles');
add_action('admin_enqueue_scripts', 'bcore_admin_scripts_and_styles');

// For front-end scripts and styles
function bcore_parent_scripts_and_styles() {

	// Deregister
	wp_deregister_script('jquery');

	// Register
	wp_register_script('bcore-jquery', BCORE_PARENT_RESOURCES_DIRECTORY . 'scripts/jquery-3.1.1.min.js', array(), '3.1.1', true);

	// Enqueue
	wp_enqueue_script('bcore-jquery');
}

// For admin scripts and styles
function bcore_admin_scripts_and_styles() {

	// Register
	wp_register_style('bcore-admin-css', BCORE_PARENT_RESOURCES_DIRECTORY . 'admin/admin.css');
	wp_register_script('bcore-admin-js', BCORE_PARENT_RESOURCES_DIRECTORY . 'admin/admin.js');

	// Enqueue
	wp_enqueue_style('bcore-admin-css');
	wp_enqueue_script('bcore-admin-js');
}