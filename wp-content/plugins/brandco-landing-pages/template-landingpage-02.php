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
		$parent_link = get_permalink($parentid);
		$pass_to = get_post_meta( $parentid, 'bco-landingpages-pass-02', true);

		// Back link
		$back_link = ( isset($_GET['referer']) ) ? $_GET['referer'] : $parent_link;

		// Google Maps
		$map = get_post_meta( $parentid, 'bco-landingpages-map', true);
		$map_confirmation = get_post_meta($parentid, 'bco-landingpages-gmaps-confirmation', true);
		$streetview = get_post_meta($parentid, 'bco-landingpages-gmaps-streetview', true);

		// Zillow
		$show_zillow = get_post_meta($parentid, 'bco-zillow-estimate', true);

		$inputID = 'input_' . BrandcoLandingPages::form2( $parentid ) . '_' . get_post_meta( $parentid, 'bco-landingpages-pass-02', true);
		$fieldID = 'field_' . BrandcoLandingPages::form2( $parentid ) . '_' . get_post_meta( $parentid, 'bco-landingpages-pass-02', true);
	?>

	<style> #<?php echo $fieldID; ?> { display: none !important; } </style>

</head>

<body class="<?php echo (BrandcoLandingPages_Image($parentid)) ? 'has-post-thumbnail' : ''; ?> <?php echo ( $map_confirmation ) ? 'do-map-confirmation' : ''; ?>">

	<div id="bco-landing-pages--wrapper-2" class="bco-landing-pages--wrapper" data-back-link="<?php echo $back_link; ?>">
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

		<?php if ( $map_confirmation ) : ?>
			jQuery(function($) {
				$('.gform_heading').append('<div class="gmaps-confirmation-title"><h3 id="gmaps-confirmation-title" class="gform_title">Is this correct?</h3><div id="gmaps-confirmation-yes" class="gmaps-confirmation-button">Yes</div><a href="" id="gmaps-confirmation-no" class="gmaps-confirmation-button">No, go back</a></div>');
				
				$('#gmaps-confirmation-yes').on('click', function() {
					$('body').removeClass('do-map-confirmation').addClass('map-is-confirmed');
				});

				setTimeout(function() {
					window.onload = function() { 
						var backLink = document.getElementById('bco-landing-pages--wrapper-2').getAttribute('data-back-link');
						var backButton = document.getElementById("gmaps-confirmation-no"); 
						backButton.href = backLink; 
					}
				}, 200);
			});
		<?php endif; ?>

		<?php if ( $map ) : ?>

				var el = document.getElementsByClassName("gform_heading")[0];
				el.insertAdjacentHTML('afterend', '<div id="BrandcoLandingPages_Map"></div>');

				function initMap() {

					jQuery(function($) {

						var address = "<?php echo $pass; ?>";
						var geocoder = new google.maps.Geocoder();

						geocoder.geocode( { 'address': address}, function(results, status) {
							console.log(results);
							
							if ( status === 'OK' ) {
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

								// Street view
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

								// Zillow API
								<?php if ($show_zillow) : ?>

									// Save address data
									var addressData = results[0];

									// Vars
									var streetNumber, streetName, cityName, stateName, zipCode, zillowAddress, zillowLocation;

									// If address is a street address 
									if ( addressData.types[0] === "street_address" ) {

										// Loop through address data and set variables for each
										// part of the address that is needed
										for (var i = 0; i < addressData.address_components.length; i++) {

											// Get street number
											if ( addressData.address_components[i].types[0] === "street_number" ) {
												streetNumber = addressData.address_components[i].long_name;
											}

											// Get street name
											if ( addressData.address_components[i].types[0] === "route" ) {
												streetName = addressData.address_components[i].long_name;
											}

											// Get city
											if ( addressData.address_components[i].types[0] === "locality" ) {
												cityName = addressData.address_components[i].long_name;
											}

											// Get state
											if ( addressData.address_components[i].types[0] === "administrative_area_level_1" ) {
												stateName = addressData.address_components[i].long_name;
											}

											// Get zip
											if ( addressData.address_components[i].types[0] === "postal_code" ) {
												zipCode = addressData.address_components[i].long_name;
											}
										}

										// Prepare the final variables for Zillow
										zillowAddress = streetNumber + ' ' + streetName;
										zillowLocation = cityName + ' ' + stateName + ' ' + zipCode;

										// Send request to Zillow

										$.ajax({
											url: '<?php echo plugin_dir_url( __FILE__ ); ?>get-zillow-data.php',
											type: 'POST',
											data: {
												'zws-id': 'X1-ZWz19j8np7wjd7_6ttia',
												'address': zillowAddress,
												'citystatezip': zillowLocation
											},
											success: function(data) {
												var jsonData = JSON.parse(data);
												console.log(jsonData);

												if ( jsonData.message.code === "0" ) {
													var allData = jsonData.response.results.result;
													var zestimate = allData.zestimate.amount;
													var inDollars = '$' + (zestimate + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
													$('.gform_heading').append('<div class="gform_description">Zillow Zestimate: ' +  inDollars + '</div>');

												} else {
													console.log('Error');
												}
											}
										});

									} else {
										console.log('Address is not a street address');
									}
								<?php endif; ?>

							} else {

								setTimeout(function() {
									document.getElementById('gmaps-confirmation-title').innerHTML = 'The address you send was not found, please try again.';
									document.getElementById('bco-landing-pages--wrapper-2').setAttribute('data-invalid-address', true);
									document.getElementById('gmaps-confirmation-yes').style.display = 'none';
									document.getElementById('gmaps-confirmation-no').innerHTML = 'Try again';
								}, 500);

							};
						}); 
					
					});

				}

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