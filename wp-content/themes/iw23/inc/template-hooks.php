<?php

/**
 * Separating logic from our templates as best as possible
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Add HTML attributes to feed item outer tags
 */
function iw21_feed_item_html_outer_tag_attributes($template_args = false)
{

    global $post;

    $attributes = sprintf('class="grid-item feed-item %s"', iw21_get_the_post_classes_string());

    if ($preview = get_field('preview', $post->ID)) {
        $attributes .= sprintf(' style="background-image: url(%s)"', $preview);
    }

    if ($template_args['thumbnail']) {
        $attributes .= sprintf(' style="background-image: url(%s)"', $template_args['thumbnail']);
    }

    $thumb_url_array = wp_get_attachment_image_src(
        get_post_thumbnail_id(),
        'iw21-feed',
        true
    );

    if ($thumb_url_array && !$preview) {
        $attributes .= sprintf(' style="background-image: url(%s)"', $thumb_url_array[0]);
    }

    if ($template_args) {
        $attributes .= sprintf(' data-index="%d" data-chunk="%d"', $template_args['index'], $template_args['chunk']);
    }

    echo $attributes;
}
add_action('iw21_feed_item_html_outer_tag_attributes', 'iw21_feed_item_html_outer_tag_attributes', 10);
add_action('iw21_menu_featured_item_html_outer_tag_attributes', 'iw21_feed_item_html_outer_tag_attributes', 10);

/**
 * Add HTML attributes to feed item link tags
 */
function iw21_feed_item_html_link_tag_attributes($template_args = false)
{

    global $post;

    $post_link = get_permalink();

    if ($has_link = get_field('link_to_url', $post)) {
        $post_link = $has_link;
    }

    if ($template_args['link']) {
        $post_link = $template_args['link'];
    }

    $attributes = sprintf('href="%s"', $post_link);

    if ($has_link && strpos($post_link, get_site_url()) === false) {
        $attributes .= ' target="_blank"';
    }

    if ($oembed = get_field('video', $post)) {
        // use preg_match to find iframe src
        preg_match('/src="(.+?)"/', $oembed, $matches);

        $src = $matches[1];

        $attributes = sprintf('href="%s" data-lity', $src);
    }

    echo $attributes;
}
add_action('iw21_feed_item_html_link_tag_attributes', 'iw21_feed_item_html_link_tag_attributes', 10);
add_action('iw21_menu_featured_item_html_link_tag_attributes', 'iw21_feed_item_html_link_tag_attributes', 10);

/**
 * Add author image to feed item if exists
 */
function iw21_author_image()
{

    global $post;

    // if (get_post_type() === 'work') {
    //     return;
    // }

    if (get_field('video', $post->ID)) {
        return;
    }

    $user_author_id = get_the_author_meta('ID');

    $user_author_image = get_field('author_image', 'user_' . $user_author_id);

    if ($user_author_image && get_the_author_meta('nickname') !== 'IW Team') {
        echo sprintf('<img src="%s" alt="Author" class="author-image">', $user_author_image);
    }
}
add_action('iw21_author_image', 'iw21_author_image', 10);

/**
 * Add overlay to feed item if exists
 */
function iw21_feed_overlay()
{

    global $post;

    if ($overlay = get_field('overlay')) {
        echo sprintf('<div class="sketch-overlay" style="background-image:url(\'%s\')"></div>', $overlay['url']);
    }
}
add_action('iw21_feed_overlay', 'iw21_feed_overlay', 10);

/**
 * Add overlay to feed item if exists
 */
function iw21_post_icon()
{

    global $post;

    // Outcome class
    $outcomes = get_the_terms($post->post_id, 'outcome');

    if (is_array($outcomes)) {
        echo sprintf('<div class="post-icon post-icon-%s"><span class="outcome">%s</span><img src="%s/imgs/feed-icons/%s.svg" class=""></div>', $outcomes[0]->slug, $outcomes[0]->name, get_template_directory_uri(), $outcomes[0]->slug);
    }
}
add_action('iw21_post_icon', 'iw21_post_icon', 10);

/**
 * Create a team member image with modal link
 */
function iw21_team_member_image($member)
{

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
function iw21_sharing_links()
{

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
function iw21_oembed_video()
{

    global $post;

    if ($oembed = get_field('video')) :
        echo sprintf('<div class="video-wrapper">%s</div>', $oembed);
    endif;
}
add_action('iw21_after_content', 'iw21_oembed_video', 10);

/**
 * 
 */
function iw21_footer_scripts()
{

    global $post;

    if ($oembed = get_field('video')) :
        echo sprintf('<div class="video-wrapper">%s</div>', $oembed);
    endif;
}
add_action('iw21_after_footer', 'iw21_footer_scripts', 10);

/**
 * 
 */
function iw21_connect_rsvps_on_form_submit($request)
{

    // Get the params from the request
    $parameters = json_decode($request->get_body(), true);

    // Get the email
    $email = $parameters['submission']['email'];

    // Find the reference for the field containing the events
    $events_field_listen_ref = $parameters['submission']['field-listen[value]'];

    // If multiple refs separated by a comma, break apart and pull in all the refs
    // if (strpos($events_field_listen_ref, ',') !== false) {

    //     $events = [];

    //     $events_field_listen_refs = explode(',', $events_field_listen_ref);

    //     foreach($events_field_listen_refs as $ref) {
    //         $events[] = explode(', ', $parameters['submission'][$ref]);
    //     }

    // } else {

    // Get the events using the field reference, and explode on comma
    $events = explode(', ', $parameters['submission'][$events_field_listen_ref]);

    // }


    // If the ID of the field isn't a calendar ID, remove it from our array
    $events = array_filter($events, function ($el) {

        if (strlen($el) != 26) {
            return false;
        }

        return true;
    });

    $results = [];

    /**
     * For each event, submit to Zapier for processing
     */
    foreach ($events as $event) {

        $url = 'https://hooks.zapier.com/hooks/catch/9327164/o00n6a1/';
        // $url = 'https://d96d0487377ef05608b7c074bdb077d4.m.pipedream.net';

        $payload = array(
            'submission' => array(
                'field-event-id[value]' => $event,
                'email' => $email
            )
        );

        $fields_string = json_encode($payload);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($fields_string)
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $results[$event] = json_decode(curl_exec($ch));
    }

    return $results;
}
add_action('rest_api_init', function () {
    register_rest_route('rsvps/v1', 'add/', array(
        'methods' => 'POST',
        'callback' => 'iw21_connect_rsvps_on_form_submit',
        'permission_callback' => '__return_true'
    ));
});

/**
 * 
 */
function iw21_add_email_to_event_with_link($request)
{

    if (strpos($_SERVER["REQUEST_URI"], '/event-signup') === false) {
        return false;
    }

    if (!isset($_GET['event']) || !isset($_GET['email'])) {
        return false;
    }

    $event_data = explode(' ', base64_decode($_GET['event']));

    $email = $_GET['email'];

    $url = 'https://hooks.zapier.com/hooks/catch/9327164/o00n6a1/';

    $payload = array(
        'submission' => array(
            'field-event-id[value]' => $event_data[0],
            'email' => $email
        )
    );

    $fields_string = json_encode($payload);

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($fields_string)
    ));

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $execute = json_decode(curl_exec($ch));

    wp_redirect(get_permalink(get_page_by_title('You\'re signed up!')));
    exit;
}
add_action('parse_request', 'iw21_add_email_to_event_with_link');

// function iw21_add_email_to_event_with_link($request)
// {

//     if (! isset($_GET['event']) || !isset($_GET['email'])) {
//         return false;
//     }

//     $event_data = explode(' ', base64_decode($_GET['event']));

//     $email = $_GET['email'];

//     $url = 'https://hooks.zapier.com/hooks/catch/9327164/o00n6a1/';

//     $payload = array(
//         'submission' => array(
//             'field-event-id[value]' => $event_data[0],
//             'email' => $email
//         )
//     );

//     $fields_string = json_encode($payload);

//     //open connection
//     $ch = curl_init();

//     //set the url, number of POST vars, POST data
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         'Content-Type: application/json',
//         'Content-Length: ' . strlen($fields_string)
//     ));

//     //So that curl_exec returns the contents of the cURL; rather than echoing it
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//     return json_decode(curl_exec($ch));
// }
// add_action('rest_api_init', function () {
//     register_rest_route('rsvps/v1', 'single/', array(
//         'methods' => 'GET',
//         'callback' => 'iw21_add_email_to_event_with_link',
//         'permission_callback' => '__return_true'
//     ));
// });
