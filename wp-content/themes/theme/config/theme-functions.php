<?php 
/** 
 * @package BrandCo Starter Theme
 * @subpackage Theme Functions
 * @author BrandCo. LLC
 */



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
			'before_page_number' => '<span class="screen-reader-object">'.$translated.' </span>'
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

function get_icon( $name = null ) {
	if ( !$name ) { return 'No icon specified'; }

	if ( $name === 'Google Plus' ) {
		return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1792 1792" style="enable-background:new 0 0 1792 1792;" xml:space="preserve"><path d="M1115.7,909.1c0,106.9-22.4,202.1-67.1,285.6c-44.7,83.5-108.4,148.7-191.1,195.8s-177.5,70.5-284.4,70.5 c-76.6,0-149.8-14.9-219.7-44.7c-69.9-29.8-130-69.9-180.3-120.2c-50.4-50.4-90.4-110.5-120.2-180.3C23,1045.8,8.1,972.6,8.1,896 S23,746.2,52.8,676.3s69.9-130,120.2-180.3s110.5-90.4,180.3-120.2s143.1-44.7,219.7-44.7c147,0,273.1,49.3,378.4,148L798.1,626.2 C738,568.2,663,539.2,573.1,539.2c-63.2,0-121.6,15.9-175.3,47.8c-53.7,31.9-96.2,75.1-127.6,129.9c-31.3,54.7-47,114.5-47,179.2 s15.7,124.5,47,179.2s73.9,98,127.6,129.9c53.7,31.9,112.1,47.8,175.3,47.8c42.6,0,81.8-5.9,117.5-17.7 c35.7-11.8,65.1-26.6,88.2-44.3c23.1-17.7,43.3-37.9,60.5-60.5c17.2-22.6,29.8-43.9,37.8-64c8-20,13.5-39.1,16.6-57H573.1V815.1 h533.3C1112.6,847.4,1115.7,878.8,1115.7,909.1z M1783.9,815.1v161.9h-161.1V1138h-161.9V976.9h-161.1V815.1h161.1V654h161.9v161.1 H1783.9z"/></svg>';
	
	} else if ( $name === 'Twitter' ) {
		return '<svg class="SiteSvg" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1684 408q-67 98-162 167 1 14 1 42 0 130-38 259.5t-115.5 248.5-184.5 210.5-258 146-323 54.5q-271 0-496-145 35 4 78 4 225 0 401-138-105-2-188-64.5t-114-159.5q33 5 61 5 43 0 85-11-112-23-185.5-111.5t-73.5-205.5v-4q68 38 146 41-66-44-105-115t-39-154q0-88 44-163 121 149 294.5 238.5t371.5 99.5q-8-38-8-74 0-134 94.5-228.5t228.5-94.5q140 0 236 102 109-21 205-78-37 115-142 178 93-10 186-50z"/></svg>';
	
	} else if ( $name === 'Facebook' ) {
		return '<svg class="SiteSvg" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1343 12v264h-157q-86 0-116 36t-30 108v189h293l-39 296h-254v759h-306v-759h-255v-296h255v-218q0-186 104-288.5t277-102.5q147 0 228 12z"/></svg>';
	
	} else if ( $name === 'LinkedIn' ) {
		return '<svg class="SiteSvg" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M477 625v991h-330v-991h330zm21-306q1 73-50.5 122t-135.5 49h-2q-82 0-132-49t-50-122q0-74 51.5-122.5t134.5-48.5 133 48.5 51 122.5zm1166 729v568h-329v-530q0-105-40.5-164.5t-126.5-59.5q-63 0-105.5 34.5t-63.5 85.5q-11 30-11 81v553h-329q2-399 2-647t-1-296l-1-48h329v144h-2q20-32 41-56t56.5-52 87-43.5 114.5-15.5q171 0 275 113.5t104 332.5z"/></svg>';
	
	} else if ( $name === 'YouTube' ) {
		return '<svg class="SiteSvg" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1099 1244v211q0 67-39 67-23 0-45-22v-301q22-22 45-22 39 0 39 67zm338 1v46h-90v-46q0-68 45-68t45 68zm-966-218h107v-94h-312v94h105v569h100v-569zm288 569h89v-494h-89v378q-30 42-57 42-18 0-21-21-1-3-1-35v-364h-89v391q0 49 8 73 12 37 58 37 48 0 102-61v54zm429-148v-197q0-73-9-99-17-56-71-56-50 0-93 54v-217h-89v663h89v-48q45 55 93 55 54 0 71-55 9-27 9-100zm338-10v-13h-91q0 51-2 61-7 36-40 36-46 0-46-69v-87h179v-103q0-79-27-116-39-51-106-51-68 0-107 51-28 37-28 116v173q0 79 29 116 39 51 108 51 72 0 108-53 18-27 21-54 2-9 2-58zm-608-913v-210q0-69-43-69t-43 69v210q0 70 43 70t43-70zm719 751q0 234-26 350-14 59-58 99t-102 46q-184 21-555 21t-555-21q-58-6-102.5-46t-57.5-99q-26-112-26-350 0-234 26-350 14-59 58-99t103-47q183-20 554-20t555 20q58 7 102.5 47t57.5 99q26 112 26 350zm-998-1276h102l-121 399v271h-100v-271q-14-74-61-212-37-103-65-187h106l71 263zm370 333v175q0 81-28 118-37 51-106 51-67 0-105-51-28-38-28-118v-175q0-80 28-117 38-51 105-51 69 0 106 51 28 37 28 117zm335-162v499h-91v-55q-53 62-103 62-46 0-59-37-8-24-8-75v-394h91v367q0 33 1 35 3 22 21 22 27 0 57-43v-381h91z"/></svg>';
	
	} else if ( $name === 'Instagram' ) { 
		return '<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1490 1426v-648h-135q20 63 20 131 0 126-64 232.5t-174 168.5-240 62q-197 0-337-135.5t-140-327.5q0-68 20-131h-141v648q0 26 17.5 43.5t43.5 17.5h1069q25 0 43-17.5t18-43.5zm-284-533q0-124-90.5-211.5t-218.5-87.5q-127 0-217.5 87.5t-90.5 211.5 90.5 211.5 217.5 87.5q128 0 218.5-87.5t90.5-211.5zm284-360v-165q0-28-20-48.5t-49-20.5h-174q-29 0-49 20.5t-20 48.5v165q0 29 20 49t49 20h174q29 0 49-20t20-49zm174-208v1142q0 81-58 139t-139 58h-1142q-81 0-139-58t-58-139v-1142q0-81 58-139t139-58h1142q81 0 139 58t58 139z"/></svg>';

	} else if ( $name === 'Pinterest' ) {
		return '<svg class="SiteSvg" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1664 896q0 209-103 385.5t-279.5 279.5-385.5 103q-111 0-218-32 59-93 78-164 9-34 54-211 20 39 73 67.5t114 28.5q121 0 216-68.5t147-188.5 52-270q0-114-59.5-214t-172.5-163-255-63q-105 0-196 29t-154.5 77-109 110.5-67 129.5-21.5 134q0 104 40 183t117 111q30 12 38-20 2-7 8-31t8-30q6-23-11-43-51-61-51-151 0-151 104.5-259.5t273.5-108.5q151 0 235.5 82t84.5 213q0 170-68.5 289t-175.5 119q-61 0-98-43.5t-23-104.5q8-35 26.5-93.5t30-103 11.5-75.5q0-50-27-83t-77-33q-62 0-105 57t-43 142q0 73 25 122l-99 418q-17 70-13 177-206-91-333-281t-127-423q0-209 103-385.5t279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/></svg>'; 

	} else {
		return 'Icon does not exist';
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