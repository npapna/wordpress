<?php
/*
 * Plugin Name: Theme Toolkit
 * Version: 1.0.1
 * Plugin URI: https://wordpress.org/plugins/theme-toolkit/
 * Description: Theme toolkit is a plugin to register custom post types, widgets and shortcodes to add additional feature and functionality to any WordPress theme. It supports testimonial, portfolio, team and partners custom post types.
 * Author: Precious Themes
 * Author URI: https://www.preciousthemes.com/
 * License: GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * Text Domain: theme-toolkit
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Theme_Toolkit' ) ) :

	class Theme_Toolkit {

		private static $instance;

		public static function run_instance() {

			if ( !self::$instance )
				self::$instance = new self;

			return self::$instance;
		}

		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		// Actions setup
		public function __construct() {
			$this->init_hooks();
			$this->define_constants();
			$this->includes();
		}

		private function init_hooks() {

			add_action( 'wp_enqueue_scripts', array( $this, 'theme_toolkit_scripts' ), 4 );

		}

		private function define_constants() {
			$this->define( 'TT_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
			$this->define( 'TT_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
		}

		private function includes() {
			require_once( TT_DIR . '/team/team.php' );
			require_once( TT_DIR . '/team/team-widget.php' );
			require_once( TT_DIR . '/testimonials/testimonials.php' );
			require_once( TT_DIR . '/testimonials/testimonials-widget.php' );
			require_once( TT_DIR . '/partners/partners.php' );
			require_once( TT_DIR . '/partners/partners-widget.php' );
			require_once( TT_DIR . '/portfolio/portfolio.php' );
			require_once( TT_DIR . '/portfolio/portfolio-widget.php' );
		}

	    function theme_toolkit_scripts() {

	    	wp_enqueue_style( 'font-awesome', TT_URL . '/assets/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

	    	wp_enqueue_style( 'theme-toolkit-style', TT_URL . '/assets/main-style.css' );
	        
	        wp_enqueue_script( 'jquery-mixitup', TT_URL . '/assets/jquery.mixitup.min.js', array( 'jquery' ), '1.5.5' );
	        
	        wp_enqueue_script( 'theme-toolkit-custom', TT_URL . '/assets/custom.js', array( 'jquery-mixitup' ), '1.0.0' );

	    }

	}

endif;

function theme_toolkit_call() {

		return Theme_Toolkit::run_instance();
}

add_action( 'plugins_loaded', 'theme_toolkit_call', 1 );