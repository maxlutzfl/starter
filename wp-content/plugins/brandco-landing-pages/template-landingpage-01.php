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

	$parentid = get_the_ID();
	$post_id = $parentid;
	$autocomplete = get_post_meta( $post_id, 'bco-landingpages-map', true);
?>

<body class="<?php if (BrandcoLandingPages_Image($parentid)) { echo 'has-post-thumbnail'; }; ?>" itemscope itemtype="http://schema.org/WebPage">

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
	
	<?php if ( BrandcoLandingPages_Image() ) : ?>
		<div class="bco-landing-pages-background" style="background-image: url('<?php echo BrandcoLandingPages_Image(); ?>'); "></div>
	<?php endif; ?>

	<?php if ( $autocomplete === 'yes' ) : ?>
		<script>
			function initAutocomplete() {
				var input = document.getElementsByClassName('gform_body')[0].querySelectorAll('input[type=text]')[0];
				var autocomplete = new google.maps.places.Autocomplete(input);
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfEzWjcytuQ3VsBCE-9qi4zHptECX6sig&libraries=places&callback=initAutocomplete" async defer></script>
	<?php endif; ?>

	<?php wp_footer(); ?>

</body>
</html>