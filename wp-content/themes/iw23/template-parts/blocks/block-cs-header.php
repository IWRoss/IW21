<?php

/**
 * Case Study Header Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
global $post;

$template = array(
    array('core/heading', array(
        'textAlign' => 'center',
        'content' => 'The Challenge'
    )),
    array('core/paragraph', array(
        'align' => 'center',
    )),
);

$classes = [];

if ($is_preview) {
    $classes[] = 'is-preview';
}

$classes[] = 'align' . $block['align'];

$industries = get_the_terms($post, 'industry');

?>


<div id="<?php echo $block['id']; ?>" class="iw-block iw-block-cs-header <?php echo implode(' ', $classes); ?>">

    <div class="cs-header" style="background-image: url('<?php echo esc_url(get_field('header_image')); ?>');">
        <div class="cs-header-inner">
            <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 73.23 86.19" class="cs-icon">
                <rect width="73.23" height="86.19" style="fill:#f28c00;" />
                <g>
                    <path d="M25.95,17.32c-1.71,0-3.19-.96-3.19-2.71v-2.51c0-1.86,1.42-2.89,3.14-2.89,1.5,0,2.99,.84,2.99,2.59v.24h-1.39v-.11c0-1.02-.89-1.42-1.61-1.42s-1.68,.4-1.68,1.52v2.51c0,.95,.81,1.49,1.74,1.49,.71,0,1.55-.4,1.55-1.42v-.11h1.39v.24c0,1.75-1.44,2.58-2.94,2.58Z" style="fill:#fff;" />
                    <path d="M35.27,17.19l-.57-1.67h-2.99l-.59,1.67h-1.46l2.92-7.84h1.34l2.89,7.84h-1.53Zm-2.06-6.07h-.02l-1.08,3.15h2.17l-1.07-3.15Z" style="fill:#fff;" />
                    <path d="M40.6,17.31c-1.44,0-2.76-.61-3.17-1.94l1.32-.52c.3,.76,1.01,1.19,1.89,1.19,.79,0,1.54-.31,1.54-1.03,0-1.83-4.28-.44-4.28-3.46,0-1.47,1.22-2.33,2.74-2.33,1.31,0,2.5,.53,2.85,1.67l-1.26,.5c-.31-.66-.88-.94-1.64-.94-.64,0-1.25,.34-1.25,1.04,0,.55,.53,.75,1.14,.91,1.26,.34,3.13,.43,3.13,2.51,0,1.44-1.29,2.4-3.01,2.4Z" style="fill:#fff;" />
                    <path d="M44.98,17.19v-7.84h5.45v1.29h-3.98v1.91h3.53v1.29h-3.53v2.07h4.03v1.29h-5.49Z" style="fill:#fff;" />
                </g>
                <g>
                    <path d="M22.11,28.31c-1.44,0-2.76-.61-3.17-1.94l1.32-.52c.3,.76,1.01,1.19,1.89,1.19,.79,0,1.54-.31,1.54-1.03,0-1.83-4.28-.44-4.28-3.46,0-1.47,1.22-2.33,2.74-2.33,1.31,0,2.5,.53,2.85,1.67l-1.27,.5c-.31-.66-.88-.94-1.64-.94-.64,0-1.25,.34-1.25,1.04,0,.55,.53,.75,1.14,.91,1.27,.34,3.14,.43,3.14,2.51,0,1.44-1.29,2.4-3.01,2.4Z" style="fill:#fff;" />
                    <path d="M29.85,21.6v6.59h-1.45v-6.59h-2.26v-1.25h5.96v1.25h-2.26Z" style="fill:#fff;" />
                    <path d="M36.44,28.31c-1.83,0-3.07-.95-3.07-2.83v-5.14h1.46v4.96c0,.97,.46,1.68,1.61,1.68,1.07,0,1.61-.56,1.61-1.68v-4.96h1.46v5.03c0,1.87-1.24,2.94-3.07,2.94Z" style="fill:#fff;" />
                    <path d="M44.23,28.19h-3.07v-7.84h3.06c1.71,0,3.09,1.11,3.09,2.86v2.09c0,1.86-1.53,2.89-3.08,2.89Zm1.63-5.07c0-.95-.81-1.49-1.74-1.49h-1.5v5.27h1.55c.75,0,1.68-.4,1.68-1.52v-2.27Z" style="fill:#fff;" />
                    <path d="M51.89,25.06v3.12h-1.42v-3.15l-2.63-4.7h1.61l1.75,3.29,1.74-3.29h1.59l-2.64,4.72Z" style="fill:#fff;" />
                </g>
                <path d="M57.61,47.01v5m2,2.41l-10.32,5.16m-8.75,4.38l-4.04,2.02c-.56,.28-1.22,.28-1.79,0l-5.1-2.55m-6-3l-7.79-3.9c-1.36-.68-2.21-2.06-2.21-3.58v-4.05c0-1.51,.86-2.9,2.21-3.58l21.55-10.78c1.41-.7,3.06-.7,4.47,0l16.19,8.09c1.47,.74,1.47,2.84,0,3.58l-21.55,10.78c-.55,.28-1.19,.28-1.75,.02l-16.69-7.91c-.66-.31-1.43,.17-1.43,.9v3.01" style="fill:none; stroke:#fff; stroke-linecap:round; stroke-miterlimit:10; stroke-width:2px;" />
                <polygon points="29.61 68.62 26.61 65.09 23.61 65.57 23.61 55.57 29.61 58.62 29.61 68.62" style="fill:none; stroke:#fff; stroke-linecap:round; stroke-linejoin:round; stroke-width:2px;" />
                <path d="M57.4,69.59l-13.78-10.01v17c0,.51,.44,.69,.85,.29l3.86-3.73,3.72,6.56c.31,.51,1.05,.62,1.64,.25l1.56-.98c.58-.37,.81-1.08,.52-1.59l-3.58-6.21h4.68c.59,0,.97-1.28,.52-1.58Z" style="fill:none; stroke:#fff; stroke-miterlimit:10; stroke-width:2px;" />
            </svg>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <p><?php the_field('subtitle', $post); ?></p>
        </div>
    </div>

    <div class=" cs-content">

        <div class="cs-content-inner">
            <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
        </div>

    </div>

    <div class="cs-header-meta cs-header-meta-left">
        <div class="cs-header-meta-inner">
            <span class="cs-header-meta-span"><?php echo $industries[0]->name ?? 'Case Study'; ?></span>
        </div>
    </div>

    <div class="cs-header-meta cs-header-meta-right">
        <div class="cs-header-meta-inner">
            <span class="cs-header-meta-span"><?php echo $industries[0]->name ?? 'Case Study'; ?></span>
        </div>
    </div>
</div>

<?php if (!$is_preview) : ?>
    <script>
        (function($) {

            $(window).on("scroll load", function() {
                var objectTop = $("#<?php echo $block['id']; ?> .cs-header-meta").offset().top;
                var windowBottom = $(window).scrollTop() + $(window).innerHeight();
                var screensScrolled = ($(window).scrollTop() / $(window).innerHeight()) * 100;

                $("#<?php echo $block['id']; ?> .cs-header-meta-left .cs-header-meta-inner").css(
                    "top",
                    100 + screensScrolled - (objectTop / $(window).innerHeight()) * 100 + "vh"
                );
                $("#<?php echo $block['id']; ?> .cs-header-meta-right .cs-header-meta-inner").css(
                    "top",
                    screensScrolled - (objectTop / $(window).innerHeight()) * 100 + "vh"
                );
            });

        })(jQuery);
    </script>
<?php endif; ?>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>