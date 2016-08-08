<?php get_header(); ?>
<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
	<header id="page-header" class="page-header">
		<div class="page-container">
			<h1 class="page-title">
				<?php echo 'Search results for: <span>' . get_search_query() . '</span>'; ?>
			</h1>
		</div>
	</header>
	<section id="page-main" class="page-main" data-content-sidebar="right" itemscope itemtype="http://schema.org/SearchResultsPage">
		<div class="page-container">
			<div class="column-primary">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('templates/archive', 'default'); ?>
				<?php endwhile; ?>
				<?php display_archive_pagination(); ?>
			</div>
			<aside class="column-secondary page-sidebar widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</section>
</main>
<?php get_footer();?>
