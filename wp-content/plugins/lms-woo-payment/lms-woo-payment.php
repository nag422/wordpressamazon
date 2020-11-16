<?php 
/**
 * Plugin Name: lms woo payment
 * Plugin URI: https://durvani.com
 * Author: Durvani
 * Author URI: https://durvani.com
 * Description: learn press WooCommerce Payment Integration
 * Version: 1.0
 */


//  If this file is called Directly, abort.

if (!defined( 'WPINC') ){
    die;
}
if (!defined( 'LMS_PLUGIN_VERSION')) {
    define( 'LMS_PLUGIN_VERSION', '1.0.0');
}
if (!defined( 'LMS_PLUGIN_DIR')) {
    define( 'LMS_PLUGIN_DIR', plugin_dir_url( __FILE__));
}
if( !function_exists( 'lms_my_plugin_scripts')) {
    function lms_my_plugin_scripts() {
        wp_enqueue_style('lms-css',LMS_PLUGIN_DIR. 'assets/css/cssstyle.js' );
        wp_enqueue_script('lms-js',LMS_PLUGIN_DIR. 'assets/js/jsmain.js', 'jQuery', '1.0.0', true );

    }
    
        add_action('wp_enqueue_scripts', 'lms_my_plugin_scripts');
        
    
}
function lms_settings_page_html() {
echo "hello";
}
function lms_register_menu_page() {
    add_menu_page(
        'Lms woo payment',
        'lms Settings',
        'manage_options',
        'lms-settings',
        'lms_settings_page_html',
        'dashicons-thumbs-up',
        30
    );
    
    
}
add_action('admin_menu','lms_register_menu_page');

 
?>