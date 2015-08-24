<?php
/**
 * Post navigation helpers
 * 
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_get_next_post_link' ) ) :

	function presscore_get_next_post_link( $link_text = '', $link_class = '', $dummy = '' ) {
		$post_link = get_next_post_link( '%link', $link_text );
		if ( $post_link ) {
			return str_replace( 'href=', 'class="'. esc_attr( $link_class ) . '" href=', $post_link );
		}

		return $dummy;
	}

endif;

if ( ! function_exists( 'presscore_get_previous_post_link' ) ) :

	function presscore_get_previous_post_link( $link_text = '', $link_class = '', $dummy = '' ) {
		$post_link = get_previous_post_link( '%link', $link_text );
		if ( $post_link ) {
			return str_replace( 'href=', 'class="'. esc_attr( $link_class ) . '" href=', $post_link );
		}

		return $dummy;
	}

endif;

if ( ! function_exists( 'presscore_get_post_back_link' ) ) :

	function presscore_get_post_back_link() {
		$config = Presscore_Config::get_instance();
		$page_id = $config->get( 'post.navigation.back_button.target_page_id' );
		if ( $page_id ) {
			return '<a class="back-to-list" href="' . esc_url( get_permalink( $page_id ) ) . '"></a>';
		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_post_navigation' ) ) :

	function presscore_post_navigation() {

		if ( ! in_the_loop() ) {
			return '';
		}

		$config = Presscore_Config::get_instance();

		$output = '';

		if ( $config->get( 'post.navigation.arrows.enabled' ) ) {
			$output .= presscore_get_next_post_link( '', 'prev-post', '<a class="prev-post disabled" href="javascript: void(0);"></a>' );
		}

		if ( $config->get( 'post.navigation.back_button.enabled' ) ) {
			$output .= presscore_get_post_back_link();
		}

		if ( $config->get( 'post.navigation.arrows.enabled' ) ) {
			$output .= presscore_get_previous_post_link( '', 'next-post', '<a class="next-post disabled" href="javascript: void(0);"></a>' );
		}

		return $output;
	}

endif;

if ( ! function_exists( 'presscore_single_post_navigation_bar' ) ) :

	function presscore_single_post_navigation_bar() {

		if ( ! ( is_single() && presscore_is_content_visible() ) ) {
			return;
		}

		switch ( get_post_type() ) {
			case 'post':
				$post_meta = presscore_new_posted_on( 'single_post' );
				break;

			case 'dt_portfolio':
				$post_meta = presscore_new_posted_on( 'single_dt_portfolio' );
				break;

			case 'dt_gallery':
				$post_meta = presscore_new_posted_on( 'single_dt_gallery' );
				break;

			default: 
				$post_meta = '';
		}

		$post_navigation = presscore_post_navigation();

		if ( $post_meta || $post_navigation ) {

			$article_top_bar_html_class = 'article-top-bar ' . presscore_get_page_title_bg_mode_html_class();

			if ( ! $post_meta ) {
				$article_top_bar_html_class .= ' post-meta-disabled';
			}

			echo '<div class="' . $article_top_bar_html_class . '"><div class="wf-wrap"><div class="wf-container-top">';

			echo presscore_get_post_meta_wrap( $post_meta );
			echo '<div class="navigation-inner"><div class="single-navigation-wrap">' . $post_navigation . '</div></div>';

			echo '</div></div></div>';
		}

	}

endif;
add_action( 'presscore_before_content', 'presscore_single_post_navigation_bar', 20 );

if ( ! function_exists( 'dt_get_next_page_button' ) ) :

	/**
	 * Next page button.
	 *
	 */
	function dt_get_next_page_button( $max, $class = '' ) {
		$next_posts_link = dt_get_next_posts_url( $max );

		if ( $next_posts_link ) {

			if ( presscore_is_lazy_loading() ) {
				$caption = __( 'Loading...', LANGUAGE_ZONE );
			} else {
				$caption = __( 'Load more', LANGUAGE_ZONE );
			}
			$caption = apply_filters( 'dt_get_next_page_button-caption', $caption );

			$icon = '<span class="stick"></span><span class="stick"></span><span class="stick"></span>';

			return '<div class="' . esc_attr($class) . '">
				<a class="button-load-more" href="javascript: void(0);" data-dt-page="' . dt_get_paged_var() .'" >'. $icon . '<span class="h5-size button-caption">' . $caption . '</span></a>
			</div>';

		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_get_breadcrumbs' ) ) :

	/**
	 * Returns breadcrumbs html
	 * original script you can find on http://dimox.net
	 * 
	 * @since 1.0.0
	 * 
	 * @return string Breadcrumbs html
	 */
	function presscore_get_breadcrumbs( $args = array() ) {

		$default_args = array(
			'text' => array(
				'home' => _x('Home', 'breadcrumbs', LANGUAGE_ZONE),
				'category' => _x('Category "%s"', 'breadcrumbs', LANGUAGE_ZONE),
				'search' => _x('Results for "%s"', 'breadcrumbs', LANGUAGE_ZONE),
				'tag' => _x('Entries tagged with "%s"', 'breadcrumbs', LANGUAGE_ZONE),
				'author' => _x('Article author %s', 'breadcrumbs', LANGUAGE_ZONE),
				'404' => _x('Error 404', 'breadcrumbs', LANGUAGE_ZONE)
			),
			'showCurrent' => 1,
			'showOnHome' => 1,
			'delimiter' => '',
			'before' => '<li class="current">',
			'after' => '</li>',
			'linkBefore' => '<li typeof="v:Breadcrumb">',
			'linkAfter' => '</li>',
			'linkAttr' => ' rel="v:url" property="v:title"',
			'beforeBreadcrumbs' => '',
			'afterBreadcrumbs' => '',
			'listAttr' => ' class="breadcrumbs text-normal"'
		);

		$args = wp_parse_args( $args, $default_args );

		$breadcrumbs_html = apply_filters( 'presscore_get_breadcrumbs-html', '', $args );
		if ( $breadcrumbs_html ) {
			return $breadcrumbs_html;
		}

		extract( array_intersect_key( $args, $default_args ) );

		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s" title="">%2$s</a>' . $linkAfter;

		$breadcrumbs_html .= '<div class="assistive-text">' . _x('You are here:', 'breeadcrumbs', LANGUAGE_ZONE) . '</div>';

		$homeLink = home_url() . '/';
		global $post;

		if (is_home() || is_front_page()) {

			if ($showOnHome == 1) {
				$breadcrumbs_html .= '<ol' . $listAttr . '><a href="' . $homeLink . '">' . $text['home'] . '</a></ol>';
			}

		} else {

			$breadcrumbs_html .= '<ol' . $listAttr . ' xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

			if ( is_category() ) {

				$thisCat = get_category(get_query_var('cat'), false);

				if ($thisCat->parent != 0) {

					$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

					if(preg_match( '/title="/', $cats ) ===0) {
						$cats = preg_replace('/title=""/', 'title=""', $cats);
					}

					$breadcrumbs_html .= $cats;
				}

				$breadcrumbs_html .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;

			} elseif ( is_search() ) {

				$breadcrumbs_html .= $before . sprintf($text['search'], get_search_query()) . $after;

			} elseif ( is_day() ) {

				$breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				$breadcrumbs_html .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
				$breadcrumbs_html .= $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {

				$breadcrumbs_html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				$breadcrumbs_html .= $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {

				$breadcrumbs_html .= $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {

				if ( get_post_type() != 'post' ) {

					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$breadcrumbs_html .= sprintf($link, $homeLink . '' . $slug['slug'] . '/', $post_type->labels->singular_name);

					if ($showCurrent == 1) {
						$breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
					}
				} else {

					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);

					if ($showCurrent == 0) {
						$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					}

					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);

					$breadcrumbs_html .= $cats;

					if ($showCurrent == 1) {
						$breadcrumbs_html .= $before . get_the_title() . $after;
					}
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

				$post_type = get_post_type_object(get_post_type());
				if ( $post_type ) {
					$breadcrumbs_html .= $before . $post_type->labels->singular_name . $after;
				}

			} elseif ( is_attachment() ) {

				if ($showCurrent == 1) {
					$breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
				}

			} elseif ( is_page() && !$post->post_parent ) {

				if ($showCurrent == 1) {
					$breadcrumbs_html .= $before . get_the_title() . $after;
				}

			} elseif ( is_page() && $post->post_parent ) {

				$parent_id  = $post->post_parent;
				$breadcrumbs = array();

				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}

				$breadcrumbs = array_reverse($breadcrumbs);

				for ($i = 0; $i < count($breadcrumbs); $i++) {

					$breadcrumbs_html .= $breadcrumbs[$i];

					if ($i != count($breadcrumbs)-1) {
						$breadcrumbs_html .= $delimiter;
					}
				}

				if ($showCurrent == 1) {
					$breadcrumbs_html .= $delimiter . $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {

				$breadcrumbs_html .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif ( is_author() ) {

				global $author;
				$userdata = get_userdata($author);
				$breadcrumbs_html .= $before . sprintf($text['author'], $userdata->display_name) . $after;

			} elseif ( is_404() ) {

				$breadcrumbs_html .= $before . $text['404'] . $after;
			}

			if ( get_query_var('paged') ) {

				$breadcrumbs_html .= $before;

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$breadcrumbs_html .= ' (';
				}

				$breadcrumbs_html .= _x('Page', 'bredcrumbs', LANGUAGE_ZONE) . ' ' . get_query_var('paged');

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					$breadcrumbs_html .= ')';
				}

				$breadcrumbs_html .= $after;

			}

			$breadcrumbs_html .= '</ol>';
		}

		return apply_filters( 'presscore_get_breadcrumbs', $beforeBreadcrumbs . $breadcrumbs_html . $afterBreadcrumbs, $args );
	} // end presscore_get_breadcrumbs()

endif;

if ( ! function_exists( 'presscore_nav_menu_list' ) ) :

	/**
	 * Make top/bottom menu.
	 *
	 * @param $menu_name string Valid menu name.
	 * @param $style string Align of menu. May be left or right. right by default.
	 *
	 * @since presscore 0.1
	 */
	function presscore_nav_menu_list( $menu_name = '', $style = '' ) {
		$menu_list = '';

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {

			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			if ( !$menu ) {
				return '';
			}

			if ( 'left' == $style ) {

				$class = ' wf-float-left';
			} else if ( 'right' == $style ) {

				$class = ' wf-float-right';
			} else {

				$class = '';
			}

			$menu_list .= '<div class="mini-nav' . $class . '">';

			$submenu_classes = array( 'sub-nav' );
			if ( $submenu_color_mode_class = presscore_get_color_mode_class( of_get_option( 'submenu-hover_font_color_mode' ) ) ) {
				$submenu_classes[] = $submenu_color_mode_class;
			}

			$menu_list .= dt_menu( array(
				'menu_wraper' 		=> '<ul>%MENU_ITEMS%' . "\n" . '</ul>',
				'menu_items'		=>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%" data-level="%DEPTH%"%ESC_ITEM_TITLE%>%ICON%<span>%ITEM_TITLE%</span></a>%SUBMENU%</li> ',
				'submenu' 			=> '<div class="' . esc_attr( implode( ' ', $submenu_classes ) ) . '"><ul>%ITEM%</ul></div>',
				'parent_clicable'	=> true,
				'params'			=> array( 'act_class' => 'act', 'please_be_mega_menu' => true, 'echo' => false, 'please_be_fat' => false ),
				'fallback_cb'		=> '',
				'location'			=> $menu_name
			) );

			$menu_list .= '<div class="menu-select">';

			$menu_list .= '<span class="customSelect1"><span class="customSelectInner">' . $menu->name . '</span></span></div>';

			$menu_list .= '</div>';

		}

		echo $menu_list;
	}

endif; // presscore_nav_menu_list

if ( ! function_exists( 'presscore_complex_pagination' ) ) :

	function presscore_complex_pagination( &$query ) {
		if ( $query ) {

			if ( presscore_is_load_more_pagination() ) {

				// load more button
				echo dt_get_next_page_button( $query->max_num_pages, 'paginator paginator-more-button with-ajax' );

			} else {

				$ajax_class = 'default' != presscore_get_config()->get( 'load_style' ) ? ' with-ajax' : '';

				// paginator
				dt_paginator( $query, array( 'class' => 'paginator' . $ajax_class ) );

			}

		}
	}

endif;

if ( ! function_exists( 'presscore_display_posts_filter' ) ) :

	function presscore_display_posts_filter( $args = array() ) {

		$default_args = array(
			'post_type' => 'post',
			'taxonomy' => 'category',
			'query' => null
		);
		$args = wp_parse_args( $args, $default_args );

		$config = presscore_get_config();
		$load_style = $config->get('load_style');

		// categorizer
		$filter_args = array();
		if ( $config->get( 'template.posts_filter.terms.enabled' ) ) {

			// $posts_ids = $terms_ids = array();
			$display = $config->get( 'display' );
			$select = $display['select'];

			// categorizer args
			$filter_args = array(
				'taxonomy'	=> $args['taxonomy'],
				'post_type'	=> $args['post_type'],
				'select'	=> $select
			);

			if ( 'default' == $load_style && 'masonry' == $config->get( 'layout' ) ) {

				if ( $args['query'] && $args['query']->have_posts() ) {

					foreach ( $args['query']->posts as $p ) {
						$p_ids[] = $p->ID;
					}

					// get posts terms
					$terms_ids = wp_get_object_terms( $p_ids, $args['taxonomy'], array( 'fields' => 'ids' ) );
					$terms_ids = array_unique( $terms_ids );
					$filter_args['terms'] = $terms_ids;
				}

				$filter_args['select'] = 'only';

			} elseif ( 'category' == $display['type'] ) {

				$terms_ids = empty($display['terms_ids']) ? array() : $display['terms_ids'];
				$filter_args['terms'] = $terms_ids;

			} elseif ( 'albums' == $display['type'] ) {

				$posts_ids = isset($display['posts_ids']) ? $display['posts_ids'] : array();
				$filter_args['post_ids'] = $posts_ids;

			}
		}

		$filter_class = '';
		if ( 'default' != $load_style ) {
			$filter_class .= ' with-ajax';
		}

		if ( 'list' == presscore_get_current_layout_type() ) {
			$filter_class .= ' without-isotope';
		}

		// display categorizer
		presscore_get_category_list( array(
			// function located in /in/extensions/core-functions.php
			'data'	=> dt_prepare_categorizer_data( $filter_args ),
			'class'	=> 'filter' . $filter_class
		) );
	}

endif;
