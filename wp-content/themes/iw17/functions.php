<?php
/**
 * Interactive Workshops 2017 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Interactive_Workshops_2017
 */

if ( ! function_exists( 'iw17_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function iw17_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Interactive Workshops 2017, use a find and replace
	 * to change 'iw17' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'iw17', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'iw17' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add image sizes.
	add_image_size( 'iw17-feed', 614, 614 );
}
endif;
add_action( 'after_setup_theme', 'iw17_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function iw17_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'iw17_content_width', 640 );
}
add_action( 'after_setup_theme', 'iw17_content_width', 0 );

//Modern Jquery


/**
 * Enqueue scripts and styles.
 */
function iw17_scripts() {

	global $post;
	global $wp_query;

	wp_enqueue_style( 'iw17-style', get_stylesheet_uri(), false, filemtime( get_stylesheet_directory() . '/style.css' ) );

	// wp_enqueue_script( 'iw17-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-lity', get_template_directory_uri() . '/js/lity.min.js', array( 'jquery' ), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-dynamo', get_template_directory_uri() . '/js/dynamo.min.js', array( 'jquery' ), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-textfit', get_template_directory_uri() . '/js/textfit.min.js', array( 'jquery' ), '20151215', true );
	//
	// wp_enqueue_script( 'iw17-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'iw17-scripts', get_template_directory_uri() . '/js/scripts.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/js/scripts.min.js' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'clients' ) ) || is_front_page() ) {
		wp_enqueue_script( 'iw17-slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js' );
	}

	if ( is_page_template( 'page-templates/page-feed.php' ) || is_archive() ) {
		wp_enqueue_script('iw17-infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/infinite-scroll.js'), true);
	}

	if ( is_page_template( 'page-templates/page-feed.php' ) ) {
		wp_localize_script('iw17-infinite-scroll', 'iw17Scroll', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'id'	  => $post->ID,
			'options' => iw17_get_query_options(),
			'ppp'	  => get_option('posts_per_page')
		));
	}

	if ( is_archive() ) {
		wp_localize_script('iw17-infinite-scroll', 'iw17Scroll', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'id'	  => $post->ID,
			'options' => $wp_query->query,
			'ppp'	  => get_option('posts_per_page')
		));
	}
}
add_action( 'wp_enqueue_scripts', 'iw17_scripts' );


function iw17_admin_scripts( $hook ) {
	if( 'index.php' != $hook ) {
		// Only applies to dashboard panel
		return;
	}

	wp_enqueue_script( 'iw17-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), '20151215', true );

	wp_localize_script( 'iw17-admin', 'ajaxsort', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'	  => wp_create_nonce( 'shuffle' )
	) );
}
add_action( 'admin_enqueue_scripts', 'iw17_admin_scripts' );


function iw17_load_external_scripts() {
	echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">';
	echo '<script>var templateDir = "', get_bloginfo( 'template_url' ), '";</script>';
	echo '<style> .preloader { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 1000; background-color: #ff8d00; } </style>';
}
add_action( 'wp_head', 'iw17_load_external_scripts' );

function iw17_load_analytics() {
	echo "<!-- Google Tag Manager --><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-58SSSX4');</script> <!-- End Google Tag Manager -->";
}
// add_action( 'wp_head', 'iw17_load_analytics' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Remove comments.
 */
// require get_template_directory() . '/inc/no-comments.php';

/**
* Load Advanced Custom Fields functions file.
 */
require get_template_directory() . '/inc/advanced-custom-fields.php';

/**
* Load Help file.
 */
require get_template_directory() . '/inc/help.php';

/**
* Load Help file.
 */
require get_template_directory() . '/inc/work.php';

/**
* Load Infinite Scroll file.
 */
require get_template_directory() . '/inc/infinite-scroll.php';

/**
* Load Shortcodes file.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
* Load Utility file.
 */
require get_template_directory() . '/inc/utility.php';

/**
* Load SEO file.
 */
require get_template_directory() . '/inc/seo.php';

/**
* Load Mailchimp file.
 */
require get_template_directory() . '/inc/mailchimp.php';

/**
* Load Schindler file.
 */
require get_template_directory() . '/inc/schindler.php';

/**
* Load Landing Pages file.
 */
require get_template_directory() . '/inc/landing-pages.php';

/**
* Load Custom Blocks file.
 */
require get_template_directory() . '/inc/blocks.php';
