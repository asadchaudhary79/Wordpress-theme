<?php

/**
 * Add theme support for the Gutenberg Editor
 *
 * @package Drowan
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function drowan_gutenberg_support()
{

	// Add theme support for dimension controls.
	add_theme_support('custom-spacing');

	// Add theme support for custom line heights.
	add_theme_support('custom-line-height');

	// Define block color palette.
	$color_palette = apply_filters('drowan_color_palette', array(
		'primary_color'    => '#ee1133',
		'secondary_color'  => '#d5001a',
		'tertiary_color'   => '#bb0000',
		'accent_color'     => '#1153ee',
		'highlight_color'  => '#eedc11',
		'light_gray_color' => '#f2f2f2',
		'gray_color'       => '#666666',
		'dark_gray_color'  => '#202020',
	));

	// Add theme support for block color palette.
	add_theme_support('editor-color-palette', apply_filters('drowan_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x('Primary', 'block color', 'drowan'),
			'slug'  => 'primary',
			'color' => esc_html($color_palette['primary_color']),
		),
		array(
			'name'  => esc_html_x('Secondary', 'block color', 'drowan'),
			'slug'  => 'secondary',
			'color' => esc_html($color_palette['secondary_color']),
		),
		array(
			'name'  => esc_html_x('Tertiary', 'block color', 'drowan'),
			'slug'  => 'tertiary',
			'color' => esc_html($color_palette['tertiary_color']),
		),
		array(
			'name'  => esc_html_x('Accent', 'block color', 'drowan'),
			'slug'  => 'accent',
			'color' => esc_html($color_palette['accent_color']),
		),
		array(
			'name'  => esc_html_x('Highlight', 'block color', 'drowan'),
			'slug'  => 'highlight',
			'color' => esc_html($color_palette['highlight_color']),
		),
		array(
			'name'  => esc_html_x('White', 'block color', 'drowan'),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x('Light Gray', 'block color', 'drowan'),
			'slug'  => 'light-gray',
			'color' => esc_html($color_palette['light_gray_color']),
		),
		array(
			'name'  => esc_html_x('Gray', 'block color', 'drowan'),
			'slug'  => 'gray',
			'color' => esc_html($color_palette['gray_color']),
		),
		array(
			'name'  => esc_html_x('Dark Gray', 'block color', 'drowan'),
			'slug'  => 'dark-gray',
			'color' => esc_html($color_palette['dark_gray_color']),
		),
		array(
			'name'  => esc_html_x('Black', 'block color', 'drowan'),
			'slug'  => 'black',
			'color' => '#000000',
		),
	)));

	// Check if block style functions are available.
	if (function_exists('register_block_style')) {

		// Register Widget Title Block style.
		register_block_style('core/heading', array(
			'name'         => 'widget-title',
			'label'        => esc_html__('Widget Title', 'drowan'),
			'style_handle' => 'drowan-stylesheet',
		));
	}
}
add_action('after_setup_theme', 'drowan_gutenberg_support');


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function drowan_block_editor_assets()
{

	// Enqueue Editor Styling.
	wp_enqueue_style('drowan-editor-styles', get_theme_file_uri('/assets/css/editor-styles.css'), array(), '20210306', 'all');

	// Enqueue Page Template Switcher Editor plugin.
	#wp_enqueue_script( 'drowan-page-template-switcher', get_theme_file_uri( '/assets/js/page-template-switcher.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), '20210306' );
}
add_action('enqueue_block_editor_assets', 'drowan_block_editor_assets');


/**
 * Add body classes in Gutenberg Editor.
 */
function drowan_block_editor_body_classes($classes)
{
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if (!(method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor())) {
		return $classes;
	}

	// Fullwidth Page Template?
	if ('templates/template-fullwidth.php' === get_page_template_slug($post->ID)) {
		$classes .= ' drowan-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if (
		'templates/template-no-title.php' === get_page_template_slug($post->ID) or
		'templates/template-sidebar-left-no-title.php' === get_page_template_slug($post->ID) or
		'templates/template-sidebar-right-no-title.php' === get_page_template_slug($post->ID)
	) {
		$classes .= ' drowan-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ('templates/template-fullwidth-no-title.php' === get_page_template_slug($post->ID)) {
		$classes .= ' drowan-fullwidth-page-layout drowan-page-title-hidden ';
	}

	return $classes;
}
#add_filter( 'admin_body_class', 'drowan_block_editor_body_classes' );
