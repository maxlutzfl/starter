<?php
/**
 *
 * For Basic Menu : nav.SimpleResponsiveNav
 * For Popout Menu:  nav.PopoutResponsiveNav
 * 
 * @package 
 */ 
?>

<div id="SiteMasthead">

	<header id="SiteHeader" role="banner" itemscope itemtype="http://schema.org/Organization">
		<div class="HeaderContainer">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="CompanyBranding" itemscope itemtype="http://schema.org/Organization">
				
				<?php if ( get_option('CompanyLogo') ): ?>
					<span id="WebsiteTitle" class="screen-reader-text" itemprop="name"><?php bloginfo('title'); ?></span>
					<?php if ( get_bloginfo('description') ) : ?>
						<span id="WebsiteSlogan" class="screen-reader-text" itemprop="description"><?php bloginfo('description'); ?></span>
					<?php endif ?>
					<?php echo sprintf( '<img src="%s" alt="%s" id="CompanyLogo" class="logo" itemprop="logo">', get_option('CompanyLogo'), get_bloginfo('title') . ' Logo' ); ?>
				
				<?php else : ?>
					<h1 id="WebsiteTitle" itemprop="name"><?php bloginfo('title'); ?></h1>
				<?php endif ?>
			</a>

		</div>
	</header>
	
	<?php if ( has_nav_menu('primary') ): ?>
		<nav id="SiteNavigation" class="PopoutResponsiveNav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

			<div class="HeaderContainer">

				<?php /** Un-Comment For Basic responsive menu ?> <a href="#0" id="MobileToggle"><i class="fa fa-bars"></i> MENU</a> <?php */ ?>
				
				<a href="#0" id="MobileToggle"><i class="Icon__Menu"></i> <span>MENU</span></a>

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
