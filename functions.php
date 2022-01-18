<?php
/**
 * flashcard functions and definitions
 *
 * @package flashcard
 */
 
 /**
  * Store the theme's directory path and uri in constants
  */
 define('THEME_DIR_PATH', get_template_directory());
 define('THEME_DIR_URI', get_template_directory_uri());

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'flashcard_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function flashcard_setup() {
	global $cap, $content_width;

	// Add html5 behavior for some theme elements
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	*/
	// add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	*/
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on flashcard, use a find and replace
	 * to change 'flashcard' to the name of your theme in all the template files
	*/
	load_theme_textdomain( 'flashcard', THEME_DIR_PATH . '/languages' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	*/
	register_nav_menus( array(
		'primary'  => __( 'Header menu', 'flashcard' ),
	) );

}
endif; // flashcard_setup
add_action( 'after_setup_theme', 'flashcard_setup' );

/**
 * Enqueue scripts and styles
 */
function flashcard_script() {
	wp_enqueue_style( 'flash-card',  get_template_directory_uri() . '/src/dist/flash-card/styles.ef46db3751d8e999.css', false, false);
	wp_enqueue_script( 'runtime',  get_template_directory_uri() . '/src/dist/flash-card/runtime.a0681e1ecc0226b1.js', [], false, true);
	wp_enqueue_script( 'polyfills',  get_template_directory_uri() . '/src/dist/flash-card/polyfills.0b37ef0ca7a56e77.js', [], false, true);
	wp_enqueue_script( 'main',  get_template_directory_uri() . '/src/dist/flash-card/main.82440271c8253f72.js', [], false, true);
}
add_action( 'wp_enqueue_scripts', 'flashcard_script' );

/**
 * Customizer additions.
 */
require THEME_DIR_PATH . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require THEME_DIR_PATH . '/includes/jetpack.php';

/**
 * Adds WooCommerce support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
