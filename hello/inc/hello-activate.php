<?php
/**
 * @package hello
 */

defined( 'ABSPATH' ) or die;

class helloActivate {

    public static function activate() {

        /* Do something on activate. */
        helloPlugin::addPostType();
        // helloPlugin::addCustomPage();
        flush_rewrite_rules();
    }
}