<?php 
/**
 * Index
 */
get_header(); ?>
<main id="site-main" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<section id="default-section" class="default-section">
			<div class="section-container">
				<h1>Use a child theme</h1>
			</div>
		</section>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>