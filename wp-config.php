<?php

use Symfony\Component\Dotenv\Dotenv;


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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// Included the .env file
if (file_exists(__DIR__.'/.env')) {
  require_once(__DIR__ . '/vendor/autoload.php');
  // @TODO https://github.com/symfony/symfony/issues/35388
  (new Dotenv())->usePutenv(true)->bootEnv(__DIR__.'/.env');
}

if (getenv('WP_CACHING') == 'true') {
  define('WP_CACHE', TRUE);
}
else {
  define('WP_CACHE', FALSE);
}
define( 'WP_CACHE_KEY_SALT', getenv('WP_CACHE_SALT') );


// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME',  getenv('WP_DATABASE'));

/** Database username */
define( 'DB_USER', getenv('DATABASE_USER'));

/** Database password */
define( 'DB_PASSWORD', getenv('DATABASE_PASSWORD'));

/** Database hostname */
define( 'DB_HOST', getenv('DATABASE_HOST'));

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv('AUTH_KEY') );
define( 'SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY') );
define( 'LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY') );
define( 'NONCE_KEY',        getenv('NONCE_KEY') );
define( 'AUTH_SALT',        getenv('AUTH_SALT') );
define( 'SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT') );
define( 'LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT') );
define( 'NONCE_SALT',       getenv('NONCE_SALT') );
/**#@-*/

/**
 * WordPress database table prefix.
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', getenv('WP_DEBUG'));
define( 'WP_DEBUG_LOG', getenv('WP_DEBUG_LOG'));

define('WP_CONTENT_DIR', dirname(__FILE__) . '/web/wp-content');
define('WP_CONTENT_URL', 'https://' . $_SERVER['HTTP_HOST'] . '/wp-content');

// Define contrib plugins directory
define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins/contrib');
define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins/contrib');

// Defind the default theme and contrib theme directory
define('WP_DEFAULT_THEME', 'twentytwentyfour' );

// WordPress URLs
define('WP_HOME', getenv('WP_HOME'));
define('WP_SITEURL', getenv('SITE_URI'));

/********** Settings by Skvare *************/
define('WP_AUTO_UPDATE_CORE', getenv('WP_AUTO_UPDATE_CORE'));
define('AUTOMATIC_UPDATER_DISABLED', getenv('AUTOMATIC_UPDATER_DISABLED'));
define('WP_ENVIRONMENT_TYPE', getenv('WP_ENVIRONMENT_TYPE'));
define('DISALLOW_FILE_EDIT', getenv('DISALLOW_FILE_EDIT'));
define('DISALLOW_FILE_MODS', getenv('DISALLOW_FILE_MODS'));

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
