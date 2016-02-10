<?php
/*
Plugin Name: Contact Forms by BrandCo.
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo.
Author URI: https://brandco.com/
*/

/*
Example: 

new BrandCo_Form( 
    array(
		'title' => 'Contact Form 01', // Does not display on front end
		'submit' => 'Submit', // Text to display in submit button
		'fields' => array(
			1 => array(
				'title' => 'Your Name',
				'type' => 'text'
			),
			2 => array(
				'title' => 'Your Last Name',
				'type' => 'text'
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

*/

if ( ! class_exists('BrandCo_Form') ) :

	class BrandCo_Form {

		function __construct( $args ) {
			$this->create_form( $args );
		}

		public function create_form( $args ) {

			if ( is_array( $args['fields'] ) ) {

				$i = 1;

				$FormTitle = ( $args['title'] ) ? $this->slugify( $args['title'] ) : 'form';
				$SubmitTitle = ( $args['submit'] ) ? $args['submit'] : 'Submit';

				echo '<div id="FormID--' . $FormTitle . '" class="ContactForm--Wrapper">';

				echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '#FormID--' . $FormTitle . '" method="post">';

				echo '<div class="ContactForm--Header">';

				$this->deliver( $args );

				echo '</div>';

				echo '<div class="ContactForm--Main">';

				foreach ( $args['fields'] as $key => $value ) {

					echo ( $value['type'] === 'text' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '" name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;
					echo ( $value['type'] === 'text*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '*</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '*" required name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;

					echo ( $value['type'] === 'phone' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '" name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;
					echo ( $value['type'] === 'phone*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '*</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '*" required name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;

					echo ( $value['type'] === 'email' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '" name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;
					echo ( $value['type'] === 'email*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '*</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '*" required name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;

					echo ( $value['type'] === 'textarea' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '</span><textarea placeholder="' . $value['title'] . '" name="' . $FormTitle . '-field-' . $i . '"></textarea></label></p>' : NULL;
					echo ( $value['type'] === 'textarea*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '*</span><textarea placeholder="' . $value['title'] . '*" required name="' . $FormTitle . '-field-' . $i . '"></textarea></label></p>' : NULL;

					if ( $value['type'] === 'address' ) { 
						echo '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '" name="' . $FormTitle . '-field-' . $i . '" value="" data-google-autocomplete></label></p>';
						add_action( 'wp_footer', array( $this, 'autocomplete' ) );
					}

					if ( $value['type'] === 'address*' ) { 
						echo '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $value['title'] . '*</span><input type="' . $value['type'] . '" placeholder="' . $value['title'] . '*" required name="' . $FormTitle . '-field-' . $i . '" value="" data-google-autocomplete></label></p>';
						add_action( 'wp_footer', array( $this, 'autocomplete' ) );
					}					

					$i++;

				}

				echo '</div>';

				echo '<div class="ContactForm--Footer">';

				echo '<input id="' . $FormTitle . '-submit-button" type="submit" name="' . $FormTitle . '-submit-button" value="' . $SubmitTitle . '">';

				echo '</div>';

				echo '</form>';

				echo '<script>window.onload = function(){ if (location.hash === "#FormID--' . $FormTitle . '") { goto( "#FormID--' . $FormTitle . '", this ); } }</script>';

				echo '</div>';
			}			
		}

		public function deliver( $args ) {

			if ( is_array( $args['fields'] ) ) {

				$FormTitle = ( $args['title'] ) ? $this->slugify( $args['title'] ) : 'form';
				$SubmitTitle = ( $args['submit'] ) ? $args['submit'] : 'Submit';

				if ( isset( $_POST[ $FormTitle . '-submit-button' ] ) ) {

					$date = date( 'Y-m-d', current_time( 'timestamp' ) );

					// $i = 1; foreach ( $args['fields'] as $type => $title ) {

					// 	$i++;
					// }

					$name = '';
					$email = '';
					$subject = 'New contact form submission: ' . $args['title'] . ' ' . get_bloginfo( 'title' );
					$message = '<h3>New submission to your contact form: ' . $args['title'] . '</h3>';
					$message .= '<h4>Submitted: ' . $date . '</h4>';

					$i = 1; foreach ( $args['fields'] as $key => $value ) {
						$message .= '<p><strong>' . $value['title'] . ': </strong> <span>' . $_POST[ $FormTitle . '-field-' . $i ] . '</span></p>';
						$i++;
					}
					
					$message .= '<br><hr>This email is from your website ' . get_bloginfo( 'title' ) . '. The admin of ' . get_bloginfo( 'title' ) . ' can be contacted at ' . get_option( 'admin_email' );

					// echo $message;

					function set_html_mail_content_type() {
						return 'text/html';
					}

					add_filter( 'wp_mail_content_type', 'set_html_mail_content_type' );

					$to = get_option( 'admin_email' );
					$site = get_bloginfo( 'title' );

					$headers = "From: " . $site . " <noreply@brandco.com>" . "\r\n";

					if ( wp_mail( $to, $subject, $message, $headers ) ) {
						$this->create_post( $date, $subject, $message );
					    echo '<div class="ContactForm--Success">';
					    echo '<p>Thanks for contacting us, we will get back to you as soon as possible!</p>';
					    echo '</div>';
					} else {
						echo '<div class="ContactForm--Error"><p>An error occurred, please try submitting your form again or contact us directly at ' . $to . '</p></div>';
					}
				}
			}		
		}

		public function create_post( $date, $subject, $message ) {

			$args = array(
				'post_type' => 'contact-entries',
				'post_title' => $subject . ': ' . $date,
				'post_content' => $message,
				'post_status' => 'publish'
			);

			wp_insert_post( $args );				
		}

		public function autocomplete() {
			?>
				<script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
				<script>

					var inputs = document.querySelectorAll('[data-google-autocomplete]');
					if ( inputs.length > 0 ) {

						function initialize() {
							for (var i = inputs.length - 1; i >= 0; i--) {
								var autocomplete = new google.maps.places.Autocomplete(inputs[i]);
							};
						}

						google.maps.event.addDomListener(window, 'load', initialize);
					}
				</script>
			<?php 
		}

		public function slugify( $text ) { 
			$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
			$text = trim($text, '-');
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
			$text = strtolower($text);
			$text = preg_replace('~[^-\w]+~', '', $text);

			return $text;
		}
	}

endif;

if ( ! class_exists('BrandCo_Form__Entries') ) :

	class BrandCo_Form__Entries {

		function __construct() {
			add_action( 'init', array( $this, 'post_type_contacts' ) );
		}


		public static function post_type_contacts() {
			$menu_name = 'Contact Entries';
			$regular_name = 'Contact Entries';
			$singular_name = 'Contact Entry';
			$register_name = 'contact-entries';
			$icon = 'dashicons-email-alt';

			$labels = array(
				'name'               => _x( $regular_name, 'post type general name', 'brandco' ),
				'singular_name'      => _x( $singular_name, 'post type singular name', 'brandco' ),
				'menu_name'          => _x( $menu_name, 'admin menu', 'brandco' ),
				'name_admin_bar'     => _x( $singular_name, 'add new on admin bar', 'brandco' ),
				'add_new'            => _x( 'Add New', $register_name, 'brandco' ),
				'add_new_item'       => __( 'Add New ' . $singular_name, 'brandco' ),
				'new_item'           => __( 'New ' . $singular_name, 'brandco' ),
				'edit_item'          => __( 'Edit ' . $singular_name, 'brandco' ),
				'view_item'          => __( 'View ' . $singular_name, 'brandco' ),
				'all_items'          => __( 'All ' . $regular_name, 'brandco' ),
				'search_items'       => __( 'Search ' . $regular_name, 'brandco' ),
				'parent_item_colon'  => __( 'Parent ' . $regular_name . ':', 'brandco' ),
				'not_found'          => __( 'No ' . $regular_name . ' found.', 'brandco' ),
				'not_found_in_trash' => __( 'No ' . $regular_name . ' found in Trash.', 'brandco' )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => $register_name,
				'capability_type'    => 'page',
				// 'capabilities' 		 => array(
				// 	'create_posts'	 => false, 
				// 	'edit_post' 	 => false, 
				// 	'read_post'      => true, 
				// 	'delete_post'    => true, 
				// ),
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'menu_icon'			 => $icon,
				'supports'           => array( 'title', 'editor' )
			);
			register_post_type( $register_name, $args );					
		} 

	}

	new BrandCo_Form__Entries();

endif;

?>
