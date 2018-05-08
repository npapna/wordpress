<?php
/**
 * Bitcoinee-Bitcoin Cryptocurrency WordPress Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bitcoinee
 */


if ( ! function_exists( 'bitcoinee_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bitcoinee_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bitcoinee-Bitcoin Cryptocurrency WordPress Theme, use a find and replace
		 * to change 'bitcoinee' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bitcoinee', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		update_option( 'thumbnail_size_w', 218 );
		update_option( 'thumbnail_size_h', 163 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'bitcoinee' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', array(
			'default-color' => 'ededed',
			'default-image' => '',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 78,
			'width'       => 225,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_editor_style( array( '/css/editor-style.css' ) );
		}
endif;
add_action( 'after_setup_theme', 'bitcoinee_setup' );

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'bitcoinee_register_required_plugins' );

require get_template_directory() . '/inc/bootstrap-navwalker.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bitcoinee_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bitcoinee_content_width', 640 );
}
add_action( 'after_setup_theme', 'bitcoinee_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bitcoinee_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bitcoinee' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bitcoinee' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><i class="cf cf-eth"></i>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Crypto Market Index', 'bitcoinee' ),
		'id'            => 'bitcoinee-crypto-market-index',
		'description'   => esc_html__( 'Add widgets here.', 'bitcoinee' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><i class="cf cf-btc-alt"></i>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Widgets', 'bitcoinee' ),
		'id'			=> 'footer-widgets',
		'description'	=> esc_html__( 'Add widgets here to display in footer area', 'bitcoinee' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s col-lg-3 col-md-3 col-sm-12 col-xs-12">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'bitcoinee_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bitcoinee_scripts() {
	
	wp_enqueue_style( 'bitcoinee-style', get_stylesheet_uri() );
	wp_enqueue_style( 'cryptofont', get_template_directory_uri() . '/css/cryptofont.min.css', array(), '0.1.1', 'all' );
	wp_enqueue_style( 'bitcoinee-googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|IBM+Plex+Serif:400,700&amp;subset=latin-ext,vietnamese' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array( 'bitcoinee-style' ), '4.0.2', 'all' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', '4.7.0', 'all' );
	wp_enqueue_style( 'owlcarousel', get_template_directory_uri() . '/css/owl.carousel.min.css', rand(), 'all' );
	wp_enqueue_style( 'owltheme', get_template_directory_uri() . '/css/owl.theme.default.min.css', rand(), 'all' );
	wp_enqueue_style( 'animatecss', get_template_directory_uri() . '/css/animate.css', rand(), 'all' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', rand(), 'all' );
	wp_enqueue_script( 'jquery-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '4.0', true );
	wp_enqueue_script( 'jquery-owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '201217', true );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '290318', true );
	wp_enqueue_script( 'bitcoinee-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'bitcoinee-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bitcoinee_scripts' );

function bitcoinee_excerpt( $length ) {

	if ( is_admin() ) {
		return $length;
	} else {
		return 30;
	}
}
add_filter( 'excerpt_length', 'bitcoinee_excerpt', 999 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function bitcoinee_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'               => 'Kades Crypto Widgets',
			'slug'               => 'kades-crypto-widgets',
			'required'           => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'bitcoinee',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}





