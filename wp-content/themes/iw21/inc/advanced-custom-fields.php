<?php
/**
 * Advanced Custom Fields Functions
 *
 * @link http://www.advancedcustomfields.com/resources/
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Add options page.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
if ( function_exists('acf_add_options_page') ) {

    acf_add_options_page( array(
        'page_title' => __( 'How it works', 'iw21' ),
        'menu_title' => __( 'Manual', 'iw21' ),
        'position'   => 1.1,
        'icon_url'   => 'dashicons-info'
    ) );

    acf_add_options_page( array(
        'page_title' => __( 'Client Logos', 'iw21' ),
        'menu_title' => __( 'Client Logos', 'iw21' ),
        'parent'     => 'options-general.php',
        'icon_url'   => 'dashicons-info'
    ) );

}

/**
 * Add labels for Flexible Content layout blocks.
 */
function iw21_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {

    if ( $style = get_sub_field( 'style' ) ) :
        $title = sprintf( '<span class="acf-module-label acf-module-label--%s">%s</span> ', $style, $title );
    else :
        $title = sprintf( '<span class="acf-module-label">%s</span> ', $title );
    endif;

    if ( $image = get_sub_field( 'image' ) )
        $title .= sprintf( '<span class="acf-module-label--img" style="background-image:url(%s)"></span> ', $image );

	if ( $text = get_sub_field( 'content' ) )
		$title .= implode( ' ', array_slice( str_word_count( strip_tags( $text ), 2 ), 0, 5 ) ) . '&hellip;';

	return $title;
}
add_filter('acf/fields/flexible_content/layout_title/name=path', 'iw21_acf_flexible_content_layout_title', 10, 4);
add_filter('acf/fields/flexible_content/layout_title/name=story', 'iw21_acf_flexible_content_layout_title', 10, 4);

/**
 * Add link for quote relationships
 */
function iw21_quote_relationship_redirect() {
    if ( $link_to = get_field( 'link_to' ) ) {
        wp_redirect( get_permalink( $link_to ) ); exit;
    }
}
add_action( 'template_redirect', 'iw21_quote_relationship_redirect' );

/**
 * Update the home field relationship
 */
function iw21_update_home_feed_relationship( $post_id ) {

    if ( ! in_array( get_post_type( $post_id ), array( 'post', 'work' ) ) )
        return;

    $home = get_page_by_title( 'Home' );

    $feed_object = get_field_object( 'selected_posts', $home->ID );

    if ( array_search( $post_id, $feed_object['value'] ) !== false )
        return;

    array_unshift( $feed_object['value'], $post_id );

    update_field(
        $feed_object['key'],
        $feed_object['value'],
        $home->ID
    );
}
// add_action( 'save_post', 'iw21_update_home_feed_relationship' );

/**
 * Shuffle home feed
 */
function iw21_shuffle_home_feed_posts() {
    $home = get_page_by_title( 'Home' );

    $feed_object = get_field_object( 'selected_posts', $home->ID );

    shuffle( $feed_object['value'] );

    echo '<pre>';
    print_r( $feed_object['value'] );
    echo '</pre>';
    die();
}
// add_action( 'admin_head', 'iw21_shuffle_home_feed_posts' );

/**
 * Get the post company and return;
 */
function iw21_post_company() {
    global $post;

    if ( $company = get_field( 'company' ) ) :
        return '<span class="post-company">'  . $company . '</span>';
    else :
        return false;
    endif;
}

/**
 * Render posts and work in relationship field
 */
function iw21_relationship_result( $title, $post, $field, $post_id ) {

	if ( $company = get_field( 'company', $post->ID ) ) {
        $title = sprintf( '%s // %s', $company, $title );
    }

    $template = sprintf( '<span class="acf-postmeta acf-postmeta-template">%s</span>', ucwords( iw21_template_nice_name( $post->ID ) ) );

    $post_type = sprintf( '<span class="acf-postmeta acf-postmeta-posttype acf-postmeta-posttype-%s">%s</span>', get_post_type( $post->ID ), ucwords( get_post_type( $post->ID ) ) );

    $title .= $post_type . $template;

	return $title;
}
add_filter('acf/fields/relationship/result', 'iw21_relationship_result', 10, 4);

/**
 * Filter drafts out from home relationship field
 */
function iw21_home_relationship_options_filter( $options, $field, $the_post ) {

	$options['post_status'] = array('publish');

	return $options;
}
add_filter('acf/fields/relationship/query/name=selected_posts', 'iw21_home_relationship_options_filter', 10, 3);

/**
 * Using FontAwesome with nav menus
 */
function iw21_replace_menu_items_with_icons( $items, $args ) {

	foreach ( $items as &$item ) {

		$icon = get_field( 'icon', $item );

		if ( $icon ) {
			$item->title = ' <span class="fa ' . $icon . '"></span>';
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'iw21_replace_menu_items_with_icons', 10, 2 );
