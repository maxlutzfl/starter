<?php 
/**
 * Index
 */
get_header(); ?>
<main id="site-main" class="site-main">
	<section id="default-section" class="default-section">
		<div class="section-container">
			<h1><?php echo get_page_title(); ?></h1>
			<ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php get_archive_pagination(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>