<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://esmondmccain.com/
 * @since      1.0.0
 *
 * @package    Em_Quick_Trash_Deletion
 * @subpackage Em_Quick_Trash_Deletion/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Em_Quick_Trash_Deletion
 * @subpackage Em_Quick_Trash_Deletion/includes
 * @author     Esmond Mccain <esmondmccain@gmail.com>
 */
class Em_Quick_Trash_Deletion_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'em-quick-trash-deletion',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
