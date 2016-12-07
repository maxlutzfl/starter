<?php
/**
 * Query Listings
 */

class BcoreIDXQueryListings {
	public $loop_index;
	public $query_data;
	public $current_listing_loop_index;
	public $number_of_listings;
	public $search_criteria;
	public $startrow;
	public $maxrows;

	function __construct($search_criteria) {
		$this->search_criteria = $search_criteria['search_criteria'];
		$this->setup();
	}

	private function setup() {

		// Setup
		$bcore_query_data = new BcoreIdxRequestData();

		// Per page and page number
		$this->startrow = (isset($_GET) && array_key_exists('startrow', $_GET)) ? $_GET['startrow'] : 1; 
		$this->maxrows = (array_key_exists('maxrows', $this->search_criteria)) ? $this->search_criteria['maxrows'] : 10; 

		// Gather the data we are requesting
		$example_request = array(
			'min_price' => '100000',
			'max_price' => '300000',
			'city' => 'Coon Rapids',
			'maxrows' => $this->maxrows,
			'startrow' => $this->startrow
		);

		$query_listings = $bcore_query_data->get_listings($example_request);

		$this->current_listing_loop_index = 0;
		$this->all_query_data = $query_listings;
		$this->query_data = $query_listings->data->listing;
		$this->number_of_listings = count($this->query_data);

		// echo '<pre>';
		// var_dump($this->query_data);
		// echo '</pre>';
	}

	public function loop_info() {
		$data['current_page']['limit'] = (int) $this->maxrows;
		$data['current_page']['total'] = (int) $this->all_query_data->data->total_rows;
		$data['current_page']['first'] = (int) $this->startrow;
		$data['current_page']['last'] = (int) ($this->startrow + $this->maxrows) - 1;

		$data['pages']['total'] = (int) ceil($this->all_query_data->data->total_rows / $this->maxrows);
		$data['pages']['current'] = floor(($data['current_page']['limit'] / $data['current_page']['total']));
		$data['pages']['next'] = ($data['current_page']['last'] + 1);
		$data['pages']['last'] = ($data['current_page']['first'] - $data['current_page']['limit']);

		return $data;
	}

	public function get_current_loop_index() {
		$index = $this->current_listing_loop_index - 1;
		return $index;
	}

	public function has_listings() {
		$keep_looping = ( $this->get_current_loop_index() < ($this->number_of_listings - 1) ) ? true : false;
		return $keep_looping;
	}

	public function the_listing() {
		$this->current_listing_loop_index++;
	}

	public function get_listing_data() {
		return $this->query_data[$this->get_current_loop_index()];
	}
}