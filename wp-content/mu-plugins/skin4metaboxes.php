<?php

add_action( 'init', 'codex_community_init' );
/**
 * Register a community/area/city post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_community_init() {
	$labels = array(
		'name'               => _x( 'Communities', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Community', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Communities', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Community', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Community', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Community', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Community', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Community', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Communities', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Communities', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Communities:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No community found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No community found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'community' ),
		'capability_type'    => 'post',
		'has_archive'        => 'communities',
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-location-alt',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'cptp_permalink_structure'     => '/%postname%/'
	);

	register_post_type( 'city', $args );
}

add_action( 'init', 'codex_agent_init' );
/**
 * Register a agent post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_agent_init() {
	$labels = array(
		'name'               => _x( 'Agents', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Agent', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Agents', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Agent', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Agent', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Agent', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Agent', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Agent', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Agents', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Agents', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Agents:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No agent found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No agent found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'agent' ),
		'capability_type'    => 'post',
		'has_archive'        => 'agents',
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'cptp_permalink_structure'     => '/%postname%/'
	);

	register_post_type( 'agent', $args );
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
// function myplugin_add_meta_box_fullwidth() {

// 	$screens = array( 'post', 'page', 'city', 'agent' );

// 	foreach ( $screens as $screen ) {

// 		add_meta_box(
// 			'myplugin_sectionid_fullwidth',
// 			__( 'Full Width', 'myplugin_textdomain_fullwidth' ),
// 			'myplugin_meta_box_callback_fullwidth',
// 			$screen,
// 			'side'
// 		);
// 	}
// }
// add_action( 'add_meta_boxes', 'myplugin_add_meta_box_fullwidth' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
// function myplugin_meta_box_callback_fullwidth( $post ) {

// 	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

// 	post_meta( $post->ID, '_my_meta_value_key_fw', true );

// 	$prfx_stored_meta_fullwidth = get_post_meta( $post->ID );

// 	echo '<label for="meta-checkbox">';
// 	    echo '<input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes"';
// 	    if ( isset ( $prfx_stored_meta_fullwidth['meta-checkbox'] ) ) checked( $prfx_stored_meta_fullwidth['meta-checkbox'][0], 'yes' );
// 	    echo '/>';
// 	    _e( 'Checking this hides the sidebar and makes the content full width', 'prfx-textdomain' );
// 	echo '</label>';
// }

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
// function myplugin_save_meta_box_data_fullwidth( $post_id ) {

// 	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
// 		return;
// 	}

// 	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
// 		return;
// 	}

// 	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
// 		return;
// 	}

// 	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

// 		if ( ! current_user_can( 'edit_page', $post_id ) ) {
// 			return;
// 		}

// 	} else {

// 		if ( ! current_user_can( 'edit_post', $post_id ) ) {
// 			return;
// 		}
// 	}

// 	if ( ! isset( $_POST['meta-checkbox'] ) ) {
// 		return;
// 	}

// 	$my_data = sanitize_text_field( $_POST['meta-checkbox'] );

// 	if( isset( $_POST[ 'meta-checkbox' ] ) ) {
// 		update_post_meta( $post_id, 'meta-checkbox', 'yes' );
// 	} else {
// 		update_post_meta( $post_id, 'meta-checkbox', '' );
// 	}
// }
// add_action( 'save_post', 'myplugin_save_meta_box_data_fullwidth' );

/**
 * Meta box for agent cpt
 */
function myplugin_add_meta_box_agent() {

	$screens = array( 'agent' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid_agent',
			__( 'Information', 'myplugin_textdomain_agent' ),
			'myplugin_meta_box_callback_agent',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box_agent' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current agent.
 */
function myplugin_meta_box_callback_agent( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	// global $post;
	// $info = get_post_meta( $post->ID, '_info', true );
	// $info_array = wp_parse_args($info,array('agenttitle' =>'','agentphone' =>'','agentemail' =>'','agentlistings' =>'','agentwebsite' =>'','facebook' => '','twitter' => '','linkedin' => '','featuredlistings' => ''));
	// extract($info_array);

	$value_agenttitle = get_post_meta( $post->ID, '_my_meta_value_key1', true );
	$value_agentphone = get_post_meta( $post->ID, '_my_meta_value_key2', true );
	$value_agentemail = get_post_meta( $post->ID, '_my_meta_value_key3', true );
	$value_agentlistings = get_post_meta( $post->ID, '_my_meta_value_key4', true );
	$value_agentwebsite = get_post_meta( $post->ID, '_my_meta_value_key5', true );
	$value_facebook = get_post_meta( $post->ID, '_my_meta_value_key6', true );
	$value_twitter = get_post_meta( $post->ID, '_my_meta_value_key7', true );
	$value_linkedin = get_post_meta( $post->ID, '_my_meta_value_key8', true );
	$value_featuredlistings = get_post_meta( $post->ID, '_my_meta_value_key9', true );

	echo '<label for="myplugin_new_field1">';
	_e( 'Agent Title', 'myplugin_textdomain1' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field1" name="myplugin_new_field1" value="' . esc_attr( $value_agenttitle ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field2">';
	_e( 'Agent Phone Number', 'myplugin_textdomain2' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field2" name="myplugin_new_field2" value="' . esc_attr( $value_agentphone ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field3">';
	_e( 'Agent Email Address', 'myplugin_textdomain3' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field3" name="myplugin_new_field3" value="' . esc_attr( $value_agentemail ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field4">';
	_e( 'Agent Listings (URL)', 'myplugin_textdomain4' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field4" name="myplugin_new_field4" value="' . esc_attr( $value_agentlistings ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field5">';
	_e( 'Agent Website (URL)', 'myplugin_textdomain5' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field5" name="myplugin_new_field5" value="' . esc_attr( $value_agentwebsite ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field6">';
	_e( 'Facebook (URL)', 'myplugin_textdomain6' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field6" name="myplugin_new_field6" value="' . esc_attr( $value_facebook ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field7">';
	_e( 'Twitter (URL)', 'myplugin_textdomain7' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field7" name="myplugin_new_field7" value="' . esc_attr( $value_twitter ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field8">';
	_e( 'LinkeIn (URL)', 'myplugin_textdomain8' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field8" name="myplugin_new_field8" value="' . esc_attr( $value_linkedin ) . '" size="25" />';

	echo '<br />';
	echo '<br />';

	echo '<label for="myplugin_new_field9">';
	_e( 'Agent Featured Listings Code', 'myplugin_textdomain9' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field9" name="myplugin_new_field9" value="' . esc_attr( $value_featuredlistings ) . '" size="25" />';

	// global $post;
	// $info = wp_parse_args(get_post_meta($post->ID,'_info',true),array('agenttitle' =>'','agentphone' =>'','agentemail' =>'','agentlistings' =>'','agentwebsite' =>'','facebook' => '','twitter' => '','linkedin' => '','featuredlistings' => ''));
	// extract($info);

	// echo '<input type="hidden" name="' . $this->nonce . '_noncename" id="' . $this->nonce . '_noncename" value="' . wp_create_nonce( __FILE__ ) . '" />';

	// echo '<p><strong>Agent Title</strong><br />';
	// echo '<input type="text" name="info[agenttitle]" value="' . $agenttitle . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Agent Phone Number</strong><br />';
	// echo '<input type="text" name="info[agentphone]" value="' . $agentphone . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Agent Email Address</strong><br />';
	// echo '<input type="text" name="info[agentemail]" value="' . $agentemail . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Agent Listings (URL)</strong><br />';
	// echo '<input type="text" name="info[agentlistings]" value="' . $agentlistings . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Agent Website (URL)</strong><br />';
	// echo '<input type="text" name="info[agentwebsite]" value="' . $agentwebsite . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Facebook (URL)</strong><br />';
	// echo '<input type="text" class="code" name="info[facebook]" value="' . $facebook . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Twitter (URL)</strong><br />';
	// echo '<input type="text" class="code" name="info[twitter]" value="' . $twitter . '" style="width: 100%;" /></p>';

	// echo '<p><strong>LinkedIn (URL)</strong><br />';
	// echo '<input type="text" class="code" name="info[linkedin]" value="' . $linkedin . '" style="width: 100%;" /></p>';

	// echo '<p><strong>Agent Featured Listings Code</strong><br />';
	// echo '<textarea class="code" name="info[featuredlistings]" style="width: 100%;" />' . $featuredlistings . '</textarea><br /><span style="font-size: 10px; font-style: italic;">Get this from ther WNT WP Plugin</span></p>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data_agent( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['myplugin_new_field1'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field2'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field3'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field4'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field5'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field6'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field7'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field8'] ) ) {
		return;
	}
	if ( ! isset( $_POST['myplugin_new_field9'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data1 = sanitize_text_field( $_POST['myplugin_new_field1'] );
	$my_data2 = sanitize_text_field( $_POST['myplugin_new_field2'] );
	$my_data3 = sanitize_text_field( $_POST['myplugin_new_field3'] );
	$my_data4 = sanitize_text_field( $_POST['myplugin_new_field4'] );
	$my_data5 = sanitize_text_field( $_POST['myplugin_new_field5'] );
	$my_data6 = sanitize_text_field( $_POST['myplugin_new_field6'] );
	$my_data7 = sanitize_text_field( $_POST['myplugin_new_field7'] );
	$my_data8 = sanitize_text_field( $_POST['myplugin_new_field8'] );
	$my_data9 = sanitize_text_field( $_POST['myplugin_new_field9'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key1', $my_data1 );
	update_post_meta( $post_id, '_my_meta_value_key2', $my_data2 );
	update_post_meta( $post_id, '_my_meta_value_key3', $my_data3 );
	update_post_meta( $post_id, '_my_meta_value_key4', $my_data4 );
	update_post_meta( $post_id, '_my_meta_value_key5', $my_data5 );
	update_post_meta( $post_id, '_my_meta_value_key6', $my_data6 );
	update_post_meta( $post_id, '_my_meta_value_key7', $my_data7 );
	update_post_meta( $post_id, '_my_meta_value_key8', $my_data8 );
	update_post_meta( $post_id, '_my_meta_value_key9', $my_data9 );

	// update_post_meta($post_id,'_info',$_POST['info']);
}
add_action( 'save_post', 'myplugin_save_meta_box_data_agent' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box_community() {

	$screens = array( 'city' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid_community',
			__( 'Featured Community Option Foor Footer', 'myplugin_textdomain_community' ),
			'myplugin_meta_box_callback_community',
			$screen,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box_community' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback_community( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$prfx_stored_meta = get_post_meta( $post->ID );

	?>
	<p>
	    <span class="prfx-row-title"><?php _e( 'You may select up to twelve communities to be featured in the footer.', 'prfx-textdomain' )?></span>
	    <div class="prfx-row-content">
	        <label for="meta-checkbox">
	            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $prfx_stored_meta['meta-checkbox'] ) ) checked( $prfx_stored_meta['meta-checkbox'][0], 'yes' ); ?> />
	            <?php _e( 'Featured Community', 'prfx-textdomain' )?>
	        </label>
	    </div>
	    <!-- <div class="prfx-row-content">
	        <label for="meta-checkbox-two">
	            <input type="checkbox" name="meta-checkbox-two" id="meta-checkbox-two" value="yes" <?php if ( isset ( $prfx_stored_meta['meta-checkbox-two'] ) ) checked( $prfx_stored_meta['meta-checkbox-two'][0], 'yes' ); ?> />
	            <?php _e( 'Display this community on phone? Note: Community must also be featured.', 'prfx-textdomain' )?>
	        </label>
	    </div> -->
	</p>
	<?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data_community( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-checkbox', '' );
	}

	// Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox-two' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox-two', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-checkbox-two', '' );
	}
}
add_action( 'save_post', 'myplugin_save_meta_box_data_community' );

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box_pages() {

	$screens = array( 'page' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid_page',
			__( 'Featured Page (Will Display on Homepage)', 'myplugin_textdomain_community' ),
			'myplugin_meta_box_callback_page',
			$screen,
			'normal',
			'high'
		);
	}
}
// add_action( 'add_meta_boxes', 'myplugin_add_meta_box_pages' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback_page( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$prfx_stored_meta = get_post_meta( $post->ID );

	?>
	<p>
	    <span class="prfx-row-title"><?php _e( 'Note: Only select 3, 6, 9, 12 featured pages to show up on the homepage. Any additional pages will be hidden.', 'prfx-textdomain' )?></span>
	    <div class="prfx-row-content">
	        <label for="meta-checkbox-homepage">
	            <input type="checkbox" name="meta-checkbox-homepage" id="meta-checkbox-homepage" value="yes" <?php if ( isset ( $prfx_stored_meta['meta-checkbox-homepage'] ) ) checked( $prfx_stored_meta['meta-checkbox-homepage'][0], 'yes' ); ?> />
	            <?php _e( 'Featured Page (Displays this page on the homepage)', 'prfx-textdomain' )?>
	        </label>
	    </div>
	    <div class="prfx-row-content">
	        <label for="meta-checkbox-homepage-two">
	            <input type="checkbox" name="meta-checkbox-homepage-two" id="meta-checkbox-homepage-two" value="yes" <?php if ( isset ( $prfx_stored_meta['meta-checkbox-homepage-two'] ) ) checked( $prfx_stored_meta['meta-checkbox-homepage-two'][0], 'yes' ); ?> />
	            <?php _e( 'Display this page on phone? Note: Page must also be featured.', 'prfx-textdomain' )?>
	        </label>
	    </div>
	</p>
	<?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data_page( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox-homepage' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox-homepage', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-checkbox-homepage', '' );
	}

	// Checks for input and saves
	if( isset( $_POST[ 'meta-checkbox-homepage-two' ] ) ) {
	    update_post_meta( $post_id, 'meta-checkbox-homepage-two', 'yes' );
	} else {
	    update_post_meta( $post_id, 'meta-checkbox-homepage-two', '' );
	}
}
add_action( 'save_post', 'myplugin_save_meta_box_data_page' );
