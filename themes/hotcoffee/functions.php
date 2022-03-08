<?php
/**
 * Fresh Coffee functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fresh_Coffee
 */

if ( ! defined( 'HOTCOFFEE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'HOTCOFFEE_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hotcoffee_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Fresh Coffee, use a find and replace
		* to change 'hotcoffee' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'hotcoffee', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-primary' => esc_html__( 'Primary', 'hotcoffee' ),
			'menu-shop' => esc_html__( 'Shop', 'hotcoffee' ),
			'menu-search' => esc_html__( 'Search', 'hotcoffee' ),
			'menu-secondary' => esc_html__( 'Secondary', 'hotcoffee' ),
			'menu-social' => esc_html__( 'Social', 'hotcoffee' ),
			'menu-footer1' => esc_html__( 'Footer1', 'hotcoffee' ),
			'menu-footer2' => esc_html__( 'Footer2', 'hotcoffee' ),
			'menu-footer3' => esc_html__( 'Footer3', 'hotcoffee' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			'unlink-homepage-logo' => false,
		)
	);
}
add_action( 'after_setup_theme', 'hotcoffee_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hotcoffee_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hotcoffee_content_width', 640 );
}
add_action( 'after_setup_theme', 'hotcoffee_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hotcoffee_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hotcoffee' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hotcoffee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hotcoffee_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hotcoffee_scripts() {
	wp_enqueue_style(
		 'hotcoffee-style', 
		get_stylesheet_uri(),
		array(), 
		HOTCOFFEE_VERSION 
	);

	wp_enqueue_style( 
		'foundation-style', 
		get_template_directory_uri() . '/assets/css/vendor/foundation.min.css',
		array(), 
		'6.7.4'
	);

	//enqueue woocommerce style
	wp_enqueue_style( 
		'woocommerce-style', 
		get_template_directory_uri() . '/assets/css/woocommerce.css',
	);


	wp_enqueue_script( 
		'what-input-script', 
		get_template_directory_uri() . '/assets/js/vendor/what-input.js',
		array('jquery'), 
		'5.2.10',
		true
	);

	wp_enqueue_script( 
		'foundation-script', 
		get_template_directory_uri() . '/assets/js/vendor/foundation.min.js',
		array('jquery'), 
		'6.7.4',
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hotcoffee_scripts' );

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
 * Block editor additions.
 */
require get_template_directory() . '/inc/block-editor.php';

/**
 * Woocommerce additions.
 */
require get_template_directory() . '/inc/woocommerce.php';



