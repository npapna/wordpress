<?php
/**
 * About configuration
 *
 * @package Business_Kit
 */

$config = array(
	'menu_name' => esc_html__( 'About Business Kit', 'business-kit' ),
	'page_name' => esc_html__( 'About Business Kit', 'business-kit' ),

	/* translators: theme version */
	'welcome_title' => sprintf( esc_html__( 'Welcome to %s - ', 'business-kit' ), 'Business Kit' ),

	/* translators: 1: theme name */
	'welcome_content' => sprintf( esc_html__( 'This page will help you to setup %1$s with few clicks. We believe you will find it easy to use and perfect for your website development.', 'business-kit' ), 'Business Kit' ),

	// Quick links.
	'quick_links' => array(
		'theme_url' => array(
			'text' => esc_html__( 'Theme Details','business-kit' ),
			'url'  => 'https://www.preciousthemes.com/downloads/business-kit/',
			),
		'demo_url' => array(
			'text' => esc_html__( 'View Demo','business-kit' ),
			'url'  => 'https://preciousthemes.com/demo/business-kit/',
			),
		'documentation_url' => array(
			'text'   => esc_html__( 'View Documentation','business-kit' ),
			'url'    => 'https://www.preciousthemes.com/documentation/business-kit/',
			'button' => 'primary',
			),
		'rate_url' => array(
			'text' => esc_html__( 'Rate This Theme','business-kit' ),
			'url'  => 'https://wordpress.org/support/theme/business-kit/reviews/',
			),
		),

	// Tabs.
	'tabs' => array(
		'getting_started'     => esc_html__( 'Getting Started', 'business-kit' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'business-kit' ),
		'support'             => esc_html__( 'Support', 'business-kit' ),
		'upgrade_to_pro'      => esc_html__( 'Upgrade to Pro', 'business-kit' ),
		'free_pro'            => esc_html__( 'FREE VS. PRO', 'business-kit' ),
	),

	// Getting started.
	'getting_started' => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'business-kit' ),
			'text'                => esc_html__( 'Find step by step instructions with video documentation to setup theme easily.', 'business-kit' ),
			'button_label'        => esc_html__( 'View documentation', 'business-kit' ),
			'button_link'         => 'https://www.preciousthemes.com/documentation/business-kit/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'business-kit' ),
			'text'                => esc_html__( 'We recommend few steps to take so that you can get complete site like shown in demo.', 'business-kit' ),
			'button_label'        => esc_html__( 'Check recommended actions', 'business-kit' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=business-kit-about&tab=recommended_actions' ) ),
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'business-kit' ),
			'text'                => esc_html__( 'Start customizing every aspect of the website with customizer.', 'business-kit' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'business-kit' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'        			=> esc_html__( 'Youtube Video Tutorials', 'business-kit' ),
			'icon'         			=> 'dashicons dashicons-video-alt3',
			'text'         			=> esc_html__( 'Please check our youtube channel for video instructions of Business Kit setup and customization.', 'business-kit' ),
			'button_label' 			=> esc_html__( 'Video Tutorials', 'business-kit' ),
			'button_link'  			=> 'https://www.youtube.com/watch?v=_JDgKKG5zBA&list=PL-vVuHhFGshHxytZqdV3nwM-as0gmQtg4',
			'is_button'    			=> false,
			'recommended_actions'	=> false,
			'is_new_tab'   			=> true,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			
			'front-page' => array(
				'title'       => esc_html__( 'Setting Static Front Page','business-kit' ),
				'description' => esc_html__( 'Create a new page to display on front page ( Ex: Home ) and assign "Home" template. Select A static page then Front page and Posts page to display front page specific sections. Note: Static page will be set automatically when you import demo content.', 'business-kit' ),
				'id'          => 'front-page',
				'check'       => ( 'page' === get_option( 'show_on_front' ) ) ? true : false,
				'help'        => '<a href="' . esc_url( wp_customize_url() ) . '?autofocus[section]=static_front_page" class="button button-secondary">' . esc_html__( 'Static Front Page', 'business-kit' ) . '</a>',
			),

			'one-click-demo-import' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'business-kit' ),
				'description' => esc_html__( 'Please install the One Click Demo Import plugin to import the demo content. After activation go to Appearance >> Import Demo Data and import it.', 'business-kit' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
			),
		),
	),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'business-kit' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'If you have any problem, feel free to create ticket on our dedicated Support forum.', 'business-kit' ),
			'button_label' => esc_html__( 'Contact Support', 'business-kit' ),
			'button_link'  => esc_url( 'https://www.preciousthemes.com/support/forum/business-kit/' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'business-kit' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Kindly check our theme documentation for detailed information and video instructions.', 'business-kit' ),
			'button_label' => esc_html__( 'View Documentation', 'business-kit' ),
			'button_link'  => 'https://www.preciousthemes.com/documentation/business-kit/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'third' => array(
			'title'        => esc_html__( 'Pro Version', 'business-kit' ),
			'icon'         => 'dashicons dashicons-products',
			'icon'         => 'dashicons dashicons-star-filled',
			'text'         => esc_html__( 'Upgrade to pro version for additional features and options.', 'business-kit' ),
			'button_label' => esc_html__( 'View Pro Version', 'business-kit' ),
			'button_link'  => 'https://www.preciousthemes.com/downloads/business-kit-pro/',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'fourth' => array(
			'title'        => esc_html__( 'Youtube Video Tutorials', 'business-kit' ),
			'icon'         => 'dashicons dashicons-video-alt3',
			'text'         => esc_html__( 'Please check our youtube channel for video instructions of Business Kit setup and customization.', 'business-kit' ),
			'button_label' => esc_html__( 'Video Tutorials', 'business-kit' ),
			'button_link'  => 'https://www.youtube.com/watch?v=_JDgKKG5zBA&list=PL-vVuHhFGshHxytZqdV3nwM-as0gmQtg4',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'fifth' => array(
			'title'        => esc_html__( 'Customization Request', 'business-kit' ),
			'icon'         => 'dashicons dashicons-admin-tools',
			'text'         => esc_html__( 'We have dedicated team members for theme customization. Feel free to contact us any time if you need any customization service.', 'business-kit' ),
			'button_label' => esc_html__( 'Customization Request', 'business-kit' ),
			'button_link'  => 'https://www.preciousthemes.com/contact-us/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'sixth' => array(
			'title'        => esc_html__( 'Child Theme', 'business-kit' ),
			'icon'         => 'dashicons dashicons-admin-customizer',
			'text'         => esc_html__( 'If you want to customize theme file, you should use child theme rather than modifying theme file itself.', 'business-kit' ),
			'button_label' => esc_html__( 'About child theme', 'business-kit' ),
			'button_link'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
	),

	// Upgrade.
	'upgrade_to_pro' 	=> array(
		'description'   => esc_html__( 'Upgrade to pro version for more exciting features and additional theme options.', 'business-kit' ),
		'button_label' 	=> esc_html__( 'Upgrade to Pro', 'business-kit' ),
		'button_link'  	=> 'https://www.preciousthemes.com/downloads/business-kit-pro/',
		'is_new_tab'   	=> true,
	),

    // Free vs pro array.
    'free_pro' => array(
	    array(
		    'title'		=> esc_html__( 'Custom Widgets', 'business-kit' ),
		    'desc' 		=> esc_html__( 'Widgets added by theme to enhance features', 'business-kit' ),
		    'free' 		=> esc_html__('10','business-kit'),
		    'pro'  		=> esc_html__('13','business-kit'),
	    ),
	    
	    array(
		    'title'     => esc_html__( 'Google Fonts', 'business-kit' ),
		    'desc' 		=> esc_html__( 'Google fonts options for changing the overall site fonts', 'business-kit' ),
		    'free'  	=> 'no',
		    'pro'   	=> esc_html__('100+','business-kit'),
	    ),
	    array(
		    'title'     => esc_html__( 'Color Options', 'business-kit' ),
		    'desc'      => esc_html__( 'Options to change primary color of the site', 'business-kit' ),
		    'free'      => esc_html__('no','business-kit'),
		    'pro'       => esc_html__('yes','business-kit'),
	    ),
	    array(
		    'title'     => esc_html__( 'WooCommerce Ready', 'business-kit' ),
		    'desc'      => esc_html__( 'Theme supports/works with WooCommerce plugin', 'business-kit' ),
		    'free'      => esc_html__('no','business-kit'),
		    'pro'       => esc_html__('yes','business-kit'),
	    ),
        array(
    	    'title'     => esc_html__( 'Latest Product Carousel', 'business-kit' ),
    	    'desc'      => esc_html__( 'Widget to display latest products in carousel mode', 'business-kit' ),
    	    'free'      => esc_html__('no','business-kit'),
    	    'pro'       => esc_html__('yes','business-kit'),
        ),

        array(
    	    'title'     => esc_html__( 'Skills with Progressbar', 'business-kit' ),
    	    'desc'      => esc_html__( 'Widget to display skills with progress bar', 'business-kit' ),
    	    'free'      => esc_html__('no','business-kit'),
    	    'pro'       => esc_html__('yes','business-kit'),
        ),

        array(
    	    'title'     => esc_html__( 'Fact Counter', 'business-kit' ),
    	    'desc'      => esc_html__( 'Widget to display facts count that goes up when viewport is visible', 'business-kit' ),
    	    'free'      => esc_html__('no','business-kit'),
    	    'pro'       => esc_html__('yes','business-kit'),
        ),
        array(
    	    'title'     => esc_html__( 'Hide Footer Credit', 'business-kit' ),
    	    'desc'      => esc_html__( 'Option to enable/disable Powerby(Designer) credit in footer', 'business-kit' ),
    	    'free'      => esc_html__('no','business-kit'),
    	    'pro'       => esc_html__('yes','business-kit'),
        ),
        array(
    	    'title'     => esc_html__( 'Override Footer Credit', 'business-kit' ),
    	    'desc'      => esc_html__( 'Option to Override existing Powerby credit of footer', 'business-kit' ),
    	    'free'      => esc_html__('no','business-kit'),
    	    'pro'       => esc_html__('yes','business-kit'),
        ),
	    array(
		    'title'     => esc_html__( 'SEO', 'business-kit' ),
		    'desc' 		=> esc_html__( 'Developed with high skilled SEO tools.', 'business-kit' ),
		    'free'  	=> 'yes',
		    'pro'   	=> 'yes',
	    ),
	    array(
		    'title'     => esc_html__( 'Support Forum', 'business-kit' ),
		    'desc'      => esc_html__( 'Highly experienced and dedicated support team for your help plus online chat.', 'business-kit' ),
		    'free'      => esc_html__('yes', 'business-kit'),
		    'pro'       => esc_html__('High Priority', 'business-kit'),
	    )

    ),

);
Business_Kit_About::init( apply_filters( 'business_kit_about_filter', $config ) );