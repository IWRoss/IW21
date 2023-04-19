<?php

[$classes, $styles] = iw23_block_styles($block);

?>

<div id="<?php echo $block['id']; ?>" class="block-podcast <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $styles); ?>">

  <div class="block-podcast-feed feed">
    <?php echo $is_preview ? "This is where the podcast feed will display on the frontend." : ""; ?>
  </div>

</div>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>