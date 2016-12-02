<?php 
/**
 * @package bcore
 */

function get_development_environment() {
	return ((int) get_option('development-environment') === 1 ? 'local' : 'live';
}