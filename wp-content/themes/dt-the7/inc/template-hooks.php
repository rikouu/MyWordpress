<?php
/**
 * Theme hooks
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_microsite_header_classes' ) ) :

	// Microsite header classes filter
	function presscore_microsite_header_classes( $classes = array() ) {
		$classes[] = 'hidden-header';
		return $classes;
	}

endif;

if ( ! function_exists( 'presscore_microsite_theme_options_filter' ) ) :

	/**
	 * Microsite theme options filter.
	 *
	 */
	function presscore_microsite_theme_options_filter( $options = array(), $name = '' ) {
		global $post;

		$field_prefix = '_dt_microsite_';

		switch ( $name ) {
			case 'header-logo_regular':
				$header_logo_regular = get_post_meta( $post->ID, "{$field_prefix}header_logo_regular", true );
				if ( $header_logo_regular ) {
					$options[ $name ] = array( '', absint($header_logo_regular[0]) );
				}
				break;

			case 'header-logo_hd':
				$header_logo_hd = get_post_meta( $post->ID, "{$field_prefix}header_logo_hd", true );
				if ( $header_logo_hd ) {
					$options[ $name ] = array( '', absint($header_logo_hd[0]) );
				}
				break;

			case 'bottom_bar-logo_regular':
				$bottom_logo_regular = get_post_meta( $post->ID, "{$field_prefix}bottom_logo_regular", true );
				if ( $bottom_logo_regular ) {
					$options[ $name ] = array( '', absint($bottom_logo_regular[0]) );
				}
				break;

			case 'bottom_bar-logo_hd':
				$bottom_logo_hd = get_post_meta( $post->ID, "{$field_prefix}bottom_logo_hd", true );
				if ( $bottom_logo_hd ) {
					$options[ $name ] = array( '', absint($bottom_logo_hd[0]) );
				}
				break;

			case 'general-floating_menu_logo_regular':
				$floating_logo_regular = get_post_meta( $post->ID, "{$field_prefix}floating_logo_regular", true );
				if ( $floating_logo_regular ) {
					$options[ $name ] = array( '', absint($floating_logo_regular[0]) );
				}
				break;

			case 'general-floating_menu_logo_hd':
				$floating_logo_hd = get_post_meta( $post->ID, "{$field_prefix}floating_logo_hd", true );
				if ( $floating_logo_hd ) {
					$options[ $name ] = array( '', absint($floating_logo_hd[0]) );
				}
				break;

			case 'general-favicon':
				$favicon = get_post_meta( $post->ID, "{$field_prefix}favicon", true );
				if ( $favicon ) {
					$icon_image = wp_get_attachment_image_src( $favicon[0], 'full' );

					if ( $icon_image ) {
						$options[ $name ] = $icon_image[0];
					}
				}
				break;

			case 'general-custom_css':
				$custom_css = get_post_meta( $post->ID, "{$field_prefix}custom_css", true );
				$options[ $name ] = $custom_css;
				break;

			case 'top_bar-show':
				$hidden_parts = get_post_meta( $post->ID, "{$field_prefix}hidden_parts", false );
				if ( is_array( $hidden_parts ) ) {
					$options[ $name ] = !in_array('top_bar', $hidden_parts);
				}

				break;

			case 'header-show_floating_menu':
				$hidden_parts = get_post_meta( $post->ID, "{$field_prefix}hidden_parts", false );
				if ( is_array( $hidden_parts ) ) {
					$options[ $name ] = !in_array('floating_menu', $hidden_parts);
				}

				break;
		}

		return $options;
	}

endif;

if ( ! function_exists( 'presscore_microsite_menu_filter' ) ) :

	/**
	 * Microsite menu filter.
	 *
	 */
	function presscore_microsite_menu_filter( $options = array() ) {
		global $post;

		if ( 'primary' == $options['location'] ) {

			$page_primary_menu = get_post_meta( $post->ID, '_dt_microsite_primary_menu', true );

			if ( $page_primary_menu ) {

				$page_primary_menu = intval( $page_primary_menu );

				if ( $page_primary_menu > 0 ) {
					$options['params']['menu'] = $page_primary_menu;
					$options['params']['dt_has_nav_menu'] = true;

				} else {
					$options['force_fallback'] = true;

				}
			}

		}

		return $options;
	}

endif;

if ( ! function_exists( 'presscore_setup_floating_menu' ) ) :

	/**
	 * Set some javascript globals for floating menu and logo.
	 *
	 */
	function presscore_setup_floating_menu() {

		$show_logo = of_get_option( 'general-floating_menu_show_logo', false );
		$show_menu = of_get_option( 'header-show_floating_menu', true );
		$logo_src = '';
		$w = '';
		$h = '';

		if ( $show_menu && $show_logo ) {

			$logos = presscore_get_floating_menu_logos_meta();
			$default_logo = '';
			$r_logo = $logos['logo_retina'];
			$logo = $logos['logo'];

			// get default logo
			foreach ( $logos as $logo ) {
				if ( $logo ) { $default_logo = $logo; break; }
			}

			if ( presscore_is_srcset_based_retina() || presscore_is_logos_only_retina() ) {

				$logos = array( '1x' => $logo, '2x' => $r_logo );
				$srcset = array();

				foreach ( $logos as $xx => $_logo ) {
					if ( ! empty( $_logo ) ) {
						$srcset[] = "{$_logo[0]} {$xx}";
					}
				}

				$srcset = implode( ', ', $srcset );
				$logo = $default_logo;
				$logo[0] = $logo_src = $srcset;

				$logo_src = esc_attr($logo_src);

			} else {

				if ( $logo && !$r_logo ) { $r_logo = $logo; }
				elseif ( $r_logo && !$logo ) { $logo = $r_logo; }
				elseif ( !$r_logo && !$logo ) { $logo = $r_logo = $default_logo; } 

				if ( dt_retina_on() && dt_is_hd_device() ) {
					$logo = $r_logo;
				}

				$logo_src = isset($logo[0]) ? $logo[0] : '';
				$logo_src = esc_url($logo_src);
			}

			$w = isset($logo[1]) ? $logo[1] : '';
			$h = isset($logo[2]) ? $logo[2] : '';
		}

		?>
		<script type="text/javascript">
			dtGlobals.logoEnabled = <?php echo absint($show_logo); ?>;
			dtGlobals.logoURL = '<?php echo $logo_src; ?>';
			dtGlobals.logoW = '<?php echo absint($w); ?>';
			dtGlobals.logoH = '<?php echo absint($h); ?>';
			smartMenu = <?php echo absint($show_menu); ?>;
		</script>
		<?php
	}

endif;

add_action( 'wp_head', 'presscore_setup_floating_menu' );

if ( ! function_exists( 'presscore_header_nav_menu_class_filter' ) ) :

	/**
	 * Header color frame, header next level indicator, submenu next level indicator settings.
	 *
	 */
	function presscore_header_nav_menu_class_filter( $classes, $item, $args = array(), $depth = false ) {

		if ( false === $depth && isset($item->menu_item_parent) && '0' == $item->menu_item_parent ) {
			$depth = 0;
		}

		if ( 0 == $depth ) {

			if ( of_get_option('header-next_level_indicator', true) ) {
				$classes[] = 'level-arrows-on';
			}

		} else if ( of_get_option('header-submenu_next_level_indicator', true) ) {
			$classes[] = 'level-arrows-on';
		}

		return $classes;
	}

endif;

if ( ! function_exists( 'presscore_show_navigation_next_prev_posts_titles' ) ) :

	/**
	 * For blog posts only show next/prev posts titles.
	 *
	 */
	function presscore_show_navigation_next_prev_posts_titles( $args = array() ) {
		$args['next_post_text']	= '%title';
		$args['prev_post_text']	= '%title';
		return $args;
	}

endif;

if ( ! function_exists( 'presscore_filter_attachment_data' ) ) :

	/**
	 * Filter attachment data.
	 *
	 * @since 3.1
	 */
	function presscore_filter_attachment_data( $attachment_data = array() ) {

		// hide title
		if ( !empty($attachment_data['ID']) ) {
			$hide_title = presscore_imagee_title_is_hidden( $attachment_data['ID'] );

			if ( $hide_title ) {
				$attachment_data['title'] = '';
			}
		}

		$attachment_data['image_attachment_data'] = array(
			'alt' => $attachment_data['alt'],
			'caption' => $attachment_data['caption'],
			'description' => $attachment_data['description'],
			'title' => $attachment_data['title'],
			'permalink' => $attachment_data['permalink'],
			'video_url' => $attachment_data['video_url'],
			'ID' => $attachment_data['ID']
		);

		return $attachment_data;
	}

endif;

add_filter( 'presscore_get_attachment_post_data-attachment_data', 'presscore_filter_attachment_data', 15 );


if ( ! function_exists( 'presscore_add_default_meta_to_images' ) ) :

	/**
	 * Add description to images.
	 *
	 * TODO: use proper image attributes i.e. img_title and alt. Change all images wraps.
	 */
	function presscore_add_default_meta_to_images( $args = array() ) {

		// add description to images if it's not defined
		if ( $id = absint($args['img_id']) ) {

			$attachment = get_post( $id );

			if ( $attachment ) {

				if ( !$args['title'] ) {
					$args['title'] = esc_attr($attachment->post_content);
				}

				// set image description
				if ( empty( $args['img_description'] ) ) {
					$args['img_description'] = $attachment->post_content;
				}

			}

			$hide_title = presscore_imagee_title_is_hidden( $id );

			// use image title instead alt
			if ( $hide_title ) {
				// $args['alt'] = get_the_title( $id );
			// } else {
				$args['img_title'] = false;
			}
		}

		return $args;
	}

endif;

add_filter( 'dt_get_thumb_img-args', 'presscore_add_default_meta_to_images', 15 );


if ( ! function_exists( 'presscore_wrap_edit_link_in_p' ) ) :

	/**
	 * Wrap edit link in p tag.
	 *
	 */
	function presscore_wrap_edit_link_in_p( $link = '' ){
		if ( $link ) {
			$link = '<p>' . $link . '</p>';
		}
		return $link;
	}

endif;

add_filter( 'presscore_post_edit_link', 'presscore_wrap_edit_link_in_p', 15 );

if ( ! function_exists( 'presscore_filter_categorizer_hash_arg' ) ) :

	/**
	 * Categorizer hash filter.
	 *
	 */
	function presscore_filter_categorizer_hash_arg( $args ) {
		$config = Presscore_Config::get_instance();

		$order = $config->get('order');
		$orderby = $config->get('orderby');

		$hash = add_query_arg( array('term' => '%TERM_ID%', 'orderby' => $orderby, 'order' => $order), get_permalink() );

		$args['hash'] = $hash;

		return $args;
	}

endif;

add_filter( 'presscore_get_category_list-args', 'presscore_filter_categorizer_hash_arg', 15 );


if ( ! function_exists( 'presscore_parse_query_for_front_page_categorizer' ) ) :

	/**
	 * Add exceptions for front page templates with category filter.
	 *
	 */
	function presscore_parse_query_for_front_page_categorizer( $query ) {

		if ( $query->is_main_query() && $query->is_home && 'page' == get_option('show_on_front') && get_option('page_on_front') ) {

			$_query = wp_parse_args($query->query);

			if ( empty($_query) || !array_diff( array_keys($_query), array('term', 'order', 'orderby', 'page', 'paged', 'preview', 'cpage', 'lang') ) ) {
				$query->is_page = true;
				$query->is_home = false;
				$query->is_singular = true;

				$query->query_vars['page_id'] = get_option('page_on_front');
				// Correct <!--nextpage--> for page_on_front
				if ( !empty($query->query_vars['paged']) ) {
					$query->query_vars['page'] = $query->query_vars['paged'];
				}
			}
		}

	}

endif;

add_action( 'parse_query', 'presscore_parse_query_for_front_page_categorizer' );


if ( ! function_exists( 'presscore_filter_categorizer_current_arg' ) ) :

	/**
	 * Categorizer current filter.
	 *
	 */
	function presscore_filter_categorizer_current_arg( $args ) {
		$config = Presscore_Config::get_instance();

		$display = $config->get('request_display');

		if ( !$display ) {
			return $args;
		}

		if ( 'only' == $display['select'] && !empty($display['terms_ids']) ) {
			$args['current'] = current($display['terms_ids']);
		} else if ( 'except' == $display['select'] && 0 == current($display['terms_ids']) ) {
			$args['current'] = 'none';
		}
		return $args;
	}

endif;

if ( ! function_exists( 'presscore_react_on_categorizer' ) ) :

	/**
	 * Change config, categorizer.
	 *
	 */
	function presscore_react_on_categorizer() {

		if ( !isset($_REQUEST['term'], $_REQUEST['order'], $_REQUEST['orderby']) ) {
			return;
		}

		$config = Presscore_Config::get_instance();

		// sanitize
		if ( '' == $_REQUEST['term'] ) {
			$display = array();
		} else if ( 'none' == $_REQUEST['term'] ) {
			$display = array( 'terms_ids' => array(0), 'select' => 'except' );
		} else {
			$display = array( 'terms_ids' => array( absint($_REQUEST['term']) ), 'select' => 'only' );
		}

		$order = esc_attr($_REQUEST['order']);
		if ( in_array( $order, array( 'ASC', 'asc', 'DESC', 'desc' ) ) ) {
			$config->set('order', $order);
		}

		$orderby = esc_attr($_REQUEST['orderby']);
		if ( in_array( $orderby, array( 'name', 'date' ) ) ) {
			$config->set('orderby', $orderby);
		}

		$config->set('request_display', $display);

		add_filter( 'presscore_get_category_list-args', 'presscore_filter_categorizer_current_arg', 15 );
	}

endif;

add_action('init', 'presscore_react_on_categorizer', 15);

if ( ! function_exists( 'presscore_post_navigation_controller' ) ) :

	/**
	 * Post pagination controller.
	 */
	function presscore_post_navigation_controller() {
		if ( !in_the_loop() ) {
			return;
		}

		$show_navigation = presscore_is_post_navigation_enabled();

		// show navigation
		if ( $show_navigation ) {
			presscore_post_navigation();
		}
	}

endif;

if ( ! function_exists( 'presscore_remove_post_format_classes' ) ) :

	/**
	 * Remove post format classes.
	 */
	function presscore_remove_post_format_classes( $classes = array() ) {
		global $post;

		if ( 'post' != get_post_type( $post ) ) {
			return $classes;
		}

		$post_format = get_post_format();
		if ( !$post_format ) {
			$post_format = 'standard';
		}

		return array_diff( $classes, array('format-' . $post_format) );
	}

endif;

if ( ! function_exists( 'presscore_add_post_format_classes' ) ) :

	/**
	 * Add post format classes to post.
	 */
	function presscore_add_post_format_classes( $classes = array() ) {
		global $post;

		if ( 'post' != get_post_type( $post ) ) {
			return $classes;
		}

		$post_format_class = presscore_get_post_format_class();
		if ( $post_format_class ) {
			$classes[] = $post_format_class;
		}

		return array_unique($classes);
	}

endif;

add_filter( 'post_class', 'presscore_add_post_format_classes' );

if ( ! function_exists( 'presscore_add_password_form_to_excerpts' ) ) :

	/**
	 * Add post password form to excerpts.
	 *
	 * @return string
	 */
	function presscore_add_password_form_to_excerpts( $content ) {
		if ( post_password_required() ) {
			$content = get_the_password_form();
		}

		return $content;
	}

endif;

add_filter( 'the_excerpt', 'presscore_add_password_form_to_excerpts', 99 );

if ( ! function_exists( 'presscore_excerpt_more_filter' ) ) :

	/**
	 * Replace default excerpt more to &hellip;
	 *
	 * @return string
	 */
	function presscore_excerpt_more_filter( $more ) {
	    return '&hellip;';
	}

endif;

add_filter( 'excerpt_more', 'presscore_excerpt_more_filter' );

if ( ! function_exists( 'presscore_add_more_anchor' ) ) :

	/**
	 * Add anchor #more-{$post->ID} to href.
	 *
	 * @return string
	 */
	function presscore_add_more_anchor( $content = '' ) {
		global $post;

		if ( $post ) {
			$content = preg_replace( '/href=[\'"]?([^\'" >]+)/', 'href="$1#more-' . $post->ID . '"', $content );
		}

		// added in helpers.php:3120+
		remove_filter( 'presscore_post_details_link', 'presscore_add_more_anchor', 15 );
		return $content;
	}

endif;

if ( ! function_exists( 'presscore_return_empty_string' ) ) :

	/**
	 * Return empty string.
	 *
	 * @return string
	 */
	function presscore_return_empty_string() {
		return '';
	}

endif;

if ( ! function_exists( 'presscore_portfolio_thumbnail_change_args' ) ) :

	/**
	 * Set portfolio thumbnail sizes.
	 *
	 * @return array.
	 */
	function presscore_portfolio_thumbnail_change_args( $args = array() ) {
		global $post;
		$config = Presscore_Config::get_instance();

		// preview mode for blog
		if ( 'portfolio' == $config->get('template') && !empty($args['options']) ) {
			
			// wide portfolio
			$post_preview = get_post_meta($post->ID, '_dt_portfolio_options_preview', true);
			if ( 'wide' == $post_preview ) {
				$args['options'] = array_merge( $args['options'], array('w' => 270, 'zc' => 3, 'z' => 0) );
			}
		}

		return $args;
	}

endif;

add_filter( 'dt_portfolio_thumbnail_args', 'presscore_portfolio_thumbnail_change_args', 15 );


if ( ! function_exists( 'presscore_gallery_post_exclude_featured_image_from_gallery' ) ) :

	/**
	 * Attempt to exclude featured image from hovered gallery in albums.
	 * Works only in the loop.
	 */
	function presscore_gallery_post_exclude_featured_image_from_gallery( $args = array(), $default_args = array(), $options = array() ) {
		global $post;

		return $args;

		if ( in_the_loop() && get_post_meta( $post->ID, '_dt_album_options_exclude_featured_image', true ) ) {
			$args['custom'] = isset($args['custom']) ? $args['custom'] : trim(str_replace( $options['links_rel'], '', $default_args['custom'] ));
			$args['class'] = $default_args['class'] . ' ignore-feaured-image';
		}

		return $args;
	}

endif;

if ( ! function_exists( 'presscore_set_image_width_based_on_column_width' ) ) :

	/**
	 * Set image width for testimonials template and shortcode.
	 *
	 */
	function presscore_set_image_width_based_on_column_width( $args = array() ) {
		$config = Presscore_Config::get_instance();
		$target_width = $config->get('target_width');

		if ( $target_width ) {
			$args['options'] = array( 'w' => round($target_width * 1.5), 'z' => 0 );
		}

		return $args;
	}

endif;

add_filter( 'teammate_thumbnail_args', 'presscore_set_image_width_based_on_column_width', 15 );


if ( ! function_exists( 'presscore_add_preload_me_class_to_images' ) ) :

	/**
	 * Add preload-me to every image that created with dt_get_thumb_img().
	 *
	 */
	function presscore_add_preload_me_class_to_images( $args = array() ) {
		$img_class = $args['img_class'];
		
		// clear
		$img_class = str_replace('preload-me', '', $img_class);
		
		// add class
		$img_class .= ' preload-me';
		$args['img_class'] = trim( $img_class );

		return $args;
	}

endif;

add_filter( 'dt_get_thumb_img-args', 'presscore_add_preload_me_class_to_images', 15 );


if ( ! function_exists( 'presscore_before_post_testimonials_list' ) ) :

	/**
	 * Testimonials list layout post container.
	 *
	 */
	function presscore_before_post_testimonials_list() {
		echo '<div class="wf-cell wf-1">';
	}

endif;

if ( ! function_exists( 'presscore_before_post_masonry' ) ) :

	/**
	 * Add post open div for masonry layout.
	 */
	function presscore_before_post_masonry() {
		global $post;

		$config = Presscore_Config::get_instance();
		$post_type = get_post_type();

		$wf_class = '';

		// get post width settings
		$post_preview = 'normal';
		if ( 'post' == $post_type ) {

			$post_preview = get_post_meta($post->ID, '_dt_post_options_preview', true);
		} else if ( 'dt_portfolio' == $post_type ) {

			$post_preview = get_post_meta($post->ID, '_dt_project_options_preview', true);
		} else if ( 'dt_gallery' == $post_type ) {

			$post_preview = get_post_meta($post->ID, '_dt_album_options_preview', true);
		}

		// if posts have not same size
		if ( !$config->get('all_the_same_width') && 'wide' == $post_preview ) {
			$wf_wide = array(
				'wf-1-2'	=> 'wf-1',
				'wf-1-3'	=> 'wf-2-3',
				'wf-1-4'	=> 'wf-1-2',
			);

			$wf_class .= ' double-width';
		}

		$iso_classes = array( 'wf-cell' );
		if ( $wf_class ) {
			$iso_classes[] = $wf_class;
		}

		if ( 'masonry' == $config->get('layout') ) {
			$iso_classes[] = 'iso-item';
		}

		if ( in_array( $config->get('template'), array('portfolio', 'albums') ) ) {

			// set taxonomy based on post_type
			$tax = null;
			switch ( $post_type ) {
				case 'dt_portfolio': $tax = 'dt_portfolio_category'; break;
				case 'dt_gallery': $tax = 'dt_gallery_category'; break;
			}

			// add terms to classes
			$terms = wp_get_object_terms( $post->ID, $tax, array('fields' => 'ids') );
			if ( $terms && !is_wp_error($terms) ) {

				foreach ( $terms as $term_id ) {

					$iso_classes[] = 'category-' . $term_id;
				}
			} else {

				$iso_classes[] = 'category-0';
			}
		}

		$iso_classes = esc_attr(implode(' ', $iso_classes));

		$clear_title = $post->post_title;

		$data_attr = array(
			'data-date="' . get_the_date( 'c' ) . '"',
			'data-name="' . esc_attr($clear_title) . '"',
			'data-post-id="' . get_the_ID() . '"'
		);

		echo '<div class="' . $iso_classes . '" ' . implode(' ', $data_attr) . '>';
	}

endif;

if ( ! function_exists( 'presscore_after_post_masonry' ) ) :

	/**
	 * Add post close div for masonry layout.
	 */
	function presscore_after_post_masonry() {
		echo '</div>';
	}

endif;

if ( ! function_exists( 'presscore_page_masonry_controller' ) ) :

	add_action('presscore_before_loop', 'presscore_page_masonry_controller', 25);
	add_action('presscore_before_shortcode_loop', 'presscore_page_masonry_controller', 25);

	/**
	 * Page masonry controller.
	 *
	 * Filter classes used in post masonry wrap.
	 */
	function presscore_page_masonry_controller() {
		$config = Presscore_Config::get_instance();

		// add masonry wrap
		if ( in_array( $config->get('layout'), array('masonry', 'grid') ) ) {

			add_action('presscore_before_post', 'presscore_before_post_masonry', 15);
			add_action('presscore_after_post', 'presscore_after_post_masonry', 15);

		}
	}

endif;

if ( ! function_exists( 'presscore_remove_posts_masonry_wrap' ) ) :

	add_action('presscore_after_loop', 'presscore_remove_posts_masonry_wrap', 15);
	add_action('presscore_after_shortcode_loop', 'presscore_remove_posts_masonry_wrap', 15);

	/**
	 * Removes posts masonry wrap
	 *
	 * @since 5.0.0
	 */
	function presscore_remove_posts_masonry_wrap() {
		remove_action('presscore_before_post', 'presscore_before_post_masonry', 15);
		remove_action('presscore_after_post', 'presscore_after_post_masonry', 15);
	}

endif;

if ( ! function_exists( 'presscore_add_footer_widgetarea' ) ) :

	/**
	 * Add footer widgetarea.
	 */
	function presscore_add_footer_widgetarea() {
		get_sidebar( 'footer' );
	}

endif;

add_action('presscore_after_main_container', 'presscore_add_footer_widgetarea', 15);

if ( ! function_exists( 'presscore_add_sidebar_widgetarea' ) ) :

	/**
	 * Add sidebar widgetarea.
	 */
	function presscore_add_sidebar_widgetarea() {
		get_sidebar();
	}

endif;

add_action('presscore_after_content', 'presscore_add_sidebar_widgetarea', 15);

if ( ! function_exists( 'presscore_get_page_content_before' ) ) :

	/**
	 * Display page content before.
	 * Used in presscore_page_content_controller
	 */
	function presscore_get_page_content_before() {
		if ( get_the_content() ) {
			echo '<div class="page-info">';
			the_content();
			echo '</div>';
		}
	}

endif;

if ( ! function_exists( 'presscore_get_page_content_after' ) ) :

	/**
	 * Display page content after.
	 * Used in presscore_page_content_controller
	 */
	function presscore_get_page_content_after() {
		if ( get_the_content() ) {
			echo '<div>';
			the_content();
			echo '</div>';
		}
	}

endif;

if ( ! function_exists( 'presscore_render_3d_slider_data' ) ) :

	/**
	 * Render 3D slider.
	 *
	 */
	function presscore_render_3d_slider_data() {
		global $post;
		$config = Presscore_Config::get_instance();

		$slider_id = $config->get('slideshow_sliders');
		$slideshows = Presscore_Inc_Slideshow_Post_Type::get_by_id( $slider_id );

		if ( !$slideshows || !$slideshows->have_posts() ) {
			return;
		}

		$slides = array();
		foreach ( $slideshows->posts as $slideshow ) {

			$media_items = get_post_meta( $slideshow->ID, '_dt_slider_media_items', true );
			if ( empty($media_items) ) {
				continue;
			}

			$slides = array_merge( $slides, $media_items );
		}

		$attachments_data = presscore_get_attachment_post_data( $slides );

		$count = count($attachments_data);
		if ( $count < 10 ) {

			$chunks = array( $attachments_data, array(), array() );
		} else {

			$length = ceil( $count/3 );
			$chunks = array_chunk( $attachments_data, $length );
		}

		$chunks = array_reverse( $chunks );

		foreach ( $chunks as $layer=>$images ) {

			printf( '<div id="level%d" class="plane">' . "\n", $layer + 1 );

			foreach ( $images as $img ) {
				printf( '<img src="%s" alt="%s" />' . "\n", esc_url($img['full']), esc_attr($img['description']) );
			}

			echo "</div>\n";
		}

	}

endif;

if ( ! function_exists( 'presscore_post_meta_new_general_controller' ) ) :

	/**
	 * Controlls display of post meta for general purpose.
	 */
	function presscore_post_meta_new_general_controller() {
		// add filters
		add_filter('presscore_new_posted_on', 'presscore_get_post_data', 12);
		add_filter('presscore_new_posted_on', 'presscore_get_post_author', 13);
		add_filter('presscore_new_posted_on', 'presscore_get_post_categories', 14);
		add_filter('presscore_new_posted_on', 'presscore_get_post_comments', 15);

		// add wrap
		add_filter('presscore_new_posted_on', 'presscore_get_post_meta_wrap', 16, 2);

	}

endif;

add_action('presscore_before_main_container', 'presscore_post_meta_new_general_controller', 15);


if ( ! function_exists( 'presscore_page_content_controller' ) ) :

	/**
	 * Show content for blog'like page templates.
	 *
	 * Uses template settings.
	 */
	function presscore_page_content_controller() {
		global $post;

		// if is not page - return
		if ( !is_page() ) {
			return;
		}

		$display_content = get_post_meta( $post->ID, '_dt_content_display',  true );

		// if content hidden - return
		if ( !$display_content || 'no' == $display_content ) {
			return;
		}

		// only for first page
		if ( 'on_first_page' == $display_content && dt_get_paged_var() > 1 ) {
			return;
		}

		$content_position = get_post_meta( $post->ID, '_dt_content_position',  true );

		if ( 'before_items' == $content_position ) {

			add_action('presscore_before_loop', 'presscore_get_page_content_before', 20);
		} else {

			add_action('presscore_after_loop', 'presscore_get_page_content_after', 20);
		}
	}

endif;

if ( ! function_exists( 'presscore_new_header_nav_menu_class_filter' ) ) :

	/**
	 * Header color frame, header next level indicator, submenu next level indicator settings.
	 *
	 */
	function presscore_new_header_nav_menu_class_filter( $classes, $item, $args = array(), $depth = false ) {

		if ( false === $depth && isset($item->menu_item_parent) && '0' == $item->menu_item_parent ) {
			$depth = 0;
		}

		if ( 0 == $depth ) {

			if ( 'background' == of_get_option( 'menu-decoration_style' ) ) {
				$classes[] = 'menu-frame-on';
			}

			if ( of_get_option('menu-next_level_indicator', true) ) {
				$classes[] = 'level-arrows-on';
			}

		} else if ( of_get_option('submenu-next_level_indicator', true) ) {
			$classes[] = 'level-arrows-on';
		}

		return $classes;
	}

endif;


if ( ! function_exists( 'presscore_add_main_menu_classes' ) ) :

	function presscore_add_main_menu_classes() {
		add_filter( 'nav_menu_css_class', 'presscore_new_header_nav_menu_class_filter', 15, 4 );
		add_filter( 'page_css_class', 'presscore_new_header_nav_menu_class_filter', 15, 4 );
	}

endif;

add_action( 'presscore_primary_navigation', 'presscore_add_main_menu_classes', 14 );


if ( ! function_exists( 'presscore_remove_main_menu_classes' ) ) :

	function presscore_remove_main_menu_classes() {
		remove_filter( 'nav_menu_css_class', 'presscore_new_header_nav_menu_class_filter', 15, 4 );
		remove_filter( 'page_css_class', 'presscore_new_header_nav_menu_class_filter', 15, 4 );
	}

endif;

add_action( 'presscore_primary_navigation', 'presscore_remove_main_menu_classes', 16 );


if ( ! function_exists( 'presscore_add_primary_menu' ) ) :

	/**
	 * Primary navigation menu.
	 *
	 */
	function presscore_add_primary_menu() {
		$config = presscore_get_config();
		$logo_align = of_get_option( 'header-layout', 'left' );
	?>
		<!-- !- Navigation -->
		<nav id="navigation"<?php if ( 'left' == $logo_align ) { echo ' class="wf-td"'; } ?>>
			<?php
			$main_menu_classes = array( 'fancy-rollovers', 'wf-mobile-hidden' );

			if ( presscore_is_gradient_color_mode( of_get_option( 'menu-hover_decoration_color_mode' ) ) ) {
				$main_menu_classes[] = 'gradient-decor';
			}

			$please_be_fat = true;

			if ( 'side' == $logo_align ) {

				if ( ! of_get_option( 'header-side_menu_lines', true ) ) {
					$main_menu_classes[] = 'divider-off';
				}

				switch ( of_get_option( 'header-side_menu_align', 'left' ) ) {
					case 'right': $main_menu_classes[] = 'text-right'; break;
					case 'center': $main_menu_classes[] = 'text-center'; break;
				}

				if ( 'down' == $config->get( 'header.layout.side.menu.dropdown.style' ) ) {
					$please_be_fat = false;
				}

			}

			switch( of_get_option( 'menu-decoration_style' ) ) {
				case 'underline':
					$main_menu_classes[] = 'underline-hover';
					break;
				case 'brackets':
					$main_menu_classes[] = 'brackets';
					break;
				case 'downwards':
					$main_menu_classes[] = 'downwards-effect';
					break;
				case 'upwards':
					$main_menu_classes[] = 'upwards-effect';
					break;
			}

			$submenu_classes = array( 'sub-nav' );
			if ( $submenu_color_mode_class = presscore_get_color_mode_class( of_get_option( 'submenu-hover_font_color_mode' ) ) ) {
				$submenu_classes[] = $submenu_color_mode_class;
			}

			dt_menu( array(
				'menu_wraper' 		=> '<ul id="main-nav" class="' . esc_attr( implode( ' ', $main_menu_classes ) ) . '">%MENU_ITEMS%' . "\n" . '</ul>',
				'menu_items'		=>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%"%ESC_ITEM_TITLE%>%ICON%<span>%ITEM_TITLE%%SPAN_DESCRIPTION%</span></a>%SUBMENU%</li> ',
				'submenu' 			=> '<div class="' . esc_attr( implode( ' ', $submenu_classes ) ) . '"><ul>%ITEM%</ul></div>',
				'parent_clicable'	=> of_get_option( 'submenu-parent_clickable', true ),
				'params'			=> array( 'act_class' => 'act', 'please_be_mega_menu' => true, 'please_be_fat' => $please_be_fat ),
			) );

			if ( ! ( class_exists( 'UberMenuStandard', false ) && has_nav_menu( 'primary' ) ) ) :

				$mobile_menu_class = '';
				if ( 'accent' == of_get_option( 'header-mobile-menu_color', 'accent' ) ) {
					$mobile_menu_class = ' class="accent-bg"';
				}

			?>

				<a href="#show-menu" rel="nofollow" id="mobile-menu"<?php echo $mobile_menu_class; ?>>
					<span class="menu-open"><?php _e( 'Menu', LANGUAGE_ZONE ); ?></span>
					<span class="menu-back"><?php _e( 'back', LANGUAGE_ZONE ); ?></span>
					<span class="wf-phone-visible">&nbsp;</span>
				</a>

			<?php endif; ?>

			<?php
			$nav_area_class = ( 'left' == $logo_align ? '': 'wf-td' );
			// if ( 'left' != $logo_align ) :
			presscore_render_header_elements( 'nav_area', $nav_area_class );
			// endif;
			?>

		</nav>

		<?php
		// if ( 'left' == $logo_align ) :
		// 	presscore_render_header_elements( 'nav_area' );
		// endif;
		?>
	<?php
	}

endif;

add_action( 'presscore_primary_navigation', 'presscore_add_primary_menu', 15 );

if ( ! function_exists( 'presscore_fancy_header_controller' ) ) :

	/**
	 * Fancy header controller.
	 *
	 */
	function presscore_fancy_header_controller() {
		$config = Presscore_Config::get_instance();

		if ( 'fancy' != $config->get('header_title') ) {
			return;
		}

		/////////////
		// title //
		/////////////

		$title = '';
		$custom_title = ( 'generic' == $config->get('fancy_header.title.mode') ) ? presscore_get_page_title() : $config->get('fancy_header.title');

		if ( $custom_title ) {

			$title_class = presscore_get_font_size_class( $config->get('fancy_header.title.font.size') );
			if ( 'accent' == $config->get('fancy_header.title.color.mode') ) {
				$title_class .= ' color-accent';
			}

			$title .= sprintf( '<h1 class="fancy-title entry-title %s"', $title_class );

			if ( 'color' == $config->get('fancy_header.title.color.mode') ) {
				$title .= ' style="color: ' . esc_attr( $config->get('fancy_header.title.color') ) . '"';
			}

			$title .= '><span>' . wp_kses_post( $custom_title ) . '</span></h1>';

		}

		////////////////
		// subtitle //
		////////////////

		if ( $config->get('fancy_header.subtitle') ) {

			$subtitle_class = presscore_get_font_size_class( $config->get('fancy_header.subtitle.font.size') );
			if ( 'accent' == $config->get('fancy_header.subtitle.color.mode') ) {
				$subtitle_class .= ' color-accent';
			}

			$title .= sprintf( '<h2 class="fancy-subtitle %s"', $subtitle_class );

			if ( 'color' == $config->get('fancy_header.subtitle.color.mode') ) {
				$title .= ' style="color: ' . esc_attr( $config->get('fancy_header.subtitle.color') ) . '"';
			}

			$title .= '><span>' . wp_kses_post( $config->get('fancy_header.subtitle') ) . '</span></h2>'; 

		}

		// container class
		$container_classes = array( 'fancy-header' );

		if ( $title ) {
			$title = '<div class="wf-td hgroup">' . $title . '</div>';

		// if title and subtitle empty
		} else {
			$container_classes[] = 'titles-off';

		}

		//////////////////
		// bredcrumbs //
		//////////////////

		$breadcrumbs = '';
		if ( 'enabled' == $config->get( 'fancy_header.breadcrumbs' ) ) {

			$breadcrumbs_args = array(
				'beforeBreadcrumbs' => '<div class="wf-td">',
				'afterBreadcrumbs' => '</div>'
			);

			$breadcrumbs_class = 'breadcrumbs text-normal';

			switch ( $config->get( 'fancy_header.breadcrumbs.bg_color' ) ) {
				case 'black':
					$breadcrumbs_class .= ' bg-dark breadcrumbs-bg';
					break;

				case 'white':
					$breadcrumbs_class .= ' bg-light breadcrumbs-bg';
					break;
			}

			$breadcrumbs_args['listAttr'] = ' class="' . $breadcrumbs_class . '"';

			$breadcrumbs_text_color = $config->get( 'fancy_header.breadcrumbs.text_color' );
			if ( $breadcrumbs_text_color ) {
				$breadcrumbs_args['listAttr'] .= ' style="color: ' . $breadcrumbs_text_color . ';"';
			}

			$breadcrumbs = presscore_get_breadcrumbs( $breadcrumbs_args );

		} else {
			$container_classes[] = 'breadcrumbs-off';

		}

		/////////////////
		// container //
		/////////////////

		$content = $title . $breadcrumbs;
		switch ( $config->get('fancy_header.title.aligment') ) {
			case 'center': $container_classes[] = 'title-center'; break;
			case 'right':
				$container_classes[] = 'title-right';
				$content = $breadcrumbs . $title;
				break;
			case 'all_left':
				$container_classes[] = 'content-left';
				break;
			case 'all_right':
				$container_classes[] = 'content-right';
				break;
			default: $container_classes[] = 'title-left';
		}

		////////////////
		// parallax //
		////////////////

		$data_attr = array();
		$parallax_speed = $config->get('fancy_header.parallax.speed');
		if ( $parallax_speed ) {
			$container_classes[] = 'fancy-parallax-bg';

			$data_attr[] = 'data-prlx-speed="' . $parallax_speed . '"';
		}

		///////////////////////
		// container style //
		///////////////////////

		$container_style = array();
		if ( $config->get('fancy_header.bg.color') ) {
			$container_style[] = 'background-color: ' . $config->get('fancy_header.bg.color');
		}

		if ( $config->get('fancy_header.bg.image') ) {

			$image_meta = wp_get_attachment_image_src( current($config->get('fancy_header.bg.image')), 'full' );
			if ( $image_meta ) {

				if ( $config->get('fancy_header.bg.fullscreen') ) {

					$bg_size = 'cover';
					$repeat = 'no-repeat';

				} else {

					$bg_size = 'auto auto';
					$repeat = $config->get('fancy_header.bg.repeat');

				}

				$container_style[] = "background-size: {$bg_size}";
				$container_style[] = "background-repeat: {$repeat}";
				$container_style[] = "background-image: url({$image_meta[0]})";

				$position_x = $config->get('fancy_header.bg.position.x');
				$position_y = $config->get('fancy_header.bg.position.y');
				$container_style[] = "background-position: {$position_x} {$position_y}";

				if ( $config->get('fancy_header.bg.fixed') ) {

					$container_style[] = 'background-attachment: fixed';

				}

			}

		}

		/////////////////////
		// header height //
		/////////////////////

		$min_h_height = ' style="min-height: ' . $config->get('fancy_header.height') . 'px;"';
		$wf_table_height = ' style="height: ' . $config->get('fancy_header.height') . 'px;"';
		$container_style[] = 'min-height: ' . $config->get('fancy_header.height') . 'px';

		//////////////
		// output //
		//////////////

		printf(
			'<header id="fancy-header" class="%1$s" style="%2$s" %3$s>
			<div class="wf-wrap">
				<div class="wf-table"%5$s>%4$s</div>
			</div>
			</header>',
			esc_attr( implode( ' ', $container_classes ) ),
			esc_attr( implode( '; ', $container_style ) ),
			implode( ' ', $data_attr ),
			$content,
			$wf_table_height,
			$min_h_height
		);
	}

endif;

add_action('presscore_before_main_container', 'presscore_fancy_header_controller', 15);

if ( ! function_exists( 'presscore_page_title_controller' ) ) :

	function presscore_page_title_controller() {
		$config = Presscore_Config::get_instance();

		if ( ! ( $config->get( 'page_title.enabled' ) || $config->get( 'page_title.breadcrumbs.enabled' ) ) ) {
			return;
		}

		$show_page_title = ( presscore_is_post_title_enabled() && presscore_is_content_visible() );
		if ( ! $show_page_title ) {
			return;
		}

		$page_title_wrap_attrs = '';

		$parallax_speed = $config->get( 'page_title.background.parallax_speed' );
		if ( $parallax_speed ) {
			$page_title_wrap_attrs .= ' data-prlx-speed="' . $parallax_speed . '"';
		}

		$title_height = absint( $config->get( 'page_title.height' ) );
		$page_title_wrap_attrs .= ' style="min-height: ' . $title_height . 'px;"';

		$page_title_wrap_table_style = ' style="height: ' . $title_height . 'px;"';

		?>

		<div <?php echo presscore_get_page_title_wrap_html_class( 'page-title' ), $page_title_wrap_attrs; ?>>
			<div class="wf-wrap">
				<div class="wf-container-title">
					<div class="wf-table"<?php echo $page_title_wrap_table_style; ?>>

						<?php
						// get page title
						if ( $config->get( 'page_title.enabled' ) ) {
							$page_title = '<div class="wf-td hgroup"><h1 ' . presscore_get_page_title_html_class() . '>' . presscore_get_page_title() . '</h1></div>';
						} else {
							$page_title = '';
						}
						$page_title = apply_filters( 'presscore_page_title', $page_title );

						// get breadcrumbs
						if ( $config->get( 'page_title.breadcrumbs.enabled' ) ) {
							$breadcrumbs = presscore_get_page_title_breadcrumbs();
						} else {
							$breadcrumbs = '';
						}

						// output
						if ( 'right' == $config->get( 'page_title.align' ) ) {
							echo $breadcrumbs, $page_title;
						} else {
							echo $page_title, $breadcrumbs;
						}
						?>

					</div>
				</div>
			</div>
		</div>

		<?php

	}

endif;
add_action('presscore_before_main_container', 'presscore_page_title_controller', 16);

if ( ! function_exists( 'presscore_single_album_photo_scroller_controller' ) ) :

	function presscore_single_album_photo_scroller_controller() {

		$config = Presscore_Config::get_instance();
		if ( !is_single() || 'dt_gallery' != get_post_type() || 'photo_scroller' != $config->get( 'post.media.type' ) || post_password_required() ) {
			return '';
		}

		$media_items = $config->get( 'post.media.library' );
		$args = array(
			'background_color' => $config->get( 'post.media.photo_scroller.background.color' ),

			'padding_top' => $config->get( 'post.media.photo_scroller.padding.top' ),
			'padding_bottom' => $config->get( 'post.media.photo_scroller.padding.bottom' ),
			'padding_side' => $config->get( 'post.media.photo_scroller.padding.side' ),

			'autoplay' => ( 'play' == $config->get( 'post.media.photo_scroller.autoplay.mode' ) ),
			'autoplay_speed' => $config->get( 'post.media.photo_scroller.autoplay.speed' ),

			'thumbnails_visibility' => $config->get( 'post.media.photo_scroller.thumbnails.visibility' ),
			'thumbnails_width' => $config->get( 'post.media.photo_scroller.thumbnail.width' ),
			'thumbnails_height' => $config->get( 'post.media.photo_scroller.thumbnail.height' ),

			'portrait_images_view' => array(
				'max_width' => $config->get( 'post.media.photo_scroller.behavior.portrait.width.max' ),
				'min_width' => $config->get( 'post.media.photo_scroller.behavior.portrait.width.min' ),
				'fill_desktop' => $config->get( 'post.media.photo_scroller.behavior.portrait.fill.desktop' ),
				'fill_mobile' => $config->get( 'post.media.photo_scroller.behavior.portrait.fill.mobile' )
			),
			'landscape_images_view' => array(
				'max_width' => $config->get( 'post.media.photo_scroller.behavior.landscape.width.max' ),
				'min_width' => $config->get( 'post.media.photo_scroller.behavior.landscape.width.min' ),
				'fill_desktop' => $config->get( 'post.media.photo_scroller.behavior.landscape.fill.desktop' ),
				'fill_mobile' => $config->get( 'post.media.photo_scroller.behavior.landscape.fill.mobile' )
			),

			'inactive_opacity' => $config->get( 'post.media.photo_scroller.inactive.opacity' ),
			'show_overlay' => $config->get( 'post.media.photo_scroller.overlay.enabled' )
		);
		$photo_scroller = new Presscore_PhotoScroller( $media_items, $args );

		if ( $photo_scroller->have_slides() ) {

			echo $photo_scroller->get_html();

			// do not show post title
			$config->set( 'page_title.enabled', false );

			// do not show post navigation
			$config->set( 'post.navigation.arrows.enabled', false );
			$config->set( 'post.navigation.back_button.enabled', false );

			$config->set( 'post.meta.fields.date', false );
			$config->set( 'post.meta.fields.categories', false );
			$config->set( 'post.meta.fields.comments', false );
			$config->set( 'post.meta.fields.author', false );
		}
	}

endif;
add_action( 'presscore_before_main_container', 'presscore_single_album_photo_scroller_controller', 10 );

if ( ! function_exists( 'presscore_portfolio_meta_new_controller' ) ) :

	/**
	 * Controlls display of dt_portfolio meta.
	 */
	function presscore_portfolio_meta_new_controller() {
		add_filter('presscore_new_posted_on-dt_portfolio', 'presscore_get_post_meta_wrap', 16, 2);
	}

endif;
add_action('presscore_before_main_container', 'presscore_portfolio_meta_new_controller', 15);

if ( ! function_exists( 'presscore_post_meta_new_controller' ) ) :

	/**
	 * Controlls display of post meta.
	 */
	function presscore_post_meta_new_controller() {

		// add wrap
		add_filter('presscore_new_posted_on-post', 'presscore_get_post_meta_wrap', 16, 2);

	}

endif;

add_action('presscore_before_main_container', 'presscore_post_meta_new_controller', 15);


if ( ! function_exists( 'presscore_post_meta_new_gallery_controller' ) ) :

	/**
	 * Controlls display of post meta for dt_gallery.
	 */
	function presscore_post_meta_new_gallery_controller() {

		add_filter( 'presscore_new_posted_on-dt_gallery', 'presscore_get_post_meta_wrap', 20, 2 );
	}

endif;
add_action('presscore_before_main_container', 'presscore_post_meta_new_gallery_controller', 15);

if ( ! function_exists( 'presscore_before_comment_form' ) ) :

	function presscore_before_comment_form() { ?>

		<div class="dt-fancy-separator title-left fancy-comments-form">
			<div class="dt-fancy-title"><?php _e( 'Leave Comment', LANGUAGE_ZONE ); ?><span class="separator-holder separator-right"></span></div>
		</div>

	<?php }

endif;
add_action( 'comment_form_before', 'presscore_before_comment_form' );


if ( ! function_exists( 'presscore_post_class_filter' ) ) :

	/**
	 * Add post format classes to post.
	 */
	function presscore_post_class_filter( $classes = array() ) {
		$config = Presscore_Config::get_instance();

		$is_archive = is_search() || is_archive();

		// post preview width
		if ( !$is_archive && 'wide' == $config->get( 'post.preview.width' ) ) {
			$classes[] = 'media-wide';
		}

		// post preview background
		if ( $config->get( 'post.preview.background.enabled' ) ) {
			$classes[] = 'bg-on';
		}

		$current_layout_type = presscore_get_current_layout_type();

		// only for layouts from masonry family
		if ( 'masonry' == $current_layout_type ) {

			// fullwidth preview background
			if ( $config->get( 'post.preview.background.enabled' ) && 'fullwidth' == $config->get( 'post.preview.background.style' ) ) {
				$classes[] = 'fullwidth-img';
			}

			if ( ! $config->get( 'post.media.library' ) && ! has_post_thumbnail() ) {
				$classes[] = 'no-img';
			}

			// preview content alignment
			if ( 'center' == $config->get( 'post.preview.description.alignment' ) ) {
				$classes[] = 'text-centered';
			}

		}

		if ( ! $config->get( 'post.preview.content.visible' ) ) {
			$classes[] = 'description-off';
		}

		if ( is_single() ) {

			$hentry_key = array_search( 'hentry', $classes );
			if ( $hentry_key !== false ) {
				unset( $classes[ $hentry_key ] );
			}

		}

		return $classes;
	}

endif;

add_filter( 'post_class', 'presscore_post_class_filter' );

if ( ! function_exists( 'presscore_add_sorting_for_category_list' ) ) :

	/**
	 * Add sorting fields to category list.
	 */
	function presscore_add_sorting_for_category_list( $html ) {
		return $html . presscore_get_categorizer_sorting_fields();
	}

endif;

add_filter( 'presscore_get_category_list', 'presscore_add_sorting_for_category_list', 15 );

if ( ! function_exists( 'presscore_add_wrap_for_catgorizer' ) ) :

	/**
	 * Categorizer wrap.
	 *
	 */
	function presscore_add_wrap_for_catgorizer( $html, $args ) {
		if ( $html ) {

			// get class or use default one
			$class = empty($args['class']) ? 'filter' : $args['class'];

			// wrap categorizer
			$html = '<div class="' . esc_attr($class) . '">' . $html . '</div>';
		}

		return $html;
	}

endif;

add_filter( 'presscore_get_category_list', 'presscore_add_wrap_for_catgorizer', 16, 2 );

if ( ! function_exists( 'presscore_add_thumbnail_class_for_masonry' ) ) :

	/**
	 * Add proportions to images.
	 *
	 * @return array.
	 */
	function presscore_add_thumbnail_class_for_masonry( $args = array() ) {
		$config = Presscore_Config::get_instance();
		$thumb_proportions = $config->get('thumb_proportions');

		if ( 'resize' == $config->get('image_layout') && $thumb_proportions ) {

			if ( is_array($thumb_proportions) ) {
				$width = ($thumb_proportions['width'] > 0) ? absint($thumb_proportions['width']) : 1;
				$height = ($thumb_proportions['height'] > 0) ? absint($thumb_proportions['height']) : 1;

				$args['prop'] = $width / $height;
			} else {
				$args['prop'] = presscore_meta_boxes_get_images_proportions( $thumb_proportions );
			}

		}

		return $args;
	}

endif;

add_filter( 'dt_portfolio_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'dt_post_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'dt_album_title_image_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'dt_media_image_args', 'presscore_add_thumbnail_class_for_masonry', 15 );
add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_add_thumbnail_class_for_masonry', 15 );

if ( ! function_exists( 'presscore_microsite_add_loader_div' ) ) :

	/**
	 * Microsite body loader. Used in template-microsite.php
	 *
	 */
	function presscore_microsite_add_loader_div() {
		switch ( presscore_get_config()->get( 'template.beautiful_loading' ) ) {
			case 'accent':
				echo '<div id="load"><div class="pace pace-active"><div class="pace-activity"></div></div></div>';
				break;
			case 'light':
				echo '<div id="load" class="light-loading"><div class="pace pace-active"><div class="pace-activity"></div></div></div>';
				break;
		}
	}

	add_action( 'presscore_body_top', 'presscore_microsite_add_loader_div' );

endif;

if ( ! function_exists( 'presscore_render_porthole_slider_data' ) ) :

	/**
	 * Porthole slider data.
	 *
	 */
	function presscore_render_porthole_slider_data() {
		global $post;
		$config = Presscore_Config::get_instance();

		$slider_id = $config->get('slideshow_sliders');
		$slideshows = Presscore_Inc_Slideshow_Post_Type::get_by_id( $slider_id );

		if ( !$slideshows || !$slideshows->have_posts() ) return;

		$slides = array();
		foreach ( $slideshows->posts as $slideshow ) {
			$media_items = get_post_meta( $slideshow->ID, '_dt_slider_media_items', true );
			if ( empty($media_items) ) continue;

			$slides = array_merge( $slides, $media_items );
		}
		$slides = array_unique($slides);

		$media_args = array(
			'posts_per_page'	=> -1,
			'post_type'         => 'attachment',
			'post_mime_type'    => 'image',
			'post_status'       => 'inherit',
			'post__in'			=> $slides,
			'orderby'			=> 'post__in',
		);
		$media_query = new WP_Query( $media_args );

		// prepare data
		if ( $media_query->have_posts() ) {

			echo '<ul id="main-slideshow-content" class="royalSlider rsHomePorthole">';

			while ( $media_query->have_posts() ) { $media_query->the_post();

				$video_url = get_post_meta( $post->ID, 'dt-video-url', true );
				$img_link = get_post_meta( $post->ID, 'dt-img-link', true );
				$thumb_meta = wp_get_attachment_image_src( $post->ID, 'thumbnail' );
				$hide_title = presscore_imagee_title_is_hidden( $post->ID );

				$img_custom = 'data-rsTmb="' . $thumb_meta[0] . '"';
				if ( $video_url ) {
					$img_custom .= ' data-rsVideo="' . esc_url( $video_url ) . '"';
				}

				$img_args = array(
					'img_meta'	=> wp_get_attachment_image_src( $post->ID, 'full' ),
					'img_id'	=> $post->ID,
					'img_class'	=> 'rsImg',
					'custom'	=> $img_custom,
					'echo'		=> false,
					'wrap'		=> '<img %IMG_CLASS% %SRC% %CUSTOM% %ALT% %SIZE% />',
				);
				$image = dt_get_thumb_img( $img_args );

				$caption = '';

				if ( !$config->get('slideshow_hide_captions') ) {

					if ( !$hide_title && $title = get_the_title() ) {
						$caption .= '<div class="rsTitle">' . $title . '</div>';
					}

					if ( $content = get_the_content() ) {
						$caption .= '<div class="rsDesc">' . $content . '</div>';
					}

					if ( $caption ) {
						$caption = sprintf( '<figure class="rsCapt rsABlock">%s</figure>', $caption );
					}

					if ( $img_link ) {
						$caption = sprintf( '<a class="rsCLink" href="%s"><span class="assistive-text">%s</span></a>',
							esc_url( $img_link ),
							_x('details', 'header slideshow', LANGUAGE_ZONE)
						) . $caption;
					}
				}

				printf( '<li>%s</li>', $image . $caption );
			}
			wp_reset_postdata();

			echo '</ul>';
		}
	}

endif;

if ( ! function_exists( 'presscore_slideshow_controller' ) ) :

	/**
	 * Slideshow controller.
	 *
	 */
	function presscore_slideshow_controller() {
		global $post;
		$config = Presscore_Config::get_instance();

		if ( 'slideshow' != $config->get('header_title') ){
			return;
		}

		$slider_id = $config->get('slideshow_sliders');

		// turn off regular titles and breadcrumbs
		remove_action('presscore_before_main_container', 'presscore_page_title_controller', 16);

		if ( dt_get_paged_var() > 1 ) {
			return;
		}

		switch ( $config->get('slideshow_mode') ) {
			case 'porthole':
				$class = 'fixed' == $config->get('slideshow_layout') ? 'class="fixed" ' : '';

				$height = absint($config->get( 'slideshow_slider_height' ));
				$width = absint($config->get( 'slideshow_slider_width' ));
				if ( !$height ) {
					$height = 500;
				}

				if ( !$width ) {
					$width = 1200;
				}

				printf( '<div id="main-slideshow" %sdata-width="%d" data-height="%d" data-autoslide="%d" data-scale="%s" data-paused="%s"></div>',
					$class,
					$width,
					$height,
					absint($config->get('slideshow_autoslide_interval')),
					'fit' == $config->get('slideshow_slider_scaling') ? 'fit' : 'fill',
					'paused' == $config->get('slideshow_autoplay') ? 'true' : 'false'
				);

				add_action( 'wp_footer', 'presscore_render_porthole_slider_data', 15 );

				break;

			case 'photo_scroller':
				$slideshow = Presscore_Inc_Slideshow_Post_Type::get_by_id( $slider_id );

				// prepare data
				if ( $slideshow->have_posts() ) {

					$slides = array();

					while ( $slideshow->have_posts() ) {

						$slideshow->the_post();

						$media_items = get_post_meta( $post->ID, '_dt_slider_media_items', true );
						if ( empty( $media_items ) ) {
							continue;
						}

						$slides = array_merge( $slides, $media_items );
					}
					wp_reset_postdata();
				}

				$photo_scroller = new Presscore_PhotoScroller( $slides, array(
					'background_color' => $config->get( 'slideshow.photo_scroller.background.color' ),

					'padding_top' => $config->get( 'slideshow.photo_scroller.padding.top' ),
					'padding_bottom' => $config->get( 'slideshow.photo_scroller.padding.bottom' ),
					'padding_side' => $config->get( 'slideshow.photo_scroller.padding.side' ),

					'autoplay' => ( 'play' == $config->get( 'slideshow.photo_scroller.autoplay.mode' ) ),
					'autoplay_speed' => $config->get( 'slideshow.photo_scroller.autoplay.speed' ),

					'thumbnails_visibility' => $config->get( 'slideshow.photo_scroller.thumbnails.visibility' ),
					'thumbnails_width' => $config->get( 'slideshow.photo_scroller.thumbnail.width' ),
					'thumbnails_height' => $config->get( 'slideshow.photo_scroller.thumbnail.height' ),

					'portrait_images_view' => array(
						'max_width' => $config->get( 'slideshow.photo_scroller.behavior.portrait.width.max' ),
						'min_width' => $config->get( 'slideshow.photo_scroller.behavior.portrait.width.min' ),
						'fill_desktop' => $config->get( 'slideshow.photo_scroller.behavior.portrait.fill.desktop' ),
						'fill_mobile' => $config->get( 'slideshow.photo_scroller.behavior.portrait.fill.mobile' )
					),
					'landscape_images_view' => array(
						'max_width' => $config->get( 'slideshow.photo_scroller.behavior.landscape.width.max' ),
						'min_width' => $config->get( 'slideshow.photo_scroller.behavior.landscape.width.min' ),
						'fill_desktop' => $config->get( 'slideshow.photo_scroller.behavior.landscape.fill.desktop' ),
						'fill_mobile' => $config->get( 'slideshow.photo_scroller.behavior.landscape.fill.mobile' )
					),

					'inactive_opacity' => $config->get( 'slideshow.photo_scroller.inactive.opacity' ),
					'show_overlay' => $config->get( 'slideshow.photo_scroller.overlay.enabled' ),
					'show_post_navigation' => false,
					'show_share_buttons' => false
				) );

				if ( $photo_scroller->have_slides() ) {

					echo $photo_scroller->get_html();

				}

				break;
/*
			case 'metro':
				$slideshow = Presscore_Inc_Slideshow_Post_Type::get_by_id( $slider_id );

				// prepare data
				if ( $slideshow->have_posts() ) {

					$slideshow_objects = array();

					while ( $slideshow->have_posts() ) {

						$slideshow->the_post();

						$media_items = get_post_meta( $post->ID, '_dt_slider_media_items', true );
						if ( empty($media_items) ) {
							continue;
						}

						$attachments_data = presscore_get_attachment_post_data( $media_items );

						if ( count($attachments_data) > 1 ) {

							$object = array();
							foreach ( $attachments_data as $array ) {
								$object[] = Presscoe_Inc_Classes_SwapperSlider::array_to_object( $array );
							}
						} else {

							$object = Presscoe_Inc_Classes_SwapperSlider::array_to_object( current($attachments_data) );
						}

						$slideshow_objects[] = $object;
					}
					wp_reset_postdata();
					
					echo Presscoe_Inc_Classes_SwapperSlider::get_html( $slideshow_objects );
				}
				break;
*/
			case '3d':

				$class = '';
				$data_attr = '';
				$slider_layout = $config->get('slideshow_3d_layout');

				if ( in_array( $slider_layout, array( 'prop-fullwidth', 'prop-content-width' ) ) ) {

					$class = ('prop-fullwidth' == $slider_layout) ? 'class="fixed-height" ' : 'class="fixed" ';

					$width = $config->get('slideshow_3d_slider_width');
					$height = $config->get('slideshow_3d_slider_height');
					$data_attr = sprintf( ' data-width="%d" data-height="%d"',
						$width ? absint($width) : 2500,
						$height ? absint($height) : 1200
					);
				}

				printf( '<div id="main-slideshow" %s><div class="three-d-slider"%s><span id="loading">0</span></div></div>',
					$class,
					$data_attr
				);

				add_action( 'wp_footer', 'presscore_render_3d_slider_data', 15 );

				break;

			case 'revolution':
				$rev_slider = $config->get('slideshow_revolution_slider');

				if ( $rev_slider && function_exists('putRevSlider') ) {

					echo '<div id="main-slideshow">';
					putRevSlider( $rev_slider );
					echo '</div>';
				}
				break;

			case 'layer':
				$layer_slider = $config->get('slideshow_layer_slider');
				$layer_bg_and_paddings = $config->get('slideshow_layer_bg_and_paddings');

				if ( $layer_slider && function_exists('layerslider') ) {

					echo '<div id="main-slideshow"' . ( $layer_bg_and_paddings ? ' class="layer-fixed"' : '' ) . '>';
					layerslider( $layer_slider );
					echo '</div>';
				}

		} // switch

	}

endif;

add_action('presscore_before_main_container', 'presscore_slideshow_controller', 15);

if ( ! function_exists( 'presscore_add_metro_slideshow_scripts' ) ) :

	function presscore_add_metro_slideshow_scripts() {
		$config = presscore_get_config();
		if ( 'slideshow' == $config->get('header_title') && 'metro' == $config->get('slideshow_mode') ) :

			$slider_rows = $config->get('slideshow_slides_in_raw') ? absint($config->get('slideshow_slides_in_raw')) : 3;
			$clider_cols = $config->get('slideshow_slides_in_column') ? absint($config->get('slideshow_slides_in_column')) : 6;
		?>
		<script type="text/javascript">
			var swiperColH = <?php echo $slider_rows; ?>,
				swiperCol = <?php echo $clider_cols; ?>;
		</script>
		<?php endif; // metro slideshow
	}
	add_action( 'wp_footer', 'presscore_add_metro_slideshow_scripts', 1 );

endif;
