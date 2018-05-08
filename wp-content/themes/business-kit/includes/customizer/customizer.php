<?php
/**
 * Business Kit Theme Customizer.
 *
 * @package Business_Kit
 */

/**
 * Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_kit_customize_register( $wp_customize ) {

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'business_kit_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'business_kit_customize_partial_blogdescription',
		) );
	}

	// Sanitization.
	require_once trailingslashit( get_template_directory() ) . '/includes/customizer/sanitize.php';

	// Active callback.
	require_once trailingslashit( get_template_directory() ) . '/includes/customizer/active.php';

	// Load options.
	require_once trailingslashit( get_template_directory() ) . '/includes/customizer/options.php';

	/* Load Upgrade to Pro control
	----------------------------------------------------------------------*/
	require_once trailingslashit( get_template_directory() ) . '/includes/upgrade-to-pro/control.php';

	/* Register custom section types.
	----------------------------------------------------------------------*/
	$wp_customize->register_section_type( 'Business_Kit_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Business_Kit_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Business Kit Pro', 'business-kit' ),
				'pro_text' => esc_html__( 'Buy Pro', 'business-kit' ),
				'pro_url'  => 'https://www.preciousthemes.com/downloads/business-kit-pro/',
				'priority' => 1,
			)
		)
	);

}
add_action( 'customize_register', 'business_kit_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function business_kit_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function business_kit_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_kit_customize_preview_js() {
	wp_enqueue_script( 'business-kit-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_kit_customize_preview_js' );

/**
 * Enqueue style for custom customize control.
 */
function business_kit_custom_customize_enqueue() {

	wp_enqueue_script( 'business-kit-customize-controls', get_template_directory_uri() . '/includes/upgrade-to-pro/customize-controls.js', array( 'customize-controls' ) );

	wp_enqueue_style( 'business-kit-customize-controls', get_template_directory_uri() . '/includes/upgrade-to-pro/customize-controls.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'business_kit_custom_customize_enqueue' );