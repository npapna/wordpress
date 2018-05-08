<?php
/**
 * Created by PhpStorm.
 * User: npapna
 * Date: 4/13/2018
 * Time: 5:34 PM
 */
function seconddb(){
    global $seconddb;
    $seconddb = new wpdb('root', '', 'blog', 'localhost');
}

add_action('init', 'seconddb');