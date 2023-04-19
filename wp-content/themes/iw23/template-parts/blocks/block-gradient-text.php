<?php

// $colors = get_field('color_stops');

// $class = $block['gradient'] ? sprintf('has-%s-gradient-background', $block['gradient']) : '';
// $style = $block['style']['color']['gradient'] ? sprintf('background: %s;', $block['style']['color']['gradient']) : '';

[$classes, $styles] = iw21_block_styles($block);

?>

<h1 id="<?php echo $block['id']; ?>" class="block-gradient-text <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $styles); ?>">
    <?php echo get_field('content'); ?>
</h1>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>