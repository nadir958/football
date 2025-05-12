<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

if ( ! function_exists( 'khelo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ 

function khelo_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on khelo, use a find and replace
	 * to change 'khelo' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'khelo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	function khelo_change_excerpt( $text )
	{
		$pos = strrpos( $text, '[');
		if ($pos === false)
		{
			return $text;
		}
		
		return rtrim (substr($text, 0, $pos) ) . '...';
	}
	add_filter('get_the_excerpt', 'khelo_change_excerpt');

	// Limit Excerpt Length by number of Words
	function khelo_custom_excerpt( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
	}
	
	function khelo_content( $limit ) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
		} else {
		$content = implode(" ",$content);
		}
		$content = preg_replace('/[.+]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'khelo' ),
		'menu-2' => esc_html__( 'Footer Menu', 'khelo' ),
		'menu-3' => esc_html__( 'Single Template Menu', 'khelo' ),
		'menu-4' => esc_html__( 'Left Menu', 'khelo' ),
		'menu-5' => esc_html__( 'Right Menu', 'khelo' ),
		
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'khelo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	//add support posts format
	add_theme_support( 'post-formats', array( 
		'aside', 
		'gallery',
		'audio',
		'video',
		'image',
		'quote',
		'link',
	) );	
	}
endif;

add_action( 'after_setup_theme', 'khelo_setup' );

/**
*Custom Image Size
*/
add_image_size( 'khelo_blog_extra_large', 1212, 600, true );
add_image_size( 'khelo_portfolio-slider', 350, 452, true );
add_image_size( 'khelo_blog_sm_grid', 600, 775, true );
add_image_size( 'khelo_blog_filter_grid', 600, 625, true );
add_image_size( 'khelo_blog_slider', 450, 325, true );
add_image_size( 'khelo_khelo_tainers_images', 385, 475, true );
add_image_size( 'khelo_top_player', 400, 500, true );
add_image_size( 'khelo_latest_blog_small',  255, 157, true );
add_image_size( 'khelo_latest_blog_big',  523, 278, true );
add_image_size( 'khelo_blog_grid_sm',  700, 475, true );
add_image_size( 'khelo_latest_xl_blog',  1000, 690, true );
add_image_size( 'khelo_blog_grid_small',  170, 120, true );
add_image_size( 'khelo_blog_grid_small_right',  165, 180, true );
add_image_size( 'khelo_blog-footer',80, 60, true );
add_image_size( 'khelo_latest_featured_blog_3column',  980, 500, true );
add_image_size( 'khelo_latest_featured_blog_thumb',  500, 300, true );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function khelo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'khelo_content_width', 640 );
}
add_action( 'after_setup_theme', 'khelo_content_width', 0 );

if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url("themes.php?page=khelo"));
}
if (is_admin()) {	
	require_once get_template_directory() . '/framework/ini/theme-base.php';	
}


$licenseKey = get_option("KheloWordPressTheme_lic_Key","");
if (class_exists( 'ReduxFramework') && !empty($licenseKey)){
	require_once get_template_directory() . '/framework/custom.php';
	require_once get_template_directory() . '/libs/theme-option/config.php';
}

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/template-scripts.php';

/**
 * woocommerce customize
 */
require_once get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';



//----------------------------------------------------------------------
// Remove Redux Framework NewsFlash
//----------------------------------------------------------------------
if ( ! class_exists( 'reduxNewsflash' ) ):
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
endif;

function khelo_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'khelo_removeDemoModeLink');


/**
 * Registers an editor stylesheet for the theme.
 */
function khelo_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'khelo_theme_add_editor_styles' );

//remove revolution slid metabox

function khelo_remove_revolution_slider_meta_boxes() {	
	remove_meta_box( 'mymetabox_revslider_0', 'client', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'club', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'players', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'fixture-results', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'point-table', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'gallery', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'cl_countdown', 'normal' );
	remove_meta_box( 'mymetabox_revslider_0', 'club_news', 'normal' );
}

add_action( 'do_meta_boxes', 'khelo_remove_revolution_slider_meta_boxes' );

//timetable action

//------------------------------------------------------------------------
//Organize Comments form field
//-----------------------------------------------------------------------
function khelo_wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'khelo_wpb_move_comment_field_to_bottom' );	