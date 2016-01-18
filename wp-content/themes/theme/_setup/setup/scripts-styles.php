<?php 
/**
 * Scripts & Styles
 * @package brandco
 */ 

add_action( 'wp_enqueue_scripts', 'brandco_enqueue_scripts_styles' );
function brandco_enqueue_scripts_styles() {
	# Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'brandco-theme-scripts', get_template_directory_uri() . '/_assets/scripts/brandco.min.js', array('jquery'), null, true );

	# Styles
	wp_register_style( 'bcore-google-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700');
	wp_enqueue_style( 'brandco-theme-style', get_template_directory_uri() . '/_assets/styles/brandco.min.css' );
	wp_enqueue_style( 'bcore-google-font' );	
	// wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/_assets/font/font-awesome-4.4.0/css/font-awesome.min.css' );
}

add_action( 'admin_enqueue_scripts', 'brandco_admin_scripts_styles' );
function brandco_admin_scripts_styles() {
	wp_register_style( 'brandco-admin-css', get_template_directory_uri() . '/_assets/admin/admin.css' );
	wp_enqueue_style( 'brandco-admin-css' );
	wp_enqueue_script( 'brandco-admin-js', get_template_directory_uri() . '/_assets/admin/admin.js', array(), null, true );
}

add_action( 'admin_init', 'brandco_admin_editor_css' );
function brandco_admin_editor_css() {
	add_editor_style( get_template_directory_uri() . '/_assets/admin/admin.css' );
}
