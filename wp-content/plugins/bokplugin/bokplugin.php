<?php
/**
 * @package BokPlugin
 */
/*
Plugin Name: Bok Plugin
Plugin URI: https://bok.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: activate the Akismet plugin and then go to your Akismet Settings page to set up your API key.
Version: 1.0
Author: Bok Pogi
Author URI: https://bok.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: bokpogitextdomain
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2018 Automattic, Inc.
*/

use Inc\Base\Activate;
use Inc\Base\Deactivate;


defined('ABSPATH') or die('Hey what you are doing silly');

if( file_exists( dirname(__FILE__) . '/vendor/autoload.php') ){
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

function activate_bok_plugin(){
    Activate::activate();
}
register_activation_hook(__FILE__, 'activate_bok_plugin');

function deactivate_bok_plugin(){
    Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_bok_plugin');

if ( class_exists( 'Inc\\Init' )){

    Inc\Init::register_services();
}











