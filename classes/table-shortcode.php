<?php

/**
 * Instantiate the Beverage_Table_Shortcode instance
 * @since Beverage_Table_Shortcode 1.0
 */

class Beverage_Table_Shortcode {

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

		add_shortcode( 'beverage_table', [ $this, 'beverage_table_shortcode' ] );

	}

	/*
	 * Get the store hash
	 *
	 * @access private
	 * @return string $output
	 */
	// Register Custom Post Type
	public function beverage_table_shortcode() {

		$output = '';

		$args = [
			'post_type'      => 'beverage',
			'post_status'    => 'publish',
			'nopaging'       => true,
			'posts_per_page' => -1,
		];

		// the query
		$the_query = new WP_Query( $args );
 
		if ( $the_query->have_posts() ) {

			// print the jquery smart tables stuff
			ob_start();
				echo do_shortcode( "[wp_jdt id='beverage-table']" );
				$output .= ob_get_contents();
			ob_end_clean();

			$output .= '<style>' . "\n";
			$output .= '#beverage-table th { text-align: left; }' . "\n";
			$output .= '</style>' . "\n";

			$output .= '<table border="0" id="beverage-table">' . "\n";
				$output .= '<thead>' . "\n";
					$output .= '<tr>' . "\n";
						$output .= '<th>Label</th>' . "\n";
						$output .= '<th>Distillery</th>' . "\n";
						$output .= '<th>Cost</th>' . "\n";
						$output .= '<th>Rating</th>' . "\n";
						$output .= '<th>Tags</th>' . "\n";
					$output .= '</tr>' . "\n";
				$output .= '</thead>' . "\n";

				$output .= '<tfoot>' . "\n";
					$output .= '<tr>' . "\n";
						$output .= '<th>Label</th>' . "\n";
						$output .= '<th>Distillery</th>' . "\n";
						$output .= '<th>Cost</th>' . "\n";
						$output .= '<th>Rating</th>' . "\n";
						$output .= '<th>Tags</th>' . "\n";
					$output .= '</tr>' . "\n";
				$output .= '</tfoot>' . "\n";

				$output .= '<tbody>' . "\n";
		 
			while ( $the_query->have_posts() ) : $the_query->the_post();

				$vendors_array = get_the_terms( get_the_ID(), 'beverage-vendor' );

				$tags_array    = get_the_terms( get_the_ID(), 'beverage-tags' );

				$tags = implode( ', ', wp_list_pluck( $tags_array, 'name' ) );

				$output .= '<tr>' . "\n";
					$output .= '<td><a href="' . esc_url( get_post_meta( get_the_ID(), 'beverage_link', true ) ) . '">' . get_the_title() . '</a></td>' . "\n";
					$output .= '<td><a href="' . esc_url( get_term_meta( $vendors_array[0]->term_id, 'beverage_vendor_link', true ) ) . '">' . esc_html( $vendors_array[0]->name ) . '</a></td>' . "\n";
					$output .= '<td>' . esc_html( get_post_meta( get_the_ID(), 'beverage_currency', true ) . get_post_meta( get_the_ID(), 'beverage_price', true ) ) . '</td>' . "\n";
					$output .= '<td nowrap>' . eh_cmb2_get_star_rating_field( 'beverage_rating', get_the_ID() ) . '</td>' . "\n";
					$output .= '<td>' . esc_html( $tags ) . '</td>' . "\n";
				$output .= '</tr>' . "\n";

			endwhile;

				$output .= '</tbody>' . "\n";
			$output .= '</table>' . "\n";

			wp_reset_postdata();
		 
		}

		return $output;

	}


	public static function register_required_plugins() {

		$plugins = [
			[
				'name'     => 'WP jQuery DataTable',
				'slug'     => 'wp-jquery-datatable',
				'required' => true,
			],
			// More plugins
		];
		$config  = [
			'id' => 'beverage-reviews',
		];
		tgmpa( $plugins, $config );
	}

}
?>
