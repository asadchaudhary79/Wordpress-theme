<?php

/**
 * Theme Links Control for the Customizer
 *
 * @package Drowan
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if (class_exists('WP_Customize_Control')) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class drowan_Customize_Links_Control extends WP_Customize_Control
	{
		/**
		 * Render Control
		 */
		public function render_content()
		{
?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e('Theme Links', 'drowan'); ?></span>

				<p>
					<a href="<?php echo esc_url(__('https://WPCodeXcom/themes/drowan/', 'drowan')); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=drowan&utm_content=theme-page" target="_blank">
						<?php esc_html_e('Theme Page', 'drowan'); ?>
					</a>
				</p>

				<p>
					<a href="http://preview.WPCodeXcom/?demo=drowan&utm_source=customizer&utm_campaign=drowan" target="_blank">
						<?php esc_html_e('Theme Demo', 'drowan'); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url(__('https://WPCodeXcom/docs/drowan-documentation/', 'drowan')); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=drowan&utm_content=documentation" target="_blank">
						<?php esc_html_e('Theme Documentation', 'drowan'); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url(__('https://WPCodeXcom/changelogs/?action=WPCodeX-changelog&type=theme&slug=drowan/', 'drowan')); ?>" target="_blank">
						<?php esc_html_e('Theme Changelog', 'drowan'); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url(__('https://wordpress.org/support/theme/drowan/reviews/', 'drowan')); ?>" target="_blank">
						<?php esc_html_e('Rate this theme', 'drowan'); ?>
					</a>
				</p>

			</div>

<?php
		}
	}

endif;
