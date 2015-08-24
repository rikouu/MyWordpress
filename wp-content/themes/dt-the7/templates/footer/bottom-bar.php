<?php
/**
 * Bottom bar template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<!-- !Bottom-bar -->
<div id="bottom-bar" <?php echo presscore_bottom_bar_class(); ?> role="contentinfo">
	<div class="wf-wrap">
		<div class="wf-container-bottom">
			<div class="wf-table wf-mobile-collapsed">

				<?php
				$config = Presscore_Config::get_instance();

				$bottom_logo = presscore_get_logo_image( presscore_get_footer_logos_meta() );
				if ( $bottom_logo ) :
				?>
				<div id="branding-bottom" class="wf-td"><?php

					if ( 'microsite' == $config->get( 'template' ) ) {
						$logo_target_link = get_post_meta( $post->ID, '_dt_microsite_logo_link', true );

						if ( $logo_target_link ) {
							echo sprintf('<a href="%s">%s</a>', esc_url( $logo_target_link ), $bottom_logo);
						} else {
							echo $bottom_logo;
						}

					} else {
						echo sprintf('<a href="%s">%s</a>', esc_url( home_url( '/' ) ), $bottom_logo);
					}

				?></div>
				<?php
				endif;

				do_action( 'presscore_credits' );

				$copyrights = $config->get( 'template.bottom_bar.copyrights' );
				$credits = $config->get( 'template.bottom_bar.credits' );
				
				if ( $copyrights || $credits ) : ?>

					<div class="wf-td">
						<div class="wf-float-left">

							<?php
							echo $copyrights;
							if ( $credits ) {
								echo '&nbsp;Dream-Theme &mdash; truly <a href="http://dream-theme.com" target="_blank">premium WordPress themes</a>';
							}
							?>

						</div>
					</div>

				<?php endif; ?>

				<div class="wf-td">

					<?php presscore_nav_menu_list( 'bottom', 'right' ); ?>

				</div>

				<?php
				$bottom_text = $config->get( 'template.bottom_bar.text' );;
				if ( $bottom_text ) : ?>

					<div class="wf-td bottom-text-block">

						<?php echo wpautop( $bottom_text ); ?>

					</div>

				<?php endif; ?>

			</div>
		</div><!-- .wf-container-bottom -->
	</div><!-- .wf-wrap -->
</div><!-- #bottom-bar -->