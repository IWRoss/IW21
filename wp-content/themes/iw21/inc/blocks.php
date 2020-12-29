<?php

/**
 * Add ACF Blocks
 */
function iw21_add_custom_blocks()
{

    // check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register block for site header
        acf_register_block_type(array(
            'name'              => 'site-header',
            'title'             => __('Site Header'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-header.php',
            'category'          => 'common',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'slides',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => array('full'),
                'mode' => false
            )
        ));

        // Register block for feed
        acf_register_block_type(array(
            'name'              => 'feed',
            'title'             => __('Feed'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-feed.php',
            'category'          => 'common',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'slides',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => array('wide'),
                'mode' => false
            )
        ));
    }
}
add_action('acf/init', 'iw21_add_custom_blocks');


function iw21_add_body_classes_for_blocks_in_content($classes) {

    global $post;

    // Get the post_content
    $post_content = get_the_content(get_the_ID());

    if (has_blocks($post_content)) {
        $blocks = parse_blocks($post_content);

        if (in_array('acf/site-header', $blocks[1])) {
            $classes[] = 'has-hero-image';
        }

        // Check for the Heading block
        if ( $blocks[0]['blockName'] === 'acf/site-header' ) {
            $classes[] = 'has-hero-image';
        }
    }

    return $classes;
}
add_filter('body_class', 'iw21_add_body_classes_for_blocks_in_content');