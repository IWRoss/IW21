<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function iw23_posted_on()
{
	$image = get_field('author_image', 'user_' . get_the_author_meta('ID'));

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if (get_the_time('U') !== get_the_modified_time('U')) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date('c')),
		esc_html(get_the_date()),
		esc_attr(get_the_modified_date('c')),
		esc_html(get_the_modified_date())
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x('Posted on %s', 'post date', 'iw21'),
		'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x('%s %s', 'post author', 'iw21'),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>',
		'<span class="author-role">' . esc_html(get_field('role', 'user_' . get_the_author_meta('ID'))) . '</span>'
	);

	echo '<img src="' . $image . '" class="author-image" /><span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

/**
 * Prints HTML with meta information for the current author.
 */
function iw23_posted_by()
{

	$image = get_field('author_image', 'user_' . get_the_author_meta('ID'));

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x('%s %s', 'post author', 'iw21'),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>',
		'<span class="author-role">' . esc_html(get_field('role', 'user_' . get_the_author_meta('ID'))) . '</span>'
	);

	echo '<img src="' . $image . '" class="author-image" /><span class="byline">' . $byline . '</span>';
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function iw23_entry_footer()
{
	// Hide category and tag text for pages.
	if ('post' === get_post_type()) {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list(esc_html__(', ', 'iw21'));
		if ($categories_list) {
			/* translators: 1: list of categories. */
			printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'iw21') . '</span>', $categories_list); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list('', esc_html_x('', 'list item separator', 'iw21'));
		if ($tags_list) {
			/* translators: 1: list of tags. */
			printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'iw21') . '</span>', $tags_list); // WPCS: XSS OK.
		}
	}

	if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'iw21'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}
}

/**
 * Get the post company and return;
 */
function iw23_post_company()
{

	global $post;

	if ($company = get_field('company')) {
		return '<span class="post-company">'  . $company . '</span>';
	}

	return false;
}

function iw23_media_tag($media, $class = 'iw21-mixed-media', $style = '', $size = 'full', $lazy = false)
{
	if (!is_array($media) || !array_key_exists('type', $media)) {
		return;
	}

	switch ($media['type']):
		case 'image':

			$media = wp_get_attachment_image_src($media['id'], $size);

			$element = sprintf('<img src="%s" class="%s" style="%s" %s/>', $media[0], $class, $style, $lazy ? 'loading="lazy"' : '');
			break;
		case 'video':
			$element = sprintf('<video playsinline autoplay muted loop class="%s" style="%s"><source src="%s" type="video/mp4"></video>', $class, $style, $media['url']);
			break;
		default:
			$element = '';
			break;
	endswitch;

	echo $element;
}

function iw23_link_tag($link_meta, $classes = [], $inline_styles = [], $modal = false)
{

	if (!is_array($link_meta) || !array_key_exists('url', $link_meta)) {
		return;
	}

	if (!$modal) {
		vprintf(
			'<a href="%1$s" target="%5$s" class="%2$s" style="%3$s">%4$s</a>',
			array(
				$link_meta['url'],
				implode(' ', $classes),
				implode(' ', $inline_styles),
				$link_meta['title'],
				$link_meta['target']
			)
		);

		return;
	}

	vprintf(
		'<a href="#" rel="%1$s" data-iw-modal="open" class="%2$s" style="%3$s">%4$s</a>',
		array(
			str_replace('#', '', $link_meta['url']),
			implode(' ', $classes),
			implode(' ', $inline_styles),
			$link_meta['title']
		)
	);

	return;
}

/**
 * 
 */
function iw23_back_button()
{
	$http_referer = $_SERVER['HTTP_REFERER'] ?? '';

	if (strpos($http_referer, $_SERVER['HTTP_HOST']) === false) {
		return false;
	}

	printf('<div class="page-nav"><a href="%s" class="back-button">%s</a></div>', $http_referer, __('Go Back', 'iw21'));
}
