<?php

function iw17_sort_dates_of_posts() {

    $post_type = $_POST['type'];

    if ( check_ajax_referer( 'shuffle', 'security', false ) ) {
        // Get array of all posts
        $all_posts = get_posts( array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
            'fields'         => 'ids'
        ) );

        // Get home feed array of posts
        $home = get_page_by_title( 'Home' );

        $home_feed = get_field_object( 'selected_posts', $home->ID );

        // Extract post of post type, new array for them
        $ordered_posts = array();

        foreach ( $home_feed['value'] as $feed_item ) {

            if ( get_post_type( $feed_item ) === $post_type ) {
                $ordered_posts[] = $feed_item;
            }
        }

        // Add IDs to end of home feed array where they are not present
        foreach ( $all_posts as $post_ref ) {
            if ( ! in_array( $post_ref, $ordered_posts ) ) {
                $ordered_posts[] = $post_ref;
            }
        }

        // Invert array
        $ordered_posts = array_reverse( $ordered_posts );

        // Loop through new array, changing post datetime incrementing in values of 5 minutes
        $date = strtotime( '2017-10-04 00:00:00' );

        $result = array();

        foreach ( $ordered_posts as $ordered_post ) {

            $date_string = date( "Y-m-d H:i:s", $date );

            $result[$ordered_post] = $date_string;

            wp_update_post(
                array(
                    'ID'            => $ordered_post,
                    'post_date'     => $date_string,
                    'post_date_gmt' => get_gmt_from_date( $date_string )
                )
            );

            $date = $date + 360;
        }

        echo 'Success!';
    } else {
        echo 'Nonce failure.';
    }

    wp_die();
}
// add_action( 'admin_head', 'iw17_sort_dates_of_posts' );

if ( is_admin() ) {
    add_action( 'wp_ajax_sort_dates_of_posts', 'iw17_sort_dates_of_posts' );
}
