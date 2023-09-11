<div class="iw-block-post-grid-post fade">

    <?php if ($args['thumbnail']) : ?>
        <img src="<?php echo $args['thumbnail']; ?>" class="iw-block-post-grid-post-thumbnail">
    <?php endif; ?>

    <a href="<?php echo $args['link']; ?>" class="iw-block-post-grid-post-link">

        <h4 class="iw-block-post-grid-post-title">
            <?php echo $args['title']; ?>
        </h4>

    </a>

</div>