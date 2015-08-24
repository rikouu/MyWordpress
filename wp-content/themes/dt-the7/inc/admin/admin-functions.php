<?php
/**
 * Admin functions.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Admin notice.
 *
 */
function presscore_admin_notice() {

	// if less css file is writable - return
	$less_is_writable = get_option( 'presscore_less_css_is_writable' );
	if ( $less_is_writable || false === $less_is_writable ) {
		return;
	}

	$current_screen = get_current_screen();

	if ( 'options-framework' != $current_screen->parent_base ) {
		return;
	}

	?>
	<div class="updated">
		<p><strong><?php echo _x( 'Failed to create customization .CSS file. To improve your site performance, please check whether ".../wp-content/uploads/" folder is created, and its CHMOD is set to 777.', 'backend css file creation error', LANGUAGE_ZONE ); ?></strong></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'presscore_admin_notice', 15 );

/**
 * Remove save notice if update credentials saved.
 *
 */
function presscore_remove_optionsframework_save_options_notice( $clean, $input = array() ) {

	if ( isset( $input['theme_update-user_name'], $input['theme_update-api_key'] ) ) {

		remove_action( 'optionsframework_after_validate', 'optionsframework_save_options_notice' );

	}
}
add_action( 'optionsframework_after_validate', 'presscore_remove_optionsframework_save_options_notice', 9, 2 );

/**
 * Add video url field for attachments.
 *
 */
function presscore_attachment_fields_to_edit( $fields, $post ) {

	// hopefuly add new field only for images
	if ( strpos( get_post_mime_type( $post->ID ), 'image' ) !== false ) {
		$video_url = get_post_meta( $post->ID, 'dt-video-url', true );
		$img_link = get_post_meta( $post->ID, 'dt-img-link', true );
		$hide_title = get_post_meta( $post->ID, 'dt-img-hide-title', true );
		if ( '' === $hide_title ) {
			// $hide_title = 1;
		}

		$fields['dt-video-url'] = array(
				'label' 		=> _x('Video url', 'attachment field', LANGUAGE_ZONE),
				'input' 		=> 'text',
				'value'			=> $video_url ? $video_url : '',
				'show_in_edit' 	=> true
		);

		$fields['dt-img-link'] = array(
				'label' 		=> _x('Image link', 'attachment field', LANGUAGE_ZONE),
				'input' 		=> 'text',
	//			'html'       	=> "<input type='text' class='text widefat' name='attachments[$post->ID][dt-video-url]' value='" . esc_attr($img_link) . "' /><br />",
				'value'			=> $img_link ? $img_link : '',
				'show_in_edit' 	=> true
		);

		$fields['dt-img-hide-title'] = array(
				'label' 		=> _x('Hide title', 'attachment field', LANGUAGE_ZONE),
				'input' 		=> 'html',
				'html'       	=> "<input id='attachments-{$post->ID}-dt-img-hide-title' type='checkbox' name='attachments[{$post->ID}][dt-img-hide-title]' value='1' " . checked($hide_title, true, false) . "/>",
				'show_in_edit' 	=> true
		);
	}

	return $fields;
}
add_filter( 'attachment_fields_to_edit', 'presscore_attachment_fields_to_edit', 10, 2 );

/**
 * Save vide url attachment field.
 *
 */
function presscore_save_attachment_fields( $attachment_id ) {

	// video url
	if ( isset( $_REQUEST['attachments'][$attachment_id]['dt-video-url'] ) ) {

		$location = esc_url($_REQUEST['attachments'][$attachment_id]['dt-video-url']);
		update_post_meta( $attachment_id, 'dt-video-url', $location );
	}

	// image link
	if ( isset( $_REQUEST['attachments'][$attachment_id]['dt-img-link'] ) ) {

		$location = esc_url($_REQUEST['attachments'][$attachment_id]['dt-img-link']);
		update_post_meta( $attachment_id, 'dt-img-link', $location );
	}

	// hide title
	$hide_title = (int) isset( $_REQUEST['attachments'][$attachment_id]['dt-img-hide-title'] );
	update_post_meta( $attachment_id, 'dt-img-hide-title', $hide_title );
}
add_action( 'edit_attachment', 'presscore_save_attachment_fields' );

/**	
 * This function return array with thumbnail image meta for items list in admin are.
 * If fitured image not set it gets last image by menu order.
 * If there are no images and $noimage not empty it returns $noimage in other way it returns false
 *
 * @param integer $post_id
 * @param integer $max_w
 * @param integer $max_h
 * @param string $noimage
 */ 

function dt_get_admin_thumbnail ( $post_id, $max_w = 100, $max_h = 100, $noimage = '' ) {
	$post_type=  get_post_type( $post_id );
	$thumb = array();

	if ( has_post_thumbnail( $post_id ) ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
	} elseif ( 'dt_gallery' == $post_type ) {
		$media_gallery = get_post_meta( $post_id, '_dt_album_media_items', true );

		if ( $media_gallery && is_array( $media_gallery ) ) {
			$thumb = wp_get_attachment_image_src( current( $media_gallery ), 'thumbnail' );
		} else {
			$thumb = array();
		}

	} elseif ( 'dt_slideshow' == $post_type ) {
		$media_gallery = get_post_meta( $post_id, '_dt_slider_media_items', true );

		if ( $media_gallery && is_array( $media_gallery ) ) {
			$thumb = wp_get_attachment_image_src( current( $media_gallery ), 'thumbnail' );
		} else {
			$thumb = array();
		}

	}

	if ( empty( $thumb ) ) {

		if ( ! $noimage ) {
			return false;
		}

		$thumb = $noimage;
		$w = $max_w;
		$h = $max_h;
	} else {

		$sizes = wp_constrain_dimensions( $thumb[1], $thumb[2], $max_w, $max_h );
		$w = $sizes[0];
		$h = $sizes[1];
		$thumb = $thumb[0];
	}

	return array( esc_url( $thumb ), $w, $h );
}

/**
 * Description here.
 *
 * @param integer $post_id
 */
function dt_admin_thumbnail ( $post_id ) {
	$default_image = PRESSCORE_THEME_URI . '/images/noimage-thumbnail.jpg';
	$thumbnail = dt_get_admin_thumbnail( $post_id, 100, 100, $default_image );

	if ( $thumbnail ) {

		echo '<a style="width: 100%; text-align: center; display: block;" href="post.php?post=' . absint($post_id) . '&action=edit" title="">
					<img src="' . esc_url($thumbnail[0]) . '" width="' . esc_attr($thumbnail[1]) . '" height="' . esc_attr($thumbnail[2]) . '" alt="" />
				</a>';
	}
}

/**
 * Add styles to admin.
 *
 */
function presscore_admin_print_scripts() {
?>
<style type="text/css">
#presscore-thumbs {
	width: 110px;
}
#presscore-sidebar,
#presscore-footer {
	width: 120px;
}
#wpbody-content .bulk-edit-row-page .inline-edit-col-right,
#wpbody-content .bulk-edit-row-post .inline-edit-col-right {
	width: 30%;
}
</style>
<?php
}
add_action( 'admin_print_scripts-edit.php', 'presscore_admin_print_scripts', 99 );

/**
 * Add styles to media.
 *
 */
function presscore_admin_print_scripts_for_media() {
?>
<style type="text/css">
.fixed .column-presscore-media-title {
	width: 10%;
}
.fixed .column-presscore-media-title span {
	padding: 2px 5px;
}
.fixed .column-presscore-media-title .dt-media-hidden-title {
	background-color: red;
	color: white;
}
.fixed .column-presscore-media-title .dt-media-visible-title {
	background-color: green;
	color: white;
}
</style>
<?php
}
add_action( 'admin_print_scripts-upload.php', 'presscore_admin_print_scripts_for_media', 99 );

/**
 * Add thumbnails column in posts list.
 *
 */
function presscore_add_thumbnails_column_in_admin( $defaults ){
	$head = array_slice( $defaults, 0, 1 );
	$tail = array_slice( $defaults, 1 );

	$head['presscore-thumbs'] = _x( 'Thumbnail', 'backend', LANGUAGE_ZONE );

	$defaults = array_merge( $head, $tail );

	return $defaults;
}
add_filter('manage_edit-dt_portfolio_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_gallery_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_team_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_testimonials_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_logos_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_slideshow_columns', 'presscore_add_thumbnails_column_in_admin');
add_filter('manage_edit-dt_benefits_columns', 'presscore_add_thumbnails_column_in_admin');

/**
 * Add sidebar and footer columns in posts list.
 *
 */
function presscore_add_sidebar_and_footer_columns_in_admin( $defaults ){
	$defaults['presscore-sidebar'] = _x( 'Sidebar', 'backend', LANGUAGE_ZONE );
	$defaults['presscore-footer'] = _x( 'Footer', 'backend', LANGUAGE_ZONE );
	return $defaults;
}
add_filter('manage_edit-page_columns', 'presscore_add_sidebar_and_footer_columns_in_admin');
add_filter('manage_edit-post_columns', 'presscore_add_sidebar_and_footer_columns_in_admin');
add_filter('manage_edit-dt_portfolio_columns', 'presscore_add_sidebar_and_footer_columns_in_admin');

/**
 * Add slug column for slideshow posts list.
 *
 */
function presscore_add_slug_column_for_slideshow( $defaults ){
	$defaults['presscore-slideshow-slug'] = _x( 'Slug', 'backend', LANGUAGE_ZONE );
	return $defaults;
}
add_filter('manage_edit-dt_slideshow_columns', 'presscore_add_slug_column_for_slideshow');

/**
 * Add title column for media.
 *
 * @since 3.1
 */
function presscore_add_title_column_for_media( $columns ) {
	$columns['presscore-media-title'] = _x( 'Image title', 'backend', LANGUAGE_ZONE );
	return $columns;
}
add_filter('manage_media_columns', 'presscore_add_title_column_for_media');

/**
 * Show thumbnail in column.
 *
 */
function presscore_display_thumbnails_in_admin( $column_name, $id ){
	static $wa_list = -1;

	if ( -1 === $wa_list ) {
		$wa_list = presscore_get_widgetareas_options();
	}

	switch ( $column_name ) {
		case 'presscore-thumbs': dt_admin_thumbnail( $id ); break;
		case 'presscore-sidebar':
			$wa = get_post_meta( $id, '_dt_sidebar_widgetarea_id', true );
			$wa_title = isset( $wa_list[ $wa ] ) ? $wa_list[ $wa ] : $wa_list['sidebar_1'];
			echo esc_html( $wa_title );
			break;

		case 'presscore-footer':
			$wa = get_post_meta( $id, '_dt_footer_widgetarea_id', true );
			$wa_title = isset( $wa_list[ $wa ] ) ? $wa_list[ $wa ] : $wa_list['sidebar_2'];
			echo esc_html( $wa_title );
			break;

		case 'presscore-slideshow-slug':
			if ( $dt_post = get_post( $id ) ) {
				echo $dt_post->post_name;
			} else {
				echo '&mdash;';
			}
			break;
	}
}
add_action( 'manage_posts_custom_column', 'presscore_display_thumbnails_in_admin', 10, 2 );
add_action( 'manage_pages_custom_column', 'presscore_display_thumbnails_in_admin', 10, 2 );

/**
 * Show title status in media list.
 *
 * @since 3.1
 */
function presscore_display_title_status_for_media( $column_name, $id ) {
	if ( 'presscore-media-title' == $column_name ) {
		$hide_title = get_post_meta( $id, 'dt-img-hide-title', true );
		if ( '' === $hide_title ) {
			// $hide_title = 1;
		}

		if ( $hide_title ) {
			echo '<span class="dt-media-hidden-title">' . _x('Hidden', 'media title hidden', LANGUAGE_ZONE) . '</span>';
		} else {
			echo '<span class="dt-media-visible-title">' . _x('Visible', 'media title visible', LANGUAGE_ZONE) . '</span>';
		}
	}
}
add_action( 'manage_media_custom_column', 'presscore_display_title_status_for_media', 10, 2 );

/**
 * Add Bulk edit fields.
 *
 */
function presscore_add_bulk_edit_fields( $col, $type ) {

	// display for one column
	if ( !in_array( $col, array( 'presscore-sidebar' ) ) ) return;

	if ( !in_array( $type, array( 'page', 'post', 'dt_portfolio' ) ) ) return; ?>
	<div class="inline-edit-col-right" style="display: inline-block; float: left;">
		<fieldset>
			<div class="inline-edit-col">

				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Sidebar option', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
						<?php
						$sidebar_options = array(
							'left' 		=> _x('Left', 'backend bulk edit', LANGUAGE_ZONE),
							'right' 	=> _x('Right', 'backend bulk edit', LANGUAGE_ZONE),
							'disabled'	=> _x('Disabled', 'backend bulk edit', LANGUAGE_ZONE),
						);
						?>
						<select name="_dt_bulk_edit_sidebar_options">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
							<?php foreach ( $sidebar_options as $value=>$title ): ?>
								<option value="<?php echo $value; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</label>

					<label class="alignright">
						<span class="title"><?php _ex( 'Widgetized footer', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
						<?php
						$show_wf = array(
							0	=> _x('Hide', 'backend bulk edit footer', LANGUAGE_ZONE),
							1	=> _x('Show', 'backend bulk edit footer', LANGUAGE_ZONE),
						);
						?>
						<select name="_dt_bulk_edit_show_footer">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
							<?php foreach ( $show_wf as $value=>$title ): ?>
								<option value="<?php echo $value; ?>"><?php echo $title; ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				</div>

			<?php if ( function_exists('presscore_get_widgetareas_options') && $wa_list = presscore_get_widgetareas_options() ): ?>

				<div class="inline-edit-group">
					<label class="alignleft">
						<span class="title"><?php _ex( 'Sidebar', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
						<select name="_dt_bulk_edit_sidebar">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
							<?php foreach ( $wa_list as $value=>$title ): ?>
								<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html( $title ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>

					<label class="alignright">
						<span class="title"><?php _ex( 'Footer', 'backend bulk edit', LANGUAGE_ZONE ); ?></span>
						<select name="_dt_bulk_edit_footer">
							<option value="-1"><?php _ex( '&mdash; No Change &mdash;', 'backend bulk edit', LANGUAGE_ZONE ); ?></option>
							<?php foreach ( $wa_list as $value=>$title ): ?>
								<option value="<?php echo esc_attr($value); ?>"><?php echo esc_html( $title ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
				</div>

			<?php endif; ?>

			</div>
		</fieldset>
	</div>
<?php
}
add_action( 'bulk_edit_custom_box', 'presscore_add_bulk_edit_fields', 10, 2 );

/**
 * Save changes made by bulk edit.
 *
 */
function presscore_bulk_edit_save_changes( $post_ID, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( !isset($_REQUEST['_ajax_nonce']) && !isset($_REQUEST['_wpnonce']) ) {
		return;
	}

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	// Check permissions
	if ( !current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	if ( !check_ajax_referer( 'bulk-posts', false, false ) ) {
		return;
	}

	if ( isset($_REQUEST['bulk_edit']) ) {

		// sidebar options
		if ( isset( $_REQUEST['_dt_bulk_edit_sidebar_options'] ) && in_array( $_REQUEST['_dt_bulk_edit_sidebar_options'], array( 'left', 'right', 'disabled' ) ) ) {
			update_post_meta( $post_ID, '_dt_sidebar_position', esc_attr( $_REQUEST['_dt_bulk_edit_sidebar_options'] ) );
		}

		// update sidebar
		if ( isset( $_REQUEST['_dt_bulk_edit_sidebar'] ) && '-1' != $_REQUEST['_dt_bulk_edit_sidebar'] ) {
			update_post_meta( $post_ID, '_dt_sidebar_widgetarea_id', esc_attr( $_REQUEST['_dt_bulk_edit_sidebar'] ) );
		}

		// update footer
		if ( isset( $_REQUEST['_dt_bulk_edit_footer'] ) && '-1' != $_REQUEST['_dt_bulk_edit_footer'] ) {
			update_post_meta( $post_ID, '_dt_footer_widgetarea_id', esc_attr( $_REQUEST['_dt_bulk_edit_footer'] ) );
		}

		// show footer
		if ( isset( $_REQUEST['_dt_bulk_edit_show_footer'] ) && '-1' != $_REQUEST['_dt_bulk_edit_show_footer'] ) {
			update_post_meta( $post_ID, '_dt_footer_show', absint( $_REQUEST['_dt_bulk_edit_show_footer'] ) );
		}
	}
}
add_action( 'save_post', 'presscore_bulk_edit_save_changes', 10, 2 );

/**
 * Add hide and show title bulk actions to list.
 */
function presscore_add_media_bulk_actions() {
	global $post_type;
	if ( $post_type == 'attachment' ) {
		$show_title_text = _x('Show titles', 'media bulk action', LANGUAGE_ZONE);
		$hide_title_text = _x('Hide titles', 'media bulk action', LANGUAGE_ZONE);
	?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			var $wpAction = jQuery("select[name='action']"),
				$wpAction2 = jQuery("select[name='action2']");

			jQuery('<option>').val('dt_hide_title').text('<?php echo $hide_title_text; ?>').appendTo($wpAction);
			jQuery('<option>').val('dt_hide_title').text('<?php echo $hide_title_text; ?>').appendTo($wpAction2);

			jQuery('<option>').val('dt_show_title').text('<?php echo $show_title_text; ?>').appendTo($wpAction);
			jQuery('<option>').val('dt_show_title').text('<?php echo $show_title_text; ?>').appendTo($wpAction2);
		});
		</script>
	<?php
	}
}
add_action('admin_footer-upload.php', 'presscore_add_media_bulk_actions');

/**
 * Add handler to close and resolve bulk actions.
 *
 * see http://www.foxrunsoftware.net/articles/wordpress/add-custom-bulk-action/
 */
function presscore_media_bulk_actions_handler() {
	global $typenow;
	$post_type = $typenow;

	if ( $post_type == '') {

		// get the action
		$wp_list_table = _get_list_table('WP_Media_List_Table');  // depending on your resource type this could be WP_Users_List_Table, WP_Comments_List_Table, etc
		$action = $wp_list_table->current_action();

		$allowed_actions = array("dt_hide_title", "dt_show_title");
		if ( !in_array($action, $allowed_actions) ) {
			return;
		}

		// security check
		check_admin_referer('bulk-media');

		// make sure ids are submitted.  depending on the resource type, this may be 'media' or 'ids'
		if ( isset($_REQUEST['media']) ) {
			$post_ids = array_map('intval', $_REQUEST['media']);
		}

		if ( empty($post_ids) ) {
			return;
		}

		// this is based on wp-admin/edit.php
		$sendback = remove_query_arg( array('titles_hidden', 'titles_shown', 'untrashed', 'deleted', 'ids'), wp_get_referer() );
		if ( ! $sendback ) {
			$sendback = admin_url( "edit.php?post_type=$post_type" );
		}

		$pagenum = $wp_list_table->get_pagenum();
		$sendback = add_query_arg( 'paged', $pagenum, $sendback );
		$error_msg = _x('You are not allowed to perform this action.', 'backend media error', LANGUAGE_ZONE);

		switch ( $action ) {
			case 'dt_hide_title':

				foreach( $post_ids as $post_id ) {

					update_post_meta( $post_id, 'dt-img-hide-title', 1 );
				}

				$sendback = add_query_arg( array('titles_hidden' => count($post_ids), 'ids' => join(',', $post_ids) ), $sendback );
			break;

			case 'dt_show_title':

				foreach( $post_ids as $post_id ) {

					update_post_meta( $post_id, 'dt-img-hide-title', 0 );
				}

				$sendback = add_query_arg( array('titles_shown' => count($post_ids), 'ids' => join(',', $post_ids) ), $sendback );
			break;

			default: return;
		}

		$sendback = remove_query_arg( array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view'), $sendback );

		wp_redirect($sendback);
		exit();
	}
}
add_action('load-upload.php', 'presscore_media_bulk_actions_handler');

/**
 * Admin scripts.
 *
 */
function presscore_new_admin_scripts() {
	wp_add_inline_style( 'optionsframework',
'
/* header layouts info */
#optionsframework .section-info.header-layout-info {
	background-color: inherit;
}
#optionsframework .section-info .info-image-holder {
	text-align: center;
}

/* header layout sortable */
#optionsframework .section-sortable .field-red {
	background-color: #f75c63;
}
#optionsframework .section-sortable .field-green {
	background-color: #6ddb61;
}
#optionsframework .section-sortable .field-blue {
	background-color: #5ea1ed;
}
#optionsframework .section-sortable .field-purple {
	background-color: #b475e5;
}

/* images */
#optionsframework .controls .of-radio-img-selected {
	border:3px solid #5ea1ed;
}

/* text element */
#optionsframework #section-header-text .controls {
	width: 100%;
}
' );
}
add_action('admin_print_styles-theme-options_page_of-header-menu', 'presscore_new_admin_scripts', 20);
add_action('admin_print_styles-theme-options_page_of-page-titles-menu', 'presscore_new_admin_scripts', 20);

if ( ! function_exists( 'presscore_admin_scripts' ) ) :

	/**
	 * Add metaboxes scripts and styles.
	 */
	function presscore_admin_scripts() {
		wp_enqueue_style( 'dt-admin-style', PRESSCORE_ADMIN_URI . '/assets/admin-style.css' );
	}

	add_action( 'admin_enqueue_scripts', 'presscore_admin_scripts' );

endif;

if ( ! function_exists( 'presscore_admin_post_scripts' ) ) :

	/**
	 * Add metaboxes scripts and styles.
	 */
	function presscore_admin_post_scripts( $hook ) {
		if ( !in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) {
			return;
		}

		wp_enqueue_style( 'dt-mb-magick', PRESSCORE_ADMIN_URI . '/assets/admin_mbox_magick.css' );

		wp_enqueue_script( 'dt-metaboxses-scripts', PRESSCORE_ADMIN_URI . '/assets/custom-metaboxes.js', array('jquery'), false, true );
		wp_enqueue_script( 'dt-mb-magick', PRESSCORE_ADMIN_URI . '/assets/admin_mbox_magick.js', array('jquery'), false, true );
		wp_enqueue_script( 'dt-mb-switcher', PRESSCORE_ADMIN_URI . '/assets/admin_mbox_switcher.js', array('jquery'), false, true );

		// for proportion ratio metabox field
		$proportions = presscore_meta_boxes_get_images_proportions();
		$proportions['length'] = count( $proportions );
		wp_localize_script( 'dt-metaboxses-scripts', 'rwmbImageRatios', $proportions );
	}

	add_action( 'admin_enqueue_scripts', 'presscore_admin_post_scripts', 11 );

endif;

if ( ! function_exists( 'presscore_admin_widgets_scripts' ) ) :

	/**
	 * Add widgets scripts. Enqueued only for widgets.php.
	 */
	function presscore_admin_widgets_scripts( $hook ) {

		if ( 'widgets.php' != $hook ) {
			return;
		}

		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		// enqueue wp colorpicker
		wp_enqueue_style( 'wp-color-picker' );

		// presscore stuff
		wp_enqueue_style( 'dt-admin-widgets', PRESSCORE_ADMIN_URI . '/assets/admin-widgets.css' );
		wp_enqueue_script( 'dt-admin-widgets', PRESSCORE_ADMIN_URI . '/assets/admin_widgets_page.js', array('jquery', 'wp-color-picker'), false, true );

		wp_localize_script( 'dt-admin-widgets', 'dtWidgtes', array(
			'title'			=> _x( 'Title', 'widget', LANGUAGE_ZONE ),
			'content'		=> _x( 'Content', 'widget', LANGUAGE_ZONE ),
			'percent'		=> _x( 'Percent', 'widget', LANGUAGE_ZONE ),
			'showPercent'	=> _x( 'Show', 'widget', LANGUAGE_ZONE ),
		) );

	}

	add_action( 'admin_enqueue_scripts', 'presscore_admin_widgets_scripts', 15 );

endif;

if ( ! function_exists( 'presscore_editor_open_images_in_lightbox' ) ) :

	function presscore_editor_open_images_in_lightbox( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
		$url_extension = pathinfo( $url, PATHINFO_EXTENSION );
		if ( in_array( $url_extension, array( 'jpg', 'jpeg', 'png', 'gif' ) ) ) {
			$count = 0;
			$anchor_classes = 'dt-single-image'; // dt-mfp-item
			$atts = ' data-dt-img-description="' . esc_attr( $caption ) . '"';
			$html = preg_replace( '/^(<a .*?)class="(\w*?)"(.*?>)(.*?<img.*?\/>.*?)(<\/a>)/', '${1}class="${2} ' . $anchor_classes . '"' . $atts . '${3}${4}${5}', $html, 1, $count );

			if ( ! $count ) {
				$html = preg_replace( '/^(<a .*?)(.*?>)(.*?<img.*?\/>.*?)(<\/a>)/', '${1}class="' . $anchor_classes . '"' . $atts . ' ${2}${3}${4}', $html );
			}
		}

		return $html;
	}

	add_filter( 'image_send_to_editor', 'presscore_editor_open_images_in_lightbox', 10, 8 );

endif;
