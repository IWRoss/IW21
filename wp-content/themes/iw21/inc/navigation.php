<?php

class IW_Menu_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $classes = is_array($item->classes) ? implode(" ", $item->classes) : '';

        $output .= "<li class='" .  $classes . "'>";

        $opens_modal = get_field('opens_modal', $item->ID);

        $output .= iw21_sprintf(
            '<a href="%url"%target%lity>%title</a>',
            array(
                '%url'              => $item->url,
                '%title'            => $item->title,
                '%lity'             => $opens_modal ? ' data-lity' : '',
                '%target'           => $item->target
                    ? sprintf(' target="%s"', $item->target)
                    : ''
            )
        );
    }
}

class IW_Megamenu_Walker extends Walker_Nav_Menu
{

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $children_count = 0;

        if (is_array($item->classes) && in_array('menu-item-has-children', $item->classes)) {

            $locations = get_nav_menu_locations(); // Getting the locations of the nav menus array.

            $menu = wp_get_nav_menu_object($locations['menu-1']); // Getting the menu calling the walker from the array.

            $menu_items = wp_get_nav_menu_items($menu->term_id); // Getting the menu item objects array from the menu.

            $menu_item_parents = array_map(function ($o) {
                return $o->menu_item_parent;
            }, $menu_items); // Getting the parent ids by looping through the menu item objects array. This will give an array of parent ids and the number of their children.

            $children_count = array_count_values($menu_item_parents)[$item->ID]; // Get number of children menu item has.
        }

        $item->classes[] = $children_count <= 10 ? ($children_count <= 6 ? ($children_count <= 3 ? 'menu-scale-large' : 'menu-scale-medium') : 'menu-scale-small') : 'menu-scale-xsmall';

        $output .= "<li class='" .  implode(" ", $item->classes) . "'>";

        if ($item->url && $item->url != '#') {
            $output .= sprintf('<a class="menu-link" href="%s"%s>', $item->url, $item->target ? sprintf(' target="%s"', $item->target) : '');
        } else {
            $output .= '<span class="menu-link menu-link-no-url">';
        }

        $output .= $item->title;

        if ($item->description) {
            $output .= sprintf('<br><span class="menu-item-description">%s</span>', $item->description);
        }

        if ($item->url && $item->url != '#') {
            $output .= '</a>';
        } else {
            $output .= '</span>';
        }

        $custom_field = get_field('featured', $item->ID);

        if (!$depth && ($custom_field || in_array('menu-item-has-children', $item->classes))) {
            $output .= '<div class="megamenu">';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {

        $custom_field = get_field('featured', $item->ID);

        if ($custom_field) {
            $output .= sprintf(
                '<div class="menu-featured-section" data-layout="%d">%s</div>',
                count($custom_field),
                array_reduce($custom_field, function ($string, $featured_post) {

                    global $post;

                    ob_start();

                    $post = get_post($featured_post->ID, OBJECT);

                    setup_postdata($post);

                    get_template_part('template-parts/content', 'menu', array('post' => $featured_post));

                    wp_reset_postdata();

                    $string .= ob_get_contents();

                    ob_end_clean();

                    return $string;
                }, '')
            );
        }

        if (!$depth && ($custom_field || in_array('menu-item-has-children', $item->classes))) {
            $output .= '</div>';
        }

        $output .= "</li>";
    }
}
