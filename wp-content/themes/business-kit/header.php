<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Kit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header">

		<?php 
		// For top header
		$header_status = business_kit_get_option( 'show_top_header' );
		
		if ( 1 == $header_status ) {
		
			$top_address    = business_kit_get_option( 'top_address' );
			$top_phone      = business_kit_get_option( 'top_phone' );
			$top_email      = business_kit_get_option( 'top_email' );

			$left_section  	= business_kit_get_option( 'left_section' );
			$right_section  = business_kit_get_option( 'right_section' );

			?>
		    <div class="top-header">

		        <div class="container">

		            <div class="top-header-content">
		                
		                <div class="top-info-left">

		                	<?php 
		                	if( 'contact' == $left_section && ( !empty( $top_address ) || !empty( $top_phone ) || !empty( $top_email ) ) ){ ?>

		                	    <div class="top-contact-info">
		                	        <?php if( !empty( $top_address ) ){ ?>
		                	            <span class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $top_address ); ?></span>
		                	        <?php } ?>

		                	        <?php if( !empty( $top_phone ) ){ ?>
		                	            <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $top_phone ); ?></span>
		                	        <?php } ?>

		                	        <?php if( !empty( $top_email ) ){ ?>
		                	            <span class="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo esc_html( $top_email ); ?></span>
		                	        <?php } ?>
		                	        
		                	    </div>
		                	    <?php
		                	} elseif( 'top-menu' == $left_section && has_nav_menu( 'top' ) ){ ?>
		                	    <div class="top-menu-warp">
		                	        <?php
		                	        wp_nav_menu(
		                	            array(
		                	            'theme_location' => 'top',
		                	            'menu_id'        => 'top-menu',
		                	            'depth'          => 1,                                   
		                	            )
		                	        ); ?>
		                	    </div><!-- .menu-content -->
		                	    <?php
		                	} elseif( 'top-social' == $left_section && has_nav_menu( 'social' ) ){ ?>

		                	    <div class="top-social-menu-container"> 

		                	        <?php the_widget( 'Business_Kit_Social_Widget' ); ?>

		                	    </div>
		                	    <?php
		                	} ?>
		                </div><!-- .top-info-left -->

		                <div class="top-info-right">

		                	<?php 
		                	if( 'contact' == $right_section && ( !empty( $top_address ) || !empty( $top_phone ) || !empty( $top_email ) ) ){ ?>

		                	    <div class="top-contact-info">
		                	        <?php if( !empty( $top_address ) ){ ?>
		                	            <span class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $top_address ); ?></span>
		                	        <?php } ?>

		                	        <?php if( !empty( $top_phone ) ){ ?>
		                	            <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $top_phone ); ?></span>
		                	        <?php } ?>

		                	        <?php if( !empty( $top_email ) ){ ?>
		                	            <span class="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo esc_html( $top_email ); ?></span>
		                	        <?php } ?>
		                	        
		                	    </div>
		                	    <?php
		                	} elseif( 'top-menu' == $right_section && has_nav_menu( 'top' ) ){ ?>
		                	    <div class="top-menu-warp">
		                	        <?php
		                	        wp_nav_menu(
		                	            array(
		                	            'theme_location' => 'top',
		                	            'menu_id'        => 'top-menu',
		                	            'depth'          => 1,                                   
		                	            )
		                	        ); ?>
		                	    </div><!-- .menu-content -->
		                	    <?php
		                	} elseif( 'top-social' == $right_section && has_nav_menu( 'social' ) ){ ?>

		                	    <div class="top-social-menu-container"> 

		                	        <?php the_widget( 'Business_Kit_Social_Widget' ); ?>

		                	    </div>
		                	    <?php
		                	} ?>
		                </div><!-- .top-info-right -->

		           </div><!-- .top-header-content --> 

		        </div> <!-- .container -->

		    </div> <!-- .top-header -->

	    <?php } ?>

	    <div class="bottom-header">
	        
	        <div class="container">

            	<div class="site-branding">
            		
            		<?php business_kit_the_custom_logo(); ?>

                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

            		<?php
            		$description = get_bloginfo( 'description', 'display' );

                    if ( $description || is_customize_preview() ) : ?>

                        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>

                        <?php
                    endif; ?>
            	</div><!-- .site-branding -->

	            <div class="main-navigation-wrapper">
                    <div id="main-nav" class="clear-fix">
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <div class="wrap-menu-content">
                				<?php
                				wp_nav_menu(
                					array(
                					'theme_location' => 'primary',
                					'menu_id'        => 'primary-menu',
                					'fallback_cb'    => 'business_kit_primary_navigation_fallback',
                					)
                				);
                				?>
                            </div><!-- .menu-content -->
                        </nav><!-- #site-navigation -->
                    </div> <!-- #main-nav -->

	            </div> <!-- .main-navigation-wrapper -->

	        </div> <!-- .container -->

	    </div> <!-- .bottom-header -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">

		<?php get_template_part( 'template-parts/slider' ); ?>

		<?php get_template_part( 'template-parts/home-widgets' ); ?>

		<?php get_template_part( 'template-parts/banner' ); ?>

		<div class="container">
			<div class="inner-wrapper">