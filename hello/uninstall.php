<?php
/**
 * Here's Uninstall process happens for the hello plug-in.
 *
 * @package hello
 */

/* Check if varable set or not. */
defined ( 'WP_UNINSTALL_PLUGIN' ) or die;

/**
 * Clear the custom post type data from the database.
 */

/**
 * Fetch all the post who has custom post type 'Hello'(same name as created CPT).
 * "-1" is set to fetch all the rows from table.
 */

$posts = get_posts( [ 'post_type' => 'hello', 'numberposts' => -1 ] );

/* Iterate over the all rows from table of posts. */
foreach ($posts as $post) {

    /* Delete posts one by one no matter whatever status is (that's why 2nd parameter is true).*/
    wp_delete_post( $post->ID, true );
}

/**
 * global $wpdb; //A global varible to directly access the database.
 * $wpdb->query( "SQL Query" ); // SQL execution here.
 */