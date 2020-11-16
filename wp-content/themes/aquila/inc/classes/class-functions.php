<?php
/**
 * Enqueue theme funtions php
 * @package Aquila
 */

namespace Aquila_Theme\Inc;

use Singleton;

class Functions{
    use Singleton;

    protected function __construct() {
        // load class.
        
        $this->setup_hooks();

    }
    protected function setup_hooks () {
        add_action('wp_logout',[ $this, 'redirect_to_custom_login_page' ]);
        // add_action('init',[ $this, 'fn_redirect_wp_admin' ]);
        
        
    }
    public function redirect_to_custom_login_page(){        
        wp_redirect(site_url() . "/login");
        exit();
    }

    public function fn_redirect_wp_admin() {
        global $pagenow;
        if ($pagenow == "wp-login.php" && $_GET['action'] == "logout") {
            wp_redirect(home_url(). "/login");
            exit();
        }
    }

    
      

    

    

    
}