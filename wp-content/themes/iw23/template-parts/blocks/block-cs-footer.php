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

/**
 * Determine the block classes.
 */
$classes = iw23_setup_block_classes($block, $is_preview);

/*------- Start Template Part: -------*/ ?>

<div class="iw-block iw-block-cs-footer <?php echo implode(' ', $classes); ?>" id="<?php echo $block['id']; ?>">

  <div class="cs-footer-inner">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 62.31 63.01" preserveAspectRatio="xMidYMid slice" class="cs-footer-logo-background">
      <polygon class="path_<?php echo $block['id']; ?>" points="19.21 17.48 22.36 29.18 16.99 50.07 8.5 17.48 19.21 17.48" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="28.01 50.13 27.98 50.13 27.99 50.07 28.01 50.13" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="39.59 28.8 34.1 50.11 31.03 38.64 31.03 38.63 36.66 17.48 39.59 28.8" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="16.99 50.07 17.01 50.13 16.98 50.13 16.99 50.07" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="34.1 50.12 34.11 50.13 34.1 50.13 34.1 50.12" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="4.72 4.38 7.72 15.05 18.72 15.05 15.43 4.38 4.72 4.38" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="25.38 17.48 16.98 50.13 27.99 50.13 36.67 17.48 25.38 17.48" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
      <polygon class="path_<?php echo $block['id']; ?>" points="42.5 17.48 34.11 50.13 45.13 50.13 53.81 17.48 42.5 17.48" style="fill:#f1f1f2; stroke:#CDCED1; stroke-linejoin:round; stroke-width:.5px;" vector-effect="non-scaling-stroke" />
    </svg>

    <div class="cs-footer-content">
      <InnerBlocks template="<?php echo esc_attr(wp_json_encode(array(
                                array('acf/icon', array()),
                                array('acf/icon', array()),
                                array('acf/modal', array())
                              ))); ?>" />
    </div>
  </div>
</div>

<script>
  (function() {
    const id = '<?php echo $block['id']; ?>';

    gsap.timeline({
        defaults: {
          duration: 5,
          delay: 1,
          ease: 'power2'
        },
        scrollTrigger: {
          trigger: `#${id}`,
          start: "center center",
          end: "center center"
        }
      })
      .fromTo(`.path_${id}`, {
        drawSVG: "100% 100%"
      }, {
        drawSVG: "0% 100%"
      }, 0);
  })();
</script>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id'], '.cs-footer-inner'); ?>