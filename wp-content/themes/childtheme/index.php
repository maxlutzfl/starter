<?php get_header(); ?>
<?php 

$new_mod = new bcore_module(
	'testimonials-section-412312412512123',
	'about', 
	array(
		'title' => '<h1>New testimonials title</h1>',
		'subtitle' => '<h2>Subtitle</h2>'
	)
);
?>

	<section class="text-center" data-section-padding="small(30)">
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