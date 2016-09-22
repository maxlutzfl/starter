<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<section class="small-medium-sp medium-large-sp">
			<div class="section-container">
				<div class="row medium-medium-colpad large-large-colpad">
					<div class="column small-12 medium-8">
						<h1 class="page-title big-text small-medium-mb"><?php echo get_index_title(); ?></h1>
						<div class="list-of-posts small-medium-hs medium-large-hs">
							<?php while ( have_posts() ) : the_post(); ?>
								<article id="post-<?php echo get_the_ID(); ?>" <?php post_class('post-preview'); ?>>
									<div class="row small-small-colpad medium-medium-colpad">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="column small-12 medium-4">
												<a href="<?php echo get_permalink(); ?>">
													<div class="aspect-ratio-box background-cover small-tiny-mb" style="background-image: url(<?php echo get_featured_image_url('large'); ?>); "></div>
												</a>
											</div>
										<?php endif; ?>
										<div class="column small-tiny-hs small-tiny-mt medium-none-mt <?php echo ( has_post_thumbnail() ) ? 'small-12 medium-8' : 'small-12 medium-12' ?>">
											<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php if ( $post->post_type === 'post' ) : ?>
												<p>
													<?php display_post_categories(); ?>
													<?php echo get_post_date(); ?> 
													<span>by</span> 
													<?php the_author(); ?>
												</p>
											<?php endif; ?>
											<?php the_excerpt(); ?>
											<a href="<?php echo get_permalink(); ?>">Continue reading</a>
										</div>
									</div>
								</article>
							<?php endwhile; ?>
						</div>
						<div class="small-medium-mt">
							<?php display_archive_pagination(); ?>
						</div>
					</div>
					<div class="column small-12 medium-4 small-medium-mt medium-none-mt">
						<aside role="complementary">
							<?php get_sidebar(); ?>
						</aside>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>