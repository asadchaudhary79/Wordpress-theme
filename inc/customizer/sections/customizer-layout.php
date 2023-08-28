<?php

/**
 * Layout Settings
 *
 * Register Layout section, settings and controls for Theme Customizer
 *
 * @package Drowan
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function drowan_customize_register_layout_settings($wp_customize)
{

	// Add Section for Theme Options.
	$wp_customize->add_section('drowan_section_layout', array(
		'title'    => esc_html__('Layout Settings', 'drowan'),
		'priority' => 10,
		'panel'    => 'drowan_options_panel',
	));

	// Add Settings and Controls for theme layout.
	$wp_customize->add_setting('drowan_theme_options[theme_layout]', array(
		'default'           => 'wide',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_select',
	));

	$wp_customize->add_control('drowan_theme_options[theme_layout]', array(
		'label'    => esc_html__('Theme Layout', 'drowan'),
		'section'  => 'drowan_section_layout',
		'settings' => 'drowan_theme_options[theme_layout]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			'wide'     => esc_html__('Wide Layout', 'drowan'),
			'centered' => esc_html__('Centered Layout', 'drowan'),
			'boxed'    => esc_html__('Boxed Layout', 'drowan'),
		),
	));

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting('drowan_theme_options[sidebar_position]', array(
		'default'           => 'left-sidebar',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'drowan_sanitize_select',
	));

	$wp_customize->add_control('drowan_theme_options[sidebar_position]', array(
		'label'    => esc_html__('Sidebar Position', 'drowan'),
		'section'  => 'drowan_section_layout',
		'settings' => 'drowan_theme_options[sidebar_position]',
		'type'     => 'radio',
		'priority' => 20,
		'choices'  => array(
			'left-sidebar'  => esc_html__('Left Sidebar', 'drowan'),
			'right-sidebar' => esc_html__('Right Sidebar', 'drowan'),
		),
	));
}
add_action('customize_register', 'drowan_customize_register_layout_settings');
