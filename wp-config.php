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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'microwww_ehelper' );

/** Database username */
define( 'DB_USER', 'microwww_ehelper' );

/** Database password */
define( 'DB_PASSWORD', 'pJrM1oA-j_FI-W^5' );

/** Database hostname */
define( 'DB_HOST', 's83.hekko.pl' );

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
define( 'AUTH_KEY',         '(w2L3(5CR|M:=cnx1M}3X/}$^9k%cN$dmzwFHkgX4&4r{+a(PQ%K@{IiNhqSJ4;~' );
define( 'SECURE_AUTH_KEY',  'goZVD*%*mRDh5x4?st8BeJ21mq6.)gqwghS+%Lit2:%s.Q6w@07|JO(Jb- [s]6A' );
define( 'LOGGED_IN_KEY',    'n~#U]FAz6EvmOlGH#=UZE<rW.y$ODK0+D}~B;2soPbW]c]i.Xt[u&:q1%dp vpFw' );
define( 'NONCE_KEY',        '-w48@z<n|TY*Mu$|*q$}6`Z@5Wv!AUk7PMty`F f20>G:Q<U(B6C55;Vq9S6do#t' );
define( 'AUTH_SALT',        'd^;_._7#%/Y/Pe~1V[z2k8L&+`99.~Vjj{@K,kvsKu.`AA=O:L2sr!,BO0i4oS)j' );
define( 'SECURE_AUTH_SALT', 'kkaO_C })9q%Zqc;W<i2h32G7Q&=jzA;c:~Ki|hhaId@vJ;s-F)fumI{DzD<p[8l' );
define( 'LOGGED_IN_SALT',   'X1;pD3!qw#ALeThH 7P rJ}dV5,|cX**Yr;NKUP-dl+&hnsD-fR[jLopkZG2C:SO' );
define( 'NONCE_SALT',       '6r-nbH.:hRZ:o:9^tX=mw2zH+KE,Ws_ MRg48U/BvXGn..fZWc]i(!qTKt*?<rqb' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
