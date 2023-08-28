<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Drowan
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action('wp_body_open'); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'drowan'); ?></a>

		<?php do_action('drowan_header_bar'); ?>

		<?php do_action('drowan_before_header'); ?>

		<header id="masthead" class="site-header clearfix" role="banner">

			<div class="header-main container clearfix">

				<div id="logo" class="site-branding clearfix">

					<?php drowan_site_logo(); ?>
					<?php drowan_site_title(); ?>
					<?php drowan_site_description(); ?>

				</div><!-- .site-branding -->
			</div><!-- .header-main -->

			<?php get_template_part('template-parts/header/navbar'); ?>


			<?php drowan_breadcrumbs(); ?>

		</header><!-- #masthead -->

		<?php do_action('drowan_after_header'); ?>

		<div id="content" class="site-content container">

			<?php do_action('drowan_before_content'); ?>