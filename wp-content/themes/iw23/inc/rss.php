<?php

function iw23_process_ajax_rss_feed_get_request()
{
  // Convert payload from URL parameters into array
  parse_str($_POST['payload'], $payload);

  // Check if the nonce is valid
  if (!wp_verify_nonce($payload['nonce'], 'iw21-nonce')) {
    wp_send_json_error(array('message' => 'Invalid token'));
  }

  // Get the RSS feed
  $rss_items = iw23_get_rss_feed($payload['url']);

  // Check if the RSS feed is valid
  if (empty($rss_items)) {
    wp_send_json_error(array('message' => 'Invalid RSS feed'));
  }

  // Prepare the response
  $response = array();

  foreach ($rss_items as $item) {


    $response[] = iw23_get_template_part('template-parts/feed/feed', 'item', array(
      'title' => $item->get_title(),
      'link' => $item->get_permalink(),
      'date' => $item->get_date('j F Y'),
      'thumbnail' => $item->get_enclosure()->get_thumbnail(),
      // 'excerpt' => $item->get_enclosure()->get_description(),
    ), false);
  }

  // Send the response
  wp_send_json_success($response);
}
add_action('wp_ajax_nopriv_process_ajax_rss_feed_get_request', 'iw23_process_ajax_rss_feed_get_request');
add_action('wp_ajax_process_ajax_rss_feed_get_request', 'iw23_process_ajax_rss_feed_get_request');

/**
 * Read the RSS feed
 */
function iw23_get_rss_feed($url)
{
  $rss = fetch_feed($url);

  if (!is_wp_error($rss)) {
    $maxitems = $rss->get_item_quantity(5);
    $rss_items = $rss->get_items(0, $maxitems);
  }

  return $rss_items;
}
