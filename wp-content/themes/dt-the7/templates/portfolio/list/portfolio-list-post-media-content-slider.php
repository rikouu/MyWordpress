<?php
/**
 * Portfolio media slider
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

	<div class="project-list-media" <?php echo presscore_get_post_content_style_for_blog_list( 'media' ); ?>>

		<?php
		// output media
		echo '<div class="post-slider">';

		$class = array( 'slider-simple' );
		$config = Presscore_Config::get_instance();

		if ( 'normal' == $config->get( 'post.preview.width' ) ) {
			$class[] = 'alignleft';

		} else {
			$class[] = 'alignnone';

		}

		echo presscore_get_project_media_slider( $class );
		echo '</div>';
		?>

	</div>