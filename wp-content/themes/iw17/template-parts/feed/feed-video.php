<?php

// Get thumb URL source array
$thumb_url_array = wp_get_attachment_image_src(
    get_post_thumbnail_id(),
    'iw17-feed',
    true
);

$user_author_image = get_field( 'author_image', 'user_'. get_the_author_meta( 'ID' ) );

$classes = iw17_get_the_post_classes_string();

$oembed = get_field( 'video' );

// use preg_match to find iframe src
preg_match( '/src="(.+?)"/', $oembed, $matches );

$src = $matches[1];

if ( $preview = get_field( 'preview' ) ) : ?>
    <div class="grid-item feed-item <?php echo $classes; ?>" style="background-image: url('<?php echo $preview; ?>');">
<?php else : ?>
    <div class="grid-item feed-item <?php echo $classes; ?>">
<?php endif; ?>
    <a href="<?php echo $src; ?>" class="feed-item-link" data-lity>

        <span class="feed-title"><?php echo iw17_get_the_title(); ?></span>

        <?php if ( $overlay = get_field( 'overlay' ) ) : ?>
            <div class="sketch-overlay" style="background-image:url('<?php echo $overlay['url']; ?>')"></div>
        <?php endif; ?>
    </a>
</div>
