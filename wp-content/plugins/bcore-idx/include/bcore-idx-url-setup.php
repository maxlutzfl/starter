<?php
/**
 * URL Setup
 */

class BcoreIDXURLSetup {

	function __construct() {
		add_filter('template_include', array($this, 'template_include'));
		add_action('init', array($this, 'add_rewrite_rules'));
		add_filter('query_vars', array($this, 'query_vars'));
	}

	public function template_include($template) {
		global $wp_query;
		$new_template = '';

		if ( array_key_exists('listingdetails', $wp_query->query_vars) ) {
			// var_dump($wp_query->query_vars);
		}

		if (array_key_exists('bcoreidx', $wp_query->query_vars)) {
			switch ($wp_query->query_vars['bcoreidx']) {

				case 'listings':

				// We expect to find bcoreidx-listings.php in the 
				// currently active theme.
				$new_template = BCORE_IDX_PLUGIN_DIRECTORY . '/templates/listings.php';
				break;
			}

			if ($new_template != '') {
				return $new_template;
			} else {

				// This is not a valid bcoreidx value, so set the header and template
				// for a 404 page.
				$wp_query->set_404();
				status_header(404);
				return get_404_template();
			}
		}

		return $template;
	}

	public function add_rewrite_rules() {
		add_rewrite_tag('%bcoreidx%', '([^&]+)');
		add_rewrite_rule(
			'listings/?$',
			'index.php?bcoreidx=listings',
			'top'
			);

	  // An alternative approach.
	  // add_rewrite_rule(
	  //   'vp/([^/]*)/?$',
	  //   'index.php?bcoreidx=$matches[1]',
	  //   'top'
	  // );

	  // There is also nothing stopping you from declaring more new variables
	  // via query_vars and mixing them in if a page needs additional parameters.
		add_rewrite_tag('%listingdetails%', '([^&]+)');
		add_rewrite_rule(
			'listings/([^/]*)/?$',
			'index.php?bcoreidx=listings&listingdetails=$matches[1]',
			'top'
		);
	}

	public function query_vars($vars) {
		$vars[] = 'bcoreidx';
		return $vars;
	}
}