<?php
/*
* Add-on Name: Interactive Banners for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('AIO_Interactive_Banners')) 
{
	class AIO_Interactive_Banners
	{
		function __construct()
		{
			add_action('admin_init',array($this,'banner_init'));
			add_shortcode('interactive_banner',array($this,'banner_shortcode'));
		}
		function banner_init()
		{
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   "name" => __("互动的横幅","smile"),
					   "base" => "interactive_banner",
					   "class" => "vc_interactive_icon",
					   "icon" => "vc_icon_interactive",
					   "category" => __("Ultimate VC Addons","smile"),
					   "description" => __("显示横幅图像信息","smile"),
					   "params" => array(
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("交互式横幅标题 ","smile"),
								"param_name" => "banner_title",
								"admin_label" => true,
								"value" => "",
								"description" => __("给这个横幅标题","smile")
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("横幅标题位置 ","smile"),
								"param_name" => "banner_title_location",
								"value" => array(
									__("标题中心","smile")=>'center',
									__("标题左","smile")=>'left',
								),
								"description" => __("标题对齐.","smile")
							),
							array(
								"type" => "textarea",
								"class" => "",
								"heading" => __("旗帜的描述","smile"),
								"param_name" => "banner_desc",
								"value" => "",
								"description" => __("在鼠标悬停文本.","smile")
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("使用图标", "smile"),
								"param_name" => "icon_disp",
								"value" => array(
									"None" => "none",
									"Icon with Heading" => "with_heading",
									"Icon with Description" => "with_description",
									"Both" => "both",
								),
								"description" => __("图标可以显示标题和描述.", "smile"),
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("选择图标 ","smile"),
								"param_name" => "banner_icon",
								"admin_label" => true,
								"value" => "",
								"description" => __("单击并选择您选择的图标.如果你不能找到一个适合你的目的,你可以 <a href='admin.php?page=AIO_Icon_Manager' target='_blank'>add new here</a>.", "smile"),
								"dependency" => Array("element" => "icon_disp","value" => array("with_heading","with_description","both")),
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
								"type" => "dropdown",
								"class" => "",
								"heading" => __("旗帜高度类型","smile"),
								"param_name" => "banner_height",
								"value" => array("Auto Height"=>'',
												"Custom Height"=>'banner-block-custom-height'),
								"description" => __("选择在自动或者自定义高度的横幅.","smile")
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("横幅高度值","smile"),
								"param_name" => "banner_height_val",
								"value" => '',
								"suffix"=>'px',
								"description" => __("给在像素高度互动的横幅.","smile"),
								"dependency" => Array("element"=>"banner_height","value"=>array("banner-block-custom-height"))
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("申请链接:", "smile"),
								"param_name" => "link_opts",
								"value" => array(
									"No Link" => "none",
									"Complete Box" => "box",
									"Display Read More" => "more",
								),
								"description" => __("选择是否使用颜色图标.", "smile"),
							),
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("旗帜的链接 ","smile"),
								"param_name" => "banner_link",
								"value" => "",
								"description" => __("添加链接/选择现有页面链接到这个横幅","smile"),
								"dependency" => Array("element" => "link_opts", "value" => array("box","more")),
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("链接文本 ","smile"),
								"param_name" => "banner_link_text",
								"value" => "",
								"description" => __("输入文本的按钮","smile"),
								"dependency" => Array("element" => "link_opts","value" => array("more")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("盒子悬停效果","smile"),
								"param_name" => "banner_style",
								"value" => array(
									__("从底部出现","smile") => "style01",
									__("从顶部出现","smile") => "style02",
									__("从左部出现","smile") => "style03",
									__("从右部出现","smile") => "style04",
									__("放大","smile") => "style11",
									__("缩小","smile") => "style12",
									__("放大缩小","smile") => "style13",
									__("从左部跳","smile") => "style21",
									__("从右部跳","smile") => "style22",
									__("从下拉","smile") => "style31",
									__("从上拉","smile") => "style32",
									__("从左拉","smile") => "style33",
									__("从右拉","smile") => "style34",
									),
								"description" => __("选择动画效果这一块的样式.","smile")
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("标题背景颜色","smile"),
								"param_name" => "banner_bg_color",
								"value" => "#242424",
								"description" => __("选择横幅标题的背景颜色","smile")
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("背景颜色不透明","smile"),
								"param_name" => "banner_opacity",
								"value" => array(
									'Transparent Background'=>'opaque',
									'Solid Background'=>'solid'
								),
								"description" => __("选择背景不透明覆盖的内容","smile")
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
								"heading" => __("<h2>横幅标题设置</h2>"),
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
								"heading" 		=>	__("字体样式", "smile"),
								"param_name"	=>	"banner_title_style",
								//"description"	=>	__("Main heading font style", "smile"),
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
								//"description" => __("Sub heading font size", "smile"),
								"dependency" => Array("element" => "banner_title", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "text",
								"heading" => __("<h2>横幅描述设置</h2>"),
								"param_name" => "banner_desc_typograpy",
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography",
							),
							array(
								"type" => "ultimate_google_fonts",
								"heading" => __("系统的字体", "smile"),
								"param_name" => "banner_desc_font_family",
								"description" => __("选择您所选择的字体.你可以 <a target='_blank' href='".admin_url('admin.php?page=ultimate-font-manager')."'>add new in the collection here</a>.", "smile"),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography"
							),
							array(
								"type" => "ultimate_google_fonts_style",
								"heading" 		=>	__("字体样式", "smile"),
								"param_name"	=>	"banner_desc_style",
								//"description"	=>	__("Main heading font style", "smile"),
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
								//"description" => __("Sub heading font size", "smile"),
								"dependency" => Array("element" => "banner_desc", "not_empty" => true),
								"group" => "Typography",
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
			wp_enqueue_script('ultimate-appear');
			if(get_option('ultimate_row') == "enable"){
				wp_enqueue_script('ultimate-row-bg',plugins_url('../assets/js/',__FILE__).'ultimate_bg.js');
			}
			wp_enqueue_script('ultimate-custom');
			// enqueue css
			wp_enqueue_style('ultimate-animate');
			wp_enqueue_style('ultimate-style');
			wp_enqueue_style('aio-interactive-styles',plugins_url('../assets/css/interactive-styles.css',__FILE__));
			$banner_title = $banner_desc = $banner_icon = $banner_image = $banner_link = $banner_link_text = $banner_style = $banner_bg_color = $el_class = $animation = $icon_disp = $link_opts = $banner_title_location = $banner_title_style_inline = $banner_desc_style_inline = '';
			extract(shortcode_atts( array(
				'banner_title' => '',
				'banner_desc' => '',
				'banner_title_location' => '',
				'icon_disp' => '',
				'banner_icon' => '',
				'banner_image' => '',
				'banner_height'=>'',
				'banner_height_val'=>'',
				'link_opts' => '',
				'banner_link' => '',
				'banner_link_text' => '',
				'banner_style' => '',
				'banner_bg_color' => '',
				'banner_opacity' => '',
				'el_class' =>'',
				'animation' => '',
				'banner_title_font_family' => '',
				'banner_title_style' => '',
				'banner_title_font_size' => '',
				'banner_desc_font_family' => '',
				'banner_desc_style' => '',
				'banner_desc_font_size' => ''
			),$atts));
			$output = $icon = $style = $target = '';
			//$banner_style = 'style01';
			
			if($banner_title_font_family != '')
			{
				$bfamily = get_ultimate_font_family($banner_title_font_family);
				$banner_title_style_inline = 'font-family:\''.$bfamily.'\';';
			}
			$banner_title_style_inline .= get_ultimate_font_style($banner_title_style);
			if($banner_title_font_size != '')
				$banner_title_style_inline .= 'font-size:'.$banner_title_font_size.'px;';
			if($banner_bg_color != '')
				$banner_title_style_inline .= 'background:'.$banner_bg_color.';"';
				
			if($banner_desc_font_family != '')
			{
				$bdfamily = get_ultimate_font_family($banner_desc_font_family);
				$banner_desc_style_inline = 'font-family:\''.$bdfamily.'\';';
			}
			$banner_desc_style .= get_ultimate_font_style($banner_desc_style);
			if($banner_desc_font_size != '')
				$banner_desc_style_inline .= 'font-size:'.$banner_desc_font_size.'px;';
			
			//enqueue google font
			$args = array(
				$banner_title_font_family, $banner_desc_font_family
			);
			enquque_ultimate_google_fonts($args);
			
			
			if($animation !== 'none')
			{
				$css_trans = 'data-animation="'.$animation.'" data-animation-delay="03"';
			}
			
			if($banner_icon !== '')
				$icon = '<i class="'.$banner_icon.'"></i>';
			$img = wp_get_attachment_image_src( $banner_image, 'large');
			$href = vc_build_link($banner_link);
			if(isset($href['target'])){
				$target = 'target="'.$href['target'].'"';
			}
			$banner_top_style='';
			if($banner_height!='' && $banner_height_val!=''){
				$banner_top_style = 'height:'.$banner_height_val.'px;';
			}
			$output .= "\n".'<div class="banner-block '.$banner_height.' banner-'.$banner_style.' '.$el_class.'"  '.$css_trans.' style="'.$banner_top_style.'">';
			$output .= "\n\t".'<img src="'.$img[0].'" alt="'.$banner_title.'">';
			if($banner_title !== ''){
				$output .= "\n\t".'<h3 class="title-'.$banner_title_location.' bb-top-title" style="'.$banner_title_style_inline.'">'.$banner_title;
				if($icon_disp == "with_heading" || $icon_disp == "both")
					$output .= $icon;
				$output .= '</h3>';
			}
			$output .= "\n\t".'<div class="mask '.$banner_opacity.'-background">';
			if($icon_disp == "with_description" || $icon_disp == "both"){
				if($banner_icon !== ''){
					$output .= "\n\t\t".'<div class="bb-back-icon">'.$icon.'</div>';
					$output .= "\n\t\t".'<p>'.$banner_desc.'</p>';
				}
			} else {
				$output .= "\n\t\t".'<p class="bb-description" style="'.$banner_desc_style_inline.'">'.$banner_desc.'</p>';
			}
			if($link_opts == "more")
				$output .= "\n\t\t".'<a class="bb-link" href="'.$href['url'].'" '.$target.'>'.$banner_link_text.'</a>';
			$output .= "\n\t".'</div>';
			$output .= "\n".'</div>';
			if($link_opts == "box"){
				$banner_with_link = '<a class="bb-link" href="'.$href['url'].'" '.$target.'>'.$output.'</a>';
				return $banner_with_link;
			} else {
				return $output;
			}
		}
	}
}
if(class_exists('AIO_Interactive_Banners'))
{
	$AIO_Interactive_Banners = new AIO_Interactive_Banners;
}
