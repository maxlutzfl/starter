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

	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 300);
	update_option('medium_size_w', 600);
	update_option('medium_size_h', 600);
	update_option('large_size_w', 1200);
	update_option('large_size_h', 1200);
	
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
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '" . $id . "', 'auto');
			ga('send', 'pageview');
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
		$wp_customize->add_setting( 'page_for_' . $type, array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_for_' . $type, array(
			'label' => __( $label . ' Archive Page', 'bcore' ),
			'section' => 'static_front_page',
			'settings' => 'page_for_' . $type,
			'type' => 'dropdown-pages'
		))); 
	}	
}

add_filter( 'display_post_states', 'BrandCo_PostTypeArchivePageLabels' );
function BrandCo_PostTypeArchivePageLabels( $states ) {
	global $post;
	$custom_post_types = get_post_types( array( '_builtin' => false ) );
	foreach ( $custom_post_types as $type ) {
		$details = get_post_type_object( $type );
		$label = $details->label;

		if ( $post->ID == get_theme_mod( 'page_for_' . $type ) ) {
			return array(  $label . ' Page' );
		}
	}
	return $states;
}

/**
 * Set default page order
 */

add_filter( 'wp_insert_post_data', 'brandco_default_menu_order' );
function brandco_default_menu_order( $data ) {
	if ( $data['post_status'] == 'auto-draft' ) {
		$data['menu_order'] = 999;
	}
	return $data;
}

/**
 * Paging
 */

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

/**
 * Open Graphs
 */

add_action('wp_head', 'BrandCo_OG');
function BrandCo_OG() {
	echo '<meta property="og:site_name" content="' . get_bloginfo('title') . '" />';
	echo '<meta property="og:title" content="' . get_bloginfo('title') . ' - ' . get_bloginfo('description') . '" />';
	if ( get_option('CompanyLogo') )
		echo '<meta property="og:image" content="' . get_option('CompanyLogo') . '" />';
}

/**
 * Gravity Forms Customizer Setting
 */

if ( class_exists('WP_Customize_Control') ) :
	class WP_Customize_Gravity_Forms extends WP_Customize_Control {
		public function render_content() {

			if ( ! class_exists('GFAPI') ) { echo '<label><span class="customize-control-title" style="color: #c40000; ">There is supposed to be an option here, but Gravity Forms is disabled! Please notify your web developer! </span></label>'; return; }

			$forms = GFAPI::get_forms();

			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<span class="description customize-control-description">First, go back to the dashboard and create a form in "Forms" on the left menu. </span>
					<select <?php $this->link(); ?>>
						<option value="0"> -- Pick one</option>
						<?php 
							foreach ( $forms as $form ) {
								echo "<option " . selected( $this->value(), $form['id'] ) . " value='" . $form['id'] . "'>" . $form['title'] . "</option>";
							}
						?>
					</select>
				</label>
			<?php

		}
	}
endif;

add_filter( 'gform_validation_message', 'gravityFormsErrorMessage', 10, 2 );
function gravityFormsErrorMessage( $message, $form ) {
    return "<div class='validation_error'>There was a problem, please fill in the required fields.</div>";
}

