<?php
/**
 * These functions create Help dialogs and meta boxes.
 *
 * @package Interactive_Workshops_2017
 */


/**
 * Add a tab with instructions on labelling posts to the Help dropdown.
 */
function iw17_posts_help_tab () {
    $screen = get_current_screen();

    if ( $screen->post_type === 'post' || $screen->post_type === 'work' ) :
        $content = '<h3>How to label posts</h3> <table class="widefat fixed"> <thead> <tr> <th>I want to make a(n):</th> <th width="20px"></th> <th>Post Type</th> <th>Template</th> <th>Category</th> </tr> </thead> <tbody> <tr> <td>Feature</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work</td> <td>Default</td> <td>Portfolio</td> </tr> <tr> <td>Story</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work</td> <td>Story</td> <td>Portfolio</td> </tr> <tr> <td>Quote</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work</td> <td>Quote</td> <td>Portfolio</td> </tr> <tr> <td>Storyboard</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work or <span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Storyboard</td> <td>Portfolio or Insights</td> </tr> <tr> <td>Infographic</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work or <span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Infographic</td> <td>Portfolio or Insights</td> </tr> <tr> <td>Insight</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Insight</td> <td>Insights</td> </tr> <tr> <td>Event</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Event</td> <td>Events</td> </tr> <tr> <td>Thought</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Thought</td> <td>Thoughts</td> </tr> <tr> <td>Video</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Video</td> <td>Videos</td> </tr> </tbody> </table> <p>Posts (general term) are split into two different <strong>Post Types</strong>: <span class="dashicons dashicons-admin-post"></span> <strong>Posts</strong> and <span class="dashicons dashicons-lightbulb"></span><strong>Work</strong>. Use Work posts for any post directly related to a single client, and for everything else use Posts.</p> <p>The <strong>Template</strong> defines how the post looks in the feed and on a single post page. Any post with the <strong>Quote</strong> or <strong>Thought</strong> template will only appear in the feed.</p> <p>Additionally, the <strong>Category</strong> and <strong>Tags</strong> help visitors find similar posts and are displayed at the bottom of the page on Insights.</p>';

        $screen->add_help_tab( array(
            'id'	=> 'iw17_posts_help',
            'title'	=> __( 'How to label Posts' ),
            'content'	=> $content,
        ) );
    endif;

}

add_action( 'load-post.php', 'iw17_posts_help_tab' );
add_action( 'load-post-new.php', 'iw17_posts_help_tab' );

/**
 * Add a meta box above the Publish post box on posts.
 */
function iw17_register_help_meta_box() {
    add_meta_box(
        'meta-box-id',
        __( 'Need help?', 'textdomain' ),
        'iw17_help_meta_display_callback',
        array( 'post', 'work'),
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'iw17_register_help_meta_box' );

/**
 * The function for displaying the meta box.
 */
function iw17_help_meta_display_callback( $post ) {
    echo '<p><img src="' . get_template_directory_uri() . '/imgs/manual/hardyandhinds.svg" alt="Hardy and Hinds" /></p>';
    echo '<p>To see a guide to labelling the <strong>Post Type</strong>, <strong>Category</strong>, <strong>Template</strong>, and <strong>Tags</strong> correctly, click the <strong>Help</strong> dropdown in the top right corner of the screen.</p>';
}

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function iw17_add_manual_dashboard_widget() {
    wp_add_dashboard_widget(
         'iw17_manual_widget',
         'Manual',
         'iw17_manual_widget'
    );

    wp_add_dashboard_widget(
         'iw17_utility_widget',
         'Utility',
         'iw17_utility_widget'
    );
}
add_action( 'wp_dashboard_setup', 'iw17_add_manual_dashboard_widget' );

/**
 * Create the function to output the contents of our Manual Dashboard Widget.
 */
function iw17_manual_widget() {
    echo '<img src="' . get_template_directory_uri() . '/imgs/logo-dark.svg" alt="Interactive Workshops" style="width: 100%;" />';
    echo '<p>The new Interactive Workshops site is built using a plugin called <strong><a href="http://www.advancedcustomfields.com">Advanced Custom Fields</a></strong>. Basically, imagine Wordpress with steroids.</p><p>Before you use the site, make sure you check out the manual for a guide on how to add <strong>Posts</strong>, <strong>Pages</strong>, and <strong>Users</strong> the right way.</p>';
    echo '<p><a href="' . admin_url( 'admin.php?page=acf-options-manual' ) . '" class="button button-primary">Go to the manual</a> <a href="mailto:ross@nevisonhardy.co.uk" class="button">Get  support</a></p>';
}

/**
 * Create the function to output the contents of our Utility Dashboard Widget.
 */
function iw17_utility_widget() {
    echo '<div id="refreshing-the-archives"><h4>Refreshing the Archives</h4><p>These buttons refresh the Work and Journal feeds to match the order on the Home feed. <strong>Please don\'t click these buttons unless you know what you\'re doing!</strong></p><p><a href="#" class="button" data-shuffle="post">Refresh Posts</a> <a href="#" class="button" data-shuffle="work">Refresh Work</a></p></div>';
}
