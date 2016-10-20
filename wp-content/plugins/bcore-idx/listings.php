<?php get_header(); ?>
<h1>Listing Details Page Template</h1>
<?php global $wp_query; ?>

<?php if ( array_key_exists('listingdetails', $wp_query->query_vars) ) : ?>
	<?php wolfnet_get_property_details($wp_query->query_vars['listingdetails']); ?>
<?php else : ?>
	<?php wolfnet_api_testing(); ?>
<?php endif; ?>

<?php get_footer(); ?>