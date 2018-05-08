<?php
/**
 * Options.
 *
 * @package Business_Kit
 */

$default = business_kit_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'business-kit' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section( 'section_header',
	array(
		'title'      => esc_html__( 'Header Options', 'business-kit' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting show_top_header.
$wp_customize->add_setting( 'show_top_header',
	array(
		'default'           => $default['show_top_header'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_header',
	array(
		'label'    			=> esc_html__( 'Show Top Header', 'business-kit' ),
		'section'  			=> 'section_header',
		'type'     			=> 'checkbox',
		'priority' 			=> 100,
	)
);

// Setting top left header.
$wp_customize->add_setting( 'left_section',
	array(
		'default'           => $default['left_section'],
		'sanitize_callback' => 'business_kit_sanitize_select',
	)
);
$wp_customize->add_control( 'left_section',
	array(
		'label'    			=> esc_html__( 'Top Header Left Section', 'business-kit' ),
		'section'  			=> 'section_header',
		'type'     			=> 'radio',
		'priority' 			=> 100,
		'choices'  			=> array(
								'top-menu'  => esc_html__( 'Menu', 'business-kit' ),
								'contact'  => esc_html__( 'Contact Details', 'business-kit' ),
								'top-social' => esc_html__( 'Social Links', 'business-kit' ),
							),
		'active_callback' 	=> 'business_kit_is_top_header_active',
	)
);

// Setting top right header.
$wp_customize->add_setting( 'right_section',
	array(
		'default'           => $default['right_section'],
		'sanitize_callback' => 'business_kit_sanitize_select',
	)
);
$wp_customize->add_control( 'right_section',
	array(
		'label'    			=> esc_html__( 'Top Header Right Section', 'business-kit' ),
		'section'  			=> 'section_header',
		'type'     			=> 'radio',
		'priority' 			=> 100,
		'choices'  			=> array(
								'top-menu'  => esc_html__( 'Menu', 'business-kit' ),
								'contact'  => esc_html__( 'Contact Details', 'business-kit' ),
								'top-social' => esc_html__( 'Social Links', 'business-kit' ),
							),
		'active_callback' 	=> 'business_kit_is_top_header_active',
	)
);

// Setting Address.
$wp_customize->add_setting( 'top_address',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_address',
	array(
		'label'    			=> esc_html__( 'Address/Location', 'business-kit' ),
		'section'  			=> 'section_header',
		'type'     			=> 'text',
		'priority' 			=> 100,
		'active_callback' 	=> 'business_kit_is_top_header_active',
	)
);

// Setting Phone.
$wp_customize->add_setting( 'top_phone',
	array(
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_phone',
	array(
		'label'    			=> esc_html__( 'Phone Number', 'business-kit' ),
		'section'  			=> 'section_header',
		'type'     			=> 'text',
		'priority' 			=> 100,
		'active_callback' 	=> 'business_kit_is_top_header_active',
	)
);

// Setting Email.
$wp_customize->add_setting( 'top_email',
	array(
		'sanitize_callback' => 'sanitize_email',
	)
);
$wp_customize->add_control( 'top_email',
	array(
		'label'    			=> esc_html__( 'Email', 'business-kit' ),
		'section'  			=> 'section_header',
		'type'     			=> 'text',
		'priority' 			=> 100,
		'active_callback' 	=> 'business_kit_is_top_header_active',
	)
);

// Add Main Slide Panel.
$wp_customize->add_panel( 'main_slider_panel',
	array(
		'title'      => esc_html__( 'Slider Options', 'business-kit' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Slider Section.
$wp_customize->add_section( 'section_slider',
	array(
		'title'      => esc_html__( 'Select Slider', 'business-kit' ),
		'panel'      => 'main_slider_panel',
		'priority'   => 100,
	)
);

// Setting slider_status.
$wp_customize->add_setting( 'slider_status',
	array(
		'default'           => $default['slider_status'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_status',
	array(
		'label'    			=> esc_html__( 'Enable Slider', 'business-kit' ),
		'section'  			=> 'section_slider',
		'type'     			=> 'checkbox',
		'priority' 			=> 100,
	)
);

$slider_number = 5;

for ( $i = 1; $i <= $slider_number; $i++ ) {

	$wp_customize->add_setting( "slider_page_$i",
		array(
			'sanitize_callback' => 'business_kit_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control( "slider_page_$i",
		array(
			'label'           => esc_html__( 'Slide ', 'business-kit' ) . ' - ' . $i,
			'section'         => 'section_slider',
			'type'            => 'dropdown-pages',
			'active_callback' => 'business_kit_is_featured_slider_active',
			'priority' 		  => 100,
		)
	); 

}

// Slider Settings.
$wp_customize->add_section( 'section_settings',
	array(
		'title'      => esc_html__( 'Slider Settings', 'business-kit' ),
		'panel'      => 'main_slider_panel',
		'priority'   => 100,
	)
);

// Setting slider_transition_effect.
$wp_customize->add_setting( 'slider_transition_effect',
	array(
		'default'           => $default['slider_transition_effect'],
		'sanitize_callback' => 'business_kit_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_transition_effect',
	array(
		'label'           => esc_html__( 'Transition Effect', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'select',
		'priority' 		  => 100,
		'choices'         => array(
			'fade'       => esc_html__( 'Fade', 'business-kit' ),
			'scroll'     => esc_html__( 'Scroll', 'business-kit' ),
		),
	)
);

// Setting slider_transition_delay.
$wp_customize->add_setting( 'slider_transition_delay',
	array(
		'default'           => $default['slider_transition_delay'],
		'sanitize_callback' => 'business_kit_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'slider_transition_delay',
	array(
		'label'           => esc_html__( 'Transition Delay', 'business-kit' ),
		'description'     => esc_html__( 'in seconds', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'number',
		'priority' 		  => 100,
		'input_attrs'     => array( 'min' => 1, 'max' => 5, 'step' => 1, 'style' => 'width: 60px;' ),
	)
);

// Setting slider_arrow_status.
$wp_customize->add_setting( 'slider_arrow_status',
	array(
		'default'           => $default['slider_arrow_status'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_arrow_status',
	array(
		'label'           => esc_html__( 'Show Arrow', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'checkbox',
		'priority' 		  => 100,
	)
);

// Setting slider_pager_status.
$wp_customize->add_setting( 'slider_pager_status',
	array(
		'default'           => $default['slider_pager_status'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_pager_status',
	array(
		'label'           => esc_html__( 'Show Pager', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'checkbox',
		'priority' 		  => 100,
	)
);

// Setting slider_autoplay_status.
$wp_customize->add_setting( 'slider_autoplay_status',
	array(
		'default'           => $default['slider_autoplay_status'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_autoplay_status',
	array(
		'label'           => esc_html__( 'Enable Autoplay', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'checkbox',
		'priority' 		  => 100,
	)
);

// Setting slider_overlay_status.
$wp_customize->add_setting( 'slider_overlay_status',
	array(
		'default'           => $default['slider_overlay_status'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_overlay_status',
	array(
		'label'           => esc_html__( 'Enable Overlay', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'checkbox',
		'priority' 		  => 100,
	)
);

// Setting slider excerpt_length.
$wp_customize->add_setting( 'slider_excerpt_length',
	array(
		'default'           => $default['slider_excerpt_length'],
		'sanitize_callback' => 'business_kit_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'slider_excerpt_length',
	array(
		'label'       => esc_html__( 'Caption Length', 'business-kit' ),
		'section'     => 'section_settings',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 1, 'max' => 50, 'style' => 'width: 55px;' ),
		'priority' 	  => 100,
	)
);

// Setting slider_readmore_status.
$wp_customize->add_setting( 'slider_readmore_status',
	array(
		'default'           => $default['slider_readmore_status'],
		'sanitize_callback' => 'business_kit_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_readmore_status',
	array(
		'label'           => esc_html__( 'Enable Readmore Button', 'business-kit' ),
		'section'         => 'section_settings',
		'type'            => 'checkbox',
		'priority' 		  => 100,
	)
);

// Setting slider readmore text.
$wp_customize->add_setting( 'slider_readmore_text',
	array(
		'default'           => $default['slider_readmore_text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'slider_readmore_text',
	array(
		'label'    => esc_html__( 'Read More Text', 'business-kit' ),
		'section'  => 'section_settings',
		'type'     => 'text',
		'priority' => 100,
		'active_callback' 	=> 'business_kit_is_slider_readmore_text_active',
	)
);

// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
		'title'      => esc_html__( 'Layout Options', 'business-kit' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_kit_sanitize_select',
	)
);
$wp_customize->add_control( 'global_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'business-kit' ),
		'section'  => 'section_layout',
		'type'     => 'radio',
		'priority' => 100,
		'choices'  => array(
				'left-sidebar'  => esc_html__( 'Left Sidebar', 'business-kit' ),
				'right-sidebar' => esc_html__( 'Right Sidebar', 'business-kit' ),
				'no-sidebar'    => esc_html__( 'No Sidebar', 'business-kit' ),
			),
	)
);

// Setting excerpt_length.
$wp_customize->add_setting( 'excerpt_length',
	array(
		'default'           => $default['excerpt_length'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_kit_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length', 'business-kit' ),
		'description' => esc_html__( 'in words', 'business-kit' ),
		'section'     => 'section_layout',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
		'title'      => esc_html__( 'Footer Options', 'business-kit' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'business-kit' ),
		'section'  => 'section_footer',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'section_breadcrumb',
	array(
		'title'      => esc_html__( 'Breadcrumb Options', 'business-kit' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'breadcrumb_type',
	array(
		'default'           => $default['breadcrumb_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_kit_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_type',
	array(
		'label'       => esc_html__( 'Breadcrumb Type', 'business-kit' ),
		'section'     => 'section_breadcrumb',
		'type'        => 'radio',
		'priority'    => 100,
		'choices'     => array(
			'disable' => esc_html__( 'Disable', 'business-kit' ),
			'simple'  => esc_html__( 'Simple', 'business-kit' ),
		),
	)
);