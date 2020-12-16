<?php

/**
 * Template Name: Home Template
 * Template Post Type: page
 *
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2017
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php

		the_content();
		
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
