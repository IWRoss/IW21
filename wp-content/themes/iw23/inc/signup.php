<?php

/**
 * 
 */
function iw21_handle_submission()
{

  /**
   * Reject requests to other requests
   */
  if (strpos($_SERVER["REQUEST_URI"], '/signup') === false) {
    return false;
  }

  /**
   * Process signup
   */
  $signup = iw21_process_signup($_POST);

  /**
   * Get default redirect URL
   */
  $redirect_url = get_field('success_url', 'option');

  /**
   * Swap it our for error URL if our signup didn't work
   */
  if (!$signup) {
    $redirect_url = get_field('error_url', 'option');
  }

  /**
   * And redirect
   */
  wp_safe_redirect(
    !empty($_POST['download'])
      ? sprintf('%s?dlid=%s', $redirect_url, rawurlencode($_POST['download']))
      : $redirect_url
  );
  exit;
}
add_action('parse_request', 'iw21_handle_submission');


/**
 * 
 */
function iw21_process_signup($postdata)
{

  /**
   * 1. This is all the important stuff. If this goes wrong, we want to return
   * —————————————————————————————————————————————————————————————————————————
   */
  try {

    /**
     * 1a. Check if postdata exists
     */
    $postdata = iw21_validate_submission($postdata); // 👍

    /**
     * 1b. Get download
     */
    $download = iw21_get_post($postdata['download'], 'media', false); // 👍

    /**
     * 1c. Get location
     */
    $location = iw21_get_post($postdata['location'], 'page'); // 👍

    /**
     * 1d. Notify Slack of the success
     */
    iw21_send_success_notification(array_merge($postdata, array(
      'location_title' => $location->post_title
    ))); // 👍

  } catch (Exception $e) {

    // Returns false
    return iw21_send_error_notification($e, $postdata); // 👍

  }

  /**
   * 2. Add lead to Copper
   * —————————————————————
   */
  try {
    iw21_add_lead_to_copper(array_merge($postdata, array(
      'location_title' => $location->post_title
    ))); // 👍
  } catch (Exception $e) {
    iw21_send_error_notification($e, $postdata); // 👍
  }

  /**
   * 3. Add lead to Mailchimp
   * ————————————————————————
   */
  try {
    iw21_add_lead_to_mailchimp($postdata); // 👍
  } catch (Exception $e) {
    iw21_send_error_notification($e, $postdata); // 👍
  }

  /**
   * 4. Add lead to Spreadsheet
   * ——————————————————————————
   */
  try {
    iw21_add_lead_to_spreadsheet($postdata, $download, $location); // 👍
  } catch (Exception $e) {
    iw21_send_error_notification($e, $postdata); // 👍
  }

  /**
   * 6. We're done! Return true to show success
   * ——————————————————————————————————————————
   */
  return true;
}

/**
 * 
 */
function iw21_validate_submission($payload)
{

  if (empty($payload)) {
    throw new Exception('No postdata');
    return false;
  }

  if (!$payload['email']) {
    throw new Exception('No email field');
    return false;
  }

  if (!$payload['first_name'] || !$payload['last_name']) {
    throw new Exception('Name provided is incomplete');
    return false;
  }

  if (!$payload['organisation']) {
    throw new Exception('No organisation field');
    return false;
  }

  $location = iw21_decrypt($payload['location'], IW_PASSPHRASE);

  if (!get_post($location)) {
    throw new Exception('No location found');
    return false;
  }

  $download = get_post(iw21_decrypt($payload['download'], IW_PASSPHRASE))->ID ?? false;

  return array(
    'email'             => $payload['email'],
    'download'          => $download,
    'location'          => $location,
    'first_name'        => $payload['first_name'],
    'last_name'         => $payload['last_name'],
    'organisation'      => $payload['organisation'],
  );
}

/**
 * 
 */
function iw21_get_post($post_id, $post_type = 'post', $strict = true)
{

  $the_post = get_post($post_id);

  if (!$the_post && $strict) {
    throw new Exception("No {$post_type} found with that ID");
  }

  if (!$the_post) {
    return false;
  }

  return $the_post;
}
