<?php

$template = array(
    array('core/heading', array(
        'level' => 2,
        'placeholder' => 'Add a headline',
    )),
    array('core/paragraph', array(
        'placeholder' => 'Add a root-level paragraph',
    )),
    array('core/buttons', array(), array(
        array('core/button', array()),
    ))
);

$allowed_blocks = array('core/heading', 'core/paragraph', 'core/button', 'acf/modal', 'core/spacer', 'core/image');

$gradient = get_field('gradient');

$alignment = get_field('align') ? get_field('align') : 'left';

?>


<div id="<?php echo $block['id']; ?>" class="block-hero block-hero-inner-align<?php echo $alignment; ?> align<?php echo $block['align']; ?>" style="<?php echo $gradient['end'] ? sprintf('background-color: %s;', $gradient['end']) : 'black'; ?>">

    <div class="block-hero-background">
        <!-- Media -->
        <?php

        $media = get_field('background');

        iw21_media_tag($media, 'block-hero-background-media');
        ?>
    </div>

    <div class="block-hero-foreground" style="background:linear-gradient(to bottom, <?php echo $gradient['start'] ? iw21_hex_to_rgba($gradient['start'], 0.9) : '#FF8D02'; ?> 0%, <?php echo $gradient['end'] ? iw21_hex_to_rgba($gradient['end'], 1) : '#DE5714'; ?> 100%);">

    </div>

    <div class=" block-hero-content">
        <div class="block-hero-innerblocks">
            <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
        </div>
    </div>


</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>