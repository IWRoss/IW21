<?php if ( $link_to = get_field( 'link_to' ) ) : ?>
    <div class="grid-item feed-item feed-work-quote">
        <a href="<?php echo get_permalink( $link_to ); ?>" class="feed-item-link">
            <?php the_excerpt(); ?>

            <span class="feed-item-meta">
                Read more
            </span>
        </a>
    </div>
<?php endif; ?>
