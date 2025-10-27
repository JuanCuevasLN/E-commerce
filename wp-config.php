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
define( 'AUTH_KEY',         'UI*BID9h d>Z;C4+|O*u0: knUeo)Z9wg7X&Fx?!XsJL#Zx`mw#o~T2E0h.D2ndw' );
define( 'SECURE_AUTH_KEY',  '3I{)fJ&,x5yW!_tch>]R]jY:$iXGn#B]Nl%)EQ1WY73$+[50tEK twEx/YJ,$F6X' );
define( 'LOGGED_IN_KEY',    '~$yys9_=t+s=<5fhY#GL*m,qi^H@>=g6/s6XunNcA:??Yo}?NA6^??F-Zpq-PuK-' );
define( 'NONCE_KEY',        'x#[OGsp+@#xNrn5ygu]|Rw3KT#},]C }n]8h*Ogon&V9~2&vi!Y1jE%qgHlqXEB@' );
define( 'AUTH_SALT',        'VhMF)2JY]iNITRx:{,kpP%$E(LBrHISt;50Ax=_=)a<7!gwId)y3Zw;W>qVzW3&A' );
define( 'SECURE_AUTH_SALT', 'MjGh_i@$I_N#<riC>|NJjQXARkni~w;KI|km<A?~F+r4BK!%JJJb97kgL#H_c(lY' );
define( 'LOGGED_IN_SALT',   '_h-ECsEdGGSNJ[+,EyY,F_1~}ZVL5bCeh=^4??cvw15G9x.9o  cVou`<8wC{JDj' );
define( 'NONCE_SALT',       '349-en//lt&dyg{WsIhj,a_<B464`71L3;F}m+cWB2S^5ya!U48v}/6>?Hu{OT}5' );

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

/*  Multisite */
define( 'WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
