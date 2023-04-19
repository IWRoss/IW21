<?php

/**
 * Set experiments
 */
function iw21_experiments()
{

    if (!session_id()) {
        return false;
    }

    $experiments = array(
        // 'hamburger' => 'private',
        'megamenu' => 'public',
    );

    $whitelist = array(
        '185.214.182.226',  // IW
        '51.148.163.134',   // Mi Casa
        '127.0.0.1'         // Local
    );

    foreach ($experiments as $experiment => $visibility) {

        $in_whitelist = in_array($_SERVER["REMOTE_ADDR"], $whitelist);

        $bool = $in_whitelist ? true : ($visibility === 'private' ? false : ($visibility === 'public' ? true : (bool)random_int(0, 1)));

        $flag = 'experiment_' . $experiment;

        $_SESSION[$flag] = isset($_SESSION[$flag]) ? $_SESSION[$flag] : $bool;
    }
}
add_action('init', 'iw21_experiments', 10);

/**
 * Get experiments
 */
function iw21_get_experiments()
{

    if (!isset($_SESSION) || !is_array($_SESSION)) {
        return [];
    }

    $experiments = array_filter($_SESSION, function ($value, $key) {
        return strpos($key, 'experiment') !== -1 ? $value : false;
    }, ARRAY_FILTER_USE_BOTH);

    return array_keys($experiments);
}

/**
 * 
 */
function iw21_add_experiments_to_body_class($classes)
{
    $experiments = iw21_get_experiments();

    return array_merge($classes, is_array($experiments) ? array_map(function ($value) {
        return str_replace('_', '-', $value);
    }, $experiments) : []);
}
add_filter('body_class', 'iw21_add_experiments_to_body_class');

/**
 * 
 */
function iw21_convert_block_color_fields_to_block_colors($post_id, $a_post, $update)
{
    /**
     * Reject requests to other requests
     */
    // if (strpos($_SERVER["REQUEST_URI"], '/iw21_convert_block_color_fields_to_block_colors') === false) {
    //     return false;
    // }

    $color_conversions = array(
        'orange' => 'iw-orange',
        'blue' => 'iw-teal',
        'black' => 'iw-black',
        'white' => 'iw-white',
    );

    $blocks = array_map(function ($el) use ($color_conversions) {

        $pattern = '/\{(?:[^{}]|(?R))*\}/x';

        preg_match_all($pattern, $el, $matches);

        foreach ($matches[0] as $match) {
            $data = json_decode($match, true);

            if (!empty($data['data']['background_color'])) {

                // You need to check to see if we need to convert the colour, or if it's custom
                if (in_array($data['data']['background_color'], array_keys($color_conversions))) {
                    $data['backgroundColor'] = $color_conversions[$data['data']['background_color']];
                } else {
                    unset($data['backgroundColor']);
                    $data['style']['color']['background'] = $data['data']['background_color'];
                }
            }

            if (!empty($data['data']['text_color'])) {

                // You need to check to see if we need to convert the colour, or if it's custom
                if (in_array($data['data']['text_color'], array_keys($color_conversions))) {
                    $data['textColor'] = $color_conversions[$data['data']['text_color']];
                } else {
                    unset($data['textColor']);
                    $data['style']['color']['text'] = $data['data']['text_color'];
                }
            }

            $el = str_replace($match, json_encode($data), $el);
        }

        return $el;
    }, explode("\n", $a_post->post_content));

    // unhook this function so it doesn't loop infinitely
    remove_action('save_post', 'iw21_convert_block_color_fields_to_block_colors');

    // update the post, which calls save_post again
    wp_update_post(array('ID' => $post_id, 'post_content' => implode("\n", $blocks)));

    // re-hook this function
    add_action('save_post', 'iw21_convert_block_color_fields_to_block_colors', 10, 3);
}
// add_action('save_post', 'iw21_convert_block_color_fields_to_block_colors', 10, 3);


/**
 * 
 */
function iw21_update_all_posts_with_block_colors()
{

    /**
     * Reject requests to other requests
     */
    if (strpos($_SERVER["REQUEST_URI"], '/iw21_update_all_posts_with_block_colors') === false) {
        return false;
    }

    $posts = get_posts(array(
        'post_type' => 'any',
        'posts_per_page' => -1,
    ));

    $color_conversions = array(
        'orange' => 'iw-orange',
        'blue' => 'iw-teal',
        'black' => 'iw-black',
        'white' => 'iw-white',
    );

    foreach ($posts as $a_post) {

        if (!in_array($a_post->post_type, ['page', 'post', 'work'])) {
            continue;
        }

        $blocks = array_map(function ($el) use ($color_conversions) {

            $pattern = '/\{(?:[^{}]|(?R))*\}/x';

            preg_match_all($pattern, $el, $matches);

            foreach ($matches[0] as $match) {
                $data = json_decode($match, true);

                if (!empty($data['data']['background_color'])) {

                    // You need to check to see if we need to convert the colour, or if it's custom
                    if (in_array($data['data']['background_color'], array_keys($color_conversions))) {
                        $data['backgroundColor'] = $color_conversions[$data['data']['background_color']];
                    } else {
                        unset($data['backgroundColor']);
                        $data['style']['color']['background'] = $data['data']['background_color'];
                    }
                }

                if (!empty($data['data']['text_color'])) {

                    // You need to check to see if we need to convert the colour, or if it's custom
                    if (in_array($data['data']['text_color'], array_keys($color_conversions))) {
                        $data['textColor'] = $color_conversions[$data['data']['text_color']];
                    } else {
                        unset($data['textColor']);
                        $data['style']['color']['text'] = $data['data']['text_color'];
                    }
                }

                $el = str_replace($match, json_encode($data), $el);
            }

            return $el;
        }, explode("\n", $a_post->post_content));

        wp_update_post(array('ID' => $a_post->ID, 'post_content' => implode("\n", $blocks)));
    }
}
add_action('parse_request', 'iw21_update_all_posts_with_block_colors');
