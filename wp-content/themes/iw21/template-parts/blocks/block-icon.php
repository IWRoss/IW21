<?php

$template = array(
    array('core/heading', array(
        'level' => 4,
        'placeholder' => 'Add a heading',
    )),
    array('core/paragraph', array(
        'placeholder' => 'Add a root-level paragraph',
    ))
);

$align_content = $block['align_content'];

?>

<div id="<?php echo $block['id']; ?>" class="block-icon block-icon-align<?php echo $align_content ?: 'top'; ?>">

    <div class="block-icon-inner">
        <?php iw21_media_tag(get_field('icon'), 'block-icon-icon', sprintf('width:%dem;', get_field('width') / 5 ?: 5)); ?>

        <div class="block-icon-text">
            <div class="block-icon-innerblocks">
                <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
            </div>
        </div>
    </div>

</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id'], '.block-icon-inner'); ?>