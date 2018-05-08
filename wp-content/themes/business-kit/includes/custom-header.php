<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Business_Kit
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses business_kit_header_style()
 */
function business_kit_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'business_kit_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1520,
		'height'                 => 415,
		'flex-height'            => true,
		'wp-head-callback'       => 'business_kit_header_style',
		'default-image'			 => '%s/assets/images/inner-banner-main.jpg',
	) ) );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(		
		'inner-banner-main' => array(
			'url'           => '%s/assets/images/inner-banner-main.jpg',
			'thumbnail_url' => '%s/assets/images/inner-banner-main.jpg',
			'description'   => _x( 'inner-banner-main', 'default banner', 'business-kit' )
		),	
		'inner-banner-plain' => array(
			'url'           => '%s/assets/images/inner-banner-plain.jpg',
			'thumbnail_url' => '%s/assets/images/inner-banner-plain.jpg',
			'description'   => _x( 'inner-banner-plain', 'plain banner', 'business-kit' )
		),	
	) );
}
add_action( 'after_setup_theme', 'business_kit_custom_header_setup' );

if ( ! function_exists( 'business_kit_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see business_kit_custom_header_setup().
	 */
	function business_kit_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
