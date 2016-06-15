<?php
/**
 * @package 
 */

/**
 * Registers an editor stylesheet for the theme.
 */
function addBackendContentEditorStylesheet() {
	add_theme_support('editor_style');
    add_editor_style('/_assets/admin/custom-editor-style.css');
}

add_action( 'admin_init', 'addBackendContentEditorStylesheet' );

/**
 * Insert custom formats to content editor
 */

function addFormatsDropdownToContentEditor($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

add_filter('mce_buttons_2', 'addFormatsDropdownToContentEditor');

function addContentEditorFormats($init_array) {
	$style_formats = array(
		array(
			'title' => 'Button',
			'block' => 'span',
			'classes' => 'content-button',
			'wrapper' => true,
		),
	);
	$init_array['style_formats'] = json_encode($style_formats); 
	return $init_array; 
}

add_filter( 'tiny_mce_before_init', 'addContentEditorFormats' );

// Moved SEO Yoast metabox below important ones
add_filter( 
	'wpseo_metabox_prio', 
	function() {
		return 'low';
	}
);

// Fix anchor jumping when form is submitted
add_filter(
	'gform_confirmation_anchor', 
	create_function(
		'',
		'return false;'
	)
);

// Cleanup wp_head() function
add_action( 'init', 'brandco_wp_head_cleanup' );
function brandco_wp_head_cleanup() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'feed_links' );
	remove_action( 'wp_head', 'index_rel_link');
	remove_action( 'wp_head', 'start_post_rel_link');
	remove_action( 'wp_head', 'parent_post_rel_link');
}

// Remove custom fields metaboxes
add_action('add_meta_boxes', 'brandco_remove_custom_fields_metabox');
function brandco_remove_custom_fields_metabox() {
	global $post_type;
	if ( is_admin() && post_type_supports( $post_type, 'custom-fields' ) ) {
		remove_meta_box( 'postcustom', 'page', 'normal' );
		remove_meta_box( 'postcustom', 'post', 'normal' );
	}
}

// Turn off comments by default
add_action('wp_insert_post_data', 'brandco_comments_off_default');
function brandco_comments_off_default( $data ) {
	if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
		$data['comment_status'] = 0;
	}
	if( $data['post_type'] == 'post' && $data['post_status'] == 'auto-draft' ) {
		$data['comment_status'] = 0;
	}
	return $data;
}

// Cleanup the default widgets available
add_action( 'widgets_init', 'bco_remove_wp_widgets' );
function bco_remove_wp_widgets() {
	// unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	// unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	// unregister_widget('WP_Widget_Search');
	// unregister_widget('WP_Widget_Text');
	// unregister_widget('WP_Widget_Categories');
	// unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}




