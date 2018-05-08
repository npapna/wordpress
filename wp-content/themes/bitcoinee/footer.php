<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bitcoinee
 */

?>
		</div>
	</div><!-- #content -->
	
	<div class="footerwrap container-fluid">
	<footer id="colophon" class="site-footer container">
		<aside id="footer-widgets" class="row footer-widget-area">
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</aside><!-- #footer-widgets -->

		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bitcoinee' ) ); ?>"><?php
				printf( esc_html__( 'Proudly powered by %s', 'bitcoinee' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				$footer_credit_text = get_theme_mod( 'footer_credit_text', 'Kadesthemes.com' );
				$footer_credit_text_url = get_theme_mod( 'footer_credit_text_link', 'https://kadesthemes.com' );
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( '%1$s by %2$s.', 'bitcoinee' ), 'bitcoinee', '<a target="_blank" href="' . esc_url( $footer_credit_text_url ) . '">' . esc_html( $footer_credit_text ) . '</a>' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div>
</div><!-- #page -->

<?php if ( false === wp_is_mobile() ) { ?>
	<a href="#" id="gotop" title="<?php esc_attr_e( 'Back to top', 'bitcoinee' ); ?>"><i class="cf cf-ardr"></i></a>	
<?php } ?>	

<?php wp_footer(); ?>
</body>
</html>
