<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sahilsk.github.io
 * @since             1.0.0
 * @package           Instagram_Feed_Sk
 *
 * @wordpress-plugin
 * Plugin Name:       Instagram feed sk
 * Plugin URI:        http://github.com/sahilsk/instagram-feed-sk-wp
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Sonu K. Meena
 * Author URI:        https://sahilsk.github.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       instagram-feed-sk
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-instagram-feed-sk-activator.php
 */
function activate_instagram_feed_sk() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-instagram-feed-sk-activator.php';
	Instagram_Feed_Sk_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-instagram-feed-sk-deactivator.php
 */
function deactivate_instagram_feed_sk() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-instagram-feed-sk-deactivator.php';
	Instagram_Feed_Sk_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_instagram_feed_sk' );
register_deactivation_hook( __FILE__, 'deactivate_instagram_feed_sk' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-instagram-feed-sk.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_instagram_feed_sk() {

	$plugin = new Instagram_Feed_Sk();
	$plugin->run();

}
run_instagram_feed_sk();
