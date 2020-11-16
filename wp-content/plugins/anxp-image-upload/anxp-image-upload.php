<?php
/*
* Plugin Name: Anxp Image Upload
* Description: This plugin to upload image from frontend.
* Version:     1.0
* Author:      Altab Hossen
* Author URI:  https://altabhossen.com
* License:     GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: anxp
*/

defined( 'ABSPATH' ) or die( '¡Sin trampas!' );
date_default_timezone_set('America/New_York');
require plugin_dir_path( __FILE__ ) . 'public/add_image_ajax.php';
require_once( ABSPATH . 'wp-admin/includes/file.php' ); // require file.php

function anxp_custom_admin_styles() {
    wp_enqueue_style('anxp-styles', plugins_url('/css/styles.css', __FILE__ ));
    wp_enqueue_style('anxp-bootstrap', plugins_url('/css/bootstrap.min.css', __FILE__ ));
	}
add_action('admin_enqueue_scripts', 'anxp_custom_admin_styles');

#-----------------------------------------------------------------
# Adding Jquery in the theme for this plugin
#-----------------------------------------------------------------

// Register Jquery Scripts.
add_action( 'wp_enqueue_scripts', 'register_anxp_plugin_jquery' );

/**
 * Register style sheet.
 */
function register_anxp_plugin_jquery() {
	wp_enqueue_script( 'anxp-bootstrap', plugins_url( 'anxp-image-upload/js/bootstrap.min.js' ), array('jquery'), '4.1.1', true );
	wp_enqueue_script( 'scripts', plugins_url( 'anxp-image-upload/js/custom.js' ), array('jquery'), '1.0.0', true );
	// wp_localize_script for custom.js and use the jquery code in custom.js. And it will work for functions
	wp_localize_script( 'scripts', 'action_url_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

#-----------------------------------------------------------------
# Adding Styles in the theme for this plugin
#-----------------------------------------------------------------
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_anxp_plugin_styles' );

/**
 * Register style sheet.
 */
function register_anxp_plugin_styles() {
	global $post;
	wp_enqueue_style( 'anxp-bootstrap-style', plugins_url( 'anxp-image-upload/css/bootstrap.min.css' ) );	
	wp_enqueue_style( 'anxp-custom-style', plugins_url( 'anxp-image-upload/css/custom-style.css' ) );	
}

global $anxp_db_version;
$anxp_db_version = '1.1.0'; 


function anxp_install()
{
    global $wpdb;
    global $anxp_db_version;

    $table_name = $wpdb->prefix . 'imagepackages'; 


    $sql = "CREATE TABLE " . $table_name . " (
      id int(11) NOT NULL AUTO_INCREMENT,
      packagename VARCHAR(100) NOT NULL,
      packagephoto text NULL,
	  status int(11) NOT NULL,
      PRIMARY KEY  (id)
    );";


    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option('anxp_db_version', $anxp_db_version);

    $installed_ver = get_option('anxp_db_version');
    if ($installed_ver != $anxp_db_version) {
        $sql = "CREATE TABLE " . $table_name . " (
          id int(11) NOT NULL AUTO_INCREMENT,
          packagename VARCHAR(100) NOT NULL,
		  packagephoto text NULL,
		  status int(11) NOT NULL,
          PRIMARY KEY  (id)
        );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        update_option('anxp_db_version', $anxp_db_version);
    }
}

register_activation_hook(__FILE__, 'anxp_install');


function anxp_install_data()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'imagepackages'; 

}

register_activation_hook(__FILE__, 'anxp_install_data');


function anxp_update_db_check()
{
    global $anxp_db_version;
    if (get_site_option('anxp_db_version') != $anxp_db_version) {
        anxp_install();
    }
}

add_action('plugins_loaded', 'anxp_update_db_check');


/**
 * Deactivation hook.
 */
function anxp_deactivate() {
    // Unregister the post type, so the rules are no longer in memory.
    // unregister_post_type( 'book' );
    // Clear the permalinks to remove our post type's rules from the database.
        global $wpdb;
        $table_name = $wpdb->prefix . 'imagepackages';
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'anxp_deactivate' );

function anxp_add_image_ajax() {
	add_filter( 'upload_dir', 'anxp_upload_dir' );	
    global $wpdb;
	$tablename = $wpdb->prefix . 'imagepackages';
	
	$uploadedfile = $_FILES['packagephoto_name'];
	$uploadedfile2 = $_FILES['packagephoto2_name'];
	$packagephoto_name = $_FILES["packagephoto_name"]["name"];
	$packagephoto2_name = $_FILES["packagephoto2_name"]["name"];
    $upload_overrides = array( 
        'test_form' => false, /* this was in your existing override array */
        'unique_filename_callback' => 'anxp_packagephoto_filename' // Function for image rename
    );
	$upload_overrides2 = array( 
        'test_form' => false, /* this was in your existing override array */
        'unique_filename_callback' => 'anxp_packagephoto2_filename' // Function for image rename
    );
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    $movefile2 = wp_handle_upload($uploadedfile2, $upload_overrides2);
	if ($movefile && !isset($movefile['error'])) {
    $data = array( 
    'packagename' => $_POST['packagename'],
    'packagephoto' => anxp_packagephoto_filename('', $packagephoto_name, ''),
    'status' => 0 );

    // FOR database SQL injection security, set up the formats
    $formats = array( 
        '%s', // packagename should be an string
        '%s', // packagephoto should be a integer
        '%d'  // status should be an integer 
    ); 
    // Actually attempt to insert the data
    $insert = $wpdb->insert($tablename, $data, $formats);
	if($insert){
    echo "<span class='text-success'>The image has been added succefully</span>";
	}else{
	echo "<span class='text-danger'>The image not added succefully</span>";	
	}
	}else{
		echo "<span class='text-danger'>Image Not Upload</span>";
	}
	remove_filter( 'upload_dir', 'anxp_upload_dir' );
}
add_action( 'wp_ajax_anxp_add_image_ajax', 'anxp_add_image_ajax' );    // If called from admin panel
add_action( 'wp_ajax_nopriv_anxp_add_image_ajax', 'anxp_add_image_ajax' );


function anxp_packagephoto_filename($dir, $filename, $ext){
    $newfilename =  time() . '1_'. $filename;
    return $newfilename;
}

function anxp_packagephoto2_filename($dir, $filename, $ext){
    $newfilename =  time() . '2_'. $filename;
    return $newfilename;
}

function anxp_upload_dir( $dirs ) { 
$user = wp_get_current_user(); 
$dirs['subdir'] = ''; 
$dirs['path'] = $dirs['basedir'].''; 
$dirs['url'] = $dirs['baseurl'].''; 
return $dirs; 
}
