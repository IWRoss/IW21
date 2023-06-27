<?php

/**
 * Template for items in the feed
 * 
 * @package Interactive_Workshops_2021
 */

?>

<div <?php do_action('iw23_feed_item_html_outer_tag_attributes', $args); ?>>

    <?php do_action('iw23_feed_item_before_link'); ?>

    <a <?php do_action('iw23_feed_item_html_link_tag_attributes', $args); ?> class="feed-item-link">

        <?php do_action('iw23_feed_item_before_content'); ?>

        <?php do_action('iw23_post_icon'); ?>

        <span class="feed-title">
            <?php echo $args['title'] ?? iw23_get_the_title(); ?>
        </span>

        <span class="feed-excerpt">
            <?php echo $args['excerpt'] ?? get_the_excerpt(); ?>
        </span>

        <?php do_action('iw23_author_image'); ?>

        <?php do_action('iw23_feed_overlay'); ?>

        <?php do_action('iw23_feed_item_after_content'); ?>

    </a>

    <?php do_action('iw23_feed_item_after_link'); ?>
</div>