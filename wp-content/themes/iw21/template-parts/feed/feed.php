<?php

global $wp;

$page_or_paged = 'paged';

if ( is_front_page() ) {
    $page_or_paged = 'page';
}

?>

<div class="entry-feed">
    <?php

        $paged = get_query_var( $page_or_paged ) ? get_query_var( $page_or_paged ) : 1;

        if ( isset($_GET['infsc'] ) && $_GET['infsc'] > 1 ) : ?>

            <div class="load-previous-posts">
                <a href="<?php echo home_url($wp->request); ?>/?infsc=<?php echo max(1, intval($_GET['infsc']) - 5); ?>" class="btn">Load more recent posts</a>
            </div>
        
        <?php endif;

        /* Build our query */
        $feed_query = new WP_Query(iw21_get_query_options());

        // The loop
        if ( $feed_query->have_posts() && ! isset($_GET['infsc'] ) ) : /* Start the loop */  ?>

            <div class="feed" class="masonry-grid" data-chunk="<?php echo $paged; ?>">
                <div class="masonry-grid-sizer"></div>
                <div class="masonry-gutter-sizer"></div>

                <?php

                $index = 1;

                while ( $feed_query->have_posts() ) : $feed_query->the_post();

                    get_template_part( 'template-parts/feed/feed', 'item', array(
                        'chunk' => $paged,
                        'index' => $index
                    )  );

                endwhile;

                $index++;

                ?>

            </div>
            

        <?php endif;

        wp_reset_postdata();

    ?>
</div>

<?php

// if ( $feed_query->post_count === (int)get_option( 'posts_per_page' ) ) :
    echo '<div id="loader" class="loader"> <div id="spinner" class="spinner"> <div class="spinner-block"></div> <div class="spinner-block"></div> <div class="spinner-block"></div> <div class="spinner-block"></div> </div> <p>Loading more</p> </div>';
// endif;

?>
