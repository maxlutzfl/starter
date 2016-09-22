<?php 
/** 
 * @package BrandCo Starter Theme
 * @subpackage Theme Functions
 * @author BrandCo. LLC
 */



function get_index_title() {
	if ( is_home() ) {
		if ( get_option('page_for_posts') ) {
			return get_the_title(get_option('page_for_posts'));
		} else {
			return 'Recent Posts';
		}
	}

	if ( is_post_type_archive() ) {
		return get_post_type_archive_title(); 
	} elseif ( is_category() ) {
		return single_cat_title( '', false );
	} elseif ( is_tag() ) {
		return single_term_title( '', false );
	} elseif ( is_search() ) {
		return 'Search results for: <span>' . get_search_query() . '</span>';
	} else {
		return get_the_archive_title();
	}
}

/**
 * Default pagination for archives
 */

function display_archive_pagination() {
	global $wp_query;
	$big = 999999999;
	$translated = __( 'Page', 'brandco' );
	echo '<div class="archive-pagination">'; 
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
			'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
	) );
	echo '</div>';
}

/**
 * Get post date
 */

function get_post_date() {
	$default_date = get_the_date();
	$formatted_date = get_the_date("Y-m-d H:i:s");
	$date = "<time datetime='{$formatted_date}' class='published' itemprop='datePublished'>{$default_date}</time>";
	return $date;
}

/**
 * Get post categories
 */

function display_post_categories($sep = null) {
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

/**
 * Get post tags
 */

function display_post_tags($sep = null) {
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

/**
 * Get blog page title
 */

function get_blog_page_title() {
	if ( is_home() ) {
		if ( get_option('page_for_posts', true) ) {
			return get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			return 'Latest Posts';
		}
	}
}

/**
 * Get custom post type title
 */

function get_post_type_archive_title() {
	global $wp_query;

	if ( is_post_type_archive() ) {
		return get_post_type_object( $wp_query->query['post_type'] )->labels->name;
	}
}

/**
 * Get featured image url
 */

function get_featured_image_url( $size = 'medium', $post_id = null ) {
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
 * Get image url by image ID
 */

function get_image_url_by_id($img_id, $size = 'thumbnail') {
	$img_src_url = wp_get_attachment_image_src( $img_id, $size );
	if ( $img_src_url ) {
		return $img_src_url[0];
	} else {
		return;
	}
}

/**
 * Single page back link to archive
 */

function display_archive_back_link() {
	global $wp_query;
	
	if ( ! is_post_type_archive() ) { return; }

	$post_type = $wp_query->query['post_type'];
	$post_type_name = get_post_type_object( $wp_query->query['post_type'] )->labels->name;

	echo '<a href="' . get_post_type_archive_link( $post_type ) . '" class="archive-back-link">Back To All ' . $post_type_name . '</a>';
}

function get_image_from_directory($img = null) {
	return IMAGE_DIRECTORY_URI . $img;
}

function get_post_excerpt( $wordcount = 30, $id = null, $readmoretext = 'Read More' ) {

	if ( $id === null ) {
		$id = get_the_ID();
	}

	if ( $readmoretext === null ) {
		$readMore = '';
	} else {
		$readMore = '<a href="'. get_permalink( $id ) .'" class="excerptReadMore">' . $readmoretext . '</a>';
	}

	$content = get_post_field( 'post_content', $id );
	$trimmed_content = wp_trim_words($content, $wordcount, '') . $readMore;
	return wpautop( strip_shortcodes($trimmed_content) );
}

function google_maps_script() {
	echo '<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfEzWjcytuQ3VsBCE-9qi4zHptECX6sig&callback=initMap"></script>';
}

function display_google_map( $address ) {
	add_action('wp_footer', 'google_maps_script');
	?>
		<div id="CompanyMap"></div>
		<script>
			function initMap() {
				var address = "<?php echo $address; ?>";
				var geocoder = new google.maps.Geocoder();
				geocoder.geocode( { 'address': address}, function(results, status) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					var myLatLng = {lat: latitude, lng: longitude};
					var map = new google.maps.Map(document.getElementById('CompanyMap'), {
						zoom: 14,
						scrollwheel: false,
						draggable: false,
						center: myLatLng
					});
					var marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						title: "<?php bloginfo('title'); ?>"
					});
					google.maps.event.addDomListener(window, 'resize', function() {
						map.setCenter(myLatLng);
					});
				}); 
			}
		</script>
	<?php
}

function get_social_media_links() {
	$links = array();
	$options[] = array(
		get_option('facebook-link'),
		get_option('twitter-link'),
		get_option('google-plus-link'),
		get_option('linkedin-link'),
		get_option('pinterest-link'),
		get_option('instagram-link'),
		get_option('youtube-link')
	);

	if ( get_option('facebook-link') ) { $links[] = array( 'title' => 'Facebook', 'link' => get_option('facebook'), 'icon' => get_icon('facebook.svg'), ); }
	if ( get_option('twitter-link') ) { $links[] = array( 'title' => 'Twitter', 'link' => get_option('twitter'), 'icon' => get_icon('twitter.svg'), ); }
	if ( get_option('google-plus-link') ) { $links[] = array( 'title' => 'Google Plus', 'link' => get_option('google-plus'), 'icon' => get_icon('google-plus.svg'), ); }
	if ( get_option('linkedin-link') ) { $links[] = array( 'title' => 'LinkedIn', 'link' => get_option('linkedin'), 'icon' => get_icon('linkedin.svg'), ); }
	if ( get_option('pinterest-link') ) { $links[] = array( 'title' => 'Pinterest', 'link' => get_option('pinterest'), 'icon' => get_icon('pinterest.svg'), ); }
	if ( get_option('instagram-link') ) { $links[] = array( 'title' => 'Instagram', 'link' => get_option('instagram'), 'icon' => get_icon('instagram.svg'), ); }
	if ( get_option('youtube-link') ) { $links[] = array( 'title' => 'YouTube', 'link' => get_option('youtube'), 'icon' => get_icon('youtube.svg'), ); }

	return $links;
}

function get_icon($icon) {
	if ( empty($icon) ) { return; }

	$file = IMAGE_DIRECTORY_URI . 'svg/' . $icon;

	if ( file_exists($file) ) {
		return file_get_contents(IMAGE_DIRECTORY_URI . 'svg/' . $icon); 
	} else {
		return 'This is not the icon you are looking for (' . $icon . ')';
	}
}

function display_mobile_nav() {
	if ( has_nav_menu('mobile') ) {
		wp_nav_menu( 
			array( 
				'theme_location' => 'mobile',
				'container' => '',
				'items_wrap' => '%3$s'
			) 
		);
		return;

	} elseif ( has_nav_menu('primary') ) {
		wp_nav_menu( 
			array( 
				'theme_location' => 'primary',
				'container' => '',
				'items_wrap' => '%3$s'
			) 
		);
		return;

	} else {
		echo 'No Menu Available.';
		return;
	}	
}

function get_parent_page_id() {
	global $post;
	if ( $post->post_parent )	{
		$ancestors = get_post_ancestors($post->ID);
		$root = count($ancestors) - 1;
		$parent = $ancestors[$root];
		
	} else {
		$parent = $post->ID;
	}

	return $parent;
}