<article <?php post_class('ArticlePreview entry-summary'); ?>>
	<?php echo sprintf( '<a href="%s"><h2 class="ArticlePreview__Title entry-title">%s</h2></a>', get_permalink(), get_the_title() ); ?>

	<?php if ( is_home() ) : ?>
		<div id="ArchivePreview__Details">
			<?php echo sprintf( '<span class="ArticleDate">%s</span>', BrandCo\Date() ); ?>
			<?php echo sprintf( '<span class="ArticleAuthor author vcard" itemprop="author">by %s</span>', get_the_author() ); ?>
			<?php BrandCo\Categories(); ?>			
		</div>
	<?php endif; ?>

	<div class="ArticlePreview__Excerpt"><?php the_excerpt(); ?></div>
</article>