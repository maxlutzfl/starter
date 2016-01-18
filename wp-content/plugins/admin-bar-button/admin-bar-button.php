<?php
/**
 * Plugin Name: Admin Bar Button
 * Description: Hide the front end admin bar and replace it with an 'Admin bar' button. When you hover over the button, the bar appears and stays for as long as your mouse hovers over it (it'll disappear 5 seconds after you move the mouse away).
 * Author: David Gard
 * Version: 3.2.2
 * Text Domain: djg-admin-bar-button
 *
 * Copyright 2014 David Gard.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Avoid direct calls to this file where WP core files are not present
 */
if(!function_exists('add_action')) :
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
endif;

/**
 * Include any relevant files
 */
include_once('page.php');
include_once('adminBar-front.php');

/**
 * Add links underneith the plugin name on the plugins page
 */
$plugin = plugin_basename(__FILE__);
add_filter('plugin_action_links_'.$plugin, 'abb_plugin_action_links');
function abb_plugin_action_links($links){

	$links[] = '<a href="options-general.php?page=djg-admin-bar-button">Settings</a>';
	return $links;
	
}