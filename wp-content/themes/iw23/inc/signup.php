<?php

/**
 * 
 */
function iw23_handle_submission()
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
  $signup = iw23_process_signup($_POST);

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
add_action('parse_request', 'iw23_handle_submission');


/**
 * 
 */
function iw23_process_signup($postdata)
{

  /**
   * 1. This is all the important stuff. If this goes wrong, we want to return
   * —————————————————————————————————————————————————————————————————————————
   */
  try {

    /**
     * 1a. Check if postdata exists
     */
    $postdata = iw23_validate_submission($postdata); // 👍

    /**
     * 1b. Get download
     */
    $download = iw23_get_post($postdata['download'], 'media', false); // 👍

    /**
     * 1c. Get location
     */
    $location = iw23_get_post($postdata['location'], 'page'); // 👍

    /**
     * 1d. Notify Slack of the success
     */
    iw23_send_success_notification(array_merge($postdata, array(
      'location_title' => $location->post_title
    ))); // 👍

  } catch (Exception $e) {

    // Returns false
    return iw23_send_error_notification($e, $postdata); // 👍

  }

  /**
   * 2. Add lead to Copper
   * —————————————————————
   */
  try {
    iw23_add_lead_to_copper(array_merge($postdata, array(
      'location_title' => $location->post_title
    ))); // 👍
  } catch (Exception $e) {
    iw23_send_error_notification($e, $postdata); // 👍
  }

  /**
   * 3. Add lead to Mailchimp
   * ————————————————————————
   */
  try {
    iw23_add_lead_to_mailchimp($postdata); // 👍
  } catch (Exception $e) {
    iw23_send_error_notification($e, $postdata); // 👍
  }

  /**
   * 4. Add lead to Spreadsheet
   * ——————————————————————————
   */
  try {
    iw23_add_lead_to_spreadsheet($postdata, $download, $location); // 👍
  } catch (Exception $e) {
    iw23_send_error_notification($e, $postdata); // 👍
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
function iw23_validate_submission($payload)
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

  $location = iw23_decrypt($payload['location'], IW_PASSPHRASE);

  if (!get_post($location)) {
    throw new Exception('No location found');
    return false;
  }

  $download = get_post(iw23_decrypt($payload['download'], IW_PASSPHRASE))->ID ?? false;

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
function iw23_get_post($post_id, $post_type = 'post', $strict = true)
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

/**
 * 
 */
function iw23_wpcf7_send_success_notification($contact_form)
{

  $submission = WPCF7_Submission::get_instance();

  if (!$submission) {
    return;
  }

  $data = $submission->get_posted_data();

  error_log(print_r($data, true));

  // Get location
  $location = get_post($contact_form->id());

  // Message
  $message = vsprintf('*There was a new signup on %s*%c%c> Name: %s %s%c> Organisation: %s%c> Email: %s', array(
    $location->post_title,
    10,
    10,
    $data['first_name'] ?? 'N/A',
    $data['last_name'] ?? 'N/A',
    10,
    $data['organisation'] ?? 'N/A',
    10,
    $data['email'] ?? 'N/A',
  ));

  // Send Slack notification
  return iw23_send_slack_notification($message, 'success');
}
add_action("wpcf7_before_send_mail", "iw23_wpcf7_send_success_notification");
