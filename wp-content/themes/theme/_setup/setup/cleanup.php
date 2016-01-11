<?php
/**
 * @package 
 */

// Moved SEO Yoast metabox below important ones
add_filter( 
	'wpseo_metabox_prio', 
	function() {
		return 'low';
	}
);

// Fix anchor jumping when form is submitted
add_filter(
	'gform_confirmation_anchor', 
	create_function(
		'',
		'return false;'
	)
);