<?php

$featured_image_array = get_post_thumbnail_id() ? acf_get_attachment(get_post_thumbnail_id()) : '';
$featured_image_GIF = get_field('post_gif', $post->ID);
?>


<div class="iw-block-post-grid-post fade">

    <?php
    echo iw23_media_tag($featured_image_GIF ?: $featured_image_array, 'iw-block-post-grid-post-background');; ?>

    <a href="<?php the_permalink(); ?>" class="iw-block-post-grid-post-link">

        <h4 class="iw-block-post-grid-post-title">
            <?php the_title(); ?>
        </h4>

    </a>

</div>