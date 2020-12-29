<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Interactive_Workshops_2021
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'iw21' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<?php
			echo '<div class="masonry-grid"><div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>';

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				if ( $template = get_page_template_slug() ) {

					$template = preg_replace( '/(single-)|(work-)+/', '', wp_basename( $template, '.php' ) );

					if ( locate_template( $template ) == '' ) {
						$template = 'standard';
					}

				} else {
					$template = 'standard';
				}

				get_template_part( 'template-parts/feed/feed', $template );

			endwhile;

			echo '</div>';

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
