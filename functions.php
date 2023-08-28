<?php

/**
 * drowan functions and definitions
 *
 * @package Drowan
 */



if (!function_exists('drowan_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function drowan_setup()
	{

		// Make theme available for translation. Translations can be filed at https://translate.wordpress.org/projects/wp-themes/drowan
		load_theme_textdomain('drowan', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let WordPress manage the document title.
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// Set detfault Post Thumbnail size.
		set_post_thumbnail_size(1360, 765, true);

		// Register Navigation Menus.
		register_nav_menus(array(
			'primary' => esc_html__('Primary Menu', 'drowan'),
			'footer-menu' => esc_html__('Footer Menu', 'drowan'),
		));

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support('html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('drowan_custom_background_args', array(
			'default-color' => 'cccccc',
		)));

		// Set up the WordPress core custom logo feature.
		add_theme_support('custom-logo', apply_filters('drowan_custom_logo_args', array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		)));

		// Set up the WordPress core custom header feature.
		add_theme_support('custom-header', apply_filters('drowan_custom_header_args', array(
			'header-text' => false,
			'width'       => 2560,
			'height'      => 500,
			'flex-width'  => true,
			'flex-height' => true,
		)));

		// Add extra theme styling to the visual editor.
		add_editor_style(array('assets/css/editor-style.css'));

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for responsive embed blocks.
		add_theme_support('responsive-embeds');
	}
endif;
add_action('after_setup_theme', 'drowan_setup');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function drowan_content_width()
{
	$GLOBALS['content_width'] = apply_filters('drowan_content_width', 910);
}
add_action('after_setup_theme', 'drowan_content_width', 0);


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function drowan_widgets_init()
{

	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'drowan'),
		'id'            => 'sidebar-1',
		'description'   => esc_html_x('Sidebar will appear on posts and pages, except with the full width template.', 'widget area description', 'drowan'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
}
add_action('widgets_init', 'drowan_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function drowan_scripts()
{

	// Get Theme Version.
	$theme_version = wp_get_theme()->get('Version');

	// Register and Enqueue Stylesheet.
	wp_enqueue_style('drowan-stylesheet', get_stylesheet_uri(), array(), $theme_version);

	// Register and enqueue navigation.min.js.
	if ((has_nav_menu('primary') || has_nav_menu('secondary')) && !drowan_is_amp()) {
		wp_enqueue_script('drowan-navigation', get_theme_file_uri('/assets/js/navigation.min.js'), array(), '20220224', true);
		$drowan_l10n = array(
			'expand'   => esc_html__('Expand child menu', 'drowan'),
			'collapse' => esc_html__('Collapse child menu', 'drowan'),
			'icon'     => drowan_get_svg('expand'),
		);
		wp_localize_script('drowan-navigation', 'drowanScreenReaderText', $drowan_l10n);
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	if (!drowan_is_amp()) {
		wp_enqueue_script('svgxuse', get_theme_file_uri('/assets/js/svgxuse.min.js'), array(), '1.2.6');
	}

	// Register Comment Reply Script for Threaded Comments.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'drowan_scripts');


/**
 * Enqueue theme fonts.
 */
function drowan_theme_fonts()
{
	$fonts_url = drowan_get_fonts_url();

	// Load Fonts if necessary.
	if ($fonts_url) {
		require_once get_theme_file_path('inc/wptt-webfont-loader.php');
		wp_enqueue_style('drowan-theme-fonts', wptt_get_webfont_url($fonts_url), array(), '20201110');
	}
}
add_action('wp_enqueue_scripts', 'drowan_theme_fonts', 1);
add_action('enqueue_block_editor_assets', 'drowan_theme_fonts', 1);


/**
 * Retrieve webfont URL to load fonts locally.
 */
function drowan_get_fonts_url()
{
	$font_families = array(
		'Raleway:400,400italic,700,700italic',
		'Quicksand:400,400italic,700,700italic',
	);

	$query_args = array(
		'family'  => urlencode(implode('|', $font_families)),
		'subset'  => urlencode('latin,latin-ext'),
		'display' => urlencode('swap'),
	);

	return apply_filters('drowan_get_fonts_url', add_query_arg($query_args, 'https://fonts.googleapis.com/css'));
}


/**
 * Add custom sizes for featured images
 */
function drowan_add_image_sizes()
{

	add_image_size('drowan-list-post', 600, 450, true);
}
add_action('after_setup_theme', 'drowan_add_image_sizes');


/**
 * Make custom image sizes available in Gutenberg.
 */
function drowan_add_image_size_names($sizes)
{
	return array_merge($sizes, array(
		'post-thumbnail'    => esc_html__('drowan Single Post', 'drowan'),
		'drowan-list-post' => esc_html__('drowan List Post', 'drowan'),
	));
}
add_filter('image_size_names_choose', 'drowan_add_image_size_names');


/**
 * Add pingback url on single posts
 */
function drowan_pingback_url()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
	}
}
add_action('wp_head', 'drowan_pingback_url');


/**
 * Include Files
 */


// Include Theme Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-functions.php';

// Include Template Tags.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';
