<?php

// Default list
$id = 'dc059ee81e';

if ( get_field( 'mailchimp' ) ) {
    $id = get_field( 'mailchimp' );
}

iw17_mailchimp_html_form( $id );
