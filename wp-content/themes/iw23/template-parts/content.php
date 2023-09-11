<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (!get_field('hide_header')) : ?>
		<header class="entry-header">
			<?php iw23_back_button(); ?>

			<?php iw23_render_post_title(); ?>

			<?php get_field('subtitle') ? printf('<h3 class="entry-subtitle">%s</h3>', get_field('subtitle')) : ''; ?>

			<?php if ('post' === get_post_type()) : ?>
				<div class="entry-meta">
					<?php iw23_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php

		do_action('iw23_before_content');

		the_content(sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'iw21'),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		));

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'iw21'),
			'after'  => '</div>',
		));

		do_action('iw23_after_content');

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php do_action('iw23_content_footer'); ?>

		<?php iw23_back_button(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->