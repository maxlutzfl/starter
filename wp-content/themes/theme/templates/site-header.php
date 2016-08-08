<div id="site-masthead" class="site-masthead" itemscope itemtype="http://schema.org/WPHeader" data-fixed-masthead>
	<header id="site-header" class="site-header" role="banner">
		<div class="page-container">
			<div class="company-branding" itemscope itemtype="http://schema.org/Organization">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link" itemprop="url">
					<span class="screen-reader-object" itemprop="name"><?php bloginfo('title'); ?></span>
					<span class="screen-reader-object" itemprop="description"><?php bloginfo('description'); ?></span>
					<img src="<?php echo get_image_from_directory('brandco-logo.png'); ?>" alt="<?php bloginfo('title'); ?> Logo" itemprop="logo">
				</a>			
			</div>
			<?php if ( has_nav_menu('primary') ): ?>
				<nav id="main-navigation" class="main-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<a href="#0" id="menu-toggle" class="menu-toggle" data-mobile-menu-toggle>
						<span>MENU</span>
					</a>
					<?php 
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'items_wrap' => '<ul id="primary-menu" class="primary-menu %2$s">%3$s</ul>',
								'container' => ''
							)
						);
					?>
				</nav>	
			<?php endif; ?>	
		</div>
	</header>
</div>