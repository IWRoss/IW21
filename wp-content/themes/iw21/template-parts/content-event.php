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
	<header class="entry-header">
		<?php iw21_render_post_title(); ?>
	</header><!-- .entry-header -->

    <?php if ( get_field( 'date' ) && get_field( 'time' ) && get_field( 'location' ) ) : ?>
        <div class="event-leader">
            <div class="toast">
                <div class="toast__col toast__col--2-of-3">
                    <dl class="event-details">
                        <div class="event-date">
                            <dt>Date</dt>
                            <dd><?php echo get_field( 'date' ); ?></dd>
                        </div>
                        <div class="event-time">
                            <dt>Time</dt>
                            <dd><?php echo get_field( 'time' ); ?></dd>
                        </div>
                        <div class="event-location">
                            <dt>Location</dt>
                            <dd><?php echo get_field( 'location' ); ?></dd>
                        </div>

                        <?php if ( $info = get_field( 'additional_information' ) ) : ?>
                            <div class="event-additional-information">
                                <?php echo $info; ?>
                            </div>
                        <?php endif; ?>
                    </dl>
                </div>
                <div class="toast__col toast__col--1-of-3">
                    <div class="event-button">
                        <?php
                            if ( get_field( 'closed' ) == 'direct' ) :
								echo sprintf( '<a href="mailto:%s" class="btn event-signup" target="_blank">Register Interest</a>', get_field( 'direct_contact' ) );
                            elseif ( get_field( 'closed' ) == 'indirect' ) :
                                get_template_part( 'template-parts/post/element', 'mailchimp' );
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


	<div class="entry-content">
		<?php
            if ( $oembed = get_field( 'promo_video' ) ) :
                echo '<div class="event-media">', $oembed, '</div>';
			elseif ( has_post_thumbnail() ) :
                echo '<div class="event-media">', get_the_post_thumbnail(), '</div>';
			endif;
		?>

		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'iw21' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			if ( get_field( 'closed' ) == 'direct' ) :
				echo sprintf( '<a href="mailto:%s" class="btn event-signup" target="_blank">Register Interest</a>', get_field( 'direct_contact' ) );
			elseif ( get_field( 'closed' ) == 'indirect' ) :
    			echo '<a href="#page" class="btn event-signup" target="_blank">Register Interest</a>';
            endif;
		?>
	</div><!-- .entry-content -->

    <?php if ( get_post_type() === 'post' || get_post_type() === 'work' ) : ?>
        <footer class="entry-footer">
            <?php get_template_part( 'template-parts/post/element', 'sharing-links' ); ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
