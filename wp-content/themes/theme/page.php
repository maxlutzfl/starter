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

<?php 
	new BrandCo_Form( 
	    array(
	    	'id' => 21414,
			'title' => 'Contact Form 02', // Does not display on front end
			'submit' => 'Submit', // Text to display in submit button
			'after_submit_redirect' => 'http://starter.bco/about-us/',
			'fields' => array(
				1 => array(
					'title' => 'Your Name',
					'type' => 'text',
					'required' => true
				),
				2 => array(
					'title' => 'Your Last Name',
					'type' => 'text',
					'required' => false
				),
			)
	    )
	);
?>

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
			'id' => 100,
			'submit' => 'Submit', // Text to display in submit button
			'fields' => array(
				1 => array(
					'title' => 'Your Name',
					'type' => 'text',
					'required' => true
				),
				2 => array(
					'title' => 'Your Last Name',
					'type' => 'text',
					'required' => false
				),
				3 => array(
					'title' => 'Your Address',
					'type' => 'address'
				),
				4 => array(
					'title' => 'Your Email',
					'type' => 'email'				
				),
				5 => array(
					'title' => 'Your Phone',
					'type' => 'phone'
				),
				6 => array(
					'title' => 'Message',
					'type' => 'textarea'
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

