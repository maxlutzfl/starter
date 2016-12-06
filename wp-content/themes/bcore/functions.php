<?php
/**
 * Functons.php
 * @package bcore
 */

// Global constants
define('BCORE_PARENT_DIRECTORY_NAME', 'bcore');
define('BCORE_PARENT_BASE_DIRECTORY', get_template_directory());
define('BCORE_PARENT_CONFIG_DIRECTORY', get_template_directory() . '/config/');
define('BCORE_PARENT_RESOURCES_DIRECTORY', get_template_directory_uri() . '/resources/');

// Required files
require BCORE_PARENT_CONFIG_DIRECTORY . '/config.php';

