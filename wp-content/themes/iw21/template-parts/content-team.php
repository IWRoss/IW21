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

			?>

			<div class="toast__col toast__col--1-of-2">
				<div class="page-template-page-team--call-to-action">
					<h3>Want to talk about your project? Drop us an email to say hello.</h3>
					<p>Get in touch to discover why we are the industry's leading experience design and facilitation specialists.</p>
					<a href="<?php echo get_permalink( get_page_by_title( 'Get in touch' ) ) ?>" class="btn">Email us</a>
				</div>
			</div>

		</div>

	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
