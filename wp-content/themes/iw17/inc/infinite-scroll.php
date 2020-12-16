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

add_action( 'wp_ajax_nopriv_ajax_feed_pagination', 'iw17_ajax_query_feed' );
add_action( 'wp_ajax_ajax_feed_pagination', 'iw17_ajax_query_feed' );
