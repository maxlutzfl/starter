<?php
/*
Plugin Name: Contact Forms by BrandCo.
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo.
Author URI: https://brandco.com/

===========
Basic Setup
===========
$form = new BrandCo_Form( 
	array(
		'title' => 'Holler at us!',
		'submit' => 'Submit my shit',
		'fields' => array(
			'text' => 'Your Name',
			'phone' => 'Your Phone Number',
			'email' => 'Your Email',
			'textarea' => 'How can we help?',	
		)
	)
);

 */

if ( ! class_exists('BrandCo_Form') ) :

	class BrandCo_Form {

		function __construct( $args ) {
			$this->create( $args );
		}

		public function create( $args ) {

			if ( is_array( $args['fields'] ) ) {

				$i = 1;

				$FormTitle = ( $args['title'] ) ? $this->slugify( $args['title'] ) : 'form';
				$SubmitTitle = ( $args['submit'] ) ? $args['submit'] : 'Submit';

				echo '<div class="ContactForm--Wrapper">';

				echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';

				echo '<div class="ContactForm--Header">';

				$this->deliver( $args );

				echo '</div>';

				echo '<div class="ContactForm--Main">';

				foreach ( $args['fields'] as $type => $title ) {

					echo ( $type === 'text' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '</span><input type="' . $type . '" placeholder="' . $title . '" name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;
					echo ( $type === 'text*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '*</span><input type="' . $type . '" placeholder="' . $title . '" required name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;

					echo ( $type === 'phone' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '</span><input type="' . $type . '" placeholder="' . $title . '" name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;
					echo ( $type === 'phone*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '*</span><input type="' . $type . '" placeholder="' . $title . '" required name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;

					echo ( $type === 'email' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '</span><input type="' . $type . '" placeholder="' . $title . '" name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;
					echo ( $type === 'email*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '*</span><input type="' . $type . '" placeholder="' . $title . '" required name="' . $FormTitle . '-field-' . $i . '" value=""></label></p>' : NULL;

					echo ( $type === 'textarea' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '</span><textarea placeholder="' . $title . '" name="' . $FormTitle . '-field-' . $i . '"></textarea></label></p>' : NULL;
					echo ( $type === 'textarea*' ) ? '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '*</span><textarea placeholder="' . $title . '" required name="' . $FormTitle . '-field-' . $i . '"></textarea></label></p>' : NULL;

					if ( $type === 'address' ) { 
						echo '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '</span><input type="' . $type . '" placeholder="' . $title . '" name="' . $FormTitle . '-field-' . $i . '" value="" data-google-autocomplete></label></p>';
						add_action( 'wp_footer', array( $this, 'autocomplete' ) );
					}

					if ( $type === 'address*' ) { 
						echo '<p id="' . $FormTitle . '-field-' . $i . '"><label><span>' . $title . '</span><input type="' . $type . '" placeholder="' . $title . '" required name="' . $FormTitle . '-field-' . $i . '" value="" data-google-autocomplete></label></p>';
						add_action( 'wp_footer', array( $this, 'autocomplete' ) );
					}					

					$i++;

				}

				echo '</div>';

				echo '<div class="ContactForm--Footer">';

				echo '<input id="' . $FormTitle . '-submit-button" type="submit" name="' . $FormTitle . '-submit-button" value="' . $SubmitTitle . '">';

				echo '</div>';

				echo '</form>';

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
					$message = '<h3>New submission to your contact form: ' . $args['title'] . '</h3><br>';
					$message .= '<h4>Submitted: ' . $date . '</h4><br>';

					$i = 1; foreach ( $args['fields'] as $type => $title ) {
						$message .= '<p><strong>' . $title . ': </strong> <span>' . $_POST[ $FormTitle . '-field-' . $i ] . '</span></p><br>';
						$i++;
					}
					
					$message .= '<br><hr>This email is from your website ' . get_bloginfo( 'title' ) . '. The admin of ' . get_bloginfo( 'title' ) . ' can be contacted at ' . get_option( 'admin_email' );

					// echo $message;

					$to = get_option( 'admin_email' );
					$site = get_bloginfo( 'title' );

					$headers = "From: " . $site . " <noreply@brandco.com>" . "\r\n";

					if ( wp_mail( $to, $subject, $message, $headers ) ) {
						$this->create_post( $date, $subject, $message );
					    echo '<div>';
					    echo '<p>Thanks for contacting me, expect a response soon.</p>';
					    echo '</div>';
					} else {
					    echo 'An unexpected error occurred';
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
