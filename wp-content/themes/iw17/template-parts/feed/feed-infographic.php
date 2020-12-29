<?php

// Get thumb URL source array
$thumb_url_array = wp_get_attachment_image_src(
    get_post_thumbnail_id(),
    'iw17-feed',
    true
);

$user_author_image = get_field('author_image', 'user_' . get_the_author_meta('ID'));

$classes = iw17_get_the_post_classes_string();

$post_link = get_permalink();

if ($has_link = get_field('link_to_url')) {
    $post_link = $has_link;
}

if (has_post_thumbnail()) : ?>
    <div class="grid-item feed-item <?php echo $classes; ?>" style="background-image: url('<?php echo $thumb_url_array[0]; ?>')" data-index="<?php echo $args['index']; ?>">
    <?php else : ?>
        <div class="grid-item feed-item <?php echo $classes; ?>">
        <?php endif; ?>
        <a href="<?php echo $post_link; ?>" class="feed-item-link" <?php echo $has_link ? 'target="_blank"' : ''; ?>>

            <span class="feed-title"><?php echo iw17_get_the_title(); ?></span>

            <span class="feed-excerpt"><?php the_excerpt(); ?></span>

            <?php if ($user_author_image && get_post_type() !== 'work') : ?>
                <img src="<?php echo $user_author_image; ?>" alt="Author" class="author-image">
            <?php endif; ?>

            <?php if ($overlay = get_field('overlay')) : ?>
                <div class="sketch-overlay" style="background-image:url('<?php echo $overlay['url']; ?>')"></div>
            <?php endif; ?>
        </a>

        </div>