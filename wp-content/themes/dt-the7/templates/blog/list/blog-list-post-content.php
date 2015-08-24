<?php
/**
 * Blog simple post content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

?>
<div class="blog-content wf-td" <?php echo presscore_get_post_content_style_for_blog_list( 'content' ); ?>>

	<?php dt_get_template_part( 'blog/blog-post-content-part', get_post_format() ); ?>

	<?php
	$config = Presscore_Config::get_instance();
	if ( $config->get( 'show_details' ) ) {
		echo presscore_post_details_link();
	}
	?>

	<?php echo presscore_new_posted_on( 'post' ); ?>

	<?php echo presscore_post_edit_link(); ?>

</div>