<?php

/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Drowan
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function drowan_customize_register_post_settings($wp_customize)
{

	// Add Sections for Post Settings.
	$wp_customize->add_section('drowan_section_post', array(
		'title'    => esc_html__('Post Settings', 'drowan'),
		'priority' => 40,
		'panel' => 'drowan_options_panel',
	));

	// Add Post Details Headline.
	$wp_customize->add_control(new drowan_Customize_Header_Control(
		$wp_customize,
		'drowan_theme_options[post_details]',
		array(
			'label' => esc_html__('Post Details', 'drowan'),
			'section' => 'drowan_section_post',
			'settings' => array(),
			'priority' => 20,
		)
	));

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting('drowan_theme_options[meta_date]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[meta_date]', array(
		'label'    => esc_html__('Display date', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 30,
	));

	// Add Setting and Control for showing post author.
	$wp_customize->add_setting('drowan_theme_options[meta_author]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[meta_author]', array(
		'label'    => esc_html__('Display author', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 40,
	));

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting('drowan_theme_options[meta_category]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[meta_category]', array(
		'label'    => esc_html__('Display categories', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 50,
	));

	// Add Single Post Headline.
	$wp_customize->add_control(new drowan_Customize_Header_Control(
		$wp_customize,
		'drowan_theme_options[single_post]',
		array(
			'label' => esc_html__('Single Post', 'drowan'),
			'section' => 'drowan_section_post',
			'settings' => array(),
			'priority' => 60,
		)
	));

	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting('drowan_theme_options[meta_tags]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[meta_tags]', array(
		'label'    => esc_html__('Display tags', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 70,
	));

	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting('drowan_theme_options[post_navigation]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[post_navigation]', array(
		'label'    => esc_html__('Display previous/next post navigation', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 80,
	));

	// Add Featured Images Headline.
	$wp_customize->add_control(new drowan_Customize_Header_Control(
		$wp_customize,
		'drowan_theme_options[featured_images]',
		array(
			'label' => esc_html__('Featured Images', 'drowan'),
			'section' => 'drowan_section_post',
			'settings' => array(),
			'priority' => 90,
		)
	));

	// Add Setting and Control for featured images on blog and archives.
	$wp_customize->add_setting('drowan_theme_options[post_image_archives]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[post_image_archives]', array(
		'label'    => esc_html__('Display images on blog and archives', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[post_image_archives]',
		'type'     => 'checkbox',
		'priority' => 100,
	));

	$wp_customize->selective_refresh->add_partial('drowan_theme_options[post_image_archives]', array(
		'selector'         => '.site-main .post-wrapper',
		'render_callback'  => 'drowan_customize_partial_blog_content',
		'fallback_refresh' => false,
	));

	// Add Setting and Control for featured images on single posts.
	$wp_customize->add_setting('drowan_theme_options[post_image_single]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_checkbox',
	));

	$wp_customize->add_control('drowan_theme_options[post_image_single]', array(
		'label'    => esc_html__('Display image on single posts', 'drowan'),
		'section'  => 'drowan_section_post',
		'settings' => 'drowan_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 110,
	));

	$wp_customize->selective_refresh->add_partial('drowan_theme_options[post_image_single]', array(
		'selector'         => '.single-post .content-area .site-main',
		'render_callback'  => 'drowan_customize_partial_single_post',
		'fallback_refresh' => false,
	));
}
add_action('customize_register', 'drowan_customize_register_post_settings');


/**
 * Render single posts partial
 */
function drowan_customize_partial_single_post()
{
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content', 'single');
	}
}
