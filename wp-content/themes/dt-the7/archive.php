<?php
/**
 * Archive pages.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_get_config();
$config->set( 'template', 'archive' );
$config->set( 'layout', 'masonry' );
$config->set( 'template.layout.type', 'masonry' );

$archive_page_id = apply_filters( 'presscore_archive_page_id', null );
presscore_config_base_init( $archive_page_id );

get_header(); ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				if ( have_posts() ) :

					do_action( 'presscore_before_loop' );

					// backup config
					$config_backup = $config->get();

					// masonry container open
					echo '<div ' . presscore_masonry_container_class( array( 'wf-container' ) ) . presscore_masonry_container_data_atts() . '>';

						while ( have_posts() ) : the_post();

							switch ( get_post_type() ) {
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
								default:
									dt_get_template_part( 'content-archive' );
									break;
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