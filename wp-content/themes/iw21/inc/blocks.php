<?php

function iw21_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'iw-blocks',
                'title' => __('IW Blocks', 'iw21'),
            ),
        )
    );
}
add_filter('block_categories', 'iw21_block_category', 10, 2);

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
            'category'          => 'iw-blocks',
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
            'category'          => 'iw-blocks',
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


        // Register block for feed
        acf_register_block_type(array(
            'name'              => 'process',
            'title'             => __('Process'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-process.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-process.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'slides',
            ),
            'mode'              => 'preview',
            'align' => 'full',
            'supports'          => array(
                'align' => array('full'),
                'mode' => false,
                'multiple' => false,
            )
        ));


        // Register block for feed
        acf_register_block_type(array(
            'name'              => 'modal',
            'title'             => __('Modal'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-modal.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-modal.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'welcome-comments',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                // 'mode' => false,
                'jsx' => true,
                'align_text' => true,
                'align' => false,
                'color' => array(
                    'background' => true,
                    'text'       => true
                )
            )
        ));

        // Register block for feed
        acf_register_block_type(array(
            'name'              => 'modal-standalone',
            'title'             => __('Modal (Standalone)'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-modal-standalone.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-modal.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'welcome-comments',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                // 'mode' => false,
                'jsx' => true,
                'align' => false,
            )
        ));

        // Register block for GET messages
        acf_register_block_type(array(
            'name'              => 'dynamic-message',
            'title'             => __('Dynamic Message'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-dynamic-message.php',
            'category'          => 'iw-blocks',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'testimonial',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'mode' => false
            )
        ));

        // Register block for GET messages
        acf_register_block_type(array(
            'name'              => 'businessamp',
            'title'             => __('BusinessAMP'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-amp.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-amp.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'sos',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'mode' => false
            )
        ));

        // Register block for GET messages
        acf_register_block_type(array(
            'name'              => 'amp-v2',
            'title'             => __('AMP (Chart.js)'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-amp-v2.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-amp.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'sos',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'mode' => false
            )
        ));

        // Register block for listing tools
        acf_register_block_type(array(
            'name'              => 'tools',
            'title'             => __('Tools'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-tools.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-tools.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'admin-tools',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'jsx' => true,
            )

        ));

        // Register block for listing tools
        acf_register_block_type(array(
            'name'              => 'tool',
            'title'             => __('Tool'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-tool.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-tool.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'admin-tools',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'jsx' => true,
            )
        ));

        // Register block for dynamic arrows
        acf_register_block_type(array(
            'name'              => 'dynamic-arrow',
            'title'             => __('Dynamic Arrow'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-dynamic-arrow.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-dynamic-arrow.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'arrow-down-alt',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'mode' => false
            )
        ));

        // Register block for horizontal timeline
        acf_register_block_type(array(
            'name'              => 'timeline',
            'title'             => __('Timeline'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-timeline.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-timeline.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'clock',
            ),
            'mode'              => 'preview',
            'align'             => 'full',
            'supports'          => array(
                'jsx' => true,
            )
        ));

        // Register block for horizontal timeline
        acf_register_block_type(array(
            'name'              => 'timeline-item',
            'title'             => __('Timeline Item'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-timeline-item.php',
            'category'          => 'iw-blocks',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'clock',
            ),
            'mode'              => 'preview',
            'align'             => 'full',
            'supports'          => array(
                'jsx' => true,
            )
        ));

        // Register block for hero section
        acf_register_block_type(array(
            'name'              => 'hero',
            'title'             => __('Hero'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-hero.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-hero.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'megaphone',
            ),
            'mode'              => 'preview',
            'align'             => 'full',
            'supports'          => array(
                'jsx' => true,
                'color' => array(
                    'gradients'   => true,
                    // 'background' => false,
                    'text'       => true
                )
                // 'align' => false,
            )
        ));

        // Register block for media & text section
        acf_register_block_type(array(
            'name'              => 'media-text',
            'title'             => __('Media & Text'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-media-text.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-media-text.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'align-pull-right',
            ),
            'mode'              => 'preview',
            'align'             => 'full',
            'supports'          => array(
                'jsx' => true,
                'color' => array(
                    'gradients'  => true,
                    'text'       => false,
                    'background' => true
                )
            )
        ));

        // Register block for icons section
        acf_register_block_type(array(
            'name'              => 'icon',
            'title'             => __('Icon'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-icon.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-icon.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'superhero-alt',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'jsx' => true,
                'align' => false,
                'align_content' => true
            )
        ));

        // Register block for icons section
        acf_register_block_type(array(
            'name'              => 'quote',
            'title'             => __('Quote'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-quote.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-quote.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'testimonial',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'jsx' => true,
                'align' => false,
                'align_text' => true
            )
        ));

        // Register block for post grid section
        acf_register_block_type(array(
            'name'              => 'post-grid',
            'title'             => __('Post Grid'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-post-grid.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-post-grid.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'layout',
            ),
            'mode'              => 'preview',
            'align'             => 'full',
            'supports'          => array(
                'align' => false
            )
        ));

        // Register block for gradient text
        acf_register_block_type(array(
            'name'              => 'gradient-text',
            'title'             => __('Gradient Text'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-gradient-text.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-gradient-text.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'heading',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'align_text' => true,
                'color' => array(
                    'gradients'   => true,
                    // 'background' => false,
                    'text'       => false
                )
            )
        ));

        // Register block for gradient text
        acf_register_block_type(array(
            'name'              => 'client',
            'title'             => __('Client'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-client.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-client.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'groups',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'align_text' => true,
                'color' => array(
                    'gradients'   => true,
                    'text'       => false
                ),
                'jsx' => true
            )
        ));

        // Register block for gradient text
        acf_register_block_type(array(
            'name'              => 'count',
            'title'             => __('Count-Up'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-count.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-count.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'performance',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'align_text' => true,
                'color' => array(
                    'text'       => true
                )
            )
        ));

        // Register block for shards
        acf_register_block_type(array(
            'name'              => 'shard',
            'title'             => __('Shard'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-shard.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-shard.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'play',
            ),
            'mode'              => 'preview',
        ));


        // Register block for gradient text
        acf_register_block_type(array(
            'name'              => 'pin',
            'title'             => __('Pinned Section'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-pin.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-pin.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'admin-post',
            ),
            'mode'              => 'preview',
            'supports'          => array(
                'align' => false,
                'color' => array(
                    'gradients' => true,
                    'text'      => true
                ),
                'jsx' => true,
                'multiple' => false
            )
        ));

        // Register block for changing backgrounds
        acf_register_block_type(array(
            'name'              => 'bg',
            'title'             => __('Change Background'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-bg.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-bg.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'color-picker',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => false,
                'color' => array(
                    'text'      => true
                ),
                'mode' => false,
            )
        ));

        // Register block for the team page
        acf_register_block_type(array(
            'name'              => 'team',
            'title'             => __('Team Members'),
            'description'       => __('Descriptive Text'),
            'render_template'   => 'template-parts/blocks/block-team.php',
            'category'          => 'iw-blocks',
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-team.css',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'groups',
            ),
            'mode'              => 'preview',
            'align'             => 'full',
            'supports'          => array(
                'color' => array(
                    'gradients'      => true
                ),
                'mode' => false,
            )
        ));
    }
}
add_action('acf/init', 'iw21_add_custom_blocks');

/**
 * 
 */
function iw21_add_case_study_blocks()
{
    acf_register_block_type(array(
        'name'              => 'cs-header',
        'title'             => __('Header (Case Study)'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-cs-header.php',
        'category'          => 'iwcs-blocks',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-cs-header.css',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'cover-image',
        ),
        'mode'              => 'preview',
        'align'             => 'full',
        'supports'          => array(
            'jsx' => true,
            'mode' => false
        )
    ));

    acf_register_block_type(array(
        'name'              => 'cs-skills',
        'title'             => __('Skills Deployed (Case Study)'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-cs-skills.php',
        'category'          => 'iwcs-blocks',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-cs-skills.css',
        'align'             => 'full',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'cover-image',
        ),
        'mode'              => 'preview',
    ));

    // Register block for horizontal timeline
    acf_register_block_type(array(
        'name'              => 'cs-horizontal',
        'title'             => __('Horizontal Scroll (Case Study)'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-cs-horizontal.php',
        'category'          => 'iwcs-blocks',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-cs-horizontal.css',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'clock',
        ),
        'mode'              => 'preview',
        'align'             => 'full',
        'supports'          => array(
            'jsx' => true,
            'align_content' => true
        )
    ));

    // Register block for horizontal timeline
    acf_register_block_type(array(
        'name'              => 'cs-horizontal-item',
        'title'             => __('Horizontal Scroll Item (Case Study)'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-cs-horizontal-item.php',
        'category'          => 'iwcs-blocks',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'clock',
        ),
        'mode'              => 'preview',
        'align'             => 'full',
        'supports'          => array(
            'jsx' => true,
        )
    ));

    acf_register_block_type(array(
        'name'              => 'cs-footer',
        'title'             => __('Footer (Case Study)'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-cs-footer.php',
        'category'          => 'iwcs-blocks',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-cs-footer.css',
        'align'             => 'full',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'cover-image',
        ),
        'mode'              => 'preview',
        'supports'          => array(
            'jsx' => true,
        )
    ));
}
add_action('acf/init', 'iw21_add_case_study_blocks');

/**
 * 
 */
function iw21_add_signup_blocks()
{

    acf_register_block_type(array(
        'name'              => 'signup-form',
        'title'             => __('Signup Form'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-signup-form.php',
        'category'          => 'signup-blocks',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-signup-form.css',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'forms',
        ),
        'mode'              => 'preview',
        'supports'          => array(
            'mode'  => false
        )
    ));

    acf_register_block_type(array(
        'name'              => 'signup-download',
        'title'             => __('Download'),
        'description'       => __('Descriptive Text'),
        'render_template'   => 'template-parts/blocks/block-signup-download.php',
        'category'          => 'signup-blocks',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/assets/block-signup-download.css',
        'icon'              => array(
            'background' => '#358C92',
            'foreground' => '#ffffff',
            'src'        => 'download',
        ),
        'mode'              => 'preview',
        'supports'          => array(
            'mode'  => false
        )
    ));
}
add_action('acf/init', 'iw21_add_signup_blocks');

/**
 * 
 */
function iw21_add_body_classes_for_blocks_in_content($classes)
{

    global $post;

    // Get the post_content
    $post_content = get_the_content(get_the_ID());

    if (has_blocks($post_content)) {
        $blocks = parse_blocks($post_content);

        if (is_array($blocks) && array_key_exists(1, $blocks) && is_array($blocks[1]) && in_array('acf/site-header', $blocks[1])) {
            $classes[] = 'has-hero-image';
        }

        // Check for the Heading block
        if ($blocks[0]['blockName'] === 'acf/site-header') {
            $classes[] = 'has-hero-image';
        }
    }

    return $classes;
}
add_filter('body_class', 'iw21_add_body_classes_for_blocks_in_content');


/**
 * Add ACF Blocks
 */
function iw21_add_landing_page_blocks()
{

    // check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register block for Schindler Logos
        acf_register_block_type(array(
            'name'              => 'landing-page-logos',
            'title'             => __('Company Logos (Generic)'),
            'description'       => __('A custom block for a landing page page, displaying a slider of logos.'),
            'render_template'   => 'template-parts/blocks/block-logos.php',
            'category'          => 'iw-blocks',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'slides',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => array('wide', 'full'),
                'mode' => false
            )
        ));
    }
}
add_action('acf/init', 'iw21_add_landing_page_blocks');

/**
 * Add ACF Blocks
 */
function iw21_add_chat_experience_block()
{

    // check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register block for Schindler Logos
        acf_register_block_type(array(
            'name'              => 'chat-experience',
            'title'             => __('Chat Experience'),
            'description'       => __('A custom block for a work story'),
            'render_template'   => 'template-parts/blocks/block-chat-experience.php',
            'enqueue_assets'     => function () {
                wp_enqueue_style('iw21-chat-experience-block', get_template_directory_uri() . '/template-parts/blocks/assets/block-chat-experience.css');
            },
            'category'          => 'iw-blocks',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'slides',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'mode' => false
            )
        ));
    }
}
add_action('acf/init', 'iw21_add_chat_experience_block');

/**
 * 
 */
function iw21_setup_block_classes($block, $is_preview)
{
    $classes = [
        $is_preview ? 'is-preview' : 'is-frontend', // is-preview
        'align' . $block['align']                   // align
    ];

    return $classes;
}

/**
 * 
 */
function iw21_setup_animations($animation, $block_id, $inner_el = "")
{
    $animations = [
        'fade-in' => 'opacity: 0',
        'float-in' => 'opacity: 0, y: 100',
        'float-down' => 'opacity: 0, y: -100',
        'float-left' => 'opacity: 0, x: 100',
        'float-right' => 'opacity: 0, x: -100',
        'flip-up' => 'opacity: 0, rotationX: -90',
        'flip-down' => 'opacity: 0, rotationX: 90',
        'flip-left' => 'opacity: 0, rotationY: 90',
        'flip-right' => 'opacity: 0, rotationY: -90',
    ];

    echo iwe_sprintf('<script> (function() { gsap.from("#%id% %inner_el%", { scrollTrigger: {trigger: "#%id% %inner_el%"}, duration: 2, ease: "power3", %animation% }); })(); </script>', array(
        '%id%'        => $block_id,
        '%inner_el%'  => $inner_el,
        '%animation%' => $animations[$animation]
    ));
}
