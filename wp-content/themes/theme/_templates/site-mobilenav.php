<?php
/**
 * Mobile Nav
 * @package brandco
 */ 
?>

<div id="MobileNavigation" aria-hidden="true">
	<div class="MobileNavigation--Container">
		
		<div id="MobileNavigation--CloseButton" title="Close Menu">&times;</div>

		<div class="MobileNavigation--Header">

			<?php 
				if ( get_option('CompanyLogo') )
					echo sprintf( '<img src="%s" alt="%s" class="MobileNavigation__logo">', get_option('CompanyLogo'), get_bloginfo('title') . ' Logo' );
				
				else 
					echo sprintf( '<h2 class="MobileNavigation__title">%s</h2>', get_bloginfo('title') );
			?>

		</div>

		<div class="MobileNavigation--Main">
		
			<ul class="MobileNavigation--Links">
				<?php BrandCo\MobileNav(); ?>
			</ul>

		</div>

		<div class="MobileNavigation--Footer">
			<?php /* ?>
			<ul class="MobileNavigation--MoreLinks">
				<li>
					<a href="#">Additional Link</a>
				</li>
				<li>
					<a href="#">Additional Link</a>
				</li>				
			</ul>
			<?php */ ?>
		</div>

	</div>
</div>

<div id="CloseMobileNavigationLayer" aria-hidden="true"></div>