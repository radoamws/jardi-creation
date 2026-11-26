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
define( 'DB_NAME', 'jardi-creation' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '5*tgMT9u(#>NmR|NiL]d*CSn;#ZgN7Occwwk2|J`a d2Z,,OlP_L_:R@%;=0:M%#' );
define( 'SECURE_AUTH_KEY',  '%l8|!rc&7Z8(<f[6@7<sjSacW|<K2:2+>T&Eh!UgQlgokGT>yIlbpyj6xUgj63JO' );
define( 'LOGGED_IN_KEY',    'HOOP>_WOCTIFb>yz,Vckb`ng%-CC/~4` s^:kp8>xVSQTGO!Y@yFGAF>+m!F{4)m' );
define( 'NONCE_KEY',        '{+:|=Q:.7B*5k1D|:=Y;utiX+w()n|~j=,QNZE{g)DwN2a$HiD8@Lb/oTqIN^3Z3' );
define( 'AUTH_SALT',        'flRVVciB5ZHa!DR]yVUX/9&B/NFKiKv6&J+Ng0IW~Rc{aD@xi$0>>2pBuO|mWhzu' );
define( 'SECURE_AUTH_SALT', 'dI*#$H^CS<u9?v]YvjY3G|.DYhwHMe,SO*t}aFhf>RU1NjXEdkYfJL|)pKW^Gnd6' );
define( 'LOGGED_IN_SALT',   '*Fp^CW;{ =1`VWCBx1],:[zM187ZtfP8!wL;CCdeMtV;xL1<P:rDS ;LyX)<Yp0%' );
define( 'NONCE_SALT',       'O{<1i~4t2L.+UaAlSS=v7`?[<qR!+DqVf}^90Jz1niVYak/twkikyv*$qqC/D/j3' );

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
if ( file_exists( __DIR__ . '/wp-config-local.php' ) ) {
	require __DIR__ . '/wp-config-local.php';
}
defined( 'WP_DEBUG' ) || define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
