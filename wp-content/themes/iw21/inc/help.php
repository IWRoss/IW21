<?php
/**
 * These functions create Help dialogs and meta boxes.
 *
 * @package Interactive_Workshops_2021
 */


/**
 * Add a tab with instructions on labelling posts to the Help dropdown.
 */
function iw21_posts_help_tab() {
    $screen = get_current_screen();

    if ( $screen->post_type === 'post' || $screen->post_type === 'work' ) :
        $content = '<h3>How to label posts</h3> <table class="widefat fixed"> <thead> <tr> <th>I want to make a(n):</th> <th width="20px"></th> <th>Post Type</th> <th>Template</th> <th>Category</th> </tr> </thead> <tbody> <tr> <td>Feature</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work</td> <td>Default</td> <td>Portfolio</td> </tr> <tr> <td>Story</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work</td> <td>Story</td> <td>Portfolio</td> </tr> <tr> <td>Quote</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work</td> <td>Quote</td> <td>Portfolio</td> </tr> <tr> <td>Storyboard</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work or <span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Storyboard</td> <td>Portfolio or Insights</td> </tr> <tr> <td>Infographic</td> <td>&rarr;</td> <td><span class="dashicons dashicons-lightbulb"></span> Work or <span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Infographic</td> <td>Portfolio or Insights</td> </tr> <tr> <td>Insight</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Insight</td> <td>Insights</td> </tr> <tr> <td>Event</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Event</td> <td>Events</td> </tr> <tr> <td>Thought</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Thought</td> <td>Thoughts</td> </tr> <tr> <td>Video</td> <td>&rarr;</td> <td><span class="dashicons dashicons-admin-post"></span> Posts</td> <td>Video</td> <td>Videos</td> </tr> </tbody> </table> <p>Posts (general term) are split into two different <strong>Post Types</strong>: <span class="dashicons dashicons-admin-post"></span> <strong>Posts</strong> and <span class="dashicons dashicons-lightbulb"></span><strong>Work</strong>. Use Work posts for any post directly related to a single client, and for everything else use Posts.</p> <p>The <strong>Template</strong> defines how the post looks in the feed and on a single post page. Any post with the <strong>Quote</strong> or <strong>Thought</strong> template will only appear in the feed.</p> <p>Additionally, the <strong>Category</strong> and <strong>Tags</strong> help visitors find similar posts and are displayed at the bottom of the page on Insights.</p>';

        $screen->add_help_tab( array(
            'id'	=> 'iw21_posts_help',
            'title'	=> __( 'How to label Posts' ),
            'content'	=> $content,
        ) );
    endif;

}

add_action( 'load-post.php', 'iw21_posts_help_tab' );
add_action( 'load-post-new.php', 'iw21_posts_help_tab' );
