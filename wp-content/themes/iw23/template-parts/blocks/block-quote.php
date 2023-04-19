<?php

/**
 * Get block styling
 */
[$classes, $inline_styles] = iw23_block_colors(
    get_field('text_color'),
    get_field('background_color')
);

$align_text = $block['align_text'];

?>

<figure id="<?php echo $block['id']; ?>" class="iw-block iw-block-quote <?php echo implode(' ', $classes); ?> iw-block-quote-align<?php echo $align_text ?: 'left'; ?>" style="<?php echo implode(' ', $inline_styles); ?>">

    <blockquote class="iw-block-quote-blockquote">
        <InnerBlocks />
    </blockquote>

    <figcaption class="iw-block-quote-citation">
        <?php
        /**
         * Quote image
         */
        iw23_media_tag(get_field('image'), 'iw-block-quote-thumbnail');

        /**
         * Quote citation
         */
        the_field('citation');
        ?>
    </figcaption>

</figure>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>