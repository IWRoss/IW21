<?php

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
