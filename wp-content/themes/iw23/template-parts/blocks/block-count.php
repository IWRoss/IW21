<?php

[$classes, $styles] = iw23_block_styles($block);

vprintf('<%s id="%s" class="iw-block iw-block-count iw-block-count-align%s %s" style="%s">%s<span class="count-up">%s</span>%s</%s>', array(
    get_field('heading') ?: 'h1',
    $block['id'],
    $block['align_text'],
    implode(' ', $classes),
    implode(' ', $styles),
    get_field('prefix') ? sprintf('<span class="prefix">%s</span>', get_field('prefix')) : '',
    get_field('count'),
    get_field('suffix') ? sprintf('<span class="suffix">%s</span>', get_field('suffix')) : '',
    get_field('heading') ?: 'h1',
));

?>

<script>
    ScrollTrigger.create({
        trigger: "#<?php echo $block['id']; ?> .count-up",
        once: true,
        onEnter: () => {
            // The animation function, which takes an Element
            const animateCountUp = el => {

                // How long you want the animation to take, in ms
                const animationDuration = 2000;
                // Calculate how long each ‘frame’ should last if we want to update the animation 60 times per second
                const frameDuration = 1000 / 60;
                // Use that to calculate how many frames we need to complete the animation
                const totalFrames = Math.round(animationDuration / frameDuration);
                // An ease-out function that slows the count as it progresses
                const easeOutQuad = t => t * (2 - t);

                let frame = 0;
                const countTo = parseInt(el.innerHTML, 10);
                // Start the animation running 60 times per second
                const counter = setInterval(() => {
                    frame++;
                    // Calculate our progress as a value between 0 and 1
                    // Pass that value to our easing function to get our
                    // progress on a curve
                    const progress = easeOutQuad(frame / totalFrames);
                    // Use the progress value to calculate the current count
                    const currentCount = Math.round(countTo * progress);

                    // If the current count has changed, update the element
                    if (parseInt(el.innerHTML, 10) !== currentCount) {
                        el.innerHTML = currentCount.toLocaleString();
                    }

                    // If we’ve reached our last frame, stop the animation
                    if (frame === totalFrames) {
                        clearInterval(counter);
                    }
                }, frameDuration);
            };

            animateCountUp(document.querySelector('#<?php echo $block['id']; ?> .count-up'));
        }

    });
</script>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>