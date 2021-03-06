<?php
/**
 * Helper Functions
 * @package bcore
 */

/**
 * Get image url by image ID
 */
function get_image_by_id($img_id, $size = 'thumbnail') {
	$img_src_url = wp_get_attachment_image_src($img_id, $size);
	if ($img_src_url) {
		return $img_src_url[0];
	} else {
		return;
	}
}

/** 
 * Get icon 
 */
function get_icon($icon = 'link.svg') {

	// Get file
	$file = BCORE_PARENT_RESOURCES_DIRECTORY . 'images/svg/' . $icon;

	// Might also be in the child theme
	$or_from_child_theme = get_stylesheet_directory() . '/resources/images/svg/' . $icon;

	// See if the svg is in the core theme
	if ( file_exists($file) ) {
		return file_get_contents($file); 

	// Otherwise check in child theme
	} else if ( file_exists($or_from_child_theme) ) { 
		return file_get_contents($or_from_child_theme); 

	// Error
	} else {
		return 'This is not the icon you are looking for (' . $icon . ')';
	}
}

/**
 * Get post excerpt
 */
function get_post_excerpt($args = array()) {

	// Get defaults
	$word_count = (array_key_exists('word_count', (array) $args)) ? $args['word_count'] : 30;
	$post_id = (array_key_exists('post_id', (array) $args)) ? $args['post_id'] : get_the_ID();
	$read_more_text = (array_key_exists('read_more_text', (array) $args)) ? $args['read_more_text'] : 'Continue reading...';
	$link = (array_key_exists('link', (array) $args)) ? $args['link'] : true;

	// Get read more link
	$read_more_text = ($read_more_text) ? $read_more_text : '';
	$read_more_link = ($link === true) ? ' <a href="' . get_permalink() . '" class="read-more-text">' . $read_more_text . '</a>' : '<span class="read-more-text">' . $read_more_text . '</span>';

	// Get content
	$content = get_post_field('post_content', $post_id);

	// Trim down
	$trimmed_content = wp_trim_words($content, $word_count, '') . $read_more_link;

	// Return
	return wpautop(strip_shortcodes($trimmed_content));
}

/** 
 * Navigation 
 * Flat menu: depth = -1;
 * Default: depth = 0;
 * Only first level: depth = 1;
 */
function get_navigation($args = array()) {

	// Get defaults
	$location = (array_key_exists('location', (array) $args)) ? $args['location'] : 'primary';
	$depth = (array_key_exists('depth', (array) $args)) ? $args['depth'] : 0;

	// Get menu
	if ( has_nav_menu($location) ) {
		wp_nav_menu( 
			array( 
				'theme_location' => $location,
				'container' => '',
				'items_wrap' => '%3$s',
				'depth' => $depth
			) 
		);
		return;

	// Error
	} else {
		echo 'Menu location does not exist: <strong>"' . $location . '"</strong>';
	}
}

/**
 * BrandCo link
 */
function get_brandco_link($text = '') {
	$text = ($text) ? $text : 'built by <span>BrandCo</span>';
	return '<a href="https://brandco.com/?utm_source=brandco_custom_site" target="_blank" rel="nofollow">' . apply_filters('by_brandco_text', $text) . '</a>';
}

/** 
 * Textarea filter so you can display shortcodes, HTML 
 */
function textarea_filter($content) {
	return apply_filters('the_content', htmlspecialchars_decode($content));
}

/**
 * Get image from directory
 */
function get_image_from_directory($file_name) {
	return BCORE_CHILD_BASE_DIRECTORY_URI . '/resources/images/' . $file_name;
}

/** 
 * Get featured image url 
 */
function get_featured_image($size = 'medium', $post_id = null) {
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$get_img_ID = get_post_thumbnail_id( $post_id );
		$img_src_url = wp_get_attachment_image_src( $get_img_ID, $size );
		if ( $img_src_url ) {
			return $img_src_url[0];
		} else {
			return;
		}
	}
}

/**
 * Get list of terms from taxonomy
 * Defaults to category
 */

function get_taxonomy_list($taxonomy = 'category', $separator = ', ') {
	if ( taxonomy_exists($taxonomy) ) {
		$list = get_the_terms(false, $taxonomy);
		if ( $list ) { 
			foreach ( $list as $category ) {
				if ( $category === end($list) ) {
					echo '<a href="' . get_term_link( $category->term_id ) . '" class="category" itemprop="keywords">' . $category->name . '</a>';
				} else {
					echo '<a href="' . get_term_link( $category->term_id ) . '" class="category" itemprop="keywords">' . $category->name . '</a>' . '<span class="taxonomy-separator">' . $separator . '</span>';
				}
			}
		}

	} else {
		echo $taxonomy . ' is not a taxonomy.';
	}
}

/**
 * Default pagination for archives
 */

function get_archive_pagination() {
	global $wp_query;
	echo '<div class="archive-pages">'; 
		echo paginate_links( 
			array(
				'base' => str_replace(10000000, '%#%', esc_url(get_pagenum_link(10000000))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages,
				'before_page_number' => '<span class="screen-reader-text">Page </span>'
			) 
		);
	echo '</div>';
}

function get_fallback_image() {
	return get_option('fallback_image');
}

function get_post_featured_image() {
	$image_url = (has_post_thumbnail()) ? get_featured_image('large') : get_fallback_image();
	return $image_url;
}

function create_url_from_data($base_url, $query_array) {
	$query_string = http_build_query($query_array);
	return $base_url . '?' . $query_string;
}

function get_google_maps_api_key() {
	return get_option('google_maps_api_key');
}

add_filter('acf/settings/google_api_key', function() {
	return get_google_maps_api_key();
});













