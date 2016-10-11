<?php
// Check for correct URL
if ( ! isset( $_GET['site'] ) ) { 
	echo 'Please use http://website.com/footer.php?site={SITE_URL}'; return; 
}

// Get footer contents
$site = $_GET['site'] . '/idx/footer-contents.php';

// Return footer contents
echo file_get_contents($site); ?>