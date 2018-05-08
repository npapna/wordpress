<?php
/**
 * Template for displaying search forms in Business Kit
 *
 * @package WordPress
 * @subpackage Business_Kit
 * @since Business Kit 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'business-kit' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'business-kit' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'business-kit' ); ?></span><i class="fa fa-search" aria-hidden="true"></i></button>
</form>
