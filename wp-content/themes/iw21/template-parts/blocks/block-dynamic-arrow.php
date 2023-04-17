<?php

$arrow_variants = array(

    'type_a' => array(
        'path'       => 'M350,950V790a40,40,0,0,0-40-40H90a40,40,0,0,1-40-40V590a40,40,0,0,1,40-40H610a40,40,0,0,0,40-40V390a40,40,0,0,0-40-40H90a40,40,0,0,1-40-40V190a40,40,0,0,1,40-40H310a40,40,0,0,0,40-40V-40',
        'height'     => 950,
        'static_elements' => array(
            'foreground' => '<g class="text-1"> <text transform="translate(95.09 262.12)" style="font-size:34px;fill:#ff8d02;font-family:Flama, sans-serif;font-weight:300;">%s</text> <rect x="32" y="232" width="36" height="36" rx="7.8" style="fill:#fff;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:4px" /> </g> <g class="text-2"> <text transform="translate(604.91 462.71)" text-anchor="end" style="font-size:34px;fill:#ff8d02;font-family:Flama, sans-serif;font-weight:300;">%s</text> <rect x="632" y="432" width="36" height="36" rx="7.8" style="fill:#fff;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:4px" /> </g> <g class="text-3"> <text transform="translate(95.09 662.41)" style="font-size:34px;fill:#ff8d02;font-family:Flama, sans-serif;font-weight:300;">%s</text> <rect x="32" y="632" width="36" height="36" rx="7.8" style="fill:#fff;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:4px" /> </g>',
        )
    ),
    'type_b' => array(
        'path'   => 'M350,699.93V525.78A29.84,29.84,0,0,0,320.16,496h-9.78a29.83,29.83,0,0,1-29.84-29.83V224.35a29.84,29.84,0,0,1,29.84-29.84H640.94a29.83,29.83,0,0,1,29.83,29.84v162.5a29.83,29.83,0,0,1-29.83,29.84H380.35a29.83,29.83,0,0,1-29.84-29.81L350-40.3',
        'height' => 700,
        'image'  => array(
            'background' => array(
                'x'      => '350',
                'y'      => '194.5',
                'width'  => '320.7',
                'height' => '222',
            ),
            'mask' => '<path d="M670.49,224.35v162.5a29.84,29.84,0,0,1-29.84,29.84H380.06a29.83,29.83,0,0,1-29.83-29.81L350,194.51H640.65A29.84,29.84,0,0,1,670.49,224.35Z" />'
        )
    ),
    'type_c' => array(
        'path'   => 'M350 %d 350 0 350 -40.3',
        'height' => 700,
        'image'  => array(
            'foreground' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            )
        )
    ),
    'type_d' => array(
        'path'   => 'M350 699.93 350 -40.3',
        'height' => 700,
        'image'  => array(
            'foreground' => array(
                'x'      => '110.47',
                'y'      => '215',
                'width'  => '480',
                'height' => '270',
            ),
            'mask' => '<rect x="110.47" y="215" width="480" height="270" rx="19.1" />'
        ),
        // 'draw_elements'      => array(
        //     'foreground'   => array(
        //         'M350,485H571.61a19.1,19.1,0,0,0,19.1-19.1V234.1a19.1,19.1,0,0,0-19.1-19.1H350',
        //         'M350,485H128.39a19.1,19.1,0,0,1-19.1-19.1V234.1a19.1,19.1,0,0,1,19.1-19.1H350'
        //     )
        // )
    ),
    'type_e' => array(
        'path'   => 'M350,699.93c0-12.14-.27-23.91-4.08-35.52-4.07-12.41-10.87-23.74-14.66-36.25-3.88-12.76-3.9-28,5-37.93,7.06-7.88,18.24-10.74,28.81-11.1,29.72-1,62.13,3.68,82.47-24,7.72-10.51,8.82-22.27,13.09-34.06,3.77-10.41,11.26-20,19.4-27.3,16.85-15.2,40.51-23.38,63.09-19.1C560.3,478,580,492.3,577.55,511.85c-5.49,43.94-73.31,21.51-91.91,1.13-21.19-23.23-29.55-63.08-17.43-92.5,10.94-26.55,40.56-31.58,58.16-52.59,17.19-20.53,31.25-49.44,29.35-76.84-2.22-32.05-17.47-67.29-47.64-81.54-62.74-29.62-149.85,13.13-170,78.77-17,55.29,21.22,119.63-5.82,173.3-11.7,23.23-36.93,37.43-62.6,41.59C227.57,510,168.72,498,133.73,473.35c-55.34-39-89.9-139.11-38.34-194,19.48-20.75,44.42-37.37,65.43-56.72a335.06,335.06,0,0,0,36.78-39.84c12.76-16.29,24.39-38.29,14.94-56.7a29.67,29.67,0,0,0-54.91,5.37c-6.28,21.87,14.33,43.15,36.07,49.86,37.93,11.71,80.53-5.12,107.79-34C340.78,105.73,350,54.83,350,0V-40.3',
        'height' => 700,
        'image'  => array(
            'foreground' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            ),
            'background' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            ),
        )
    ),
    'type_f' => array(
        'path'   => 'M350,700.6s.9-29.86,4.24-47c3.1-15.89,11.23-31.48,25-40,11-6.86,24.46-8.6,37.43-8.55,37.7.14,74.15,2.05,110.79-9.29,25.82-8,50.37-22.52,66-44.55s21.14-52.2,9.93-76.8c-7.68-16.84-22.45-29.86-39.27-37.59C537,424.34,504.26,423.36,476,432.57c-61.23,19.95-119.25,53-173.91,86.95-45.54,28.31-96.61,65.11-153.63,48.69a91.06,91.06,0,0,1-56.25-47.72c-15.7-33-9.07-78.51,15.15-105.89,23.39-26.44,60.67-34.67,93.71-41.76a426.94,426.94,0,0,1,111.69-8.51c60.89,3.26,125.65,19.44,183.87-6.68,46.11-20.7,85.21-72.81,55.82-122.35-22-37-64.95-41.18-102.62-32.46-52.23,12.1-95,47-142.85,69.27-47.19,22-109.69,35.59-157.28,7.16a74.34,74.34,0,0,1-12.24-9.15c-30.56-28.25-33.25-79.23-8.89-112.21,31.26-42.31,99.62-45.24,145.63-61.19,22.32-7.74,41.9-17.13,56.2-36.53C344.11,41.56,350,15.4,350-.6',
        'height' => 700,
        'image'  => array(
            'foreground' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            ),
            'background' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            ),
        )
    ),
    'custom' => array(
        'height' => 700,
        'image'  => array(
            'foreground' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            ),
            'background' => array(
                'x'      => '0',
                'y'      => '0',
                'width'  => '700',
                'height' => '700',
            ),
        )
    ),


);

$arrow_type = $arrow_variants[get_field('variant')];

$block_unique_id = uniqid();

$block_content = get_field(get_field('variant'));

/**
 * If height dynamically set, perform adjustments
 */
$arrow_type['height'] = $block_content['height'] ?? $arrow_type['height'];

$arrow_type['path'] = $arrow_type['path'] ?? $block_content['path'];

$arrow_type['path'] = $block_content['height']
    ? vsprintf($arrow_type['path'], [$block_content['height']])
    : vsprintf($arrow_type['path'], [$arrow_type['height']]);

if ($block_content['height'] && $arrow_type['image']['foreground']) {
    $arrow_type['image']['foreground']['height'] = $block_content['height'];
}

if ($block_content['height'] && !empty($arrow_type['image']['background'])) {
    $arrow_type['image']['background']['height'] = $block_content['height'];
}

?>



<div id="<?php echo $block['id']; ?>" class="block-dynamic-arrow align<?php echo $block['align']; ?>">

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 700 <?php echo $arrow_type['height']; ?>" class="svg_<?php echo $block_unique_id; ?>">

        <?php

        /**
         * Image Mask
         */
        if (!empty($arrow_type['image']['mask'])) : ?>
            <defs>
                <clipPath id="mask_<?php echo $block_unique_id; ?>">
                    <?php echo $arrow_type['image']['mask']; ?>
                </clipPath>
            </defs>
        <?php
        endif;

        /** 
         * Background: Static Elements
         */
        echo !empty($arrow_type['static_elements']['background']) ? $arrow_type['static_elements']['background'] : '';

        /** 
         * Background: Image Element
         */
        if (!empty($arrow_type['image']['background'])) : ?>
            <image <?php echo ($arrow_type['image']['mask'] ?? false) ? 'clip-path="url(#mask_' . $block_unique_id . ')"' : ''; ?> width="<?php echo $arrow_type['image']['background']['width']; ?>" height="<?php echo $arrow_type['image']['background']['height']; ?>" x="<?php echo $arrow_type['image']['background']['x']; ?>" y="<?php echo $arrow_type['image']['background']['y']; ?>" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $block_content['background']; ?>" />
        <?php
        endif;

        /** 
         * Background: Draw Elements
         */
        if (!empty($arrow_type['draw_elements']['background'])) :
            foreach ($arrow_type['draw_elements']['background'] as $path) {
                printf('<path d="%s" style="fill:none;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:10px;stroke-linecap:square;" class="path_%s" />', $path, $block_unique_id);
            }
        endif;

        /**
         * Follow Path
         */ ?>
        <path d="<?php echo $arrow_type['path']; ?>" style="fill:none;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:10px;stroke-linecap:square;" class="path_main_<?php echo $block_unique_id; ?>" />

        <?php
        /**
         * Follow Path
         */ ?>
        <polygon class="arrowhead_<?php echo $block_unique_id; ?>" points="350 0 375 -40 325 -40 350 0" style="fill:#ff8d02;fill-rule:evenodd" />

        <?php
        /**
         * Start/End Lines
         */ ?>
        <line x1="300" x2="400" style="fill:none;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:20px" />
        <line x1="300" y1="<?php echo $arrow_type['height']; ?>" x2="400" y2="<?php echo $arrow_type['height']; ?>" style="fill:none;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:20px" />

        <?php
        /**
         * Foreground: Static Elements
         */
        echo !empty($arrow_type['static_elements']['foreground'])
            ? vsprintf($arrow_type['static_elements']['foreground'], [
                iw21_multiline_text_to_tspans($block_content['text']),
                iw21_multiline_text_to_tspans($block_content['text_2']),
                iw21_multiline_text_to_tspans($block_content['text_3']),
            ])
            : '';

        /**
         * Foreground: Image Element
         */
        if (!empty($arrow_type['image']['foreground'])) : ?>
            <image <?php echo ($arrow_type['image']['mask'] ?? false) ? 'clip-path="url(#mask_' . $block_unique_id . ')"' : ''; ?> width="<?php echo $arrow_type['image']['foreground']['width']; ?>" height="<?php echo $arrow_type['image']['foreground']['height']; ?>" x="<?php echo $arrow_type['image']['foreground']['x']; ?>" y="<?php echo $arrow_type['image']['foreground']['y']; ?>" preserveAspectRatio="xMidYMid slice" xlink:href="<?php echo $block_content['foreground']; ?>" />
        <?php
        endif;

        /**
         * Foreground: Draw Elements
         */
        if (!empty($arrow_type['draw_elements']['foreground'])) :

            foreach ($arrow_type['draw_elements']['foreground'] as $path) {
                printf('<path d="%s" style="fill:none;stroke:#ff8d02;stroke-miterlimit:10;stroke-width:10px;stroke-linecap:square;" class="path_%s" />', $path, $block_unique_id);
            }
        endif;
        ?>

    </svg>

    <script>
        gsap.timeline({
                defaults: {
                    duration: 1,
                    ease: 'none'
                },
                scrollTrigger: {
                    trigger: '.svg_<?php echo $block_unique_id; ?>',
                    scrub: 0,
                    start: "top center",
                    end: "bottom center"
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

        <?php if (!empty($arrow_type['draw_elements'])) : ?>
            gsap.timeline({
                    defaults: {
                        duration: 1,
                        ease: 'none'
                    },
                    scrollTrigger: {
                        trigger: '.path_<?php echo $block_unique_id; ?>',
                        scrub: 0,
                        start: "top center",
                        end: "bottom center"
                    }
                })
                .fromTo('.path_<?php echo $block_unique_id; ?>', {
                    drawSVG: "100% 100%"
                }, {
                    drawSVG: "0% 100%"
                }, 0);
        <?php endif; ?>
    </script>
</div>

<?php if ($animation = get_field('animation')) iw21_setup_animations($animation, $block['id']); ?>