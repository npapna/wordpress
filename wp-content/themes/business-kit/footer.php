<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Kit
 */

?>		
			</div><!-- .inner-wrapper -->
		</div><!-- .container -->
	</div><!-- #content -->

<?php 

if ( is_active_sidebar( 'footer-1' ) ||
	 is_active_sidebar( 'footer-2' ) ||
	 is_active_sidebar( 'footer-3' ) ||
	 is_active_sidebar( 'footer-4' ) ) :
?>

	<aside id="footer-widgets" class="widget-area" role="complementary">
		<div class="container">
			<?php
				$column_count = 0;
				for ( $i = 1; $i <= 4; $i++ ) {
					if ( is_active_sidebar( 'footer-' . $i ) ) {
						$column_count++;
					}
				}
			 ?>
			<div class="inner-wrapper">
				<?php
				$column_class = 'widget-column footer-active-' . absint( $column_count );
				for ( $i = 1; $i <= 4 ; $i++ ) {
					if ( is_active_sidebar( 'footer-' . $i ) ) {
						?>
						<div class="<?php echo $column_class; ?>">
							<?php dynamic_sidebar( 'footer-' . $i ); ?>
						</div>
						<?php
					}
				}
				?>
			</div><!-- .inner-wrapper -->
		</div><!-- .container -->
	</aside><!-- #footer-widgets -->

<?php endif;

?>

	<footer id="colophon" class="site-footer">

	    <div class="container">
	    	
	    		<div class="copyright-wrapper">
	    			<?php 
	    			$copyright_text = business_kit_get_option( 'copyright_text' ); 

	    			if ( ! empty( $copyright_text ) ) : ?>

	    				<div class="copyright">

	    					<?php echo wp_kses_data( $copyright_text ); ?>

	    				</div> 

	    				<?php

	    			endif; ?>

	    			<div class="site-info">
	    				<?php printf( esc_html__( '%1$s by %2$s', 'business-kit' ), 'Business Kit', '<a href="https://preciousthemes.com" rel="designer">Precious Themes</a>' ); ?>
	    			</div>

	    		</div><!-- .copyright-wrapper -->

	    </div> <!-- .container -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<a href="#page" class="gotop" id="btn-gotop"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>

<?php wp_footer(); ?>

</body>
</html>