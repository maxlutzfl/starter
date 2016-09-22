<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
				<section class="padding-medium background-light">
					<div class="section-container spacing-tiny">
						<h1 class="entry-title big-text"><?php the_title(); ?></h1>
					</div>
				</section>
				<section class="padding-medium sidebar-layout-right">
					<div class="section-container">
						<div class="column-primary">
							<div class="entry-content spacing-medium">
								<?php the_content(); ?>
							</div>
						</div>
						<aside class="column-sidebar" role="complementary">
							<?php get_sidebar(); ?>
						</aside>
					</div>
				</section>
			</article>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>