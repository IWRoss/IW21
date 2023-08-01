<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function iw23_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter('body_class', 'iw23_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function iw23_pingback_header()
{
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
	}
}
add_action('wp_head', 'iw23_pingback_header');

/**
 * Change length of excerpt to 30
 */
function iw23_excerpt_length($length)
{
	return 30;
}
add_filter('excerpt_length', 'iw23_excerpt_length', 999);

/**
 * Change document title separator
 */
add_filter('document_title_separator', function ($sep) {
	return "//";
});

/**
 * 
 */
function iw23_sprintf($string, $replacements)
{
	return str_replace(array_keys($replacements), array_values($replacements), $string);
}

/**
 * Alter title part of document title to add company in certain instances
 */
add_filter('document_title_parts', function ($title) {

	global $post;

	if (get_post_type() === 'work' && $company = get_field('company')) {
		$title['title'] = $company . ' // ' . $title['title'];
	}

	return $title;
});

/**
 * Return true if post/page meets conditions
 */
function iw23_is_cta_post()
{

	global $post;

	// Override
	return false;

	if (is_page_template('page-templates/single-event.php')) :
		return false;
	endif;

	if (is_page_template('page-templates/page-feed.php')) :
		return false;
	endif;

	if (is_front_page()) :
		return false;
	endif;

	if (is_page('contact')) :
		return false;
	endif;

	return true;
}

/**
 * Turn string with line breaks into options dynamo.min.js can use
 */
function iw23_render_dynamic_text_array($string, $target)
{

	$string_parts = explode(PHP_EOL, $string);

	$result = array();

	foreach ($string_parts as $key => $part) {

		$part = preg_split('/(?<!\w)' . $target . '/', $part);

		$result[0][$key] = substr($part[0], 1);

		$result[1][$key] = $part[1];
	}

	return $result;
}

/**
 * Render html element for the parallax background
 */
function iw23_parallax_background($type = 'squares', $full = true)
{

	$classes = array(
		'background',
		'parallax',
		$type
	);

	if ($full) :
		$classes[] = 'full-height';
	endif;

	echo '<div class="', implode(' ', $classes), '"></div>';
}

/**
 * Retrieve array of post classes
 */
function iw23_get_the_post_classes()
{
	global $post;

	$classes = [];

	// Post thumbnail class
	if (has_post_thumbnail()) :
		$classes[] = 'has-thumbnail';
	endif;

	// if ( $user_author_image ) :
	//     $classes[] = 'has-author-image';
	// endif;

	// Category class
	$categories = get_the_category();

	foreach ($categories as $category) :
		$classes[] = 'category-' . $category->slug;
	endforeach;

	// Industry class
	$industries = get_the_terms($post->post_id, 'industry');

	if ($industries) :
		foreach ($industries as $industry) :
			$classes[] = 'industry-' . $industry->slug;
		endforeach;
	endif;

	// Outcome class
	$outcomes = get_the_terms($post->post_id, 'outcome');

	if ($outcomes) :
		foreach ($outcomes as $outcome) :
			$classes[] = 'outcome-' . $outcome->slug;
		endforeach;
	endif;

	if ($template = get_page_template_slug()) :
		$classes[] = 'feed-' . wp_basename($template, '.php');

		if ($template !== 'work-quote' && $template !== 'single-thought') :
			$classes[] = 'shadow-effect';
		endif;
	else :
		$classes[] = 'feed-standard';
	endif;

	$classes[] = get_post_type() ? 'post-type-' . get_post_type() : 'post-type-post';

	if ($span = get_field('span', $post)) :
		$classes[] = 'grid-item--width' . $span;
	endif;

	$classes[] = 'fade';

	return $classes;
}

/**
 * Turn array of post classes into string
 */
function iw23_get_the_post_classes_string()
{
	return implode(' ', iw23_get_the_post_classes());
}

function iw23_get_the_title()
{
	global $post;

	$title = get_the_title();


	if ($company = get_field('company', $post)) {
		$title = '<span class="post-company">' . $company . ' //</span> ' . $title;
	} else if ($terms = get_the_terms($post->ID, 'industry')) {
		$title = '<span class="post-company">' . $terms[0]->name . ' //</span> ' . $title;
	}

	return $title;
}

/**
 * Add company title to post name and include class for post length
 */
function iw23_render_post_title($title = false)
{
	global $post;

	if (!$title) {
		$title = iw23_get_the_title();
	}

	$longest_word = array_reduce(str_word_count(strip_tags($title), 1), function ($v, $p) {
		return strlen($v) > strlen($p) ? $v : $p;
	});

	$length = 'short-title';

	if (strlen(strip_tags($title)) >= 25 || strlen($longest_word) >= 12) {
		$length = 'long-title';
	}

	$type = 'entry-title';

	if (is_page()) {
		$type = 'page-title';
	}

	echo sprintf('<h1 class="%s %s">%s</h1>', $type, $length, $title);
}

/**
 * Get a nice name version of the template
 */
function iw23_template_nice_name($id = null)
{
	if ($id) {
		$template = get_page_template_slug($id);
	} else {
		$template = get_page_template_slug();
	}

	return preg_replace('/(single-)|(work-)+/', '', wp_basename($template, '.php'));
}

/**
 * Intepret ACF fields to create query arguments for feed
 */
function iw23_get_query_options($paged = false)
{
	global $post;

	/* Let's get some posts. */
	$options = array(
		'posts_per_page' => get_option('posts_per_page')
	);

	if ($paged) {
		$options['paged'] = $paged;
	}

	/* Get our differentiator */
	$taxonomy = get_field('taxonomy');

	if ($taxonomy === 'post_type' && $post_type = get_field('post_type')) {
		$options['post_type'] = $post_type;
	} else {
		$options['post_type'] = array('post', 'work');

		if ($taxonomy === 'category' && $categories = get_field('category')) {

			/* Easy peasy */
			$options['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => $categories
				)
			);
		} else if ($taxonomy === 'tag' && $tags = get_field('tag')) {

			/* Lemon squeezy */
			$options['tax_query'] = array(
				array(
					'taxonomy' => 'post_tag',
					'field' => 'id',
					'terms' => $tags
				)
			);
		} else if ($taxonomy === 'template' && $templates = get_field('template')) {

			/* Macaroni cheesy */
			$options['meta_query'] = array(
				array(
					'key'   => '_wp_page_template',
					'value' => $templates
				)
			);
		} else if ($taxonomy === 'select' && $selected_posts = get_field('selected_posts', false, false)) {

			/* Using Febrezey */
			$options['post__in'] = $selected_posts;
			$options['orderby'] = 'post__in';
		}
	}

	$options['post_status'] = 'publish';

	return $options;
}

/**
 * Floating action button
 */
function iw23_floating_action_button($title)
{
	// Disable
	return;

	// echo '<a href="' . get_permalink( get_page_by_title( $title ) ). '" class="fab"></a>';
	echo '<a href="#" class="fab" data-iw-modal="open" rel="', $title, '"></a>';
}

/**
 * Custom format image as css
 */
function hardyware_format_image_background_css($image)
{

	if (!$image) {
		return;
	}

	printf('background-image:url(\'%s\')', $image);
}

/**
 * Remove website field from comments
 */
function iw23_disable_comment_url($fields)
{
	unset($fields['url']);
	return $fields;
}
add_filter('comment_form_default_fields', 'iw23_disable_comment_url');


/**
 * Change email address based on a response
 */
function iw23_redirect_contact_form($to, $postdata, $post_id)
{

	if (in_array('Playbook', $postdata['field-id-like-more-information-on']['value'])) {
		return 'jerome@interactiveworkshops.com';
	}

	return $to;
}
// add_filter('coblocks_form_email_to', 'iw23_redirect_contact_form', 10, 3);


function iw23_custom_disable_author_page()
{
	global $wp_query;

	if (is_author()) {
		// Redirect to homepage, set status to 301 permenant redirect. 
		// Function defaults to 302 temporary redirect. 
		wp_redirect(get_option('home'), 301);
		exit;
	}
}
// add_action('template_redirect', 'iw23_custom_disable_author_page');

function iw23_body_class($classes)
{
	$include = array(
		// browsers/devices (https://codex.wordpress.org/Global_Variables)
		'is-iphone'            => $GLOBALS['is_iphone'],
		'is-chrome'            => $GLOBALS['is_chrome'],
		'is-safari'            => $GLOBALS['is_safari'],
		'is-ns4'               => $GLOBALS['is_NS4'],
		'is-opera'             => $GLOBALS['is_opera'],
		'is-mac-ie'            => $GLOBALS['is_macIE'],
		'is-win-ie'            => $GLOBALS['is_winIE'],
		'is-gecko'             => $GLOBALS['is_gecko'],
		'is-lynx'              => $GLOBALS['is_lynx'],
		'is-ie'                => $GLOBALS['is_IE'],
		'is-edge'              => $GLOBALS['is_edge'],
		// WP Query (already included by default, but nice to have same format)
		'is-archive'           => is_archive(),
		'is-post_type_archive' => is_post_type_archive(),
		'is-attachment'        => is_attachment(),
		'is-author'            => is_author(),
		'is-category'          => is_category(),
		'is-tag'               => is_tag(),
		'is-tax'               => is_tax(),
		'is-date'              => is_date(),
		'is-day'               => is_day(),
		'is-feed'              => is_feed(),
		'is-comment-feed'      => is_comment_feed(),
		'is-front-page'        => is_front_page(),
		'is-home'              => is_home(),
		'is-privacy-policy'    => is_privacy_policy(),
		'is-month'             => is_month(),
		'is-page'              => is_page(),
		'is-paged'             => is_paged(),
		'is-preview'           => is_preview(),
		'is-robots'            => is_robots(),
		'is-search'            => is_search(),
		'is-single'            => is_single(),
		'is-singular'          => is_singular(),
		'is-time'              => is_time(),
		'is-trackback'         => is_trackback(),
		'is-year'              => is_year(),
		'is-404'               => is_404(),
		'is-embed'             => is_embed(),
		// Mobile
		'is-mobile'            => wp_is_mobile(),
		'is-desktop'           => !wp_is_mobile(),
		// Common
		'has-blocks'           => function_exists('has_blocks') && has_blocks(),
		'no-header'			   => function_exists('get_field') && get_field('hide_header')
	);

	// Sidebars
	foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
		$include["is-sidebar-{$sidebar['id']}"] = is_active_sidebar($sidebar['id']);
	}

	// Add classes

	foreach ($include as $class => $do_include) {
		if ($do_include) $classes[$class] = $class;
	}

	// Return

	return $classes;
}

add_filter('body_class', 'iw23_body_class');

function iw23_preloader()
{
?>

	<script type="text/javascript">
		setTimeout(function() {
			jQuery('.preloader').fadeOut(250);
			jQuery('body').addClass('loaded');
		}, 250);


		// // jQuery(window).on('load', function() {
		// // 	jQuery('.preloader').fadeOut(250);
		// // 	jQuery('body').addClass('loaded');
		// // });

		// // Create Promises for each event
		// const allImagesLoadedPromise = new Promise(resolve => {
		// 	document.addEventListener('allImagesLoaded', resolve);
		// });

		// const allVideosLoadedPromise = new Promise(resolve => {
		// 	document.addEventListener('allVideosLoaded', resolve);
		// });

		// // Use Promise.all() to wait for both promises to resolve
		// Promise.all([allImagesLoadedPromise, allVideosLoadedPromise])
		// 	.then(() => {
		// 		document.querySelector('body').classList.add('loaded');

		// 		document.querySelector('.preloader').classList.add('fadeOut');

		// 		setTimeout(function() {
		// 			document.querySelector('.preloader').style.display = 'none';
		// 		}, 250);
		// 	});

		// /**
		//  * Create an event listener to see if all images without an
		//  * attribute of loading="lazy" have loaded.
		//  * */
		// const images = document.querySelectorAll('img:not([loading="lazy"])');

		// images.forEach(image => {
		// 	image.addEventListener('load', () => {
		// 		// Check images array to see if each image has loaded
		// 		if (images.length !== Array.from(images).filter(image => image.complete).length) {
		// 			return;
		// 		}

		// 		document.dispatchEvent(new Event('allImagesLoaded'));
		// 	});
		// });

		// /**
		//  * Create an event listener to see if all videos have loaded.
		//  */
		// const videos = document.querySelectorAll('video');

		// videos.forEach(video => {
		// 	video.addEventListener('loadeddata', () => {
		// 		// Check videos array to see if each video has loaded
		// 		if (videos.length !== Array.from(videos).filter(video => video.readyState >= 3).length) {
		// 			return;
		// 		}

		// 		document.dispatchEvent(new Event('allVideosLoaded'));
		// 	});
		// });

		// // If no images or videos, dispatch event
		// if (images.length === 0) {
		// 	document.dispatchEvent(new Event('allImagesLoaded'));
		// }

		// if (videos.length === 0) {
		// 	document.dispatchEvent(new Event('allVideosLoaded'));
		// }

		// // If browser is Safari, bypass preloader
		// if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
		// 	document.dispatchEvent(new Event('allImagesLoaded'));
		// 	document.dispatchEvent(new Event('allVideosLoaded'));
		// }

		// // If browser is Web0S; Linux/SmartTV, bypass preloader
		// if (/web0s/i.test(navigator.userAgent)) {
		// 	document.dispatchEvent(new Event('allImagesLoaded'));
		// 	document.dispatchEvent(new Event('allVideosLoaded'));
		// }
	</script>

<?php
}
add_action('wp_footer', 'iw23_preloader');


function iw23_update_form_element_with_javascript()
{
	global $post;

	$script_content = '';

	if ($redirects = get_field('redirects')) {

		foreach ($redirects as $redirect) {
			$script_content .= sprintf('jQuery("%s").attr("action", "%s");', $redirect['css_selector'], $redirect['endpoint']);
		}

		$script_content .= 'jQuery(\'.coblocks-field--email[type="email"]\').attr(\'name\', \'email\');';
	}

	if ($custom_names = get_field('custom_names')) {

		foreach ($custom_names as $custom_name) {
			$script_content .= sprintf('jQuery("%s").attr("name", "%s");', $custom_name['css_selector'], $custom_name['name']);
		}
	}

	if ($custom_values = get_field('custom_values')) {

		foreach ($custom_values as $custom_value) {
			$script_content .= sprintf('jQuery("%s").attr("value", "%s");', $custom_value['css_selector'], $custom_value['value']);
		}
	}

	if ($custom_classes = get_field('custom_classes')) {

		foreach ($custom_classes as $custom_class) {
			$script_content .= sprintf('jQuery("%s").addClass("%s");', $custom_class['css_selector'], $custom_class['class']);
		}
	}

	$script_content .= sprintf('jQuery(".coblocks-form form").append("<input type=\"hidden\" name=\"referrer\" value=\"%s\">");', get_the_title());

	printf('<script>jQuery(document).on("ready", function(){%s});</script>', $script_content);
}
add_action('wp_footer', 'iw23_update_form_element_with_javascript');


function iw23_load_template_field_choices($field)
{

	// reset choices
	$field['choices'] = array();


	// get the textarea value from options page without any formatting
	$choices = wp_get_theme()->get_page_templates(null, 'post') + wp_get_theme()->get_page_templates(null, 'work') + wp_get_theme()->get_page_templates(null, 'page');

	// loop through array and add to field 'choices'
	if (is_array($choices)) {

		foreach ($choices as $path => $label) {

			$field['choices'][$path] = $label;
		}
	}

	asort($field['choices']);

	// return the field
	return $field;
}

add_filter('acf/load_field/name=template', 'iw23_load_template_field_choices');

function iw23_build_args_from_query_builder($field)
{

	$args = array(
		'posts_per_page' => get_option('posts_per_page'),
		'post_type'		 => array('post', 'work')
	);

	if ($field) {

		foreach ($field as $rule) {

			if ($rule['acf_fc_layout'] === 'post_type') {
				$args['post_type'] = $rule['post_type'];
			}

			if (in_array($rule['acf_fc_layout'], array('category', 'post_tag'))) {

				$args['tax_query'][] = array(
					'taxonomy' => $rule['acf_fc_layout'],
					'field' => 'id',
					'terms' => $rule[$rule['acf_fc_layout']]
				);
			}

			if ($rule['acf_fc_layout'] === 'template') {
				$args['meta_query'] = array(
					array(
						'key'   => '_wp_page_template',
						'value' => $rule['template']
					)
				);
			}

			if ($rule['acf_fc_layout'] === 'length') {
				$args['posts_per_page'] = $rule['length'];
			}

			if ($rule['acf_fc_layout'] === 'order') {
				$args['order'] = $rule['order'];
			}

			if ($rule['acf_fc_layout'] === 'selection') {

				/* Using Febrezey */
				$args['post__in'] = $rule['selection'];
				$args['orderby'] = 'post__in';
			}
		}
	}

	$args['post_status'] = 'publish';

	return $args;
}

function iw23_edit_posts_orderby($orderby_statement)
{
	$orderby_statement = " term_taxonomy_id DESC, post_date DESC ";
	return $orderby_statement;
}

function iw23_search_for_key($match, $search_key, $array)
{
	foreach ($array as $key => $val) {
		if ($val[$search_key] === $match) {
			return $key;
		}
	}
	return null;
}

function iw23_block_colors($color_field, $background_field)
{

	$classes = [];
	$inline_styles = [];

	if ($color_field && strpos($color_field, '#') === false) {
		$classes[] = sprintf('has-iw-%s-color', $color_field);
	}

	if ($color_field && strpos($color_field, '#') === 0) {
		$classes[] = sprintf('has-custom-color', $color_field);
		$inline_styles[] = sprintf('color: %s;', $color_field);
	}

	if ($background_field && strpos($background_field, '#') === false) {
		$classes[] = sprintf('has-iw-%s-background-color', $background_field);
	}

	if ($background_field && strpos($background_field, '#') === 0) {
		$classes[] = sprintf('has-custom-background-color', $background_field);
		$inline_styles[] = sprintf('background-color: %s; border-color: %s;', $background_field, $background_field);
	}

	return [$classes, $inline_styles];
}

function iw23_multiline_text_to_tspans($original_text)
{

	if (!strstr($original_text, PHP_EOL)) return $original_text;

	$text_string = '';

	foreach (explode(PHP_EOL, $original_text) as $key => $line) {

		$dy = $key ? '1em' : '-%sem';

		$text_string .= sprintf('<tspan x="0" dy="%s">%s</tspan>', $dy, $line);
	}

	$text_string = sprintf($text_string, (count(explode(PHP_EOL, $original_text)) - 1) * 0.5);

	return $text_string;
}

function iw23_convert_hex_to_rgb_color_array($hex)
{
	return sscanf($hex, "#%02x%02x%02x");
}

function iw23_hex_to_rgba($hex, $alpha = 1)
{

	$rgb_array = iw23_convert_hex_to_rgb_color_array($hex);

	return sprintf('rgba(%d,%d,%d,%.2f)', $rgb_array[0], $rgb_array[1], $rgb_array[2], $alpha);
}

/**
 * 
 */
function iw23_create_gradient_string($color_stops)
{

	$color_stops = array_map(function ($value) {

		return array_merge($value, array(
			'string' => sprintf('%s %d%%', $value['color'], $value['position'])
		));
	}, $color_stops);

	return sprintf('linear-gradient(to bottom, %s);', implode(', ', array_column($color_stops, 'string')));
}

/**
 * 
 */
function iw23_block_color_class($block)
{

	if (!empty($block['backgroundColor'])) {
		return sprintf('has-%s-background-color', $block['backgroundColor']);
	}

	if (!empty($block['gradient'])) {
		return sprintf('has-%s-gradient-background', $block['gradient']);
	}

	return 'no-background';
}

/**
 * 
 */
function iw23_block_styles($block)
{

	$classes = [];

	if (!empty($block['backgroundColor'])) {
		$classes[] = sprintf('has-%s-background-color', $block['backgroundColor']);
	}

	if (!empty($block['textColor'])) {
		$classes[] = sprintf('has-%s-color', $block['textColor']);
	}

	if (!empty($block['gradient'])) {
		$classes[] = sprintf('has-%s-gradient-background', $block['gradient']);
	}

	$inline_styles = [];

	if (!empty($block['style'])) {

		foreach ($block['style']['color'] as $key => $value) {

			$attribute = in_array($key, array('background', 'gradient')) ? 'background' : 'color';

			$inline_styles[] = sprintf('%s: %s;', $attribute, $value);
		}
	}


	return [$classes, $inline_styles];
}

/**
 * 
 */
function iw23_get_amp_polyline_points($base64_encoded_results)
{

	try {

		$results = array_map(function ($v) {
			return implode(' ', iw23_convert_scores_to_coordinates($v, 25));
		}, json_decode(
			base64_decode($base64_encoded_results),
			true
		));

		return $results;
	} catch (Exception $e) {
		return false;
	}
}

/**
 * 
 */
function iw23_convert_scores_to_coordinates($scores, $offset)
{

	$points = array_map(function ($k, $v) use ($offset) {

		$coordinate_string = '%s,%s';

		switch ($k) {
			case 0:
				return sprintf(
					$coordinate_string,
					$offset,
					-$v + $offset
				);
			case 1:
				return sprintf(
					$coordinate_string,
					sqrt($v * $v / 2) + $offset,
					-sqrt($v * $v / 2) + $offset
				);
			case 2:
				return sprintf(
					$coordinate_string,
					$v + $offset,
					$offset
				);
			case 3:
				return sprintf(
					$coordinate_string,
					sqrt($v * $v / 2) + $offset,
					sqrt($v * $v / 2) + $offset
				);
			case 4:
				return sprintf(
					$coordinate_string,
					$offset,
					$v + $offset
				);
			case 5:
				return sprintf(
					$coordinate_string,
					-sqrt($v * $v / 2) + $offset,
					sqrt($v * $v / 2) + $offset
				);
			case 6:
				return sprintf(
					$coordinate_string,
					-$v + $offset,
					$offset
				);
			case 7:
				return sprintf(
					$coordinate_string,
					-sqrt($v * $v / 2) + $offset,
					-sqrt($v * $v / 2) + $offset
				);
		}
	}, array_keys($scores), $scores);

	$points[8] = $points[0];

	return $points;
}

/**
 * 
 */
function iw23_get_amp_circle_elements($polyline_points)
{

	$points = explode(' ', $polyline_points);

	$elements = '';

	foreach ($points as $point) {
		[$x, $y] = explode(',', $point);

		$elements .= sprintf('<circle cx="%s" cy="%s" r="0.75"></circle>', $x, $y);
	}

	return $elements;
}

/**
 * 
 */
add_filter('cli_show_cookie_bar_only_on_selected_pages', 'webtoffee_custom_selected_pages', 10, 2);

function webtoffee_custom_selected_pages($html, $slug)
{

	$slug_array = array('businessamp-results', 'amp-e', 'cisco-flm');
	if (in_array($slug, $slug_array)) {
		$html = '';
		return $html;
	}

	// For wild card URL entry
	foreach ($slug_array as $slug_ar) {
		if (strpos($slug_ar, '*') !== false) {

			if (fnmatch($slug_ar, $slug)) {
				$html = '';
				return $html;
			}
		}
	}

	return $html;
}

/**
 * 
 */
function iw23_array_key_exists($key, $array)
{
	if (!is_array($array)) {
		return false;
	}

	if (!array_key_exists($key, $array)) {
		return false;
	}

	return true;
}

/**
 * 
 */
function iw23_encrypt($message_to_encrypt, $secret_key, $method = 'aes128')
{

	$nonce_size = openssl_cipher_iv_length($method);

	$nonce = openssl_random_pseudo_bytes($nonce_size);

	$encrypted_message = openssl_encrypt($message_to_encrypt, $method, $secret_key, OPENSSL_RAW_DATA, $nonce);

	return base64_encode($nonce . $encrypted_message);
}

/**
 * 
 */
function iw23_decrypt($encrypted_data, $secret_key, $method = 'aes128')
{

	$encrypted_data = base64_decode($encrypted_data, true);

	$nonce_size = openssl_cipher_iv_length($method);

	$nonce = mb_substr($encrypted_data, 0, $nonce_size, '8bit');

	$message_to_decrypt = mb_substr($encrypted_data, $nonce_size, null, '8bit');

	return openssl_decrypt($message_to_decrypt, $method, $secret_key, OPENSSL_RAW_DATA, $nonce);
}

/**
 * 
 */
function iw23_dump($variable)
{
	echo '<pre>', print_r($variable, true), '</pre>';
}

/**
 * 
 */
function iw23_dump_and_die($variable)
{
	iw_dump($variable);
	die();
}

/**
 * 
 */
function iw23_get_template_part($slug, $name = null, $args = array(), $echo = true)
{

	if ($echo) {
		return get_template_part($slug, $name, $args);
	}

	/**
	 * Output get_template_part to buffer
	 */
	ob_start();

	get_template_part($slug, $name, $args);

	$template_part = ob_get_contents();

	ob_end_clean();

	return $template_part;
}
