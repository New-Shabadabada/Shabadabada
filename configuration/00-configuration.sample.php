<?php

// IMPORTANT utilisation des thèmes avec wp
define( 'WP_USE_THEMES', true );

// IMPORTANT avec cette constante wp est capable de gérer "des trucs"
// "staging" ==  "préprpd"
define('WP_ENVIRONMENT_TYPE', 'staging');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'DB_NAME' );

/** MySQL database username */
define( 'DB_USER', 'CHANGE_ME' );

/** MySQL database password */
define( 'DB_PASSWORD', 'CHANGE_ME' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

// IMPORTANT  configuration de jwt_auth
define('JWT_AUTH_SECRET_KEY', 'CHANGE_ME');
define('JWT_AUTH_CORS_ENABLE', true);
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'CHANGE_ME' );
define( 'SECURE_AUTH_KEY',  'CHANGE_ME' );
define( 'LOGGED_IN_KEY',    'CHANGE_ME' );
define( 'NONCE_KEY',        'CHANGE_ME' );
define( 'AUTH_SALT',        'CHANGE_ME' );
define( 'SECURE_AUTH_SALT', 'CHANGE_ME' );
define( 'LOGGED_IN_SALT',   'CHANGE_ME' );
define( 'NONCE_SALT',       'CHANGE_ME' );

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

define('WP_HOME', rtrim ( 'http://localhost/public', '/' ));
define('WP_SITEURL', WP_HOME . '/wp');

// on peut installer des plugins/theme directement depuis le bo
define('FS_METHOD','direct');