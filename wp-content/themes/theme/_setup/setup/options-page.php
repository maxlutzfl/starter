<?php

if ( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(
		array(
			'page_title' => get_bloginfo('title') . ' Website Settings',
			'menu_title' => get_bloginfo('title') . ' Website Settings',
			'menu_slug' => 'bco-general-settings',
			'parent_slug' => 'themes.php',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);
	
}