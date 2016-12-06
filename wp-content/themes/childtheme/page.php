<?php 
/**
 * Default Page Template
 */
get_header(); ?>
<main id="site-main" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<section id="default-section" class="default-section">
			<div class="section-container">
				<h1><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>