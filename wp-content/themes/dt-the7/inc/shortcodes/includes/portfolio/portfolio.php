<?php
/**
 * Portfolio shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Portfolio', false ) ) {

	class DT_Shortcode_Portfolio extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_portfolio';
		protected $post_type = 'dt_portfolio';
		protected $taxonomy = 'dt_portfolio_category';
		protected $plugin_name = 'dt_mce_plugin_shortcode_portfolio';
		protected $atts;

		public static function get_instance() {

			if ( ! self::$instance ) {
				self::$instance = new DT_Shortcode_Portfolio();
			}

			return self::$instance;

		}

		protected function __construct() {

			add_shortcode( $this->shortcode_name, array($this, 'shortcode') );

			// add shortcode button
			$tinymce_button = new DT_ADD_MCE_BUTTON( $this->plugin_name, basename(dirname(__FILE__)), false, 4 );

		}

		public function shortcode( $atts, $content = null ) {
			$atts = $this->compatibility_filter( $atts );

			$attributes = shortcode_atts( array(
				'type' => 'masonry',
				'category' => '',
				'order' => '',
				'orderby' => '',
				'number' => '12',
				'show_title' => '',
				'show_excerpt' => '',
				'show_details' => '',
				'show_link' => '',
				'show_zoom' => '',
				'show_categories' => '',
				'show_date' => '',
				'show_author' => '',
				'show_comments' => '',
				'columns' => '2',
				'column_width' => '370',
				'padding' => '20',
				'descriptions' => 'under_image',
				'hover_bg_color' => 'accent',
				'bg_under_projects' => 'disabled',
				'content_aligment' => 'left',
				'hover_animation' => 'fade',
				'hover_content_visibility' => 'on_hover',
				'loading_effect' => 'fade_in',
				'proportion' => '',
				'same_width' => '1',
				'full_width' => '',
			), $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

			if ( $attributes['category'] ) {

				$attributes['category'] = explode(',', $attributes['category']);
				$attributes['category'] = array_map('trim', $attributes['category']);
				$attributes['select'] = 'only';

			} else {

				$attributes['select'] = 'all';

			}

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);

			$attributes['show_details'] = apply_filters('dt_sanitize_flag', $attributes['show_details']);
			$attributes['show_link'] = apply_filters('dt_sanitize_flag', $attributes['show_link']);
			$attributes['show_zoom'] = apply_filters('dt_sanitize_flag', $attributes['show_zoom']);

			$attributes['show_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_categories']);
			$attributes['show_date'] = apply_filters('dt_sanitize_flag', $attributes['show_date']);
			$attributes['show_author'] = apply_filters('dt_sanitize_flag', $attributes['show_author']);
			$attributes['show_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_comments']);

			$attributes['columns'] = absint($attributes['columns']);

			$attributes['descriptions'] = in_array($attributes['descriptions'], array('under_image', 'on_hover_centered', 'on_dark_gradient', 'from_bottom')) ? $attributes['descriptions'] : 'under_image';
			$attributes['descriptions'] = str_replace('hover', 'hoover', $attributes['descriptions']);

			$attributes['hover_bg_color'] = in_array($attributes['hover_bg_color'], array('accent', 'dark')) ? $attributes['hover_bg_color'] : 'accent';
			$attributes['bg_under_projects'] = in_array($attributes['bg_under_projects'], array('disabled', 'fullwidth', 'with_paddings')) ? $attributes['bg_under_projects'] : 'accent';

			$attributes['content_aligment'] = in_array($attributes['content_aligment'], array('centre', 'center')) ? 'center' : 'left';

			$attributes['hover_animation'] = in_array($attributes['hover_animation'], array('fade', 'move_to', 'direction_aware', 'move_from_bottom')) ? $attributes['hover_animation'] : 'fade';
			$attributes['hover_content_visibility'] = in_array($attributes['hover_content_visibility'], array('on_hover', 'always')) ? $attributes['hover_content_visibility'] : 'on_hover';
			$attributes['hover_content_visibility'] = str_replace('hover', 'hoover', $attributes['hover_content_visibility']);

			$attributes['same_width'] = apply_filters('dt_sanitize_flag', $attributes['same_width']);

			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);
			$attributes['padding'] = intval($attributes['padding']);
			$attributes['column_width'] = intval($attributes['column_width']);

			if ( $attributes['proportion'] ) {

				$wh = array_map( 'absint', explode(':', $attributes['proportion']) );
				if ( 2 == count($wh) && !empty($wh[0]) && !empty($wh[1]) ) {

					$attributes['proportion'] = $wh[0]/$wh[1];

				} else {

					$attributes['proportion'] = '';

				}
			}

			// store attributes
			$this->atts = $attributes;

			return $this->portfolio_masonry(); 
		}

		/**
		 * Portfolio masonry.
		 *
		 */
		public function portfolio_masonry() {
			global $post;

			$post_backup = $post;

			$dt_query = $this->get_posts_by_terms( $this->atts );

			$output = '';

			if ( $dt_query->have_posts() ) {

				$config = Presscore_Config::get_instance();

				// backup and reset config
				$config_backup = $config->get();

				$this->setup_config();

				$details_already_hidden = false;
				if ( !$config->get('show_details') && !has_filter('presscore_post_details_link', 'presscore_return_empty_string') ) {
					add_filter('presscore_post_details_link', 'presscore_return_empty_string');
					$details_already_hidden = true;
				}

				$before_post_hook_added = false;
				$after_post_hook_added = false;

				// add masonry wrap
				if ( ! has_filter( 'presscore_before_post', 'presscore_before_post_masonry' ) ) {
					add_action('presscore_before_post', 'presscore_before_post_masonry', 15);
					$before_post_hook_added = true;
				}

				if ( ! has_filter( 'presscore_after_post', 'presscore_after_post_masonry' ) ) {
					add_action('presscore_after_post', 'presscore_after_post_masonry', 15);
					$after_post_hook_added = true;
				}

				// remove proportions filter
				remove_filter( 'dt_portfolio_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );

				// add image height filter
				add_filter( 'dt_portfolio_thumbnail_args', array($this, 'portfolio_image_filter'), 15 );

				// loop
				while ( $dt_query->have_posts() ) { $dt_query->the_post();

					// populate post config
					presscore_populate_portfolio_config();

					ob_start();

					dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post' );

					$output .= ob_get_contents();
					ob_end_clean();
				}

				// remove image height filter
				remove_filter( 'dt_portfolio_thumbnail_args', array($this, 'portfolio_image_filter'), 15 );

				// add proportions filter
				add_filter( 'dt_portfolio_thumbnail_args', 'presscore_add_thumbnail_class_for_masonry', 15 );

				// remove masonry wrap
				if ( $before_post_hook_added ) {
					remove_action('presscore_before_post', 'presscore_before_post_masonry', 15);
				}

				if ( $after_post_hook_added ) {
					remove_action('presscore_after_post', 'presscore_after_post_masonry', 15);
				}

				if ( $details_already_hidden ) {
					// remove details filter
					remove_filter('presscore_post_details_link', 'presscore_return_empty_string');
				}

				$output = '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-portfolio-shortcode' ) ) . presscore_masonry_container_data_atts() . '>' . $output . '</div>';

				if ( $this->atts['full_width'] ) {
					$output = '<div class="full-width-wrap">' . $output . '</div>';
				}

				// restore original $post
				$post = $post_backup;
				setup_postdata( $post );

				// restore config
				$config->reset( $config_backup );

			} // if have posts

			return $output;
		}

		public function portfolio_image_filter( $args = array() ) {
			$atts = $this->atts;

			if ( $atts['proportion'] ) {
				$args['prop'] = $atts['proportion'];
			}
			return $args;
		}

		protected function setup_config() {
			$config = Presscore_Config::get_instance();

			$attributes = &$this->atts;

			$config->set( 'layout', $attributes['type'] );
			$config->set( 'template', 'portfolio' );
			$config->set( 'all_the_same_width', $attributes['same_width'] );

			// do not show preview details button
			$config->set( 'post.preview.buttons.details.enabled', false );

			// desired columns number
			$config->set( 'template.columns.number', $attributes['columns'] );
			$config->set( 'post.preview.width.min', $attributes['column_width'] );
			$config->set( 'item_padding', $attributes['padding'] );

			$config->set( 'post.preview.description.style', $attributes['descriptions'] );
			$config->set( 'post.preview.description.alignment', $attributes['content_aligment'] );

			if ( 'under_image' == $attributes['descriptions'] ) {
				$config->set( 'post.preview.background.enabled', ! in_array( $attributes['bg_under_projects'], array( 'disabled', '' ) ) );
				$config->set( 'post.preview.background.style', $attributes['bg_under_projects'] );
			} else {
				$config->set( 'post.preview.background.enabled', false );
				$config->set( 'post.preview.background.style', false );
			}

			$config->set( 'load_style', 'default' );

			$config->set( 'post.preview.hover.animation', $attributes['hover_animation'] );
			$config->set( 'post.preview.hover.color', $attributes['hover_bg_color'] );
			$config->set( 'post.preview.hover.content.visibility', $attributes['hover_content_visibility'] );
			$config->set( 'post.preview.load.effect', $attributes['loading_effect'], 'fade_in' );

			$config->set( 'show_links', $attributes['show_link'] );
			$config->set( 'show_titles', $attributes['show_title'] );

			$config->set( 'show_details', $attributes['show_details'] );
			$config->set( 'show_excerpts', $attributes['show_excerpt'] );
			$config->set( 'show_zoom', $attributes['show_zoom'] );

			/////////////////////////////
			// post meta information //
			/////////////////////////////

			$config->set( 'post.meta.fields.date', $attributes['show_date'] );
			$config->set( 'post.meta.fields.categories', $attributes['show_categories'] );
			$config->set( 'post.meta.fields.comments', $attributes['show_comments'] );
			$config->set( 'post.meta.fields.author', $attributes['show_author'] );
		}

		protected function compatibility_filter( &$atts ) {

			// descriptions style
			if ( isset( $atts['descriptions'] ) && 'on_hover' == $atts['descriptions'] ) {
				$atts['descriptions'] = 'on_hover_centered';
			}

			// detect old shortcode
			if ( ! isset( $atts['columns'] ) && isset( $atts['column_width'] ) ) {

				// columns adaptation
				$abs_column_width = absint( $atts['column_width'] );
				if ( $abs_column_width ) {
					$atts['columns'] = intval( round( 1200 / $abs_column_width ) );
				}

				// post meta visibility
				$show_atts_family = array(
					'show_title',
					'show_excerpt',
					'show_details',
					'show_link',
					'show_zoom',
				);

				foreach ( $show_atts_family as $show_att ) {
					if ( ! isset( $atts[ $show_att ] ) ) {
						$atts[ $show_att ] = 'true';
					}
				}

				if ( ! isset( $atts['meta_info'] ) ) {
					$atts['show_categories'] = 'true';
					$atts['show_date'] = 'true';
					$atts['show_author'] = 'false';
					$atts['show_comments'] = 'true';
				}
			}

			return $atts;
		}

	}

	// create shortcode
	DT_Shortcode_Portfolio::get_instance();

}
