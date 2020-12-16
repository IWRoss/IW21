<?php

$page_or_paged = 'paged';

if ( is_front_page() ) {
    $page_or_paged = 'page';
}

?>

<div class="entry-feed">
    <?php

        // $paged = get_query_var( $page_or_paged ) ? get_query_var( $page_or_paged ) : 1;

        /* Build our query */
        $feed_query = new WP_Query( iw17_get_query_options() );

        // // Pagination fix
        // $temp_query = $wp_query;
        // $wp_query   = NULL;
        // $wp_query   = $feed_query;

        // The loop
        if ( $feed_query->have_posts() ) :

            /* Start the loop */

            echo '<div id="feed" class="masonry-grid" data-filtered="false"><div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>';

            while ( $feed_query->have_posts() ) : $feed_query->the_post();

                /* We need to detect the template to decide which feed template part to use */

                if ( get_page_template_slug() ) :
                    get_template_part( 'template-parts/feed/feed', iw17_template_nice_name() );
                else :
                    get_template_part( 'template-parts/feed/feed', 'standard' );
                endif;

            endwhile;

            echo '</div>';

            if ( $feed_query->post_count === (int)get_option( 'posts_per_page' ) ) :
                echo '<div id="loader" class="loader"> <div id="spinner" class="spinner"> <div class="spinner-block"></div> <div class="spinner-block"></div> <div class="spinner-block"></div> <div class="spinner-block"></div> </div> <p>Loading more</p> </div>';
            endif;

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
