<?php
/**
 * Beverage Custom Post Type
 *
 * Uses Extended Custom Post Types library
 *
 * @since 1.0.0
 *
 * @see register_extended_post_type
 * @see register_extended_taxonomy
 * @link https://github.com/johnbillion/extended-cpts
 * @package beverage-reviews
 */

/**
 * Instantiate the Beverage_CPT instance
 *
 * @since Beverage_CPT 1.0
 */
class Beverage_CPT {

	/**
	 * Instance handle
	 *
	 * @static
	 * @since 1.2
	 * @var string
	 */
	private static $instance = null;

	/**
	 * Constructor, actually contains nothing
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
	}

	/**
	 * Instance initiator, runs setup etc.
	 *
	 * @static
	 * @access public
	 * @return self
	 */
	public static function instance() {
		if ( ! is_a( self::$instance, __CLASS__ ) ) {
			self::$instance = new self();
			self::$instance->setup();
		}

		return self::$instance;
	}

	/**
	 * Runs things that would normally be in __construct
	 *
	 * @access private
	 * @return void
	 */
	public function setup() {

		$this->beverage_cpt();

	}

	/**
	 * Register Custom Post Type
	 *
	 * @access public
	 */
	public function beverage_cpt() {

		register_extended_post_type( 'beverage',
			array(
				'show_in_rest' => true,
			)
		);

		register_extended_taxonomy(
			'beverage-vendor',
			'beverage',
			array(),
			array(

				// Override the base names used for labels.
				'singular' => 'Beverage Vendor',
				'plural'   => 'Beverage Vendors',
				'slug'     => 'beverage-vendors',

			)
		);

		register_extended_taxonomy(
			'beverage-tags',
			'beverage',
			array(

				// Use radio buttons in the meta box for this taxonomy on the post editing screen.
				'hierarchical' => false,

			),
			array(

				// Override the base names used for labels.
				'singular' => 'Beverage Tag',
				'plural'   => 'Beverage Tags',
				'slug'     => 'beverage-tags',

			)
		);

	}

}
