<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_Kit
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_kit_body_classes( $classes ) {

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class for global layout.
	$global_layout = business_kit_get_option( 'global_layout' );
	$global_layout = apply_filters( 'business_kit_filter_theme_global_layout', $global_layout );
	$classes[] = 'global-layout-' . esc_attr( $global_layout );

	$header_status = business_kit_get_option( 'show_top_header' );
		
	if ( 1 == $header_status ) {

		$classes[] = 'top-header-active';

	}

	$slider_status = business_kit_get_option( 'slider_status' );
		
	if ( 1 != $slider_status ) {

		$classes[] = 'slider-inactive';

	}

	// Custom image.
	$banner_image = get_header_image();

	if( empty( $banner_image ) ){

		$classes[] = 'banner-inactive';

	}

	return $classes;
}
add_filter( 'body_class', 'business_kit_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function business_kit_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'business_kit_pingback_header' );


if ( ! function_exists( 'business_kit_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function business_kit_implement_excerpt_length( $length ) {

		$excerpt_length = business_kit_get_option( 'excerpt_length' );
		
		if ( absint( $excerpt_length ) > 0 ) {

			$length = absint( $excerpt_length );

		}

		return $length;

	}
endif;

if ( ! function_exists( 'business_kit_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function business_kit_implement_read_more( $more ) {
		
		$output = '&hellip;';
		
		return $output;

	}
endif;

if ( ! function_exists( 'business_kit_hook_read_more_filters' ) ) :

	/**
	 * Hook read more and excerpt length filters.
	 *
	 * @since 1.0.0
	 */
	function business_kit_hook_read_more_filters() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() || is_search() ) {

			add_filter( 'excerpt_length', 'business_kit_implement_excerpt_length', 999 );
			add_filter( 'excerpt_more', 'business_kit_implement_read_more' );

		}
	}
endif;
add_action( 'wp', 'business_kit_hook_read_more_filters' );

if ( ! function_exists( 'business_kit_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function business_kit_add_sidebar() {

		$global_layout = business_kit_get_option( 'global_layout' );
		$global_layout = apply_filters( 'business_kit_filter_theme_global_layout', $global_layout );

		// Include sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}

	}
endif;
add_action( 'business_kit_action_sidebar', 'business_kit_add_sidebar' );

function business_kit_register_required_plugins() {
	
	$plugins = array(
				
		array(
			'name'      => esc_html__( 'Theme Toolkit', 'business-kit' ),
			'slug'      => 'theme-toolkit',
			'required'  => false,
		),

	);

	tgmpa( $plugins );
}

add_action( 'tgmpa_register', 'business_kit_register_required_plugins' );

//=============================================================
// Hide archive page prefix
//=============================================================
if( ! function_exists( 'business_kit_remove_archive_prefix' ) ):

	 function business_kit_remove_archive_prefix( $title ) {

	 		if ( is_category() ) {

	 		    $title = single_cat_title( '', false );

	 		} elseif ( is_post_type_archive() ) {

	 		    $title = post_type_archive_title( '', false );

	 		} elseif ( is_tax() ) {

	 		    $title = single_term_title( '', false );

	 		}

	 	return $title;

	 }

endif;

add_filter( 'get_the_archive_title', 'business_kit_remove_archive_prefix');