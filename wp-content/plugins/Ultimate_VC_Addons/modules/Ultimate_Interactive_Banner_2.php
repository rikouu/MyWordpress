<?php
/*
* Add-on Name: Interactive Banner - 2
*/
if(!class_exists('Ultimate_Interactive_Banner')) 
{
	class Ultimate_Interactive_Banner{
		function __construct(){
			add_action('admin_init',array($this,'banner_init'));
			add_shortcode('interactive_banner_2',array($this,'banner_shortcode'));
		}
		function banner_init(){
			if(function_exists('vc_map'))
			{
				$json = ultimate_get_banner2_json();
				vc_map(
					array(
					   "name" => __("交互式幻灯片2","smile"),
					   "base" => "interactive_banner_2",
					   "class" => "vc_interactive_icon",
					   "icon" => "vc_icon_interactive",
					   "category" => __("Ultimate VC Addons","smile"),
					   "description" => __("显示横幅图像信息","smile"),
					   "params" => array(
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("标题  ","smile"),
								"param_name" => "banner_title",
								"admin_label" => true,
								"value" => "",
								"description" => __("给这个横幅标题","smile")
							),
							array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("描述 ","smile"),
								"param_name" => "banner_desc",
								"value" => "",
								"description" => __("在鼠标悬停文本.","smile")
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("横幅图像","smile"),
								"param_name" => "banner_image",
								"value" => "",
								"description" => __("上传这个横幅的形象","smile")
							),
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("连接 ","smile"),
								"param_name" => "banner_link",
								"value" => "",
								"description" => __("添加链接/选择现有页面链接到这个横幅","smile"),
							),
							/*array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("Link Text","smile"),
								"param_name" => "banner_link_text",
								"value" => "",
								"description" => __("Enter text for button","smile"),
								"dependency" => Array("element" => "link_opts","value" => array("more")),
							),*/
							array(
								"type" => "ult_select2",
								"class" => "",
								"heading" => __("风格  ","smile"),
								"param_name" => "banner_style",
								"value" => "",
								"json" => $json,
								"description" => "",
							),
							/*array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Banner Styles","smile"),
								"param_name" => "banner_style",
								"value" => array(
									__("Style 1","smile") => "style1",
									__("Style 2","smile") => "style2",
									__("Style 3","smile") => "style3",
									__("Style 4","smile") => "style4",
									__("Style 5","smile") => "style5",
									__("Style 6","smile") => "style6",
									__("Style 7","smile") => "style7",
									__("Style 8","smile") => "style8",
									__("Style 9","smile") => "style9",
									__("Style 10","smile") => "style10",
									__("Style 11","smile") => "style11",
									__("Style 12","smile") => "style12",
									__("Style 13","smile") => "style13",
									__("Style 14","smile") => "style14",
									__("Style 15","smile") => "style15",
									),
								"description" => __("Select animation effect style for this block.","smile")
							),*/
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("标题背景颜色","smile"),
								"param_name" => "banner_title_bg",
								"value" => "",
								"description" => "",
								"dependency" => Array("element" => "banner_style", "value" => array('style5')),
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("额外的类别", "smile"),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("添加额外的类名,将被应用到图标的过程,并且您可以使用这个类为你定制.", "smile"),
							),
							array(
								"type" => "text",
								"heading" => __("<h2>标题的设置</h2>"),
								"param_name" => "banner_title_typograpy",
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("系统的字体 ", "smile"),
								"param_name" => "banner_title_font_family",
								"description" => __("选择您所选择的字体.你可以 <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>__("字体风格", "smile"),
								"param_name"	=>	"banner_title_style",
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("字体大小", "smile"),
								"param_name" => "banner_title_font_size",
								"min" => 12,
								"suffix" => "px",
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "text",
								"heading" => __("<h2>描述的设置</h2>"),
								"param_name" => "banner_desc_typograpy",
								"group" => "Typography",
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("系统的字体 ", "smile"),
								"param_name" => "banner_desc_font_family",
								"description" => __("选择您所选择的字体.你可以<a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("字体风格", "smile"),
								"param_name"	=>	"banner_desc_style",
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("字体大小", "smile"),
								"param_name" => "banner_desc_font_size",
								"min" => 12,
								"suffix" => "px",
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("标题颜色","smile"),
								"param_name" => "banner_color_title",
								"value" => "",
								"description" => "",
								"group" => "Color Settings",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("描述颜色","smile"),
								"param_name" => "banner_color_desc",
								"value" => "",
								"description" => "",
								"group" => "Color Settings",
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("背景颜色","smile"),
								"param_name" => "banner_color_bg",
								"value" => "",
								"description" => "",
								"group" => "Color Settings",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("图像透明度", "smile"),
								"param_name" => "image_opacity",
								"value" => 1,
								"min" => 0.0,
								"max" => 1.0,
								"step" => 0.1,
								"suffix" => "",
								"description" => __("输入值0.0至1 (0是最大的透明度,而1是最低的)","smile"),
								"group" => "Color Settings",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("图像透明度上徘徊", "smile"),
								"param_name" => "image_opacity_on_hover",
								"value" => 1,
								"min" => 0.0,
								"max" => 1.0,
								"step" => 0.1,
								"suffix" => "",
								"description" => __("输入值0.0至1 (0是最大的透明度,而1是最低的)","smile"),
								"group" => "Color Settings",
							),
							array(
								"type" => "checkbox",
								"class" => "",
								"heading" => __("响应自然","smile"),
								"param_name" => "enable_responsive",
								"value" => array("Enable Responsive Behaviour" => "yes"),
								"description" => __("如果描述文本不适合在特定的屏幕尺寸,你可以启用该选项,将隐藏的描述文本.","smile"),
								"group" => "Responsive",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("最低屏幕大小", "smile"),
								"param_name" => "responsive_min",
								"value" => 768,
								"min" => 100,
								"max" => 1000,
								"suffix" => "px",
								"dependency" => Array("element" => "enable_responsive", "value" => "yes"),
								"description" => __("提供屏幕大小的范围,你想隐藏的描述文本.","smile"),
								"group" => "Responsive",
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("最大的屏幕大小", "smile"),
								"param_name" => "responsive_max",
								"value" => 900,
								"min" => 100,
								"max" => 1000,
								"suffix" => "px",
								"dependency" => Array("element" => "enable_responsive", "value" => "yes"),
								"description" => __("提供屏幕大小的范围,你想隐藏的描述文本.","smile"),	
								"group" => "Responsive",
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for stats banner
		function banner_shortcode($atts)
		{
			// enqueue js
			// enqueue css
			wp_enqueue_style('utl-ib2-style',plugins_url('../assets/css/ib2-style.css',__FILE__));
			$banner_title = $banner_desc = $banner_image = $banner_link = $banner_style = $el_class = '';
			$banner_title_font_family=$banner_title_style = $banner_title_font_size = $banner_desc_font_family = $banner_desc_style = $banner_desc_font_size = '';
			$banner_title_style_inline = $banner_desc_style_inline = $banner_color_bg = $banner_color_title = $banner_color_desc = $banner_title_bg = '';
			$image_opacity = $image_opacity_on_hover = $enable_responsive = $responsive_min = $responsive_max = '';
			extract(shortcode_atts( array(
				'banner_title' => '',
				'banner_desc' => '',
				'banner_title_location' => '',
				'banner_image' => '',
				'image_opacity' => '',
				'image_opacity_on_hover' => '',
				'banner_height'=>'',
				'banner_height_val'=>'',
				'banner_link' => '',
				/*'banner_link_text' => '',*/
				'banner_style' => '',
				'banner_title_font_family' => '',
				'banner_title_style' => '',
				'banner_title_font_size' => '',
				'banner_desc_font_family' => '',
				'banner_desc_style' => '',
				'banner_desc_font_size' => '',
				'banner_color_bg' => '',
				'banner_color_title' => '',
				'banner_color_desc' => '',
				'banner_title_bg' => '',
				'enable_responsive' => '',
				'responsive_min' => '',
				'responsive_max' => '',
				'el_class' =>'',
			),$atts));
			$output = $style = $target = $link = $banner_style_inline = $title_bg = $img_style = $responsive = '';
			//$banner_style = 'style01';
			
			if($enable_responsive == "yes"){
				$responsive .= 'data-min-width="'.$responsive_min.'" data-max-width="'.$responsive_max.'"';
				$el_class .= "ult-ib-resp";
			}
			
			if($banner_title_bg !== '' && $banner_style == "style5"){
				$title_bg .= 'background:'.$banner_title_bg.';';
			}
			
			$img = wp_get_attachment_image_src( $banner_image, 'large');
			if($banner_link !== ''){
				$href = vc_build_link($banner_link);
				$link = $href['url'];
				if(isset($href['target'])){
					$target = 'target="'.$href['target'].'"';
				}
			} else {
				$link = "#";
			}
			
			if($banner_title_font_family != '')
			{
				$bfamily = get_ultimate_font_family($banner_title_font_family);
				if($bfamily != '')
					$banner_title_style_inline = 'font-family:\''.$bfamily.'\';';
			}
			$banner_title_style_inline .= get_ultimate_font_style($banner_title_style);
			if($banner_title_font_size != '')
				$banner_title_style_inline .= 'font-size:'.$banner_title_font_size.'px;';
				
			if($banner_desc_font_family != '')
			{
				$bdfamily = get_ultimate_font_family($banner_desc_font_family);
				if($bdfamily != '')
					$banner_desc_style_inline = 'font-family:\''.$bdfamily.'\';';
			}
			$banner_desc_style .= get_ultimate_font_style($banner_desc_style);
			if($banner_desc_font_size != '')
				$banner_desc_style_inline .= 'font-size:'.$banner_desc_font_size.'px;';
			
			if($banner_color_bg != '')
				$banner_style_inline .= 'background:'.$banner_color_bg.';"';

			if($banner_color_title != '')
				$banner_title_style_inline .= 'color:'.$banner_color_title.';"';

			if($banner_color_desc != '')
				$banner_desc_style_inline .= 'color:'.$banner_color_desc.';"';

			//enqueue google font
			$args = array(
				$banner_title_font_family, $banner_desc_font_family
			);
			enquque_ultimate_google_fonts($args);
			
			if($image_opacity !== ''){
				$img_style .= 'opacity:'.$image_opacity.';';
			}
			
			$output .= '<div class="ult-new-ib ult-ib-effect-'.$banner_style.' '.$el_class.'" '.$responsive.' style="'.$banner_style_inline.'" data-opacity="'.$image_opacity.'" data-hover-opacity="'.$image_opacity_on_hover.'">';
			$output .= '<img class="ult-new-ib-img" style="'.$img_style.'" src="'.$img[0].'"/>';
			$output .= '<div class="ult-new-ib-desc" style="'.$title_bg.'">';
			$output .= '<h2 class="ult-new-ib-title" style="'.$banner_title_style_inline.'">'.$banner_title.'</h2>';
			$output .= '<p class="ult-new-ib-content" style="'.$banner_desc_style_inline.'">'.$banner_desc.'</p>';
			$output .= '</div>';
			$output .= '<a class="ult-new-ib-link" href="'.$link.'"></a>';
			$output .= '</div>';

			return $output;
		}
	}
}
if(class_exists('Ultimate_Interactive_Banner'))
{
	$Ultimate_Interactive_Banner = new Ultimate_Interactive_Banner;
}
