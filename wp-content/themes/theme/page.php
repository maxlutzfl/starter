<?php
/**
 * Default Page Template
 * @package brandco
 */

get_header(); ?>

<main id="SiteMain" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header id="PageHeader">
				<div class="PageContainer">
					<?php echo sprintf( '<h1 class="entry-title" itemprop="headline">%s</h1>', get_the_title() ); ?>
				</div>
			</header>

			<section id="PageMain">
				<div class="PageContainer">

					<div class="entry-content" itemprop="mainContentOfPage">
						<?php the_content(); ?>
					</div>
					
				</div>
			</section>

			<footer id="PageFooter">
				<div class="PageContainer">

				</div>
			</footer>

		</article>

	<?php endwhile; ?> 

</main>

<?php get_footer();?>

