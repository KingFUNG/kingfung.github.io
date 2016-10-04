<?php
// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}


class One_And_One_Wizard_Header {

	static public function get_wizard_header( $wizard_step, $site_type = '', $theme = '' ) {

		if ( $theme ) {
			$theme = wp_get_theme( $theme );
		} else {
			$theme = wp_get_theme();
		}

		$site_type_translated = get_option( 'oneandone_assistant_sitetype_translated' );

		if ( ! $site_type ) {
			$site_type = get_option( 'oneandone_assistant_sitetype' );
		}
		?>

		<h2><?php esc_html_e( '1&1 WP Wizard', '1and1-wordpress-wizard' ) ?></h2>

		<div class="clear oneandone-setup-progress">
			<ul>
				<li>
					<span class="<?php echo ( $wizard_step == 1 ) ? 'active' : ''; ?> oneandone-progress-step-number">1</span>
					<span class="oneandone-progress-step-title">
                        <?php
						esc_html_e( 'Website Type', '1and1-wordpress-wizard' );
						if ( ! empty( $site_type_translated ) ) {
							echo ': '.$site_type_translated;
						} elseif ( $site_type ) {
							echo ': '.One_And_One_Wizard::get_site_type_label( $site_type );
						}
						?>
                    </span>
					<hr class="oneandone-horizontal-line" />
				</li>
				<li>
					<span class="<?php echo ( $wizard_step == 2 ) ? 'active' : ''; ?> oneandone-progress-step-number">2</span>
					<span class="oneandone-progress-step-title">
                        <?php
						esc_html_e( 'Design', '1and1-wordpress-wizard' );
						echo( $theme ? ': '.$theme->name : '' );
						?>
                    </span>
					<hr class="oneandone-horizontal-line" />
				</li>
				<li>
					<span class="<?php echo ( $wizard_step == 3 ) ? 'active' : ''; ?> oneandone-progress-step-number">3</span><span
						class="oneandone-progress-step-title"><?php esc_html_e( 'Plugins', '1and1-wordpress-wizard' ); ?></span>
				</li>
			</ul>
		</div>

		<?php
	}
}