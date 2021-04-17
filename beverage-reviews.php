<?php
/*
Plugin Name: Beverage Reviews
Description: Allows you to enter beverages and rate them
Version: 1.0
Author: Topher
Author URI: http://topher1kenobe.com
Text Domain: beverage-reviews
Domain Path: /languages/
License: GPLv3+
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
*/

/**
 * Require Extended Custom Post Types
 *
 * @since My_Affiliate_List_Tax 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'vendors/extended-cpts/extended-cpts.php' ) ) {
    include_once plugin_dir_path( __FILE__ ) . 'vendors/extended-cpts/extended-cpts.php';
}

/**
 * Require metabox.io
 *
 * @since My_Affiliate_List_Tax 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/class-tgm-plugin-activation.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/class-tgm-plugin-activation.php';
	add_action( 'tgmpa_register', 'Beverage_Meta::register_required_plugins' );
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
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/cpt.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/cpt.php';
	add_action( 'init', array( 'Beverage_CPT', 'instance' ) );
}

/**
 * Instantiate instance of My Affiliate Meta Boxes
 *
 * @since Beverage_Meta 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/meta.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/meta.php';
	add_action( 'init', array( 'Beverage_Meta', 'instance' ) );
}

/**
 * Instantiate instance of Beverage Table Shortcode
 *
 * @since Beverage_Meta 1.0
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/table-shortcode.php' ) ) {
	include_once plugin_dir_path( __FILE__ ) . 'classes/table-shortcode.php';
	add_action( 'init', array( 'Beverage_Table_Shortcode', 'instance' ) );
}


/**
 * Instantiate instance of My Affiliate Columns (bring back later)
 *
 * @since My_Affiliate_List_Columns 1.0
 */
//if ( file_exists( plugin_dir_path( __FILE__ ) . 'classes/columns.php' ) ) {
	//include_once plugin_dir_path( __FILE__ ) . 'classes/columns.php';
	//add_action( 'init', array( 'My_Affiliate_List_Columns', 'instance' ) );
//}
