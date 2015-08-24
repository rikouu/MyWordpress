<?php
/**
 * The7 theme compatibility module :)
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Mod_The7_Adapter', false ) ) {

	class Presscore_Mod_The7_Adapter {

		protected $module_dir = '';
		protected $assets_uri = '';
		protected $import_status = null;
		protected $import_status_slug = '';
		protected $default_preset = 'skin01';

		public function setup() {

			$this->import_status_slug = 'presscore_mod_' . sanitize_key( wp_get_theme()->get( 'Name' ) ) . '_the7_options_import_status';
			$this->module_dir = trailingslashit( dirname( __FILE__ ) );
			$this->assets_uri = $this->get_assets_uri();

			// check for the7 options
			add_action( 'after_switch_theme', array( $this, 'the7_options_exists' ) );

			// dismiss admin notices
			add_action( 'admin_init', array( $this, 'change_import_status' ) );
		}

		public function add_admin_notices() {
			global $current_screen;

			if ( $this->the7_options_found() ) {

				$dismiss_link = add_query_arg( 'the7_opts_import', 'dissmiss_admin_notice' );
				$import_link = add_query_arg( 'the7_opts_import', 'options_imported' );

				$presets_select = '<select class="dt-skins-list">';
				foreach ( $this->get_presets_names_list() as $preset_id=>$preset_name ) {
					$presets_select .= '<option value="' . esc_attr( $preset_id ) . '">' . esc_html( $preset_name ) . '</option>';
				}
				$presets_select .= '</select>';

				$msg = '<p>' 
						. sprintf( _x( 'The7 detected!<br/>Would you like to import The7 settings to %s ?', 'options import', LANGUAGE_ZONE ), wp_get_theme()->get('Name') ) 
					. '</p>' 
					. '<p>' 
						. '<label>' 
							. _x( 'Choose default skin:', 'options import', LANGUAGE_ZONE ) 
							. '&nbsp;' 
							. $presets_select 
						. '</label>' 
					. '</p>' 
					. '<div class="dt-buttons-holder">' 
						. '<div class="dt-button-secondary">' 
							. '<a href="' . $dismiss_link . '" class="button button-secondary">' . _x( "Dismiss this message" , 'options import', LANGUAGE_ZONE ) . '</a>' 
						. '</div>' 
						. '<div class="dt-button-primary">' 
							. '<a href="' . $import_link . '" class="button button-primary dt-import-options">' . _x( "Yes, do it!" , 'options import', LANGUAGE_ZONE ) . '</a>' 
							. '<span class="spinner"></span>' 
						. '</div>' 
					. '</div>';

				add_settings_error( 'presscore-import-the7-options', 'presscore-import-the7-options', $msg, 'error' );

				if ( ! in_array( $current_screen->parent_base, array( 'options-general', 'options-framework' ) ) ) {
					settings_errors( 'presscore-import-the7-options' );
				}
			}
		}

		public function change_import_status() {

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				return;
			}

			if ( ! empty( $_GET['the7_opts_import'] ) ) {

				switch ( $_GET['the7_opts_import'] ) {
					case 'dissmiss_admin_notice':
						update_option( $this->import_status_slug, 'import_refused' );
						break;
				}

			}

			$this->import_status = get_option( $this->import_status_slug );

			if ( $this->the7_options_found() ) {

				// add admin notices
				add_action( 'admin_notices', array( $this, 'add_admin_notices' ) );

				// enqueue scripts
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

				if ( ! empty( $_POST['the7_opts_import'] ) ) {

					// remove filters
					remove_action( 'optionsframework_after_validate', 'presscore_flush_rewrite_rules_after_post_type_slug_change' );

					$this->include_dependencies();

					// change default preset
					add_filter( 'optionsframework_validate_input', array( $this, 'set_default_preset_for_inport' ) );

					// import options
					add_filter( 'optionsframework_validated_options', array( $this, 'import_theme_options' ) );

					// fix header import issues
					add_filter( 'presscore_compatibility_import_theme_options', array( Presscore_Mod_The7_Adapter_Header::get_instance(), 'filter_theme_options' ), 10, 2 );
				}
			}
		}

		public function set_default_preset_for_inport( $input = array() ) {
			if ( ! empty( $_POST['defaultPreset'] ) ) {

				$clean_default_preset = sanitize_key( $_POST['defaultPreset'] );
				$presets_list = presscore_get_presets_names_list();
				if ( in_array( $clean_default_preset, $presets_list ) ) {
					$input['preset'] = $clean_default_preset . 'b';
				}
			}

			return $input;
		}

		public function import_theme_options( $input = array() ) {
			// update import status
			// update_option( $this->import_status_slug, 'imported' );

			$of_options = get_option( 'optionsframework' );
			$the7_options = get_option( 'the7' );
			$current_theme_options = $input;
			$options_fields =& _optionsframework_options();

			$options_intersect = array_intersect_key( $the7_options, $current_theme_options );
			unset( $options_intersect['preset'] );
			$options_intersect_keys = array_keys( $options_intersect );

			foreach ( $options_fields as $option_field ) {

				if ( empty( $option_field['id'] ) || ! in_array( $option_field['id'], $options_intersect_keys ) ) {
					continue;
				}

				$option_id = $option_field['id'];
				$intersect_value = $options_intersect[ $option_id ];
				$current_theme_value = $current_theme_options[ $option_id ];

				switch ( $option_field['type'] ) {
					case 'radio':
						$radio_options = array_keys( $option_field['options'] );

						if ( ! in_array( $intersect_value, $radio_options ) ) {
							$options_intersect[ $option_id ] = $current_theme_value;
						}

						break;

					case 'background_img':

						if ( ! dt_maybe_uploaded_image_url( $intersect_value['image'] ) ) {
							$options_intersect[ $option_id ]['image'] = $current_theme_value['image'];
						}

						break;

					case 'upload':

						if ( $intersect_value ) {

							if ( is_array( $intersect_value ) && dt_maybe_uploaded_image_url( $intersect_value[0] ) ) {
								$options_intersect[ $option_id ] = $intersect_value;
							} else if ( ! is_array( $intersect_value ) && dt_maybe_uploaded_image_url( $intersect_value ) ) {
								$options_intersect[ $option_id ] = $intersect_value;
							} else {
								$options_intersect[ $option_id ] = $current_theme_value;
							}

						}

						break;
				}

			}

			$current_theme_options = array_merge( $current_theme_options, $options_intersect );

			return apply_filters( 'presscore_compatibility_import_theme_options', $current_theme_options, $the7_options );
		}

		public function the7_options_exists() {
			$of_options = get_option( 'optionsframework' );

			if ( ! empty( $of_options['knownoptions'] ) && in_array( 'the7', $of_options['knownoptions'] ) ) {
				$the7_options = get_option( 'the7' );

				if ( ! empty( $the7_options ) ) {
					add_option( $this->import_status_slug, 'options_found' );
				}
			}
		}

		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'the7-options-import', $this->assets_uri . '/css/the7-import-style.css', false, wp_get_theme()->get( 'Version' ) );
			wp_enqueue_script( 'the7-options-import', $this->assets_uri . '/js/the7-import-script.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

			wp_localize_script( 'the7-options-import', 'the7Adapter', array(
				'importPostData' => array(
					'option_page' => 'optionsframework',
					'action' => 'update',
					'_wpnonce' => wp_create_nonce( 'optionsframework-options' ),
					'the7_opts_import' => true,
					'defaultPreset' => $this->default_preset
				)
			) );
		}

		protected function the7_options_found() {
			return 'options_found' == $this->import_status;
		}

		protected function get_assets_uri() {
			$theme_root = str_replace( '\\', '/', get_theme_root() );
			$current_dir = str_replace( '\\', '/', $this->module_dir );

			return str_replace( $theme_root, get_theme_root_uri(), $current_dir );
		}

		protected function get_presets_names_list() {
			return presscore_get_presets_list();
		}

		protected function include_dependencies() {
			include_once $this->module_dir . 'classes/utility/class-mod-the7-adapter-utility-header-layout.php';

			include_once $this->module_dir . 'classes/class-mod-the7-adapter-header.php';
		}
	}

}

$adapter = new Presscore_Mod_The7_Adapter();
$adapter->setup();
