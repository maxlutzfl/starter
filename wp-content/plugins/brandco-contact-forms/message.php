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

			// All $_POST data
			var_dump($_POST);

			// Insert new post
			wp_insert_post(
				array(
					'post_status' => 'publish',
					'post_type' => 'post',
					'post_title' => 'test3',
					'post_content' => 'Lorem ipsum'
				)
			);

			// Setup mail options
			$to = get_option( 'admin_email' );
			$subject = 'New contact form submission';
			$message = 'Yes it works!3';
			$headers = "From: " . get_bloginfo( 'title' ) . " <noreply@brandco.com>" . "\r\n";

			// Send it! 
			wp_mail( $to, $subject, $message, $headers );

		}
	?>

</body>
</html>