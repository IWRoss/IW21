<?php

/**
 * Custom infinite scrolling feature
 *
 * Basically, Jetpack is too restrictive.
 *
 * @package Interactive_Workshops_2021
 */

function iw21_get_a_page_of_posts_via_ajax()
{

	$postdata = json_decode(str_replace("\\", '', $_POST['body']), true);

	$options = $postdata['options'];

	if (isset($postdata['chunk'])) {
		$options['offset'] = (intval($postdata['chunk']) - 1) * $postdata['ppp'];
	}


	/* Build our query */
	$feed_query = new WP_Query($options);

	if ($feed_query->have_posts()) : /* Start the loop */

		$index = 1;

		while ($feed_query->have_posts()) : $feed_query->the_post();

			$template = 'standard';

			if (get_page_template_slug()) {
				$template = iw21_template_nice_name();
			}

			get_template_part('template-parts/feed/feed', 'item', array(
				'chunk' => $postdata['chunk'],
				'index' => $index
			));

			$index++;

		endwhile;

		wp_reset_postdata();

	endif;

	die();
}
add_action('wp_ajax_nopriv_ajax_feed_pagination', 'iw21_get_a_page_of_posts_via_ajax');
add_action('wp_ajax_ajax_feed_pagination', 'iw21_get_a_page_of_posts_via_ajax');
