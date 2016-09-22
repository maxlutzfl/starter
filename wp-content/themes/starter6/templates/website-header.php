<?php 
	$logo = get_option('company-logo'); 
	$title = get_bloginfo('title');
	$description = get_bloginfo('description');
?>

<div id="site-masthead" class="site-masthead" data-fixed-masthead>
	<div class="header-container">
		<header id="site-header" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
			<div class="company-branding" itemscope itemtype="http://schema.org/Organization">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
					<span <?php if ($logo) : ?> class="screen-reader-text" <?php endif; ?> itemprop="name"><?php bloginfo('title'); ?></span>
					<?php if ($description) : ?><span class="screen-reader-text" itemprop="description"><?php echo $description; ?></span><?php endif; ?>
					<?php if ($logo) : ?><img src="<?php echo $logo; ?>" alt="<?php bloginfo('title'); ?> Logo" itemprop="logo"><?php endif; ?>
				</a>			
			</div>
		</header>
		<nav id="site-navigation" class="site-navigation" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
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
	</div>
</div>

