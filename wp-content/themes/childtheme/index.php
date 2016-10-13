<?php get_header(); ?>

	<section class="text-center small-large-sp">
		<div class="section-container">
			<div class="small-medium-sp">
				<h1><?php echo get_page_title(); ?></h1>

				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php echo get_the_ID(); ?>">
						<h1><?php the_title(); ?></h1>
						<?php echo get_post_excerpt(); ?>
						<?php the_content(); ?>
						<a href="<?php the_permalink(); ?>"><?php echo get_icon(); ?> Continue reading</a>
					</article>
				<?php endwhile; ?>

			</div>
		</div>
	</section>
<?php get_footer(); ?>