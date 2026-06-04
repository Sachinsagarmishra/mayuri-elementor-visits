<?php
/**
 * Plugin Name: Mayuri Elementor Visits
 * Description: Adds unique, editable Elementor visit widgets for Mayuri sections.
 * Version: 1.0.6
 * Author: Mayuri
 * Text Domain: mayuri-elementor-visits
 * Requires PHP: 7.4
 * Elementor tested up to: 3.29
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Trigger deploy retry after FTP lockout cool-down.

define( 'MEV_VERSION', '1.0.6' );
define( 'MEV_FILE', __FILE__ );
define( 'MEV_PATH', plugin_dir_path( __FILE__ ) );
define( 'MEV_URL', plugin_dir_url( __FILE__ ) );

require_once MEV_PATH . 'includes/Plugin.php';

MayuriElementorVisits\Plugin::instance();
