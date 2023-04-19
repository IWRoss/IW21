<?php

/**
 * Tools Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$template = array(
    array('acf/tool', array()),
    array('acf/tool', array()),
    array('acf/tool', array()),
);

$allowed_blocks = array('acf/tool');

/**
 * Get block styling
 */
[$classes, $inline_styles] = iw21_block_colors(
    get_field('text_color'),
    get_field('background_color')
);

if ($is_preview) {
    $classes[] = 'is-preview';
}

$classes[] = 'align' . $block['align'];

?>


<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-tools <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $inline_styles); ?>">

    <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" />

</div>

<script>
    const tools = gsap.utils.toArray("#<?php echo $block['id']; ?> .iw-block-tool");

    ScrollTrigger.create({
        trigger: "#<?php echo $block['id']; ?>",
        once: true,
        onEnter: () => {
            // The animation function, which takes an Element
            const animateFadeIn = el => {

                let i = 0;

                const fader = setInterval(() => {

                    tools[i].classList.add('visible');

                    i++;

                    if (i === tools.length) {
                        clearInterval(fader);
                    }

                }, 125);

            };

            animateFadeIn(document.querySelector('#<?php echo $block['id']; ?>'));
        }
    });
</script>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>