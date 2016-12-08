<?php
/*
Plugin Name: var_dump() -> console.log()
Plugin URI: https://brandco.com/
Description: In PHP, use the function <code>var_dump_console_log($data)</code> and check the Chrome Dev Tools console.
Version: 0.0.1
Author: BrandCo LLC
Author URI: https://brandco.com/
*/

/**
 * Load script
 */
add_action('wp_enqueue_scripts', 'var_dump_console_log_files', 1000);
function var_dump_console_log_files() {
	wp_register_script('bcore-var-dump-js', plugins_url('bcore-var-dump-js.js', __FILE__), array(), '1.0.0', true);
}

/**
 * The function
 */
function var_dump_console_log($data) {
	echo '<div data-console-log="' . htmlspecialchars(json_encode($data)) . '"></div>';
	wp_enqueue_script('bcore-var-dump-js');
}
