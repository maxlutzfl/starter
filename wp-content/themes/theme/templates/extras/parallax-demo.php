<?php
/**
 * Template Name: Testing Template
 * @package brandco
 */

get_header(); ?>

<main id="siteMain" class="siteMain" role="main" <?php if ( is_user_logged_in() && function_exists('live_edit') ) { live_edit('post_title, post_content'); } ?>>

	<section class="__sectionPadding-default __background-cover" style="background-image: url(<?php echo BrandCo\ImageID(261, 'placeholder'); ?>); height: 500px" data-src="<?php echo BrandCo\ImageID(261, 'full'); ?>">
		
	</section>

	<section class="__sectionPadding-default">
		<div class="pageContainer">

			<a href="<?php echo BrandCo\ImageID(263, 'full'); ?>" data-image-expand>
				<img src="<?php echo BrandCo\ImageID(263, 'placeholder'); ?>" data-src="<?php echo BrandCo\ImageID(263, 'full'); ?>" alt="Lazy Load Image">
				<noscript><img src="<?php echo BrandCo\ImageID(263, 'full'); ?>" alt="Lazy Load Image"></noscript>
			</a>


			<img src="<?php echo BrandCo\ImageID(264, 'placeholder'); ?>" data-src="<?php echo BrandCo\ImageID(264, 'full'); ?>" alt="Lazy Load Image">
			<noscript><img src="<?php echo BrandCo\ImageID(264, 'full'); ?>" alt="Lazy Load Image"></noscript>

			<img src="<?php echo BrandCo\ImageID(265, 'placeholder'); ?>" data-src="<?php echo BrandCo\ImageID(265, 'full'); ?>" alt="Lazy Load Image">
			<noscript><img src="<?php echo BrandCo\ImageID(265, 'full'); ?>" alt="Lazy Load Image"></noscript>
		</div>
	</section>

	<section class="__sectionPadding-default">
		<div class="pageContainer">
			
			<div class="testSlider-main">
				<ul data-slider="test-main">
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(261, 'placeholder'); ?>); height: 500px" data-src="<?php echo BrandCo\ImageID(261, 'full'); ?>"></div></li>
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(263, 'placeholder'); ?>); height: 500px" data-src="<?php echo BrandCo\ImageID(263, 'full'); ?>"></div></li>
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(264, 'placeholder'); ?>); height: 500px" data-src="<?php echo BrandCo\ImageID(264, 'full'); ?>"></div></li>
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(265, 'placeholder'); ?>); height: 500px" data-src="<?php echo BrandCo\ImageID(265, 'full'); ?>"></div></li>
				</ul>				
			</div>

			<div class="testSlider-buttons">
				<ul data-slider="test-buttons">
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(261, 'placeholder'); ?>); height: 100px; padding: 0 10px;" data-src="<?php echo BrandCo\ImageID(261, 'full'); ?>"></div></li>
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(263, 'placeholder'); ?>); height: 100px; padding: 0 10px;" data-src="<?php echo BrandCo\ImageID(263, 'full'); ?>"></div></li>
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(264, 'placeholder'); ?>); height: 100px; padding: 0 10px;" data-src="<?php echo BrandCo\ImageID(264, 'full'); ?>"></div></li>
					<li><div class="__background-cover" style="background-image: url(<?php echo BrandCo\ImageID(265, 'placeholder'); ?>); height: 100px; padding: 0 10px;" data-src="<?php echo BrandCo\ImageID(265, 'full'); ?>"></div></li>
				</ul>				
			</div>

		</div>
	</section>

</main>

<?php get_footer();?>

