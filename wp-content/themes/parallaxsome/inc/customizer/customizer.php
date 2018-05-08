<?php
/**
 * ParallaxSome Theme Customizer.
 *
 * @package AccessPress Themes
 * @subpackage ParallaxSome
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function parallaxsome_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/*------------------------------------------------------------------------------------*/
		/**
		 * Upgrade to Uncode Pro
		*/
		// Register custom section types.
		$wp_customize->register_section_type( 'Parallaxsome_Customize_Section_Pro' );

		// Register sections.
		$wp_customize->add_section(
		    new Parallaxsome_Customize_Section_Pro(
		        $wp_customize,
		        'parallaxsome-pro',
		        array(
		            'title1'    => esc_html__( 'Free vs Pro', 'parallaxsome' ),
		            'pro_text1' => esc_html__( 'Compare','parallaxsome' ),
		            'pro_url1'  => admin_url('themes.php?page=parallaxsome-welcome&section=free_vs_pro'),
		            'priority' => 1,
		        )
		    )
		);
		$wp_customize->add_setting(
			'parallaxsome_pro_upbuton',
			array(
				'section' => 'parallaxsome-pro',
				'sanitize_callback' => 'esc_attr',
			)
		);

		$wp_customize->add_control(
			'parallaxsome_pro_upbuton',
			array(
				'section' => 'parallaxsome-pro'
			)
		);

		/** Dynamic Color Options **/
		$wp_customize->add_setting( 'parallaxsome_tpl_color', array( 'default' => '#e23815', 'sanitize_callback' => 'sanitize_hex_color' ));

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'parallaxsome_tpl_color', 
			array(
				'label'      => esc_html__( 'Template Color', 'parallaxsome' ),
				'section'    => 'colors',
				'settings'   => 'parallaxsome_tpl_color',
			) ) 
		);
}
add_action( 'customize_register', 'parallaxsome_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function parallaxsome_customize_preview_js() {
	wp_enqueue_script( 'parallaxsome_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20160714', true );
}
add_action( 'customize_preview_init', 'parallaxsome_customize_preview_js' );

/**
 *
 */
function parallaxsome_customize_backend_scripts() {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'parallaxsome_admin_customizer_style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );
	wp_enqueue_script( 'parallaxsome_admin_customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-scripts.js', array( 'jquery', 'customize-controls' ), '20160714', true );
}
add_action( 'customize_controls_enqueue_scripts', 'parallaxsome_customize_backend_scripts', 10 );
