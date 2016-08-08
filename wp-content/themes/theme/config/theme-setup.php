<?php
/**
 * @package BrandCo Starter Theme
 * @subpackage Theme Setup
 * @author BrandCo. LLC
 */

class ThemeSetup {

	/**
	 * Initiate functions using add_action inside __construct()
	 * @example add_action('hook_name', array($this, 'Function_Name'));
	 */

	public function __construct() {
		add_action('after_setup_theme', array($this, 'Setup'));
		add_action('widgets_init', array($this, 'Widgets'));
		add_action('wp_enqueue_scripts', array($this, 'Frontend_Scripts_Styles'));
		add_action('admin_enqueue_scripts', array($this, 'Backend_Scripts_Styles'));
		add_action('admin_init', array($this, 'Content_Editor_Stylesheet'));
		add_action('wp_footer', array($this, 'Google_Analytics'));
		add_action('customize_register', array($this, 'Post_Type_Archives_Setup'));
		add_filter('display_post_states', array($this, 'Post_Type_Archives_Setup_Labels'));
		add_filter('gform_validation_message', array($this, 'Gravity_Forms_Error_Message'), 10, 2);
		add_action('wp_head', array($this, 'Open_Graph'));
		add_filter('wp_insert_post_data', array($this, 'Default_PagePost_Menu_Order'));
		add_action('widgets_init', array($this, 'Backend_Cleanup_Widgets'));
		add_action('wp_insert_post_data', array($this, 'Comments_Off_By_Default'));
		add_action('add_meta_boxes', array($this, 'Remove_Custom_Fields_Metabox'));
		add_action('init', array($this, 'WP_Head_Cleanup'));
		add_filter('tiny_mce_before_init', array($this, 'Add_Content_Editor_Formats'));
		add_filter('mce_buttons_2', array($this, 'Add_Formats_Dropdown_To_Content_Editor'));
		add_action('admin_init', array($this, 'Add_Backend_Content_Editor_Stylesheet'));
		add_filter('nav_menu_link_attributes', array($this, 'add_schema_org_attributes_to_menu'), 10, 3 );
	}

	/**
	 * General Theme Setup
	 */

	public function Setup() {

		/**
		 * @see https://codex.wordpress.org/Content_Width
		 */

		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

		/**
		 * @see https://codex.wordpress.org/Function_Reference/add_theme_support
		 */

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

		/**
		 * Add and update default image sizes
		 * uploaded to the media library
		 * @see https://developer.wordpress.org/reference/functions/add_image_size/
		 */

		add_image_size('placeholder', 30, 30);
		update_option('thumbnail_size_w', 300);
		update_option('thumbnail_size_h', 300);
		update_option('medium_size_w', 600);
		update_option('medium_size_h', 600);
		update_option('large_size_w', 1200);
		update_option('large_size_h', 1200);

		/**
		 * Add navigation menu locations to the theme
		 * @see https://codex.wordpress.org/Function_Reference/register_nav_menus
		 */

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Main Navigation', 'brandco' ),
				'mobile' => esc_html__( 'Mobile Navigation', 'brandco' ),
				'footer' => esc_html__( 'Footer Links', 'brandco' )
			)
		);

		/**
		 * Move Yoast SEO metabox below custom fields
		 */

		add_filter(
			'wpseo_metabox_prio',
			function() {
				return 'low';
			}
		);

		/**
		 * Fixes Gravity Forms confirmation anchor problem
		 */

		add_filter(
			'gform_confirmation_anchor',
			create_function(
				'',
				'return false;'
			)
		);

		/**
		 * Add ACF Custom Options Page
		 */

		if ( function_exists('acf_add_options_page') ) {
			acf_add_options_page(
				array(
					'page_title' => get_bloginfo('title') . ' Website Settings',
					'menu_title' => get_bloginfo('title') . ' Website Settings',
					'menu_slug' => 'bco-general-settings',
					'parent_slug' => 'themes.php',
					'capability' => 'edit_posts',
					'redirect' => false
				)
			);
		}
	}

	public function Widgets() {

		/**
		 * Add sidebar areas to the theme
		 * @see https://codex.wordpress.org/Function_Reference/register_sidebar
		 */

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

	/**
	 * Enqueue scripts and styles
	 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 */

	public function Frontend_Scripts_Styles() {
		// Scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'brandco-theme-scripts', SCRIPTS_DIRECTORY_URI . 'main.min.js', array('jquery'), null, true );

		// Styles
		wp_enqueue_style( 'brandco-theme-style', STYLESHEET_DIRECTORY_URI . 'main.min.css' );

		// Google Fonts
		if ( GOOGLE_FONTS ) {
			wp_register_style( 'brandco-google-font', 'https://fonts.googleapis.com/css?family=' . GOOGLE_FONTS);
			wp_enqueue_style( 'brandco-google-font' );
		}
	}

	public function Backend_Scripts_Styles() {
		wp_register_style( 'brandco-admin-css', RESOURCES_DIRECTORY_URI . 'admin/admin.css' );
		wp_enqueue_style( 'brandco-admin-css' );
		wp_enqueue_script( 'brandco-admin-js', RESOURCES_DIRECTORY_URI . 'admin/admin.js', array(), null, true );
	}


	public function Content_Editor_Stylesheet() {
		add_editor_style( RESOURCES_DIRECTORY_URI . 'admin/custom-editor-style.css' );
	}

	/**
	 * Add Google Analytics to the footer of the site
	 */

	public function Google_Analytics() {
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

	/**
	 * Custom options to better setup for custom post type archives and pages
	 */

	public function Post_Type_Archives_Setup($wp_customize) {

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

	/**
	 * Display labels on custom post type archive pages
	 */

	public function Post_Type_Archives_Setup_Labels($states) {
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
	 * Tweak Gravity Forms error message
	 */

	public function Gravity_Forms_Error_Message($message, $form) {
	    return "<div class='validation_error'>There was a problem, please fill in the required fields.</div>";
	}

	/**
	 * Change the default page order when adding new pages
	 */

	public function Default_PagePost_Menu_Order($data) {

		if ( $data['post_status'] == 'auto-draft' ) {
			$data['menu_order'] = 1000;
		}

		return $data;
	}

	/**
	 * Add Open Graph meta to header
	 */

	public function Open_Graph() {
		echo '<meta property="og:site_name" content="' . get_bloginfo('title') . '" />';
		echo '<meta property="og:title" content="' . get_bloginfo('title') . ' - ' . get_bloginfo('description') . '" />';
		if ( get_option('CompanyLogo') )
			echo '<meta property="og:image" content="' . get_option('CompanyLogo') . '" />';
	}

	/**
	 * Cleanup -- Widgets
	 */

	public function Backend_Cleanup_Widgets() {
		// unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		// unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		// unregister_widget('WP_Widget_Search');
		// unregister_widget('WP_Widget_Text');
		// unregister_widget('WP_Widget_Categories');
		// unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
	}

	/**
	 * Comments_Off_By_Default
	 */

	public function Comments_Off_By_Default( $data ) {
		if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
			$data['comment_status'] = 0;
		}
		if( $data['post_type'] == 'post' && $data['post_status'] == 'auto-draft' ) {
			$data['comment_status'] = 0;
		}
		return $data;
	}

	/**
	 * Remove_Custom_Fields_Metabox
	 */

	public function Remove_Custom_Fields_Metabox() {
		global $post_type;
		if ( is_admin() && post_type_supports( $post_type, 'custom-fields' ) ) {
			remove_meta_box( 'postcustom', 'page', 'normal' );
			remove_meta_box( 'postcustom', 'post', 'normal' );
		}
	}

	/**
	 * WP_Head_Cleanup
	 */

	public function WP_Head_Cleanup() {
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'feed_links' );
		remove_action( 'wp_head', 'index_rel_link');
		remove_action( 'wp_head', 'start_post_rel_link');
		remove_action( 'wp_head', 'parent_post_rel_link');
	}

	/**
	 * Add formats to MCE Content Editor
	 */

	public function Add_Formats_Dropdown_To_Content_Editor($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}

	public function Add_Content_Editor_Formats($init_array) {
		$style_formats = array(
			array(
				'title' => 'Button',
				'block' => 'span',
				'classes' => 'content-button',
				'wrapper' => true,
			),
		);
		$init_array['style_formats'] = json_encode($style_formats);
		return $init_array;
	}

	public function Add_Backend_Content_Editor_Stylesheet() {
		add_theme_support('editor_style');
		add_editor_style('/_assets/admin/custom-editor-style.css');
	}

	public function add_schema_org_attributes_to_menu( $atts, $item, $args ) {
		$atts['itemprop'] = 'url';
		return $atts;
	}
}

/**
 * Initiate the ThemeSetup class
 */

new ThemeSetup();
