<?php

    function bok_widget_scripts(){
        wp_enqueue_style('widget-main-style',plugins_url(). '/bokwidget/assets/css/bokstyle.css');

        wp_enqueue_script('widget-main-script',plugins_url(). '/bokwidget/assets/js/bokscripts.js');

       // wp_enqueue_script('widget-main-script',plugins_url(). '/bokwidget/assets/js/ihs-javascript.js');

        wp_localize_script('widget-main-script', 'myVar', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));

    }

    add_action('wp_enqueue_scripts','bok_widget_scripts');



