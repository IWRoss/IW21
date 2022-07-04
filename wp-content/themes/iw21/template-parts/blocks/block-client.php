<?php

$template = array(
    array('core/heading', array(
        'level' => 4,
        'placeholder' => 'Client Name',
    )),
    array('core/paragraph', array(
        'placeholder' => 'Add a root-level paragraph',
    ))
);

// $class = iw21_block_color_class($block);
// $style = $block['style']['color']['gradient'] ? sprintf('background: %s;', $block['style']['color']['gradient']) : '';

[$classes, $styles] = iw21_block_styles($block);

?>


<div id="<?php echo $block['id']; ?>" class="block-animation-wrapper">
    <div class="block-client">

        <div class="block-client-logo <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $styles); ?>">
            <img src="<?php the_field('logo'); ?>" alt="Company Logo">
        </div>

        <div class="block-client-innerblocks">
            <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
        </div>

    </div>
</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id'], '.block-client'); ?>