<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Interactive_Workshops_2017
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
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 50" class="lines-logo">
				<polygon points="14.01 0.03 0.72 49.97 18.14 49.97 31.9 0.03 14.01 0.03" style="fill:#fff;fill-rule:evenodd" />
				<polygon points="41.13 0.03 27.84 49.97 45.3 49.97 59.05 0.03 41.13 0.03" style="fill:#fff;fill-rule:evenodd" />
			</svg>
		</div>
	</div>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'iw17'); ?></a>

		<?php

		if (is_front_page()) :
			iw17_parallax_background('graph');
		else :
			iw17_parallax_background('graph', false);
		endif;

		?>
		<header id="masthead" class="site-hero parallax">

			<div class="site-header">
				<div class="site-branding">
					<h3 class="site-title"><?php bloginfo('name'); ?></h3>
					<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-logo">
						<svg xmlns="http://www.w3.org/2000/svg" width="361" height="70" viewBox="-1 -1 363 72">
							<g fill="none" fill-rule="evenodd">
								<polygon class="polygon--dark" fill="#22222A" points="27.96 37.98 22.96 20.05 6 20.05 19.45 69.93 27.96 37.98" />
								<polygon class="polygon--dark" fill="#22222A" points="41.7 52.43 46.56 69.98 55.25 37.35 50.61 20.05 50.61 20.06 41.7 52.43" />
								<polygon class="polygon--light" fill="#FF8D00" points="32.729 20.052 19.433 70 36.861 70 50.613 20.052" />
								<polygon class="polygon--light" fill="#FF8D00" points="59.851 20.052 46.555 70 64.013 70 77.766 20.052" />
								<polygon class="polygon--dark" fill="#22222A" points="0 0 4.763 16.321 22.187 16.321 16.963 0" />
								<text class="text--dark" fill="#22222A" font-family="Flama" font-size="26" class="site-logo-text" font-weight="300">
									<tspan x="97" y="46">interactive</tspan>
									<tspan x="219" y="46" font-weight="bold">workshops</tspan>
								</text>
							</g>
						</svg>
					</a>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'iw17'); ?></button>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					));
					?>
				</nav><!-- #site-navigation -->

			</div>

		</header><!-- #masthead -->

		<div id="content" class="site-content">