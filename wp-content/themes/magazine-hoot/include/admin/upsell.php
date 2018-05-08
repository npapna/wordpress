<?php
/**
 * Upsell page
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/** Determine whether to load upsell subpage **/
$premium_features_file = HYBRIDEXTEND_INC . 'admin/premium.php';
$maghoot_load_upsell_subpage = apply_filters( 'maghoot_load_upsell_subpage', file_exists( $premium_features_file ) );
if ( !$maghoot_load_upsell_subpage )
	return;

/* Add the admin setup function to the 'admin_menu' hook. */
add_action( 'admin_menu', 'maghoot_appearance_subpage' );

/**
 * Unload the upsell section
 *
 * @since 1.2
 * @access public
 * @return void
 */
function maghoot_unload_upsell_section( $val ) {
	return false;
}
add_filter( 'maghoot_customize_load_premiumsection', 'maghoot_unload_upsell_section' );

/**
 * Sets up the Appearance Subpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_appearance_subpage() {

	add_theme_page(
		__( 'Magazine Hoot Premium', 'magazine-hoot' ),	// Page Title
		__( 'Premium Options', 'magazine-hoot' ),	// Menu Title
		'edit_theme_options',					// capability
		'magazine-hoot-premium',						// menu-slug
		'maghoot_theme_appearance_subpage'			// function name
		);

	add_action( 'admin_enqueue_scripts', 'maghoot_admin_enqueue_upsell_styles' );

}

/**
 * Enqueue CSS
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_admin_enqueue_upsell_styles( $hook ) {
	if ( $hook == 'appearance_page_magazine-hoot-premium' )
		wp_enqueue_style( 'maghoot-admin-upsell', HYBRIDEXTEND_INCURI . 'admin/css/upsell.css', array(),  HYBRIDEXTEND_VERSION );
}

/**
 * Display the Appearance Subpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_theme_appearance_subpage() {
	/** Load Premium Features Data **/
	include( HYBRIDEXTEND_INC . 'admin/premium.php' );

	/** Display Premium Teasers **/
	$maghoot_cta = ( empty( $maghoot_cta ) ) ? '<a class="button button-primary button-buy-premium" href="https://wphoot.com/" target="_blank">' . __( 'Click here', 'magazine-hoot' ) . '</a>' : $maghoot_cta;
	$maghoot_cta_top = ( empty( $maghoot_cta_top ) ) ? $maghoot_cta : $maghoot_cta_top;
	$maghoot_intro = ( !empty( $maghoot_intro ) && is_array( $maghoot_intro ) ) ? $maghoot_intro : array();
	$maghoot_intro = wp_parse_args( $maghoot_intro, array(
		'name' => __('Upgrade to Premium', 'magazine-hoot'),
		'desc' => '',
		) );
	?>
	<div id="maghoot-upsell" class="wrap">
		<h1 class="centered"><?php echo $maghoot_intro['name']; ?></h1>
		<p class="maghoot-upsell-intro centered"><?php echo $maghoot_intro['desc']; ?></p>
		<p class="maghoot-upsell-cta centered"><?php if ( !empty( $maghoot_cta_demo ) ) echo $maghoot_cta_demo; echo $maghoot_cta_top; ?></p>
		<?php if ( !empty( $maghoot_options_premium ) && is_array( $maghoot_options_premium ) ): ?>
			<div class="maghoot-upsell-sub">
				<?php foreach ( $maghoot_options_premium as $key => $feature ) : ?>
					<?php $style = empty( $feature['style'] ) ? 'info' : $feature['style']; ?>
					<div class="section-premium <?php
						if ( $style == 'hero-top' || $style == 'hero-bottom' ) echo "premium-hero premium-{$style}";
						elseif ( $style == 'side' ) echo 'premium-sideinfo';
						elseif ( $style == 'aside' ) echo 'premium-asideinfo';
						else echo "premium-{$style}";
						?>">

						<?php if ( $style == 'hero-top' || $style == 'hero-bottom' ) : ?>
							<?php if ( $style == 'hero-top' ) : ?>
								<h4 class="heading"><?php echo $feature['name']; ?></h4>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-hero-text">' . $feature['desc'] . '</div>'; ?>
							<?php endif; ?>
							<?php if ( !empty( $feature['img'] ) ) : ?>
								<div class="premium-hero-img">
									<img src="<?php echo esc_url( $feature['img'] ); ?>" />
								</div>
							<?php endif; ?>
							<?php if ( $style == 'hero-bottom' ) : ?>
								<h4 class="heading"><?php echo $feature['name']; ?></h4>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-hero-text">' . $feature['desc'] . '</div>'; ?>
							<?php endif; ?>

						<?php elseif ( $style == 'side' ) : ?>
							<div class="premium-side-wrap">
								<div class="premium-side-img">
									<img src="<?php echo esc_url( $feature['img'] ); ?>" />
								</div>
								<div class="premium-side-textblock">
									<?php if ( !empty( $feature['name'] ) ) : ?>
										<h4 class="heading"><?php echo $feature['name']; ?></h4>
									<?php endif; ?>
									<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-side-text">' . $feature['desc'] . '</div>'; ?>
								</div>
								<div class="clear"></div>
							</div>

						<?php elseif ( $style == 'aside' ) : ?>
							<?php if ( !empty( $feature['blocks'] ) ) : ?>
								<div class="premium-aside-wrap">
								<?php foreach ( $feature['blocks'] as $key => $block ) {
									echo '<div class="premium-aside-block premium-aside-'.($key+1).'">';
										if ( !empty( $block['img'] ) ) : ?>
											<div class="premium-aside-img">
												<img src="<?php echo esc_url( $block['img'] ); ?>" />
											</div>
										<?php endif;
										if ( !empty( $block['name'] ) ) : ?>
											<h4 class="heading"><?php echo $block['name']; ?></h4>
										<?php endif;
										if ( !empty( $block['desc'] ) ) echo '<div class="premium-aside-text">' . $block['desc'] . '</div>';
									echo '</div>';
								} ?>
								<div class="clear"></div>
								</div>
							<?php endif; ?>

						<?php else : ?>
							<?php if ( !empty( $feature['img'] ) ) : ?>
								<div class="premium-info-img">
									<img src="<?php echo esc_url( $feature['img'] ); ?>" />
								</div>
							<?php endif; ?>
							<div class="premium-info-textblock">
								<?php if ( !empty( $feature['name'] ) ) : ?>
									<div class="premium-info-heading"><h4 class="heading"><?php echo $feature['name']; ?></h4></div>
								<?php endif; ?>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-info-text">' . $feature['desc'] . '</div>'; ?>
								<div class="clear"></div>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				<div class="section-premium maghoot-upsell-cta centered"><?php if ( !empty( $maghoot_cta_demo ) ) echo $maghoot_cta_demo; echo $maghoot_cta; ?></p>
			</div>
		<?php endif; ?>
		<a class="maghoot-premium-top" href="#wpbody"><span class="dashicons dashicons-arrow-up-alt"></span></a>
	</div>
	<?php
}