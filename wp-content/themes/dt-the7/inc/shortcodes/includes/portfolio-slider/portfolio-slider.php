<?php
/**
 * Portfolio scroller shortcode
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Portfolio_Slider', false ) ) {

	class DT_Shortcode_Portfolio_Slider extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_portfolio_slider';
		protected $post_type = 'dt_portfolio';
		protected $taxonomy = 'dt_portfolio_category';
		protected $atts = array();

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Portfolio_Slider();
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
					'class' => 'dt_vc-portfolio_scroller',
					'title' => _x( 'Portfolio scroller', 'vc inline dummy', LANGUAGE_ZONE ),
					'fields' => array( $terms_title => $terms_list )
				) );
			}

			return $this->portfolio_slider();
		}

		protected function portfolio_slider() {
			$output = '';

			// query
			$dt_query = $this->get_posts_by_terms( array(
				'orderby' => $this->atts['orderby'],
				'order' => $this->atts['order'],
				'number' => $this->atts['number'],
				'select' => $this->atts['select'],
				'category' => $this->atts['category']
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

					presscore_populate_portfolio_config();

					presscore_get_config()->set( 'post.preview.media.style', 'featured_image' );

					dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post' );

					echo '</li>';
				}

				// store loop html
				$posts_html = ob_get_contents();
				ob_end_clean();

				// shape output
				$output = '<div ' . $this->get_container_html_class( array( 'dt-portfolio-shortcode', 'slider-wrapper' ) ) . ' ' . $this->get_container_data_atts() . '>';
				$output .= '<div class="frame fullwidth-slider"><ul class="clearfix">' . $posts_html . '</ul></div>';
				if ( $this->atts['arrows'] ) {
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

		protected function sanitize_attributes( &$atts ) {
			$atts = $this->compatibility_filter( $atts );

			$attributes = shortcode_atts( array(
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
				'padding' => '20',
				'appearance' => 'under_image',
				'hover_bg_color' => 'accent',
				'bg_under_projects' => 'disabled',
				'content_aligment' => 'center',
				'hover_animation' => 'fade',
				'hover_content_visibility' => 'on_hover',
				'autoslide' => '',
				'loop' => '',
				'arrows' => 'light',
				'width' => '',
				'height' => '',
			), $atts );

			// sanitize attributes
			$attributes['order'] = apply_filters('dt_sanitize_order', $attributes['order']);
			$attributes['orderby'] = apply_filters('dt_sanitize_orderby', $attributes['orderby']);
			$attributes['number'] = apply_filters('dt_sanitize_posts_per_page', $attributes['number']);

			$attributes['show_title'] = apply_filters('dt_sanitize_flag', $attributes['show_title']);
			$attributes['show_excerpt'] = apply_filters('dt_sanitize_flag', $attributes['show_excerpt']);
			$attributes['show_details'] = apply_filters('dt_sanitize_flag', $attributes['show_details']);
			$attributes['show_link'] = apply_filters('dt_sanitize_flag', $attributes['show_link']);
			$attributes['show_zoom'] = apply_filters('dt_sanitize_flag', $attributes['show_zoom']);
			$attributes['show_categories'] = apply_filters('dt_sanitize_flag', $attributes['show_categories']);
			$attributes['show_date'] = apply_filters('dt_sanitize_flag', $attributes['show_date']);
			$attributes['show_author'] = apply_filters('dt_sanitize_flag', $attributes['show_author']);
			$attributes['show_comments'] = apply_filters('dt_sanitize_flag', $attributes['show_comments']);
			$attributes['loop'] = apply_filters('dt_sanitize_flag', $attributes['loop']);

			$attributes['appearance'] = str_replace( 'hover', 'hoover', sanitize_key( $attributes['appearance'] ) );
			$attributes['hover_content_visibility'] = str_replace( 'hover', 'hoover', sanitize_key( $attributes['hover_content_visibility'] ) );
			$attributes['hover_animation'] = sanitize_key( $attributes['hover_animation'] );
			$attributes['hover_bg_color'] = sanitize_key( $attributes['hover_bg_color'] );
			$attributes['bg_under_projects'] = sanitize_key( $attributes['bg_under_projects'] );
			$attributes['content_aligment'] = sanitize_key( $attributes['content_aligment'] );
			$attributes['arrows'] = sanitize_key( $attributes['arrows'] );

			$attributes['width'] = absint($attributes['width']);
			$attributes['height'] = absint($attributes['height']);
			$attributes['padding'] = absint($attributes['padding']);
			$attributes['autoslide'] = absint($attributes['autoslide']);

			if ( $attributes['category']) {
				$attributes['category'] = explode(',', $attributes['category']);
				$attributes['category'] = array_map('trim', $attributes['category']);
				$attributes['select'] = 'only';
			} else {
				$attributes['select'] = 'all';
			}

			return $attributes;
		}

		protected function setup_config() {
			$config = presscore_get_config();

			$config->set( 'template', 'portfolio' );
			$config->set( 'template.layout.type', 'masonry' );
			$config->set( 'layout', 'grid' );
			$config->set( 'justified_grid', false );
			$config->set( 'all_the_same_width', true );
			$config->set( 'post.preview.width.min', $this->atts['width'], 300 );
			$config->set( 'post.preview.load.effect', false );

			$config->set( 'show_titles', $this->atts['show_title'] );
			$config->set( 'show_excerpts', $this->atts['show_excerpt'] );

			if ( 'under_image' == $this->atts['appearance'] ) {
				$config->set( 'post.preview.background.enabled', ! in_array( $this->atts['bg_under_projects'], array( 'disabled', '' ) ) );
				$config->set( 'post.preview.background.style', $this->atts['bg_under_projects'] );
			} else {
				$config->set( 'post.preview.background.enabled', false );
				$config->set( 'post.preview.background.style', false );
			}

			$config->set( 'post.preview.description.style', $this->atts['appearance'] );
			$config->set( 'post.preview.description.alignment', $this->atts['content_aligment'] );
			$config->set( 'post.preview.hover.animation', $this->atts['hover_animation'] );
			$config->set( 'post.preview.hover.color', $this->atts['hover_bg_color'] );
			$config->set( 'post.preview.hover.content.visibility', $this->atts['hover_content_visibility'] );

			$config->set( 'show_links', $this->atts['show_link'] );
			$config->set( 'show_details', $this->atts['show_details'] );
			$config->set( 'show_zoom', $this->atts['show_zoom'] );

			$config->set( 'post.meta.fields.date', $this->atts['show_date'] );
			$config->set( 'post.meta.fields.categories', $this->atts['show_categories'] );
			$config->set( 'post.meta.fields.comments', $this->atts['show_comments'] );
			$config->set( 'post.meta.fields.author', $this->atts['show_author'] );
		}

		public function set_image_dimensions( $args ) {
			$args['options'] = array( 'w' => $this->atts['width'], 'h' => $this->atts['height'] );
			$args['prop'] = false;
			return $args;
		}

		protected function get_container_html_class( $class = array() ) {
			switch ( $this->atts['arrows'] ) {
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
			add_filter( 'dt_portfolio_thumbnail_args', array( &$this, 'set_image_dimensions' ) );
		}

		protected function remove_hooks() {
			remove_filter( 'dt_portfolio_thumbnail_args', array( &$this, 'set_image_dimensions' ) );
		}

		protected function compatibility_filter( &$atts ) {

			if ( isset( $atts['appearance'] ) ) {

				switch ( $atts['appearance'] ) {
					case 'default':
						$atts['appearance'] = 'under_image';
						break;

					case 'text_on_image':
						$atts['appearance'] = 'on_hover_centered';
						break;
				}

			}

			// change show_* attributes behaviour
			if ( isset( $atts['under_image_buttons'] ) && ! isset( $atts['arrows'] ) ) {

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
	DT_Shortcode_Portfolio_Slider::get_instance();

}
