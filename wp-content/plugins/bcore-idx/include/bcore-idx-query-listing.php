<?php
/**
 * Get listing data
 */

class BcoreIDXListing {

	public function request_listing_data($listing_id) {

		// Setup
		$bcore_query_data = new BcoreIdxRequestData();

		// Perform request
		$listing_data = $bcore_query_data->get_listing($listing_id);

		// return 
		return $listing_data;
	}
}