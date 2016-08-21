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
define('DB_NAME', 'tobe.vn');

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
define('AUTH_KEY',         '#Li_6_HPxB72r6S(7aKS1R)DEQPnoX =W3R0v&tpH0+MaC4uZ_zA_y%LA@2hCk~K');
define('SECURE_AUTH_KEY',  '$-_^d7ocJM%FU0Ba{D5Y4a(x8m 1@19w*:>7IYAeG$`gB>i<%_a$9{G2/S.:bJa[');
define('LOGGED_IN_KEY',    '.&:$4KgOw:~tc/@=f#=<wDANm<&ha].*%o0n8+T-Xy:Uk}f^8iK25;sa|~sf!h><');
define('NONCE_KEY',        '}0o%jHF{|W9x2.N(u<r)k}:S*Qt{Whp(]Qm-%x`v CP@o)%qC7),#ARV].DtX/c=');
define('AUTH_SALT',        'T&+ZplbU,9WmJ?%e_N~dXy*ZU}cvs(p(RX,J4kmuMIK=bZ9+MR dsD]M_ B&c*47');
define('SECURE_AUTH_SALT', 'UL-9.])Wu7h<U8@8m}$bGHD?`SO39i!8pw%Wm3=-&B^hi{u1|AGgD`QJ|m30J*mS');
define('LOGGED_IN_SALT',   'N|:i(:ipiLFF1^ey%:ym|Cc&Ot)g9M{;m<I55$n+01NzqT<=B-A]Nm iq4k.U|i!');
define('NONCE_SALT',       'J{cib=7tm(2QHx3mnn><w[L1#7f1|9j4u0r/LcK+*0Xxsb~!)G5R;.t@oFR96M?v');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'atb_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
