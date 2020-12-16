<?php

$business_areas = get_field( 'business_areas' );

?>

<div class="schindler-block schindler-block-business-areas align<?php echo $block['align']; ?>">

    <h2 style="text-align:center;"><mark><?php the_field( 'title' ); ?></mark></h2>

    <ul class="business-navigation">
        <?php

        foreach ( $business_areas as $business_area ) :

            printf( '<li><a href="" rel="business-%s" data-nodes="%s" data-iw-modal="open" class="btn btn-small">%s</a></li>', sanitize_title( $business_area['label'] ), implode( '|', array_column( $business_area['locations'], 'value' ) ), $business_area['label'] );

        endforeach;

        ?>
    </ul>

    <?php get_template_part( 'template-parts/elements/element', 'world-map' ); ?>

    <?php foreach ( $business_areas as $business_area ) : ?>
        <div id="business-<?php echo sanitize_title( $business_area['label'] ); ?>" class="iw-modal business-modal">

            <div class="iw-modal-window business-modal-window">
                <span class="close" data-iw-modal="close">&times;</span>

                <div class="iw-modal--content business-modal--content">
                    <h3><?php echo $business_area['label']; ?></h3>


                    <?php if ( $business_area['content'] ) echo $business_area['content']; ?>


                    <?php if ( $business_area['locations'] ) : ?>

                        <h5>Delivered to:</h5>

                        <?php echo implode( ', ', array_column( $business_area['locations'], 'label' ) ); ?>

                    <?php endif ; ?>


                    <?php if ( $business_area['timeline'] ) : ?>

                        <ul class="timeline">
                            <?php foreach ( $business_area['timeline'] as $year ) : ?>
                                <li class="timeline-node">
                                    <h5><?php echo $year['year']; ?></h5>
                                    <?php echo wpautop( $year['events'] ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    <?php endif ; ?>

                </div>
            </div>

        </div>

    <?php endforeach; ?>
</div>

<script>

    ( function($) {

        function alterNode( node, color, radius ) {

            var el = 'g[data-region="' + node + '"]';

            $( el ).css( {
                fill: color,
                transition: "0.2s"
            } );
        }

        $( 'a[data-nodes]' ).mouseenter( function() {

            var nodes = $(this).data( 'nodes' ).split( '|' );

            $.each( nodes, function( index, value ) {
                alterNode( value, '#FF8D00', '0.4' );
            } );

        } ).mouseleave( function() {

            var nodes = $(this).data( 'nodes' ).split( '|' );

            $.each( nodes, function( index, value ) {
                alterNode( value, 'black', '0.3' );
            } );

        } );

        $( 'circle' ).mouseenter( function() {
            console.log( $(this).attr( 'cx' ) + ' ' + $(this).attr( 'cy' ) );
        } );

    } )( jQuery )

</script>
