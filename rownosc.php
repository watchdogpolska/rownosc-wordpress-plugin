<?php
/**
 * Plugin Name: Rownosc.Info
 * Plugin URI:
 * Description: .
 * Version: 0.0.1
 * Author: Kamil Bregula
 * Author URI: https://siecobywatelska.pl/
 * License: GPLv3 or Later
 *
 */

use Rownosc\Rownosc;

define( 'R_VERSION', '0.0.1');
define( 'R_PLUGIN_FILE', __FILE__ );
define( 'R_PLUGIN_PATH', dirname(__FILE__) . '/');
define( 'R_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'R_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );


include dirname(__FILE__) .'/autoload.php';
include dirname(__FILE__) .'/functions.php';
include dirname(__FILE__) .'/includes/core-functions.php';
include dirname(__FILE__) .'/template-functions.php';
include dirname(__FILE__) .'/template-hooks.php';




/**
 * Main instance of Rownosc.
 *
 * Returns the main instance of Rownosc to prevent the need to use globals.
 *
 * @since  2.1
 * @return Rownosc
 */
function R() {
    return Rownosc::instance();
}
// Init
R();