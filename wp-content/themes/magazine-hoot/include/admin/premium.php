<?php
/**
 * Premium Theme Options displayed in admin
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 * @return array Return Hoot Options array to be merged to the original Options array
 */

$maghoot_options_premium = array();
$imagepath =  HYBRIDEXTEND_INCURI . 'admin/images/';
$maghoot_cta_top = '<a class="button button-primary button-buy-premium" href="https://wphoot.com/themes/magazine-hoot/" target="_blank">' . __( 'Click here to know more', 'magazine-hoot' ) . '</a>';
$maghoot_cta_top = $maghoot_cta = '<a class="button button-primary button-buy-premium" href="https://wphoot.com/themes/magazine-hoot/" target="_blank">' . __( 'Buy Magazine Hoot Premium', 'magazine-hoot' ) . '</a>';
$maghoot_cta_demo = '<a class="button button-secondary button-view-demo" href="https://demo.wphoot.com/magazine-hoot/" target="_blank">' . __( 'View Demo Site', 'magazine-hoot' ) . '</a>';
$maghoot_cta_url = 'https://wphoot.com/themes/magazine-hoot/';
$maghoot_cta_demo_url = 'https://demo.wphoot.com/magazine-hoot/';

$maghoot_intro = array(
	'name' => __('Upgrade to <span>Magazine Hoot <strong>Premium</strong></span>', 'magazine-hoot'),
	'desc' => __("If you've enjoyed using Magazine Hoot, you're going to love <strong>Magazine Hoot Premium</strong>.<br>It's a robust upgrade to Magazine Hoot that gives you many useful features.", 'magazine-hoot'),
	);

$maghoot_options_premium[] = array(
	'name' => __('Complete <br />Style <strong>Customization</strong>', 'magazine-hoot'),
	'desc' => __('Different looks and styles. Choose from an extensive range of customization features in Magazine Hoot Premium to setup your own unique front page. Give youe site the personality it deserves.', 'magazine-hoot'),
	// 'img' => $imagepath . 'premium-style.jpg',
	'style' => 'hero-top',
	);

$maghoot_options_premium[] = array(
	'name' => __('Unlimited Colors', 'magazine-hoot'),
	'desc' => __('Magazine Hoot Premium lets you select unlimited colors for different sections of your site. Select pre-existing backgrounds for site sections like header, footer etc. or upload your own background images/patterns.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-colors.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Fonts and <span>Typography Control</span>', 'magazine-hoot'),
	'desc' => __('Assign different typography (fonts, text size, font color) to menu, topbar, logo, content headings, sidebar, footer etc.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-typography.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Unlimites Sliders, Unlimites Slides', 'magazine-hoot'),
	'desc' => __('Magazine Hoot Premium allows you to create unlimited sliders with as many slides as you need.<hr>You can use these sliders on your Frontpage, or add them anywhere using shortcodes - like in your Posts, Sidebars or Footer.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-sliders.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('600+ Google Fonts', 'magazine-hoot'),
	'desc' => __("With the integrated Google Fonts library, you can find the fonts that match your site's personality, and there's over 600 options to choose from.", 'magazine-hoot'),
	'img' => $imagepath . 'premium-googlefonts.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Shortcodes with <span>Easy Generator</span>', 'magazine-hoot'),
	'desc' => __('Enjoy the flexibility of using shortcodes throughout your site with Magazine Hoot premium. These shortcodes were specially designed for this theme and are very well integrated into the code to reduce loading times, thereby maximizing performance!<hr>Use shortcodes to insert buttons, sliders, tabs, toggles, columns, breaks, icons, lists, and a lot more design and layout modules.<hr>The intuitive Shortcode Generator has been built right into the Edit screen, so you dont have to hunt for shortcode syntax.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-shortcodes.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Image Carousels', 'magazine-hoot'),
	'desc' => __('Add carousels to your post, in your sidebar, on your frontpage or in your footer. A simple drag and drop interface allows you to easily create and manage carousels.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-carousels.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __("Floating <br /><span>'Sticky' Header</span> &amp; <span>'Goto Top'</span> button (optional)", 'magazine-hoot'),
	'desc' => __("The floating header follows the user down your page as they scroll, which means they never have to scroll back up to access your navigation menu, improving user experience.<hr>Or, use the 'Goto Top' button appears on the screen when users scroll down your page, giving them a quick way to go back to the top of the page.", 'magazine-hoot'),
	'img' => $imagepath . 'premium-header-top.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('One Page <span>Scrolling Website /</span> <span>Landing Page</span>', 'magazine-hoot'),
	'desc' => __("Make One Page websites with menu items linking to different sections on the page. Watch the scroll animation kick in when a user clicks a menu item to jump to a page section.<hr>Create different landing pages on your site. Change the menu for each page so that the menu items point to sections of the page being displayed.", 'magazine-hoot'),
	'img' => $imagepath . 'premium-scroller.jpg',
	'style' => 'side',
	);

$maghoot_options_premium[] = array(
	'name' => __('3 Blog Layouts (including pinterest <span>type mosaic)</span>', 'magazine-hoot'),
	'desc' => __('Magazine Hoot Premium gives you the option to display your post archives in 3 different layouts including a mosaic type layout similar to pinterest.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-blogstyles.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Custom Widgets', 'magazine-hoot'),
	'desc' => __('Custom widgets crafted and designed specifically for Magazine Hoot Premium Theme to give you the flexibility of adding stylized content.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-widgets.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Menu Icons', 'magazine-hoot'),
	'desc' => __('Select from over 500 icons for your main navigation menu links.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-menuicons.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Premium Background Patterns (CC0)', 'magazine-hoot'),
	'desc' => __('Magazine Hoot Premium comes with many additional premium background patterns. You can always upload your own background image/pattern to match your site design.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-backgrounds.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Automatic Image Lightbox and <span>WordPress Gallery</span>', 'magazine-hoot'),
	'desc' => __('Automatically open image links on your site with the integrates lightbox in Magazine Hoot Premium.<hr>Automatically convert standard WordPress galleries to beautiful lightbox gallery slider.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-lightbox.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Developers <br />love {LESS}', 'magazine-hoot'),
	'desc' => __('CSS is passe. Developers love the modularity and ease of using LESS, which is why Magazine Hoot Premium comes with properly organized LESS files for the main stylesheet.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-lesscss.jpg',
	);

$maghoot_options_premium[] = array(
	'name' => __('Easy Import/Export', 'magazine-hoot'),
	'desc' => __('Moving to a new host? Or applying a new child theme? Easily import/export your customizer settings with just a few clicks - right from the backend.', 'magazine-hoot'),
	'img' => $imagepath . 'premium-import-export.jpg',
	);

$maghoot_options_premium[] = array(
	'style' => 'aside',
	'blocks' => array(
		array(
			'name' => __('Custom Javascript &amp; <span>Google Analytics</span>', 'magazine-hoot'),
			'desc' => __("Easily insert any javascript snippet to your header without modifying the code files. This helps in adding scripts for Google Analytics, Adsense or any other custom code.", 'magazine-hoot'),
			'img' => $imagepath . 'premium-customjs.jpg',
			),
		array(
			'name' => __('Continued <br />Updates', 'magazine-hoot'),
			'desc' => __("You will help support the continued development of Magazine Hoot - ensuring it works with future versions of WordPress for years to come.", 'magazine-hoot'),
			'img' => $imagepath . 'premium-updates.jpg',
			),
		),
	);

$maghoot_options_premium[] = array(
	'name' => __('Premium <br />Priority Support', 'magazine-hoot'),
	'desc' => __("Need help setting up Magazine Hoot? Upgrading to Magazine Hoot Premium gives you prioritized support. We have a growing support team ready to help you with your questions.<hr>Need small modifications? If you are not a developer yourself, you can count on our support staff to help you with CSS snippets to get the look you're after.", 'magazine-hoot'),
	'img' => $imagepath . 'premium-support.jpg',
	);