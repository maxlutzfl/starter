<?php
/**
 * @package BrandCo Starter Theme
 * @subpackage Default Single Post Template
 * @author BrandCo. LLC
 */
get_header();
use BrandCo\Config\Functions;
?>

<main id="siteMain" class="siteMain" role="main" <?php if ( is_user_logged_in() && function_exists('live_edit') ) { live_edit('post_title, post_content'); } ?>>

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header id="pageHeader" class="pageHeader __border-bottom-thin __sectionPadding-default">
				<div class="pageContainer">

					<h1 class="entry-title entryTitle" itemprop="headline">
						<?php the_title(); ?>
					</h1>
				
					<?php if ( is_singular('post') ) : ?>
						<h2 class="entrySubtitle">
							<span class="entryMeta-date"><?php echo Functions\Date(); ?></span>
							<span class="entryMeta-author author vcard" itemprop="author">by <?php echo get_the_author(); ?></span>
						</h2>
					<?php endif; ?>

				</div>
			</header>

			<section id="pageMain" class="pageMain __sectionPadding-default" data-content-sidebar="right">
				<div class="pageContainer">
					
					<div class="pageMain-primary">
						<div class="entry-content entryContent" itemprop="mainContentOfPage">
							<?php the_content(); ?>
						</div>

						<?php if ( is_singular('post') ) : ?>
							<div class="entryMeta">
								<p>
									<span class="entryMeta-date">Entry posted <?php echo Functions\Date(); ?></span>
									<span class="entryMeta-author author vcard" itemprop="author">by <?php echo get_the_author(); ?></span>
								</p>
								<p class="entryMeta-categories">
									<strong>Categories: </strong>
									<?php Functions\Categories(); ?>
								</p>

								<?php if ( get_the_tags() ) : ?>
									<p class="entryMeta-tags">
										<strong>Tags: </strong>
										<?php Functions\Tags(', '); ?>
									</p>		
								<?php endif; ?>	

							</div>
						<?php endif; ?>

						<?php the_posts_navigation(); ?>
					</div>

					<aside class="pageMain-secondary" class="siteSidebar widgetArea" role="complementary">
						<?php get_sidebar(); ?>
					</aside>

				</div>
			</section>

		</article>

	<?php endwhile; ?> 

</main>

<?php get_footer();?>

