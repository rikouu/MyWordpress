<?php
/**
 * Load theme modules
 *
 * @since 4.0.2
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


/////////////////
// Woocommerce //
/////////////////

if ( class_exists( 'Woocommerce' ) ) {
	include_once locate_template( 'inc/mods/mod-woocommerce/mod-woocommerce.php' );
}

//////////////
// UberMenu //
//////////////

if ( class_exists('UberMenu') ) {
	include_once locate_template( 'inc/mods/mod-ubermenu/mod-ubermenu.php' );
}

/////////////////////////////////////////
// Layer slider compatibility settings //
/////////////////////////////////////////

if ( defined('LS_PLUGIN_VERSION') && class_exists('UniteBaseClassRev') ) {
	include_once locate_template( 'inc/mods/mod-layerslider/mod-layerslider.php' );
}

/////////////////
// Total Cache //
/////////////////

if ( defined('W3TC') && W3TC && defined('W3TC_DYNAMIC_SECURITY') && W3TC_DYNAMIC_SECURITY ) {
	include_once locate_template( 'inc/mods/mod-totalcache/mod-totalcache.php' );
}

/////////////////
// Super Cache //
/////////////////

if ( function_exists('wp_cache_is_enabled') && wp_cache_is_enabled() && function_exists('add_cacheaction') ) {
	include_once locate_template( 'inc/mods/mod-supercache/mod-supercache.php' );
}

//////////
// WPML //
//////////

if ( class_exists('SitePress') ) {
	include_once locate_template( 'inc/mods/mod-wpml/mod-wpml.php' );
}

/////////////////////
// Private content //
/////////////////////

if ( class_exists('PG_Walker_Nav_Menu_Edit_Custom') ) {
	include_once locate_template( 'inc/mods/mod-private-content/mod-private-content.php' );
}

/////////////////////////
// The events calendar //
/////////////////////////

if ( class_exists('TribeEvents') ) {
	include_once locate_template( 'inc/mods/mod-the-events-calendar/mod-the-events-calendar.php' );
}

/////////////
// Jetpack //
/////////////

if ( class_exists( 'Jetpack', false ) ) {
	include_once locate_template( 'inc/mods/mod-jetpack/mod-jetpack.php' );
}

/////////////////////
// Visual Composer //
/////////////////////

if ( class_exists( 'Vc_Manager', false ) ) {
	require_once locate_template( 'inc/mods/mod-visual-composer/mod-visual-composer.php' );
}

/////////////
// bbPress //
/////////////

if ( class_exists( 'bbPress', false ) ) {
	require_once locate_template( 'inc/mods/mod-bb-press/mod-bb-press.php' );
}
