<?php
/*
Plugin Name: BcoRE IDX
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo LLC
Author URI: https://brandco.com/
*/

// add_action('init', 'wolfnet_api_testing');
function wolfnet_api_testing() { 
    $key = 'wp_1aec9f8eb41cfaabd582c7323789c92b';
    $client = new Wolfnet_Api_Client();
    $authenticate = $client->authenticate($key);
    $token = $authenticate['responseData']['data']['api_token'];
    $resource = '/listing?sort=price_desc&min_price=200000&max_price=300000&city=Coon Rapids&maxrows=5&startrow=6';
    $request = $client->sendRequest($token, $resource);

    foreach ( $request['responseData']['data']['listing'] as $listing ) {
    	$link = 'http://starter.bco/listings/' . sanitize_title($listing['display_address']) . '_' . $listing['property_id'];
        echo '<article>';
            echo '<img src="' . $listing['photo_url'] . '">';
            echo '<h1>' . $listing['display_address'] . '</h1>';
            echo '<h2>$' . $listing['listing_price'] . '</h2>';
            echo '<a href="' . $link . '">See listing</a>';
        echo '</article>';
        echo '<br><hr><br>';
    }
}

function wolfnet_get_property_details($property_id) {
	$key = 'wp_1aec9f8eb41cfaabd582c7323789c92b';
	$client = new Wolfnet_Api_Client();
	$authenticate = $client->authenticate($key);
	$token = $authenticate['responseData']['data']['api_token'];
	$resource = '/listing/' . $property_id;
	$request = $client->sendRequest($token, $resource);

	foreach ( $request['responseData']['data']['photo'] as $photo_data ) {
		echo '<img src="' . $photo_data['photo_url'] . '" alt="">';
	} 
}

// add_action('wp_footer', 'bcore_idx');
function bcore_idx() {

	$data = array(
		"key" => "wp_1aec9f8eb41cfaabd582c7323789c92b", 
		"v" => "1"
	);                    

	$data_string = json_encode($data);                                                                                   

	$ch = curl_init('https://api.wolfnet.com/core/auth');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($data_string))                                                                       
	);                                                                                                                   

	$result = curl_exec($ch);

	echo '----';
	var_dump($result);
}
// ---------------------------------------------------------------------------
// Add virtual pages.
// ---------------------------------------------------------------------------

/**
 * First create a query variable addition for the pages. This means that
 * WordPress will recognize index.php?bcoreidx=name
 */
function example_bcoreidx_query_vars($vars) {
	$vars[] = 'bcoreidx';
	return $vars;
}
add_filter('query_vars', 'example_bcoreidx_query_vars');

/**
 * Add redirects to point desired virtual page paths to the new 
 * index.php?bcoreidx=name destination.
 *
 * After this code is updated, the permalink settings in the administration
 * interface must be saved before they will take effect. This can be done 
 * programmatically as well, using flush_rewrite_rules() triggered on theme
 * or plugin install, update, or removal.
 */
function example_bcoreidx_add_rewrite_rules() {
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
add_action('init', 'example_bcoreidx_add_rewrite_rules');

/**
 * Assign templates to the virtual pages.
 */
function example_bcoreidx_template_include($template) {
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
			$new_template = dirname( __FILE__ ) . '/listings.php';
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
add_filter('template_include', 'example_bcoreidx_template_include');




