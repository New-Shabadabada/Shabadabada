<?php
// ====================================
// Initialisation en fonction de l'environnement
// ====================================
// require __DIR__ . '/define-environment.php';

require(__DIR__ . '/configuration-current.php');

/* That\'s all, stop editing! Happy publishing. */
define('WP_CONTENT_URL', WP_HOME . '/wp-content');
define('WP_CONTENT_DIR', __DIR__ . '/wp-content');

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';