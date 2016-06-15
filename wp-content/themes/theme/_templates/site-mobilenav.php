<?php
/**
 * Mobile Nav
 * @package brandco
 */ 
?>

<div id="mobileNavigation" class="mobileNavigation" aria-hidden="true">
	<div class="mobileNavigation-container">
		
		<div id="mobileNavigation-close" class="mobileNavigation-close" title="Close Menu" data-mobile-menu-close>&times;</div>

		<div class="mobileNavigation-header">

			<img src="<?php echo BrandCo\ImgDir('brandco-logo.png'); ?>" alt="<?php bloginfo('title'); ?> Logo" itemprop="logo">

		</div>

		<div class="mobileNavigation-body">
			<div class="mobileNavigation-links">
				<ul>
					<?php BrandCo\MobileNav(); ?>
				</ul>				
			</div>
		</div>

		<div class="mobileNavigation-footer">
			<ul>
				<li> ... </li>
				<li> ... </li>
				<li> ... </li>
			</ul>
		</div>

	</div>
</div>

<div id="mobileNavigation-overlay" class="mobileNavigation-overlay" aria-hidden="true" data-mobile-menu-close></div>