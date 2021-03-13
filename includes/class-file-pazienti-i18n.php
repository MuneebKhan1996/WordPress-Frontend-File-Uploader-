<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.fiverr.com/ranamkhan
 * @since      1.0.0
 *
 * @package    File_Pazienti
 * @subpackage File_Pazienti/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    File_Pazienti
 * @subpackage File_Pazienti/includes
 * @author     Muneeb Khan <rmkhan1996@hotmail.com>
 */
class File_Pazienti_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'file-pazienti',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
