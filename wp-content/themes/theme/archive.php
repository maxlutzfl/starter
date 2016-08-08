<?php get_header(); ?>
<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
	<header id="page-header" class="page-header">
		<div class="page-container">
			<?php 
				if ( is_post_type_archive() ) {
					echo sprintf( '<h1 class="page-title">%s</h1>', get_post_type_archive_title() ); 
				} elseif ( is_category() ) {
					echo sprintf( '<h1 class="page-title"><span class="screen-reader-object">Category:</span> %s</h1>', single_cat_title( '', false ) );
				} elseif ( is_tag() ) {
					echo sprintf( '<h1 class="page-title"><span class="screen-reader-object">Tag:</span> %s</h1>', single_term_title( '', false ) );
				} else {
					echo sprintf( '<h1 class="page-title">%s</h1>', get_the_archive_title() );
				}
			?>
		</div>
	</header>
	<section id="page-main" class="page-main" data-content-sidebar="right">
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

