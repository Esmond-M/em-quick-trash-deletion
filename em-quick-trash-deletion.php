<?php

/**
 *
 * @link              https://esmondmccain.com/
 * @since             1.0.0
 * @package           Em_Quick_Trash_Deletion
 *
 * @wordpress-plugin
 * Plugin Name:       Quick trash deletion
 * Plugin URI:        https://esmondmccain.com/
 * Description:       This plugin adds an 'empty trash' button to the trash page. A permanent delete button link will also be added in the view all posts edit screen. These features allows you to empty the trash list without loading the entire list of posts.
 * Version:           1.0.0
 * Author:            Esmond Mccain
 * Author URI:        https://esmondmccain.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       em-quick-trash-deletion
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
define( 'EM_QUICK_TRASH_DELETION_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-em-quick-trash-deletion.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_em_quick_trash_deletion() {

	$plugin = new Em_Quick_Trash_Deletion();
	$plugin->run();

}
run_em_quick_trash_deletion();
