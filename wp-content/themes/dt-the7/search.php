<?php
/**
 * Search results page.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_get_config();
$config->set( 'template', 'search' );
$config->set( 'layout', 'masonry' );
$config->set( 'template.layout.type', 'masonry' );

presscore_config_base_init();

get_header(); ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				if ( have_posts() ) :

					do_action( 'presscore_before_loop' );
					do_action( 'presscore_before_search_loop' );

					// backup config
					$config_backup = $config->get();

					$search_content_templates = presscore_search_content_templates();

					// masonry container open
					echo '<div ' . presscore_masonry_container_class( array( 'wf-container' ) ) . presscore_masonry_container_data_atts() . '>';

						while ( have_posts() ) : the_post();

							$post_type = get_post_type();
							switch ( $post_type ) {
								case 'post':

									$config->set( 'show_details', false );

									// populate config with current post settings
									presscore_populate_post_config();

									dt_get_template_part( 'blog/masonry/blog-masonry-post' );

									// restore config
									$config->reset( $config_backup );
									break;
								case 'dt_portfolio':

									// populate post config
									presscore_populate_portfolio_config();

									dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post' );

									// restore config
									$config->reset( $config_backup );
									break;
								case 'dt_gallery':

									add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );

									// populate post config
									presscore_populate_album_post_config();

									// get_template_part( 'content', 'gallery' );
									dt_get_template_part( 'albums/masonry/albums-masonry-post' );

									remove_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );

									// restore config
									$config->reset( $config_backup );
									break;

								case 'dt_team':
									presscore_populate_team_config();

									dt_get_template_part( 'team/team-post' );

									$config->reset( $config_backup );
									break;

								case 'dt_testimonials':
									get_template_part( 'content', 'testimonials' );
									break;

								case 'page':
								default:

									if ( $search_content_templates->action_exists( $post_type ) ) {
										$search_content_templates->do_action( $post_type );
									} else {
										dt_get_template_part( 'content-archive' );
									}
							}

						endwhile;

					// masonry container close
					echo '</div>';

					dt_paginator();

					// restore config
					$config->reset( $config_backup );

					do_action( 'presscore_after_loop' );

				else :

					get_template_part( 'no-results', 'search' );

				endif;
				?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

<?php get_footer(); ?>