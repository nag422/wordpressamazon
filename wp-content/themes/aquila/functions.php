<?php
/**
 * Theme Functions.
 * 
 * @package Aquila
*/

// echo '<pre>';
// print_r( filemtime( get_template_directory() .'/style.css') );
// wp_die();

if(! defined( 'AQUILA_DIR_PATH' )) {
    define( 'AQUILA_DIR_PATH', untrailingslashit( get_template_directory()));
}

if(! defined( 'AQUILA_DIR_URI' )) {
    define( 'AQUILA_DIR_URI', untrailingslashit( get_template_directory_uri()));
}

require_once AQUILA_DIR_PATH .'/inc/helpers/autoloader.php';
require_once AQUILA_DIR_PATH .'/inc/helpers/template-tags.php';
function aquila_get_theme_instance(){
    \AQUILA_THEME\Inc\AQUILA_THEME::get_instance();
}
aquila_get_theme_instance();


function aquila_enqueue_scripts() {

    // Register Styles.
    
    
    
    // Register Scripts.
   
    
    // Enqueue Styles
   

    // Enqueue Scripts
   
   

}
add_action( 'wp_enqueue_scripts', 'aquila_enqueue_scripts' );

 
trait Singleton {
    public static function get_instance(){
        static $instance = [];

        $called_class = get_called_class();
        if (! isset($instance[$called_class])) {
            // echo "Pease Wait";
            $instance[$called_class] = new $called_class;
        } 
        return $instance[$called_class];
    }
}
class User {
    use Singleton;
    public function __construct() {
        // echo 'Loading...';
    }
   
}
$user_one=User::get_instance();
$user_two=User::get_instance();


function slug_add_data_c($response, $post) {
    $id = $post->ID;
    $response->data['latitud'] = $id;

    return $response;
}
add_filter('rest_prepare_books', 'slug_add_data_c', 10, 3);


// $object_type = 'post';
// $meta_args = array( // Validate and sanitize the meta value.
//     // Note: currently (4.7) one of 'string', 'boolean', 'integer',
//     // 'number' must be used as 'type'. The default is 'string'.
//     'type'         => 'string',
//     // Shown in the schema for the meta key.
//     'description'  => 'some description',
//     // Return a single value of the type.
//     'single'       => true,
//     // Show in the WP REST API response. Default: false.
//     'show_in_rest' => true,
// );
// register_meta( $object_type, 'post_author', $meta_args );