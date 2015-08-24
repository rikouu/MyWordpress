<?php
/**
 * Theme config helpers
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_config_base_init' ) ) :

	function presscore_config_base_init( $new_post_id = null ) {

		///////////////////////////
		// config for archives //
		///////////////////////////

		if ( null == $new_post_id && ( is_archive() || is_search() || is_home() || is_404() ) ) {
			presscore_config_populate_archive_vars();
			return;
		}

		///////////////////
		// set post id //
		///////////////////

		$config = Presscore_Config::get_instance();
		$post_id = $config->get('post_id');

		if ( null == $post_id ) {

			global $post;
			if ( $new_post_id ) {
				$post_id = $new_post_id;
			} else if ( !empty($post) ) {
				$post_id = $post->ID;
			}

			$config->set( 'post_id', $post_id );
		}

		if ( empty( $post_id ) ) {
			return;
		}

		//////////////////////
		// common settings //
		//////////////////////

		presscore_config_populate_header_options();
		presscore_config_populate_sidebar_and_footer_options();
		presscore_config_populate_footer_theme_options();
		presscore_config_logo_options();
		presscore_config_populate_buttons_options();
		presscore_config_get_theme_option();

		/////////////////////////////
		// config for post types //
		/////////////////////////////

		$cur_post_type = get_post_type( $post_id );
		switch ( $cur_post_type ) {

			case 'page':

				$config->set( 'page_id', $post_id );
				switch ( $config->get('template') ) {

					case 'portfolio' :
						presscore_congif_populate_portfolio_vars();
						break;

					case 'albums' :
						presscore_congif_populate_albums_vars();
						break;

					case 'media' :
						presscore_congif_populate_media_vars();
						break;

					case 'blog' :
						presscore_congif_populate_blog_vars();
						break;

					case 'team' :
						presscore_congif_populate_team_vars();
						break;

					case 'testimonials' :
						presscore_congif_populate_testimonials_vars();
						break;

				}

				break;

			case 'post':
				presscore_congif_populate_single_post_vars();
				break;

			case 'dt_portfolio':
				presscore_congif_populate_single_portfolio_vars();
				break;

			case 'dt_gallery':
				presscore_congif_populate_single_album_vars();
				break;

			case 'attachment':
				presscore_congif_populate_single_attachment_vars();
				break;

		}

		do_action( 'presscore_config_base_init' );
	}

endif;

/////////////
// ARCHIVE //
/////////////

if ( ! function_exists( 'presscore_config_populate_archive_vars' ) ) :

	function presscore_config_populate_archive_vars() {

		presscore_config_populate_footer_theme_options();
		presscore_config_populate_header_options();
		presscore_config_logo_options();
		presscore_config_populate_buttons_options();
		presscore_config_get_theme_option();

		$config = presscore_get_config();

		$config->set( 'logo.header.regular', of_get_option( 'header-logo_regular', array('', 0) ) );
		$config->set( 'logo.header.hd', of_get_option( 'header-logo_hd', array('', 0) ) );

		$config->set( 'show_titles', true );
		$config->set( 'show_excerpts', true );

		$config->set( 'show_links', true );
		$config->set( 'show_details', true );
		$config->set( 'show_zoom', true );

		$config->set( 'post.meta.fields.date', true );
		$config->set( 'post.meta.fields.categories', true );
		$config->set( 'post.meta.fields.comments', true );
		$config->set( 'post.meta.fields.author', true );
		$config->set( 'post.meta.fields.media_number', true );

		$config->set( 'post.preview.width.min', 320 );
		$config->set( 'post.preview.mini_images.enabled', true );
		$config->set( 'post.preview.load.effect', 'fade_in' );
		$config->set( 'post.preview.background.enabled', true );
		$config->set( 'post.preview.background.style', 'fullwidth' );
		$config->set( 'post.preview.description.alignment', 'left' );
		$config->set( 'post.preview.description.style', 'under_image' );

		$config->set( 'post.preview.hover.animation', 'fade' );
		$config->set( 'post.preview.hover.color', 'accent' );
		$config->set( 'post.preview.hover.content.visibility', 'on_hoover' );

		$config->set( 'post.fancy_date.enabled', false );

		$config->set( 'template.columns.number', 3 );
		$config->set( 'load_style', 'default' );
		$config->set( 'image_layout', 'original' );
		$config->set( 'all_the_same_width', true );
		$config->set( 'item_padding', 10 );

		if ( is_home() ) {
			$config->set( 'sidebar_position', 'right' );
			$config->set( 'footer_show', true );
		} else {
			$config->set( 'sidebar_position', 'disabled' );
		}

	}

endif;

/////////////////
// SINGLE POST //
/////////////////

if ( ! function_exists( 'presscore_congif_populate_single_post_vars' ) ) :

	function presscore_congif_populate_single_post_vars() {
		$config = Presscore_Config::get_instance();

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// general meta switch
		if ( of_get_option( 'general-blog_meta_on', 1 ) ) {

			// date
			$config->set( 'post.meta.fields.date', of_get_option( 'general-blog_meta_date', 1 ) );

			// categories
			$config->set( 'post.meta.fields.categories', of_get_option( 'general-blog_meta_categories', 1 ) );

			// comments
			$config->set( 'post.meta.fields.comments', of_get_option( 'general-blog_meta_comments', 1 ) );

			// author
			$config->set( 'post.meta.fields.author', of_get_option( 'general-blog_meta_author', 1 ) );

			// tags
			$config->set( 'post.meta.fields.tags', of_get_option( 'general-blog_meta_tags', 1 ) );

		} else {

			// turn off all
			$config->set( 'post.meta.fields.date', 0 );
			$config->set( 'post.meta.fields.categories',0 );
			$config->set( 'post.meta.fields.comments', 0 );
			$config->set( 'post.meta.fields.author', 0 );

		}

		///////////////////////////////
		// post navigation buttons //
		///////////////////////////////

		$config->set( 'post.navigation.arrows.enabled', of_get_option( 'general-next_prev_in_blog', 1 ) );
		$config->set( 'post.navigation.back_button.enabled', of_get_option( 'general-show_back_button_in_post', 0 ) );
		$config->set( 'post.navigation.back_button.target_page_id', of_get_option( 'general-post_back_button_target_page_id', 0 ) );

		$config->set( 'post.author_block', of_get_option( 'general-show_author_in_blog', true ) );
	}

endif;

//////////////////////
// SINGLE PORTFOLIO //
//////////////////////

if ( ! function_exists( 'presscore_congif_populate_single_portfolio_vars' ) ) :

	function presscore_congif_populate_single_portfolio_vars() {

		$config = Presscore_Config::get_instance();

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// general meta switch
		if ( of_get_option( 'general-portfolio_meta_on', 1 ) ) {

			// date
			$config->set( 'post.meta.fields.date', of_get_option( 'general-portfolio_meta_date', 1 ) );

			// categories
			$config->set( 'post.meta.fields.categories', of_get_option( 'general-portfolio_meta_categories', 1 ) );

			// comments
			$config->set( 'post.meta.fields.comments', of_get_option( 'general-portfolio_meta_comments', 1 ) );

			// author
			$config->set( 'post.meta.fields.author', of_get_option( 'general-portfolio_meta_author', 1 ) );

		} else {

			// turn off all
			$config->set( 'post.meta.fields.date', 0 );
			$config->set( 'post.meta.fields.categories',0 );
			$config->set( 'post.meta.fields.comments', 0 );
			$config->set( 'post.meta.fields.author', 0 );

		}

		///////////////////////////////
		// post navigation buttons //
		///////////////////////////////

		$config->set( 'post.navigation.arrows.enabled', of_get_option( 'general-next_prev_in_portfolio', 1 ) );
		$config->set( 'post.navigation.back_button.enabled', of_get_option( 'general-show_back_button_in_project', 0 ) );
		$config->set( 'post.navigation.back_button.target_page_id', of_get_option( 'general-project_back_button_target_page_id', 0 ) );

		$post_id = $config->get( 'post_id' );

		/////////////////////////////
		// project media library //
		/////////////////////////////

		$prefix = '_dt_project_media_';

		$config->set( 'post.media.library', get_post_meta( $post_id, "{$prefix}items", true ), array() );

		/////////////////////////////
		// project media layout //
		/////////////////////////////

		$prefix = '_dt_project_media_options_';

		$config->set( 'post.media.layout', get_post_meta( $post_id, "{$prefix}layout", true ), 'left' );

		////////////////////////
		// floating content //
		////////////////////////

		$config->set( 'post.content.floating.enabled', get_post_meta( $post_id, "{$prefix}enable_floationg_content", true ), false );

		//////////////////
		// media type //
		//////////////////

		$config->set( 'post.media.type', get_post_meta( $post_id, "{$prefix}type", true ), 'slideshow' );

		////////////////////////////////////////
		// project media slider proportions //
		////////////////////////////////////////

		$config->set( 'post.media.slider.proportion', get_post_meta( $post_id, "{$prefix}slider_proportions", true ), array( 'width' => '', 'height' => '' ) );

		///////////////////////////////
		// project media gallery  //
		///////////////////////////////

		$config->set( 'post.media.gallery.columns', get_post_meta( $post_id, "{$prefix}gallery_columns", true ), 4 );
		$config->set( 'post.media.gallery.first_iamge_is_large', get_post_meta( $post_id, "{$prefix}gallery_make_first_big", true ), true );

		/////////////////////
		// related posts //
		/////////////////////

		$prefix = '_dt_project_options_';

		$config->set( 'post.related_posts.enabled', of_get_option( 'general-show_rel_projects', false ) );

		$config->set( 'post.related_posts.query.mode', get_post_meta( $post_id, "{$prefix}related_mode", true ) );
		$config->set( 'post.related_posts.query.terms', get_post_meta( $post_id, "{$prefix}related_categories", true ) );
		$config->set( 'post.related_posts.query.posts_per_page', of_get_option( 'general-rel_projects_max', 12 ) );

		$config->set( 'post.related_posts.title', of_get_option( 'general-rel_projects_head_title', '' ) );

		$config->set( 'post.related_posts.show.title', of_get_option( 'general-rel_projects_title', true ) );
		$config->set( 'post.related_posts.show.description', of_get_option( 'general-rel_projects_excerpt', true ) );
		$config->set( 'post.related_posts.show.link', of_get_option( 'general-rel_projects_link', true ) );
		$config->set( 'post.related_posts.show.zoom', of_get_option( 'general-rel_projects_zoom', true ) );
		$config->set( 'post.related_posts.show.details_link', of_get_option( 'general-rel_projects_details', true ) );

		// related posts meta

		// date
		$config->set( 'post.related_posts.meta.fields.date', of_get_option( 'general-rel_projects_info_date', 1 ) );

		// categories
		$config->set( 'post.related_posts.meta.fields.categories', of_get_option( 'general-rel_projects_info_categories', 1 ) );

		// comments
		$config->set( 'post.related_posts.meta.fields.comments', of_get_option( 'general-rel_projects_info_comments', 1 ) );

		// author
		$config->set( 'post.related_posts.meta.fields.author', of_get_option( 'general-rel_projects_info_author', 1 ) );

		// related posts with sidebar
		if ( 'disabled' != $config->get( 'sidebar_position' ) ) {
			$config->set( 'post.related_posts.height', of_get_option( 'general-rel_projects_height', 190 ) );

			$related_posts_width_mode = of_get_option('general-rel_projects_width_style');
			$config->set( 'post.related_posts.width.mode', $related_posts_width_mode );
			$config->set( 'post.related_posts.width', 'fixed' == $related_posts_width_mode ? of_get_option( 'general-rel_projects_width' ) : null );

		// fullwidth related posts
		} else {
			$config->set( 'post.related_posts.height', of_get_option( 'general-rel_projects_fullwidth_height', 270 ) );

			$related_posts_width_mode = of_get_option('general-rel_projects_fullwidth_width_style');
			$config->set( 'post.related_posts.width.mode', $related_posts_width_mode );
			$config->set( 'post.related_posts.width', 'fixed' == $related_posts_width_mode ? of_get_option( 'general-rel_projects_fullwidth_width' ) : null );
		}

		////////////////////
		// project link //
		////////////////////

		$config->set( 'post.buttons.link.enabled', get_post_meta( $post_id, "{$prefix}show_link", true ) );
		$config->set( 'post.buttons.link.title', get_post_meta( $post_id, "{$prefix}link_name", true ) );
		$config->set( 'post.buttons.link.url', get_post_meta( $post_id, "{$prefix}link", true ) );
		$config->set( 'post.buttons.link.target_blank', get_post_meta( $post_id, "{$prefix}link_target", true ) );

		//////////////////////////////////////////
		// hide featured image in single post //
		//////////////////////////////////////////

		$config->set( 'post.media.featured_image.enabled', !get_post_meta( $post_id, "{$prefix}hide_thumbnail", true ), true );

		///////////////////////////////////////
		// open images in lightbox //
		///////////////////////////////////////

		$config->set( 'post.media.lightbox.enabled', get_post_meta( $post_id, "{$prefix}open_thumbnail_in_lightbox", true ), false );
	}

endif;

////////////////////
// SINGLE ALBUM //
////////////////////

if ( ! function_exists( 'presscore_congif_populate_single_album_vars' ) ) :

	function presscore_congif_populate_single_album_vars() {

		$config = Presscore_Config::get_instance();

		$config->set( 'post.media.lightbox.enabled', true );

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// general meta switch
		if ( of_get_option( 'general-album_meta_on', true ) ) {

			// date
			$config->set( 'post.meta.fields.date', of_get_option( 'general-album_meta_date', true ) );

			// categories
			$config->set( 'post.meta.fields.categories', of_get_option( 'general-album_meta_categories', true ) );

			// comments
			$config->set( 'post.meta.fields.comments', of_get_option( 'general-album_meta_comments', true ) );

			// author
			$config->set( 'post.meta.fields.author', of_get_option( 'general-album_meta_author', true ) );

		} else {

			// turn off all
			$config->set( 'post.meta.fields.date', 0 );
			$config->set( 'post.meta.fields.categories',0 );
			$config->set( 'post.meta.fields.comments', 0 );
			$config->set( 'post.meta.fields.author', 0 );

		}

		///////////////////////////////
		// post navigation buttons //
		///////////////////////////////

		$config->set( 'post.navigation.arrows.enabled', of_get_option( 'general-next_prev_in_album', true ) );
		$config->set( 'post.navigation.back_button.enabled', of_get_option( 'general-show_back_button_in_album', false ) );
		$config->set( 'post.navigation.back_button.target_page_id', of_get_option( 'general-album_back_button_target_page_id', 0 ) );

		$post_id = $config->get( 'post_id' );

		///////////////////////////
		// album media library //
		///////////////////////////

		$prefix = '_dt_album_media_';

		$config->set( 'post.media.library', get_post_meta( $post_id, "{$prefix}items", true ), array() );

		//////////////////
		// media type //
		//////////////////

		$prefix = '_dt_album_options_';

		$post_media_type = get_post_meta( $post_id, "{$prefix}type", true );
		$config->set( 'post.media.type', $post_media_type, 'slideshow' );

		switch ( $post_media_type ) {
			case 'photo_scroller':
				$config->set( 'header_background', 'normal' );
				$config->set( 'page_title.enabled', false );
				$config->set( 'page_title.breadcrumbs.enabled', false );
				break;

			case 'masonry_grid':
				$config->set( 'post.preview.description.style', 'disabled' );
				$config->set( 'show_excerpts', true );
				$config->set( 'show_titles', true );
				$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}mg_load_effect", true ), 'fade_in' );
				$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}mg_target_width", true ), 370 );
				$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}mg_columns_number", true ), 3 );
				$config->set( 'layout', get_post_meta( $post_id, "{$prefix}mg_layout", true ), 'masonry' );
				$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}mg_item_padding", true ), 20 );
				$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}mg_image_layout", true ), 'original' );
				$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}mg_thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );
				$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}mg_full_width", true ), false );
				break;

			case 'jgrid':
				$config->set( 'justified_grid', true );
				$config->set( 'layout', 'grid' );
				$config->set( 'show_excerpts', true );
				$config->set( 'show_titles', true );
				$config->set( 'post.preview.description.style', 'disabled' );
				$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}jg_load_effect", true ), 'fade_in' );
				$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}jg_columns_number", true ), 3 );
				$config->set( 'target_height', get_post_meta( $post_id, "{$prefix}jg_target_height", true ), 250 );
				$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}jg_item_padding", true ), 20 );
				$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}jg_image_layout", true ), 'original' );
				$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}jg_thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );
				$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}jg_full_width", true ), false );
				$config->set( 'hide_last_row', get_post_meta( $post_id, "{$prefix}jg_hide_last_row", true ), false );
				break;
		}

		//////////////////////////////////////
		// album media slider proportions //
		//////////////////////////////////////

		$config->set( 'post.media.slider.proportion', get_post_meta( $post_id, "{$prefix}slider_proportions", true ), array( 'width' => '', 'height' => '' ) );

		////////////////////////////
		// album media gallery  //
		////////////////////////////

		$config->set( 'post.media.gallery.columns', get_post_meta( $post_id, "{$prefix}gallery_columns", true ), 4 );
		$config->set( 'post.media.gallery.first_iamge_is_large', get_post_meta( $post_id, "{$prefix}gallery_make_first_big", true ), true );

		//////////////////////////////////////////
		// hide featured image in single post //
		//////////////////////////////////////////

		$config->set( 'post.media.featured_image.enabled', !get_post_meta( $post_id, "{$prefix}exclude_featured_image", true ), true );

		///////////////////////////////
		// Phoso Scroller settings //
		///////////////////////////////

		$config->set( 'post.media.photo_scroller.layout', get_post_meta( $post_id, "{$prefix}photo_scroller_layout", true ), 'fullscreen' );
		$config->set( 'post.media.photo_scroller.background.color', get_post_meta( $post_id, "{$prefix}photo_scroller_bg_color", true ), '#000000' );
		$config->set( 'post.media.photo_scroller.overlay.enabled', get_post_meta( $post_id, "{$prefix}photo_scroller_overlay", true ), true );

		$config->set( 'post.media.photo_scroller.padding.top', get_post_meta( $post_id, "{$prefix}photo_scroller_top_padding", true ), 0 );
		$config->set( 'post.media.photo_scroller.padding.bottom', get_post_meta( $post_id, "{$prefix}photo_scroller_bottom_padding", true ), 0 );
		$config->set( 'post.media.photo_scroller.padding.side', get_post_meta( $post_id, "{$prefix}photo_scroller_side_paddings", true ), 0 );

		$config->set( 'post.media.photo_scroller.inactive.opacity', get_post_meta( $post_id, "{$prefix}photo_scroller_inactive_opacity", true ), 15 );
		$config->set( 'post.media.photo_scroller.thumbnails.visibility', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_visibility", true ), 'show' );

		$config->set( 'post.media.photo_scroller.autoplay.mode', get_post_meta( $post_id, "{$prefix}photo_scroller_autoplay", true ), 'play' );
		$config->set( 'post.media.photo_scroller.autoplay.speed', get_post_meta( $post_id, "{$prefix}photo_scroller_autoplay_speed", true ), 4000 );

		$config->set( 'post.media.photo_scroller.thumbnail.width', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_width", true ), 0 );
		$config->set( 'post.media.photo_scroller.thumbnail.height', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_height", true ), 85 );

		$config->set( 'post.media.photo_scroller.behavior.landscape.width.max', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_max_width", true ), '100' );
		$config->set( 'post.media.photo_scroller.behavior.landscape.width.min', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_min_width", true ), '0' );
		$config->set( 'post.media.photo_scroller.behavior.landscape.fill.desktop', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_fill_dt", true ), 'fit' );
		$config->set( 'post.media.photo_scroller.behavior.landscape.fill.mobile', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_fill_mob", true ), 'fit' );

		$config->set( 'post.media.photo_scroller.behavior.portrait.width.max', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_max_width", true ), '100' );
		$config->set( 'post.media.photo_scroller.behavior.portrait.width.min', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_min_width", true ), '0' );
		$config->set( 'post.media.photo_scroller.behavior.portrait.fill.desktop', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_fill_dt", true ), 'fit' );
		$config->set( 'post.media.photo_scroller.behavior.portrait.fill.mobile', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_fill_mob", true ), 'fit' );

	}

endif;

////////////////////////
// PORTFOLIO TEMPLATE //
////////////////////////

if ( ! function_exists( 'presscore_congif_populate_portfolio_vars' ) ) :

	function presscore_congif_populate_portfolio_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );
		$prefix = '_dt_portfolio_options_';

		// populate options

		////////////////////
		// posts filter //
		////////////////////

		// for categorizer compatibility
		if ( !$config->get('order') ) {
			$config->set( 'order', get_post_meta( $post_id, "{$prefix}order", true ) );
		}

		if ( !$config->get('orderby') ) {
			$config->set( 'orderby', get_post_meta( $post_id, "{$prefix}orderby", true ) );
		}

		if ( !$config->get('display') ) {
			$config->set( 'display', get_post_meta( $post_id, "_dt_portfolio_display", true ) );
		}

		$config->set( 'template.posts_filter.terms.enabled', get_post_meta( $post_id, "{$prefix}show_filter", true ) );
		$config->set( 'template.posts_filter.orderby.enabled', get_post_meta( $post_id, "{$prefix}show_orderby", true ) );
		$config->set( 'template.posts_filter.order.enabled', get_post_meta( $post_id, "{$prefix}show_order", true ) );

		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );

		//////////////
		// layout //
		//////////////

		$template_name = dt_get_template_name( $post_id, true );
		switch ( $template_name ) {
			case 'template-portfolio-masonry.php' :
				$config->set( 'layout', get_post_meta( $post_id, "{$prefix}masonry_layout", true ) );
				break;

			default:
				$config->set( 'layout', get_post_meta( $post_id, "{$prefix}list_layout", true ) );
		}

		//////////////
		// images //
		//////////////

		$config->set( 'all_the_same_width', get_post_meta( $post_id, "{$prefix}posts_same_width", true ) );

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ) );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ) );

		/////////////////////////
		// titles & excerpts //
		/////////////////////////

		$config->set( 'show_titles', get_post_meta( $post_id, "{$prefix}show_titles", true ) );
		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ) );

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// date
		$config->set( 'post.meta.fields.date', get_post_meta( $post_id, "{$prefix}show_date_in_post_meta", true ) );

		// categories
		$config->set( 'post.meta.fields.categories', get_post_meta( $post_id, "{$prefix}show_categories_in_post_meta", true ) );

		// comments
		$config->set( 'post.meta.fields.comments', get_post_meta( $post_id, "{$prefix}show_comments_in_post_meta", true ) );

		// author
		$config->set( 'post.meta.fields.author', get_post_meta( $post_id, "{$prefix}show_author_in_post_meta", true ) );

		//////////////////////////
		// functional icons //
		//////////////////////////

		$config->set( 'show_links', get_post_meta( $post_id, "{$prefix}show_links", true ) );
		$config->set( 'show_details', get_post_meta( $post_id, "{$prefix}show_details", true ) );
		$config->set( 'show_zoom', get_post_meta( $post_id, "{$prefix}show_zoom", true ) );

		/////////////////
		// paginator //
		/////////////////

		$config->set( 'show_all_pages', get_post_meta( $post_id, "{$prefix}show_all_pages", true ) );

		/////////////
		// hover //
		/////////////

		// hover section based on template
		if ( 'template-portfolio-masonry.php' == $template_name ) {

			// preview content
			$config->set( 'post.preview.description.style', get_post_meta( $post_id, "{$prefix}description", true ), 'under_image' );
			$config->set( 'post.preview.description.alignment', get_post_meta( $post_id, "{$prefix}post_content_alignment", true ) );

			// preview hover
			$config->set( 'post.preview.hover.animation', get_post_meta( $post_id, "{$prefix}hover_animation", true ), 'fade' );
			$config->set( 'post.preview.hover.color', get_post_meta( $post_id, "{$prefix}hover_bg_color", true ), 'accent' );
			$config->set( 'post.preview.hover.content.visibility', get_post_meta( $post_id, "{$prefix}hover_content_visibility", true ), 'on_hoover' );

			// preview background
			if ( 'under_image' == $config->get('post.preview.description.style') ) {
				$background_under_posts = get_post_meta( $post_id, "{$prefix}bg_under_masonry_posts", true );

				$config->set( 'post.preview.background.enabled', ! in_array( $background_under_posts, array( 'disabled', '' ) ) );
				$config->set( 'post.preview.background.style', $background_under_posts, false );

			} else {
				$config->set( 'post.preview.background.enabled', false );
				$config->set( 'post.preview.background.style', false );

			}

			// do not show preview details button
			$config->set( 'post.preview.buttons.details.enabled', false );

			// column minimum width
			$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );

			// desired columns number
			$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );

			$load_style = get_post_meta( $post_id, "{$prefix}load_style", true );
			$load_style = $load_style ? $load_style : 'default';
			$config->set( 'load_style', $load_style );

			$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		} else if ( 'template-portfolio-jgrid.php' == $template_name ) {

			// preview content
			$config->set( 'post.preview.description.style', get_post_meta( $post_id, "{$prefix}jgrid_description", true ), 'on_hoover_centered' );

			// $config->set( 'under_image_buttons', get_post_meta( $post_id, "{$prefix}jgrid_under_image_buttons", true ), 'under_image' );

			// preview hover
			$config->set( 'post.preview.hover.animation', get_post_meta( $post_id, "{$prefix}jgrid_hover_animation", true ), 'fade' );
			$config->set( 'post.preview.hover.color', get_post_meta( $post_id, "{$prefix}jgrid_hover_bg_color", true ), 'accent' );
			$config->set( 'post.preview.hover.content.visibility', get_post_meta( $post_id, "{$prefix}jgrid_hover_content_visibility", true ), 'on_hoover' );

			// do not show preview details button
			$config->set( 'post.preview.buttons.details.enabled', false );

			// do not show preview background
			$config->set( 'post.preview.background.enabled', false );
			$config->set( 'post.preview.background.style', false );

			// template settings
			$config->set( 'justified_grid', true );
			$config->set( 'layout', 'grid' );
			$config->set( 'all_the_same_width', true );

			// row height
			$config->set( 'target_height', get_post_meta( $post_id, "{$prefix}target_height", true ), 250 );

			$load_style = get_post_meta( $post_id, "{$prefix}load_style", true );
			$load_style = $load_style ? $load_style : 'default';
			$hide_last_row = ('default' == $load_style) ? get_post_meta( $post_id, "{$prefix}hide_last_row", true ) : false;

			$config->set( 'load_style', $load_style );
			$config->set( 'hide_last_row', $hide_last_row );

			$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		} else if ( 'template-portfolio-list.php' == $template_name ) {

			$config->set( 'post.preview.hover.color', get_post_meta( $post_id, "{$prefix}list_hover_bg_color", true ), 'accent' );
			$config->set( 'post.preview.background.enabled', get_post_meta( $post_id, "{$prefix}bg_under_list_posts", true ), false );
			$config->set( 'post.preview.background.style', 'with_paddings' );
			$config->set( 'post.preview.buttons.details.enabled', get_post_meta( $post_id, "{$prefix}show_details_buttons", true ), true );

			$config->set( 'load_style', 'default' );
			$config->set( 'post.preview.load.effect', 'fade_in' );
		}

		///////////////
		// content //
		///////////////

		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ) );

		/////////////////////
		// posts preview //
		/////////////////////

		$current_layout_type = presscore_get_current_layout_type();
		if ( 'masonry' == $current_layout_type ) {

		} else if ( 'list' == $current_layout_type ) {

		}

		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );

		$config->set( 'post.preview.media.width', get_post_meta( $post_id, "{$prefix}thumb_width", true ), 30 );

	}

endif;

/////////////////////
// ALBUMS TEMPLATE //
/////////////////////

if ( ! function_exists( 'presscore_congif_populate_albums_vars' ) ) :

	function presscore_congif_populate_albums_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		////////////////////
		// posts filter //
		////////////////////
		$prefix = '_dt_albums_options_';

		// for categorizer compatibility
		if ( !$config->get('order') ) {
			$config->set( 'order', get_post_meta( $post_id, "{$prefix}order", true ) );
		}

		if ( !$config->get('orderby') ) {
			$config->set( 'orderby', get_post_meta( $post_id, "{$prefix}orderby", true ) );
		}

		if ( !$config->get('display') ) {
			$config->set( 'display', get_post_meta( $post_id, "_dt_albums_display", true ) );
		}

		$config->set( 'template.posts_filter.terms.enabled', get_post_meta( $post_id, "{$prefix}show_filter", true ), true );
		$config->set( 'template.posts_filter.orderby.enabled', get_post_meta( $post_id, "{$prefix}show_orderby", true ), true );
		$config->set( 'template.posts_filter.order.enabled', get_post_meta( $post_id, "{$prefix}show_order", true ), true );

		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ), '' );

		//////////////
		// layout //
		//////////////

		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );

		//////////////
		// images //
		//////////////

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ), 'original' );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );
		$config->set( 'all_the_same_width', get_post_meta( $post_id, "{$prefix}posts_same_width", true ), false );
		$config->set( 'post.preview.mini_images.enabled', get_post_meta( $post_id, "{$prefix}show_round_miniatures", true ), true );

		/////////////////////////
		// titles & excerpts //
		/////////////////////////

		$config->set( 'show_titles', get_post_meta( $post_id, "{$prefix}show_titles", true ), true );
		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ), true );

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// date
		$config->set( 'post.meta.fields.date', get_post_meta( $post_id, "{$prefix}show_date_in_post_meta", true ), true );

		// categories
		$config->set( 'post.meta.fields.categories', get_post_meta( $post_id, "{$prefix}show_categories_in_post_meta", true ), true );

		// comments
		$config->set( 'post.meta.fields.comments', get_post_meta( $post_id, "{$prefix}show_comments_in_post_meta", true ), true );

		// author
		$config->set( 'post.meta.fields.author', get_post_meta( $post_id, "{$prefix}show_author_in_post_meta", true ), true );

		// image & video number
		$config->set( 'post.meta.fields.media_number', get_post_meta( $post_id, "{$prefix}show_numbers_in_post_meta", true ), true );

		/////////////////
		// paginator //
		/////////////////

		$config->set( 'show_all_pages', get_post_meta( $post_id, "{$prefix}show_all_pages", true ), false );

		////////////////
		// loading  //
		///////////////

		$load_style = get_post_meta( $post_id, "{$prefix}load_style", true );
		$load_style = $load_style ? $load_style : 'default';
		$hide_last_row = ('default' == $load_style) ? get_post_meta( $post_id, "{$prefix}hide_last_row", true ) : false;

		$config->set( 'load_style', $load_style );
		$config->set( 'hide_last_row', $hide_last_row );

		$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		$template_name = dt_get_template_name( $post_id, true );
		$is_justified_grid = ( 'template-albums-jgrid.php' == $template_name );
		$config->set( 'justified_grid', $is_justified_grid );

		if ( ! $is_justified_grid ) {

			// post description
			$config->set( 'post.preview.description.style', get_post_meta( $post_id, "{$prefix}description", true ), 'under_image' );
			$config->set( 'post.preview.description.alignment', get_post_meta( $post_id, "{$prefix}post_content_alignment", true ), 'left' );

			// preview background
			if ( 'under_image' == $config->get('post.preview.description.style') ) {
				$background_under_posts = get_post_meta( $post_id, "{$prefix}bg_under_masonry_posts", true );

				$config->set( 'post.preview.background.enabled', ! in_array( $background_under_posts, array( 'disabled', '' ) ) );
				$config->set( 'post.preview.background.style', $background_under_posts, false );

			} else {
				$config->set( 'post.preview.background.enabled', false );
				$config->set( 'post.preview.background.style', false );

			}

			// hover settings
			$config->set( 'post.preview.hover.animation', get_post_meta( $post_id, "{$prefix}hover_animation", true ), 'fade' );
			$config->set( 'post.preview.hover.color', get_post_meta( $post_id, "{$prefix}hover_bg_color", true ), 'accent' );
			$config->set( 'post.preview.hover.content.visibility', get_post_meta( $post_id, "{$prefix}hover_content_visibility", true ), 'on_hoover' );

			// specific settings
			$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
			$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );
			$config->set( 'layout', get_post_meta( $post_id, "{$prefix}layout", true ) );

		} else {

			// post description
			$config->set( 'post.preview.description.style', get_post_meta( $post_id, "{$prefix}jgrid_description", true ), 'on_hoover_centered' );

			// hover settings
			$config->set( 'post.preview.hover.animation', get_post_meta( $post_id, "{$prefix}jgrid_hover_animation", true ), 'fade' );
			$config->set( 'post.preview.hover.color', get_post_meta( $post_id, "{$prefix}jgrid_hover_bg_color", true ), 'accent' );
			$config->set( 'post.preview.hover.content.visibility', get_post_meta( $post_id, "{$prefix}jgrid_hover_content_visibility", true ), 'on_hoover' );

			// specific settings
			$config->set( 'target_height', get_post_meta( $post_id, "{$prefix}target_height", true ), 250 );
			$config->set( 'all_the_same_width', true );
			$config->set( 'layout', 'grid' );

		}

		///////////////
		// content //
		///////////////

		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ), false );

	}

endif;

/////////////////////
// PHOTOS TEMPLATE //
/////////////////////

if ( ! function_exists( 'presscore_congif_populate_media_vars' ) ) :

	function presscore_congif_populate_media_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		////////////////////
		// posts filter //
		////////////////////

		$prefix = '_dt_media_options_';

		$config->set( 'order', get_post_meta( $post_id, "{$prefix}order", true ) );
		$config->set( 'orderby', get_post_meta( $post_id, "{$prefix}orderby", true ) );
		$config->set( 'display', get_post_meta( $post_id, "_dt_albums_media_display", true ) );

		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );

		//////////////
		// layout //
		//////////////

		$config->set( 'layout', get_post_meta( $post_id, "{$prefix}layout", true ), 'masonry' );
		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );

		//////////////
		// images //
		//////////////

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ), 'original' );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );

		/////////////////////////
		// titles & excerpts //
		/////////////////////////

		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ), true );
		$config->set( 'show_titles', get_post_meta( $post_id, "{$prefix}show_titles", true ), true );

		//////////////////////////
		// is content visible //
		//////////////////////////

		$config->set( 'post.preview.content.visible', $config->get( 'show_titles' ) || $config->get( 'show_excerpts' ) );

		//////////////////
		// load style //
		//////////////////

		$load_style = get_post_meta( $post_id, "{$prefix}load_style", true );
		$load_style = $load_style ? $load_style : 'default';
		$hide_last_row = ( 'default' == $load_style ) ? get_post_meta( $post_id, "{$prefix}hide_last_row", true ) : false;

		$config->set( 'load_style', $load_style );
		$config->set( 'hide_last_row', $hide_last_row, false );

		$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		/////////////////
		// paginator //
		/////////////////

		$config->set( 'show_all_pages', get_post_meta( $post_id, "{$prefix}show_all_pages", true ), false );

		$template_name = dt_get_template_name( $post_id, true );

		if ( 'template-media.php' == $template_name ) {
			$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
			$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );

			// preview description under image or disabled
			$config->set( 'post.preview.description.style', ( $config->get( 'post.preview.content.visible' ) ? 'under_image' : 'disabled' ) );

		} else if ( 'template-media-jgrid.php' == $template_name ) {
			$config->set( 'justified_grid', true );
			$config->set( 'layout', 'grid' );
			$config->set( 'target_height', get_post_meta( $post_id, "{$prefix}target_height", true ), 250 );

			// preview description on hover centered
			$config->set( 'post.preview.description.style', 'on_hoover_centered' );

		}

		///////////////
		// content //
		///////////////

		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ), false );

	}

endif;

///////////////////
// BLOG TEMPLATE //
///////////////////

if ( ! function_exists( 'presscore_congif_populate_blog_vars' ) ) :

	function presscore_congif_populate_blog_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		$prefix = '_dt_blog_options_';

		// populate options
		$config->set( 'display', get_post_meta( $post_id, "_dt_blog_display", true ) );
		$config->set( 'order', get_post_meta( $post_id, "{$prefix}order", true ), 'DESC' );
		$config->set( 'orderby', get_post_meta( $post_id, "{$prefix}orderby", true ), 'date' );

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ) );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ) );
		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );
		$config->set( 'all_the_same_width', get_post_meta( $post_id, "{$prefix}posts_same_width", true ) );
		$config->set( 'show_all_pages', get_post_meta( $post_id, "{$prefix}show_all_pages", true ) );
		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ) );
		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ), true );
		$config->set( 'show_details', get_post_meta( $post_id, "{$prefix}show_details", true ), true );

		//////////////////
		// Load style //
		//////////////////

		$config->set( 'load_style', get_post_meta( $post_id, "{$prefix}load_style", true ), 'default' );
		$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// date
		$config->set( 'post.meta.fields.date', get_post_meta( $post_id, "{$prefix}show_date_in_post_meta", true ), true );

		// categories
		$config->set( 'post.meta.fields.categories', get_post_meta( $post_id, "{$prefix}show_categories_in_post_meta", true ), true );

		// comments
		$config->set( 'post.meta.fields.comments', get_post_meta( $post_id, "{$prefix}show_comments_in_post_meta", true ), true );

		// author
		$config->set( 'post.meta.fields.author', get_post_meta( $post_id, "{$prefix}show_author_in_post_meta", true ), true );

		///////////////////////////////////
		// template speciffic settings //
		///////////////////////////////////

		$current_layout_type = presscore_get_current_layout_type();
		if ( 'masonry' == $current_layout_type ) {
			$background_under_posts = get_post_meta( $post_id, "{$prefix}bg_under_masonry_posts", true );

			$config->set( 'post.preview.background.enabled', ! in_array( $background_under_posts, array( 'disabled', '' ) ) );
			$config->set( 'post.preview.background.style', $background_under_posts, false );

			$config->set( 'post.preview.description.alignment', get_post_meta( $post_id, "{$prefix}post_content_alignment", true ), 'left' );
			$config->set( 'post.preview.description.style', 'under_image' );

			$config->set( 'layout', get_post_meta( $post_id, "{$prefix}layout", true ), 'masonry' );

		} else if ( 'list' == $current_layout_type ) {
			$config->set( 'post.preview.background.enabled', get_post_meta( $post_id, "{$prefix}bg_under_list_posts", true ), false );
			$config->set( 'post.preview.media.width', get_post_meta( $post_id, "{$prefix}thumb_width", true ), 30 );

			$config->set( 'layout', get_post_meta( $post_id, "{$prefix}list_layout", true ), 'list' );

		}

		//////////////////
		// fancy date //
		//////////////////

		// enable fancy date
		$config->set( 'post.fancy_date.enabled', get_post_meta( $post_id, "{$prefix}enable_fancy_date", true ), true );

		/////////////////////
		// posts preview //
		/////////////////////

		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );
		$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
		$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );
	}

endif;

///////////////////
// TEAM TEMPLATE //
///////////////////

if ( ! function_exists( 'presscore_congif_populate_team_vars' ) ) :

	function presscore_congif_populate_team_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		$config->set( 'display', get_post_meta( $post_id, "_dt_team_display", true ) );

		$prefix = '_dt_team_options_';

		////////////////////
		// Image sizing //
		////////////////////

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ) );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ) );

		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ) );

		//////////////
		// Layout //
		//////////////

		$config->set( 'layout', get_post_meta( $post_id, "{$prefix}masonry_layout", true ) );
		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ) );

		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );
		$config->set( 'post.preview.description.style', 'under_image' );

		///////////////////
		// Items style //
		///////////////////

		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );
		$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
		$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );
		$config->set( 'post.preview.background.enabled', get_post_meta( $post_id, "{$prefix}bg_under_posts", true ) );
	}

endif;

///////////////////////////
// TESTIMONIALS TEMPLATE //
///////////////////////////

if ( ! function_exists( 'presscore_congif_populate_testimonials_vars' ) ) :

	function presscore_congif_populate_testimonials_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );
		$prefix = '_dt_testimonials_options_';

		$config->set( 'layout', get_post_meta( $post_id, "{$prefix}masonry_layout", true ), 'masonry' );
		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );
		$config->set( 'display', get_post_meta( $post_id, "_dt_testimonials_display", true ) );

		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ), false );
		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );
		$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
		$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );

		$config->set( 'post.preview.description.style', 'on_hoover_centered' );

		//////////////////////
		// loading effect //
		//////////////////////

		$config->set( 'load_style', get_post_meta( $post_id, "{$prefix}load_style", true ), 'default' );
		$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );
	}

endif;

/////////////////////
// HEADER SETTINGS //
/////////////////////

if ( ! function_exists( 'presscore_config_populate_header_options' ) ) :

	function presscore_config_populate_header_options() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		///////////////////////
		// Header settings //
		///////////////////////

		$header_layout = of_get_option( 'header-layout', 'left' );
		$config->set( 'header.layout', $header_layout, 'left' );
		$config->set( 'header.layout.left.fullwidth', of_get_option( 'header-left_layout_fullwidth' ) );
		$config->set( 'header.layout.center.menu.background.mode', of_get_option( 'header-center_menu_bg_mode' ) );
		$config->set( 'header.layout.classic.menu.background.mode', of_get_option( 'header-classic_menu_bg_mode' ) );
		$config->set( 'header.layout.side.menu.dropdown.style', of_get_option( 'header-side_menu_dropdown_style' ) );
		$config->set( 'header.layout.side.menu.position', of_get_option( 'header-side_position' ) );
		$config->set( 'header.layout.side.menu.visibility', of_get_option( 'header-side_menu_visibility' ) );
		$config->set( 'header.mobile.logo.first_switch', of_get_option( 'header-mobile-first_switch-logo', 'mobile' ), 'mobile' );
		$config->set( 'header.mobile.logo.second_switch', of_get_option( 'header-mobile-second_switch-logo', 'mobile' ), 'mobile' );

		$config->set( 'header.menu.submenu.parent_clickable', of_get_option( 'submenu-parent_clickable', true ), true );
		$config->set( 'header.decoration', of_get_option( 'header-decoration', 'shadow' ), 'shadow' );

		$prefix = '_dt_header_';

		$header_title = get_post_meta( $post_id, "{$prefix}title", true );
		$config->set( 'header_title', ( $header_title ? $header_title : null ), 'enabled' );

		if ( 'side' != $header_layout ) {

			switch ( $header_title ) {

				case 'fancy':
				case 'slideshow':
					$config->set( 'header_background', get_post_meta( $post_id, "{$prefix}background", true ), 'normal' );
					$config->set( 'header.transparent.background.opacity', get_post_meta( $post_id, "{$prefix}transparent_bg_opacity", true ), 50 );
					$config->set( 'header.transparent.background.color', get_post_meta( $post_id, "{$prefix}transparent_bg_color", true ), '#000000' );
					$config->set( 'header.transparent.background.style', get_post_meta( $post_id, "{$prefix}transparent_bg_style", true ), 'solid_background' );

					$config->set( 'header.transparent.menu_text.color.mode', get_post_meta( $post_id, "{$prefix}transparent_menu_text_color_mode", true ), 'light' );
					$config->set( 'header.transparent.menu_decoration.color.mode', get_post_meta( $post_id, "{$prefix}transparent_menu_hover_color_mode", true ), 'light' );
					$config->set( 'header.transparent.top_bar.color.mode', get_post_meta( $post_id, "{$prefix}transparent_menu_top_bar_color_mode", true ), 'light' );
					break;

				case 'disabled':
					break;

				case 'enabled':
				default:
					$config->set( 'header_background', of_get_option( 'header-background', 'normal' ), 'normal' );
					$config->set( 'header.transparent.background.opacity', of_get_option( 'header-transparent_bg_opacity', 50 ) );
					$config->set( 'header.transparent.background.color', of_get_option( 'header-transparent_bg_color', '#000000' ) );
					$config->set( 'header.transparent.background.style', of_get_option( 'header-style', 'solid_background' ) );

					$config->set( 'header.transparent.menu_text.color.mode', of_get_option( 'header-menu_text_color_mode', 'light' ) );
					$config->set( 'header.transparent.menu_decoration.color.mode', of_get_option( 'header-menu_hover_color_mode', 'light' ) );
					$config->set( 'header.transparent.top_bar.color.mode', of_get_option( 'header-menu_top_bar_color_mode', 'light' ) );
					break;
			}

		} else {
			$config->set( 'header_background', 'normal' );
		}

		//////////////////
		// Page title //
		//////////////////

		$config->set( 'page_title.enabled', of_get_option( 'general-show_titles' ) );
		$config->set( 'page_title.align', of_get_option( 'general-title_align' ) );
		$config->set( 'page_title.font.size', of_get_option( 'general-title_size' ) );
		$config->set( 'page_title.font.color', of_get_option( 'general-title_color' ) );
		$config->set( 'page_title.height', of_get_option( 'general-title_height' ) );

		$page_title_background_mode = of_get_option( 'general-title_bg_mode', 'content_line' );
		$config->set( 'page_title.background.mode', $page_title_background_mode );

		if ( 'background' == $page_title_background_mode ) {
			$config->set( 'page_title.background.color', of_get_option( 'general-title_bg_color' ) );

			$config->set( 'page_title.background.image', of_get_option( 'general-title_bg_image' ) );
			$config->set( 'page_title.background.fullscreen', of_get_option( 'general-title_bg_fullscreen' ) );
			$config->set( 'page_title.background.fixed', of_get_option( 'general-title_bg_fixed' ) );
			$config->set( 'page_title.background.parallax_speed', of_get_option( 'general-title_bg_parallax' ) );
		}

		$config->set( 'page_title.breadcrumbs.enabled', of_get_option( 'general-show_breadcrumbs' ) );
		$config->set( 'page_title.breadcrumbs.font.color', of_get_option( 'general-breadcrumbs_color' ) );
		$config->set( 'page_title.breadcrumbs.background.mode', of_get_option( 'general-breadcrumbs_bg_color' ) );

		////////////////////////////
		// Fancy header options //
		////////////////////////////

		$prefix = '_dt_fancy_header_';

		// title

		$config->set( 'fancy_header.title', get_post_meta( $post_id, "{$prefix}title", true ), '' );
		$config->set( 'fancy_header.title.mode', get_post_meta( $post_id, "{$prefix}title_mode", true ), 'custom' );
		$config->set( 'fancy_header.title.aligment', get_post_meta( $post_id, "{$prefix}title_aligment", true ), 'center' );
		$config->set( 'fancy_header.title.font.size', get_post_meta( $post_id, "{$prefix}title_size", true ), 'h1' );
		$config->set( 'fancy_header.title.color.mode', get_post_meta( $post_id, "{$prefix}title_color_mode", true ), 'color' );
		$config->set( 'fancy_header.title.color', get_post_meta( $post_id, "{$prefix}title_color", true ), '#ffffff' );

		// subtitle

		$config->set( 'fancy_header.subtitle', get_post_meta( $post_id, "{$prefix}subtitle", true ), '' );
		$config->set( 'fancy_header.subtitle.font.size', get_post_meta( $post_id, "{$prefix}subtitle_size", true ), 'h3' );
		$config->set( 'fancy_header.subtitle.color.mode', get_post_meta( $post_id, "{$prefix}subtitle_color_mode", true ), 'color' );
		$config->set( 'fancy_header.subtitle.color', get_post_meta( $post_id, "{$prefix}subtitle_color", true ), '#ffffff' );

		// background

		$config->set( 'fancy_header.bg.color', get_post_meta( $post_id, "{$prefix}bg_color", true ), '#000000' );
		$config->set( 'fancy_header.bg.image', get_post_meta( $post_id, "{$prefix}bg_image", true ) );
		$config->set( 'fancy_header.bg.repeat', get_post_meta( $post_id, "{$prefix}bg_repeat", true ) );
		$config->set( 'fancy_header.bg.position.x', get_post_meta( $post_id, "{$prefix}bg_position_x", true ) );
		$config->set( 'fancy_header.bg.position.y', get_post_meta( $post_id, "{$prefix}bg_position_y", true ) );
		$config->set( 'fancy_header.bg.fullscreen', get_post_meta( $post_id, "{$prefix}bg_fullscreen", true ) );

		$config->set( 'fancy_header.bg.fixed', get_post_meta( $post_id, "{$prefix}bg_fixed", true ) );
		$config->set( 'fancy_header.parallax.speed', floatval( get_post_meta( $post_id, "{$prefix}parallax_speed", true ) ) );

		// height

		$config->set( 'fancy_header.height', absint( get_post_meta( $post_id, "{$prefix}height", true ) ) );

		// breadcrumbs
		$config->set( 'fancy_header.breadcrumbs', get_post_meta( $post_id, "{$prefix}breadcrumbs", true ), 'enabled' );
		$config->set( 'fancy_header.breadcrumbs.text_color', get_post_meta( $post_id, "{$prefix}breadcrumbs_text_color", true ) );
		$config->set( 'fancy_header.breadcrumbs.bg_color', get_post_meta( $post_id, "{$prefix}breadcrumbs_bg_color", true ) );

		/////////////////////////
		// Slideshow options //
		/////////////////////////

		$prefix = '_dt_slideshow_';

		$config->set( 'slideshow_mode', get_post_meta( $post_id, "{$prefix}mode", true ) );

		$config->set( 'slideshow_sliders', get_post_meta( $post_id, "{$prefix}sliders", false ) );
		$config->set( 'slideshow_layout', get_post_meta( $post_id, "{$prefix}layout", true ) );

		$slider_prop = get_post_meta( $post_id, "{$prefix}slider_proportions", true );
		if ( empty($slider_prop) ) {
			$slider_prop = array( 'width' => 1200, 'height' => 500 );
		}
		$config->set( 'slideshow_slider_width', $slider_prop['width'] );
		$config->set( 'slideshow_slider_height', $slider_prop['height'] );

		$config->set( 'slideshow_slider_scaling', get_post_meta( $post_id, "{$prefix}scaling", true ) );

		$config->set( 'slideshow_3d_layout', get_post_meta( $post_id, "{$prefix}3d_layout", true ) );

		$slider_3d_prop = get_post_meta( $post_id, "{$prefix}3d_slider_proportions", true );
		if ( empty($slider_3d_prop) ) {
			$slider_3d_prop = array( 'width' => 500, 'height' => 500 );
		}
		$config->set( 'slideshow_3d_slider_width', $slider_3d_prop['width'] );
		$config->set( 'slideshow_3d_slider_height', $slider_3d_prop['height'] );

		$config->set( 'slideshow_autoslide_interval', get_post_meta( $post_id, "{$prefix}autoslide_interval", true ) );
		$config->set( 'slideshow_autoplay', get_post_meta( $post_id, "{$prefix}autoplay", true ) );
		$config->set( 'slideshow_hide_captions', get_post_meta( $post_id, "{$prefix}hide_captions", true ) );

		// $config->set( 'slideshow_slides_in_raw', get_post_meta( $post_id, "{$prefix}slides_in_raw", true ) );
		// $config->set( 'slideshow_slides_in_column', get_post_meta( $post_id, "{$prefix}slides_in_column", true ) );

		$config->set( 'slideshow_revolution_slider', get_post_meta( $post_id, "{$prefix}revolution_slider", true ) );

		$config->set( 'slideshow_layer_slider', get_post_meta( $post_id, "{$prefix}layer_slider", true ) );
		$config->set( 'slideshow_layer_bg_and_paddings', get_post_meta( $post_id, "{$prefix}layer_show_bg_and_paddings", true ) );

		//////////////////////
		// photo scroller //
		//////////////////////

		$config->set( 'slideshow.photo_scroller.layout', get_post_meta( $post_id, "{$prefix}photo_scroller_layout", true ), 'fullscreen' );
		$config->set( 'slideshow.photo_scroller.background.color', get_post_meta( $post_id, "{$prefix}photo_scroller_bg_color", true ), '#000000' );
		$config->set( 'slideshow.photo_scroller.overlay.enabled', get_post_meta( $post_id, "{$prefix}photo_scroller_overlay", true ), true );

		$config->set( 'slideshow.photo_scroller.padding.top', get_post_meta( $post_id, "{$prefix}photo_scroller_top_padding", true ), 0 );
		$config->set( 'slideshow.photo_scroller.padding.bottom', get_post_meta( $post_id, "{$prefix}photo_scroller_bottom_padding", true ), 0 );
		$config->set( 'slideshow.photo_scroller.padding.side', get_post_meta( $post_id, "{$prefix}photo_scroller_side_paddings", true ), 0 );

		$config->set( 'slideshow.photo_scroller.inactive.opacity', get_post_meta( $post_id, "{$prefix}photo_scroller_inactive_opacity", true ), 15 );
		$config->set( 'slideshow.photo_scroller.thumbnails.visibility', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_visibility", true ), 'show' );

		$config->set( 'slideshow.photo_scroller.autoplay.mode', get_post_meta( $post_id, "{$prefix}photo_scroller_autoplay", true ), 'play' );
		$config->set( 'slideshow.photo_scroller.autoplay.speed', get_post_meta( $post_id, "{$prefix}photo_scroller_autoplay_speed", true ), 4000 );

		$config->set( 'slideshow.photo_scroller.thumbnail.width', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_width", true ), 0 );
		$config->set( 'slideshow.photo_scroller.thumbnail.height', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_height", true ), 85 );

		$config->set( 'slideshow.photo_scroller.behavior.landscape.width.max', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_max_width", true ), '100' );
		$config->set( 'slideshow.photo_scroller.behavior.landscape.width.min', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_min_width", true ), '0' );
		$config->set( 'slideshow.photo_scroller.behavior.landscape.fill.desktop', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_fill_dt", true ), 'fit' );
		$config->set( 'slideshow.photo_scroller.behavior.landscape.fill.mobile', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_fill_mob", true ), 'fit' );

		$config->set( 'slideshow.photo_scroller.behavior.portrait.width.max', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_max_width", true ), '100' );
		$config->set( 'slideshow.photo_scroller.behavior.portrait.width.min', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_min_width", true ), '0' );
		$config->set( 'slideshow.photo_scroller.behavior.portrait.fill.desktop', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_fill_dt", true ), 'fit' );
		$config->set( 'slideshow.photo_scroller.behavior.portrait.fill.mobile', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_fill_mob", true ), 'fit' );

		// floating meny
		$config->set( 'floating_menu.animation', of_get_option( 'header-floating_menu_animation', 'fade' ), 'fade' );
		$config->set( 'header.floating_menu.show', of_get_option( 'header-show_floating_menu', '1' ), '1' );

		// top bar
		$config->set( 'header.top_bar.mobile.position', of_get_option( 'header-mobile-top_bar_position', 'closed' ), 'closed' );

	}

endif;

if ( ! function_exists( 'presscore_config_logo_options' ) ) :

	function presscore_config_logo_options() {
		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		$prefix = '_dt_custom_header_logo_';

		// header regular logo
		$regular_logo_id = get_post_meta( $post_id, "{$prefix}regular", true );
		if ( ! empty( $regular_logo_id[0] ) ) {
			$config->set( 'logo.header.regular', array( '', $regular_logo_id[0] ) );
		} else {
			$config->set( 'logo.header.regular', of_get_option( 'header-logo_regular', array('', 0) ) );
		}

		// header hd logo
		$hd_logo_id = get_post_meta( $post_id, "{$prefix}hd", true );
		if ( ! empty( $hd_logo_id[0] ) ) {
			$config->set( 'logo.header.hd', array( '', $hd_logo_id[0] ) );
		} else {
			$config->set( 'logo.header.hd', of_get_option( 'header-logo_hd', array('', 0) ) );
		}

	}

endif;

//////////////////////
// SIDEBAR SETTINGS //
//////////////////////

if ( ! function_exists( 'presscore_config_populate_sidebar_and_footer_options' ) ) :

	function presscore_config_populate_sidebar_and_footer_options() {

		$config = Presscore_Config::get_instance();

		$post_id = $config->get( 'post_id' );

		/////////////////////////
		// Template settings //
		/////////////////////////

		$prefix = '_dt_sidebar_';

		// Sidebar options
		$config->set( 'sidebar_position', get_post_meta( $post_id, "{$prefix}position", true ), 'right' );
		$config->set( 'sidebar_hide_on_mobile', get_post_meta( $post_id, "{$prefix}hide_on_mobile", true ), false );
		$config->set( 'sidebar_widgetarea_id', get_post_meta( $post_id, "{$prefix}widgetarea_id", true ) );

		// Footer options
		$prefix = '_dt_footer_';
		$config->set( 'footer_show', get_post_meta( $post_id, "{$prefix}show", true ), true );
		$config->set( 'footer_hide_on_mobile', get_post_meta( $post_id, "{$prefix}hide_on_mobile", true ), false );
		$config->set( 'footer_widgetarea_id', get_post_meta( $post_id, "{$prefix}widgetarea_id", true ) );

	}

endif;

function presscore_config_populate_footer_theme_options() {

	$config = Presscore_Config::get_instance();

	// footer
	$footer_style = of_get_option( 'footer-style', 'full_width_line' );
	$config->set( 'template.footer.style', $footer_style );

	if ( 'solid_background' == $footer_style ) {
		$footer_slideout_mode = of_get_option( 'footer-slide-out-mode', false );
	} else {
		$footer_slideout_mode = false;
	}
	$config->set( 'template.footer.background.slideout_mode', $footer_slideout_mode );

	$config->set( 'template.footer.layout', of_get_option( 'footer-layout', '1/4+1/4+1/4+1/4' ) );

	// bottom bar
	$config->set( 'template.bottom_bar.style', of_get_option( 'bottom_bar-style', 'full_width_line' ) );
	$config->set( 'template.bottom_bar.copyrights', of_get_option( 'bottom_bar-copyrights', '' ) );
	$config->set( 'template.bottom_bar.text', of_get_option( 'bottom_bar-text', '' ) );
	$config->set( 'template.bottom_bar.credits', of_get_option( 'bottom_bar-credits', true ) );

}

////////////////////////
// BLOG POST SETTINGS //
////////////////////////

if ( ! function_exists( 'presscore_populate_post_config' ) ) :

	function presscore_populate_post_config( $target_post_id = 0 ) {

		$config = Presscore_Config::get_instance();
		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		$prefix = '_dt_post_options_';

		/////////////////////////
		// post preview width //
		/////////////////////////

		if ( 'list' == presscore_get_current_layout_type() ) {

			$post_preview_media_width = $config->get( 'post.preview.media.width' );
			if ( $post_preview_media_width >= 100 ) {
				$post_preview_width = 'wide';

			} else {
				$post_preview_width = get_post_meta( $post_id, "{$prefix}preview", true );

			}

		} else {
			$post_preview_width = get_post_meta( $post_id, "{$prefix}preview", true );

		}

		$config->set( 'post.preview.width', $post_preview_width, 'normal' );
		$config->set( 'post.preview.gallery.style', get_post_meta( $post_id, "{$prefix}preview_style_gallery", true ), 'standard_gallery' );
		$config->set( 'post.preview.gallery.sideshow.proportions', get_post_meta( $post_id, "{$prefix}slider_proportions", true ), array( 'width' => '', 'height' => '' ) );
		$config->set( 'post.preview.video.style', get_post_meta( $post_id, "{$prefix}preview_style_video", true ), 'image' );

		return true;
	}

endif;

/////////////////////////////
// PORTFOLIO POST SETTINGS //
/////////////////////////////

if ( ! function_exists( 'presscore_populate_portfolio_config' ) ) :

	function presscore_populate_portfolio_config( $target_post_id = 0 ) {

		$config = Presscore_Config::get_instance();
		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		/////////////////////////////
		// project media library //
		/////////////////////////////

		$prefix = '_dt_project_media_';

		$project_library = get_post_meta( $post_id, "{$prefix}items", true );

		$config->set( 'post.media.library', $project_library, array() );

		////////////////////////////////
		// post preview media style //
		////////////////////////////////

		$prefix = '_dt_project_options_';

		// if project media library is empty - treat preview style as featured image
		if ( !empty($project_library) ) {
			$project_preview_media_style = get_post_meta( $post_id, "{$prefix}preview_style", true );

		} else {
			$project_preview_media_style = 'featured_image';

		}

		$config->set( 'post.preview.media.style', $project_preview_media_style, 'featured_image' );

		/////////////////////////
		// post preview width //
		/////////////////////////

		if ( 'list' == presscore_get_current_layout_type() ) {

			$post_preview_media_width = $config->get( 'post.preview.media.width' );
			if ( $post_preview_media_width >= 100 ) {
				$post_preview_width = 'wide';

			} else {
				$post_preview_width = get_post_meta( $post_id, "{$prefix}preview", true );

			}

		} else {
			$post_preview_width = get_post_meta( $post_id, "{$prefix}preview", true );

		}

		$config->set( 'post.preview.width', $post_preview_width, 'normal' );

		////////////////////
		// project link //
		////////////////////

		// allways show project link for post preview
		$config->set( 'post.buttons.link.enabled', get_post_meta( $post_id, "{$prefix}show_link", true ), false );
		$config->set( 'post.buttons.link.title', get_post_meta( $post_id, "{$prefix}link_name", true ), '' );
		$config->set( 'post.buttons.link.url', get_post_meta( $post_id, "{$prefix}link", true ), '#' );
		$config->set( 'post.buttons.link.target_blank', get_post_meta( $post_id, "{$prefix}link_target", true ), '' );

		//////////////////////////////////
		// is project content visible //
		//////////////////////////////////

		if ( in_the_loop() ) {
			$show_title = $config->get( 'show_titles' ) && get_the_title();
			$show_description = $config->get( 'show_excerpts' ) && get_the_excerpt();
			$show_links = $config->get( 'show_links' ) && $config->get( 'show_details' ) && $config->get( 'show_zoom' ) && has_post_thumbnail() && !post_password_required();
			$show_meta = $config->get( 'post.meta.fields.date' ) && $config->get( 'post.meta.fields.categories' ) && $config->get( 'post.meta.fields.comments' ) && $config->get( 'post.meta.fields.author' );

		} else {
			$show_project_content = true;

		}

		$config->set( 'post.preview.content.visible', $show_title || $show_description || $show_links || $show_meta );

		return true;
	}

endif;

///////////////////////////
// ALBUM POST SETTINGS //
///////////////////////////

if ( ! function_exists( 'presscore_populate_album_post_config' ) ) :

	function presscore_populate_album_post_config( $target_post_id = 0 ) {

		$config = Presscore_Config::get_instance();
		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		///////////////////////////
		// album media library //
		///////////////////////////

		$prefix = '_dt_album_media_';

		$config->set( 'post.media.library', get_post_meta( $post_id, "{$prefix}items", true ), array() );

		//////////////////////////////////////////
		// hide featured image in single post //
		//////////////////////////////////////////

		$prefix = '_dt_album_options_';

		$config->set( 'post.media.featured_image.enabled', !get_post_meta( $post_id, "{$prefix}exclude_featured_image", true ), true );

		if ( post_password_required( $post_id ) ) {
			$open_as = 'post';
		} else {
			$open_as = get_post_meta( $post_id, "{$prefix}open_album", true );
		}

		$config->set( 'post.open_as', $open_as, 'lightbox' );

		/////////////////////////
		// post preview width //
		/////////////////////////

		$config->set( 'post.preview.width', get_post_meta( $post_id, "{$prefix}preview", true ), 'normal' );

		//////////////////////////////////
		// is project content visible //
		//////////////////////////////////

		if ( in_the_loop() ) {

			// title
			$show_title = $config->get( 'show_titles' ) && get_the_title();

			// post content
			$show_description = $config->get( 'show_excerpts' ) && apply_filters( 'the_content', get_the_content() );

			// mini images
			$show_mini_images = $config->get( 'post.preview.mini_images.enabled' );

			// meta information
			$show_meta = 	$config->get( 'post.meta.fields.date' ) && 
							$config->get( 'post.meta.fields.categories' ) && 
							$config->get( 'post.meta.fields.comments' ) && 
							$config->get( 'post.meta.fields.author' ) && 
							$config->get( 'post.meta.fields.media_number' );

			$show_post_content = $show_title || $show_description || $show_meta || $show_mini_images;

		} else {
			$show_post_content = true;

		}

		$config->set( 'post.preview.content.visible', $show_post_content );

		return true;
	}

endif;

////////////////////////
// TEAM POST SETTINGS //
////////////////////////

if ( ! function_exists( 'presscore_populate_team_config' ) ) :

	function presscore_populate_team_config( $target_post_id = 0 ) {

		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		$config = Presscore_Config::get_instance();
		$prefix = '_dt_teammate_options_';

		// open as
		$open_as = get_post_meta( $post_id, "{$prefix}go_to_single", true );
		$config->set( 'post.open_as', ( $open_as ? 'post' : 'none' ) );

		// position
		$config->set( 'post.member.position', get_post_meta( $post_id, "{$prefix}position", true ), '' );

		// links
		$teammate_links = presscore_get_team_links_array();
		$links = array();
		foreach ( $teammate_links as $id=>$data ) {
			$link = get_post_meta( $post_id, "{$prefix}{$id}", true );
			if ( $link ) {
				$links[ $id ] = $link;
			}
		}
		$config->set( 'post.preview.links', $links, array() );

		return true;
	}

endif;

if ( ! function_exists( 'presscore_congif_populate_single_attachment_vars' ) ) :

	function presscore_congif_populate_single_attachment_vars( $target_post_id = 0 ) {

		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		$config = presscore_get_config();

		$config->set( 'sidebar_position', 'disabled' );
		$config->set( 'footer_show', false );

		return true;
	}

endif;

if ( ! function_exists( 'presscore_config_populate_buttons_options' ) ) :

	function presscore_config_populate_buttons_options() {
		$config = presscore_get_config();

		$config->set( 'buttons.style', of_get_option( 'buttons-style', 'flat' ) );
	}

endif;

if ( ! function_exists( 'presscore_config_get_theme_option' ) ) :

	function presscore_config_get_theme_option() {
		$config = presscore_get_config();

		$config->set( 'template.content.width', of_get_option( 'general-content_width', '1200px' ) );
		$config->set( 'template.beautiful_loading', of_get_option( 'general-beautiful_loading', 'accent' ) );
		$config->set( 'template.accent.color.mode', of_get_option( 'general-accent_color_mode', 'color' ) );
		$config->set( 'template.layout', of_get_option( 'general-layout', 'wide' ) );
		$config->set( 'template.images.hover.style', of_get_option( 'image_hover-style', 'none' ) );
		$config->set( 'template.images.hover.icon', of_get_option( 'image_hover-default_icon', 'none' ) );

		$config->set( 'template.style', of_get_option( 'general-style', 'minimalistic' ) );

		// sidebar
		$config->set( 'sidebar.style', of_get_option( 'sidebar-visual_style', 'with_dividers' ) );
		$config->set( 'sidebar.style.with_dividers.vertical_divider', of_get_option( 'sidebar-divider-vertical', true ) );
		$config->set( 'sidebar.style.with_dividers.horizontal_dividers', of_get_option( 'sidebar-divider-horizontal', true ) );
	}

endif;

if ( ! function_exists( 'presscore_config_filter_values' ) ) :

	function presscore_config_filter_values() {
		$config = presscore_get_config();

		if ( $config->get( 'justified_grid' ) ) {

			if ( 'on_hoover' == $config->get( 'post.preview.description.style' ) ) {
				$config->set( 'post.preview.description.style', 'on_hoover_centered' );
			}
		}
	}

	add_action( 'presscore_config_base_init', 'presscore_config_filter_values' );

endif;
