<?php
/**
 * Default Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Default Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function default_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Default Theme, use a find and replace
		* to change 'default-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'default-theme', get_template_directory() . '/languages' );

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
			'main-menu' => esc_html__( 'Main Menu', 'default-theme' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'default-theme' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'default_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
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
		)
	);
}
add_action( 'after_setup_theme', 'default_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function default_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'default_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'default_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function default_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'default-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'default-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar Book', 'default-theme' ),
			'id'            => 'sidebar-book',
			'description'   => esc_html__( 'Add widgets here.', 'default-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'default_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function theme_scripts() {
	wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'theme-main-style', get_stylesheet_directory_uri() . '/assets/css/main.min.css', array(), _S_VERSION );
	wp_style_add_data( 'theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'theme-main-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), _S_VERSION, true );

	wp_localize_script( 
		'theme-main-scripts', 
		'my_ajax_object', 
		array( 
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('ajax-nonce') 
		) 
	);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

if (is_admin()) {
	wp_enqueue_style( 'theme-acf-style', get_stylesheet_directory_uri() . '/assets/css/editor-acf.css', array(), _S_VERSION );
}

/**
 * Implement the Custom Post Type.
 */
require get_template_directory() . '/inc/custom-post-type.php';

/**
 * Implement the Custom Shortcodes.
 */
require get_template_directory() . '/inc/custom-shortcodes.php';

/**
 * Implement the Custom Widgets.
 */
require get_template_directory() . '/inc/custom-widgets.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'Global Content',
		'menu_slug' => 'footer-content',
		'position' => '21',
		'icon_url' => 'dashicons-layout',
	));
  }


  
// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );





function load_custom_wp_admin_style(){
    wp_register_style( 'custom_wp_admin_css', get_bloginfo('stylesheet_directory') . '/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

//exclide node_modules and git folders from ain1wm
 
add_filter( 'ai1wm_exclude_themes_from_export', function ( $exclude_filters ) {
	$exclude_filters[] = 'default-theme/node_modules';
	$exclude_filters[] = 'default-theme/.git'; 
	return $exclude_filters;
} );

function books_rating_ajax() {
	$post_id = $_POST['post_id'];
	$rating = $_POST['rating'];

	update_post_meta($post_id, 'rating', $rating);

	wp_send_json($rating);
}
add_action('wp_ajax_books_rating_ajax', 'books_rating_ajax');

function display_rating($post_id) {
    
    $rating = get_post_meta($post_id, 'rating', true);
    if (!$rating) {
        $rating = 0; 
		update_post_meta( $post_id, 'rating', $rating );
    }

    echo '<div class="post-rating"><h5>Book Rating</h5>'.
		'<button class="rate-plus"></button>'.
		'<div id="rate-'.$post_id.'" class="rate-number">'.$rating.'</div>'.
		'<button class="rate-minus"></button>'.
	'</div>';
}