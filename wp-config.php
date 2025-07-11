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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'grow' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~@?bL6gIuFM)W8GaAoM+Rk<ndy}7hOLC!OM^!q@)(mnFA+9M8i~gv$PO&(z$X1>x' );
define( 'SECURE_AUTH_KEY',  'l>b}mHfbB+#2xA5M3b@ R:T/I.`~PSNjfu-;y%|Rn*ZYviQ_Q?* X,TSIoL{T+ua' );
define( 'LOGGED_IN_KEY',    'lrRC{_f>-U,aL>%(`Z#GT4hQ5p}]q9f1FlrhvJY*IR?+r_I0=ku^pigrkhtqw#OS' );
define( 'NONCE_KEY',        '%C3{T<.OKzzP!rR#AoZ{Z8h8n_1 `y^2`SWZGGjjnc.pgv6o(Nrz+W &fF$<h0)%' );
define( 'AUTH_SALT',        'pu(8$R]n)GU*oW#:TlV`2PFC{9H;Nv-LP5JSI,6#J!vBT^TFC==/Ap~IP{m}lfl%' );
define( 'SECURE_AUTH_SALT', 'ATswW,|6!TSd1o2:+`b1aedq8x]G?}5{u@asP!^V:Gmv#=gP{@eP$g6V@![qd7 R' );
define( 'LOGGED_IN_SALT',   'b5<w#:pE!DijusU nmt[-~WJa-0|sYw75XJwCgx6A<E;|PY#{WqM*wlsUaPSL9@o' );
define( 'NONCE_SALT',       '6G=]LgPp$%P$7yL>%Hyd uY3sABq5KL=9^P_ng~ 01Ap,z.L3vYtLJ;u# 0_8>J$' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/grow/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
