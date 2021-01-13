<div class="block-modal">
    <a href="#" rel="modal-<?php echo $block['id']; ?>" data-iw-modal="open" class="btn"><?php the_field('button_text'); ?></a>

    <div id="modal-<?php echo $block['id']; ?>" class="iw-modal">
        <div class="iw-modal-window">
            <span class="close" data-iw-modal="close">&times;</span>
            <div class="iw-modal--content" data-insert="<?php the_field('modal_content'); ?>">
            </div>
        </div>
    </div>
</div>