/**
 * File admin.js.
 */

( function( $ ) {

    $( 'a[data-shuffle]' ).click( function(e) {

        e.preventDefault();

        var shuffle = $(this).data( 'shuffle' ),
            $archive = $( '#refreshing-the-archives' );

        $.ajax( {
            url: ajaxsort.ajaxurl,
            type: 'post',
            data: {
                action: 'sort_dates_of_posts',
                type: shuffle,
                security: ajaxsort.nonce
            },
            beforeSend: function(){
                $archive.find( '.loading' ).remove();
                $archive.append( '<p class="loading">Working...</p>');
            },
            success: function( result ) {
                $( '.loading' ).html( result );
            }
        } );

    } );

} )( jQuery );
