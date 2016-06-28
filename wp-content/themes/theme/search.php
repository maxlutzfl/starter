<?php
/**
 * @package BrandCo Starter Theme
 * @subpackage Search Results Page Template
 * @author BrandCo. LLC
 */
get_header();
use BrandCo\Config\Functions;
?>

<main id="siteMain" class="siteMain" role="main">

	<header id="pageHeader" class="pageHeader __border-bottom-thin __sectionPadding-default">
		<div class="pageContainer">
			<h1 class="pageTitle">
				<?php echo 'Search results for: <span>' . get_search_query() . '</span>'; ?>
			</h1>

			<?php echo sprintf( '<h1 class="PageTitle">Search results for: <span>%s</span></h1>', get_search_query() ); ?>
		</div>
	</header>

	<section id="pageMain" class="pageMain __sectionPadding-default" data-content-sidebar="right">
		<div class="pageContainer">

			<div class="pageMain-primary archivePage-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('templates/archive', 'default'); ?>
				<?php endwhile; ?>
				<?php Functions\BrandCo_Pagination(); ?>
			</div>

			<aside class="pageMain-secondary siteSidebar widgetArea" role="complementary">
				<?php get_sidebar(); ?>
			</aside>

		</div>
	</section>

</main>

<?php get_footer();?>
