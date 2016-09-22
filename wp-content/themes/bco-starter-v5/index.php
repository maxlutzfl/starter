<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<section class="padding-medium background-light">
			<div class="section-container">
				<h1 class="page-title big-text"><?php echo get_index_title(); ?></h1>
			</div>
		</section>
		<section class="padding-large sidebar-layout-right">
			<div class="section-container">
				<div class="column-primary">
					<div class="list-of-posts spacing-large">
						<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php echo get_the_ID(); ?>" <?php post_class('post-preview'); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-preview-thumbnail">
										<a href="<?php echo get_permalink(); ?>">
											<?php the_post_thumbnail('medium'); ?>
										</a>
									</div>
								<?php endif; ?>
								<div class="post-preview-main spacing-small">
									<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php if ( $post->post_type === 'post' ) : ?>
										<p>
											<?php echo get_post_date(); ?> 
											<span>by</span> 
											<?php the_author(); ?>
											<span> | </span>
											<?php display_post_categories(); ?>
										</p>
									<?php endif; ?>
									<?php the_excerpt(); ?>
									<a href="<?php echo get_permalink(); ?>">Continue reading</a>
								</div>
							</article>
						<?php endwhile; ?>
					</div>
					<div class="mt-large">
						<?php display_archive_pagination(); ?>
					</div>
				</div>
				<aside class="column-sidebar" role="complementary">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</section>
	</main>
<?php get_footer(); ?>