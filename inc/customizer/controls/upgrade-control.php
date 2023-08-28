<?php

/**
 * Upgrade Control for the Customizer
 *
 * @package Drowan
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if (class_exists('WP_Customize_Control')) :

	/**
	 * Displays the upgrade teaser in the Customizer.
	 */
	class drowan_Customize_Upgrade_Control extends WP_Customize_Control
	{
		/**
		 * Render Control
		 */
		public function render_content()
		{
?>

			<div class="upgrade-pro-version">

				<span class="customize-control-title"><?php esc_html_e('Pro Version Add-on', 'drowan'); ?></span>

				<span class="textfield">
					<?php printf(esc_html__('Purchase the %s Pro Add-on to get additional features and advanced customization options.', 'drowan'), 'drowan'); ?>
				</span>

				<p>
					<a href="<?php echo esc_url(__('https://WPCodeXcom/addons/drowan-pro/', 'drowan')); ?>?utm_source=customizer&utm_medium=button&utm_campaign=drowan&utm_content=pro-version" target="_blank" class="button button-secondary">
						<?php printf(esc_html__('Learn more about %s Pro', 'drowan'), 'drowan'); ?>
					</a>
				</p>

			</div>

<?php
		}
	}

endif;
