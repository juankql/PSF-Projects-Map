<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           psf_map_manager
 *
 * @wordpress-plugin
 * Plugin Name:       PSF Map manager
 * Plugin URI:        https://pixelwilderness.com/
 * Description:       This plugin allows the registration of new points in a map and the visualization of it in the frontend.
 * Version:           1.0.0
 * Author:            PixelWilderness (Juan Carlos Quevedo Lussón)
 * Author URI:        https://pixelwilderness.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pwpsf-map-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'pwpsf_map_manager_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pwpsf-map-manager-activator.php
 */
function activate_pwpsf_map_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pwpsf-map-manager-activator.php';
	pwpsf_map_manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pwpsf-map-manager-deactivator.php
 */
function deactivate_pwpsf_map_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pwpsf-map-manager-deactivator.php';
	pwpsf_map_manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pwpsf_map_manager' );
register_deactivation_hook( __FILE__, 'deactivate_pwpsf_map_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pwpsf-map-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pwpsf_map_manager() {

	$plugin = new pwpsf_map_manager();
	$plugin->run();

}
run_pwpsf_map_manager();
