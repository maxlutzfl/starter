<?php
/**
 * Listings Query
 */

class BcoreListingsQuery {

	public function get_listings($args) {
		$query = $this->get_query_string($args);
		$data = $this->send_request($query);
		return $data;
	}

	private function get_product_key() {
		$key = 'wp_1aec9f8eb41cfaabd582c7323789c92b';
		return $key;
	}

	public function get_offset() {
		$offset = 0;
		return $offset;
	}

	private function get_query_string($args) {
		return http_build_query($args) . "\n";
	}

	private function send_request($query) {
		$key = 'wp_1aec9f8eb41cfaabd582c7323789c92b';
		$client = new Wolfnet_Api_Client();
		$authenticate = $client->authenticate($key);
		$token = $authenticate['responseData']['data']['api_token'];
		$resource = '/listing?' . $query;
		$response = $client->sendRequest($token, $resource);
		return $response;
	}

	public function get_listings_data($data) {
		return $data['responseData']['data']['listing'];
	}

	public function get_listing_address($data) {
		return $data['display_address'];
	}
}

