<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<section class="hero-padding-small background-light">
			<div class="section-container spacing-between-elements-small">
				<h1 class="entry-title big-text">Uh oh... 404 Error</h1>
				<h2>We're sorry! The page you are looking for does not exist.</h2>
			</div>
		</section>
		<section class="section-padding sidebar-layout-right">
			<div class="section-container">
				<div class="column-primary">
					<div class="entry-content spacing-between-elements">
						<p>Please contact us or use the navigation.</p>
						<?php 
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'items_wrap' => '<ul class="%2$s">%3$s</ul>',
									'container' => ''
								)
							);
						?>
					</div>
				</div>
				<aside class="column-sidebar" role="complementary">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</section>
	</main>
<?php get_footer(); ?>