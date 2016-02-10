<?php
/**
 * Default Page Template
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
						<?php the_content(); ?>
					</div>
					
				</div>
			</section>

			<footer id="PageFooter">
				<div class="PageContainer">
<?php 

new BrandCo_Form( 
    array(
		'title' => 'Contact Form 01', // Does not display on front end
		'submit' => 'Submit', // Text to display in submit button
		'fields' => array(
			1 => array(
				'title' => 'Your Name',
				'type' => 'text*'
			),
			2 => array(
				'title' => 'Your Last Name',
				'type' => 'text'
			),
			3 => array(
				'title' => 'Your Address',
				'type' => 'address*'
			),
			4 => array(
				'title' => 'Your Email',
				'type' => 'email*'				
			),
			5 => array(
				'title' => 'Your Phone',
				'type' => 'phone'
			),
			6 => array(
				'title' => 'Message',
				'type' => 'textarea*'
			),
		)
    )
);

?>
				</div>
			</footer>

		</article>

	<?php endwhile; ?> 

</main>

<?php get_footer();?>

