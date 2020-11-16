<?php
/**
 * Enqueue theme assets
 * @package Aquila
 */

namespace Aquila_Theme\Inc;

use Singleton;

class Assets{
    use Singleton;

    protected function __construct() {
        // load class.
        
        $this->setup_hooks();

    }
    protected function setup_hooks () {
        add_action('wp_enqueue_scripts',[ $this, 'register_styles' ]);
        add_action('wp_enqueue_scripts',[ $this, 'register_scripts' ]);
        
    }
    public function register_styles(){

        wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css' ), 'all');   

        wp_register_style( 'bootstrapcss', get_template_directory_uri() . '/src/assets/css/bootstrap.min.css', [], false, 'all' );
        wp_register_style( 'slickcss', get_template_directory_uri() . '/src/assets/slick/slick.css', [], false, 'all' );
        wp_register_style( 'slickthmecss', get_template_directory_uri() . '/src/assets/slick/slick-theme.css', [], false, 'all' );
        wp_enqueue_style( 'style-css' );
        wp_enqueue_style( 'bootstrapcss' );   
        wp_enqueue_style( 'slickcss' ); 
        wp_enqueue_style( 'slickthmecss' ); 

    }
    public function register_scripts(){
        wp_register_script( 'appjs', get_template_directory_uri() . '/src/assets/js/app.js', [ 'jquery' ], false, true);
        wp_register_script( 'mainjs', get_template_directory_uri() . '/src/assets/js/main.js', [ ], false, true);
        wp_register_script( 'slickjs', get_template_directory_uri() . '/src/assets/slick/slick.js', [ ], false, true);
        wp_register_script( 'slickinit', get_template_directory_uri() . '/src/assets/slick/slickinit.js', [ ], false, true);
        wp_enqueue_script( 'appjs' );
        wp_enqueue_script( 'mainjs' );
        wp_enqueue_script( 'slickjs' );
        wp_enqueue_script( 'slickinit' );
        
    }
}