<?php
/**
 * Shortcodes
 * @package bcore
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