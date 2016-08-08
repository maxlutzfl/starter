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
?>

<body class="<?php if (BrandcoLandingPages_Image($parentid)) { echo 'has-post-thumbnail'; }; ?>" itemscope itemtype="http://schema.org/WebPage">

	<?php /* ?>
	<style>
		html {
			height: 100%;
		}

		body,
		html {
			background-color: transparent !important;
			margin: 0;
			padding: 0;
			background-size: cover;
			background-position: 50%;
			min-height: 100%;
			height: 100%;
		}

		body,
		input,
		textarea,
		button,
		p,
		h1, h2, h3, h4, h5, h6 {
			font-family: 'Open Sans', sans-serif !important;
			white-space: normal !important;
			word-wrap: break-word !important;
			letter-spacing: 0px !important;
		}

		body:after {
			content: "";
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 5 !important;
			background-color: #333;
			background-image: none !important;
			opacity: 0.5;
		}

		body:before {
			content: "";
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 1;
			background-size: cover;
			background-position: 50%;			
			background-image: url('<?php echo BrandcoLandingPages_Image(); ?>');			
		}

		.bco-landing-pages--wrapper {
			padding: 10% 50px;
			position: relative;
			z-index: 10;
		}

		.bco-landing-pages--container {
			max-width: 520px;
			margin: 0 auto;
		}

		@media screen and ( min-width: 750px ) {
			.bco-landing-pages--wrapper {
				padding-top: 13%;
			}
		}


		@media screen and ( min-width: 1400px ) {
			.bco-landing-pages--wrapper {
				padding-top: 15%;
			}
		}

		.gform_wrapper .gform_heading {
			color: #fff !important;
			text-align: center !important;
		}

		.gform_wrapper .gform_heading .gform_title {
			margin: 15px 0 !important;
			font-size: 50px !important;
			color: #fff !important;
		}

		.gform_wrapper .gform_heading .gform_description {
			margin: 15px 0 !important;
			display: block !important;
			font-size: 20px !important;
		}

		.gform_body ul {
			margin: 0;
			padding: 0;
		}

		.gform_body ul li {
			list-style: none !important;
		}

		.gform_body {
			margin: 15px 0 !important;
		}

		.gform_body .gfield {
			margin: 15px 0 !important;
		}

		.gform_body .gfield input {
			width: 100% !important;
			background-color: #fff;
			border: 2px solid #fff;
			height: 50px;
			line-height: normal;
			padding: 0 15px;
			transition: 300ms;
			-webkit-transition: 300ms;
		}

		.gform_body .gfield input:focus {
			background-color: #eee !important;
		}

		.gform_body .gfield label {
			margin-bottom: 5px !important;
			color: #fff !important;
			font-size: 14px !important;
			display: block !important;
		}

		.gform_footer {
			margin: 15px 0 !important;
			text-align: center !important;
		}

		.gform_footer input[type="submit"] {
			height: 50px;
			line-height: 50px;
			white-space: nowrap;
			text-transform: uppercase;
			text-shadow: 0 0 transparent;
			padding: 0 5px;
			text-align: center;
			font-size: 16px;
			min-width: 150px;
			letter-spacing: 1px;
		}
	</style>
	<?php */ ?>

	<?php if ( BrandcoLandingPages_Image() ) : ?>
		<style>
			body:before { background-image: url('<?php echo BrandcoLandingPages_Image(); ?>'); }
		</style>
	<?php endif; ?>

	<div id="bco-landing-pages--wrapper-1" class="bco-landing-pages--wrapper">
		<div class="bco-landing-pages--container">
			<div class="bco-landing-pages--box">
				<?php 
					$formid = BrandcoLandingPages::form( get_the_ID() );
					if ( $formid ) { 
						echo gravity_form( $formid, true, true, false, '', true, 12);
					}
				?>
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>

</body>
</html>