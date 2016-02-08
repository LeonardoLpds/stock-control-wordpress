<?php
/**
* Plugin Name: Stock Control
* Description: This plugin allows you to add a simple stock control to your WordPress website.
* Version: 0.0.1
* Author: Leonardo de Souza
*/

//Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require_once(plugin_dir_path(__FILE__).'stock-control-cpt.php');
require_once(plugin_dir_path(__FILE__).'stock-control-cf.php');
add_action('admin_enqueue_scripts', 'stock_control_enqueue_scripts');

function stock_control_enqueue_scripts() {
    //Varibales to target the post type and the post edit screen.
    global $pagenow, $typenow;

    if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && ($typenow == 'product' || $typenow == 'client' || $typenow == 'order') ) {
        //Plugin Main CSS File.
        wp_enqueue_style( 'stock-control-style-css', plugins_url( 'css/stock-control-style.css', __FILE__ ) );
        wp_enqueue_style('stock-control-bootstrap-css', plugins_url('css/bootstrap.min.css', __FILE__ ));
        wp_enqueue_script('bootstrap-scripts', plugins_url('/js/bootstrap.min.js', __FILE__));
        wp_enqueue_script('jaquery-mask-scripts', plugins_url('/js/jquery.maskedinput.min.js', __FILE__));
        wp_enqueue_script('stock-control-script', plugins_url('/js/stock-control-script.js', __FILE__));
    }
}