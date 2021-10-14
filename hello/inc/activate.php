<?php
/**
 * @package hello
 */

defined( 'ABSPATH' ) or die;

namespace inc;

class activate {

    public static function activate() {

        /* Do something on activate. */
        helloPlugin::addPostType();
        flush_rewrite_rules();
    }
}