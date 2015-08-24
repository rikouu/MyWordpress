<?php
/**
 * Mirosite template.
 *
 * @package presscore
 * @since presscore 2.2
 */

/* Template Name: Microsite */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// add filter for theme options here
add_filter( 'dt_of_get_option', 'presscore_microsite_theme_options_filter', 15, 2 );

// add menu filter here
add_filter( 'dt_menu_options', 'presscore_microsite_menu_filter' );

$config = Presscore_Config::get_instance();
$config->set('template', 'microsite');
presscore_config_base_init();

presscore_microsite_setup();

get_header(); ?>

		<?php if ( presscore_is_content_visible() ): ?>	

			<div id="content" class="content" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<?php do_action('presscore_before_loop'); ?>

					<?php the_content(); ?>

					<?php presscore_display_share_buttons( 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'microsite' ); ?>

			<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>