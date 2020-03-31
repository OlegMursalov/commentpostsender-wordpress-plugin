<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/OlegMursalov/
 * @since      1.0.0
 *
 * @package    Commentpostsender
 * @subpackage Commentpostsender/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Commentpostsender
 * @subpackage Commentpostsender/includes
 * @author     Oleg Mursalov <olegmursalovistrue@gmail.com>
 */
class Commentpostsender_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'commentpostsender',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
