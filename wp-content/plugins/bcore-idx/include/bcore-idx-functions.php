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
			
			// Grab the end of the url for http://site.com/listings/[this_stuff]
			$url = $wp_query->query_vars['listingdetails'];

			// Make sure it contains the @ which separates the address from the listing ID
			if (strpos($url, '@') !== false) {

				// Separates the address from the listing ID
				$url_parts = explode('@', $url); 

				// Return the listing ID
				$id = $url_parts[1]; 
			} else {

				// No listing ID found
				return false;
			}

		} else {
			return false;
		}

		return $id;
	}

}