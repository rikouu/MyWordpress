<?php
/*
* Add-on Name: Just Icon for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('AIO_Just_Icon')) 
{
	class AIO_Just_Icon
	{
		function __construct()
		{
			add_action('admin_init',array($this,'just_icon_init'));
			add_shortcode('just_icon',array($this,'just_icon_shortcode'));
		}
		function just_icon_init()
		{
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   "name" => __("只是图标"),
					   "base" => "just_icon",
					   "class" => "vc_simple_icon",
					   "icon" => "vc_just_icon",
					   "category" => __("Ultimate VC Addons","smile"),
					   "description" => __("添加一个简单的图标,给一些自定义的风格.","smile"),
					   "params" => array(							
							// Play with icon selector
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("图标显示:", "smile"),
								"param_name" => "icon_type",
								"value" => array(
									"Font Icon Manager" => "selector",
									"Custom Image Icon" => "custom",
								),
								"description" => __("使用  <a href='admin.php?page=font-icon-Manager' target='_blank'>现有字体图标</a> 或上传自定义图像.", "smile")
							),
							array(
								"type" => "icon_manager",
								"class" => "",
								"heading" => __("选择图标  ","smile"),
								"param_name" => "icon",
								"value" => "",
								"description" => __("单击并选择您选择的图标.如果你不能找到一个适合你的目的,你可以 <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "flip-box"),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("上传图片的缩略图:", "smile"),
								"param_name" => "icon_img",
								"admin_label" => true,
								"value" => "",
								"description" => __("上传自定义图片图标.", "smile"),
								"dependency" => Array("element" => "icon_type","value" => array("custom")),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("图像宽度", "smile"),
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
								"heading" => __("图标或图片风格", "smile"),
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
									"None"=> "",
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
								"description" => __("0像素值将创建一个广场边界. 当你增加价值,形状圆内转换缓慢. (e.g 500 pixels).", "smile"),
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
								"description" => __("S从中心图标踱步到边界的边界/背景", "smile"),
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "vc_link",
								"class" => "",
								"heading" => __("Link ","smile"),
								"param_name" => "icon_link",
								"value" => "",
								"description" => __("添加一个自定义或选择现有的页面的链接.您可以删除现有的链接.","smile")
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("动画 ","smile"),
								"param_name" => "icon_animation",
								"value" => array(
							 		__("没有动画","smile") => "",
									__("旋转","smile") => "swing",
									__("脉冲 ","smile") => "pulse",
									__("淡入","smile") => "fadeIn",
									__("向上淡入","smile") => "fadeInUp",
									__("向下淡入","smile") => "fadeInDown",
									__("向左淡入","smile") => "fadeInLeft",
									__("向右淡入","smile") => "fadeInRight",
									__("向上淡入长时间","smile") => "fadeInUpBig",
									__("向下淡入长时间","smile") => "fadeInDownBig",
									__("向左淡入长时间","smile") => "fadeInLeftBig",
									__("向右淡入长时间","smile") => "fadeInRightBig",
									__("向下滑动","smile") => "slideInDown",
									__("向左滑动","smile") => "slideInLeft",
									__("向左滑动","smile") => "slideInLeft",
									__("弹跳","smile") => "bounceIn",
									__("向上弹跳","smile") => "bounceInUp",
									__("向下弹跳","smile") => "bounceInDown",
									__("向左弹跳","smile") => "bounceInLeft",
									__("向右弹跳","smile") => "bounceInRight",
									__("旋转","smile") => "rotateIn",
									__("光速","smile") => "lightSpeedIn",
									__("滚动","smile") => "rollIn",
									),
								"description" => __("喜欢CSS3动画吗?我们有几个选项为您服务!","smile")
						  	),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("提示框 ", "smile"),
								"param_name" => "tooltip_disp",
								"value" => array(
									"None"=> "",
									"Tooltip from Left" => "left",
									"Tooltip from Right" => "right",
									"Tooltip from Top" => "top",
									"Tooltip from Bottom" => "bottom",
								),
								"description" => __("选择工具提示的位置","smile"),
							),							
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("提示文本", "smile"),
								"param_name" => "tooltip_text",
								"value" => "",
								"description" => __("在这里输入你的提示文本.", "smile"),
								"dependency" => Array("element" => "tooltip_disp", "not_empty" => true),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("对齐 ", "smile"),
								"param_name" => "icon_align",
								"value" => array(
									"Center"	=>	"center",
									"Left"		=>	"left",
									"Right"		=>	"right"
								)
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("自定义CSS类", "smile"),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("跑出来的选项吗?需要更多的风格吗?编写自己的CSS和提到这里的类名.", "smile"),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for stats Icon
		function just_icon_shortcode($atts)
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
			wp_enqueue_script('aio-tooltip',plugins_url('../assets/js/',__FILE__).'tooltip.js',array('jquery'));
			wp_enqueue_style('aio-tooltip',plugins_url('../assets/css/',__FILE__).'tooltip.css');
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation =  $tooltip_disp = $tooltip_text = $icon_align = '';
			extract(shortcode_atts( array(				
				'icon_type' => '',
				'icon' => '',
				'icon_img' => '',
				'img_width' => '',
				'icon_size' => '',				
				'icon_color' => '',
				'icon_style' => '',
				'icon_color_bg' => '',
				'icon_color_border' => '',			
				'icon_border_style' => '',
				'icon_border_size' => '',
				'icon_border_radius' => '',
				'icon_border_spacing' => '',
				'icon_link' => '',
				'icon_animation' => '',
				'tooltip_disp' => '',
				'tooltip_text' => '',
				'el_class'=>'',
				'icon_align' => ''
			),$atts));
			if($icon_animation !== 'none')
			{
				$css_trans = 'data-animation="'.$icon_animation.'" data-animation-delay="03"';
			}
			$output = $style = $link_sufix = $link_prefix = $target = $href = $icon_align_style = '';
			$uniqid = uniqid();
			if($icon_link !== ''){
				$href = vc_build_link($icon_link);
				$target = (isset($href['target'])) ? "target='".$href['target']."'" : '';
				$link_prefix .= '<a class="aio-tooltip '.$uniqid.'" href = "'.$href['url'].'" '.$target.' data-toggle="tooltip" data-placement="'.$tooltip_disp.'" title="'.$tooltip_text.'">';
				$link_sufix .= '</a>';
			} else {
				if($tooltip_disp !== ""){
					$link_prefix .= '<span class="aio-tooltip '.$uniqid.'" href = "'.$href.'" '.$target.' data-toggle="tooltip" data-placement="'.$tooltip_disp.'" title="'.$tooltip_text.'">';
					$link_sufix .= '</span>';
				}
			}
			
			/* position fix */
			if($icon_align == 'right')
				$icon_align_style .= 'text-align:right;';
			elseif($icon_align == 'center')
				$icon_align_style .= 'text-align:center;';
			else
				$icon_align_style .= 'text-align:left;';
			
			if($icon_type == 'custom'){
				$img = wp_get_attachment_image_src( $icon_img, 'large');
				if($icon_style !== 'none'){
					if($icon_color_bg !== '')
						$style .= 'background:'.$icon_color_bg.';';
				}
				if($icon_style == 'circle'){
					$el_class.= ' uavc-circle ';
				}
				if($icon_style == 'square'){
					$el_class.= ' uavc-square ';
				}
				if($icon_style == 'advanced' && $icon_border_style !== '' ){
					$style .= 'border-style:'.$icon_border_style.';';
					$style .= 'border-color:'.$icon_color_border.';';
					$style .= 'border-width:'.$icon_border_size.'px;';
					$style .= 'padding:'.$icon_border_spacing.'px;';
					$style .= 'border-radius:'.$icon_border_radius.'px;';
				}
				if(!empty($img[0])){
					$output .= "\n".$link_prefix.'<div class="aio-icon-img '.$el_class.'" style="font-size:'.$img_width.'px;'.$style.'" '.$css_trans.'>';
					$output .= "\n\t".'<img class="img-icon" src="'.$img[0].'"/>';	
					$output .= "\n".'</div>'.$link_sufix;
				}
				$output = $output;
			} else {
				if($icon_color !== '')
					$style .= 'color:'.$icon_color.';';
				if($icon_style !== 'none'){
					if($icon_color_bg !== '')
						$style .= 'background:'.$icon_color_bg.';';
				}
				if($icon_style == 'advanced'){
					$style .= 'border-style:'.$icon_border_style.';';
					$style .= 'border-color:'.$icon_color_border.';';
					$style .= 'border-width:'.$icon_border_size.'px;';
					$style .= 'width:'.$icon_border_spacing.'px;';
					$style .= 'height:'.$icon_border_spacing.'px;';
					$style .= 'line-height:'.$icon_border_spacing.'px;';
					$style .= 'border-radius:'.$icon_border_radius.'px;';
				}
				if($icon_size !== '')
					$style .='font-size:'.$icon_size.'px;';
				if($icon !== ""){
					$output .= "\n".$link_prefix.'<div class="aio-icon '.$icon_style.' '.$el_class.'" '.$css_trans.' style="'.$style.'">';				
					$output .= "\n\t".'<i class="'.$icon.'"></i>';	
					$output .= "\n".'</div>'.$link_sufix;
				}
				$output = $output;
			}
			if($tooltip_disp !== ""){
				$output .= '<script>
					jQuery(function () {
						jQuery(".'.$uniqid.'").bsf_tooltip("hide");
					})
				</script>';
			}
			/* alignment fix */
			if($icon_align !== ''){
				$output = '<div class="align-icon" style="'.$icon_align_style.'">'.$output.'</div>';
			}
			
			return $output;
		}
	}
}
if(class_exists('AIO_Just_Icon'))
{
	$AIO_Just_Icon = new AIO_Just_Icon;
}