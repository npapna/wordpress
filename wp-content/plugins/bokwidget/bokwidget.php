<?php

/*
Plugin Name: Bok Widget
Plugin URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
Description: This plugin adds a custom widget.
Version: 1.0
Author: Nelson Papna
Author URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
License: GPL2
*/

if(!defined('ABSPATH')){
    exit;
}

require_once (plugin_dir_path(__FILE__).'/includes/bokwidget-scripts.php');
require_once (plugin_dir_path(__FILE__).'/includes/BokController.php');
require_once (plugin_dir_path(__FILE__).'/includes/PostController.php');

/**
 *init  get function my widget
 */

add_action( 'widgets_init', function(){
    register_widget( 'My_Widget' );
});

add_action('wp_ajax_my_ajax_hook', 'do_something');