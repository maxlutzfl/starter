<?php 
/**
 * 
 */

add_action('wp_enqueue_scripts', 'theme_google_font');
function theme_google_font() {
	if ( defined('THEME_GOOGLE_FONT') ) {
		wp_register_style( 'bcore-google-font', 'https://fonts.googleapis.com/css?family=' . THEME_GOOGLE_FONT);
		wp_enqueue_style( 'bcore-google-font' );
	}
}