<?php
/**
 * Website info
 */

function get_website_info($request) {
	switch ($request) {
		case "company-name" :
			return "Company Name";
			break;

		case "company-phone" :
			return "444-444-4444"; 
			break;

		default:
			return;
	}
}