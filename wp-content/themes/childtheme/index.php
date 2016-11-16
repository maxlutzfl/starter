<?php get_header(); ?>
<section data-section-padding="small(40) medium(60)">
	<div class="section-container medium-container">
		<ul data-grid="small(1) medium(1) large(1)" data-grid-padding="small(60) medium(60) large(60)">
			<?php while ( have_posts() ) : the_post(); ?>
				<li>
					<article id="post-<?php echo get_the_ID(); ?>" <?php post_class('entry-summary'); ?>>
						<ul data-column-padding="small(20) medium(40) large(60)">
							<?php if ( has_post_thumbnail() ) : ?>
								<li data-column-span="small(12) medium(5) large(5)">
									<div class="entry-summary--image">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
									</div>
								</li>
							<?php endif; ?>
							<li data-column-span="<?php echo (has_post_thumbnail()) ? 'small(12) medium(7) large(7)' : 'small(12) medium(12) large(12)'; ?>">
								<div class="entry-summary--content" data-element-spacing="small(20)">
									<h1><?php the_title(); ?></h1>
									<?php 
										echo get_post_excerpt(array(
											'word_count' => 65,
											'read_more_text' => '...',
											'link' => false
										)); 
									?>
									<a href="<?php the_permalink(); ?>" class="button-style"><span>Read More</span></a>
									<?php the_content(); ?>
								</div>
							</li>
						</ul>
					</article>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php get_archive_pagination(); ?>
	</div>
</section>
<?php get_footer(); ?>