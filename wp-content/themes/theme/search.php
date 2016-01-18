<?php
/**
 * Blog Index
 * @package brandco
 */

get_header(); ?>

<main id="SiteMain" role="main">

	<header id="PageHeader">
		<div class="PageContainer">
			<?php echo sprintf( '<h1 class="PageTitle">Search results for: <span>%s</span></h1>', get_search_query() ); ?>
		</div>
	</header>

	<section id="PageMain">
		<div class="PageContainer">

			<div class="ArchiveList ColumnPrimary">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('_templates/archive', 'default'); ?>
				<?php endwhile; ?>
			</div>

			<div class="ColumnAside">
				
			</div>

		</div>
	</section>

	<footer id="PageFooter">
		<div class="PageContainer">
			<?php BrandCo_Pagination(); ?>
		</div>
	</footer>

</main>

<?php get_footer();?>

