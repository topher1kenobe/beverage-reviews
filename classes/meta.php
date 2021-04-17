<?php

/**
 * Instantiate the Beverage_Meta instance
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

		add_filter( 'rwmb_meta_boxes', [ $this, 'beverage_meta' ], 1 );

	}

	/*
	 * Register the meta box and fields
	 *
	 * @access public
	 * @return string $output
	 */
	public function beverage_meta( $meta_boxes ) {

		$prefix = 'beverage_';

		$meta_boxes[] = [
			'title'      => esc_html__( 'Beverage Information', 'beverage-reviews' ),
			'id'         => 'beverage_links',
			'post_types' => [ 'beverage' ],
			'context'    => 'normal',
			'priority'   => 'high',
			'autosave'   => true,
			'fields'     => [
				[
					'type' => 'text',
					'id'   => $prefix . 'link',
					'name' => esc_html__( 'More Information (URL)', 'beverage-reviews' ),
				],
				[
					'type' => 'text',
					'id'   => $prefix . 'batch',
					'name' => esc_html__( 'Batch', 'beverage-reviews' ),
				],
				[
					'type' => 'text',
					'id'   => $prefix . 'currency',
					'std'  => '$',
					'name' => esc_html__( 'Currency', 'beverage-reviews' ),
					'size' => 1,
				],
				[
					'type' => 'text',
					'id'   => $prefix . 'price',
					'name' => esc_html__( 'Average Price', 'beverage-reviews' ),
					'size' => 5,
				],
				[
					'id'   => $prefix . 'rating',
					'type' => 'rating',
					'name' => esc_html__( 'Rating', 'beverage-reviews' ),
					'std'  => 0,
				],
			],
		];

		return $meta_boxes;

	}

	public static function register_required_plugins() {

		$plugins = array(
			array(
				'name'     => 'Meta Box',
				'slug'     => 'meta-box',
				'required' => true,
			),
			array(
				'name'     => 'WP jQuery DataTable',
				'slug'     => 'wp-jquery-datatable',
				'required' => true,
			),
			array(
				'name'     => 'Meta Box Ratings Field',
				'slug'     => 'mb-rating-field-main',
				'required' => true,
				'source'   => 'https://github.com/wpmetabox/mb-rating-field/archive/refs/heads/main.zip',
			),
			// More plugins
		);
		$config  = array(
			'id' => 'beverage-reviews',
		);
		tgmpa( $plugins, $config );
	}

}
?>
