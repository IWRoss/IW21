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

	<?php
	if (iw21_is_cta_post())
		get_template_part('template-parts/footers/footer', 'single');
	?>

	<div class="site-info">
		<div class="toast">
			<div class="toast__col toast__col--1-of-2">
				<p><a href="tel:442033185753"><strong>+44 (0) 203 318 5753</strong></a> // <a href="mailto:info@interactiveworkshops.com"><strong>info@interactiveworkshops.com</strong></a></p>
			</div>
			<div class="toast__col toast__col--1-of-2">
				<p><small>&copy; <?php echo date('Y'); ?> Interactive Workshops. Read our <a href="<?php echo get_permalink(get_page_by_title('Terms of Service and Privacy Policy')); ?>">Privacy Policy</a>. <a href="#page">Back to top</a></small></p>
			</div>
		</div>

	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>