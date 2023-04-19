<?php

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */


$is_author = !empty($wp_query->query['author_name']);

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<header class="page-header">
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			?>

			<?php

			if (!$is_author) :
				the_archive_description('<div class="archive-description">', '</div>');
			else :

				echo '<div class="archive-description">';

				$user = get_user_by('slug', $wp_query->query['author_name']);

				/**
				 * Show team member in grid
				 */
				get_template_part('template-parts/team/team', 'grid', array(
					'member' => array(
						'ID'               => $user->ID,
						'user_firstname'   => $user->user_firstname,
						'user_lastname'    => $user->user_lastname,
						'nickname'         => $user->nickname,
						'user_nicename'    => $user->user_nicename,
						'display_name'     => $user->display_name,
						'user_email'       => $user->user_email,
						'user_url'         => $user->user_url,
						'user_registered'  => $user->user_registered,
						'user_description' => $user->user_description,
						'user_avatar'      => get_avatar($user->ID),
					)
				));

				echo '</div>';

			?>
			<?php endif; ?>
		</header><!-- .page-header -->

		<?php get_template_part('template-parts/feed/feed', ''); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
