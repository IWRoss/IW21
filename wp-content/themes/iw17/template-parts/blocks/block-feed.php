<?php

$args = array(
    'post_status' => 'publish'
);

$selection_method = get_field('selection_method');

if ($selection_method === 'select') {

    $args = $args + array(
        'post__in' => get_field('feed'),
        'orderby' => 'post__in',
        'post_type' => array('post', 'work'),
    );

} else {

    $args = $args + array(
        'post_type' => get_field('post_type'),
        'tag_slug__in' => 'feature',
        'posts_per_page' => 8
    );

}


?>

<div class="block-feed">
    <?php

    // $paged = get_query_var( $page_or_paged ) ? get_query_var( $page_or_paged ) : 1;

    /* Build our query */
    $feed_query = new WP_Query($args);

    // // Pagination fix
    // $temp_query = $wp_query;
    // $wp_query   = NULL;
    // $wp_query   = $feed_query;

    // The loop
    if ($feed_query->have_posts()) :

        /* Start the loop */

        echo '<div class="feed">';

        while ($feed_query->have_posts()) : $feed_query->the_post();

            /* We need to detect the template to decide which feed template part to use */

            if (get_page_template_slug()) :
                get_template_part('template-parts/feed/feed', iw17_template_nice_name());
            else :
                get_template_part('template-parts/feed/feed', 'standard');
            endif;

        endwhile;

        echo '</div>';

    else :

        echo '<p>No posts to display.</p>';

    endif;

    // if ( $feed_query->post_count === (int)get_option( 'posts_per_page' ) ) :
    //     echo '<a href="" id="pagination-button" class="btn">Load more posts</a>';
    // endif;

    // the_posts_pagination();

    wp_reset_postdata();

    // Reset main query object
    // $wp_query = NULL;
    // $wp_query = $temp_query;

    ?>
</div>