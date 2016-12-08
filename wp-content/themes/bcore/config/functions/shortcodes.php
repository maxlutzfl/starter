<?php
/**
 * Shortcodes
 * @package bcore
 */

/**
 * Button shortcode
 */
add_shortcode('button_shortcode', 'bcore_button_shortcode');
function bcore_button_shortcode($attributes) {
	$link = (isset($attributes['link'])) ? $attributes['link'] : '';
	$title = (isset($attributes['title'])) ? $attributes['title'] : 'Click here to learn more';
	$style = (isset($attributes['style'])) ? $attributes['style'] : '';

	if ( $link ) {
		return '<p><a href="' . $link . '" class="button-style button-style-' . $style . ' ' . $arrows . '"><span>' . $title . '</span></a></p>';
	}
}

/**
 * Container shortcode
 */
add_shortcode('container', 'bcore_container_shortcode');
function bcore_container_shortcode($atts, $content = null) {
	return '<div class="content-container">' . apply_filters('the_content', $content) . '</div>';
}

/**
 * Half shortcode
 */
add_shortcode('half', 'bcore_half_shortcode');
function bcore_half_shortcode($atts, $content = null) {
	return '<div class="content-column__half">' . apply_filters('the_content', $content) . '</div>';
}

/**
 * Fix empty <p> tags generated from shortcodes
 */
add_filter('the_content', 'bcore_shortcode_empty_paragraph_fix');
function bcore_shortcode_empty_paragraph_fix($content) {
	$array = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']'
	);

	return strtr( $content, $array );
}