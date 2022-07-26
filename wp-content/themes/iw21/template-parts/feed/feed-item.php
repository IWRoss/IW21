<?php

/**
 * Template for items in the feed
 * 
 * @package Interactive_Workshops_2021
 */

?>

<div <?php do_action('iw21_feed_item_html_outer_tag_attributes', $args); ?>>
    <a <?php do_action('iw21_feed_item_html_link_tag_attributes'); ?> class="feed-item-link">

        <?php do_action('iw21_post_icon'); ?>

        <span class="feed-title">
            <?php echo iw21_get_the_title(); ?>
        </span>

        <span class="feed-excerpt">
            <?php the_excerpt(); ?>
        </span>

        <?php do_action('iw21_author_image'); ?>

        <?php do_action('iw21_feed_overlay'); ?>

    </a>
</div>