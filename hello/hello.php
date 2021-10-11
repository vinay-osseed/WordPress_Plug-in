<?php
/**
 * Plugin Name: hello
 * Plugin URI: https://www.hello.com/
 * Description: This is the very first plugin I ever created.
 * Version: 1.0
 * Author: Vinay Gawade
 * Author URI: http://hello.com/
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
defined('ABSPATH') or die;


/**
 * 3.To ensure that wordpress working fine.
 */

if (!function_exists('add_action')) {
    die;
}

/* SECURITY */


/* CLASSES BEGIN */

class helloPlugin {
    /* METHODS */

    function __construct() {
        add_action('init', array( $this, 'renamePostType' ) );
    }

    function activate() {
        /* Do something on activate. */

        $this->renamePostType();
        flush_rewrite_rules();
    }

    function deactivate() {
        /* Do something on deactivate. */
        flush_rewrite_rules();
    }

    function uninstall() { /* Do something on uninstall. */ }

    function renamePostType() {
        register_post_type( 'Hello', [ 'public' => true, 'label' => 'Hello' ] );
    }

}

/* CLASSES END */

if (class_exists('helloPlugin')) {
    /**
     * Check if class exist or not if exist create it's instance.
     */

    $hello = new helloPlugin();
}

/* Activation Hook Call */
register_activation_hook(__FILE__, [$hello, 'activate']);

/* Deactivation Hook Call */
register_deactivation_hook(__FILE__, [$hello, 'deactivate']);


// function dh_modify_read_more_link() {

//     return '<a class="more-link" href="' . get_permalink() . '">Hello Read More!</a>';

// }

// add_filter( 'the_content_more_link', 'dh_modify_read_more_link' );