<?php 
/**
 * 
 */

// add_action('wp_enqueue_scripts', 'bco_google_font');
function bco_google_font() {
	$fonts = 'Raleway:400,700';
	wp_register_style( 'brandco-google-font', 'https://fonts.googleapis.com/css?family=' . $fonts);
	wp_enqueue_style( 'brandco-google-font' );
}