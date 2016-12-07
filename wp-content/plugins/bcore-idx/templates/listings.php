<?php 
/**
 * Listings Template
 */
get_header(); ?>
	
	<?php 
		global $wp_query;
		$bcore_idx_functions = new BcoreIDXFunctions();

		// Look at the bcore-idx-url-setup.php file
		// Basically, if we are on anything like /listings/blahblah then this will be true
		if ( array_key_exists('listingdetails', $wp_query->query_vars) ) {
			echo '<h1>Single Listing</h1>';

			// Initialize the class
			$single_listing_api = new BcoreIDXListing();

			// Get the listing ID (from the URL)
			$listing_id = $bcore_idx_functions->get_listing_id();

			// Send request to Wolfnet API with the listing ID
			$listing_data = $single_listing_api->request_listing_data($listing_id);

			// Data dump
			var_dump($listing_data);

		// Otherwise the URL is just on /listings/ then show this stuff
		} else {
			echo '<h1>Listings</h1>';
			echo do_shortcode('[bcoreidx_list]');
		}
	?>

<?php get_footer(); ?>