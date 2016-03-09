<?php
/**
 * 
 * @package 
 */ ?><!DOCTYPE html> 
<html class="no-js" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">

	<?php wp_head(); ?>	
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

	<div id="SiteMainWrapper">

		<?php get_template_part('_templates/site', 'header'); ?>

