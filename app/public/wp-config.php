<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '18DnGN#]>ZtYO*7[vVZS;U2upg~kfPb*H8V77g5J6!<FIJ81MdN<S?Sd~L#:+|Gu' );
define( 'SECURE_AUTH_KEY',   '6HHe`l~(WDt@ojxA$q PN<+)OS9~A+`Ppk2J$n+oX4-9wQFeyI>aJ}D+CXE2,UmT' );
define( 'LOGGED_IN_KEY',     'o[=*0nkAWv#rn>^0>.CUvchb)/Yz1wm&+ gySGWhQ i5M-J_.12NvHiL7P7-QyHu' );
define( 'NONCE_KEY',         '8O=VgoLO/ex?k u=)@n0Wi/zg4_][F8:^}7o>@E_?ndL*+E`)RkFY-Yt5~3BKtmR' );
define( 'AUTH_SALT',         'X,zo<-U>iRdDGxgq5WdSAF|Q729pm-,kf[ xWy0]A]yJ=thBH2i3#d,WF0hJF9a7' );
define( 'SECURE_AUTH_SALT',  'IC4W:GcBx2NAG]+Pn&pvwXwH,A[kw.7qbKw;U cV/=7s|+5F?lJSO<>[`d88gHq!' );
define( 'LOGGED_IN_SALT',    'x/pTM{T_LYAw+oT+h,94{%%}5]}O%Jj;z#.tR3{*u7~@j7tEn`jy_.y!=a&B:TN{' );
define( 'NONCE_SALT',        'czjDO~J}<Hho! yg+7yJ6O<+EEu+&J-IV**t.RMcAkNh>+vjIV*m91{:{>2HYuGI' );
define( 'WP_CACHE_KEY_SALT', 'iu[4@2W]/Y/S?u6Yi(Jq,GxQqn-hKymcd%Na/ekL8yv!-7:OsrVFHno&*i|9SC`-' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
