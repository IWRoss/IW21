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

			<?php foreach( $team as $member ) : ?>

				<div class="toast__col toast__col--1-of-4 toast__col--m-1-of-3 toast__col--s-1-of-2">

					<?php if ( $team_image = get_field( 'team_image', 'user_' . $member['ID'] ) ) : ?>
						<div class="team-member--img" style="background-image:url('<?php echo $team_image['sizes']['medium_large']; ?>')">
					<?php else : ?>
						<div class="team-member--img">
					<?php endif; ?>

						<a href="#" rel="team-<?php echo $member['ID']; ?>" data-iw-modal="open" class="team-modal--open">Click for bio</a>
					</div>

					<h5 class="team-member--name"><?php echo $member['nickname']; ?></h5>

					<?php if ( $role = get_field( 'role', 'user_' . $member['ID'] ) ) : ?>
						<p class="team-member--role"><?php echo $role; ?></p>
					<?php endif; ?>

					<div id="team-<?php echo $member['ID']; ?>" class="iw-modal team-modal">

						<div class="iw-modal-window team-modal-window">
							<span class="close" data-iw-modal="close">&times;</span>

							<?php if ( $bio_image = get_field( 'bio_image', 'user_' . $member['ID'] ) ) : ?>
								<div class="team-modal--img" style="background-image:url('<?php echo $bio_image; ?>')"></div>
							<?php endif; ?>

							<div class="iw-modal--content team-modal--content">
								<h5 class="team-member--name"><?php echo $member['nickname']; ?></h5>

								<?php echo wpautop( $member['user_description'] ); ?>

								<dl class="team-member--details">
									<div class="team-member--email">
										<dt>Email:</dt>
										<dd>
											<a href="mailto:<?php echo $member['user_email'] ?>" target="_blank"><?php echo $member['user_email'] ?></a>
										</dd>
									</div>

									<?php if ( $phone = get_field( 'phone', 'user_' . $member['ID'] ) ) : ?>
										<div class="team-member--phone">
											<dt>Phone:</dt>
											<dd>
												<?php echo $phone; ?>
											</dd>
										</div>
									<?php endif; ?>
								</dl>
							</div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

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
