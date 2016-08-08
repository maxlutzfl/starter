<?php
/**
Plugin Name: 	Developer Tools
Plugin URI: 	https://brandco.com/
Description: 	Provides a set of tools to help the dev team at BrandCo.
Author: 		BrandCo. LLC
Version: 		1.0
Author URI: 	https://brandco.com/
*/

class bco_developer_options {

	// Initialize 
	function __construct() {
		add_action( 'admin_menu', array($this, 'add_options_page_to_menu') );
		add_action( 'admin_init', array($this, 'options_page_init') );

		require plugin_dir_path( __FILE__ ) . '/plugins/custom-login-screen.php';
	}

	public function add_options_page_to_menu() {
		add_options_page(
			'Developer Options',
			'Developer Options',
			'manage_options',
			'bco_developer_options',
			array(
				$this,
				'create_options_page'
			)
		);
	}

	public function options_page_init() {

		// register_setting
		register_setting( 'bco-developer-options-settings-group', 'bco-developer-options-settings' );

		// Add section 1
		add_settings_section( 
			'bco-developer-options-section-1', 
			'Login Screen Options', 
			array($this, 'section_1_callback'), 
			'bco_developer_options' 
		);

		// Add fields to settings
		add_settings_field('field_1_1', 'Enable customized login page', array($this, 'field_1_1_callback'), 'bco_developer_options', 'bco-developer-options-section-1');
		add_settings_field('field_1_2', 'Login Page Logo', array($this, 'field_1_2_callback'), 'bco_developer_options', 'bco-developer-options-section-1');
	}

	public function create_options_page() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( 'You do not have sufficient permissions to access this page.' );
		}

		?>
			<div class="wrap">
				<h2>Developer Options</h2>
				<form action="options.php" method="POST">
					<?php settings_fields('bco-developer-options-settings-group'); ?>
					<?php do_settings_sections('bco_developer_options'); ?>
					<?php submit_button(); ?>
				</form>
			</div>
		<?php
	}

	public function section_1_callback() {
		// echo paragraph below section title here
	}

	public function field_1_1_callback() {
		$options = (array) get_option('bco-developer-options-settings');
		$field = 'field_1_1_enable_custom_login';
		$value = (array_key_exists($field, $options)) ? $options[$field] : '';
		$checked = (array_key_exists($field, $options)) ? 'checked' : '';
		echo '<input type="checkbox" name="bco-developer-options-settings[' . $field . ']" value="1" ' . $checked . ' />';
	}

	public function field_1_2_callback() {
		$options = (array) get_option('bco-developer-options-settings');
		$field = 'field_1_2_custom_login_logo';
		$value = (array_key_exists($field, $options)) ? $options[$field] : '';
		echo '<input type="text" name="bco-developer-options-settings[' . $field . ']" value="' . $value . '" />';
	}
}

new bco_developer_options();






