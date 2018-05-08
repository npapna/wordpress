<?php $coinbar = get_theme_mod( 'coin_index_bar' );
if ( 1 == $coinbar ) {		?>

	<div id="cryptoindex" class="container-fluid">

			<?php if( is_active_sidebar( 'bitcoinee-crypto-market-index' ) ) : ?>
				<div id="cryptoindex-inner" class="container" role="complementary">
					<?php dynamic_sidebar( 'bitcoinee-crypto-market-index' ); ?>
				</div><!-- #primary-sidebar -->
			<?php endif; ?>
	</div>

		<?php
}
?>
