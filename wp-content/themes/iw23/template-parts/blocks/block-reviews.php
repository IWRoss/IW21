<div id="<?php echo $block['id']; ?>" class="client-section">
    <?php echo do_shortcode(sprintf('[wpbr_collection id="%s"]', get_field('client_reviews_id', 'option'))); ?>
    <a href="https://g.page/r/CQUDT-ARAEfoEAg/review" target="_blank" class="btn btn-inline">Leave a review</a>
</div>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>