<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Interactive_Workshops_2021
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e('Page not found', 'iw21'); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e('Sorry, it looks like nothing was found at this location. You may find what you&rsquo;re looking for in the feed below.', 'iw21'); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

		<?php get_template_part('template-parts/feed/feed', '', array(
			'post_type' => 'post'
		)); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
