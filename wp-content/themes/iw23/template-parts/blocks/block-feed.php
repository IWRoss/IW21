<?php

$args = array(
    'post_status' => 'publish'
);

// $selection_method = get_field('selection_method');

// if ($selection_method === 'select') {

//     $args = $args + array(
//         'post__in' => get_field('feed'),
//         'orderby' => 'post__in',
//         'post_type' => array('post', 'work'),
//     );

// } else {

//     $args = $args + array(
//         'post_type' => get_field('post_type'),
//         'tag_slug__in' => 'feature',
//         'posts_per_page' => 8
//     );

// }

// echo '<pre>', print_r(iw23_build_args_from_query_builder(get_field('feed_builder'))), '</pre>';

$feed_builder = get_field('feed_builder');

$grouped = array_search('group_by_category', array_column((array)$feed_builder, 'acf_fc_layout')) !== false;

$args = iw23_build_args_from_query_builder($feed_builder);

$masonry = get_field('masonry');

?>

<div id="<?php echo $block['id']; ?>" class="block-feed">
    <?php

    if ($grouped) {
        add_filter('posts_orderby', 'iw23_edit_posts_orderby');
    }

    /* Build our query */
    $feed_query = new WP_Query($args);

    if ($grouped) {
        remove_filter('posts_orderby', 'iw23_edit_posts_orderby');
    }

    // The loop
    if ($feed_query->have_posts()) :

        /* Start the loop */

        echo $masonry ? '<div class="feed masonry-grid">' : '<div class="feed">';

        // echo $masonry ? '<div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>' : '';

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

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>