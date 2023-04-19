<?php

/**
 * Get block styling
 */
[$classes, $inline_styles] = iw21_block_colors(
    get_field('text_color'),
    get_field('background_color')
);

if ($is_preview) {
    $classes[] = 'is-preview';
}

$classes[] = 'align' . $block['align'];

$background = get_field('feature_image');

?>

<div class="iw-block iw-block-tool <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $inline_styles); ?>">

    <img class="iw-block-tool-background" src="<?php echo is_array($background) ? $background['sizes']['large'] : ''; ?>" />

    <div class="iw-block-tool-inner">
        <h4 class="tool-title"><?php the_field('title'); ?></h4>
        <div class="tool-meta">
            <p class="tool-description"><?php the_field('description'); ?></p>
        </div>
    </div>

    <a href="<?php the_field('page_link'); ?>" class="tool-link"></a>
</div>