<?php
/**
 * Frontend functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/////////////////////
// Enqueue scripts //
/////////////////////

if ( ! function_exists( 'presscore_enqueue_scripts' ) ) :

	/**
	 * Enqueue scripts and styles.
	 */
	function presscore_enqueue_scripts() {
		global $wp_styles;

		// enqueue web fonts if needed
		presscore_enqueue_web_fonts();

		$theme_version = wp_get_theme()->get( 'Version' );

		$template_directory = PRESSCORE_THEME_DIR;
		$template_uri = PRESSCORE_THEME_URI;

		presscore_enqueue_theme_stylesheet( 'dt-main', 'css/main' );
		presscore_enqueue_theme_stylesheet( 'dt-old-ie', 'css/old-ie' );
		$wp_styles->add_data( 'dt-old-ie', 'conditional', 'lt IE 9' );
		presscore_enqueue_theme_stylesheet( 'dt-awsome-fonts', 'css/font-awesome' );

		// $fontello_css = str_replace( get_theme_root(), get_theme_root_uri(), locate_template( 'css/fontello/css/fontello.css', false ) );
		if ( locate_template( 'css/fontello/css/fontello.css', false ) ) {
			presscore_enqueue_theme_stylesheet( 'dt-fontello', 'css/fontello/css/fontello' );
		}

		presscore_enqueue_dynamic_stylesheets();
		$wp_styles->add_data( 'dt-custom-old-ie.less', 'conditional', 'lt IE 9' );

		$config = Presscore_Config::get_instance();
		if ( 'slideshow' == $config->get( 'header_title' ) && '3d' == $config->get( 'slideshow_mode' ) ) {
			presscore_enqueue_theme_stylesheet( 'dt-3d-slider', 'css/3D-slider' );
		}

		wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $theme_version );

		presscore_enqueue_theme_script( 'dt-above-fold', 'js/above-the-fold', array( 'jquery' ), $theme_version, false );

		// detect device type
		$detect = new Mobile_Detect;
		$device_type = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

		presscore_enqueue_theme_script( 'dt-main', 'js/main', array( 'jquery' ), $theme_version, true );

		$config->set( 'device_type', $device_type );

		if ( is_page() ) {
			$page_data = array(
				'type' => 'page',
				'template' => $config->get('template'),
				'layout' => $config->get('justified_grid') ? 'jgrid' : $config->get('layout')
			);
		} else if ( is_archive() ) {
			$page_data = array(
				'type' => 'archive',
				'template' => $config->get('template'),
				'layout' => $config->get('justified_grid') ? 'jgrid' : $config->get('layout')
			);
		} else if ( is_search() ) {
			$page_data = array(
				'type' => 'search',
				'template' => $config->get('template'),
				'layout' => $config->get('justified_grid') ? 'jgrid' : $config->get('layout')
			);
		} else {
			$page_data = false;
		}

		global $post;

		$dt_local = array(
			'passText' => __( 'To view this protected post, enter the password below:', LANGUAGE_ZONE ),
			'moreButtonText' => array(
				'loading' => __( 'Loading...', LANGUAGE_ZONE ),
			),
			'postID' => empty( $post->ID ) ? null : $post->ID,
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'contactNonce' => wp_create_nonce('dt_contact_form'),
			'ajaxNonce' => wp_create_nonce('presscore-posts-ajax'),
			'pageData' => $page_data,
			'themeSettings' => array(
				'smoothScroll' => of_get_option('general-smooth_scroll', 'on'),
				'lazyLoading' => ( 'lazy_loading' == $config->get( 'load_style' ) ),
				'accentColor' => array(),
				'mobileHeader' => array(
					'firstSwitchPoint' => of_get_option( 'header-mobile-first_switch-after', 1024 )
				),
				'content' => array(
					'responsivenessTreshold' => of_get_option( 'general-responsiveness-treshold', 800 ),
					'textColor' => of_get_option( 'content-primary_text_color', '#000000' ),
					'headerColor' => of_get_option( 'content-headers_color', '#000000' )
				),
				'stripes' => array(
					'stripe1' => array(
						'textColor' => of_get_option( 'stripes-stripe_1_text_color', '#000000' ),
						'headerColor' => of_get_option( 'stripes-stripe_1_headers_color', '#000000' )
					),
					'stripe2' => array(
						'textColor' => of_get_option( 'stripes-stripe_2_text_color', '#000000' ),
						'headerColor' => of_get_option( 'stripes-stripe_2_headers_color', '#000000' )
					),
					'stripe3' => array(
						'textColor' => of_get_option( 'stripes-stripe_3_text_color', '#000000' ),
						'headerColor' => of_get_option( 'stripes-stripe_3_headers_color', '#000000' )
					)
				)
			)
		);

		switch ( $config->get( 'template.accent.color.mode' ) ) {
			case 'gradient':
				$dt_local['themeSettings']['accentColor']['mode'] = 'gradient';
				$dt_local['themeSettings']['accentColor']['color'] = of_get_option( 'general-accent_bg_color_gradient', array( '#000000', '#000000' ) );
				break;
			case 'color':
			default:
				$dt_local['themeSettings']['accentColor']['mode'] = 'solid';
				$dt_local['themeSettings']['accentColor']['color'] = of_get_option( 'general-accent_bg_color', '#000000' );
		}

		$dt_local = apply_filters( 'presscore_localized_script', $dt_local );

		// add some additional data
		wp_localize_script( 'dt-above-fold', 'dtLocal', $dt_local );

		// comments clear script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$custom_css = of_get_option( 'general-custom_css', '' );
		if ( $custom_css ) {

			wp_add_inline_style( 'style', $custom_css );
		}
	}

endif; // presscore_enqueue_scripts

add_action( 'wp_enqueue_scripts', 'presscore_enqueue_scripts', 15 );

/**
 * Add new body classes.
 *
 */
if ( ! function_exists( 'presscore_body_class' ) ) :

	function presscore_body_class( $classes ) {
		$config = Presscore_Config::get_instance();
		$desc_on_hoover = ( 'under_image' != $config->get('post.preview.description.style') );
		$template = $config->get('template');
		$layout = $config->get('layout');

		///////////////////////
		// template classes //
		///////////////////////

		switch ( $template ) {
			case 'blog':
				$classes[] = 'blog';
				break;
			case 'portfolio': $classes[] = 'portfolio'; break;
			case 'team': $classes[] = 'team'; break;
			case 'testimonials': $classes[] = 'testimonials'; break;
			case 'archive': $classes[] = 'archive'; break;
			case 'search': $classes[] = 'search'; break;
			case 'albums': $classes[] = 'albums'; break;
			case 'media': $classes[] = 'media'; break;
			case 'microsite': $classes[] = 'one-page-row'; break;
		}

		/////////////////////
		// layout classes //
		/////////////////////

		switch ( $layout ) {
			case 'masonry':
				if ( $desc_on_hoover ) {
					$classes[] = 'layout-masonry-grid';

				} else {
					$classes[] = 'layout-masonry';
				}
				break;
			case 'grid':
				$classes[] = 'layout-grid';
				if ( $desc_on_hoover ) {
					$classes[] = 'grid-text-hovers';
				}
				break;
			case 'checkerboard':
			case 'list':
			case 'right_list':
				$classes[] = 'layout-list';
				break;
		}

		////////////////////
		// hover classes //
		////////////////////

		if ( in_array($layout, array('masonry', 'grid')) && !in_array($template, array('testimonials', 'team')) ) {
			$classes[] = $desc_on_hoover ? 'description-on-hover' : 'description-under-image';
		}

		//////////////////////////////////////
		// hide dividers if content is off //
		//////////////////////////////////////

		if ( in_array($config->get('template'), array('albums', 'portfolio')) && 'masonry' == $config->get('layout') ) {
			$show_dividers = $config->get('show_titles') || $config->get('show_details') || $config->get('show_excerpts') || $config->get('show_terms') || $config->get('show_links');
			if ( !$show_dividers ) {
				$classes[] = 'description-off';
			}
		}

		/////////////////////
		// single classes //
		/////////////////////

		if ( is_single() ) {

			if ( post_password_required() || ( !comments_open() && '0' == get_comments_number() ) ) {
				$classes[] = 'no-comments';
			}

			$post_type = get_post_type();
			if ( 'dt_gallery' == $post_type && 'photo_scroller' == $config->get( 'post.media.type' ) ) {
				$classes[] = 'photo-scroller-album';
			}

		}

		/////////////////////////////////
		// fix single portfolio class //
		/////////////////////////////////

		if ( in_array('single-dt_portfolio', $classes) ) {
			$key = array_search('single-dt_portfolio', $classes);
			$classes[ $key ] = 'single-portfolio';
		}

		////////////////////////
		// header background //
		////////////////////////

		if ( 'background' == $config->get( 'page_title.background.mode' ) || in_array( $config->get( 'header_title' ), array( 'fancy', 'slideshow' ) ) ) {

			switch ( $config->get('header_background') ) {

				case 'overlap':
					$classes['header_background'] = 'overlap';
					break;

				case 'transparent':
					$classes['header_background'] = 'transparent';
					break;
			}

			if ( 'disabled' == $config->get( 'header.transparent.background.style' ) ) {
				$classes[] = 'disabled-transparent-bg';
			}

		}

		///////////////////
		// header title //
		///////////////////

		if ( 'fancy' == $config->get( 'header_title' ) ) {
			$classes[] = 'fancy-header-on';

		} elseif ( 'slideshow' == $config->get( 'header_title' ) ) {
			$classes[] = 'slideshow-on';

			if ( '3d' == $config->get( 'slideshow_mode' ) && 'fullscreen-content' == $config->get( 'slideshow_3d_layout' ) ) {
				$classes[] = 'threed-fullscreen';

			}

			if ( dt_get_paged_var() > 1 && isset($classes['header_background']) ) {
				unset($classes['header_background']);

			}

		} elseif ( is_single() && 'disabled' == $config->get( 'header_title' ) ) {
			$classes[] = 'title-off';

		}

		///////////////////
		// hover style //
		///////////////////

		switch( $config->get( 'template.images.hover.style' ) ) {
			case 'grayscale': $classes[] = 'filter-grayscale-static'; break;
			case 'gray+color': $classes[] = 'filter-grayscale'; break;
			case 'blur' : $classes[] = 'image-blur'; break;
			case 'scale' : $classes[] = 'scale-on-hover'; break;
		}

		if ( 'white_icon' == $config->get( 'template.images.hover.icon' ) ) {
			$classes[] = 'rollover-show-icon';
		}

		////////////
		// boxed //
		////////////

		if ( 'boxed' == $config->get( 'template.layout' ) ) {
			$classes[] = 'boxed-layout';
		}

		/////////////////////
		// responsiveness //
		/////////////////////

		if ( !presscore_responsive() ) {
			$classes[] = 'responsive-off';
		}

		/////////////////////
		// justified grid //
		/////////////////////

		if ( $config->get( 'justified_grid' ) ) {
			$classes[] = 'justified-grid';
		}

		////////////////////
		// header layout //
		////////////////////

		if ( 'side' == $config->get( 'header.layout' ) ) {

			switch( $config->get( 'header.layout.side.menu.position' ) ) {
				case 'right': $classes[] = 'header-side-right'; break;
				default: $classes[] = 'header-side-left';
			}

			if ( 'sticky' == $config->get( 'header.layout.side.menu.visibility' ) ) {
				$classes[] = 'sticky-header';
			}

		}

		//////////////////////
		// accent gradient //
		//////////////////////

		if ( 'gradient' == $config->get( 'template.accent.color.mode' ) ) {
			$classes[] = 'accent-gradient';
		}

		//////////////////////////////
		// srcset based hd images //
		//////////////////////////////

		if ( presscore_is_srcset_based_retina() || presscore_is_logos_only_retina() ) {
			$classes[] = 'srcset-enabled';
		}

		////////////////////
		// buttons style //
		////////////////////

		switch ( $config->get( 'buttons.style' ) ) {
			case '3d':
				$classes[] = 'btn-3d';
				break;
			case 'flat':
				$classes[] = 'btn-flat';
				break;
			case 'ios7':
			default:
				$classes[] = 'btn-ios';
				break;
		}

		if ( $config->get( 'template.footer.background.slideout_mode' ) ) {
			$classes[] = 'footer-overlap';
		}

		/////////////////////
		// general style //
		/////////////////////

		switch ( $config->get( 'template.style' ) ) {
			case 'minimalistic':
				$classes[] = 'style-minimal';
				break;
			case 'ios7':
				$classes[] = 'style-ios';
				break;
		}

		/////////////////////
		// floating menu //
		/////////////////////

		if ( $config->get( 'header.floating_menu.show' ) ) {

			switch( $config->get( 'floating_menu.animation' ) ) {
				case 'fade':
					$classes[] = 'phantom-fade';
					break;

				case 'slide':
					$classes[] = 'phantom-slide';
					break;
			}

		}

		////////////////////////////////////
		// Sidebar and footer on mobile //
		////////////////////////////////////

		if ( 'disabled' != $config->get( 'sidebar_position' ) && $config->get( 'sidebar_hide_on_mobile' ) ) {
			$classes[] = 'mobile-hide-sidebar';
		}

		if ( $config->get( 'footer_show' ) && $config->get( 'footer_hide_on_mobile' ) ) {
			$classes[] = 'mobile-hide-footer';
		}

		/////////////
		// return //
		/////////////

		return array_values( array_unique( $classes ) );
	}

endif;

add_filter( 'body_class', 'presscore_body_class' );

if ( ! function_exists( 'presscore_get_blank_image' ) ) :

	/**
	 * Get blank image.
	 *
	 */
	function presscore_get_blank_image() {
		return PRESSCORE_THEME_URI . '/images/1px.gif';
	}

endif; // presscore_get_blank_image

if ( ! function_exists( 'presscore_get_default_avatar' ) ) :

	/**
	 * Get default avatar.
	 *
	 * @return string.
	 */
	function presscore_get_default_avatar() {
		return PRESSCORE_THEME_URI . '/images/no-avatar.gif';
	}

endif; // presscore_get_default_avatar

if ( !function_exists('presscore_get_default_image') ) :

	/**
	 * Get default image.
	 *
	 * Return array( 'url', 'width', 'height' );
	 *
	 * @return array.
	 */
	function presscore_get_default_image() {
		return array( PRESSCORE_THEME_URI . '/images/noimage.jpg', 1000, 1000 );
	}

endif;

if ( ! function_exists( 'presscore_get_widgetareas_options' ) ) :

	/**
	 * Prepare array with widgetareas options.
	 *
	 */
	function presscore_get_widgetareas_options() {
		$widgetareas_list = array();
		$widgetareas_stored = of_get_option('widgetareas', false);
		if ( is_array($widgetareas_stored) ) {
			foreach ( $widgetareas_stored as $index=>$desc ) {
				$widgetareas_list[ 'sidebar_' . $index ] = $desc['sidebar_name'];
			}
		}

		return $widgetareas_list;
	}

endif; // presscore_get_widgetareas_options

if ( ! function_exists( 'presscore_enqueue_web_fonts' ) ) :

	/**
	 * Web fonts override.
	 *
	 */
	function presscore_enqueue_web_fonts() {
		// get web fonts from theme options
		$headers = presscore_themeoptions_get_headers_defaults();
		$buttons = presscore_themeoptions_get_buttons_defaults();

		$skin = of_get_option( 'preset' );

		$fonts = array();
		
		// main fonts
		$fonts['dt-font-basic'] = of_get_option('fonts-font_family');

		// h fonts
		foreach ( $headers as $id=>$opts ) {
			$fonts[ 'dt-font-' . $id ] = of_get_option('fonts-' . $id . '_font_family');
		}

		// buttons fonts
		foreach ( $buttons as $id=>$opts ) {
			$fonts[ 'dt-font-btn-' . $id ] = of_get_option('buttons-' . $id . '_font_family');
		}

		// menu font
		$fonts['dt-font-menu'] = of_get_option('menu-font_family');

		// submenu font
		$fonts['dt-font-submenu'] = of_get_option('submenu-font_family');

		// we do not want duplicates
		$fonts = array_unique($fonts);

		$fonts_compressor = new Presscore_Web_Fonts_Compressor();
		$compressed_fonts = $fonts_compressor->compress_fonts( presscore_filter_web_fonts( $fonts ) );
		unset( $fonts_compressor );

		wp_enqueue_style( 'dt-web-fonts', dt_make_web_font_uri( $compressed_fonts ) );
	}

endif;

if ( ! function_exists( 'presscore_filter_web_fonts' ) ) :

	function presscore_filter_web_fonts( $fonts ) {

		$web_fonts = array();
		foreach ( $fonts as $font ) {
			if ( dt_stylesheet_maybe_web_font( $font ) ) {
				$web_fonts[] = $font;
			}
		}

		return $web_fonts;
	}

endif;

if ( ! function_exists( 'presscore_comment_id_fields_filter' ) ) :

	/**
	 * PressCore comments fields filter. Add Post Comment and clear links before hudden fields.
	 *
	 * @since presscore 0.1
	 */
	function presscore_comment_id_fields_filter( $result ) {

		$comment_buttons = presscore_get_button_html( array( 'href' => 'javascript: void(0);', 'title' => __( 'clear form', LANGUAGE_ZONE ), 'class' => 'clear-form' ) );
		$comment_buttons .= presscore_get_button_html( array( 'href' => 'javascript: void(0);', 'title' => __( 'Submit', LANGUAGE_ZONE ), 'class' => 'dt-btn dt-btn-m' ) );

		return $comment_buttons . $result;
	}

endif; // presscore_comment_id_fields_filter

add_filter( 'comment_id_fields', 'presscore_comment_id_fields_filter' );

if ( ! function_exists( 'presscore_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since presscore 1.0
	 */
	function presscore_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="pingback">
			<div class="pingback-content">
				<span><?php _e( 'Pingback:', LANGUAGE_ZONE ); ?></span>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __( '(Edit)', LANGUAGE_ZONE ), ' ' ); ?>
			</div>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<article id="div-comment-<?php comment_ID(); ?>">

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->

			<div class="comment-meta">
				<time datetime="<?php comment_time( 'c' ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					// TODO: add date/time format (for qTranslate)
					printf( __( '%1$s at %2$s', LANGUAGE_ZONE ), get_comment_date(), get_comment_time() ); ?>
				</time>
				<?php edit_comment_link( __( '(Edit)', LANGUAGE_ZONE ), ' ' ); ?>
			</div><!-- .comment-meta -->

			<div class="comment-author vcard">
				<?php if ( dt_validate_gravatar( $comment->comment_author_email ) ) :	?>
					<?php echo get_avatar( $comment, 60 ); ?>
				<?php else : ?>
					<span class="avatar no-avatar"></span>
				<?php endif; ?>
				<?php printf( '<cite class="fn">%s</cite>', str_replace( 'href', 'target="_blank" href', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', LANGUAGE_ZONE ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-content"><?php comment_text(); ?></div>

			</article>

		<?php
				break;
		endswitch;
	}

endif; // presscore_comment

if ( ! function_exists( 'presscore_add_compat_header' ) ) {

	add_filter( 'wp_headers', 'presscore_add_compat_header' );

	/**
	 * [presscore_add_compat_header description]
	 * 
	 * @param  array $headers
	 * @return array
	 */
	function presscore_add_compat_header( $headers ) {
		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false) {
			$headers['X-UA-Compatible'] = 'IE=EmulateIE10';
		}
		return $headers;
	}
}

if ( ! function_exists( 'presscore_enqueue_theme_stylesheet' ) ) :

	/**
	 * [presscore_enqueue_theme_stylesheet description]
	 *
	 * @since  4.2.2
	 * 
	 * @param  string       $handle [description]
	 * @param  string|bool  $src    [description]
	 * @param  array        $deps   [description]
	 * @param  string|bool  $ver    [description]
	 * @param  string       $media  [description]
	 */
	function presscore_enqueue_theme_stylesheet( $handle, $src, $deps = array(), $ver = false, $media = 'all' ) {
		$src = get_template_directory_uri() . '/' . presscore_locate_stylesheet( $src );
		if ( ! $ver ) {
			$ver = wp_get_theme()->get( 'Version' );
		}

		wp_enqueue_style( $handle, $src, $deps, $ver, $media );
	}

endif;

if ( ! function_exists( 'presscore_enqueue_theme_script' ) ) :

	/**
	 * [presscore_enqueue_theme_script description]
	 *
	 * @since 4.2.2
	 * 
	 * @param string      $handle    Name of the script.
	 * @param string|bool $src       Path to the script from the root directory of WordPress. Example: '/js/myscript'.
	 * @param array       $deps      An array of registered handles this script depends on. Default jquery.
	 * @param string|bool $ver       Optional. String specifying the script version number, if it has one. This parameter
	 *                               is used to ensure that the correct version is sent to the client regardless of caching,
	 *                               and so should be included if a version number is available and makes sense for the script.
	 * @param bool        $in_footer Optional. Whether to enqueue the script before </head> or before </body>.
	 *                               Default 'false'. Accepts 'false' or 'true'.
	 */
	function presscore_enqueue_theme_script( $handle, $src = false, $deps = array( 'jquery' ), $ver = false, $in_footer = true ) {
		$src = get_template_directory_uri() . '/' . presscore_locate_script( $src );
		if ( ! $ver ) {
			$ver = wp_get_theme()->get( 'Version' );
		}

		wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	}

endif;

if ( ! function_exists( 'presscore_locate_asset' ) ) :

	/**
	 * Try to locate minified file first, if file not exists - return $path.$ext
	 * 
	 * @since 4.2.2
	 * 
	 * @param  string $path File path without extension
	 * @param  string $ext  File extension
	 * @return string       File path
	 */
	function presscore_locate_asset( $path, $ext = 'css' ) {
		if ( locate_template( $path . '.min.' . $ext, false ) ) {
			return $path . '.min.' . $ext;

		} else {
			return $path . '.' . $ext;

		}
	}

endif;

if ( ! function_exists( 'presscore_locate_stylesheet' ) ) :

	/**
	 * Locate stylesheet file
	 *
	 * @since 4.2.2
	 * 
	 * @param  string $path File path
	 * @return string       File path
	 */
	function presscore_locate_stylesheet( $path ) {
		return presscore_locate_asset( $path, 'css' );
	}

endif;

if ( ! function_exists( 'presscore_locate_script' ) ) :

	/**
	 * Locate script file
	 *
	 * @since 4.2.2
	 * 
	 * @param  string $path File path
	 * @return string       File path
	 */
	function presscore_locate_script( $path ) {
		return presscore_locate_asset( $path, 'js' );
	}

endif;
