<?php
// Get post type archive title
function get_post_type_title() {
	global $wp_query;
	return get_post_type_object( $wp_query->query['post_type'] )->labels->name;
}

// Get post type id name
function get_post_type_registered_title() {
	global $wp_query;
	return get_post_type_object($wp_query->query['post_type'])->name;
}

// Get page title
function get_page_title() {

	// Blog page
	if (is_home()) {
		if ( get_option('page_for_posts') ) {
			return get_the_title(get_option('page_for_posts'));
		} else {
			return 'Recent Posts';
		}
	}

	// Post type title
	if (is_post_type_archive()) {
		if (get_option('page_for_' . get_post_type_registered_title())) {
			return get_the_title(get_option('page_for_' . get_post_type_registered_title()));
		} else {
			return get_post_type_title(); 
		}
	}

	// Category archive
	if ( is_category() ) {
		return single_cat_title( '', false );
	} 

	// Tag archive
	if ( is_tag() ) {
		return single_term_title( '', false );
	}

	// Search results page
	if ( is_search() ) {
		return 'Search results for: <span>' . get_search_query() . '</span>';
	}

	// 404 Page
	if (is_404()) {
		return __('This page cannot be accessed, need help?', 'bco');
	}

	// Page title
	return get_the_title();
}