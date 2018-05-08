<?php
/**
 * Helper functions.
 *
 * @package Business_Kit
 */

if ( ( is_front_page()) || is_page_template( 'templates/home.php' ) ) {
    return;
} 

// Custom image.
$image_url = get_header_image();

if( !empty( $image_url ) ){

	$banner_style = 'style="background: url('.esc_url( $image_url ).') top center no-repeat; background-size: cover;"';

} else{

	$banner_style = '';
} ?>

<section id="featured-banner" class="overlay" <?php echo $banner_style; ?>>
	<div class="container">
		<div class="banner-title">

				<?php 
				if(is_page() || is_single() ){ ?>

					<h2><?php echo esc_html( get_the_title() ); ?></h2>

					<?php
				} elseif( is_search() ){ ?>

			        <h2><?php printf( esc_html__( 'Search Results for: %s', 'business-kit' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

			        <?php
			    }elseif( is_404() ){ ?>

			        <h2><?php echo esc_html( 'Page Not Found: 404', 'business-kit'); ?></h2>

			        <?php
			    }elseif( is_home() ){ ?>

			        <h2><?php single_post_title(); ?></h2>

			        <?php
			    } else{

					the_archive_title( '<h2>', '</h2>' );

				}
				?>
			
		</div>
	</div>
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
</section><!-- #main-banner -->