<?php 
/** 
 * @package BrandCo Starter Theme
 * @subpackage Site Masthead Template
 * @author BrandCo. LLC
 */ 
use BrandCo\Config\Functions;
?>


<div id="siteMasthead" class="siteMasthead" data-fixed-masthead>
	<header id="siteHeader" class="siteHeader" role="banner">
		<div class="siteHeader-container">

			<div class="siteHeader-logoSide">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="siteHeader-homeLink __background-contain" itemscope itemtype="http://schema.org/Organization" style="background-image: url(<?php echo Functions\ImgDir('brandco-logo.png'); ?>); ">
					<span class="screen-reader-object" itemprop="name"><?php bloginfo('title'); ?></span>
					<span class="screen-reader-object" itemprop="description"><?php bloginfo('description'); ?></span>
					<img class="screen-reader-object" src="<?php echo Functions\ImgDir('brandco-logo.png'); ?>" alt="<?php bloginfo('title'); ?> Logo" itemprop="logo">
				</a>			
			</div>

			<div class="siteHeader-navSide">
				<?php if ( has_nav_menu('primary') ): ?>
					<nav id="mainNavigation" class="mainNavigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<a href="#0" id="mobileMenu-toggle" class="mobileMenu-toggle" data-mobile-menu-toggle>
							<span>MENU</span>
						</a>
						<?php 
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'items_wrap' => '<ul id="primaryMenu" class="primaryMenu %2$s">%3$s</ul>',
									'container' => ''
								)
							);
						?>
					</nav>	
				<?php endif; ?>	
			</div>
			
		</div>
	</header>
</div>
