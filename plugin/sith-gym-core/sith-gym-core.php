<?php
/**
 * Plugin Name: Sith Gym Core
 * Plugin URI:  https://github.com/keithgoode/Sith-Gym
 * Description: Core functionality plugin for the Sith Gym website. Houses all non-presentational features.
 * Version:     0.1.0
 * Author:      Keith Goode
 * Author URI:  https://github.com/keithgoode
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sith-gym-core
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin version constant.
 *
 * Centralised here so other files can reference it without parsing the header.
 */
define( 'SITH_GYM_CORE_VERSION', '0.1.0' );

/**
 * Absolute path to the plugin directory (with trailing slash).
 */
define( 'SITH_GYM_CORE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Public URL to the plugin directory (with trailing slash).
 */
define( 'SITH_GYM_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load plugin files.
 *
 * Each future module will be required here as a single line, e.g.:
 *   require_once SITH_GYM_CORE_DIR . 'includes/internal-links.php';
 *
 * No modules exist yet — this function is the wiring point for future work.
 */
function sith_gym_core_init() {
	// Future module files will be required here.
}
add_action( 'plugins_loaded', 'sith_gym_core_init' );
