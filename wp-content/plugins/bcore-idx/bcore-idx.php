<?php
/*
Plugin Name: BcoRE IDX
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo LLC
Author URI: https://brandco.com/
*/

add_action('wp_footer', 'bcore');
function bcore() {

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
