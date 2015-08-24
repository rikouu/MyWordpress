<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$show_icon = of_get_option('header-search_icon', true);
$class = $show_icon ? '' : ' icon-off';
$caption = of_get_option('header-search_caption', _x( "Search", "theme-options", LANGUAGE_ZONE ));

if ( !$caption && $show_icon ) {
	$class .= ' text-disable';
}

if ( !$caption ) {
	$caption = '&nbsp;';
}
?>
<div class="mini-search">
	<form class="searchform" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field searchform-s" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php _e( 'Type and hit enter &hellip;', LANGUAGE_ZONE ); ?>" />
		<input type="submit" class="assistive-text searchsubmit" value="<?php esc_attr_e( 'Go!', LANGUAGE_ZONE ); ?>" />
		<a href="#go" id="trigger-overlay" class="submit<?php echo $class; ?>"><?php echo esc_html($caption); ?></a>
	</form>
</div>