<?php
$api_key = $_POST['key'];
$version = $_POST['v'];

echo $api_key;
echo file_get_contents('http://api.wolfnet.com/core/auth');