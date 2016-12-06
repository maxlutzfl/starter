<?php
/**
 * Social Media
 * @package bcore
 */

function get_social_media_links() {
	$links = array();

	$options = array(
		get_option('facebook_link'),
		get_option('twitter_link'),
		get_option('google_plus_link'),
		get_option('linkedin_link'),
		get_option('pinterest_link'),
		get_option('instagram_link'),
		get_option('youtube_link')
	);

	if ( get_option('facebook_link') ) { $links[] = array( 'title' => 'Facebook', 'link' => get_option('facebook_link'), 'icon' => get_icon('facebook.svg'), ); }
	if ( get_option('twitter_link') ) { $links[] = array( 'title' => 'Twitter', 'link' => get_option('twitter_link'), 'icon' => get_icon('twitter.svg'), ); }
	if ( get_option('google_plus_link') ) { $links[] = array( 'title' => 'Google Plus', 'link' => get_option('google_plus_link'), 'icon' => get_icon('google-plus.svg'), ); }
	if ( get_option('linkedin_link') ) { $links[] = array( 'title' => 'LinkedIn', 'link' => get_option('linkedin_link'), 'icon' => get_icon('linkedin.svg'), ); }
	if ( get_option('pinterest_link') ) { $links[] = array( 'title' => 'Pinterest', 'link' => get_option('pinterest_link'), 'icon' => get_icon('pinterest.svg'), ); }
	if ( get_option('instagram_link') ) { $links[] = array( 'title' => 'Instagram', 'link' => get_option('instagram_link'), 'icon' => get_icon('instagram.svg'), ); }
	if ( get_option('youtube_link') ) { $links[] = array( 'title' => 'YouTube', 'link' => get_option('youtube_link'), 'icon' => get_icon('youtube.svg'), ); }

	return $links;
}