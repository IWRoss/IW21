<?php

/**
 * Shortcode functions
 *
 * @package Interactive_Workshops_2021
 */

/**
 * IW signoff shortcode
 */
function iw23_signoff_shortcode()
{
	return '<img src="' . get_template_directory_uri() . '/imgs/logo-mark.svg" alt="iw" class="signoff" />';
}
add_shortcode('signoff', 'iw23_signoff_shortcode');

/**
 * Mailchimp shortcode
 */
function iw23_signup_shortcode($atts)
{

	$a = shortcode_atts(array(
		'title' 	  => 'Don&rsquo;t miss out&hellip;',
		'description' => 'Sign up to our mailing list for all the latest from the IW team.',
		'id' 		  => '8512bd090e'
	), $atts);

	ob_start();

?>

	<div class="call-to-action call-to-action-narrow">
		<div class="call-to-action--single">
			<h3 class="signup-form-title"><?php echo $a['title']; ?></h3>

			<p class="signup-form-description"><?php echo $a['description']; ?></p>

			<?php iw23_mailchimp_html_form($a['id']); ?>
		</div>
	</div>

<?php

	$form = ob_get_contents();

	ob_end_clean();

	return $form;
}
add_shortcode('signup', 'iw23_signup_shortcode');

/**
 * Logos shortcode
 */
function iw23_logo_slider($atts)
{

	ob_start();

	$logos = get_field('logos', 'option'); ?>

	<div class="client-logos">
		<?php foreach ($logos as $logo) : ?>
			<div class="slide"><?php echo sprintf('<img src="%s" alt="%s" />', $logo['sizes']['medium'], $logo['alt']); ?></div>
		<?php endforeach; ?>
	</div>

	<script type="text/javascript">
		(function($) {
			$('.client-logos').slick({
				slidesToShow: 6,
				slidesToScroll: 6,
				autoplay: true,
				autoplaySpeed: 3000,
				arrows: false,
				dots: false,
				pauseOnHover: false,
				responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4
					}
				}, {
					breakpoint: 520,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}]
			});
		})(jQuery);
	</script>

<?php

	$slider = ob_get_contents();

	ob_end_clean();

	return $slider;
}
add_shortcode('clients', 'iw23_logo_slider');

/**
 * Display Industries list
 */
function iw23_industries_list_shortcode()
{

	$terms = get_terms(array('taxonomy' => 'industry', 'hide_empty' => false));

	ob_start(); ?>

	<h4 style="text-align:center;">Filter by industry:</h4>
	<ul class="industries-list">
		<?php foreach ($terms as $term) : ?>
			<li class="industries-list-item"><a href="<?php echo get_term_link($term); ?>" class="btn btn-small" data-filter="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a></li>
		<?php endforeach; ?>
	</ul>

<?php $industries = ob_get_contents();

	ob_end_clean();

	return $industries;
}
add_shortcode('industries', 'iw23_industries_list_shortcode');
