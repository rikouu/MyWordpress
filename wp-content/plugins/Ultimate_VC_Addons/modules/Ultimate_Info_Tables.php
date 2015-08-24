<?php
/*
* Add-on Name: Info Tables for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists("Ultimate_Info_Table")){
	class Ultimate_Info_Table{
		function __construct(){
			add_action("admin_init",array($this,"ultimate_it_init"));
			add_shortcode("ultimate_info_table",array($this,"ultimate_it_shortcode"));
		}
		function ultimate_it_init(){
			if(function_exists("vc_map")){
				vc_map(
				array(
				   "name" => __("信息表"),
				   "base" => "ultimate_info_table",
				   "class" => "vc_ultimate_info_table",
				   "icon" => "vc_ultimate_info_table",
				   "category" => __("Ultimate VC Addons",'smile'),
				   "description" => __("创建漂亮的信息表.","smile"),
				   "params" => array(
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("选择设计风格", "smile"),
							"param_name" => "design_style",
							"value" => array(
								"Design 01" => "design01",
								"Design 02" => "design02",
								"Design 03" => "design03",
								"Design 04" => "design04",
								"Design 05" => "design05",
								"Design 06" => "design06",
							),
							"description" => __("选择您想要使用信息表设计", "smile")
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("选择配色方案", "smile"),
							"param_name" => "color_scheme",
							"value" => array(
								"Black" => "black",
								"Red" => "red",
								"Blue" => "blue",
								"Yellow" => "yellow",
								"Green" => "green",
								"Gray" => "gray",
								"Design Your Own" => "custom",
							),
							"description" => __("配色方案想使用吗?", "smile")
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("主要的背景颜色", "smile"),
							"param_name" => "color_bg_main",
							"value" => "",
							"description" => __("选择正常的背景颜色.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("主要文本颜色", "smile"),
							"param_name" => "color_txt_main",
							"value" => "",
							"description" => __("选择正常的背景颜色.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("配置高亮的背景颜色 ", "smile"),
							"param_name" => "color_bg_highlight",
							"value" => "",
							"description" => __("选择突出显示的背景颜色.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("强调文本颜色", "smile"),
							"param_name" => "color_txt_highlight",
							"value" => "",
							"description" => __("选择突出显示的背景颜色.", "smile"),
							"dependency" => Array("element" => "color_scheme","value" => array("custom")),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("标题 ", "smile"),
							"param_name" => "package_heading",
							"admin_label" => true,
							"value" => "",
							"description" => __("标题信息表", "smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("副标题 ", "smile"),
							"param_name" => "package_sub_heading",
							"value" => "",
							"description" => __(" 在一行描述信息表", "smile"),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("图标显示:", "smile"),
							"param_name" => "icon_type",
							"value" => array(
								"No Icon" => "none",
								"Font Icon Manager" => "selector",
								"Custom Image Icon" => "custom",
							),
							"description" => __("使用现有的字体图标</a> 或上传自定义图像.", "smile")
						),
						array(
							"type" => "icon_manager",
							"class" => "",
							"heading" => __("选择图标  ","smile"),
							"param_name" => "icon",
							"value" => "",
							"description" => __("单击并选择您选择的图标.如果你不能找到一个适合你的目的,你可以<a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),
						),
						array(
							"type" => "attach_image",
							"class" => "",
							"heading" => __("上传图片的缩略图:", "smile"),
							"param_name" => "icon_img",
							"value" => "",
							"description" => __("上传自定义图片图标.", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("custom")),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("图像宽度 ", "smile"),
							"param_name" => "img_width",
							"value" => 48,
							"min" => 16,
							"max" => 512,
							"suffix" => "px",
							"description" => __("提供图像宽度", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("custom")),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("图标的大小", "smile"),
							"param_name" => "icon_size",
							"value" => 32,
							"min" => 12,
							"max" => 72,
							"suffix" => "px",
							"description" => __("你想要多大吗?", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("颜色 ", "smile"),
							"param_name" => "icon_color",
							"value" => "#333333",
							"description" => __("给它一个好的油漆!", "smile"),
							"dependency" => Array("element" => "icon_type","value" => array("selector")),						
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("图标样式", "smile"),
							"param_name" => "icon_style",
							"value" => array(
								"Simple" => "none",
								"Circle Background" => "circle",
								"Square Background" => "square",
								"Design your own" => "advanced",
							),
							"description" => __("我们有三个快速预定如果你匆忙.否则,创建自己的各种选择.", "smile"),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("背景颜色", "smile"),
							"param_name" => "icon_color_bg",
							"value" => "#ffffff",
							"description" => __("为图标选择背景颜色.", "smile"),	
							"dependency" => Array("element" => "icon_style", "value" => array("circle","square","advanced")),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("图标边框样式", "smile"),
							"param_name" => "icon_border_style",
							"value" => array(
								"None" => "",
								"Solid"=> "solid",
								"Dashed" => "dashed",
								"Dotted" => "dotted",
								"Double" => "double",
								"Inset" => "inset",
								"Outset" => "outset",
							),
							"description" => __("选择边框样式图标.","smile"),
							"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __("边框色彩", "smile"),
							"param_name" => "icon_color_border",
							"value" => "#333333",
							"description" => __("为图标选择边框颜色.", "smile"),	
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("边框宽度", "smile"),
							"param_name" => "icon_border_size",
							"value" => 1,
							"min" => 1,
							"max" => 10,
							"suffix" => "px",
							"description" => __("边界的厚度.", "smile"),
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("边框半径 ", "smile"),
							"param_name" => "icon_border_radius",
							"value" => 500,
							"min" => 1,
							"max" => 500,
							"suffix" => "px",
							"description" => __("0像素值将创建一个广场边界.当你增加价值,形状圆内转换缓慢. (例 500 像素).", "smile"),
							"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => __("背景的大小", "smile"),
							"param_name" => "icon_border_spacing",
							"value" => 50,
							"min" => 30,
							"max" => 500,
							"suffix" => "px",
							"description" => __("间距从中心图标到边界的边界/背景", "smile"),
							"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => __("特点", "smile"),
							"param_name" => "content",
							"value" => "",
							"description" => __("在简短的描述信息表.", "smile"),
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => __("添加链接", "smile"),
							"param_name" => "use_cta_btn",
							"value" => array(
								"No Link" => "",
								"Call to Action Button" => "true",
								"Link to Complete Box" => "box",
							),
							"description" => __("你想显示调用操作按钮?","smile"),
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("调用操作按钮的文本", "smile"),
							"param_name" => "package_btn_text",
							"value" => "",
							"description" => __("输入调用操作按钮的文本", "smile"),
							"dependency" => Array("element" => "use_cta_btn", "value" => array("true")),
						),
						array(
							"type" => "vc_link",
							"class" => "",
							"heading" => __("行动呼吁链接", "smile"),
							"param_name" => "package_link",
							"value" => "",
							"description" => __("选择/输入调用操作按钮的链接", "smile"),
							"dependency" => Array("element" => "use_cta_btn", "value" => array("true","box")),
						),
						// Customize everything
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => __("额外的类别", "smile"),
							"param_name" => "el_class",
							"value" => "",
							"description" => __("添加额外的类名,将被应用到图标框,你可以使用这个类来定制.", "smile"),
						),
					)// params
				));// vc_map
			}
		}
		function ultimate_it_shortcode($atts,$content = null){
			// enqueue js
			wp_enqueue_script('ultimate-appear');
			if(get_option('ultimate_row') == "enable"){
				wp_enqueue_script('ultimate-row-bg',plugins_url('../assets/js/',__FILE__).'ultimate_bg.js');
			}
			wp_enqueue_script('ultimate-custom');
			// enqueue css
			wp_enqueue_style('ultimate-animate');
			wp_enqueue_style('ultimate-style');
			wp_enqueue_style("ultimate-pricing",plugins_url("../assets/css/pricing.css",__FILE__));
			$design_style = '';
			extract(shortcode_atts(array(
				"design_style" => "",
			),$atts));
			$output = '';
			require_once(__ULTIMATE_ROOT__.'/templates/info-tables/info-table-'.$design_style.'.php');
			$design_func = 'generate_'.$design_style;
			$design_cls = 'Info_'.ucfirst($design_style);
			$class = new $design_cls;
			$output .= $class->generate_design($atts,$content);
			return $output;
		}
	} // class Ultimate_Info_Table
	new Ultimate_Info_Table;
}