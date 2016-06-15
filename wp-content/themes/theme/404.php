<?php
/**
 * 404 Page Template
 * @package brandco
 */

get_header(); ?>

<main id="siteMain" class="siteMain" role="main">

	<article id="errorPage404" class="errorPage404">

		<header id="pageHeader" class="pageHeader __border-bottom-thin __sectionPadding-default">
			<div class="pageContainer">
				<?php echo sprintf( '<h1 class="entry-title">%s</h1>', 'Oops... this page does not exist.' ); ?>
			</div>
		</header>

		<section id="pageMain" class="pageMain __sectionPadding-default" data-content-sidebar="right">
			<div class="pageContainer">

				<div class="pageMain-primary">
					<div class="entry-content entryContent">
						<p>We're sorry, the page you are looking for does not exists. <a href="<?php echo home_url(); ?>">Go back home.</a></p>
					</div>
				</div>

				<aside class="pageMain-secondary" class="siteSidebar widgetArea" role="complementary">
					<?php get_sidebar(); ?>
				</aside>
				
			</div>
		</section>

	</article>

</main>

<?php get_footer();?>

