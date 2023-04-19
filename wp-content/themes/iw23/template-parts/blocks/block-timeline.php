<?php

/**
 * Timeline Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$template = array(
    array('acf/timeline-item', array(), array(
        array('core/heading', array()),
        array('core/paragraph', array()),
    )),
    array('acf/timeline-item', array(), array(
        array('core/heading', array()),
        array('core/paragraph', array()),
    )),
    array('acf/timeline-item', array(), array(
        array('core/heading', array()),
        array('core/paragraph', array()),
    )),
);

$allowed_blocks = array('acf/timeline-item');

/**
 * Get block styling
 */
[$classes, $inline_styles] = iw23_block_colors(
    get_field('text_color'),
    get_field('background_color')
);

if ($is_preview) {
    $classes[] = 'is-preview';
}

$classes[] = 'align' . $block['align'];

?>


<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-timeline <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $inline_styles); ?>">

    <div class="iw-block-timeline-marker"></div>

    <div class="iw-block-timeline-inner">

        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" orientation="horizontal" />

    </div>

</div>

<script>
    (function($) {
        $(window).on('load', function() {
            const panelsContainer = $(".iw-block-timeline");
            const panels = gsap.utils.toArray(".iw-block-timeline-item");

            gsap.to(panels, {
                xPercent: -100 * (panels.length - 1) - 50,
                ease: "none",
                scrollTrigger: {
                    trigger: ".iw-block-timeline",
                    pin: true,
                    start: "center center",
                    scrub: 1,
                    end: () => "+=" + panelsContainer.width()
                }
            });
        });
    })(jQuery);
</script>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>