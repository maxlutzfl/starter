<?php
/**
 * 
 * @package 
 */ ?><!DOCTYPE html> 
<html prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>	
</head>
<body itemscope itemtype="http://schema.org/WebPage">
	<div id="SiteMainWrapper">
		
		<header id="SiteHeader" role="banner"></header>
		<nav id="SiteNavigation" role="navigation"></nav>

		<main id="SiteMain" role="main">
			<header id="PageHeader"></header>
			<section id="PageMain"></section>
			<footer id="PageFooter"></footer>
		</main>

		<footer id="SiteFooter" role="contentinfo"></footer>

	</div>

	<div id="MobileNavigation" aria-hidden="true"></div>

	<?php wp_footer(); ?>
</body>
</html>