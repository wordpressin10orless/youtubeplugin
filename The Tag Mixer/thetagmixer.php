<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wordpressin10orless.com
 * @since             1.0.0
 * @package           TheTagMixer
 *
 * @wordpress-plugin
 * Plugin Name:       The Tag Mixer
 * Plugin URI:        http://wordpressin10orless.com
 * Description:       The tag mixer is a plugin that allowes you to change html elements real time based on query strings.
 * Version:           1.0.0
 * Author:            WPIn10OrLess - Josh
 * Author URI:        http://wordpressin10orless.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       http://wordpressin10orless.com
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
define( 'THETAGMIXER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-thetagmixer-activator.php
 */
function activate_thetagmixer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-thetagmixer-activator.php';
	TheTagMixer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-thetagmixer-deactivator.php
 */
function deactivate_thetagmixer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-thetagmixer-deactivator.php';
	TheTagMixer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_thetagmixer' );
register_deactivation_hook( __FILE__, 'deactivate_thetagmixer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-thetagmixer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_thetagmixer() {

	$plugin = new TheTagMixer();
	$plugin->run();

}
run_thetagmixer();
        