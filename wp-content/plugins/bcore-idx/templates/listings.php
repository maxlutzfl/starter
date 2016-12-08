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

			// First, check the URL and make sure it actually has a listing ID 
			// Get the listing ID (from the URL)
			$listing_id = $bcore_idx_functions->get_listing_id();

			if ( $listing_id ) {

				// Initialize the class
				$single_listing_api = new BcoreIDXListing();

				// Send request to Wolfnet API with the listing ID
				$listing_data = $single_listing_api->request_listing_data($listing_id);	

				// Data dump
				if (function_exists('var_dump_console_log')) {
					var_dump_console_log($listing_data);
				}
				echo '<img src="' . $listing_data->data->photo[0]->photo_url . '" style="width: 300px;">';
				echo '<h1>' . $listing_data->data->display_address . '</h1>';
				echo '<h2>$' . $listing_data->data->listing_price . '</h2>';
				echo '<h3>' . $listing_data->data->total_bedrooms . ' Beds</h3>';
				echo '<h3>' . $listing_data->data->total_bathrooms . ' Baths</h3>';
				echo apply_filters('the_content', $listing_data->data->remarks);
				echo '<a href="' . get_option('siteurl') . '/listings/"><strong>&larr; Back to listings</strong></a>';

			} else {
				echo 'No listing ID found in the URL';
			}


		// Otherwise the URL is just on /listings/ then show this stuff
		} else {
			echo '<h1>Listings</h1>';
			echo do_shortcode('[bcoreidx_list]');
		}
	?>

<?php get_footer(); ?>