<?php
/**
 * Theme update functions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Update library.
 *
 */
require_once trailingslashit( dirname( __FILE__ ) ) . '/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php';

if ( ! function_exists( 'presscore_add_update_options_page' ) ) :

	function presscore_add_update_options_page( $options_list = array() ) {
		$options_list['theme_update'] = 'inc/admin/mods/mod-theme-update/options-themeupdate.php';
		return $options_list;
	}
	add_filter( 'presscore_options_list', 'presscore_add_update_options_page', 1 );

endif;

if ( ! function_exists( 'presscore_theme_update_get_changelog_url' ) ) :

	function presscore_theme_update_get_changelog_url() {
		return 'http://the7.dream-demo.com/changelog.txt';
	}

endif;

/**
 * Check for theme update.
 *
 */
function presscore_check_for_update() {

	$current_screen = get_current_screen();

	if ( false !== strpos( $current_screen->id, 'of-themeupdate-menu' ) ) {

		$user = of_get_option( 'theme_update-user_name', '' );
		$api_key = of_get_option( 'theme_update-api_key', '' );

		if ( $user || $api_key ) {

			$upgrader = new Envato_WordPress_Theme_Upgrader( $user, $api_key );

			if ( $upgrader ) {

				$responce = $upgrader->check_for_theme_update();
				$current_theme = wp_get_theme();
				$update_needed = false;

				//check is current theme up to date
				if ( isset($responce->updated_themes) ) {
					foreach ( $responce->updated_themes as $updated_theme ) {

						if ( $updated_theme->version == $current_theme->version && $updated_theme->name == $current_theme->name ) {
							$update_needed = true;
						}
					}
				}

				if ( !empty($responce->errors) ) {

					add_settings_error( 'theme-update', 'update_errors', _x('Error:<br />', 'backend', LANGUAGE_ZONE) . implode( '<br \>', $responce->errors ), 'error' );
				} else if ( $update_needed ) {

					// changelog link
					$message = sprintf( _x('New version (<a href="%s" target="_blank">see changelog</a>) of theme is available!', 'backend', LANGUAGE_ZONE), presscore_theme_update_get_changelog_url() );

					// update link
					$message .= '&nbsp;<a href="' . add_query_arg('theme-updater', 'update') . '">' . _x('Please, click here to update.', 'backend', LANGUAGE_ZONE) . '</a>';

					add_settings_error( 'theme-update', 'update_nedded', $message, 'updated' );
				} else {

					add_settings_error( 'theme-update', 'theme-uptodate', _x("You're have most recent version of theme!", 'backend', LANGUAGE_ZONE), 'updated salat' );
				}

				$update_result = get_transient( 'presscore_update_result' );

				if ( $update_result ) {

					if ( !empty($update_result->success) ) {

						add_settings_error( 'theme-update', 'update_result', _x('Theme was successfully updated to newest version!', 'backend', LANGUAGE_ZONE), 'updated salat' );
					} else if ( !empty($update_result->installation_feedback) ) {

						add_settings_error( 'theme-update', 'update_result', _x('Error:<br />', 'backend', LANGUAGE_ZONE) . implode('<br />', $update_result->installation_feedback), 'error' );
					}
				}

			}

		}
	}

}
add_action( 'admin_head', 'presscore_check_for_update' );

/**
 * Update theme.
 *
 */
function presscore_theme_update() {

	if ( isset($_GET['theme-updater']) && 'update' == $_GET['theme-updater'] ) {

		// global timestamp
		global $dt_lang_backup_dir_timestamp;

		$user = of_get_option( 'theme_update-user_name', '' );
		$api_key = of_get_option( 'theme_update-api_key', '' );

		$dt_lang_backup_dir_timestamp = time();

		// backup lang files
		add_filter( 'upgrader_pre_install', 'presscore_before_theme_update', 10, 2 );

		// restore lang files
		add_filter( 'upgrader_post_install', 'presscore_after_theme_update', 10, 3 );

		$upgrader = new Envato_WordPress_Theme_Upgrader( $user, $api_key );

		$responce = $upgrader->upgrade_theme();

		remove_filter( 'upgrader_pre_install', 'presscore_before_theme_update', 10, 2 );
		remove_filter( 'upgrader_post_install', 'presscore_after_theme_update', 10, 3 );

		unset($dt_lang_backup_dir_timestamp);

		set_transient( 'presscore_update_result', $responce, 10 );

		if ( $responce ) {
			wp_safe_redirect( add_query_arg( 'theme-updater', 'updated', remove_query_arg('theme-updater') ) );

		} else {
			wp_safe_redirect( remove_query_arg('theme-updater') );

		}

	// regenrate stylesheets after succesful update
	} else if ( isset($_GET['theme-updater']) && 'updated' == $_GET['theme-updater'] && get_transient( 'presscore_update_result' ) ) {
		add_settings_error( 'options-framework', 'theme_updated', _x( 'Stylesheets regenerated.', 'backend', LANGUAGE_ZONE ), 'updated fade' );

	}

}
add_action( 'admin_init', 'presscore_theme_update' );

/**
 * Backup files from language dir to temporary folder in uploads.
 *
 */
function presscore_before_theme_update( $res = true, $hook_extra = array() ) {
	global $wp_filesystem, $dt_lang_backup_dir_timestamp;

	if ( !is_wp_error($res) && !empty($dt_lang_backup_dir_timestamp) ) {

		$upload_dir = wp_upload_dir();
		$copy_folder = PRESSCORE_THEME_DIR . '/languages/';
		$dest_folder = $upload_dir['basedir'] . '/dt-language-cache/t' . str_replace( array('\\', '/'), '', $dt_lang_backup_dir_timestamp ) . '/';

		// create dest dir if it's not exist
		if ( wp_mkdir_p( $dest_folder ) ) {

			$files = array_keys( $wp_filesystem->dirlist( $copy_folder ) );
			$files = array_diff( $files, array( 'en_US.po' ) );

			// backup files
			foreach ( $files as $file_name ) {
				$wp_filesystem->copy( $copy_folder . $file_name, $dest_folder . $file_name, true, FS_CHMOD_FILE );
			}

		}

	}

	return $res;
}

/**
 * Restore stored language files.
 *
 */
function presscore_after_theme_update( $res = true, $hook_extra = array(), $result = array() ) {
	global $wp_filesystem, $dt_lang_backup_dir_timestamp;

	if ( !is_wp_error($res) && !empty($dt_lang_backup_dir_timestamp) ) {

		$upload_dir = wp_upload_dir();
		$dest_folder = PRESSCORE_THEME_DIR . '/languages/';
		$copy_base = $upload_dir['basedir'] . '/dt-language-cache/';
		$copy_folder = $copy_base . 't' . str_replace( array('\\', '/'), '', $dt_lang_backup_dir_timestamp ) . '/';

		// proceed only if both copy and destination folders exists
		if ( $wp_filesystem->exists( $copy_folder ) && $wp_filesystem->exists( $dest_folder ) ) {

			$files = array_keys( $wp_filesystem->dirlist( $copy_folder ) );

			// restore files
			foreach ( $files as $file_name ) {
				$wp_filesystem->copy( $copy_folder . $file_name, $dest_folder . $file_name, false, FS_CHMOD_FILE );
			}

			// remove backup folder
			if ( !is_wp_error($result) ) {
				$wp_filesystem->delete( $copy_base, true );
			}

		}

	}

	return $res;
}
