<article <?php post_class('entrySummary entry-summary'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entrySummary-image">
			<a href="<?php echo get_permalink(); ?>">
				<img src="<?php echo BrandCo\Image('thumbnail'); ?>" alt="<?php the_title(); ?> - Featured Image">
			</a>
		</div>
	<?php endif; ?>

	<div class="entrySummary-main">

		<h1 class="entrySummary-title">
			<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
		</h1>

		<?php if ( is_home() || is_category() || is_tag() ) : ?>
			<div class="entrySummary-meta">
				<p>
					<span class="entrySummary-meta-categories"><?php BrandCo\Categories(); ?> </span>
					<span class="entrySummary-meta-date"><?php echo BrandCo\Date(); ?> </span>
					<span class="entrySummary-meta-author author vcard" itemprop="author">by <?php echo get_the_author(); ?></span>
				</p>
			</div>
		<?php endif; ?>

		<div class="entrySummary-excerpt">
			<?php echo BrandCo\Excerpt(100, null, '...'); ?>
		</div>

	</div>
</article>