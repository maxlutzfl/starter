<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'brandco_starter2016');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ':;bMqBrzZ,&RH{Eo6?d/ 4<g-9Xx>-Ko$>Vj3EVuXJ/(IrJRmX=M6VY8atM42Q*L');
define('SECURE_AUTH_KEY',  'l?Dj%^9~a-B)7A,7L_]$t`Z+VXVD`)=XKP%X!2iCW$T{]qPt,JYpE{+Y+U?~!v&%');
define('LOGGED_IN_KEY',    'dxA4F,.W^MhK(;,V)Y1|<s8xK RSxs~{^4xM{X4{+|_zP=N%&F96fhP@Xd4u~;w+');
define('NONCE_KEY',        'w-44{#rcPI}k^b-^!sH@l5q[pH7ikg,UG NCB@evZ$NW6BKIMU}aY5mQv1?,.lP4');
define('AUTH_SALT',        'P KbOn|cW_txw<&=+r+fR123<%/#f=x%o9Nv+j/F>KyKbmtAy:6c+nSde )n`jQ*');
define('SECURE_AUTH_SALT', '6AL9{^7;kI+>l} ,Jut +,~D.a,XM;04M7,Do[_algg|^1[_lB)06^;uzUyXJ|w_');
define('LOGGED_IN_SALT',   'fu|fr=OKzvLz?LaKA[e_JTz&D<@#i0@LH%E[L;/0yN63hk]Vpe$F%y})4XjMs{z<');
define('NONCE_SALT',       'j[.v(9Yps?6UZ1;G.e@~5)BH*6+(x+qaWtKWnva3r1^4bQZHL.f1V=6L?g-#v2^Y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'brandco_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
