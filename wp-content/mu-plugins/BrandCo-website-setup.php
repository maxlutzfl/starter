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
		add_action( 'customize_register', array( $this, 'Customizer' ) );
		add_action( 'init', array( $this, 'CPT_Agents' ) );
	}

	public static function Customizer( $wp_customize ) {
	
		$wp_customize->add_setting( 'CompanyLogo', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'CompanyLogo', array(
			'label' => __( 'Company Logo', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'CompanyLogo',
			'description' => 'Your main company logo for the website.',
			'priority' => 100
		))); 

		$wp_customize->add_setting( 'Site_GoogleAnalyticsID', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'Site_GoogleAnalyticsID', array(
			'label' => __( 'Google Analytics UA-XXXXX-X ID', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'Site_GoogleAnalyticsID',
			'priority' => 20
		))); 

		$wp_customize->add_section( 'Section__CompanyInfo' , array(
			'title' => __( 'Company Details', 'brandco' ),
			'priority' => 30
		));

		$wp_customize->add_setting( 'CompanyAddress', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'CompanyAddress', array(
			'label' => __( 'Company Address', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'CompanyAddress'
		))); 

		$wp_customize->add_setting( 'CompanyLocation', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'CompanyLocation', array(
			'label' => __( 'Company Location', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'CompanyLocation'
		))); 

		$wp_customize->add_setting( 'CompanyPhone', array('type' => 'option') );	
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'CompanyPhone', array(
			'label' => __( 'Company Phone Number', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'CompanyPhone'
		))); 

		$wp_customize->add_setting( 'CompanyEmail', array('type' => 'option') );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'CompanyEmail', array(
			'label' => __( 'Company Email Address', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'CompanyEmail'
		))); 

		$wp_customize->add_section( 'Section__SocialMedia' , array(
			'title' => __( 'Social Media', 'brandco' ),
			'priority' => 30,
			'description' => __( '<div class="error" style="padding:8px;"><strong>Important!</strong> Must use "http://" before links.</div>', 'brandco' )
		));

		$wp_customize->add_setting( 'SocialMedia__Facebook', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__Facebook', array(
			'label' => __( 'Facebook URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__Facebook'
		))); 
		
		$wp_customize->add_setting( 'SocialMedia__Twitter', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__Twitter', array(
			'label' => __( 'Twitter URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__Twitter'
		))); 
		
		$wp_customize->add_setting( 'SocialMedia__GooglePlus', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__GooglePlus', array(
			'label' => __( 'Google Plus URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__GooglePlus'
		))); 
		
		$wp_customize->add_setting( 'SocialMedia__Linkedin', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__Linkedin', array(
			'label' => __( 'LinkedIn URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__Linkedin'
		))); 
		
		$wp_customize->add_setting( 'SocialMedia__Pinterest', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__Pinterest', array(
			'label' => __( 'Pinterest URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__Pinterest'
		))); 
		
		$wp_customize->add_setting( 'SocialMedia__Instagram', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__Instagram', array(
			'label' => __( 'Instagram URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__Instagram'
		)));
		
		$wp_customize->add_setting( 'SocialMedia__Youtube', array( 'type' => 'option' ) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'SocialMedia__Youtube', array(
			'label' => __( 'Youtube URL', 'brandco' ),
			'section' => 'Section__CompanyInfo',
			'settings' => 'SocialMedia__Youtube'
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