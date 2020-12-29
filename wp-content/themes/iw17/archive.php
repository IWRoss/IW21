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

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="entry-feed">

				<?php if ( isset($_GET['infsc'] ) && $_GET['infsc'] > 1 ) : ?>
					<div class="load-previous-posts">
						<a href="<?php echo home_url($wp->request); ?>/?infsc=<?php echo max(1, intval($_GET['infsc']) - 5); ?>" class="btn">Load more recent posts</a>
					</div>
				<?php endif; ?>


				<?php if ( have_posts() && ! isset($_GET['infsc'] ) ) : ?>
					
					<div class="feed" class="masonry-grid" data-chunk="1">
						<div class="masonry-grid-sizer"></div>
						<div class="masonry-gutter-sizer"></div>

						<?php 
						
						while ( have_posts() ) : the_post();

							$template = 'standard';

							if (get_page_template_slug()) {
								$template = iw17_template_nice_name();
							}

							get_template_part( 'template-parts/feed/feed', $template, array(
								'chunk' => $paged,
								'index' => $index
							)  );

						endwhile;

						?>

					</div>

				<?php endif; ?>
			</div>

			<?php echo '<div id="loader" class="loader"> <div id="spinner" class="spinner"> <div class="spinner-block"></div> <div class="spinner-block"></div> <div class="spinner-block"></div> <div class="spinner-block"></div> </div> <p>Loading more</p> </div>'; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
