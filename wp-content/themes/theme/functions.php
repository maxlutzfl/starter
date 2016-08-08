<?php
/**
 * @package BrandCo Starter Theme
 * @subpackage Main Functions File
 * @author BrandCo. LLC
 */

/**
 * Define global constants
 */

define('CONFIG_DIRECTORY', dirname(__FILE__) . '/config/');
define('RESOURCES_DIRECTORY_URI', get_template_directory_uri() . '/resources/');
define('IMAGE_DIRECTORY_URI', get_template_directory_uri() . '/resources/images/');
define('STYLESHEET_DIRECTORY_URI', get_template_directory_uri() . '/resources/styles/css/');
define('SCRIPTS_DIRECTORY_URI', get_template_directory_uri() . '/resources/scripts/');
define('GOOGLE_FONTS', 'Open+Sans:400,700');

/**
 * Require config files
 */

require CONFIG_DIRECTORY . 'theme-setup.php';
require CONFIG_DIRECTORY . 'theme-functions.php';
