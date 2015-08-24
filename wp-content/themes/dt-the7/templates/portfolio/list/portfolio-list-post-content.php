<?php
/**
 * Portfolio contentpart
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
?>

<div class="project-list-content" <?php echo presscore_get_post_content_style_for_blog_list( 'content' ); ?>>

	<?php if ( $config->get('show_titles') ): ?>

	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<?php endif; ?>

	<?php if ( $config->get('show_excerpts') ): ?>

		<?php the_excerpt(); ?>

	<?php endif; ?>

	<?php
	if ( $config->get( 'post.preview.buttons.details.enabled' ) ) {
		echo '<p>' . presscore_post_details_link( get_the_ID(), 'details more-link', __( 'View details', LANGUAGE_ZONE ) ) . '</p>';
	}

	echo presscore_new_posted_on( 'dt_portfolio' );

	echo presscore_post_edit_link();
	?>

</div>