<?php

/**
 * This template part renders a feed before any interaction with infinite scroll
 */

global $wp;

$page_or_paged = 'paged';

if (is_front_page()) {
    $page_or_paged = 'page';
}

$paged = get_query_var($page_or_paged) ? get_query_var($page_or_paged) : 1;

$feed_query = $GLOBALS['wp_query'];

/* Build our query */
if (!is_archive() && !is_search()) {
    $feed_query = new WP_Query($args);
}

$prev_posts_url = sprintf(
    '%s/?infsc=%d%s',
    home_url($wp->request),
    max(1, intval(!empty($_GET['infsc']) ? $_GET['infsc'] : 0) - 5),
    is_search() ? sprintf('&s=%s', get_search_query()) : ''
);

?>

<?php if (isset($_GET['infsc']) && $_GET['infsc'] > 1) : ?>
    <div class="load-previous-posts">
        <a href="<?php echo $prev_posts_url; ?>" class="btn">Load more recent posts</a>
    </div>
<?php endif; ?>

<div id="feed" class="entry-feed feed">


    <?php

    // The loop
    if ($feed_query->have_posts() && !isset($_GET['infsc'])) : /* Start the loop */  ?>


        <?php

        $index = 1;

        while ($feed_query->have_posts()) : $feed_query->the_post();

            get_template_part('template-parts/feed/feed', 'item', array(
                'chunk' => $paged,
                'index' => $index
            ));

            $index++;

        endwhile;

        ?>



    <?php endif;

    wp_reset_postdata();

    ?>
</div>

<?php get_template_part('template-parts/elements/element', 'spinner'); ?>