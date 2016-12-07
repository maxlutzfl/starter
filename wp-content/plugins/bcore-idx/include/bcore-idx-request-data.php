<?php
/**
 * Request Data
 */

class BcoreIdxRequestData {

	const EXAMPLE_API_KEY = 'wp_1aec9f8eb41cfaabd582c7323789c92b';
	const WOLFNET_API_HOST = 'https://api.wolfnet.com';

	private $example_api_key = self::EXAMPLE_API_KEY;
	private $wolfnet_api_host = self::WOLFNET_API_HOST;

	// Get many listings
	public function get_listings($request) {
		$key = $this->get_key();
		$token = $this->get_token();

		$request = array(
			'key' => $key,
			'token' => $token,
			'endpoint' => self::WOLFNET_API_HOST . '/listing',
			'method' => 'GET',
			'requested_data' => $request,
		);

		$response = $this->send_request($request);
		$decoded_response = $this->parse_response($response);

		return $decoded_response;
	}

	// Get one listing
	public function get_listing($listing_id) {
		$key = $this->get_key();
		$token = $this->get_token();

		$request = array(
			'key' => $key,
			'token' => $token,
			'endpoint' => self::WOLFNET_API_HOST . '/listing/' . $listing_id,
			'method' => 'GET',
			'requested_data' => '',
		);

		$response = $this->send_request($request);
		$decoded_response = $this->parse_response($response);

		return $decoded_response;
	}

	public function get_listing_photos($property_id) {

	}

	private function get_key() {
		return $this->example_api_key;
	}

	// should be called request token. make new function get_token to decide between a new one or a cached one if its still valid 
	private function get_token() {

		$request = array(
			'key' => $this->get_key(),
			'token' => null,
			'endpoint' => self::WOLFNET_API_HOST . '/core/auth',
			'method' => 'POST',
			'requested_data' => array(
				'key' => $this->get_key(),
				'v' => 1
			),
		);

		$response = $this->send_request($request);
		$decode_response_body = $this->parse_response($response);

		// echo '<pre>'; 
		// var_dump($decode_response_body);
		// echo '</pre>';

		$token = $decode_response_body->data->api_token;
		return $token;
	}

	private function cache_token() {

	}

	private function send_request($request) {

		$method = (array_key_exists('method', $request)) ? $request['method'] : 'GET';

		if ( $method === 'GET' && $request['requested_data'] ) {
			$request_url = add_query_arg(
				$request['requested_data'],
				$request['endpoint']
			);
		} else {
			$request_url = $request['endpoint'];
		}

		$request_data = array(
			'method' => $method,
			'headers' => array(
				'api_token' => $request['token'],
				'Accept-Encoding' => 'gzip, deflate'
			),
			'timeout' => 10,
			'body' => ($method !== 'GET') ? $request['requested_data'] : '',
			'sslverify' => false,
		);

		$response = wp_remote_request(
			$request_url,
			$request_data
		);

		return $response;
	}

	private function parse_response($data) {
		return json_decode($data['body']);
	}
}



