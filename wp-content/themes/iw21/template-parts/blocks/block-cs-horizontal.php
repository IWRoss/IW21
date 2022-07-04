<?php

/**
 * Case Study Footer Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
global $post;

$template = array(
    array('acf/cs-horizontal-item', array(), array(
        array('core/image', array(
            'align' => 'center'
        )),
        array('core/heading', array(
            'textAlign' => 'center',
            'level' => 1,
            'content' => '100'
        )),
        array('core/heading', array(
            'textAlign' => 'center',
            'level' => 4,
            'content' => 'things achieved'
        )),
    )),
    array('acf/cs-horizontal-item', array(), array(
        array('core/image', array(
            'align' => 'center'
        )),
        array('core/heading', array(
            'textAlign' => 'center',
            'level' => 1,
            'content' => '100'
        )),
        array('core/heading', array(
            'textAlign' => 'center',
            'level' => 4,
            'content' => 'things achieved'
        )),
    )),
    array('acf/cs-horizontal-item', array(), array(
        array('core/image', array(
            'align' => 'center'
        )),
        array('core/heading', array(
            'textAlign' => 'center',
            'level' => 1,
            'content' => '100'
        )),
        array('core/heading', array(
            'textAlign' => 'center',
            'level' => 4,
            'content' => 'things achieved'
        )),
    )),
    array('acf/cs-horizontal-item', array(), array(
        array('core/heading', array(
            'content' => 'Find out more about how your organisation can benefit from working with us',
            'level' => 2,
            'textAlign' => 'center'
        ))
    )),
);

$allowed_blocks = array('acf/cs-horizontal-item');

$classes = [];

if ($is_preview) {
    $classes[] = 'is-preview';
}

$classes[] = 'align' . $block['align'];

$num_children = substr_count($content, 'iw-block-cs-horizontal-item') / 2;

?>


<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-cs-horizontal <?php echo implode(' ', $classes); ?>">

    <div class="iw-block-cs-horizontal-inner valign-<?php echo $block['align_content'] ?? 'top'; ?>" style="--mobile-width:<?php echo 12.5 + $num_children * 75; ?>vw;--desktop-width:<?php echo 60 + $num_children * 40; ?>vw;">
        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" orientation="horizontal" />
    </div>

</div>

<?php if (!$is_preview) : ?>
    <script>
        (function($) {

            $(window).on('load resize', function() {
                const panelsContainer = $(".iw-block-cs-horizontal");
                const panelsInner = $(".iw-block-cs-horizontal-inner");
                const panels = gsap.utils.toArray(".iw-block-cs-horizontal-item");

                gsap.to(panelsInner, {
                    xPercent: -100 + (panelsContainer.outerWidth() / panelsInner.outerWidth() * 100),
                    ease: "none",
                    scrollTrigger: {
                        trigger: ".iw-block-cs-horizontal",
                        pin: true,
                        start: "center center",
                        scrub: 1,
                        end: () => "+=" + panelsInner.width()
                    }
                });
            });

        })(jQuery);
    </script>
<?php endif; ?>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>