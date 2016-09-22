<?php
/**
 * @package Starter2017 Documentation
 */

/** 
 * Shortcodes

[show_company_info show="all"] -- TODO: See C21 Milestone functions
[show_company_address_map] -- TODO: See C21 Milestone functions
[button_shortcode]

*/

/**
 * Helpers
 */

// For subpages, sub-subpages, this function
// will find the post ID of the parent page
function get_parent_id() {  }

// Breaks up a textarea at the line breaks 
// and adds spans so you can style the title
function multi_line_textarea_title_style() {  } // TODO: See C21 Milestone functions

/**
 * Company info
 */

function get_company_title() {  }
function get_company_address() {  }
function get_company_phone_number() {  }
function get_company_email_address() {  }
function get_social_media_links() {  }

/** 
 * Metadata
 */

function get_formatted_post_date() {  }
function get_post_excerpt($word_count = 30, $post_id = null, $read_more_text = 'Continue reading...', $link = true) {  }

// TODO: The top two function here can be combined to the 
// third function like get_list_of_terms_by_taxonomy('category', ', ');
function get_post_categories($separator) {  }
function get_post_tags($separator) {  }
function get_list_of_terms_by_taxonomy($taxonomy, $separator) {  }

/**
 * Index/archive functions
 */

// Master function to get the title
// for the archive page which can be:
// Search Results, Blog Index, Author,
// Category, Post Type Index, Date, or Tag 
function get_archive_title() {  }
function get_back_to_post_type_archive_link() {  }
function get_archive_pagination() {  }

/** 
 * Custom Post Types
 */

// Defaults to the main post type title
// but if the option is set page_for_{post_type}
// then get the title of that page
function get_post_type_title($post_type) {  }

// If the option is set page_for_{post_type}
// get the_content from that page
function get_post_type_page_content($post_type) {  }

/** 
 * Images
 */

function get_featured_image_url($size, $post_id = null) {  }
function get_image_from_directory($file_name) {  }
function get_image_by_id($image_id, $size = 'full') {  }
function get_svg($file_name) {  }
function get_fallback_image() {  }

