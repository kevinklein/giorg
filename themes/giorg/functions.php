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

		function custom_excerpt_length( $length ) {
			return 30;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

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

		//ancillary nav in header
		register_nav_menus( array(
			'menu-4' => esc_html__( 'Patients', 'giorg' ),
		) );

		//ancillary nav in header
		register_nav_menus( array(
			'menu-5' => esc_html__( 'Blog Categories', 'giorg' ),
		) );

		//custom walker to allow passing of class to li in menus
		class Categories_Walker extends Walker_Nav_Menu
		{
			/**
			 * Start the element output.
			 *
			 * @param  string $output Passed by reference. Used to append additional content.
			 * @param  object $item   Menu item data object.
			 * @param  int $depth     Depth of menu item. May be used for padding.
			 * @param  array|object $args    Additional strings. Actually always an 
											 instance of stdClass. But this is WordPress.
			* @return void
			*/
			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
			{
				$classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

				$class_names = join(
					' '
				,   apply_filters(
						'nav_menu_css_class'
					,   array_filter( $classes ), $item
					)
				);

				! empty ( $class_names )
					and $class_names = ' class="'. esc_attr( $class_names ) . '"';
				
				// no <li></li>
				$output .= "";

				$attributes  = '';

				! empty( $item->attr_title )
					and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
				! empty( $item->target )
					and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
				! empty( $item->xfn )
					and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
				! empty( $item->url )
					and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

				// insert description for top level elements only
				// you may change this
				$description = ( ! empty ( $item->description ) and 0 == $depth )
					? '<small class="nav_desc">' . esc_attr( $item->description ) . '</small>' : '';

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				$item_output = $args->before
					. "<a class='list-group-item text-500 text-normal' $attributes>"
					. $args->link_before
					. $title
					. '</a> '
					. $args->link_after
					. $description
					. $args->after;

				// Since $output is called by reference we don't need to return anything.
				$output .= apply_filters(
					'walker_nav_menu_start_el'
				,   $item_output
				,   $item
				,   $depth
				,   $args
				);
			}
		
		}

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

		add_editor_style('editor-style.css');

		// Update CSS within in Admin
		function admin_style() {
			wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
		}
		add_action('admin_enqueue_scripts', 'admin_style');

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
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar Widgets', 'giorg' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Blog Sidebar Widgets', 'giorg' ),
		'before_widget' => '<div class="list-group m-b-md">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="list-group-item"><h3 class="text-uc text-gray-dark m-b-0">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'giorg_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function giorg_scripts() {
	wp_enqueue_style( 'giorg-style', get_stylesheet_uri() );

	wp_enqueue_script( 'giorg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'giorg-scrollreveal', 'https://unpkg.com/scrollreveal/dist/scrollreveal.min.js', null, null, true  );

	//wp_enqueue_script( 'giorg-scrollreveal', 'https://unpkg.com/scrollreveal/dist/scrollreveal.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-jqueryui', get_template_directory_uri() . '/js/jquery-ui.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-tether', get_template_directory_uri() . '/js/tether.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-gsap', get_template_directory_uri() . '/js/gsap.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-gsap-tween', get_template_directory_uri() . '/js/gsap/TweenLite.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-scrollmagic', get_template_directory_uri() . '/js/scrollmagic/ScrollMagic.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-scrollmagic-anim', get_template_directory_uri() . '/js/scrollmagic/ScrollMagic.animation.gsap.min.js', null, null, true  );

	wp_enqueue_script( 'giorg-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20180915', true );

	if ( is_singular( 'topics' ) || is_page( 'patients') ) {
        wp_enqueue_script('giorg-slider', get_template_directory_uri() . '/js/cycle.js', null, null, true );
    }

	if ( is_page( 'guidelines' ) ) {
        wp_enqueue_script('giorg-isotope', get_template_directory_uri() . '/js/isotope.min.js', null, null, true );
    }

	if ( is_page( 'history' ) ) {
        wp_enqueue_script('giorg-timeline', get_template_directory_uri() . '/js/jquery.timelinr.js', null, null, true );
    }

	if ( is_singular( 'guideline' ) ) {
        wp_enqueue_script('giorg-toc', get_template_directory_uri() . '/js/toc.min.js', null, null, true );
    }

	if ( is_front_page() || is_home() ) {
		wp_enqueue_style('giorg-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css' );
        wp_enqueue_script('giorg-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js', null, null, true );
    }

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
 * Patients (aka Patients > GI Health Centers) Functions
 */
require get_template_directory() . '/inc/patients-functions.php';

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

// for seeing if a post is any number of blog content pages
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}