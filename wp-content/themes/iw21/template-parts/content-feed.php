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

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
		if ( get_field( 'show_tag_cloud' ) )
			wp_tag_cloud();
		?>
	</div><!-- .entry-content -->

	<?php

	wp_reset_postdata();

	get_template_part( 'template-parts/feed/feed' );

	get_template_part( 'template-parts/feed/element', 'cta' );

	?>

</article><!-- #post-<?php the_ID(); ?> -->
