<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php get_template_part('template-parts/feed/feed', ''); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
