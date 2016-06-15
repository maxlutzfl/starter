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

function Image( $size = 'medium', $post_id = null ) {
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

function ImageID($img_id, $size = 'thumbnail') {
	$img_src_url = wp_get_attachment_image_src( $img_id, $size );
	if ( $img_src_url ) {
		return $img_src_url[0];
	} else {
		return;
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

	if ( get_option('SocialMedia__Facebook') ) 
		$links[] = array( 'title' => 'Facebook', 'icon' => Icon('Facebook'), 'link' => get_option('SocialMedia__Facebook') );
	
	if ( get_option('SocialMedia__Twitter') )
		$links[] = array( 'title' => 'Twitter', 'icon' => Icon('Twitter'), 'link' => get_option('SocialMedia__Twitter') );
	
	if ( get_option('SocialMedia__GooglePlus') )
		$links[] = array( 'title' => 'Google Plus', 'icon' => Icon('Google Plus'), 'link' => get_option('SocialMedia__GooglePlus') );
	
	if ( get_option('SocialMedia__Linkedin') )
		$links[] = array( 'title' => 'LinkedIn', 'icon' => Icon('LinkedIn'), 'link' => get_option('SocialMedia__Linkedin') );
	
	if ( get_option('SocialMedia__Pinterest') )
		$links[] = array( 'title' => 'Pinterest', 'icon' => Icon('Pinterest'), 'link' => get_option('SocialMedia__Pinterest') );
	
	if ( get_option('SocialMedia__Instagram') )
		$links[] = array( 'title' => 'Instagram', 'icon' => Icon('Instagram'), 'link' => get_option('SocialMedia__Instagram') );
	
	if ( get_option('SocialMedia__Youtube') )
		$links[] = array( 'title' => 'Youtube', 'icon' => Icon('YouTube'), 'link' => get_option('SocialMedia__Youtube') );

	foreach ( $links as $link ) {
		echo '<a href="' . $link['link'] . '" title="Click to find us on ' . $link['title'] . '" class="SocialIcon">' . $link['icon'] . '</a>';
	}
}

function ImgDir( $img = null ) {
	return get_template_directory_uri() . '/_assets/images/' . $img;
}

function Excerpt( $wordcount = 30, $id = null, $readmoretext = 'Read More' ) {

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

function GoogleMapsScript() {
	echo '<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>';
}

function AddMap( $address ) {
	add_action('wp_footer', 'BrandCo\GoogleMapsScript');
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

function Icon( $name = null ) {
	if ( !$name ) { return 'No icon specified'; }

	if ( $name === 'Google Plus' ) {
		return '<svg class="SiteSvg" width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1181 913q0 208-87 370.5t-248 254-369 91.5q-149 0-285-58t-234-156-156-234-58-285 58-285 156-234 234-156 285-58q286 0 491 192l-199 191q-117-113-292-113-123 0-227.5 62t-165.5 168.5-61 232.5 61 232.5 165.5 168.5 227.5 62q83 0 152.5-23t114.5-57.5 78.5-78.5 49-83 21.5-74h-416v-252h692q12 63 12 122zm867-122v210h-209v209h-210v-209h-209v-210h209v-209h210v209h209z"/></svg>';
	
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

function MobileNav() {
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

function getParentPageId() {
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