<?php
/**
 * Plugin Name: BrandCo. Website Setup
 * Plugin URI: https://brandco.com/
 * Version: 1.0
 * Author: BrandCo LLC
 * Description: BrandCo. custom website setup.
 * Text Domain: brandco
 * License: GPLv3
 */

if ( !class_exists( 'BrandCo_WebsiteSetup' ) ) :

class BrandCo_WebsiteSetup {

	function __construct() {
		// add_action( 'customize_register', array( $this, 'Customizer' ) );
		add_action( 'init', array( $this, 'CPT_Agents' ) );
	}

	public static function Customizer( $wp_customize ) {

		$wp_customize->add_section( 'section-logo' , array(
			'title' => __( 'Logo', 'brandco' ),
			'priority' => 30
		));

		$wp_customize->add_setting( 'company-logo', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'company-logo', array(
			'label' => __( 'Upload Logo', 'brandco' ),
			'section' => 'section-logo',
			'settings' => 'company-logo',
			'description' => 'Your main company logo for the website.',
			'priority' => 100
		))); 

		$wp_customize->add_section( 'section-analytics' , array(
			'title' => __( 'Analytics', 'brandco' ),
			'priority' => 30
		));

		$wp_customize->add_setting( 'google-analytics-id', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google-analytics-id', array(
			'label' => __( 'Google Analytics UA-XXXXX-X ID', 'brandco' ),
			'section' => 'section-analytics',
			'settings' => 'google-analytics-id',
			'priority' => 20
		))); 

		$wp_customize->add_section( 'section-company' , array(
			'title' => __( 'Company Info', 'brandco' ),
			'priority' => 30
		));

		$wp_customize->add_setting( 'company-title', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company-title', array(
			'label' => __( 'Company Title', 'brandco' ),
			'section' => 'section-company',
			'settings' => 'company-title'
		))); 

		$wp_customize->add_setting( 'company-address', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company-address', array(
			'label' => __( 'Company Address', 'brandco' ),
			'section' => 'section-company',
			'settings' => 'company-address'
		))); 

		$wp_customize->add_setting( 'company-location', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company-location', array(
			'label' => __( 'Company Location', 'brandco' ),
			'section' => 'section-company',
			'settings' => 'company-location'
		))); 

		$wp_customize->add_setting( 'company-phone', array('type' => 'option') );	
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company-phone', array(
			'label' => __( 'Company Phone Number', 'brandco' ),
			'section' => 'section-company',
			'settings' => 'company-phone'
		))); 

		$wp_customize->add_setting( 'company-email', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company-email', array(
			'label' => __( 'Company Email Address', 'brandco' ),
			'section' => 'section-company',
			'settings' => 'company-email'
		))); 

		$wp_customize->add_section( 'section-social-media' , array(
			'title' => __( 'Social Media', 'brandco' ),
			'priority' => 30,
			'description' => __( '<div class="error" style="padding:8px;"><strong>Important!</strong> Must use "http://" before links.</div>', 'brandco' )
		));

		$wp_customize->add_setting( 'facebook-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook-link', array(
			'label' => __( 'Facebook URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'facebook-link'
		))); 
		
		$wp_customize->add_setting( 'twitter-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter-link', array(
			'label' => __( 'Twitter URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'twitter-link'
		))); 
		
		$wp_customize->add_setting( 'google-plus-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google-plus-link', array(
			'label' => __( 'Google Plus URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'google-plus-link'
		))); 
		
		$wp_customize->add_setting( 'linkedin-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin-link', array(
			'label' => __( 'LinkedIn URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'linkedin-link'
		))); 
		
		$wp_customize->add_setting( 'pinterest-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest-link', array(
			'label' => __( 'Pinterest URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'pinterest-link'
		))); 
		
		$wp_customize->add_setting( 'instagram-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram-link', array(
			'label' => __( 'Instagram URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'instagram-link'
		)));
		
		$wp_customize->add_setting( 'youtube-link', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube-link', array(
			'label' => __( 'Youtube URL', 'brandco' ),
			'section' => 'section-social-media',
			'settings' => 'youtube-link'
		)));
	}

	public static function CPT_Agents() {
		$menu_name = 'Employees';
		$regular_name = 'Employees';
		$singular_name = 'Employee';
		$register_name = 'employees';
		$icon = 'dashicons-businessman';

		$labels = array(
			'name'               => _x( $regular_name, 'post type general name', 'brandco' ),
			'singular_name'      => _x( $singular_name, 'post type singular name', 'brandco' ),
			'menu_name'          => _x( $menu_name, 'admin menu', 'brandco' ),
			'name_admin_bar'     => _x( $singular_name, 'add new on admin bar', 'brandco' ),
			'add_new'            => _x( 'Add New', $register_name, 'brandco' ),
			'add_new_item'       => __( 'Add New ' . $singular_name, 'brandco' ),
			'new_item'           => __( 'New ' . $singular_name, 'brandco' ),
			'edit_item'          => __( 'Edit ' . $singular_name, 'brandco' ),
			'view_item'          => __( 'View ' . $singular_name, 'brandco' ),
			'all_items'          => __( 'All ' . $regular_name, 'brandco' ),
			'search_items'       => __( 'Search ' . $regular_name, 'brandco' ),
			'parent_item_colon'  => __( 'Parent ' . $regular_name . ':', 'brandco' ),
			'not_found'          => __( 'No ' . $regular_name . ' found.', 'brandco' ),
			'not_found_in_trash' => __( 'No ' . $regular_name . ' found in Trash.', 'brandco' )
		);

		# There is a customizer option to choose a Page. 
		# If a Page is chosen, refresh the permalinks to 
		# use that page's slug for this custom post type
		$theme_mod_id = get_theme_mod( 'page_for_' . $register_name );
		if ( $theme_mod_id ) {
			global $post;
			$slug_by_id = get_post( $theme_mod_id )->post_name;
			$slug = array( 'slug' => $slug_by_id );
		} else {
			$slug = array( 'slug' => $register_name );
		}

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => $slug,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => $icon,
			'supports'           => array( 'title', 'editor', 'page-attributes', 'thumbnail'  )
		);
		register_post_type( $register_name, $args );		
	}
}

new BrandCo_WebsiteSetup();

endif;