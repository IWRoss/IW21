<div <?php do_action('iw21_menu_featured_item_html_outer_tag_attributes', $args); ?>>
    <a <?php do_action('iw21_menu_featured_item_html_link_tag_attributes'); ?> class="menu-featured-item-link">
        <span class="menu-featured-item-meta">
            Featured
        </span>
        <span class="menu-featured-item-title">
            <?php echo iw21_get_the_title(); ?>
        </span>
    </a>
</div>