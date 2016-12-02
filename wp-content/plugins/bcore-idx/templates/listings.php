<?php 
/**
 * 
 */
get_header(); 
global $wp_query;
$bcore_idx_functions = new BcoreIDXFunctions();
?>
<h1>Listing Details Page Template</h1>

<?php if ( array_key_exists('listingdetails', $wp_query->query_vars) ) : ?>
	<?php 
		$single_listing_api = new BcoreIDXListing();
		$listing_id = $bcore_idx_functions->get_listing_id();
		$listing_data = $single_listing_api->request_listing_data($listing_id);

		highlight_string("<?php\n\$data =\n" . var_export($listing_data, true) . ";\n?>");
	?>

<?php else : ?>
	<?php echo do_shortcode('[bcoreidx_list]'); ?>
<?php endif; ?>

<?php get_footer(); ?>