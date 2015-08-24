<?php
/**
 * Admin icons bar class.
 * 
 * @since 1.0.0
 */

if ( ! class_exists( 'Presscore_Admin_Icons_Bar', false ) ) {

	class Presscore_Admin_Icons_Bar {

		protected $fontello_css_url = '';
		protected $fontello_json_path = '';
		protected $textdomain = '';
		protected $assets_uri = '';

		public function __construct( $args = array() ) {
			$default_args = array(
				'fontello_css_url' => '',
				'fontello_json_path' => '',
				'textdomain' => 'iconsbar'
			);
			$args = wp_parse_args( $args, $default_args );

			$this->fontello_css_url = apply_filters( 'presscore/admin/icons_bar/fontello_css_url', $args['fontello_css_url'] );
			$this->fontello_json_path = apply_filters( 'presscore/admin/icons_bar/fontello_json_path', $args['fontello_json_path'] );
			$this->textdomain = $args['textdomain'];

			$this->assets_uri = $this->get_assets_uri();

			$this->init();
		}

		public function enqueue_styles() {
			wp_enqueue_style( 'presscore-icons-bar', $this->assets_uri . 'css/icons-bar.css' );
			wp_enqueue_style( 'the7-fontello', $this->fontello_css_url );
		}

		public function enqueue_scripts() {
			wp_enqueue_script( 'presscore-isons-bar', $this->assets_uri . 'js/icons-bar.js', false, wp_get_theme()->get( 'Version' ), true );
		}

		public function add_custom_toolbar() {
			global $wp_admin_bar;

			$wp_admin_bar->add_node( array(
				'id' => 'presscore-icons-bar',
				'title' => _x( 'Icons Bar', 'admin icons bar', $this->textdomain ),
				'href' => '#TB_inline?width=1024&height=768&inlineId=presscore-icons-bar'
			) );
		}

		public function ajax_response() {
			echo'
				<div class="presscore-modal-header">
					<div class="presscore-inline presscore-modal-title"><span>' . _x( 'Icons', 'admin icons bar', $this->textdomain ) . '</span></div>
					<div class="presscore-inline presscore-modal-search">
						<input type="text" id="presscore-icon-search" value="" placeholder="'. __( 'search', LANGUAGE_ZONE ).'" />
					</div>
				</div>
				<div class="presscore-modal-content presscore-icon-selection">
					<ul class="presscore-icons">
			';

			if ( $this->fontello_json_path ) {
				$json = file_get_contents( $this->fontello_json_path, 0, null, null );
				$json_output = json_decode( $json );
				$icon_prefix = $json_output->css_prefix_text;

				$format = '<li class="%1$s"><h5>%1$s</h5><input type="text" class="presscore-icon-code" readonly value="%2$s"/></span></li>';
				foreach ( $json_output->glyphs as $icon_name ) {
					$icon_class = $icon_prefix . $icon_name->css;
					echo sprintf( $format, esc_attr( $icon_class ), esc_attr( '<i class="fa ' . $icon_class . '"></i>' ) );
				}
			}

			echo '
					</ul>
				</div>
			';

			exit;
		}

		protected function init() {
			if ( ! $this->fontello_css_url || ! $this->fontello_json_path ) {
				return;
			}

			add_action( 'wp_before_admin_bar_render', array( &$this,'add_custom_toolbar' ) , 20 );

			add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_styles' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );

			add_action( 'init', 'add_thickbox' );

			add_action( 'wp_ajax_icons_bar', array( &$this, 'ajax_response' ) );
		}

		protected function get_assets_uri() {
			$theme_root = str_replace( '\\', '/', get_theme_root() );
			$current_dir = str_replace( '\\', '/', trailingslashit( dirname( __FILE__ ) ) );

			return str_replace( $theme_root, get_theme_root_uri(), $current_dir );
		}

	}

}
