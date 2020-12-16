<?php

$button = get_field( 'button' );

$background_image = get_field( 'background_image' );

?>


<div class="schindler-block schindler-block-cta <?php echo $background_image ? 'has-background' : ''; ?>" style="<?php hardyware_format_image_background_css( $background_image['sizes']['large'] ); ?>">

    <div class="schindler-block-cta-content">

        <?php if ( get_field( 'title' ) ) : ?>
            <h3><mark><?php the_field( 'title' ); ?></mark></h3>
        <?php endif; ?>

        <?php if ( get_field( 'content' ) ) : ?>
            <?php the_field( 'content' ); ?>
        <?php endif; ?>

        <?php printf( '<a href="%s" target="%s" class="btn">%s</a>', $button['url'], $button['target'], $button['title'] ); ?>

    </div>

</div>
