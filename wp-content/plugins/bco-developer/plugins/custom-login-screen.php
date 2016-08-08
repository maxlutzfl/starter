<?php 

class bco_custom_login_screen {

	// Initialize 
	function __construct() {
		add_action('init', array($this, 'login_screen'));
		// $options = (array) get_option('bco-developer-options-settings');
		// var_dump($options);
		// if ( $options['field_1_1'] > 0 ) {
		// 	add_filter( 'login_headerurl', array($this, 'my_login_logo_url') );
		// 	add_action( 'login_enqueue_scripts', array($this, 'my_login_logo') );
		// 	add_filter( 'login_headertitle', array($this, 'my_login_logo_url_title') );
		// }
	}

	public function login_screen() {
		$options = (array) get_option('bco-developer-options-settings');
		if ( $options['field_1_1_enable_custom_login'] > 0 ) {
				add_filter( 'login_headerurl', array($this, 'my_login_logo_url') );
				add_action( 'login_enqueue_scripts', array($this, 'my_login_logo') );
				add_filter( 'login_headertitle', array($this, 'my_login_logo_url_title') );
		}
	}

	function my_login_logo() {
		$options = (array) get_option('bco-developer-options-settings');
		$field = 'field_1_2_custom_login_logo';
		if ( (array_key_exists($field, $options)) ) { ?>
			<style type="text/css">
				html { background-color: #fff !important; }
				html body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; background-color: transparent; }

				#login h1 a, .login h1 a {
					background-image: url(<?php echo $options['field_1_2_custom_login_logo']; ?>);
					background-size: contain;
					-webkit-background-size: contain;
					width: auto;
				}

				.button-primary {
					background-color: #2196F3 !important;
				}
				html .login form {
					box-shadow: 0 10px 40px rgba(0,0,0,0.1);
				}
			</style>
		<?php }
	}

	function my_login_logo_url() {
	    return home_url();
	}
	
	function my_login_logo_url_title() {
	    return get_bloginfo('title');
	}
}

new bco_custom_login_screen();