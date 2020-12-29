/**
 * File main.js.
 */

( function( $ ) {

    /**
     * Smooth scroll on anchor click.
     *
     * @link https://stackoverflow.com/questions/7717527/smooth-scrolling-when-clicking-an-anchor-link
     */
    var $root = $( 'html, body' );

    $( 'a[href*=\\#]' ).click( function(e) {
        e.preventDefault();

        if ( ! $.attr( this, 'rel' ) ) {
            $root.animate( {
                scrollTop: $( $.attr(this, 'href') ).offset().top
            }, 300);
        }
    } );

    $( '[data-iw-modal]' ).click( function(e) {
        e.preventDefault();

        if ( $( this ).data( 'iw-modal' ) == 'open' ) {
            $( '#' + $.attr( this, 'rel' ) ).fadeIn();
        }

        if ( $( this ).data( 'iw-modal' ) == 'close' ) {
            $( '.iw-modal' ).fadeOut();
        }
    } );

    $( window ).click( function(e) {
        if ( $( e.target ).hasClass( 'iw-modal' ) ) {
            $( e.target ).fadeOut();
        }
    } );

    /**
     * Masonry layout.
     *
     * External js: masonry.pkgd.min.js, imagesloaded.pkgd.min.js
     */
    var options = {
        itemSelector: '.grid-item',
        columnWidth: '.masonry-grid-sizer',
        gutter: '.masonry-gutter-sizer',
        percentPosition: true,
        transitionDuration: 0
    };

    // We need to wait for the window to load before we start calculating heights
    $( window ).load( function() {

        var $dynamicTextCache = [
            $( '.site-tagline-first-line' ).html(),
            $( '.site-tagline-second-line' ).html()
        ];

        // Initialise Dynamo
        $( '.dynamic-text' ).dynamo();

        var $masonryGrid = $( '.masonry-grid' ).imagesLoaded( function() {

            // init Masonry after all images have loaded
            $masonryGrid.masonry( options );

        } ).progress( function( instance, image ) {

            // If any images break, we need to make sure it doesn't break the layout
            if ( ! image.isLoaded ) {

                // Let's add a broken image replacement
                // image.img.src = templateDir + '/imgs/nosrc.png';

                // Reset layout
                $masonryGrid.masonry( options );
            }

        } );

        var resizeTimer;

        $( window ).on( 'resize', function(e) {

            clearTimeout( resizeTimer );

            $('.site-tagline').css('opacity','0');

            resizeTimer = setTimeout( function() {
                $masonryGrid.masonry();

                // Dynamo functions
                $( '.site-tagline-first-line' ).html( $dynamicTextCache[0] );

                $( '.site-tagline-second-line' ).html( $dynamicTextCache[1] );

                $( '.dynamic-text' ).dynamo();

                $('.site-tagline').css('opacity','1');

                textFit( $( '.equal-height-grid .path-item-mixed .path-item--content' ), { maxFontSize: 20 } );
            }, 500 );
        } );

        var $pathItems = $( '.path-item' );

        $pathItems.each( function( index ) {
            $( this ).delay( 300*index + 500 ).queue( function() {
                $( this ).removeClass( 'path-item--hidden' ).dequeue();
            } );
        } );

        textFit( $( '.equal-height-grid .path-item-mixed .path-item--content' ), { maxFontSize: 20 } );
    } );

    // Parallax functions
    $( window ).on( 'scroll', $.throttle(16, function() {
        var scrollTop = $( this ).scrollTop();

        $( '.parallax' ).each(function(){
            var $this = $(this),
                objectTop = $this.offset().top,
                objectHeight = $this.outerHeight();

            if (objectTop + objectHeight < scrollTop) {
                return;
            }

            $this.css( 'backgroundPosition', '50% ' + scrollTop / 100 + '%' );
        });

    } ) );

    $( 'iframe' ).wrap('<div class="video-wrapper" />');

    function fade() {
        var animation_height = $(window).innerHeight() * 0.25;
        var ratio = Math.round((1 / animation_height) * 10000) / 10000;

        $(".fade").each(function () {

            var objectTop = $(this).offset().top;
            var windowBottom = $(window).scrollTop() + $(window).innerHeight();

            if (objectTop < windowBottom) {
                if (objectTop < windowBottom - animation_height) {
                    $(this).css({
                        transition: 'opacity 0.1s linear,transform 0.5s cubic-bezier(0,0,0,1)',
                        opacity: 1,
                        transform: 'translateY(0)'
                    });

                } else {
                    $(this).css({
                        transition: 'opacity 0.25s linear,transform 0.5s cubic-bezier(0,0,0,1)',
                        opacity: (windowBottom - objectTop) * ratio,
                        transform: 'translateY(2em)'
                    });
                }
            } else {
                $(this).css('opacity', 0);
            }
        });
    }

    /**
     * Fade sections in on scroll
     */
    $( window ).on( "load", function() {

        $( '.fade' ).css( 'opacity', 0 );

        fade();

    } );

    $(window).on('scroll', function () {
        fade();
    });
    

} )( jQuery );
