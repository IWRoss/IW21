<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Interactive_Workshops_2021
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">

	<?php get_template_part('template-parts/footers/footer', get_post_type()); ?>

	<nav class="footer-navigation">

		<a href="#page" class="back-to-top"><i class="fa fa-angle-up"></i></a>

		<?php
		wp_nav_menu(array(
			'theme_location' => 'menu-4',
			'menu_id'        => 'footer-menu',
			'walker'		 => new IW_Menu_Walker()
		));
		?>

	</nav>

	<nav class="social-navigation">

		<?php
		wp_nav_menu(array(
			'theme_location' => 'menu-2',
			'menu_id'        => 'footer-social-menu',
			'walker'		 => new IW_Menu_Walker()
		));
		?>

	</nav>

	<div class="site-info">
		<div class="contact-info">
			<p><a href="tel:442033185753"><strong>+44 (0) 203 318 5753</strong></a> // <a href="mailto:info@interactiveworkshops.com"><strong>info@interactiveworkshops.com</strong></a></p>
		</div>
		<div class="business-info">
			<p><small>&copy; <?php echo date('Y'); ?> Interactive Workshops. Read our <a href="<?php echo get_permalink(get_page_by_title('Terms of Service and Privacy Policy')); ?>">Privacy Policy</a>. <a href="#page">Back to top</a></small></p>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>