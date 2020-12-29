<?php
/**
 * Custom infinite scrolling feature
 *
 * Basically, Jetpack is too restrictive.
 *
 * @package Interactive_Workshops_2017
 */


function iw17_ajax_query_feed() {

	$options = $_POST['options'];

	if ( ! empty( $_POST['paged'] ) ) {
		$options['paged'] = $_POST['paged'];
	}

	if ( ! empty( $_POST['term'] ) ) {
		$options['tax_query'] = array(
			array(
				'taxonomy' => 'industry',
				'field' => 'term_id',
				'terms' => $_POST['term'],
			)
		);

		$options['posts_per_page'] = '-1';

		unset( $options['paged'] );
	}

	/* Build our query */
	$feed_query = new WP_Query( $options );

	if ( $feed_query->have_posts() ) :

		/* Start the loop */

		while ( $feed_query->have_posts() ) : $feed_query->the_post();

			/* We need to detect the template to decide which feed template part to use */

			if ( get_page_template_slug() ) :
				get_template_part( 'template-parts/feed/feed', iw17_template_nice_name() );
			else :
				get_template_part( 'template-parts/feed/feed', 'standard' );
			endif;

		endwhile;

		wp_reset_postdata();

	endif;

    die();
}

function iw17_get_a_page_of_posts_via_ajax() {
	
	$options = $_POST['options'];
	
	if (isset($_POST['chunk'])) {
		$options['offset'] = intval($_POST['chunk']) * $_POST['ppp'];
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
						$template = iw17_template_nice_name();
					}

					get_template_part('template-parts/feed/feed', $template, array(
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
add_action( 'wp_ajax_nopriv_ajax_feed_pagination', 'iw17_get_a_page_of_posts_via_ajax' );
add_action( 'wp_ajax_ajax_feed_pagination', 'iw17_get_a_page_of_posts_via_ajax' );
