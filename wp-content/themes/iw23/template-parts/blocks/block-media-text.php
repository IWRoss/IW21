<?php

$alignment = get_field('alignment') ? get_field('alignment') : 'left';

$design = get_field('style') ? get_field('style') : 'basic';

$class = iw21_block_color_class($block);
$style = !empty($block['style']['color']['gradient']) ? sprintf('background: %s;', $block['style']['color']['gradient']) : '';

// echo '<pre>', print_r(iw21_block_styles($block)), '</pre>';
$classes = array(
    sprintf('block-media-text-style-%s', get_field('style') ? get_field('style') : 'basic'),
    sprintf('align%s', $block['align']),
    sprintf('block-media-text-inner-align%s', get_field('alignment') ? get_field('alignment') : 'left')
);

[$block_classes, $block_styles] = iw21_block_styles($block);

?>

<div id="<?php echo $block['id']; ?>" class="block-media-text <?php echo implode(' ', $classes); ?>">

    <div class="block-media-text-media">
        <!-- Media -->
        <?php

        $media = get_field('media');

        iw21_media_tag($media, 'block-media-text-media-element');
        ?>
    </div>

    <?php if (strpos($design, 'shards') !== -1) : ?>
        <div class="shards <?php echo implode(' ', $block_classes); ?>" style="<?php echo implode(' ', $block_styles); ?>"></div>
    <?php endif; ?>

    <div class="block-media-text-text">
        <div class="block-media-text-innerblocks">
            <InnerBlocks />
        </div>
    </div>

</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>