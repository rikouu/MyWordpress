<?php
/**
 * Portfolio post content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
?>

<div class="project-list-content">

<?php if ( $config->get( 'show_titles' ) && get_the_title() ) : ?>

	<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

<?php endif; ?>

<?php if ( $config->get('show_excerpts') ) : ?>

	<?php the_excerpt(); ?>

<?php endif; ?>

<?php echo presscore_new_posted_on( 'dt_portfolio' ); ?>

<?php echo presscore_post_edit_link(); ?>

</div>