<?php
define('WP_USE_THEMES', false);
require('wp-load.php');

if ( ! defined( 'WP_CLI' ) || ( defined( 'WP_CLI' ) && ! WP_CLI ) ) {
    define('WP_CLI', true);
}

echo "WP-CLI fonctionne correctement.";