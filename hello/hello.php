<?php
/**
 * Plugin Name: hello
 * Plugin URI: https://www.hello.com/
 * Description: This is the very first plugin I ever created.
 * Version: 1.0
 * Author: Vinay Gawade
 * Author URI: http://hello.com/
 *
 * @package hello
 */

/* SECURITY */

/**
 * 1. Add an "index.php" file with no content to avoid direct access to plug-in.
 */

/**
 * 2.To avoid trying to externally access or trigger any of the functionality of the plug-in.
 */

// if ( ! defined( 'ABSPATH' ) ) {
//     die;
// }

/* All in one-line. */
defined( 'ABSPATH' ) or die;


/**
 * 3.To ensure that wordpress working fine.
 */

if ( ! function_exists( 'add_action' ) ) {
    die;
}

/* SECURITY */

if ( ! class_exists( 'helloPlugin' ) ) { // Check if class exist or not if exist create it.

    /* CLASSES BEGIN */
    class helloPlugin {
        public $plugin_name;
        /* METHODS */

        public function __construct() {
            $this->plugin_name = plugin_basename( __FILE__ );

            /* Call actions & filters at intialization of the class*/
            add_action( 'init', [ 'helloPlugin', 'addPostType' ] );
            add_action( 'admin_menu', [ 'helloPlugin', 'addCustomPage' ] );
            add_filter( "plugin_action_links_$this->plugin_name", [ 'helloPlugin', 'setting_link']);
        }

        public static function setting_link( $links ) {
            $setting_link_tag = '<a href="admin.php?page=hello_setting" > Settings </a>';
            array_push( $links, $setting_link_tag );
            return $links;
        }

        public static function addCustomPage() {
            add_menu_page(
                'Hello Plug-in Setting',                // Page Title.
                'Hello Setting',                        // Page Menu Name.
                'manage_options',                       // Capability (Permission).
                'hello_setting',                          // Menu Slug
                [ 'helloPlugin', 'settingsPagePath' ],  // Call Callback Function
                'dashicons-admin-generic',              // Icon
                '50',                                   // Position in Numbers on Sidebar
            );
        }

        public static function settingsPagePath() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/settings-page.php'; // Get template.
        }

        public static function addPostType() {
            register_post_type( 'hello', [ 'public' => true, 'label' => 'Hello' ] ); // Add custom post type here.
        }

    }

/* CLASSES END */

    $hello = new helloPlugin(); // instance of class

    require_once plugin_dir_path( __FILE__ ) . 'inc/hello-activate.php';
    register_activation_hook( __FILE__, [ 'helloActivate', 'activate' ] ); // Activation Hook Call

    require_once plugin_dir_path( __FILE__ ) . 'inc/hello-deactivate.php';
    register_deactivation_hook( __FILE__, [ 'helloDeactivate', 'deactivate' ] ); // Deactivation Hook Call
}