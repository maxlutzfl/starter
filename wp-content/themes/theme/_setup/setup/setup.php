<?php 
/**
 *
 * @package brandco
 */


add_action( 'after_setup_theme', 'BrandCo_ThemeSetup' );
function BrandCo_ThemeSetup() {

	$content_width = 1100;

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

	register_nav_menus( 
		array(
			'primary' => esc_html__( 'Main Navigation', 'brandco' ),
			'mobile' => esc_html__( 'Mobile Navigation', 'brandco' ),
			'footer' => esc_html__( 'Footer Links', 'brandco' )
		) 
	);
}

add_action( 'widgets_init', 'BrandCo_Widgets' );
function BrandCo_Widgets() {
	register_sidebar( 
		array(
			'name' => esc_html__( 'Sidebar', 'brandco' ),
			'id' => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) 
	);
}

add_action('wp_footer', 'BrandCo_GoogleAnalytics');
function BrandCo_GoogleAnalytics() {
	$id = get_option('Site_GoogleAnalyticsID');
	if ( $id ) :
	echo "
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','" . $id . "','auto');ga('send','pageview');
		</script>
 	";
 	endif;
}

add_action('customize_register', 'BrandCo_PostTypeArchiveSetup');
function BrandCo_PostTypeArchiveSetup( $wp_customize ) {
	$custom_post_types = get_post_types( array( '_builtin' => false, 'public' => true ) );
	foreach ( $custom_post_types as $type ) {
		$details = get_post_type_object( $type );
		$label = $details->label;
		$wp_customize->add_setting( 'page_for_' . $type );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_for_' . $type, array(
			'label' => __( $label . ' Archive Page', 'bcore' ),
			'section' => 'static_front_page',
			'settings' => 'page_for_' . $type,
			'type' => 'dropdown-pages'
		))); 
	}	
}

function BrandCo_Pagination() {
	global $wp_query;
	$big = 999999999;
	$translated = __( 'Page', 'brandco' );
	echo '<div class="ArchivePagination">'; 
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
			'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
	) );
	echo '</div>';
}

add_action('wp_head', 'BrandCo_OG');
function BrandCo_OG() {
	echo '<meta property="og:site_name" content="' . get_bloginfo('title') . '" />';
	echo '<meta property="og:title" content="' . get_bloginfo('title') . ' - ' . get_bloginfo('description') . '" />';
	if ( get_option('CompanyLogo') )
		echo '<meta property="og:image" content="' . get_option('CompanyLogo') . '" />';
}
