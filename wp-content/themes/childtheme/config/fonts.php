<?php 
/**
 * Fonts
 */

add_action('wp_enqueue_scripts', 'bcore_custom_theme_fonts');
function bcore_custom_theme_fonts() {

	// Google Fonts
	if ( defined('THEME_GOOGLE_FONT') ) {
		wp_register_style('bcore-google-font', 'https://fonts.googleapis.com/css?family=' . THEME_GOOGLE_FONT);
		wp_enqueue_style('bcore-google-font');
	}
}