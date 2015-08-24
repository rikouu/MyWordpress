<?php
/*
* Add-on Name: Stats Counter for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('AIO_Stats_Counter'))
{
	class AIO_Stats_Counter
	{
		// constructor
		function __construct()
		{
			add_action('admin_init',array($this,'counter_init'));
			add_shortcode('stat_counter',array($this,'counter_shortcode'));
		}
		// initialize the mapping function
		function counter_init()
		{
			if(function_exists('vc_map'))
			{
				// map with visual
				vc_map(
					array(
					   "name" => __("柜台"),
					   "base" => "stat_counter",
					   "class" => "vc_stats_counter",
					   "icon" => "vc_icon_stats",
					   "category" => __("Ultimate VC Addons",'smile'),
					   "description" => __("你的里程碑,成就, etc.","smile"),
					   "params" => array(
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("图标显示:", "smile"),
								"param_name" => "icon_type",
								"value" => array(
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
								"description" => __("单击并选择您选择的图标.如果你不能找到一个适合你的目的,你可以 <a href='admin.php' target='_blank'>在这里添加新</a>.", "flip-box"),
								"dependency" => Array("element" => "icon_type","value" => array("selector")),
							),
							array(
								"type" => "attach_image",
								"class" => "",
								"heading" => __("上传图片图标:", "smile"),
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
								//"dependency" => Array("element" => "icon_type","value" => array("selector")),
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
									"Solid" => "solid",
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
								"heading" => __("边缘宽度 ", "smile"),
								"param_name" => "icon_border_size",
								"value" => 1,
								"min" => 1,
								"max" => 10,
								"suffix" => "px",
								"description" => __("边缘的厚度.", "smile"),
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
								"description" => __("0像素值将创建一个广场边界. 当你增加价值,形状圆内转换缓慢. (例 500 pixels).", "smile"),
								"dependency" => Array("element" => "icon_border_style", "not_empty" => true),
							),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("背景的大小", "smile"),
								"param_name" => "icon_border_spacing",
								"value" => 50,
								"min" => 0,
								"max" => 500,
								"suffix" => "px",
								"description" => __("间距从中心图标到边界的边界/背景", "smile"),
								"dependency" => Array("element" => "icon_style", "value" => array("advanced")),
							),
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("动画 ","smile"),
								"param_name" => "icon_animation",
								"value" => array(
							 		__("没有动画","smile") => "",
									__("旋转","smile") => "swing",
									__("脉冲","smile") => "pulse",
									__("淡入","smile") => "fadeIn",
									__("向上渐入","smile") => "fadeInUp",
									__("向下渐入","smile") => "fadeInDown",
									__("向左渐入","smile") => "fadeInLeft",
									__("向右渐入","smile") => "fadeInRight",
									__("向上渐入长时间","smile") => "fadeInUpBig",
									__("向下渐入长时间","smile") => "fadeInDownBig",
									__("向左渐入长时间","smile") => "fadeInLeftBig",
									__("向右渐入长时间","smile") => "fadeInRightBig",
									__("向下滑动","smile") => "slideInDown",
									__("向左滑动","smile") => "slideInLeft",
									__("向左滑动t","smile") => "slideInLeft",
									__("弹跳","smile") => "bounceIn",
									__("向上弹跳","smile") => "bounceInUp",
									__("向下弹跳","smile") => "bounceInDown",
									__("向左弹跳","smile") => "bounceInLeft",
									__("向右弹跳","smile") => "bounceInRight",
									__("旋转","smile") => "rotateIn",
									__("光速","smile") => "lightSpeedIn",
									__("滚动","smile") => "rollIn",
								),
								"description" => __("喜欢CSS3动画吗?我们有几个选项!","smile")
						  	),
						  array(
							 "type" => "dropdown",
							 "class" => "",
							 "heading" => __("图标位置", "icon-box"),
							 "param_name" => "icon_position",
							 "value" => array(
							 		'Top' => 'top',
									'Right' => 'right',
									'Left' => 'left',	
							 		),							
							 "description" => __("输入图标的位置", "icon-box")
							 ),
						  array(
							 "type" => "textfield",
							 "class" => "",
							 "heading" => __("计数器的标题 ", "smile"),
							 "param_name" => "counter_title",
							 "admin_label" => true,
							 "value" => "",
							 "description" => __("为统计计数器输入标题块", "smile")
						  ),
						  array(
							 "type" => "textfield",
							 "class" => "",
							 "heading" => __("对应价值", "smile"),
							 "param_name" => "counter_value",
							 "value" => "1250",
							 "description" => __("没有任何特殊字符输入数字计数器.你可以输入一个十进制数. 例 12.76", "smile")
						  ),
						  array(
							 "type" => "textfield",
							 "class" => "",
							 "heading" => __("数字分隔符", "smile"),
							 "param_name" => "counter_sep",
							 "value" => ",",
							 "description" => __("为thousanda输入字符分隔符. 例. ',' will separate 125000 into 125,000", "smile")
						  ),
						  array(
							 "type" => "textfield",
							 "class" => "",
							 "heading" => __("小数点替换", "smile"),
							 "param_name" => "counter_decimal",
							 "value" => ".",
							 "description" => __("你输入一个十进制数吗(Eg - 12.76) 小数点  '.' 将被替换为价值上面,你将进入.", "smile"),
						  ),
						  array(
							 "type" => "textfield",
							 "class" => "",
							 "heading" => __("计数器值的前缀", "smile"),
							 "param_name" => "counter_prefix",
							 "value" => "",
							 "description" => __("为计数器值输入前缀", "smile")
						  ),
						  array(
							 "type" => "textfield",
							 "class" => "",
							 "heading" => __("计数器值后缀", "smile"),
							 "param_name" => "counter_suffix",
							 "value" => "",
							 "description" => __("为计数器值输入后缀", "smile")
						  ),
						  array(
								"type" => "number",
								"class" => "",
								"heading" => __("计数管轧制时间", "smile"),
								"param_name" => "speed",
								"value" => 3,
								"min" => 1,
								"max" => 10,
								"suffix" => "seconds",
								"description" => __("多少秒计数器应该卷?", "smile")
							),
						  array(
								"type" => "number",
								"class" => "",
								"heading" => __("标题字体大小", "smile"),
								"param_name" => "font_size_title",
								"value" => 18,
								"min" => 10,
								"max" => 72,
								"suffix" => "px",
								"description" => __("输入值的像素.", "smile")
							),
						  array(
								"type" => "number",
								"class" => "",
								"heading" => __("计数器字体大小", "smile"),
								"param_name" => "font_size_counter",
								"value" => 28,
								"min" => 12,
								"max" => 72,
								"suffix" => "px",
								"description" => __("输入值的像素.", "smile")
							),
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("计数器文本颜色", "smile"),
								"param_name" => "counter_color_txt",
								"value" => "",
								"description" => __("选择文本颜色计数器标题和数字.", "smile"),	
							),
							array(
								"type" => "textfield",
								"class" => "",
								"heading" => __("额外的类",  "smile"),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("添加额外的类名,将被应用到图标的过程,并且您可以使用这个类为你定制.",  "smile"),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function for stats counter
		function counter_shortcode($atts)
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
			wp_enqueue_script('front-js',plugins_url('../assets/js/countUp.js',__FILE__));
			wp_enqueue_style('stats-counter-style',plugins_url('../assets/css/',__FILE__).'stats-counter.css');
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $icon_link = $el_class = $icon_animation = $counter_title = $counter_value = $icon_position = $counter_style = $font_size_title = $font_size_counter = $counter_font = $title_font = $speed = $el_class = $counter_sep = $counter_suffix = $counter_prefix = $counter_decimal = $counter_color_txt = '';
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
				'counter_title' => '',
				'counter_value' => '',
				'counter_sep' => '',
				'counter_suffix' => '',
				'counter_prefix' => '',
				'counter_decimal' => '',
				'icon_position'=>'',
				'counter_style'=>'',
				'speed'=>'',
				'font_size_title' => '',
				'font_size_counter' => '',
				'counter_color_txt' => '',
				'el_class'=>'',
			),$atts));			 
			$class = $style = '';
			$stats_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_link="'.$icon_link.'" icon_animation="'.$icon_animation.'"]');
			if($counter_color_txt !== ''){
				$counter_color = 'color:'.$counter_color_txt.';';
			} else {
				$counter_color = '';
			}
			if($icon_color != '')
				$style.='color:'.$icon_color.';';
			if($icon_animation !== 'none')
			{
				$css_trans = 'data-animation="'.$icon_animation.'" data-animation-delay="03"';
			}
			$counter_font = 'font-size:'.$font_size_counter.'px;';
			$title_font = 'font-size:'.$font_size_title.'px;';
			if($counter_style !=''){
				$class = $counter_style;
				if(strpos($counter_style, 'no_bg')){
					$style.= "border:2px solid ".$counter_icon_bg_color.';';
				}
				elseif(strpos($counter_style, 'with_bg')){
					if($counter_icon_bg_color != '')
						$style.='background:'.$counter_icon_bg_color.';';
				}
			}
			if($el_class != '')
				$class.= ' '.$el_class;
			$ic_position = 'stats-'.$icon_position;
			$ic_class = 'aio-icon-'.$icon_position;
			$output = '<div class="stats-block '.$ic_position.' '.$class.'">';
				//$output .= '<div class="stats-icon" style="'.$style.'">
				//				<i class="'.$stats_icon.'"></i>
				//			</div>';
				$id = 'counter_'.uniqid();
				if($counter_sep == ""){
					$counter_sep = 'none';
				}
				if($counter_decimal == ""){
					$counter_decimal = 'none';
				}
				if($icon_position !== "right")
					$output .= '<div class="'.$ic_class.'">'.$stats_icon.'</div>';
				$output .= '<div class="stats-desc">';
					if($counter_prefix !== ''){
						$output .= '<div class="counter_prefix" style="'.$counter_font.'">'.$counter_prefix.'</div>';
					}
					$output .= '<div id="'.$id.'" data-id="'.$id.'" class="stats-number" style="'.$counter_font.' '.$counter_color.'" data-speed="'.$speed.'" data-counter-value="'.$counter_value.'" data-separator="'.$counter_sep.'" data-decimal="'.$counter_decimal.'">0</div>';
					if($counter_suffix !== ''){
						$output .= '<div class="counter_suffix" style="'.$counter_font.' '.$counter_color.'">'.$counter_suffix.'</div>';
					}
					$output .= '<div class="stats-text" style="'.$title_font.' '.$counter_color.'">'.$counter_title.'</div>';
				$output .= '</div>';
				if($icon_position == "right")
					$output .= '<div class="'.$ic_class.'">'.$stats_icon.'</div>';
			$output .= '</div>';				
			return $output;		
		}
	}
}
if(class_exists('AIO_Stats_Counter'))
{
	$AIO_Stats_Counter = new AIO_Stats_Counter;
}