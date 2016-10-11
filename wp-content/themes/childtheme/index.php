<?php get_header(); ?>
	<section class="text-center small-large-sp">
		<div class="section-container">
			<div class="small-medium-sp">
				<h1>Welcome</h1>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php echo get_the_ID(); ?>">
						<h1><?php the_title(); ?></h1>
						<?php 
							$args = array(
								'word_count' => 10,
								'post_id' => get_the_ID(),
								'read_more_text' => '...',
								'link' => true
							);
						?>
						<?php echo get_post_excerpt($args); ?>
						<a href="<?php the_permalink(); ?>">Continue reading</a>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>