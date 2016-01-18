<?php
/**
 * @package:		WordPress
 * @subpackage:		Admin Bar Button Plugin
 * @description:	Options page for the admin bar button
 * @since:			3.2.1
 */

/**
 * Remove the WordPress menu from the WordPress Admin Bar
 */
add_action('wp_before_admin_bar_render', 'abb_remove_wordpress_menu', 0);
function abb_remove_wordpress_menu(){

	$admin_bar_button = new ABB_Page;
	
	if(!$admin_bar_button->get_value('show_wordpress_menu')) :
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
	endif;
	
}
?>