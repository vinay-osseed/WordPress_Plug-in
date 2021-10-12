<?php
/**
 * @package hello
 */

defined( 'ABSPATH' ) or die;

class helloDeactivate {

    public static function deactivate() {
echo "d";
        /* Do something on deactivate. */
        flush_rewrite_rules();
    }
}