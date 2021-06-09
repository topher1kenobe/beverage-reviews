<?php
/**
 * Beverage DataTables Shortcode
 *
 * Uses WP jQuery DataTable
 *
 * @since 1.0.0
 *
 * @link https://wordpress.org/plugins/wp-jquery-datatable/
 * @package beverage-reviews
 */

/**
 * Instantiate the Beverage_Table_Shortcode instance
 *
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

		add_shortcode( 'beverage_table', array( $this, 'beverage_table_shortcode' ) );

	}

	/**
	 * Get the store hash
	 *
	 * @access private
	 * @return string $output
	 */
	public function beverage_table_shortcode() {

		$output = '';

		$args = array(
			'post_type'      => 'beverage',
			'post_status'    => 'publish',
			'nopaging'       => true,
			'posts_per_page' => -1,
		);

		// the query.
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {

			// print the jquery smart tables stuff.
			ob_start();
				echo do_shortcode( "[wp_jdt id='beverage-table']" );
				$output .= ob_get_contents();
			ob_end_clean();

			include_once 'template-parts/beverage-table-start.php';

			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				$vendors_array = get_the_terms( get_the_ID(), 'beverage-vendor' );
				$tags_array    = get_the_terms( get_the_ID(), 'beverage-tags' );
				$tags          = implode( ', ', wp_list_pluck( $tags_array, 'name' ) );

				$output .= '<tr>' . "\n";
				$output .= '<td nowrap><a href=""><span class="dashicons dashicons-info-outline"></span> <span class="hidden">Info</span></a></td>' . "\n";
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


	/**
	 * Set up TGM Requirements
	 *
	 * @access public
	 */
	public static function register_required_plugins() {

		$plugins = array(
			array(
				'name'     => 'WP jQuery DataTable',
				'slug'     => 'wp-jquery-datatable',
				'required' => true,
			),
			// More plugins.
		);
		$config = array(
			'id' => 'beverage-reviews',
		);
		tgmpa( $plugins, $config );
	}
}
