<?php
/**
 * 
 * @package 
 */ 
?>

<div id="SiteMasthead">

	<header id="SiteHeader" role="banner">
		<div class="HeaderContainer">
			
		</div>
	</header>
	
	<?php if ( has_nav_menu('primary') ): ?>
		<nav id="SiteNavigation" class="SimpleResponsiveNav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

			<div class="HeaderContainer">
				<a href="#0" id="MobileToggle"><i class="fa fa-bars"></i> MENU</a>
				<?php 
					wp_nav_menu( 
						array( 
							'theme_location' => 'primary',
							'items_wrap'      => '<ul id="PrimaryMenu" class="%2$s">%3$s</ul>',
							'container' => ''
						) 
					); 
				?>
			</div>
		</nav>	
	<?php endif; ?>

</div>
