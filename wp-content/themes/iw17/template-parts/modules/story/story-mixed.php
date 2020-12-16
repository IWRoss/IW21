<?php if ( $span = get_sub_field( 'span' ) ) : ?>
    <div class="grid-item story-item grid-item--width2">
<?php else : ?>
    <div class="grid-item story-item">
<?php endif; ?>
    <?php the_sub_field( 'content' ); ?>
</div>
