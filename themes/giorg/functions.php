<?php
/**
 * giorg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package giorg
 */

if ( ! function_exists( 'giorg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function giorg_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on giorg, use a find and replace
		 * to change 'giorg' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'giorg', get_template_directory() . '/languages' );

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

		// Register all the navs

		//main nav
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'giorg' ),
		) );

		//ancillary nav in header
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Ancillary Header', 'giorg' ),
		) );

		//ancillary nav in header
		register_nav_menus( array(
			'menu-3' => esc_html__( 'Top', 'giorg' ),
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

	}
endif;
add_action( 'after_setup_theme', 'giorg_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function giorg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer/Overlay Menu Column 1', 'giorg' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'First footer column', 'giorg' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer/Overlay Menu Column 2', 'giorg' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Second footer column', 'giorg' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer/Overlay Menu Column 3', 'giorg' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Third footer column', 'giorg' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'giorg' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Fourth footer column', 'giorg' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 5', 'giorg' ),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Fifth footer column', 'giorg' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'giorg_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function giorg_scripts() {
	wp_enqueue_style( 'giorg-style', get_stylesheet_uri() );

	wp_enqueue_script( 'giorg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'giorg-scrollreveal', 'https://unpkg.com/scrollreveal/dist/scrollreveal.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-tether', get_template_directory_uri() . '/js/tether.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-gsap', get_template_directory_uri() . '/js/gsap.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-gsap-tween', get_template_directory_uri() . '/js/gsap/TweenLite.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-scrollmagic', get_template_directory_uri() . '/js/scrollmagic/ScrollMagic.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-scrollmagic-anim', get_template_directory_uri() . '/js/scrollmagic/ScrollMagic.animation.gsap.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20180915', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'giorg_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

include_once('inc/acf-smart-button/acf-smart-button.php');

/**
 * Remove auto insertion of <p> <br> tags in RTEs
 */
function acf_wysiwyg_remove_wpautop() {
    remove_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'acf_wysiwyg_remove_wpautop', 15);