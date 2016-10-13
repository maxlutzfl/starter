<?php
/**
 * 
 */

$zwsid = $_POST['zws-id'];
$address = $_POST['address'];
$citystatezip = $_POST['citystatezip'];

echo json_encode(simplexml_load_file('http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=' . $zwsid . '&address=' . $address . '&citystatezip=' . $citystatezip));

?>
