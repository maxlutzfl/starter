<?php
	$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
	require_once( $parse_uri[0] . 'wp-load.php' );
?><!doctype html>
<html>
<head>
	
</head>
<body>

	<?php
		if ( function_exists('wp_insert_post') ) {

			// Create array of all data from form
			$allData = array();

			foreach ( $_POST as $key => $value ) {
				$allData[] = array(
					'key' => $key,
					'value' => $value
				);
			}

			// Gather form Info
			$formTitle = $_POST['Form_Title'];
			$formID = $_POST['Form_ID'];

			$formInfo = array(
				'FormID' => $formID,
				'FormTitle' => $formTitle
			);

			// Insert new post
			$post_id = wp_insert_post(
				array(
					'post_status' => 'publish',
					'post_type' => 'brandco-entries',
					'post_title' => 'Form submission: ' . $formTitle,
				)
			);

			// Insert post meta for all data
			add_post_meta( $post_id, 'bco-form-entry-data-all', $allData );

			// Unset unnessecary data to display on front end 
			$fieldsDataOnly = $allData;

			foreach ( $fieldsDataOnly as $index => $data ) {
				if ( $data['key'] == 'Form_Title' || $data['key'] == 'From_Page_URL' || $data['key'] == 'Submit' || $data['key'] == 'Form_ID' ) {
					unset( $fieldsDataOnly[$index] );
				}
			}

			// Insert post meta for fields only and form info
			add_post_meta( $post_id, 'bco-form-entry-data-fieldsonly', $fieldsDataOnly );
			add_post_meta( $post_id, 'bco-form-entry-data-formInfo', $formInfo );

			// Setup mail options
			$to = get_option( 'admin_email' );
			$subject = 'New contact form submission';
			$headers = "From: " . get_bloginfo( 'title' ) . " <noreply@brandco.com>" . "\r\n";

			// Email message

			ob_start();

				$fieldDataForEmail = get_post_meta( $post_id, 'bco-form-entry-data-fieldsonly', true );

				foreach ( $fieldDataForEmail as $key ) {
					echo '<p>';
					echo '<strong>' . $key['key'] . ': </strong>';
					echo '<span>' . $key['value'] . '</span>';
					echo '</p>';
				}

				$message = ob_get_contents();
			
			ob_end_clean();

			// Send it! 
			add_filter( 'wp_mail_content_type', create_function( '', 'return "text/html"; ' ) );
			wp_mail( $to, $subject, $message, $headers );

		}
	?>

</body>
</html>