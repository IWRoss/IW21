<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Interactive_Workshops_2017
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Error 404 // Page not found', 'iw17' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Sorry, it looks like nothing was found at this location. You may find what you&rsquo;re looking for in the feed below.', 'iw17' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

			<div class="entry-feed">
				<?php
					/* Let's get some posts. We'll start by getting everything */
					$options = array(
						'posts_per_page'	=> -1,
						'post_type'			=> 'post'
					);

					/* Build our query */
					$feed_query = new WP_Query( $options );

					if ( $feed_query->have_posts() ) :

						/* Start the loop */

						echo '<div class="masonry-grid"><div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>';

						while ( $feed_query->have_posts() ) : $feed_query->the_post();

							/*
							 * We want to render in different styles depending on post format. The function get_post_format()
							 * returns false when 'Standard' post format selected, so let's wrap in a conditional.
							 */

							 if ( get_page_template_slug() ) :
		 						get_template_part( 'template-parts/feed/feed', iw17_template_nice_name() );
		 					else :
		 						get_template_part( 'template-parts/feed/feed', 'standard' );
		 					endif;

						endwhile;

						wp_reset_postdata();

						echo '</div>';

					else :

						echo '<p>No posts to display.</p>';

					endif;
				?>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
