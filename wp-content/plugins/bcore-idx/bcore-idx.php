<?php
/*
Plugin Name: BcoRE IDX
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo LLC
Author URI: https://brandco.com/
*/

define('BCORE_IDX_PLUGIN_DIRECTORY', plugin_dir_path(__FILE__));

/** 
 * Setup URLs 
 */
require BCORE_IDX_PLUGIN_DIRECTORY . '/include/bcore-idx-url-setup.php';
new BcoreIDXURLSetup();

/**
 * Setup shortcodes
 */
require BCORE_IDX_PLUGIN_DIRECTORY . '/shortcodes/list-shortcode.php';
new BcoreIDXListShortcode();

/**
 * Include
 */
require BCORE_IDX_PLUGIN_DIRECTORY . '/include/bcore-idx-request-data.php';
require BCORE_IDX_PLUGIN_DIRECTORY . '/include/bcore-idx-query-listings.php';
require BCORE_IDX_PLUGIN_DIRECTORY . '/include/bcore-idx-query-listing.php';
require BCORE_IDX_PLUGIN_DIRECTORY . '/include/bcore-idx-functions.php';




// add_action('init', 'wolfnet_api_testing');
// function wolfnet_api_testing() { 

// 	$args = array(
// 		'min_price' => '100000',
// 		'max_price' => '300000',
// 		'city' => 'Coon Rapids',
// 		'maxrows' => 5,
// 		'startrow' => 6
// 	);

// 	$listings = new BcoreListingsQuery();
// 	$listings_data = $listings->get_listings($args);

// 	foreach ( $listings->get_listings_data($listings_data) as $listing_data ) {
// 		$address = $listings->get_listing_address($listing_data);

// 		echo '<article>';
// 			// echo '<img src="' . $listing['photo_url'] . '">';
// 			echo '<h1>' . $address . '</h1>';
// 			// echo '<a href="' . $link . '">See listing</a>';
// 			echo '</article>';
// 		echo '<br><hr><br>';
// 	}

    // var_dump($request);
    // foreach ( $listings['responseData']['data']['listing'] as $listing ) {
    // 	$link = 'http://starter.bco/listings/' . sanitize_title($listing['display_address']) . '_' . $listing['property_id'];
    //     echo '<article>';
    //         echo '<img src="' . $listing['photo_url'] . '">';
    //         echo '<h1>' . $listing['display_address'] . '</h1>';
    //         echo '<h2>$' . $listing['listing_price'] . '</h2>';
    //         echo '<a href="' . $link . '">See listing</a>';
    //     echo '</article>';
    //     echo '<br><hr><br>';
    // }
// }

// function wolfnet_get_property_details($property_id) {
// 	$key = 'wp_1aec9f8eb41cfaabd582c7323789c92b';
// 	$client = new Wolfnet_Api_Client();
// 	$authenticate = $client->authenticate($key);
// 	$token = $authenticate['responseData']['data']['api_token'];
// 	$resource = '/listing/' . $property_id;
// 	$request = $client->sendRequest($token, $resource);

// 	foreach ( $request['responseData']['data']['photo'] as $photo_data ) {
// 		echo '<img src="' . $photo_data['photo_url'] . '" alt="">';
// 	} 
// }

// add_action('wp_footer', 'bcore_idx');
// function bcore_idx() {

// 	$data = array(
// 		"key" => "wp_1aec9f8eb41cfaabd582c7323789c92b", 
// 		"v" => "1"
// 	);                    

// 	$data_string = json_encode($data);                                                                                   

// 	$ch = curl_init('https://api.wolfnet.com/core/auth');                                                                      
// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
// 		'Content-Type: application/json',                                                                                
// 		'Content-Length: ' . strlen($data_string))                                                                       
// 	);                                                                                                                   

// 	$result = curl_exec($ch);

// 	echo '----';
// 	var_dump($result);
// }
// ---------------------------------------------------------------------------
// Add virtual pages.
// ---------------------------------------------------------------------------

/**
 * First create a query variable addition for the pages. This means that
 * WordPress will recognize index.php?bcoreidx=name
 */


/**
 * Add redirects to point desired virtual page paths to the new 
 * index.php?bcoreidx=name destination.
 *
 * After this code is updated, the permalink settings in the administration
 * interface must be saved before they will take effect. This can be done 
 * programmatically as well, using flush_rewrite_rules() triggered on theme
 * or plugin install, update, or removal.
 */



/**
 * Assign templates to the virtual pages.
 */






