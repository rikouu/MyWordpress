<?php
/*
* Module - Animation Block
*/
if(!class_exists('Ultimate_Animation')){
	class Ultimate_Animation{
		function __construct(){
			add_shortcode('ult_animation_block',array($this,'animate_shortcode'));
			add_action('admin_init',array($this,'animate_shortcode_mapper'));
		}/* end constructor*/
		function animate_shortcode($atts, $content=null){
			$output = $animation = $opacity = $animation_duration = $animation_delay = $animation_iteration_count = $inline_disp = $el_class = '';
			extract(shortcode_atts(array(
				"animation" => "",
				"opacity" => "",
				"animation_duration" => "",
				"animation_delay" => "",
				"animation_iteration_count" => "",
				"inline_disp" => "",
				"el_class" => "",
			),$atts));
			$style = $infi = $mobile_opt = '';
			$ultimate_animation = get_option('ultimate_animation');
			if($ultimate_animation == "enable"){
				$mobile_opt = 'ult-no-mobile';
			}

			if($inline_disp !== ''){
				$style .= 'display:inline-block;';
			}
			if($opacity == "set"){
				$style .= 'opacity:0;';
				$el_class .= 'ult-animate-viewport';
			}
			$inifinite_arr = array("InfiniteRotate", "InfiniteDangle","InfiniteSwing","InfinitePulse","InfiniteHorizontalShake","InfiniteBounce","InfiniteFlash",	"InfiniteTADA");
			if($animation_iteration_count == 0 || in_array($animation,$inifinite_arr)){
				$animation_iteration_count = 'infinite';
				$animation = 'infinite '.$animation;
			}
			$output .= '<div class="ult-animation '.$el_class.' '.$mobile_opt.'" data-animate="'.$animation.'" data-animation-delay="'.$animation_delay.'" data-animation-duration="'.$animation_duration.'" data-animation-iteration="'.$animation_iteration_count.'" style="'.$style.'">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			return $output;
		} /* end animate_shortcode()*/
		function animate_shortcode_mapper(){
			if(function_exists('vc_map')){
				vc_map( 
					array(
						"name" => __("动画块", "js_composer"),
						"base" => "ult_animation_block",
						"icon" => "animation_block",
						"class" => "animation_block",
						"as_parent" => array('except' => 'ult_animation_block'),
						"content_element" => true,
						"controls" => "full",
						"show_settings_on_create" => true,
						"category" => "Ultimate VC Addons",
						"description" => "Apply animations everywhere.",
						"params" => array(
							// add params same as with any other content element
							array(
								"type" => "animator",
								"class" => "",
								"heading" => __("动画 ","smile"),
								"param_name" => "animation",
								"value" => "",
								"description" => __("","smile"),
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("动画周期 ","smile"),
								"param_name" => "animation_duration",
								"value" => 3,
								"min" => 1,
								"max" => 100,
								"suffix" => "s",
								"description" => __("","smile"),
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("动画延迟 ","smile"),
								"param_name" => "animation_delay",
								"value" => 1,
								"min" => 1,
								"max" => 100,
								"suffix" => "s",
								"description" => __("","smile"),
						  	),
							array(
								"type" => "number",
								"class" => "",
								"heading" => __("动画的迭代计算","smile"),
								"param_name" => "animation_iteration_count",
								"value" => 1,
								"min" => 0,
								"max" => 100,
								"suffix" => "",
								"description" => __("0表示无限.没有必要如果无限动画被选中.","smile"),
						  	),
							array(
								"type" => "chk-switch",
								"class" => "",
								"heading" => __("视口的效果", "woocomposer"),
								"param_name" => "opacity",
								"admin_label" => true,
								"value" => "",
								"options" => array(
										"set" => array(
												"label" => "如果设置为yes,块和动画效果就会出现一次用户屏幕上的特定位置.",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "woocomposer"),
							),
							/*array(
								"type" => "chk-switch",
								"class" => "",
								"heading" => __("Inline Content", "woocomposer"),
								"param_name" => "inline_disp",
								"admin_label" => true,
								"value" => "",
								"options" => array(
										"inline" => array(
												"label" => "If set to yes, 'display:inline-block' CSS property will be applied",
												"on" => "Yes",
												"off" => "No",
											),
									),
								"description" => __("", "woocomposer"),
							),*/
							array(
								"type" => "textfield",
								"heading" => __("额外的类名", "js_composer"),
								"param_name" => "el_class",
								"description" => __("如果你想风格特定内容元素不同,然后使用这个字段添加一个类名,然后把它在你的css文件.", "js_composer")
							)
						),
						"js_view" => 'VcColumnView'
					)
				);/* end vc_map*/
			} /* end vc_map check*/
		}/*end animate_shortcode_mapper()*/
	} /* end class Ultimate_Animation*/
	// Instantiate the class
	new Ultimate_Animation;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_ult_animation_block extends WPBakeryShortCodesContainer {
		}
	}
}