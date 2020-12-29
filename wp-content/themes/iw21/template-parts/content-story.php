<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php iw21_render_post_title(); ?>
	</header><!-- .entry-header -->

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php iw21_posted_by(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			if ( have_rows( 'story' ) ) :

				echo '<div class="masonry-grid story"><div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>';

				while ( have_rows( 'story' ) ) : the_row();

					get_template_part( 'template-parts/modules/story/story', get_row_layout() );

				endwhile;

				echo '</div>';

			endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'iw21' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<?php if ( get_post_type() === 'post' || get_post_type() === 'work' ) : ?>
		<footer class="entry-footer">
			<?php get_template_part( 'template-parts/post/element', 'sharing-links' ); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
