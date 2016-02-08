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