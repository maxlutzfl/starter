<?php 
/**
 * Functions
 * @package brandco
 */

namespace BrandCo;

function Date() {
	$default_date = get_the_date();
	$formatted_date = get_the_date("Y-m-d H:i:s");
	$date = "<time datetime='{$formatted_date}' class='published' itemprop='datePublished'>{$default_date}</time>";
	return $date;
}

function Categories($sep = null) {
	$list = get_the_category();
	if ( $list ) { 
		foreach ( $list as $category ) {
			if ( $category === end( $list ) ) {
				echo '<a href="' . get_term_link( $category->term_id ) . '" class="category" itemprop="keywords">' . $category->name . '</a>';
			} else {
				echo '<a href="' . get_term_link( $category->term_id ) . '" class="category" itemprop="keywords">' . $category->name . $sep . '</a>';
			}
		}
	}
}

function Tags($sep = null) {
	$list = get_the_tags();
	if ( $list ) {
		foreach ( $list as $tag ) {
			if ( $tag === end( $list ) ) {
				echo '<a href="' . get_term_link( $tag->term_id ) . '" class="post-tag" itemprop="keywords">' . $tag->name . '</a>';
			} else {
				echo '<a href="' . get_term_link( $tag->term_id ) . '" class="post-tag" itemprop="keywords">' . $tag->name . $sep . '</a>';
			}
		}
	}
}

function BlogTitle() {
	if ( is_home() ) {
		if ( get_option('page_for_posts', true) ) {
			return get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			return 'Latest Posts';
		}
	}
}

function PostTypeTitle() {
	global $wp_query;

	if ( is_post_type_archive() ) {
		return get_post_type_object( $wp_query->query['post_type'] )->labels->name;
	}
}

function Image( $size = 'medium', $id = null ) {
	if ( empty( $id ) )
		$id = get_the_ID();

	if ( has_post_thumbnail( $id ) ) {
		$get_img_ID = get_post_thumbnail_id( $id );
		$img_src_url = wp_get_attachment_image_src( $get_img_ID, $size )[0];
		return $img_src_url;
	}
}

function ArchiveBackLink() {
	global $wp_query;
	
	if ( ! is_post_type_archive() ) { return; }

	$post_type = $wp_query->query['post_type'];
	$post_type_name = get_post_type_object( $wp_query->query['post_type'] )->labels->name;

	echo '<a href="' . get_post_type_archive_link( $post_type ) . '" class="ArchiveBackLink">Back To All ' . $post_type_name . '</a>';
}

function SocialMedia() {
	$links = array();

	$links[] = array( 'title' => 'Facebook', 'icon' => 'fa-facebook', 'link' => get_theme_mod('SocialMedia__Facebook') );
	$links[] = array( 'title' => 'Twitter', 'icon' => 'fa-twitter', 'link' => get_theme_mod('SocialMedia__Twitter') );
	$links[] = array( 'title' => 'Google Plus', 'icon' => 'fa-google-plus', 'link' => get_theme_mod('SocialMedia__GooglePlus') );
	$links[] = array( 'title' => 'LinkedIn', 'icon' => 'fa-linkedin', 'link' => get_theme_mod('SocialMedia__Linkedin') );
	$links[] = array( 'title' => 'Pinterest', 'icon' => 'fa-pinterest', 'link' => get_theme_mod('SocialMedia__Pinterest') );
	$links[] = array( 'title' => 'Instagram', 'icon' => 'fa-instagram', 'link' => get_theme_mod('SocialMedia__Instagram') );
	$links[] = array( 'title' => 'Youtube', 'icon' => 'fa-youtube-play', 'link' => get_theme_mod('SocialMedia__Youtube') );

	foreach ( $links as $link ) {
		echo '<a href="' . $link['link'] . '" title="Click to find us on ' . $link['title'] . '"><i class="fa ' . $link['icon'] . '"></i></a>';
	}
}

function ImgDir( $img = null ) {
	return get_template_directory_uri() . '/_assets/images/' . $img;
}





