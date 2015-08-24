<?php
/* Template Name: Blog - masonry & grid */

/**
 * Blog masonry template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
$config->set( 'template', 'blog' );
$config->set( 'template.layout.type', 'masonry' );

presscore_config_base_init();

// add content controller
add_action( 'presscore_before_main_container', 'presscore_page_content_controller', 15 );

get_header();

if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop

					do_action( 'presscore_before_loop' );

					if ( post_password_required() ) {
						the_content();

					} else {

						// backup config
						$config_backup = $config->get();

						// fullwidth wrap open
						if ( $config->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

						// masonry container open
						echo '<div ' . presscore_masonry_container_class( array( 'wf-container' ) ) . presscore_masonry_container_data_atts() . '>';

							//////////////////////
							// Custom loop //
							//////////////////////

							$orderby = $config->get( 'orderby' );

							$blog_args = array(
								'post_type'		=> 'post',
								'post_status'	=> 'publish' ,
								'paged'			=> dt_get_paged_var(),
								'order'			=> $config->get( 'order' ),
								'orderby'		=> 'name' == $orderby ? 'title' : $orderby,
							);

							$ppp = $config->get( 'posts_per_page' );
							if ( $ppp ) {
								$blog_args['posts_per_page'] = intval($ppp);
							}

							$display = $config->get( 'display' );
							if ( ! empty( $display['terms_ids'] ) ) {
								$terms_ids = array_values($display['terms_ids']);

								switch( $display['select'] ) {
									case 'only':
										$blog_args['category__in'] = $terms_ids;
										break;

									case 'except':
										$blog_args['category__not_in'] = $terms_ids;
								}

							}

							$page_query = new WP_Query( $blog_args );

							if ( $page_query->have_posts() ): while( $page_query->have_posts() ): $page_query->the_post();

								// populate config with current post settings
								presscore_populate_post_config();

								dt_get_template_part( 'blog/masonry/blog-masonry-post' );

							endwhile; wp_reset_postdata(); endif;

						// masonry container close
						echo '</div>';

						// fullwidth wrap close
						if ( $config->get( 'full_width' ) ) { echo '</div>'; }

						/////////////////////
						// Pagination //
						/////////////////////

						presscore_complex_pagination( $page_query );

						// restore config
						$config->reset( $config_backup );

					}

					do_action( 'presscore_after_loop' );

				endwhile; endif; ?>

			</div><!-- #content -->

		<?php
		do_action('presscore_after_content');

endif; // if content visible

get_footer(); ?>