<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Interactive_Workshops_2021
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div class="preloader">
		<div class="preloader-inner">
			<?php get_template_part('template-parts/elements/element', 'logo'); ?>
		</div>
	</div>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'iw21'); ?></a>

		<?php

		if (is_front_page()) :
			iw21_parallax_background('dotted');
		else :
			iw21_parallax_background('dotted', false);
		endif;

		?>
		<header id="masthead" class="site-hero">

			<div class="site-header">
				<div class="site-branding">
					<h3 class="site-title"><?php bloginfo('name'); ?></h3>
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo">
						<svg xmlns="http://www.w3.org/2000/svg" width="364" height="91" viewBox="-1 -1 363 90">
							<g fill="none" fill-rule="evenodd">
								<polygon class="polygon--dark" stroke="#FF8D00" fill="none" points="27.96 37.98 22.96 20.05 6 20.05 19.45 69.93 27.96 37.98" />
								<polygon class="polygon--dark" stroke="#FF8D00" fill="none" points="41.7 52.43 46.56 69.98 55.25 37.35 50.61 20.05 50.61 20.06 41.7 52.43" />
								<polygon class="polygon--light" stroke="#FF8D00" fill="none" points="32.729 20.052 19.433 70 36.861 70 50.613 20.052" />
								<polygon class="polygon--light" stroke="#FF8D00" fill="none" points="59.851 20.052 46.555 70 64.013 70 77.766 20.052" />
								<polygon class="polygon--dark" stroke="#FF8D00" fill="none" points="0 0 4.763 16.321 22.187 16.321 16.963 0" />
								<text class="text--dark site-logo-text" fill="#FF8D00" font-family="Flama" font-size="26" font-weight="300">
									<tspan x="97" y="46">interactive</tspan>
									<tspan x="219" y="46" font-weight="bold">workshops</tspan>
								</text>
							</g>
							<g class="site-logo-tagline-long">
								<text transform="matrix(1 0 0 1 97.6729 68.1338)" fill="#FF8D00" class="text--dark" font-family="Flama" font-size="14.5" class="site-logo-text" font-weight="300">
									<a xlink:href="https://interactiveworkshops.com/story/" target="_blank" class="site-logo-sub-link">
										<tspan x="0" y="0">LONDON </tspan>
									</a>
									<tspan x="61.5" y="0">|</tspan>
									<a xlink:href="https://interactiveworkshops.com/interactive-workshops-growing-fast-in-new-york/" target="_blank" class="site-logo-sub-link">
										<tspan x="72.2" y="0"> NEW YORK</tspan>
									</a>
								</text>
							</g>
							<g class="site-logo-tagline-short">
								<text class="text--dark" font-size="20" fill="#282727" font-family="Flama" font-weight="300">
									<tspan x="2" y="100"> <a xlink:href="https://interactiveworkshops.com/story/" target="_blank" class="site-logo-sub-link"> LDN </a> | <a xlink:href="https://interactiveworkshops.com/new-york-new-york/" target="_blank" class="site-logo-sub-link"> NY</a> </tspan>
								</text>
							</g>
						</svg>
					</a>
				</div><!-- .site-branding -->

				<?php if (empty($_SESSION['experiment_hamburger']) || !$_SESSION['experiment_hamburger']) : ?>

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<?php get_template_part('template-parts/elements/element', 'burger'); ?>
						</button>

						<?php
						wp_nav_menu(array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'walker'		 => new IW_Megamenu_Walker()
						));
						?>

					</nav><!-- #site-navigation -->

				<?php else : ?>

					<nav id="site-navigation" class="experimental-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<?php get_template_part('template-parts/elements/element', 'burger'); ?>
						</button>

						<div class="top-navigation">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'menu-3',
								'menu_id'        => 'top-menu',
								'walker'		 => new IW_Menu_Walker()
							));
							?>
						</div>

						<div class="navigation-overlay">
							<div class="search-bar">
								<?php get_search_form(); ?>
							</div>

							<?php

							wp_nav_menu(array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'walker'		 => new IW_Menu_Walker()
							));

							// wp_nav_menu(
							// 	array(
							// 		'theme_location'  => 'menu-1',
							// 		'menu_id'         => 'social-menu',
							// 	)
							// );
							?>

						</div>

					</nav><!-- #site-navigation -->

				<?php endif; ?>

			</div>

		</header><!-- #masthead -->

		<div id="content" class="site-content">