<?php
/**
 * The Header for single posts.
 *
 * Do not content header-main-content-open template part!
 *
 * @package vogue
 * @since vogue 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ancient-ie old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ancient-ie old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="old-ie no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="old-ie9 no-js" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php if ( presscore_responsive() ) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php endif; // is responsive?>
	<?php if ( dt_retina_on() ) { dt_core_detect_retina_script(); } ?>
	<title><?php echo presscore_blog_title(); ?></title>
<style type='text/css'>
body,a,h1,h2,h3,h4,h5,div,p,span{font-family:"Microsoft Yahei" !important;}
</style>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if IE]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	echo dt_get_favicon( of_get_option('general-favicon', '') );
	presscore_icons_for_handhelded_devices();
	// tracking code
	if ( ! is_preview() ) {
		echo of_get_option('general-tracking_code', '');
	}
	?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'presscore_body_top' ); ?>

<?php $config = presscore_get_config(); ?>

<div id="page"<?php if ( 'boxed' == $config->get( 'template.layout' ) ) echo ' class="boxed"'; ?>>

<?php
if ( presscore_is_content_visible() && $config->get( 'template.footer.background.slideout_mode' ) ) {
	echo '<div class="page-inner">';
}
?>

<?php if ( apply_filters( 'presscore_show_header', true ) ) : ?><!-- left, center, classic, side -->

	<?php dt_get_template_part( 'header/header', of_get_option( 'header-layout', 'left' ) ); ?>

<?php endif; // presscore_show_header ?>