<?php

[$classes, $styles] = iw23_block_styles($block);

$image = get_field('image');

?>

<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-pin <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $styles); ?>">

    <div class="iw-block-pin-inner <?php echo $image ? 'iw-block-pin-inner-has_image' : ''; ?>">
        <InnerBlocks />
    </div>

    <a href="#" class="iw-block-pin-close" data-close="<?php echo $block['id']; ?>"></a>
</div>

<?php if (!$is_preview) : ?>
    <script>
        jQuery('a[data-close="<?php echo $block['id']; ?>"]').on('click', function(e) {
            e.preventDefault();

            jQuery('#<?php echo $block['id']; ?>').fadeOut(100);
        });
    </script>
<?php endif; ?>