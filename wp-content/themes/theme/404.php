<?php
/**
 * 404 Page Template
 * @package brandco
 */

get_header(); ?>

<main id="SiteMain" role="main">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header id="PageHeader">
			<div class="PageContainer">
				<?php echo sprintf( '<h1 class="entry-title">%s</h1>', 'Oops... this page does not exist.' ); ?>
			</div>
		</header>

		<section id="PageMain">
			<div class="PageContainer">

				<div class="entry-content">
					<p>We're sorry, the page you are looking for does not exists.</p>
				</div>
				
			</div>
		</section>

		<footer id="PageFooter">
			<div class="PageContainer">
				
			</div>
		</footer>

	</article>

</main>

<?php get_footer();?>

