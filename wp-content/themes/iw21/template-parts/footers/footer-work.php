<?php

$next_post = get_adjacent_post(true, '', true, 'category');

if (!$next_post) {

    $categories = wp_get_post_categories($post->ID);

    $recent_posts = wp_get_recent_posts(array(
        'numberposts' => 1,
        'category' => $categories[0] ?? false,
        'post_type' => $post->post_type,
        'post_status' => 'publish'
    ), OBJECT);

    $next_post = $recent_posts[0];
}

?>


<section class="cta-section">
    <h1 class="cta-heading">See what we mean</h1>
    <p class="cta-description">There’s more where that came from. For our other insights, check out our Linkedin, or see some more of our work.</p>
    <div class="cta-navigation">
        <a href="https://www.linkedin.com/company/interactive-workshops" class="btn btn-inline" target="_blank">Linkedin</a>
        <a href="<?php echo get_permalink($next_post); ?>" class="btn btn-inline">See more</a>
    </div>
</section>