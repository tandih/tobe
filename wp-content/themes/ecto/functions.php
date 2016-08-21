<?php
/**
 * Ecto functions and definitions
 *
 * @package Ecto
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 702; /* pixels */
}

if ( ! function_exists( 'ecto_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ecto_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Ecto, use a find and replace
	 * to change 'ecto' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ecto', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'ecto-banner', 1440, 600, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ecto' ),
		'social' => __( 'Social Menu', 'ecto' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ecto_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // ecto_setup
add_action( 'after_setup_theme', 'ecto_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ecto_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ecto' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ecto_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ecto_scripts() {

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons/genericons.css', array(), '3.3' );

	wp_enqueue_style( 'ecto-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ecto-js', get_template_directory_uri() . '/js/ecto.js', array( 'jquery' ), '20150113', true );

	wp_enqueue_script( 'ecto-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'ecto-opensans-merriweather', ecto_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'ecto_scripts' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Ecto 1.0
 */
function ecto_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'ecto_javascript_detection', 0 );


/**
 * Register Google Fonts
 */
function ecto_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$opensans = _x( 'on', 'Open Sans font: on or off', 'ecto' );

	/* Translators: If there are characters in your language that are not
	 * supported by Merriweather, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$merriweather = _x( 'on', 'Merriweather font: on or off', 'ecto' );

	if ( 'off' !== $merriweather || 'off' !== $opensans ) {
		$font_families = array();

		if ( 'off' !== $opensans ) {

			$font_families[] = 'Open Sans:400,700,700italic,400italic';

		}

		if ( 'off' !== $merriweather ) {

			$font_families[] = 'Merriweather:300,700,700italic,300italic';

		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );

}

/**
 * Enqueue Google Fonts for Editor Styles
 */
function ecto_editor_styles() {
	add_editor_style( array( 'editor-style.css', ecto_fonts_url() ) );
}
add_action( 'after_setup_theme', 'ecto_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
