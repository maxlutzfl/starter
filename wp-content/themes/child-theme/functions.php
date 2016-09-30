<?php
/**
 * @package BrandCo. Framework Child Theme
 */

# Required files
function bco_child_theme_setup() {
	require BCO_CHILD_BASE_DIRECTORY . '/config/scripts-and-styles.php';
}

add_action('init', 'bco_child_theme_setup');