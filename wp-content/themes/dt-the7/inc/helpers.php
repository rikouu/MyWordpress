<?php
/**
 * Helpers.
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

//////////////////////////
// include helpers libs //
//////////////////////////

require_once PRESSCORE_HELPERS_DIR . '/html-helpers.php';
require_once PRESSCORE_HELPERS_DIR . '/portfolio-helpers.php';
require_once PRESSCORE_HELPERS_DIR . '/blog-helpers.php';
require_once PRESSCORE_HELPERS_DIR . '/widget-areas.php';
require_once PRESSCORE_HELPERS_DIR . '/masonry-template.php';
require_once PRESSCORE_HELPERS_DIR . '/microsite-template.php';
require_once PRESSCORE_HELPERS_DIR . '/list-template.php';
require_once PRESSCORE_HELPERS_DIR . '/post-navigation.php';
require_once PRESSCORE_HELPERS_DIR . '/page-title.php';
require_once PRESSCORE_HELPERS_DIR . '/comments-helpers.php';
require_once PRESSCORE_HELPERS_DIR . '/header-helpers.php';
require_once PRESSCORE_HELPERS_DIR . '/sanitize-functions.php';

if ( ! function_exists( 'presscore_get_post_fancy_date' ) ) :

	/**
	 * Return fancy date html
	 *
	 * @since 1.0.0
	 * 
	 * @param  string $new_class Additional class
	 * @return string            Fancy date html
	 */
	function presscore_get_post_fancy_date( $new_class = '' ) {

		if ( !in_the_loop() ) {
			return '';
		}

		$class = 'fancy-date' . ( $new_class ? ' ' . trim($new_class) : '' );
		$href = 'javascript: void(0);';

		if ( 'post' == get_post_type() ) {

			// remove link if in date archive
			if ( !(is_day() && is_month() && is_year()) ) {

				$href = presscore_get_post_day_link();
			}
		}

		return sprintf(
			'<div class="%s"><a title="%s" href="%s" rel="nofollow"><span class="entry-month">%s</span><span class="entry-date updated">%s</span><span class="entry-year">%s</span></a></div>',
				esc_attr( $class ), // class
				esc_attr( get_the_time() ),	// title
				$href,	// href
				esc_attr( get_the_date( 'M' ) ),	// month
				esc_html( get_the_date( 'j' ) ),	// date
				esc_html( get_the_date( 'Y' ) )	// year
		);

	}

endif;

if ( ! function_exists( 'presscore_is_post_navigation_enabled' ) ) :

	/**
	 * Check if post navigation enabled.
	 *
	 * @return bool
	 */
	function presscore_is_post_navigation_enabled() {
		return presscore_get_config()->get( 'post.navigation.arrows.enabled' );
	}

endif;

if ( ! function_exists( 'presscore_is_post_title_enabled' ) ) :

	/**
	 * Check if post title enabled.
	 * 
	 * @return bool
	 */
	function presscore_is_post_title_enabled() {
		return in_array( presscore_get_config()->get( 'header_title' ), array( 'enabled', '' ) );
	}

endif;

if ( ! function_exists( 'presscore_show_post_media' ) ) :

	function presscore_show_post_media() {
		global $post;
		if ( 'gallery' == get_post_format() ) {
			$show_post_media = has_shortcode( $post->post_content, 'gallery' );

		} else {
			$show_post_media = !post_password_required() && has_post_thumbnail();

		}

		return $show_post_media;
	}

endif;

if ( ! function_exists( 'presscore_get_current_template_type' ) ) :

	/**
	 * Get layout type based on current layout in theme config
	 *
	 * @since 1.0.0
	 * @return string Layout type (masonry, list) or empty string on failure
	 */
	function presscore_get_current_layout_type() {
		$config = presscore_get_config();

		$layout_type = $config->get( 'template.layout.type' );
		if ( $layout_type ) {
			return $layout_type;
		}

		$current_layout = $config->get( 'layout' );
		if ( in_array( $current_layout, array( 'masonry', 'grid' ) ) ) {
			$layout_type = 'masonry';

		} else if ( in_array( $current_layout, array( 'list', 'right_list', 'checkerboard' ) ) ) {
			$layout_type = 'list';

		} else {
			$layout_type = '';

		}

		return $layout_type;
	}

endif;

if ( ! function_exists( 'presscore_get_categorizer_sorting_fields' ) ) :

	/**
	 * Get Categorizer sorting fields.
	 *
	 * @since 1.0.0
	 */
	function presscore_get_categorizer_sorting_fields() {

		$config = presscore_get_config();

		$show_orderby = $config->get( 'template.posts_filter.orderby.enabled' );
		$show_order = $config->get( 'template.posts_filter.order.enabled' );

		// if filter or all sorting buttons disabled - return empty string
		if ( !$show_orderby && !$show_order ) {
			return '';
		}

		$request_display = $config->get('request_display');

		if ( null !== $request_display ) {
			$display = $request_display;

		} else {
			$display = $config->get('display');
			$display['select'] = 'all';

		}

		$select = isset($display['select']) ? $display['select'] : 'all';
		$term_id = isset($display['terms_ids']) ? current( (array) $display['terms_ids'] ) : array();
		$term = '';

		if ( 'except' == $select && 0 === $term_id ) {
			$term = 'none';

		} else if ( 'only' == $select ) {
			$term = absint( $term_id );

		}

		$paged = dt_get_paged_var();

		if ( $paged > 1 ) {
			$base_link = get_pagenum_link($paged);
		} else {
			$base_link = get_permalink();
		}

		//////////////
		// output //
		//////////////

		$link = add_query_arg( 'term', $term, $base_link );
		$act = ' act';
		$display_none = ' style="display: none;"';
		$orderby = $config->get('orderby');
		$order = $config->get('order');

		$html =	'<div class="filter-extras">' . "\n" 

					.'<div class="filter-by"' . ( $show_orderby ? '' : $display_none ) . '>' . "\n" 
						. '<a href="' . esc_url( add_query_arg( array( 'orderby' => 'date', 'order' => $order ), $link ) ) . '" class="sort-by-date' . ('date' == $orderby ? $act : '') . '" data-by="date">' . __( 'Date', LANGUAGE_ZONE ) . '</a>' . "\n" 
						. '<span class="filter-switch"></span>' 
						. '<a href="' . esc_url( add_query_arg( array( 'orderby' => 'name', 'order' => $order ), $link ) ) . '" class="sort-by-name' . ('name' == $orderby ? $act : '') . '" data-by="name">' . __( 'Name', LANGUAGE_ZONE ) . '</a>' . "\n" 
					. '</div>' . "\n" 

					. '<div class="filter-sorting"' . ( $show_order ? '' : $display_none ) . '>' . "\n" 
						. '<a href="' . esc_url( add_query_arg( array( 'orderby' => $orderby, 'order' => 'DESC' ), $link ) ) . '" class="sort-by-desc' . ('DESC' == $order ? $act : '') . '" data-sort="desc">' . __( 'Desc', LANGUAGE_ZONE ) . '</a>' 
						. '<span class="filter-switch"></span>' 
						. '<a href="' . esc_url( add_query_arg( array( 'orderby' => $orderby, 'order' => 'ASC' ), $link ) ) . '" class="sort-by-asc' . ('ASC' == $order ? $act : '') . '" data-sort="asc">' . __( 'Asc', LANGUAGE_ZONE ) . '</a>' 
					. '</div>' . "\n" 

				. '</div>' . "\n";

		return $html;
	}

endif; // presscore_get_categorizer_sorting_fields

if ( ! function_exists( 'presscore_get_category_list' ) ) :

	// TODO: refactor this!
	/**
	 * Categorizer.
	 */
	function presscore_get_category_list( $args = array() ) {
		global $post;

		$defaults = array(
			'item_wrap'         => '<a href="%HREF%" %CLASS% data-filter="%CATEGORY_ID%">%TERM_NICENAME%</a>',
			'hash'              => '#!term=%TERM_ID%&amp;page=%PAGE%&amp;orderby=date&amp;order=DESC',
			'item_class'        => '',
			'all_class'        	=> 'show-all',
			'other_class'		=> '',
			'class'             => 'filter',
			'current'           => 'all',
			'page'              => '1',
			'ajax'              => false,
			'all_btn'           => true,
			'other_btn'         => true,
			'echo'				=> true,
			'data'				=> array(),
			'before'			=> '<div class="filter-categories">',
			'after'				=> '</div>',
			'act_class'			=> 'act',
		);
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'presscore_get_category_list-args', $args );

		$data = $args['data'];

		$args['hash'] = str_replace( array( '%PAGE%' ), array( $args['page'] ), $args['hash'] );
		$output = $all = '';

		if ( isset($data['terms']) &&
			( ( count( $data['terms'] ) == 1 && !empty( $data['other_count'] ) ) ||
			count( $data['terms'] ) > 1 )
		) {
			if ( !empty( $args['item_class'] ) ) {
				$args['item_class'] = 'class="' . esc_attr($args['item_class']) . '"';
			}

			$replace_list = array( '%HREF%', '%CLASS%', '%TERM_DESC%', '%TERM_NICENAME%', '%TERM_SLUG%', '%TERM_ID%', '%COUNT%', '%CATEGORY_ID%' );

			foreach( $data['terms'] as $term ) {

				$item_class = array();

				if ( !empty( $args['item_class'] ) ) {
					$item_class[] = $args['item_class'];
				}

				if ( in_array( $args['current'], array($term->term_id, $term->slug) ) ) {
					$item_class[] = $args['act_class'];
				}

				if ( $item_class ) {
					$item_class = sprintf( 'class="%s"', esc_attr( implode( ' ', $item_class ) ) );
				} else {
					$item_class = '';
				}

				$output .= str_replace(
					$replace_list,
					array(
						esc_url( str_replace( array( '%TERM_ID%' ), array( $term->term_id ), $args['hash'] ) ),
						$item_class,
						$term->category_description,
						$term->cat_name,
						esc_attr($term->slug),
						esc_attr($term->term_id),
						$term->count,
						esc_attr('.category-' . $term->term_id),
					), $args['item_wrap']
				);
			}

			// all button
			if ( $args['all_btn'] ) {
				$all_class = array();

				if ( !empty( $args['all_class'] ) ) {
					$all_class[] = $args['all_class'];
				}

				if ( 'all' == $args['current'] ) {
					$all_class[] = $args['act_class'];
				}

				if ( $all_class ) {
					$all_class = sprintf( 'class="%s"', esc_attr( implode( ' ', $all_class ) ) );
				} else {
					$all_class = '';
				}

				$all = str_replace(
					$replace_list,
					array(
						esc_url( str_replace( array( '%TERM_ID%' ), array( '' ), $args['hash'] ) ),
						$all_class,
						_x( 'All posts', 'category list', LANGUAGE_ZONE ),
						_x( 'View all', 'category list', LANGUAGE_ZONE ),
						'',
						'',
						$data['all_count'],
						'*',
					), $args['item_wrap']
				);
			}

			// other button
			if( $data['other_count'] && $args['other_btn'] ) {
				$other_class = array();
				
				if ( !empty( $args['other_class'] ) ) {
					$other_class[] = $args['other_class'];
				}

				if ( 'none' == $args['current'] ) {
					$other_class[] = $args['act_class'];
				}

				if ( $other_class ) {
					$other_class = sprintf( 'class="%s"', esc_attr( implode( ' ', $other_class ) ) );
				} else {
					$other_class = '';
				}

				$output .= str_replace(
					$replace_list,
					array(
						esc_url( str_replace( array( '%TERM_ID%' ), array( 'none' ), $args['hash'] ) ),
						$other_class,
						_x( 'Other posts', 'category list', LANGUAGE_ZONE ),
						_x( 'Other', 'category list', LANGUAGE_ZONE ),
						'',
						0,
						$data['other_count'],
						esc_attr('.category-0'),
					), $args['item_wrap']
				); 
			}

			$config = presscore_get_config();

			$show_extra = $config->get( 'template.posts_filter.orderby.enabled' ) || $config->get( 'template.posts_filter.order.enabled' );

			$output = '<div class="filter-categories' . ( $show_extra ? '' : ' extras-off' ) . '">' . $all . $output . '</div>';
			$output = str_replace( array( '%CLASS%' ), array( $args['class'] ), $output );
		}

		$output = apply_filters( 'presscore_get_category_list', $output, $args );

		if ( $args['echo'] ) {
			echo $output;
		} else {
			return $output;
		}
		return false;
	}

endif;

if ( ! function_exists( 'pressocore_render_login_form' ) ) :

	function pressocore_render_login_form() {

		$show_icon = of_get_option( 'header-login_icon', true );
		$class = $show_icon ? '' : ' icon-off';

		if ( is_user_logged_in() ) {
			$caption = of_get_option( 'header-logout_caption', _x( "Logout", "theme-options", LANGUAGE_ZONE ) );
		} else {
			$caption = of_get_option( 'header-login_caption', _x( "Login", "theme-options", LANGUAGE_ZONE ) );
		}


		if ( !$caption && $show_icon ) {
			$class .= ' text-disable';
		}

		if ( !$caption ) {
			$caption = '&nbsp;';
		}
		?>
		<div class="mini-login"><a href="<?php echo esc_url( of_get_option( 'header-login_url', '' ) );?>" class="submit<?php echo $class; ?>"><?php echo esc_html($caption); ?></a></div>
		<?php
	}

endif;

if ( ! function_exists( 'presscore_get_posts_small_list' ) ) :

	/**
	 * Description here.
	 *
	 * Some sort of images list with some description and post title and date ... eah
	 *
	 * @return array Array of items or empty array.
	 */
	function presscore_get_posts_small_list( $attachments_data, $options = array() ) {
		if ( empty( $attachments_data ) ) {
			return array();
		}

		global $post;
		$default_options = array(
			'links_rel' => '',
			'show_images' => true,
			'image_dimensions' => array( 'w' => 60, 'h' => 60 )
		);
		$options = wp_parse_args( $options, $default_options );

		$image_args = array(
			'img_class' => '',
			'class'		=> 'alignleft post-rollover',
			'custom'	=> $options['links_rel'],
			'options'	=> array( 'w' => $options['image_dimensions']['w'], 'h' => $options['image_dimensions']['h'], 'z' => true ),
			'echo'		=> false,
		);

		$articles = array();
		$class = '';
		$post_was_changed = false;
		$post_backup = $post;

		foreach ( $attachments_data as $data ) {

			$new_post = null;

			if ( isset( $data['parent_id'] ) ) {

				$post_was_changed = true;
				$new_post = get_post( $data['parent_id'] );

				if ( $new_post ) {
					$post = $new_post;
					setup_postdata( $post );
				}
			}

			$permalink = esc_url($data['permalink']);

			$attachment_args = array(
				'href'		=> $permalink,
				'img_meta' 	=> array( $data['full'], $data['width'], $data['height'] ),
				'img_id'	=> empty($data['ID']) ? 0 : $data['ID'],
				'echo'		=> false,
				'wrap'		=> '<a %CLASS% %HREF% %CUSTOM%><img %IMG_CLASS% %SRC% %SIZE% %ALT% /></a>',
			);

			// show something if there is no title
			if ( empty($data['title']) ) {
				$data['title'] = _x('No title', 'blog small list', LANGUAGE_ZONE);
			}

			if ( !empty( $data['parent_id'] ) ) {
				$class = 'post-' . presscore_get_post_format_class( get_post_format( $data['parent_id'] ) );

				if ( empty($data['ID']) ) {
					$attachment_args['wrap'] = '<a %HREF% %CLASS% %TITLE% style="width:' . $options['image_dimensions']['w'] . 'px; height: ' . $options['image_dimensions']['h'] . 'px;"></a>';
					$attachment_args['class'] = $image_args['class'] . ' no-avatar';
					$attachment_args['img_meta'] = array('', 0, 0);
					$attachment_args['options'] = false;
				}
			}

			$article = sprintf(
				'<article class="%s"><div class="wf-td">%s</div><div class="post-content">%s%s</div></article>',
				$class,
				$options['show_images'] ? dt_get_thumb_img( array_merge($image_args, $attachment_args) ) : '',
				'<a href="' . $permalink . '">' . esc_html($data['title']) . '</a><br />',
				'<time class="text-secondary" datetime="' . get_the_date('c') . '">' . get_the_date(get_option('date_format')) . '</time>'
			);

			$articles[] = $article;
		}

		if ( $post_was_changed ) {
			$post = $post_backup;
			setup_postdata( $post );
		}

		return $articles;
	}

endif;

if ( ! function_exists( 'presscore_is_load_more_pagination' ) ) :

	/**
	 * Description here
	 *
	 * @since 1.0.0
	 * @return boolean Is we use load more button in pagination
	 */
	function presscore_is_load_more_pagination() {
		return in_array( presscore_get_config()->get('load_style'), array( 'ajax_more', 'lazy_loading' ) );
	}

endif;

if ( ! function_exists( 'presscore_is_lazy_loading' ) ) :

	function presscore_is_lazy_loading() {
		return ( 'lazy_loading' == presscore_get_config()->get( 'load_style' ) );
	}

endif;

if ( ! function_exists( 'presscore_is_content_visible' ) ) :

	/**
	 * Flag to check is content visible.
	 *
	 * @return boolean Returns true or false.
	 */
	function presscore_is_content_visible() {
		if ( post_password_required() ) {
			return true;
		}

		$config = presscore_get_config();

		$hide_content_for_3d_slider = 'slideshow' == $config->get('header_title') 
			&& '3d' == $config->get('slideshow_mode') 
			&& 'fullscreen-content' == $config->get('slideshow_3d_layout');

		$hide_content_for_photo_scroller_in_album_post = 'photo_scroller' == $config->get( 'post.media.type' ) 
			&& 'fullscreen' == $config->get( 'post.media.photo_scroller.layout' );

		$hide_content_for_photo_scroller_slideshow = 'slideshow' == $config->get('header_title') 
			&& 'photo_scroller' == $config->get('slideshow_mode') 
			&& 'fullscreen' == $config->get( 'slideshow.photo_scroller.layout' );

		$content_is_visible = !( $hide_content_for_3d_slider || $hide_content_for_photo_scroller_in_album_post || $hide_content_for_photo_scroller_slideshow );

		return apply_filters( 'presscore_is_content_visible', $content_is_visible );
	}

endif; // presscore_is_content_visible

if ( ! function_exists( 'presscore_get_attachments_data_count' ) ) :

	/**
	 * Counts attachments data images and videos.
	 *
	 * @return array
	 */
	function presscore_get_attachments_data_count( $attachments_ids = array() ) {
		$images_count = 0;
		$videos_count = 0;

		if ( !empty( $attachments_ids ) ) {

			foreach ( $attachments_ids as $id ) {

				if ( false != get_post_meta( $id, 'dt-video-url', true ) ) {
					$videos_count++;

				} else {
					$images_count++;

				}

			}

		}

		return array( $images_count, $videos_count );
	}

endif; // presscore_get_attachments_data_count

if ( ! function_exists( 'presscore_testimonials_ajax_loading_responce' ) ) :

	function presscore_testimonials_ajax_loading_responce( $ajax_data = array() ) {
		global $post, $wp_query, $paged, $page;

		extract( $ajax_data );

		if ( !$nonce || !$post_id || !$post_paged || !$target_page || !wp_verify_nonce( $nonce, 'presscore-posts-ajax' ) ) {
			$responce = array( 'success' => false, 'reason' => 'corrupted data' );

		} else {

			require_once PRESSCORE_EXTENSIONS_DIR . '/aq_resizer.php';
			require_once PRESSCORE_DIR . '/template-hooks.php';
			require_once PRESSCORE_EXTENSIONS_DIR . '/dt-pagination.php';

			// get page
			query_posts( array(
				'post_type' => 'page',
				'page_id' => $post_id,
				'post_status' => 'publish',
				'page' => $target_page
			) );

			if ( have_posts() && !post_password_required() ) : while ( have_posts() ) : the_post(); // main loop

				$config = presscore_get_config();

				$config->set( 'template', 'testimonials' );
				$config->set( 'template.layout.type', 'masonry' );

				presscore_config_base_init();

				do_action( 'presscore_before_loop' );

				$query = Presscore_Inc_Testimonials_Post_Type::get_template_query();

				$html = '';
				ob_start();

				if ( $query->have_posts() ) {

					while( $query->have_posts() ) { $query->the_post();
/*
						// check if current post already loaded
						$key_in_loaded = array_search( $post->ID, $loaded_items );
						if ( false !== $key_in_loaded ) {
							unset( $loaded_items[ $key_in_loaded ] );
							continue;
						}
*/
						// post template
						get_template_part( 'content', 'testimonials' );
					}

					wp_reset_postdata();

				}

				$html .= ob_get_clean();

			endwhile;

			$responce = array( 'success' => true );

			///////////////////
			// pagination //
			///////////////////

			$next_page_link = dt_get_next_posts_url( $query->max_num_pages );

			if ( $next_page_link ) {
				$responce['nextPage'] = dt_get_paged_var() + 1;

			} else {
				$responce['nextPage'] = 0;

			}

			$load_style = $config->get( 'load_style' );

			// pagination style
			if ( presscore_is_load_more_pagination() ) {

				$pagination = dt_get_next_page_button( $query->max_num_pages, 'paginator paginator-more-button with-ajax' );

				if ( $pagination ) {
					$responce['currentPage'] = dt_get_paged_var();
					$responce['paginationHtml'] = $pagination;
				} else {
					$responce['currentPage'] = $post_paged;
				}

				$responce['paginationType'] = 'more';

			} else if ( 'ajax_pagination' == $load_style ) {

				ob_start();
				dt_paginator( $query, array('class' => 'paginator with-ajax', 'ajaxing' => true ) );
				$pagination = ob_get_clean();

				if ( $pagination ) {
					$responce['paginationHtml'] = $pagination;
				}

				$responce['paginationType'] = 'paginator';

			}

			/////////////////
			// response //
			/////////////////

			$responce['itemsToDelete'] = array_values( $loaded_items );
			// $responce['query'] = $page_query->query;
			$responce['order'] = $query->get( 'order', '' );
			$responce['orderby'] = $query->get( 'orderby', 'date' );

			endif; // main loop

			$responce['html'] = $html;

		}

		return $responce;
	}

endif;

if ( ! function_exists( 'presscore_get_mobile_logos_meta' ) ) :

	/**
	 * Get mobile logos meta.
	 *
	 * @return array.
	 */
	function presscore_get_mobile_logos_meta() {
		return array(
			'logo' 			=> dt_get_uploaded_logo( of_get_option( 'general-mobile_logo-regular', array('', 0) ) ),
			'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'general-mobile_logo-hd', array('', 0) ), 'retina' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_get_header_logos_meta' ) ) :

	/**
	 * Get header logos meta.
	 *
	 * @return array.
	 */
	function presscore_get_header_logos_meta() {
		$config = presscore_get_config();
		return array(
			'logo' 			=> dt_get_uploaded_logo( $config->get( 'logo.header.regular' ) ),
			'logo_retina'	=> dt_get_uploaded_logo( $config->get( 'logo.header.hd' ), 'retina' ),
		);
	}

endif; // presscore_get_header_logos_meta

if ( ! function_exists( 'presscore_get_footer_logos_meta' ) ) :

	/**
	 * Get footer logos meta.
	 *
	 * @return array.
	 */
	function presscore_get_footer_logos_meta() {
		return array(
			'logo' 			=> dt_get_uploaded_logo( of_get_option( 'bottom_bar-logo_regular', array('', 0) ) ),
			'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'bottom_bar-logo_hd', array('', 0) ), 'retina' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_get_floating_menu_logos_meta' ) ) :

	/**
	 * Get footer logos meta.
	 *
	 * @return array.
	 */
	function presscore_get_floating_menu_logos_meta() {
		return array(
			'logo' 			=> dt_get_uploaded_logo( of_get_option( 'general-floating_menu_logo_regular', array('', 0) ) ),
			'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'general-floating_menu_logo_hd', array('', 0) ), 'retina' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_vc_is_inline' ) ) :

	function presscore_vc_is_inline() {
		return function_exists( 'vc_is_inline' ) && vc_is_inline();
	}

endif;

if ( ! function_exists( 'presscore_image_title_enabled' ) ) :

	function presscore_image_title_enabled( $image_id ) {
		return ! get_post_meta( $image_id, 'dt-img-hide-title', true );
	}

endif;

if ( ! function_exists( 'presscore_get_attachment_post_data' ) ) :

	/**
	 * Get attachments post data.
	 *
	 * @param array $media_items Attachments id's array.
	 * @return array Attachments data.
	 */
	function presscore_get_attachment_post_data( $media_items, $orderby = 'post__in', $order = 'DESC', $posts_per_page = -1 ) {
		if ( empty( $media_items ) ) {
			return array();
		}

		global $post;

		// sanitize $media_items
		$media_items = array_diff( array_unique( array_map( "absint", $media_items ) ), array(0) );

		if ( empty( $media_items ) ) {
			return array();
		}

		// get attachments
		$query = new WP_Query( array(
			'no_found_rows'     => true,
			'posts_per_page'    => $posts_per_page,
			'post_type'         => 'attachment',
			'post_mime_type'    => 'image',
			'post_status'       => 'inherit',
			'post__in'			=> $media_items,
			'orderby'			=> $orderby,
			'order'				=> $order,
		) );

		$attachments_data = array();

		if ( $query->have_posts() ) {

			// backup post
			$post_backup = $post;

			while ( $query->have_posts() ) { $query->the_post();
				$post_id = get_the_ID();
				$data = array();

				// attachment meta
				$data['full'] = $data['width'] = $data['height'] = '';
				$meta = wp_get_attachment_image_src( $post_id, 'full' );
				if ( !empty($meta) ) {
					$data['full'] = esc_url($meta[0]);
					$data['width'] = absint($meta[1]);
					$data['height'] = absint($meta[2]);
				}

				$data['thumbnail'] = wp_get_attachment_image_src( $post_id, 'thumbnail' );

				$data['alt'] = esc_attr( get_post_meta( $post_id, '_wp_attachment_image_alt', true ) );
				$data['caption'] = wp_kses_post( $post->post_excerpt );
				$data['description'] = wp_kses_post( $post->post_content );
				$data['title'] = get_the_title( $post_id );
				$data['permalink'] = get_permalink( $post_id );
				$data['video_url'] = esc_url( get_post_meta( $post_id, 'dt-video-url', true ) );
				$data['link'] = esc_url( get_post_meta( $post_id, 'dt-img-link', true ) );
				$data['mime_type_full'] = get_post_mime_type( $post_id );
				$data['mime_type'] = dt_get_short_post_myme_type( $post_id );
				$data['ID'] = $post_id;

				// attachment meta
				$data['meta'] = presscore_new_posted_on();

				$attachments_data[] = apply_filters( 'presscore_get_attachment_post_data-attachment_data', $data, $media_items );
			}

			// restore post
			$post = $post_backup;
			setup_postdata( $post );
		}

		return $attachments_data;
	}

endif;

if ( ! function_exists( 'presscore_get_posts_in_categories' ) ) :

	/**
	 * Get posts by categories.
	 *
	 * @return object WP_Query Object. 
	 */
	function presscore_get_posts_in_categories( $options = array() ) {

		$default_options = array(
			'post_type'	=> 'post',
			'taxonomy'	=> 'category',
			'field'		=> 'term_id',
			'cats'		=> array( 0 ),
			'select'	=> 'all',
			'args'		=> array(),
		);

		$options = wp_parse_args( $options, $default_options );

		$args = array(
			'posts_per_page'	=> -1,
			'post_type'			=> $options['post_type'],
			'no_found_rows'     => 1,
			'post_status'       => 'publish',
			'tax_query'         => array( array(
				'taxonomy'      => $options['taxonomy'],
				'field'         => $options['field'],
				'terms'         => $options['cats'],
			) ),
		);

		$args = array_merge( $args, $options['args'] );

		switch( $options['select'] ) {
			case 'only': $args['tax_query'][0]['operator'] = 'IN'; break;
			case 'except': $args['tax_query'][0]['operator'] = 'NOT IN'; break;
			default: unset( $args['tax_query'] );
		}

		$query = new WP_Query( $args );

		return $query;
	}

endif;

if ( ! function_exists( 'presscore_get_related_posts' ) ) :

	/**
	 * Get related posts attachments data slightly modified.
	 *
	 * @return array Attachments data.
	 */
	function presscore_get_related_posts( $options = array() ) {
		$default_options = array(
			'select'			=> 'only',
			'exclude_current'	=> true,
			'args'				=> array(),
		);

		$options = wp_parse_args( $options, $default_options );

		// exclude current post if in the loop
		if ( in_the_loop() && $options['exclude_current'] ) {
			$options['args'] = array_merge( $options['args'], array( 'post__not_in' => array( get_the_ID() ) ) );
		}

		$posts = presscore_get_posts_in_categories( $options );

		$attachments_ids = array();
		$attachments_data_override = array();
		$posts_data = array();

		// get posts attachments id
		if ( $posts->have_posts() ) {

			while ( $posts->have_posts() ) { $posts->the_post();

				// thumbnail or first attachment id
				if ( has_post_thumbnail() ) {
					$attachment_id = get_post_thumbnail_id();

				} else if ( $attachment = presscore_get_first_image() ) {
					$attachment_id = $attachment->ID;

				} else {
					$attachment_id = 0;

				}

				switch ( get_post_type() ) {
					case 'post':
						$post_meta = presscore_new_posted_on( 'post' );
						break;
					case 'dt_portfolio':
						$post_meta = presscore_new_posted_on( 'dt_portfolio' );
						break;
					default:
						$post_meta = presscore_new_posted_on();
				}

				$post_data = array();

				/////////////////////////
				// attachment data //
				/////////////////////////

				$post_data['full'] = $post_data['width'] = $post_data['height'] = '';
				$meta = wp_get_attachment_image_src( $attachment_id, 'full' );
				if ( !empty($meta) ) {
					$post_data['full'] = esc_url($meta[0]);
					$post_data['width'] = absint($meta[1]);
					$post_data['height'] = absint($meta[2]);
				}

				$post_data['thumbnail'] = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );

				$post_data['caption'] = '';
				$post_data['video_url'] = esc_url( get_post_meta( $attachment_id, 'dt-video-url', true ) );
				$post_data['mime_type_full'] = get_post_mime_type( $attachment_id );
				$post_data['mime_type'] = dt_get_short_post_myme_type( $attachment_id );
				$post_data['ID'] = $attachment_id;

				$post_data['image_attachment_data'] = array(
					'caption' => $post_data['caption'],
					'description' => wp_kses_post( get_post_field( 'post_content', $attachment_id ) ),
					'title' => presscore_imagee_title_is_hidden( $attachment_id ) ? '' : get_the_title( $attachment_id ),
					'permalink' => get_permalink( $attachment_id ),
					'video_url' => $post_data['video_url'],
					'ID' => $attachment_id
				);

				///////////////////
				// post data //
				///////////////////

				$post_data['title'] = get_the_title();
				$post_data['permalink'] = get_permalink();
				$post_data['link'] = presscore_get_project_link('project-link');
				$post_data['description'] = get_the_excerpt();
				$post_data['alt'] = get_the_title();
				$post_data['parent_id'] = get_the_ID();
				$post_data['meta'] = $post_meta;

				// save data
				$posts_data[] = $post_data;
			}
			wp_reset_postdata();

		}

		return $posts_data;
	}

endif;

if ( ! function_exists( 'presscore_get_first_image' ) ) :

	/**
	 * Get first image associated with the post.
	 *
	 * @param integer $post_id Post ID.
	 * @return mixed Return (object) attachment on success ar false on failure.
	 */
	function presscore_get_first_image( $post_id = null ) {
		if ( in_the_loop() && !$post_id ) {
			$post_id = get_the_ID();
		}

		if ( !$post_id ) {
			return false;
		}

		$args = array(
			'posts_per_page' 	=> 1,
			'order'				=> 'ASC',
			'post_mime_type' 	=> 'image',
			'post_parent' 		=> $post_id,
			'post_status'		=> 'inherit',
			'post_type'			=> 'attachment',
		);

		$attachments = get_children( $args );

		if ( $attachments ) {
			return current($attachments);
		}

		return false;
	}

endif;

if ( ! function_exists( 'presscore_responsive' ) ) :

	/**
	 * Set some responsivness flag.
	 */
	function presscore_responsive() {
		return absint( of_get_option( 'general-responsive', 1 ) );
	}

endif;

if ( ! function_exists( 'presscore_the_excerpt' ) ) :

	/**
	 * Echo custom content.
	 *
	 */
	function presscore_the_excerpt() {
		echo presscore_get_the_excerpt();
	}

endif;

if ( ! function_exists( 'presscore_get_the_excerpt' ) ) :

	/**
	 * Show content with funny details button.
	 *
	 */
	function presscore_get_the_excerpt() {
		global $post, $more, $pages;
		$more = 0;
		$content = '';

		if ( ! has_excerpt( $post->ID ) ) {

			$excerpt_length = apply_filters('excerpt_length', 55);
			$content = presscore_get_the_clear_content();


			// check for more tag
			if ( preg_match( '/<!--more(.*?)?-->/', $post->post_content, $matches ) ) {
				$content .= apply_filters( 'presccore_get_content-more', '' );

				if ( count($pages) > 1 ) {
					add_filter( 'presscore_post_details_link', 'presscore_return_empty_string', 15 );
				} else {
					add_filter( 'presscore_post_details_link', 'presscore_add_more_anchor', 15 );
				}

			// check content length
			} elseif ( dt_count_words( $content ) <= $excerpt_length ) {
				add_filter( 'presscore_post_details_link', 'presscore_return_empty_string', 15 );
			} else {
				$content = '';
			}

		}

		// if we got excerpt or content more than $excerpt_length
		if ( empty($content) && get_the_excerpt() ) {

			$content = apply_filters( 'the_excerpt', get_the_excerpt() );
		}

		return $content;
	}

endif;

if ( ! function_exists( 'presscore_get_the_clear_content' ) ) :

	/**
	 * Return content passed through these functions:
	 *	strip_shortcodes( $content );
	 *	apply_filters( 'the_content', $content );
	 *	str_replace( ']]>', ']]&gt;', $content );
	 *
	 * @return string
	 */
	function presscore_get_the_clear_content() {
		$content = get_the_content( '' );
		$content = strip_shortcodes( $content );
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		return $content;
	}

endif;

if ( ! function_exists( 'presscore_imagee_title_is_hidden' ) ) :

	/**
	 * Check image title status.
	 *
	 */
	function presscore_imagee_title_is_hidden( $img_id ) {
		return get_post_meta( $img_id, 'dt-img-hide-title', true );
	}

endif;

if ( ! function_exists( 'presscore_search_content_templates' ) ) :

	function presscore_search_content_templates() {
		static $templates = null;

		if ( ! $templates ) {
			$templates = new Presscore_Action_Manager();
		}

		return $templates;
	}

endif;
