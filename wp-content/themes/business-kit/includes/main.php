<?php
/**
 * Load files.
 *
 * @package Business_Kit
 */

// Customizer additions.
require_once trailingslashit( get_template_directory() ) . '/includes/customizer/customizer.php';

// Load core functions.
require_once trailingslashit( get_template_directory() ) . '/includes/customizer/core.php';

// Load helper functions.
require_once trailingslashit( get_template_directory() ) . '/includes/helpers.php';

// Custom template tags for this theme.
require_once trailingslashit( get_template_directory() ) . '/includes/template-tags.php';

// Custom header for this theme.
require_once trailingslashit( get_template_directory() ) . '/includes/custom-header.php';

// Custom functions that act independently of the theme templates.
require_once trailingslashit( get_template_directory() ) . '/includes/extras.php';

// Load widgets.
require_once trailingslashit( get_template_directory() ) . '/includes/widgets/widgets.php';

//TGM Plugin activation.
require_once trailingslashit( get_template_directory() ) . '/includes/tgm/class-tgm-plugin-activation.php';

if ( is_admin() ) {
	// Load about.
	require_once trailingslashit( get_template_directory() ) . 'includes/theme-info/class-about.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/theme-info/about.php';

	// Load demo.
	require_once trailingslashit( get_template_directory() ) . 'includes/demo/class-demo.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/demo/demo.php';
}