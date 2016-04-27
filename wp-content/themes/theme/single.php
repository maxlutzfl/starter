<?php
/**
 * Single Post Template
 * @package brandco
 */

get_header(); ?>

<main id="SiteMain" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="PageHeader">
				<div class="PageContainer">
					<?php echo sprintf( '<h1 class="entry-title" itemprop="headline">%s</h1>', get_the_title() ); ?>
				</div>
			</header>

			<section class="PageMain">
				<div class="PageContainer">
					
					<div class="ColumnPrimary">
						<div class="entry-content" itemprop="mainContentOfPage">

							<?php the_content(); ?>

						</div>
						
						<div class="PageMeta">
						
							<?php 
								if ( is_singular('post') ) {
									echo sprintf( '<span class="ArticleDate">%s</span>', BrandCo\Date() );
									echo sprintf( '<span class="ArticleAuthor author vcard" itemprop="author">by %s</span>', get_the_author() );
									BrandCo\Categories();
									BrandCo\Tags(', ');
								}

								BrandCo\ArchiveBackLink();

								the_posts_navigation();
							?>

						</div>
					</div>

					<aside class="ColumnSidebar">
						<?php get_sidebar(); ?>
					</aside>
					
				</div>
			</section>

		</article>

	<?php endwhile; ?> 

</main>

<?php get_footer();?>

