<?php
/**
 * Plugin Name: [Plugin Name]
 * Description: [Plugin Description]
 * Version: [Version number]
 * Author: [Author Name]
 * Text Domain: [Text Domain]
 */

require_once('security.php');

 class App {
    public function __construct() {
        add_action('init', array($this, 'create_custom_post_type'));
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));

        // rename the shortcode
        add_shortcode('render_app', array($this, 'render_app'));
    }

    public function create_custom_post_type() {
        $args = array(
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'labels'  => array(
                'name' => 'Product Forms',
                'singular_name' => 'Product Form',
                'add_new' => 'Add Product Form',
                'add_new_item' => 'Add New Product Form',
                'edit_item' => 'Edit Product Form',
                'new_item' => 'New Product Form',
                'view_item' => 'View Product Form',
                'search_items' => 'Search Product Forms',
                'not_found' => 'No Product Forms Found',
                'not_found_in_trash' => 'No Product Forms Found in Trash',
                'parent_item_colon' => 'Parent Product Form'
            ),
            'menu_icon' => 'dashicons-coffee',
            'supports' => array('title', 'editor', 'author'),
            'publicly_queryable' => false,
            'capability' => 'manage_options',
        );

        // register should be the same with the shortcode name [render_app]
        register_post_type('render_app', $args);
    }

    public function load_assets() {
        wp_enqueue_script('custom-jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array('jquery'), '3.6.0', true);
        wp_enqueue_style('custom-css', plugin_dir_url(__FILE__) . 'css/custom.css', array(), '1.0.0', 'all');
        wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.css', array(), '5.3.2', 'all');
        wp_enqueue_script('custom-js', plugin_dir_url(__FILE__) . 'js/custom.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.js', array('jquery'), '5.3.2', true);
        wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js', array('jquery'), '2.10.2', true);
    }

    public function render_app() {
        ob_start();
        include('templates/render.php');
        return ob_get_clean();
    }

    // Add more methods here
    // Add more features here

 }

new App();
