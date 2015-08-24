<?php
/**
 * Blog masonry shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_BlogPosts', false ) ) {

	/**
	 * Shortcode Blog masonry class.
	 *
	 */
	class DT_Shortcode_BlogPosts extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_blog_posts';
		protected $post_type = 'post';
		protected $taxonomy = 'category';
		protected $atts = array();
		protected $config = null;

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_BlogPosts();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$this->atts = $this->sanitize_attributes( $atts );
			$this->config = presscore_get_config();

			return $this->blog_masonry();
		}

		private function blog_masonry() {
			$output = '';

			$dt_query = $this->get_posts_by_terms( array(
				'orderby' => $this->atts['orderby'],
				'order' => $this->atts['order'],
				'number' => $this->atts['number'],
				'select' => $this->atts['select'],
				'category' => $this->atts['category']
			) );

			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();
				$this->backup_theme_config();
				$this->setup_config();

				ob_start();

				do_action( 'presscore_before_shortcode_loop', $this->shortcode_name, $this->atts );

				// fullwidth wrap open
				if ( $this->atts['full_width'] ) { echo '<div class="full-width-wrap">'; }

				// masonry container open
				echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-blog-shortcode' ) ) . presscore_masonry_container_data_atts() . '>';

				while ( $dt_query->have_posts() ) { $dt_query->the_post();
					presscore_populate_post_config();

					$this->config->set( 'post.preview.gallery.style', 'hovered_gallery' );

					dt_get_template_part( 'blog/masonry/blog-masonry-post' );
				}

				// masonry container close
				echo '</div>';

				// fullwidth wrap close
				if ( $this->atts['full_width'] ) { echo '</div>'; }

				do_action( 'presscore_after_shortcode_loop', $this->shortcode_name, $this->atts );

				$output = ob_get_contents();
				ob_end_clean();

				// cleanup
				$this->restore_theme_config();
				$this->restore_post_object();
			}

			return $output;
		}

		protected function sanitize_attributes( &$atts ) {
			$atts = $this->compatibility_filter( $atts );

			$attributes = shortcode_atts( array(
				'type' => 'masonry',
				'category' => '',
				'order' => '',
				'orderby' => '',
				'number' => '12',
				'proportion' => '',
				'same_width' => '1',
				'padding' => '20',
				'column_width' => '370',
				'columns_number' => '3',
				'full_width' => '',
				'fancy_date' => '',
				'background' => 'disabled',
				'show_excerpts' => '',
				'show_read_more_button' => '',
				'loading_effect' => 'fade_in',
				'show_post_categories' => '',
				'show_post_date' => '',
				'show_post_author' => '',
				'show_post_comments' => ''
			), $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['background'] = sanitize_key( $attributes['background'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

			$attributes['same_width'] = apply_filters('dt_sanitize_flag', $attributes['same_width']);
			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);
			$attributes['fancy_date'] = apply_filters('dt_sanitize_flag', $attributes['fancy_date']);
			$attributes['show_excerpts'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpts']);
			$attributes['show_read_more_button'] = apply_filters('dt_sanitize_flag', $attributes['show_read_more_button']);
			$attributes['show_post_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_post_categories']);
			$attributes['show_post_date'] = apply_filters('dt_sanitize_flag', $attributes['show_post_date']);
			$attributes['show_post_author'] = apply_filters('dt_sanitize_flag', $attributes['show_post_author']);
			$attributes['show_post_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_post_comments']);

			$attributes['padding'] = absint($attributes['padding']);
			$attributes['column_width'] = absint($attributes['column_width']);
			$attributes['columns_number'] = absint($attributes['columns_number']);

			if ( $attributes['category']) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			if ( $attributes['proportion'] ) {
				$wh = array_map( 'absint', explode(':', $attributes['proportion']) );
				if ( 2 == count($wh) && !empty($wh[0]) && !empty($wh[1]) ) {
					// $attributes['proportion'] = $wh[0]/$wh[1];
					$attributes['proportion'] = array( 'width' => $wh[0], 'height' => $wh[1] );
				} else {
					$attributes['proportion'] = '';
				}
			}

			return $attributes;
		}

		protected function setup_config() {
			$config = &$this->config;
			$atts = &$this->atts;

			$config->set( 'template', 'blog' );
			$config->set( 'load_style', 'default' );
			$config->set( 'post.preview.description.style', 'under_image' );
			$config->set( 'post.preview.description.alignment', 'left' );

			$config->set( 'layout', $atts['type'] );
			$config->set( 'all_the_same_width', $atts['same_width'] );
			$config->set( 'item_padding', $atts['padding']  );
			$config->set( 'show_excerpts', $atts['show_excerpts'] );
			$config->set( 'show_details', $atts['show_read_more_button'] );
			$config->set( 'thumb_proportions', $atts['proportion'] );

			$config->set( 'template.columns.number', $atts['columns_number'] );
			$config->set( 'post.meta.fields.date', $atts['show_post_date'] );
			$config->set( 'post.meta.fields.categories', $atts['show_post_categories'] );
			$config->set( 'post.meta.fields.comments', $atts['show_post_comments'] );
			$config->set( 'post.meta.fields.author', $atts['show_post_author'] );

			$config->set( 'post.fancy_date.enabled', $atts['fancy_date'] );
			$config->set( 'post.preview.background.enabled', $atts['background'] != 'disabled' );
			$config->set( 'post.preview.background.style',  $atts['background'] != 'disabled' ? $atts['background'] : '' );
			$config->set( 'post.preview.load.effect', $atts['loading_effect'], 'fade_in' );
			$config->set( 'post.preview.width.min', $atts['column_width'] );

			$config->set( 'image_layout', $atts['proportion'] ? 'resize' : 'original' );
		}

		protected function compatibility_filter( &$atts ) {

			// detect old shortcode
			if ( ! isset( $atts['columns_number'] ) && isset( $atts['column_width'] ) ) {

				// columns adaptation
				$abs_column_width = absint( $atts['column_width'] );
				if ( $abs_column_width ) {
					$atts['columns_number'] = intval( round( 1200 / $abs_column_width ) );
				}

				$atts['fancy_date'] = 'true';
				$atts['show_excerpts'] = 'true';
				$atts['show_read_more_button'] = 'true';
				$atts['show_post_categories'] = 'true';
				$atts['show_post_date'] = 'true';
				$atts['show_post_author'] = 'true';
				$atts['show_post_comments'] = 'true';

			}

			return $atts;
		}

	}

	// create shortcode
	DT_Shortcode_BlogPosts::get_instance();

}
