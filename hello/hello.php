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


/* CLASSES BEGIN */
class assetsOfWp {
    /* METHODS */

    /**
     * This class load assets of the plug-ins.
     *
     * plugins_url() for get plugins current directory.
     */
    public function adminAssets() {

        /* Enqueue all assets for admin. */
        wp_enqueue_style( 'custom-css', plugins_url( '/assets/admin/css/style.css', __FILE__ ) ); // add css
        wp_enqueue_script( 'custom-js', plugins_url( '/assets/admin/js/script.js', __FILE__ ) ); // add JavaScript
    }

    public function wpAssets() {

        /* Enqueue all assets for wp. */
        wp_enqueue_style( 'custom-css', plugins_url( '/assets/wp/css/style.css', __FILE__ ) ); // add css
        wp_enqueue_script( 'custom-js', plugins_url( '/assets/wp/js/script.js', __FILE__ ) ); // add JavaScript
    }

    public function loadWpAssets() {
        add_action( 'wp_enqueue_scripts', [ $this, 'wpAssets' ] );
    }

    public function loadAdminAssets() {
        add_action( 'admin_enqueue_scripts', [ $this, 'adminAssets' ] );
    }

}

class helloPlugin extends assetsOfWp {
    /* METHODS */

    public function __construct() {

        /* Call actions & filters at intialization of the class*/
        add_action( 'init', [ $this, 'renamePostType' ] );
        add_filter( 'the_content_more_link', [ $this, 'dh_modify_read_more_link' ] );
    }

    public function renamePostType() {

        /* Add custom post type here. */
        register_post_type( 'hello', [ 'public' => true, 'label' => 'Hello' ] );
    }

    private function dh_modify_read_more_link() {

        /* Modifies the read more insert tag's text here. */
        return '<a class="more-link" href="' . get_permalink() . '">Hello Read More!</a>';
    }

    private function activate() {

        /* Do something on activate. */
        $this->renamePostType();
        flush_rewrite_rules();
    }

    private function deactivate() {

        /* Do something on deactivate. */
        flush_rewrite_rules();
    }
}

/* CLASSES END */

if (class_exists('helloPlugin')) { // Check if class exist or not if exist create it's instance.

    $hello = new helloPlugin(); // instance of class
    $hello->loadAdminAssets(); // loaded admin assets
    $hello->loadWpAssets(); // loaded user assets

    register_activation_hook( __FILE__, [ $hello, 'activate' ] ); // Activation Hook Call
    register_deactivation_hook( __FILE__, [ $hello, 'deactivate' ] ); // Deactivation Hook Call
}