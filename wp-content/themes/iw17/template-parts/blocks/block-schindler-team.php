<?php

$team = get_field( 'team' );

?>

<div class="schindler-block schindler-block-team align<?php echo $block['align']; ?>">

    <?php if ( $group_name = get_field( 'group_name' ) ) : ?>
        <h3 style="text-align:center;"><?php echo $group_name; ?></h3>
    <?php endif; ?>

    <div class="slider-container">

        <div id="team-slider-<?php echo $block['id']; ?>" class="team-slider">

            <?php foreach ( $team as $team_member ) : ?>

                <div class="team-member">
                    <div class="team-member--img" style="<?php hardyware_format_image_background_css( $team_member['image']['sizes']['medium'] ); ?>">
                        <a href="#" rel="team-<?php echo $block['id']; ?>-<?php echo sanitize_title( $team_member['label'] ); ?>" data-iw-modal="open" class="team-modal--open">Click for bio</a>
                    </div>

                    <div class="team-member--meta">
                        <h5 class="team-member--name"><?php echo $team_member['label']; ?></h5>
                        <p class="team-member--role"><?php echo $team_member['role']; ?></p>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>    

    <?php foreach ( $team as $team_member ) : ?>
        <div id="team-<?php echo $block['id']; ?>-<?php echo sanitize_title( $team_member['label'] ); ?>" class="iw-modal team-modal">

            <div class="iw-modal-window team-modal-window">
                <span class="close" data-iw-modal="close">&times;</span>

                <div class="team-modal--img" style="<?php hardyware_format_image_background_css( $team_member['image']['sizes']['large'] ); ?>"></div>

                <div class="iw-modal--content team-modal--content">
                    <h3><?php echo $team_member['label']; ?></h3>

                    <?php echo $team_member['bio']; ?>
                </div>
            </div>

        </div>


    <?php endforeach; ?>


</div>

<script>

    ( function($) {

        $.fn.isInView = function() {
            var win = $(window);
            var bounds = this.offset();

            var viewport = {
                top: win.scrollTop()
            };

            viewport.bottom = viewport.top + win.height();
            bounds.bottom = bounds.top + this.outerHeight();

            return ( ! ( viewport.bottom < bounds.top || viewport.bottom < bounds.bottom || viewport.top > bounds.bottom || viewport.top > bounds.top ) );
        };



        $( '#team-slider-<?php echo $block['id']; ?>' ).slick( {
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            <?php if ( count( $team ) > 4 ) : ?>
            centerMode: true,
            <?php endif; ?>
            autoplaySpeed: 3000,
            arrows: true,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        centerPadding: '10px'
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                        centerMode: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true
                    }
                }
            ]
        } );

    } )( jQuery )

</script>
