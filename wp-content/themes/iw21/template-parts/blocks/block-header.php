<?php

$taglines = iw21_render_dynamic_text_array(get_field('tagline'), 'w');

$banner_image = get_field('banner_image');

?>

<div class="block-header align<?php echo $block['align']; ?>" style="background-image: url('<?php echo $banner_image['url']; ?>'); background-size: cover;">
    <div class="tagline">
        <h1 class="site-tagline">
            <span class="site-tagline-first-line">
                i<span class="dynamic-text" data-lines="<?php echo implode(',', $taglines[0]); ?>">nteractive</span><br />
            </span>
            <span class="site-tagline-second-line">
                w<span class="dynamic-text" data-lines="<?php echo implode(',', $taglines[1]); ?>">orkshops</span>
            </span>
        </h1>
    </div>

    <div class="header-content">
        <?php the_field('header_content'); ?>
    </div>


    <?php if ($overlay = get_field('sketch_overlay')) : ?>
        <div class="sketch-overlay" style="background-image:url('<?php echo $overlay['url']; ?>')"></div>
    <?php endif; ?>

    <?php if (get_field('media') === 'video') : ?>

        <?php $video_file = get_field('video'); ?>

        <video playsinline autoplay muted loop poster="<?php echo $banner_image['url']; ?>" class="bg-video">
            <source src="<?php echo $video_file['url']; ?>" type="video/mp4">
        </video>

    <?php endif; ?>
</div>