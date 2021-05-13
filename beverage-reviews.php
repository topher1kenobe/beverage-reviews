<?php
/**
Plugin Name: Beverage Reviews
Description: Allows you to enter beverages and rate them
Version: 2.0
Author: Topher
Author URI: http://topher1kenobe.com
Text Domain: beverage-reviews
Domain Path: /languages/
License: GPLv3+
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

@package beverage-reviews
 */

/**
 * Require requirement plugin
 *
 * @since Beverage_CPT 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/class-tgm-plugin-activation.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/class-tgm-plugin-activation.php';
	add_action( 'tgmpa_register', 'Beverage_Table_Shortcode::register_required_plugins' );
}

/**
 * Require Extended Custom Post Types
 *
 * @since Beverage_CPT 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendors/extended-cpts/extended-cpts.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'vendors/extended-cpts/extended-cpts.php';
}

/**
 * Require cmb2
 *
 * @since Beverage_CPT 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendors/cmb2/init.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'vendors/cmb2/init.php';
}

/**
 * Require star rating function for cmb2
 *
 * @since Beverage_CPT 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendors/star-rating-field-type/star-rating-field-type.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'vendors/star-rating-field-type/star-rating-field-type.php';
}

/**
 * Prepare for internationalization
 *
 * @since Beverage_CPT
 */
function br_load_text_domain() {
	load_plugin_textdomain( 'beverage-reviews', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'br_load_text_domain' );

/**
 * Instantiate instance of Beverage CPT
 *
 * @since Beverage_CPT 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/class-beverage-cpt.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/class-beverage-cpt.php';
	add_action( 'init', array( 'Beverage_CPT', 'instance' ) );
}

/**
 * Instantiate instance of Beverage Meta Boxes
 *
 * @since Beverage_Meta 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/class-beverage-meta.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/class-beverage-meta.php';
	add_action( 'init', array( 'Beverage_Meta', 'instance' ) );
}

/**
 * Instantiate instance of Beverage Table Shortcode
 *
 * @since Beverage_Meta 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/class-beverage-table-shortcode.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/class-beverage-table-shortcode.php';
	add_action( 'init', array( 'Beverage_Table_Shortcode', 'instance' ) );
}
