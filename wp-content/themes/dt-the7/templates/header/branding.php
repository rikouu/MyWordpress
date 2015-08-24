<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
				<!-- !- Branding -->
				<div id="branding" class="wf-td">

					<?php

					// header logo
					$logo = presscore_get_logo_image( presscore_get_header_logos_meta() );

					// modile logo
					$logo .= presscore_get_logo_image( presscore_get_mobile_logos_meta(), 'mobile-logo' );

					if ( $logo ) {

						$config = Presscore_Config::get_instance();

						if ( 'microsite' == $config->get('template') ) {
							$logo_target_link = get_post_meta( $post->ID, '_dt_microsite_logo_link', true );

							if ( $logo_target_link ) {
								echo sprintf('<a href="%s">%s</a>', esc_url( $logo_target_link ), $logo);
							} else {
								echo $logo;
							}

						} else {
							echo sprintf('<a href="%s">%s</a>', esc_url( home_url( '/' ) ), $logo);

						}

						$site_title_class = 'assistive-text';

					} else {
						$site_title_class = 'h3-size site-title';

					}
					?>

					<div id="site-title" class="<?php echo $site_title_class; ?>"><?php bloginfo( 'name' ); ?></div>
					<div id="site-description" class="assistive-text"><?php bloginfo( 'description' ); ?></div>
				</div>