<!DOCTYPE html> 
<html prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo plugins_url() . '/brandco-landing-pages/bco-landing-pages.css'; ?>">
</head>

<?php 
	add_action( 'gform_enqueue_scripts', 'BrandcoLandingPages::remove_style' );

	function BrandcoLandingPages_Image( $id = null, $size = 'full' ) {
		if ( empty( $id ) )
			$id = get_the_ID();

		if ( has_post_thumbnail( $id ) ) {
			$get_img_ID = get_post_thumbnail_id( $id );
			$img_src_url = wp_get_attachment_image_src( $get_img_ID, $size )[0];
			return $img_src_url;
		}
	}		

	$parentid = BrandcoLandingPages::find_page3_parent();
	$thanksmessage = get_post_meta( $parentid, 'bco-landingpages-ty-msg', true);	
	$linkTo = get_post_meta($parentid, 'bco-landingpages-link-to', true); 
	$linkToText = get_post_meta($parentid, 'bco-landingpages-link-to-text', true); 
?>

<body class="<?php if (BrandcoLandingPages_Image($parentid)) { echo 'has-post-thumbnail'; }; ?>" itemscope itemtype="http://schema.org/WebPage">

	<div id="bco-landing-pages--wrapper-3" class="bco-landing-pages--wrapper">
		<div class="bco-landing-pages--container">
			<div class="bco-landing-pages--box">
				<div class="gform_heading">
					<?php  
						if ( $thanksmessage ) {
							echo sprintf('<h1>%s</h1>', $thanksmessage);
						}
					?>
				</div>
				<div class="gform_footer">
					<p>
						<?php if ( $linkTo ) : ?>
							<a href="<?php echo $linkTo; ?>"><?php echo $linkToText; ?></a>
						<?php else : ?>
							<a href="<?php bloginfo('url'); ?>">Go back home</a>
						<?php endif; ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<?php if ( BrandcoLandingPages_Image($parentid) ) : ?>
		<div class="bco-landing-pages-background" style="background-image: url('<?php echo BrandcoLandingPages_Image($parentid); ?>'); "></div>
	<?php endif; ?>

	<?php wp_footer(); ?>

</body>
</html>