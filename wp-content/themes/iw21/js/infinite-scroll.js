(function($){
    
    var chunk = 1;

    var masonryOptions = {
        itemSelector: '.grid-item',
        columnWidth: '.masonry-grid-sizer',
        gutter: '.masonry-gutter-sizer',
        percentPosition: true,
        transitionDuration: 0
    };

    // We're now tracking our progress in the URL, so we'll need this function
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);

        if ( $.isArray(results) ) {
            return results[1];
        }

        return false;
    }

    // Back off, browser, I got this... (if there's a history of scrolling)
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }

    // When the page loads, fetch posts if paginated
    $(window).on('pageshow', function(){

        var anchor = $.urlParam('infsc');

        if ( anchor ) {

            chunk = parseInt(anchor);

            $.ajax({
                type: "POST",
                url: iw21Scroll.ajaxurl,
                data: {
                    "action": 'ajax_feed_pagination',
                    "id": iw21Scroll.id,
                    "options": iw21Scroll.options,
                    "ppp": iw21Scroll.ppp,
                    "chunk": chunk
                },
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(response) {

                    $('#loader').hide();
                    
                    $( '.entry-feed' ).append( response );
                    
                    $('.feed[data-chunk="' + chunk + '"]').masonry(masonryOptions);
                }
            });
            
        } else {
            $('.feed').masonry(masonryOptions);
        }

    });

    $(window).on('scroll', $.throttle(50, function() {

        // selectors
        var $window = $(window),
            $chunk = $('.feed');

        var scroll = $window.scrollTop();

        $chunk.each( function(){
            var $this = $(this);


            if ( $this.position().top > scroll + 500 ) {
                return;
            }

            if ( $this.position().top + $this.height() <= scroll + 500 ) {
                return;
            }

            if (window.history.replaceState) {
                //prevents browser from storing history with each change:
                window.history.replaceState($this.data('chunk'), $this.data('chunk'), '?infsc=' + $this.data('chunk'));
            }

            if ( $this.data('chunk') == chunk ) {
                chunk++;

                $.ajax({
                    type: "POST",
                    url: iw21Scroll.ajaxurl,
                    data: {
                        "action": 'ajax_feed_pagination',
                        "id": iw21Scroll.id,
                        "options": iw21Scroll.options,
                        "ppp": iw21Scroll.ppp,
                        "chunk": chunk
                    },
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    success: function(response) {
                        $('#loader').hide();

                        $( '.entry-feed' ).append( response );

                        $('.feed[data-chunk="' + chunk + '"]').masonry(masonryOptions);
                    }
                });
            }

        });
        
    }));


    $('.feed').on('click', 'a[data-remember]', function(){

        var $this = $(this),
            $chunk = $this.parents('.feed');

        if (window.history.replaceState) {
            //prevents browser from storing history with each change:
            window.history.replaceState($chunk.data('chunk'), $chunk.data('chunk'), '/?infsc=' + $chunk.data('chunk'));
        }

        window.location = $this.attr('href');
    });


})(jQuery);