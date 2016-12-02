<?php
/**
 * Functions
 */

class BcoreIDXFunctions {

	public function get_full_address($data) {
		
	}

	public function get_listing_id() {
		global $wp_query;
		$id = false;
		if ( array_key_exists('listingdetails', $wp_query->query_vars) ) { 
			$url = $wp_query->query_vars['listingdetails'];
			$url_parts = explode('@', $url); 
			$id = $url_parts[1]; 
		} else {
			return false;
		}
		return $id;
	}

}