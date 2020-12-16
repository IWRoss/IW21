<?php
/**
 * Advanced Custom Fields Functions
 *
 * @link http://www.advancedcustomfields.com/resources/
 *
 * @package Interactive_Workshops_2017
 */

/**
 * Add options page.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
if ( function_exists('acf_add_options_page') ) {

    acf_add_options_page( array(
        'page_title' => __( 'How it works', 'iw17' ),
        'menu_title' => __( 'Manual', 'iw17' ),
        'position'   => 1.1,
        'icon_url'   => 'dashicons-info'
    ) );

    acf_add_options_page( array(
        'page_title' => __( 'Client Logos', 'iw17' ),
        'menu_title' => __( 'Client Logos', 'iw17' ),
        'parent'     => 'options-general.php',
        'icon_url'   => 'dashicons-info'
    ) );

}

/**
 * Add styles for ACF.
 */
function iw17_acf_admin_head() {
    $style = str_replace( '%s', get_template_directory_uri(), file_get_contents( get_template_directory_uri() . '/acf.css' ));
    echo '<style type="text/css">/* ACF styles */' . $style . '</style>';
}
add_action( 'admin_head', 'iw17_acf_admin_head' );

/**
 * Add labels for Flexible Content layout blocks.
 */
function iw17_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {

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
add_filter('acf/fields/flexible_content/layout_title/name=path', 'iw17_acf_flexible_content_layout_title', 10, 4);
add_filter('acf/fields/flexible_content/layout_title/name=story', 'iw17_acf_flexible_content_layout_title', 10, 4);

/**
 * Add link for quote relationships
 */
function iw17_quote_relationship_redirect() {
    if ( $link_to = get_field( 'link_to' ) ) {
        wp_redirect( get_permalink( $link_to ) ); exit;
    }
}
add_action( 'template_redirect', 'iw17_quote_relationship_redirect' );

/**
 * Update the home field relationship
 */
function iw17_update_home_feed_relationship( $post_id ) {

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
// add_action( 'save_post', 'iw17_update_home_feed_relationship' );

/**
 * Shuffle home feed
 */
function iw17_shuffle_home_feed_posts() {
    $home = get_page_by_title( 'Home' );

    $feed_object = get_field_object( 'selected_posts', $home->ID );

    shuffle( $feed_object['value'] );

    echo '<pre>';
    print_r( $feed_object['value'] );
    echo '</pre>';
    die();
}
// add_action( 'admin_head', 'iw17_shuffle_home_feed_posts' );

/**
 * Get the post company and return;
 */
function iw17_post_company() {
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
function iw17_relationship_result( $title, $post, $field, $post_id ) {

	if ( $company = get_field( 'company', $post->ID ) ) {
        $title = sprintf( '%s // %s', $company, $title );
    }

    $template = sprintf( '<span class="acf-postmeta acf-postmeta-template">%s</span>', ucwords( iw17_template_nice_name( $post->ID ) ) );

    $post_type = sprintf( '<span class="acf-postmeta acf-postmeta-posttype acf-postmeta-posttype-%s">%s</span>', get_post_type( $post->ID ), ucwords( get_post_type( $post->ID ) ) );

    $title .= $post_type . $template;

	return $title;
}
add_filter('acf/fields/relationship/result', 'iw17_relationship_result', 10, 4);

/**
 * Use field to send emails for signoff by other users
 */
function iw17_send_email_for_signoff( $post_id ) {

    // bail early if no ACF data
    if ( empty( $_POST['acf'] ) ) {
        return;
    }

    if ( ! in_array( $_POST['post_type'], array( 'post', 'work' ) ) ) {
        return;
    }

    $user_ids = $_POST['acf']['field_5a7c3ef238e7e'];

    if ( empty( $user_ids ) ) {
        return;
    }

    $current_user = wp_get_current_user();

    $subject = sprintf( 'Post review request for IW: "%s"', wp_strip_all_tags( $_POST['post_title'] ) );

    $link = sprintf( get_site_url( null, '?p=%d&preview=true' ), sanitize_text_field( $_POST['post_ID'] ) );

    $message = sprintf(
        "You've received a request to review a post on the Interactive Workshops site from %s.\n\nPost Title:\n%s\n\nExcerpt:\n%s\n\nDirect link:\n%s\n\nYou need to login in order to view the post. Follow this link to login and be redirected to the post:\n%s",
        $current_user->user_login,
        wp_strip_all_tags( $_POST['post_title'] ),
        wp_strip_all_tags( $_POST['post_excerpt'] ),
        $link,
        wp_login_url( $link )
    );

    $emails = array();

    foreach ( $user_ids as $user_id ) {
        $user_info = get_userdata( $user_id );

        wp_mail( $user_info->user_email, $subject, $message );
    }

    $_POST['acf']['field_5a7c3ef238e7e'] = '';
}
// add_action( 'save_post', 'iw17_send_email_for_signoff', 1 );

/**
 * Filter drafts out from home relationship field
 */
function iw17_home_relationship_options_filter( $options, $field, $the_post ) {

	$options['post_status'] = array('publish');

	return $options;
}
add_filter('acf/fields/relationship/query/name=selected_posts', 'iw17_home_relationship_options_filter', 10, 3);

/**
 * Using FontAwesome with nav menus
 */
function iw17_replace_menu_items_with_icons( $items, $args ) {

	foreach ( $items as &$item ) {

		$icon = get_field( 'icon', $item );

		if ( $icon ) {
			$item->title = ' <span class="fa ' . $icon . '"></span>';
		}
	}

	return $items;
}
add_filter( 'wp_nav_menu_objects', 'iw17_replace_menu_items_with_icons', 10, 2 );
