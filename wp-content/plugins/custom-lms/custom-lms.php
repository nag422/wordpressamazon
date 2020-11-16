<?php
/*
* Plugin Name: Custom Lms
* Description: This plugin to lms.
* Version:     1.0
* Author:      Nagendra Kumar
* Author URI:  https://altabhossen.com
* License:     GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: nagendra
*/

defined( 'ABSPATH' ) or die;


/**
 * Register a custom post type called "Course".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_Course_init() {
    $labels = array(
        'name'                  => _x( 'Courses', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Course', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Courses', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Course', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Course', 'textdomain' ),
        'new_item'              => __( 'New Course', 'textdomain' ),
        'edit_item'             => __( 'Edit Course', 'textdomain' ),
        'view_item'             => __( 'View Course', 'textdomain' ),
        'all_items'             => __( 'All Courses', 'textdomain' ),
        'search_items'          => __( 'Search Courses', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Courses:', 'textdomain' ),
        'not_found'             => __( 'No Courses found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Courses found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Course Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Course archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Course', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Course', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Courses list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Courses list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Courses list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'description'        => 'Course custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Course' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        // 'taxonomies'         => array('category', 'post_tag'),
        'show_in_rest'       => false
    );
 
    register_post_type( 'course', $args );
}
 
add_action( 'init', 'wpdocs_codex_Course_init' );

// custom lms

function wporg_register_taxonomy_course() {
    unset($labels);
    unset($args);
    $labels = array(
        'name'              => _x( 'Modules', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Module', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Modules', 'textdomain' ),
        'all_items'         => __( 'All Modules', 'textdomain' ),
        'parent_item'       => __( 'Parent Module', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Module', 'textdomain' ),
        'edit_item'         => __( 'Edit Module', 'textdomain' ),
        'update_item'       => __( 'Update Module', 'textdomain' ),
        'add_new_item'      => __( 'Add New Module', 'textdomain' ),
        'new_item_name'     => __( 'New Module Name', 'textdomain' ),
        'menu_name'         => __( 'Course Module', 'textdomain' ),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'module' ],
    );
    register_taxonomy( 'Module', [ 'course' ], $args );
}
add_action( 'init', 'wporg_register_taxonomy_course' );