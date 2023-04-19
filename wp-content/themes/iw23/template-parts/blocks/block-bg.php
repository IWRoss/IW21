<?php if (!$is_preview && (!empty($block['backgroundColor']) || !empty($block['textColor']))) : ?>

    <?php

    $colors = array(
        !empty($block['backgroundColor']) ? 'bg-' . $block['backgroundColor'] : '',
        !empty($block['textColor']) ? 'text-' . $block['textColor'] : '',
    );

    ?>


    <div id="<?php echo $block['id']; ?>" class="iw-block iw-block-bg"></div>

    <script>
        (function() {
            let body = document.body;

            let prevColors = [];

            ScrollTrigger.create({
                trigger: "#<?php echo $block['id']; ?>",
                start: "top center",
                end: "bottom center",
                onEnter: () => {
                    prevColors = [...body.classList].filter(c => c.startsWith("bg-") || c.startsWith("text-"));
                    body.classList.remove(...prevColors);
                    body.classList.add("<?php echo implode('","', $colors); ?>");
                },
                onLeaveBack: () => {
                    body.classList.remove("<?php echo implode('","', $colors); ?>");
                    body.classList.add(...prevColors)
                },
            });
        })();
    </script>
<?php else : ?>
    <p style="padding:1em 2em;border:2px dashed grey;color:grey;cursor:pointer;text-align:center;"><?php echo $is_preview ? 'This block is only visible on the frontend.' : 'Block has not yet been set up.'; ?></p>
<?php endif; ?>