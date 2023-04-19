<?php

[$classes, $styles] = iw21_block_styles($block);

$image = get_field('image');

?>

<div class="iw-block iw-block-shard <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $styles); ?>">
  <div class="iw-block-shard-mask" style="clip-path: <?php the_field('clip_path'); ?>">
    <img src="<?php echo $image['sizes']['large']; ?>" alt="">
  </div>
</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>