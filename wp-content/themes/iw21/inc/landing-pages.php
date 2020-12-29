<?php

/**
 * Add ACF Blocks
 */
function iw21_add_landing_page_blocks() {

    // check function exists.
    if ( function_exists( 'acf_register_block_type' ) ) {

        // Register block for Schindler Logos
        acf_register_block_type( array(
            'name'              => 'landing-page-logos',
            'title'             => __('Company Logos (Generic)'),
            'description'       => __('A custom block for a landing page page, displaying a slider of logos.'),
            'render_template'   => 'template-parts/blocks/block-logos.php',
            'category'          => 'common',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'slides',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => array( 'wide', 'full' ),
                'mode' => false
            )
        ) );
    }

}
add_action( 'acf/init', 'iw21_add_landing_page_blocks' );


/**
 * Add stylesheet for the Schindler page
 */
function iw21_landingpages_stylesheet() {

    if ( is_page_template( 'page-templates/page-noheader.php' )  ) {
        wp_enqueue_style( 'iw21-landing-pages', get_template_directory_uri() . '/landing-pages.css', false );

        wp_enqueue_script( 'iw21-slick-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ) );

    }

}
add_action( 'wp_enqueue_scripts', 'iw21_landingpages_stylesheet' );
