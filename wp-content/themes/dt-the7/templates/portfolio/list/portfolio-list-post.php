<?php
/**
 * Portfolio list content. 
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;

$config = Presscore_Config::get_instance();

$article_content_layout = presscore_get_template_image_layout( $config->get( 'layout' ), $config->get( 'post.query.var.current_post' ) );
?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class( array( 'post', 'project-' . $article_content_layout ) ); ?>>

	<?php
	if ( 'odd' == $article_content_layout || 'wide' == $config->get( 'post.preview.width' ) ) {

		// media
		dt_get_template_part( 'portfolio/list/portfolio-list-post-media' );

		// content
		dt_get_template_part( 'portfolio/list/portfolio-list-post-content' );

	} else {

		// content
		dt_get_template_part( 'portfolio/list/portfolio-list-post-content' );

		// media
		dt_get_template_part( 'portfolio/list/portfolio-list-post-media' );

	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php do_action('presscore_after_post'); ?>