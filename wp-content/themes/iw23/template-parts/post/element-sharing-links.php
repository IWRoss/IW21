<div class="sharing-links">
    <h5>Share:</h5>
    <ul class="share-menu">
        <li class="share-link">
            <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(get_permalink()); ?>" target="_blank" id="facebook" class="track-share-link">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/social-icons/facebook.svg" alt="Facebook" class="social-icon">
            </a>
        </li>
        <li class="share-link">
            <a href="<?php echo 'https://www.linkedin.com/shareArticle?mini=true&url=', urlencode(get_permalink()), '&title=', get_the_title(), '&summary=&source='; ?>" target="_blank" id="linkedin" class="track-share-link">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/social-icons/linkedin.svg" alt="Linkedin" class="social-icon">
            </a>
        </li>
        <li class="share-link">
            <a href="<?php echo 'http://twitter.com/home?status=', get_the_title(), ' ', wp_get_shortlink(); ?>" target="_blank" id="twitter" class="track-share-link">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/social-icons/twitter.svg" alt="Twitter" class="social-icon">
            </a>
        </li>
    </ul>
</div>