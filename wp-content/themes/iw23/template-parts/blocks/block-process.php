<?php

/**
 * Timeline Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


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

$block_unique_id = uniqid();

$template_dir = get_template_directory_uri();

?>

<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-process <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $inline_styles); ?>">

    <div class="design-process-path">

        <svg id="svg_<?php echo $block_unique_id; ?>" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 100">
            <defs>
                <style>
                    .cls-1 {
                        fill: none;
                    }

                    .cls-1,
                    .cls-3 {
                        stroke: #000;
                        stroke-miterlimit: 10;
                        stroke-width: 10px;
                    }

                    .cls-2 {
                        fill: #000;
                    }

                    .cls-3 {
                        fill: #fff;
                    }
                </style>
            </defs>
            <path class="cls-1 path_main_<?php echo $block_unique_id; ?>" d="M1665,50H225" />
            <polygon class="cls-2 arrowhead_<?php echo $block_unique_id; ?>" points="240 65.58 258 34.41 222 34.41 240 65.58" />
            <circle class="cls-3" cx="240" cy="50" r="32" />
            <circle class="cls-3" cx="720" cy="50" r="32" />
            <circle class="cls-3" cx="1200" cy="50" r="32" />
            <circle class="cls-3" cx="1680" cy="50" r="32" />
        </svg>

    </div>

    <div class="design-process">

        <div class="design-process-column discovery-column">
            <h3 class="design-process-heading">Discovery</h3>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/research.svg);">Undertake Research</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/interviews.svg);">Conduct Interviews</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/insight.svg);">Share Insights & Concepts</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/decision.svg);">Drive to Decision</div>
            <div class="design-process-stage design-process-stage-end">Get Client sign-off</div>
        </div>

        <div class="design-process-column design-column">
            <h3 class="design-process-heading">Design</h3>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/blueprint.svg);">Present Detailed Blueprints</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/architecture.svg);">Create Architecture</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/feedback.svg);">Get Client Feedback</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/implement.svg);">Implement Client Feedback</div>
            <div class="design-process-stage design-process-stage-end">Get Client sign-off</div>
        </div>

        <div class="design-process-column development-column">
            <h3 class="design-process-heading">Development</h3>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/architecture.svg);">Complete Architecture</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/full-build.svg);">Full Build</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/collateral.svg);">Create Collateral</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/design.svg);">Design Assets</div>
            <div class="design-process-stage design-process-stage-end">Get Client sign-off</div>
        </div>

        <div class="design-process-column deployment-column">
            <h3 class="design-process-heading">Deployment</h3>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/pilot.svg);">Execute Pilot Phase</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/feedback.svg);">Get Client & Participant Feedback</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/rollout.svg);">Rollout</div>
            <div class="design-process-stage" style="background-image:url(<?php echo $template_dir; ?>/imgs/process/iterate.svg);">Iterate</div>
        </div>

    </div>


</div>

<?php if (!$is_preview) : ?>
    <script>
        (function($) {
            $(window).on('load', function() {

                const interval = 400;

                ScrollTrigger.matchMedia({
                    "(max-width: 1023px)": () => {
                        let stages = gsap.utils.toArray(".design-process-column").forEach((stage, i) => {
                            ScrollTrigger.create({
                                trigger: stage,
                                start: () => `top center`,
                                toggleActions: "play reverse none reverse",
                                onEnter: () => stage.classList.add("is-active")
                            });
                        });
                    },
                    "(min-width: 1024px)": () => {

                        ScrollTrigger.create({
                            trigger: ".iw-block-process",
                            pin: true,
                            start: "center center",
                            scrub: 1,
                            end: () => "+=" + interval * 4
                        });

                        let stages = gsap.utils.toArray(".design-process-column").forEach((stage, i) => {
                            ScrollTrigger.create({
                                trigger: stage,
                                start: () => `top+=${interval * i}px center`,
                                toggleActions: "play reverse none reverse",
                                onEnter: () => stage.classList.add("is-active")
                            });
                        });

                        gsap.timeline({
                                defaults: {
                                    duration: 1,
                                    ease: 'none'
                                },
                                scrollTrigger: {
                                    trigger: '#svg_<?php echo $block_unique_id; ?>',
                                    scrub: 0,
                                    start: "top center",
                                    end: () => "+=" + interval * 3.333
                                }
                            })
                            .fromTo('.path_main_<?php echo $block_unique_id; ?>', {
                                drawSVG: "100% 100%"
                            }, {
                                drawSVG: "0% 100%"
                            }, 0)
                            .from('.arrowhead_<?php echo $block_unique_id; ?>', {
                                motionPath: {
                                    path: '.path_main_<?php echo $block_unique_id; ?>',
                                    align: '.path_main_<?php echo $block_unique_id; ?>',
                                    offsetX: 0,
                                    offsetY: 0,
                                    autoRotate: 90,
                                    alignOrigin: [0.5, 0]
                                }
                            }, 0);

                    }
                });


            });
        })(jQuery);
    </script>
<?php endif; ?>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>