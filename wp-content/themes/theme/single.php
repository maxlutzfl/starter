<?php
/**
 * Single Post Template
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
						<?php 
							if ( has_post_thumbnail() )
								echo sprintf('<img src="%s" alt="%s" title="%s" class="PageImage" itemprop="image">', BrandCo\Image(), get_the_title(), get_the_title() ); 
						?>
						<?php the_content(); ?>
					</div>
					
				</div>
			</section>

			<footer id="PageFooter">
				<div class="PageContainer">

					<?php if ( is_singular('post') ) : ?>
						<?php echo sprintf( '<span class="ArticleDate">%s</span>', BrandCo\Date() ); ?>
						<?php echo sprintf( '<span class="ArticleAuthor author vcard" itemprop="author">by %s</span>', get_the_author() ); ?>
						<?php BrandCo\Categories(); ?>
						<?php BrandCo\Tags(', '); ?>
					<?php endif; ?>

					<?php BrandCo\ArchiveBackLink(); ?>

					<?php the_posts_navigation(); ?>

				</div>
			</footer>

		</article>

	<?php endwhile; ?> 

</main>

<?php get_footer();?>

