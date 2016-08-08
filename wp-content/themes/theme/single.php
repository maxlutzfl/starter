<?php get_header(); ?>
<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
			<header id="page-header" class="page-header border-bottom-thin section-padding-default">
				<div class="page-container">
					<h1 class="entry-title" itemprop="headline">
						<?php the_title(); ?>
					</h1>
					<?php if ( is_singular('post') ) : ?>
						<h2 class="entry-subtitle">
							<span class="entry-meta-date"><?php echo get_post_date(); ?></span>
							<span class="entry-meta-author author vcard" itemprop="author">by <?php echo get_the_author(); ?></span>
						</h2>
					<?php endif; ?>
				</div>
			</header>
			<section id="page-main" class="page-main" data-content-sidebar="right">
				<div class="page-container">
					<div class="column-primary">
						<div class="entry-content" itemprop="text">
							<?php the_content(); ?>
						</div>
						<?php if ( is_singular('post') ) : ?>
							<div class="entry-meta">
								<p>
									<span class="entry-meta-date">Entry posted <?php echo get_post_date(); ?></span>
									<span class="entry-meta-author author vcard" itemprop="author">by <?php echo get_the_author(); ?></span>
								</p>
								<p class="entry-meta-categories">
									<strong>Categories: </strong>
									<?php display_post_categories(); ?>
								</p>

								<?php if ( get_the_tags() ) : ?>
									<p class="entry-meta-tags">
										<strong>Tags: </strong>
										<?php display_post_tags(', '); ?>
									</p>		
								<?php endif; ?>	
							</div>
						<?php endif; ?>
						<?php the_posts_navigation(); ?>
					</div>
					<aside class="column-secondary page-sidebar widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
						<?php get_sidebar(); ?>
					</aside>
				</div>
			</section>
		</article>
	<?php endwhile; ?> 
</main>
<?php get_footer();?>