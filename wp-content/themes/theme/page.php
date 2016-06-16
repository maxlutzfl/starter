<?php
/**
 * @package BrandCo Starter Theme
 * @subpackage Default Page Template
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

				</div>
			</header>

			<section id="pageMain" class="pageMain __sectionPadding-default" data-content-sidebar="none">
				<div class="pageContainer">

					<div class="entry-content entryContent" itemprop="mainContentOfPage">
						<?php the_content(); ?>
					</div>
					
				</div>
			</section>

		</article>

	<?php endwhile; ?> 

</main>

<?php get_footer();?>

