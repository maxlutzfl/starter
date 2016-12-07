<?php
/**
 * URL Setup
 * Based on this article:
 * https://www.exratione.com/2016/04/wordpress-4-create-virtual-pages-in-code-without-page-database-entries/
 * Basically, we are hijacking the url /listings/ so if we are at http://site.com/listings/ then it will include the listings template
 */

class BcoreIDXURLSetup {

	function __construct() {
		add_filter('template_include', array($this, 'template_include'));
		add_action('init', array($this, 'add_rewrite_rules'));
		add_filter('query_vars', array($this, 'query_vars'));
	}

	/**
	 * Register the query variable
	 */
	public function query_vars($vars) {
		$vars[] = 'bcoreidx';
		return $vars;
	}

	/**
	 * Add rewrite rules
	 */
	public function add_rewrite_rules() {

		/** 
		 * Add rule for
		 * http://site.com/listings/ 
		 */
		add_rewrite_tag('%bcoreidx%', '([^&]+)');
		add_rewrite_rule(
			'listings/?$',
			'index.php?bcoreidx=listings',
			'top'
		);

		/** 
		 * Add rule for
		 * http://site.com/listings/[listing-stuff-here]
		 */
		add_rewrite_tag('%listingdetails%', '([^&]+)');
		add_rewrite_rule(
			'listings/([^/]*)/?$',
			'index.php?bcoreidx=listings&listingdetails=$matches[1]',
			'top'
		);
	}

	/**
	 * Tell WordPress to load out listings template 
	 * if we are on a /listings/ or /listings/[listing-details] URL
	 */
	public function template_include($template) {
		global $wp_query;

		// Empty for now
		$new_template = '';

		// if ( array_key_exists('listingdetails', $wp_query->query_vars) ) {
		// 	var_dump($wp_query->query_vars);
		// }

		// If we are on http://site.com/listings/
		if ( array_key_exists('bcoreidx', $wp_query->query_vars) ) {
			switch ($wp_query->query_vars['bcoreidx']) {

				case 'listings' :
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
}