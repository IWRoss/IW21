<?php

/**
 * Timeline Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

global $post;

$classes = [];

if ($is_preview) {
    $classes[] = 'is-preview';
}

$classes[] = 'align' . $block['align'];

$skills_deployed = array_map(function ($term) {
    return $term->term_id;
}, get_the_terms($post, 'work_type') ?: []);

?>


<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-cs-skills  <?php echo implode(' ', $classes); ?>">

    <svg viewBox="0 0 1680 564" fill="none" xmlns="http://www.w3.org/2000/svg" class="cs-skills-graphic" id="<?php printf('svg_%s', $block['id']); ?>">
        <path d="M1306 480H1532L1306 296V480Z" fill="#A6DAE3" />
        <path d="M1680 161L1185 161L1680 564L1680 161Z" fill="white" />
        <path d="M1338 237L1198.5 123.165H1V0" stroke="#FF8C00" stroke-width="2px" vector-effect="non-scaling-stroke" id="<?php printf('path_%s', $block['id']); ?>" />
    </svg>

    <div class="cs-skills-inner">
        <ul class="cs-skills--list cs-skills--skills">
            <?php

            $skills = get_terms('work_type', array(
                'hide_empty' => false,
                'orderby'     => 'term_id'
            ));

            foreach ($skills as $skill) : ?>

                <?php
                // Get icon
                $icon = get_field('icon', 'work_type_' . $skill->term_id);
                ?>

                <li class="cs-skills--list-item cs-skills--list-item--skill <?php echo in_array($skill->term_id, $skills_deployed) ? 'skill-deployed' : ''; ?>">
                    <img src="<?php echo $icon['sizes']['thumbnail']; ?>" alt="" class="cs-skills--list-item--skill-icon">
                    <?php echo $skill->name; ?>
                </li>

            <?php endforeach; ?>
        </ul>

    </div>

</div>


<script>
    gsap.timeline({
            defaults: {
                duration: 1,
                ease: 'none'
            },
            scrollTrigger: {
                trigger: '#svg_<?php echo $block['id']; ?>',
                scrub: 0,
                start: "top center",
                end: "center center"
            }
        })
        .fromTo('#path_<?php echo $block['id']; ?>', {
            drawSVG: "100% 100%"
        }, {
            drawSVG: "0% 100%"
        }, 0);
</script>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>