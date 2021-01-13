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
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'iw21' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( $team = get_field( 'team' ) ) : ?>

		<div class="toast">

			<?php
			
			foreach( $team as $member ) :

				/**
				 * Show team member in grid
				 */
				get_template_part('template-parts/team/team', 'grid', array(
					'member' => $member
				));				

			endforeach;

			get_template_part('template-parts/elements/element', 'team-cta');

			?>

		</div>

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
