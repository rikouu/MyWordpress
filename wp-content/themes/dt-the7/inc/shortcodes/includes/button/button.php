<?php
/**
 * Button shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Button', false ) ) {

	class DT_Shortcode_Button extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_button';
		protected $plugin_name = 'dt_mce_plugin_shortcode_button';
		protected $atts = array();
		protected $content = null;
		protected $config = null;

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Button();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array($this, 'shortcode') );
			$this->config = presscore_get_config();
		}

		public function shortcode( $atts, $content = null ) {
			$this->atts = $this->sanitize_attributes( $atts );
			$this->content = $content;
			return $this->get_button_html();
		}

		protected function sanitize_attributes( &$atts ) {
			$atts = $this->compatibility_filter( $atts );

			$attributes = shortcode_atts( array(
				'style' => 'default',
				'size' => 'medium',
				'color_mode' => 'default',
				'color' => '#888888',
				'link' => '',
				'target_blank' => '1',
				'animation' => 'none',
				'icon' => '',
				'icon_align' => 'left',
				'button_alignment' => 'default',
				'el_class' => ''
			), $atts );

			$attributes['style'] = sanitize_key( $attributes['style'] );
			$attributes['size'] = sanitize_key( $attributes['size'] );
			$attributes['color_mode'] = sanitize_key( $attributes['color_mode'] );
			$attributes['icon_align'] = sanitize_key( $attributes['icon_align'] );
			$attributes['button_alignment'] = sanitize_key( $attributes['button_alignment'] );

			$attributes['link'] = $attributes['link'] ? esc_url( $attributes['link'] ) : '#';
			$attributes['color'] = esc_attr( $attributes['color'] );
			$attributes['target_blank'] = apply_filters( 'dt_sanitize_flag', $attributes['target_blank'] );
			$attributes['el_class'] = esc_attr( $attributes['el_class'] );

			if ( $attributes['icon'] ) {

				if ( preg_match( '/^fa\s(fa|icon)-(\w)/', $attributes['icon'] ) ) {
					$attributes['icon'] = '<i class="' . esc_attr( $attributes['icon'] ) . '"></i>';
				} else {
					$attributes['icon'] = wp_kses( rawurldecode( base64_decode( $attributes['icon'] ) ), array( 'i' => array( 'class' => array() ) ) );
				}

			}

			return $attributes;
		}

		protected function get_button_html() {

			// add icon
			$icon = $this->atts['icon'];
			if ( $icon ) {

				if ( 'right' == $this->atts['icon_align'] ) {
					$this->content .= $icon;
				} else {
					$this->content = $icon . $this->content;
				}

			}

			$button_html = presscore_get_button_html( array(
				'href' => $this->atts['link'],
				'title' => $this->content,
				'target' => $this->atts['target_blank'],
				'class' => $this->get_button_class(),
				'atts' => $this->get_button_style()
			) );

			if ( 'center' == $this->atts['button_alignment'] ) {
				$button_html = '<div class="text-centered">' . $button_html . '</div>';
			}

			return $button_html;
		}

		protected function get_button_class() {
			$classes = array();

			switch ( $this->atts['size'] ) {
				case 'small':
					$classes[] = 'dt-btn-s';
					break;
				case 'medium':
					$classes[] = 'dt-btn-m';
					break;
				case 'big':
					$classes[] = 'dt-btn-l';
					break;
			}

			switch ( $this->atts['style'] ) {
				case 'light':
					$classes[] = 'dt-btn';
					$classes[] = 'btn-light';
					break;
				case 'link':
					$classes[] = 'btn-link';
					break;
				case 'default':
					$classes[] = 'dt-btn';
					break;
			}

			if ( presscore_shortcode_animation_on( $this->atts['animation'] ) ) {
				$classes[] = presscore_get_shortcode_animation_html_class( $this->atts['animation'] );
				$classes[] = 'animation-builder';
			}

			if ( $this->atts['icon'] && 'right' == $this->atts['icon_align'] ) {
				$classes[] = 'ico-right-side';
			}

			if ( $this->atts['el_class'] ) {
				$classes[] = $this->atts['el_class'];
			}

			return implode( ' ', $classes );
		}

		protected function get_button_style() {
			if ( 'custom' != $this->atts['color_mode'] || ! $this->atts['color'] ) {
				return '';
			}

			if ( in_array( $this->atts['style'], array( 'light', 'link' ) ) ) {
				$style = ' style="color: ' . $this->atts['color'] . ';"';
			} else if ( '3d' == $this->config->get( 'buttons.style' ) ) {

				if ( false !== strpos( $this->atts['color'], 'rgb' ) ) {
					$color = new Color( Color::rgbToHex( $this->atts['color'] ) );
				} else {
					$color = new Color( $this->atts['color'] );
				}
				$style = ' style="background: ' . $this->atts['color'] . '; border-bottom-color: #' . $color->darken( 18 ) . ';"';

			} else {
				$style = ' style="background: ' . $this->atts['color'] . ';"';
			}

			return $style;
		}

		protected function compatibility_filter( &$atts ) {
			if ( isset( $atts['size'] ) && 'link' == $atts['size'] ) {
				$atts['style'] = 'link';
				$atts['size'] = 'medium';
			}

			return $atts;
		}

	}

	// create shortcode
	DT_Shortcode_Button::get_instance();

}
