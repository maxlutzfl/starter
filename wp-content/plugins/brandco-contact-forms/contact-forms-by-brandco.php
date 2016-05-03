<?php
/*
Plugin Name: Contact Forms by BrandCo.
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo.
Author URI: https://brandco.com/
*/

if ( ! class_exists('BrandCo_Form') ) :

	class BrandCo_Form {

		function __construct($args) {
			$this->form($args);
		}

		public function form($args) {

			// For debugging, view all data
			// echo '<pre>';
			// var_dump($args);
			// echo '</pre>';

			// Check if everything is set up correctly
			if ( ! array_key_exists('title', $args) ) { echo "No title found! "; return; }
			if ( ! array_key_exists('fields', $args) ) { echo "No fields found! "; return; }

			// Vars
			$formTitle = $args['title'];
			$formID = $this->create_slug( $args['title'] );
			$formFakeID = $args['id'];
			$formFields = $args['fields'];
			$formRedirect = ( array_key_exists('after_submit_redirect', $args) ) ? esc_url( $args['after_submit_redirect'] ) : '';

			?>
				<div id="BcoForm__Wrapper__<?php echo $formID; ?>" class="BcoForm__Wrapper">
					<form id="BcoForm__<?php echo $formID; ?>" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="POST">
						<div class="BcoForm__Header">
							<div class="BcoForm__Messages">
								<div class="BcoForm__Success"></div>
								<div class="BcoForm__Error"></div>
							</div>
						</div>

						<div class="BcoForm__Body">
							<?php foreach ( $formFields as $id => $data ): ?>
								
								<?php 
									// Vars
									$fieldTitle = ( array_key_exists('title', $data) ) ? $data['title'] : '';
									$fieldRequired = ( array_key_exists('required', $data) && $data['required'] === true ) ? true : false;
									$fieldType = ( array_key_exists('type', $data) ) ? $data['type'] : '';

									// Before field
									echo '<div id="BcoForm__Field__' . $id . '" class="BcoForm__Field BcoForm__FieldType__' . $fieldType . '">';

									// Text field
									if ( $fieldType === 'text' ) { ?>
										<label>
											<span class="BcoForm__Label">
												<span class="BcoForm__Label__Text">
													<?php echo $fieldTitle; ?>
												</span>
												<?php echo ( $fieldRequired ) ? '<span class="BcoForm__RequiredField">*</span>' : ''; ?>
											</span>
											<input type="text" name="BcoForm__Field__<?php echo $id; ?>" data-bco-field-label="<?php echo $fieldTitle; ?>" <?php echo ( $fieldRequired ) ? 'required' : ''; ?> placeholder="<?php echo $fieldTitle; ?>">
										</label>
									<?php }

									// Email field
									if ( $fieldType === 'email' ) { ?>
										<label>
											<span class="BcoForm__Label">
												<span class="BcoForm__Label__Text">
													<?php echo $fieldTitle; ?>
												</span>
												<?php echo ( $fieldRequired ) ? '<span class="BcoForm__RequiredField">*</span>' : ''; ?>
											</span>
											<input type="email" name="BcoForm__Field__<?php echo $id; ?>" data-bco-field-label="<?php echo $fieldTitle; ?>" <?php echo ( $fieldRequired ) ? 'required' : ''; ?> placeholder="<?php echo $fieldTitle; ?>">
										</label>
									<?php }

									// Phone field
									if ( $fieldType === 'phone' ) { ?>
										<label>
											<span class="BcoForm__Label">
												<span class="BcoForm__Label__Text">
													<?php echo $fieldTitle; ?>
												</span>
												<?php echo ( $fieldRequired ) ? '<span class="BcoForm__RequiredField">*</span>' : ''; ?>
											</span>
											<input type="phone" name="BcoForm__Field__<?php echo $id; ?>" data-bco-field-label="<?php echo $fieldTitle; ?>" <?php echo ( $fieldRequired ) ? 'required' : ''; ?> placeholder="<?php echo $fieldTitle; ?>">
										</label>
									<?php }

									// Address field
									if ( $fieldType === 'address' ) { ?>
										<label>
											<span class="BcoForm__Label">
												<span class="BcoForm__Label__Text">
													<?php echo $fieldTitle; ?>
												</span>
												<?php echo ( $fieldRequired ) ? '<span class="BcoForm__RequiredField">*</span>' : ''; ?>
											</span>
											<input type="text" name="BcoForm__Field__<?php echo $id; ?>" data-bco-field-label="<?php echo $fieldTitle; ?>" <?php echo ( $fieldRequired ) ? 'required' : ''; ?> placeholder="<?php echo $fieldTitle; ?>" data-google-autocomplete>
										</label>
									<?php }

									// Textarea field
									if ( $fieldType === 'textarea' ) { ?>
										<label>
											<span class="BcoForm__Label">
												<span class="BcoForm__Label__Text">
													<?php echo $fieldTitle; ?>
												</span>
												<?php echo ( $fieldRequired ) ? '<span class="BcoForm__RequiredField">*</span>' : ''; ?>
											</span>
											<textarea name="BcoForm__Field__<?php echo $id; ?>" data-bco-field-label="<?php echo $fieldTitle; ?>" <?php echo ( $fieldRequired ) ? 'required' : ''; ?> placeholder="<?php echo $fieldTitle; ?>"></textarea>
										</label>
									<?php }

									// After field
									echo '</div>';
								?>

							<?php 
								// End of field
								endforeach;

								// Hidden fields 
								echo '<input type="hidden" data-bco-field-label="From Page URL" name="BcoForm__HiddenField__PageURL" value="' . esc_url( $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ) . '">';
								echo '<input type="hidden" data-bco-field-label="Form Title" name="BcoForm__HiddenField__FormTitle" value="' . $formTitle . '">';
								echo '<input type="hidden" data-bco-field-label="Form ID" name="BcoForm__HiddenField__FormID" value="' . $formID . '">';
							?>

						</div>

						<div class="BcoForm__Footer">
							<div class="BcoForm__Field BcoForm__Submit">
								<div class="BcoForm__SubmitButtonWrapper">
									<input type="submit" id="Form__Submit" data-bco-field-label="Submit" value="Submit">
								</div>
							</div>
						</div>
				
						<?php /* ?>
						<div class="BcoForm__Alert">
							<svg style="height: 50px; width: 50px; " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 76 76" style="enable-background:new 0 0 76 76;" xml:space="preserve"><g><path d="M38,0C17,0,0,17,0,38s17,38,38,38s38-17,38-38S59,0,38,0z M38,72C19.2,72,4,56.8,4,38S19.2,4,38,4s34,15.2,34,34 S56.8,72,38,72z M60.9,25.1c-0.8-0.8-2-0.8-2.8,0L32.6,50.7L21.9,40c-0.8-0.8-2.1-0.8-2.8,0c-0.8,0.8-0.8,2.1,0,2.8l12.1,12.1 c0.4,0.4,0.9,0.6,1.4,0.6s1-0.2,1.4-0.6l26.9-27C61.7,27.1,61.7,25.9,60.9,25.1z"/></g></svg>
						</div>	
						<?php */ ?>

					</form>

					<?php 
						$this->after_submit_js( $formID, $formRedirect );
					?>

				</div>
		
			<?php
		}

		public function create_slug( $text ) { 
			$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
			$text = trim($text, '-');
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
			$text = strtolower($text);
			$text = preg_replace('~[^-\w]+~', '', $text);

			return $text;
		}

		public function after_submit_post() {
			var_dump($_POST);
		}

		public function after_submit_redirect() {

		}

		public function after_submit_js($formID, $formRedirect) {
			?>
				<script type="text/javascript">
					window.addEventListener("load", function() {
						function sendData() {

							var form = document.getElementById('<?php echo "BcoForm__" . $formID; ?>');
							var elem = form.elements;
							var url = form.action;        
							var params = "";
							var value;
							var redirect = "<?php echo $formRedirect; ?>";

							// var fieldLabel;
							// var fieldResponse;
							// var fieldLabelAndResponse;
							
							for (var i = 0; i < elem.length; i++) {

								if ( elem[i].tagName == "SELECT" ) {
									value = elem[i].options[elem[i].selectedIndex].value;
								} else {
									value = elem[i].value;
								}

								params += elem[i].getAttribute('data-bco-field-label') + "=" + encodeURIComponent(value) + "&";
							}

							// for (var i = 0; i < elem.length; i++) {

							// 	if ( elem[i].tagName == "SELECT" ) {
							// 		fieldResponse = elem[i].options[elem[i].selectedIndex].value;
							// 	} else {
							// 		fieldResponse = elem[i].value;
							// 	}

							// 	fieldLabelAndResponse += elem[i].getAttribute('data-bco-field-label') + "=" + encodeURIComponent(fieldResponse) + "&";
							// }
							// console.log(fieldLabelAndResponse);			

							var XHR; 

							if ( window.XMLHttpRequest ) {
								XHR = new XMLHttpRequest();
							} else {
								XHR = new ActiveXObject("Microsoft.XMLHTTP");
							}
							
							// We define what will happen if the data are successfully sent
							XHR.addEventListener("load", function(event) {
								document.getElementById('<?php echo "BcoForm__" . $formID; ?>').querySelector('.BcoForm__Success').innerHTML = 'Thanks you for submitting your information, we will get back to you as soon as possible! ';
								if ( redirect.length ) {
									setTimeout(function(){
										window.location.href = redirect + '?' + params;
									}, 1000);
								}
							});

							console.log(params);

							// We define what will happen in case of error
							XHR.addEventListener("error", function(event) {
								alert('Oups! Something goes wrong.');
							});

							XHR.open("POST", '<?php echo home_url(); ?>/wp-content/plugins/brandco-contact-forms/form-submit.php');
							XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							XHR.send(params);
						}
						
						var form = document.getElementById('<?php echo "BcoForm__" . $formID; ?>');

						form.addEventListener("submit", function (event) {
							event.preventDefault();
							sendData();
						});
					});
				</script>
			<?php
		}
	}

endif;


if ( ! class_exists('BrandCo_Contacts_Setup') ) :

	class BrandCo_Contacts_Setup {

		function __construct() {
			add_action( 'init', array( $this, 'PostType_Entries' ) );
			add_action( 'add_meta_boxes', array( $this, 'MetaBox_EntryData' ) );

			// add_action( 'init', array( $this, 'PostType_Users' ) );
			// add_action( 'init', array( $this, 'SetCookie' )  );
			// add_action( 'wp_footer', array( $this, 'RegisterPageView' ) );
			// add_action( 'add_meta_boxes', array( $this, 'MetaBox_Users' ) );
		}

		public function PostType_Entries() {
			$labels = array(
				'name'               => _x( 'Contact Entries', 'brandco-contact-entries', 'brandco' ),
				'singular_name'      => _x( 'Contact Entry', 'brandco-contact-entry', 'brandco' ),
				'menu_name'          => _x( 'Contact Entries', 'admin menu', 'brandco' ),
				'name_admin_bar'     => _x( 'Contact Entries', 'add new on admin bar', 'brandco' ),
				'add_new'            => _x( 'Add New', 'Contact Entry', 'brandco' ),
				'add_new_item'       => __( 'Add New Contact Entry', 'brandco' ),
				'new_item'           => __( 'New Contact Entry', 'brandco' ),
				'edit_item'          => __( 'Edit Contact Entry', 'brandco' ),
				'view_item'          => __( 'View Contact Entry', 'brandco' ),
				'all_items'          => __( 'All Contact Entries', 'brandco' ),
				'search_items'       => __( 'Search Contact Entries', 'brandco' ),
				'parent_item_colon'  => __( 'Parent Contact Entries:', 'brandco' ),
				'not_found'          => __( 'No contact entries found.', 'brandco' ),
				'not_found_in_trash' => __( 'No contact entries found in Trash.', 'brandco' )
			);

			$args = array(
				'labels' => $labels,
				'public' => false,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'brandco-entries' ),
				'capability_type' => 'post',
				// 'capabilities' => array(
				// 	'edit_post'          => true, 
				// 	'read_post'          => true, 
				// 	'delete_post'        => true, 
				// 	'delete_posts'       => true, 
				// 	'edit_posts'         => true, 
				// 	'edit_others_posts'  => true, 
				// 	'publish_posts'      => true,       
				// 	'read_private_posts' => true, 
				// 	'create_posts'       => false, 
				// ),
				'has_archive' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'menu_icon' => 'dashicons-email-alt',
				'supports' => array( 'title' )
			);

			register_post_type( 'brandco-entries', $args );
		}

		public function MetaBox_EntryData() {
			add_meta_box( 
				'BrandCo_EntryData_Metabox', 
				'Entry Data', 
				array($this, 'BrandCo_EntryData_Metabox_Callback'), 
				'brandco-entries' 
			);
		}

		public function BrandCo_EntryData_Metabox_Callback( $post ) {
			$data = get_post_meta( $post->ID, 'bco-form-entry-data-fieldsonly', true );

			?>

				<ul>
					<?php foreach ( $data as $key ) : ?>

						<li>
							<div>
								<div>
									<strong><?php echo str_replace('_', ' ', $key['key']); ?>: </strong>
									<span><?php echo $key['value']; ?></span>
								</div>
							</div>
						</li>								
		
					<?php endforeach ?>
				</ul>

			<?php
		}

		public function PostType_Users() {
			$labels = array(
				'name'               => _x( 'Contact Users', 'brandco-users', 'brandco' ),
				'singular_name'      => _x( 'Contact User', 'brandco-user', 'brandco' ),
				'menu_name'          => _x( 'Contact Users', 'admin menu', 'brandco' ),
				'name_admin_bar'     => _x( 'Contact Users', 'add new on admin bar', 'brandco' ),
				'add_new'            => _x( 'Add New', 'User', 'brandco' ),
				'add_new_item'       => __( 'Add New Contact User', 'brandco' ),
				'new_item'           => __( 'New Contact User', 'brandco' ),
				'edit_item'          => __( 'Edit Contact User', 'brandco' ),
				'view_item'          => __( 'View Contact User', 'brandco' ),
				'all_items'          => __( 'All Contact Users', 'brandco' ),
				'search_items'       => __( 'Search Contact Users', 'brandco' ),
				'parent_item_colon'  => __( 'Parent Contact Users:', 'brandco' ),
				'not_found'          => __( 'No contact users found.', 'brandco' ),
				'not_found_in_trash' => __( 'No contact users found in Trash.', 'brandco' )
			);

			$args = array(
				'labels' => $labels,
				'public' => false,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'brandco-users' ),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array( 'title' )
			);

			register_post_type( 'brandco-users', $args );
		}	

		public function MetaBox_Users() {
			add_meta_box( 
				'BrandCo_Users_Metabox', 
				'User Details', 
				array($this, 'BrandCo_Users_Metabox_Callback'), 
				'brandco-users' 
			);
		}

		public function BrandCo_Users_Metabox_Callback( $post ) {
			$events = get_post_meta( $post->ID, 'brandco_user_event', true );

			if ( empty($events) ) { echo 'No events recorded yet. Check back later.'; return; }

			foreach ( array_reverse($events) as $event ) :
				?>
					<li>
						<p>
							<strong><?php echo $event['page_url']; ?> -- </strong>
							<i><?php echo $event['time']; ?></i>
						</p>
						<!-- <pre><?php var_dump($event); ?></pre> -->
					</li>
				<?php
			endforeach;
		}

		public static function SetCookie() {
			if ( is_admin() ) { return; }

			if ( ! isset( $_COOKIE['brandco_site_user_test_6'] ) ) {

				$new_id = wp_insert_post(
					array(
						'post_status' => 'publish',
						'post_type' => 'brandco-users',
						'post_title' => 'Anonymous User'
					)
				);	

				setcookie(
					"brandco_site_user_test_6",
					$new_id,
					time() + (10 * 365 * 24 * 60 * 60)
				);
			}
		}

		public function RegisterPageView() {
			if ( is_admin() ) { return; }

			if ( ! isset( $_COOKIE['brandco_site_user_test_6'] ) ) { return; }

			$user_id = $_COOKIE['brandco_site_user_test_6'];
			$data = get_post_meta( $user_id, 'brandco_user_event', true );
			$data[] = array(
				'event' => 'page_view',
				'time' => current_time('Y-m-d h:i:sa'),
				'page_url' => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
				// 'referrer' => $_SERVER['HTTP_REFERER']
			);

			update_post_meta( $user_id, 'brandco_user_event', $data );
		}
	}

	new BrandCo_Contacts_Setup();

endif;

/**
	new BrandCo_Form( 
	    array(
	    	'id' => 21414,
			'title' => 'Contact Form 02', // Does not display on front end
			'submit' => 'Submit', // Text to display in submit button
			'after_submit_redirect' => 'http://starter.bco/about-us/',
			'fields' => array(
				1 => array(
					'title' => 'Your Name',
					'type' => 'text',
					'required' => true
				),
				2 => array(
					'title' => 'Your Last Name',
					'type' => 'text',
					'required' => false
				),
			)
	    )
	);

	new BrandCo_Form( 
	    array(
			'title' => 'Contact Form 01', // Does not display on front end
			'id' => 100,
			'submit' => 'Submit', // Text to display in submit button
			'fields' => array(
				1 => array(
					'title' => 'Your Name',
					'type' => 'text',
					'required' => true
				),
				2 => array(
					'title' => 'Your Last Name',
					'type' => 'text',
					'required' => false
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

?>