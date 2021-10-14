<?php
/**
 * @package hello
 */

defined( 'ABSPATH' ) or die;

namespace inc;

class deactivate {

    public static function deactivate() {

        /* Do something on deactivate. */
        flush_rewrite_rules();
    }
}