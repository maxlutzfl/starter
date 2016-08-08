<?php get_header(); ?>
<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
	<article id="404-page" class="404-page">
		<header id="page-header" class="page-header">
			<div class="page-container">
				<?php echo sprintf( '<h1 class="entry-title">%s</h1>', 'Oops... this page does not exist.' ); ?>
			</div>
		</header>
		<section id="page-main" class="page-main" data-content-sidebar="right">
			<div class="page-container">
				<div class="column-primary">
					<div class="entry-content">
						<p>We're sorry, the page you are looking for does not exist. <a href="<?php echo home_url(); ?>">Go back home.</a></p>
					</div>
				</div>
				<aside class="column-secondary page-sidebar widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</section>
	</article>
</main>
<?php get_footer();?>

