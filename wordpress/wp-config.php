<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'cA+B<fO&_s JtbHX)%3&Ej]`MN5}kGu}o*gM&h&ua~z&RI8N&9_z8a|W@L#~cj)k' );
define( 'SECURE_AUTH_KEY',  '`kW3D6Z5W~8[9wqAFHcyd21mNAVp(gL==?t~VQ?)a,mI1<j;/RDDGjB<|35a.8i7' );
define( 'LOGGED_IN_KEY',    '&Pj2IXGOj6Rs%pdXWI+>Z,{Au[P.r<j%}9Z[nE~8-OVBszS!.d):C-s7/<LtBW]L' );
define( 'NONCE_KEY',        ',@dqGuz9OITZkqicg$xPAd(2SBmzd0uZ!/uvvs8Zs*MVM|(%>D$kZKJiZf]rjnwW' );
define( 'AUTH_SALT',        'tr1kMErFXd)afv5f MEHym yH`zXW&UT)H8X%GeL!?Zc`btCwc|ESZknS?e(/H&]' );
define( 'SECURE_AUTH_SALT', '7e$RAWd,:T[k>^OPoV53Mh{MFoDYtjeLm{Dif1QP*~5:A0IHh*y4zG6vAVwkW:U3' );
define( 'LOGGED_IN_SALT',   '~b^Os9u-&?v/da_TGH:};mWldE]X=>PZteDihGv&EO7O>ww!bZ#la=:b,9{FYiH[' );
define( 'NONCE_SALT',       'jdd_bpa[>lx[|_kIf7.>`*Q9P0 W!>&|r&Ae?!xLiH+RyRdQu@f,kd1Phc*cbJ`L' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
