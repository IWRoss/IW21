<?php

/**
 * Add stylesheet for the Schindler page
 */
function iw17_schindler_stylesheet() {

    if ( is_page( 'schindler' )  ) {
        wp_enqueue_style( 'iw17-schindler', get_template_directory_uri() . '/schindler.css', false );

        wp_enqueue_script( 'iw17-slick-script', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ) );
    }

}
add_action( 'wp_enqueue_scripts', 'iw17_schindler_stylesheet' );

/**
 * Add Schindler features
 */
function iw17_add_schindler_features() {

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'IW Orange', 'iw17' ),
            'slug' => 'iw-orange',
            'color' => '#ff8d00',
        ),
        array(
            'name' => __( 'IW Blue', 'iw17' ),
            'slug' => 'iw-blue',
            'color' => '#16467B',
        ),
        array(
            'name' => __( 'IW Black', 'iw17' ),
            'slug' => 'iw-black',
            'color' => '#22222A',
        ),
        array(
            'name' => __( 'White', 'iw17' ),
            'slug' => 'iw-white',
            'color' => '#ffffff',
        )
    ) );

    add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'iw17_add_schindler_features' );

/**
 * Add ACF Blocks
 */
function iw17_add_schindler_blocks() {

    // check function exists.
    if ( function_exists( 'acf_register_block_type' ) ) {

        // Register block for Schindler Business Areas
        acf_register_block_type( array(
            'name'              => 'schindler-business-areas',
            'title'             => __('Business Areas'),
            'description'       => __('A custom block for the Schindler page, displaying Business Areas.'),
            'render_template'   => 'template-parts/blocks/block-schindler-business-areas.php',
            'category'          => 'common',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'businessman',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => array( 'wide', 'full' ),
                'mode' => false
            )
        ) );

        // Register block for Schindler Teams
        acf_register_block_type( array(
            'name'              => 'schindler-team',
            'title'             => __('Team'),
            'description'       => __('A custom block for the Schindler page, displaying the team in a slider.'),
            'render_template'   => 'template-parts/blocks/block-schindler-team.php',
            'category'          => 'common',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'groups',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'align' => array( 'wide', 'full' ),
                'mode' => false
            )
        ) );

        // Register block for Schindler Call-To-Actions
        acf_register_block_type( array(
            'name'              => 'schindler-cta',
            'title'             => __('Call-to-action'),
            'description'       => __('A custom block for the Schindler page, displaying a call-to-action.'),
            'render_template'   => 'template-parts/blocks/block-schindler-cta.php',
            'category'          => 'common',
            'icon'              => array(
                'background' => '#ff8d00',
                'foreground' => '#ffffff',
                'src'        => 'yes-alt',
            ),
            'mode'              => 'edit',
            'supports'          => array(
                'mode' => false
            )
        ) );

        // Register block for Schindler Logos
        acf_register_block_type( array(
            'name'              => 'schindler-logos',
            'title'             => __('Company Logos'),
            'description'       => __('A custom block for the Schindler page, displaying a slider of logos.'),
            'render_template'   => 'template-parts/blocks/block-schindler-logos.php',
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
add_action( 'acf/init', 'iw17_add_schindler_blocks' );


function iw17_add_label_to_schindler_flexible_content_field( $title, $field, $layout, $i ) {

	// load text sub field
	if ( $text = get_sub_field( 'label' ) ) {

		$title = $text;

	}

	return $title;
}

// name
add_filter('acf/fields/flexible_content/layout_title/name=business_areas', 'iw17_add_label_to_schindler_flexible_content_field', 10, 4);
add_filter('acf/fields/flexible_content/layout_title/name=team', 'iw17_add_label_to_schindler_flexible_content_field', 10, 4);

/**
 * Custom format image as css
 */
function hardyware_format_image_background_css( $image ) {

	if ( ! $image ) {
		return;
	}

	printf( 'background-image:url(\'%s\')', $image );
}
