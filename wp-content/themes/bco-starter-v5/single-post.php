<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
				<section class="padding-medium background-light">
					<div class="section-container spacing-tiny">
						<h1 class="entry-title big-text"><?php the_title(); ?></h1>
						<div class="article-meta h2">
							<p>
								<span><?php echo get_post_date(); ?></span>
								<span>by <?php the_author(); ?></span>
							</p>
						</div>
					</div>
				</section>
				<section class="padding-large sidebar-layout-right">
					<div class="section-container">
						<div class="column-primary">
							<div class="entry-content spacing-small-medium">
								<?php the_content(); ?>
							</div>
							<div class="article-meta spacing-small-medium mt-large">
								<p><strong><?php echo get_post_date(); ?> by <?php the_author(); ?></strong></p>
								<p><strong>Categories:</strong> <?php display_post_categories(); ?></p>
								<?php if ( has_tag() ) : ?><p><strong>Tags:</strong> <?php display_post_tags(', '); ?></p><?php endif; ?>
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