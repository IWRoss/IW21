<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2017
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			echo '<div class="masonry-grid"><div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>';

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				if ( $template = get_page_template_slug() ) :
					$template = preg_replace( '/(single-)|(work-)+/', '', wp_basename( $template, '.php' ) );

					get_template_part( 'template-parts/feed/feed', $template );
				else :
					get_template_part( 'template-parts/feed/feed', 'standard' );
				endif;

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
