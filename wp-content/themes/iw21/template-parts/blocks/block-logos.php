<?php

$logos = get_field( 'logos' );

?>

<div class="schindler-block schindler-block-logos align<?php echo $block['align']; ?>">

    <div class="slider-container">

        <div id="logo-slider-<?php echo $block['id']; ?>" class="logo-slider">

            <?php foreach ( $logos as $logo ) : ?>

                <?php printf( '<img src="%s" alt="%s" />', $logo['url'], $logo['alt'] ); ?>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<script>

    ( function($) {

        $( '#logo-slider-<?php echo $block['id']; ?>' ).slick( {
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            centerMode: true,
            autoplaySpeed: 1500,
            arrows: false,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerPadding: '10px'
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 384,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        } );

    } )( jQuery )

</script>
