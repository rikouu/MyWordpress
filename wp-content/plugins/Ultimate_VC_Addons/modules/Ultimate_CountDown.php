<?php
/*
* Add-on Name: CountDown for Visual Composer
* Add-on URI: http://dev.brainstormforce.com
*/
if(!class_exists('Ultimate_CountDown'))
{
	class Ultimate_CountDown
	{
		function __construct()
		{
			add_action('admin_init',array($this,'countdown_init'));
			add_shortcode('ult_countdown',array($this,'countdown_shortcode'));
			add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
		}
	   function admin_scripts() {
	   	wp_enqueue_script('jquery.datetimep',plugins_url('../admin/js/bootstrap-datetimepicker.min.js',__FILE__),'1.0','jQuery',true);			
			wp_enqueue_style('colorpicker.style',plugins_url('../admin/css/bootstrap-datetimepicker.min.css',__FILE__));
	   }
		function countdown_init()
		{
			if(function_exists('vc_map'))
			{
				vc_map(
					array(
					   "name" => __("倒计时"),
					   "base" => "ult_countdown",
					   "class" => "vc_countdown",
					   "icon" => "vc_countdown",
					   "category" => __("旗舰版  VC 扩展 ","smile"),
					   "description" => __("定时器.","smile"),
					   "params" => array(
					   		array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("倒数计时器风格", "smile"),
								"param_name" => "count_style",
								"value" => array(
										__("数字和单位","smile") => "ult-cd-s1",
										__("数字和单位上下","smile") => "ult-cd-s2",
									),
								"group" => "General Settings",
								//"description" => __("Select style for countdown timer.", "smile"),
							),
							array(
						   		"type" => "datetimepicker",
								"class" => "",
								"heading" => __("目标时间倒计时", "smile"),
								"param_name" => "datetime",
								"value" => "", 
								"description" => __("日期和时间格式 (yyyy/mm/dd hh:mm:ss).", "smile"),
								"group" => "General Settings",
							),	
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("倒数计时器取决于", "smile"),
								"param_name" => "ult_tz",
								"value" => array(
										__("WordPress定义时区","smile") => "ult-wptz",
										__("用户系统时区","smile") => "ult-usrtz",
									),
								//"description" => __("Select style for countdown timer.", "smile"),
								"group" => "General Settings",
							),						
							array(
						   		"type" => "checkbox",
								"class" => "",
								"heading" => __("选择显示在倒数计时器时间单位", "smile"),
								"param_name" => "countdown_opts",
								"value" => array(
										__("年","smile") => "syear",
										__("月份","smile") => "smonth",
										__("周","smile") => "sweek",
										__("天","smile") => "sday",										
										__("小时","smile") => "shr",
										__("分钟","smile") => "smin",
										__("秒钟 ","smile") => "ssec",										
									),
								//"description" => __("Select options for the video.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("定时器数字文本颜色", "smile"),
								"param_name" => "tick_col",
								"value" => "",
								//"description" => __("Text color for time ticks.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("定时器数字文本大小", "smile"),
								"param_name" => "tick_size",
								"suffix"=>"px",
								"min"=>"0",
								"value" => "36",
								//"description" => __("Font size of tick text.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("定时器数字文本样式", "smile"),
								"param_name" => "tick_style",								
								"value" => array(
												"Normal"=>"",
												"Bold"=>"bold",
												"Italic"=>"italic",
												"Bold & Italic"=>"boldnitalic",
											),
								//"description" => __("Font size of tick text.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("定时器单元文本颜色", "smile"),
								"param_name" => "tick_sep_col",
								"value" => "",
								//"description" => __("Text color for time ticks Period.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("定时器单元文本大小", "smile"),
								"param_name" => "tick_sep_size",
								"value" => "13",
								"suffix"=>"px",
								"min"=>"0",
								//"description" => __("Font size of tick text Period.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("定时器单元文本样式", "smile"),
								"param_name" => "tick_sep_style",
								"value" => array(
												"Normal"=>"",
												"Bold"=>"bold",
												"Italic"=>"italic",
												"Bold & Italic"=>"boldnitalic",
											),
								//"description" => __("Font size of tick text.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "dropdown",
								"class" => "",
								"heading" => __("定时器位边框样式", "smile"),
								"param_name" => "br_style",
								"value" => array(
											"None"=>'',
											"Solid"=>"solid",
											"Dashed"=>"dashed",
											"Dotted"=>"dotted",
											"Double"=>"double",
											"Inset"=>"inset",
											"Outset"=>"outset",
											),
								//"description" => __("Border-style.", "smile"),
								"group" => "General Settings",								
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("定时器位边界大小", "smile"),
								"param_name" => "br_size",
								"value" => "",
								"min"=>"0",
								"suffix"=>"px",
								//"description" => __("Border-size.", "smile"),
								"dependency" => Array("element"=>"br_style","value"=>array("solid","dotted","dashed","double","inset","outset",)),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("定时器位边框颜色", "smile"),
								"param_name" => "br_color",
								"value" => "",
								//"description" => __("Text color for time ticks Period.", "smile"),
								"dependency" => Array("element"=>"br_style","value"=>array("solid","dotted","dashed","double","inset","outset",)),
								"group" => "General Settings",
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("定时器位边界半径", "smile"),
								"param_name" => "br_radius",
								"value" => "",
								"min"=>"0",
								"suffix"=>"px",
								//"description" => __("Border-Time Radius.", "smile"),
								"dependency" => Array("element"=>"br_style","value"=>array("solid","dotted","dashed","double","inset","outset",)),
								"group" => "General Settings",
							),
							array(
						   		"type" => "colorpicker",
								"class" => "",
								"heading" => __("定时器数字背景颜色", "smile"),
								"param_name" => "timer_bg_color",
								"value" => "",
								//"description" => __("Background-Color.", "smile"),
								"group" => "General Settings",								
							),
							array(
						   		"type" => "number",
								"class" => "",
								"heading" => __("定时器数字背景大小", "smile"),
								"param_name" => "br_time_space",
								"min"=>"0",
								"value" => "0",
								"suffix"=>"px",
								//"description" => __("Border-Timer Space.", "smile"),
								"group" => "General Settings",
							),							
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("额外的类别", "smile"),
								"param_name" => "el_class",
								"value" => "",
								"description" => __("额外的包装器类.", "smile"),
								"group" => "General Settings",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("天 (单数)", "smile"),
								"param_name" => "string_days",
								"value" => "Day",
								//"description" => __("Enter your string for day.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("天 (复数)", "smile"),
								"param_name" => "string_days2",
								"value" => "Days",
								//"description" => __("Enter your string for days.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("周 (单数)", "smile"),
								"param_name" => "string_weeks",
								"value" => "Week",
								//"description" => __("Enter your string for Week.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("周 (复数)", "smile"),
								"param_name" => "string_weeks2",
								"value" => "Weeks",
								//"description" => __("Enter your string for Weeks.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("月 (单数)", "smile"),
								"param_name" => "string_months",
								"value" => "Month",
								//"description" => __("Enter your string for Month.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("月 (复数)", "smile"),
								"param_name" => "string_months2",
								"value" => "Months",
								//"description" => __("Enter your string for Months.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("年 (单数)", "smile"),
								"param_name" => "string_years",
								"value" => "Year",
								//"description" => __("Enter your string for Year.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("年 (复数)", "smile"),
								"param_name" => "string_years2",
								"value" => "Years",
								//"description" => __("Enter your string for Years.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("小时 (单数)", "smile"),
								"param_name" => "string_hours",
								"value" => "Hour",
								//"description" => __("Enter your string for Hour.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("小时(复数)", "smile"),
								"param_name" => "string_hours2",
								"value" => "Hours",
								//"description" => __("Enter your string for Hours.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("分钟 (单数)", "smile"),
								"param_name" => "string_minutes",
								"value" => "Minute",
								//"description" => __("Enter your string for Minute.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("分钟(复数)", "smile"),
								"param_name" => "string_minutes2",
								"value" => "Minutes",
								//"description" => __("Enter your string for Minutes.", "smile"),
								"group" => "Strings Translation",
							),							
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("秒钟 (单数)", "smile"),
								"param_name" => "string_seconds",
								"value" => "Second",
								//"description" => __("Enter your string for Second.", "smile"),
								"group" => "Strings Translation",
							),
							array(
						   		"type" => "textfield",
								"class" => "",
								"heading" => __("秒钟 (复数)", "smile"),
								"param_name" => "string_seconds2",
								"value" => "Seconds",
								//"description" => __("Enter your string for Seconds.", "smile"),
								"group" => "Strings Translation",
							),
						)	
					)
				);
			}
		}
		// Shortcode handler function for  icon block
		function countdown_shortcode($atts)
		{
			wp_enqueue_script('jquery.timecircle',plugins_url('../assets/js/jquery.countdown_org.js',__FILE__),'1.0',array('jQuery'));
			wp_enqueue_script('jquery.countdown',plugins_url('../assets/js/count-timer.js',__FILE__),'1.0',array('jQuery'));
			wp_enqueue_style('timecircle',plugins_url('../assets/css/countdown.css',__FILE__));
			$count_style = $datetime = $ult_tz = $countdown_opts = $tick_col = $tick_size = $tick_style = $tick_sep_col = $tick_sep_size = '';
			$tick_sep_style = $br_color = $br_style = $br_size = $timer_bg_color = $br_radius = $br_time_space = $el_class = '';
			$string_days = $string_weeks = $string_months = $string_years = $string_hours = $string_minutes = $string_seconds = '';
			$string_days2 = $string_weeks2 = $string_months2 = $string_years2 = $string_hours2 = $string_minutes2 = $string_seconds2 = '';
			extract(shortcode_atts( array(
				'count_style'=>'',
				'datetime'=>'',
				'ult_tz'=>'',
				'countdown_opts'=>'',
				'tick_col'=>'',
				'tick_size'=>'',
				'tick_style'=>'',
				'tick_sep_col'=>'',
				'tick_sep_size'=>'',
				'tick_sep_style'=>'',
				'br_color'=>'',
				'br_style'=>'',
				'br_size'=>'',
				'timer_bg_color'=>'',
				'br_radius'=>'',
				'br_time_space'=>'',				
				'el_class'=>'',
				'string_days' => 'Day',
				'string_days2' => 'Days',
				'string_weeks' => 'Week',
				'string_weeks2' => 'Weeks',
				'string_months' => 'Month',
				'string_months2' => 'Months',
				'string_years' => 'Year',
				'string_years2' => 'Years',
				'string_hours' => 'Hour',
				'string_hours2' => 'Hours',
				'string_minutes' => 'Minute',
				'string_minutes2' => 'Minutes',
				'string_seconds' => 'Second',
				'string_seconds2' => 'Seconds',
			),$atts));	
			$count_frmt = $labels = '';
			$labels = $string_years2 .','.$string_months2.','.$string_weeks2.','.$string_days2.','.$string_hours2.','.$string_minutes2.','.$string_seconds2;
			$labels2 = $string_years .','.$string_months.','.$string_weeks.','.$string_days.','.$string_hours.','.$string_minutes.','.$string_seconds;
			$countdown_opt = explode(",",$countdown_opts);				
				if(is_array($countdown_opt)){
					foreach($countdown_opt as $opt){
						if($opt == "syear") $count_frmt .= 'Y';
						if($opt == "smonth") $count_frmt .= 'O';
						if($opt == "sweek") $count_frmt .= 'W';
						if($opt == "sday") $count_frmt .= 'D';
						if($opt == "shr") $count_frmt .= 'H';
						if($opt == "smin") $count_frmt .= 'M';
						if($opt == "ssec") $count_frmt .= 'S';	
					}
				}
			$data_attr = '';
			if($count_frmt=='') $count_frmt = 'DHMS';
			if($br_size =='' || $br_color == '' || $br_style ==''){
				if($timer_bg_color==''){
					$el_class.=' ult-cd-no-border';
				}
			}
			else{
				$data_attr .=  'data-br-color="'.$br_color.'" data-br-style="'.$br_style.'" data-br-size="'.$br_size.'" ';
			}
			$data_attr .= 'data-tick-style="'.$tick_style.'"';
			$data_attr .= 'data-tick-p-style="'.$tick_sep_style.'"';	
			$data_attr .= 'data-bg-color="'.$timer_bg_color.'" data-br-radius="'.$br_radius.'" data-padd="'.$br_time_space.'"';
			$output = '<div class="ult_countdown '.$el_class.' '.$count_style.'">';
			if($datetime!=''){
				$output .='<div class="ult_countdown-div ult_countdown-dateAndTime '.$ult_tz.'" data-labels="'.$labels.'" data-labels2="'.$labels2.'"  data-terminal-date="'.$datetime.'" data-countformat="'.$count_frmt.'" data-time-zone="'.get_option('gmt_offset').'" data-time-now="'.str_replace('-', '/', current_time('mysql')).'" data-tick-size="'.$tick_size.'" data-tick-col="'.$tick_col.'" data-tick-p-size="'.$tick_sep_size.'" data-tick-p-col="'.$tick_sep_col.'" '.$data_attr.'>'.$datetime.'</div>';
			}			
			$output .='</div>';
			return $output;		
		}
	}
	//instantiate the class
	$ult_countdown = new Ultimate_CountDown;
}