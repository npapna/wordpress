<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bitcoinee
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bitcoinee' ); ?></a>

	<header id="masthead" class="site-header container-fluid">
		<div class="headerwrap container-fluid">
			
		<div class="site-branding container">
			
		<?php if ( function_exists( 'the_custom_logo' ) && ( has_custom_logo() ) ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php the_custom_logo();?></a>
		<?php } else { ?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	
		<?php } ?>
		
		</div><!-- .site-branding -->
		
		<nav id="site-navigation" class="main-navigation container navbar navbar-expand-lg">
			<button type="button" class="navbar-toggle" aria-controls="navbar-content" aria-expanded="false" aria-label="<?php esc_html_e( 'Toggle Navigation', 'bitcoinee' ); ?>" data-toggle="collapse" data-target="#bitcoineeNavbar"><?php esc_html_e( 'Open Menu', 'bitcoinee' ); ?></button>
			
			<div class="collapse navbar-collapse" id="bitcoineeNavbar">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'depth'          => 2,
					'menu_class'     => 'navbar-nav ml-auto',
					'walker'         => new Bootstrap_NavWalker(),
					'fallback_cb'    => 'Bootstrap_NavWalker::fallback',
				) );
				?>

			</div>
			
		</nav><!-- #site-navigation -->
		
		</div><!-- /.headerwrap -->

		<?php get_template_part( 'template-parts/slider' ); ?>

	</header><!-- #masthead -->
	
	<?php get_template_part( 'template-parts/coin-index' ); ?>

	<div id="content" class="site-content container">
	<?php $bitcoinee_breakingnews_toggle = get_theme_mod( 'bitcoinee_breaking_news' );
if ( ! empty( $bitcoinee_breakingnews_toggle ) ) {
		if ( is_home() || is_front_page() ) {
				echo "<div class='posts-heading row'><h3 class='col-lg-2 col-md-3 col-sm-12 col-xs-12'>" . esc_html__( 'Breaking News', 'bitcoinee' ) . "</h3>"; ?>
					<div class="breakingnews-list col-lg-10 col-md-9 col-sm-12 col-xs-12">
					<?php
					// WP_Query arguments
					$args = array(
						'post_type'     => array( 'post' ),
						'post_status'   => array( 'publish' ),
						'tag'			=> array( 'breakingnews' ),
						'orderby'		=> 'date',
						'no_found_rows' => true,
						'update_post_meta_cache' => false,
						'update_post_term_cache' => false,
						'fields'				=> 'ids',
					);

					// The Query
					$breakingnews = new WP_Query( $args );

					// The Loop
					if ( $breakingnews->have_posts() ) { 
						while ( $breakingnews->have_posts() ) {
							$breakingnews->the_post(); ?>
							<a class="breaking-title" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<?php } 
					} else {
						echo '<p>'.esc_html__( 'Posts with tagged "breakingnews" will show up here!', 'bitcoinee' ).'</p>';
					}

					// Restore original Post Data
					wp_reset_postdata(); ?>

					<?php echo "</div></div>"; // end .posts-heading
} } ?>
		<div class="row">
