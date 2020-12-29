<?php $span = ( get_sub_field( 'span' ) !== 1 && ! get_field( 'restrict_spans' ) ) ? ' grid-item--width' . get_sub_field( 'span' ) : ''; ?>

<div class="grid-item path-item path-item--type-img path-item--hidden path-item<?php echo $span; ?>">
    <div class="path-item--index">
        <?php echo get_row_index(); ?>
    </div>

    <div class="path-item--content">
        <?php if ( get_field( 'equal_heights' ) ) : ?>
            <div class="path-item--img" style="background-image:url(<?php the_sub_field( 'image' ); ?>)"></div>
        <?php else : ?>
            <img src="<?php the_sub_field( 'image' ); ?>" class="path-item--img" />
        <?php endif; ?>

        <?php if ( $text_overlay = get_sub_field( 'text_overlay' ) ) : ?>
            <div class="path-item--img-overlay">
                <h4 class="path-item--img-overlay-text"><?php echo $text_overlay; ?></h4>
            </div>
        <?php endif; ?>
    </div>
</div>
