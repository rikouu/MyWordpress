<?php
/**
 * Small photos shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_SmallPhotos', false ) ) {

	class DT_Shortcode_SmallPhotos extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_small_photos';
		protected $post_type = 'dt_gallery';
		protected $taxonomy = 'dt_gallery_category';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_SmallPhotos();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
			$this->map_vc_shortcode();
		}

		public function shortcode( $atts, $content = null ) {

			$attributes = $this->sanitize_attributes( $atts );

			if ( presscore_vc_is_inline() ) {

				$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $attributes['category'], 'taxonomy' => $this->taxonomy ) );

				$dummy = '
					<div class="dt_vc-shortcode_dummy dt_vc-photos_scroller" style="height: ' . $slider_args['height'] . 'px;">
						<h5>Photos scroller</h5>
						<p class="text-small"><strong>Display categories:</strong> ' . $terms_list . '</p>
					</div>
				';

				return $dummy;
			}

			$attachments_ids = array();

			// get albums
			$dt_query = $this->get_posts_by_terms( array_merge( $attributes, array( 'number' => -1 ) ) );
			if ( $dt_query->have_posts() ) {
				// take albums id
				foreach ( $dt_query->posts as $dt_post ) {
					$album_attachments = get_post_meta( $dt_post->ID, '_dt_album_media_items', true );
					if ( $album_attachments ) {
						$attachments_ids = array_merge( $attachments_ids, $album_attachments );
					}
				}
			}

			if ( 'rand' == $attributes['orderby'] ) {
				shuffle($attachments_ids);
			}

			// new query to take attachments
			$attachments_data = presscore_get_attachment_post_data( $attachments_ids, 'post__in', 'DESC', $attributes['number'] );

			$config = Presscore_Config::get_instance();
			
			$slider_class = array( 'shortcode-instagram' );
			if ( 'disabled' == $config->get('sidebar_position') ) {
				$slider_class[] = 'full';
			}

			$slider_style = array();
			if ( $attributes['margin_bottom'] ) {
				$slider_style[] = 'margin-bottom: ' . $attributes['margin_bottom'];
			}

			if ( $attributes['margin_top'] ) {
				$slider_style[] = 'margin-top: ' . $attributes['margin_top'];
			}

			$slider_fields = array();
			/*if ( $attributes['arrows'] ) {
				$slider_fields[] = 'arrows';
			}*/

			$sharebuttons = presscore_get_share_buttons_for_prettyphoto( 'photo' );

			$slider_args = array(
				'fields'        	=> $slider_fields,
				'class'         	=> $slider_class,
				'style'         	=> implode( ';', $slider_style ),
				'link'          	=> ( $attributes['lightbox'] ? 'file' : 'none' ),
				'popup'				=> ( $attributes['lightbox'] ? 'gallery' : 'none' ),
				'container_attr'	=> $sharebuttons
			);

			/*if ( $attributes['slider_title'] ) {
				$slider_args['title'] = $attributes['slider_title'];
			}*/

			if ( $attributes['height'] ) {
				$slider_args['height'] = $attributes['height'];
			}

			if ( $attributes['width'] ) {
				$slider_args['img_width'] = $attributes['width'];
			}

			$output = presscore_get_fullwidth_slider_two( $attachments_data, $slider_args );

			return $output; 
		}

		protected function sanitize_attributes( $atts ) {

			$default_atts = array(
				'category'              => '',
				'number'                => '6',
				'orderby'               => 'recent',
				'height'                => '270',
				'margin_top'            => '',
				'margin_bottom'         => '',
				'width'                 => '',
				// 'arrows'                => '1',
				'lightbox'              => ''
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			// sanitize attributes
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);
			$attributes['orderby'] = in_array( $attributes['orderby'], array( 'recent', 'random' ) ) ? $attributes['orderby'] : 'recent';
			$attributes['height'] = absint($attributes['height']);
			$attributes['width'] = absint($attributes['width']);
			$attributes['margin_top'] = $attributes['margin_top'] ? intval($attributes['margin_top']) . 'px' : '';
			$attributes['margin_bottom'] = $attributes['margin_bottom'] ? intval($attributes['margin_bottom']) . 'px' : '';
			// $attributes['arrows'] = apply_filters('dt_sanitize_flag', $attributes['arrows']);
			$attributes['lightbox'] = apply_filters('dt_sanitize_flag', $attributes['lightbox']);

			// $attributes['slider_title'] = wp_kses($content, array());

			if ( 'recent' == $attributes['orderby'] ) {
				$attributes['orderby'] = 'date';
			} elseif ( 'random' == $attributes['orderby'] ) {
				$attributes['orderby'] = 'rand';
			}

			if ( $attributes['category']) {
				$attributes['category'] = explode(',', $attributes['category']);
				$attributes['category'] = array_map('trim', $attributes['category']);
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			return $attributes;

		}

		protected function map_vc_shortcode() {

			if ( ! function_exists( 'vc_map' ) ) {
				return false;
			}

			vc_map( array(
				"name" => __("Photos Scroller", LANGUAGE_ZONE),
				"base" => $this->shortcode_name,
				"icon" => "dt_vc_ico_small_photos",
				"class" => "dt_vc_sc_small_photos",
				"category" => __('by Dream-Theme', LANGUAGE_ZONE),
				"params" => array(
					array(
						"type" => "dt_taxonomy",
						"taxonomy" => "dt_gallery_category",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Categories", LANGUAGE_ZONE),
						"param_name" => "category",
						"description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Open in lighbox", LANGUAGE_ZONE),
						"param_name" => "lightbox",
						"value" => array(
							"" => "true"
						),
						"description" => ""
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Thumbnails height", LANGUAGE_ZONE),
						"param_name" => "height",
						"value" => "210",
						"description" => __("In pixels.", LANGUAGE_ZONE)
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Thumbnails width", LANGUAGE_ZONE),
						"param_name" => "width",
						"value" => "",
						"description" => __("In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", LANGUAGE_ZONE)
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Top margin", LANGUAGE_ZONE),
						"param_name" => "margin_top",
						"value" => "10",
						"description" => __("In pixels; negative values are allowed.", LANGUAGE_ZONE)
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Bottom margin", LANGUAGE_ZONE),
						"param_name" => "margin_bottom",
						"value" => "10",
						"description" => __("In pixels; negative values are allowed.", LANGUAGE_ZONE)
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Number of posts to show", LANGUAGE_ZONE),
						"param_name" => "number",
						"value" => "12",
						"description" => ""
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Show", LANGUAGE_ZONE),
						"param_name" => "orderby",
						"value" => array(
							"Recent photos" => "recent",
							"Random photos" => "random"
						),
						"description" => ""
					)
				)
			) );

			return true;
		}
	}

	// create shortcode
	DT_Shortcode_SmallPhotos::get_instance();

}
