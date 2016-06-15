<?php
/**
 * Blog Index
 * @package brandco
 */

get_header(); ?>

<main id="siteMain" class="siteMain" role="main">

	<header id="pageHeader" class="pageHeader __border-bottom-thin __sectionPadding-default">
		<div class="pageContainer">
			<?php echo sprintf( '<h1 class="PageTitle">Search results for: <span>%s</span></h1>', get_search_query() ); ?>
		</div>
	</header>

	<section id="pageMain" class="pageMain __sectionPadding-default" data-content-sidebar="right">
		<div class="pageContainer">

			<div class="pageMain-primary archivePage-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('_templates/archive', 'default'); ?>
				<?php endwhile; ?>
				<?php BrandCo_Pagination(); ?>
			</div>

			<aside class="pageMain-secondary siteSidebar widgetArea" role="complementary">
				<?php get_sidebar(); ?>
			</aside>

		</div>
	</section>

</main>

<?php get_footer();?>

