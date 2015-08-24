<?php
/**
 * Portfolio post content part with rollover
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

if ( $config->get( 'show_titles' ) && get_the_title() ) :
?>
	<h3 class="entry-title"><a class="dt-trigger-first-mfp" href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<?php
endif;

if ( $config->get( 'show_excerpts' ) ) {
	echo wpautop( get_the_content() );
}
?>