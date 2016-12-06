<?php
/**
 * Dev Environment Modes
 * @package bcore
 */

# Get dev environment
function get_development_environment() {
	return get_option('development_environment');
}

# Show developer messages 
function show_developer_messages() {
	if ( (int) get_option('dev_warnings') !== 1 ) {
		return true;
	} else {
		return false;
	}
}

function get_developer_options_link() {
	return get_admin_url() . 'customize.php?autofocus[section]=developers_section';
}

# Admin bar status label
add_action('admin_bar_menu', 'admin_bar_dev_env');
function admin_bar_dev_env($admin_bar) {
	$env = get_development_environment();
	if ( $env === 'local' ) {
		$title = 'Status: Local Dev';
	} elseif ( $env === 'beta' ) {
		$title = 'Status: In Beta';
	} else {
		$title = 'Status: Live';
	}

	$admin_bar->add_menu( 
		array(
			'id' => 'bcore-dev-env-' . $env,
			'parent' => 'top-secondary',
			'title' => $title,
			'href' => get_developer_options_link()
		) 
	);
}
