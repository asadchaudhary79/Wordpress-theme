<?php

/**
 * Implement theme options in the Customizer
 *
 * @package Drowan
 */

$customizer_files = array(
	'sanitize-functions.php',
	'controls/headline-control.php',
	'controls/links-control.php',
	'controls/plugin-control.php',
	'controls/upgrade-control.php',
	'sections/customizer-layout.php',
	'sections/customizer-blog.php',
	'sections/customizer-post.php',
	'sections/customizer-website.php'
);

foreach ($customizer_files as $file) {
	require get_template_directory() . '/inc/customizer/' . $file;
}

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 * @param object $wp_customize / Customizer Object.
 */
function drowan_customize_register_options($wp_customize)
{

	// Add Theme Options Panel.
	$wp_customize->add_panel('drowan_options_panel', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Theme Options', 'drowan'),
	));

	// Change default background section.
	$wp_customize->get_control('background_color')->section = 'background_image';
	$wp_customize->get_section('background_image')->title   = esc_html__('Background', 'drowan');
}
add_action('customize_register', 'drowan_customize_register_options');


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function drowan_customize_preview_js()
{
	wp_enqueue_script('drowan-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array('customize-preview'), '20200410', true);
}
add_action('customize_preview_init', 'drowan_customize_preview_js');


/**
 * Embed JS for Customizer Controls.
 */
function drowan_customizer_controls_js()
{
	wp_enqueue_script('drowan-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '20200410', true);
}
add_action('customize_controls_enqueue_scripts', 'drowan_customizer_controls_js');


/**
 * Embed CSS styles Customizer Controls.
 */
function drowan_customizer_controls_css()
{
	wp_enqueue_style('drowan-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '20200410');
}
add_action('customize_controls_print_styles', 'drowan_customizer_controls_css');
