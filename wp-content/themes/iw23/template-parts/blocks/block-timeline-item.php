<?php

/**
 * Get block styling
 */
[$classes, $inline_styles] = iw23_block_colors(
    get_field('text_color'),
    get_field('background_color')
);

?>

<div class="iw-block-timeline-item <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $inline_styles); ?>">
    <div class="iw-block-timeline-item-inner">
        <InnerBlocks />
    </div>
</div>