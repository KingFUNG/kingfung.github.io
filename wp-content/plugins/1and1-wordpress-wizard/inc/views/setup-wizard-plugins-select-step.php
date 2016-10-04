<?php
// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

class One_And_One_Plugin_Select_Step {

	static public function get_plugin_selection( $site_type, $theme_id ) {

		add_thickbox();
		wp_enqueue_script('1and1-install-progress');

		$catalog = new One_And_One_Catalog();
		$recommended_plugins = $catalog->get_recommended_plugins( $site_type );
		$default_plugins = $catalog->get_default_plugins( $site_type );


		if ( version_compare( $GLOBALS['wp_version'], '4.0', '<' ) ) {
			include_once( One_And_One_Wizard::get_views_dir_path() . 'setup-wizard-plugin-item-compatibility.php' );
		}
		else {
			include_once( One_And_One_Wizard::get_views_dir_path() . 'setup-wizard-plugin-item.php' );
		}
		?>

		<script type="text/javascript">
			function showBox(id, title) {
				tb_show(title, '#TB_inline?height=500&width=800&inlineId=' + id + '&modal=false', null);
			}

			jQuery(function($) {
				$( '.oneandone-plugin-browser' ).on( 'click', '.oneandone-install-checkbox input', function(evt) {
					$checkbox = $(this);

					if ( $checkbox.prop('checked') ) {
						$(this).closest('.oneandone-install-checkbox').addClass( 'checked' );
					} else {
						$(this).closest('.oneandone-install-checkbox').removeClass( 'checked' );
					}
				});
			});
		</script>

	<form action="<?php echo esc_url( add_query_arg( array( 'setup_action' => 'install' ) ) ); ?>" method="post">
		<!-- Add nonce-->
		<?php wp_nonce_field( 'install' ) ?>
		<input type="hidden" name="sitetype" value="<?php echo esc_attr( $site_type ); ?>"/>
		<input type="hidden" name="theme" value="<?php echo esc_attr( $theme_id ); ?>"/>

		<div class="wrap">

			<?php
			include_once( One_And_One_Wizard::get_views_dir_path() . 'setup-wizard-header.php' );
			One_And_One_Wizard_Header::get_wizard_header( 3, $site_type, $theme_id ); ?>

			<h3 class="clear"><?php esc_html_e( 'Select your plugins', '1and1-wordpress-wizard' ); ?></h3>

			<p>
			<?php
			$button_title = esc_attr__( 'Continue', '1and1-wordpress-wizard' );

			if ( false === $default_plugins && false === $recommended_plugins ) {
				esc_html_e( "The plugins couldn't get retrieved. Please refresh the page.", '1and1-wordpress-wizard' );
			}
			else if ( ! $default_plugins && ! $recommended_plugins ) {
				esc_html_e( 'You already installed all the plugins we recommend. Nice job!', '1and1-wordpress-wizard' );
			}
			else {
				$button_title = esc_attr__( 'Install selection', '1and1-wordpress-wizard' );
				esc_html_e( 'Enhance your website with plugins and additional features now. These plugins are adjusted for the selected website type:', '1and1-wordpress-wizard' );
			}
			?>
			</p>

			<?php if ( $recommended_plugins ) : ?>
				<p><a href="#recommended_plugins"><?php esc_html_e( 'These plugins are worth a try as well:', '1and1-wordpress-wizard' ); ?></a></p>
			<?php endif; ?>

			<br/>

			<div class="oneandone-functionality-choice">
				<?php
				$index = 0;
				if ( $default_plugins ) {
					?>
					<hr />

					<h3><?php esc_html_e( 'Recommended for your website:', '1and1-wordpress-wizard' ); ?></h3>
					<p><?php esc_html_e( 'We recommend these plugins as the basic configuration for your website type.', '1and1-wordpress-wizard' ); ?></p>

					<div class="oneandone-plugin-browser">
						<?php
						foreach ( $default_plugins as $plugin ) {
							$popup_id = "Popup" . $index++;

							One_And_One_Plugin_Item::get_plugin_item( $plugin, $popup_id, true );
						} ?>
					</div>

					<br class="clear">
					<div class="alignright">
						<input type="submit" name="install" value="<?php echo $button_title; ?>" class="button button-primary"/>
					</div>
					<br class="clear">
					<br class="clear">
				<?php } ?>


				<?php
				if ( $recommended_plugins ) {
					?>
					<hr />
					<h3 id="recommended_plugins"><?php esc_html_e( 'These plugins are worth a try as well:', '1and1-wordpress-wizard' ); ?></h3>

					<p><?php esc_html_e( 'These plugins can help you to implement new ideas with your website.', '1and1-wordpress-wizard' ) ?></p>

					<div class="oneandone-plugin-browser">
						<?php
						foreach ( $recommended_plugins as $plugin ) {
							$popup_id = "Popup" . $index++;

							One_And_One_Plugin_Item::get_plugin_item( $plugin, $popup_id, false );
						} ?>
					</div>

				<?php
				}
				?>
			</div>

			<br class="clear">
			<div class="alignright">
				<input type="submit" name="install" value="<?php echo $button_title; ?>" class="button button-primary"/>
			</div>

			<p>
				<a href="<?php echo esc_url( admin_url( 'tools.php?page=1and1-wordpress-wizard' ) ); ?>"><?php esc_html_e( 'Back to the beginning', '1and1-wordpress-wizard' ); ?></a>
			</p>
		</div>

	<?php
	}

}