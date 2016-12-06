<?php 
/**
 * Customizer Options
* @package bcore
 */

add_action('customize_register', 'bcore_customize_register');
function bcore_customize_register($wp_customize) {

	// Structure the custom fields
	// for the customize editor
	$customizer_sections = array(
		array(
			'title' => 'Logo',
			'id' => 'logo_section',
			'fields' => array(
				array(
					'title' => 'Logo',
					'id' => 'company_logo',
					'class' => 'WP_Customize_Image_Control'
				)
			)
		),
		array(
			'title' => 'Website Settings',
			'id' => 'website_settings_section',
			'fields' => array(
				array(
					'title' => 'Fallback Image',
					'description' => 'Used throughout the site in areas where an image is required but one has not yet been selected.',
					'id' => 'fallback_image',
					'class' => 'WP_Customize_Image_Control'
				)
			)
		),
		array(
			'title' => 'Company Information',
			'id' => 'company_info_section',
			'fields' => array(
				array(
					'title' => 'Company Title',
					'id' => 'company_title',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Office/Location Title',
					'id' => 'office_title',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Office Address',
					'id' => 'offce_address',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Office Location',
					'id' => 'offce_location',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Contact Number',
					'id' => 'office_number',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Contact Email',
					'id' => 'office_email',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Fax Number',
					'id' => 'office_fax',
					'class' => 'WP_Customize_Control'
				),
			),
		),
		array(
			'title' => 'Social Media',
			'id' => 'social_media_section',
			'fields' => array(
				array(
					'title' => 'Facebook',
					'id' => 'facebook_link',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Twitter',
					'id' => 'twitter_link',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Google Plus',
					'id' => 'google_plus_link',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'LinkedIn',
					'id' => 'linkedin_link',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Pinterest',
					'id' => 'pinterest_link',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'Instagram',
					'id' => 'instagram_link',
					'class' => 'WP_Customize_Control'
				),
				array(
					'title' => 'YouTube',
					'id' => 'youtube_link',
					'class' => 'WP_Customize_Control'
				),
			)
		),
		array(
			'title' => 'Analytics',
			'id' => 'analytics_section',
			'fields' => array(
				array(
					'title' => 'Google Analytics UA-XXXXX-X ID',
					'id' => 'google_analytics_id',
					'class' => 'WP_Customize_Control'
				)
			)
		),
		array(
			'title' => 'Developers',
			'id' => 'developers_section',
			'fields' => array(
				array(
					'title' => 'Hide Developer Messages',
					'id' => 'dev_warnings',
					'class' => 'WP_Customize_Control',
					'type' => 'checkbox'
				),
				array(
					'title' => 'Development Environment',
					'id' => 'development_environment',
					'class' => 'WP_Customize_Control',
					'type' => 'select',
					'choices' => array(
						'local' => 'Local',
						'beta' => 'Beta',
						'live' => 'Live'
					)
				),
				array(
					'title' => 'Google Maps API Key',
					'id' => 'google_maps_api_key',
					'class' => 'WP_Customize_Control'
				)
			)
		),
	);

	// Loop through the sections
	foreach ( $customizer_sections as $section ) {
		$section_id = $section['id'];
		$section_title = $section['title'];

		$wp_customize->add_section(
			$section_id, 
			array(
				'title' => $section_title,
				'priority' => 20
			)
		);

		// Loop through the fields
		foreach ( $section['fields'] as $field ) {
			$field_title = $field['title'];
			$field_description = (array_key_exists('description', $field)) ? $field['description'] : ''; 
			$field_id = $field['id'];
			$field_class = $field['class'];
			$field_type = (array_key_exists('type', $field)) ? $field['type'] : ''; 
			$field_choices = (array_key_exists('choices', $field)) ? $field['choices'] : ''; 

			$wp_customize->add_setting(
				$field_id,
				array(
					'type' => 'option'
				) 
			);

			$args = array(
				'label' => $field_title,
				'section' => $section_id,
				'settings' => $field_id,
				'priority' => 10
			);

			($field_description) ? $args['description'] = $field_description : '';
			($field_choices) ? $args['choices'] = $field_choices : '';
			($field_type) ? $args['type'] = $field_type : '';

			$wp_customize->add_control(
				new $field_class(
					$wp_customize, 
					$field_id, 
					$args
				)
			); 
		}
	}
}














