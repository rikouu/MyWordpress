<?php
/**
 * Theme setup.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_theme_supports' ) ) :

	function presscore_theme_supports() {
		add_theme_support( 'presscore_admin_tgm_plugins_setup' );
		add_theme_support( 'presscore_admin_icons_bar' );
		add_theme_support( 'presscore_theme_update' );
		add_theme_support( 'presscore_mega_menu' );
		add_theme_support( 'presscore_the7_adapter' );
		add_theme_support( 'presscore_archives_templates' );
	}
	add_action( 'after_setup_theme', 'presscore_theme_supports', 5 );

endif;

if ( ! function_exists( 'presscore_load_theme_modules' ) ) :

	function presscore_load_theme_modules() {

		/**
		 * Icons Bar.
		 */
		if ( is_admin() && current_theme_supports( 'presscore_admin_icons_bar' ) ) {
			include_once PRESSCORE_ADMIN_MODS_DIR . '/mod-admin-icons-bar/icons-bar.class.php';

			$icons_bar = new Presscore_Admin_Icons_Bar( array(
				'fontello_css_url' => str_replace( get_theme_root(), get_theme_root_uri(), locate_template( 'css/fontello/css/fontello.css', false ) ),
				'fontello_json_path' => locate_template( "/css/fontello/config.json", false ),
				'textdomain' => LANGUAGE_ZONE
			) );
		}

		/**
		 * TGM Plugin Activation.
		 */
		if ( is_admin() && current_theme_supports( 'presscore_admin_tgm_plugins_setup' ) ) {
			require_once PRESSCORE_ADMIN_MODS_DIR . '/mod-tgm-plugin-activation/tgm-plugin-setup.php';
		}

		/**
		 * Theme Update.
		 */
		if ( ! is_child_theme() && is_admin() && current_theme_supports( 'presscore_theme_update' ) ) {
			require_once PRESSCORE_ADMIN_MODS_DIR . '/mod-theme-update/mod-theme-update.php';
		}

		/**
		 * Presscore Mega Menu.
		 */
		if ( current_theme_supports( 'presscore_mega_menu' ) ) {
			require_once PRESSCORE_MODS_DIR . '/mod-theme-mega-menu/mod-theme-mega-menu.php';
		}

		/**
		 * The7 adapter.
		 */
		if ( current_theme_supports( 'presscore_the7_adapter' ) ) {
			require_once PRESSCORE_MODS_DIR . '/mod-the7-compatibility/mod-the7-compatibility.php';
		}

		/* Archive templates */
		if ( current_theme_supports( 'presscore_archives_templates' ) ) {
			require_once PRESSCORE_MODS_DIR . '/mod-archives-templates/mod-archives-templates.php';
		}

	}
	add_action( 'after_setup_theme', 'presscore_load_theme_modules', 7 );

endif;

if ( ! function_exists( 'presscore_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	function presscore_setup() {

		/* Load theme text domain */
		load_theme_textdomain( LANGUAGE_ZONE, get_template_directory() . '/languages' );

		if ( is_child_theme() ) {
			load_child_theme_textdomain( CHILD_LANGUAGE_ZONE, get_stylesheet_directory() . '/languages' );
		}

		/**
		 * Editor style.
		 */
		add_editor_style();

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' 	=> __( 'Primary Menu', LANGUAGE_ZONE ),
			'top'		=> __( 'Top Menu', LANGUAGE_ZONE ),
			'bottom'	=> __( 'Bottom Menu', LANGUAGE_ZONE ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status' ) );

		/**
		 * Allow shortcodes in widgets.
		 *
		 */
		add_filter( 'widget_text', 'do_shortcode' );

		// create upload dir
		wp_upload_dir();
	}
	add_action( 'after_setup_theme', 'presscore_setup', 10 );

endif; // presscore_setup

if ( ! function_exists( 'presscore_add_theme_options' ) ) :

	/**
	 * Set theme options path.
	 *
	 */
	function presscore_add_theme_options() {
		return array( 'inc/admin/load-theme-options.php' );
	}

endif;

if ( ! function_exists('presscore_widgets_init') ) :

	/**
	 * Register widgetized area and
	 *
	 * @since presscore 0.1
	 */
	function presscore_widgets_init() {

		if ( function_exists('of_get_option') ) {

			$w_params = array(
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' 	=> '</section>',
				'before_title' 	=> '<div class="widget-title">',
				'after_title'	=> '</div>'
			);

			$w_areas = apply_filters( 'presscore_widgets_init-sidebars', of_get_option( 'widgetareas', false ) );

			if ( !empty( $w_areas ) && is_array( $w_areas ) ) {

				$prefix = 'sidebar_';

				foreach( $w_areas as $sidebar_id=>$sidebar ) {

					$sidebar_args = array(
						'name' 			=> isset( $sidebar['sidebar_name'] ) ? $sidebar['sidebar_name'] : '',
						'id' 			=> $prefix . $sidebar_id,
						'description' 	=> isset( $sidebar['sidebar_desc'] ) ? $sidebar['sidebar_desc'] : '',
						'before_widget' => $w_params['before_widget'],
						'after_widget' 	=> $w_params['after_widget'],
						'before_title' 	=> $w_params['before_title'],
						'after_title'	=> $w_params['after_title'] 
					);

					$sidebar_args = apply_filters( 'presscore_widgets_init-sidebar_args', $sidebar_args, $sidebar_id, $sidebar );

					register_sidebar( $sidebar_args );
				}

			}

		}
	}

endif; // presscore_widgets_init

add_action( 'widgets_init', 'presscore_widgets_init' );

if ( ! function_exists( 'presscore_themeoptions_add_share_buttons' ) ) :

	/**
	 * Add some share buttons to theme options.
	 */
	function presscore_themeoptions_add_share_buttons( $buttons ) {
		$theme_soc_buttons = presscore_themeoptions_get_social_buttons_list();
		if ( $theme_soc_buttons && is_array( $theme_soc_buttons ) ) {
			$buttons = array_merge( $buttons, $theme_soc_buttons );
		}
		return $buttons;
	}

endif; // presscore_themeoptions_add_share_buttons

add_filter( 'optionsframework_interface-social_buttons', 'presscore_themeoptions_add_share_buttons', 15 );

if ( ! function_exists( 'presscore_post_types_author_archives' ) ) :

	/**
	 * Add Custom Post Types to Author Archives
	 */
	function presscore_post_types_author_archives( $query ) {

		// Add 'videos' post type to author archives
		if ( $query->is_main_query() && $query->is_author ) {
			$post_type = $query->get( 'post_type' );
			$query->set( 'post_type', array_merge( (array) $post_type, array('dt_portfolio', 'post') ) );
		}

	}

endif; // presscore_post_types_author_archives

add_action( 'pre_get_posts', 'presscore_post_types_author_archives' );

if ( ! function_exists( 'presscore_get_presets_list' ) ) :

	function presscore_get_presets_list() {
		return array(
			'skin01' => 'Azure',
			'skin02' => 'Dark',
			'skin03' => 'Polygonal',
			'skin04' => 'Spring',
			'skin05' => 'Aquamarine',
			'skin06' => 'Striped',
			'skin07' => 'Cobalt',
			'skin08' => 'The7 minimal',
			'skin09' => 'Minimal',
			'skin10' => 'Jeans',
			'skin11' => 'Purple peak',
			'skin12' => 'The7 classic',
			'skin13' => 'Sepia',
			'skin14' => 'Sandy',
			'skin15' => 'Red',
			'skin16' => 'Fresh',
		);
	}

endif;

if ( ! function_exists( 'presscore_get_presets_names_list' ) ) :

	function presscore_get_presets_names_list() {
		$presets_list = presscore_get_presets_list();
		return array_keys( $presets_list );
	}

endif;

if ( ! function_exists( 'presscore_add_presets' ) ) :

	/**
	 * Add theme options presets.
	 *
	 */
	function presscore_add_presets( $presets = array() ) {
		// noimage - /images/noimage-small.jpg

		$presets_names = presscore_get_presets_names_list();

		$theme_presets = array();

		foreach( $presets_names as $preset_name ) {

			foreach( array( 'b', 'c', 'r', 's', 'so' ) as $header_type ) {

				$theme_presets[ $preset_name . $header_type ] = array(
					'src' => '/inc/presets/icons/' . $preset_name . $header_type . '.jpg' ,
					'title' => $preset_name . $header_type
				);

			}

		}

		return array_merge( $presets, $theme_presets );
	}

endif;
add_filter( 'optionsframework_get_presets_list', 'presscore_add_presets', 15 );


if ( ! function_exists('presscore_set_first_run_skin') ) :

	/**
	 * Set first run skin.
	 *
	 */
	function presscore_set_first_run_skin( $skin_name = '' ) {
		return 'skin01b';
	}

endif;
add_filter( 'options_framework_first_run_skin', 'presscore_set_first_run_skin' );

if ( ! function_exists( 'presscore_options_black_list' ) ) :

	function presscore_options_black_list( $fields = array() ) {

		$fields_black_list = array(
			'general-custom_css',
			'general-tracking_code',
			'general-hd_images',
			'general-post_type_portfolio_slug',
			'general-post_type_gallery_slug',
			'general-post_type_team_slug',
			'general-contact_form_send_mail_to',

			'general-favicon',
			'general-favicon_hd',
			'general-handheld_icon-old_iphone',
			'general-handheld_icon-old_ipad',
			'general-handheld_icon-retina_iphone',
			'general-handheld_icon-retina_ipad',

			'header-search_icon',
			'header-contact_address',
			'header-contact_address_icon',
			'header-contact_phone',
			'header-contact_phone_icon',
			'header-contact_email',
			'header-contact_email_icon',
			'header-contact_skype',
			'header-contact_skype_icon',
			'header-contact_clock',
			'header-contact_clock_icon',
			'header-login_icon',
			'header-login_url',
			'header-text',
			'header-soc_icons',

			'submenu-parent_clickable',

			'footer-layout',
			'bottom_bar-copyrights',
			'bottom_bar-text',

			'general-beautiful_loading',

			'general-show_author_in_blog',
			'general-next_prev_in_blog',
			'general-show_back_button_in_post',
			'general-post_back_button_target_page_id',
			'general-blog_meta_on',
			'general-blog_meta_date',
			'general-blog_meta_author',
			'general-blog_meta_categories',
			'general-blog_meta_comments',
			'general-blog_meta_tags',

			'general-next_prev_in_portfolio',
			'general-show_back_button_in_project',
			'general-project_back_button_target_page_id',

			'general-portfolio_meta_on',
			'general-portfolio_meta_date',
			'general-portfolio_meta_author',
			'general-portfolio_meta_categories',
			'general-portfolio_meta_comments',

			'general-show_rel_projects',
			'general-rel_projects_head_title',
			'general-rel_projects_title',
			'general-rel_projects_excerpt',
			'general-rel_projects_info_date',
			'general-rel_projects_info_author',
			'general-rel_projects_info_comments',
			'general-rel_projects_info_categories',
			'general-rel_projects_link',
			'general-rel_projects_zoom',
			'general-rel_projects_details',
			'general-rel_projects_max',
			'general-rel_projects_fullwidth_height',
			'general-rel_projects_fullwidth_width_style',
			'general-rel_projects_fullwidth_width',
			'general-rel_projects_height',
			'general-rel_projects_width_style',
			'general-rel_projects_width',

			'social_buttons-post-button_title',
			'social_buttons-post',
			'social_buttons-portfolio_post-button_title',
			'social_buttons-portfolio_post',
			'social_buttons-photo-button_title',
			'social_buttons-photo',
			'social_buttons-page-button_title',
			'social_buttons-page',

			'theme_update-user_name',
			'theme_update-api_key',
			'widgetareas',

			// archives
			'template_page_id_author',
			'template_page_id_date',
			'template_page_id_blog_category',
			'template_page_id_blog_tags',
			'template_page_id_search',
			'template_page_id_portfolio_category',
			'template_page_id_gallery_category',

			// woocommerce
			'woocommerce_display_product_info',
			'woocommerce_show_product_titles',
			'woocommerce_show_product_price',
			'woocommerce_show_product_rating',
			'woocommerce_show_details_icon',
			'woocommerce_show_cart_icon',
			'woocommerce_shop_template_layout',
			'woocommerce_shop_template_gap',
			'woocommerce_shop_template_column_min_width',
			'woocommerce_shop_template_columns',
			'woocommerce_shop_template_fullwidth',
			'woocommerce_shop_template_loading_effect'
		);

		return array_unique( array_merge( $fields, $fields_black_list ) );
	}

endif;
add_filter( 'optionsframework_fields_black_list', 'presscore_options_black_list' );
add_filter( 'optionsframework_validate_preserve_fields', 'presscore_options_black_list', 14 );

if ( ! function_exists( 'presscore_themeoption_preserved_fields' ) ) :

	function presscore_themeoption_preserved_fields( $fields = array() ) {

		$preserved_fields = array(

			// header logo
			'header-logo_regular',
			'header-logo_hd',

			// bottom logo
			'bottom_bar-logo_regular',
			'bottom_bar-logo_hd',

			// mobile logo
			'general-mobile_logo-regular',
			'general-mobile_logo-hd',
			'general-mobile_logo-padding_top',
			'general-mobile_logo-padding_bottom',

			// floating logo
			'general-floating_menu_show_logo',
			'general-floating_menu_logo_regular',
			'general-floating_menu_logo_hd',

			// menu icons dimentions
			'header-icons_size',
			'header-submenu_icons_size',
			'header-submenu_next_level_indicator',
			'header-next_level_indicator',

			// header layout
			'header-login_caption',
			'header-logout_caption',
			'header-search_caption',
			'header-woocommerce_cart_caption',
		);

		return array_unique( array_merge( $fields, $preserved_fields ) );
	}

endif;
add_filter( 'optionsframework_validate_preserve_fields', 'presscore_themeoption_preserved_fields', 15 );

if ( ! function_exists( 'presscore_after_switch_theme' ) ) :

	function presscore_after_switch_theme() {
		flush_rewrite_rules();
		delete_option( 'presscore_less_css_is_writable' );
	}

	add_action( 'after_switch_theme', 'presscore_after_switch_theme' );

endif;

if ( ! function_exists( 'presscore_layerslider_overrides' ) ) :

	function presscore_layerslider_overrides() {

		// Disable auto-updates
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'presscore_layerslider_overrides');

endif;

if ( ! function_exists( 'presscore_change_dt_potfolio_post_type_args' ) ) :

	function presscore_change_dt_potfolio_post_type_args( $args = array() ) {

		if ( array_key_exists('rewrite', $args) && is_array($args['rewrite']) && array_key_exists('slug', $args['rewrite']) ) {

			$new_slug = of_get_option( 'general-post_type_portfolio_slug', '' );
			if ( $new_slug && is_string($new_slug) ) {
				$args['rewrite']['slug'] = trim( strtolower( $new_slug ) );
			}
		}

		return $args;
	}

	add_filter( 'presscore_post_type_dt_portfolio_args', 'presscore_change_dt_potfolio_post_type_args' );

endif;

if ( ! function_exists( 'presscore_change_dt_gallery_post_type_args' ) ) :

	function presscore_change_dt_gallery_post_type_args( $args = array() ) {

		if ( array_key_exists('rewrite', $args) && is_array($args['rewrite']) && array_key_exists('slug', $args['rewrite']) ) {

			$new_slug = of_get_option( 'general-post_type_gallery_slug', '' );
			if ( $new_slug && is_string($new_slug) ) {
				$args['rewrite']['slug'] = trim( strtolower( $new_slug ) );
			}
		}

		return $args;
	}

	add_filter( 'presscore_post_type_dt_gallery_args', 'presscore_change_dt_gallery_post_type_args' );

endif;

if ( ! function_exists( 'presscore_change_dt_team_post_type_args' ) ) :

	function presscore_change_dt_team_post_type_args( $args = array() ) {

		if ( array_key_exists('rewrite', $args) && is_array($args['rewrite']) && array_key_exists('slug', $args['rewrite']) ) {

			$new_slug = of_get_option( 'general-post_type_team_slug', '' );
			if ( $new_slug && is_string($new_slug) ) {
				$args['rewrite']['slug'] = trim( strtolower( $new_slug ) );
			}
		}

		return $args;
	}

	add_filter( 'presscore_post_type_dt_team_args', 'presscore_change_dt_team_post_type_args' );

endif;

if ( ! function_exists( 'presscore_flush_rewrite_rules_after_post_type_slug_change' ) ) :

	function presscore_flush_rewrite_rules_after_post_type_slug_change( $options = array() ) {

		$slug_options_list = array(
			'general-post_type_portfolio_slug',
			'general-post_type_gallery_slug',
			'general-post_type_team_slug'
		);

		$flush_rewrite_rules = false;
		foreach ( $slug_options_list as $option_id ) {
			if ( ! isset( $options[ $option_id ] ) ) {
				continue;
			}

			$old_portfolio_slug = of_get_option( $option_id, 'project' );
			$new_portfolio_slug = $options[ $option_id ];

			if ( $old_portfolio_slug != $new_portfolio_slug ) {
				$flush_rewrite_rules = true;
			}
		}

		// check if new slug really new
		if ( $flush_rewrite_rules ) {
			wp_schedule_single_event( time(), 'presscore_onetime_after_post_type_slug_changing' );
		}
	}

	add_action( 'optionsframework_after_validate', 'presscore_flush_rewrite_rules_after_post_type_slug_change' );

endif;

if ( ! function_exists( 'presscore_onetime_scheduled_rewrite_rules_flush' ) ) :

	/**
	 * Run onetime scheduled code
	 *
	 * @since 4.1.0
	 */
	function presscore_onetime_scheduled_rewrite_rules_flush() {
		flush_rewrite_rules();
	}

	add_action( 'presscore_onetime_after_post_type_slug_changing', 'presscore_onetime_scheduled_rewrite_rules_flush' );

endif;

if ( ! function_exists( 'presscore_set_default_contact_form_email' ) ) :

	/**
	 * Set default email for contact forms if it's not empty
	 * See theme options General->Advanced
	 * 
	 * @since 4.1.0
	 * @param  string $email Original email
	 * @return string        Modified email
	 */
	function presscore_set_default_contact_form_email( $email = '' ) {

		$default_email = of_get_option( 'general-contact_form_send_mail_to', '' );
		if ( $default_email ) {
			$email = $default_email;
		}

		return $email;
	}

	add_filter( 'dt_core_send_mail-to', 'presscore_set_default_contact_form_email' );

endif;

if ( ! function_exists( 'presscore_dt_paginator_args_filter' ) ) :

	/**
	 * PressCore dt_paginator args filter.
	 *
	 * @param array $args Paginator args.
	 * @return array Filtered $args.
	 */
	function presscore_dt_paginator_args_filter( $args ) {
		global $post;
		$config = Presscore_Config::get_instance();

		// show all pages in paginator
		$show_all_pages = '0';

		if ( is_page() ) {
			$show_all_pages = $config->get( 'show_all_pages' );
		}

		if ( '0' != $show_all_pages ) {
			$args['num_pages'] = 9999;
		} else {
			$args['num_pages'] = 5;
		}

		$args['wrap'] = '<div class="%CLASS%" role="navigation"><div class="page-links">%LIST%</div><div class="page-nav">%PREV%%NEXT%</div></div>';
		$args['pages_wrap'] = '';
		$args['item_wrap'] = '<a href="%HREF%" %CLASS_ACT% data-page-num="%PAGE_NUM%">%TEXT%</a>';
		$args['first_wrap'] = '<a href="%HREF%" %CLASS_ACT% data-page-num="%PAGE_NUM%">%FIRST_PAGE%</a>';
		$args['last_wrap'] = '<a href="%HREF%" %CLASS_ACT% data-page-num="%PAGE_NUM%">%LAST_PAGE%</a>';
		$args['dotleft_wrap'] = '<a href="javascript: void(0);" class="dots">%TEXT%</a>'; 
		$args['dotright_wrap'] = '<a href="javascript: void(0);" class="dots">%TEXT%</a>';// %TEXT%
		$args['pages_prev_class'] = 'nav-prev';
		$args['pages_next_class'] = 'nav-next';
		$args['act_class'] = 'act';
		$args['next_text'] = _x( 'Next page', 'paginator', LANGUAGE_ZONE );
		$args['prev_text'] = _x( 'Prev page', 'paginator', LANGUAGE_ZONE );
		$args['no_next'] = '';
		$args['no_prev'] = '';
		$args['first_is_first_mode'] = true;

		return $args;
	}

	add_filter( 'dt_paginator_args', 'presscore_dt_paginator_args_filter' );

endif;

if ( ! function_exists( 'presscore_add_srcsets' ) ) :

	function presscore_add_srcsets( $args = array() ) {
		if ( presscore_is_srcset_based_retina() && ! empty( $args['options'] ) ) {
			$args['options']['use_srcset'] = true;
		}

		return $args;
	}

	add_filter( 'dt_get_thumb_img-args', 'presscore_add_srcsets' );

endif;

if ( ! function_exists( 'presscore_is_srcset_based_retina' ) ) :

	function presscore_is_srcset_based_retina() {
		return ( 'srcset_based' == of_get_option( 'general-hd_images', 'cookie_based' ) );
	}

endif;

if ( ! function_exists( 'presscore_is_logos_only_retina' ) ) :

	function presscore_is_logos_only_retina() {
		return ( 'logos_only' == of_get_option( 'general-hd_images', 'cookie_based' ) );
	}

endif;

if ( ! function_exists( 'presscore_add_dt_retina_on_filter' ) ) :

	function presscore_add_dt_retina_on_filter() {
		if ( presscore_is_logos_only_retina() ) {
			add_filter( 'dt_retina_on', '__return_false', 99 );
		}
	}
	add_action( 'init', 'presscore_add_dt_retina_on_filter', 30 );

endif;
