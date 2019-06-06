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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'KnFC37TojvvR2d/h9In3Zu5zsVX00eROM9ChjeJ3mGWaAfdziLsZOHYJB/8U2pN0wYrQP0iCEE1iRbGLB8eqhQ==');
define('SECURE_AUTH_KEY',  'GmhyzYgr8njfV02ZqgxA7VsNNABkbCU3Q42obhM9Vw5kcy9v9a8TQpEoDyhl5fKE4z6toUloOf1sESR9diKnoQ==');
define('LOGGED_IN_KEY',    '45lskXzOP5UjKxj27sUNz8vqSZFzpfuSNWx8qVV1yaRfypENl/tP4pOvP9N9UYBAQGjUYwhkWObGSH2Hgz5PDQ==');
define('NONCE_KEY',        '4PAyn0P2bblpJrxzMxK6gMfKwtSjnl4t1MlOBYuTAGbS4Lh7Rj4KpnAm5gRysl+3gsw9oIT4tN2ShphrtlUS4Q==');
define('AUTH_SALT',        'hHcYZbqOWL2N/mCnSWWLOgHzZZ4JqINt0UWKoGUObvdH8nUtP3IuRRI6Y20zDQrnNAdpdQQhwJ/bHEZ0FozlsA==');
define('SECURE_AUTH_SALT', 'aDQr11K2UmFPGySbkpRkXVGhodETqoRmRtnX83NlutUlKcUgQYWlVsG71MVvPENoXHdHuLnhrjDEfDBL6xpm8Q==');
define('LOGGED_IN_SALT',   '4Bs0FGoGfDrXgO1W9LF0G3NSCVxU84iHudpwymUifADMeCSNU183gPYsYucAeX1X3M6Haf5kHy7jxz/7ZQOWGg==');
define('NONCE_SALT',       'R6euHmi14vANwjwvFrMJ2mwpJ9QUCielShgXcnP2ZhsiV9Eum6QVU18Xi4MWrfXXws6MTv1Sqlk1w6oZPJmC9A==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
