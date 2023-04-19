<?php
/**
 * Template part for displaying page content in page-schindler.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action('iw21_before_content'); ?>
	
	<?php the_content(); ?>
	
	<?php do_action('iw21_after_content'); ?>
	
</article><!-- #post-<?php the_ID(); ?> -->