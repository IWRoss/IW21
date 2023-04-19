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
	<?php if (!get_field('hide_header')) : ?>
		<header class="entry-header">
			<?php iw23_render_post_title(); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php if ('post' === get_post_type()) : ?>
		<div class="entry-meta">
			<?php iw23_posted_by(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		if (have_rows('story')) :

			echo '<div class="masonry-grid story"><div class="masonry-grid-sizer"></div><div class="masonry-gutter-sizer"></div>';

			while (have_rows('story')) : the_row();

				get_template_part('template-parts/modules/story/story', get_row_layout());

			endwhile;

			echo '</div>';

		endif;

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'iw21'),
			'after'  => '</div>',
		));
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php do_action('iw23_content_footer'); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->