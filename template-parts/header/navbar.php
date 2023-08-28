<?php

/**
 * Primary Menu
 *
 * @version 1.2
 * @package Drowan
 */
?>

<?php if (has_nav_menu('primary')) : ?>

	<div id="main-navigation-wrap" class="primary-navigation-wrap">

		<div id="main-navigation-container" class="primary-navigation-container container">

			<?php do_action('drowan_header_search'); ?>

			<button class="primary-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false" <?php drowan_amp_menu_toggle(); ?>>
				<?php
				echo drowan_get_svg('menu');
				echo drowan_get_svg('close');
				?>
				<span class="menu-toggle-text"><?php esc_html_e('Menu', 'drowan'); ?></span>
			</button>

			<div class="primary-navigation">

				<nav id="site-navigation" class="main-navigation" role="navigation" <?php drowan_amp_menu_is_toggled(); ?> aria-label="<?php esc_attr_e('Primary Menu', 'drowan'); ?>">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'container'      => false,
						)
					);
					?>
				</nav><!-- #site-navigation -->

			</div><!-- .primary-navigation -->

		</div>

	</div>

<?php endif; ?>

<?php do_action('drowan_after_navigation'); ?>