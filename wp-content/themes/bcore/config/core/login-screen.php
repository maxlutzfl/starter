<?php
/**
 * Login Screen
 * @package bcore
 */

add_filter('login_headerurl', 'bcore_login_logo_url');
add_action('login_enqueue_scripts', 'bcore_login_logo');
add_filter('login_headertitle', 'bcore_login_logo_url_title');

function bcore_login_logo_url() {
    return home_url();
}

function bcore_login_logo_url_title() {
    return get_bloginfo('title');
}

function bcore_login_logo() {
	?>
		<style type="text/css">
			html { background-color: #fff !important; }
			html body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; background-color: #ECEFF1; }

			#login h1 a, .login h1 a {
				background-image: url(<?php echo get_template_directory_uri(); ?>/login-icon.png);
				background-size: contain;
				-webkit-background-size: contain;
				width: auto;
			}
		</style>
	<?php 
}