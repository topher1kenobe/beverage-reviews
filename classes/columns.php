<?php

/**
 * Instantiate the My_Affiliate_List_Columns instance
 * @since My_Affiliate_List_Columns 1.0
 */

class My_Affiliate_List_Columns {

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

		add_filter( 'manage_my-affiliates_posts_columns', [ $this, 'affiliate_columns' ], 1 );
		add_action( 'manage_my-affiliates_posts_custom_column', [ $this, 'link_column' ], 10, 2);

	}

	/*
	 * Set up which columns exist in the admin listing
	 *
	 * @access public
	 * @return string $columns
	 */
	public function affiliate_columns( $columns ) {

		unset( $columns['taxonomy-affiliate_type'] );
		unset( $columns['date'] );

		$columns['image']                   = __( 'Image',  'my-affiliates' );
		$columns['mal-mal_affiliate_link']  = __( 'Link',   'my-affiliates' );
		$columns['mal-mal_affiliate_admin'] = __( 'Admin',  'my-affiliates' );
		$columns['taxonomy-affiliate_type'] = __( 'Types',  'my-affiliates' );
	  
		return $columns;
  
	}

	/*
	 * Create contents for the columns
	 *
	 * @access public
	 * @return NULL
	 */
	public function link_column( $column, $post_id ) {

		// Link column
		if ( 'mal-mal_affiliate_link' === $column ) {
		$link = get_post_meta( $post_id, 'mal-mal_affiliate_link', true );
			if ( ! $link ) {
				_e( 'n/a' );  
			} else {
				echo '<a href="' . esc_url( $link ) . '">' . __( 'Link', 'my-affiliates' ) . '</a>';
			}
		}

		// Admin column
		if ( 'mal-mal_affiliate_admin' === $column ) {
		$admin = get_post_meta( $post_id, 'mal-mal_affiliate_admin', true );
			if ( ! $admin ) {
				_e( 'n/a' );  
			} else {
				echo '<a href="' . esc_url( $admin ) . '">' . __( 'Admin', 'my-affiliates' ) . '</a>';
			}
		}

		// Types column
		if ( 'types' === $column ) {
		$types = get_post_meta( $post_id, 'mal-mal_affiliate_admin', true );
			if ( ! $types ) {
				_e( 'n/a' );  
			} else {
				echo '<a href="' . esc_url( $types ) . '">' . __( 'Admin', 'my-affiliates' ) . '</a>';
			}
		}
	}
  

}
?>
