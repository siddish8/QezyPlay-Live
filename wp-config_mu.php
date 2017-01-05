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
define('DB_NAME', 'qezyplay_wordpress');

/** MySQL database username */
define('DB_USER', 'qezyplay_word');

/** MySQL database password */
define('DB_PASSWORD', '&(word_qezyplay)&');

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
define('AUTH_KEY',         'MvvtX~:6mgH^>_%s>?seuBwlJ Ep!}4;nfi/GYis~.Svs+XxZgJMqut:o8xoQZje');
define('SECURE_AUTH_KEY',  '/]N2tR^OB^tIl/zqY#X;CbV+@Az-fR^nuO_|z3B,NZz5@r>hh?|4IK/:{. K|kG9');
define('LOGGED_IN_KEY',    'sH8eHpHwcn;5;=V^BJ0:_8wD%U4y7:4WzlfLVS^5,0]B5IxI2}iaJ-b7ag2sH,IF');
define('NONCE_KEY',        '@&(P+)zaIF1wKdb9_jyEJGB/6qYZ|7R=}=K(J}G,Y;]JsinK}#cnqt{)ASUjfT9t');
define('AUTH_SALT',        'Bt)Y)|I@h|P+PTomk20|iUPf&>q{|]m7,<s`^`9.YV^gUj):#-Vu~w4^EVV4hmEY');
define('SECURE_AUTH_SALT', '+Qy`&Q@ECx`ik+?)%wuA|pz;h(B$t-c6H@C5}fk&-Dsx~ML<!R`?GVE$&Z?&eNg=');
define('LOGGED_IN_SALT',   'B~3S!j2@z#8rB)7_Rzr3_|;$8_za+7^x<|RdarRNj&brzVJ>R+}?wh)`/TvNFX~^');
define('NONCE_SALT',       '$jwje-/4u|T>Sq4GK%f-xU;C2e$vZp1sqA|Ib]X`o*R.6J_0$_w*dE.voQn:B`&>');

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

//define('WP_HOME','https://qezyplay.com');
//define('WP_SITEURL','https://qezyplay.com');
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'qezyplay.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define( 'NOBLOGREDIRECT', 'https://qezyplay.com' );




/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
