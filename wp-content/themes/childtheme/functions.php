<?php
/**
 * @package BrandCo. Framework Child Theme
 */

/** Required files */
add_action('init', 'bco_child_theme_setup');
function bco_child_theme_setup() {
	require BCO_CHILD_BASE_DIRECTORY . '/config/scripts-and-styles.php';
}

/** Custom admin styles */
add_action('admin_head', 'wp_admin_custom_styles');
function wp_admin_custom_styles() {
	?>
<style>
	.post-type-page #postimagediv h2 span { font-size: 0; }
	.post-type-page #postimagediv h2 span:after { content: "Background Image"; font-size: 14px; }
</style>
	<?php
}