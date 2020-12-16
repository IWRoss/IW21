<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Interactive_Workshops_2017
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function iw17_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'		=> 'scroll',
		'container' => 'feed',
		'render'    => 'iw17_infinite_scroll_render',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'iw17-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'iw17_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function iw17_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();

		if ( $template = get_page_template_slug() ) :
			$template = preg_replace( '/(single-)|(work-)+/', '', wp_basename( $template, '.php' ) );

			get_template_part( 'template-parts/feed/feed', $template );
		else :
			get_template_part( 'template-parts/feed/feed', 'standard' );
		endif;
	}
}

function iw17_custom_is_support() {
    $supported = current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() || is_front_page() || is_page_template( 'page-templates/page-home.php' ) );

    return $supported;
}
add_filter( 'infinite_scroll_archive_supported', 'iw17_custom_is_support' );
