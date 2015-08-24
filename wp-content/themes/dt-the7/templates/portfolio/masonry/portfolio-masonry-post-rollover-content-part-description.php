<?php
/**
 * Portfolio post content part with rollover
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_get_config();

if ( $config->get( 'show_titles' ) && get_the_title() ) : ?>

	<h3 class="entry-title"><?php the_title(); ?></h3>

<?php endif;

if ( $config->get( 'show_excerpts' ) ) {
	the_excerpt();
}

echo presscore_new_posted_on( 'dt_portfolio' );
?>