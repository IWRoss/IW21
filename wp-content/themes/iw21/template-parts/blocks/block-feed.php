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

    /* Build our query */
    $feed_query = new WP_Query($args);

    // The loop
    if ($feed_query->have_posts()) :

        /* Start the loop */

        echo '<div class="feed">';

        while ($feed_query->have_posts()) : $feed_query->the_post();

            get_template_part('template-parts/feed/feed', 'item');

        endwhile;

        echo '</div>';

    else :

        echo '<p>No posts to display.</p>';

    endif;

    wp_reset_postdata();

    ?>
</div>