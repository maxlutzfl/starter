<?php
/**
 * List of properties
 */

class BcoreIDXListShortcode {

	public function __construct() {
		add_shortcode('bcoreidx_list', array($this, 'list_shortcode'));	
	}

	public function list_shortcode($attributes) {

		$query = new BcoreIDXQueryListings(
			array(
				'search_criteria' => array(
					'min_price' => '100000',
					'max_price' => '300000',
					'city' => 'Coon Rapids',
					'maxrows' => 7
				)
			)
		);

		echo '<pre>';
		var_dump($query->loop_info());
		echo '</pre>';

		echo '<ul>';
		while ( $query->has_listings() ) {
			$query->the_listing();

			$address = $query->get_listing_data()->display_address;
			$property_id = $query->get_listing_data()->property_id;
			$link = get_option('siteurl') . '/listings/' . sanitize_title($address) . '@' . $property_id;

			echo '<li>';
				echo 'Listing title: ' . $query->get_listing_data()->display_address;
				echo '<a href="' . $link . '">View this listing</a>';
			echo '</li>';
		}
		echo '</ul>';

		echo '<a href="' . get_option('siteurl') . '/listings/?startrow=' . $query->loop_info()['pages']['last'] . '">Last Page</a>';
		echo '<a href="' . get_option('siteurl') . '/listings/?startrow=' . $query->loop_info()['pages']['next'] . '">Next Page</a>';

	}
}