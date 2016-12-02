<?php 
/**
 * Default loop
 */
get_header(); ?>
<?php
	// Get default loop module
	$module = new bcore_module(
		'archive-section',
		'default-loop',
		array()
	);
?>
<?php get_footer(); ?>