<?php 

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


// ! Removing unwanted shortcodes
/* vc_remove_element("vc_widget_sidebar"); */
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_gallery");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_separator");
// vc_remove_element("vc_text_separator");

// ! Changing rows and columns classes
function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
	if ($tag=='vc_row' || $tag=='vc_row_inner') {
		$class_string = str_replace('vc_row-fluid', 'wf-container', $class_string);
	}

	if ($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_span(\d{1,2})/', 'wf-cell wf-span-$1', $class_string);
	}

	return $class_string;
}
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);


// ! Adding our classes to paint standard VC shortcodes
function custom_css_accordion( $class_string, $tag, $atts = array() ) {
	if ( in_array( $tag, array('vc_accordion', 'vc_toggle', 'vc_progress_bar', 'vc_posts_slider') ) ) {
		$class_string .= ' dt-style';
	}

	if ( 'vc_accordion' == $tag && array_key_exists( 'style' , $atts ) ) {

		switch ( $atts['style'] ) {
			case '2':
				$class_string .= ' dt-accordion-bg-on';
				break;

			case '3':
				$class_string .= ' dt-accordion-line-on';
				break;
		}
	}

	return $class_string;
}
add_filter( 'vc_shortcodes_css_class', 'custom_css_accordion', 10, 3 );

// ! Background for widgetized area
vc_add_param("vc_widget_sidebar", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Show background", LANGUAGE_ZONE),
	"admin_label" => true,
	"param_name" => "show_bg",
	"value" => array(
		"Yes" => "true",
		"No" => "false"
	),
	"description" => ""
));

//********************************************************************************************
// ROW START
//********************************************************************************************

// remove font color
vc_remove_param('vc_row', 'font_color');

// remove margin bottom
vc_remove_param('vc_row', 'margin_bottom');

// remove bg color
vc_remove_param('vc_row', 'bg_color');

// remove bg image
vc_remove_param('vc_row', 'bg_image');

// remove css editor
vc_remove_param('vc_row', 'css');
vc_remove_param('vc_row_inner', 'css');

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Anchor", LANGUAGE_ZONE),
	"param_name" => "anchor"
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Minimum height", LANGUAGE_ZONE),
	"param_name" => "min_height",
	"description" => __("You can use pixels (px) or percents (%).", LANGUAGE_ZONE)
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Top margin", LANGUAGE_ZONE),
	"param_name" => "margin_top",
	"value" => "0",
	"description" => __("In pixels; negative values are allowed.", LANGUAGE_ZONE),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Bottom margin", LANGUAGE_ZONE),
	"param_name" => "margin_bottom",
	"value" => "0",
	"description" => __("In pixels; negative values are allowed.", LANGUAGE_ZONE),
));

// fullwidth
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Full-width content", LANGUAGE_ZONE),
	"param_name" => "full_width",
	"value" => array(
		"" => "true"
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield", //attach_images
	//"holder" => "img",
	"class" => "",
	"heading" => __("Left padding", LANGUAGE_ZONE),
	"description" => __("This setting works only for a row inside of a row.", LANGUAGE_ZONE),
	"param_name" => "padding_left",
	"value" => "0",
	"dependency" => array(
		"element" => "full_width",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield", //attach_images
	//"holder" => "img",
	"class" => "",
	"heading" => __("Right padding", LANGUAGE_ZONE),
	"description" => __("This setting works only for a row inside of a row.", LANGUAGE_ZONE),
	"param_name" => "padding_right",
	"value" => "0",
	"dependency" => array(
		"element" => "full_width",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Animation", LANGUAGE_ZONE),
	"admin_label" => true,
	"param_name" => "animation",
	"value" => presscore_get_vc_animation_options(),
	"description" => ""
));

// ! Adding stripes to rows
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Row style", LANGUAGE_ZONE),
	"admin_label" => true,
	"param_name" => "type",
	"value" => array(
		"Default" => "",
		"Stripe 1" => "1",
		"Stripe 2" => "2",
		"Stripe 3" => "3",
		"Stripe 4" => "4",
		"Stripe 5" => "5"
	),
	"description" => ""
));

vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Background color", LANGUAGE_ZONE),
	"param_name" => "bg_color",
	"value" => "",
	"description" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield", //attach_images
	//"holder" => "img",
	"class" => "dt_image",
	"heading" => __("Background image", LANGUAGE_ZONE),
	"param_name" => "bg_image",
	"description" => __("Image URL.", LANGUAGE_ZONE),
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Background position", LANGUAGE_ZONE),
	"param_name" => "bg_position",
	"value" => array(
		"Top" => "top",
		"Middle" => "center",
		"Bottom" => "bottom"
	),
	"description" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Background repeat", LANGUAGE_ZONE),
	"param_name" => "bg_repeat",
	"value" => array(
		"No repeat" => "no-repeat",
		"Repeat (horizontally & vertically)" => "repeat",
		"Repeat horizontally" => "repeat-x",
		"Repeat vertically" => "repeat-y"
	),
	"description" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Full-width background", LANGUAGE_ZONE),
	"param_name" => "bg_cover",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	),
	"description" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Fixed background", LANGUAGE_ZONE),
	"param_name" => "bg_attachment",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	),
	"description" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Top padding", LANGUAGE_ZONE),
	"param_name" => "padding_top",
	"value" => "0",
	"description" => __("In pixels.", LANGUAGE_ZONE),
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Bottom padding", LANGUAGE_ZONE),
	"param_name" => "padding_bottom",
	"value" => "0",
	"description" => __("In pixels.", LANGUAGE_ZONE),
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

// parallax
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Enable parallax", LANGUAGE_ZONE),
	"param_name" => "enable_parallax",
	"value" => array(
		"" => "false"
	),
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Parallax speed", LANGUAGE_ZONE),
	"param_name" => "parallax_speed",
	"value" => "0.1",
	"dependency" => array(
		"element" => "enable_parallax",
		"not_empty" => true
	)
));

// video background
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background (mp4)", LANGUAGE_ZONE),
	"param_name" => "bg_video_src_mp4",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background (ogv)", LANGUAGE_ZONE),
	"param_name" => "bg_video_src_ogv",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background (webm)", LANGUAGE_ZONE),
	"param_name" => "bg_video_src_webm",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true
	)
));

//********************************************************************************************
// ROW END
//********************************************************************************************

///////////////
// VC Column //
///////////////

// remove css editor
vc_remove_param('vc_column', 'css');

vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Animation", LANGUAGE_ZONE),
	"admin_label" => true,
	"param_name" => "animation",
	"value" => presscore_get_vc_animation_options(),
	"description" => ""
));

/////////////
// VC Tabs //
/////////////

vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Style", LANGUAGE_ZONE),
	"param_name" => "style",
	"value" => array(
		"Style 1" => "tab-style-one",
		"Style 2" => "tab-style-two",
		"Style 3" => "tab-style-three"
	),
	"description" => ""
));

/////////////
// VC Tour //
/////////////

vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Style", LANGUAGE_ZONE),
	"param_name" => "style",
	"value" => array(
		"Style 1" => "tab-style-one",
		"Style 2" => "tab-style-two",
		"Style 3" => "tab-style-three"
	),
	"description" => ""
));

/////////////////
// Fancy Titles //
/////////////////

vc_map( array(
	"name" => "Fancy Titles",
	"base" => "dt_fancy_title",
	"icon" => "dt_vc_ico_fancy_titles",
	"class" => "dt_vc_sc_fancy_titles",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"description" => '',
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => "Title",
			"param_name" => "title",
			"holder" => "div",
			"value" => "Title",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title position",
			"param_name" => "title_align",
			"value" => array(
				'centre' => "center",
				'left' => "left",
				'right' => "right"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title size",
			"param_name" => "title_size",
			"value" => array(
				'small' => "small",
				'medium' => "normal",
				'large' => "big",
				'h1' => "h1",
				'h2' => "h2",
				'h3' => "h3",
				'h4' => "h4",
				'h5' => "h5",
				'h6' => "h6",
			),
			"std" => "normal",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title color",
			"param_name" => "title_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"title" => "title",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom title color",
			"param_name" => "custom_title_color",
			"dependency" => array(
				"element" => "title_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator style",
			"param_name" => "separator_style",
			"value" => array(
				"line" => "",
				"dashed" => "dashed",
				"dotted" => "dotted",
				"double" => "double",
				"thick" => "thick",
				"disabled" => "disabled"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Element width (in %)",
			"param_name" => "el_width",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Background under title",
			"param_name" => "title_bg",
			"value" => array(
				"enabled" => "enabled",
				"disabled" => "disabled"
			),
			"std" => "disabled",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator & background color",
			"param_name" => "separator_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom separator color",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
	)
) );

/////////////////////
// Fancy Separators //
/////////////////////

vc_map( array(
	"name" => "Fancy Separators",
	"base" => "dt_fancy_separator",
	"icon" => "dt_vc_ico_separators",
	"class" => "dt_vc_sc_separators",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"description" => '',
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => "Separator style",
			"param_name" => "separator_style",
			"value" => array(
				"line" => "line",
				"dashed" => "dashed",
				"dotted" => "dotted",
				"double" => "double",
				"thick" => "thick"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator color",
			"param_name" => "separator_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom separator color",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Element width (in %)",
			"param_name" => "el_width",
			"value" => "",
			"description" => ""
		),
	)
) );

// ! Fancy Quote
vc_map( array(
	"name" => __("Fancy Quote", LANGUAGE_ZONE),
	"base" => "dt_quote",
	"icon" => "dt_vc_ico_quote",
	"class" => "dt_vc_sc_quote",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "content",
			"value" => __("<p>I am test text for QUOTE. Click edit button to change this text.</p>", LANGUAGE_ZONE),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Quote type", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Blockquote" => "blockquote",
				"Pullquote" => "pullquote"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", LANGUAGE_ZONE),
			"param_name" => "font_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big",
				"h1" => "h1",
				"h2" => "h2",
				"h3" => "h3",
				"h4" => "h4",
				"h5" => "h5",
				"h6" => "h6",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Blockquote style", LANGUAGE_ZONE),
			"param_name" => "background",
			"value" => array(
				"Border" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

// ! Call to Action
vc_map( array(
	"name" => __("Call to Action", LANGUAGE_ZONE),
	"base" => "dt_call_to_action",
	"icon" => "dt_vc_ico_call_to_action",
	"class" => "dt_vc_sc_call_to_action",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "content",
			"value" => __("<p>I am test text for CALL TO ACTION. Click edit button to change this text.</p>", LANGUAGE_ZONE),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", LANGUAGE_ZONE),
			"param_name" => "content_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", LANGUAGE_ZONE),
			"param_name" => "background",
			"value" => array(
				"None" => "no",
				"Border" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Colored line", LANGUAGE_ZONE),
			"param_name" => "line",
			"value" => array(
				"Disable" => "false",
				"Enable" => "true"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", LANGUAGE_ZONE),
			"param_name" => "style",
			"value" => array(
				"Default" => "0",
				"On the right" => "1"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

// ! Teaser
vc_map( array(
	"name" => __("Teaser", LANGUAGE_ZONE),
	"base" => "dt_teaser",
	"icon" => "dt_vc_ico_teaser",
	"class" => "dt_vc_sc_teaser",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Uploaded image" => "uploaded_image",
				"Image from url" => "image",
				"Video from url" => "video"
			),
			"description" => ""
		),

		//////////////////////
		// uploaded image //
		//////////////////////

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", LANGUAGE_ZONE),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// image from url //
		//////////////////////

		// image url
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", LANGUAGE_ZONE),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image width
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image WIDTH", LANGUAGE_ZONE),
			"param_name" => "image_width",
			"value" => "",
			"description" => __("image width in px", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image height
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image HEIGHT", LANGUAGE_ZONE),
			"param_name" => "image_height",
			"value" => "",
			"description" => __("image height in px", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image alt
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", LANGUAGE_ZONE),
			"param_name" => "image_alt",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// misc link
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Misc link", LANGUAGE_ZONE),
			"param_name" => "misc_link",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// target
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Target link", LANGUAGE_ZONE),
			"param_name" => "target",
			"value" => array(
				"Blank" => "blank",
				"Self" => "self"
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// open in lightbox
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", LANGUAGE_ZONE),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// video from url //
		//////////////////////

		// video url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"video"
				)
			)
		),

		// content
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "content",
			"value" => __("I am test text for TEASER. Click edit button to change this text.", LANGUAGE_ZONE),
			"description" => ""
		),

		// media style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Media style", LANGUAGE_ZONE),
			"param_name" => "style",
			"value" => array(
				"Full-width" => "1",
				"With paddings" => "2"
			),
			"description" => ""
		),

		// font size
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", LANGUAGE_ZONE),
			"param_name" => "content_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big"
			),
			"std" => "big",
			"description" => ""
		),

		// background
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", LANGUAGE_ZONE),
			"param_name" => "background",
			"value" => array(
				"None" => "no",
				"Border" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),

		// animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

// ! Banner
vc_map( array(
	"name" => __("Banner", LANGUAGE_ZONE),
	"base" => "dt_banner",
	"icon" => "dt_vc_ico_banner",
	"class" => "dt_vc_sc_banner",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Uploaded image" => "uploaded_image",
				"Image from url" => "image"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Background image", LANGUAGE_ZONE),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Background image", LANGUAGE_ZONE),
			"param_name" => "bg_image",
			"description" => __("Image URL.", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "content",
			"value" => __("<p>I am test text for BANNER. Click edit button to change this text.</p>", LANGUAGE_ZONE),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Banner link", LANGUAGE_ZONE),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", LANGUAGE_ZONE),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			),
			"description" => "",
			"dependency" => array(
				"element" => "link",
				"not_empty" => true
			)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", LANGUAGE_ZONE),
			"param_name" => "bg_color",
			"value" => "rgba(0,0,0,0.4)",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Border color", LANGUAGE_ZONE),
			"param_name" => "text_color",
			"value" => "#ffffff",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", LANGUAGE_ZONE),
			"param_name" => "text_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big"
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Border width", LANGUAGE_ZONE),
			"param_name" => "border_width",
			"value" => "3",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Outer padding", LANGUAGE_ZONE),
			"param_name" => "outer_padding",
			"value" => "10",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Inner padding", LANGUAGE_ZONE),
			"param_name" => "inner_padding",
			"value" => "10",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Banner minimal height", LANGUAGE_ZONE),
			"param_name" => "min_height",
			"value" => "150",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

// ! Contact form
vc_map( array(
	"name" => __("Contact Form", LANGUAGE_ZONE),
	"base" => "dt_contact_form",
	"icon" => "dt_vc_ico_contact_form",
	"class" => "dt_vc_sc_contact_form",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Form fields", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "fields",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"website" => "website",
				"message" => "message"
			),
			"description" => __("Attention! At least one must be selected.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Message textarea height", LANGUAGE_ZONE),
			"param_name" => "message_height",
			"value" => "6",
			"description" => __("Number of lines.", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "fields",
				"value" => array(
					"message"
				)
			)
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Required fields", LANGUAGE_ZONE),
			//"admin_label" => true,
			"param_name" => "required",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"website" => "website",
				"message" => "message"
			),
			"description" => __("Attention! At least one must be selected.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __('Submit button caption', LANGUAGE_ZONE),
			"param_name" => "button_title",
			"value" => "Send message",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Submit button size", LANGUAGE_ZONE),
			"param_name" => "button_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Big" => "big"
			),
			"description" => ""
		)
	)
) );

/*
// ! Map
vc_map( array(
	"name" => __("Map", LANGUAGE_ZONE),
	"base" => "dt_map",
	"icon" => "dt_vc_ico_map",
	"class" => "dt_vc_sc_map",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Map URL", LANGUAGE_ZONE),
			"param_name" => "content",
			"value" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Map height", LANGUAGE_ZONE),
			"param_name" => "height",
			"value" => "300",
			"description" => __("In pixels (min. 200)", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Top margin", LANGUAGE_ZONE),
			"param_name" => "margin_top",
			"value" => "40",
			"description" => __("In pixels; negative values are allowed.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Bottom margin", LANGUAGE_ZONE),
			"param_name" => "margin_bottom",
			"value" => "40",
			"description" => __("In pixels; negative values are allowed.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Map width", LANGUAGE_ZONE),
			"param_name" => "fullwidth",
			"value" => array(
				"Normal" => "false",
				"Window-width" => "true",
			),
			"description" => ""
		)
	)
) );
*/

// ! Mini Blog
vc_map( array(
	"name" => __("Blog Mini", LANGUAGE_ZONE),
	"base" => "dt_blog_posts_small",
	"icon" => "dt_vc_ico_blog_posts_small",
	"class" => "dt_vc_sc_blog_posts_small",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", LANGUAGE_ZONE),
			"param_name" => "columns",
			"value" => array(
				"List" => "1",
				"2 columns" => "2",
				"3 columns" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Featured images", LANGUAGE_ZONE),
			"param_name" => "featured_images",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"description" => "",
			"group" => __("Featured images", LANGUAGE_ZONE),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Enable rounded corners", LANGUAGE_ZONE),
			"param_name" => "round_images",
			"value" => array(
				"" => "true",
			),
			"group" => __("Featured images", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Images width (in px)", LANGUAGE_ZONE),
			"param_name" => "images_width",
			"value" => "60",
			"description" => "",
			"group" => __("Featured images", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Images height (in px)", LANGUAGE_ZONE),
			"param_name" => "images_height",
			"value" => "60",
			"description" => "",
			"group" => __("Featured images", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "6",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Blog
vc_map( array(
	"name" => __("Blog Masonry & Grid", LANGUAGE_ZONE),
	"base" => "dt_blog_posts",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Taxonomy
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", LANGUAGE_ZONE),
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between posts (px)", LANGUAGE_ZONE),
			"description" => __("Post paddings (e.g. 5 pixel padding will give you 10 pixel gaps between posts)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column min width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Column max width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns_number",
			"value" => "3"
		),

		// Fancy date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Fancy date", LANGUAGE_ZONE),
			"param_name" => "fancy_date",
			"value" => array(
				"" => "true",
			)
		),

		// Image & background style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image & background style", LANGUAGE_ZONE),
			"param_name" => "background",
			"value" => array(
				"No background" => "disabled",
				"Fullwidth image" => "fullwidth",
				"Image with paddings" => "with_paddings"
			),
			"description" => ""
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Post proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE)
		),

		// Post width
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Posts width", LANGUAGE_ZONE),
			"param_name" => "same_width",
			"value" => array(
				"Preserve original width" => "false",
				"Make posts same width" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		),

		// Show excerpts
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpts", LANGUAGE_ZONE),
			"param_name" => "show_excerpts",
			"value" => array(
				"" => "true"
			)
		),

		// Show "Read more" buttons
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __('Show "Read more" buttons', LANGUAGE_ZONE),
			"param_name" => "show_read_more_button",
			"value" => array(
				"" => "true"
			)
		),

		//////////////////////////////////
		// blog post meta information //
		//////////////////////////////////

		// Categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post categories", LANGUAGE_ZONE),
			"param_name" => "show_post_categories",
			"value" => array(
				"" => "true"
			)
		),

		// Date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post date", LANGUAGE_ZONE),
			"param_name" => "show_post_date",
			"value" => array(
				"" => "true"
			)
		),

		// Author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post author", LANGUAGE_ZONE),
			"param_name" => "show_post_author",
			"value" => array(
				"" => "true"
			)
		),

		// Comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post comments", LANGUAGE_ZONE),
			"param_name" => "show_post_comments",
			"value" => array(
				"" => "true"
			)
		)
	)
) );

// ! Blog Scroller
vc_map( array(
	"name" => __("Blog Scroller", LANGUAGE_ZONE),
	"base" => "dt_blog_scroller",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", LANGUAGE_ZONE),
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
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

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => '',
			"param_name" => "padding",
			"value" => "20"
		),

		// Arrows
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Arrows", LANGUAGE_ZONE),
			"param_name" => "arrows",
			"value" => array(
				'light' => 'light',
				'dark' => 'dark',
				'rectangular accent' => 'rectangular_accent',
				'disabled' => 'disabled'
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", LANGUAGE_ZONE),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			)
		),

		// Background under projects
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under projects", LANGUAGE_ZONE),
			"param_name" => "bg_under_posts",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			)
		),

		// Content alignment
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content alignment", LANGUAGE_ZONE),
			"param_name" => "content_aligment",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			)
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpt", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post categories", LANGUAGE_ZONE),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post date", LANGUAGE_ZONE),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post author", LANGUAGE_ZONE),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post comments", LANGUAGE_ZONE),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Autoslide interval
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide interval (in milliseconds)", LANGUAGE_ZONE),
			"description" => "",
			"param_name" => "autoslide",
			"value" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Loop", LANGUAGE_ZONE),
			"param_name" => "loop",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)

	)
) );

// ! Portfolio Scroller
vc_map( array(
	"name" => __("Portfolio Scroller", LANGUAGE_ZONE),
	"base" => "dt_portfolio_slider",
	"icon" => "dt_vc_ico_portfolio_slider",
	"class" => "dt_vc_sc_portfolio_slider",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_portfolio_category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", LANGUAGE_ZONE),
			"param_name" => "category",
			"description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
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

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => '',
			"param_name" => "padding",
			"value" => "20"
		),

		// Arrows
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Arrows", LANGUAGE_ZONE),
			"param_name" => "arrows",
			"value" => array(
				'light' => 'light',
				'dark' => 'dark',
				'rectangular accent' => 'rectangular_accent',
				'disabled' => 'disabled'
			)
		),

		// Show projects descriptions
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show projects descriptions", LANGUAGE_ZONE),
			"param_name" => "appearance",
			"value" => array(
				'Under images'=> 'under_image',
				'On colored background' => 'on_hover_centered',
				'On dark gradient' => 'on_dark_gradient',
				'In the bottom' => 'from_bottom',
			),
			"description" => ""
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "hover_animation",
			"value" => array(
				'Fade' => 'fade',
				'Direction aware' => 'direction_aware',
				'Move from bottom' => 'move_from_bottom'
			),
			"dependency" => array(
				"element" => "appearance",
				"value" => array(
					'on_hover_centered'
				)
			)
		),
		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", LANGUAGE_ZONE),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"dependency" => array(
				"element" => "appearance",
				"value" => array(
					'on_hover_centered',
					'under_image'
				)
			)
		),

		// Background under projects
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under projects", LANGUAGE_ZONE),
			"param_name" => "bg_under_projects",
			"std" => "disabled",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			),
			"dependency" => array(
				"element" => "appearance",
				"value" => array(
					'under_image'
				)
			)
		),

		// Content alignment
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content alignment", LANGUAGE_ZONE),
			"param_name" => "content_aligment",
			"std" => "center",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			),
			"dependency" => array(
				"element" => "appearance",
				"value" => array(
					'under_image'
				)
			)
		),

		// Content
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "hover_content_visibility",
			"value" => array(
				'On hover' => 'on_hover',
				'Always visible' => 'always'
			),
			"dependency" => array(
				"element" => "appearance",
				"value" => array(
					'on_dark_gradient',
					'from_bottom'
				)
			)
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show title", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpt", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project categories", LANGUAGE_ZONE),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project date", LANGUAGE_ZONE),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project author", LANGUAGE_ZONE),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project comments", LANGUAGE_ZONE),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show details icon", LANGUAGE_ZONE),
			"param_name" => "show_details",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show link icon", LANGUAGE_ZONE),
			"param_name" => "show_link",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show zoom icon", LANGUAGE_ZONE),
			"param_name" => "show_zoom",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Autoslide interval
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide interval (in milliseconds)", LANGUAGE_ZONE),
			"description" => "",
			"param_name" => "autoslide",
			"value" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Loop", LANGUAGE_ZONE),
			"param_name" => "loop",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)

	)
) );

// ! Portfolio
vc_map( array(
	"name" => __("Portfolio Masonry & Grid", LANGUAGE_ZONE),
	"base" => "dt_portfolio",
	"icon" => "dt_vc_ico_portfolio",
	"class" => "dt_vc_sc_portfolio",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_portfolio_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => __("Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns",
			"value" => "2"
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE)
		),

		// Post width
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Projects width", LANGUAGE_ZONE),
			"param_name" => "same_width",
			"value" => array(
				"Preserve original width" => "false",
				"Make projects same width" => "true",
			),
			"description" => ""
		),

		// Description
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show projects descriptions", LANGUAGE_ZONE),
			"param_name" => "descriptions",
			"value" => array(
				'Under images'=> 'under_image',
				'On colored background' => 'on_hover_centered',
				'On dark gradient' => 'on_dark_gradient',
				'In the bottom' => 'from_bottom',
			),
			"description" => ""
		),

		// Background under projects
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under projects", LANGUAGE_ZONE),
			"param_name" => "bg_under_projects",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'under_image'
				)
			)
		),

		// Content alignment
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content alignment", LANGUAGE_ZONE),
			"param_name" => "content_aligment",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'under_image'
				)
			)
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "hover_animation",
			"value" => array(
				'Fade' => 'fade',
				'Side move' => 'move_to',
				'Direction aware' => 'direction_aware',
				'Move from bottom' => 'move_from_bottom',
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", LANGUAGE_ZONE),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered',
					'under_image'
				)
			)
		),

		// Content
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "hover_content_visibility",
			"value" => array(
				'On hover' => 'on_hover',
				'Always visible' => 'always'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_dark_gradient',
					'from_bottom'
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show projects titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show projects excerpts", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project categories", LANGUAGE_ZONE),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project date", LANGUAGE_ZONE),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project author", LANGUAGE_ZONE),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project comments", LANGUAGE_ZONE),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show details icon
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show details icon", LANGUAGE_ZONE),
			"param_name" => "show_details",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show link
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show link icon", LANGUAGE_ZONE),
			"param_name" => "show_link",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show zoom
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show zoom icon", LANGUAGE_ZONE),
			"param_name" => "show_zoom",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of projects to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Portfolio justified grid
vc_map( array(
	"name" => __( "Portfolio Justified Grid", LANGUAGE_ZONE ),
	"base" => 'dt_portfolio_jgrid',
	"icon" => "dt_vc_ico_portfolio",
	"class" => "dt_vc_sc_portfolio",
	"category" => __( 'by Dream-Theme', LANGUAGE_ZONE ),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_portfolio_category",
			"class" => "",
			"heading" => __( "Categories", LANGUAGE_ZONE ),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE )
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Gap between images (px)", LANGUAGE_ZONE ),
			"description" => __( "Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", LANGUAGE_ZONE ),
			"param_name" => "padding",
			"value" => "20"
		),

		// Row height
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Row target height (px)", LANGUAGE_ZONE ),
			"param_name" => "target_height",
			"value" => "240"
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE)
		),

		// Description
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show projects descriptions", LANGUAGE_ZONE),
			"param_name" => "descriptions",
			"value" => array(
				'On colored background' => 'on_hover_centered',
				'On dark gradient' => 'on_dark_gradient',
				'In the bottom' => 'from_bottom',
			),
			"description" => ""
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "hover_animation",
			"value" => array(
				'Fade' => 'fade',
				'Side move' => 'move_to',
				'Direction aware' => 'direction_aware',
				'Move from bottom' => 'move_from_bottom',
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", LANGUAGE_ZONE),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Content
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "hover_content_visibility",
			"value" => array(
				'On hover' => 'on_hover',
				'Always visible' => 'always'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_dark_gradient',
					'from_bottom'
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Hide last row
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Hide last row if there's not enough images to fill it", LANGUAGE_ZONE ),
			"param_name" => "hide_last_row",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show projects titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show projects excerpts", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project categories", LANGUAGE_ZONE),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project date", LANGUAGE_ZONE),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project author", LANGUAGE_ZONE),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show project comments", LANGUAGE_ZONE),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show details icon
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show details icon", LANGUAGE_ZONE),
			"param_name" => "show_details",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show link
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show link icon", LANGUAGE_ZONE),
			"param_name" => "show_link",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show zoom
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show zoom icon", LANGUAGE_ZONE),
			"param_name" => "show_zoom",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of projects to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Albums masonry
vc_map( array(
	"name" => __("Albums Masonry & Grid", LANGUAGE_ZONE),
	"base" => 'dt_albums',
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_gallery_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => __("Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns",
			"value" => "2"
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE)
		),

		// Post width
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Albums width", LANGUAGE_ZONE),
			"param_name" => "same_width",
			"value" => array(
				"Preserve original width" => "false",
				"Make albums same width" => "true",
			),
			"description" => ""
		),

		// Description
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show albums descriptions", LANGUAGE_ZONE),
			"param_name" => "descriptions",
			"value" => array(
				'Under images'=> 'under_image',
				'On colored background' => 'on_hover_centered',
				'On dark gradient' => 'on_dark_gradient',
				'In the bottom' => 'from_bottom',
			),
			"description" => ""
		),

		// Background under albums
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under albums", LANGUAGE_ZONE),
			"param_name" => "bg_under_albums",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'under_image'
				)
			)
		),

		// Content alignment
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content alignment", LANGUAGE_ZONE),
			"param_name" => "content_aligment",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'under_image'
				)
			)
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "hover_animation",
			"value" => array(
				'Fade' => 'fade',
				'Side move' => 'move_to',
				'Direction aware' => 'direction_aware',
				'Move from bottom' => 'move_from_bottom',
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", LANGUAGE_ZONE),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered',
					'under_image'
				)
			)
		),

		// Content
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "hover_content_visibility",
			"value" => array(
				'On hover' => 'on_hover',
				'Always visible' => 'always'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_dark_gradient',
					'from_bottom'
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show albums titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show albums excerpts", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show miniatures
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show image miniatures", LANGUAGE_ZONE),
			"param_name" => "show_miniatures",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album categories", LANGUAGE_ZONE),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album date", LANGUAGE_ZONE),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album author", LANGUAGE_ZONE),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album comments", LANGUAGE_ZONE),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show media count
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show number of images & videos", LANGUAGE_ZONE),
			"param_name" => "show_media_count",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of albums to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Albums justified grid
vc_map( array(
	"name" => __( "Albums Justified Grid", LANGUAGE_ZONE ),
	"base" => "dt_albums_jgrid",
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"category" => __( 'by Dream-Theme', LANGUAGE_ZONE ),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_gallery_category",
			"class" => "",
			"heading" => __( "Categories", LANGUAGE_ZONE ),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __( "Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE )
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Gap between images (px)", LANGUAGE_ZONE ),
			"description" => __( "Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", LANGUAGE_ZONE ),
			"param_name" => "padding",
			"value" => "20"
		),

		// Row height
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Row target height (px)", LANGUAGE_ZONE ),
			"param_name" => "target_height",
			"value" => "240"
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Thumbnails proportions", LANGUAGE_ZONE ),
			"param_name" => "proportion",
			"value" => "",
			"description" => __( "Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE )
		),

		// Description
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Show albums descriptions", LANGUAGE_ZONE ),
			"param_name" => "descriptions",
			"value" => array(
				'On colored background' => 'on_hover_centered',
				'On dark gradient' => 'on_dark_gradient',
				'In the bottom' => 'from_bottom',
			),
			"description" => ""
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Animation", LANGUAGE_ZONE ),
			"param_name" => "hover_animation",
			"value" => array(
				'Fade' => 'fade',
				'Side move' => 'move_to',
				'Direction aware' => 'direction_aware',
				'Move from bottom' => 'move_from_bottom',
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Image hover background color", LANGUAGE_ZONE ),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Content
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Content", LANGUAGE_ZONE ),
			"param_name" => "hover_content_visibility",
			"value" => array(
				'On hover' => 'on_hover',
				'Always visible' => 'always'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_dark_gradient',
					'from_bottom'
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Loading effect", LANGUAGE_ZONE ),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Hide last row
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Hide last row if there's not enough images to fill it", LANGUAGE_ZONE ),
			"param_name" => "hide_last_row",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show albums titles", LANGUAGE_ZONE ),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show albums excerpts", LANGUAGE_ZONE ),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show miniatures
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show image miniatures", LANGUAGE_ZONE ),
			"param_name" => "show_miniatures",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show album categories", LANGUAGE_ZONE ),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show album date", LANGUAGE_ZONE ),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show album author", LANGUAGE_ZONE ),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show album comments", LANGUAGE_ZONE ),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show media count
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Show number of images & videos", LANGUAGE_ZONE ),
			"param_name" => "show_media_count",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Number of albums to show", LANGUAGE_ZONE ),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Order by", LANGUAGE_ZONE ),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __( "Select how to sort retrieved posts.", LANGUAGE_ZONE )
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __( "Order way", LANGUAGE_ZONE ),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __( "Designates the ascending or descending order.", LANGUAGE_ZONE )
		)
	)
) );

// ! Albums scroller
vc_map( array(
	"name" => __("Albums Scroller", LANGUAGE_ZONE),
	"base" => 'dt_albums_scroller',
	"icon" => "dt_vc_ico_albums",
	"class" => "dt_vc_sc_albums",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_gallery_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
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

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => '',
			"param_name" => "padding",
			"value" => "20"
		),

		// Arrows
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Arrows", LANGUAGE_ZONE),
			"param_name" => "arrows",
			"value" => array(
				'light' => 'light',
				'dark' => 'dark',
				'rectangular accent' => 'rectangular_accent',
				'disabled' => 'disabled'
			)
		),

		// Description
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show albums descriptions", LANGUAGE_ZONE),
			"param_name" => "descriptions",
			"value" => array(
				'Under images'=> 'under_image',
				'On colored background' => 'on_hover_centered',
				'On dark gradient' => 'on_dark_gradient',
				'In the bottom' => 'from_bottom',
			),
			"description" => ""
		),

		// Background under albums
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under albums", LANGUAGE_ZONE),
			"param_name" => "bg_under_albums",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'under_image'
				)
			)
		),

		// Content alignment
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content alignment", LANGUAGE_ZONE),
			"param_name" => "content_aligment",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'under_image'
				)
			)
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "hover_animation",
			"value" => array(
				'Fade' => 'fade',
				'Direction aware' => 'direction_aware',
				'Move from bottom' => 'move_from_bottom',
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered'
				)
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", LANGUAGE_ZONE),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_hover_centered',
					'under_image'
				)
			)
		),

		// Content
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content", LANGUAGE_ZONE),
			"param_name" => "hover_content_visibility",
			"value" => array(
				'On hover' => 'on_hover',
				'Always visible' => 'always'
			),
			"dependency" => array(
				"element" => "descriptions",
				"value" => array(
					'on_dark_gradient',
					'from_bottom'
				)
			)
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show albums titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show albums excerpts", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show miniatures
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show image miniatures", LANGUAGE_ZONE),
			"param_name" => "show_miniatures",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album categories", LANGUAGE_ZONE),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album date", LANGUAGE_ZONE),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album author", LANGUAGE_ZONE),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show album comments", LANGUAGE_ZONE),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show media count
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show number of images & videos", LANGUAGE_ZONE),
			"param_name" => "show_media_count",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of albums to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Autoslide interval
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide interval (in milliseconds)", LANGUAGE_ZONE),
			"description" => "",
			"param_name" => "autoslide",
			"value" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Loop", LANGUAGE_ZONE),
			"param_name" => "loop",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Photos scroller
vc_map( array(
	"name" => __("Photos Scroller", LANGUAGE_ZONE),
	"base" => 'dt_small_photos',
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_gallery_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
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

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => '',
			"param_name" => "padding",
			"value" => "20"
		),

		// Arrows
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Arrows", LANGUAGE_ZONE),
			"param_name" => "arrows",
			"value" => array(
				'light' => 'light',
				'dark' => 'dark',
				'rectangular accent' => 'rectangular_accent',
				'disabled' => 'disabled'
			)
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show items captions", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of items to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Autoslide interval
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide interval (in milliseconds)", LANGUAGE_ZONE),
			"description" => "",
			"param_name" => "autoslide",
			"value" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Loop", LANGUAGE_ZONE),
			"param_name" => "loop",
			"value" => array(
				"" => "true",
			),
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

// ! Photos jgrid
vc_map( array(
	"name" => __("Photos Justified Grid", LANGUAGE_ZONE),
	"base" => 'dt_photos_jgrid',
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_gallery_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => __("Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20"
		),

		// Row height
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __( "Row target height (px)", LANGUAGE_ZONE ),
			"param_name" => "target_height",
			"value" => "240"
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Hide last row
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __( "Hide last row if there's not enough images to fill it", LANGUAGE_ZONE ),
			"param_name" => "hide_last_row",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show items captions", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of items to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Photos masonry
vc_map( array(
	"name" => __("Photos Masonry & Grid", LANGUAGE_ZONE),
	"base" => 'dt_photos_masonry',
	"icon" => "dt_vc_ico_photos",
	"class" => "dt_vc_sc_photos",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_gallery_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your albums will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", LANGUAGE_ZONE),
			"description" => __("Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns",
			"value" => "2"
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => ""
		),

		// Show title
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show titles", LANGUAGE_ZONE),
			"param_name" => "show_title",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show excerpt
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show items captions", LANGUAGE_ZONE),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of items to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Team
vc_map( array(
	"name" => __("Team", LANGUAGE_ZONE),
	"base" => 'dt_team',
	"icon" => "dt_vc_ico_team",
	"class" => "dt_vc_sc_team",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_team_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your team will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between team members (px)", LANGUAGE_ZONE),
			"description" => __("Team member paddings (e.g. 5 pixel padding will give you 10 pixel gaps between team members)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column target width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns",
			"value" => "2"
		),

		// Background under team members
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under team members", LANGUAGE_ZONE),
			"param_name" => "members_bg",
			"value" => array(
				"Enabled" => "true",
				"disabled" => "false"
			),
			"description" => ""
		),

		// Images sizing
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Images sizing", LANGUAGE_ZONE),
			"param_name" => "images_sizing",
			"value" => array(
				"preserve images proportions" => "original",
				"resize images" => "resize",
				"make images round" => "round"
			),
			"description" => ""
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Images proportions", LANGUAGE_ZONE),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "images_sizing",
				"value" => array(
					'resize'
				)
			)
		),

		// Show excerpts
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpts", LANGUAGE_ZONE),
			"param_name" => "show_excerpts",
			"value" => array(
				"" => "true",
			)
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of team members to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => __("(Integer)", LANGUAGE_ZONE)
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Testimonials
vc_map( array(
	"name" => __("Testimonials", LANGUAGE_ZONE),
	"base" => 'dt_testimonials',
	"icon" => "dt_vc_ico_testimonials",
	"class" => "dt_vc_sc_testimonials",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_testimonials_category",
			"class" => "",
			"heading" => __("Categories", LANGUAGE_ZONE),
			"param_name" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your testimonials will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Slider" => "slider"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between testimonials (px)", LANGUAGE_ZONE),
			"description" => __("Testimonial paddings (e.g. 5 pixel padding will give you 10 pixel gaps between testimonials)", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "20",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "370",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns",
			"value" => "2",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", LANGUAGE_ZONE),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Autoslide
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide", LANGUAGE_ZONE),
			"param_name" => "autoslide",
			"value" => "",
			"description" => __('In milliseconds (e.g. 3 secund = 3000 miliseconds). Leave this field empty to disable autoslide. This field works only when "Appearance: Slider" selected.', LANGUAGE_ZONE),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"slider"
				)
			)
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of testimonials to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		)
	)
) );

// ! Royal Slider
vc_map( array(
	"name" => __("Royal Slider", LANGUAGE_ZONE),
	"base" => "dt_slideshow",
	"icon" => "dt_vc_ico_slideshow",
	"class" => "dt_vc_sc_slideshow",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "dt_posttype",
			"posttype" => "dt_slideshow",
			"class" => "",
			"heading" => __("Display slideshow(s)", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "posts",
			"description" => __("Attention: Do not ignore this setting! Otherwise only one (newest) slideshow will be displayed.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Proportions: width", LANGUAGE_ZONE),
			"param_name" => "width",
			"value" => "800",
			// "description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Proportions: height", LANGUAGE_ZONE),
			"param_name" => "height",
			"value" => "450",
			// "description" => __("In pixels.", LANGUAGE_ZONE)
		)
	)
) );

// ! Logos
vc_map( array(
	"name" => __("Logos", LANGUAGE_ZONE),
	"base" => "dt_logos",
	"icon" => "dt_vc_ico_logos",
	"class" => "dt_vc_sc_logos",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_logos_category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", LANGUAGE_ZONE),
			"param_name" => "category",
			"description" => __("Note: By default, all your logotypes will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),
		// Column min width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "180"
		),

		// Column max width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns_number",
			"value" => "3"
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of logotypes to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animate", LANGUAGE_ZONE),
			"param_name" => "animate",
			"value" => array(
				"One-by-one" => 'one_by_one',
				"At the same time" => 'at_the_same_time'
			),
			"description" => ""
		),
	)
) );

// ! Gap
vc_map( array(
	"name" => __("Gap (Deprecated)", LANGUAGE_ZONE),
	"base" => "dt_gap",
	"icon" => "dt_vc_ico_gap",
	"class" => "dt_vc_sc_gap",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap height", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "10",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		)
	)
) );

// ! Fancy Media
vc_map( array(
	"name" => __("Fancy Media", LANGUAGE_ZONE),
	"base" => "dt_fancy_image",
	"icon" => "dt_vc_ico_fancy_image",
	"class" => "dt_vc_sc_fancy_image",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", LANGUAGE_ZONE),
			"param_name" => "type",
			"value" => array(
				"Uploaded media" => "uploaded_image",
				"Media from url" => "from_url"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", LANGUAGE_ZONE),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		//Only for "image" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", LANGUAGE_ZONE),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "image" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", LANGUAGE_ZONE),
			"param_name" => "image_alt",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "video" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "image"
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", LANGUAGE_ZONE),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", LANGUAGE_ZONE)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", LANGUAGE_ZONE),
			"param_name" => "style",
			"value" => array(
				"Full-width media" => "1",
				"Media with padding" => "2",
				"Media with padding & background fill" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Width", LANGUAGE_ZONE),
			"param_name" => "width",
			"value" => "270",
			"description" => __("In pixels. Proportional height will be calculated automatically.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Padding", LANGUAGE_ZONE),
			"param_name" => "padding",
			"value" => "10",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Margin-top", LANGUAGE_ZONE),
			"param_name" => "margin_top",
			"value" => "0",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Margin-bottom", LANGUAGE_ZONE),
			"param_name" => "margin_bottom",
			"value" => "0",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Margin-left", LANGUAGE_ZONE),
			"param_name" => "margin_left",
			"value" => "0",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Margin-right", LANGUAGE_ZONE),
			"param_name" => "margin_right",
			"value" => "0",
			"description" => __("In pixels.", LANGUAGE_ZONE)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Align", LANGUAGE_ZONE),
			"param_name" => "align",
			"value" => array(
				"Left" => "left",
				"Center" => "center",
				"Right" => "right"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

// ! Button
vc_map( array(
	"name" => __("Button", LANGUAGE_ZONE),
	"base" => "dt_button",
	"icon" => "dt_vc_ico_button",
	"class" => "dt_vc_sc_button",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		// Extra class name
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", LANGUAGE_ZONE),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", LANGUAGE_ZONE)
		),

		// Caption
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Caption", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
			"description" => ""
		),

		// Link Url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link URL", LANGUAGE_ZONE),
			"param_name" => "link",
			"value" => "",
			"description" => ""
		),

		// Open link in
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", LANGUAGE_ZONE),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			),
			"description" => ""
		),

		// Size
		array(
			"group" => __("Style", LANGUAGE_ZONE),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", LANGUAGE_ZONE),
			"param_name" => "size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Large" => "big"
			),
			"description" => "",
		),

		// Style
		array(
			"group" => __("Style", LANGUAGE_ZONE),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", LANGUAGE_ZONE),
			"param_name" => "style",
			"value" => array(
				"Default" => "default",
				"Light" => "light",
				"Link" => "link"
			),
			"description" => "",
		),

		// Align
		array(
			"group" => __("Style", LANGUAGE_ZONE),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", LANGUAGE_ZONE),
			"param_name" => "button_alignment",
			"value" => array(
				"Default" => "default",
				"Centre" => "center",
			),
			"description" => "",
		),

		// Button color mode
		array(
			"group" => __("Style", LANGUAGE_ZONE),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button color", LANGUAGE_ZONE),
			"param_name" => "color_mode",
			"value" => array(
				"Default" => "default",
				"Custom" => "custom"
			),
			"description" => "",
		),

		// Button color
		array(
			"group" => __("Style", LANGUAGE_ZONE),
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Custom color", LANGUAGE_ZONE),
			"param_name" => "color",
			"value" => '#888888',
			"description" => "",
			"dependency" => array(
				"element" => "color_mode",
				"value" => array( "custom" )
			),
		),

		// Icon
		array(
			"group" => __("Icon", LANGUAGE_ZONE),
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => __("Icon", LANGUAGE_ZONE),
			"param_name" => "icon",
			"value" => '',
			"description" => __('f.e. <code>&lt;i class="fa fa-coffee"&gt;&lt;/i&gt;</code>', LANGUAGE_ZONE),
		),

		// Icon align
		array(
			"group" => __("Icon", LANGUAGE_ZONE),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon align", LANGUAGE_ZONE),
			"param_name" => "icon_align",
			"value" => array(
				"Left" => "left",
				"Right" => "right"
			),
			"description" => ""
		),

		// Animation
		array(
			"group" => __("Style", LANGUAGE_ZONE),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		),

	)
) );

// ! Fancy List
vc_map( array(
	"name" => __("Fancy List", LANGUAGE_ZONE),
	"base" => "dt_vc_list",
	"icon" => "dt_vc_ico_list",
	"class" => "dt_vc_sc_list",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Caption", LANGUAGE_ZONE),
			"param_name" => "content",
			"value" => __("<ul><li>Your list</li><li>goes</li><li>here!</li></ul>", LANGUAGE_ZONE),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("List style", LANGUAGE_ZONE),
			"param_name" => "style",
			"value" => array(
				"Unordered" => "1",
				"Ordered (numbers)" => "2",
				"No bullets" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bullet position", LANGUAGE_ZONE),
			"param_name" => "bullet_position",
			"value" => array(
				"Top" => "top",
				"Middle" => "middle"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Dividers", LANGUAGE_ZONE),
			"param_name" => "dividers",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"description" => ""
		)
	)
) );


// ! Benefits
vc_map( array(
	"name" => __("Benefits", LANGUAGE_ZONE),
	"base" => "dt_benefits_vc",
	"icon" => "dt_vc_ico_benefits",
	"class" => "dt_vc_sc_benefits",
	"category" => __('by Dream-Theme', LANGUAGE_ZONE),
	"params" => array(

		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_benefits_category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", LANGUAGE_ZONE),
			"param_name" => "category",
			"description" => __("Note: By default, all your benefits will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", LANGUAGE_ZONE)
		),

		// Column min width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", LANGUAGE_ZONE),
			"param_name" => "column_width",
			"value" => "180"
		),

		// Column max width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", LANGUAGE_ZONE),
			"param_name" => "columns_number",
			"value" => "3"
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Benefits layout", LANGUAGE_ZONE),
			"param_name" => "style",
			"value" => array(
				"Image, title & content centered" => "1",
				"Image & title inline" => "2",
				"Image on the left" => "3"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icons backgrounds", LANGUAGE_ZONE),
			"param_name" => "image_background",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Border radius for image backgrounds", LANGUAGE_ZONE),
			"param_name" => "image_background_border",
			"value" => array(
				"Default" => "",
				"Custom" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Border radius (in px)", LANGUAGE_ZONE),
			"param_name" => "image_background_border_radius",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "image_background_border",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Background size (in px)", LANGUAGE_ZONE),
			"param_name" => "image_background_size",
			"value" => "70",
			"description" => "",
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Backgrounds color", LANGUAGE_ZONE),
			"param_name" => "image_background_paint",
			"value" => array(
				"Light" => "light",
				"Accent" => "accent",
				"Custom color" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "image_background_color",
			"value" => "#222222",
			"description" => "",
			"dependency" => array(
				"element" => "image_background_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Backgrounds hover color", LANGUAGE_ZONE),
			"param_name" => "image_hover_background_paint",
			"value" => array(
				"Light" => "light",
				"Accent" => "accent",
				"Custom color" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "image_hover_background_color",
			"value" => "#444444",
			"description" => "",
			"dependency" => array(
				"element" => "image_hover_background_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon size (in px)", LANGUAGE_ZONE),
			"param_name" => "icons_size",
			"value" => "38",
			"description" => "",
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icons color", LANGUAGE_ZONE),
			"param_name" => "icons_paint",
			"value" => array(
				"Light" => "light",
				"Accent" => "accent",
				"Custom color" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "icons_color",
			"value" => "#ffffff",
			"description" => "",
			"dependency" => array(
				"element" => "icons_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icons hover color", LANGUAGE_ZONE),
			"param_name" => "icons_hover_paint",
			"value" => array(
				"Light" => "light",
				"Accent" => "accent",
				"Custom color" => "custom"
			),
			"description" => ""
		),

		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "",
			"param_name" => "icons_hover_color",
			"value" => "#dddddd",
			"description" => "",
			"dependency" => array(
				"element" => "icons_hover_paint",
				"value" => array(
					"custom"
				)
			)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Decorative lines", LANGUAGE_ZONE),
			"param_name" => "decorative_lines",
			"value" => array(
				"Accent" => "hover",
				"Light" => "static",
				"Disabled" => "disabled"
			),
			'std' => 'disabled',
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Title font size", LANGUAGE_ZONE),
			"param_name" => "header_size",
			"value" => array(
				"H1" => "h1",
				"H2" => "h2",
				"H3" => "h3",
				"H4" => "h4",
				"H5" => "h5",
				"H6" => "h6"
			),
			'std' => 'h5',
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content font size", LANGUAGE_ZONE),
			"param_name" => "content_size",
			"value" => array(
				"Large" => "big",
				"Medium" => "normal",
				"Small" => "small"
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of benefits to show", LANGUAGE_ZONE),
			"param_name" => "number",
			"value" => "8",
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", LANGUAGE_ZONE),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", LANGUAGE_ZONE),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", LANGUAGE_ZONE)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", LANGUAGE_ZONE),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", LANGUAGE_ZONE)
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animate", LANGUAGE_ZONE),
			"param_name" => "animate",
			"value" => array(
				"One-by-one" => 'one_by_one',
				"At the same time" => 'at_the_same_time'
			),
			"description" => ""
		),
	)
) );

//***********************************************************************
// Before / After
//***********************************************************************

vc_map( array(
	'name' => __( 'Before / After', LANGUAGE_ZONE ),
	'base' => 'dt_before_after',
	'class' => 'dt_vc_sc_before_after',
	'icon' => 'dt_vc_ico_before_after',
	'category' => __( 'by Dream-Theme', LANGUAGE_ZONE ),
	'description' => "",
	'params' => array(

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose first image", LANGUAGE_ZONE),
			"param_name" => "image_1",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose second image", LANGUAGE_ZONE),
			"param_name" => "image_2",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Orientation", LANGUAGE_ZONE),
			"param_name" => "orientation",
			"value" => array(
				"Vertical" => "horizontal",
				"Horizontal" => "vertical"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Navigation", LANGUAGE_ZONE),
			"param_name" => "navigation",
			"value" => array(
				"Click and drag" => "drag",
				"Follow" => "move"
			),
			"description" => ""
		),

		array(
			'type' => 'textfield',
			"holder" => "div",
			'heading' => __( 'Visible part of the "Before" image (in %)', LANGUAGE_ZONE ),
			'param_name' => 'offset',
			'std' => '50',
			'description' => "",
		),

	)
) );

//***********************************************************************
// Pie
//***********************************************************************

vc_remove_element( "vc_pie" );

vc_map( array(
	'name' => __( 'Pie chart', LANGUAGE_ZONE ),
	'base' => 'vc_pie',
	'class' => '',
	'icon' => 'icon-wpb-vc_pie',
	'category' => __( 'Content', LANGUAGE_ZONE ),
	'description' => __( 'Animated pie chart', LANGUAGE_ZONE ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', LANGUAGE_ZONE ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', LANGUAGE_ZONE ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Pie value', LANGUAGE_ZONE ),
			'param_name' => 'value',
			'description' => __( 'Input graph value here. Choose range between 0 and 100.', LANGUAGE_ZONE ),
			'value' => '50',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Pie label value', LANGUAGE_ZONE ),
			'param_name' => 'label_value',
			'description' => __( 'Input integer value for label. If empty "Pie value" will be used.', LANGUAGE_ZONE ),
			'value' => ''
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Units', LANGUAGE_ZONE ),
			'param_name' => 'units',
			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', LANGUAGE_ZONE )
		),
		array(
			"type" => "dropdown",
			"heading" => __("Bar color", LANGUAGE_ZONE),
			"param_name" => "color_mode",
			"value" => array(
				"Title" => "title_like",
				"Light (50% content)" => "content_like",
				"Accent" => "accent",
				"Custom" => "custom"
			),
			"description" => __( 'Select pie chart color.', LANGUAGE_ZONE )
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Custom bar color", LANGUAGE_ZONE),
			"param_name" => "color",
			"value" => '#f7f7f7',
			"description" => "",
			"dependency" => array(
				"element" => "color_mode",
				"value" => array(
					"custom"
				)
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', LANGUAGE_ZONE ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', LANGUAGE_ZONE )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", LANGUAGE_ZONE),
			"admin_label" => true,
			"param_name" => "appearance",
			"value" => array(
				"Pie chart (default)" => "default",
				"Counter" => "counter"
			),
			"description" => ""
		)

	)
) );

//***********************************************************************
// Progress bars
//***********************************************************************

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __("Text position", LANGUAGE_ZONE),
	"param_name" => "caption_pos",
	"value" => array(
		'On the bar' => 'on',
		'Above the bar' => 'top'
	),
	"description" => ""
));

// add accent predefined color
$param = WPBMap::getParam('vc_progress_bar', 'bgcolor');
$param['value'] = array( 'Accent' => 'accent-bg', 'Custom' => 'custom' );
WPBMap::mutateParam('vc_progress_bar', $param);

//***********************************************************************
// Column text
//***********************************************************************

// add custom animation
$param = WPBMap::getParam('vc_column_text', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_column_text', $param);

//***********************************************************************
// Message Box
//***********************************************************************

// add custom animation
$param = WPBMap::getParam('vc_message', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_message', $param);

//***********************************************************************
// Toggle
//***********************************************************************

// add custom animation
$param = WPBMap::getParam('vc_toggle', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_toggle', $param);

//***********************************************************************
// Single Image
//***********************************************************************

// add custom animation
$param = WPBMap::getParam('vc_single_image', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_single_image', $param);

//***********************************************************************
// Accordion
//***********************************************************************

vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Style", LANGUAGE_ZONE),
	"param_name" => "style",
	"value" => array(
		'Style 1 (no background)' => '1',
		'Style 2 (with background)' => '2',
		'Style 3 (with dividers)' => '3'
	),
	"description" => ""
));

//***********************************************************************
// Carousel
//***********************************************************************

// vc_remove_param('vc_carousel', 'mode');

//////////////////
// VC Separator //
//////////////////

// vc_map_update( 'vc_separator', array( "name" => __("Separator (deprecated)", LANGUAGE_ZONE), "category"  => __('Deprecated', LANGUAGE_ZONE), "weight" => -1 ) );

///////////////////////
// VC Text Separator //
///////////////////////

vc_map_update( 'vc_text_separator', array( "name" => __("Separator with Text (deprecated)", LANGUAGE_ZONE), "category"  => __('Deprecated', LANGUAGE_ZONE), "weight" => -1 ) );
