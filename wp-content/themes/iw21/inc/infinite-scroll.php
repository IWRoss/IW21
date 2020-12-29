<?php
/**
 * Custom infinite scrolling feature
 *
 * Basically, Jetpack is too restrictive.
 *
 * @package Interactive_Workshops_2021
 */

function iw21_get_a_page_of_posts_via_ajax() {
	
	$options = $_POST['options'];
	
	if (isset($_POST['chunk'])) {
		$options['offset'] = (intval($_POST['chunk']) - 1) * $_POST['ppp'];
	}
	
	/* Build our query */
	$feed_query = new WP_Query($options);

	if ($feed_query->have_posts()) : /* Start the loop */ ?>

		<div class="feed" class="masonry-grid" data-chunk="<?php echo intval($_POST['chunk']); ?>">
			<div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>

				<?php

				$index = 1;

				while ($feed_query->have_posts()) : $feed_query->the_post();

					$template = 'standard';

					if (get_page_template_slug()) {
						$template = iw21_template_nice_name();
					}

					// get_template_part('template-parts/feed/feed', $template, array(
					// 	'chunk' => $options['paged'],
					// 	'index' => $index
					// ) );

					get_template_part('template-parts/feed/feed', 'item', array(
						'chunk' => $options['paged'],
						'index' => $index
					) );

					$index++;

				endwhile;

				wp_reset_postdata();

				?>

		</div>

	<?php endif;

	die();
}
add_action( 'wp_ajax_nopriv_ajax_feed_pagination', 'iw21_get_a_page_of_posts_via_ajax' );
add_action( 'wp_ajax_ajax_feed_pagination', 'iw21_get_a_page_of_posts_via_ajax' );
