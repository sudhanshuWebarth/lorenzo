<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'seoscor_lorenzo');

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
define('AUTH_KEY',         'jTTq|8ikBpLj|%odFLxU/i~34:.vA:h1s^gj+T?*z&ih=:du2)QF[FkniCs+x-@V');
define('SECURE_AUTH_KEY',  '&L9a& AhP:MS-@>Y*FCFodg/oHrD ?u>Uz1H@rYbC|}F-mQe|a^93{HQCpGcRu7k');
define('LOGGED_IN_KEY',    '=%B48,[[d6p oNNjcT_[xz(]p5q>6}Gd+yvyR~0%d-9/@a:D_0|9TJo0*v+-W|^a');
define('NONCE_KEY',        '|y}:i>94aztwfjE@%-h8<28dn+_:VJlZ+]`M`_7tK`j9Fh;&u,Lo+VL1e^@b+=eO');
define('AUTH_SALT',        'IJPG8K:m}c8qQ#CQ|:uK|(]7JZL=eKYN+kBbNH6|ns&O[)-,cac+QyYWr,|Y-h|/');
define('SECURE_AUTH_SALT', 'Za+G=W!oMx>@Uow{dS:h1ejyif^Bg}0= v=^6O[K=u=?7pc!HSH^E$*Xc|U6lwi*');
define('LOGGED_IN_SALT',   ']?nL~Us:,QQ4_xb+N6IY|5n`;71tg/)Agt _;$9gP$aL#.W!Irq,q>oAwzUm0!B<');
define('NONCE_SALT',       'ZwIjqrE]?Zzu>*.Bn$<lg.x}Z:04+TkUVe?`T, GVyq-[iJm3z4*6Zn?;uJ@q; u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
