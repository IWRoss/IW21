<?php

$span = ( get_sub_field( 'span' ) !== 1 && ! get_field( 'restrict_spans' ) ) ? ' grid-item--width' . get_sub_field( 'span' ) : '';

$background = get_sub_field( 'style' );

?>

<div class="grid-item path-item path-item-mixed path-item--hidden <?php echo 'path-item-', $background, $span; ?>">
    <div class="path-item--index">
        <?php echo get_row_index(); ?>
    </div>

    <div class="path-item--content">
        <?php the_sub_field( 'content' ); ?>
    </div>
</div>
