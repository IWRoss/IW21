<?php
/**
 * Remove Comments completely. The Nuclear option
 *
 * @package Interactive_Workshops_2017
 */

/**
 * Removes Comments from admin menu.
 */
function iw17_remove_admin_menus() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'iw17_remove_admin_menus' );

/**
 * Removes Comments from post and pages.
 */
function iw17_remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'iw17_remove_comment_support', 100);

/**
 * Removes Comments from admin bar.
 */
function iw17_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' );
}
add_action( 'wp_before_admin_bar_render', 'iw17_admin_bar_render' );
