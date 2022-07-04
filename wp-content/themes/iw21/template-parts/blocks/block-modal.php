<?php

/**
 * Get block styling
 */
// [$classes, $inline_styles] = iw21_block_colors(
//     get_field('text_color'),
//     get_field('background_color')
// );

$default = ['url' => '', 'title' => '', 'target' => '_self'];

[$classes, $inline_styles] = iw21_block_styles($block);

$link_1 = get_field('link_1') ?? $default;
$link_2 = get_field('link_2') ?? $default;

if (get_field('create_modal')) {

    $link_1['url'] = $link_1['url'] === '#' ? 'modal-' . $block['id'] : $link_1['url'];

    if (gettype($link_2) === 'array') {
        $link_2['url'] = $link_2['url'] === '#' ? 'modal-' . $block['id'] : $link_2['url'];
    }
}

?>


<div id="<?php echo $block['id']; ?>" class="block-modal <?php echo $is_preview ? 'is-preview' : '' ?>">
    <div class="block-modal-button-container block-modal-button-align<?php echo $block['align_text']; ?>">

        <?php

        iw21_link_tag(
            $link_1,
            array_merge($classes, array('btn')),
            $inline_styles,
            get_field('refers_to_modal_1')
        );

        if ($link_2) {

            iw21_link_tag(
                $link_2,
                array('link'),
                $inline_styles,
                get_field('refers_to_modal_2')
            );
        }

        ?>

    </div>

    <?php if (get_field('create_modal')) : ?>
        <div id="modal-<?php echo $block['id']; ?>" class="iw-modal">
            <div class="iw-modal-window">

                <?php if (!$is_preview) : ?>
                    <span class="close" data-iw-modal="close">&times;</span>
                <?php endif; ?>

                <div class="iw-modal--content" data-insert="<?php the_field('modal_content'); ?>">
                    <InnerBlocks />
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if (!$is_preview && get_field('create_modal')) : ?>
    <script>
        (function($) {

            $('#modal-<?php echo $block['id']; ?>').appendTo('body');

        })(jQuery);
    </script>
<?php endif; ?>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>