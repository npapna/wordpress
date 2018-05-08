<?php
/**
 * @package BokPlugin
 */

namespace Inc\Base;
use Inc\Base\BaseController;

class Enqueue extends BaseController{


    function register()
    {
        // wp_enqueue_scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        wp_enqueue_style('mypluginstyle', $this->plugin_url.'assets/mystyles.css', __FILE__);
        wp_enqueue_script('mypluginscript', $this->plugin_url.'assets/myscript.js', __FILE__);
    }


}