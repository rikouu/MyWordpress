<?php
/**
 * Albums masonry shortcode
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Albums', false ) ) {

	class DT_Shortcode_Albums extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_albums';
		protected $post_type = 'dt_gallery';
		protected $taxonomy = 'dt_gallery_category';

		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new DT_Shortcode_Albums();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$attributes = $this->sanitize_attributes( $atts );

			// vc inline dummy
			if ( presscore_vc_is_inline() ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', LANGUAGE_ZONE );
				$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $attributes['category'], 'taxonomy' => $this->taxonomy ) );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-albums_masonry',
					'title' => _x( 'Albums masonry', 'vc inline dummy', LANGUAGE_ZONE ),
					'fields' => array( $terms_title => $terms_list )
				) );
			}

			return $this->albums_masonry( $attributes ); 
		}

		protected function albums_masonry( &$attributes ) {
			$output = '';

			$dt_query = $this->get_posts_by_terms( array(
				'orderby' => $attributes['orderby'],
				'order' => $attributes['order'],
				'number' => $attributes['number'],
				'select' => $attributes['select'],
				'category' => $attributes['category']
			) );

			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();
				$this->backup_theme_config();

				$this->setup_config( $attributes );

				ob_start();

				do_action( 'presscore_before_shortcode_loop', $this->shortcode_name, $attributes );

				// fullwidth wrap open
				if ( $attributes['full_width'] ) { echo '<div class="full-width-wrap">'; }

				// masonry container open
				echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-albums-shortcode' ) ) . presscore_masonry_container_data_atts() . '>';

					while ( $dt_query->have_posts() ) { $dt_query->the_post();
						presscore_populate_album_post_config();

						dt_get_template_part( 'albums/masonry/albums-masonry-post' );
					}

				// masonry container close
				echo '</div>';

				// fullwidth wrap close
				if ( $attributes['full_width'] ) { echo '</div>'; }

				do_action( 'presscore_after_shortcode_loop', $this->shortcode_name, $attributes );

				$output = ob_get_contents();
				ob_end_clean();

				$this->restore_theme_config();
				$this->restore_post_object();

			}

			return $output;
		}

		protected function sanitize_attributes( &$atts ) {
			$default_atts = array(
				'type' => 'masonry',
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
				'columns' => '2',
				'column_width' => '370',
				'padding' => '5',
				'descriptions' => 'under_image',
				'hover_bg_color' => 'accent',
				'bg_under_albums' => 'disabled',
				'content_aligment' => 'left',
				'hover_animation' => 'fade',
				'hover_content_visibility' => 'on_hover',
				'loading_effect' => 'fade_in',
				'proportion' => '',
				'same_width' => '1',
				'full_width' => '',
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			// sanitize attributes
			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['hover_bg_color'] = sanitize_key( $attributes['hover_bg_color'] );
			$attributes['hover_animation'] = sanitize_key( $attributes['hover_animation'] );
			$attributes['loading_effect'] = sanitize_key( $attributes['loading_effect'] );

			$attributes['descriptions'] = sanitize_key( $attributes['descriptions'] );
			$attributes['descriptions'] = str_replace( 'hover', 'hoover', $attributes['descriptions'] );

			$attributes['bg_under_albums'] = sanitize_key( $attributes['bg_under_albums'] );
			$attributes['content_aligment'] = in_array( $attributes['content_aligment'], array( 'centre', 'center' ) ) ? 'center' : 'left';

			$attributes['hover_content_visibility'] = sanitize_key( $attributes['hover_content_visibility'] );
			$attributes['hover_content_visibility'] = str_replace( 'hover', 'hoover', $attributes['hover_content_visibility'] );

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
			$attributes['same_width'] = apply_filters('dt_sanitize_flag', $attributes['same_width']);
			$attributes['full_width'] = apply_filters('dt_sanitize_flag', $attributes['full_width']);

			$attributes['columns'] = absint($attributes['columns']);
			$attributes['padding'] = intval($attributes['padding']);
			$attributes['column_width'] = intval($attributes['column_width']);

			if ( $attributes['category'] ) {
				$attributes['category'] = presscore_sanitize_explode_string( $attributes['category'] );
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			if ( $attributes['proportion'] ) {

				$wh = array_map( 'absint', explode(':', $attributes['proportion']) );
				if ( 2 == count($wh) && !empty($wh[0]) && !empty($wh[1]) ) {
					$attributes['proportion'] = array( 'width' => $wh[0], 'height' => $wh[1] );
				} else {
					$attributes['proportion'] = '';
				}
			}

			return $attributes;
		}

		protected function setup_config( &$attributes ) {
			$config = Presscore_Config::get_instance();

			$config->set( 'template', 'albums' );
			$config->set( 'load_style', 'default' );
			$config->set( 'template.layout.type', 'masonry' );
			$config->set( 'post.preview.buttons.details.enabled', false );
			$config->set( 'justified_grid', false );

			$config->set( 'layout', $attributes['type'] );
			$config->set( 'image_layout', $attributes['proportion'] ? 'resize' : 'original' );
			$config->set( 'thumb_proportions', $attributes['proportion'] );
			$config->set( 'all_the_same_width', $attributes['same_width'] );
			$config->set( 'show_titles', $attributes['show_title'] );
			$config->set( 'show_excerpts', $attributes['show_excerpt'] );
			$config->set( 'template.columns.number', $attributes['columns'] );
			$config->set( 'post.preview.width.min', $attributes['column_width'] );
			$config->set( 'item_padding', $attributes['padding'] );

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
			$config->set( 'post.preview.load.effect', $attributes['loading_effect'], 'fade_in' );
			$config->set( 'post.preview.mini_images.enabled', $attributes['show_miniatures'] );
			$config->set( 'post.meta.fields.media_number', $attributes['show_media_count'] );

			$config->set( 'post.meta.fields.date', $attributes['show_date'] );
			$config->set( 'post.meta.fields.categories', $attributes['show_categories'] );
			$config->set( 'post.meta.fields.comments', $attributes['show_comments'] );
			$config->set( 'post.meta.fields.author', $attributes['show_author'] );
		}

	}

	// create shortcode
	DT_Shortcode_Albums::get_instance();

}
