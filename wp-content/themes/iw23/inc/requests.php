<?php

/**
 * Custom function for POST requests
 */
function iw23_post_request($url, $data, $headers = array(), $type = 'POST', $encode_to_json = true)
{

    $payload = $encode_to_json ? json_encode($data) : $data;

    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL             => $url,
        CURLOPT_CUSTOMREQUEST   => $type,
        CURLOPT_POSTFIELDS      => $payload,
        CURLOPT_HTTPHEADER      => array_merge(
            $encode_to_json ? array('Content-Type:application/json') : [],
            $headers
        ),
        CURLOPT_RETURNTRANSFER  => true
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}

/**
 * Wrapper function for PUT requests
 */
function iw23_put_request($url, $data, $headers = array())
{
    return iw23_post_request($url, $data, $headers, 'PUT');
}

/**
 * 
 */
function iw23_send_error_notification(Exception $e, $data = array())
{
    // Message
    $message = sprintf('There was an error on the Interactive Workshops site: `%s`%c```%s```', $e->getMessage(), 10, json_encode($data, JSON_PRETTY_PRINT));

    // Send Slack notification
    return iw23_send_slack_notification($message, 'error');
}

/**
 * 
 */
function iw23_send_success_notification($data = array())
{
    // Message
    $message = vsprintf('*There was a new signup on %s*%c%c> Name: %s %s%c> Organisation: %s%c> Email: %s', array(
        $data['location_title'],
        10,
        10,
        $data['first_name'],
        $data['last_name'],
        10,
        $data['organisation'],
        10,
        $data['email']
    ));

    // Send Slack notification
    return iw23_send_slack_notification($message, 'success');
}

/**
 * 
 */
function iw23_send_slack_notification($message, $status = 'error')
{

    $request = iw23_post_request(
        get_field(sprintf('signup_slack_%s_hook', $status), 'option'),
        array('text' => $message)
    );

    return $request;
}

/**
 * 
 */
function iw23_add_lead_to_copper($postdata)
{

    /**
     * Check to make sure Copper integration has tag to log signup source
     */
    $add_tags = array(get_the_title($postdata['location']));

    /**
     * Check to make sure Copper integration has credentials
     */
    $copper_api_key = get_field('signup_copper_api', 'option');
    $copper_email = get_field('signup_copper_email', 'option');

    if (!$copper_api_key || !$copper_email) {
        throw new Exception('Copper integration not set up properly');
        return false;
    }

    /**
     * We'll use these headers for all the requests
     */
    $headers = iw23_prepare_headers(array(
        'X-PW-AccessToken'  => $copper_api_key,
        'X-PW-Application'  => 'developer_api',
        'X-PW-UserEmail'    => $copper_email,
    ));

    /**
     * Get Person from Copper
     * ======================
     * If the person exists already, we want to update their tags and quit
     */

    $person = iw23_post_request(
        'https://api.prosperworks.com/developer_api/v1/people/fetch_by_email',
        array(
            'email' => $postdata['email']
        ),
        $headers
    );

    if ($person['success'] !== false) {
        // Add tag to list if it doesn't exist
        $add_tags = in_array($add_tags[0], $person['tags'])
            ? $person['tags']
            : array_merge($person['tags'], $add_tags);

        // Update person
        return iw23_put_request(
            sprintf('https://api.prosperworks.com/developer_api/v1/people/%s', $person['id']),
            array(
                'tags' => $add_tags
            ),
            $headers
        );
    }

    /**
     * Get Lead from Copper
     * ====================
     * Only necessary because if the lead already exists, we don't want
     * to overwrite their tags
     */

    $leads = iw23_post_request(
        'https://api.prosperworks.com/developer_api/v1/leads/search',
        array(
            'page_size' => 25,
            'sort_by'   => 'name',
            'emails'    => $postdata['email']
        ),
        $headers
    );

    /**
     * If we have a lead, we may already have tags. Let's check!
     */
    if ($leads) {
        // Add tag to list if it doesn't exist
        $add_tags = in_array($add_tags[0], $leads[0]['tags'])
            ? $leads[0]['tags']
            : array_merge($leads[0]['tags'], $add_tags);

        // Add custom field if it doesn't exist
        foreach ($leads[0]['custom_fields'] as &$custom_field) {

            if ($custom_field['custom_field_definition_id'] != get_field('signup_copper_custom_field_id', 'option')) {
                continue;
            }

            if (strpos($custom_field['value'], $postdata['location']) !== false) {
                continue;
            }

            $custom_field['value'] = implode(
                ', ',
                array_filter(
                    array_merge(
                        explode(', ', $custom_field['value']),
                        array($postdata['location_title'])
                    )
                )
            );
        }
    }

    /**
     * Let's UPSERT
     */
    return iw23_put_request(
        'https://api.prosperworks.com/developer_api/v1/leads/upsert',
        array(
            'properties'    => array(
                'name'          => $postdata['first_name'] . ' ' . $postdata['last_name'],
                'email'         => array(
                    'email'     => $postdata['email'],
                    'category'  => 'work',
                ),
                'tags' => $add_tags,
                'custom_fields' => $leads[0]['custom_fields']
            ),
            'match'         => array(
                'field_name'    => 'email',
                'field_value'   => $postdata['email']
            ),
        ),
        $headers
    );
}

/**
 * 
 */
function iw23_add_lead_to_mailchimp($postdata)
{

    if (!$postdata['marketing']) {
        return false;
    }

    // Add lead to mailchimp
    return iw23_post_request(
        sprintf('https://us5.api.mailchimp.com/3.0/lists/%s/members/', get_field('signup_mailchimp_list_id', 'option')),
        array(
            'email_address' => $postdata['email'],
            'status'        => 'subscribed',
            'merge_fields'  => array(
                'FNAME' => $postdata['first_name'],
                'LNAME' => $postdata['last_name'],
            )
        ),
        iw23_prepare_headers(array(
            'Authorization' => sprintf('apikey %s', get_field('signup_mailchimp_api', 'option'))
        ))
    );
}

/**
 * 
 */
function iw23_add_lead_to_spreadsheet($postdata, $download)
{

    $data = array(
        'submission'    => $postdata,
        'download'      => $download->post_title
    );

    return iw23_post_request(
        get_field('signup_update_spreadsheet_hook', 'option'),
        $data
    );
}

/**
 * Very basic function to convert a key-value array 
 * to an array of headers for cURL
 */
function iw23_prepare_headers($headers)
{

    return array_map(function ($k, $v) {
        return sprintf('%s: %s', $k, $v);
    }, array_keys($headers), $headers);
}
