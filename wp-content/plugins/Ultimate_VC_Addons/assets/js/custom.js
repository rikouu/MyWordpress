(function($) {
  "use strict";
	jQuery(window).scroll(function(){
		animate_block();
		jQuery('.vc-row-fade').vc_fade_row();
		jQuery('.vc-row-translate').vc_translate_row();
	});
	/*jQuery('#page').scroll(function(e) {
        jQuery('.vc-row-fade').vc_fade_row();
		jQuery('.vc-row-translate').vc_translate_row();
    });*/
	
	$.fn.vc_translate_row = function() {
		var window_scroll = jQuery(window).scrollTop();
		var window_height = jQuery(window).height();
		jQuery(this).each(function(index, element) {
			var mobile_disable = jQuery(element).attr('data-row-effect-mobile-disable');
			if(typeof mobile_disable == "undefined")
				mobile_disable = 'false';
			else
				mobile_disable = mobile_disable.toString();
			if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
				var is_mobile = 'false';
			else
				var is_mobile = 'true';
			if(is_mobile == 'true' && mobile_disable == 'true')
				var disable_row_effect = 'true';
			else
				var disable_row_effect = 'false';
			if(disable_row_effect == 'false')
			{
				var percentage = 0
				
				var row_height = jQuery(element).outerHeight();
				var row_top = jQuery(element).offset().top;
				var position = row_top - window_scroll;
				var row_visible = position+row_height;
				var pcsense = jQuery(element).attr('data-parallax-content-sense');
				var sense = (pcsense/100);
				var translate = 0;
				
				var cut = window_height - (window_height * (percentage/100));
	
				if(row_visible <= cut && position <= 0)
				{
					//translate = ((cut - row_visible)/2);
					if(row_height > window_height)
					{
						var translate = (window_height - row_visible)*sense;
					}
					else
					{
						var translate = -(position*sense);
					}
					if(translate < 0)
						translate = 0;
				}
				else
				{
					translate = 0;
				}
				var find_class = '.upb_row_bg,.upb_video-wrapper';
				jQuery(element).children().each(function(index, child) {
					if(!jQuery(child).is(find_class)) 
					{
						jQuery(child).css({'-webkit-transform':'translateY('+translate+'px)', 'transform':'translateY('+translate+'px)', '-ms-transform':'translateY('+translate+'px)'});
					}
				});
			}
		});
	}
	
	$.fn.vc_fade_row = function() {
		var window_scroll = jQuery(window).scrollTop();
		var window_height = jQuery(window).height();
		jQuery(this).each(function(index, element) {
			var mobile_disable = jQuery(element).attr('data-row-effect-mobile-disable');
			if(typeof mobile_disable == "undefined")
				mobile_disable = 'false';
			else
				mobile_disable = mobile_disable.toString();
			if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
				var is_mobile = 'false';
			else
				var is_mobile = 'true';
			if(is_mobile == 'true' && mobile_disable == 'true')
				var disable_row_effect = 'true';
			else
				var disable_row_effect = 'false';

			if(disable_row_effect == 'false')
			{
				var min_opacity = 0; // limit minimum opacity
	
				var percentage = jQuery(element).data('fadeout-percentage'); //% part of element visible from top the window to start transparency effect
				percentage = 100 - percentage;
				
				var no_class = '';
				
				var row_height = jQuery(element).outerHeight();
				var row_top = jQuery(element).offset().top;
				var position = row_top - window_scroll;
				var row_bottom = position+row_height;
				var opacity = 1;
				
				var cut = window_height - (window_height * (percentage/100));
							
				var newop = (((cut-row_bottom)/cut)*(1-min_opacity));
				if(newop > 0)
					 opacity = 1-newop;
				
				//if(position < 0 && (row_bottom <= (window_height-cut))) // if position out of the window 
				if(row_bottom <= cut) // if position out of the window 
				{
					if(opacity < min_opacity) // if opacity is less than min opacity
						opacity = min_opacity; //set min opacity to opacity
					else if(opacity > 1) //if opacity is greater than 1 set to 1
						opacity = 1;
					jQuery(element).children().each(function(rindex, row_child) {
						var find_class = '.upb_row_bg,.upb_video-wrapper';
						if(!jQuery(row_child).is(find_class))
						{
							jQuery(row_child).css({		
								'opacity' : opacity
							});
						}
					});
				}
				else
				{
					jQuery(element).children().each(function(rindex, row_child) {
						jQuery(row_child).css({		
							'opacity' : opacity
						});
					}); 
				}
			}
        });
	}

  	jQuery(window).load(function(){
		
		//interactive banner height fix
		jQuery('.banner-block-custom-height').each(function(index, element) {
            var $blockimg = jQuery(this).find('img');
			var block_width = jQuery(this).width();
			var img_width = $blockimg.width();
			if(block_width > img_width)
				$blockimg.css({'width':'100%','height':'auto'});
        });
  		// FLIP BOX START
  		var flip_resize_count=0, flip_time_resize=0;  		
  		var flip_box_resize = function(){
			jQuery('.ifb-jq-height').each(function(){			
				jQuery(this).find('.ifb-back').css('height','auto');
				jQuery(this).find('.ifb-front').css('height','auto');
				var fh = parseInt(jQuery(this).find('.ifb-front').outerHeight(true));
				var bh = parseInt(jQuery(this).find('.ifb-back').outerHeight(true));
				var gr = (fh>bh)?fh:bh;
				jQuery(this).find('.ifb-front').css('height',gr+'px');
				jQuery(this).find('.ifb-back').css('height',gr+'px');
				//viraj
				if(jQuery(this).hasClass('vertical_door_flip')) {
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
				else if(jQuery(this).hasClass('horizontal_door_flip')) {
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
				else if(jQuery(this).hasClass('style_9')) {
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
			})	
			jQuery('.ifb-auto-height').each(function(){
				if( (jQuery(this).hasClass('horizontal_door_flip')) || (jQuery(this).hasClass('vertical_door_flip')) ){
					var fh = parseInt(jQuery(this).find('.ifb-front').outerHeight());
					var bh = parseInt(jQuery(this).find('.ifb-back').outerHeight());
					var gr = (fh>bh)?fh:bh;
					jQuery(this).find('.ifb-flip-box').css('height',gr+'px');
				}
			})
		}		
		if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1){			
			setTimeout(function() {
				flip_box_resize();	
			}, 500);	
		}
		else{
			flip_box_resize()
		}
		jQuery(window).resize(function(){
			flip_resize_count++;
			setTimeout(function() {
				flip_time_resize++;
				if(flip_resize_count == flip_time_resize){
					flip_box_resize();					
				}
			}, 500);
		})
		// FLIP BOX END
		var tiid=0;
		var mason_des=0;
		jQuery(window).resize(function(){
			ib_responsive();
			jQuery('.csstime.smile-icon-timeline-wrap').each(function(){
				timeline_icon_setting(jQuery(this));
			});
			$('.jstime .timeline-wrapper').each(function(){
				timeline_icon_setting(jQuery(this));
			});
			if(jQuery('.smile-icon-timeline-wrap.jstime .timeline-line').css('display')=='none'){
				if(mason_des===0){
					$('.jstime .timeline-wrapper').masonry('destroy');
					mason_des=1;
				}
			}else{
				if(mason_des==1){					
					jQuery('.jstime .timeline-wrapper').masonry({
						"itemSelector": '.timeline-block',					
					});
					setTimeout(function() {
						jQuery('.jstime .timeline-wrapper').masonry({
							"itemSelector": '.timeline-block',					
						});
						jQuery(this).find('.timeline-block').each(function(){
							if(jQuery(this).css('left')=='0px'){
								jQuery(this).addClass('timeline-post-left');
							}
							else{
								jQuery(this).addClass('timeline-post-right');
							}
						});
						mason_des=0;
					}, 300);
				}				
			}
		});
		$('.smile-icon-timeline-wrap').each(function(){			
			var cstm_width = jQuery(this).data('timeline-cutom-width');
			if(cstm_width){
				jQuery(this).css('width',((cstm_width*2)+40)+'px');
			}
			//$(this).find('.smile_icon_timeline').attr('id','timeline-wrapper-'+(++tiid));
			// Initialize Masonry
			var width = parseInt(jQuery(this).width());
			var b_wid = parseInt(jQuery(this).find('.timeline-block').width());				
			var l_pos = (b_wid/width)*100;
			if(jQuery(this).hasClass('jstime')){
				//jQuery(this).find('.timeline-line').css('left',l_pos+'%');
			}
			var time_r_margin = (width - (b_wid*2) - 40);			
			time_r_margin = (time_r_margin/width)*100;
			//jQuery(this).find('.timeline-separator-text').css('margin-right',time_r_margin+'%');
			//jQuery(this).find('.timeline-feature-item').css('margin-right',time_r_margin+'%');
			$('.jstime .timeline-wrapper').each(function(){
				jQuery(this).masonry({
					"itemSelector": '.timeline-block',
					//gutter : 40
				});
			});
			setTimeout(function() {
				$('.jstime .timeline-wrapper').each(function(){
					jQuery(this).find('.timeline-block').each(function(){
						if(jQuery(this).css('left')=='0px'){
							jQuery(this).addClass('timeline-post-left');
						}
						else{
							jQuery(this).addClass('timeline-post-right');
						}
						timeline_icon_setting(jQuery(this));
					});
					jQuery('.timeline-block').each(function(){
						var div=parseInt(jQuery(this).css('top'))-parseInt(jQuery(this).next().css('top'));
						//console.log(jQuery(this).css('top'))
						//console.log(jQuery(this).next().css('top'))
						if((div < 14 && div > 0)|| div==0) {
							//console.log('clash-right'+div)
							jQuery(this).next().addClass('time-clash-right');
						}
						else if(div > -14){
							//console.log('clash-left'+div)
							jQuery(this).next().addClass('time-clash-left');
						}
					})
					// Block bg
					jQuery('.smile-icon-timeline-wrap').each(function(){
						var block_bg =jQuery(this).data('time_block_bg_color');
						jQuery(this).find('.timeline-block').css('background-color',block_bg);
					    jQuery(this).find('.timeline-post-left.timeline-block l').css('border-left-color',block_bg);
					    jQuery(this).find('.timeline-post-right.timeline-block l').css('border-right-color',block_bg);	
					    jQuery(this).find('.feat-item').css('background-color',block_bg);	
					    if(jQuery(this).find('.feat-item').find('.feat-top').length > 0)
							jQuery(this).find('.feat-item l').css('border-top-color',block_bg);
						else
					    	jQuery(this).find('.feat-item l').css('border-bottom-color',block_bg);
					})
					jQuery('.jstime.timeline_preloader').remove();
					jQuery('.smile-icon-timeline-wrap.jstime').css('opacity','1');
				});
				jQuery('.timeline-post-right').each(function(){
					var cl = jQuery(this).find('.timeline-icon-block').clone();
					jQuery(this).find('.timeline-icon-block').remove(); 
					jQuery(this).find('.timeline-header-block').after(cl);
				})
			}, 1000);
			jQuery(this).find('.timeline-wrapper').each(function(){
				if(jQuery(this).text().trim()===''){
					jQuery(this).remove();
				}
			});
			if( ! jQuery(this).find('.timeline-line ').next().hasClass('timeline-separator-text')){
				jQuery(this).find('.timeline-line').prepend('<o></o>');
			}			
			var sep_col = jQuery(this).data('time_sep_color');
			var sep_bg =jQuery(this).data('time_sep_bg_color');
			var line_color = jQuery('.smile-icon-timeline-wrap .timeline-line').css('border-right-color');
			jQuery(this).find('.timeline-dot').css('background-color',sep_bg);
			jQuery(this).find('.timeline-line z').css('background-color',sep_bg);
			jQuery(this).find('.timeline-line o').css('background-color',sep_bg);
			// Sep Color
			jQuery(this).find('.timeline-separator-text').css('color',sep_col);
			jQuery(this).find('.timeline-separator-text .sep-text').css('background-color',sep_bg);
			jQuery(this).find('.ult-timeline-arrow s').css('border-color','rgba(255, 255, 255, 0) '+line_color);
			jQuery(this).find('.feat-item .ult-timeline-arrow s').css('border-color',line_color+' rgba(255, 255, 255, 0)');
			jQuery(this).find('.timeline-block').css('border-color',line_color);
			jQuery(this).find('.feat-item').css('border-color',line_color);
  		});
		jQuery('.timeline-block').each(function(){
			var link_b = $(this).find('.link-box').attr('href');
			var link_t = $(this).find('.link-title').attr('href');
			if(link_b){				
				jQuery(this).wrap('<a href='+link_b+'></a>')
				//var htht = jQuery(this).html();
				//jQuery(this).html('<a href='+link_b+'>'+htht+'</a>')
				//jQuery(this).find('.timeline-header-block').wrap('<a href='+link_b+'></a>')
				//jQuery(this).find('.timeline-icon-block').wrap('<a href='+link_b+'></a>')
			}
			if(link_t){
				jQuery(this).find('.ult-timeline-title').wrap('<a href='+link_t+'></a>')
			}
		});
		jQuery('.feat-item').each(function(){
			var link_b = $(this).find('.link-box').attr('href');			
			if(link_b){				
				jQuery(this).wrap('<a href='+link_b+'></a>')
			}
		});
	});	
	jQuery(document).ready(function() {
		animate_block();
		ib_responsive();
	
		jQuery(".ubtn").hover(
			function(){
				var $this = jQuery(this);
				$this.find(".ubtn-text").css("color",$this.data('hover'));
				$this.find(".ubtn-hover").css("background",$this.data('hover-bg'));
				var old_style = $this.attr('style');
				if($this.data('shadow-hover') != ''){
					var old_shadow = $this.css('box-shadow');
					//console.log(old_shadow);
					old_style += 'box-shadow:'+$this.data('shadow-hover');
				}
				$this.attr('style', old_style);
				if($this.data('border-hover') != '')
				{
					$this.css("border-color",$this.data('border-hover'));
				}
				if($this.data('shadow-click') != 'none')
				{
					var temp_adj = $this.data('shd-shadow')-3;
					if($this.is('.shd-left') != '')
						$this.css({ 'right':temp_adj});
					else if($this.is('.shd-right') != '')
						$this.css({ 'left':temp_adj });
					else if($this.is('.shd-top') != '')
						$this.css({ 'bottom':temp_adj });
					else if($this.is('.shd-bottom') != '')
						$this.css({ 'top':temp_adj });
				}
			},
			function(){
				var $this = jQuery(this);
				$this.find(".ubtn-text").removeAttr('style');
				$this.find(".ubtn-hover").removeAttr('style');
				var border_color = $this.data('border-color');
				var old_style = $this.attr('style');
				if($this.data('shadow-hover') != '')
					old_style += 'box-shadow:'+$this.data('shadow');
				$this.attr('style', old_style);
				if($this.data('border-hover') != '')
				{
					$this.css("border-color",border_color);
				}
				if($this.data('shadow-click') != 'none')
				{
					$this.removeClass('no-ubtn-shadow');
					if($this.is('.shd-left') != '')
						$this.css({ 'right':'auto'});
					else if($this.is('.shd-right') != '')
						$this.css({ 'left':'auto' });
					else if($this.is('.shd-top') != '')
						$this.css({ 'bottom':'auto' });
					else if($this.is('.shd-bottom') != '')
						$this.css({ 'top':'auto' });
				}
			}
		);
		/*
		jQuery(".ubtn-link").hover(
			function(){
				var $this = jQuery(this).find(".ubtn");
				$this.find(".ubtn-text").css("color",$this.data('hover'));
				$this.find(".ubtn-hover").css("background",$this.data('hover-bg'));
				var old_style = $this.attr('style');
				if($this.data('shadow-hover') != '')
					old_style += 'box-shadow:'+$this.data('shadow-hover');
				$this.attr('style', old_style);
				if($this.data('border-hover') != '')
				{
					$this.css("border-color",$this.data('border-hover'));
				}
			},
			function(){
				var $this = jQuery(this).find(".ubtn");
				$this.find(".ubtn-text").removeAttr('style');
				$this.find(".ubtn-hover").removeAttr('style');
				var border_color = $this.data('border-color');
				//$this.css("box-shadow","");
				var old_style = $this.attr('style');
				if($this.data('shadow-hover') != '')
					old_style += 'box-shadow:'+$this.data('shadow');
				$this.attr('style', old_style);
				if($this.data('border-hover') != '')
				{
					$this.css("border-color",border_color);
				}
			}
		);
		*/
		jQuery(".ult-new-ib").hover(
			function(){
				jQuery(this).find(".ult-new-ib-img").attr("style","opacity:"+jQuery(this).data('hover-opacity'));
			},
			function(){
				jQuery(this).find(".ult-new-ib-img").attr("style","opacity:"+jQuery(this).data('opacity'));
			}
		);
		/*jQuery(".ubtn-link").click(function(){
			var $this = jQuery(this).find(".ubtn");
			$this.css("box-shadow",$this.data("shadow-click"));
		});
		jQuery(".ubtn").click(function(){
			var $this = jQuery(this);
			$this.css("box-shadow",$this.data("shadow-click"));
		});*/
		jQuery(".ubtn").on("focus blur mousedown mouseup", function(e) {
			var $this = jQuery(this);
			if($this.data('shadow-click') != 'none')
			{
				setTimeout(function() {
					if($this.is( ":focus" ))
					{
						$this.addClass("no-ubtn-shadow");
						if($this.is('.shd-left') != '')
							$this.css({ 'right':$this.data('shd-shadow')+'px'});
						else if($this.is('.shd-right') != '')
							$this.css({ 'left':$this.data('shd-shadow')+'px' });
						else if($this.is('.shd-top') != '')
							$this.css({ 'bottom':$this.data('shd-shadow')+'px' });
						else if($this.is('.shd-bottom') != '')
							$this.css({ 'top':$this.data('shd-shadow')+'px' });
					}
					else
					{
						$this.removeClass("no-ubtn-shadow");
						if($this.is('.shd-left') != '')
							$this.css({ 'right':'auto'});
						else if($this.is('.shd-right') != '')
							$this.css({ 'left':'auto' });
						else if($this.is('.shd-top') != '')
							$this.css({ 'bottom':'auto' });
						else if($this.is('.shd-bottom') != '')
							$this.css({ 'top':'auto' });
					}
				}, 0 );
			}
		});
		jQuery(".ubtn").focusout(function(){
			var $this = jQuery(this);
			$this.removeClass("no-ubtn-shadow");
			if($this.is('.shd-left') != '')
				$this.css({ 'right':'auto'});
			else if($this.is('.shd-right') != '')
				$this.css({ 'left':'auto' });
			else if($this.is('.shd-top') != '')
				$this.css({ 'bottom':'auto' });
			else if($this.is('.shd-bottom') != '')
				$this.css({ 'top':'auto' });
		});

		
		jQuery('.smile-icon-timeline-wrap.jstime').css('opacity','0');
		jQuery('.jstime.timeline_preloader').css('opacity','1');
		jQuery('.smile-icon-timeline-wrap.csstime .timeline-wrapper').each(function(){
			jQuery('.csstime .timeline-block:even').addClass('timeline-post-left');
			jQuery('.csstime .timeline-block:odd').addClass('timeline-post-right');
		})
		jQuery('.csstime .timeline-post-right').each(function(){
			jQuery(this).css('float','right');
			jQuery("<div style='clear:both'></div>").insertAfter(jQuery(this));
		})
		jQuery('.csstime.smile-icon-timeline-wrap').each(function(){
			var block_bg =jQuery(this).data('time_block_bg_color');
			jQuery(this).find('.timeline-block').css('background-color',block_bg);
		    jQuery(this).find('.timeline-post-left.timeline-block l').css('border-left-color',block_bg);
		    jQuery(this).find('.timeline-post-right.timeline-block l').css('border-right-color',block_bg);	
		    jQuery(this).find('.feat-item').css('background-color',block_bg);	
		    if(jQuery(this).find('.feat-item').find('.feat-top').length > 0)
				jQuery(this).find('.feat-item l').css('border-top-color',block_bg);	
			else
				jQuery(this).find('.feat-item l').css('border-bottom-color',block_bg);
			timeline_icon_setting(jQuery(this));
		})
		// CSS3 Transitions.
		jQuery('*').each(function(){
			if(jQuery(this).attr('data-animation')) {
				var animationName = jQuery(this).attr('data-animation'),
					animationDelay = "delay-"+jQuery(this).attr('data-animation-delay');
				jQuery(this).bsf_appear(function() {
					var $this = jQuery(this);
					//$this.css('opacity','0');
					//setTimeout(function(){
						$this.addClass('animated').addClass(animationName);
						$this.addClass('animated').addClass(animationDelay);
						//$this.css('opacity','1');
					//},1000);
				});
			} 
		});
		// Icon Tabs
		// Stats Counter
		jQuery('.stats-block').each(function() {
			jQuery(this).bsf_appear(function() {
				var endNum = parseFloat(jQuery(this).find('.stats-number').data('counter-value'));
				var Num = (jQuery(this).find('.stats-number').data('counter-value'))+' ';
				var speed = parseInt(jQuery(this).find('.stats-number').data('speed'));
				var ID = jQuery(this).find('.stats-number').data('id');
				var sep = jQuery(this).find('.stats-number').data('separator');
				var dec = jQuery(this).find('.stats-number').data('decimal');
				var dec_count = Num.split(".");
				if(dec_count[1]){
					dec_count = dec_count[1].length-1;
				} else {
					dec_count = 0;
				}
				var grouping = true;
				if(dec == "none"){
					dec = "";
				}
				if(sep == "none"){
					grouping = false;
				} else {
					grouping = true;
				}
				var settings = {
					useEasing : true, 
					useGrouping : grouping, 
					separator : sep, 
					decimal : dec
				}
				var counter = new countUp(ID, 0, endNum, dec_count, speed, settings);
				setTimeout(function(){
					counter.start();
				},50);
			});
		});
		// Flip-box	
		var is_touch_device = 'ontouchstart' in document.documentElement;		
		jQuery('#page').click(function(){			
			jQuery('.ifb-hover').removeClass('ifb-hover');
		});
		if(!is_touch_device){
			jQuery('.ifb-flip-box').hover(function(event){			
				event.stopPropagation();				
				jQuery(this).addClass('ifb-hover');	
			},function(event){
				event.stopPropagation();
				jQuery(this).removeClass('ifb-hover');			
			});
		}
		jQuery('.ifb-flip-box').each(function(index, element) {
			if(jQuery(this).parent().hasClass('style_9')) {
				jQuery(this).hover(function(){
						jQuery(this).addClass('ifb-door-hover');						
					},
					function(){
						jQuery(this).removeClass('ifb-door-hover');
					})
				jQuery(this).on('click',function(){
						jQuery(this).toggleClass('ifb-door-right-open');
						jQuery(this).removeClass('ifb-door-hover');						
					});
			}
		});
		jQuery('.ifb-flip-box').click(function(event){
			event.stopPropagation();
			if(jQuery(this).hasClass('ifb-hover')){				
				jQuery(this).removeClass('ifb-hover');							
			}
			else{
				jQuery('.ifb-hover').removeClass('ifb-hover');
				jQuery(this).addClass('ifb-hover');
			}
		});
		/*
		jQuery('.timeline-wrapper').each(function(){
			var timeline_icon_width = jQuery(this).find('.timeline-block .timeline-icon-block').width();
			jQuery(this).find('.timeline-post-left.timeline-block .timeline-icon-block').css('left', timeline_icon_width/2);
			jQuery(this).find('.timeline-post-right.timeline-block .timeline-icon-block').css('left', timeline_icon_width/-2);			
		})
		jQuery(window).resize(function(){
			jQuery('.timeline-wrapper').each(function(){
				var timeline_icon_width = jQuery(this).find('.timeline-block .timeline-icon-block').width();
				jQuery(this).find('.timeline-post-left.timeline-block .timeline-icon-block').css('left', timeline_icon_width/2);
				jQuery(this).find('.timeline-post-right.timeline-block .timeline-icon-block').css('left', timeline_icon_width/-2);			
			})
		})*/		
		/*
		jQuery('.timeline-wrapper').each(function(){
			var timeline_icon_width = jQuery(this).find('.timeline-block .timeline-icon-block').width();
			jQuery(this).find('.timeline-post-left.timeline-block').css('left', timeline_icon_width/2);
			jQuery(this).find('.timeline-post-right.timeline-block').css('left', timeline_icon_width/-2);			
		})
		jQuery(window).resize(function(){
			jQuery('.timeline-wrapper').each(function(){
				var timeline_icon_width = jQuery(this).find('.timeline-block .timeline-icon-block').width();
				jQuery(this).find('.timeline-post-left.timeline-block').css('left', timeline_icon_width/2);
				jQuery(this).find('.timeline-post-right.timeline-block').css('left', timeline_icon_width/-2);			
			})
		})
		*/
		//Flipbox
			//Vertical Door Flip
			jQuery('.vertical_door_flip .ifb-front').each(function() {
				jQuery(this).wrap('<div class="v_door ifb-multiple-front ifb-front-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-front-1').addClass('ifb-front-2').insertAfter(jQuery(this).parent());
			});
			//Reverse Vertical Door Flip
			jQuery('.reverse_vertical_door_flip .ifb-back').each(function() {
				jQuery(this).wrap('<div class="rv_door ifb-multiple-back ifb-back-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-back-1').addClass('ifb-back-2').insertAfter(jQuery(this).parent());
			});
			//Horizontal Door Flip
			jQuery('.horizontal_door_flip .ifb-front').each(function() {
				jQuery(this).wrap('<div class="h_door ifb-multiple-front ifb-front-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-front-1').addClass('ifb-front-2').insertAfter(jQuery(this).parent());
			});
			//Reverse Horizontal Door Flip
			jQuery('.reverse_horizontal_door_flip .ifb-back').each(function() {
				jQuery(this).wrap('<div class="rh_door ifb-multiple-back ifb-back-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-back-1').addClass('ifb-back-2').insertAfter(jQuery(this).parent());
			});
			//Stlye 9 front
			jQuery('.style_9 .ifb-front').each(function() {
				jQuery(this).wrap('<div class="new_style_9 ifb-multiple-front ifb-front-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-front-1').addClass('ifb-front-2').insertAfter(jQuery(this).parent());
			});
			//Style 9 back
			jQuery('.style_9 .ifb-back').each(function() {
				jQuery(this).wrap('<div class="new_style_9 ifb-multiple-back ifb-back-1"></div>');
				jQuery(this).parent().clone().removeClass('ifb-back-1').addClass('ifb-back-2').insertAfter(jQuery(this).parent());
			});
			if( jQuery.browser.safari ){
				jQuery('.vertical_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
                    jQuery(this).find('.ifb-multiple-front').css('width', '50.2%');
                });
				jQuery('.horizontal_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
                    jQuery(this).find('.ifb-multiple-front').css('height','50.2%');
                });
				jQuery('.reverse_vertical_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
                });
				jQuery('.reverse_horizontal_door_flip').each(function(index, element) {
                    var safari_link = jQuery(this).find('.flip_link').outerHeight();
					jQuery(this).find('.flip_link').css('top', - safari_link/2 +'px');
					jQuery(this).find('.ifb-back').css('position', 'inherit');
                });
			}
			//Info Box
			jQuery('.square_box-icon').each(function(index, element) {
                var ib_box_style_icon_height = parseInt(jQuery(this).find('.aio-icon').outerHeight());
				var ib_padding = ib_box_style_icon_height/2;
				//var icon_pos = ib_box_style_icon_height*2;
				jQuery(this).css('padding-top', ib_padding+'px');
				jQuery(this).parents().find('.aio-icon-component').css('margin-top', ib_padding+20+'px');
				jQuery(this).find('.aio-icon').css('top', - ib_box_style_icon_height+'px');
            });
	});
	function timeline_icon_setting(ele) //setting to est icon if any
	{
		if(ele.find('.timeline-icon-block').length > 0)
		{
			$('.timeline-block').each(function(index, element) {
				var $hbblock = $(this).find('.timeline-header-block');
				var $icon = $(this).find('.timeline-icon-block');
				$icon.css({'position':'absolute'});
				var icon_height = $icon.outerHeight();
				var icon_width = $icon.outerWidth();
				var diff_pos = -(icon_width/2);
				var padding_fixer = parseInt($hbblock.find('.timeline-header').css('padding-left').replace ( /[^\d.]/g, '' ));
				if($(this).hasClass('timeline-post-left'))
				{
					$icon.css({'left':diff_pos,'right':'auto'});
					$hbblock.css({'padding-left':((icon_width/2)+padding_fixer)+'px'});
				}
				else if($(this).hasClass('timeline-post-right'))
				{
					$icon.css({'left':'auto','right':diff_pos});
					$hbblock.css({'padding-right':((icon_width/2)+padding_fixer)+'px'});
				}
				var blheight = $hbblock.height();
				var blmidheight = blheight/2;
				var icon_mid_height = icon_height/2;
				var diff = blmidheight - icon_mid_height;
				$icon.css({'top':diff});
				var tleft = $icon.offset().left;
				var winw = $(window).width();

				if(0 > tleft || winw < (tleft+icon_width))
				{
					$icon.css({'position':'relative','top':'auto','left':'auto','right':'auto','text-align':'center'});
					$icon.children().children().css({'margin':'10px auto'});
					$hbblock.css({'padding':'0'});
				}
			});
		}
	}

	// CSS3 Transitions.
	function animate_block(){
		jQuery('.ult-animation').each(function(){
			if(jQuery(this).attr('data-animate')) {
				//var child = jQuery(this).children('div');
				var child2 = jQuery(this).children('*');
				//var child = jQuery('.ult-animation > *');
				//console.log(child);
				var animationName = jQuery(this).attr('data-animate'),
					animationDuration = jQuery(this).attr('data-animation-duration')+'s',
					animationIteration = jQuery(this).attr('data-animation-iteration'),
					animationDelay = jQuery(this).attr('data-animation-delay');
				var style = 'opacity:1;-webkit-animation-delay:'+animationDelay+'s;-webkit-animation-duration:'+animationDuration+';-webkit-animation-iteration-count:'+animationIteration+'; -moz-animation-delay:'+animationDelay+'s;-moz-animation-duration:'+animationDuration+';-moz-animation-iteration-count:'+animationIteration+'; animation-delay:'+animationDelay+'s;animation-duration:'+animationDuration+';animation-iteration-count:'+animationIteration+';';
				var container_style = 'opacity:1;-webkit-transition-delay: '+(animationDelay)+'s; -moz-transition-delay: '+(animationDelay)+'s; transition-delay: '+(animationDelay)+'s;';
				if(isAppear(jQuery(this))){
					var p_st = jQuery(this).attr('style');
					if(typeof(p_st) == 'undefined'){
						p_st = 'test';
					}
					if(p_st == 'opacity:0;'){
						if( p_st.indexOf(container_style) !== 0 ){
							jQuery(this).attr('style',container_style);
						}
					}
				}
				//jQuery(this).bsf_appear(function() {
				jQuery.each(child2,function(index,value){
					var $this = jQuery(value);
					var prev_style = $this.attr('style');
					if(typeof(prev_style) == 'undefined'){
						prev_style = 'test';
					}
					var new_style = '';
					if( prev_style.indexOf(style) == 0 ){
						new_style = prev_style;
					} else {
						new_style = style+prev_style;
					}
					$this.attr('style',new_style);
					if(isAppear($this)){
						$this.addClass('animated').addClass(animationName);
					}
				});
			} 
		});
	}

	function isAppear(id){
		var win = jQuery(window);
		var viewport = {
			top : win.scrollTop(),
			left : win.scrollLeft()
		};
		var productHeight = jQuery(id).outerHeight()-80;
		viewport.right = viewport.left + win.width();
		viewport.bottom = viewport.top + win.height() - productHeight;
		var bounds = jQuery(id).offset();
		bounds.right = bounds.left + jQuery(id).outerWidth();
		bounds.bottom = bounds.top + jQuery(id).outerHeight();
		return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
	};

	function ib_responsive(){
		var new_ib = jQuery(".ult-new-ib");
		new_ib.each(function(index, element) {
           var $this = jQuery(this); 
		   if($this.hasClass("ult-ib-resp")){
				var w = jQuery(document).width();
				var ib_min = $this.data("min-width");
				var ib_max = $this.data("max-width");
				if(w <= ib_max && w >= ib_min){
					$this.find(".ult-new-ib-content").hide();
				} else {
					$this.find(".ult-new-ib-content").show();
				}
			}
        });
	}

})(jQuery);
//ready