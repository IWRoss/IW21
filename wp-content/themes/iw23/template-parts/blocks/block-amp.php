<?php

if (iw23_array_key_exists('results', $_GET)) {

    $polylines = iw23_get_amp_polyline_points($_GET['results']);

    $circles = array_map(function ($v) {
        return iw23_get_amp_circle_elements($v);
    }, $polylines);
}

$image = get_field('image');

?>

<div id="<?php echo $block['id']; ?>" class="iw-block iw-business-amp alignwide">

    <?php if ($_GET['results'] && $polylines && $circles) : ?>

        <img src="<?php echo $image['url']; ?>" alt="BusinessAMP Wheel" class="business-amp-background">

        <svg class="business-amp-results" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">

            <g stroke-width="0.5px">
                <?php foreach ($polylines as $polyline) : ?>
                    <?php ?>
                    <polyline points="<?php echo $polyline; ?>" fill="none" stroke="white" class="business-amp-now"></polyline>
                <?php endforeach; ?>
            </g>

            <?php foreach ($circles as $circle) : ?>
                <g class="circles">
                    <?php echo $circle; ?>
                </g>
            <?php endforeach; ?>

        </svg>

    <?php else : ?>
        <p style="text-align:center;">No results found. Please check the URL.</p>
    <?php endif; ?>

</div>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>