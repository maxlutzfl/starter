<article <?php post_class('entry-summary'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-summary-image">
			<a href="<?php echo get_permalink(); ?>">
				<img src="<?php echo get_featured_image_url('thumbnail'); ?>" alt="<?php the_title(); ?> - Featured Image">
			</a>
		</div>
	<?php endif; ?>
	<div class="entry-summary-main">
		<h1 class="entry-summary-title">
			<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<?php if ( is_home() || is_category() || is_tag() ) : ?>
			<div class="entry-summary-meta">
				<p>
					<span class="entry-summary-meta-categories"><?php display_post_categories(); ?> </span>
					<span class="entry-summary-meta-date"><?php echo get_post_date(); ?> </span>
					<span class="entry-summary-meta-author author vcard" itemprop="author">by <?php echo get_the_author(); ?></span>
				</p>
			</div>
		<?php endif; ?>
		<div class="entry-summary-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>