<?php

/**
 * Set the default admin color scheme for WordPress user.
 */
add_filter('get_user_option_admin_color', function($result) {

    // set new default admin color scheme
    $result = 'blue';

    // return the new default color
    return $result;
} );
