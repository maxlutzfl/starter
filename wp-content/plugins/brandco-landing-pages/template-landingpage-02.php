<!DOCTYPE html> 
<html prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>	
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo plugins_url() . '/brandco-landing-pages/bco-landing-pages.css'; ?>">
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
		$map_confirmation = get_post_meta($parentid, 'bco-landingpages-gmaps-confirmation', true);
		$streetview = get_post_meta($parentid, 'bco-landingpages-gmaps-streetview', true);

		$inputID = 'input_' . BrandcoLandingPages::form2( $parentid ) . '_' . get_post_meta( $parentid, 'bco-landingpages-pass-02', true);
		$fieldID = 'field_' . BrandcoLandingPages::form2( $parentid ) . '_' . get_post_meta( $parentid, 'bco-landingpages-pass-02', true);
	?>

	<style> #<?php echo $fieldID; ?> { display: none !important; } </style>

</head>

<body class="<?php echo (BrandcoLandingPages_Image($parentid)) ? 'has-post-thumbnail' : ''; ?> <?php echo ( $map_confirmation ) ? 'do-map-confirmation' : ''; ?>">

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

	<?php if ( BrandcoLandingPages_Image($parentid) ) : ?>
		<div class="bco-landing-pages-background" style="background-image: url('<?php echo BrandcoLandingPages_Image($parentid); ?>'); "></div>
	<?php endif; ?>
		
	<script>

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
						zoom: 17,
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

					<?php if ($streetview) : ?>
					var panorama = new google.maps.StreetViewPanorama(
						document.getElementById('BrandcoLandingPages_Map'), {
							position: myLatLng,
						}
					);
					map.setStreetView(panorama);

					var sv = new google.maps.StreetViewService();

					sv.getPanorama({
					    location: myLatLng,
					    radius: 50
					}, function(data, status) {
						if (status === google.maps.StreetViewStatus.OK) {

						    var marker_pano = new google.maps.Marker({
						        position: myLatLng,
						        map: panorama
						    });

						    var heading = google.maps.geometry.spherical.computeHeading(data.location.latLng, marker_pano.getPosition());

						    panorama.setPov({
						        heading: heading,
						        pitch: 0
						    });
						}
					});
					<?php endif; ?>
				}); 
			}
		<?php endif; ?>

		<?php if ( $map_confirmation ) : ?>
		jQuery(function($) {
			$('.gform_heading').append('<div class="gmaps-confirmation-title"><h3 class="gform_title">Is this correct?</h3><div id="gmaps-confirmation-yes" class="gmaps-confirmation-button">Yes</div><a href="" id="gmaps-confirmation-no" class="gmaps-confirmation-button">No, go back</a></div>');
			
			$('#gmaps-confirmation-yes').on('click', function() {
				$('body').removeClass('do-map-confirmation').addClass('map-is-confirmed');
			});

			setTimeout(function() {
				window.onload = function() { 
					var backUrl = document.referrer;
					var backButton = document.getElementById("gmaps-confirmation-no"); 
					backButton.href = backUrl; 
				}
			}, 1000);
		});
		<?php endif; ?>

	</script>

	<?php if ( $map ) : ?>
		<?php /* ?><script src="<?php echo plugin_dir_url( __FILE__ ) . 'bco-landing-pages.js'; ?>"></script><?php */ ?>
		<script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyBfEzWjcytuQ3VsBCE-9qi4zHptECX6sig&libraries=geometry"></script>
	<?php endif; ?>

	<?php 
		wp_footer(); 
		add_action( 'gform_enqueue_scripts', 'BrandcoLandingPages::remove_style' );
	?>

</body>
</html>