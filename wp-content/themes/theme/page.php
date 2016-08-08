<?php get_header(); ?>
<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header id="page-header" class="page-header">
				<div class="page-container">
					<h1 class="entry-title" itemprop="headline">
						<?php the_title(); ?>
					</h1>
				</div>
			</header>
			<section id="page-main" class="page-main" data-content-sidebar="none">
				<div class="page-container">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</div>
			</section>
		</article>
	<?php endwhile; ?> 
</main>
<?php get_footer();?>