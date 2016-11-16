<?php
/**
 * Plugin Name: Post Types
 * Plugin URI: https://brandco.com/
 * Description: Post Type
 * Author: BrandCo
 * Version: 1.0.0
 * Author URI: https://brandco.com/
 */

class BcorePostTypes { 

	function __construct() {
		add_action('init', array($this, 'agents_post_types'));
		add_action('init', array($this, 'testimonials_post_types'));
		add_action('init', array($this, 'listings_post_types'));
		add_action('pre_get_posts', array($this, 'pre_get_agents_posts')); 
		add_action('add_meta_boxes', array($this, 'designated_pages_metabox'));
		add_action('save_post', array($this, 'designated_pages_save'));
		add_filter('display_post_states', array($this, 'designated_pages_setup_labels'));
	}

	public function listings_post_types() {
		$menu_name = 'Listings';
		$regular_name = 'Listings';
		$singular_name = 'Listing';
		$register_name = 'listings';
		$icon = 'dashicons-admin-multisite';

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
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'menu_icon'			 => $icon,
			'supports'           => array('title', 'editor', 'page-attributes', 'thumbnail')
		);

		register_post_type( $register_name, $args );		
	}

	public function agents_post_types() {
		$menu_name = 'Agents';
		$regular_name = 'Agents';
		$singular_name = 'Agent';
		$register_name = 'agents';
		$icon = 'dashicons-groups';

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
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'menu_icon'			 => $icon,
			'supports'           => array('title', 'editor', 'page-attributes', 'thumbnail')
		);

		register_post_type( $register_name, $args );		
	}

	public function testimonials_post_types() {
		$menu_name = 'Testimonials';
		$regular_name = 'Testimonials';
		$singular_name = 'Testimonial';
		$register_name = 'testimonials';
		$icon = 'dashicons-format-status';

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
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'menu_icon'			 => $icon,
			'supports'           => array('title', 'editor')
		);

		register_post_type( $register_name, $args );		
	}

	/**
	 * Pre Get Posts
	 */

	public function pre_get_agents_posts($query) {

		if ( !is_admin() && $query->is_main_query() && is_post_type_archive('agents') ) {
			$query->set('posts_per_page', -1);
			$query->set('orderby', 'menu_order');
			$query->set('order', 'ASC');
		}

		return $query;
	}

	/**
	 * Designated Page Options
	 */

	public function designated_pages_setup_labels($states) {
		global $post;

		$post_types = array(
			'agents',
			'listings',
			'testimonials'
		);

		foreach ( $post_types as $type ) {
			$details = get_post_type_object($type);
			$label = $details->label;

			if ( (int) $post->ID === (int) get_option('page_for_' . $type)) {
				return array($label . ' Page');
			}
		}

		return $states;
	}

	public function designated_pages_metabox() {
		add_meta_box( 
			'designated_pages_metabox', 
			'Designated Pages', 
			array($this, 'designated_pages_callback'), 
			'page',
			'side'
		);
	}

	public function designated_pages_callback($post) {
		wp_nonce_field(basename(__FILE__), 'designated_pages_nonce');
		$prfx_stored_meta = get_post_meta($post->ID);
		?>
		<p>
			<label for="designated_pages_option">
				<p>Designate this page as the main page for post types like Posts, Employees, Products or Listings if needed.</p>
			</label>
			<select name="designated_pages_option" id="designated_pages_option" style="width: 100%;">
				<option>-- Regular Page --</option>
				<option value="page_on_front" <?php echo ($post->ID === get_option('page_on_front')) ? 'selected' : ''; ?>>Homepage</option>
				<option value="page_for_posts" <?php echo ($post->ID === get_option('page_for_posts')) ? 'selected' : ''; ?>>Posts Page</option>
				<option value="page_for_agents" <?php echo ($post->ID === get_option('page_for_agents')) ? 'selected' : ''; ?>>Agents Page</option>
				<option value="page_for_listings" <?php echo ($post->ID === get_option('page_for_listings')) ? 'selected' : ''; ?>>Listings Page</option>
				<option value="page_for_testimonials" <?php echo ($post->ID === get_option('page_for_testimonials')) ? 'selected' : ''; ?>>Testimonials Page</option>
			</select>
		</p>
		<?php 
	}

	public function designated_pages_save($post_id) {

		// Checks save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = (isset($_POST['designated_pages_nonce'] ) && wp_verify_nonce($_POST['designated_pages_nonce'], basename(__FILE__))) ? 'true' : 'false';

		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		$options = array('page_on_front', 'page_for_posts', 'page_for_agents', 'page_for_listings', 'page_for_testimonials');

		// Checks for input and sanitizes/saves if needed
		if ( isset($_POST['designated_pages_option']) ) {

			foreach ( $options as $option ) {
				if ( (int) get_option($option) === (int) $post_id ) {
					update_option($option, 0);
				}
			}

			update_option($_POST['designated_pages_option'], $post_id);
		}
	}
}

new BcorePostTypes();