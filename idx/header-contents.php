<?php 
// Load Wordpress
include '../wp-load.php';

// If mulitsite, get correct blog ID
if ( is_multisite() ) { switch_to_blog( get_current_blog_id() ); }

// Get header
get_header(); ?>