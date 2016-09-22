<?php /** Template Name: Full Width Page Template */ ?>
<?php get_header(); ?>
	<main id="site-main" class="site-main" role="main" itemscope itemprop="mainContentOfPage">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>
				<section class="padding-medium background-light">
					<div class="section-container spacing-small">
						<h1 class="entry-title big-text"><?php the_title(); ?></h1>
					</div>
				</section>
				<section class="padding-large">
					<div class="section-container">
						<div class="entry-content spacing-small-medium">
							<?php the_content(); ?>
						</div>
					</div>
				</section>
			</article>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>