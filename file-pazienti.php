<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.fiverr.com/ranamkhan
 * @since             1.0.0
 * @package           File_Pazienti
 *
 * @wordpress-plugin
 * Plugin Name:       File Pazienti
 * Plugin URI:        www.fiverr.com/ranamkhan
 * Description:       Questo plugin serve a fare l'upload di documenti e pdf dal web e gestirli dal backend.
 * Version:           1.0.0
 * Author:            Muneeb Khan
 * Author URI:        www.fiverr.com/ranamkhan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       file-pazienti
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FILE_PAZIENTI_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-file-pazienti-activator.php
 */
function activate_file_pazienti() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-file-pazienti-activator.php';
	File_Pazienti_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-file-pazienti-deactivator.php
 */
function deactivate_file_pazienti() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-file-pazienti-deactivator.php';
	File_Pazienti_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_file_pazienti' );
register_deactivation_hook( __FILE__, 'deactivate_file_pazienti' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-file-pazienti.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_file_pazienti() {

	$plugin = new File_Pazienti();
	$plugin->run();

}
run_file_pazienti();
