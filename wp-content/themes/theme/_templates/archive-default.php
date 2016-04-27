<article <?php post_class('ArticlePreview entry-summary'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="ArticlePreview__Side">
			<?php echo sprintf( '<a href="%s"><img class="ArticlePreview__Image" src="%s" alt="%s"></a>', get_permalink(), BrandCo\Image(), get_the_title() ); ?>
		</div>
	<?php endif; ?>

	<div class="ArticlePreview__Main">

		<?php echo sprintf( '<a href="%s"><h2 class="ArticlePreview__Title entry-title">%s</h2></a>', get_permalink(), get_the_title() ); ?>

		<?php if ( is_home() ) : ?>
			<div class="ArchivePreview__Details">
				<?php
					echo sprintf( '<span class="ArticleDate">%s</span>', BrandCo\Date() );
					echo sprintf( '<span class="ArticleAuthor author vcard" itemprop="author">by %s</span>', get_the_author() );
					BrandCo\Categories();
				?>	
			</div>
		<?php endif; ?>

		<div class="ArticlePreview__Excerpt">
			<?php the_excerpt(); ?>
		</div>

	</div>
</article>