<?php
/*
Plugin Name: Landing Pages for Gravity Forms
Plugin URI: https://brandco.com/
Version: 0.0.1
Author: BrandCo.
Author URI: https://brandco.com/
*/

add_action('admin_init', 'BrandcoLandingPages::setup_page_list');
add_action('admin_init', 'BrandcoLandingPages::create_subpages');

add_action( 'gform_confirmation', 'BrandcoLandingPages::form_redirect', 10, 4 );

if ( isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) === 'page' ) {
	$template = get_post_meta( $_GET['post'], '_wp_page_template', true );
	if ( $template === 'template-landingpage-01.php' || $template === 'template-landingpage-02.php' ) {
		if ( BrandcoLandingPages::gravity_forms_active() === true ) {
			add_action( 'admin_init', 'BrandcoLandingPages::clean' );
			add_action( 'add_meta_boxes',  'BrandcoLandingPages::metabox' ); 
			add_action( 'after_setup_theme', 'BrandcoLandingPages::setup' );

		} else {
			echo '<div class="error notice"><p>Gravity Forms is required to use this page template properly, please activate.</p></div>';
		}
	}
}

add_action( 'save_post', 'BrandcoLandingPages::save' );

class BrandcoLandingPages {

	public static function setup() {
		add_theme_support('post-thumbnails');
	}

	public static function metabox() {
		add_meta_box( 'bco_meta', 'Landing Page Setup/Instructions', 'BrandcoLandingPages::callback', 'page' );
	}

	public static function gravity_forms_active() {
		include_once(ABSPATH.'wp-admin/includes/plugin.php');

		if ( \is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
			return true;
		}
	}

	public static function callback( $post ) {
		$postid = $_GET['post'];
		wp_nonce_field( basename( __FILE__ ), 'bco_nonce' );
		$stored_meta = get_post_meta( $post->ID ); 
		$forms = \GFAPI::get_forms();
		$template = get_post_meta( $_GET['post'], '_wp_page_template', true );
		?>
		
		<?php if ( $template === 'template-landingpage-01.php') : ?>

			<h1><strong>(1) Create 2 Forms in Gravity Forms.</strong></h1>

			<p>Form 1 should only have one field. For example: Address.</p>
			<p>Form 2 should have an identical field as Form 1, like Address, as well as additional information you want to capture from the user.</p>

			<p>
				<label for="bco-landingpages-form" class="screen-reader-text">Select Form for Step 1</label>
				<select name="bco-landingpages-form" id="bco-landingpages-form" data-post-id="<?php echo $_GET['post']; ?>">
					<option>-- Select Form for Step 1 </option>
					<?php foreach ( $forms as $form ) : ?>
						<option value="<?php echo $form['id']; ?>" <?php if ( isset ( $stored_meta['bco-landingpages-form'] ) ) selected( $stored_meta['bco-landingpages-form'][0], $form['id'] ); ?>>Form ID <?php echo $form["id"]; ?>: <?php echo $form['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p>
				<select name="bco-landingpages-form2" id="bco-landingpages-form2" data-post-id="<?php echo $_GET['post']; ?>">
					<option>-- Select Form for Step 2 </option>
					<?php foreach ( $forms as $form ) : ?>
						<option value="<?php echo $form['id']; ?>" <?php if ( isset ( $stored_meta['bco-landingpages-form2'] ) ) selected( $stored_meta['bco-landingpages-form2'][0], $form['id'] ); ?>>Form ID <?php echo $form["id"]; ?>: <?php echo $form['title']; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<hr>

			<?php $selected_form = get_post_meta( $postid, 'bco-landingpages-form', true ); ?>
			
			<h1><strong>(2) Pass information from Form 1 to 2. Select a field from Form 1 to auto-populate in Form 2.</strong></h1>
			<p>For example, Form 1 should have 1 field for Address. Form 2 should also have a field for Address. Select the 2 Address fields below. When the user submits their address in form 1, that address will be passed over to Form 2. The address field in Form 2 will automatically get filled in. The address field in Form 2 will also be hidden so the user doesn't have to fill in their address twice.</p>
			<p>
				<label for="bco-landingpages-pass-01">From Form 1: </label>
				<select name="bco-landingpages-pass-01" id="bco-landingpages-pass-01">
					<option>-- Select field to pass information to Step 2</option>
					<?php foreach ( $forms as $form => $value ) : ?>
						<?php if ( $value['id'] == $selected_form ) : ?>
							<?php $labels = $value['fields']; ?>
							<?php foreach ($labels as $label => $value): ?>
								<option value="<?php echo $value->id; ?>" <?php if ( isset ( $stored_meta['bco-landingpages-pass-01'] ) ) selected( $stored_meta['bco-landingpages-pass-01'][0], $value->id ); ?>><?php echo $value->label; ?></option>
							<?php endforeach ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</p>

			<?php $selected_form2 = get_post_meta( get_the_ID(), 'bco-landingpages-form2', true ); ?>

			<p>
				<label for="bco-landingpages-pass-02">To Form 2: </label>
				<select name="bco-landingpages-pass-02" id="bco-landingpages-pass-02">
					<option>-- Select field to accept information from Step 1</option>
					<?php foreach ( $forms as $form => $value ) : ?>
						<?php if ( $value['id'] == $selected_form2 ) : ?>
							<?php $labels = $value['fields']; ?>
							<?php foreach ($labels as $label => $value): ?>
								<option value="<?php echo $value->id; ?>" <?php if ( isset ( $stored_meta['bco-landingpages-pass-02'] ) ) selected( $stored_meta['bco-landingpages-pass-02'][0], $value->id ); ?>><?php echo $value->label; ?></option>
							<?php endforeach ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</p>

			<hr>

			<h1><strong>(3) Select Page 2 and 3</strong></h1>

			<?php 
				$get_pages_args = array( 'post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => -1 );
				$get_pages = new WP_Query($get_pages_args);
			?>

			<p>
				<label for="bco-landingpages-page-2">Select Step 2 Page</label>
				<select name="bco-landingpages-page-2" id="bco-landingpages-page-2">
					<option>-- Select Step 2 Page</option>
					<?php while ( $get_pages->have_posts() ) : $get_pages->the_post(); ?>
						<option value="<?php echo get_the_ID(); ?>" <?php if ( isset ( $stored_meta['bco-landingpages-page-2'] ) ) selected( $stored_meta['bco-landingpages-page-2'][0], get_the_ID() ); ?>><?php echo get_the_title(); ?></option>
					<?php endwhile; wp_reset_postdata(); ?>
				</select>	
			</p>

			<?php 
				$get_pages_args = array( 'post_type' => 'page', 'post_status' => 'publish', 'posts_per_page' => -1 );
				$get_pages = new WP_Query($get_pages_args);
			?>

			<p>
				<label for="bco-landingpages-page-3">Select Thank You Page</label>
				<select name="bco-landingpages-page-3" id="bco-landingpages-page-3">
					<option>-- Select Thank You Page</option>
					<?php while ( $get_pages->have_posts() ) : $get_pages->the_post(); ?>
						<option value="<?php echo get_the_ID(); ?>" <?php if ( isset ( $stored_meta['bco-landingpages-page-3'] ) ) selected( $stored_meta['bco-landingpages-page-3'][0], get_the_ID() ); ?>><?php echo get_the_title(); ?></option>
					<?php endwhile; wp_reset_postdata(); ?>
				</select>
			</p>

			<hr>

			<h1><strong>(4) Page 3, Thank you Page Options:</strong></h1>

			<p>
				<label for="bco-landingpages-ty-msg">Thank You Page Message</label>
				<input style="width: 100%" type="text" name="bco-landingpages-ty-msg" id="bco-landingpages-ty-msg" value="<?php if ( isset ( $stored_meta['bco-landingpages-ty-msg'] ) ) echo $stored_meta['bco-landingpages-ty-msg'][0]; ?>" />
			</p>

			<p>
				<label for="bco-landingpages-link-to">Link to:</label>
				<input style="width: 100%" type="text" name="bco-landingpages-link-to" id="bco-landingpages-link-to" value="<?php if ( isset ( $stored_meta['bco-landingpages-link-to'] ) ) echo $stored_meta['bco-landingpages-link-to'][0]; ?>" />
			</p>

			<p>
				<label for="bco-landingpages-link-to-text">Text for link above:</label>
				<input style="width: 100%" type="text" name="bco-landingpages-link-to-text" id="bco-landingpages-link-to-text" value="<?php if ( isset ( $stored_meta['bco-landingpages-link-to-text'] ) ) echo $stored_meta['bco-landingpages-link-to-text'][0]; ?>" />
			</p>

			<h1><strong>Google Maps Integration</strong></h1>

			<p>
				<label for="bco-landingpages-gmaps-autocomplete">
					<input type="checkbox" name="bco-landingpages-gmaps-autocomplete" id="bco-landingpages-gmaps-autocomplete" value="yes" <?php if ( isset ( $stored_meta['bco-landingpages-gmaps-autocomplete'] ) ) checked( $stored_meta['bco-landingpages-gmaps-autocomplete'][0], 'yes' ); ?> />
					Use Google Maps address autocomplete for Step 1?
				</label>				
			</p>

			<p>
				<label for="bco-landingpages-map">
					<input type="checkbox" name="bco-landingpages-map" id="bco-landingpages-map" value="yes" <?php if ( isset ( $stored_meta['bco-landingpages-map'] ) ) checked( $stored_meta['bco-landingpages-map'][0], 'yes' ); ?> />
					Display Google Maps for Step 2? (Only apply if Step 1 is asking for an address)
				</label>				
			</p>

			<p>
				<label for="bco-landingpages-gmaps-confirmation">
					<input type="checkbox" name="bco-landingpages-gmaps-confirmation" id="bco-landingpages-gmaps-confirmation" value="yes" <?php if ( isset ( $stored_meta['bco-landingpages-gmaps-confirmation'] ) ) checked( $stored_meta['bco-landingpages-gmaps-confirmation'][0], 'yes' ); ?> />
					Add an additional step for map confirmation? The user will be shown the map after the submit their address and will be asked if the map is accurate. (<strong>Will only work work if the option for "Display Google Maps on Step 2" is checked.</strong>)
				</label>				
			</p>

			<p>
				<label for="bco-landingpages-gmaps-streetview">
					<input type="checkbox" name="bco-landingpages-gmaps-streetview" id="bco-landingpages-gmaps-streetview" value="yes" <?php if ( isset ( $stored_meta['bco-landingpages-gmaps-streetview'] ) ) checked( $stored_meta['bco-landingpages-gmaps-streetview'][0], 'yes' ); ?> />
					Google Street View?
				</label>				
			</p>

		<?php endif; ?>

		<?php if ( $template === 'template-landingpage-02.php') : ?>
			<h2>Go back to the main page for options.</h2>
		<?php endif; ?>

		<?php if ( $template === 'template-landingpage-03.php') : ?>
			<h2>Go back to the main page for options.</h2>
		<?php endif; ?>

		<?php
	}

	public static function save( $post_id ) {
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'bco_nonce' ] ) && wp_verify_nonce( $_POST[ 'bco_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		if( isset( $_POST[ 'bco-landingpages-form' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-form', $_POST[ 'bco-landingpages-form' ] );
		}

		if( isset( $_POST[ 'bco-landingpages-pass-01' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-pass-01', $_POST[ 'bco-landingpages-pass-01' ] );
		}

		if( isset( $_POST[ 'bco-landingpages-page-2' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-page-2', $_POST[ 'bco-landingpages-page-2' ] );
		}

		if( isset( $_POST[ 'bco-landingpages-form2' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-form2', $_POST[ 'bco-landingpages-form2' ] );
		}

		if( isset( $_POST[ 'bco-landingpages-pass-02' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-pass-02', $_POST[ 'bco-landingpages-pass-02' ] );
		}

		if( isset( $_POST[ 'bco-landingpages-page-3' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-page-3', $_POST[ 'bco-landingpages-page-3' ] );
		}

		if ( isset( $_POST[ 'bco-landingpages-gmaps-autocomplete' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-gmaps-autocomplete', 'yes' );
		} else {
			update_post_meta( $post_id, 'bco-landingpages-gmaps-autocomplete', '' );
		}

		if ( isset( $_POST[ 'bco-landingpages-gmaps-confirmation' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-gmaps-confirmation', 'yes' );
		} else {
			update_post_meta( $post_id, 'bco-landingpages-gmaps-confirmation', '' );
		}

		if ( isset( $_POST[ 'bco-landingpages-gmaps-streetview' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-gmaps-streetview', 'yes' );
		} else {
			update_post_meta( $post_id, 'bco-landingpages-gmaps-streetview', '' );
		}

		if ( isset( $_POST[ 'bco-landingpages-map' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-map', 'yes' );
		} else {
			update_post_meta( $post_id, 'bco-landingpages-map', '' );
		}

	    if ( isset( $_POST[ 'bco-landingpages-ty-msg' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-ty-msg', sanitize_text_field( $_POST[ 'bco-landingpages-ty-msg' ] ) );
	    }

	    if ( isset( $_POST[ 'bco-landingpages-link-to' ] ) ) {
			update_post_meta( $post_id, 'bco-landingpages-link-to', sanitize_text_field( $_POST[ 'bco-landingpages-link-to' ] ) );
	    }

        if ( isset( $_POST[ 'bco-landingpages-link-to-text' ] ) ) {
    		update_post_meta( $post_id, 'bco-landingpages-link-to-text', sanitize_text_field( $_POST[ 'bco-landingpages-link-to-text' ] ) );
        }

	}

	public static function clean() {
		remove_meta_box('postexcerpt', 'page', 'normal');
		remove_meta_box('trackbacksdiv', 'page', 'normal');
		remove_meta_box('postcustom', 'page', 'normal');
		remove_meta_box('commentstatusdiv', 'page', 'normal');
		remove_meta_box('commentsdiv', 'page', 'normal');
		remove_meta_box('revisionsdiv', 'page', 'normal');
		remove_meta_box('authordiv', 'page', 'normal');
		remove_meta_box('sqpt-meta-tags', 'page', 'normal');
		remove_meta_box('postdivrich', 'page', 'normal');
		remove_meta_box('slugdiv', 'page', 'normal');
		remove_post_type_support( 'page', 'editor' );
	}

	public static function remove_style() {
		global $wp_styles;
		unset( $wp_styles->registered['gforms_datepicker_css'] );
		unset( $wp_styles->registered['gforms_browsers_css'] );
		unset( $wp_styles->registered['gforms_formsmain_css'] );
		unset( $wp_styles->registered['gforms_reset_css'] );
		unset( $wp_styles->registered['gforms_ready_class_css'] );
	}

	public static function title() {
		return get_post_meta( get_the_ID(), 'bco-landingpages-title', true );
	}

	public static function form( $id ) {
		$formid = get_post_meta( $id, 'bco-landingpages-form', true );
		return $formid;
	}

	public static function form2( $id ) {
		$formid = get_post_meta( $id, 'bco-landingpages-form2', true );
		return $formid;
	}

	public static function find_page2_parent() {
		global $post;
		if ( $post->post_parent )	{
			$ancestors = get_post_ancestors($post->ID);
			$root = count($ancestors) - 1;
			$parent = $ancestors[$root];
			
		} else {
			$parent = $post->ID;
		}

		return $parent;
	}

	public static function find_page3_parent() {
		global $wpdb;
		global $post;

		$meta_key = 'bco-landingpages-page-3';

		$parentid = $wpdb->get_var( $wpdb->prepare( 
			"
				SELECT post_id
				FROM $wpdb->postmeta 
				WHERE meta_key LIKE %s AND meta_value LIKE %s
			", 
			$meta_key,
			$post->ID
		) );

		return $parentid;
	}

	public static function setup_page_list() {
		// Add option if it doesn't exist
		if ( ! get_option('bco_landingpages_pages') ) {
			add_option('bco_landingpages_pages');
		}

		// Create a list of page ID's set to the landing pages template
		$list = array();

		// Get all pages
		$pages_args = array(
			'post_type' => 'page',
			'posts_per_page' => -1
		);
		$all_pages = new WP_Query($pages_args);

		// Add in all page ID's set to landing pages template to the list array
		while ( $all_pages->have_posts() ) {
			$all_pages->the_post();
			global $post;

			if ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-landingpage-01.php' ) {
				$list[] = $post->ID;
			}
		}
		wp_reset_postdata();

		// Update option with all ID's of pages that have the landing pages template
		update_option('bco_landingpages_pages', $list);
	}

	public static function create_subpages() {
		$list = get_option('bco_landingpages_pages');
		foreach ( $list as $pageid ) {

			// Find out if each page with the landing page template has children.
			$pages_args = array(
				'post_type' => 'page',
				'post_status' => 'publish',
				'child_of' => $pageid
			);

			$has_children = get_pages( $pages_args );

			// If it does not have children, then we will add them in
			if ( count( $has_children ) == 0  ) {
				$step2id = wp_insert_post(
					array(
						'post_title' => get_the_title($pageid) . ' Step 2',
						'post_type' => 'page',
						'post_name' => 'step-2',
						'post_parent' => $pageid,
						'post_status' => 'publish'
					)
				);

				update_post_meta( $step2id, '_wp_page_template', 'template-landingpage-02.php');
				update_post_meta( $pageid, 'bco-landingpages-page-2', $step2id );

				$step3id = wp_insert_post(
					array(
						'post_title' => get_the_title($pageid) . ' Step 3',
						'post_type' => 'page',
						'post_name' => 'step-3',
						'post_parent' => $pageid,
						'post_status' => 'publish'
					)
				);

				update_post_meta( $step3id, '_wp_page_template', 'template-landingpage-03.php');
				update_post_meta( $pageid, 'bco-landingpages-page-3', $step3id );	
			}
		}
	}

	public static function get_subpage_id( $step = 2 ) {
		// $step = 2 will return step 2 page id
		global $post;

		$list = get_option('bco_landingpages_pages');

		foreach ( $list as $pageid ) {

			if ( $pageid === $post->ID ) {

				$pages_args = array(
					'ID' => $post->ID,
					'post_type' => 'page',
					'post_status' => 'publish',
					'child_of' => $pageid
				);

				$has_children = get_pages( $pages_args );

				foreach ( $has_children as $child ) {
					if ( $child->post_name === 'step-' . $step ) {
						return $child->ID;
					}
				}
			}
		}
	}

	public static function form_redirect( $confirmation, $form, $entry, $ajax ) {

		global $post;

		if ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-landingpage-01.php' ) {
			$nextpage = get_permalink( get_post_meta( get_the_ID(), 'bco-landingpages-page-2', true) );
			$pass = get_post_meta( get_the_ID(), 'bco-landingpages-pass-01', true);
			$confirmation = array( 'redirect' => $nextpage . '?pass=' . $entry[$pass] );
			return $confirmation;

		} elseif ( get_post_meta( $post->ID, '_wp_page_template', true ) === 'template-landingpage-02.php' ) {
			$nextpage = get_permalink( get_post_meta( BrandcoLandingPages::find_page2_parent(), 'bco-landingpages-page-3', true) );
			$confirmation = array( 'redirect' => $nextpage );
			return $confirmation;
		} else {
			return $confirmation;
		}

	}

}


/**
 *  
 */
class BrandcoIncludeTemplates {

	private static $instance;

	protected $templates;

	public static function get_instance() {

	    if( null == self::$instance ) {
			self::$instance = new BrandcoIncludeTemplates();
		} 

		return self::$instance;
	} 

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();

		// Add a filter to the attributes metabox to inject template into the cache.
		add_filter(
			'page_attributes_dropdown_pages_args',
			 array( $this, 'register_project_templates' ) 
		);

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data', 
			array( $this, 'register_project_templates' ) 
		);

		// Add a filter to the template include to determine if the page has our 
		// template assigned and return it's path
		add_filter(
			'template_include', 
			array( $this, 'view_project_template') 
		);

		// Add your templates to this array.
		$this->templates = array(
			'template-landingpage-01.php' => 'Landing Page Setup',
			'template-landingpage-02.php' => 'Landing Page Step 2 Template',
			'template-landingpage-03.php' => 'Landing Page Step 3 Template'
		);
	} 

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 */
	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list. 
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
		        $templates = array();
		} 

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;
	} 

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {

		global $post;

		if (!isset($this->templates[get_post_meta( $post->ID, '_wp_page_template', true )] ) ) {
			return $template;	
		} 

		$file = plugin_dir_path(__FILE__). get_post_meta( 
			$post->ID, '_wp_page_template', true 
		);


		if ( file_exists( $file ) ) {
			return $file;
		} 
		else { echo $file; }

		return $template;
	} 
}

add_action( 'plugins_loaded', array( 'BrandcoIncludeTemplates', 'get_instance' ) );
add_action( 'admin_init', array( 'BrandcoIncludeTemplates', 'get_instance' ) );

// Update option 1 javascript 
add_action('admin_footer', 'update_option_1_javascript');
function update_option_1_javascript() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {

			$('#bco-landingpages-form').on('change', function() {
				var formId = $(this).val();
				var postId = $(this).attr('data-post-id');

				var data = {
					'action': 'update_option_1',
					form_id: formId,
					post_id: postId
				};

				$.post(ajaxurl, data, function(response) {
					$('#bco-landingpages-pass-01').html('').append(response);
				});
			});
		});
	</script> <?php
}

// Update option 1 callback
add_action( 'wp_ajax_update_option_1', 'update_option_1_callback' );
function update_option_1_callback() {
	global $wpdb; 
	$forms = \GFAPI::get_forms();
	$selected_form = $_POST['form_id'];

	?>
		<option>-- Select field to pass information to Step 2</option>
		<?php foreach ( $forms as $form => $value ) : ?>
			<?php if ( $value['id'] == $selected_form ) : ?>
				<?php $labels = $value['fields']; ?>
				<?php foreach ($labels as $label => $value): ?>
					<option value="<?php echo $value->id; ?>">
						<?php echo $value->label; ?>
					</option>
				<?php endforeach ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php

	wp_die(); 
}

// Update option 2 javascript 
add_action('admin_footer', 'update_option_2_javascript');
function update_option_2_javascript() { ?>
	<script type="text/javascript" >
		jQuery(document).ready(function($) {

			$('#bco-landingpages-form2').on('change', function() {
				var formId = $(this).val();
				var postId = $(this).attr('data-post-id');

				var data = {
					'action': 'update_option_2',
					form_id: formId,
					post_id: postId
				};

				$.post(ajaxurl, data, function(response) {
					$('#bco-landingpages-pass-02').html('').append(response);
				});
			});
		});
	</script> <?php
}

// Update option 2 callback
add_action( 'wp_ajax_update_option_2', 'update_option_2_callback' );
function update_option_2_callback() {
	global $wpdb; 
	$forms = \GFAPI::get_forms();
	$selected_form = $_POST['form_id'];

	?>
		<option>-- Select field to accept information from Step 1</option>
		<?php foreach ( $forms as $form => $value ) : ?>
			<?php if ( $value['id'] == $selected_form ) : ?>
				<?php $labels = $value['fields']; ?>
				<?php foreach ($labels as $label => $value): ?>
					<option value="<?php echo $value->id; ?>">
						<?php echo $value->label; ?>
					</option>
				<?php endforeach ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php

	wp_die(); 
}

?>