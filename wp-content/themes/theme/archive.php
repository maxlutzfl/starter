<?php
/**
 * Blog Index
 * @package brandco
 */

get_header(); ?>

<main id="siteMain" class="siteMain" role="main">

	<header id="pageHeader" class="pageHeader __border-bottom-thin __sectionPadding-default">
		<div class="pageContainer">
			<?php 
				if ( is_post_type_archive() )
					echo sprintf( '<h1 class="PageTitle">%s</h1>', Brandco\PostTypeTitle() ); 

				elseif ( is_category() )
					echo sprintf( '<h1 class="PageTitle"><span class="screen-reader-object">Category:</span> %s</h1>', single_cat_title( '', false ) );

				elseif ( is_tag() )
					echo sprintf( '<h1 class="PageTitle"><span class="screen-reader-object">Tag:</span> %s</h1>', single_term_title( '', false ) );

				else
					echo sprintf( '<h1 class="PageTitle">%s</h1>', get_the_archive_title() );
			?>
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

