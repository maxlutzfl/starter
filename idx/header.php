<?php 
// Check for correct URL
if ( ! isset( $_GET['site'] ) ) { echo 'Please use http://website.com/header.php?site={SITE_URL}'; return; }

// Get header contents
$site = $_GET['site'] . '/wolfnet/header-contents.php';

// Echo header contents
echo file_get_contents( $site ); ?>

<script>
document.getElementsByTagName('body')[0].setAttribute('id', 'bcowolf');
document.documentElement.setAttribute('data-idx-integration', 'true');
</script>