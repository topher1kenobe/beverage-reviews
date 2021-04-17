<?php

/**
 * Instantiate the Beverage_CPT instance
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
	private static $__instance = null;

	/**
	 * Constructor, actually contains nothing
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
	}

	/*
	 * Instance initiator, runs setup etc.
	 *
	 * @static
	 * @access public
	 * @return self
	 */
	public static function instance() {
		if ( ! is_a( self::$__instance, __CLASS__ ) ) {
			self::$__instance = new self;
			self::$__instance->setup();
		}

		return self::$__instance;
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

	/*
	 * Get the store hash
	 *
	 * @access private
	 * @return string $output
	 */
	// Register Custom Post Type
	public function beverage_cpt() {

		register_extended_post_type( 'beverage' );

		register_extended_taxonomy( 'vendor', 'beverage' );

		register_extended_taxonomy( 'beverage-tags', 'beverage', array(

			# Use radio buttons in the meta box for this taxonomy on the post editing screen:
			'hierarchical' => false,

		), array(

			# Override the base names used for labels:
			'singular' => 'Beverage Tag',
			'plural'   => 'Beverage Tags',
			'slug'     => 'beverage-tags'

		) );

	}

}
?>
