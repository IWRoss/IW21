<?php
/**
 * Separating logic from our templates as best as possible
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Add HTML attributes to feed item outer tags
 */
function iw21_feed_item_html_outer_tag_attributes($template_args = false) {

    global $post;

    $attributes = sprintf('class="grid-item feed-item %s"', iw21_get_the_post_classes_string());

    if ($preview = get_field('preview')) {
        $attributes .= sprintf(' style="background-image: url(%s)"', $preview);
    }
    
    $thumb_url_array = wp_get_attachment_image_src(
        get_post_thumbnail_id(),
        'iw21-feed',
        true
    );

    if ($thumb_url_array && ! $preview) {
        $attributes .= sprintf(' style="background-image: url(%s)"', $thumb_url_array[0]);
    }

    if ($template_args) {
        $attributes .= sprintf(' data-index="%d"', $template_args['index']);
    }

    echo $attributes;
}
add_action('iw21_feed_item_html_outer_tag_attributes', 'iw21_feed_item_html_outer_tag_attributes', 10);

/**
 * Add HTML attributes to feed item link tags
 */
function iw21_feed_item_html_link_tag_attributes() {

    global $post;

    $post_link = get_permalink();

    if ($has_link = get_field('link_to_url')) {
        $post_link = $has_link;
    }

    $attributes = sprintf('href="%s"', $post_link);

    if ($has_link) {
        $attributes .= sprintf(' target="_blank"');
    }

    if ($oembed = get_field('video')) {
        // use preg_match to find iframe src
        preg_match('/src="(.+?)"/', $oembed, $matches);

        $src = $matches[1];

        $attributes = sprintf('href="%s" data-lity', $src); 
    }

    echo $attributes;
}
add_action('iw21_feed_item_html_link_tag_attributes', 'iw21_feed_item_html_link_tag_attributes', 10);

/**
 * Add author image to feed item if exists
 */
function iw21_author_image() {

    global $post;

    if (get_post_type() === 'work') {
        return;
    }

    if (get_field('video')) {
        return;
    }

    $user_author_image = get_field('author_image', 'user_' . get_the_author_meta('ID'));

    if ($user_author_image) {
        echo sprintf('<img src="%s" alt="Author" class="author-image">', $user_author_image);
    }
}
add_action('iw21_author_image', 'iw21_author_image', 10);

/**
 * Add overlay to feed item if exists
 */
function iw21_feed_overlay() {

    global $post;

    if ($overlay = get_field('overlay')) {
        echo sprintf('<div class="sketch-overlay" style="background-image:url(\'%s\')"></div>', $overlay['url']);
    }
}
add_action('iw21_feed_overlay', 'iw21_feed_overlay', 10);

/**
 * Create a team member image with modal link
 */
function iw21_team_member_image($member) {

    // Image
    $attributes = '';

    if ($team_image = get_field('team_image', 'user_' . $member['ID'])) {

        $attributes = sprintf(
            ' style="background-image:url(\'%s\')"',
            $team_image['sizes']['medium_large']
        );

    }

    // Link
    $link = sprintf(
        '<a href="#" rel="team-%d" data-iw-modal="open" class="team-modal--open">Click for bio</a>',
        $member['ID']
    );

    // Put it together
    echo sprintf(
        '<div class="team-member--img"%s>%s</div>',
        $attributes,
        $link
    );

}
add_action('iw21_team_member_image', 'iw21_team_member_image', 10);

/**
 * 
 */
function iw21_sharing_links() {

    global $post;

    if (get_post_type() !== 'post' && get_post_type() !== 'work') {
        return;
    }

    get_template_part('template-parts/post/element', 'sharing-links');
		
}
add_action('iw21_content_footer', 'iw21_sharing_links', 10);

/**
 * 
 */
function iw21_oembed_video() {

    global $post;

    if ($oembed = get_field('video')) :
        echo sprintf('<div class="video-wrapper">%s</div>', $oembed);
    endif;
    
}
add_action('iw21_after_content', 'iw21_oembed_video', 10);