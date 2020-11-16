<?php
/**
 * Bootstraps the Theme.
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;


use AQUILA_THEME\Inc\Traits\Singleton;

class AQUILA_THEME {
    use Singleton;
    protected function __construct() {
        // Load Class.
        $this->setup_hooks();
        Assets::get_instance();
        Meta_Boxes::get_instance();
        Menus::get_instance();
        Sidebars::get_instance();
        Functions::get_instance();
    }

    protected function setup_hooks(){
        // actions and filters
        add_action('after_setup_theme', [$this, 'setup_theme']) ;       
        
    }
    public function setup_theme() {
        add_theme_support('title-tag');
        add_theme_support( 'post-thumbnails' );        
        add_image_size( 'featured-thumbnail',350,233, true );
        add_theme_support('custom-logo',[
            'header-text' => ['site-title', 'site-description'],
            'height' => 100,
            'width' => 400,
            'flex-height' => true,
            'flex-width' => true,
            'class-name' => 'its-nagendraclass'
        ]);
        add_theme_support( 'custom-background', [
            'default-color' => '#fff',
            'default-image' => get_template_directory_uri(). '/assets/images/visual.jpg',
        ]);
    }
    
}