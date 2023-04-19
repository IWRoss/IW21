<?php

// Register Custom Post Type
function iw23_report_post_type()
{

    $labels = array(
        'name'                  => _x('Reports', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Report', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Reports', 'text_domain'),
        'name_admin_bar'        => __('Report', 'text_domain'),
        'archives'              => __('Report Archives', 'text_domain'),
        'attributes'            => __('Report Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Report:', 'text_domain'),
        'all_items'             => __('All Reports', 'text_domain'),
        'add_new_item'          => __('Add New Report', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Report', 'text_domain'),
        'edit_item'             => __('Edit Report', 'text_domain'),
        'update_item'           => __('Update Report', 'text_domain'),
        'view_item'             => __('View Report', 'text_domain'),
        'view_items'            => __('View Reports', 'text_domain'),
        'search_items'          => __('Search Report', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into report', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this report', 'text_domain'),
        'items_list'            => __('Reports list', 'text_domain'),
        'items_list_navigation' => __('Reports list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter reports list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Report', 'text_domain'),
        'description'           => __('Custom post type for marketing reports', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-analytics',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type('report', $args);
}
add_action('init', 'iw23_report_post_type', 0);
