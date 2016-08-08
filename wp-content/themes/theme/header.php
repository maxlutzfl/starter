<!DOCTYPE html> 
<html <?php language_attributes(); ?> class="no-js" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png">
	<?php wp_head(); ?>	
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<div id="site-wrapper" class="site-wrapper">
		<?php get_template_part('templates/site', 'header'); ?>