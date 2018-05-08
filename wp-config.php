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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '`a1l4MUK;duq?m#iS9xK|T9^-suJ|7XN7dcAlNG&d3-x,~IhM?v|sL&_&5^7BQYH');
define('SECURE_AUTH_KEY',  'bkewssI]V(^ddZe,Xd,u!7PKZJ<6I.8l!K{`Xfab6#6Oa8Or3heV<t3Ik^aovZx1');
define('LOGGED_IN_KEY',    '3>4H5C; uesXi88:DyxK Ps6bC>qs`!/4W0->XS*4I4DR*&A<}@HE]Nb-qvLKLUl');
define('NONCE_KEY',        '*!m*T42ENDC8-G1}bxDv9_uMCbO*TH?Ynr:2&+xZK*O}FZ0(D`I8ePXX$(W0`v}~');
define('AUTH_SALT',        's=kt1) I8P9QN)U?[o5XSH9p{v4B*si-|eyZa]} sz[& |h{IM$eZ/UsywaP;gL[');
define('SECURE_AUTH_SALT', 'z5#HO]s_M0[brhGT@bZum69Zr..YbGA&d;=y>c2>I]If7%C%YO.<#UNj8!f-:r5g');
define('LOGGED_IN_SALT',   't)=]+c6G;.j=5$**.+aLrY{R4L[IlYr@L$y`IRAix)Hi,E]0tQkCtL~6)!!`9HKL');
define('NONCE_SALT',       'a~vlERU244 +zMOf6<~cgwA`@at }h|V0hm.Rp.9BSf*JTsrf/AGlOWcO JEw{(w');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
