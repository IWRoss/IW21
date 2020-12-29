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
function iw21_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'iw21_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function iw21_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'iw21_pingback_header' );

/**
 * Change length of excerpt to 30
 */
function iw21_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'iw21_excerpt_length', 999 );


/**
 * Limit max menu depth in admin panel to 2
 */
function iw21_limit_depth( $hook ) {
  if ( $hook != 'nav-menus.php' ) return;

  // override default value right after 'nav-menu' JS
  wp_add_inline_script( 'nav-menu', 'wpNavMenu.options.globalMaxDepth = 0;', 'after' );
}
// add_action( 'admin_enqueue_scripts', 'iw21_limit_depth' );

/**
 * Change document title separator
 */
add_filter( 'document_title_separator', function( $sep ) {
    return "//";
} );

/**
 * Alter title part of document title to add company in certain instances
 */
add_filter( 'document_title_parts', function( $title ) {

	global $post;

	if ( get_post_type() === 'work' && $company = get_field( 'company' ) ) {
		$title['title'] = $company . ' // ' . $title['title'];
	}

    return $title;
} );

/**
 * Return a permalink to a random post in the portfolio category
 */
function iw21_random_post() {

	global $post;

	$args = array(
		'post_type' 	 => 'post',
		'orderby' 		 => 'rand',
		'posts_per_page' => 1,
		'post__not_in' 	 => array( get_the_ID() ),
		'category_name'	 => 'portfolio'
	);

	$random_query = new WP_Query( $args );

	while ( $random_query->have_posts() ) : $random_query->the_post();
		$permalink = get_permalink();
	endwhile;

	wp_reset_postdata();

	return $permalink;
}

/**
 * Return true if post/page meets conditions
 */
function iw21_is_cta_post() {

	global $post;

	// Override
	return false;

	if ( is_page_template( 'page-templates/single-event.php' ) ) :
		return false;
	endif;

	if ( is_page_template( 'page-templates/page-feed.php' ) ) :
		return false;
	endif;

	if ( is_front_page() ) :
		return false;
	endif;

	if ( is_page( 'contact' ) ) :
		return false;
	endif;

	return true;
}

/**
 * Turn string with line breaks into options dynamo.min.js can use
 */
function iw21_render_dynamic_text_array( $string, $target ) {

	$string_parts = explode( PHP_EOL, $string );

	$result = array();

	foreach ( $string_parts as $key => $part ) {

		$part = preg_split('/(?<!\w)' . $target . '/', $part );

		$result[0][$key] = substr( $part[0], 1 );

		$result[1][$key] = $part[1];
	}

	return $result;
}

/**
 * Render html element for the parallax background
 */
function iw21_parallax_background( $type = 'squares', $full = true ) {

	$classes = array(
		'background',
		'parallax',
		$type
	);

	if ( $full ) :
		$classes[] = 'full-height';
	endif;

	echo '<div class="', implode( ' ', $classes ), '"></div>';
}

/**
 * Retrieve array of post classes
 */
function iw21_get_the_post_classes() {
	global $post;

	$classes = [];

	// Post thumbnail class
	if ( has_post_thumbnail() ) :
	    $classes[] = 'has-thumbnail';
	endif;

	// if ( $user_author_image ) :
	//     $classes[] = 'has-author-image';
	// endif;

	// Category class
	$categories = get_the_category();

	foreach ( $categories as $category ) :
	    $classes[] = 'category-' . $category->slug;
	endforeach;

	// Industry class
	$industries = get_the_terms( $post->post_id, 'industry' );

	if ( $industries ) :
		foreach ( $industries as $industry ) :
			$classes[] = 'industry-' . $industry->slug;
		endforeach;
	endif;

	if ( $template = get_page_template_slug() ) :
		$classes[] = 'feed-' . wp_basename( $template, '.php' );

		if ( $template !== 'work-quote' && $template !== 'single-thought' ) :
			$classes[] = 'shadow-effect';
		endif;
	else :
		$classes[] = 'feed-standard';
	endif;

	$classes[] = 'post-type-' . get_post_type();

	if ( $span = get_field( 'span' ) ) :
	    $classes[] = 'grid-item--width' . $span;
	endif;

	$classes[] = 'fade';

	return $classes;
}

/**
 * Turn array of post classes into string
 */
function iw21_get_the_post_classes_string() {
	return implode( ' ', iw21_get_the_post_classes() );
}

function iw21_get_the_title() {
	global $post;

	$title = get_the_title();


	if ( $company = get_field( 'company' ) ) {
		$title = '<span class="post-company">' . $company . ' //</span> ' . $title;
	} else if ( $terms = get_the_terms( $post->ID, 'industry' ) ) {
		$title = '<span class="post-company">' . $terms[0]->name . ' //</span> ' . $title;
	}

	return $title;
}

/**
 * Add company title to post name and include class for post length
 */
function iw21_render_post_title( $title = false ) {
	global $post;

	if ( ! $title )
		$title = iw21_get_the_title();

	$longest_word = array_reduce( str_word_count( strip_tags( $title ), 1 ), function( $v, $p ) {
		return strlen($v) > strlen($p) ? $v : $p;
	} );

	if ( strlen( strip_tags( $title ) ) >= 25 || strlen( $longest_word ) >= 12 ) :
		$length = 'long-title';
	else :
		$length = 'short-title';
	endif;

	if ( is_page() ) :
		$type = 'page-title';
	else :
		$type = 'entry-title';
	endif;

	echo sprintf( '<h1 class="%s %s">%s</h1>', $type, $length, $title );
}

/**
 * Get a nice name version of the template
 */
function iw21_template_nice_name( $id = null ) {
	if ( $id ) {
		$template = get_page_template_slug( $id );
	} else {
		$template = get_page_template_slug();
	}

	return preg_replace( '/(single-)|(work-)+/', '', wp_basename( $template, '.php' ) );
}

/**
 * Intepret ACF fields to create query arguments for feed
 */
function iw21_get_query_options( $paged = false ) {
    global $post;

    /* Let's get some posts. */
    $options = array(
        'posts_per_page' => get_option( 'posts_per_page' )
    );

	if ( $paged ) {
		$options['paged'] = $paged;
	}

    /* Get our differentiator */
    $taxonomy = get_field( 'taxonomy' );

    if ( $taxonomy === 'post_type' && $post_type = get_field( 'post_type' ) ) {
        $options['post_type'] = $post_type;
    } else {
        $options['post_type'] = array( 'post', 'work' );

        if ( $taxonomy === 'category' && $categories = get_field( 'category' ) ) {

            /* Easy peasy */
            $options['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $categories
                )
            );

        } else if ( $taxonomy === 'tag' && $tags = get_field( 'tag' ) ) {

            /* Lemon squeezy */
            $options['tax_query'] = array(
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'id',
                    'terms' => $tags
                )
            );

        } else if ( $taxonomy === 'template' && $templates = get_field( 'template') ) {

            /* Macaroni cheesy */
            $options['meta_query'] = array(
                array(
                    'key'   => '_wp_page_template',
                    'value' => $templates
                )
            );
        } else if ( $taxonomy === 'select' && $selected_posts = get_field( 'selected_posts', false, false ) ) {

            /* Using Febrezey */
            $options['post__in'] = $selected_posts;
            $options['orderby'] = 'post__in';
        }
    }

	$options['post_status'] = 'publish';

    return $options;
}


/**
 * Style custom columns
 */
function iw21_localhost_reminder() {
	if ( get_option( 'siteurl' ) === 'http://iw.test' ) {
		echo '<style type="text/css">';
		echo '#wpadminbar { background-color: #0073aa; }';
		echo '#wp-admin-bar-site-name .ab-item:after { content: " (Local)"; }';
		echo '</style>';
	}
}
add_action( 'admin_head', 'iw21_localhost_reminder' );
add_action( 'wp_head', 'iw21_localhost_reminder' );

/**
 * Floating action button
 */
function iw21_floating_action_button( $title ) {
	// Disable
	return;

	// echo '<a href="' . get_permalink( get_page_by_title( $title ) ). '" class="fab"></a>';
	echo '<a href="#" class="fab" data-iw-modal="open" rel="', $title, '"></a>';
}

/**
 * Remove website field from comments
 */
function iw21_disable_comment_url( $fields ) {
    unset( $fields['url'] );
    return $fields;
}
add_filter( 'comment_form_default_fields','iw21_disable_comment_url' );


function iw21_redirect_contact_form( $to, $postdata, $post_id ) {

	if ( in_array( 'Playbook', $postdata['field-id-like-more-information-on']['value'] ) ) {
		return 'jerome@interactiveworkshops.com';
	}
	
	return $to;
}
add_filter( 'coblocks_form_email_to', 'iw21_redirect_contact_form', 10, 3 );


function iw21_custom_disable_author_page() {
    global $wp_query;

    if ( is_author() ) {
        // Redirect to homepage, set status to 301 permenant redirect. 
        // Function defaults to 302 temporary redirect. 
        wp_redirect(get_option('home'), 301); 
        exit; 
    }
}
add_action('template_redirect', 'iw21_custom_disable_author_page');
