<?php 
/**
 * Theme Setup
 * @package bcore
 */

add_action('after_setup_theme', 'bco_theme_setup');
function bco_theme_setup() {

	/**
	 * @see https://codex.wordpress.org/Content_Width
	 */

	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}

	/**
	 * @see https://codex.wordpress.org/Function_Reference/add_theme_support
	 */

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/**
	 * Add and update default image sizes
	 * uploaded to the media library
	 * @see https://developer.wordpress.org/reference/functions/add_image_size/
	 */

	add_image_size('placeholder', 30, 30);
	add_image_size('featured', 600, 380, true);
	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 300);
	update_option('medium_size_w', 600);
	update_option('medium_size_h', 600);
	update_option('large_size_w', 1500);
	update_option('large_size_h', 1500);

	/**
	 * Add navigation menu locations to the theme
	 * @see https://codex.wordpress.org/Function_Reference/register_nav_menus
	 */

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Main Navigation', 'brandco' ),
			'mobile' => esc_html__( 'Mobile Navigation', 'brandco' ),
			'footer' => esc_html__( 'Footer Links', 'brandco' )
		)
	);

	/**
	 * Move Yoast SEO metabox below custom fields
	 */

	add_filter(
		'wpseo_metabox_prio',
		function() {
			return 'low';
		}
	);

	/**
	 * Fixes Gravity Forms confirmation anchor problem
	 */

	add_filter(
		'gform_confirmation_anchor',
		create_function(
			'',
			'return false;'
		)
	);

	// Hide admin bar is user is not an admin
	if ( !current_user_can('administrator') && !is_admin() ) {
		show_admin_bar(false);
	}

	/**
	 * Add ACF Custom Options Page
	 */

	// if ( function_exists('acf_add_options_page') ) {
	// 	acf_add_options_page(
	// 		array(
	// 			'page_title' => get_bloginfo('title') . ' Website Settings',
	// 			'menu_title' => get_bloginfo('title') . ' Website Settings',
	// 			'menu_slug' => 'bco-general-settings',
	// 			'parent_slug' => 'themes.php',
	// 			'capability' => 'edit_posts',
	// 			'redirect' => false
	// 		)
	// 	);
	// }
}

# Default menu order
add_filter('wp_insert_post_data', 'default_menu_order');
function default_menu_order($data) {
	if ( $data['post_status'] == 'auto-draft' ) {
		$data['menu_order'] = 1000;
	}
	return $data;
}

# Comments off by default
add_action('wp_insert_post_data', 'comments_off_by_default');
function comments_off_by_default( $data ) {
	if ( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
		$data['comment_status'] = 0;
	}

	if ( $data['post_type'] == 'post' && $data['post_status'] == 'auto-draft' ) {
		$data['comment_status'] = 0;
	}
	return $data;
}

# Remove custom fields metabox
add_action('add_meta_boxes', 'remove_custom_fields_metabox');
function remove_custom_fields_metabox() {
	global $post_type;
	if ( is_admin() && post_type_supports( $post_type, 'custom-fields' ) ) {
		remove_meta_box( 'postcustom', 'page', 'normal' );
		remove_meta_box( 'postcustom', 'post', 'normal' );
	}
}



