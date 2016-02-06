<?php 
/**
 *
 * @package brandco
 */


add_action( 'after_setup_theme', 'BrandCo_ThemeSetup' );
function BrandCo_ThemeSetup() {

	$content_width = 1100;

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 
		'html5', 
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) 
	);

	register_nav_menus( 
		array(
			'primary' => esc_html__( 'Main Navigation', 'brandco' ),
			'mobile' => esc_html__( 'Mobile Navigation', 'brandco' ),
			'footer' => esc_html__( 'Footer Links', 'brandco' )
		) 
	);
}

add_action( 'widgets_init', 'BrandCo_Widgets' );
function BrandCo_Widgets() {
	register_sidebar( 
		array(
			'name' => esc_html__( 'Sidebar', 'brandco' ),
			'id' => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) 
	);
}

add_action('wp_footer', 'BrandCo_GoogleAnalytics');
function BrandCo_GoogleAnalytics() {
	$id = get_option('Site_GoogleAnalyticsID');
	if ( $id ) :
	echo "
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='https://www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','" . $id . "','auto');ga('send','pageview');
		</script>
 	";
 	endif;
}

add_action('customize_register', 'BrandCo_PostTypeArchiveSetup');
function BrandCo_PostTypeArchiveSetup( $wp_customize ) {
	$custom_post_types = get_post_types( array( '_builtin' => false, 'public' => true ) );
	foreach ( $custom_post_types as $type ) {
		$details = get_post_type_object( $type );
		$label = $details->label;
		$wp_customize->add_setting( 'page_for_' . $type );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_for_' . $type, array(
			'label' => __( $label . ' Archive Page', 'bcore' ),
			'section' => 'static_front_page',
			'settings' => 'page_for_' . $type,
			'type' => 'dropdown-pages'
		))); 
	}	
}

function BrandCo_Pagination() {
	global $wp_query;
	$big = 999999999;
	$translated = __( 'Page', 'brandco' );
	echo '<div class="ArchivePagination">'; 
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
			'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
	) );
	echo '</div>';
}

add_action('wp_head', 'BrandCo_OG');
function BrandCo_OG() {
	echo '<meta property="og:site_name" content="' . get_bloginfo('title') . '" />';
	echo '<meta property="og:title" content="' . get_bloginfo('title') . ' - ' . get_bloginfo('description') . '" />';
	if ( get_option('CompanyLogo') )
		echo '<meta property="og:image" content="' . get_option('CompanyLogo') . '" />';
}

/**
 *
 */
if ( class_exists('WP_Customize_Control') && class_exists('GFAPI') ) :
	class WP_Customize_Gravity_Forms extends WP_Customize_Control {
		public function render_content() {

			$forms = GFAPI::get_forms();

			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?>>
						<option value="0"> -- Pick one</option>
						<?php 
							foreach ( $forms as $form ) {
								echo "<option " . selected( $this->value(), $form['id'] ) . " value='" . $form['id'] . "'>" . $form['title'] . "</option>";
							}
						?>
					</select>
				</label>
			<?php

		}
	}
endif;

function html_form_code() {
	?>
		<form class="BrandCoContactForm" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">

			<label class="BrandCoContactForm__field">
				<span class="screen-reader-text">Your Name</span>
				<input type="text" placeholder="Your Name" required name="cf-name" pattern="[a-zA-Z0-9 ]+" value="<?php echo ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) ?>" >
			</label>

			<label class="BrandCoContactForm__field">
				<span class="screen-reader-text">Your Email</span>
				<input type="email" name="cf-email" placeholder="Your Email" required value="<?php echo ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) ?>" size="40" />
			</label>

			<label class="BrandCoContactForm__field">
				<span class="screen-reader-text">How can we help?</span>
				<textarea name="cf-message" placeholder="How can we help?" ><?php echo ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ); ?></textarea>
			</label>

			<input class="BrandCoContactForm__submit" type="submit" name="cf-submitted" value="Submit">

		</form>

	<?php
}

function deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		// sanitize form values
		$name = sanitize_text_field( $_POST["cf-name"] );
		$email = sanitize_email( $_POST["cf-email"] );
		// $subject = sanitize_text_field( $_POST["cf-subject"] );
		$website = get_bloginfo('title');

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$message = esc_textarea( $_POST["cf-message"] ) . '<br><br> ____ <br><br>' . $name . ': ' .  $email . ' <br> This message is from your website ' . $website . ' ' . $to;


		$headers = "From: $website <noreply@brandco.com>" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, 'New form submission for your website.', $message, $headers ) ) {
			echo '<div>';
			echo '<p>Thanks for contacting me, expect a response soon.</p>';
			echo '</div>';

			// wp_insert_post(
			// 	array(
			// 		'post_type' => 'post',
			// 		'post_title' => 'Message from ' . $name . ': ' . $email,
			// 		'post_content' => apply_filters( 'the_content', $message )
			// 	)
			// );

		} else {
			echo 'An unexpected error occurred';
		}
	}
}

function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

function cf_shortcode() {
	deliver_mail();
	html_form_code();
}

add_shortcode( 'sitepoint_contact_form', 'cf_shortcode' );