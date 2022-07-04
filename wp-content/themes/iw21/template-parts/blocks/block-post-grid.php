<?php

/**
 * Global $post
 */
global $post;

/**
 * Get block styling
 */
[$classes, $inline_styles] = iw21_block_colors(
    get_field('text_color'),
    get_field('background_color')
);

$post_grid_posts = get_field('posts');

$classes[] = 'alignfull';
?>


<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-post-grid <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $inline_styles); ?>">


    <?php if ($post_grid_posts) : ?>
        <div class="iw-block-post-grid-grid has-<?php echo count($post_grid_posts); ?>-posts">

            <?php foreach ($post_grid_posts as $post) : ?>

                <?php setup_postdata($post); ?>

                <?php get_template_part('template-parts/content', 'grid'); ?>

            <?php endforeach; ?>

            <?php wp_reset_postdata(); ?>
        </div>

    <?php else : ?>

        <p>No posts to display.</p>

    <?php endif; ?>

</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>