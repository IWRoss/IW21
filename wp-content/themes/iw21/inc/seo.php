<?php

function iw21_doctype_opengraph( $output ) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter( 'language_attributes', 'iw21_doctype_opengraph' );


function iw21_fb_opengraph() {
    global $post;

    $home = get_page_by_title( 'Home' );

    if ( is_single() ) {

        if ( $excerpt = $post->post_excerpt ) {
            $excerpt = strip_tags( $post->post_excerpt );
            $excerpt = str_replace( "", "'", $excerpt );
        } else {
            $excerpt = get_bloginfo( 'description' );
        }
        ?>

    <meta property="og:title" content="<?php echo the_title(); ?> // <?php bloginfo( 'name' ); ?>" />
    <meta property="og:description" content="<?php echo $excerpt; ?>" />
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>" />
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>" />

<?php
    } else {
        return;
    }
}
add_action( 'wp_head', 'iw21_fb_opengraph', 5 );
