<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
				<section class="small-small-sp medium-medium-sp large-large-sp">
					<div class="section-container">
						<div class="row medium-medium-colpad large-large-colpad">
							<div class="column small-12 medium-8">
								<h1 class="entry-title big-text small-tiny-mb"><?php the_title(); ?></h1>
								<div class="article-meta h3 small-medium-mb">
									<p>
										<span><?php display_post_categories(', '); ?></span>
										<span><?php echo get_post_date(); ?></span>
										<span>by <?php the_author(); ?></span>
									</p>
								</div>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="aspect-ratio-box background-cover small-medium-mb" style="background-image: url(<?php echo get_featured_image_url('large'); ?>); "></div>
								<?php endif; ?>
								<div class="entry-content spacing-small-medium">
									<?php the_content(); ?>
								</div>
								<div class="article-meta small-tiny-hs small-medium-mt">
									<?php if ( has_tag() ) : ?><p><strong class="screen-reader-text">Tags: </strong><?php display_post_tags(' '); ?></p><?php endif; ?>
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
			</article>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>