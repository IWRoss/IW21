<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2017
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	get_template_part( 'template-parts/feed/feed' );

	get_template_part( 'template-parts/feed/element', 'cta' );
	
	?>

</article><!-- #post-<?php the_ID(); ?> -->
