<?php

/**
 * Admin Functions
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Add Company column and reorder columns
 */
function iw23_set_custom_edit_work_columns($columns)
{
    $new_columns = array();

    foreach ($columns as $key => $title) {
        if ($key == 'date') {
            $new_columns['template'] = __('Template', 'iw21');
        }

        $new_columns[$key] = $title;
    }

    // unset($new_columns['tags']);

    return $new_columns;
}
add_filter('manage_posts_columns', 'iw23_set_custom_edit_work_columns');
add_filter('manage_pages_columns', 'iw23_set_custom_edit_work_columns');

/**
 * Add custom column contents
 */
function iw23_custom_work_column($column, $post_id)
{

    if ($column == 'template') {

        $templates = wp_get_theme()->get_page_templates('', get_post_type($post_id));

        $the_template = get_page_template_slug($post_id);

        echo isset($templates[$the_template]) ? str_replace(' Template', '', $templates[$the_template]) : '&mdash;';
    }
}
add_action('manage_posts_custom_column', 'iw23_custom_work_column', 10, 2);

/**
 * Enqueue supplemental block editor styles.
 */
function iw23_block_editor_styles()
{

    $css_dependencies = array();

    wp_enqueue_style('iw21-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i');

    // Enqueue the editor styles.
    wp_enqueue_style('iw21-block-editor-styles', get_theme_file_uri('/common.css'), $css_dependencies, wp_get_theme()->get('Version'), 'all');
}

add_action('enqueue_block_editor_assets', 'iw23_block_editor_styles', 1, 1);
