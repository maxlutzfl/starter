<?php
/**
 * Blog Index
 * @package brandco
 */

get_header(); ?>

<main id="SiteMain" role="main">

	<header id="PageHeader">
		<div class="PageContainer">
			<?php 
				if ( is_post_type_archive() )
					echo sprintf( '<h1 class="PageTitle">%s</h1>', Brandco\PostTypeTitle() ); 

				elseif ( is_category() )
					echo sprintf( '<h1 class="PageTitle">%s</h1>', single_cat_title( '', false ) );

				elseif ( is_tag() )
					echo sprintf( '<h1 class="PageTitle">%s</h1>', single_term_title( '', false ) );

				else
					echo sprintf( '<h1 class="PageTitle">%s</h1>', get_the_archive_title() );
			?>
		</div>
	</header>

	<section id="PageMain">
		<div class="PageContainer">

			<div class="ArchiveList ColumnPrimary">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('_templates/archive', 'default'); ?>
				<?php endwhile; ?>
			</div>

			<aside class="ColumnAside">
				<?php get_sidebar(); ?>
			</aside>

		</div>
	</section>

	<footer id="PageFooter">
		<div class="PageContainer">
			<?php BrandCo_Pagination(); ?>
		</div>
	</footer>

</main>

<?php get_footer();?>

