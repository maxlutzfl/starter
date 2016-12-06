<?php
/**
 * Config
 * @package bcore
 */

/** Core */
require BCORE_PARENT_CONFIG_DIRECTORY . '/core/cleanup.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/core/google-analytics.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/core/gravity-forms.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/core/login-screen.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/core/modes.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/core/module-builder.php';

/** Setup */
require BCORE_PARENT_CONFIG_DIRECTORY . '/setup/customize-options.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/setup/scripts-styles.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/setup/theme-setup.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/setup/widgets.php';

/** Functions */
require BCORE_PARENT_CONFIG_DIRECTORY . '/functions/helpers.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/functions/social-media.php';
require BCORE_PARENT_CONFIG_DIRECTORY . '/functions/titles.php';

/** Admin */
if ( is_admin() ) {
	require BCORE_PARENT_CONFIG_DIRECTORY . '/core/theme-check.php';
}