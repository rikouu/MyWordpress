<?php
/**
 * Albums scroller shortcode
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Albums_Slider', false ) ) {

	class DT_Shortcode_Albums_Slider extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_albums_scroller';
		protected $post_type = 'dt_gallery';
		protected $taxonomy = 'dt_gallery_category';
		protected $atts = array();

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Albums_Slider();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$this->atts = $this->sanitize_attributes( $atts );

			// vc inline dummy
			if ( presscore_vc_is_inline() ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', LANGUAGE_ZONE );
				$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $this->atts['category'], 'taxonomy' => $this->taxonomy ) );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-albums_scroller',
					'title' => _x( 'Albums posts scroller', 'vc inline dummy', LANGUAGE_ZONE ),
					'fields' => array( $terms_title => $terms_list )
				) );
			}

			return $this->slider();
		}

		public function slider() {
			$output = '';
			$attributes = &$this->atts;

			// query
			$dt_query = $this->get_posts_by_terms( array(
				'orderby' => $attributes['orderby'],
				'order' => $attributes['order'],
				'number' => $attributes['number'],
				'select' => $attributes['select'],
				'category' => $attributes['category']
			) );

			if ( $dt_query->have_posts() ) {

				// setup
				$this->backup_post_object();
				$this->backup_theme_config();
				$this->setup_config();
				$this->add_hooks();

				ob_start();

				// loop
				while( $dt_query->have_posts() ) { $dt_query->the_post();
					echo '<li class="fs-entry">';

					presscore_populate_album_post_config();
					dt_get_template_part( 'albums/masonry/albums-masonry-post' );

					echo '</li>';
				}

				// store loop html
				$posts_html = ob_get_contents();
				ob_end_clean();

				// shape output
				$output = '<div ' . $this->get_container_html_class( array( 'dt-albums-shortcode', 'slider-wrapper' ) ) . ' ' . $this->get_container_data_atts() . '>';
				$output .= '<div class="frame fullwidth-slider"><ul class="clearfix">' . $posts_html . '</ul></div>';
				if ( $attributes['arrows'] ) {
					$output .= '<div class="prev"><i></i></div><div class="next"><i></i></div>';
				}
				$output .= '</div>';

				// cleanup
				$this->remove_hooks();
				$this->restore_theme_config();
				$this->restore_post_object();
			}
			return $output;
		}

		public function set_image_dimensions( $args ) {
			$args['options'] = array( 'w' => $this->atts['width'], 'h' => $this->atts['height'] );
			$args['prop'] = false;
			return $args;
		}

		protected function sanitize_attributes( &$atts ) {
			$attributes = shortcode_atts( array(
				'category' => '',
				'order' => '',
				'orderby' => '',
				'number' => '6',
				'show_title' => '',
				'show_excerpt' => '',
				'show_categories' => '',
				'show_date' => '',
				'show_author' => '',
				'show_comments' => '',
				'show_miniatures' => '',
				'show_media_count' => '',
				'padding' => '5',
				'descriptions' => 'under_image',
				'hover_bg_color' => 'accent',
				'bg_under_albums' => 'disabled',
				'content_aligment' => 'left',
				'hover_animation' => 'fade',
				'hover_content_visibility' => 'on_hover',
				'autoslide' => '',
				'loop' => '',
				'arrows' => 'light',
				'width' => 0,
				'height' => 210,
			), $atts );

			// sanitize attributes
			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);
			$attributes['show_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_categories']);
			$attributes['show_date'] = apply_filters('dt_sanitize_flag', $attributes['show_date']);
			$attributes['show_author'] = apply_filters('dt_sanitize_flag', $attributes['show_author']);
			$attributes['show_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_comments']);
			$attributes['show_miniatures'] = apply_filters('dt_sanitize_flag', $attributes['show_miniatures']);
			$attributes['show_media_count'] = apply_filters('dt_sanitize_flag', $attributes['show_media_count']);
			$attributes['loop'] = apply_filters('dt_sanitize_flag', $attributes['loop']);

			$attributes['descriptions'] = str_replace( 'hover', 'hoover', sanitize_key( $attributes['descriptions'] ) );
			$attributes['hover_content_visibility'] = str_replace( 'hover', 'hoover', sanitize_key( $attributes['hover_content_visibility'] ) );
			$attributes['hover_bg_color'] = sanitize_key( $attributes['hover_bg_color'] );
			$attributes['hover_animation'] = sanitize_key( $attributes['hover_animation'] );
			$attributes['bg_under_albums'] = sanitize_key( $attributes['bg_under_albums'] );
			$attributes['content_aligment'] = sanitize_key( $attributes['content_aligment'] );
			$attributes['arrows'] = sanitize_key( $attributes['arrows'] );

			$attributes['width'] = absint($attributes['width']);
			$attributes['height'] = absint($attributes['height']);
			$attributes['padding'] = absint($attributes['padding']);
			$attributes['autoslide'] = absint($attributes['autoslide']);

			if ( $attributes['category']) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			return $attributes;
		}

		protected function setup_config() {
			$config = presscore_get_config();
			$attributes = &$this->atts;

			$config->set( 'template', 'albums' );
			$config->set( 'template.layout.type', 'masonry' );
			$config->set( 'layout', 'grid' );
			$config->set( 'justified_grid', false );
			$config->set( 'all_the_same_width', true );
			$config->set( 'post.preview.width.min', $attributes['width'], 300 );
			$config->set( 'post.preview.buttons.details.enabled', false );
			$config->set( 'post.preview.load.effect', false );

			$config->set( 'show_titles', $attributes['show_title'] );
			$config->set( 'show_excerpts', $attributes['show_excerpt'] );

			if ( 'under_image' == $attributes['descriptions'] ) {
				$config->set( 'post.preview.background.enabled', ! in_array( $attributes['bg_under_albums'], array( 'disabled', '' ) ) );
				$config->set( 'post.preview.background.style', $attributes['bg_under_albums'] );
			} else {
				$config->set( 'post.preview.background.enabled', false );
				$config->set( 'post.preview.background.style', false );
			}

			$config->set( 'post.preview.description.style', $attributes['descriptions'] );
			$config->set( 'post.preview.description.alignment', $attributes['content_aligment'] );
			$config->set( 'post.preview.hover.animation', $attributes['hover_animation'] );
			$config->set( 'post.preview.hover.color', $attributes['hover_bg_color'] );
			$config->set( 'post.preview.hover.content.visibility', $attributes['hover_content_visibility'] );
			$config->set( 'post.preview.mini_images.enabled', $attributes['show_miniatures'] );
			$config->set( 'post.meta.fields.media_number', $attributes['show_media_count'] );

			$config->set( 'post.meta.fields.date', $attributes['show_date'] );
			$config->set( 'post.meta.fields.categories', $attributes['show_categories'] );
			$config->set( 'post.meta.fields.comments', $attributes['show_comments'] );
			$config->set( 'post.meta.fields.author', $attributes['show_author'] );
		}

		protected function get_container_html_class( $class = array() ) {
			$attributes = &$this->atts;

			switch ( $attributes['arrows'] ) {
				case 'light':
					$class[] = 'arrows-light';
					break;
				case 'dark':
					$class[] = 'arrows-dark';
					break;
				case 'rectangular_accent':
					$class[] = 'arrows-accent';
					break;
			}

			$html_class = presscore_masonry_container_class( $class );
			$html_class = str_replace( array( ' iso-grid', 'iso-grid ', ' loading-effect-fade-in', 'loading-effect-fade-in ' ), '', $html_class );

			return $html_class;
		}

		protected function get_container_data_atts() {
			return presscore_get_inlide_data_attr( array(
				'padding-side' => $this->atts['padding'],
				'autoslide' => $this->atts['autoslide'] ? 'true' : 'false',
				'delay' => $this->atts['autoslide'],
				'loop' => $this->atts['loop'] ? 'true' : 'false'
			) );
		}

		protected function add_hooks() {
			add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', array( &$this, 'set_image_dimensions' ) );
			add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );
		}

		protected function remove_hooks() {
			remove_filter( 'presscore_get_images_gallery_hoovered-title_img_args', array( &$this, 'set_image_dimensions' ) );
			remove_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );
		}

	}

	// create shortcode
	DT_Shortcode_Albums_Slider::get_instance();

}
