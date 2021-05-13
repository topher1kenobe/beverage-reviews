<?php
/**
 * Beverage Meta Fields
 *
 * Uses CMB2
 *
 * @since 1.0.0
 *
 * @link https://wordpress.org/plugins/cmb2/
 * @package beverage-reviews
 */

/**
 * Instantiate the Beverage_Meta instance
 *
 * @since Beverage_Meta 1.0
 */
class Beverage_Meta {

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

		add_filter( 'cmb2_admin_init', array( $this, 'beverage_meta' ), 1 );

		add_filter( 'cmb2_admin_init', array( $this, 'vendor_meta' ), 1 );

	}

	/**
	 * Register the beverage meta box and fields
	 *
	 * @access public
	 */
	public function beverage_meta() {

		$prefix = 'beverage_';

		$beverage_meta = new_cmb2_box(
			array(
				'id'           => 'beverage_links',
				'title'        => esc_html__( 'Beverage Information', 'beverage-reviews' ),
				'object_types' => array( 'beverage' ), // Post type.
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);

		$beverage_meta->add_field(
			array(
				'name' => esc_html__( 'More Information (URL)', 'beverage-reviews' ),
				'id'   => $prefix . 'link',
				'type' => 'text_url',
			)
		);

		$beverage_meta->add_field(
			array(
				'name' => esc_html__( 'Year', 'beverage-reviews' ),
				'id'   => $prefix . 'year',
				'type' => 'text_small',
			)
		);

		$beverage_meta->add_field(
			array(
				'name' => esc_html__( 'Batch', 'beverage-reviews' ),
				'id'   => $prefix . 'batch',
				'type' => 'text_medium',
			)
		);

		$beverage_meta->add_field(
			array(
				'name'    => esc_html__( 'Currency', 'beverage-reviews' ),
				'id'      => $prefix . 'currency',
				'default' => '$',
				'type'    => 'text_small',
			)
		);

		$beverage_meta->add_field(
			array(
				'name' => esc_html__( 'Price', 'beverage-reviews' ),
				'id'   => $prefix . 'price',
				'type' => 'text_small',
			)
		);

		$beverage_meta->add_field(
			array(
				'name' => esc_html__( 'Rating', 'beverage-reviews' ),
				'id'   => $prefix . 'rating',
				'type' => 'star_rating',
			)
		);

	}

	/**
	 * Register the vendor meta box and fields
	 *
	 * @access public
	 * @return void
	 */
	public function vendor_meta() {

		$prefix = 'beverage_vendor_';

		/**
		 * Metabox to add fields to categories and tags
		 */
		$cmb_term = new_cmb2_box(
			array(
				'id'               => $prefix . 'term_meta',
				'title'            => esc_html__( 'Vendor Information', 'beverage-reviews' ), // Doesn't output for term boxes.
				'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta.
				'taxonomies'       => array( 'beverage-vendor' ), // Tells CMB2 which taxonomies should have these fields.
				'new_term_section' => true, // Will display in the "Add New Category" section.
			)
		);

		$cmb_term->add_field(
			array(
				'name' => esc_html__( 'URL', 'beverage-reviews' ),
				'id'   => $prefix . 'link',
				'type' => 'text_url',
			)
		);

	}

}
