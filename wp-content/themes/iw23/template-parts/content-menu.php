<div <?php do_action('iw23_menu_featured_item_html_outer_tag_attributes', $args); ?>>

    <?php do_action('iw23_menu_featured_item_before_link'); ?>

    <a <?php do_action('iw23_menu_featured_item_html_link_tag_attributes'); ?> class="menu-featured-item-link">

        <?php do_action('iw23_menu_featured_item_before_content'); ?>

        <span class="menu-featured-item-meta">
            Featured
        </span>
        <span class="menu-featured-item-title">
            <?php echo iw23_get_the_title(); ?>
        </span>

        <?php do_action('iw23_menu_featured_item_after_content'); ?>
    </a>

    <?php do_action('iw23_menu_featured_item_after_link'); ?>
</div>