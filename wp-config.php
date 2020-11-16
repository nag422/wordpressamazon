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
define( 'DB_NAME', 'amazon' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'YHRfVBI2K0hBTvFS2u6tbffTHwcDss1nbYFcWLXf2yYsTnLcOBjSslzZtix8SayK' );
define( 'SECURE_AUTH_KEY',  'ZZrKuPAq1aHZNxvGxAjsj2heJJ6Ovo9BtaMhR81qu0Y9TeZcPHP6wYM2AjuQFYKn' );
define( 'LOGGED_IN_KEY',    'ubc4g59gl3rgAPnSoL9aWWi3WCH9QRWvJ9qB4uNzUG98P5kbVlke6qh2xYU8Numk' );
define( 'NONCE_KEY',        '5RZzeecIRRljHNXWBaCZ2u5pDVEcxXKAfxGsrH04lhQNZdivOxLMnYR7dWbMYb0a' );
define( 'AUTH_SALT',        'QwQwBikrHCCVq5WLw2p2YgoUl3hKXgx1eRapcxFhN2GUFWvykP6c9GyinvbahcfL' );
define( 'SECURE_AUTH_SALT', 'MkoOXAGdNFRw2q6HGTYTFpEGSQPbDzG5hCFWV597gy9Squ7cxmEYsdHgLdhw2Qhw' );
define( 'LOGGED_IN_SALT',   'RiEsj7f3a147sToK7NjD6VQKfkgvAUaKoNb5DjAwJSbHhS6sr0t9lziZn7sOb7ep' );
define( 'NONCE_SALT',       'a4iBsaIlUV1RhTlaGywXxzaNNLaTIEjvon9N78oNeHSw3BcxUSPDCrHdH1ZE0pUG' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
