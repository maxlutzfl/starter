<?php
// Check
if ( ! isset( $_GET['site'] ) ) { echo 'Please use http://website.com/header.php?site={SITE_URL}'; return; }

// Header
$site = $_GET['site'] . '/idx/header-contents.php';
echo file_get_contents( $site ); 

// Body tag
echo "<script>document.getElementsByTagName('body')[0].setAttribute('id', 'wolf');</script>";

// Footer
$site = $_GET['site'] . '/idx/footer-contents.php';
echo file_get_contents($site); ?>