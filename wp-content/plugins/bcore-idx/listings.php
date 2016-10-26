<?php get_header(); ?>
<h1>Listing Details Page Template</h1>
<?php global $wp_query; ?>

<?php if ( array_key_exists('listingdetails', $wp_query->query_vars) ) : ?>

	<?php $url = $wp_query->query_vars['listingdetails'] ?>
	<?php $url_parts = explode("_", $url); ?>
	<?php wolfnet_get_property_details($url_parts[1]); ?>
<?php else : ?>
	<?php wolfnet_api_testing(); ?>
<?php endif; ?>

<?php get_footer(); ?>