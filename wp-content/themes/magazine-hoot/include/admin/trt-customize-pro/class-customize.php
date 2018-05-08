<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @credit() Justin Tadlock https://github.com/justintadlock/trt-customizer-pro
 *
 * @since  1.0
 * @access public
 */
final class Maghoot_Premium_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( HYBRIDEXTEND_INC . 'admin/trt-customize-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Maghoot_Premium_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Maghoot_Premium_Customize_Section_Pro(
				$manager,
				'maghoot_premium',
				array(
					'title'    => esc_html__( 'Magazine Hoot Premium', 'magazine-hoot' ),
					'priority' => 1,
					'pro_text' => esc_html__( 'Premium', 'magazine-hoot' ),
					'pro_url'  => esc_url( admin_url('themes.php?page=magazine-hoot-premium') ),
					'demo'     => 'https://demo.wphoot.com/magazine-hoot/',
					'docs'     => 'https://wphoot.com/support/',
					'rating'   => 'https://wordpress.org/support/view/theme-reviews/magazine-hoot#postform',
				)
			)
		);
	}

}

// Doing this customizer thang!
Maghoot_Premium_Customize::get_instance();
