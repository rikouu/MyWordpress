<?php
/*
Add-on: Ultimate Parallax Background for VC
Add-on URI: https://brainstormforce.com/demos/parallax/
Description: Display interactive image and video parallax background in visual composer row
Version: 1.0
*/
if(!class_exists('VC_Ultimate_Parallax')){
	class VC_Ultimate_Parallax{
		function __construct(){
			add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
			/*add_action('wp_enqueue_scripts',array($this,'front_scripts'),9999); */
			add_action('admin_init',array($this,'parallax_init'));
			add_filter('parallax_image_video',array($this,'parallax_shortcode'), 10, 2);
			if ( function_exists('add_shortcode_param'))
			{
				//add_shortcode_param('number' , array(&$this, 'number_settings_field' ) );
			}
			if ( function_exists('add_shortcode_param'))
			{
				add_shortcode_param('gradient' , array(&$this, 'gradient_picker' ) );
			}
		}/* end constructor */ 
		public static function parallax_shortcode($atts, $content){
			/* enqueue js */
			wp_enqueue_script('ultimate-appear');
			if(get_option('ultimate_row') == "enable"){
				wp_enqueue_script('ultimate-row-bg',plugins_url('../assets/js/',__FILE__).'ultimate_bg.js');
			}
			wp_enqueue_script('ultimate-custom');
			/* enqueue css */
			wp_enqueue_style('ultimate-animate');
			wp_enqueue_style('ultimate-style');			
			$bg_type = $bg_image = $bg_image_new = $bsf_img_repeat = $parallax_style = $video_opts = $video_url = $video_url_2 = $video_poster = $bg_image_size = $bg_image_posiiton = $u_video_url = $parallax_sense = $bg_cstm_size = $bg_override = $bg_img_attach = $u_start_time = $u_stop_time = $layer_image 			= $css = $animation_type = $horizontal_animation = $vertical_animation = $animation_speed = $animated_bg_color = $fadeout_row = $fadeout_start_effect = $parallax_content = $parallax_content_sense = $disable_on_mobile = $disable_on_mobile_img_parallax = "";
			extract( shortcode_atts( array(
			    "bg_type" => "",
				"bg_image" => "",
				"bg_image_new" => "",
				"bg_image_repeat" => "",
				'bg_image_size'=>"",
				"parallax_style" => "",
				"parallax_sense"=>"",
				"video_opts" => "",
				"bg_image_posiiton"=>"",
				"video_url" => "",
				"video_url_2" => "",
				"video_poster" => "",
				"u_video_url" =>"",
				"bg_cstm_size"=>"",
				"bg_override"=>"",
				"bg_img_attach" =>"",
				"u_start_time"=>"",
				"u_stop_time"=>"",
				"layer_image"=>"",
				"bg_grad"=>"",
				"bg_color_value" => "",
				"overlay_set"=>'',
				"overlay_color"=>'',				
				"bg_fade"=>"",
				"css" => "",
				"viewport_vdo" => "",
				"enable_controls" => "",
				"controls_color" => "",
				"animation_type" => "",
				"horizontal_animation" => "",
				"vertical_animation" => "",
				"animation_speed" => "",
				"animated_bg_color" => "",
				"fadeout_row" => "",
				"fadeout_start_effect" => "50",
				"parallax_content" => "",
				"parallax_content_sense" => "30",
				"disable_on_mobile" => "",
				"disable_on_mobile_img_parallax" => ""
			), $atts ) );			
			$html = $autoplay = $muted = $loop = $pos_suffix = $bg_img = '';
			
			if($disable_on_mobile != '')
				$disable_on_mobile = 'true';
			else
				$disable_on_mobile = 'false';
			
			if($disable_on_mobile_img_parallax != '')
				$disable_on_mobile_img_parallax = 'true';
			else
				$disable_on_mobile_img_parallax = 'false';
			
			$output = '<!-- Row Backgrounds -->';
			if($bg_image_new != ""){
				$bg_img_id = $bg_image_new;
			} elseif( $bg_image != ""){
				$bg_img_id = $bg_image;
			} else {
				if($css !== ""){
					$arr = explode('?id=', $css);
					if(isset($arr[1])){
						$arr = explode(')', $arr[1]);
						$bg_img_id = $arr[0];
					}
				}
			}
			if($bg_image_posiiton!=''){
				if(strpos($bg_image_posiiton, 'px')){
					$pos_suffix ='px';
				}
				elseif(strpos($bg_image_posiiton, 'em')){
					$pos_suffix ='em';
				}
				else{
					$pos_suffix='%';
				}
			}			
			if($bg_type== "no_bg"){
				$html .= '<div class="upb_no_bg" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
			}	
			elseif($bg_type == "image"){
				if($bg_image_size=='cstm'){
					if($bg_cstm_size!=''){
						$bg_image_size = $bg_cstm_size;
					}
				}
				if($parallax_style == 'vcpb-fs-jquery' || $parallax_style=="vcpb-mlvp-jquery"){
					 $imgs = explode(',',$layer_image);
					 $layer_image = array();
	                foreach ($imgs as $value) {
	                    $layer_image[] = wp_get_attachment_image_src($value,'full');
	                }
	                foreach ($layer_image as $key=>$value) {
	                    $bg_imgs[]=$layer_image[$key][0];
	                }
	                $html .= '<div class="upb_bg_img" data-ultimate-bg="'.implode(',', $bg_imgs).'" data-ultimate-bg-style="'.$parallax_style.'" data-bg-img-repeat="'.$bg_image_repeat.'" data-bg-img-size="'.$bg_image_size.'" data-bg-img-position="'.$bg_image_posiiton.'" data-parallx_sense="'.$parallax_sense.'" data-bg-override="'.$bg_override.'" data-bg_img_attach="'.$bg_img_attach.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
				}
				else{
					if($bg_img_id){
						if($animation_type == 'h')
							$animation = $horizontal_animation;
						else
							$animation = $vertical_animation;
						
						$bg_img = wp_get_attachment_image_src($bg_img_id,'full');
						$html .= '<div class="upb_bg_img" data-ultimate-bg="url('.$bg_img[0].')" data-image-id="'.$bg_img_id.'" data-ultimate-bg-style="'.$parallax_style.'" data-bg-img-repeat="'.$bg_image_repeat.'" data-bg-img-size="'.$bg_image_size.'" data-bg-img-position="'.$bg_image_posiiton.'" data-parallx_sense="'.$parallax_sense.'" data-bg-override="'.$bg_override.'" data-bg_img_attach="'.$bg_img_attach.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-bg-animation="'.$animation.'" data-bg-animation-type="'.$animation_type.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
					}
				}
			} elseif($bg_type == "video"){
				$v_opts = explode(",",$video_opts);
				if(is_array($v_opts)){
					foreach($v_opts as $opt){
						if($opt == "muted") $muted .= $opt;
						if($opt == "autoplay") $autoplay .= $opt;
						if($opt == "loop") $loop .= $opt;
					}
				}
				if($viewport_vdo != '')
					$enable_viewport_vdo = 'true';
				else
					$enable_viewport_vdo = 'false';
				$u_stop_time = ($u_stop_time!='')?$u_stop_time:0;
				$u_start_time = ($u_stop_time!='')?$u_start_time:0;
				$v_img = wp_get_attachment_image_src($video_poster,'full');				
				$html .= '<div class="upb_content_video" data-controls-color="'.$controls_color.'" data-controls="'.$enable_controls.'" data-viewport-video="'.$enable_viewport_vdo.'" data-ultimate-video="'.$video_url.'" data-ultimate-video2="'.$video_url_2.'" data-ultimate-video-muted="'.$muted.'" data-ultimate-video-loop="'.$loop.'" data-ultimate-video-poster="'.$v_img[0].'" data-ultimate-video-autoplay="autoplay" data-bg-override="'.$bg_override.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
			}
			elseif ($bg_type=='u_iframe') {
				//wp_enqueue_script('jquery.tublar',plugins_url('../assets/js/tubular.js',__FILE__));
				wp_enqueue_script('jquery.ytplayer',plugins_url('../assets/js/jquery.mb.YTPlayer.js',__FILE__));
				$v_opts = explode(",",$video_opts);
				$v_img = wp_get_attachment_image_src($video_poster,'full');
				if(is_array($v_opts)){
					foreach($v_opts as $opt){
						if($opt == "muted") $muted .= $opt;
						if($opt == "autoplay") $autoplay .= $opt;
						if($opt == "loop") $loop .= $opt;
					}
				}
				if($viewport_vdo != '')
					$enable_viewport_vdo = 'true';
				else
					$enable_viewport_vdo = 'false';
				
				$html .= '<div class="upb_content_iframe" data-controls="'.$enable_controls.'" data-viewport-video="'.$enable_viewport_vdo.'" data-ultimate-video="'.$u_video_url.'" data-bg-override="'.$bg_override.'" data-start-time="'.$u_start_time.'" data-stop-time="'.$u_stop_time.'" data-ultimate-video-muted="'.$muted.'" data-ultimate-video-loop="'.$loop.'" data-ultimate-video-poster="'.$v_img[0].'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'"  data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
			}
			elseif ($bg_type == 'grad') {
				$html .= '<div class="upb_grad" data-grad="'.$bg_grad.'" data-bg-override="'.$bg_override.'" data-upb-overlay-color="'.$overlay_color.'" data-upb-bg-animation="'.$bg_fade.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
			}
			elseif($bg_type == 'bg_color'){
				$html .= '<div class="upb_color" data-bg-override="'.$bg_override.'" data-bg-color="'.$bg_color_value.'" data-fadeout="'.$fadeout_row.'" data-fadeout-percentage="'.$fadeout_start_effect.'" data-parallax-content="'.$parallax_content.'" data-parallax-content-sense="'.$parallax_content_sense.'" data-row-effect-mobile-disable="'.$disable_on_mobile.'" data-img-parallax-mobile-disable="'.$disable_on_mobile_img_parallax.'"></div>';
			}
			$output .= $html;
			if($bg_type=='theme_default'){
				return false;
			}else{
				self::front_scripts();
				return $output;
			}
		} /* end parallax_shortcode */
		function parallax_init(){
			$group_name = 'Background';
			$group_effects = 'Effect';
			if(function_exists('vc_remove_param')){
				//vc_remove_param('vc_row','bg_image');
				vc_remove_param('vc_row','bg_image_repeat');
			}
			if(function_exists('vc_add_param')){
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"admin_label" => true,
						"heading" => __("Background Style", "upb_parallax"),
						"param_name" => "bg_type",
						"value" => array(
							__("默认","upb_parallax") => "no_bg",
							__("单色","upb_parallax") => "bg_color",
							__("渐变色","upb_parallax") => "grad",
							__("图像/视差","upb_parallax") => "image",
							__("YouTube 视频","upb_parallax") => "u_iframe",
							__("Hosted 视频","upb_parallax") => "video",
							//__("Animated Background","upb_parallax") => "animated",
							//__("No","upb_parallax") => "no_bg",
							),
						"description" => __("你想选择什么样的背景这一行.不确定吗?看到了 <a href='https://www.youtube.com/watch?v=Qxs8R-uaMWk&list=PL1kzJGWGPrW981u5caHy6Kc9I1bG1POOx' target='_blank'>Video Tutorials</a>", "upb_parallax"),
						"group" => $group_name,
					)
				);				
				vc_add_param('vc_row',array(
						"type" => "gradient",
						"class" => "",
						"heading" => __("渐变背景", "upb_parallax"),						
						"param_name" => "bg_grad",
						"description" => __('至少应该选择两个颜色点. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', "upb_parallax"),
						"dependency" => array("element" => "bg_type","value" => array("grad")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("背景颜色", "upb_parallax"),						
						"param_name" => "bg_color_value",
						//"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', "upb_parallax"),
						"dependency" => array("element" => "bg_type","value" => array("bg_color")),
						"group" => $group_name,
					)
				);
				vc_add_param("vc_row", array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("视差风格","upb_parallax"),
					"param_name" => "parallax_style",
					"value" => array(
						__("简单的背景图像","upb_parallax") => "vcpb-default",
						__("自动移动背景","upb_parallax") => "vcpb-animated",
						__("垂直视差滚动","upb_parallax") => "vcpb-vz-jquery",
						__("水平视差滚动","upb_parallax") => "vcpb-hz-jquery",
						__("交互式视差在鼠标悬停","upb_parallax") => "vcpb-fs-jquery",
						__("多层垂直视差","upb_parallax") => "vcpb-mlvp-jquery",
					), 
					"description" => __("选择你喜欢的风格的背景.","upb_parallax"),
					"dependency" => array("element" => "bg_type","value" => array("image")),
					"group" => $group_name,
				));	
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("背景影像", "upb_parallax"),
						"param_name" => "bg_image_new",
						"value" => "",
						"description" => __("上传或从媒体选择背景图片画廊.", "upb_parallax"),
						"dependency" => array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery",)),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_images",
						"class" => "",
						"heading" => __("层图像", "upb_parallax"),
						"param_name" => "layer_image",
						"value" => "",
						"description" => __("上传或从媒体选择背景图片画廊.", "upb_parallax"),
						"dependency" => array("element" => "parallax_style","value" => array("vcpb-fs-jquery","vcpb-mlvp-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("背景图片重复", "upb_parallax"),
						"param_name" => "bg_image_repeat",
						"value" => array(
								__("不重复 ", "upb_parallax") => "no-repeat",
								__("重复", "upb_parallax") => "repeat",
								__("重复X", "upb_parallax") => "repeat-x",
								__("重复 Y", "upb_parallax") => "repeat-y",
							),
						"description" => __("Options to control repeatation of the background image. Learn on <a href='http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat' target='_blank'>W3School</a>", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-fix","vcpb-vz-jquery","vcpb-hz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("背景图片大小", "upb_parallax"),
						"param_name" => "bg_image_size",
						"value" => array(
								__("覆盖 - 图像尽可能大", "upb_parallax") => "cover",
								__("包含  - 图像将试图把它装进集装箱", "upb_parallax") => "contain",
								__("最初", "upb_parallax") => "initial",
								/*__("Automatic", "upb_parallax") => "automatic", */
							),
						"description" => __("选项来控制背景图片的大小. Learn on <a href='http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-size&preval=50%25' target='_blank'>W3School</a>", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-fix","vcpb-vz-jquery","vcpb-hz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("自定义背景图片大小", "upb_parallax"),
						"param_name" => "bg_cstm_size",
						"value" =>"",
						"description" => __("您可以使用初始,继承或任何与px, em, %, etc. 例- 100px 100px", "upb_parallax"),
						"dependency" => Array("element" => "bg_image_size","value" => array("cstm")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("滚动效果", "upb_parallax"),
						"param_name" => "bg_img_attach",
						"value" => array(								
								__("固定的位置", "upb_parallax") => "fixed",
								__("移动与内容", "upb_parallax") => "scroll",								
							),
						"description" => __("选择设置背景图像是否固定或与页面的其余部分滚动.", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-animated","vcpb-hz-jquery","vcpb-vz-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("视差速度", "upb_parallax"),
						"param_name" => "parallax_sense",
						"value" =>"30",
						"min"=>"1",
						"max"=>"100",
						"description" => __("控制速度的视差. 输入1到100之间的值", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-vz-jquery","vcpb-animated","vcpb-hz-jquery","vcpb-vs-jquery","vcpb-hs-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("背景图像Posiiton", "upb_parallax"),
						"param_name" => "bg_image_posiiton",
						"value" =>"",	
						"description" => __("您可以使用任意数量的px, em, %, etc. 例- 100px 100px.", "upb_parallax"),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-default","vcpb-fix")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("动画类型", "upb_parallax"),
						"param_name" => "animation_type",
						"value" => array(
								__("水平 ", "upb_parallax") => "h",
								__("垂直 ", "upb_parallax") => "v",
							),
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("动画方向", "upb_parallax"),
						"param_name" => "horizontal_animation",
						"value" => array(
								__("从左到右", "upb_parallax") => "left-animation",
								__("从右往左 ", "upb_parallax") => "right-animation",
							),
						"dependency" => Array("element" => "animation_type","value" => array("h")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("动画方向", "upb_parallax"),
						"param_name" => "vertical_animation",
						"value" => array(
								__("从上到下", "upb_parallax") => "top-animation",
								__("下至上", "upb_parallax") => "bottom-animation",
							),
						"dependency" => Array("element" => "animation_type","value" => array("v")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("MP4格式的视频链接", "upb_parallax"),
						"param_name" => "video_url",
						"value" => "",
						/*"description" => __("Enter your video URL. You can upload a video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>, if not done already.", "upb_parallax"),*/
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("WebM / Ogg格式的视频链接", "upb_parallax"),
						"param_name" => "video_url_2",
						"value" => "",
						"description" => __("IE, Chrome & Safari <a href='http://www.w3schools.com/html/html5_video.asp' target='_blank'>support</a> MP4 format, while Firefox & Opera prefer WebM / Ogg formats. You can upload the video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("进入YouTube视频的URL", "upb_parallax"),
						"param_name" => "u_video_url",
						"value" => "",
						"description" => __("进入YouTube url. 例 - YouTube (https://www.youtube.com/watch?v=tSqJIIcxKZM) ", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("额外选项 ", "upb_parallax"),
						"param_name" => "video_opts",
						"value" => array(
								__("循环","upb_parallax") => "loop",
								__("柔和","upb_parallax") => "muted",
							),
						/*"description" => __("Select options for the video.", "upb_parallax"),*/
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "attach_image",
						"class" => "",
						"heading" => __("占位符图像", "upb_parallax"),
						"param_name" => "video_poster",
						"value" => "",
						"description" => __("图像占位符显示在案例背景视频受到限制 (Ex - on iOS devices).", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("开始时间", "upb_parallax"),
						"param_name" => "u_start_time",
						"value" => "",
						"suffix" => "seconds",
						/*"description" => __("Enter time in seconds from where video start to play.", "upb_parallax"),*/
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("停止时间", "upb_parallax"),
						"param_name" => "u_stop_time",
						"value" => "",
						"suffix" => "seconds",
						"description" => __("你可以启动/停止视频在任何时候你想.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("播放视频只有当视窗", "upb_parallax"),
						"param_name" => "viewport_vdo",
						//"admin_label" => true,
						"value" => "viewport_play",
						"options" => array(
								"viewport_play" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"description" => __("视频将只有当用户屏幕上的特定的位置.一旦用户滚动了,视频将会暂停.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video","u_iframe")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("显示控制条 ", "upb_parallax"),
						"param_name" => "enable_controls",
						//"admin_label" => true,
						"value" => "display_control",
						"options" => array(
								"display_control" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"description" => __("显示视频的播放/暂停控制右下方位置.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("video")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("颜色的控制图标", "upb_parallax"),
						"param_name" => "controls_color",
						//"admin_label" => true,
						//"description" => __("Display play / pause controls for the video on bottom right position.", "upb_parallax"),
						"dependency" => Array("element" => "enable_controls","value" => array("display_control")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("简单的视差", "upb_parallax"),
						"param_name" => "parallax_content",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"parallax_content_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						"description" => __("如果启用,里面的元素,慢慢将作为用户卷轴.", "upb_parallax")
					)
				);
				vc_add_param('vc_row',array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("视差速度", "upb_parallax"),
						"param_name" => "parallax_content_sense",
						//"admin_label" => true,
						"value" => "30",
						"group" => $group_effects,
						"description" => __("输入值在0到100之间", "upb_parallax")
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("额外效果", "upb_parallax"),
						"param_name" => "fadeout_row",
						//"admin_label" => true,
						"value" => "",
						"options" => array(
								"fadeout_row_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						"description" => __("如果启用,里面的内容行也会慢慢淡出的用户在向下滚动.", "upb_parallax")
					)
				);
				vc_add_param('vc_row',array(
						"type" => "number",
						"class" => "",
						"heading" => __("视口的位置", "upb_parallax"),
						"param_name" => "fadeout_start_effect",
						"suffix" => "%",
						//"admin_label" => true,
						"value" => "30",
						"group" => $group_effects,
						"description" => __("区域的屏幕从上淡出效果生效一次行完全是在那个地区.", "upb_parallax"),
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("禁用对手机的影响", "upb_parallax"),
						"param_name" => "disable_on_mobile",
						//"admin_label" => true,
						"value" => "disable_on_mobile_value",
						"options" => array(
								"disable_on_mobile_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_effects,
						
					)
				);

				/*
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Show Background Overlay", "upb_parallax"),
						"param_name" => "overlay_set",
						"value" => array(							
							"Hide"=>"overlay_hide",
							"Show"=>"overlay_show",
							),
						"description" => __("Hide or Show overlay on background images.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("image","video","grad")),
					)
				);
				vc_add_param('vc_row',array(
						"type" => "colorpicker",
						"class" => "",
						"heading" => __("Overlay Color", "upb_parallax"),
						"param_name" => "overlay_color",
						"value" => "",
						"description" => __("Select color for background overlay.", "upb_parallax"),
						"dependency" => Array("element" => "overlay_set","value" => array("overlay_show")),
					)
				);				
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Apply Row Fade Animation", "upb_parallax"),
						"param_name" => "bg_fade",
						"value" => array(														
							"No"=>"upb_default_animation",
							"Yes"=>"upb_fade_animation",
							),
						"description" => __("Row will fade slightly when scrolled out of window.", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe","image","video","grad")),
					)
				);*/
				vc_add_param('vc_row',array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("背景覆盖(描述)", "upb_parallax"),
						"param_name" => "bg_override",
						"value" =>array(
							"Default Width"=>"0",
							"Apply 1st parent element's width"=>"1",
							"Apply 2nd parent element's width"=>"2",
							"Apply 3rd parent element's width"=>"3",
							"Apply 4th parent element's width"=>"4",
							"Apply 5th parent element's width"=>"5",
							"Apply 6th parent element's width"=>"6",
							"Apply 7th parent element's width"=>"7",
							"Apply 8th parent element's width"=>"8",
							"Apply 9th parent element's width"=>"9",
							"Full Width "=>"full",
							"Maximum Full Width"=>"ex-full",
							"Browser Full Dimension"=>"browser_size"
						),
						"description" => __("默认情况下,背景将给视觉作曲家行。然而,在某些情况下,根据你的主题的CSS - 它可能不适合你希望它的容器.在这种情况下你要选择适当的值,您期望的输出..", "upb_parallax"),
						"dependency" => Array("element" => "bg_type","value" => array("u_iframe","image","video","grad","bg_color","animated")),
						"group" => $group_name,
					)
				);
				vc_add_param('vc_row',array(
						"type" => "chk-switch",
						"class" => "",
						"heading" => __("禁用视差在移动", "upb_parallax"),
						"param_name" => "disable_on_mobile_img_parallax",
						//"admin_label" => true,
						"value" => "disable_on_mobile_img_parallax_value",
						"options" => array(
								"disable_on_mobile_img_parallax_value" => array(
									"label" => "",
									"on" => "Yes",
									"off" => "No",
								)
							),
						"group" => $group_name,
						"dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
					)
				);
			}
		} /* parallax_init*/
		function gradient_picker($settings, $value)
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$color1 = isset($settings['color1']) ? $settings['color1'] : ' ';
			$color2 = isset($settings['color2']) ? $settings['color2'] : ' ';			
			$class = isset($settings['class']) ? $settings['class'] : '';
			$uni = uniqid();
			$output = '<div class="vc_ug_control" data-uniqid="'.$uni.'" data-color1="'.$color1.'" data-color2="'.$color2.'">
						<div class="grad_trgt" id="grad_target'.$uni.'"></div>
						<div class="grad_hold" id="grad_hold'.$uni.'"></div>';
			$output .= '<input id="grad_val'.$uni.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' vc_ug_gradient" name="' . $param_name . '"  style="display:none"  value="'.$value.'" '.$dependency.'/></div>';			
			?>
				<script type="text/javascript">
				jQuery(document).ready(function(){					
						function gradient_pre_defined(){
							jQuery('.vc_ug_control').each(function(){
								var uni = jQuery(this).data('uniqid');
								var hid = "#grad_hold"+uni;
								var did = "#grad_target"+uni;
								var tid = "#grad_val"+uni;
								var prev_col = jQuery(tid).val();
								if(prev_col!=''){
									var p_l = prev_col.indexOf('-webkit-linear-gradient(top,');
									prev_col = prev_col.substring(p_l+28);								
									p_l = prev_col.indexOf(');');
									prev_col = prev_col.substring(0,p_l);
								}else{
									prev_col ="#fbfbfb 0%, #e3e3e3 50%, #c2c2c2 100%";
									//prev_col ="";
								}
								jQuery(hid).ClassyGradient({			
							        target:did,
							         gradient: prev_col,
							        onChange: function(stringGradient,cssGradient) {
							        	cssGradient = cssGradient.replace('url(data:image/svg+xml;base64,','');
							        	var e_pos = cssGradient.indexOf(';');
							        	cssGradient = cssGradient.substring(e_pos+1);							        	
							        	if(jQuery(tid).parents('.wpb_el_type_gradient').css('display')=='none'){
											//jQuery(tid).val('');	
											cssGradient='';
										}
										jQuery(tid).val(cssGradient);
							        },
							        onInit: function(){
							        	//console.log(jQuery(tid).val())
							        }
								});
								jQuery('.colorpicker').css('z-index','999999');
							})
						}	
						gradient_pre_defined();					
				})
				</script>
			<?php
			return $output;
		}
		function number_settings_field($settings, $value)
		{
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
			return $output;
		}
		function admin_scripts(){
			wp_enqueue_script('jquery.colorpicker',plugins_url('../admin/js/jquery.colorpicker.js',__FILE__));
			wp_enqueue_script('jquery.classygradient',plugins_url('../admin/js/jquery.classygradient.min.js',__FILE__));			
			wp_enqueue_style('classycolorpicker.style',plugins_url('../admin/css/jquery.colorpicker.css',__FILE__));
			wp_enqueue_style('classygradient.style',plugins_url('../admin/css/jquery.classygradient.min.css',__FILE__));
		}/* end admin_scripts */
		static function front_scripts(){
			/* wp_enqueue_script('jquery.video_bg',plugins_url('../assets/js/ultimate_bg.js',__FILE__),'1.0',array('jQuery')); */	
			wp_enqueue_script('jquery.shake',plugins_url('../assets/js/jparallax.js',__FILE__));
			wp_enqueue_script('jquery.vhparallax',plugins_url('../assets/js/jquery.vhparallax.js',__FILE__));			
			wp_enqueue_style('background-style',plugins_url('../assets/css/background-style.css',__FILE__));
			/* wp_enqueue_script('jquery.tublar',plugins_url('../assets/js/tubular.js',__FILE__)); */
		} /* end front_scripts */
	}
	new VC_Ultimate_Parallax;
}
$ultimate_row = get_option('ultimate_row');
if($ultimate_row == "enable"){
	if ( !function_exists( 'vc_theme_after_vc_row' ) ) {
		function vc_theme_after_vc_row($atts, $content = null) {
			 return VC_Ultimate_Parallax::parallax_shortcode($atts, $content);
			 //return apply_filters( 'parallax_image_video', '', $atts, $content );
			 //return '<div><p>Append this div before shortcode</p></div>';
		}
	}
}