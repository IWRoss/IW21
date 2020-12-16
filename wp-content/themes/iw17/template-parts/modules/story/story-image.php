<?php if ( $span = get_sub_field( 'span' ) ) : ?>
    <div class="grid-item story-item story-item--img grid-item--width2">
<?php else : ?>
    <div class="grid-item story-item--img story-item">
<?php endif; ?>
    <img src="<?php the_sub_field( 'image' ); ?>" class="story-item--img">

    <?php if ( $overlay = get_sub_field( 'overlay' ) ) : ?>
        <div class="sketch-overlay" style="background-image:url('<?php echo $overlay['url']; ?>')"></div>
    <?php endif; ?>
</div>
