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
	function BrandcoLandingPages_Image( $id = null, $size = 'full' ) {
		if ( empty( $id ) )
			$id = get_the_ID();

		if ( has_post_thumbnail( $id ) ) {
			$get_img_ID = get_post_thumbnail_id( $id );
			$img_src_url = wp_get_attachment_image_src( $get_img_ID, $size )[0];
			return $img_src_url;
		}
	}	

	$pass = htmlspecialchars( $_GET["pass"] );

	$parentid = BrandcoLandingPages::find_page2_parent();
	$pass_to = get_post_meta( $parentid, 'bco-landingpages-pass-02', true);

	$map = get_post_meta( $parentid, 'bco-landingpages-map', true);

	$inputID = 'input_' . BrandcoLandingPages::form2( $parentid ) . '_' . get_post_meta( $parentid, 'bco-landingpages-pass-02', true);
	$fieldID = 'field_' . BrandcoLandingPages::form2( $parentid ) . '_' . get_post_meta( $parentid, 'bco-landingpages-pass-02', true);
?>

<body class="<?php if (BrandcoLandingPages_Image($parentid)) { echo 'has-post-thumbnail'; }; ?>">
	
	<?php if ( BrandcoLandingPages_Image($parentid) ) : ?>
		<style>
			body:before { background-image: url('<?php echo BrandcoLandingPages_Image($parentid); ?>'); }
		</style>
	<?php endif; ?>

	<div id="bco-landing-pages--wrapper-2" class="bco-landing-pages--wrapper">
		<div class="bco-landing-pages--container">
			<div class="bco-landing-pages--box">
				<?php 
					$formid = BrandcoLandingPages::form2( $parentid );
					if ( $formid ) { 
						echo gravity_form( $formid, true, true, false, '', true, 12);
					}
				?>	
			</div>
		</div>
	</div>

	<script>
		document.getElementById("<?php echo $fieldID; ?>").style.display = "none";
		document.getElementById("<?php echo $inputID; ?>").value = "<?php echo $pass; ?>";

		<?php if ( $map ) : ?>
			var el = document.getElementsByClassName("gform_heading")[0];
			el.insertAdjacentHTML('afterend', '<div id="BrandcoLandingPages_Map"></div>');

			function initMap() {
				var address = "<?php echo $pass; ?>";
				var geocoder = new google.maps.Geocoder();
				geocoder.geocode( { 'address': address}, function(results, status) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					var myLatLng = {lat: latitude, lng: longitude};
					var map = new google.maps.Map(document.getElementById('BrandcoLandingPages_Map'), {
						zoom: 14,
						scrollwheel: false,
						draggable: false,
						center: myLatLng
					});
					var marker = new google.maps.Marker({
						position: myLatLng,
						map: map,
						title: "<?php bloginfo('title'); ?>"
					});
					google.maps.event.addDomListener(window, 'resize', function() {
						map.setCenter(myLatLng);
					});
				}); 
			}
		<?php endif; ?>

	</script>

	<?php if ( $map ) : ?><script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyBfEzWjcytuQ3VsBCE-9qi4zHptECX6sig"></script><?php endif; ?>

	<?php 
		wp_footer(); 
		add_action( 'gform_enqueue_scripts', 'BrandcoLandingPages::remove_style' );
	?>

</body>
</html>