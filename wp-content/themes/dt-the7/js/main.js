jQuery(document).ready(function($) {
	if (dtGlobals.isWindowsPhone){
		$("body").addClass("ie-mobile");
	}
	if(!$("html").hasClass("old-ie")){
		dtGlobals.isPhone = false;
		dtGlobals.isTablet = false;
		dtGlobals.isDesktop = false;

		var size = window.getComputedStyle(document.body,":after").getPropertyValue("content");

		if (size.indexOf("phone") !=-1 && dtGlobals.isMobile) {
			dtGlobals.isPhone = true;
		} 
		else if (size.indexOf("tablet") !=-1 && dtGlobals.isMobile) {
			dtGlobals.isTablet = true;
		}
		else {
			dtGlobals.isDesktop = true;
		};

	}

	// Retina images using srcset polyfill
	window.retinizer = function() {
		if ($("body").hasClass("srcset-enabled")) {
			var $coll = $("img:not(.retinized)").filter("[srcset]"),
				ratio = window.devicePixelRatio ? window.devicePixelRatio : 1;
	
			$coll.each(function() {
				var $this = $(this),
					srcArray = $this.attr("srcset").split(","),
					srcMap = [],
					src = "";
	
				srcArray.forEach(function(el, i) {
					var temp = $.trim(el).split(" ");
					srcMap[temp[1]] = temp[0];
				});
	
				if (ratio >= 1.5) {
					if (!(typeof srcMap["2x"] == "undefined")) src = srcMap["2x"];
					else src = srcMap["1x"];
				}
				else {
					if (!(typeof srcMap["1x"] == "undefined")) src = srcMap["1x"];
					else src = srcMap["2x"];
				};
	
				$this.attr("src", src).addClass("retinized");
			});
	
			// Retina logo in floating menu
			
			if (! (typeof dtGlobals.logoURL == "undefined")) {
				var logoArray = dtGlobals.logoURL.split(","),
					logoMap = [];
		
				logoArray.forEach(function(el, i) {
					var temp = $.trim(el).split(" ");
					logoMap[temp[1]] = temp[0];
				});
		
				if (ratio >= 1.5) {
					if (!(typeof logoMap["2x"] == "undefined")) dtGlobals.logoURL = logoMap["2x"];
					else dtGlobals.logoURL = logoMap["1x"];
				}
				else {
					if (!(typeof logoMap["1x"] == "undefined")) dtGlobals.logoURL = logoMap["1x"];
					else dtGlobals.logoURL = logoMap["2x"];
				};
			};
		};
	};
	retinizer();

	/* !Debounced resize event */
	var dtResizeTimeout;
	if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
		$(window).bind("orientationchange", function(event) {
			/*$(window).on("resize", function() {*/
				clearTimeout(dtResizeTimeout);
				dtResizeTimeout = setTimeout(function() {
					$(window).trigger( "debouncedresize" );
				}, 200);
			/*});*/
		});
	}else{
		$(window).on("resize", function() {
			clearTimeout(dtResizeTimeout);
			dtResizeTimeout = setTimeout(function() {
				$(window).trigger( "debouncedresize" );
			}, 200);
		});
	}
	/* Debounced resize event: end */

if (!$("html").hasClass("old-ie")){
	var icons = [
		'<g id="social-500px"><path d="M11.969 13.544c1.137 1.3 2.5 2.5 4.3 2.467c2.364 0 3.775-1.795 3.775-4.08 c0-2.279-1.438-3.973-3.756-3.973c-1.848 0-3.059 1.202-4.232 2.621c-1.201-1.44-2.393-2.621-4.279-2.621 C5.477 8 4 9.7 4 12.005c0 2.3 1.6 4 3.8 4.037c1.93-0.08 2.977-1.325 4.117-2.498H11.969z M5.715 12 c0-1.011 0.656-2.114 1.865-2.114c1.233 0 2.5 1.3 3.4 2.137c-0.82 0.957-2.015 1.99-3.265 2 c-1.285-0.021-1.974-0.842-1.974-2.013H5.715z M13.146 12.099c0.867-0.94 1.941-2.123 3.219-2.123c1.246 0 2 0.9 2 2.1 c0 1.104-0.645 2.025-1.876 1.973c-1.333 0.049-2.469-0.879-3.282-1.898L13.146 12.099z"/></g>',
		'<g id="vk"><path d="M12.235 16.191c0.372 0 0.524-0.248 0.516-0.56c-0.017-1.17 0.438-1.797 1.258-0.978 c0.908 0.9 1.1 1.5 2.1 1.502c0.418 0 1.5 0 1.9 0c1.528 0 0.166-1.54-0.916-2.54c-1.024-0.952-1.071-0.979-0.189-2.123 c1.102-1.425 2.535-3.26 1.266-3.26c-0.246 0-0.072 0-2.428 0c-0.471 0-0.501 0.277-0.672 0.7 c-0.604 1.429-1.758 3.28-2.195 3.001c-0.46-0.295-0.248-1.3-0.213-3.038c0.014-0.459 0.01-0.774-0.694-0.94 c-1.92-0.447-3.578 0.431-2.9 0.537c0.954 0.2 0.9 2 0.6 2.98c-0.387 1.558-1.851-1.235-2.457-2.623 C7.25 8.5 7.2 8.3 6.7 8.277c-0.29 0-1.558 0-1.986 0c-0.382 0-0.569 0.177-0.434 0.531c0.133 0.3 1.7 3.8 3.4 5.8 c1.718 1.7 3.4 1.6 4.6 1.597H12.235L12.235 16.191z"/></g>',
		'<g id="tripedvisor"><path fill="none" d="M15.825 9.215c-1.584 0-2.873 1.291-2.873 2.874c0 1.6 1.3 2.9 2.9 2.876s2.873-1.292 2.873-2.876 C18.698 10.5 17.4 9.2 15.8 9.215z M15.879 13.729c-0.423 0-0.82-0.164-1.118-0.464c-0.299-0.301-0.465-0.697-0.465-1.121 c0-0.421 0.166-0.818 0.465-1.119c0.298-0.298 0.695-0.461 1.118-0.461c0.873 0 1.6 0.7 1.6 1.6 C17.464 13 16.8 13.7 15.9 13.729z"/><path fill="none" d="M8.26 9.251c-1.592 0-2.887 1.296-2.887 2.888c0 1.6 1.3 2.9 2.9 2.9 c1.591 0 2.886-1.299 2.886-2.887C11.146 10.5 9.9 9.3 8.3 9.251z M8.253 13.706c-0.421 0-0.816-0.163-1.113-0.461 c-0.3-0.296-0.462-0.691-0.462-1.114c0-0.419 0.164-0.814 0.462-1.113c0.297-0.296 0.693-0.457 1.113-0.462 c0.87 0 1.6 0.7 1.6 1.574S9.123 13.7 8.3 13.706z"/><path d="M8.253 10.556c-0.42 0.005-0.816 0.166-1.113 0.463c-0.299 0.299-0.462 0.694-0.462 1.113c0 0.4 0.2 0.8 0.5 1.1 c0.297 0.3 0.7 0.5 1.1 0.461c0.87 0 1.576-0.708 1.576-1.577S9.123 10.6 8.3 10.556z"/><path d="M15.879 10.563c-0.423 0-0.82 0.163-1.118 0.461c-0.299 0.301-0.465 0.698-0.465 1.119c0 0.4 0.2 0.8 0.5 1.1 c0.298 0.3 0.7 0.5 1.1 0.464c0.873 0 1.585-0.708 1.585-1.582S16.752 10.6 15.9 10.563z"/><path d="M20.172 8.047l-3.177 0.365c-0.042-0.013-0.085-0.021-0.127-0.034c-0.138-0.216-1.087-1.44-4.881-1.44 c-4.164 0-4.9 1.475-4.9 1.475l-3.165-0.35c0.339 0.3 1 1.3 1.1 1.733c-0.49 0.649-0.867 1.475-0.859 2.4 c0.016 1.8 0.7 3.9 3.7 4.338c1.375-0.019 2.048-0.344 3.064-1.133l1.109 2.461l1.169-2.439 c0.776 0.6 1.2 1 2.6 1.096c3.047-0.125 3.981-2.578 4.029-4.321c0.002-0.933-0.238-1.729-0.781-2.396 C19.256 9.3 19.9 8.4 20.2 8.047z M8.26 15.025c-1.592 0-2.887-1.299-2.887-2.887c0-1.592 1.295-2.888 2.887-2.888 c1.591 0 2.9 1.3 2.9 2.888C11.146 13.7 9.9 15 8.3 15.025z M15.825 14.965c-1.584 0-2.873-1.29-2.873-2.876 c0-1.583 1.289-2.874 2.873-2.874c1.586 0 2.9 1.3 2.9 2.874C18.698 13.7 17.4 15 15.8 14.965z"/></g>',
		'<g id="foursquare"><path d="M18.511 13.164l-5.351 5.353c-0.643 0.641-1.688 0.641-2.326 0L5.48 13.164c-0.639-0.645-0.639-1.688 0-2.329l5.354-5.354 c0.638-0.638 1.685-0.638 2.3 0l2.417 2.418l-3.631 3.631l-1.707-1.712c-0.239-0.24-0.57-0.377-0.907-0.377 c-0.339 0-0.667 0.137-0.907 0.375l-1.096 1.094c-0.243 0.243-0.378 0.565-0.378 0.909c0 0.3 0.1 0.7 0.4 0.906l3.707 3.7 c0.167 0.2 0.4 0.3 0.6 0.34l0.053 0.035l0.25 0.002c0.341 0 0.666-0.134 0.905-0.376l5.636-5.635h0.023 c0.689 0.7 0.7 1.6 0.1 2.333L18.511 13.164L18.511 13.164z"/><path d="M18.571 9.409l-6.367 6.373c-0.085 0.079-0.196 0.129-0.315 0.129l0 0c-0.002 0-0.002 0-0.004 0 c-0.017 0-0.034-0.002-0.048-0.005c-0.101-0.012-0.192-0.057-0.262-0.124l-3.547-3.558c-0.173-0.171-0.171-0.452 0-0.622 l1.049-1.048c0.083-0.081 0.195-0.128 0.311-0.129c0.117 0 0.2 0.1 0.3 0.131l2.191 2.195l5.009-5.009 c0.083-0.084 0.193-0.13 0.312-0.13c0.117 0 0.2 0 0.3 0.13l1.045 1.049c0.221 0.1 0.2 0.4 0.1 0.619L18.571 9.4 L18.571 9.409z"/></g>',
		'<g id="website"><path d="M8.639 10.095c0.251-0.252 0.53-0.46 0.827-0.625c1.654-0.912 3.778-0.425 4.8 1.187l-1.287 1.3 c-0.371-0.844-1.288-1.323-2.198-1.118c-0.342 0.077-0.67 0.249-0.936 0.512l-2.468 2.467c-0.75 0.748-0.75 2 0 2.7 c0.75 0.8 2 0.8 2.7 0l0.762-0.76c0.689 0.2 1.4 0.3 2.2 0.324l-1.679 1.682c-1.439 1.438-3.771 1.438-5.211 0 c-1.439-1.438-1.439-3.771 0-5.211L8.639 10.095z M12.557 6.177l-1.681 1.677c0.732-0.054 1.4 0.1 2.2 0.331l0.764-0.761 c0.75-0.749 1.97-0.749 2.7 0c0.75 0.8 0.8 2 0 2.717l-2.465 2.466c-0.753 0.752-1.974 0.744-2.719 0 c-0.173-0.174-0.323-0.393-0.417-0.604l-1.287 1.284c0.136 0.2 0.3 0.4 0.4 0.562c0.465 0.4 1.1 0.8 1.8 1 c0.882 0.2 1.9 0.1 2.644-0.354c0.298-0.16 0.577-0.369 0.828-0.621l2.47-2.465c1.437-1.439 1.437-3.773 0-5.21 c-1.479-1.438-3.761-1.438-5.292-0.008L12.557 6.177L12.557 6.177z"/></g>',
		'<g id="mail"><path d="M5 6.984v10.031h0.012h13.954H19V6.984H5z M17.414 8.134l-5.416 4.012L6.586 8.134H17.414 z M6.188 9.289l2.902 2.151L6.188 14.25V9.289z M6.2 15.864l3.842-3.719l1.957 1.45l1.946-1.442l3.834 3.712L6.2 15.864L6.2 15.864z M17.812 14.271l-2.916-2.824l2.916-2.159V14.271z"/></g>',
		'<g id="behance"><path d="M11.429 8.664c0.27 0.4 0.4 0.8 0.4 1.385c0 0.554-0.138 0.999-0.407 1.3 c-0.152 0.188-0.374 0.36-0.671 0.499c0.45 0.2 0.8 0.4 1 0.804c0.229 0.4 0.3 0.8 0.3 1.3 c0 0.535-0.133 1.021-0.39 1.397c-0.164 0.282-0.374 0.522-0.62 0.722c-0.282 0.217-0.61 0.363-0.992 0.5 c-0.381 0.076-0.794 0.128-1.236 0.128H4.836V7.694H9.07c1.156-0.03 1.9 0.4 2.4 0.97H11.429z M6.686 9.345v2.015h2.145 c0.382 0 0.694-0.078 0.931-0.227c0.241-0.149 0.36-0.417 0.36-0.804c0-0.422-0.159-0.707-0.475-0.841 C9.374 9.4 9 9.3 8.6 9.345l-1.92 0.017V9.345z M6.686 12.874v2.438h2.142c0.385 0 0.682-0.055 0.894-0.164 c0.387-0.201 0.581-0.573 0.581-1.137c0-0.479-0.188-0.812-0.563-0.984c-0.209-0.098-0.501-0.146-0.883-0.152L6.686 12.9 L6.686 12.874z M17.494 10.061c0.445 0.2 0.8 0.5 1.1 0.979c0.262 0.4 0.4 0.9 0.5 1.4 c0.041 0.3 0.1 0.7 0.1 1.312h-4.637c0.023 0.7 0.3 1.1 0.7 1.396c0.248 0.2 0.6 0.2 0.9 0.2 c0.383 0 0.688-0.104 0.924-0.309c0.133-0.104 0.188-0.164 0.289-0.354h1.734c-0.041 0.396-0.232 0.688-0.598 1.1 c-0.568 0.646-1.363 0.97-2.396 0.999c-0.848 0-1.596-0.271-2.236-0.812c-0.652-0.543-0.835-1.439-0.835-2.659 c0-1.144 0.147-2.012 0.735-2.621c0.584-0.611 1.344-0.916 2.275-0.916c0.559-0.023 1.1 0.1 1.5 0.293L17.494 10.061z M14.811 11.632c-0.232 0.256-0.328 0.775-0.391 1.198l3.064 0.034c-0.033-0.468-0.074-0.964-0.412-1.413 c-0.271-0.244-0.752-0.295-1.156-0.295c-0.438 0.003-0.818 0.203-1.113 0.477L14.811 11.632L14.811 11.632z M18.586 7.207h-4.707 v1.584h4.707V7.207z"/></g>',
		'<g id="stumbleupon"><path d="M12.719 10.35l0.917 0.499l1.456-0.477v-0.96c0-1.656-1.422-2.944-3.11-2.944 c-1.687 0-3.116 1.205-3.116 2.949c0 1.7 0 4.4 0 4.384c0 0.401-0.332 0.723-0.738 0.723c-0.409 0-0.74-0.318-0.74-0.723v-1.855 H5v1.896c0 1.7 1.4 3.1 3.2 3.034c1.71 0 3.096-1.336 3.121-2.991V9.517c0-0.396 0.331-0.718 0.74-0.718 c0.407 0 0.7 0.3 0.7 0.718v0.833H12.719z M16.573 11.918v1.943c0 0.396-0.33 0.719-0.738 0.7 c-0.41 0-0.737-0.32-0.737-0.723v-1.906l-1.459 0.478l-0.916-0.499v1.891c0.02 1.7 1.4 3.1 3.2 3.1 c1.719 0 3.117-1.362 3.117-3.032c0-0.025 0-1.887 0-1.887L16.573 11.918L16.573 11.918z"/></g>',
		'<g id="instagram"><rect x="3" y="3" display="none" opacity="0.7" fill="#27AAE1" enable-background="new    " width="16" height="16"/><path d="M15.121 11.582l3.023-0.032v4.181c0 1.334-1.095 2.42-2.437 2.42H8.283c-1.344 0-2.434-1.086-2.434-2.42v-4.173h3.097 c-0.08 0.677-0.096 0.745-0.056 1.052c0.233 1.8 1.8 2.6 3.2 2.652c1.672 0.1 2.703-0.996 3.123-2.927 c-0.045-0.729-0.017 0.085-0.017-0.752L15.121 11.582L15.121 11.582z M8.226 5.851C8.246 5.8 8.3 5.8 8.3 5.85h0.393 M8.279 5.85h7.431c1.343 0 2.4 1.1 2.4 2.421l0.002 2.33h-3.375c-0.527-0.672-1.499-1.71-2.784-1.674 c-1.755 0.048-2.28 1.089-2.663 1.727L5.85 10.56V8.271c0-0.816 0.317-2.02 1.821-2.419 M16.739 7.5 c0-0.191-0.155-0.342-0.345-0.342h-1.166c-0.19 0-0.34 0.15-0.34 0.342v1.181c0 0.2 0.1 0.3 0.3 0.343h1.164 c0.188 0 0.345-0.155 0.345-0.343V7.5l0.037 0.039V7.5z M10.207 12.054c0 1 0.8 1.8 1.8 1.9 c0.986 0 1.788-0.891 1.788-1.88c0-0.983-0.802-1.779-1.789-1.779c-1.029 0.011-1.867 0.823-1.867 1.779H10.207z"/></g>',
		'<g id="github"><path d="M15.604 5.666c-0.662 0.286-1.369 0.442-2.124 0.472C13 5.9 12.4 5.7 11.8 5.666c-1.562 0-3.112 1.052-3.177 2.8 c-0.047 1.3 0.5 2.2 1.6 2.788c-0.475 0.219-0.664 0.723-0.664 1.217c0 0.5 0.3 1 0.6 1.2 C9.041 14.2 8.4 14.9 8.4 15.889c0 3.2 7 3.3 7.004-0.136c0-1.271-0.875-2.188-3.03-2.538 c-0.852-0.118-1.304-1.413-0.046-1.647c1.803-0.296 3.015-1.998 2.38-3.867c0.269-0.04 0.537-0.105 0.801-0.196l0.097-1.818V5.666 H15.604z M12.002 14.818c0.982-0.02 1.6 0.3 1.6 0.951c0.014 0.674-0.539 0.979-1.482 0.9 c-1.049-0.003-1.643-0.292-1.664-0.986c0.004-0.549 0.484-0.861 1.631-0.902H12.002L12.002 14.818z M11.856 10 c-0.831 0.012-1.212-0.445-1.213-1.329c0-0.806 0.369-1.309 1.194-1.314c0.738-0.003 1.1 0.5 1.1 1.4 C13.041 9.5 12.6 10 11.8 9.98L11.856 9.96z"/></g>',
		'<g id="skype"><path d="M18.412 12.034c0-3.541-2.889-6.412-6.447-6.412c-0.353 0-0.7 0.028-1.038 0.083c-0.604-0.394-1.323-0.623-2.101-0.623 c-2.124 0-3.846 1.723-3.846 3.847c0 0.8 0.2 1.5 0.6 2.094c-0.053 0.33-0.079 0.667-0.079 1 c0 3.5 2.9 6.4 6.4 6.414c0.402 0 0.795-0.041 1.176-0.107c0.589 0.4 1.3 0.6 2 0.6 c2.126 0 3.849-1.725 3.849-3.848c0-0.803-0.246-1.551-0.668-2.167C18.391 12.6 18.4 12.3 18.4 12.034z M12.568 16.8 c-2.049 0.105-3.007-0.348-3.886-1.172c-0.98-0.918-0.587-1.969 0.213-2.021c0.798-0.053 1.3 0.9 1.7 1.2 c0.427 0.3 2 0.9 2.901-0.104c0.933-1.062-0.621-1.614-1.758-1.782C10.121 12.6 8.1 11.7 8.2 10 c0.159-1.729 1.468-2.617 2.847-2.742c1.757-0.159 2.9 0.3 3.8 1.037c1.046 0.9 0.5 1.89-0.187 2 c-0.664 0.079-1.411-1.468-2.874-1.49c-1.509-0.022-2.528 1.571-0.665 2.024c1.861 0.5 3.9 0.6 4.6 2.3 C16.455 14.8 14.6 16.7 12.6 16.76z"/></g>',
		'<g id="devian"><path d="M11.747 10.649c2.892-0.069 5.2 1.4 5.6 3.778l-2.893 0.058l-0.02-1.923c-0.629-0.337-0.83-0.45-1.492-0.523 l-0.035 3.913H20c-0.374-3.838-3.814-6.841-8.001-6.841c-0.073 0-0.146 0-0.216 0.001L11.8 7.1 c-0.66-0.056-1.126 0.276-1.757 0.629l-0.012 1.624C6.868 10.1 4.3 12.8 4 15.95h7.785v-5.301H11.747z M10.072 14.4 l-3.359 0.086c0.262-1.62 1.974-3.136 3.333-3.597L10.072 14.37z"/></g>',
		'<g id="pinterest"><path d="M8.317 13.361c0.703-1.242-0.227-1.515-0.372-2.416c-0.596-3.68 4.244-6.193 6.779-3.622 c1.754 1.8 0.6 7.256-2.229 6.687c-2.71-0.545 1.325-4.901-0.836-5.756c-1.757-0.696-2.689 2.126-1.856 3.5 c-0.489 2.411-1.541 4.682-1.114 7.708c1.381-1.002 1.847-2.924 2.228-4.924c0.695 0.4 1.1 0.9 2 0.9 c3.264 0.3 5.089-3.258 4.641-6.5c-0.396-2.872-3.259-4.335-6.313-3.992c-2.415 0.27-4.822 2.222-4.922 5 C6.211 11.7 6.7 13 8.3 13.361z"/></g>',
		'<g id="tumbler"><path d="M10.493 5.792c-0.073 0.618-0.211 1.126-0.41 1.526C9.884 7.7 9.6 8.1 9.3 8.35c-0.328 0.289-0.72 0.507-1.18 0.7 v1.71h1.285v4.198c0 0.5 0.1 0.9 0.2 1.252c0.111 0.3 0.3 0.5 0.6 0.828c0.289 0.2 0.6 0.4 1 0.6 c0.412 0.1 0.9 0.2 1.4 0.205c0.47 0 0.911-0.049 1.313-0.146c0.401-0.097 0.858-0.266 1.358-0.508v-1.896 c-0.586 0.396-1.176 0.589-1.771 0.589c-0.335 0-0.63-0.078-0.89-0.235c-0.195-0.117-0.331-0.281-0.405-0.479 c-0.068-0.196-0.106-0.641-0.106-1.336v-3.073h2.784V8.824H12.21V5.792H10.493z"/></g>',
		'<g id="vimeo"><path d="M17.732 9.417c-0.051 1.179-0.83 2.796-2.342 4.85c-1.561 2.144-2.878 3.215-3.959 3.258c-0.668 0-1.235-0.65-1.697-1.959 c-0.306-1.195-0.617-2.396-0.925-3.587c-0.34-1.373-0.678-1.984-1.085-1.984c-0.086 0-0.386 0.192-0.899 0.571L6.268 9.8 c0.565-0.526 1.15-1.036 1.66-1.576c0.754-0.688 1.321-1.053 1.7-1.088c0.893-0.091 1.4 0.5 1.6 1.9 c0.225 1.5 0.4 2.4 0.5 2.779c0.256 1.2 0.5 1.8 0.8 1.834c0.24 0 0.601-0.402 1.082-1.206 c0.481-0.802 0.739-1.413 0.772-1.834c0.066-0.689-0.188-1.037-0.772-1.037c-0.276 0-0.561 0.065-0.85 0.2 c0.565-1.953 1.645-2.901 3.232-2.846c1.198 0.1 1.8 0.9 1.7 2.447H17.732z"/></g>',
		'<g id="linkedin"><path d="M9.269 7.02c0 0.714-0.586 1.293-1.307 1.293c-0.722 0-1.307-0.579-1.307-1.293 c0-0.712 0.585-1.291 1.307-1.291C8.683 5.7 9.3 6.3 9.3 7.02H9.269z M9.061 9.279H6.873v7.392h2.188V9.279z M12.91 9.3 h-1.795l-0.027 7.392h2.044c0 0 0-2.742 0-3.879c0-1.04 0.775-1.79 1.7-1.665c0.824 0.1 1.1 0.6 1.1 1.7 c0 1.028-0.021 3.915-0.021 3.89h2.025c0 0 0.025-2.729 0.025-4.708c0-1.981-1.006-2.78-2.604-2.78 c-1.599 0-2.248 1.096-2.248 1.096v-1H12.91z"/></g>',
		'<g id="lastfm"><path d="M11.217 15.157l-0.538-1.458c0 0-0.87 0.972-2.177 0.972c-1.159 0-1.979-1.009-1.979-2.621c0-2.064 1.04-2.807 2.063-2.807 c1.475 0 1.9 1 2.3 2.185l0.538 1.678c0.535 1.6 1.5 2.9 4.4 2.938c2.082 0 3.488-0.638 3.488-2.318 c0-1.357-0.771-2.063-2.216-2.4l-1.071-0.233c-0.739-0.17-0.953-0.472-0.953-0.973c0-0.572 0.453-0.907 1.188-0.907 c0.808 0 1.2 0.3 1.3 1.023l1.681-0.201c-0.088-1.521-1.174-2.125-2.884-2.135c-1.512 0-2.987 0.571-2.987 2.4 c0 1.1 0.5 1.9 1.9 2.203l1.141 0.27c0.854 0.2 1.1 0.6 1.1 1.042c0 0.624-0.603 0.877-1.739 0.9 c-1.697 0-2.399-0.893-2.802-2.116l-0.555-1.677c-0.702-2.184-1.826-2.99-4.058-2.99c-2.467 0-3.771 1.562-3.771 4.2 c0 2.5 1.3 3.9 3.6 3.93c2.041-0.041 2.903-0.947 2.903-0.94h0.042V15.157z"/></g>',
		'<g id="forrst"><polygon points="11.404,15.574 9.438,13.961 10.031,13.381 11.404,14.055 11.404,10.815 12.492,10.815 12.492,12.521 14.07,12.043 14.365,12.904 12.596,13.67 12.596,14.715 15.158,13.766 15.548,14.625 12.596,16.053 12.596,17.771 17.913,17.771 12,4.229 6.087,17.771 11.404,17.771 "/></g>',
		'<g id="flickr"><circle cx="8.3" cy="12" r="2.8"/><circle cx="15.7" cy="12" r="2.8"/></g>',
		'<g id="delicious"><path d="M16.553 6H7.457C6.652 6 6 6.7 6 7.454v9.089c0 0.9 0.6 1.5 1.4 1.455h9.095c0.806 0 1.458-0.651 1.458-1.455 V7.454C18.014 6.7 17.4 6 16.6 6H16.553z M16.906 16.327c0 0.252-0.344 0.605-0.594 0.582H12V12H7.219L7.188 7.8 c0-0.251 0.407-0.646 0.656-0.646H12v4.844h4.938L16.906 16.327L16.906 16.327z"/></g>',
		'<g id="rss"><path d="M9.258 16.374c0 0.894-0.728 1.62-1.625 1.62s-1.625-0.729-1.625-1.62c0-0.896 0.729-1.618 1.625-1.618 c0.898-0.027 1.7 0.7 1.7 1.618H9.258z M6.007 10.099v2.4c3.026 0 5.4 2.5 5.6 5.496h2.408 c-0.075-4.356-3.594-7.841-7.949-7.896H6.007z M6.007 8.419c2.556 0 5 1 6.8 2.812c1.812 1.9 2.8 4.2 2.8 6.751H18 C17.982 11.4 12.6 6 6 6.005L6.007 8.419L6.007 8.419z"/></g>',
		'<g id="you-tube"><path d="M18.877 9.35c-0.22-1.924-0.96-2.189-2.438-2.292c-2.101-0.147-6.781-0.147-8.88 0C6.084 7.2 5.3 7.4 5.1 9.3 c-0.163 1.429-0.164 3.9 0 5.298c0.22 1.9 1 2.2 2.4 2.294c2.099 0.1 6.8 0.1 8.9 0 c1.477-0.104 2.217-0.369 2.437-2.294C19.041 13.2 19 10.8 18.9 9.35z M9.69 15.335v-6.65l5.623 3.324L9.69 15.335z"/></g>',
		'<g id="dribbble"><path d="M12.012 5C8.139 5 5 8.1 5 12c0 3.8 3.1 7 7 7C15.861 19 19 15.9 19 12c0.025-3.857-3.075-7-7.012-7H12.012 z M17.787 11.674c-1.506-0.246-2.889-0.259-4.15-0.043c-0.145-0.329-0.291-0.656-0.447-0.979c1.352-0.583 2.438-1.376 3.244-2.378 c0.787 1 1.3 2.1 1.4 3.401L17.787 11.674L17.787 11.674z M15.54 7.456c-0.701 0.907-1.671 1.624-2.91 2.1 c-0.595-1.086-1.273-2.143-2.038-3.173c0.455-0.115 0.928-0.185 1.42-0.185c1.331-0.066 2.5 0.4 3.5 1.18L15.54 7.456z M9.398 6.847c0.779 1 1.5 2.1 2.1 3.138c-1.419 0.418-3.115 0.631-5.073 0.688c0.405-1.743 1.56-3.118 3.037-3.826H9.398 z M6.217 12c0-0.052 0.007-0.1 0.01-0.151c2.247-0.004 4.187-0.263 5.812-0.771c0.136 0.3 0.3 0.6 0.4 0.8 c-1.975 0.615-3.603 1.877-4.868 3.781C6.725 14.7 6.2 13.4 6.2 12H6.217z M8.458 16.6 c1.15-1.799 2.619-2.971 4.437-3.512c0.543 1.4 1 2.8 1.2 4.354c-0.646 0.246-1.348 0.39-2.077 0.4 c-1.329-0.055-2.571-0.546-3.555-1.273L8.458 16.593z M15.229 16.807c-0.258-1.371-0.636-2.716-1.121-4.021 c1.094-0.157 2.305-0.112 3.6 0.112c-0.273 1.634-1.23 3.009-2.516 3.908H15.229L15.229 16.807z"/></g>',
		'<g id="google"><path d="M19.02 10.145h-1.953l0.021 1.958h-1.344l-0.021-1.937l-1.854-0.019l-0.023-1.258l1.896-0.008V6.864h1.343V8.86 l1.938 0.042v1.243H19.02z M13.254 15.303c0 1.217-1.107 2.698-3.899 2.698c-2.043 0-3.748-0.884-3.748-2.364 c0-1.146 0.725-2.624 4.107-2.624c-0.5-0.412-0.625-0.985-0.318-1.604c-1.98 0-2.995-1.166-2.995-2.645 c0-1.447 1.076-2.762 3.271-2.762c0.557 0 3.5 0 3.5 0l-0.809 0.823h-0.923c0.651 0.4 1 1.1 1 2 c0 0.778-0.427 1.407-1.036 1.874c-1.085 0.838-0.807 1.4 0.3 2.133c1.091 0.8 1.5 1.5 1.5 2.48L13.254 15.3 L13.254 15.303z M10.863 8.771C10.712 7.8 10 7.1 9.1 7.068c-0.872-0.021-1.457 0.687-1.307 1.6 c0.151 0.9 0.9 1.6 1.9 1.562c0.848 0.1 1.305-0.531 1.201-1.458L10.863 8.771z M11.544 15.5 c0-0.707-0.78-1.379-2.087-1.379c-1.178-0.017-2.179 0.615-2.179 1.354c0 0.7 0.8 1.4 2 1.4 c1.56-0.031 2.338-0.553 2.338-1.334H11.544z"/></g>',
		'<g id="twitter"><path d="M18.614 6.604c-0.556 0.325-1.171 0.561-1.822 0.688c-0.526-0.551-1.271-0.896-2.099-0.896 c-1.586 0-2.875 1.269-2.875 2.83c0 0.2 0 0.4 0.1 0.646c-2.385-0.119-4.5-1.247-5.916-2.959 C5.729 7.3 5.6 7.8 5.6 8.336c0 1 0.5 1.9 1.3 2.354c-0.47-0.014-0.912-0.141-1.3-0.354c0 0 0 0 0 0 c0 1.4 1 2.5 2.3 2.774c-0.241 0.062-0.495 0.102-0.756 0.102c-0.186 0-0.365-0.02-0.541-0.055 c0.365 1.1 1.4 1.9 2.7 1.971c-0.982 0.756-2.222 1.208-3.567 1.208c-0.232 0-0.461-0.016-0.686-0.04 c1.271 0.8 2.8 1.3 4.4 1.272c5.286 0 8.171-4.312 8.171-8.055c0-0.123-0.003-0.246-0.009-0.367 C18.127 8.8 18.6 8.3 19 7.72c-0.516 0.225-1.068 0.378-1.648 0.446C17.943 7.8 18.4 7.3 18.6 6.604z"/></g>',
		'<g id="facebook"><path d="M14.545 11.521l-1.74 0.002l0.052 6.648h-2.453l0.014-6.648H8.824V9.421h1.592l-0.001-1.236 c0-1.713 0.485-2.756 2.592-2.756h1.758V7.53h-1.098c-0.824 0-0.863 0.293-0.863 0.84l-0.004 1.051h1.975L14.545 11.521z"/></g>',
		'<g id="xing"><polygon points="18.2,5 15.3,5 10.6,13.4 13.7,19 16.6,19 13.4,13.4"/><polygon points="9.5,7.6 6.6,7.6 8.2,10.3 5.8,14.6 8.7,14.6 11.2,10.3"/></g>',
		'<g id="odnoklassniki"><path d="M12.001 12.212c1.819 0 3.299-1.542 3.299-3.442c0-1.897-1.479-3.442-3.299-3.442c-1.822 0-3.302 1.544-3.302 3.4 C8.699 10.7 10.2 12.2 12 12.212z M12.001 7.346c0.753 0 1.4 0.6 1.4 1.424c0 0.788-0.612 1.426-1.365 1.4 s-1.367-0.638-1.367-1.426C10.634 8 11.2 7.3 12 7.346z"/><path d="M15.557 12.802c-0.285-0.47-0.883-0.613-1.334-0.315c-1.353 0.888-3.094 0.886-4.444 0 c-0.454-0.298-1.049-0.155-1.333 0.315c-0.286 0.473-0.149 1.1 0.3 1.393c0.597 0.4 1.2 0.7 1.9 0.826l-1.847 1.9 c-0.376 0.393-0.376 1 0 1.426c0.19 0.2 0.4 0.3 0.7 0.295c0.25 0 0.498-0.101 0.685-0.295l1.815-1.894l1.812 1.9 c0.377 0.4 1 0.4 1.4 0c0.379-0.396 0.379-1.033 0-1.426l-1.849-1.929c0.675-0.156 1.319-0.437 1.918-0.826 C15.704 13.9 15.8 13.3 15.6 12.802z"/></g>',
		'<g id="weibo"><path fill="none" d="M10.852 10.982c-0.188 0.001-0.379 0.012-0.571 0.03c-2.466 0.231-4.341 1.763-4.188 3.4 c0.153 1.7 2.3 2.8 4.7 2.582c2.469-0.23 4.344-1.766 4.188-3.42C14.884 12.1 13.1 11 10.9 10.982z M11.108 16.211c-1.224 0.528-2.753 0.096-3.123-0.938c-0.37-1.034 0.026-2.414 1.641-2.95c0.216-0.071 0.472-0.111 0.736-0.112 c0.795 0 1.7 0.3 2.1 1.232C12.883 14.4 12.3 15.7 11.1 16.211z"/><path fill="none" d="M10.749 13.609c-0.063 0-0.129 0.016-0.192 0.048c-0.169 0.091-0.25 0.274-0.181 0.4 c0.067 0.1 0.3 0.2 0.4 0.086c0.169-0.092 0.251-0.274 0.182-0.41C10.943 13.7 10.9 13.6 10.7 13.609z"/><path fill="none" d="M9.57 13.982c-0.158 0-0.328 0.043-0.494 0.14c-0.443 0.257-0.518 0.696-0.329 1.1 c0.133 0.3 0.7 0.4 1.1 0.14c0.443-0.258 0.483-0.799 0.309-1.08C10.059 14.1 9.8 14 9.6 13.982z"/><path d="M16.672 10.558c0.605 0.2 0.823-0.293 0.791-1.008c-0.023-0.497-0.229-0.817-0.35-1.026 c-0.319-0.541-0.963-0.885-1.555-0.893c-0.109-0.001-0.218 0.008-0.32 0.031c-0.283 0.061-0.624 0.182-0.494 0.7 c0.143 0.5 0.9 0.2 1.3 0.427s0.374 0.4 0.4 0.714C16.499 9.9 16.2 10.4 16.7 10.558z"/><path d="M19.473 9.129c-0.088-1.024-0.719-2.061-1.505-2.708c-0.653-0.54-1.608-0.859-2.464-0.864 c-0.122 0-0.242 0.006-0.359 0.019c-0.463 0.049-0.938 0.153-0.945 0.692c-0.012 0.5 0.4 0.6 0.6 0.6 c0.859-0.037 1.621-0.222 2.6 0.649c0.574 0.5 1 1.5 0.9 2.076c-0.168 1.098-0.326 1.5 0.2 1.7 C19.574 11.6 19.5 9.9 19.5 9.129z"/><path d="M10.362 12.211c-0.266 0.001-0.52 0.04-0.736 0.112c-1.615 0.536-2.011 1.916-1.641 3 c0.37 1 1.9 1.5 3.1 0.938c1.223-0.529 1.774-1.787 1.344-2.768C12.063 12.6 11.2 12.2 10.4 12.211z M9.858 15.354c-0.442 0.256-0.979 0.144-1.111-0.14c-0.189-0.396-0.112-0.835 0.329-1.092c0.165-0.097 0.336-0.14 0.493-0.14 c0.263 0 0.5 0.1 0.6 0.291C10.34 14.6 10.3 15.1 9.9 15.354z"/><path d="M15.493 11.402c-0.163-0.054 0.651-1.638-0.241-2.087c-1.504-0.756-3.555 0.668-3.464 0.3 c0.168-0.719 0.526-2.196-0.743-2.264c-0.087-0.009-0.176-0.013-0.265-0.012c-2.777 0.022-6.688 4.516-6.246 6.9 c0.479 2.6 3.6 3.8 6.7 3.658c2.804 0 6.714-2.161 6.292-4.678C17.516 12.4 16.6 11.8 15.5 11.402z M10.837 17.016c-2.466 0.23-4.589-0.927-4.743-2.582c-0.153-1.657 1.72-3.188 4.188-3.419c0.193-0.019 0.383-0.029 0.571-0.03 c2.212-0.018 4 1.1 4.2 2.615C15.18 15.3 13.3 16.8 10.8 17.016z"/></g>',
		'<g id="research-gate"><path d="M11.338,16.022c-0.048-0.261-0.078-0.633-0.087-1.129c-0.007-0.49-0.033-0.906-0.07-1.242c-0.039-0.34-0.111-0.614-0.216-0.842c-0.104-0.221-0.252-0.387-0.44-0.501c-0.194-0.119-0.45-0.196-0.772-0.239v-0.027c0.531-0.114,0.922-0.365,1.174-0.758c0.252-0.394,0.377-0.901,0.377-1.522c0-0.808-0.215-1.404-0.651-1.8c-0.435-0.396-1.039-0.591-1.825-0.591H5.358v9.262h1.879v-3.916h0.994c0.384,0,0.66,0.101,0.821,0.312c0.165,0.209,0.253,0.494,0.271,0.856l0.053,1.774c0.007,0.188,0.024,0.357,0.051,0.523c0.024,0.17,0.089,0.318,0.185,0.449h2.057V16.56C11.495,16.463,11.386,16.28,11.338,16.022z M9.062,11.142c-0.244,0.214-0.592,0.317-1.041,0.317H7.237V8.787h0.887c0.869,0,1.302,0.428,1.302,1.285C9.426,10.574,9.306,10.932,9.062,11.142z"/><path d="M15.606,11.641v1.374h1.235v0.947c0,0.247-0.036,0.467-0.114,0.654c-0.08,0.188-0.177,0.338-0.295,0.458c-0.115,0.125-0.242,0.214-0.38,0.271c-0.131,0.066-0.256,0.096-0.368,0.096c-0.269,0-0.486-0.09-0.656-0.25c-0.174-0.17-0.299-0.414-0.396-0.73c-0.092-0.314-0.155-0.693-0.188-1.141c-0.033-0.446-0.051-0.95-0.051-1.509c0-1.162,0.1-1.991,0.305-2.491c0.193-0.502,0.521-0.753,0.973-0.753c0.193,0,0.357,0.05,0.49,0.147c0.133,0.102,0.246,0.225,0.332,0.376c0.088,0.152,0.148,0.319,0.189,0.506s0.057,0.361,0.057,0.525h1.801c0-0.943-0.225-1.666-0.678-2.172c-0.451-0.507-1.189-0.761-2.217-0.761c-0.601,0-1.103,0.101-1.5,0.302c-0.398,0.196-0.724,0.494-0.965,0.887c-0.242,0.394-0.416,0.885-0.513,1.473c-0.104,0.588-0.151,1.271-0.151,2.047c0,0.808,0.032,1.512,0.104,2.122c0.065,0.606,0.205,1.123,0.409,1.537c0.199,0.413,0.486,0.729,0.847,0.938c0.358,0.214,0.834,0.317,1.403,0.317c0.439,0,0.822-0.078,1.142-0.244c0.313-0.162,0.588-0.426,0.812-0.791h0.029v0.855h1.379v-4.991H15.606z"/></g>'
		];


		var icons = $('<svg id="svg-source" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" style="position:absolute; margin-left: -100%" xmlns:xlink="http://www.w3.org/1999/xlink">'+icons+'</svg>');
		
		$(document.body).prepend($(icons));

		
		$(".soc-ico a").not(".entry-share .soc-ico a").html('<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#social-500px"></use></svg>');
		$(".entry-share .soc-ico a").append('<svg class="icon" viewBox="0 0 24 24"><use xlink:href="#social-500px"></use></svg>')
		var svg_icon = $(".soc-ico a svg use");

		$(".px-500").find(svg_icon).attr("xlink:href", "#social-500px");
		$(".tripedvisor").find(svg_icon).attr("xlink:href", "#tripedvisor");
		$(".vk").find(svg_icon).attr("xlink:href", "#vk");
		$(".foursquare").find(svg_icon).attr("xlink:href", "#foursquare");
		$(".website").find(svg_icon).attr("xlink:href", "#website");
		$(".mail").find(svg_icon).attr("xlink:href", "#mail");
		$(".behance").find(svg_icon).attr("xlink:href", "#behance");
		$(".stumbleupon").find(svg_icon).attr("xlink:href", "#stumbleupon");
		$(".instagram").find(svg_icon).attr("xlink:href", "#instagram");
		$(".github").find(svg_icon).attr("xlink:href", "#github");
		$(".skype").find(svg_icon).attr("xlink:href", "#skype");
		$(".devian").find(svg_icon).attr("xlink:href", "#devian");
		$(".pinterest").find(svg_icon).attr("xlink:href", "#pinterest");
		$(".tumbler").find(svg_icon).attr("xlink:href", "#tumbler");
		$(".vimeo").find(svg_icon).attr("xlink:href", "#vimeo");
		$(".linkedin").find(svg_icon).attr("xlink:href", "#linkedin");
		$(".lastfm").find(svg_icon).attr("xlink:href", "#lastfm");
		$(".forrst").find(svg_icon).attr("xlink:href", "#forrst");
		$(".flickr").find(svg_icon).attr("xlink:href", "#flickr");
		$(".delicious").find(svg_icon).attr("xlink:href", "#delicious");
		$(".rss").find(svg_icon).attr("xlink:href", "#rss");
		$(".you-tube").find(svg_icon).attr("xlink:href", "#you-tube");
		$(".dribbble").find(svg_icon).attr("xlink:href", "#dribbble");
		$(".google").find(svg_icon).attr("xlink:href", "#google");
		$(".twitter").find(svg_icon).attr("xlink:href", "#twitter");
		$(".facebook").find(svg_icon).attr("xlink:href", "#facebook");
		$(".xing").find(svg_icon).attr("xlink:href", "#xing");
		$(".odnoklassniki").find(svg_icon).attr("xlink:href", "#odnoklassniki");
		$(".weibo").find(svg_icon).attr("xlink:href", "#weibo");
		$(".research-gate").find(svg_icon).attr("xlink:href", "#research-gate");
	}
});
/*---------------------------------------!-Plugins--------------------------------------------------------*/
/*
 * RoyalSlider
 *
 * @version 9.4.8:
 *
 * Copyright 2011-2012, Dmitry Semenov
 *
 */
(function($) {
	if(!$.rsModules) {
		$.rsModules = {uid:0};
	}


	function RoyalSlider(element, options) {
		var i,
			self = this,
			ua = navigator.userAgent.toLowerCase();

		self.uid = $.rsModules.uid++;
		self.ns = '.rs' + self.uid; // unique namespace for events
		// feature detection, some ideas taken from Modernizr
		var tempStyle = document.createElement('div').style,
			vendors = ['webkit','Moz','ms','O'],
			vendor = '',
			lastTime = 0,
			tempV;

		for (i = 0; i < vendors.length; i++ ) {
			tempV = vendors[i];
			if (!vendor && (tempV + 'Transform') in tempStyle ) {
				vendor = tempV;
			}
			tempV = tempV.toLowerCase();
			
			if(!window.requestAnimationFrame) {
				window.requestAnimationFrame = window[tempV+'RequestAnimationFrame'];
						window.cancelAnimationFrame = window[tempV+'CancelAnimationFrame'] 
																	 || window[tempV+'CancelRequestAnimationFrame'];
			}
		}

		// requestAnimationFrame polyfill by Erik Möller
		// fixes from Paul Irish and Tino Zijdel
			if (!window.requestAnimationFrame) {
					window.requestAnimationFrame = function(callback, element) {
							var currTime = new Date().getTime(),
								timeToCall = Math.max(0, 16 - (currTime - lastTime)),
								id = window.setTimeout(function() { callback(currTime + timeToCall); }, timeToCall);
							lastTime = currTime + timeToCall;
							return id;
					};
			}
			if (!window.cancelAnimationFrame) 
				window.cancelAnimationFrame = function(id) { clearTimeout(id); };

			self.isIPAD = ua.match(/(ipad)/);


			// browser UA sniffing, sadly still required
			var uaMatch = function( ua ) {
				var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
						/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
						/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
						/(msie) ([\w.]+)/.exec( ua ) ||
						ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
						[];

				return {
						browser: match[ 1 ] || "",
						version: match[ 2 ] || "0"
				};
		};
		var matched = uaMatch( ua );
		var br = {};
		if ( matched.browser ) {
				br[ matched.browser ] = true;
				br.version = matched.version;
		}
		if(br.chrome) { br.webkit = true; };
		self._browser = br;
		self.isAndroid = ua.indexOf("android") > -1;



			self.slider = $(element); // DOM reference
		self.ev = $(self); // event object
		self._doc = $(document);
		self.st = $.extend({}, $.fn.royalSlider.defaults, options); 
		self._currAnimSpeed = self.st.transitionSpeed;
		self._minPosOffset = 0;
		if(self.st.allowCSS3) {
			if((!br.webkit || self.st.allowCSS3OnWebkit) ) {
					var bT = vendor + (vendor ? 'T' : 't' );
					self._useCSS3Transitions = ( (bT + 'ransform') in tempStyle ) && ( (bT + 'ransition') in tempStyle );
					if(self._useCSS3Transitions) {
						self._use3dTransform = (vendor + (vendor ? 'P' : 'p'  ) + 'erspective') in tempStyle;
					}
				}
		}
			
			vendor = vendor.toLowerCase();
			self._vendorPref = '-'+vendor+'-';
		
		self._slidesHorizontal = (self.st.slidesOrientation === 'vertical') ? false : true;
		self._reorderProp = self._slidesHorizontal ? 'left' : 'top';
		self._sizeProp = self._slidesHorizontal ? 'width' : 'height';
		self._prevNavItemId = -1;
		self._isMove = (self.st.transitionType === 'fade') ? false : true;
		if(!self._isMove) {
			self.st.sliderDrag = false;
			self._fadeZIndex = 10;
		}
		self._opacityCSS = 'z-index:0; display:none; opacity:0;';

		self._newSlideId = 0;
		self._sPosition = 0;
		self._nextSlidePos = 0;

		// init modules
		$.each($.rsModules, function (helper, opts) {
			if(helper !== 'uid')
				opts.call(self);
		});

		// parse all slides
		self.slides = [];
		self._idCount = 0;
		var returnVal;
		var ts = self.st.slides ? $(self.st.slides) : self.slider.children().detach();
		
		ts.each(function() {
			self._parseNode(this, true);
		});

		if(self.st.randomizeSlides) {
				self.slides.sort(function() { return 0.5 - Math.random() });
			}
		self.numSlides = self.slides.length;
		self._refreshNumPreloadImages();

		if(!self.st.startSlideId) {
			self.st.startSlideId = 0;
		} else if(self.st.startSlideId > self.numSlides - 1) {
			self.st.startSlideId = self.numSlides - 1;
		}

		self._newSlideId = self.staticSlideId = self.currSlideId = self._realId =  self.st.startSlideId;
		self.currSlide = self.slides[self.currSlideId];

		self._accelerationPos = 0;
		self.msTouch = false;
		self.slider.addClass( (self._slidesHorizontal ? 'rsHor' : 'rsVer') + (self._isMove ? '' : ' rsFade') );

		var sliderHTML = '<div class="rsOverflow"><div class="rsContainer">';
		self.slidesSpacing = self.st.slidesSpacing;
		self._slideSize = ( self._slidesHorizontal ? self.slider.width() : self.slider.height() ) + self.st.slidesSpacing;

		self._preload = Boolean(self._numPreloadImages > 0);
		
		if(self.numSlides <= 1) {
			self._loop = false;
		}
		var loopHelpers = (self._loop && self._isMove) ? ( self.numSlides === 2 ? 1 : 2) : 0;
		self._loopHelpers = loopHelpers;

		self._maxImages = self.numSlides < 6 ? self.numSlides : 6;
		self._currBlockIndex = 0;


		self._idOffset = 0;
		self.slidesJQ = [];
		
		for(i =0; i < self.numSlides; i++) {
			self.slidesJQ.push( $(createItemHTML(i)) );
		}
		self._sliderOverflow = sliderHTML = $(sliderHTML + '</div></div>');


		var addCursors = function() {
			if(self.st.sliderDrag) {
				self._hasDrag = true;
				if (br.msie || br.opera) {
					self._grabCursor = self._grabbingCursor = "move";
				} else if(br.mozilla) {
					self._grabCursor = "-moz-grab";
					self._grabbingCursor = "-moz-grabbing";
				} else if(br.webkit && (navigator.platform.indexOf("Mac")!=-1)) {
					self._grabCursor = "-webkit-grab";
					self._grabbingCursor = "-webkit-grabbing";
				}
				self._setGrabCursor();
			}
		};
		var rsNS = self.ns;
		var addEventNames = function(pref, down, move, up, cancel) {
			self._downEvent = pref + down + rsNS;
			self._moveEvent = pref + move + rsNS;
			self._upEvent = pref + up + rsNS;
			if(cancel)
				self._cancelEvent = pref + cancel + rsNS;
		};


		// Pointer events support
		var nPointerEnabled = navigator.pointerEnabled;
		self.pointerEnabled = nPointerEnabled || navigator.msPointerEnabled;

		if(self.pointerEnabled) {
			self.hasTouch = false;
			self._lastItemFriction = 0.2;
			// Hardware supports multitouch
			self.pointerMultitouch = Boolean(navigator[ (nPointerEnabled ? 'm' : 'msM') + 'axTouchPoints' ] > 1);
			if(nPointerEnabled) {
				// >= IE11 & other devices that support pointer events
				addEventNames('pointer', 'down', 'move', 'up', 'cancel');
			} else {
				// IE10
				addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
			}
		} else {

			// IOS can't handle both touch and mouse events at once
			if(!self.isIOS) {
				addEventNames('mouse', 'down', 'move', 'up');
			} else {
				self._downEvent = self._moveEvent = self._upEvent = self._cancelEvent = '';
			}

			if('ontouchstart' in window || 'createTouch' in document) {
				self.hasTouch = true;
				self._downEvent += ' touchstart' + rsNS;
				self._moveEvent += ' touchmove' + rsNS;
				self._upEvent += ' touchend' + rsNS;
				self._cancelEvent += ' touchcancel' + rsNS;
				self._lastItemFriction = 0.5;
				if(self.st.sliderTouch) {
					self._hasDrag = true;
				}
			} else {
				self.hasTouch = false;
				self._lastItemFriction = 0.2;
			}
		}
		addCursors();
	
		self.slider.html(sliderHTML);

		
		self._controlsContainer = self.st.controlsInside ? self._sliderOverflow : self.slider;
		
		self._slidesContainer = self._sliderOverflow.children('.rsContainer');
		if(self.msEnabled) {
			self._slidesContainer.css('-ms-touch-action', self._slidesHorizontal ? 'pan-y' : 'pan-x');
		}
		self._preloader = $('<div class="rsPreloader"><div class="pace pace-active"><div class="pace-activity"></div></div></div>');
		var slides = self._slidesContainer.children('.rsSlide');

		self._currHolder = self.slidesJQ[self.currSlideId]
		self._selectedSlideHolder = 0;

		function createItemHTML(i, className) {
			return '<div style="'+ (self._isMove ? '' : (i !== self.currSlideId  ? self._opacityCSS : 'z-index:0;') ) +'" class="rsSlide '+ (className || '')+'"></div>';
		}
		
		if(self._useCSS3Transitions) {

			// some constants for CSS3
			self._TP = 'transition-property';
			self._TD = 'transition-duration';
			self._TTF = 'transition-timing-function';

			self._yProp = self._xProp = self._vendorPref +'transform';

			if(self._use3dTransform) {
				if(br.webkit && !br.chrome) {
					self.slider.addClass('rsWebkit3d');
				}

				self._tPref1 = 'translate3d(';
				self._tPref2 = 'px, ';
				self._tPref3 = 'px, 0px)';
			} else {
				self._tPref1 = 'translate(';
				self._tPref2 = 'px, ';
				self._tPref3 = 'px)';
			}
			if(!self._isMove) {
				var animObj = {};
				animObj[(self._vendorPref + self._TP)] = 'opacity';
				animObj[(self._vendorPref + self._TD)] = self.st.transitionSpeed + 'ms';
				animObj[(self._vendorPref + self._TTF)] = self.st.css3easeInOut;
				slides.css(animObj);
			} else {
				self._slidesContainer[(self._vendorPref + self._TP)] = (self._vendorPref + 'transform');
			}
			

		} else {
			self._xProp = 'left';
			self._yProp = 'top';
		}

		// !Responsiveness (on window resize)
		
		if (!self.st.disableResponsiveness) {
			var resizeTimer;
			$(window).on('resize'+self.ns, function() { 
				if(resizeTimer) {
					clearTimeout(resizeTimer);      
				}
				resizeTimer = setTimeout(function() { self.updateSliderSize(); }, 50);      
			});
		}

		self.ev.trigger('rsAfterPropsSetup'); // navigation (bullets, thumbs...) are created here

		self.updateSliderSize();


		// keyboard nav
		if(self.st.keyboardNavEnabled) {
			self._bindKeyboardNav();
		}

		if(self.st.arrowsNavHideOnTouch && (self.hasTouch || self.msTouch) ) {
			self.st.arrowsNav = false;
		}

		//Direction navigation (arrows)
		if(self.st.arrowsNav) {
			var rArr = 'rsArrow',
				container = self._controlsContainer;
			$('<div class="'+rArr+' '+rArr+'Left"><div class="'+rArr+'Icn"></div></div><div class="'+rArr+' '+rArr+'Right"><div class="'+rArr+'Icn"></div></div>').appendTo(container);

			self._arrowLeft = container.children('.'+rArr+'Left').click(function(e) {
				e.preventDefault();
				self.prev();
			});
			self._arrowRight = container.children('.'+rArr+'Right').click(function(e) {
				e.preventDefault();
				self.next();
			});

			if(self.st.arrowsNavAutoHide && !self.hasTouch) {
				self._arrowLeft.addClass('rsHidden');
				self._arrowRight.addClass('rsHidden');

				var hoverEl = container;
				hoverEl.one("mousemove.arrowshover",function() {
					self._arrowLeft.removeClass('rsHidden');
					self._arrowRight.removeClass('rsHidden');     
				});


				hoverEl.hover(
					function() {
						if(!self._arrowsAutoHideLocked) {
							self._arrowLeft.removeClass('rsHidden');
							self._arrowRight.removeClass('rsHidden');
						}
					},
					function() {
						if(!self._arrowsAutoHideLocked) {
							self._arrowLeft.addClass('rsHidden');
							self._arrowRight.addClass('rsHidden');
						}
					}
				);  
			} 
			self.ev.on('rsOnUpdateNav', function() {
				self._updateArrowsNav();
			});
			self._updateArrowsNav();
		}

			
		
		if( self._hasDrag ) {
			self._slidesContainer.on(self._downEvent, function(e) { self._onDragStart(e); }); 
		} else {
			self.dragSuccess = false;
		}
		var videoClasses = ['rsPlayBtnIcon', 'rsPlayBtn', 'rsCloseVideoBtn', 'rsCloseVideoIcn'];
		self._slidesContainer.click(function(e) {
			if(!self.dragSuccess) {
				var t = $(e.target);
				var tClass = t.attr('class');
				if( $.inArray(tClass, videoClasses) !== -1) {
							if( self.toggleVideo() ) {
						return false;
					}
					}
				if(self.st.navigateByClick && !self._blockActions) {
					if($(e.target).closest('.rsNoDrag', self._currHolder).length) {
						 return true;
					}
					self._mouseNext(e);
				} 
				self.ev.trigger('rsSlideClick');
			} 
		}).on('click.rs', 'a', function(e) {  
			if(self.dragSuccess) {            
				return false;
			} else {
				self._blockActions = true;
				setTimeout(function() {
					self._blockActions = false;
				}, 3);
			}
		});
		self.ev.trigger('rsAfterInit');
	} /* RoyalSlider Constructor End */

	/**
	 *
	 * RoyalSlider Core Prototype
	 * 
	 */
	RoyalSlider.prototype = {
		constructor: RoyalSlider,
		_mouseNext: function(e) {
			var self = this,
				relativePos = e[self._slidesHorizontal ? 'pageX' : 'pageY'] - self._sliderOffset;

				if(relativePos >= self._nextSlidePos) {
					self.next();
				} else if(relativePos < 0) {
					self.prev();
				}
		},
		_refreshNumPreloadImages: function() {
			var self = this,
				n;
			n = self.st.numImagesToPreload;
			self._loop = self.st.loop;

			if(self._loop) {
				if(self.numSlides === 2) {
					self._loop = false;
					self.st.loopRewind = true;
				} else if(self.numSlides < 2) {
					self.st.loopRewind = self._loop = false;
				}
				
			}
			if(self._loop && n > 0) {
				if(self.numSlides <= 4) {
					n = 1;
				} else {
					if(self.st.numImagesToPreload > (self.numSlides - 1) / 2 ) {
						n = Math.floor( (self.numSlides - 1) / 2 );
					}
				} 
			}
			self._numPreloadImages = n;
		},
		_parseNode: function(content, pushToSlides) {
			var self = this,
				hasImg,
				isRoot,
				hasCover,
				obj = {},
				tempEl,
				first = true;
			content = $(content);
			self._currContent = content;
			self.ev.trigger('rsBeforeParseNode', [content, obj]);
			if(obj.stopParsing) {
				return;
			}
			content = self._currContent;
			obj.id = self._idCount;
			obj.contentAdded = false;
			self._idCount++;
			obj.images = [];
			obj.isBig = false;

			if(!obj.hasCover) {
				if(content.hasClass('rsImg')) {
					tempEl = content;
					hasImg = true;
				} else {
					tempEl = content.find('.rsImg');
					if(tempEl.length) {
						hasImg = true;
					}
				}

				if(hasImg) {
					obj.bigImage = tempEl.eq(0).attr('data-rsBigImg');
					tempEl.each(function() {
						var item = $(this);
						if(item.is('a')) {
							parseEl(item, 'href');
						} else if(item.is('img')) {
							parseEl(item, 'src');
						} else {
							parseEl(item);
						}
					});
				} else if(content.is('img')) {
					content.addClass('rsImg rsMainSlideImage');
					parseEl(content, 'src');
				}
			}
			tempEl = content.find('.rsCaption');
			if(tempEl.length) {
				obj.caption = tempEl.remove();
			}
			obj.content = content;

			self.ev.trigger('rsAfterParseNode', [content, obj]);
			function parseEl(el, s) {
				if(s) {
					obj.images.push( el.attr(s) );
				} else {
					obj.images.push( el.text() );
				}
				if(first) {
					first = false;
					obj.caption = (s === 'src') ? el.attr('alt') : el.contents();
					obj.image = obj.images[0];
					obj.videoURL = el.attr('data-rsVideo');
					
					
					var wAtt = el.attr('data-rsw'),
						hAtt = el.attr('data-rsh');
					if (typeof wAtt !== 'undefined' && wAtt !== false && typeof hAtt !== 'undefined' && hAtt !== false ) {
							 obj.iW = parseInt(wAtt);
							 obj.iH = parseInt(hAtt);
					} else if(self.st.imgWidth && self.st.imgHeight ) {
						obj.iW = self.st.imgWidth;
						obj.iH = self.st.imgHeight;
					}
				}
			}
			if(pushToSlides) {
				self.slides.push(obj);
			}
			if(obj.images.length === 0) {
				obj.isLoaded = true;
				obj.isRendered = false;
				obj.isLoading = false;
				obj.images = null;
			}
			return obj;
		},
		_bindKeyboardNav: function() {
			var self = this,
				interval,
				keyCode,
				onKeyboardAction = function (keyCode) {
						if (keyCode === 37) {
						self.prev();
					} else if (keyCode === 39) {
						self.next();
					}
				};

			self._doc.on('keydown' + self.ns, function(e) {
				if(!self._isDragging) {
					keyCode = e.keyCode;
					if(keyCode === 37 || keyCode === 39) {
						if(!interval) {
									onKeyboardAction(keyCode);
									interval = setInterval(function() {
											onKeyboardAction(keyCode);
									}, 700);
							}
					}
				}
			}).on('keyup' + self.ns, function(e) {
				if(interval) {
					clearInterval(interval); 
							interval = null;
				}
			});

		},

		goTo: function(id, notUserAction) {
			var self = this;
			if(id !== self.currSlideId) {
				self._moveTo(id,self.st.transitionSpeed, true, !notUserAction);
			}
		},
		destroy: function(remove) {
			var self = this;
			self.ev.trigger('rsBeforeDestroy');
			self._doc.off('keydown' +self.ns+ ' keyup' + self.ns + ' ' + self._moveEvent +' '+ self._upEvent );
			self._slidesContainer.off(self._downEvent + ' click');  
			self.slider.data('royalSlider', null);
			$.removeData(self.slider, 'royalSlider');
			$(window).off('resize' + self.ns);
			if(remove) {
				self.slider.remove();
			}
			self.slides = null;
			self.slider = null;
			self.ev = null;
		},
		_updateBlocksContent: function(beforeTransition, getId) {
			var self = this,
				item,
				i,
				n,
				pref,
				group,
				groupId,
				slideCode,
				loop = self._loop,
				numSlides = self.numSlides;
			if(!isNaN(getId) ) {
				return getCorrectLoopedId(getId);
			}


			var id = self.currSlideId;
			var groupOffset;
			
			var itemsOnSide = beforeTransition ? (Math.abs(self._prevSlideId - self.currSlideId) >= self.numSlides - 1 ? 0 : 1) : self._numPreloadImages;
			var itemsToCheck = Math.min(2, itemsOnSide); 
			
			var updateAfter = false;
			var updateBefore = false;
			var tempId;

			for(i = id; i < id + 1 + itemsToCheck; i++) {
				tempId = getCorrectLoopedId(i);
				item = self.slides[tempId];
				if(item && (!item.isAdded || !item.positionSet) ) {
					updateAfter = true;
					break;
				}
			}
			for(i = id - 1; i > id - 1 - itemsToCheck; i--) {
				tempId = getCorrectLoopedId(i);
				item = self.slides[tempId];
				if(item && (!item.isAdded || !item.positionSet) ) {
					updateBefore = true;
					break;
				}
			}
			if(updateAfter) {
				for(i = id; i < id + itemsOnSide + 1; i++) {
					tempId = getCorrectLoopedId(i);
					groupOffset = Math.floor( (self._realId - (id - i)) / self.numSlides) * self.numSlides;
					item = self.slides[tempId];
					if(item) {
						updateItem(item, tempId); 
					}
				}
			}
			if(updateBefore) {
				for(i = id - 1; i > id - 1 - itemsOnSide; i--) {
					tempId = getCorrectLoopedId(i);
					groupOffset = Math.floor( (self._realId - (id - i) ) / numSlides) * numSlides;
					item = self.slides[tempId];
					if(item) {
						updateItem(item, tempId);
					}
				}
			}
			if(!beforeTransition) {
				var start = id;
				var distance = itemsOnSide;
				var min = getCorrectLoopedId(id - itemsOnSide);
				var max = getCorrectLoopedId(id + itemsOnSide);
				
				var nmin = min > max ? 0 : min;
				
				for (i = 0; i < numSlides; i++) { 
					if(min > max) {
						if(i > min - 1) {
							continue;
						}
					}
					if(i < nmin || i > max) {
						 item = self.slides[i];
						if(item && item.holder) {
							
							//slideCode = self.slidesJQ[i];
							//if(typeof slideCode !== "string") { 
								item.holder.detach();
								item.isAdded = false;
							//}
						}     
					}                               
					}   
			}

			function updateItem(item , i, slideCode) {

				if(!item.isAdded) {
					if(!slideCode)
						slideCode = self.slidesJQ[i];

					if(!item.holder) {
						slideCode = self.slidesJQ[i] = $(slideCode);
						item.holder = slideCode;
					} else {
						slideCode = item.holder;
					}

					item.appendOnLoaded = false;

					
					updatePos(i, item, slideCode);
					addContent(i, item);
					self._addBlockToContainer(item, slideCode, beforeTransition);
					item.isAdded = true;
					appended = true;
				} else {
					addContent(i, item);
					updatePos(i, item);
				}
			}
			function addContent(i, item) {
				if(!item.contentAdded) {
					self.setItemHtml(item, beforeTransition);
					if(!beforeTransition) {
						item.contentAdded = true;
					}
					
				}
			}
			function updatePos(i, item, slideCode) {
				if(self._isMove) {
					if(!slideCode) {
						slideCode = self.slidesJQ[i];
					}

					slideCode.css(self._reorderProp, (i + self._idOffset + groupOffset) * self._slideSize);
				}
			}
			function getCorrectLoopedId(index) {
				var changed = false;
				if(loop) {
					if(index > numSlides - 1) {
						return getCorrectLoopedId(index - numSlides);
					} else  if(index < 0) {
						return getCorrectLoopedId(numSlides + index);
					}
				}
				return index;
			}
			
		},

		/**
		 * Sets or loads HTML for specified slide
		 * @param {Object} currSlideObject  holds data about curr slide (read about rsAfterParseNode for more info)
		 * @param {Boolean} beforeTransition determines if setItemHTML method is called before or after transition
		 */
		setItemHtml: function(currSlideObject, beforeTransition) {

			var self = this;

			if(currSlideObject.isLoaded) {
				appendContent();
				return;
			} else {
				if(beforeTransition) {
					waitForTransition();
				} else {
					parseDataAndLoad();
				}
			}

			function parseDataAndLoad() {
				if(!currSlideObject.images) {
					currSlideObject.isRendered = true;
						currSlideObject.isLoaded = true;
					currSlideObject.isLoading = false;
					appendContent(true);
					return;
				}
				if(currSlideObject.isLoading) {
					return;
				}
				
				var el,
					isRoot;
				if(currSlideObject.content.hasClass('rsImg') ) {
					el = currSlideObject.content;
					isRoot = true;
				} else {
					el = currSlideObject.content.find('.rsImg:not(img)')
				}
				if(el && !el.is('img')) {
					el.each(function() {
						var item = $(this),
							newEl = '<img class="rsImg" src="'+ ( item.is('a') ? item.attr('href') : item.text() ) +'" />';

						if(!isRoot) {
							item.replaceWith( newEl );
						} else {
							currSlideObject.content = $(newEl);
						}
					});
				}
				
				el = isRoot ? currSlideObject.content : currSlideObject.content.find('img.rsImg');
				setPreloader();
				
				el.eq(0).addClass('rsMainSlideImage');
				if(currSlideObject.iW && currSlideObject.iH) {
					if(!currSlideObject.isLoaded) {
						self._resizeImage( currSlideObject );
					}
					appendContent();
				}

				currSlideObject.isLoading = true;
				var newEl;

				if(currSlideObject.isBig) {
					$('<img />').on('load.rs error.rs', function(e){
						onLoad( [this], true );
					}).attr('src', currSlideObject.image);
				} else {
					currSlideObject.loaded = [];
					currSlideObject.imgLoaders = [];
					for(var i = 0; i < currSlideObject.images.length; i++) {
						var image = $('<img />');

						currSlideObject.imgLoaders.push( this );
						image.on('load.rs error.rs', function(e){
							currSlideObject.loaded.push( this );
							if(currSlideObject.loaded.length === currSlideObject.imgLoaders.length) {
								onLoad( currSlideObject.loaded, false );
							}
						}).attr('src', currSlideObject.images[i]);
					}
				}

				// old images loading
				// el.imagesLoaded( function( $images, $proper, $broken ) {
				//  if($broken.length) {
				//    currSlideObject.isLoading = false;
				//    var img =  $images[0],
				//        src = img.src;
				//    if(src && src.indexOf(currSlideObject.image) === -1 ) {
				//        return;
				//      }
				//    if(!currSlideObject.tryAgainCount) { currSlideObject.tryAgainCount = 0; }
				//    if(currSlideObject.tryAgainCount < 3) {
				//      currSlideObject.tryAgainCount++;
				//      self.setItemHtml(currSlideObject, beforeTransition);
				//      return;
				//    }
				//  }
				//     onLoad($images);
				// });
			}
			function onLoad($images, isBig) {
				if($images.length) {
						var img = $images[0],
							src = img.src;
						
						if(isBig !== currSlideObject.isBig) {
							var c = currSlideObject.holder.children();
							if(c && c.length > 1) {
								removePreloader();
							}
							return;
						}
						
						if(currSlideObject.iW && currSlideObject.iH) {
							imageLoadingComplete();
							return;
						}
						currSlideObject.iW = img.width;
						currSlideObject.iH = img.height;
						if(currSlideObject.iW && currSlideObject.iH) {
							imageLoadingComplete();
							return;
						} else {
							// if no size, try again
							var loader = new Image();
							loader.onload = function() {
								if(loader.width) {
									currSlideObject.iW = loader.width;
									currSlideObject.iH = loader.height;
									imageLoadingComplete();
								} else {
									setTimeout(function() {
										if(loader.width) {
											currSlideObject.iW = loader.width;
											currSlideObject.iH = loader.height;
										}

										// failed to get size on last tier, just output image
										imageLoadingComplete();
									}, 1000);
								}
						};
							loader.src = img.src;
						}
					} else {
						imageLoadingComplete();
					}
			}
			function imageLoadingComplete() {
				currSlideObject.isLoaded = true;
				currSlideObject.isLoading = false;

					appendContent();
					removePreloader();
					triggerLoaded();
			}
			function waitForTransition() {
				if(!self._isMove && currSlideObject.images && currSlideObject.iW && currSlideObject.iH) {
					parseDataAndLoad();
					return;
				}
				currSlideObject.holder.isWaiting = true;
				setPreloader();
				currSlideObject.holder.slideId = -99;
			}
			
			function appendContent() {
				if(!currSlideObject.isAppended) {

					var visibleNearby = self.st.visibleNearby,
					bId = currSlideObject.id - self._newSlideId;
					if(!beforeTransition && !currSlideObject.appendOnLoaded && self.st.fadeinLoadedSlide  && ( bId === 0 || ( (visibleNearby || self._isAnimating || self._isDragging) && (bId === -1 || bId === 1) ) ) ) {
						var css = {
							visibility: 'visible', 
							opacity: 0
						};
						css[self._vendorPref + 'transition'] = 'opacity 400ms ease-in-out';
						currSlideObject.content.css(css);

						setTimeout(function() {
							currSlideObject.content.css('opacity', 1);
						}, 16);
					}

					if(currSlideObject.holder.find('.rsPreloader').length) {
						currSlideObject.holder.append( currSlideObject.content );
					} else {
						currSlideObject.holder.html( currSlideObject.content );
					}
					

					currSlideObject.isAppended = true;
					if(currSlideObject.isLoaded) {
						self._resizeImage(currSlideObject);
						triggerLoaded();
					}
					if(!currSlideObject.sizeReady) {
						currSlideObject.sizeReady = true;
						setTimeout(function() {
							// triggers after content is added, usually is true when page is refreshed from cache
							self.ev.trigger('rsMaybeSizeReady', currSlideObject);
						}, 100);
					}
					
				}
			}
			function triggerLoaded() {
				if(!currSlideObject.loadedTriggered) {
					currSlideObject.isLoaded = currSlideObject.loadedTriggered = true;
					currSlideObject.holder.trigger('rsAfterContentSet');
					self.ev.trigger('rsAfterContentSet', currSlideObject);
				}
			}
			function setPreloader() {
				if(self.st.usePreloader)
					currSlideObject.holder.html(self._preloader.clone());
			}
			function removePreloader(now) {
				if(self.st.usePreloader) {
					var preloader = currSlideObject.holder.find('.rsPreloader');
					if(preloader.length) {
						preloader.remove();
					}
				}
			}

		},
		_addBlockToContainer: function(slideObject, content, dontFade) {
			var self = this;
			var holder = slideObject.holder;
			var bId = slideObject.id - self._newSlideId;
			
			var visibleNearby = false;
			// if(self._isMove && !dontFade && self.st.fadeinLoadedSlide  && ( bId === 0 || ( (visibleNearby || self._isAnimating || self._isDragging) && (bId === -1 || bId === 1) ) ) ) {
			//  var content = slideObject.content;
			//  content.css(self._vendorPref + 'transition', 'opacity 400ms ease-in-out').css({visibility: 'visible', opacity: 0});
			//  //holder.css('opacity', 0);
			//  self._slidesContainer.append(holder);
			//  setTimeout(function() {
			//    content.css('opacity', 1);
			//    //self.ev.trigger('rsAfterContentSet', holder);
			//  }, 6);
			// } else {
				self._slidesContainer.append(holder);
			//}
			slideObject.appendOnLoaded = false;
		},
	
		_onDragStart:function(e, isThumbs) {
			var self = this,
				point,
				wasAnimating,
				isTouch = (e.type === 'touchstart');

			self._isTouchGesture = isTouch; 

			self.ev.trigger('rsDragStart');
			if($(e.target).closest('.rsNoDrag', self._currHolder).length) {
				 self.dragSuccess = false;
				 return true;
			}

			

			if(!isThumbs) {
				if(self._isAnimating) {
					self._wasAnimating = true;

					self._stopAnimation();
				}
			}
			self.dragSuccess = false;
			if(self._isDragging) {
				if(isTouch) {
					self._multipleTouches = true;
				}
				return;
			} else {
				if(isTouch) {
					self._multipleTouches = false;
				}
			}

			self._setGrabbingCursor();
			
			if(isTouch) {
				//parsing touch event
				var touches = e.originalEvent.touches;
				if(touches && touches.length > 0) {
					point = touches[0];
					if(touches.length > 1) {
						self._multipleTouches = true;
					}
				}         
				else {  
					return;           
				}
			} else {
				e.preventDefault();       
				point = e;
				if(self.msEnabled) point = point.originalEvent;   
			}

			self._isDragging = true;
			self._doc.on(self._moveEvent, function(e) { self._onDragMove(e, isThumbs); })
						.on(self._upEvent, function(e) { self._onDragRelease(e, isThumbs); });
			
			self._currMoveAxis = '';
			self._hasMoved = false;
			self._pageX = point.pageX;
			self._pageY = point.pageY;
			self._startPagePos = self._accelerationPos = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal) ? point.pageX : point.pageY;
			
			self._horDir = 0;
			self._verDir = 0;


			self._currRenderPosition = !isThumbs ? self._sPosition : self._thumbsPosition;

			self._startTime = new Date().getTime();
			if(isTouch) {
				self._sliderOverflow.on(self._cancelEvent, function(e) { self._onDragRelease(e, isThumbs); });  
			}
		},
		_renderMovement:function(point, isThumbs) {
			var self = this;
			if(self._checkedAxis) {

				var timeStamp = self._renderMoveTime,
					deltaX = point.pageX - self._pageX,
					deltaY = point.pageY - self._pageY,
					newX = self._currRenderPosition + deltaX,
					newY = self._currRenderPosition + deltaY,
					isHorizontal = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal),
					newPos = isHorizontal ? newX : newY,
					mAxis = self._currMoveAxis;

				self._hasMoved = true;
				self._pageX = point.pageX;
				self._pageY = point.pageY;

				if(mAxis === 'x' && deltaX !== 0) {
					self._horDir = deltaX > 0 ? 1 : -1;
				} else if(mAxis === 'y' && deltaY !== 0) {
					self._verDir = deltaY > 0 ? 1 : -1;
				}

				var pointPos = isHorizontal ? self._pageX : self._pageY,
					deltaPos = isHorizontal ? deltaX : deltaY;
				if(!isThumbs) {
					if(!self._loop) {
						if(self.currSlideId <= 0) {
							if(pointPos - self._startPagePos > 0) {
								newPos = self._currRenderPosition + deltaPos * self._lastItemFriction;
							}
						}
						if(self.currSlideId >= self.numSlides - 1) {
							if(pointPos - self._startPagePos < 0) {
								newPos = self._currRenderPosition + deltaPos * self._lastItemFriction ;
							}
						}
					}
				} else {
					if(newPos > self._thumbsMinPosition) {
						newPos = self._currRenderPosition + deltaPos * self._lastItemFriction;
					} else if(newPos < self._thumbsMaxPosition) {
						newPos = self._currRenderPosition + deltaPos * self._lastItemFriction ;
					}
				}

				self._currRenderPosition = newPos;
				
				if (timeStamp - self._startTime > 200) {
					self._startTime = timeStamp;
					self._accelerationPos = pointPos;           
				}

				if(!isThumbs) {
					if(self._isMove) {
						self._setPosition(self._currRenderPosition);
					}
				} else {
					self._setThumbsPosition(self._currRenderPosition);
				}
			}
			
		},
		_onDragMove:function(e, isThumbs) {
			var self = this,
				point,
				isTouch = (e.type === 'touchmove');

			if(self._isTouchGesture && !isTouch) {
				return;
			}

			if(isTouch) {
				if(self._lockAxis) {
					return;
				} 
				var touches = e.originalEvent.touches;
				if(touches) {
					if(touches.length > 1) {
						return;
					} else {
						point = touches[0]; 
					}
				} else {
					return;
				}
			} else {
				point = e;
				if(self.msEnabled) point = point.originalEvent; 
			}
			

			if(!self._hasMoved) {
				if(self._useCSS3Transitions) {
					(!isThumbs ? self._slidesContainer : self._thumbsContainer).css((self._vendorPref + self._TD), '0s');
				}
				(function animloop(){
					if(self._isDragging) {
						self._animFrame = requestAnimationFrame(animloop);
						if(self._renderMoveEvent)
							self._renderMovement(self._renderMoveEvent, isThumbs);
					}
					
					})();
			}
				
			if(!self._checkedAxis) {
				
				var dir = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal),
					diff = (Math.abs(point.pageX - self._pageX) - Math.abs(point.pageY - self._pageY) ) - (dir ? -7 : 7);

				if(diff > 7) {
					// hor movement
					if(dir) {
						e.preventDefault();
						self._currMoveAxis = 'x';
					} else if(isTouch) {
						self._completeGesture();
						return;
					} 
					self._checkedAxis = true;
				} else if(diff < -7) {
					// ver movement
					if(!dir) {
						e.preventDefault();
						self._currMoveAxis = 'y';
					} else if(isTouch) {
						self._completeGesture();
						return;
					} 
					self._checkedAxis = true;
				}
				return;
			}
			
			e.preventDefault(); 
			self._renderMoveTime = new Date().getTime();
			self._renderMoveEvent = point;
		},
		_completeGesture: function() {
			var self = this;
			self._lockAxis = true;
			self._hasMoved = self._isDragging = false;
			self._onDragRelease();
		},
		_onDragRelease:function(e, isThumbs) {
			var self = this,
				totalMoveDist,
				accDist,
				duration,
				v0,
				newPos,
				newDist,
				newDuration,
				blockLink,
				isTouch = (e.type === 'touchend' || e.type === 'touchcancel');


			if(self._isTouchGesture && !isTouch) {
				return;
			}
			self._isTouchGesture = false;
			self.ev.trigger('rsDragRelease');

			self._renderMoveEvent = null;
			self._isDragging = false;
			self._lockAxis = false;
			self._checkedAxis = false;
			self._renderMoveTime = 0;
			cancelAnimationFrame(self._animFrame);
			if(self._hasMoved) {
				if(!isThumbs) {
					if(self._isMove) {
						self._setPosition(self._currRenderPosition);
					}
				} else {
					self._setThumbsPosition(self._currRenderPosition);
				}
			}


			self._doc.off(self._moveEvent).off(self._upEvent);

			if(isTouch) {
				self._sliderOverflow.off(self._cancelEvent);  
			}

			
			self._setGrabCursor();
			if (!self._hasMoved && !self._multipleTouches) {
				if(isThumbs && self._thumbsEnabled) {
					var item = $(e.target).closest('.rsNavItem');
					if(item.length) {
						self.goTo(item.index());
					} 
					return;
				}
			}
			var orient = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal);
			if(!self._hasMoved || (self._currMoveAxis === 'y' && orient) || (self._currMoveAxis === 'x' && !orient) ) {
				if(!isThumbs && self._wasAnimating) {
					self._wasAnimating = false;
					if(!self.st.navigateByClick) {
						self.dragSuccess = true;
					} else {
						self._mouseNext( (self.msEnabled ? e.originalEvent : e) );
						self.dragSuccess = true;
						return;
					}
				} else {
					self._wasAnimating = false;
					self.dragSuccess = false;
					return;
				}
				
			} else {
				self.dragSuccess = true;
			}

			self._wasAnimating = false;
			
			
			self._currMoveAxis = '';

			
			function getCorrectSpeed(newSpeed) {
				if(newSpeed < 100) {
					return 100;
				} else if(newSpeed > 500) {
					return 500;
				} 
				return newSpeed;
			}
			function returnToCurrent(isSlow, v0) {
				if(self._isMove || isThumbs) {

					newPos = (-self._realId - self._idOffset) * self._slideSize;
					newDist = Math.abs(self._sPosition  - newPos);
					self._currAnimSpeed = newDist / v0;
					if(isSlow) {
						self._currAnimSpeed += 250; 
					}
					self._currAnimSpeed = getCorrectSpeed(self._currAnimSpeed);

					self._animateTo(newPos, false);
				}
			}

			var snapDist = self.st.minSlideOffset,
				point = isTouch ? e.originalEvent.changedTouches[0] : (self.msEnabled ? e.originalEvent : e),
				pPos = orient ? point.pageX : point.pageY,
				sPos = self._startPagePos,
				axPos = self._accelerationPos,
				axCurrItem = self.currSlideId,
				axNumItems = self.numSlides,
				dir = orient ? self._horDir : self._verDir,
				loop = self._loop,
				changeHash = false,
				distOffset = 0;
			
			totalMoveDist = Math.abs(pPos - sPos);
			accDist = pPos - axPos;


			duration = (new Date().getTime()) - self._startTime;
			v0 = Math.abs(accDist) / duration;  

			if(dir === 0 || axNumItems <= 1) {
				returnToCurrent(true, v0);
				return;
			}

			if(!loop && !isThumbs) {
				if(axCurrItem <= 0) {
					if(dir > 0) {
						returnToCurrent(true, v0);
						return;
					}
				} else if(axCurrItem >= axNumItems - 1) {
					if(dir < 0) {
						returnToCurrent(true, v0);
						return;
					}
				}
			}

			if(!isThumbs) {
				if(sPos + snapDist < pPos) {
					if(dir < 0) {   
						returnToCurrent(false, v0);
						return;         
					}
					self._moveTo('prev', getCorrectSpeed(Math.abs(self._sPosition  - (-self._realId - self._idOffset + 1) * self._slideSize) / v0), changeHash, true, true);
				} else if(sPos - snapDist > pPos) {
					if(dir > 0) {   
						returnToCurrent(false, v0);
						return;         
					}
					self._moveTo('next', getCorrectSpeed(Math.abs(self._sPosition  - (-self._realId - self._idOffset - 1) * self._slideSize) / v0), changeHash, true, true);
				} else {
					returnToCurrent(false, v0);
				}
			} else {
				var newPos = self._thumbsPosition;
				var transitionSpeed;
				
				if(newPos > self._thumbsMinPosition) {
					newPos = self._thumbsMinPosition;
				} else if(newPos < self._thumbsMaxPosition) {
					newPos = self._thumbsMaxPosition;
				} else {
					var friction = 0.003,
						S = (v0 * v0) / (friction * 2),
						minXDist = -self._thumbsPosition,
						maxXDist = self._thumbsContainerSize - self._thumbsViewportSize + self._thumbsPosition;

					if (accDist > 0 && S > minXDist) {
						minXDist = minXDist + self._thumbsViewportSize / (15 / (S / v0 * friction));
						v0 = v0 * minXDist / S;
						S = minXDist;
					} else if (accDist < 0 && S > maxXDist) {
						maxXDist = maxXDist + self._thumbsViewportSize / (15 / (S / v0 * friction));
						v0 = v0 * maxXDist / S;
						S = maxXDist;
					}




					transitionSpeed =  Math.max(Math.round(v0 / friction), 50);
					newPos = newPos + S * (accDist < 0 ? -1 : 1);


					if(newPos > self._thumbsMinPosition) {
						self._animateThumbsTo(newPos, transitionSpeed, true, self._thumbsMinPosition, 200);
						return;
					 } else if(newPos < self._thumbsMaxPosition) {
						self._animateThumbsTo( newPos, transitionSpeed, true, self._thumbsMaxPosition, 200);
						return;
					}
				}

				self._animateThumbsTo(newPos, transitionSpeed, true);

			}
		},
		_setPosition: function(pos) {
			var self = this;
			pos = self._sPosition = pos;
			if(self._useCSS3Transitions) {
				self._slidesContainer.css(self._xProp, self._tPref1 + ( self._slidesHorizontal ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 );    
			} else {
				self._slidesContainer.css(self._slidesHorizontal ? self._xProp : self._yProp, pos);
			}
		},
		
		
		updateSliderSize: function(force) {
			var self = this,
				newWidth,
				newHeight;

			if(self.st.autoScaleSlider) {
				var asw = self.st.autoScaleSliderWidth,
					ash = self.st.autoScaleSliderHeight;

				if(self.st.autoScaleHeight) {
					newWidth = self.slider.width();
					if(newWidth != self.width) {
						self.slider.css("height", newWidth * (ash / asw) );
						newWidth = self.slider.width();
					} 
					newHeight = self.slider.height();
				} else {
					newHeight = self.slider.height();
					if(newHeight != self.height) {
						self.slider.css("width", newHeight * (asw / ash));
						newHeight = self.slider.height();
					}   
					newWidth = self.slider.width();
				}
			
			} else {
				newWidth = self.slider.width();
				newHeight = self.slider.height();
			}
			


			if(force || newWidth != self.width || newHeight != self.height) {
				self.width = newWidth;
				self.height = newHeight;

				self._wrapWidth = newWidth;
				self._wrapHeight = newHeight;

				self.ev.trigger('rsBeforeSizeSet');
				self.ev.trigger('rsAfterSizePropSet');

				self._sliderOverflow.css({
					width: self._wrapWidth,
					height: self._wrapHeight
				});


				self._slideSize = (self._slidesHorizontal ? self._wrapWidth : self._wrapHeight) + self.st.slidesSpacing;
				

				self._imagePadding = self.st.imageScalePadding;
				var item,
					slideItem,
					i,
					img;
				for(i = 0; i < self.slides.length; i++) {
					item = self.slides[i];
					item.positionSet = false;

					if(item && item.images && item.isLoaded) {
						item.isRendered = false;
						self._resizeImage(item);
					} 
				}
				if(self._cloneHolders) {
					for(i = 0; i < self._cloneHolders.length; i++) {
						item = self._cloneHolders[i];
						item.holder.css(self._reorderProp, (item.id + self._idOffset) * self._slideSize);
					}
				}
				
				self._updateBlocksContent();

				if(self._isMove) {
					if(self._useCSS3Transitions) {
						self._slidesContainer.css(self._vendorPref + 'transition-duration', '0s');
					}
					self._setPosition( (-self._realId - self._idOffset) * self._slideSize);
				}
				self.ev.trigger('rsOnUpdateNav');
			}
			self._sliderOffset = self._sliderOverflow.offset();
			self._sliderOffset = self._sliderOffset[self._reorderProp];


		},
		//setSlidesOrientation: function(orient) {
			// TODO
			// var self = this,
			//  newHor = Boolean(orient === 'horizontal');
			// if(self._slidesHorizontal !== newHor) {
			//  self._setPosition(0);
			//  if(self._isMove) {
			//    for(var i = 0; i < self._slideHolders.length; i++) {
			//      self._slideHolders[i].block.css(self._reorderProp, '');
			//    }
			//  }
			//  self.slider.removeClass(self._slidesHorizontal ? 'rsHor' : 'rsVer').addClass(newHor ? 'rsHor' : 'rsVer');
			//  self._slidesHorizontal = newHor;
			//  self._reorderProp = newHor ? 'left' : 'top';
			//  self.updateSliderSize(true);
			// }
		//},
		/**
		 * Adds slide
		 * @param  {jQuery object or raw HTML} htmltext 
		 * @param  {int} index    (optional) Index where item should be added (last item is removed of not specified)
		 */
		appendSlide: function(htmltext, index) {
			var self = this,
				parsedSlide = self._parseNode(htmltext);

			if(isNaN(index) || index > self.numSlides) {
				index = self.numSlides;
			}
			self.slides.splice(index, 0, parsedSlide);
			self.slidesJQ.splice(index, 0, '<div style="'+ (self._isMove ? 'position:absolute;' : self._opacityCSS ) +'" class="rsSlide"></div>');

			if(index < self.currSlideId) {
				self.currSlideId++;
			}
			self.ev.trigger('rsOnAppendSlide', [parsedSlide, index]);
			
			self._refreshSlides(index);

			if(index === self.currSlideId) {
				self.ev.trigger('rsAfterSlideChange');
			}
		},

		/**
		 * Removes slide
		 * @param  {int} Index of item that should be removed
		 */
		removeSlide: function(index) {
			var self = this,
				slideToRemove = self.slides[index];

			if(slideToRemove) {
				if(slideToRemove.holder) {
					slideToRemove.holder.remove();
				}
				if(index < self.currSlideId) {
					self.currSlideId--;
				}
				self.slides.splice(index, 1);
				self.slidesJQ.splice(index, 1);

				self.ev.trigger('rsOnRemoveSlide', [index]);
				self._refreshSlides(index);

				if(index === self.currSlideId) {
					self.ev.trigger('rsAfterSlideChange');
				}
			}
		},
		_refreshSlides: function(refreshIndex) {

			// todo: optimize this stuff
			var self = this;

			var oldNumSlides = self.numSlides;
			var numLoops = self._realId <= 0 ? 0 : Math.floor(self._realId / oldNumSlides);

			self.numSlides = self.slides.length;
			if(self.numSlides === 0) {
				self.currSlideId = self._idOffset = self._realId = 0;
				self.currSlide = self._oldHolder = null;
			} else {
				self._realId = numLoops * self.numSlides + self.currSlideId;
			}

			for(var i = 0; i < self.numSlides; i++) {
				self.slides[i].id = i;
			}

			self.currSlide = self.slides[self.currSlideId];
			self._currHolder = self.slidesJQ[self.currSlideId];

			if(self.currSlideId >= self.numSlides) {
				self.goTo(self.numSlides - 1);
			} else if(self.currSlideId < 0) {
				self.goTo(0);
			}

			self._refreshNumPreloadImages();

			if(self._isMove && self._loop) {
				self._slidesContainer.css((self._vendorPref + self._TD), '0ms');
			}
			if(self._refreshSlidesTimeout) {
				clearTimeout(self._refreshSlidesTimeout);
			}


			self._refreshSlidesTimeout = setTimeout(function() {
				if(self._isMove) {
					self._setPosition( (-self._realId - self._idOffset) * self._slideSize); 
				}
				self._updateBlocksContent();
				if(!self._isMove) {
					self._currHolder.css({
						display: 'block',
						opacity: 1
					});
				}
				
			}, 14);
			self.ev.trigger('rsOnUpdateNav');
		},
		_setGrabCursor:function() { 
			var self = this;
			if(self._hasDrag && self._isMove) {
				if(self._grabCursor) {
					self._sliderOverflow.css('cursor', self._grabCursor);
				} else {
					self._sliderOverflow.removeClass('grabbing-cursor');
					self._sliderOverflow.addClass('grab-cursor'); 
				}
			}
		},
		_setGrabbingCursor:function() {   
			var self = this;
			if(self._hasDrag && self._isMove) {
				if(self._grabbingCursor) {
					self._sliderOverflow.css('cursor', self._grabbingCursor);
				} else {
					self._sliderOverflow.removeClass('grab-cursor');
					self._sliderOverflow.addClass('grabbing-cursor'); 
				} 
			}
		},
		next: function(notUserAction) {
			var self = this;
			self._moveTo('next',  self.st.transitionSpeed, true, !notUserAction);
		},
		prev: function(notUserAction) {
			var self = this;
			self._moveTo('prev', self.st.transitionSpeed, true, !notUserAction);
		},
		_moveTo:function(type,  speed, inOutEasing, userAction, fromSwipe) {
			var self = this,
				newPos,
				difference,
				i;
			
			
			self.ev.trigger('rsBeforeMove', [type, userAction]);
			if(type === 'next') {
				newItemId = self.currSlideId+1;
			} else if(type === 'prev') {
				newItemId = self.currSlideId-1;
			} else {
				newItemId = type = parseInt(type, 10);
			}

			if(!self._loop) {
				if(newItemId < 0) {
					self._doBackAndForthAnim('left', !userAction);
					return;
				} else if(newItemId >= self.numSlides ) {
					self._doBackAndForthAnim('right', !userAction);
					return;
				}
			}
			
			if(self._isAnimating) {
				self._stopAnimation(true);
				inOutEasing = false;
			}

			difference = newItemId - self.currSlideId;



			self._prevSlideId = self.currSlideId;
			var prevId = self.currSlideId;
			var id = self.currSlideId + difference;
			var realId = self._realId;
			var temp;
			var delayed;
			if(self._loop) {
				id = self._updateBlocksContent(false, id);
				realId += difference;
			} else {
				realId = id;
			}
			self._newSlideId = id;

			self._oldHolder = self.slidesJQ[self.currSlideId];

			
			self._realId = realId;
			self.currSlideId = self._newSlideId;

			self.currSlide = self.slides[self.currSlideId];
			self._currHolder = self.slidesJQ[self.currSlideId];

			
			var checkDist = self.st.slidesDiff;
			var next = Boolean(difference > 0);
			var absDiff = Math.abs(difference);
			var g1 = Math.floor( prevId / self._numPreloadImages);
			var g2 = Math.floor( ( prevId + (next ? checkDist : -checkDist  ) ) / self._numPreloadImages);
			var biggest = next ? Math.max(g1,g2) : Math.min(g1,g2);
			var biggestId = biggest * self._numPreloadImages +  ( next ? (self._numPreloadImages - 1) : 0 );
			if(biggestId > self.numSlides - 1) {
				biggestId = self.numSlides - 1;
			} else if(biggestId < 0) {
				biggestId = 0;
			}
			var toLast =  next ? (biggestId - prevId) :  (prevId - biggestId);
			if(toLast > self._numPreloadImages) {
				toLast = self._numPreloadImages;
			}
			if(absDiff > toLast + checkDist) {
				self._idOffset +=  ( absDiff - (toLast + checkDist) ) * ( next ? -1 : 1 );
				speed = speed * 1.4;
				for(i = 0; i < self.numSlides; i++) {
					self.slides[i].positionSet = false;
				}
			}
			self._currAnimSpeed = speed;

			self._updateBlocksContent(true);
			if(!fromSwipe) {
				delayed = true;
			}


			newPos = (-realId - self._idOffset) * self._slideSize;


			if(delayed) {
				setTimeout(function() {
					self._isWorking = false;
					self._animateTo(newPos, type, false, inOutEasing);
					self.ev.trigger('rsOnUpdateNav');
				}, 0);
			} else {
				self._animateTo(newPos, type, false, inOutEasing);
				self.ev.trigger('rsOnUpdateNav');
			}
			
			
			function isSetToCurrent(testId) {
				if(testId < 0) {
					testId = self.numSlides + testId;
				} else if(testId > self.numSlides - 1) {
					testId = testId - self.numSlides;
				}
				if(testId !== self.currSlideId) {
					return false;
				}
				return true;
			}
			
		},
		_updateArrowsNav: function() {
			var self = this,
				arrDisClass = 'rsArrowDisabled';
			if(self.st.arrowsNav) {
				if(self.numSlides <= 1) {
					self._arrowLeft.css('display', 'none');
					self._arrowRight.css('display', 'none');
					return;
				} else {
					self._arrowLeft.css('display', 'block');
					self._arrowRight.css('display', 'block');
				}
				if(!self._loop && !self.st.loopRewind) {
					if(self.currSlideId === 0) {
						self._arrowLeft.addClass(arrDisClass);
					} else {
						self._arrowLeft.removeClass(arrDisClass);
					}
					if(self.currSlideId === self.numSlides - 1) {
						self._arrowRight.addClass(arrDisClass);
					} else {
						self._arrowRight.removeClass(arrDisClass);
					}
				}
			}
		},
		_animateTo:function(pos, dir,  loadAll, inOutEasing, customComplete) {
			var self = this,
				moveProp,
				oldBlock,
				animBlock;

			var animObj = {};
			if(isNaN(self._currAnimSpeed)) {
				self._currAnimSpeed = 400;
			} 
			


			self._sPosition = self._currRenderPosition = pos;

			self.ev.trigger('rsBeforeAnimStart');

			if(!self._useCSS3Transitions) {
				if(self._isMove) {
					animObj[self._slidesHorizontal ? self._xProp : self._yProp] = pos + 'px';


					self._slidesContainer.animate(animObj, self._currAnimSpeed, /*'easeOutQuart'*/ inOutEasing ? self.st.easeInOut : self.st.easeOut);
				} else {
					oldBlock = self._oldHolder;
					animBlock = self._currHolder;         

					animBlock.stop(true, true).css({
						opacity: 0,
						display: 'block',
						zIndex: self._fadeZIndex
					});
					self._currAnimSpeed = self.st.transitionSpeed;
					animBlock.animate({opacity: 1}, self._currAnimSpeed, self.st.easeInOut);

					
					clearTimeouts();
					if(oldBlock) {
						oldBlock.data('rsTimeout', setTimeout(function() {
							oldBlock.stop(true, true).css({
								opacity: 0,
								display: 'none',
								zIndex: 0
							});
						}, self._currAnimSpeed + 60) );
					}
				}
				
			} else {
				if(self._isMove) {
					
					

						self._currAnimSpeed = parseInt(self._currAnimSpeed);
						var td = self._vendorPref + self._TD;
						var ttf = self._vendorPref + self._TTF;

						animObj[td] = self._currAnimSpeed+'ms';
						animObj[ttf] = inOutEasing ? $.rsCSS3Easing[self.st.easeInOut] : $.rsCSS3Easing[self.st.easeOut];
						
						self._slidesContainer.css(animObj);
					if(inOutEasing || !self.hasTouch) {
						setTimeout(function() {
							self._setPosition(pos);
						}, 5);
					} else {
						self._setPosition(pos);
					} 
					
					

				} else {
					//self._currAnimSpeed = 10
					self._currAnimSpeed = self.st.transitionSpeed;
					oldBlock = self._oldHolder;
					animBlock = self._currHolder;   
					if(animBlock.data('rsTimeout')) {
						animBlock.css('opacity', 0);
					}
					clearTimeouts();
					if(oldBlock) {
						//if(oldBlock)
						oldBlock.data('rsTimeout', setTimeout(function() {
							animObj[self._vendorPref + self._TD] = '0ms';
							animObj.zIndex = 0;
							animObj.display = 'none';
							oldBlock.data('rsTimeout', '');
							oldBlock.css(animObj);
							setTimeout(function() {
								oldBlock.css('opacity', 0);
							}, 16);
						}, self._currAnimSpeed + 60) );
					}

					animObj.display = 'block';
					animObj.zIndex = self._fadeZIndex;
					animObj.opacity = 0;
					animObj[self._vendorPref + self._TD] = '0ms';
					animObj[self._vendorPref + self._TTF] = $.rsCSS3Easing[self.st.easeInOut];
					animBlock.css(animObj);
					animBlock.data('rsTimeout', setTimeout(function() {
						//animBlock.css('opacity', 0);
						animBlock.css(self._vendorPref + self._TD,  self._currAnimSpeed+'ms');

						//oldBlock.css(self._vendorPref + self._TD,  '0ms');
						animBlock.data('rsTimeout', setTimeout(function() {
							animBlock.css('opacity', 1);
							animBlock.data('rsTimeout', '');
						}, 20) );
					}, 20) );
				}
			}
			self._isAnimating = true;
			if(self.loadingTimeout) {
				clearTimeout(self.loadingTimeout);
			}
			if(customComplete) {
				self.loadingTimeout = setTimeout(function() {
					self.loadingTimeout = null;
					customComplete.call();

				}, self._currAnimSpeed + 60);
			} else {
				self.loadingTimeout = setTimeout(function() {
					self.loadingTimeout = null;
					self._animationComplete(dir);
				}, self._currAnimSpeed + 60);
			}

			function clearTimeouts() {
				var t;
				if(oldBlock) {
					t = oldBlock.data('rsTimeout');
					if(t) {
						if(oldBlock !== animBlock) {
							oldBlock.css({
									opacity: 0,
									display: 'none',
									zIndex: 0
								});
						}
						clearTimeout(t);
						oldBlock.data('rsTimeout', '');
					}
				}
				
				t = animBlock.data('rsTimeout');
				if(t) {
					clearTimeout(t);
					animBlock.data('rsTimeout', '');
				}
			}
		},
		_stopAnimation: function(noCSS3) {
			var self = this;
			self._isAnimating = false;
			clearTimeout(self.loadingTimeout);
			if(self._isMove) {

				if(!self._useCSS3Transitions) {
					self._slidesContainer.stop(true);
					self._sPosition = parseInt(self._slidesContainer.css(self._xProp), 10);
				} else if (!noCSS3) {
					var oldPos = self._sPosition;
					var newPos =  self._currRenderPosition = self._getTransformProp();
					self._slidesContainer.css((self._vendorPref + self._TD), '0ms');
					if(oldPos !==newPos) {
						self._setPosition(newPos);
					}
				}
			} else {
				// kung fu
				if(self._fadeZIndex > 20) {
					self._fadeZIndex = 10;
				} else {
					self._fadeZIndex++;
				}
			}
			
			
		},
		// Thanks to @benpbarnett
		_getTransformProp:function(){
			var self = this,
				transform = window.getComputedStyle(self._slidesContainer.get(0), null).getPropertyValue(self._vendorPref + 'transform'),     
				explodedMatrix = transform.replace(/^matrix\(/i, '').split(/, |\)$/g),
				isMatrix3d = (explodedMatrix[0].indexOf('matrix3d') === 0);
			return parseInt(explodedMatrix[(self._slidesHorizontal ? (isMatrix3d ? 12 : 4) : (isMatrix3d ? 13 : 5) )], 10);
		},
		_getCSS3Prop: function(pos, hor) {
			var self = this;
			return self._useCSS3Transitions ? self._tPref1 + ( hor ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 : pos;
		},
		_animationComplete: function(dir) {
			var self = this;
			if(!self._isMove) {
				self._currHolder.css('z-index', 0);
				self._fadeZIndex = 10;
			}
			self._isAnimating = false;
			
			self.staticSlideId = self.currSlideId;
			self._updateBlocksContent();


			self._slidesMoved = false;
			
			self.ev.trigger('rsAfterSlideChange');
		},
		_doBackAndForthAnim:function(type, userAction) {
			var self = this,
				newPos = (-self._realId - self._idOffset) * self._slideSize;

			if(self.numSlides === 0 || self._isAnimating) {
				return;
			} 
			if(self.st.loopRewind) {
				self.goTo(type === 'left' ? self.numSlides - 1 : 0, userAction);
				return;
			}

			if(self._isMove) {
				self._currAnimSpeed = 200;

				function allAnimComplete() {
					self._isAnimating = false;
				}
				function firstAnimComplete() {
					self._isAnimating = false;
					self._animateTo(newPos, '', false, true, allAnimComplete);
				}
				self._animateTo(newPos + (type === 'left' ? 30 : -30),'', false, true, firstAnimComplete);
			}
			
		},
		_resizeImage:function(slideObject, useClone) {

			var isRoot = true;
			if(slideObject.isRendered) {
				return;
			}
			var img = slideObject.content;
			var classToFind = 'rsMainSlideImage';
			var isVideo;
			var self = this,
				imgAlignCenter = self.st.imageAlignCenter,
				imgScaleMode = self.st.imageScaleMode,
				tempEl;

			if(slideObject.videoURL) {
				classToFind = 'rsVideoContainer';
				if(imgScaleMode !== 'fill') {
					isVideo = true;
				} else {
					tempEl = img;
					if(!tempEl.hasClass(classToFind)) {
						tempEl = tempEl.find('.'+classToFind);
					}
					tempEl.css({width:'100%',height: '100%'});
					classToFind = 'rsMainSlideImage';
				}
			}
			if(!img.hasClass(classToFind)) {
				isRoot = false;
				img = img.find('.'+classToFind);
			}
			if(!img) {
				return;
			}

			var baseImageWidth = slideObject.iW,
				baseImageHeight = slideObject.iH;

			slideObject.isRendered = true;
			if(imgScaleMode === 'none' && !imgAlignCenter) {
				return;
			}
			if(imgScaleMode !== 'fill') {
				bMargin = self._imagePadding;
			} else {
				bMargin = 0;
			}
			//var block = img.parent('.block-inside').css('margin', bMargin);
			var containerWidth = self._wrapWidth - bMargin * 2,
				containerHeight = self._wrapHeight - bMargin * 2,
				hRatio,
				vRatio,
				ratio,
				nWidth,
				nHeight,
				cssObj = {};

			if(imgScaleMode === 'fit-if-smaller') {
				if(baseImageWidth > containerWidth || baseImageHeight > containerHeight) {
					imgScaleMode = 'fit';
				}
			}
			if(imgScaleMode === 'fill' || imgScaleMode === 'fit') {   
				hRatio = containerWidth / baseImageWidth;
				vRatio = containerHeight / baseImageHeight;

				if (imgScaleMode  == "fill") {
					ratio = hRatio > vRatio ? hRatio : vRatio;                          
				} else if (imgScaleMode  == "fit") {
					ratio = hRatio < vRatio ? hRatio : vRatio;                    
				} else {
					ratio = 1;
				}

				nWidth = Math.ceil(baseImageWidth * ratio, 10);
				nHeight = Math.ceil(baseImageHeight * ratio, 10);
			} else {                
				nWidth = baseImageWidth;
				nHeight = baseImageHeight;    
			}
			if(imgScaleMode !== 'none') {
				cssObj.width = nWidth;
				cssObj.height = nHeight;
				if(isVideo) {
					img.find('.rsImg').css({width: '100%', height:'100%'});
				}
			}
			if (imgAlignCenter) { 
				cssObj.marginLeft = Math.floor((containerWidth - nWidth) / 2) +  bMargin;
				cssObj.marginTop = Math.floor((containerHeight - nHeight) / 2) +  bMargin;
			}
			img.css(cssObj);
		}
	}; /* RoyalSlider core prototype end */
	$.rsProto = RoyalSlider.prototype;

	$.fn.royalSlider = function(options) {      
		var args = arguments;
		return this.each(function(){
			var self = $(this);
			if (typeof options === "object" ||  !options) {
				if( !self.data('royalSlider') ) {
					self.data('royalSlider', new RoyalSlider(self, options));
				}
			} else {
				var royalSlider = self.data('royalSlider');
				if (royalSlider && royalSlider[options]) {
					return royalSlider[options].apply(royalSlider, Array.prototype.slice.call(args, 1));
				}
			}
		});
	};

	$.fn.royalSlider.defaults = {    
		slidesSpacing: 8,
		startSlideId: 0,
		loop: false,
		loopRewind: false,
		numImagesToPreload: 4,
		fadeinLoadedSlide: true,
		slidesOrientation: 'horizontal', 
		transitionType: 'move', 
		transitionSpeed: 600,
		controlNavigation: 'bullets',
		controlsInside: true, 
		arrowsNav: true,
		arrowsNavAutoHide: false,
		navigateByClick: true,
		randomizeSlides: false,
		sliderDrag: true, 
		sliderTouch: true,
		keyboardNavEnabled: false,
		fadeInAfterLoaded: true,

		allowCSS3: true,
		allowCSS3OnWebkit: true,

		
		addActiveClass: false,
		autoHeight: false,

		easeOut: 'easeOutSine',
		easeInOut: 'easeInOutSine',

		minSlideOffset: 10,

		imageScaleMode:"fit-if-smaller",                 
		imageAlignCenter:true,        
		imageScalePadding: 4,
		usePreloader: true,

		autoScaleSlider: false,               
						
			autoScaleSliderWidth: 800,       
			autoScaleSliderHeight: 400,   

			autoScaleHeight: true,      

			arrowsNavHideOnTouch: false,
			globalCaption: false,

			slidesDiff: 2,
			
			disableResponsiveness: false // !disable responsiveness option
	}; /* default options end */

	$.rsCSS3Easing = {
		easeOutSine: 'cubic-bezier(0.390, 0.575, 0.565, 1.000)',
		easeInOutSine: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
	};

	$.extend(jQuery.easing, {
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});

	/****************************************************************************************************************/
	/**
	 *
	 * RoyalSlider fullscreen module
	 * @version 1.0.5:
	 *
	 * 1.0.1:
	 * - Added rsEnterFullscreen and rsExitFullscreen events
	 *
	 * 1.0.2
	 * - Added window scroll detection
	 *
	 * 1.0.3
	 * - Fullscreen button now is added to _controlsContainer element
	 *
	 * 1.0.4
	 * - Fixed issue that could cause small image be loaded in fullscreen
	 *
	 * 1.0.5
	 * - Fix "false" native fullscreen on Android
	 * 
	 */
	$.extend($.rsProto, {
		_initFullscreen: function() {
			var self = this;

			self._fullscreenDefaults = {
				enabled: false,
				keyboardNav: true,
				buttonFS: true,
				nativeFS: false,
				doubleTap: true
			};
			self.st.fullscreen = $.extend({}, self._fullscreenDefaults, self.st.fullscreen);

			if(self.st.fullscreen.enabled) {
				self.ev.one('rsBeforeSizeSet', function() {
					self._setupFullscreen();
				});
			}
		},
		_setupFullscreen: function() {
			var self = this;
			self._fsKeyboard = (!self.st.keyboardNavEnabled && self.st.fullscreen.keyboardNav);

			if(self.st.fullscreen.nativeFS) {
				// Thanks to John Dyer http://j.hn/
					self._fullScreenApi = {
									supportsFullScreen: false,
									isFullScreen: function() { return false; },
									requestFullScreen: function() {},
									cancelFullScreen: function() {},
									fullScreenEventName: '',
									prefix: ''
							};
					var browserPrefixes = 'webkit moz o ms khtml'.split(' ');
					// check for native support
					if(!self.isAndroid) {
					
						if (typeof document.cancelFullScreen != 'undefined') {
								 self._fullScreenApi.supportsFullScreen = true;
						} else {
								// check for fullscreen support by vendor prefix
								for (var i = 0; i < browserPrefixes.length; i++ ) {
										 self._fullScreenApi.prefix = browserPrefixes[i];
				 
										if (typeof document[ self._fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ) {
												 self._fullScreenApi.supportsFullScreen = true;
				 
												break;
										}
								}
						}

					}
			 
					// update methods to do something useful
					if ( self._fullScreenApi.supportsFullScreen) {
						self.nativeFS = true;
							 self._fullScreenApi.fullScreenEventName =  self._fullScreenApi.prefix + 'fullscreenchange' + self.ns;
				
							 self._fullScreenApi.isFullScreen = function() {
									switch (this.prefix) {
											case '':
													return document.fullScreen;
											case 'webkit':
													return document.webkitIsFullScreen;
											default:
													return document[this.prefix + 'FullScreen'];
									}
							};
							 self._fullScreenApi.requestFullScreen = function(el) {
									return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
							};
							 self._fullScreenApi.cancelFullScreen = function(el) {
									return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
							};
					} else {
						self._fullScreenApi = false;
					}
			}


			if(self.st.fullscreen.buttonFS) {
				self._fsBtn = $('<div class="rsFullscreenBtn"><div class="rsFullscreenIcn"></div></div>')
					.appendTo(self._controlsContainer)
					.on('click.rs', function() {
						if(self.isFullscreen) {
							self.exitFullscreen();
						} else {

							self.enterFullscreen();
						}
					});
			}
		},
		enterFullscreen: function(preventNative) {
			var self = this;
			if( self._fullScreenApi ) {
				if(!preventNative) {
					self._doc.on( self._fullScreenApi.fullScreenEventName, function(e) {
						if(!self._fullScreenApi.isFullScreen()) {
							self.exitFullscreen(true);
						} else {
							self.enterFullscreen(true);
						}
					});
					self._fullScreenApi.requestFullScreen($('html')[0]);
					return;
				} else {
					self._fullScreenApi.requestFullScreen($('html')[0]);
				}
			}

			if(self._isFullscreenUpdating) {
				return;
			}
			self._isFullscreenUpdating = true;

			self._doc.on('keyup' + self.ns + 'fullscreen', function(e) {
				if(e.keyCode === 27) {
					self.exitFullscreen();
				}
			});
			if(self._fsKeyboard) {
				self._bindKeyboardNav();
			}

			var win = $(window);
			self._fsScrollTopOnEnter = win.scrollTop();
			self._fsScrollLeftOnEnter = win.scrollLeft();

			self._htmlStyle = $('html').attr('style');
			self._bodyStyle = $('body').attr('style');
			self._sliderStyle = self.slider.attr('style');

			$('body, html').css({
				overflow: 'hidden',
				height: '100%',
				width: '100%',
				margin: '0',
				padding: '0'
			});

			self.slider.addClass('rsFullscreen');
			
		
			var item,
				i;
			for(i = 0; i < self.numSlides; i++) {
				item = self.slides[i];
				
				item.isRendered = false;
				if(item.bigImage) {
					item.isBig = true;
					item.isMedLoaded = item.isLoaded;
					item.isMedLoading = item.isLoading;
					item.medImage = item.image;
					item.medIW = item.iW;
					item.medIH = item.iH;
					item.slideId = -99;

					if(item.bigImage !== item.medImage) {
						item.sizeType = 'big';
					}

					item.isLoaded = item.isBigLoaded;
					item.isLoading = false;
					item.image = item.bigImage;
					item.images[0] = item.bigImage;
					item.iW = item.bigIW;
					item.iH = item.bigIH;

					item.isAppended = item.contentAdded = false;
					self._updateItemSrc(item);
				}
				
			}

			
			self.isFullscreen = true;
			
			self._isFullscreenUpdating = false;
			self.updateSliderSize();
			self.ev.trigger('rsEnterFullscreen');
			
		},
		exitFullscreen: function(preventNative) {
			var self = this;

			if( self._fullScreenApi ) {
				if(!preventNative) {
					self._fullScreenApi.cancelFullScreen($('html')[0]);
					return;
				}
				self._doc.off( self._fullScreenApi.fullScreenEventName );
			}
			if(self._isFullscreenUpdating) {
				return;
			}
			self._isFullscreenUpdating = true;

			self._doc.off('keyup'  + self.ns + 'fullscreen');
			if(self._fsKeyboard) {
				self._doc.off('keydown' + self.ns);
			}

			$('html').attr('style', self._htmlStyle || '');
			$('body').attr('style', self._bodyStyle || '');
			

			
			var item,
				i;
			for(i = 0; i < self.numSlides; i++) {
				item = self.slides[i];
				
				
				item.isRendered = false;
				if(item.bigImage) {
					item.isBig = false;
					item.slideId = -99;
					item.isBigLoaded = item.isLoaded;
					item.isBigLoading = item.isLoading;
					item.bigImage = item.image;
					item.bigIW = item.iW;
					item.bigIH = item.iH;
					item.isLoaded = item.isMedLoaded;
					item.isLoading = false;
					item.image = item.medImage;
					item.images[0] = item.medImage;
					item.iW = item.medIW;
					item.iH = item.medIH;

					item.isAppended = item.contentAdded = false;

					self._updateItemSrc(item, true);
					
					
					if(item.bigImage !== item.medImage) {
						item.sizeType = 'med';
					}
				}
			}
			
			self.isFullscreen = false;

			var win = $(window);
			win.scrollTop( self._fsScrollTopOnEnter );
			win.scrollLeft( self._fsScrollLeftOnEnter );
			
			self._isFullscreenUpdating = false;
			self.slider.removeClass('rsFullscreen');

			self.updateSliderSize();
			// fix overflow bug
			setTimeout(function() {
				self.updateSliderSize();
			},1);
			self.ev.trigger('rsExitFullscreen');
		},
		_updateItemSrc: function(item, exit) {
			var newHTML = (!item.isLoaded && !item.isLoading) ? '<a class="rsImg rsMainSlideImage" href="'+item.image+'"></a>' : '<img class="rsImg rsMainSlideImage" src="'+item.image+'"/>';
			
			if(item.content.hasClass('rsImg')) {
				item.content = $(newHTML);
			} else {
				item.content.find('.rsImg').eq(0).replaceWith(newHTML);
			}
			if(!item.isLoaded && !item.isLoading && item.holder) {
				item.holder.html(item.content);
			}
		}
	});
	$.rsModules.fullscreen = $.rsProto._initFullscreen;

	/****************************************************************************************************************/

		/**
	 *
	 * RoyalSlider bullets module
	 * @version 1.0.1:
	 *
	 * 1.0.1
	 * - Minor optimizations
	 * 
	 */ 
	$.extend($.rsProto, {
		_initBullets: function() {
			var self = this;
			if(self.st.controlNavigation === 'bullets') {
				var itemHTML = '<div class="rsNavItem rsBullet"><span></span></div>';
				self.ev.one('rsAfterPropsSetup', function() {

					self._controlNavEnabled = true;
					self.slider.addClass('rsWithBullets');
					var out = '<div class="rsNav rsBullets">';
					for(var i = 0; i < self.numSlides; i++) {
						out += itemHTML;
					}
					self._controlNav = out = $(out + '</div>');
					self._controlNavItems = out.appendTo(self.slider).children();

					self._controlNav.on('click.rs','.rsNavItem',function(e) {
						if(!self._thumbsDrag ) {
							self.goTo( $(this).index() );
						}
					});
				});

				self.ev.on('rsOnAppendSlide', function(e, parsedSlide, index) {
					if(index >= self.numSlides) {
						self._controlNav.append(itemHTML);
					} else {
						self._controlNavItems.eq(index).before(itemHTML);
					}
					self._controlNavItems = self._controlNav.children();
				});
				self.ev.on('rsOnRemoveSlide', function(e, index) {
					var itemToRemove = self._controlNavItems.eq(index);
					if(itemToRemove && itemToRemove.length) {
						itemToRemove.remove();
						self._controlNavItems = self._controlNav.children();
					}
					
				}); 

				self.ev.on('rsOnUpdateNav', function() {
					var id = self.currSlideId,
						currItem,
						prevItem;
					if(self._prevNavItem) {
						self._prevNavItem.removeClass('rsNavSelected');
					}
					currItem = self._controlNavItems.eq(id);

					currItem.addClass('rsNavSelected');
					self._prevNavItem = currItem;
				});
			}
		}
	});
	$.rsModules.bullets = $.rsProto._initBullets;

	/****************************************************************************************************************/
	/**
	 *
	 * RoyalSlider auto height module
	 * @version 1.0.2:
	 *
	 * 1.0.2
	 * - Changed "on" to "one" in afterInit event listener
	 * - Removed id="clear"
	 */ 
	$.extend($.rsProto, {
		_initAutoHeight: function() {
			var self = this;
			if(self.st.autoHeight) {
				var holder,
					tH,
					currSlide,
					currHeight,
					updHeight = function(animate) {
						currSlide = self.slides[self.currSlideId];
						holder = currSlide.holder;

						if(holder) {
							tH = holder.height();
							if(tH && tH !== currHeight) {
								self._wrapHeight = tH;
								if(self._useCSS3Transitions || !animate) {
									self._sliderOverflow.css('height', tH);
								} else {
									self._sliderOverflow.stop(true,true).animate({height: tH}, self.st.transitionSpeed);
								}
							}
						}
					};

				self.ev.on('rsMaybeSizeReady.rsAutoHeight', function(e, slideObject) {
					if(currSlide === slideObject) {
						updHeight();
					}
				});

				self.ev.on('rsAfterContentSet.rsAutoHeight', function(e, slideObject) {
					if(currSlide === slideObject) {
						updHeight();
					}
				});
				


				self.slider.addClass('rsAutoHeight');
				self.ev.one('rsAfterInit', function() {
					setTimeout(function() {
						updHeight(false);
						setTimeout(function() {
							self.slider.append('<div style="clear:both; float: none;"></div>');
							if(self._useCSS3Transitions) {
								self._sliderOverflow.css(self._vendorPref + 'transition', 'height ' + self.st.transitionSpeed + 'ms ease-in-out');
							}
						}, 16);
					}, 16);
				});
				self.ev.on('rsBeforeAnimStart', function() {
					updHeight(true);
				});
				self.ev.on('rsBeforeSizeSet' , function() {
					setTimeout(function() {
						updHeight(false);
					}, 16);
				});
			}
			
		}
	});
	$.rsModules.autoHeight = $.rsProto._initAutoHeight;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider video module
	 * @version 1.1.0:
	 *
	 * 1.0.3:
	 * - Added rsOnDestroyVideoElement event
	 *
	 * 1.0.4:
	 * - Added wmode=transparent to default YouTube video embed code
	 *
	 * 1.0.5
	 * - Fixed bug: HTMl5 YouTube player sometimes keeps playing in ie9 after closing
	 *
	 * 1.0.6
	 * - A bit lightened Vimeo and YouTube regex 
	 *
	 * 1.0.7
	 * - Minor optimizations
	 * - Added autoHideCaption option
	 *
	 * 1.0.9
	 * - Fixed error that could appear if updateSliderSize method is called directly after video close
	 *
	 * 1.1.0
	 * - Video is now removed in rsAfterSlideChange event to avoid transition lag
	 * - Fixed bug that could cause appearing of arrows with auto-hide
	 */
	$.extend($.rsProto, {
		_initVideo: function() {
			var self = this;
			self._videoDefaults = {
				autoHideArrows: true,
				autoHideControlNav: false,
				autoHideBlocks: false,
				autoHideCaption: false,
				youTubeCode: '<iframe src="http://www.youtube.com/embed/%id%?rel=1&autoplay=1&showinfo=0&autoplay=1&wmode=transparent" frameborder="no"></iframe>',
				vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?byline=0&amp;portrait=0&amp;autoplay=1" frameborder="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
			};

			self.st.video = $.extend({}, self._videoDefaults, self.st.video);

			self.ev.on('rsBeforeSizeSet', function() {
				if(self._isVideoPlaying) {
					setTimeout(function() {
						var content = self._currHolder;
						content = content.hasClass('rsVideoContainer') ? content : content.find('.rsVideoContainer');
						if(self._videoFrameHolder) {
							self._videoFrameHolder.css({
								width: content.width(),
								height: content.height()
							});
						}
					}, 32);
				}
			});
			var isFF = self._browser.mozilla;
			self.ev.on('rsAfterParseNode', function(e, content, obj) {
				var jqcontent = $(content),
					tempEl,
					hasVideo;

				if(obj.videoURL) {
					if(!hasVideo && isFF) {
						hasVideo = true;
						self._useCSS3Transitions = self._use3dTransform = false;
					}
					var wrap = $('<div class="rsVideoContainer"></div>'),
						playBtn = $('<div class="rsBtnCenterer"><div class="rsPlayBtn"><div class="rsPlayBtnIcon"></div></div></div>');
					if(jqcontent.hasClass('rsImg')) {
						obj.content = wrap.append(jqcontent).append(playBtn);
					} else {
						obj.content.find('.rsImg').wrap(wrap).after(playBtn);
						if(obj.content.find('.rsCLink').length > 0){
							obj.content.find('.rsCLink').appendTo(playBtn);
							playBtn.addClass("with-link");
						}
					}
				}
			});

			self.ev.on('rsAfterSlideChange', function() {
				self.stopVideo();
			});

		},
		toggleVideo: function() {
			var self = this;
			if(!self._isVideoPlaying) {
				return self.playVideo();
			} else {
				return self.stopVideo();
			}
		},
		playVideo: function() {
			var self = this;
			if(!self._isVideoPlaying) {
				var currSlide = self.currSlide;
				if(!currSlide.videoURL) {
					return false;
				}

				
				var content = self._currVideoContent = currSlide.content;
				var url = currSlide.videoURL,
					videoId,
					regExp,
					match;

				if( url.match(/youtu\.be/i) || url.match(/youtube\.com/i) ) {

					regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;


						match = url.match(regExp);
						if (match && match[7].length==11){
								videoId = match[7];
						}

					if(videoId !== undefined) {
						self._videoFrameHolder = self.st.video.youTubeCode.replace("%id%", videoId);
					}
				} else if(url.match(/vimeo\.com/i)) {
					regExp = /(www\.)?vimeo.com\/(\d+)($|\/)/;
					match = url.match(regExp);
					if(match) {
						videoId = match[2];
					}
					if(videoId !== undefined) {
						self._videoFrameHolder = self.st.video.vimeoCode.replace("%id%", videoId);
					}
				}
				self.videoObj = $(self._videoFrameHolder);

				self.ev.trigger('rsOnCreateVideoElement', [url]);


				if(self.videoObj.length) {
					self._videoFrameHolder = $('<div class="rsVideoFrameHolder"><div class="rsPreloader"></div><div class="rsCloseVideoBtn"><div class="rsCloseVideoIcn"></div></div></div>');
					self._videoFrameHolder.find('.rsPreloader').after(self.videoObj);
					content = content.hasClass('rsVideoContainer') ? content : content.find('.rsVideoContainer');
					self._videoFrameHolder.css({
						width: content.width(),
						height: content.height()
					}).find('.rsCloseVideoBtn').off('click.rsv').on('click.rsv', function(e) {
						self.stopVideo();
						e.preventDefault();
						e.stopPropagation();
						return false;
					});
					content.append(self._videoFrameHolder);
					if(self.isIPAD) {
						content.addClass('rsIOSVideo');
					}

					self._toggleHiddenClass(false);

					setTimeout(function() {
						self._videoFrameHolder.addClass('rsVideoActive');
					}, 10);
					self.ev.trigger('rsVideoPlay');
					self._isVideoPlaying = true;
				}
				return true;
			}
			return false;
		},
		stopVideo: function() {
			var self = this;
			if(self._isVideoPlaying) {
				if(self.isIPAD) {
					self.slider.find('.rsCloseVideoBtn').remove();
				}
				
				self._toggleHiddenClass(true);

				setTimeout(function() {
					self.ev.trigger('rsOnDestroyVideoElement', [self.videoObj]);
					var ifr = self._videoFrameHolder.find('iframe');
					if(ifr.length) {
						try {
							ifr.attr('src', "");
						} catch(ex) { }
					}
					self._videoFrameHolder.remove();
					self._videoFrameHolder = null;
				}, 16);
				self.ev.trigger('rsVideoStop');
				self._isVideoPlaying = false;
				return true;
			} 
			return false;
		},
		_toggleHiddenClass: function(remove) {
			var arr = [],
				self = this,
				vst = self.st.video;
			if(vst.autoHideArrows) {
				if(self._arrowLeft) {
					arr.push(self._arrowLeft, self._arrowRight);
					self._arrowsAutoHideLocked = !remove;
				}
				if(self._fsBtn) {
					arr.push(self._fsBtn);
				}
			}
			if(vst.autoHideControlNav && self._controlNav) {
				arr.push(self._controlNav);
			}
			if(vst.autoHideBlocks && self.currSlide.animBlocks) {
				arr.push(self.currSlide.animBlocks);
			}
			if(vst.autoHideCaption && self.globalCaption) {
				arr.push(self.globalCaption);
			}

			if(arr.length) {
				for(var i = 0; i < arr.length; i++) {
					if(!remove) {
						arr[i].addClass('rsHidden');
					} else {
						arr[i].removeClass('rsHidden');
					}
				}
			}
		}
	});
	$.rsModules.video = $.rsProto._initVideo;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider auto play module
	 * @version 1.0.5:
	 *
	 * 1.0.3:
	 * - added support for 'autoplay' property name. 
	 *
	 * 1.0.4
	 * - added toggleAutoPlay public method
	 *
	 * 1.0.5
	 * - Fixed issue when autoPlay may not pause when switching browser tabs
	 */
	$.extend($.rsProto, {
		_initAutoplay: function() {
			var self = this,
				del;

			self._autoPlayDefaults = {
				enabled: false,
					stopAtAction: true,
					pauseOnHover: true,
					delay: 2000
			};

			// fix deprecated name
			if(!self.st.autoPlay && self.st.autoplay) {
				self.st.autoPlay = self.st.autoplay;
			}
			self.st.autoPlay = $.extend({}, self._autoPlayDefaults, self.st.autoPlay);

			if(self.st.autoPlay.enabled) {
				self.ev.on('rsBeforeParseNode', function(e, content, obj) {
					content = $(content);
					del = content.attr('data-rsDelay');
					if(del) {
						obj.customDelay = parseInt(del, 10);
					}
				});
				self.ev.one('rsAfterInit', function() {
					self._setupAutoPlay();
				});
				self.ev.on('rsBeforeDestroy', function() {
					self.stopAutoPlay();
					$(window).off('blur'+self.ns + ' focus' + self.ns);
				});
				
			}
		},
		_setupAutoPlay: function() {
			var self = this;
				
			self.startAutoPlay();

			self.ev.on('rsAfterContentSet', function(e, slideObject) {
				if(!self._isDragging && !self._isAnimating && self._autoPlayEnabled && slideObject === self.currSlide ) {
					self._play();
				}
			});
			self.ev.on('rsDragRelease', function() {
				if(self._autoPlayEnabled && self._autoPlayPaused) {
					self._autoPlayPaused = false;
					self._play();
				}
			});
			self.ev.on('rsAfterSlideChange', function() {
				if(self._autoPlayEnabled) {
					if(self._autoPlayPaused) {
						self._autoPlayPaused = false; 

						if(self.currSlide.isLoaded) {
							self._play();
						}
					}
				}
			});
			self.ev.on('rsDragStart', function() {
				if(self._autoPlayEnabled) {
					if(self.st.autoPlay.stopAtAction) {
						self.stopAutoPlay();
					} else {
						self._autoPlayPaused = true;
						self._pause();
					}
				}
			});
			self.ev.on('rsBeforeMove', function(e, type, userAction) {
				if(self._autoPlayEnabled) {
					if(userAction && self.st.autoPlay.stopAtAction) {
						self.stopAutoPlay();
					} else {
						self._autoPlayPaused = true;
						self._pause();
					}
				}
			});

			self._pausedByVideo = false;
			self.ev.on('rsVideoStop', function() {
				if(self._autoPlayEnabled) {
					self._pausedByVideo = false;
					self._play();
				}
			});
			self.ev.on('rsVideoPlay', function() {
				if(self._autoPlayEnabled) {
					self._autoPlayPaused = false;
					self._pause();
					self._pausedByVideo = true;
				} 
			});

			$(window).on('blur'+self.ns, function(){
				if(self._autoPlayEnabled) {
					self._autoPlayPaused = true;
					self._pause();
				}
			}).on('focus'+self.ns, function(){
					if(self._autoPlayEnabled && self._autoPlayPaused) {
					self._autoPlayPaused = false;
					self._play();
				}
			});

			if(self.st.autoPlay.pauseOnHover) {
				self._pausedByHover = false;
				self.slider.hover(
					function() {
						if(self._autoPlayEnabled) {
							self._autoPlayPaused = false;
							self._pause();
							self._pausedByHover = true;
						} 
					},
					function() {
						if(self._autoPlayEnabled) {
							self._pausedByHover = false;
							self._play();
						}
					}
				);  
			}
			
		},
		toggleAutoPlay: function() {
			var self = this;
			if(self._autoPlayEnabled) {
				self.stopAutoPlay();
			} else {
				self.startAutoPlay();
			}
		},
		startAutoPlay: function() {
			var self = this;
			self._autoPlayEnabled = true;
			if(self.currSlide.isLoaded) {
				self._play();
			}
		},
		stopAutoPlay: function() {
			var self = this;
			self._pausedByVideo = self._pausedByHover = self._autoPlayPaused = self._autoPlayEnabled = false;
			self._pause();
		},
		_play: function() {
			var self = this;
			self.ev.trigger('autoPlayPlay');

			if(!self._pausedByHover && !self._pausedByVideo) {
				self._autoPlayRunning = true;
				if(self._autoPlayTimeout) {
					clearTimeout(self._autoPlayTimeout);
				}
				self._autoPlayTimeout = setTimeout(function() {
					var changed;
					if(!self._loop && !self.st.loopRewind) {
						changed = true;
						self.st.loopRewind = true;
					}
					self.next(true);
					if(changed) {
						changed = false;
						self.st.loopRewind = false;
					}
				}, !self.currSlide.customDelay ? self.st.autoPlay.delay : self.currSlide.customDelay);
			}
			
		},
		_pause: function() {
			var self = this;
			self.ev.trigger('autoPlayPause');

			if(!self._pausedByHover && !self._pausedByVideo) {
				self._autoPlayRunning = false;
				if(self._autoPlayTimeout) {
					clearTimeout(self._autoPlayTimeout);
					self._autoPlayTimeout = null;
				}
			}
		}
	});
	$.rsModules.autoplay = $.rsProto._initAutoplay;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider animated blocks module
	 * @version 1.0.6:
	 *
	 * 1.0.2:
	 * - Fixed mistake from prev fix :/
	 * 
	 * 1.0.3:
	 * - Fixed animated block appearing in Firefox
	 *
	 * 1.0.4
	 * - Fixed bug that could cause incorrect block when randomizeSlides is enabled
	 *
	 * 1.0.5
	 * - moveEffect:none' bug
	 *
	 * 1.0.6
	 * - Fixed issue that could cause incorrect position of blocks in IE
	 */ 
	$.extend($.rsProto, {
		_initAnimatedBlocks: function() {
			var self = this,
				i;

			self._blockDefaults = {
				fadeEffect: true,
				moveEffect: 'top', 
				moveOffset:20,               
				speed:400,               
				easing:'easeOutSine',      
				delay:200                 
			};
			self.st.block = $.extend({}, self._blockDefaults, self.st.block);

			self._blockAnimProps = [];
			self._animatedBlockTimeouts = [];

			self.ev.on('rsAfterInit', function() {
				runBlocks();
			});

			self.ev.on('rsBeforeParseNode', function(e, content, obj) {
				content = $(content);

				obj.animBlocks = content.find('.rsABlock').css('display', 'none');
				if(!obj.animBlocks.length) {
					if(content.hasClass('rsABlock')) {
						obj.animBlocks = content.css('display', 'none');
					} else {
						obj.animBlocks = false;
					}
				}
			});
			self.ev.on('rsAfterContentSet', function(e, slideObject) {
				var currId = self.slides[self.currSlideId].id; 
				if(slideObject.id === currId) {
					setTimeout(function() {
						runBlocks();
					}, self.st.fadeinLoadedSlide ? 300 : 0);
				}
			});
		
			self.ev.on('rsAfterSlideChange', function() {
				runBlocks();
			});
			function runBlocks() {
				var slide = self.currSlide;
				if(!self.currSlide || !self.currSlide.isLoaded) {
					return;
				}

				// clear previous animations
				if(self._slideWithBlocks !== slide) {
					if(self._animatedBlockTimeouts.length > 0) {
						for(i = 0; i < self._animatedBlockTimeouts.length; i++) { 
							clearTimeout(self._animatedBlockTimeouts[i]);
						}
						self._animatedBlockTimeouts = [];
					}
					
					if(self._blockAnimProps.length > 0) {           
						var cItemTemp;
						for(i = 0; i < self._blockAnimProps.length; i++) {  
							cItemTemp = self._blockAnimProps[i];              
							if(cItemTemp) {               
								if(!self._useCSS3Transitions) {
									// if(cItemTemp.running) {
									//  cItemTemp.block.stop(true, true);
									// } else {
										cItemTemp.block.stop(true).css(cItemTemp.css);
									//}
								} else {
									cItemTemp.block.css(self._vendorPref + self._TD, '0s');
									cItemTemp.block.css(cItemTemp.css);
								}
								self._slideWithBlocks = null;
								slide.animBlocksDisplayed = false;
							}
						}
						self._blockAnimProps = [];
					}
					if(slide.animBlocks) {
						slide.animBlocksDisplayed = true;
						self._slideWithBlocks = slide;
						self._animateBlocks(slide.animBlocks);
					}
				}
			}
		},
		_updateAnimBlockProps: function(obj, props) {
			setTimeout(function() {
				obj.css(props);
			}, 6);
		},
		_animateBlocks: function(animBlocks) {
			var self = this,
				item,
				animObj,
				newPropObj,
				transitionData;

			var currItem,
				fadeEnabled,
				moveEnabled,        
				effectName, 
				effectsObject,
				moveEffectProperty,
				currEffects,
				newEffectObj, 
				moveOffset,
				delay,
				speed,
				easing,
				moveProp,
				i;

			self._animatedBlockTimeouts = [];

			animBlocks.each(function(index) {

				item = $(this);
				

				animObj = {};
				newPropObj = {};
				transitionData = null;

					var moveOffset = item.data('move-offset');
					if(isNaN(moveOffset)) {
						moveOffset = self.st.block.moveOffset;
					}

					if(moveOffset > 0) {
						var moveEffect = item.data('move-effect');
						if(moveEffect) {
							moveEffect = moveEffect.toLowerCase();
							if(moveEffect === 'none') {
								moveEffect = false;
							} else if(moveEffect !== 'left' && moveEffect !== 'top' && moveEffect !== 'bottom' && moveEffect !== 'right') {
								moveEffect = self.st.block.moveEffect;
								if(moveEffect === 'none') {
									moveEffect = false;
								}
							}
						} else {
							moveEffect = self.st.block.moveEffect;
						}
						if(moveEffect && moveEffect !== 'none') {
							var moveHorizontal;
							if(moveEffect === 'right' || moveEffect === 'left') {
								moveHorizontal = true;
							} else {
								moveHorizontal = false;
							}
							var currPos,
								moveProp,
								startPos;
							
							isOppositeProp = false;
							
							if(self._useCSS3Transitions) {
								currPos = 0;
								moveProp = self._xProp;
							} else {
								if(moveHorizontal) {
									if( !isNaN( parseInt(item.css('right'), 10) ) ) {
										moveProp = 'right';
										isOppositeProp = true;
									} else {
										moveProp = 'left';
									}
								} else {

									if( !isNaN( parseInt(item.css('bottom'), 10) ) ) {
										moveProp = 'bottom';
										isOppositeProp = true;
									} else {
										moveProp = 'top';
									}
								}
								moveProp = 'margin-'+moveProp;
								if(isOppositeProp) {
									moveOffset = -moveOffset;
								}

								if(!self._useCSS3Transitions) {
									currPos = item.data('rs-start-move-prop');
									if( currPos === undefined ) {
										currPos = parseInt(item.css(moveProp), 10); 
										item.data('rs-start-move-prop', currPos);
									}
								} else {
									currPos = parseInt(item.css(moveProp), 10); 
								}
								
								
							}

							if(moveEffect === 'top' || moveEffect === 'left') {
								startPos = currPos - moveOffset;
							} else {
								startPos = currPos + moveOffset;
							}
							
							newPropObj[moveProp] = self._getCSS3Prop(startPos, moveHorizontal);
							animObj[moveProp] = self._getCSS3Prop(currPos, moveHorizontal);
							
						}
					}
					

					var fadeEffect = item.attr('data-fade-effect');
					if(!fadeEffect) {
						fadeEffect = self.st.block.fadeEffect;
					} else if(fadeEffect.toLowerCase() === 'none' || fadeEffect.toLowerCase() === 'false') {
						fadeEffect = false;
					}
					if(fadeEffect) {
						newPropObj.opacity = 0;
						animObj.opacity = 1;
					}

					if(fadeEffect || moveEffect) {
						transitionData = {};
						transitionData.hasFade = Boolean(fadeEffect);
						if(Boolean(moveEffect)) {
							transitionData.moveProp = moveProp;
							transitionData.hasMove = true;
						}

						transitionData.speed = item.data('speed');
						if(isNaN(transitionData.speed)) {
							transitionData.speed = self.st.block.speed;
						}
						transitionData.easing = item.data('easing');
						if(!transitionData.easing) {
							transitionData.easing = self.st.block.easing;
						}
						transitionData.css3Easing = $.rsCSS3Easing[transitionData.easing];

						transitionData.delay =  item.data('delay');
						if(isNaN(transitionData.delay)) {
							transitionData.delay = self.st.block.delay * index;
						}

					}

					var blockPropsObj = {};
					if(self._useCSS3Transitions) {
						blockPropsObj[(self._vendorPref + self._TD)] =  '0ms';
					}
					blockPropsObj.moveProp = animObj.moveProp;
					blockPropsObj.opacity = animObj.opacity;
					blockPropsObj.display = 'none';


					self._blockAnimProps.push({block:item, css:blockPropsObj});
					
					self._updateAnimBlockProps(item, newPropObj);

					// animate caption
					self._animatedBlockTimeouts.push(setTimeout((function (cItem, animateData, transitionData, index) { 
						return function() { 
							cItem.css('display', 'block');
							if(transitionData) {
								var animObj = {};
								if(!self._useCSS3Transitions) {
									setTimeout(function() {
										cItem.animate(animateData, transitionData.speed, transitionData.easing);
									}, 16);
								} else {
									var prop = '';
									if(transitionData.hasMove) {
										prop += transitionData.moveProp;
									} 
									if(transitionData.hasFade) {
										if(transitionData.hasMove) {
											prop += ', ';
										}
										prop += 'opacity';
									}
									animObj[(self._vendorPref + self._TP)] = prop;
									animObj[(self._vendorPref + self._TD)] =  transitionData.speed + 'ms';
									animObj[(self._vendorPref + self._TTF)] = transitionData.css3Easing;
									cItem.css(animObj);
									setTimeout(function() {
										cItem.css(animateData);
									}, 24);
								}
							}
					
							delete self._animatedBlockTimeouts[index];
						};
					})(item, animObj, transitionData, index), transitionData.delay <= 6 ? 12 : transitionData.delay));        
				//} 



			});
		}
	});
	$.rsModules.animatedBlocks = $.rsProto._initAnimatedBlocks;

	/****************************************************************************************************************/

	/**
	 *
	 * RoyalSlider porthole-thumbnails module by Miroslav Varsky (from Dream-Theme.com)
	 * @version 1.0.b:
	 *
	 */ 
	$.extend($.rsProto, {
		_initThumbs: function() {
			var self = this;
			if(self.st.controlNavigation === 'porthole') {

				self._thumbsDefaults = {
					drag: false,
					touch: false,
					orientation: 'vertical',
					navigation: true,
					spacing: 10,
					appendSpan: false,
					transitionSpeed:600,
					autoCenter: true,
					fitInViewport: true, 
					firstMargin: true,
					paddingTop: 0,
					paddingBottom: 0
				};

				self.st.thumbs = $.extend({}, self._thumbsDefaults, self.st.thumbs);
				self._firstThumbMoved = true;
				if(self.st.thumbs.firstMargin === false) { self.st.thumbs.firstMargin = 0; }
				else if(self.st.thumbs.firstMargin === true) { self.st.thumbs.firstMargin = self.st.thumbs.spacing; }

				self.ev.on('rsBeforeParseNode', function(e, content, obj) {
					content = $(content);
					obj.thumbnail = content.find('.rsTmb').remove();
					if(!obj.thumbnail.length) {
						obj.thumbnail = content.attr('data-rsTmb');
						if(!obj.thumbnail) {
							obj.thumbnail = content.find('.rsImg').attr('data-rsTmb');
						}
						if(!obj.thumbnail) {
							obj.thumbnail = '';
						} else {
							obj.thumbnail = '<img src="'+obj.thumbnail+'" width="150" height="150" />';
						}
					} else {
						obj.thumbnail = $(document.createElement('div')).append(obj.thumbnail).html();
					}
				});

				self.ev.one('rsAfterPropsSetup', function() {
					self._createThumbs();
				});

				self._prevNavItem = null;

				self.ev.on('rsOnUpdateNav', function() {

					//self._controlNavItems.attr('class', 'rsNavItem rsThumb');

					var currItem = $(self._controlNavItems[self.currSlideId]);
					if(currItem === self._prevNavItem) {
						return;
					}
					if(self._prevNavItem) {
						self._prevNavItem = null;
					}
					if(self._thumbsNavigation) {          
						self._setCurrentThumb(self.currSlideId);
					}

					self._prevNavItem = currItem;

					self._controlNavItems.each(function() {
						if (self._prevNavItem[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavSelected');
						}
						else if (self._prevNavItem.prev().prev()[0]===this || self._prevNavItem.next().next()[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavVis');
						}
						else if (self._prevNavItem.prev()[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavPrev');
						}
						else if (self._prevNavItem.next()[0]===this) {
							$(this).attr('class', 'rsNavItem rsThumb rsNavNext');
						}
						else {
							$(this).attr('class', 'rsNavItem rsThumb');
						}
					});


				});

				self.ev.on('rsOnAppendSlide', function(e, parsedSlide, index) {
					var html = '<div'+self._thumbsMargin+' class="rsNavItem rsThumb">'+self._addThumbHTML+parsedSlide.thumbnail+'</div>';
					if(index >= self.numSlides) {
						self._thumbsContainer.append(html);
					} else {
						self._controlNavItems.eq(index).before(html);
					}
					self._controlNavItems = self._thumbsContainer.children();
					self.updateThumbsSize();
				});
				self.ev.on('rsOnRemoveSlide', function(e, index) {
					var itemToRemove = self._controlNavItems.eq(index);
					if(itemToRemove) {
						itemToRemove.remove();
						self._controlNavItems = self._thumbsContainer.children();
						self.updateThumbsSize();
					}
				}); 
				

			} 
		},
		_createThumbs: function() {
			var self = this, 
				tText = 'rsThumbs',
				thumbSt = self.st.thumbs,
				out = '',
				style,
				item,
				spacing = thumbSt.spacing;
			
			self._controlNavEnabled = true;
			self._thumbsHorizontal = (thumbSt.orientation === 'vertical') ? false : true;
			
			self._thumbsMargin = style = spacing ? ' style="margin-' + (self._thumbsHorizontal ? 'right' : 'bottom') + ':'+ spacing+'px;"' : ''; 
			
			self._thumbsPosition = 0;
			self._isThumbsAnimating = false;
			self._thumbsDrag = false;
			self._thumbsNavigation = false;

			var pl = (self._thumbsHorizontal ? 'Hor' : 'Ver');
			self.slider.addClass('rsWithThumbs' + ' rsWithThumbs'+ pl );
			
			out += '<div class="rsNav rsThumbs rsThumbs'+pl +'"><div class="'+tText+'Container">';
			self._addThumbHTML = thumbSt.appendSpan ? '<span class="thumbIco"></span>' : '';
			for(var i = 0; i < self.numSlides; i++) {
				item = self.slides[i];
				out += '<div'+style+' class="rsNavItem rsThumb">'+item.thumbnail+self._addThumbHTML+'</div>';
			}
			out = $(out +'</div></div>');

			var o = {};
			if(thumbSt.paddingTop) {
				o[self._thumbsHorizontal ? 'paddingTop' : 'paddingLeft'] = thumbSt.paddingTop;
			} 
			if(thumbSt.paddingBottom) {
				o[self._thumbsHorizontal ? 'paddingBottom' : 'paddingRight'] = thumbSt.paddingBottom;
			} 
			out.css(o);

			self._thumbsContainer = $(out).find('.' + tText + 'Container');



			self._controlNav = out;
			self._controlNavItems = self._thumbsContainer.children();
			

			if(self.msEnabled && self.st.thumbs.navigation) {
				self._thumbsContainer.css('-ms-touch-action', self._thumbsHorizontal ? 'pan-y' : 'pan-x');
			}

			self.slider.append(out);
			
			self._thumbsEnabled = true;
			self._thumbsSpacing = spacing;

			
			if(thumbSt.navigation) {
				if(self._useCSS3Transitions) {
					self._thumbsContainer.css(self._vendorPref + 'transition-property', self._vendorPref + 'transform');
				}
			}
			
			self._controlNav.on('click.rs','.rsNavItem',function(e) {
				if(!self._thumbsDrag ) {
					self.goTo( $(this).index() );
				}
			});

			self.ev.off('rsBeforeSizeSet.thumbs').on('rsBeforeSizeSet.thumbs', function() {
				self._realWrapSize = self._thumbsHorizontal ? self._wrapHeight : self._wrapWidth;
				self.updateThumbsSize(true);

			});


			// fix deprecated name
			if(!self.st.autoPlay && self.st.autoplay) {
				self.st.autoPlay = self.st.autoplay;
			}

			if (self.st.autoPlay.enabled) {
				self._thumbsContainer.after('<div class="progress-wrapper"><div class="progress-controls"></div></div>');
				self.progressWrap = self._thumbsContainer.next();
				self.progressHtml = '<div class="progress-mask"><div class="progress-spinner-left" style="'+self._vendorPref+'animation-duration: '+self.st.autoPlay.delay+'ms;"></div></div><div class="progress-mask"><div class="progress-spinner-right" style="'+self._vendorPref+'animation-duration: '+self.st.autoPlay.delay+'ms;"></div></div>';

				self.ev.on("autoPlayPlay", function() {
					if (self.progressWrap.find(".progress-mask").length < 1) {
						self.progressWrap.prepend(self.progressHtml);
					}
					self.progressWrap.removeClass("paused");
				});

				self.ev.on("autoPlayPause", function() {
					self.progressWrap.find(".progress-mask").remove();
					if (!self._autoPlayEnabled) {
						self.progressWrap.addClass("paused");
					}
				});

				self.ev.on('rsAfterSlideChange', function() {
					self.progressWrap.removeClass("blurred");
				});

				self.ev.on('rsBeforeAnimStart', function() {
					self.progressWrap.addClass("blurred");
				});

				self.ev.on('rsVideoPlay', function() {
					$("body").addClass("hide-thumbnails");
					if (!self.slider.parent().hasClass("fixed")) $("body").addClass("video-playing");
				});
				self.ev.on('rsVideoStop', function() {
					$("body").removeClass("video-playing").removeClass("hide-thumbnails");
				});

				self.progressWrap.on("click", function() {
					self.toggleAutoPlay();
				});
			}
		},
		updateThumbsSize: function(isResize) {
			var self = this,
				firstThumb = self._controlNavItems.first(),
				cssObj = {};

			var numItems = self._controlNavItems.length;
			self._thumbSize = ( self._thumbsHorizontal ? firstThumb.outerWidth() : firstThumb.outerHeight() ) + self._thumbsSpacing;
			self._thumbsContainerSize = self._thumbsContainer.outerHeight(); // numItems * self._thumbSize - self._thumbsSpacing;
			//cssObj[self._thumbsHorizontal ? 'width' : 'height'] = self._thumbsContainerSize + self._thumbsSpacing;
			self._thumbsViewportSize = self._thumbsHorizontal ? self._controlNav.width() : self._controlNav.height();
			self._thumbsMaxPosition = -(self._thumbsContainerSize - self._thumbsViewportSize) - (self.st.thumbs.firstMargin);
			self._thumbsMinPosition = self.st.thumbs.firstMargin;
			self._visibleThumbsPerView = Math.floor(self._thumbsViewportSize / self._thumbSize); // 1;

			if(self.st.thumbs.navigation && !self._thumbsNavigation) {
				self._thumbsNavigation = true;
				if( (!self.hasTouch && self.st.thumbs.drag) ||  (self.hasTouch && self.st.thumbs.touch)) {
					self._thumbsDrag = true;
					self._controlNav.on(self._downEvent, function(e) { self._onDragStart(e, true); });  
				}
			}

			if(self._useCSS3Transitions) {
				cssObj[(self._vendorPref + 'transition-duration')] = '0ms';
			}

			self._thumbsContainer.css(cssObj);
		},
		setThumbsOrientation: function(newPlacement, dontUpdateSize) {
			var self = this;
			if(self._thumbsEnabled) {
				self.st.thumbs.orientation = newPlacement;
				self._controlNav.remove();
				self.slider.removeClass('rsWithThumbsHor rsWithThumbsVer');
				self._createThumbs();
				self._controlNav.off(self._downEvent);  
				if(!dontUpdateSize) {
					self.updateSliderSize(true);
				}
			}
		},
		_setThumbsPosition: function(pos) {
			var self = this;
			self._thumbsPosition = pos;
			if(self._useCSS3Transitions) {
				self._thumbsContainer.css(self._xProp, self._tPref1 + ( self._thumbsHorizontal ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 );
			} else {
				self._thumbsContainer.css(self._thumbsHorizontal ? self._xProp : self._yProp, pos);
			}
		},
		_animateThumbsTo: function(pos, speed, outEasing, bounceAnimPosition, bounceAnimSpeed) {

			var self = this;
			if(!self._thumbsNavigation) {
				return;
			}
			if(!speed) {
				speed = self.st.thumbs.transitionSpeed;
			}
			self._thumbsPosition = pos;
			if(self._thumbsAnimTimeout) {
				clearTimeout(self._thumbsAnimTimeout);
			}
			if(self._isThumbsAnimating) {
				if(!self._useCSS3Transitions) {
					self._thumbsContainer.stop();
				}
				outEasing = true;
			}
			var animObj = {};
			self._isThumbsAnimating = true;
			if(!self._useCSS3Transitions) {
				animObj[self._thumbsHorizontal ? self._xProp : self._yProp] = pos + 'px';
				self._thumbsContainer.animate(animObj, speed, outEasing ? 'easeOutCubic' : self.st.easeInOut);
			} else { 
				animObj[(self._vendorPref + 'transition-duration')] = speed+'ms';
				animObj[(self._vendorPref + 'transition-timing-function')] = outEasing ? $.rsCSS3Easing[self.st.easeOut] : $.rsCSS3Easing[self.st.easeInOut];
				self._thumbsContainer.css(animObj);
				self._setThumbsPosition(pos);
			}
			if(bounceAnimPosition) {
				self._thumbsPosition = bounceAnimPosition;
			}
			
			self._thumbsAnimTimeout = setTimeout(function() {
				self._isThumbsAnimating = false;
				if(bounceAnimSpeed) {
					self._animateThumbsTo(bounceAnimPosition, bounceAnimSpeed, true);
					bounceAnimSpeed = null;
				}
			}, speed);
		},
		_setCurrentThumb: function(id, justSet) {
			var self = this,
				newPos = -id * 40;

			if (newPos == 0) {
				newPos = 20;
			}

			if(!self._thumbsNavigation) {
				return;
			}

			if(self._firstThumbMoved) {
				justSet = true;
				self._firstThumbMoved = false;
			}

			if(newPos !== self._thumbsPosition) {
				if(!justSet) {
					self._animateThumbsTo(newPos);
				} else {
					self._setThumbsPosition(newPos);
				}
			}

		}
	});
	$.rsModules.thumbnails = $.rsProto._initThumbs;
})(jQuery, window);

/*!
 * Isotope PACKAGED v2.1.0
 * Filter & sort magical layouts
 * http://isotope.metafizzy.co
 */

/**
 * Bridget makes jQuery widgets
 * v1.1.0
 * MIT license
 */

( function( window ) {



	// -------------------------- utils -------------------------- //

	var slice = Array.prototype.slice;

	function noop() {}

	// -------------------------- definition -------------------------- //

	function defineBridget( $ ) {

	// bail if no jQuery
	if ( !$ ) {
	  return;
	}

	// -------------------------- addOptionMethod -------------------------- //

	/**
	 * adds option method -> $().plugin('option', {...})
	 * @param {Function} PluginClass - constructor class
	 */
	function addOptionMethod( PluginClass ) {
	  // don't overwrite original option method
	  if ( PluginClass.prototype.option ) {
	    return;
	  }

	  // option setter
	  PluginClass.prototype.option = function( opts ) {
	    // bail out if not an object
	    if ( !$.isPlainObject( opts ) ){
	      return;
	    }
	    this.options = $.extend( true, this.options, opts );
	  };
	}

	// -------------------------- plugin bridge -------------------------- //

	// helper function for logging errors
	// $.error breaks jQuery chaining
	var logError = typeof console === 'undefined' ? noop :
	  function( message ) {
	    console.error( message );
	  };

	/**
	 * jQuery plugin bridge, access methods like $elem.plugin('method')
	 * @param {String} namespace - plugin name
	 * @param {Function} PluginClass - constructor class
	 */
	function bridge( namespace, PluginClass ) {
	  // add to jQuery fn namespace
	  $.fn[ namespace ] = function( options ) {
	    if ( typeof options === 'string' ) {
	      // call plugin method when first argument is a string
	      // get arguments for method
	      var args = slice.call( arguments, 1 );

	      for ( var i=0, len = this.length; i < len; i++ ) {
	        var elem = this[i];
	        var instance = $.data( elem, namespace );
	        if ( !instance ) {
	          logError( "cannot call methods on " + namespace + " prior to initialization; " +
	            "attempted to call '" + options + "'" );
	          continue;
	        }
	        if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
	          logError( "no such method '" + options + "' for " + namespace + " instance" );
	          continue;
	        }

	        // trigger method with arguments
	        var returnValue = instance[ options ].apply( instance, args );

	        // break look and return first value if provided
	        if ( returnValue !== undefined ) {
	          return returnValue;
	        }
	      }
	      // return this if no return value
	      return this;
	    } else {
	      return this.each( function() {
	        var instance = $.data( this, namespace );
	        if ( instance ) {
	          // apply options & init
	          instance.option( options );
	          instance._init();
	        } else {
	          // initialize new instance
	          instance = new PluginClass( this, options );
	          $.data( this, namespace, instance );
	        }
	      });
	    }
	  };

	}

	// -------------------------- bridget -------------------------- //

	/**
	 * converts a Prototypical class into a proper jQuery plugin
	 *   the class must have a ._init method
	 * @param {String} namespace - plugin name, used in $().pluginName
	 * @param {Function} PluginClass - constructor class
	 */
	$.bridget = function( namespace, PluginClass ) {
	  addOptionMethod( PluginClass );
	  bridge( namespace, PluginClass );
	};

	return $.bridget;

	}

	// transport
	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'jquery-bridget/jquery.bridget',[ 'jquery' ], defineBridget );
	} else if ( typeof exports === 'object' ) {
	  defineBridget( require('jquery') );
	} else {
	  // get jquery from browser global
	  defineBridget( window.jQuery );
	}

	})( window );

	/*!
	 * eventie v1.0.5
	 * event binding helper
	 *   eventie.bind( elem, 'click', myFn )
	 *   eventie.unbind( elem, 'click', myFn )
	 * MIT license
	 */

	/*jshint browser: true, undef: true, unused: true */
	/*global define: false, module: false */

	( function( window ) {



	var docElem = document.documentElement;

	var bind = function() {};

	function getIEEvent( obj ) {
	  var event = window.event;
	  // add event.target
	  event.target = event.target || event.srcElement || obj;
	  return event;
	}

	if ( docElem.addEventListener ) {
	  bind = function( obj, type, fn ) {
	    obj.addEventListener( type, fn, false );
	  };
	} else if ( docElem.attachEvent ) {
	  bind = function( obj, type, fn ) {
	    obj[ type + fn ] = fn.handleEvent ?
	      function() {
	        var event = getIEEvent( obj );
	        fn.handleEvent.call( fn, event );
	      } :
	      function() {
	        var event = getIEEvent( obj );
	        fn.call( obj, event );
	      };
	    obj.attachEvent( "on" + type, obj[ type + fn ] );
	  };
	}

	var unbind = function() {};

	if ( docElem.removeEventListener ) {
	  unbind = function( obj, type, fn ) {
	    obj.removeEventListener( type, fn, false );
	  };
	} else if ( docElem.detachEvent ) {
	  unbind = function( obj, type, fn ) {
	    obj.detachEvent( "on" + type, obj[ type + fn ] );
	    try {
	      delete obj[ type + fn ];
	    } catch ( err ) {
	      // can't delete window object properties
	      obj[ type + fn ] = undefined;
	    }
	  };
	}

	var eventie = {
	  bind: bind,
	  unbind: unbind
	};

	// ----- module definition ----- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'eventie/eventie',eventie );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = eventie;
	} else {
	  // browser global
	  window.eventie = eventie;
	}

	})( this );

	/*!
	 * docReady v1.0.4
	 * Cross browser DOMContentLoaded event emitter
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true, unused: true*/
	/*global define: false, require: false, module: false */

	( function( window ) {



	var document = window.document;
	// collection of functions to be triggered on ready
	var queue = [];

	function docReady( fn ) {
	  // throw out non-functions
	  if ( typeof fn !== 'function' ) {
	    return;
	  }

	  if ( docReady.isReady ) {
	    // ready now, hit it
	    fn();
	  } else {
	    // queue function when ready
	    queue.push( fn );
	  }
	}

	docReady.isReady = false;

	// triggered on various doc ready events
	function onReady( event ) {
	  // bail if already triggered or IE8 document is not ready just yet
	  var isIE8NotReady = event.type === 'readystatechange' && document.readyState !== 'complete';
	  if ( docReady.isReady || isIE8NotReady ) {
	    return;
	  }

	  trigger();
	}

	function trigger() {
	  docReady.isReady = true;
	  // process queue
	  for ( var i=0, len = queue.length; i < len; i++ ) {
	    var fn = queue[i];
	    fn();
	  }
	}

	function defineDocReady( eventie ) {
	  // trigger ready if page is ready
	  if ( document.readyState === 'complete' ) {
	    trigger();
	  } else {
	    // listen for events
	    eventie.bind( document, 'DOMContentLoaded', onReady );
	    eventie.bind( document, 'readystatechange', onReady );
	    eventie.bind( window, 'load', onReady );
	  }

	  return docReady;
	}

	// transport
	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'doc-ready/doc-ready',[ 'eventie/eventie' ], defineDocReady );
	} else if ( typeof exports === 'object' ) {
	  module.exports = defineDocReady( require('eventie') );
	} else {
	  // browser global
	  window.docReady = defineDocReady( window.eventie );
	}

	})( window );

	/*!
	 * EventEmitter v4.2.9 - git.io/ee
	 * Oliver Caldwell
	 * MIT license
	 * @preserve
	 */

	(function () {
	    

	    /**
	     * Class for managing events.
	     * Can be extended to provide event functionality in other classes.
	     *
	     * @class EventEmitter Manages event registering and emitting.
	     */
	    function EventEmitter() {}

	    // Shortcuts to improve speed and size
	    var proto = EventEmitter.prototype;
	    var exports = this;
	    var originalGlobalValue = exports.EventEmitter;

	    /**
	     * Finds the index of the listener for the event in its storage array.
	     *
	     * @param {Function[]} listeners Array of listeners to search through.
	     * @param {Function} listener Method to look for.
	     * @return {Number} Index of the specified listener, -1 if not found
	     * @api private
	     */
	    function indexOfListener(listeners, listener) {
	        var i = listeners.length;
	        while (i--) {
	            if (listeners[i].listener === listener) {
	                return i;
	            }
	        }

	        return -1;
	    }

	    /**
	     * Alias a method while keeping the context correct, to allow for overwriting of target method.
	     *
	     * @param {String} name The name of the target method.
	     * @return {Function} The aliased method
	     * @api private
	     */
	    function alias(name) {
	        return function aliasClosure() {
	            return this[name].apply(this, arguments);
	        };
	    }

	    /**
	     * Returns the listener array for the specified event.
	     * Will initialise the event object and listener arrays if required.
	     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
	     * Each property in the object response is an array of listener functions.
	     *
	     * @param {String|RegExp} evt Name of the event to return the listeners from.
	     * @return {Function[]|Object} All listener functions for the event.
	     */
	    proto.getListeners = function getListeners(evt) {
	        var events = this._getEvents();
	        var response;
	        var key;

	        // Return a concatenated array of all matching events if
	        // the selector is a regular expression.
	        if (evt instanceof RegExp) {
	            response = {};
	            for (key in events) {
	                if (events.hasOwnProperty(key) && evt.test(key)) {
	                    response[key] = events[key];
	                }
	            }
	        }
	        else {
	            response = events[evt] || (events[evt] = []);
	        }

	        return response;
	    };

	    /**
	     * Takes a list of listener objects and flattens it into a list of listener functions.
	     *
	     * @param {Object[]} listeners Raw listener objects.
	     * @return {Function[]} Just the listener functions.
	     */
	    proto.flattenListeners = function flattenListeners(listeners) {
	        var flatListeners = [];
	        var i;

	        for (i = 0; i < listeners.length; i += 1) {
	            flatListeners.push(listeners[i].listener);
	        }

	        return flatListeners;
	    };

	    /**
	     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
	     *
	     * @param {String|RegExp} evt Name of the event to return the listeners from.
	     * @return {Object} All listener functions for an event in an object.
	     */
	    proto.getListenersAsObject = function getListenersAsObject(evt) {
	        var listeners = this.getListeners(evt);
	        var response;

	        if (listeners instanceof Array) {
	            response = {};
	            response[evt] = listeners;
	        }

	        return response || listeners;
	    };

	    /**
	     * Adds a listener function to the specified event.
	     * The listener will not be added if it is a duplicate.
	     * If the listener returns true then it will be removed after it is called.
	     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to attach the listener to.
	     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.addListener = function addListener(evt, listener) {
	        var listeners = this.getListenersAsObject(evt);
	        var listenerIsWrapped = typeof listener === 'object';
	        var key;

	        for (key in listeners) {
	            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
	                listeners[key].push(listenerIsWrapped ? listener : {
	                    listener: listener,
	                    once: false
	                });
	            }
	        }

	        return this;
	    };

	    /**
	     * Alias of addListener
	     */
	    proto.on = alias('addListener');

	    /**
	     * Semi-alias of addListener. It will add a listener that will be
	     * automatically removed after its first execution.
	     *
	     * @param {String|RegExp} evt Name of the event to attach the listener to.
	     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.addOnceListener = function addOnceListener(evt, listener) {
	        return this.addListener(evt, {
	            listener: listener,
	            once: true
	        });
	    };

	    /**
	     * Alias of addOnceListener.
	     */
	    proto.once = alias('addOnceListener');

	    /**
	     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
	     * You need to tell it what event names should be matched by a regex.
	     *
	     * @param {String} evt Name of the event to create.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.defineEvent = function defineEvent(evt) {
	        this.getListeners(evt);
	        return this;
	    };

	    /**
	     * Uses defineEvent to define multiple events.
	     *
	     * @param {String[]} evts An array of event names to define.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.defineEvents = function defineEvents(evts) {
	        for (var i = 0; i < evts.length; i += 1) {
	            this.defineEvent(evts[i]);
	        }
	        return this;
	    };

	    /**
	     * Removes a listener function from the specified event.
	     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to remove the listener from.
	     * @param {Function} listener Method to remove from the event.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.removeListener = function removeListener(evt, listener) {
	        var listeners = this.getListenersAsObject(evt);
	        var index;
	        var key;

	        for (key in listeners) {
	            if (listeners.hasOwnProperty(key)) {
	                index = indexOfListener(listeners[key], listener);

	                if (index !== -1) {
	                    listeners[key].splice(index, 1);
	                }
	            }
	        }

	        return this;
	    };

	    /**
	     * Alias of removeListener
	     */
	    proto.off = alias('removeListener');

	    /**
	     * Adds listeners in bulk using the manipulateListeners method.
	     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
	     * You can also pass it a regular expression to add the array of listeners to all events that match it.
	     * Yeah, this function does quite a bit. That's probably a bad thing.
	     *
	     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
	     * @param {Function[]} [listeners] An optional array of listener functions to add.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.addListeners = function addListeners(evt, listeners) {
	        // Pass through to manipulateListeners
	        return this.manipulateListeners(false, evt, listeners);
	    };

	    /**
	     * Removes listeners in bulk using the manipulateListeners method.
	     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
	     * You can also pass it an event name and an array of listeners to be removed.
	     * You can also pass it a regular expression to remove the listeners from all events that match it.
	     *
	     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
	     * @param {Function[]} [listeners] An optional array of listener functions to remove.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.removeListeners = function removeListeners(evt, listeners) {
	        // Pass through to manipulateListeners
	        return this.manipulateListeners(true, evt, listeners);
	    };

	    /**
	     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
	     * The first argument will determine if the listeners are removed (true) or added (false).
	     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
	     * You can also pass it an event name and an array of listeners to be added/removed.
	     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
	     *
	     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
	     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
	     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
	        var i;
	        var value;
	        var single = remove ? this.removeListener : this.addListener;
	        var multiple = remove ? this.removeListeners : this.addListeners;

	        // If evt is an object then pass each of its properties to this method
	        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
	            for (i in evt) {
	                if (evt.hasOwnProperty(i) && (value = evt[i])) {
	                    // Pass the single listener straight through to the singular method
	                    if (typeof value === 'function') {
	                        single.call(this, i, value);
	                    }
	                    else {
	                        // Otherwise pass back to the multiple function
	                        multiple.call(this, i, value);
	                    }
	                }
	            }
	        }
	        else {
	            // So evt must be a string
	            // And listeners must be an array of listeners
	            // Loop over it and pass each one to the multiple method
	            i = listeners.length;
	            while (i--) {
	                single.call(this, evt, listeners[i]);
	            }
	        }

	        return this;
	    };

	    /**
	     * Removes all listeners from a specified event.
	     * If you do not specify an event then all listeners will be removed.
	     * That means every event will be emptied.
	     * You can also pass a regex to remove all events that match it.
	     *
	     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.removeEvent = function removeEvent(evt) {
	        var type = typeof evt;
	        var events = this._getEvents();
	        var key;

	        // Remove different things depending on the state of evt
	        if (type === 'string') {
	            // Remove all listeners for the specified event
	            delete events[evt];
	        }
	        else if (evt instanceof RegExp) {
	            // Remove all events matching the regex.
	            for (key in events) {
	                if (events.hasOwnProperty(key) && evt.test(key)) {
	                    delete events[key];
	                }
	            }
	        }
	        else {
	            // Remove all listeners in all events
	            delete this._events;
	        }

	        return this;
	    };

	    /**
	     * Alias of removeEvent.
	     *
	     * Added to mirror the node API.
	     */
	    proto.removeAllListeners = alias('removeEvent');

	    /**
	     * Emits an event of your choice.
	     * When emitted, every listener attached to that event will be executed.
	     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
	     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
	     * So they will not arrive within the array on the other side, they will be separate.
	     * You can also pass a regular expression to emit to all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
	     * @param {Array} [args] Optional array of arguments to be passed to each listener.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.emitEvent = function emitEvent(evt, args) {
	        var listeners = this.getListenersAsObject(evt);
	        var listener;
	        var i;
	        var key;
	        var response;

	        for (key in listeners) {
	            if (listeners.hasOwnProperty(key)) {
	                i = listeners[key].length;

	                while (i--) {
	                    // If the listener returns true then it shall be removed from the event
	                    // The function is executed either with a basic call or an apply if there is an args array
	                    listener = listeners[key][i];

	                    if (listener.once === true) {
	                        this.removeListener(evt, listener.listener);
	                    }

	                    response = listener.listener.apply(this, args || []);

	                    if (response === this._getOnceReturnValue()) {
	                        this.removeListener(evt, listener.listener);
	                    }
	                }
	            }
	        }

	        return this;
	    };

	    /**
	     * Alias of emitEvent
	     */
	    proto.trigger = alias('emitEvent');

	    /**
	     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
	     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
	     *
	     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
	     * @param {...*} Optional additional arguments to be passed to each listener.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.emit = function emit(evt) {
	        var args = Array.prototype.slice.call(arguments, 1);
	        return this.emitEvent(evt, args);
	    };

	    /**
	     * Sets the current value to check against when executing listeners. If a
	     * listeners return value matches the one set here then it will be removed
	     * after execution. This value defaults to true.
	     *
	     * @param {*} value The new value to check for when executing listeners.
	     * @return {Object} Current instance of EventEmitter for chaining.
	     */
	    proto.setOnceReturnValue = function setOnceReturnValue(value) {
	        this._onceReturnValue = value;
	        return this;
	    };

	    /**
	     * Fetches the current value to check against when executing listeners. If
	     * the listeners return value matches this one then it should be removed
	     * automatically. It will return true by default.
	     *
	     * @return {*|Boolean} The current value to check for or the default, true.
	     * @api private
	     */
	    proto._getOnceReturnValue = function _getOnceReturnValue() {
	        if (this.hasOwnProperty('_onceReturnValue')) {
	            return this._onceReturnValue;
	        }
	        else {
	            return true;
	        }
	    };

	    /**
	     * Fetches the events object and creates one if required.
	     *
	     * @return {Object} The events storage object.
	     * @api private
	     */
	    proto._getEvents = function _getEvents() {
	        return this._events || (this._events = {});
	    };

	    /**
	     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
	     *
	     * @return {Function} Non conflicting EventEmitter class.
	     */
	    EventEmitter.noConflict = function noConflict() {
	        exports.EventEmitter = originalGlobalValue;
	        return EventEmitter;
	    };

	    // Expose the class either via AMD, CommonJS or the global object
	    if (typeof define === 'function' && define.amd) {
	        define('eventEmitter/EventEmitter',[],function () {
	            return EventEmitter;
	        });
	    }
	    else if (typeof module === 'object' && module.exports){
	        module.exports = EventEmitter;
	    }
	    else {
	        exports.EventEmitter = EventEmitter;
	    }
	}.call(this));

	/*!
	 * getStyleProperty v1.0.4
	 * original by kangax
	 * http://perfectionkills.com/feature-testing-css-properties/
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true */
	/*global define: false, exports: false, module: false */

	( function( window ) {



	var prefixes = 'Webkit Moz ms Ms O'.split(' ');
	var docElemStyle = document.documentElement.style;

	function getStyleProperty( propName ) {
	  if ( !propName ) {
	    return;
	  }

	  // test standard property first
	  if ( typeof docElemStyle[ propName ] === 'string' ) {
	    return propName;
	  }

	  // capitalize
	  propName = propName.charAt(0).toUpperCase() + propName.slice(1);

	  // test vendor specific properties
	  var prefixed;
	  for ( var i=0, len = prefixes.length; i < len; i++ ) {
	    prefixed = prefixes[i] + propName;
	    if ( typeof docElemStyle[ prefixed ] === 'string' ) {
	      return prefixed;
	    }
	  }
	}

	// transport
	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'get-style-property/get-style-property',[],function() {
	    return getStyleProperty;
	  });
	} else if ( typeof exports === 'object' ) {
	  // CommonJS for Component
	  module.exports = getStyleProperty;
	} else {
	  // browser global
	  window.getStyleProperty = getStyleProperty;
	}

	})( window );

	/*!
	 * getSize v1.2.2
	 * measure size of elements
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true, unused: true */
	/*global define: false, exports: false, require: false, module: false, console: false */

	( function( window, undefined ) {



	// -------------------------- helpers -------------------------- //

	// get a number from a string, not a percentage
	function getStyleSize( value ) {
	  var num = parseFloat( value );
	  // not a percent like '100%', and a number
	  var isValid = value.indexOf('%') === -1 && !isNaN( num );
	  return isValid && num;
	}

	function noop() {}

	var logError = typeof console === 'undefined' ? noop :
	  function( message ) {
	    console.error( message );
	  };

	// -------------------------- measurements -------------------------- //

	var measurements = [
	  'paddingLeft',
	  'paddingRight',
	  'paddingTop',
	  'paddingBottom',
	  'marginLeft',
	  'marginRight',
	  'marginTop',
	  'marginBottom',
	  'borderLeftWidth',
	  'borderRightWidth',
	  'borderTopWidth',
	  'borderBottomWidth'
	];

	function getZeroSize() {
	  var size = {
	    width: 0,
	    height: 0,
	    innerWidth: 0,
	    innerHeight: 0,
	    outerWidth: 0,
	    outerHeight: 0
	  };
	  for ( var i=0, len = measurements.length; i < len; i++ ) {
	    var measurement = measurements[i];
	    size[ measurement ] = 0;
	  }
	  return size;
	}



	function defineGetSize( getStyleProperty ) {

	// -------------------------- setup -------------------------- //

	var isSetup = false;

	var getStyle, boxSizingProp, isBoxSizeOuter;

	/**
	 * setup vars and functions
	 * do it on initial getSize(), rather than on script load
	 * For Firefox bug https://bugzilla.mozilla.org/show_bug.cgi?id=548397
	 */
	function setup() {
	  // setup once
	  if ( isSetup ) {
	    return;
	  }
	  isSetup = true;

	  var getComputedStyle = window.getComputedStyle;
	  getStyle = ( function() {
	    var getStyleFn = getComputedStyle ?
	      function( elem ) {
	        return getComputedStyle( elem, null );
	      } :
	      function( elem ) {
	        return elem.currentStyle;
	      };

	      return function getStyle( elem ) {
	        var style = getStyleFn( elem );
	        if ( !style ) {
	          logError( 'Style returned ' + style +
	            '. Are you running this code in a hidden iframe on Firefox? ' +
	            'See http://bit.ly/getsizebug1' );
	        }
	        return style;
	      };
	  })();

	  // -------------------------- box sizing -------------------------- //

	  boxSizingProp = getStyleProperty('boxSizing');

	  /**
	   * WebKit measures the outer-width on style.width on border-box elems
	   * IE & Firefox measures the inner-width
	   */
	  if ( boxSizingProp ) {
	    var div = document.createElement('div');
	    div.style.width = '200px';
	    div.style.padding = '1px 2px 3px 4px';
	    div.style.borderStyle = 'solid';
	    div.style.borderWidth = '1px 2px 3px 4px';
	    div.style[ boxSizingProp ] = 'border-box';

	    var body = document.body || document.documentElement;
	    body.appendChild( div );
	    var style = getStyle( div );

	    isBoxSizeOuter = getStyleSize( style.width ) === 200;
	    body.removeChild( div );
	  }

	}

	// -------------------------- getSize -------------------------- //

	function getSize( elem ) {
	  setup();

	  // use querySeletor if elem is string
	  if ( typeof elem === 'string' ) {
	    elem = document.querySelector( elem );
	  }

	  // do not proceed on non-objects
	  if ( !elem || typeof elem !== 'object' || !elem.nodeType ) {
	    return;
	  }

	  var style = getStyle( elem );

	  // if hidden, everything is 0
	  if ( style.display === 'none' ) {
	    return getZeroSize();
	  }

	  var size = {};
	  size.width = elem.offsetWidth;
	  size.height = elem.offsetHeight;

	  var isBorderBox = size.isBorderBox = !!( boxSizingProp &&
	    style[ boxSizingProp ] && style[ boxSizingProp ] === 'border-box' );

	  // get all measurements
	  for ( var i=0, len = measurements.length; i < len; i++ ) {
	    var measurement = measurements[i];
	    var value = style[ measurement ];
	    value = mungeNonPixel( elem, value );
	    var num = parseFloat( value );
	    // any 'auto', 'medium' value will be 0
	    size[ measurement ] = !isNaN( num ) ? num : 0;
	  }

	  var paddingWidth = size.paddingLeft + size.paddingRight;
	  var paddingHeight = size.paddingTop + size.paddingBottom;
	  var marginWidth = size.marginLeft + size.marginRight;
	  var marginHeight = size.marginTop + size.marginBottom;
	  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
	  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

	  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

	  // overwrite width and height if we can get it from style
	  var styleWidth = getStyleSize( style.width );
	  if ( styleWidth !== false ) {
	    size.width = styleWidth +
	      // add padding and border unless it's already including it
	      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
	  }

	  var styleHeight = getStyleSize( style.height );
	  if ( styleHeight !== false ) {
	    size.height = styleHeight +
	      // add padding and border unless it's already including it
	      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
	  }

	  size.innerWidth = size.width - ( paddingWidth + borderWidth );
	  size.innerHeight = size.height - ( paddingHeight + borderHeight );

	  size.outerWidth = size.width + marginWidth;
	  size.outerHeight = size.height + marginHeight;

	  return size;
	}

	// IE8 returns percent values, not pixels
	// taken from jQuery's curCSS
	function mungeNonPixel( elem, value ) {
	  // IE8 and has percent value
	  if ( window.getComputedStyle || value.indexOf('%') === -1 ) {
	    return value;
	  }
	  var style = elem.style;
	  // Remember the original values
	  var left = style.left;
	  var rs = elem.runtimeStyle;
	  var rsLeft = rs && rs.left;

	  // Put in the new values to get a computed value out
	  if ( rsLeft ) {
	    rs.left = elem.currentStyle.left;
	  }
	  style.left = value;
	  value = style.pixelLeft;

	  // Revert the changed values
	  style.left = left;
	  if ( rsLeft ) {
	    rs.left = rsLeft;
	  }

	  return value;
	}

	return getSize;

	}

	// transport
	if ( typeof define === 'function' && define.amd ) {
	  // AMD for RequireJS
	  define( 'get-size/get-size',[ 'get-style-property/get-style-property' ], defineGetSize );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS for Component
	  module.exports = defineGetSize( require('desandro-get-style-property') );
	} else {
	  // browser global
	  window.getSize = defineGetSize( window.getStyleProperty );
	}

	})( window );

	/**
	 * matchesSelector v1.0.2
	 * matchesSelector( element, '.selector' )
	 * MIT license
	 */

	/*jshint browser: true, strict: true, undef: true, unused: true */
	/*global define: false, module: false */

	( function( ElemProto ) {

	  

	  var matchesMethod = ( function() {
	    // check un-prefixed
	    if ( ElemProto.matchesSelector ) {
	      return 'matchesSelector';
	    }
	    // check vendor prefixes
	    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

	    for ( var i=0, len = prefixes.length; i < len; i++ ) {
	      var prefix = prefixes[i];
	      var method = prefix + 'MatchesSelector';
	      if ( ElemProto[ method ] ) {
	        return method;
	      }
	    }
	  })();

	  // ----- match ----- //

	  function match( elem, selector ) {
	    return elem[ matchesMethod ]( selector );
	  }

	  // ----- appendToFragment ----- //

	  function checkParent( elem ) {
	    // not needed if already has parent
	    if ( elem.parentNode ) {
	      return;
	    }
	    var fragment = document.createDocumentFragment();
	    fragment.appendChild( elem );
	  }

	  // ----- query ----- //

	  // fall back to using QSA
	  // thx @jonathantneal https://gist.github.com/3062955
	  function query( elem, selector ) {
	    // append to fragment if no parent
	    checkParent( elem );

	    // match elem with all selected elems of parent
	    var elems = elem.parentNode.querySelectorAll( selector );
	    for ( var i=0, len = elems.length; i < len; i++ ) {
	      // return true if match
	      if ( elems[i] === elem ) {
	        return true;
	      }
	    }
	    // otherwise return false
	    return false;
	  }

	  // ----- matchChild ----- //

	  function matchChild( elem, selector ) {
	    checkParent( elem );
	    return match( elem, selector );
	  }

	  // ----- matchesSelector ----- //

	  var matchesSelector;

	  if ( matchesMethod ) {
	    // IE9 supports matchesSelector, but doesn't work on orphaned elems
	    // check for that
	    var div = document.createElement('div');
	    var supportsOrphans = match( div, 'div' );
	    matchesSelector = supportsOrphans ? match : matchChild;
	  } else {
	    matchesSelector = query;
	  }

	  // transport
	  if ( typeof define === 'function' && define.amd ) {
	    // AMD
	    define( 'matches-selector/matches-selector',[],function() {
	      return matchesSelector;
	    });
	  } else if ( typeof exports === 'object' ) {
	    module.exports = matchesSelector;
	  }
	  else {
	    // browser global
	    window.matchesSelector = matchesSelector;
	  }

	})( Element.prototype );

	/**
	 * Outlayer Item
	 */

	( function( window ) {



	// ----- get style ----- //

	var getComputedStyle = window.getComputedStyle;
	var getStyle = getComputedStyle ?
	  function( elem ) {
	    return getComputedStyle( elem, null );
	  } :
	  function( elem ) {
	    return elem.currentStyle;
	  };


	// extend objects
	function extend( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	}

	function isEmptyObj( obj ) {
	  for ( var prop in obj ) {
	    return false;
	  }
	  prop = null;
	  return true;
	}

	// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
	function toDash( str ) {
	  return str.replace( /([A-Z])/g, function( $1 ){
	    return '-' + $1.toLowerCase();
	  });
	}

	// -------------------------- Outlayer definition -------------------------- //

	function outlayerItemDefinition( EventEmitter, getSize, getStyleProperty ) {

	// -------------------------- CSS3 support -------------------------- //

	var transitionProperty = getStyleProperty('transition');
	var transformProperty = getStyleProperty('transform');
	var supportsCSS3 = transitionProperty && transformProperty;
	var is3d = !!getStyleProperty('perspective');

	var transitionEndEvent = {
	  WebkitTransition: 'webkitTransitionEnd',
	  MozTransition: 'transitionend',
	  OTransition: 'otransitionend',
	  transition: 'transitionend'
	}[ transitionProperty ];

	// properties that could have vendor prefix
	var prefixableProperties = [
	  'transform',
	  'transition',
	  'transitionDuration',
	  'transitionProperty'
	];

	// cache all vendor properties
	var vendorProperties = ( function() {
	  var cache = {};
	  for ( var i=0, len = prefixableProperties.length; i < len; i++ ) {
	    var prop = prefixableProperties[i];
	    var supportedProp = getStyleProperty( prop );
	    if ( supportedProp && supportedProp !== prop ) {
	      cache[ prop ] = supportedProp;
	    }
	  }
	  return cache;
	})();

	// -------------------------- Item -------------------------- //

	function Item( element, layout ) {
	  if ( !element ) {
	    return;
	  }

	  this.element = element;
	  // parent layout class, i.e. Masonry, Isotope, or Packery
	  this.layout = layout;
	  this.position = {
	    x: 0,
	    y: 0
	  };

	  this._create();
	}

	// inherit EventEmitter
	extend( Item.prototype, EventEmitter.prototype );

	Item.prototype._create = function() {
	  // transition objects
	  this._transn = {
	    ingProperties: {},
	    clean: {},
	    onEnd: {}
	  };

	  this.css({
	    position: 'absolute'
	  });
	};

	// trigger specified handler for event type
	Item.prototype.handleEvent = function( event ) {
	  var method = 'on' + event.type;
	  if ( this[ method ] ) {
	    this[ method ]( event );
	  }
	};

	Item.prototype.getSize = function() {
	  this.size = getSize( this.element );
	};

	/**
	 * apply CSS styles to element
	 * @param {Object} style
	 */
	Item.prototype.css = function( style ) {
	  var elemStyle = this.element.style;

	  for ( var prop in style ) {
	    // use vendor property if available
	    var supportedProp = vendorProperties[ prop ] || prop;
	    elemStyle[ supportedProp ] = style[ prop ];
	  }
	};

	 // measure position, and sets it
	Item.prototype.getPosition = function() {
	  var style = getStyle( this.element );
	  var layoutOptions = this.layout.options;
	  var isOriginLeft = layoutOptions.isOriginLeft;
	  var isOriginTop = layoutOptions.isOriginTop;
	  var x = parseInt( style[ isOriginLeft ? 'left' : 'right' ], 10 );
	  var y = parseInt( style[ isOriginTop ? 'top' : 'bottom' ], 10 );

	  // clean up 'auto' or other non-integer values
	  x = isNaN( x ) ? 0 : x;
	  y = isNaN( y ) ? 0 : y;
	  // remove padding from measurement
	  var layoutSize = this.layout.size;
	  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
	  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

	  this.position.x = x;
	  this.position.y = y;
	};

	// set settled position, apply padding
	Item.prototype.layoutPosition = function() {
	  var layoutSize = this.layout.size;
	  var layoutOptions = this.layout.options;
	  var style = {};

	  if ( layoutOptions.isOriginLeft ) {
	    style.left = ( this.position.x + layoutSize.paddingLeft ) + 'px';
	    // reset other property
	    style.right = '';
	  } else {
	    style.right = ( this.position.x + layoutSize.paddingRight ) + 'px';
	    style.left = '';
	  }

	  if ( layoutOptions.isOriginTop ) {
	    style.top = ( this.position.y + layoutSize.paddingTop ) + 'px';
	    style.bottom = '';
	  } else {
	    style.bottom = ( this.position.y + layoutSize.paddingBottom ) + 'px';
	    style.top = '';
	  }

	  this.css( style );
	  this.emitEvent( 'layout', [ this ] );
	};


	// transform translate function
	var translate = is3d ?
	  function( x, y ) {
	    return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
	  } :
	  function( x, y ) {
	    return 'translate(' + x + 'px, ' + y + 'px)';
	  };


	Item.prototype._transitionTo = function( x, y ) {
	  this.getPosition();
	  // get current x & y from top/left
	  var curX = this.position.x;
	  var curY = this.position.y;

	  var compareX = parseInt( x, 10 );
	  var compareY = parseInt( y, 10 );
	  var didNotMove = compareX === this.position.x && compareY === this.position.y;

	  // save end position
	  this.setPosition( x, y );

	  // if did not move and not transitioning, just go to layout
	  if ( didNotMove && !this.isTransitioning ) {
	    this.layoutPosition();
	    return;
	  }

	  var transX = x - curX;
	  var transY = y - curY;
	  var transitionStyle = {};
	  // flip cooridinates if origin on right or bottom
	  var layoutOptions = this.layout.options;
	  transX = layoutOptions.isOriginLeft ? transX : -transX;
	  transY = layoutOptions.isOriginTop ? transY : -transY;
	  transitionStyle.transform = translate( transX, transY );

	  this.transition({
	    to: transitionStyle,
	    onTransitionEnd: {
	      transform: this.layoutPosition
	    },
	    isCleaning: true
	  });
	};

	// non transition + transform support
	Item.prototype.goTo = function( x, y ) {
	  this.setPosition( x, y );
	  this.layoutPosition();
	};

	// use transition and transforms if supported
	Item.prototype.moveTo = supportsCSS3 ?
	  Item.prototype._transitionTo : Item.prototype.goTo;

	Item.prototype.setPosition = function( x, y ) {
	  this.position.x = parseInt( x, 10 );
	  this.position.y = parseInt( y, 10 );
	};

	// ----- transition ----- //

	/**
	 * @param {Object} style - CSS
	 * @param {Function} onTransitionEnd
	 */

	// non transition, just trigger callback
	Item.prototype._nonTransition = function( args ) {
	  this.css( args.to );
	  if ( args.isCleaning ) {
	    this._removeStyles( args.to );
	  }
	  for ( var prop in args.onTransitionEnd ) {
	    args.onTransitionEnd[ prop ].call( this );
	  }
	};

	/**
	 * proper transition
	 * @param {Object} args - arguments
	 *   @param {Object} to - style to transition to
	 *   @param {Object} from - style to start transition from
	 *   @param {Boolean} isCleaning - removes transition styles after transition
	 *   @param {Function} onTransitionEnd - callback
	 */
	Item.prototype._transition = function( args ) {
	  // redirect to nonTransition if no transition duration
	  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
	    this._nonTransition( args );
	    return;
	  }

	  var _transition = this._transn;
	  // keep track of onTransitionEnd callback by css property
	  for ( var prop in args.onTransitionEnd ) {
	    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
	  }
	  // keep track of properties that are transitioning
	  for ( prop in args.to ) {
	    _transition.ingProperties[ prop ] = true;
	    // keep track of properties to clean up when transition is done
	    if ( args.isCleaning ) {
	      _transition.clean[ prop ] = true;
	    }
	  }

	  // set from styles
	  if ( args.from ) {
	    this.css( args.from );
	    // force redraw. http://blog.alexmaccaw.com/css-transitions
	    var h = this.element.offsetHeight;
	    // hack for JSHint to hush about unused var
	    h = null;
	  }
	  // enable transition
	  this.enableTransition( args.to );
	  // set styles that are transitioning
	  this.css( args.to );

	  this.isTransitioning = true;

	};

	var itemTransitionProperties = transformProperty && ( toDash( transformProperty ) +
	  ',opacity' );

	Item.prototype.enableTransition = function(/* style */) {
	  // only enable if not already transitioning
	  // bug in IE10 were re-setting transition style will prevent
	  // transitionend event from triggering
	  if ( this.isTransitioning ) {
	    return;
	  }

	  // make transition: foo, bar, baz from style object
	  // TODO uncomment this bit when IE10 bug is resolved
	  // var transitionValue = [];
	  // for ( var prop in style ) {
	  //   // dash-ify camelCased properties like WebkitTransition
	  //   transitionValue.push( toDash( prop ) );
	  // }
	  // enable transition styles
	  // HACK always enable transform,opacity for IE10
	  this.css({
	    transitionProperty: itemTransitionProperties,
	    transitionDuration: this.layout.options.transitionDuration
	  });
	  // listen for transition end event
	  this.element.addEventListener( transitionEndEvent, this, false );
	};

	Item.prototype.transition = Item.prototype[ transitionProperty ? '_transition' : '_nonTransition' ];

	// ----- events ----- //

	Item.prototype.onwebkitTransitionEnd = function( event ) {
	  this.ontransitionend( event );
	};

	Item.prototype.onotransitionend = function( event ) {
	  this.ontransitionend( event );
	};

	// properties that I munge to make my life easier
	var dashedVendorProperties = {
	  '-webkit-transform': 'transform',
	  '-moz-transform': 'transform',
	  '-o-transform': 'transform'
	};

	Item.prototype.ontransitionend = function( event ) {
	  // disregard bubbled events from children
	  if ( event.target !== this.element ) {
	    return;
	  }
	  var _transition = this._transn;
	  // get property name of transitioned property, convert to prefix-free
	  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

	  // remove property that has completed transitioning
	  delete _transition.ingProperties[ propertyName ];
	  // check if any properties are still transitioning
	  if ( isEmptyObj( _transition.ingProperties ) ) {
	    // all properties have completed transitioning
	    this.disableTransition();
	  }
	  // clean style
	  if ( propertyName in _transition.clean ) {
	    // clean up style
	    this.element.style[ event.propertyName ] = '';
	    delete _transition.clean[ propertyName ];
	  }
	  // trigger onTransitionEnd callback
	  if ( propertyName in _transition.onEnd ) {
	    var onTransitionEnd = _transition.onEnd[ propertyName ];
	    onTransitionEnd.call( this );
	    delete _transition.onEnd[ propertyName ];
	  }

	  this.emitEvent( 'transitionEnd', [ this ] );
	};

	Item.prototype.disableTransition = function() {
	  this.removeTransitionStyles();
	  this.element.removeEventListener( transitionEndEvent, this, false );
	  this.isTransitioning = false;
	};

	/**
	 * removes style property from element
	 * @param {Object} style
	**/
	Item.prototype._removeStyles = function( style ) {
	  // clean up transition styles
	  var cleanStyle = {};
	  for ( var prop in style ) {
	    cleanStyle[ prop ] = '';
	  }
	  this.css( cleanStyle );
	};

	var cleanTransitionStyle = {
	  transitionProperty: '',
	  transitionDuration: ''
	};

	Item.prototype.removeTransitionStyles = function() {
	  // remove transition
	  this.css( cleanTransitionStyle );
	};

	// ----- show/hide/remove ----- //

	// remove element from DOM
	Item.prototype.removeElem = function() {
	  this.element.parentNode.removeChild( this.element );
	  this.emitEvent( 'remove', [ this ] );
	};

	Item.prototype.remove = function() {
	  // just remove element if no transition support or no transition
	  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
	    this.removeElem();
	    return;
	  }

	  // start transition
	  var _this = this;
	  this.on( 'transitionEnd', function() {
	    _this.removeElem();
	    return true; // bind once
	  });
	  this.hide();
	};

	Item.prototype.reveal = function() {
	  delete this.isHidden;
	  // remove display: none
	  this.css({ display: '' });

	  var options = this.layout.options;
	  this.transition({
	    from: options.hiddenStyle,
	    to: options.visibleStyle,
	    isCleaning: true
	  });
	};

	Item.prototype.hide = function() {
	  // set flag
	  this.isHidden = true;
	  // remove display: none
	  this.css({ display: '' });

	  var options = this.layout.options;
	  this.transition({
	    from: options.visibleStyle,
	    to: options.hiddenStyle,
	    // keep hidden stuff hidden
	    isCleaning: true,
	    onTransitionEnd: {
	      opacity: function() {
	        // check if still hidden
	        // during transition, item may have been un-hidden
	        if ( this.isHidden ) {
	          this.css({ display: 'none' });
	        }
	      }
	    }
	  });
	};

	Item.prototype.destroy = function() {
	  this.css({
	    position: '',
	    left: '',
	    right: '',
	    top: '',
	    bottom: '',
	    transition: '',
	    transform: ''
	  });
	};

	return Item;

	}

	// -------------------------- transport -------------------------- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'outlayer/item',[
	      'eventEmitter/EventEmitter',
	      'get-size/get-size',
	      'get-style-property/get-style-property'
	    ],
	    outlayerItemDefinition );
	} else if (typeof exports === 'object') {
	  // CommonJS
	  module.exports = outlayerItemDefinition(
	    require('wolfy87-eventemitter'),
	    require('get-size'),
	    require('desandro-get-style-property')
	  );
	} else {
	  // browser global
	  window.Outlayer = {};
	  window.Outlayer.Item = outlayerItemDefinition(
	    window.EventEmitter,
	    window.getSize,
	    window.getStyleProperty
	  );
	}

	})( window );

	/*!
	 * Outlayer v1.3.0
	 * the brains and guts of a layout library
	 * MIT license
	 */

	( function( window ) {



	// ----- vars ----- //

	var document = window.document;
	var console = window.console;
	var jQuery = window.jQuery;
	var noop = function() {};

	// -------------------------- helpers -------------------------- //

	// extend objects
	function extend( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	}


	var objToString = Object.prototype.toString;
	function isArray( obj ) {
	  return objToString.call( obj ) === '[object Array]';
	}

	// turn element or nodeList into an array
	function makeArray( obj ) {
	  var ary = [];
	  if ( isArray( obj ) ) {
	    // use object if already an array
	    ary = obj;
	  } else if ( obj && typeof obj.length === 'number' ) {
	    // convert nodeList to array
	    for ( var i=0, len = obj.length; i < len; i++ ) {
	      ary.push( obj[i] );
	    }
	  } else {
	    // array of single index
	    ary.push( obj );
	  }
	  return ary;
	}

	// http://stackoverflow.com/a/384380/182183
	var isElement = ( typeof HTMLElement === 'function' || typeof HTMLElement === 'object' ) ?
	  function isElementDOM2( obj ) {
	    return obj instanceof HTMLElement;
	  } :
	  function isElementQuirky( obj ) {
	    return obj && typeof obj === 'object' &&
	      obj.nodeType === 1 && typeof obj.nodeName === 'string';
	  };

	// index of helper cause IE8
	var indexOf = Array.prototype.indexOf ? function( ary, obj ) {
	    return ary.indexOf( obj );
	  } : function( ary, obj ) {
	    for ( var i=0, len = ary.length; i < len; i++ ) {
	      if ( ary[i] === obj ) {
	        return i;
	      }
	    }
	    return -1;
	  };

	function removeFrom( obj, ary ) {
	  var index = indexOf( ary, obj );
	  if ( index !== -1 ) {
	    ary.splice( index, 1 );
	  }
	}

	// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
	function toDashed( str ) {
	  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
	    return $1 + '-' + $2;
	  }).toLowerCase();
	}


	function outlayerDefinition( eventie, docReady, EventEmitter, getSize, matchesSelector, Item ) {

	// -------------------------- Outlayer -------------------------- //

	// globally unique identifiers
	var GUID = 0;
	// internal store of all Outlayer intances
	var instances = {};


	/**
	 * @param {Element, String} element
	 * @param {Object} options
	 * @constructor
	 */
	function Outlayer( element, options ) {
	  // use element as selector string
	  if ( typeof element === 'string' ) {
	    element = document.querySelector( element );
	  }

	  // bail out if not proper element
	  if ( !element || !isElement( element ) ) {
	    if ( console ) {
	      console.error( 'Bad ' + this.constructor.namespace + ' element: ' + element );
	    }
	    return;
	  }

	  this.element = element;

	  // options
	  this.options = extend( {}, this.constructor.defaults );
	  this.option( options );

	  // add id for Outlayer.getFromElement
	  var id = ++GUID;
	  this.element.outlayerGUID = id; // expando
	  instances[ id ] = this; // associate via id

	  // kick it off
	  this._create();

	  if ( this.options.isInitLayout ) {
	    this.layout();
	  }
	}

	// settings are for internal use only
	Outlayer.namespace = 'outlayer';
	Outlayer.Item = Item;

	// default options
	Outlayer.defaults = {
	  containerStyle: {
	    position: 'relative'
	  },
	  isInitLayout: true,
	  isOriginLeft: true,
	  isOriginTop: true,
	  isResizeBound: true,
	  isResizingContainer: true,
	  // item options
	  transitionDuration: '0.4s',
	  hiddenStyle: {
	    opacity: 0,
	    transform: 'scale(0.001)'
	  },
	  visibleStyle: {
	    opacity: 1,
	    transform: 'scale(1)'
	  }
	};

	// inherit EventEmitter
	extend( Outlayer.prototype, EventEmitter.prototype );

	/**
	 * set options
	 * @param {Object} opts
	 */
	Outlayer.prototype.option = function( opts ) {
	  extend( this.options, opts );
	};

	Outlayer.prototype._create = function() {
	  // get items from children
	  this.reloadItems();
	  // elements that affect layout, but are not laid out
	  this.stamps = [];
	  this.stamp( this.options.stamp );
	  // set container style
	  extend( this.element.style, this.options.containerStyle );

	  // bind resize method
	  if ( this.options.isResizeBound ) {
	    this.bindResize();
	  }
	};

	// goes through all children again and gets bricks in proper order
	Outlayer.prototype.reloadItems = function() {
	  // collection of item elements
	  this.items = this._itemize( this.element.children );
	};


	/**
	 * turn elements into Outlayer.Items to be used in layout
	 * @param {Array or NodeList or HTMLElement} elems
	 * @returns {Array} items - collection of new Outlayer Items
	 */
	Outlayer.prototype._itemize = function( elems ) {

	  var itemElems = this._filterFindItemElements( elems );
	  var Item = this.constructor.Item;

	  // create new Outlayer Items for collection
	  var items = [];
	  for ( var i=0, len = itemElems.length; i < len; i++ ) {
	    var elem = itemElems[i];
	    var item = new Item( elem, this );
	    items.push( item );
	  }

	  return items;
	};

	/**
	 * get item elements to be used in layout
	 * @param {Array or NodeList or HTMLElement} elems
	 * @returns {Array} items - item elements
	 */
	Outlayer.prototype._filterFindItemElements = function( elems ) {
	  // make array of elems
	  elems = makeArray( elems );
	  var itemSelector = this.options.itemSelector;
	  var itemElems = [];

	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    // check that elem is an actual element
	    if ( !isElement( elem ) ) {
	      continue;
	    }
	    // filter & find items if we have an item selector
	    if ( itemSelector ) {
	      // filter siblings
	      if ( matchesSelector( elem, itemSelector ) ) {
	        itemElems.push( elem );
	      }
	      // find children
	      var childElems = elem.querySelectorAll( itemSelector );
	      // concat childElems to filterFound array
	      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
	        itemElems.push( childElems[j] );
	      }
	    } else {
	      itemElems.push( elem );
	    }
	  }

	  return itemElems;
	};

	/**
	 * getter method for getting item elements
	 * @returns {Array} elems - collection of item elements
	 */
	Outlayer.prototype.getItemElements = function() {
	  var elems = [];
	  for ( var i=0, len = this.items.length; i < len; i++ ) {
	    elems.push( this.items[i].element );
	  }
	  return elems;
	};

	// ----- init & layout ----- //

	/**
	 * lays out all items
	 */
	Outlayer.prototype.layout = function() {
	  this._resetLayout();
	  this._manageStamps();

	  // don't animate first layout
	  var isInstant = this.options.isLayoutInstant !== undefined ?
	    this.options.isLayoutInstant : !this._isLayoutInited;
	  this.layoutItems( this.items, isInstant );

	  // flag for initalized
	  this._isLayoutInited = true;
	};

	// _init is alias for layout
	Outlayer.prototype._init = Outlayer.prototype.layout;

	/**
	 * logic before any new layout
	 */
	Outlayer.prototype._resetLayout = function() {
	  this.getSize();
	};


	Outlayer.prototype.getSize = function() {
	  this.size = getSize( this.element );
	};

	/**
	 * get measurement from option, for columnWidth, rowHeight, gutter
	 * if option is String -> get element from selector string, & get size of element
	 * if option is Element -> get size of element
	 * else use option as a number
	 *
	 * @param {String} measurement
	 * @param {String} size - width or height
	 * @private
	 */
	Outlayer.prototype._getMeasurement = function( measurement, size ) {
	  var option = this.options[ measurement ];
	  var elem;
	  if ( !option ) {
	    // default to 0
	    this[ measurement ] = 0;
	  } else {
	    // use option as an element
	    if ( typeof option === 'string' ) {
	      elem = this.element.querySelector( option );
	    } else if ( isElement( option ) ) {
	      elem = option;
	    }
	    // use size of element, if element
	    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
	  }
	};

	/**
	 * layout a collection of item elements
	 * @api public
	 */
	Outlayer.prototype.layoutItems = function( items, isInstant ) {
	  items = this._getItemsForLayout( items );

	  this._layoutItems( items, isInstant );

	  this._postLayout();
	};

	/**
	 * get the items to be laid out
	 * you may want to skip over some items
	 * @param {Array} items
	 * @returns {Array} items
	 */
	Outlayer.prototype._getItemsForLayout = function( items ) {
	  var layoutItems = [];
	  for ( var i=0, len = items.length; i < len; i++ ) {
	    var item = items[i];
	    if ( !item.isIgnored ) {
	      layoutItems.push( item );
	    }
	  }
	  return layoutItems;
	};

	/**
	 * layout items
	 * @param {Array} items
	 * @param {Boolean} isInstant
	 */
	Outlayer.prototype._layoutItems = function( items, isInstant ) {
	  var _this = this;
	  function onItemsLayout() {
	    _this.emitEvent( 'layoutComplete', [ _this, items ] );
	  }

	  if ( !items || !items.length ) {
	    // no items, emit event with empty array
	    onItemsLayout();
	    return;
	  }

	  // emit layoutComplete when done
	  this._itemsOn( items, 'layout', onItemsLayout );

	  var queue = [];

	  for ( var i=0, len = items.length; i < len; i++ ) {
	    var item = items[i];
	    // get x/y object from method
	    var position = this._getItemLayoutPosition( item );
	    // enqueue
	    position.item = item;
	    position.isInstant = isInstant || item.isLayoutInstant;
	    queue.push( position );
	  }

	  this._processLayoutQueue( queue );
	};

	/**
	 * get item layout position
	 * @param {Outlayer.Item} item
	 * @returns {Object} x and y position
	 */
	Outlayer.prototype._getItemLayoutPosition = function( /* item */ ) {
	  return {
	    x: 0,
	    y: 0
	  };
	};

	/**
	 * iterate over array and position each item
	 * Reason being - separating this logic prevents 'layout invalidation'
	 * thx @paul_irish
	 * @param {Array} queue
	 */
	Outlayer.prototype._processLayoutQueue = function( queue ) {
	  for ( var i=0, len = queue.length; i < len; i++ ) {
	    var obj = queue[i];
	    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant );
	  }
	};

	/**
	 * Sets position of item in DOM
	 * @param {Outlayer.Item} item
	 * @param {Number} x - horizontal position
	 * @param {Number} y - vertical position
	 * @param {Boolean} isInstant - disables transitions
	 */
	Outlayer.prototype._positionItem = function( item, x, y, isInstant ) {
	  if ( isInstant ) {
	    // if not transition, just set CSS
	    item.goTo( x, y );
	  } else {
	    item.moveTo( x, y );
	  }
	};

	/**
	 * Any logic you want to do after each layout,
	 * i.e. size the container
	 */
	Outlayer.prototype._postLayout = function() {
	  this.resizeContainer();
	};

	Outlayer.prototype.resizeContainer = function() {
	  if ( !this.options.isResizingContainer ) {
	    return;
	  }
	  var size = this._getContainerSize();
	  if ( size ) {
	    this._setContainerMeasure( size.width, true );
	    this._setContainerMeasure( size.height, false );
	  }
	};

	/**
	 * Sets width or height of container if returned
	 * @returns {Object} size
	 *   @param {Number} width
	 *   @param {Number} height
	 */
	Outlayer.prototype._getContainerSize = noop;

	/**
	 * @param {Number} measure - size of width or height
	 * @param {Boolean} isWidth
	 */
	Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
	  if ( measure === undefined ) {
	    return;
	  }

	  var elemSize = this.size;
	  // add padding and border width if border box
	  if ( elemSize.isBorderBox ) {
	    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
	      elemSize.borderLeftWidth + elemSize.borderRightWidth :
	      elemSize.paddingBottom + elemSize.paddingTop +
	      elemSize.borderTopWidth + elemSize.borderBottomWidth;
	  }

	  measure = Math.max( measure, 0 );
	  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
	};

	/**
	 * trigger a callback for a collection of items events
	 * @param {Array} items - Outlayer.Items
	 * @param {String} eventName
	 * @param {Function} callback
	 */
	Outlayer.prototype._itemsOn = function( items, eventName, callback ) {
	  var doneCount = 0;
	  var count = items.length;
	  // event callback
	  var _this = this;
	  function tick() {
	    doneCount++;
	    if ( doneCount === count ) {
	      callback.call( _this );
	    }
	    return true; // bind once
	  }
	  // bind callback
	  for ( var i=0, len = items.length; i < len; i++ ) {
	    var item = items[i];
	    item.on( eventName, tick );
	  }
	};

	// -------------------------- ignore & stamps -------------------------- //


	/**
	 * keep item in collection, but do not lay it out
	 * ignored items do not get skipped in layout
	 * @param {Element} elem
	 */
	Outlayer.prototype.ignore = function( elem ) {
	  var item = this.getItem( elem );
	  if ( item ) {
	    item.isIgnored = true;
	  }
	};

	/**
	 * return item to layout collection
	 * @param {Element} elem
	 */
	Outlayer.prototype.unignore = function( elem ) {
	  var item = this.getItem( elem );
	  if ( item ) {
	    delete item.isIgnored;
	  }
	};

	/**
	 * adds elements to stamps
	 * @param {NodeList, Array, Element, or String} elems
	 */
	Outlayer.prototype.stamp = function( elems ) {
	  elems = this._find( elems );
	  if ( !elems ) {
	    return;
	  }

	  this.stamps = this.stamps.concat( elems );
	  // ignore
	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    this.ignore( elem );
	  }
	};

	/**
	 * removes elements to stamps
	 * @param {NodeList, Array, or Element} elems
	 */
	Outlayer.prototype.unstamp = function( elems ) {
	  elems = this._find( elems );
	  if ( !elems ){
	    return;
	  }

	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    // filter out removed stamp elements
	    removeFrom( elem, this.stamps );
	    this.unignore( elem );
	  }

	};

	/**
	 * finds child elements
	 * @param {NodeList, Array, Element, or String} elems
	 * @returns {Array} elems
	 */
	Outlayer.prototype._find = function( elems ) {
	  if ( !elems ) {
	    return;
	  }
	  // if string, use argument as selector string
	  if ( typeof elems === 'string' ) {
	    elems = this.element.querySelectorAll( elems );
	  }
	  elems = makeArray( elems );
	  return elems;
	};

	Outlayer.prototype._manageStamps = function() {
	  if ( !this.stamps || !this.stamps.length ) {
	    return;
	  }

	  this._getBoundingRect();

	  for ( var i=0, len = this.stamps.length; i < len; i++ ) {
	    var stamp = this.stamps[i];
	    this._manageStamp( stamp );
	  }
	};

	// update boundingLeft / Top
	Outlayer.prototype._getBoundingRect = function() {
	  // get bounding rect for container element
	  var boundingRect = this.element.getBoundingClientRect();
	  var size = this.size;
	  this._boundingRect = {
	    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
	    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
	    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
	    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
	  };
	};

	/**
	 * @param {Element} stamp
	**/
	Outlayer.prototype._manageStamp = noop;

	/**
	 * get x/y position of element relative to container element
	 * @param {Element} elem
	 * @returns {Object} offset - has left, top, right, bottom
	 */
	Outlayer.prototype._getElementOffset = function( elem ) {
	  var boundingRect = elem.getBoundingClientRect();
	  var thisRect = this._boundingRect;
	  var size = getSize( elem );
	  var offset = {
	    left: boundingRect.left - thisRect.left - size.marginLeft,
	    top: boundingRect.top - thisRect.top - size.marginTop,
	    right: thisRect.right - boundingRect.right - size.marginRight,
	    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
	  };
	  return offset;
	};

	// -------------------------- resize -------------------------- //

	// enable event handlers for listeners
	// i.e. resize -> onresize
	Outlayer.prototype.handleEvent = function( event ) {
	  var method = 'on' + event.type;
	  if ( this[ method ] ) {
	    this[ method ]( event );
	  }
	};

	/**
	 * Bind layout to window resizing
	 */
	Outlayer.prototype.bindResize = function() {
	  // bind just one listener
	  if ( this.isResizeBound ) {
	    return;
	  }
	  eventie.bind( window, 'resize', this );
	  this.isResizeBound = true;
	};

	/**
	 * Unbind layout to window resizing
	 */
	Outlayer.prototype.unbindResize = function() {
	  if ( this.isResizeBound ) {
	    eventie.unbind( window, 'resize', this );
	  }
	  this.isResizeBound = false;
	};

	// original debounce by John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

	// this fires every resize
	Outlayer.prototype.onresize = function() {
	  if ( this.resizeTimeout ) {
	    clearTimeout( this.resizeTimeout );
	  }

	  var _this = this;
	  function delayed() {
	    _this.resize();
	    delete _this.resizeTimeout;
	  }

	  this.resizeTimeout = setTimeout( delayed, 100 );
	};

	// debounced, layout on resize
	Outlayer.prototype.resize = function() {
	  // don't trigger if size did not change
	  // or if resize was unbound. See #9
	  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
	    return;
	  }

	  this.layout();
	};

	/**
	 * check if layout is needed post layout
	 * @returns Boolean
	 */
	Outlayer.prototype.needsResizeLayout = function() {
	  var size = getSize( this.element );
	  // check that this.size and size are there
	  // IE8 triggers resize on body size change, so they might not be
	  var hasSizes = this.size && size;
	  return hasSizes && size.innerWidth !== this.size.innerWidth;
	};

	// -------------------------- methods -------------------------- //

	/**
	 * add items to Outlayer instance
	 * @param {Array or NodeList or Element} elems
	 * @returns {Array} items - Outlayer.Items
	**/
	Outlayer.prototype.addItems = function( elems ) {
	  var items = this._itemize( elems );
	  // add items to collection
	  if ( items.length ) {
	    this.items = this.items.concat( items );
	  }
	  return items;
	};

	/**
	 * Layout newly-appended item elements
	 * @param {Array or NodeList or Element} elems
	 */
	Outlayer.prototype.appended = function( elems ) {
	  var items = this.addItems( elems );
	  if ( !items.length ) {
	    return;
	  }
	  // layout and reveal just the new items
	  this.layoutItems( items, true );
	  this.reveal( items );
	};

	/**
	 * Layout prepended elements
	 * @param {Array or NodeList or Element} elems
	 */
	Outlayer.prototype.prepended = function( elems ) {
	  var items = this._itemize( elems );
	  if ( !items.length ) {
	    return;
	  }
	  // add items to beginning of collection
	  var previousItems = this.items.slice(0);
	  this.items = items.concat( previousItems );
	  // start new layout
	  this._resetLayout();
	  this._manageStamps();
	  // layout new stuff without transition
	  this.layoutItems( items, true );
	  this.reveal( items );
	  // layout previous items
	  this.layoutItems( previousItems );
	};

	/**
	 * reveal a collection of items
	 * @param {Array of Outlayer.Items} items
	 */
	Outlayer.prototype.reveal = function( items ) {
	  var len = items && items.length;
	  if ( !len ) {
	    return;
	  }
	  for ( var i=0; i < len; i++ ) {
	    var item = items[i];
	    item.reveal();
	  }
	};

	/**
	 * hide a collection of items
	 * @param {Array of Outlayer.Items} items
	 */
	Outlayer.prototype.hide = function( items ) {
	  var len = items && items.length;
	  if ( !len ) {
	    return;
	  }
	  for ( var i=0; i < len; i++ ) {
	    var item = items[i];
	    item.hide();
	  }
	};

	/**
	 * get Outlayer.Item, given an Element
	 * @param {Element} elem
	 * @param {Function} callback
	 * @returns {Outlayer.Item} item
	 */
	Outlayer.prototype.getItem = function( elem ) {
	  // loop through items to get the one that matches
	  for ( var i=0, len = this.items.length; i < len; i++ ) {
	    var item = this.items[i];
	    if ( item.element === elem ) {
	      // return item
	      return item;
	    }
	  }
	};

	/**
	 * get collection of Outlayer.Items, given Elements
	 * @param {Array} elems
	 * @returns {Array} items - Outlayer.Items
	 */
	Outlayer.prototype.getItems = function( elems ) {
	  if ( !elems || !elems.length ) {
	    return;
	  }
	  var items = [];
	  for ( var i=0, len = elems.length; i < len; i++ ) {
	    var elem = elems[i];
	    var item = this.getItem( elem );
	    if ( item ) {
	      items.push( item );
	    }
	  }

	  return items;
	};

	/**
	 * remove element(s) from instance and DOM
	 * @param {Array or NodeList or Element} elems
	 */
	Outlayer.prototype.remove = function( elems ) {
	  elems = makeArray( elems );

	  var removeItems = this.getItems( elems );
	  // bail if no items to remove
	  if ( !removeItems || !removeItems.length ) {
	    return;
	  }

	  this._itemsOn( removeItems, 'remove', function() {
	    this.emitEvent( 'removeComplete', [ this, removeItems ] );
	  });

	  for ( var i=0, len = removeItems.length; i < len; i++ ) {
	    var item = removeItems[i];
	    item.remove();
	    // remove item from collection
	    removeFrom( item, this.items );
	  }
	};

	// ----- destroy ----- //

	// remove and disable Outlayer instance
	Outlayer.prototype.destroy = function() {
	  // clean up dynamic styles
	  var style = this.element.style;
	  style.height = '';
	  style.position = '';
	  style.width = '';
	  // destroy items
	  for ( var i=0, len = this.items.length; i < len; i++ ) {
	    var item = this.items[i];
	    item.destroy();
	  }

	  this.unbindResize();

	  var id = this.element.outlayerGUID;
	  delete instances[ id ]; // remove reference to instance by id
	  delete this.element.outlayerGUID;
	  // remove data for jQuery
	  if ( jQuery ) {
	    jQuery.removeData( this.element, this.constructor.namespace );
	  }

	};

	// -------------------------- data -------------------------- //

	/**
	 * get Outlayer instance from element
	 * @param {Element} elem
	 * @returns {Outlayer}
	 */
	Outlayer.data = function( elem ) {
	  var id = elem && elem.outlayerGUID;
	  return id && instances[ id ];
	};


	// -------------------------- create Outlayer class -------------------------- //

	/**
	 * create a layout class
	 * @param {String} namespace
	 */
	Outlayer.create = function( namespace, options ) {
	  // sub-class Outlayer
	  function Layout() {
	    Outlayer.apply( this, arguments );
	  }
	  // inherit Outlayer prototype, use Object.create if there
	  if ( Object.create ) {
	    Layout.prototype = Object.create( Outlayer.prototype );
	  } else {
	    extend( Layout.prototype, Outlayer.prototype );
	  }
	  // set contructor, used for namespace and Item
	  Layout.prototype.constructor = Layout;

	  Layout.defaults = extend( {}, Outlayer.defaults );
	  // apply new options
	  extend( Layout.defaults, options );
	  // keep prototype.settings for backwards compatibility (Packery v1.2.0)
	  Layout.prototype.settings = {};

	  Layout.namespace = namespace;

	  Layout.data = Outlayer.data;

	  // sub-class Item
	  Layout.Item = function LayoutItem() {
	    Item.apply( this, arguments );
	  };

	  Layout.Item.prototype = new Item();

	  // -------------------------- declarative -------------------------- //

	  /**
	   * allow user to initialize Outlayer via .js-namespace class
	   * options are parsed from data-namespace-option attribute
	   */
	  docReady( function() {
	    var dashedNamespace = toDashed( namespace );
	    var elems = document.querySelectorAll( '.js-' + dashedNamespace );
	    var dataAttr = 'data-' + dashedNamespace + '-options';

	    for ( var i=0, len = elems.length; i < len; i++ ) {
	      var elem = elems[i];
	      var attr = elem.getAttribute( dataAttr );
	      var options;
	      try {
	        options = attr && JSON.parse( attr );
	      } catch ( error ) {
	        // log error, do not initialize
	        if ( console ) {
	          console.error( 'Error parsing ' + dataAttr + ' on ' +
	            elem.nodeName.toLowerCase() + ( elem.id ? '#' + elem.id : '' ) + ': ' +
	            error );
	        }
	        continue;
	      }
	      // initialize
	      var instance = new Layout( elem, options );
	      // make available via $().data('layoutname')
	      if ( jQuery ) {
	        jQuery.data( elem, namespace, instance );
	      }
	    }
	  });

	  // -------------------------- jQuery bridge -------------------------- //

	  // make into jQuery plugin
	  if ( jQuery && jQuery.bridget ) {
	    jQuery.bridget( namespace, Layout );
	  }

	  return Layout;
	};

	// ----- fin ----- //

	// back in global
	Outlayer.Item = Item;

	return Outlayer;

	}

	// -------------------------- transport -------------------------- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'outlayer/outlayer',[
	      'eventie/eventie',
	      'doc-ready/doc-ready',
	      'eventEmitter/EventEmitter',
	      'get-size/get-size',
	      'matches-selector/matches-selector',
	      './item'
	    ],
	    outlayerDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = outlayerDefinition(
	    require('eventie'),
	    require('doc-ready'),
	    require('wolfy87-eventemitter'),
	    require('get-size'),
	    require('desandro-matches-selector'),
	    require('./item')
	  );
	} else {
	  // browser global
	  window.Outlayer = outlayerDefinition(
	    window.eventie,
	    window.docReady,
	    window.EventEmitter,
	    window.getSize,
	    window.matchesSelector,
	    window.Outlayer.Item
	  );
	}

	})( window );

	/**
	 * Isotope Item
	**/

	( function( window ) {



	// -------------------------- Item -------------------------- //

	function itemDefinition( Outlayer ) {

	// sub-class Outlayer Item
	function Item() {
	  Outlayer.Item.apply( this, arguments );
	}

	Item.prototype = new Outlayer.Item();

	Item.prototype._create = function() {
	  // assign id, used for original-order sorting
	  this.id = this.layout.itemGUID++;
	  Outlayer.Item.prototype._create.call( this );
	  this.sortData = {};
	};

	Item.prototype.updateSortData = function() {
	  if ( this.isIgnored ) {
	    return;
	  }
	  // default sorters
	  this.sortData.id = this.id;
	  // for backward compatibility
	  this.sortData['original-order'] = this.id;
	  this.sortData.random = Math.random();
	  // go thru getSortData obj and apply the sorters
	  var getSortData = this.layout.options.getSortData;
	  var sorters = this.layout._sorters;
	  for ( var key in getSortData ) {
	    var sorter = sorters[ key ];
	    this.sortData[ key ] = sorter( this.element, this );
	  }
	};

	var _destroy = Item.prototype.destroy;
	Item.prototype.destroy = function() {
	  // call super
	  _destroy.apply( this, arguments );
	  // reset display, #741
	  this.css({
	    display: ''
	  });
	};

	return Item;

	}

	// -------------------------- transport -------------------------- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'isotope/js/item',[
	      'outlayer/outlayer'
	    ],
	    itemDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = itemDefinition(
	    require('outlayer')
	  );
	} else {
	  // browser global
	  window.Isotope = window.Isotope || {};
	  window.Isotope.Item = itemDefinition(
	    window.Outlayer
	  );
	}

	})( window );

	( function( window ) {



	// --------------------------  -------------------------- //

	function layoutModeDefinition( getSize, Outlayer ) {

	  // layout mode class
	  function LayoutMode( isotope ) {
	    this.isotope = isotope;
	    // link properties
	    if ( isotope ) {
	      this.options = isotope.options[ this.namespace ];
	      this.element = isotope.element;
	      this.items = isotope.filteredItems;
	      this.size = isotope.size;
	    }
	  }

	  /**
	   * some methods should just defer to default Outlayer method
	   * and reference the Isotope instance as `this`
	  **/
	  ( function() {
	    var facadeMethods = [
	      '_resetLayout',
	      '_getItemLayoutPosition',
	      '_manageStamp',
	      '_getContainerSize',
	      '_getElementOffset',
	      'needsResizeLayout'
	    ];

	    for ( var i=0, len = facadeMethods.length; i < len; i++ ) {
	      var methodName = facadeMethods[i];
	      LayoutMode.prototype[ methodName ] = getOutlayerMethod( methodName );
	    }

	    function getOutlayerMethod( methodName ) {
	      return function() {
	        return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
	      };
	    }
	  })();

	  // -----  ----- //

	  // for horizontal layout modes, check vertical size
	  LayoutMode.prototype.needsVerticalResizeLayout = function() {
	    // don't trigger if size did not change
	    var size = getSize( this.isotope.element );
	    // check that this.size and size are there
	    // IE8 triggers resize on body size change, so they might not be
	    var hasSizes = this.isotope.size && size;
	    return hasSizes && size.innerHeight !== this.isotope.size.innerHeight;
	  };

	  // ----- measurements ----- //

	  LayoutMode.prototype._getMeasurement = function() {
	    this.isotope._getMeasurement.apply( this, arguments );
	  };

	  LayoutMode.prototype.getColumnWidth = function() {
	    this.getSegmentSize( 'column', 'Width' );
	  };

	  LayoutMode.prototype.getRowHeight = function() {
	    this.getSegmentSize( 'row', 'Height' );
	  };

	  /**
	   * get columnWidth or rowHeight
	   * segment: 'column' or 'row'
	   * size 'Width' or 'Height'
	  **/
	  LayoutMode.prototype.getSegmentSize = function( segment, size ) {
	    var segmentName = segment + size;
	    var outerSize = 'outer' + size;
	    // columnWidth / outerWidth // rowHeight / outerHeight
	    this._getMeasurement( segmentName, outerSize );
	    // got rowHeight or columnWidth, we can chill
	    if ( this[ segmentName ] ) {
	      return;
	    }
	    // fall back to item of first element
	    var firstItemSize = this.getFirstItemSize();
	    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
	      // or size of container
	      this.isotope.size[ 'inner' + size ];
	  };

	  LayoutMode.prototype.getFirstItemSize = function() {
	    var firstItem = this.isotope.filteredItems[0];
	    return firstItem && firstItem.element && getSize( firstItem.element );
	  };

	  // ----- methods that should reference isotope ----- //

	  LayoutMode.prototype.layout = function() {
	    this.isotope.layout.apply( this.isotope, arguments );
	  };

	  LayoutMode.prototype.getSize = function() {
	    this.isotope.getSize();
	    this.size = this.isotope.size;
	  };

	  // -------------------------- create -------------------------- //

	  LayoutMode.modes = {};

	  LayoutMode.create = function( namespace, options ) {

	    function Mode() {
	      LayoutMode.apply( this, arguments );
	    }

	    Mode.prototype = new LayoutMode();

	    // default options
	    if ( options ) {
	      Mode.options = options;
	    }

	    Mode.prototype.namespace = namespace;
	    // register in Isotope
	    LayoutMode.modes[ namespace ] = Mode;

	    return Mode;
	  };


	  return LayoutMode;

	}

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'isotope/js/layout-mode',[
	      'get-size/get-size',
	      'outlayer/outlayer'
	    ],
	    layoutModeDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = layoutModeDefinition(
	    require('get-size'),
	    require('outlayer')
	  );
	} else {
	  // browser global
	  window.Isotope = window.Isotope || {};
	  window.Isotope.LayoutMode = layoutModeDefinition(
	    window.getSize,
	    window.Outlayer
	  );
	}


	})( window );

	/*!
	 * Masonry v3.2.1
	 * Cascading grid layout library
	 * http://masonry.desandro.com
	 * MIT License
	 * by David DeSandro
	 */

	( function( window ) {



	// -------------------------- helpers -------------------------- //

	var indexOf = Array.prototype.indexOf ?
	  function( items, value ) {
	    return items.indexOf( value );
	  } :
	  function ( items, value ) {
	    for ( var i=0, len = items.length; i < len; i++ ) {
	      var item = items[i];
	      if ( item === value ) {
	        return i;
	      }
	    }
	    return -1;
	  };

	// -------------------------- masonryDefinition -------------------------- //

	// used for AMD definition and requires
	function masonryDefinition( Outlayer, getSize ) {
	  // create an Outlayer layout class
	  var Masonry = Outlayer.create('masonry');

	  Masonry.prototype._resetLayout = function() {
	    this.getSize();
	    this._getMeasurement( 'columnWidth', 'outerWidth' );
	    this._getMeasurement( 'gutter', 'outerWidth' );
	    this.measureColumns();

	    // reset column Y
	    var i = this.cols;
	    this.colYs = [];
	    while (i--) {
	      this.colYs.push( 0 );
	    }

	    this.maxY = 0;
	  };

	  Masonry.prototype.measureColumns = function() {
	    this.getContainerWidth();
	    // if columnWidth is 0, default to outerWidth of first item
	    if ( !this.columnWidth ) {
	      var firstItem = this.items[0];
	      var firstItemElem = firstItem && firstItem.element;
	      // columnWidth fall back to item of first element
	      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
	        // if first elem has no width, default to size of container
	        this.containerWidth;
	    }

	    this.columnWidth += this.gutter;

	    this.cols = Math.floor( ( this.containerWidth + this.gutter ) / this.columnWidth );
	    this.cols = Math.max( this.cols, 1 );
	  };

	  Masonry.prototype.getContainerWidth = function() {
	    // container is parent if fit width
	    var container = this.options.isFitWidth ? this.element.parentNode : this.element;
	    // check that this.size and size are there
	    // IE8 triggers resize on body size change, so they might not be
	    var size = getSize( container );
	    this.containerWidth = size && size.innerWidth;
	  };

	  Masonry.prototype._getItemLayoutPosition = function( item ) {
	    item.getSize();
	    // how many columns does this brick span
	    var remainder = item.size.outerWidth % this.columnWidth;
	    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
	    // round if off by 1 pixel, otherwise use ceil
	    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
	    colSpan = Math.min( colSpan, this.cols );

	    var colGroup = this._getColGroup( colSpan );
	    // get the minimum Y value from the columns
	    var minimumY = Math.min.apply( Math, colGroup );
	    var shortColIndex = indexOf( colGroup, minimumY );

	    // position the brick
	    var position = {
	      x: this.columnWidth * shortColIndex,
	      y: minimumY
	    };

	    // apply setHeight to necessary columns
	    var setHeight = minimumY + item.size.outerHeight;
	    var setSpan = this.cols + 1 - colGroup.length;
	    for ( var i = 0; i < setSpan; i++ ) {
	      this.colYs[ shortColIndex + i ] = setHeight;
	    }

	    return position;
	  };

	  /**
	   * @param {Number} colSpan - number of columns the element spans
	   * @returns {Array} colGroup
	   */
	  Masonry.prototype._getColGroup = function( colSpan ) {
	    if ( colSpan < 2 ) {
	      // if brick spans only one column, use all the column Ys
	      return this.colYs;
	    }

	    var colGroup = [];
	    // how many different places could this brick fit horizontally
	    var groupCount = this.cols + 1 - colSpan;
	    // for each group potential horizontal position
	    for ( var i = 0; i < groupCount; i++ ) {
	      // make an array of colY values for that one group
	      var groupColYs = this.colYs.slice( i, i + colSpan );
	      // and get the max value of the array
	      colGroup[i] = Math.max.apply( Math, groupColYs );
	    }
	    return colGroup;
	  };

	  Masonry.prototype._manageStamp = function( stamp ) {
	    var stampSize = getSize( stamp );
	    var offset = this._getElementOffset( stamp );
	    // get the columns that this stamp affects
	    var firstX = this.options.isOriginLeft ? offset.left : offset.right;
	    var lastX = firstX + stampSize.outerWidth;
	    var firstCol = Math.floor( firstX / this.columnWidth );
	    firstCol = Math.max( 0, firstCol );
	    var lastCol = Math.floor( lastX / this.columnWidth );
	    // lastCol should not go over if multiple of columnWidth #425
	    lastCol -= lastX % this.columnWidth ? 0 : 1;
	    lastCol = Math.min( this.cols - 1, lastCol );
	    // set colYs to bottom of the stamp
	    var stampMaxY = ( this.options.isOriginTop ? offset.top : offset.bottom ) +
	      stampSize.outerHeight;
	    for ( var i = firstCol; i <= lastCol; i++ ) {
	      this.colYs[i] = Math.max( stampMaxY, this.colYs[i] );
	    }
	  };

	  Masonry.prototype._getContainerSize = function() {
	    this.maxY = Math.max.apply( Math, this.colYs );
	    var size = {
	      height: this.maxY
	    };

	    if ( this.options.isFitWidth ) {
	      size.width = this._getContainerFitWidth();
	    }

	    return size;
	  };

	  Masonry.prototype._getContainerFitWidth = function() {
	    var unusedCols = 0;
	    // count unused columns
	    var i = this.cols;
	    while ( --i ) {
	      if ( this.colYs[i] !== 0 ) {
	        break;
	      }
	      unusedCols++;
	    }
	    // fit container to columns that have been used
	    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
	  };

	  Masonry.prototype.needsResizeLayout = function() {
	    var previousWidth = this.containerWidth;
	    this.getContainerWidth();
	    return previousWidth !== this.containerWidth;
	  };

	  return Masonry;
	}

	// -------------------------- transport -------------------------- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'masonry/masonry',[
	      'outlayer/outlayer',
	      'get-size/get-size'
	    ],
	    masonryDefinition );
	} else if (typeof exports === 'object') {
	  module.exports = masonryDefinition(
	    require('outlayer'),
	    require('get-size')
	  );
	} else {
	  // browser global
	  window.Masonry = masonryDefinition(
	    window.Outlayer,
	    window.getSize
	  );
	}

	})( window );

	/*!
	 * Masonry layout mode
	 * sub-classes Masonry
	 * http://masonry.desandro.com
	 */

	( function( window ) {



	// -------------------------- helpers -------------------------- //

	// extend objects
	function extend( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	}

	// -------------------------- masonryDefinition -------------------------- //

	// used for AMD definition and requires
	function masonryDefinition( LayoutMode, Masonry ) {
	  // create an Outlayer layout class
	  var MasonryMode = LayoutMode.create('masonry');

	  // save on to these methods
	  var _getElementOffset = MasonryMode.prototype._getElementOffset;
	  var layout = MasonryMode.prototype.layout;
	  var _getMeasurement = MasonryMode.prototype._getMeasurement;

	  // sub-class Masonry
	  extend( MasonryMode.prototype, Masonry.prototype );

	  // set back, as it was overwritten by Masonry
	  MasonryMode.prototype._getElementOffset = _getElementOffset;
	  MasonryMode.prototype.layout = layout;
	  MasonryMode.prototype._getMeasurement = _getMeasurement;

	  var measureColumns = MasonryMode.prototype.measureColumns;
	  MasonryMode.prototype.measureColumns = function() {
	    // set items, used if measuring first item
	    this.items = this.isotope.filteredItems;
	    measureColumns.call( this );
	  };

	  // HACK copy over isOriginLeft/Top options
	  var _manageStamp = MasonryMode.prototype._manageStamp;
	  MasonryMode.prototype._manageStamp = function() {
	    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
	    this.options.isOriginTop = this.isotope.options.isOriginTop;
	    _manageStamp.apply( this, arguments );
	  };

	  return MasonryMode;
	}

	// -------------------------- transport -------------------------- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'isotope/js/layout-modes/masonry',[
	      '../layout-mode',
	      'masonry/masonry'
	    ],
	    masonryDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = masonryDefinition(
	    require('../layout-mode'),
	    require('masonry-layout')
	  );
	} else {
	  // browser global
	  masonryDefinition(
	    window.Isotope.LayoutMode,
	    window.Masonry
	  );
	}

	})( window );

	( function( window ) {



	function fitRowsDefinition( LayoutMode ) {

	var FitRows = LayoutMode.create('fitRows');

	FitRows.prototype._resetLayout = function() {
	  this.x = 0;
	  this.y = 0;
	  this.maxY = 0;
	  this._getMeasurement( 'gutter', 'outerWidth' );
	};

	FitRows.prototype._getItemLayoutPosition = function( item ) {
	  item.getSize();

	  var itemWidth = item.size.outerWidth + this.gutter;
	  // if this element cannot fit in the current row
	  var containerWidth = this.isotope.size.innerWidth + this.gutter;
	  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
	    this.x = 0;
	    this.y = this.maxY;
	  }

	  var position = {
	    x: this.x,
	    y: this.y
	  };

	  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
	  this.x += itemWidth;

	  return position;
	};

	FitRows.prototype._getContainerSize = function() {
	  return { height: this.maxY };
	};

	return FitRows;

	}

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'isotope/js/layout-modes/fit-rows',[
	      '../layout-mode'
	    ],
	    fitRowsDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = fitRowsDefinition(
	    require('../layout-mode')
	  );
	} else {
	  // browser global
	  fitRowsDefinition(
	    window.Isotope.LayoutMode
	  );
	}

	})( window );

	( function( window ) {



	function verticalDefinition( LayoutMode ) {

	var Vertical = LayoutMode.create( 'vertical', {
	  horizontalAlignment: 0
	});

	Vertical.prototype._resetLayout = function() {
	  this.y = 0;
	};

	Vertical.prototype._getItemLayoutPosition = function( item ) {
	  item.getSize();
	  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
	    this.options.horizontalAlignment;
	  var y = this.y;
	  this.y += item.size.outerHeight;
	  return { x: x, y: y };
	};

	Vertical.prototype._getContainerSize = function() {
	  return { height: this.y };
	};

	return Vertical;

	}

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( 'isotope/js/layout-modes/vertical',[
	      '../layout-mode'
	    ],
	    verticalDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = verticalDefinition(
	    require('../layout-mode')
	  );
	} else {
	  // browser global
	  verticalDefinition(
	    window.Isotope.LayoutMode
	  );
	}

	})( window );

	/*!
	 * Isotope v2.1.0
	 * Filter & sort magical layouts
	 * http://isotope.metafizzy.co
	 */

	( function( window ) {



	// -------------------------- vars -------------------------- //

	var jQuery = window.jQuery;

	// -------------------------- helpers -------------------------- //

	// extend objects
	function extend( a, b ) {
	  for ( var prop in b ) {
	    a[ prop ] = b[ prop ];
	  }
	  return a;
	}

	var trim = String.prototype.trim ?
	  function( str ) {
	    return str.trim();
	  } :
	  function( str ) {
	    return str.replace( /^\s+|\s+$/g, '' );
	  };

	var docElem = document.documentElement;

	var getText = docElem.textContent ?
	  function( elem ) {
	    return elem.textContent;
	  } :
	  function( elem ) {
	    return elem.innerText;
	  };

	var objToString = Object.prototype.toString;
	function isArray( obj ) {
	  return objToString.call( obj ) === '[object Array]';
	}

	// index of helper cause IE8
	var indexOf = Array.prototype.indexOf ? function( ary, obj ) {
	    return ary.indexOf( obj );
	  } : function( ary, obj ) {
	    for ( var i=0, len = ary.length; i < len; i++ ) {
	      if ( ary[i] === obj ) {
	        return i;
	      }
	    }
	    return -1;
	  };

	// turn element or nodeList into an array
	function makeArray( obj ) {
	  var ary = [];
	  if ( isArray( obj ) ) {
	    // use object if already an array
	    ary = obj;
	  } else if ( obj && typeof obj.length === 'number' ) {
	    // convert nodeList to array
	    for ( var i=0, len = obj.length; i < len; i++ ) {
	      ary.push( obj[i] );
	    }
	  } else {
	    // array of single index
	    ary.push( obj );
	  }
	  return ary;
	}

	function removeFrom( obj, ary ) {
	  var index = indexOf( ary, obj );
	  if ( index !== -1 ) {
	    ary.splice( index, 1 );
	  }
	}

	// -------------------------- isotopeDefinition -------------------------- //

	// used for AMD definition and requires
	function isotopeDefinition( Outlayer, getSize, matchesSelector, Item, LayoutMode ) {
	  // create an Outlayer layout class
	  var Isotope = Outlayer.create( 'isotope', {
	    layoutMode: "masonry",
	    isJQueryFiltering: true,
	    sortAscending: true
	  });

	  Isotope.Item = Item;
	  Isotope.LayoutMode = LayoutMode;

	  Isotope.prototype._create = function() {
	    this.itemGUID = 0;
	    // functions that sort items
	    this._sorters = {};
	    this._getSorters();
	    // call super
	    Outlayer.prototype._create.call( this );

	    // create layout modes
	    this.modes = {};
	    // start filteredItems with all items
	    this.filteredItems = this.items;
	    // keep of track of sortBys
	    this.sortHistory = [ 'original-order' ];
	    // create from registered layout modes
	    for ( var name in LayoutMode.modes ) {
	      this._initLayoutMode( name );
	    }
	  };

	  Isotope.prototype.reloadItems = function() {
	    // reset item ID counter
	    this.itemGUID = 0;
	    // call super
	    Outlayer.prototype.reloadItems.call( this );
	  };

	  Isotope.prototype._itemize = function() {
	    var items = Outlayer.prototype._itemize.apply( this, arguments );
	    // assign ID for original-order
	    for ( var i=0, len = items.length; i < len; i++ ) {
	      var item = items[i];
	      item.id = this.itemGUID++;
	    }
	    this._updateItemsSortData( items );
	    return items;
	  };


	  // -------------------------- layout -------------------------- //

	  Isotope.prototype._initLayoutMode = function( name ) {
	    var Mode = LayoutMode.modes[ name ];
	    // set mode options
	    // HACK extend initial options, back-fill in default options
	    var initialOpts = this.options[ name ] || {};
	    this.options[ name ] = Mode.options ?
	      extend( Mode.options, initialOpts ) : initialOpts;
	    // init layout mode instance
	    this.modes[ name ] = new Mode( this );
	  };


	  Isotope.prototype.layout = function() {
	    // if first time doing layout, do all magic
	    if ( !this._isLayoutInited && this.options.isInitLayout ) {
	      this.arrange();
	      return;
	    }
	    this._layout();
	  };

	  // private method to be used in layout() & magic()
	  Isotope.prototype._layout = function() {
	    // don't animate first layout
	    var isInstant = this._getIsInstant();
	    // layout flow
	    this._resetLayout();
	    this._manageStamps();
	    this.layoutItems( this.filteredItems, isInstant );

	    // flag for initalized
	    this._isLayoutInited = true;
	  };

	  // filter + sort + layout
	  Isotope.prototype.arrange = function( opts ) {
	    // set any options pass
	    this.option( opts );
	    this._getIsInstant();
	    // filter, sort, and layout
	    this.filteredItems = this._filter( this.items );
	    this._sort();
	    this._layout();
	  };
	  // alias to _init for main plugin method
	  Isotope.prototype._init = Isotope.prototype.arrange;

	  // HACK
	  // Don't animate/transition first layout
	  // Or don't animate/transition other layouts
	  Isotope.prototype._getIsInstant = function() {
	    var isInstant = this.options.isLayoutInstant !== undefined ?
	      this.options.isLayoutInstant : !this._isLayoutInited;
	    this._isInstant = isInstant;
	    return isInstant;
	  };

	  // -------------------------- filter -------------------------- //

	  Isotope.prototype._filter = function( items ) {
	    var filter = this.options.filter;
	    filter = filter || '*';
	    var matches = [];
	    var hiddenMatched = [];
	    var visibleUnmatched = [];

	    var test = this._getFilterTest( filter );

	    // test each item
	    for ( var i=0, len = items.length; i < len; i++ ) {
	      var item = items[i];
	      if ( item.isIgnored ) {
	        continue;
	      }
	      // add item to either matched or unmatched group
	      var isMatched = test( item );
	      // item.isFilterMatched = isMatched;
	      // add to matches if its a match
	      if ( isMatched ) {
	        matches.push( item );
	      }
	      // add to additional group if item needs to be hidden or revealed
	      if ( isMatched && item.isHidden ) {
	        hiddenMatched.push( item );
	      } else if ( !isMatched && !item.isHidden ) {
	        visibleUnmatched.push( item );
	      }
	    }

	    var _this = this;
	    function hideReveal() {
	      _this.reveal( hiddenMatched );
	      _this.hide( visibleUnmatched );
	    }

	    if ( this._isInstant ) {
	      this._noTransition( hideReveal );
	    } else {
	      hideReveal();
	    }

	    return matches;
	  };

	  // get a jQuery, function, or a matchesSelector test given the filter
	  Isotope.prototype._getFilterTest = function( filter ) {
	    if ( jQuery && this.options.isJQueryFiltering ) {
	      // use jQuery
	      return function( item ) {
	        return jQuery( item.element ).is( filter );
	      };
	    }
	    if ( typeof filter === 'function' ) {
	      // use filter as function
	      return function( item ) {
	        return filter( item.element );
	      };
	    }
	    // default, use filter as selector string
	    return function( item ) {
	      return matchesSelector( item.element, filter );
	    };
	  };

	  // -------------------------- sorting -------------------------- //

	  /**
	   * @params {Array} elems
	   * @public
	   */
	  Isotope.prototype.updateSortData = function( elems ) {
	    // get items
	    var items;
	    if ( elems ) {
	      elems = makeArray( elems );
	      items = this.getItems( elems );
	    } else {
	      // update all items if no elems provided
	      items = this.items;
	    }

	    this._getSorters();
	    this._updateItemsSortData( items );
	  };

	  Isotope.prototype._getSorters = function() {
	    var getSortData = this.options.getSortData;
	    for ( var key in getSortData ) {
	      var sorter = getSortData[ key ];
	      this._sorters[ key ] = mungeSorter( sorter );
	    }
	  };

	  /**
	   * @params {Array} items - of Isotope.Items
	   * @private
	   */
	  Isotope.prototype._updateItemsSortData = function( items ) {
	    // do not update if no items
	    var len = items && items.length;

	    for ( var i=0; len && i < len; i++ ) {
	      var item = items[i];
	      item.updateSortData();
	    }
	  };

	  // ----- munge sorter ----- //

	  // encapsulate this, as we just need mungeSorter
	  // other functions in here are just for munging
	  var mungeSorter = ( function() {
	    // add a magic layer to sorters for convienent shorthands
	    // `.foo-bar` will use the text of .foo-bar querySelector
	    // `[foo-bar]` will use attribute
	    // you can also add parser
	    // `.foo-bar parseInt` will parse that as a number
	    function mungeSorter( sorter ) {
	      // if not a string, return function or whatever it is
	      if ( typeof sorter !== 'string' ) {
	        return sorter;
	      }
	      // parse the sorter string
	      var args = trim( sorter ).split(' ');
	      var query = args[0];
	      // check if query looks like [an-attribute]
	      var attrMatch = query.match( /^\[(.+)\]$/ );
	      var attr = attrMatch && attrMatch[1];
	      var getValue = getValueGetter( attr, query );
	      // use second argument as a parser
	      var parser = Isotope.sortDataParsers[ args[1] ];
	      // parse the value, if there was a parser
	      sorter = parser ? function( elem ) {
	        return elem && parser( getValue( elem ) );
	      } :
	      // otherwise just return value
	      function( elem ) {
	        return elem && getValue( elem );
	      };

	      return sorter;
	    }

	    // get an attribute getter, or get text of the querySelector
	    function getValueGetter( attr, query ) {
	      var getValue;
	      // if query looks like [foo-bar], get attribute
	      if ( attr ) {
	        getValue = function( elem ) {
	          return elem.getAttribute( attr );
	        };
	      } else {
	        // otherwise, assume its a querySelector, and get its text
	        getValue = function( elem ) {
	          var child = elem.querySelector( query );
	          return child && getText( child );
	        };
	      }
	      return getValue;
	    }

	    return mungeSorter;
	  })();

	  // parsers used in getSortData shortcut strings
	  Isotope.sortDataParsers = {
	    'parseInt': function( val ) {
	      return parseInt( val, 10 );
	    },
	    'parseFloat': function( val ) {
	      return parseFloat( val );
	    }
	  };

	  // ----- sort method ----- //

	  // sort filteredItem order
	  Isotope.prototype._sort = function() {
	    var sortByOpt = this.options.sortBy;
	    if ( !sortByOpt ) {
	      return;
	    }
	    // concat all sortBy and sortHistory
	    var sortBys = [].concat.apply( sortByOpt, this.sortHistory );
	    // sort magic
	    var itemSorter = getItemSorter( sortBys, this.options.sortAscending );
	    this.filteredItems.sort( itemSorter );
	    // keep track of sortBy History
	    if ( sortByOpt !== this.sortHistory[0] ) {
	      // add to front, oldest goes in last
	      this.sortHistory.unshift( sortByOpt );
	    }
	  };

	  // returns a function used for sorting
	  function getItemSorter( sortBys, sortAsc ) {
	    return function sorter( itemA, itemB ) {
	      // cycle through all sortKeys
	      for ( var i = 0, len = sortBys.length; i < len; i++ ) {
	        var sortBy = sortBys[i];
	        var a = itemA.sortData[ sortBy ];
	        var b = itemB.sortData[ sortBy ];
	        if ( a > b || a < b ) {
	          // if sortAsc is an object, use the value given the sortBy key
	          var isAscending = sortAsc[ sortBy ] !== undefined ? sortAsc[ sortBy ] : sortAsc;
	          var direction = isAscending ? 1 : -1;
	          return ( a > b ? 1 : -1 ) * direction;
	        }
	      }
	      return 0;
	    };
	  }

	  // -------------------------- methods -------------------------- //

	  // get layout mode
	  Isotope.prototype._mode = function() {
	    var layoutMode = this.options.layoutMode;
	    var mode = this.modes[ layoutMode ];
	    if ( !mode ) {
	      // TODO console.error
	      throw new Error( 'No layout mode: ' + layoutMode );
	    }
	    // HACK sync mode's options
	    // any options set after init for layout mode need to be synced
	    mode.options = this.options[ layoutMode ];
	    return mode;
	  };

	  Isotope.prototype._resetLayout = function() {
	    // trigger original reset layout
	    Outlayer.prototype._resetLayout.call( this );
	    this._mode()._resetLayout();
	  };

	  Isotope.prototype._getItemLayoutPosition = function( item  ) {
	    return this._mode()._getItemLayoutPosition( item );
	  };

	  Isotope.prototype._manageStamp = function( stamp ) {
	    this._mode()._manageStamp( stamp );
	  };

	  Isotope.prototype._getContainerSize = function() {
	    return this._mode()._getContainerSize();
	  };

	  Isotope.prototype.needsResizeLayout = function() {
	    return this._mode().needsResizeLayout();
	  };

	  // -------------------------- adding & removing -------------------------- //

	  // HEADS UP overwrites default Outlayer appended
	  Isotope.prototype.appended = function( elems ) {
	    var items = this.addItems( elems );
	    if ( !items.length ) {
	      return;
	    }
	    var filteredItems = this._filterRevealAdded( items );
	    // add to filteredItems
	    this.filteredItems = this.filteredItems.concat( filteredItems );
	  };

	  // HEADS UP overwrites default Outlayer prepended
	  Isotope.prototype.prepended = function( elems ) {
	    var items = this._itemize( elems );
	    if ( !items.length ) {
	      return;
	    }
	    // add items to beginning of collection
	    var previousItems = this.items.slice(0);
	    this.items = items.concat( previousItems );
	    // start new layout
	    this._resetLayout();
	    this._manageStamps();
	    // layout new stuff without transition
	    var filteredItems = this._filterRevealAdded( items );
	    // layout previous items
	    this.layoutItems( previousItems );
	    // add to filteredItems
	    this.filteredItems = filteredItems.concat( this.filteredItems );
	  };

	  Isotope.prototype._filterRevealAdded = function( items ) {
	    var filteredItems = this._noTransition( function() {
	      return this._filter( items );
	    });
	    // layout and reveal just the new items
	    this.layoutItems( filteredItems, true );
	    this.reveal( filteredItems );
	    return items;
	  };

	  /**
	   * Filter, sort, and layout newly-appended item elements
	   * @param {Array or NodeList or Element} elems
	   */
	  Isotope.prototype.insert = function( elems ) {
	    var items = this.addItems( elems );
	    if ( !items.length ) {
	      return;
	    }
	    // append item elements
	    var i, item;
	    var len = items.length;
	    for ( i=0; i < len; i++ ) {
	      item = items[i];
	      this.element.appendChild( item.element );
	    }
	    // filter new stuff
	    /*
	    // this way adds hides new filtered items with NO transition
	    // so user can't see if new hidden items have been inserted
	    var filteredInsertItems;
	    this._noTransition( function() {
	      filteredInsertItems = this._filter( items );
	      // hide all new items
	      this.hide( filteredInsertItems );
	    });
	    // */
	    // this way hides new filtered items with transition
	    // so user at least sees that something has been added
	    var filteredInsertItems = this._filter( items );
	    // hide all newitems
	    this._noTransition( function() {
	      this.hide( filteredInsertItems );
	    });
	    // */
	    // set flag
	    for ( i=0; i < len; i++ ) {
	      items[i].isLayoutInstant = true;
	    }
	    this.arrange();
	    // reset flag
	    for ( i=0; i < len; i++ ) {
	      delete items[i].isLayoutInstant;
	    }
	    this.reveal( filteredInsertItems );
	  };

	  var _remove = Isotope.prototype.remove;
	  Isotope.prototype.remove = function( elems ) {
	    elems = makeArray( elems );
	    var removeItems = this.getItems( elems );
	    // do regular thing
	    _remove.call( this, elems );
	    // bail if no items to remove
	    if ( !removeItems || !removeItems.length ) {
	      return;
	    }
	    // remove elems from filteredItems
	    for ( var i=0, len = removeItems.length; i < len; i++ ) {
	      var item = removeItems[i];
	      // remove item from collection
	      removeFrom( item, this.filteredItems );
	    }
	  };

	  Isotope.prototype.shuffle = function() {
	    // update random sortData
	    for ( var i=0, len = this.items.length; i < len; i++ ) {
	      var item = this.items[i];
	      item.sortData.random = Math.random();
	    }
	    this.options.sortBy = 'random';
	    this._sort();
	    this._layout();
	  };

	  /**
	   * trigger fn without transition
	   * kind of hacky to have this in the first place
	   * @param {Function} fn
	   * @returns ret
	   * @private
	   */
	  Isotope.prototype._noTransition = function( fn ) {
	    // save transitionDuration before disabling
	    var transitionDuration = this.options.transitionDuration;
	    // disable transition
	    this.options.transitionDuration = 0;
	    // do it
	    var returnValue = fn.call( this );
	    // re-enable transition for reveal
	    this.options.transitionDuration = transitionDuration;
	    return returnValue;
	  };

	  // ----- helper methods ----- //

	  /**
	   * getter method for getting filtered item elements
	   * @returns {Array} elems - collection of item elements
	   */
	  Isotope.prototype.getFilteredItemElements = function() {
	    var elems = [];
	    for ( var i=0, len = this.filteredItems.length; i < len; i++ ) {
	      elems.push( this.filteredItems[i].element );
	    }
	    return elems;
	  };

	  // -----  ----- //

	  return Isotope;
	}

	// -------------------------- transport -------------------------- //

	if ( typeof define === 'function' && define.amd ) {
	  // AMD
	  define( [
	      'outlayer/outlayer',
	      'get-size/get-size',
	      'matches-selector/matches-selector',
	      'isotope/js/item',
	      'isotope/js/layout-mode',
	      // include default layout modes
	      'isotope/js/layout-modes/masonry',
	      'isotope/js/layout-modes/fit-rows',
	      'isotope/js/layout-modes/vertical'
	    ],
	    isotopeDefinition );
	} else if ( typeof exports === 'object' ) {
	  // CommonJS
	  module.exports = isotopeDefinition(
	    require('outlayer'),
	    require('get-size'),
	    require('desandro-matches-selector'),
	    require('./item'),
	    require('./layout-mode'),
	    // include default layout modes
	    require('./layout-modes/masonry'),
	    require('./layout-modes/fit-rows'),
	    require('./layout-modes/vertical')
	  );
	} else {
	  // browser global
	  window.Isotope = isotopeDefinition(
	    window.Outlayer,
	    window.getSize,
	    window.matchesSelector,
	    window.Isotope.Item,
	    window.Isotope.LayoutMode
	  );
	}
	// Add hidden class if item hidden
	var itemReveal = Isotope.Item.prototype.reveal;
	Isotope.Item.prototype.reveal = function() {
		itemReveal.apply( this, arguments );
		jQuery( this.element ).removeClass('isotope-hidden');
	};
	var itemHide = Isotope.Item.prototype.hide;
	Isotope.Item.prototype.hide = function() {
		itemHide.apply( this, arguments );
		jQuery( this.element ).addClass('isotope-hidden');
	};
})( window );


/*Isotope: end*/

/*!
 * imagesLoaded PACKAGED v3.1.8
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

(function(){function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var i=e.prototype,r=this,o=r.EventEmitter;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return r.EventEmitter=o,e},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n}var n=document.documentElement,i=function(){};n.addEventListener?i=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(i=function(e,n,i){e[n+i]=i.handleEvent?function(){var n=t(e);i.handleEvent.call(i,n)}:function(){var n=t(e);i.call(e,n)},e.attachEvent("on"+n,e[n+i])});var r=function(){};n.removeEventListener?r=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(r=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var o={bind:i,unbind:r};"function"==typeof define&&define.amd?define("eventie/eventie",o):e.eventie=o}(this),function(e,t){"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,i){return t(e,n,i)}):"object"==typeof exports?module.exports=t(e,require("wolfy87-eventemitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(window,function(e,t,n){function i(e,t){for(var n in t)e[n]=t[n];return e}function r(e){return"[object Array]"===d.call(e)}function o(e){var t=[];if(r(e))t=e;else if("number"==typeof e.length)for(var n=0,i=e.length;i>n;n++)t.push(e[n]);else t.push(e);return t}function s(e,t,n){if(!(this instanceof s))return new s(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=o(e),this.options=i({},this.options),"function"==typeof t?n=t:i(this.options,t),n&&this.on("always",n),this.getImages(),a&&(this.jqDeferred=new a.Deferred);var r=this;setTimeout(function(){r.check()})}function f(e){this.img=e}function c(e){this.src=e,v[e]=this}var a=e.jQuery,u=e.console,h=u!==void 0,d=Object.prototype.toString;s.prototype=new t,s.prototype.options={},s.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);var i=n.nodeType;if(i&&(1===i||9===i||11===i))for(var r=n.querySelectorAll("img"),o=0,s=r.length;s>o;o++){var f=r[o];this.addImage(f)}}},s.prototype.addImage=function(e){var t=new f(e);this.images.push(t)},s.prototype.check=function(){function e(e,r){return t.options.debug&&h&&u.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},s.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},a&&(a.fn.imagesLoaded=function(e,t){var n=new s(this,e,t);return n.jqDeferred.promise(a(this))}),f.prototype=new t,f.prototype.check=function(){var e=v[this.img.src]||new c(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void 0;if(this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},f.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var v={};return c.prototype=new t,c.prototype.check=function(){if(!this.isChecked){var e=new Image;n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},c.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},c.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},c.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},c.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},c.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},s});

jQuery(document).ready(function ($) {
	if (!('ontouchstart' in window) && (dtLocal.themeSettings.smoothScroll == "on" || dtLocal.themeSettings.smoothScroll == "on_parallax" && $(".stripe-parallax-bg").length > 0)) {
		$("body").css({"scroll-behavior" : "smooth"});
	}
});

/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

jQuery(document).ready(function ($) {
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		var fixTimeout;
		
		//get the starting position of each element to have parallax applied to it    
		$this.each(function(){
				firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();        

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((top - pos) * speedFactor) + "px");
			});
		}   

		$window.bind('scroll', update).resize(function() {
			update();
		}).bind("debouncedresize", function() {
			clearTimeout(fixTimeout);
			fixTimeout = setTimeout(function() {
				update();
			}, 20);
		});
		update();

		setTimeout(function() {
			if (!window.bgGlitchFixed && $.browser.webkit) {
				$window.scrollTop($window.scrollTop() + 1);
				window.bgGlitchFixed = true;
			}
		}, 20);

	};
});
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
/*if(typeof jQuery.easing["jswing"] === typeof undefined){*/
	jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return jQuery.easing[jQuery.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-jQuery.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return jQuery.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return jQuery.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}})/*}*/
/**
 * jquery.dlmenu.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {

	// global
	var Modernizr = window.Modernizr, $body = $( 'body' );

	$.DLMenu = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.DLMenu.defaults = {
		// classes for the animation effects
		animationClasses : { animIn : 'dl-animate-in-2', animOut : 'dl-animate-out-2' }
	};

	$.DLMenu.prototype = {
		_init : function( options ) {

			// options
			this.options = $.extend( true, {}, $.DLMenu.defaults, options );
			// cache some elements and initialize some variables
			this._config();
			
			var animEndEventNames = {
					'WebkitAnimation' : 'webkitAnimationEnd',
					'OAnimation' : 'oAnimationEnd',
					'msAnimation' : 'MSAnimationEnd',
					'animation' : 'animationend'
				},
				transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'MozTransition' : 'transitionend',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				};
			// animation end event name
			this.animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ] + '.dlmenu';
			// transition end event name
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.dlmenu',
			// support for css animations and css transitions
			this.supportAnimations = Modernizr.cssanimations,
			this.supportTransitions = Modernizr.csstransitions;

			this._initEvents();

		},
		_config : function() {
			this.open = false;
			this.$trigger = this.$el.find( '#mobile-menu' );
	/* ! !changed */
			this.openCap = '<span class="wf-phone-visible">&nbsp;</span><span class="wf-phone-hidden">'+this.$trigger.find( '.menu-open' ).html()+"</span>";
			this.closeCap = '<span class="wf-phone-visible">&nbsp;</span><span class="wf-phone-hidden">'+this.$trigger.find( '.menu-close' ).html()+"</span>";
	/* !changed: end */
			this.$menu = this.$el.find( 'ul.dl-menu' );
			if($(".dt-parent-menu-clickable").length > 0){
				var item = this.$menu.find( 'li.menu-item-has-children > a' );
				$("<i class='next-level'></i>").insertAfter(item);
				this.$menuitemsArrow = this.$menu.find( 'li.menu-item-has-children > .next-level' );
			}/*else{*/
				 this.$menuitems = this.$menu.find( 'li:not(.dl-back)' );
			/*}*/
			this.$back = this.$menu.find( 'li.dl-back' );
			this.$menu.find( '.new-column' ).each(function(){
				var $item_new = $(this),
						$submenu_new = $item_new.children( '.dl-submenu' ),
						$submenu_new_prev = $item_new.prev().find( '> .dl-submenu' );
						 $item_new.find("> a").remove();
					var new_col_sub = $submenu_new.unwrap();
						new_col_sub.find("> a, .dl-back").remove();
					new_col_sub.children().unwrap().appendTo($submenu_new_prev).addClass("new-ul");
					$item_new.siblings(".new-column").remove();
			});
		},
		_initEvents : function() {

			var self = this;

			this.$trigger.on( 'click.dlmenu', function() {

				if( self.open ) {
					self._closeMenu();
				} 
				else {
					self._openMenu();
					// clicking somewhere else makes the menu close
					$body.off( 'click' ).on( 'click.dlmenu', function() {
						self._closeMenu() ;
					} );
					
				}
				return false;

			} );
			if($(".dt-parent-menu-clickable").length > 0){
				this.$menuitemsArrow.on( 'click.dlmenu', function( event ) {
					
					event.stopPropagation();

					var $item = $(this).parent("li"),
						$submenu = $item.children( '.dl-submenu' );
						
					if( $submenu.length > 0) {
						if( $("#dl-menu").css("display") == "block") {
							 $("html, body").animate({ scrollTop: self.$el.offset().top }, 150);
						}
						var $flyin = $submenu.clone().insertAfter( self.$menu ).addClass( self.options.animationClasses.animIn ),
							onAnimationEndFn = function() {
								self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.animOut ).addClass( 'dl-subview' );
								$item.addClass( 'dl-subviewopen' ).parents( '.dl-subviewopen:first' ).removeClass( 'dl-subviewopen' ).addClass( 'dl-subview' );
								$flyin.remove();
							};

						self.$menu.addClass( self.options.animationClasses.animOut );


						if( self.supportAnimations ) {
							self.$menu.on( self.animEndEventName, onAnimationEndFn );
						}
						else {
							onAnimationEndFn.call();
						}

						return false;

					}
				} );
			}else{
				this.$menuitems.on( 'click.dlmenu', function( event ) {
					
					event.stopPropagation();

					var $item = $(this),
						$submenu = $item.children( '.dl-submenu' );
						
					if( $submenu.length > 0) {
						if( $("#dl-menu").css("display") == "block") {
							 $("html, body").animate({ scrollTop: self.$el.offset().top }, 150);
						}
						var $flyin = $submenu.clone().insertAfter( self.$menu ).addClass( self.options.animationClasses.animIn ),
							onAnimationEndFn = function() {
								self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.animOut ).addClass( 'dl-subview' );
								$item.addClass( 'dl-subviewopen' ).parents( '.dl-subviewopen:first' ).removeClass( 'dl-subviewopen' ).addClass( 'dl-subview' );
								$flyin.remove();
							};

						self.$menu.addClass( self.options.animationClasses.animOut );


						if( self.supportAnimations ) {
							self.$menu.on( self.animEndEventName, onAnimationEndFn );
						}
						else {
							onAnimationEndFn.call();
						}

						return false;

					}
				} );
			}

			this.$back.on( 'click.dlmenu', function( event ) {
				if($("#dl-menu").css("display") == "block"){
					$("html, body").animate({ scrollTop: self.$el.offset().top }, 150);
				}

				var $this = $( this ),
					$submenu = $this.parents( '.dl-submenu:first' ),
					$item = $submenu.parent(),


					$flyin = $submenu.clone().insertAfter( self.$menu ).addClass( self.options.animationClasses.animOut );

				var onAnimationEndFn = function() {
					self.$menu.off( self.animEndEventName ).removeClass( self.options.animationClasses.animIn );
					$flyin.remove();
				};

				self.$menu.addClass( self.options.animationClasses.animIn );

				if( self.supportAnimations ) {
					self.$menu.on( self.animEndEventName, onAnimationEndFn );
				}
				else {
					onAnimationEndFn.call();
				}

				$item.removeClass( 'dl-subviewopen' );
				
				var $subview = $this.parents( '.dl-subview:first' );
				if( $subview.is( 'li' ) ) {
					$subview.addClass( 'dl-subviewopen' );
				}
				$subview.removeClass( 'dl-subview' );

				return false;

			} );
			
		},
		_closeMenu : function() {
			var self = this,
				onTransitionEndFn = function() {
					self.$menu.off( self.transEndEventName );
					self._resetMenu();
				};
			
			this.$menu.removeClass( 'dl-menuopen' );
			this.$menu.addClass( 'dl-menu-toggle' );
			this.$trigger.removeClass( 'dl-active' )/*.html(this.openCap)*/;
			
			if( this.supportTransitions ) {
				this.$menu.on( this.transEndEventName, onTransitionEndFn );
			}
			else {
				onTransitionEndFn.call();
			}

			this.open = false;

		},
		_openMenu : function() {
			this.$menu.addClass( 'dl-menuopen dl-menu-toggle' ).on( this.transEndEventName, function() {
				$( this ).removeClass( 'dl-menu-toggle' );
			} );

			this.$trigger.addClass( 'dl-active' )/*.html(this.closeCap)*/;
			this.open = true;
			if($("#dl-menu").css("display") == "block"){
				 $("html, body").animate({ scrollTop: this.$el.offset().top }, 150);
			}

		},
		// resets the menu to its original state (first level of options)
		_resetMenu : function() {
			this.$menu.removeClass( 'dl-subview' );
			this.$menuitems.removeClass( 'dl-subview dl-subviewopen' );
		}
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.dlmenu = function( options ) {
		if ( typeof options === 'string' ) {
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'dlmenu' );
				if ( !instance ) {
					logError( "cannot call methods on dlmenu prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for dlmenu instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
		} 
		else {
			this.each(function() {	
				var instance = $.data( this, 'dlmenu' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'dlmenu', new $.DLMenu( options, this ) );
				}
			});
		}
		return this;
	};

} )( jQuery, window );
/****************************************************************************************************************************/

 /* !- Tooltip*/  
 function simple_tooltip(e,t){jQuery(e).each(function(e){jQuery("body").append("<div class='"+t+"' id='"+t+e+"'>"+jQuery(this).find("span.tooltip-c").html()+"</div>");var n=jQuery("#"+t+e);jQuery(this).removeAttr("title").mouseover(function(){n.css({opacity:1,display:"none"}).fadeIn(400)}).mousemove(function(e){var t=jQuery(window).scrollTop();var r=jQuery(window).width();var i;var s;var o=15;if(r-o*2>=n.width()+e.pageX){i=e.pageX+o}else{i=r-n.width()-o}if(t+o*2>=e.pageY-n.height()){s=t+o}else{s=e.pageY-n.height()-2.2*o}n.css({left:i,top:s})}).mouseout(function(){n.css({left:"-9999px"})})})}
/********************************************************************************************************************************/

 /* !- Accordion, Toggle*/ 
(function(e,t,n){var r=t.event;var i=0;t.Accordion=function(e,n){this.$el=t(n);this.$items=this.$el.children("ul").children("li");this.itemsCount=this.$items.length;this._init(e)};t.Accordion.defaults={open:-1,oneOpenedItem:false,speed:600,easing:"easeInOutExpo",scrollSpeed:900,scrollEasing:"easeInOutExpo"};t.Accordion.prototype={_init:function(e){this.options=t.extend(true,{},t.Accordion.defaults,e);this._validate();this.current=this.options.open;this.$items.find("div.st-content").hide();this._saveDimValues();if(this.current!=-1)this._toggleItem(this.$items.eq(this.current));this._initEvents()},_saveDimValues:function(){this.$items.each(function(){var e=t(this);e.data({originalHeight:e.find("a:first").height(),offsetTop:e.offset().top})})},_validate:function(){if(this.options.open<-1||this.options.open>this.itemsCount-1)this.options.open=-1},_initEvents:function(){var n=this;this.$items.find("a:first").bind("click.accordion",function(e){var r=t(this).parent();if(n.options.oneOpenedItem&&n._isOpened()&&n.current!==r.index()){n._toggleItem(n.$items.eq(n.current))}n._toggleItem(r);return false});n.$el.find("li").each(function(){var e=t(this);e.css("height",e.data("originalHeight"))});t(e).bind("debouncedresize",function(e){n._saveDimValues();n.$el.find("li").not(".st-open").each(function(){var e=t(this);e.css("height",e.data("originalHeight"))});n.$el.find("li.st-open").each(function(){var e=t(this);e.css("height",e.data("originalHeight")+e.find("div.st-content").outerHeight(true))})})},_isOpened:function(){return this.$el.find("li.st-open").length>0},_toggleItem:function(e){i++;var t=this;var n=e.find("div.st-content");e.hasClass("st-open")?(this.current=-1,n.stop(true,true).fadeOut(this.options.speed),e.removeClass("st-open").stop().animate({height:e.data("originalHeight")},this.options.speed,this.options.easing,function(){if(i>1){t._scroll()}})):(this.current=e.index(),n.stop(true,true).fadeIn(this.options.speed),e.addClass("st-open").stop().animate({height:e.data("originalHeight")+n.outerHeight(true)},this.options.speed,this.options.easing,function(){}))},_scroll:function(n){var n=n||this,r;n.current!==-1?r=n.current:r=n.$el.find("li.st-open:last").index();if(e.innerWidth<760){t("html, body").stop().animate({scrollTop:n.$items.eq(r).offset().top},n.options.scrollSpeed,n.options.scrollEasing)}}};var s=function(e){if(this.console){console.error(e)}};t.fn.dtAccordion=function(e){if(typeof e==="string"){var n=Array.prototype.slice.call(arguments,1);this.each(function(){var r=t.data(this,"accordion");if(!r){s("cannot call methods on accordion prior to initialization; "+"attempted to call method '"+e+"'");return}if(!t.isFunction(r[e])||e.charAt(0)==="_"){s("no such method '"+e+"' for accordion instance");return}r[e].apply(r,n)})}else{this.each(function(){var n=t.data(this,"accordion");if(!n){t.data(this,"accordion",new t.Accordion(e,this))}})}return this};var i=0;t.Toggle=function(e,n){this.$el=t(n);this.$items=this.$el;this.itemsCount=this.$items.length;this._init(e)};t.Toggle.defaults={open:-1,oneOpenedItem:false,speed:600,easing:"easeInOutExpo",scrollSpeed:900,scrollEasing:"easeInOutExpo"};t.Toggle.prototype={_init:function(e){this.options=t.extend(true,{},t.Toggle.defaults,e);this._validate();this.current=this.options.open;this.$items.find("div.st-toggle-content").hide();this._saveDimValues();if(this.current!=-1)this._toggleItem(this.$items.eq(this.current));this._initEvents()},_saveDimValues:function(){this.$items.each(function(){var e=t(this);e.data({originalHeight:e.find("a:first").height(),offsetTop:e.offset().top})})},_validate:function(){if(this.options.open<-1||this.options.open>this.itemsCount-1)this.options.open=-1},_initEvents:function(){var n=this;this.$items.find("a:first").bind("click.toggle",function(e){var r=t(this).parent();if(n.options.oneOpenedItem&&n._isOpened()&&n.current!==r.index()){n._toggleItem(n.$items.eq(n.current))}n._toggleItem(r);return false});n.$el.each(function(){var e=t(this);e.css("height",e.data("originalHeight"))});t(e).bind("debouncedresize",function(e){n._saveDimValues();n.$el.not(".st-open").each(function(){var e=t(this);e.css("height",e.data("originalHeight"))});n.$el.each(function(){if(t(this).hasClass("st-open")){var e=t(this);e.css("height",e.data("originalHeight")+e.find("div.st-toggle-content").outerHeight(true))}})})},_isOpened:function(){return this.$el.is(".st-toggle-open").length>0},_toggleItem:function(e){i++;var t=this;var n=e.find("div.st-toggle-content");e.hasClass("st-open")?(this.current=-1,n.stop(true,true).fadeOut(this.options.speed),e.removeClass("st-open").stop().animate({height:e.data("originalHeight")},this.options.speed,this.options.easing,function(){if(i>1){t._scroll()}})):(this.current=e.index(),n.stop(true,true).fadeIn(this.options.speed),e.addClass("st-open").stop().animate({height:e.data("originalHeight")+n.outerHeight(true)},this.options.speed,this.options.easing,function(){if(i>1){t._scroll()}}))},_scroll:function(n){var n=n||this,r;n.current!==-1?r=n.current:r=n.$el.find("li.st-open:last").index();if(e.innerWidth<760){t("html, body").stop().animate({scrollTop:n.$items.eq(r).offset().top},n.options.scrollSpeed,n.options.scrollEasing)}}};var s=function(e){if(this.console){console.error(e)}};t.fn.toggle=function(e){if(typeof e==="string"){var n=Array.prototype.slice.call(arguments,1);this.each(function(){var r=t.data(this,"toggle");if(!r){s("cannot call methods on toggle prior to initialization; "+"attempted to call method '"+e+"'");return}if(!t.isFunction(r[e])||e.charAt(0)==="_"){s("no such method '"+e+"' for toggle instance");return}r[e].apply(r,n)})}else{this.each(function(){var n=t.data(this,"toggle");if(!n){t.data(this,"toggle",new t.Toggle(e,this))}})}return this}})(window,jQuery)
/*********************************************************************************************************************/

 /*3D slideshow*/
 jQuery(document).ready(function(e){if(e(".three-d-slider").length>0){if(e("#main-slideshow").hasClass("fixed")){var t=e(".three-d-slider").attr("data-height")/e(".three-d-slider").attr("data-width");var n=e(".three-d-slider").css("height"),r=e(".three-d-slider").css("height",e(".three-d-slider").width()*t).addClass("slide-me");var i=e(".three-d-slider").width()}else if(e("#main-slideshow").hasClass("fixed-height")){var t=e(".three-d-slider").attr("data-height")/e(".three-d-slider").attr("data-width");var n=e(".three-d-slider").css("height"),r=e(".three-d-slider").css("height",e(".three-d-slider").width()*t).addClass("slide-me");var i=e(".three-d-slider").width()}else{if(e(".boxed").length>0){var s=parseInt(e("#page.boxed").css("margin-bottom"))}else{var s=0}var r=e(".three-d-slider").css({height:e(window).height()-e("#header").height()+e("#header.overlap").height()-s-e("#wpadminbar").height()-s-e("#top-bar").height()}).addClass("slide-me")}var o={useJS:1,cellSize:300,images:[e("#level1 img"),e("#level2 img"),e("#level3 img")],scale:[.14,.23,.35],corner_w:3,corner_l:30,corner_color:"#ffffff",hover_color:"rgba(0, 0, 0, .35)"};var u=[],a=e([]),f=0;function l(){var t=o.images.slice();for(var n=0;n<t.length;n++){if(t[n]&&t[n].length){u[f]=t[n].slice(0);a=e.merge(a,t[n]);t[n].parent().addClass("erase-source");f++}}}l();var c=0,h=a.length,p=r.children("#loading"),d=r.height(),v=r.width(),m=v/d,g=3,y=[3,6,9],b=[1,1,1],w,E=Math.round(100/o.scale[g-1])/100,S={layer:700,invis:850,scrn:500,delay:100},x,T,N,C,k,L,A,O,M=[],_=[],D=[],P={allowParallax:g,useNavig:0,antiStumble:0,isLightbox:0,isMobile:/(Android|BlackBerry|iPhone|iPod|iPad|Palm|Symbian)/.test(navigator.userAgent),scrolling:false,noImagesWarning:"There are no slides to display. Please upload images."};if(e("#main-slideshow").hasClass("fixed")){var H,B;var j=i;e(window).on("resize",function(){var n=e(".three-d-slider").attr("data-width"),r=e(".three-d-slider").attr("data-height");H=e(".three-d-slider").width();if(H!=j){var i=e(".three-d-slider").css("height",H*(r/n)).addClass("slide-me");H=e(".three-d-slider").width()}else{i=e(".three-d-slider").css("height",e(".three-d-slider").width()*t).addClass("slide-me")}})}else if(e("#main-slideshow").hasClass("fixed-height")){var H,B;var j=i;e(window).on("resize",function(){var n=e(".three-d-slider").attr("data-width"),r=e(".three-d-slider").attr("data-height");H=e(".three-d-slider").width();if(H!=j){var i=e(".three-d-slider").css("height",H*(r/n)).addClass("slide-me");H=e(".three-d-slider").width()}else{i=e(".three-d-slider").css("height",e(".three-d-slider").width()*t).addClass("slide-me")}})}else{e(window).on("resize",function(){if(e(".boxed").length>0){var t=parseInt(e("#page.boxed").css("margin-bottom"))}else{var t=0}var n=e(".three-d-slider").css({height:e(window).height()-e("#header").height()+e("#header.overlap").height()-t-e("#wpadminbar").height()-t-e("#top-bar").height()}).addClass("slide-me")})}var F=r.offset().left,I=r.offset().top;function q(){var e=Math.floor(h/g);for(var t=0;t<g;t++){u[t]=[];for(var n=0;n<e+Math.floor((t+1)/g)*(h-3*e);n++){u[t][n]=a[n+t*e]}}}function R(){var t=e.Deferred();if(f!=g)q();r.addClass("slide-me");if(h!=0){a.loaded(function(){++c});e.when(U()).done(function(){t.resolve()});return r}else{p.css("display","none");r.addClass("lightbox").append('<div class="img-caption"><p>'+P.noImagesWarning+"</p></div>");return r}}function U(){var t=e.Deferred();A=setTimeout(function(){if(c>.5*h){var n=0;O=setInterval(function(){if(n<h){p.html(++n+"/"+h)}else{p.html(h+"/"+h);if(c==h){clearInterval(O);e.when(Et()).done(function(){t.resolve()})}}},50)}else{O=setInterval(function(){p.html(c+"/"+h);if(c==h){clearInterval(O);e.when(Et()).done(function(){t.resolve()})}},100)}clearTimeout(A)},150);return t.promise()}var z="";var W="";if(e.browser.webkit){z="-webkit-";W="Webkit"}else if(e.browser.msie){z="-ms-";W="ms"}else if(e.browser.mozilla){z="-moz-";W="Moz"}else if(e.browser.opera){z="-o-";W="O"}function X(){var e=document.body||document.documentElement;var t=e.style;var n="transform";if(typeof t[n]=="string")return true;n=n.charAt(0).toUpperCase()+n.substr(1);if(typeof t[W+n]=="string")return true;return false}function V(){var e=document.body||document.documentElement;var t=e.style;var n="transition";if(typeof t[n]=="string")return true;n=n.charAt(0).toUpperCase()+n.substr(1);if(typeof t[W+n]=="string")return true;return false}var $=V()*X(),J=z+"transition-duration",K=z+"transition-delay",Q=z+"transform";function G(e){if(e.originalEvent.touches!==undefined&&e.originalEvent.touches[0]){e.pageX=e.originalEvent.touches[0].pageX;e.pageY=e.originalEvent.touches[0].pageY}return e}function Y(){d=r.height();v=r.width();m=v/d;lt(.5*v,.5*d)}function Z(){d=r.height();v=r.width();m=v/d;st()}function et(t){var n='<div class="close"></div><div class="dark-layer l2"></div><div class="dark-layer l1"></div><div class="img-caption"><p></p></div><div class="navig"><div class="act">1</div><div>2</div><div>3</div></div>',i;for(var s=0;s<g;s++){n+='<div class="container-'+(s+1)+' container" >';var u=t[s].length;for(var a=0;a<u;a++){if(e("<canvas></canvas>")[0].getContext){var f='<canvas class="photo"></canvas>'}else{var f='<img class="photo" />'}n+=f}n+='<div class="dark-layer"></div>';if(!P.isMobile){if($){i='<canvas class="corners"></canvas>'}else{i='<span class="top-l"></span><span class="top-r"></span><span class="bottom-l"></span><span class="bottom-r"></span>'}n+=i}n+="</div>"}r.append(n);tt();e(window).resize(function(){F=r.offset().left;I=r.offset().top;$navig.css("top",Math.round(.5*(d-$navig.height())));if(!P.isLightbox){if($&&!o.useJS){Z();return true}Y()}});e(document).on("scroll",function(){$this=e(document);scrollTop=$this.scrollTop();scrollLeft=$this.scrollLeft()});return e("div.container")}function tt(){$closeX=r.children(".close");$dark_layer1=r.children(".l1");$dark_layer2=r.children(".l2");$caption=r.children(".img-caption");$caption_text=$caption.children("p");$navig=r.children(".navig");$navig.css("top",Math.round(.5*(d-$navig.height())));$darkLayers=r.find("div.dark-layer");scrollTop=e(document).scrollTop();scrollLeft=e(document).scrollLeft()}function nt(t){for(var n=0;n<g;n++){var r=rt(n),i=r.length;for(var s=0;s<i;s++){var o=t[n][s],u=e(o).width(),a=e(o).height();r[s].width=u;r[s].height=a;if(e("<canvas></canvas>")[0].getContext){var f=r[s].getContext("2d");f.drawImage(o,0,0,u,a)}else{e(r[s]).attr("src",e(o).attr("src"))}e(r[s]).attr("alt",o.alt);it(r[s])}}}function rt(t){return e(D[t]).children(".photo")}function it(t){var n=e(t),r=Math.ceil(n.width()/o.cellSize),i=Math.ceil(n.height()/o.cellSize);n.data({wCanvas:r,hCanvas:i,deviationX:Math.floor((r*o.cellSize-n.width())*Math.random()),deviationY:Math.floor((i*o.cellSize-n.height())*Math.random())})}function st(){for(var t=0;t<g;t++){var n=rt(t),i=ot(n,m);M[t]=i.n;_[t]=i.m;var s=at(n,ut(0,_[t],0,M[t]),0,0,M[t],_[t]);_[t]=s[0];M[t]=s[1];D[t].ind=t;var u=ft(M[t],d),a=ft(_[t],v),f=n.length;D[t].Wo=a[0];D[t].Ho=u[0];for(var l=0;l<f;l++){var c=e(n[l]),h=parseFloat(c.css("top")),p=parseFloat(c.css("left"));c.css({top:h+u[1],left:p+a[1]})}D[t].Scale=1;e(D[t]).css({width:D[t].Wo,height:D[t].Ho});if(!$||o.useJS){b[t]=o.scale[t];D[t]=bt(o.scale[t],D[t],0)}}lt(.5*v,.5*d);P.allowParallax=g;return r}function ot(e,t){var n=0,r=e.length,i=0,s=0;giveMoreSpace=1.3;for(var u=0;u<r;u++){var a=e[u].width,f=e[u].height;i=Math.max(i,a);s=Math.max(s,f);n+=giveMoreSpace*a*f+2*o.cellSize*o.cellSize}i=Math.ceil(i/o.cellSize);s=Math.ceil(s/o.cellSize);var l=Math.ceil(Math.sqrt(t*n)/o.cellSize),c;if(!(l>i))l=i+1;c=Math.ceil(giveMoreSpace*l/t);if(!(c>s))c=s+1;return{n:c,m:l}}function ut(e,t,n,r){var i=[];for(var s=n;s<r;s++){var o=[];for(var u=e;u<t;u++){o[u]=true}i[s]=o}return i}function at(t,n,r,i,s,u){var a=0,f=0,l=i;var c=t.length;for(var h=0;h<c;h++){i=l;var p=e(t[h]);widthCanvas=p.data("wCanvas"),heightCanvas=p.data("hCanvas");e:for(var d=r;d<s-heightCanvas;d++){t:for(var v=i;v<u-widthCanvas;v++){for(var m=d;m<d+heightCanvas;m++){for(var g=v;g<v+widthCanvas;g++){if(n[m][g]==false){if(d==s-heightCanvas-1&&v==u-widthCanvas-1){for(var y=0;y<s;y++){n[y].push(true)}v=i;u++;d=0}continue t}}}for(var m=d;m<d+heightCanvas+1;m++){for(var g=v;g<v+widthCanvas+1;g++){n[m][g]=false}}if(v+widthCanvas>a)a=v+widthCanvas;if(d+heightCanvas>f)f=d+heightCanvas;p.css({top:Math.floor(d*o.cellSize+p.data("deviationY")),left:Math.floor(v*o.cellSize+p.data("deviationX"))});break e}}}return[a,f]}function ft(e,t){if(o.cellSize*e*o.scale[g-1]<t){var n=Math.round((t+.5*o.cellSize)/o.scale[g-1]),r=Math.round(.5*(n-o.cellSize*e))}else{var n=Math.round(o.cellSize*e+.5*o.cellSize/o.scale[g-1]),r=Math.round(.25*o.cellSize/o.scale[g-1])}return[n,r]}function lt(t,n){if(P.allowParallax!=g)return false;t-=F;n-=I;var r=t/v,i=n/d,s=g-1,u=(r-.5)*(1-o.scale[s]/b[s])*D[s].Wo-r*(D[s].Wo-v),a=(i-.5)*(1-o.scale[s]/b[s])*D[s].Ho-i*(D[s].Ho-d);for(var f=0;f<s;f++){var l=o.scale[f]/b[s]*(u+.5*(b[f]*D[f].Wo-v))-.5*(b[f]*D[f].Wo-v),c=o.scale[f]/b[s]*(a+.5*(b[f]*D[f].Ho-d))-.5*(b[f]*D[f].Ho-d);if(!P.antiStumble){e(D[f]).css({left:Math.round(l),top:Math.round(c)})}else{P.allowParallax=0;e(D[f]).animate({left:Math.round(l),top:Math.round(c)},120,"linear")}}if(!P.antiStumble){e(D[s]).css({left:Math.floor(u),top:Math.floor(a)})}else{e(D[s]).animate({left:Math.floor(u),top:Math.floor(a)},120,"linear",function(){P.antiStumble=0;P.allowParallax=g})}}function ct(){var e=0,t=0,n=0,i=0,s=0,o=0,u=0,a=0,f,l,c;r[0].ontouchmove=function(e){e.preventDefault()};r.on("touchstart",function(r){var i=G(r);P.scrolling=false;n=i.pageX-F;s=i.pageY-I;u=e+(n-.5*v);a=t+(s-.5*d)});r.on("touchmove",function(r){var i=G(r),o=i.pageX-F,h=i.pageY-I,p=o-u,m=h-a,g,y;f=o;l=h;g=(p>v)*(v+.1)+(p<0)*.1;y=(m>d)*(d+.1)+(m<0)*.1;if(!g){g=p}else{g=g-.1;n=v-g-e}if(!y){y=m}else{y=y-.1;s=d-y-t}P.scrolling=true;lt(v-g+F,d-y+I);c=true});r.on("touchend",function(r){if(c){e+=n-f;t+=s-l}c=0})}function ht(e){if($){var t=e.width()+2*o.corner_w,n=e.height()+2*o.corner_w,r=parseFloat(e.css("left"))-o.corner_w,i=parseFloat(e.css("top"))-o.corner_w,s=e.siblings(".corners").css({left:r,top:i});s[0].width=t;s[0].height=n;var u=s[0].getContext("2d");u.clearRect(0,0,t,n);u.fillStyle=o.hover_color;u.fillRect(o.corner_w,o.corner_w,t-2*o.corner_w,n-2*o.corner_w);u.beginPath();u.strokeStyle=o.corner_color;u.lineWidth=o.corner_w;u.lineCap="square";pt(u,.5*o.corner_w,o.corner_l,.5*o.corner_w,.5*o.corner_w,o.corner_l,.5*o.corner_w);pt(u,t-o.corner_l,.5*o.corner_w,t-.5*o.corner_w,.5*o.corner_w,t-.5*o.corner_w,o.corner_l);pt(u,t-.5*o.corner_w,n-o.corner_l,t-.5*o.corner_w,n-.5*o.corner_w,t-o.corner_l,n-.5*o.corner_w);u.stroke();pt(u,o.corner_l,n-.5*o.corner_w,.5*o.corner_w,n-.5*o.corner_w,.5*o.corner_w,n-o.corner_l);u.stroke();return false}else{var a=e.siblings("span.top-l"),f=e.siblings("span.bottom-l"),l=e.siblings("span.top-r"),c=e.siblings("span.bottom-r"),h=parseFloat(e.css("left")),p=parseFloat(e.css("top")),d=e.width(),v=e.height();span_side=o.corner_l-o.corner_w;a.css({opacity:.7,left:h,top:p});f.css({opacity:.7,left:h,top:p+v-span_side});l.css({opacity:.7,left:h+d-span_side,top:p});c.css({opacity:.7,left:h+d-span_side,top:p+v-span_side});e.on("mouseleave",function(){a.css("opacity",0);f.css("opacity",0);l.css("opacity",0);c.css("opacity",0)})}}function pt(e,t,n,r,i,s,o){e.moveTo(t,n);e.lineTo(r,i);e.lineTo(s,o)}function dt(t,n){var r=t.length-1,i=n.target;vt();while(!e(i).hasClass("photo")&&r!=0){var s=new jQuery.Event("click");s.pageX=n.pageX-scrollLeft;s.pageY=n.pageY-scrollTop;e(t[r]).addClass("toBG");i=document.elementFromPoint(s.pageX,s.pageY);r--}var o=t.length;for(var u=0;u<o;u++){e(t[u]).removeClass("toBG")}vt();if(!e(i).hasClass("photo"))i=false;return i}function vt(){for(var t=0;t<$darkLayers.length;t++){e($darkLayers[t]).toggleClass("toBG")}return $darkLayers}function mt(t){if(!P.useNavig){var n=e(t),i=n.parent("div.container");$navig.children("div.act").removeClass("act");$navig.children(":nth-child("+(g-i.index("div.container"))+")").addClass("act");St(n)}else{var i=e(t);lt(.5*v,.5*d)}P.allowParallax=0;var s=i[0].ind,u=g-1-s,a=[];r.addClass("scale-me").removeClass("slide-me");for(var f=0;f<s+1;f++){var l=(f+u)%g,c=(l-f)*S.layer;a[l]=gt(D[f],o.scale[l],y[l],c);a[l].ind=l;if(P.useNavig){T=setTimeout(function(){P.allowParallax++;P.useNavig--},1.25*(c-S.layer))}}for(var h=s+1;h<g;h++){var l=(h+u)%g,p=(g-1-h)*S.layer,m=l*S.layer;a[l]=yt(D[h],o.scale[l],y[l],p,m);a[l].ind=l;if(P.useNavig){N=setTimeout(function(){P.allowParallax++;P.useNavig--;Math.floor(P.allowParallax/g)*r.removeClass("scale-me").addClass("slide-me")},p+S.scrn+S.delay+300+m+S.invis)}}return a}function gt(t,n,r,i){$dark_layer1.removeClass("l1");$dark_layer2.removeClass("l2");if($&&!o.useJS){e(t).css(J,S.layer+"ms").css(K,"0ms").css(Q,"scale("+n+","+n+")")}else{t=bt(n,t,i)}C=setTimeout(function(){e(t).css({zIndex:r});$dark_layer1.addClass("l1");$dark_layer2.addClass("l2")},1.25*(i-S.layer));return t}function yt(t,n,r,i,s){var u=i+S.scrn;ttt2=.5*i;e(t).css("zIndex",90*n);if($&&!o.useJS){e(t).css(J,u+"ms, "+S.scrn+"ms").css(K," 0ms, "+ttt2+"ms").css(Q,"scale(1,1)").css({opacity:0})}else{t=bt(1,t,u);if(P.isMobile)e(t).css({opacity:0}).css(J,S.scrn+"ms").css(K,ttt2+"ms")}k=setTimeout(function(){e(t).css({zIndex:r});if($&&!o.useJS){e(t).css(J,"0ms").css(K,"0ms").css(Q,"scale(0.1,0.1)")}else{t=bt(.1,t,0);if(!P.isMobile)e(t).css("visibility","hidden")}},i+S.scrn+S.delay);var a=s+S.invis;ttt4=.5*S.invis;L=setTimeout(function(){if($&&!o.useJS){e(t).css(J,a+"ms, "+ttt4+"ms").css(K," 0ms").css(Q,"scale("+n+","+n+")").css({opacity:1})}else{e(t).css("visibility","visible");t=bt(n,t,a);if(P.isMobile){e(t).css({opacity:1}).css(J,ttt4+"ms").css(K," 0ms")}else{e(t).css("visibility","visible")}}},i+S.scrn+S.delay+300);return t}function bt(t,n,r){var i=t/n.Scale;n.Scale=t;var s=n.Wo,o=n.Ho,u=parseFloat(e(n).css("top")),a=parseFloat(e(n).css("left")),f=e(n).children(".photo"),l=Math.round(i*s),c=Math.round(i*o);e(n).animate({width:l,height:c,top:Math.round(u+.5*(1-i)*o),left:Math.round(a+.5*(1-i)*s)},r);n.Wo=l;n.Ho=c;var h=f.length;for(var p=0;p<h;p++){var d=parseFloat(e(f[p]).css("width")),v=parseFloat(e(f[p]).css("height")),m=parseFloat(e(f[p]).css("top")),g=parseFloat(e(f[p]).css("left"));if(!e(f[p]).hasClass("show")){e(f[p]).animate({width:Math.round(i*d),height:Math.round(i*v),top:Math.round(i*m),left:Math.round(i*g)},r)}}return n}function wt(t){var n=Math.round(100/o.scale[0])/100;e(D[t]).css(Q,"scale("+o.scale[t]+","+o.scale[t]+")").children("div.dark-layer").css(Q,"scale("+n+","+n+")")}function Et(){clearInterval(A);p.css("display","none");D=et(u);if(o.useJS*=P.isMobile)r.addClass("useJS");if($&&!o.useJS)for(var t=0;t<g;t++){wt(t)}nt(u);e(".erase-source").remove();st();if(!$){$closeX.css("display","none");$caption.css("display","none")}else{o.corner_w=Math.round(o.corner_w/o.scale[g-1]);o.corner_l=Math.round(o.corner_l/o.scale[g-1])}if(e(D[g-1]).width()){r.on("click",function(t){if(P.allowParallax==g&&!e(t.target).hasClass("act")){var n=dt(D,t);if(n){D=mt(n)}}})}if(!P.isMobile){r.on("mousemove",function(e){lt(e.pageX,e.pageY)});r.children("div.container").children(".photo").on("click",function(){if(e(this).parent(".container")[0]==D[g-1])St(e(this))});r.children("div.container").children("canvas.corners").on("click touchend",function(){St(w)});r.children("div.container").children(".photo").not(".top-slice").on("mouseenter",function(t){w=e(t.target);if(w.parent(".container")[0]==D[g-1]&&!w.hasClass("top-slice")){ht(w)}})}else{ct();r.children("div.container").children(".photo").on("touchend",function(){if(!P.scrolling)St(e(this))})}$navig.children("div").on("click touchend",function(){Tt(e(this))});return r}function St(t){if(!t.hasClass("show")&&P.allowParallax==g){P.isLightbox=1;P.allowParallax=0;inImW=t.width();inImH=t.height();inImT=parseFloat(t.css("top"));inImL=parseFloat(t.css("left"));$parent=t.parent();sc=o.scale[g-1];inScale=o.scale[$parent[0].ind];$dark_bg=t.siblings(".dark-layer").addClass("l3");r[0].ontouchstart=function(e){e.preventDefault()};var n=parseFloat($parent.css("top")),i=parseFloat($parent.css("left")),s=$parent[0].Wo,u=$parent[0].Ho;r.addClass("lightbox");$caption_text.html(t.attr("alt"));t.addClass("show top-slice");xt(t,inImW,inImH,sc,inScale,s,u,i,n,$dark_bg);if($&&!o.useJS){t.css(Q,"scale("+E+","+E+")");$dark_bg.css({width:v,height:d,left:Math.round((.5*(s-v)*(inScale-1)-i)/inScale),top:Math.round((.5*(u-d)*(inScale-1)-n)/inScale)})}else{t.siblings("span").css("opacity",0);$dark_bg.css({width:v,height:d,left:Math.round(-i-.5*(1-sc/inScale)*s),top:Math.round(-n-.5*(1-sc/inScale)*u),display:"none"})}e(window).resize(function(){if(P.isLightbox&&$){F=r.offset().left;I=r.offset().top;Y();n=parseFloat($parent.css("top"));i=parseFloat($parent.css("left"));xt(r.children("div.container").children(".show.top-slice"),inImW,inImH,sc,inScale,s,u,i,n,$dark_bg)}});$closeX.on("mouseover",function(){$closeX.addClass("hovered")});$closeX.on("click touchend",function(){St(t)});e(document).keyup(function(e){if(e.keyCode==27)St(t)});return true}else if(t.hasClass("show")&&D.length==g&&$closeX[0].offsetWidth){r[0].ontouchstart=function(e){return true};r.removeClass("lightbox");$closeX.removeClass("hovered");t.siblings(".dark-layer").removeClass("l3");$caption_text.empty();if($&&!o.useJS){t.removeClass("show").css({left:Math.round(inImL),top:Math.round(inImT),maxWidth:"none",maxHeight:"none"}).css(Q,"none")}else{t.removeClass("show").animate({left:Math.round(sc*inImL/inScale),top:Math.round(sc*inImT/inScale),width:Math.round(sc*inImW/inScale),height:Math.round(sc*inImH/inScale)},400).css({maxWidth:"none",maxHeight:"none"});$closeX.fadeOut();$dark_bg.fadeOut();$caption.fadeOut()}x=setTimeout(function(){t.removeClass("top-slice");P.allowParallax=g;P.isLightbox=0;P.antiStumble=1;r.removeClass("scale-me").addClass("slide-me")},400);return true}}function xt(e,t,n,r,i,s,u,a,f,l){var c,h,p=42,m=$*!o.useJS+(!$+o.useJS)*i;if(t/m>v||n/m>d-110){if(t/n>v/d){var g=v-2*$closeX.width(),y=Math.round((v-2*$closeX.width())*n/t);p=.5*$closeX.width()}else{var g=Math.round((d-110)*t/n),y=d-110}e.css({maxHeight:y,maxWidth:g});c=g*m;h=y*m}else{c=t;h=n}if($&&!o.useJS){e.css({left:Math.round(.5*(v-c*r-2*a-s*(1-r))/r),top:Math.round(.5*(d-h*r-2*f-u*(1-r))/r)})}else{e.animate({left:Math.round(-a-.5*(1-r/i)*s+.5*(v-c/i)),top:Math.round(-f-.5*(1-r/i)*u+.5*(d-h/i)),width:Math.round(c/i),height:Math.round(h/i)},850,function(){$closeX.delay(700).fadeIn(400);l.delay(700).fadeIn(400);$caption.delay(700).fadeIn(400)})}$caption.css("top",Math.round(.5*(d+h/($*!o.useJS+(!$+o.useJS)*i))));$closeX.css({top:Math.round(.5*(d-h/($*!o.useJS+(!$+o.useJS)*i))),left:Math.round(.5*c/($*!o.useJS+(!$+o.useJS)*i)+p)});return e}function Tt(t){if(P.allowParallax>=g&&!t.hasClass("act")){ct();P.useNavig=g;var n=g-$navig.children(".act").index(),r=g-t.index(),i=g-1-n;$navig.children(".act").removeClass("act");t.addClass("act");D=mt(e(D[(r+i)%g]))}}function Nt(){clearTimeout(x);clearTimeout(T);clearTimeout(N);clearTimeout(C);clearTimeout(k);clearTimeout(L);clearTimeout(A);clearInterval(O);r.children("div.container").children(".photo").off("click");$closeX.off("click");r.off("click");r.off("mousemove");r.children("div.container").children(".photo").off("mouseenter");r.children("div.container").children(".photo").off("mouseleave");!P.isMobile*r.children("div.container").children("canvas.corners").off("click");$dark_layer1.remove();$dark_layer2.remove();$closeX.remove();$caption.remove();D.remove()}return R()}e.fn.loaded=function(t,n,r){var i=this.length;if(i>0){return this.each(function(){var r=this,s=e(r),o="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";s.on("load.dt",function(r){e(this).off("load.dt");if(typeof t=="function"){t.call(this)}if(--i<=0&&typeof n=="function"){n.call(this)}});if(!r.complete||r.complete===undefined){r.src=r.src}else{s.trigger("load.dt")}})}else if(r){if(typeof n=="function"){n.call(this)}return this}}})

 /***************************************************************************************/
 
 
/* !Sandbox */

/*
 * Pixastic - JavaScript Image Processing Library
 * Copyright (c) 2008 Jacob Seidelin, jseidelin@nihilogic.dk, http://blog.nihilogic.dk/
 * MIT License [http://www.pixastic.com/lib/license.txt]
 */


var Pixastic=(function(){function addEvent(el,event,handler){if(el.addEventListener)
el.addEventListener(event,handler,false);else if(el.attachEvent)
el.attachEvent("on"+event,handler);}
function onready(handler){var handlerDone=false;var execHandler=function(){if(!handlerDone){handlerDone=true;handler();}}
document.write("<"+"script defer src=\"//:\" id=\"__onload_ie_pixastic__\"></"+"script>");var script=document.getElementById("__onload_ie_pixastic__");script.onreadystatechange=function(){if(script.readyState=="complete"){script.parentNode.removeChild(script);execHandler();}}
if(document.addEventListener)
document.addEventListener("DOMContentLoaded",execHandler,false);addEvent(window,"load",execHandler);}
function init(){var imgEls=getElementsByClass("pixastic",null,"img");var canvasEls=getElementsByClass("pixastic",null,"canvas");var elements=imgEls.concat(canvasEls);for(var i=0;i<elements.length;i++){(function(){var el=elements[i];var actions=[];var classes=el.className.split(" ");for(var c=0;c<classes.length;c++){var cls=classes[c];if(cls.substring(0,9)=="pixastic-"){var actionName=cls.substring(9);if(actionName!="")
actions.push(actionName);}}
if(actions.length){if(el.tagName.toLowerCase()=="img"){var dataImg=new Image();dataImg.src=el.src;if(dataImg.complete){for(var a=0;a<actions.length;a++){var res=Pixastic.applyAction(el,el,actions[a],null);if(res)
el=res;}}else{dataImg.onload=function(){for(var a=0;a<actions.length;a++){var res=Pixastic.applyAction(el,el,actions[a],null)
if(res)
el=res;}}}}else{setTimeout(function(){for(var a=0;a<actions.length;a++){var res=Pixastic.applyAction(el,el,actions[a],null);if(res)
el=res;}},1);}}})();}}
if(typeof pixastic_parseonload!="undefined"&&pixastic_parseonload)
onready(init);function getElementsByClass(searchClass,node,tag){var classElements=new Array();if(node==null)
node=document;if(tag==null)
tag='*';var els=node.getElementsByTagName(tag);var elsLen=els.length;var pattern=new RegExp("(^|\\s)"+searchClass+"(\\s|$)");for(i=0,j=0;i<elsLen;i++){if(pattern.test(els[i].className)){classElements[j]=els[i];j++;}}
return classElements;}
var debugElement;function writeDebug(text,level){if(!Pixastic.debug)return;try{switch(level){case"warn":console.warn("Pixastic:",text);break;case"error":console.error("Pixastic:",text);break;default:console.log("Pixastic:",text);}}catch(e){}
if(!debugElement){}}
var hasCanvas=(function(){var c=document.createElement("canvas");var val=false;try{val=!!((typeof c.getContext=="function")&&c.getContext("2d"));}catch(e){}
return function(){return val;}})();var hasCanvasImageData=(function(){var c=document.createElement("canvas");var val=false;var ctx;try{if(typeof c.getContext=="function"&&(ctx=c.getContext("2d"))){val=(typeof ctx.getImageData=="function");}}catch(e){}
return function(){return val;}})();var hasGlobalAlpha=(function(){var hasAlpha=false;var red=document.createElement("canvas");if(hasCanvas()&&hasCanvasImageData()){red.width=red.height=1;var redctx=red.getContext("2d");redctx.fillStyle="rgb(255,0,0)";redctx.fillRect(0,0,1,1);var blue=document.createElement("canvas");blue.width=blue.height=1;var bluectx=blue.getContext("2d");bluectx.fillStyle="rgb(0,0,255)";bluectx.fillRect(0,0,1,1);redctx.globalAlpha=0.5;redctx.drawImage(blue,0,0);var reddata=redctx.getImageData(0,0,1,1).data;hasAlpha=(reddata[2]!=255);}
return function(){return hasAlpha;}})();return{parseOnLoad:false,debug:false,applyAction:function(img,dataImg,actionName,options){options=options||{};var imageIsCanvas=(img.tagName.toLowerCase()=="canvas");if(imageIsCanvas&&Pixastic.Client.isIE()){if(Pixastic.debug)writeDebug("Tried to process a canvas element but browser is IE.");return false;}
var canvas,ctx;var hasOutputCanvas=false;if(Pixastic.Client.hasCanvas()){hasOutputCanvas=!!options.resultCanvas;canvas=options.resultCanvas||document.createElement("canvas");ctx=canvas.getContext("2d");}
var w=img.offsetWidth;var h=img.offsetHeight;if(imageIsCanvas){w=img.width;h=img.height;}
if(w==0||h==0){if(img.parentNode==null){var oldpos=img.style.position;var oldleft=img.style.left;img.style.position="absolute";img.style.left="-9999px";document.body.appendChild(img);w=img.offsetWidth;h=img.offsetHeight;document.body.removeChild(img);img.style.position=oldpos;img.style.left=oldleft;}else{if(Pixastic.debug)writeDebug("Image has 0 width and/or height.");return;}}
if(actionName.indexOf("(")>-1){var tmp=actionName;actionName=tmp.substr(0,tmp.indexOf("("));var arg=tmp.match(/\((.*?)\)/);if(arg[1]){arg=arg[1].split(";");for(var a=0;a<arg.length;a++){thisArg=arg[a].split("=");if(thisArg.length==2){if(thisArg[0]=="rect"){var rectVal=thisArg[1].split(",");options[thisArg[0]]={left:parseInt(rectVal[0],10)||0,top:parseInt(rectVal[1],10)||0,width:parseInt(rectVal[2],10)||0,height:parseInt(rectVal[3],10)||0}}else{options[thisArg[0]]=thisArg[1];}}}}}
if(!options.rect){options.rect={left:0,top:0,width:w,height:h};}else{options.rect.left=Math.round(options.rect.left);options.rect.top=Math.round(options.rect.top);options.rect.width=Math.round(options.rect.width);options.rect.height=Math.round(options.rect.height);}
var validAction=false;if(Pixastic.Actions[actionName]&&typeof Pixastic.Actions[actionName].process=="function"){validAction=true;}
if(!validAction){if(Pixastic.debug)writeDebug("Invalid action \""+actionName+"\". Maybe file not included?");return false;}
if(!Pixastic.Actions[actionName].checkSupport()){if(Pixastic.debug)writeDebug("Action \""+actionName+"\" not supported by this browser.");return false;}
if(Pixastic.Client.hasCanvas()){if(canvas!==img){canvas.width=w;canvas.height=h;}
if(!hasOutputCanvas){canvas.style.width=w+"px";canvas.style.height=h+"px";}
ctx.drawImage(dataImg,0,0,w,h);if(!img.__pixastic_org_image){canvas.__pixastic_org_image=img;canvas.__pixastic_org_width=w;canvas.__pixastic_org_height=h;}else{canvas.__pixastic_org_image=img.__pixastic_org_image;canvas.__pixastic_org_width=img.__pixastic_org_width;canvas.__pixastic_org_height=img.__pixastic_org_height;}}else if(Pixastic.Client.isIE()&&typeof img.__pixastic_org_style=="undefined"){img.__pixastic_org_style=img.style.cssText;}
var params={image:img,canvas:canvas,width:w,height:h,useData:true,options:options}
var res=Pixastic.Actions[actionName].process(params);if(!res){return false;}
if(Pixastic.Client.hasCanvas()){if(params.useData){if(Pixastic.Client.hasCanvasImageData()){canvas.getContext("2d").putImageData(params.canvasData,options.rect.left,options.rect.top);canvas.getContext("2d").fillRect(0,0,0,0);}}
if(!options.leaveDOM){canvas.title=img.title;canvas.imgsrc=img.imgsrc;if(!imageIsCanvas)canvas.alt=img.alt;if(!imageIsCanvas)canvas.imgsrc=img.src;canvas.className=img.className;canvas.style.cssText=img.style.cssText;canvas.name=img.name;canvas.tabIndex=img.tabIndex;canvas.id=img.id;if(img.parentNode&&img.parentNode.replaceChild){img.parentNode.replaceChild(canvas,img);}}
options.resultCanvas=canvas;return canvas;}
return img;},prepareData:function(params,getCopy){var ctx=params.canvas.getContext("2d");var rect=params.options.rect;var dataDesc=ctx.getImageData(rect.left,rect.top,rect.width,rect.height);var data=dataDesc.data;if(!getCopy)params.canvasData=dataDesc;return data;},process:function(img,actionName,options,callback){if(img.tagName.toLowerCase()=="img"){var dataImg=new Image();dataImg.src=img.src;if(dataImg.complete){var res=Pixastic.applyAction(img,dataImg,actionName,options);if(callback)callback(res);return res;}else{dataImg.onload=function(){var res=Pixastic.applyAction(img,dataImg,actionName,options)
if(callback)callback(res);}}}
if(img.tagName.toLowerCase()=="canvas"){var res=Pixastic.applyAction(img,img,actionName,options);if(callback)callback(res);return res;}},revert:function(img){if(Pixastic.Client.hasCanvas()){if(img.tagName.toLowerCase()=="canvas"&&img.__pixastic_org_image){img.width=img.__pixastic_org_width;img.height=img.__pixastic_org_height;img.getContext("2d").drawImage(img.__pixastic_org_image,0,0);if(img.parentNode&&img.parentNode.replaceChild){img.parentNode.replaceChild(img.__pixastic_org_image,img);}
return img;}}else if(Pixastic.Client.isIE()){if(typeof img.__pixastic_org_style!="undefined")
img.style.cssText=img.__pixastic_org_style;}},Client:{hasCanvas:hasCanvas,hasCanvasImageData:hasCanvasImageData,hasGlobalAlpha:hasGlobalAlpha,isIE:function(){return!!document.all&&!!window.attachEvent&&!window.opera;}},Actions:{}}})();Pixastic.Actions.blurfast={process:function(params){var amount=parseFloat(params.options.amount)||0;var clear=!!(params.options.clear&&params.options.clear!="false");amount=Math.max(0,Math.min(5,amount));if(Pixastic.Client.hasCanvas()){var rect=params.options.rect;var ctx=params.canvas.getContext("2d");ctx.save();ctx.beginPath();ctx.rect(rect.left,rect.top,rect.width,rect.height);ctx.clip();var scale=2;var smallWidth=Math.round(params.width/scale);var smallHeight=Math.round(params.height/scale);var copy=document.createElement("canvas");copy.width=smallWidth;copy.height=smallHeight;var clear=false;var steps=Math.round(amount*20);var copyCtx=copy.getContext("2d");for(var i=0;i<steps;i++){var scaledWidth=Math.max(1,Math.round(smallWidth-i));var scaledHeight=Math.max(1,Math.round(smallHeight-i));copyCtx.clearRect(0,0,smallWidth,smallHeight);copyCtx.drawImage(params.canvas,0,0,params.width,params.height,0,0,scaledWidth,scaledHeight);if(clear)
ctx.clearRect(rect.left,rect.top,rect.width,rect.height);ctx.drawImage(copy,0,0,scaledWidth,scaledHeight,0,0,params.width,params.height);}
ctx.restore();params.useData=false;return true;}else if(Pixastic.Client.isIE()){var radius=10*amount;params.image.style.filter+=" progid:DXImageTransform.Microsoft.Blur(pixelradius="+radius+")";if(params.options.fixMargin||1){params.image.style.marginLeft=(parseInt(params.image.style.marginLeft,10)||0)-Math.round(radius)+"px";params.image.style.marginTop=(parseInt(params.image.style.marginTop,10)||0)-Math.round(radius)+"px";}
return true;}},checkSupport:function(){return(Pixastic.Client.hasCanvas()||Pixastic.Client.isIE());}}

 /***************************************************************************************/

/*!
 * jquery.customSelect() - v0.4.1
 * http://adam.co/lab/jquery/customselect/
 * 2013-05-13
 *
 * Copyright 2013 Adam Coulombe
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @license http://www.gnu.org/licenses/gpl.html GPL2 License
 */
jQuery(document).ready(function(a) {a.fn.extend({customSelect:function(c){if(typeof document.body.style.maxHeight==="undefined"){return this}var e={customClass:"customSelect",mapClass:true,mapStyle:true},c=a.extend(e,c),d=c.customClass,f=function(h,k){var g=h.find(":selected"),j=k.children(":first"),i=g.html()||"&nbsp;";j.html(i);if(g.attr("disabled")){k.addClass(b("DisabledOption"))}else{k.removeClass(b("DisabledOption"))}setTimeout(function(){k.removeClass(b("Open"));a(document).off("mouseup."+b("Open"))},60)},b=function(g){return d+g};return this.each(function(){var g=a(this),i=a("<span />").addClass(b("Inner")),h=a("<span />");g.after(h.append(i));h.addClass(d);if(c.mapClass){h.addClass(g.attr("class"))}if(c.mapStyle){h.attr("style",g.attr("style"))}g.addClass("hasCustomSelect").on("update",function(){f(g,h);var k=parseInt(g.outerWidth(),10)-(parseInt(h.outerWidth(),10)-parseInt(h.width(),10));h.css({display:"inline-block"});var j=h.outerHeight();if(g.attr("disabled")){h.addClass(b("Disabled"))}else{h.removeClass(b("Disabled"))}i.css({width:k,display:"inline-block"});g.css({"-webkit-appearance":"menulist-button",width:h.outerWidth(),position:"absolute",opacity:0,height:j,fontSize:h.css("font-size")})}).on("change",function(){h.addClass(b("Changed"));f(g,h)}).on("keyup",function(j){if(!h.hasClass(b("Open"))){g.blur();g.focus()}else{if(j.which==13||j.which==27){f(g,h)}}}).on("mousedown",function(j){h.removeClass(b("Changed"))}).on("mouseup",function(j){if(!h.hasClass(b("Open"))){if(a("."+b("Open")).not(h).length>0&&typeof InstallTrigger!=="undefined"){g.focus()}else{h.addClass(b("Open"));j.stopPropagation();a(document).one("mouseup."+b("Open"),function(k){if(k.target!=g.get(0)&&a.inArray(k.target,g.find("*").get())<0){g.blur()}else{f(g,h)}})}}}).focus(function(){h.removeClass(b("Changed")).addClass(b("Focus"))}).blur(function(){h.removeClass(b("Focus")+" "+b("Open"))}).hover(function(){h.addClass(b("Hover"))},function(){h.removeClass(b("Hover"))}).trigger("update")})}})});

 /***************************************************************************************/

/*! Magnific Popup - v0.9.9 - 2014-09-06
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2014 Dmitry Semenov; */
;(function($) {

	/*>>core*/
	/**
	 * 
	 * Magnific Popup Core JS file
	 * 
	 */

	/**
	 * Private static constants
	 */
	var CLOSE_EVENT = 'Close',
		BEFORE_CLOSE_EVENT = 'BeforeClose',
		AFTER_CLOSE_EVENT = 'AfterClose',
		BEFORE_APPEND_EVENT = 'BeforeAppend',
		MARKUP_PARSE_EVENT = 'MarkupParse',
		OPEN_EVENT = 'Open',
		CHANGE_EVENT = 'Change',
		NS = 'mfp',
		EVENT_NS = '.' + NS,
		READY_CLASS = 'mfp-ready',
		REMOVING_CLASS = 'mfp-removing',
		PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


	/**
	 * Private vars 
	 */
	var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
		MagnificPopup = function(){},
		_isJQ = !!(window.jQuery),
		_prevStatus,
		_window = $(window),
		_body,
		_document,
		_prevContentType,
		_wrapClasses,
		_currPopupType;


	/**
	 * Private functions
	 */
	var _mfpOn = function(name, f) {
			mfp.ev.on(NS + name + EVENT_NS, f);
		},
		_getEl = function(className, appendTo, html, raw) {
			var el = document.createElement('div');
			el.className = 'mfp-'+className;
			if(html) {
				el.innerHTML = html;
			}
			if(!raw) {
				el = $(el);
				if(appendTo) {
					el.appendTo(appendTo);
				}
			} else if(appendTo) {
				appendTo.appendChild(el);
			}
			return el;
		},
		_mfpTrigger = function(e, data) {
			mfp.ev.triggerHandler(NS + e, data);

			if(mfp.st.callbacks) {
				// converts "mfpEventName" to "eventName" callback and triggers it if it's present
				e = e.charAt(0).toLowerCase() + e.slice(1);
				if(mfp.st.callbacks[e]) {
					mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
				}
			}
		},
		_getCloseBtn = function(type) {
			if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
				mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
				_currPopupType = type;
			}
			return mfp.currTemplate.closeBtn;
		},
		// Initialize Magnific Popup only when called at least once
		_checkInstance = function() {
			if(!$.magnificPopup.instance) {
				mfp = new MagnificPopup();
				mfp.init();
				$.magnificPopup.instance = mfp;
			}
		},
		// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
		supportsTransitions = function() {
			var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
				v = ['ms','O','Moz','Webkit']; // 'v' for vendor

			if( s['transition'] !== undefined ) {
				return true; 
			}
				
			while( v.length ) {
				if( v.pop() + 'Transition' in s ) {
					return true;
				}
			}
					
			return false;
		};



	/**
	 * Public functions
	 */
	MagnificPopup.prototype = {

		constructor: MagnificPopup,

		/**
		 * Initializes Magnific Popup plugin. 
		 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
		 */
		init: function() {
			var appVersion = navigator.appVersion;
			mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1; 
			mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
			mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
			mfp.isAndroid = (/android/gi).test(appVersion);
			mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
			mfp.supportsTransition = supportsTransitions();

			// We disable fixed positioned lightbox on devices that don't handle it nicely.
			// If you know a better way of detecting this - let me know.
			mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
			_document = $(document);

			mfp.popupsCache = {};
		},

		/**
		 * Opens popup
		 * @param  data [description]
		 */
		open: function(data) {

			if(!_body) {
				_body = $(document.body);
			}

			var i;

			if(data.isObj === false) { 
				// convert jQuery collection to array to avoid conflicts later
				mfp.items = data.items.toArray();

				mfp.index = 0;
				var items = data.items,
					item;
				for(i = 0; i < items.length; i++) {
					item = items[i];
					if(item.parsed) {
						item = item.el[0];
					}
					if(item === data.el[0]) {
						mfp.index = i;
						break;
					}
				}
			} else {
				mfp.items = $.isArray(data.items) ? data.items : [data.items];
				mfp.index = data.index || 0;
			}

			// if popup is already opened - we just update the content
			if(mfp.isOpen) {
				mfp.updateItemHTML();
				return;
			}
			
			mfp.types = []; 
			_wrapClasses = '';
			if(data.mainEl && data.mainEl.length) {
				mfp.ev = data.mainEl.eq(0);
			} else {
				mfp.ev = _document;
			}

			if(data.key) {
				if(!mfp.popupsCache[data.key]) {
					mfp.popupsCache[data.key] = {};
				}
				mfp.currTemplate = mfp.popupsCache[data.key];
			} else {
				mfp.currTemplate = {};
			}



			mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
			mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

			if(mfp.st.modal) {
				mfp.st.closeOnContentClick = false;
				mfp.st.closeOnBgClick = false;
				mfp.st.showCloseBtn = false;
				mfp.st.enableEscapeKey = false;
			}
			

			// Building markup
			// main containers are created only once
			if(!mfp.bgOverlay) {

				// Dark overlay
				mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
					mfp.close();
				});

				mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
					if(mfp._checkIfClose(e.target)) {
						mfp.close();
					}
				});

				mfp.container = _getEl('container', mfp.wrap);
			}

			mfp.contentContainer = _getEl('content');
			if(mfp.st.preloader) {
				mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
			}


			// Initializing modules
			var modules = $.magnificPopup.modules;
			for(i = 0; i < modules.length; i++) {
				var n = modules[i];
				n = n.charAt(0).toUpperCase() + n.slice(1);
				mfp['init'+n].call(mfp);
			}
			_mfpTrigger('BeforeOpen');


			if(mfp.st.showCloseBtn) {
				// Close button
				if(!mfp.st.closeBtnInside) {
					mfp.wrap.append( _getCloseBtn() );
				} else {
					_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
						values.close_replaceWith = _getCloseBtn(item.type);
					});
					_wrapClasses += ' mfp-close-btn-in';
				}
			}

			if(mfp.st.alignTop) {
				_wrapClasses += ' mfp-align-top';
			}

		

			if(mfp.fixedContentPos) {
				mfp.wrap.css({
					overflow: mfp.st.overflowY,
					overflowX: 'hidden',
					overflowY: mfp.st.overflowY
				});
			} else {
				mfp.wrap.css({ 
					top: _window.scrollTop(),
					position: 'absolute'
				});
			}
			if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
				mfp.bgOverlay.css({
					height: _document.height(),
					position: 'absolute'
				});
			}

			

			if(mfp.st.enableEscapeKey) {
				// Close on ESC key
				_document.on('keyup' + EVENT_NS, function(e) {
					if(e.keyCode === 27) {
						mfp.close();
					}
				});
			}

			_window.on('resize' + EVENT_NS, function() {
				mfp.updateSize();
			});


			if(!mfp.st.closeOnContentClick) {
				_wrapClasses += ' mfp-auto-cursor';
			}
			
			if(_wrapClasses)
				mfp.wrap.addClass(_wrapClasses);


			// this triggers recalculation of layout, so we get it once to not to trigger twice
			var windowHeight = mfp.wH = _window.height();

			
			var windowStyles = {};

			if( mfp.fixedContentPos ) {
	            if(mfp._hasScrollBar(windowHeight)){
	                var s = mfp._getScrollbarSize();
	                if(s) {
	                    windowStyles.marginRight = s;
	                }
	            }
	        }

			if(mfp.fixedContentPos) {
				if(!mfp.isIE7) {
					windowStyles.overflow = 'hidden';
				} else {
					// ie7 double-scroll bug
					$('body, html').css('overflow', 'hidden');
				}
			}

			
			
			var classesToadd = mfp.st.mainClass;
			if(mfp.isIE7) {
				classesToadd += ' mfp-ie7';
			}
			if(classesToadd) {
				mfp._addClassToMFP( classesToadd );
			}

			// add content
			mfp.updateItemHTML();

			_mfpTrigger('BuildControls');

			// remove scrollbar, add margin e.t.c
			$('html').css(windowStyles);
			
			// add everything to DOM
			mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || _body );

			// Save last focused element
			mfp._lastFocusedEl = document.activeElement;
			
			// Wait for next cycle to allow CSS transition
			setTimeout(function() {
				
				if(mfp.content) {
					mfp._addClassToMFP(READY_CLASS);
					mfp._setFocus();
				} else {
					// if content is not defined (not loaded e.t.c) we add class only for BG
					mfp.bgOverlay.addClass(READY_CLASS);
				}
				
				// Trap the focus in popup
				_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

			}, 16);

			mfp.isOpen = true;
			mfp.updateSize(windowHeight);
			_mfpTrigger(OPEN_EVENT);

			return data;
		},

		/**
		 * Closes the popup
		 */
		close: function() {
			if(!mfp.isOpen) return;
			_mfpTrigger(BEFORE_CLOSE_EVENT);

			mfp.isOpen = false;
			// for CSS3 animation
			if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
				mfp._addClassToMFP(REMOVING_CLASS);
				setTimeout(function() {
					mfp._close();
				}, mfp.st.removalDelay);
			} else {
				mfp._close();
			}
		},

		/**
		 * Helper for close() function
		 */
		_close: function() {
			_mfpTrigger(CLOSE_EVENT);

			var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

			mfp.bgOverlay.detach();
			mfp.wrap.detach();
			mfp.container.empty();

			if(mfp.st.mainClass) {
				classesToRemove += mfp.st.mainClass + ' ';
			}

			mfp._removeClassFromMFP(classesToRemove);

			if(mfp.fixedContentPos) {
				var windowStyles = {marginRight: ''};
				if(mfp.isIE7) {
					$('body, html').css('overflow', '');
				} else {
					windowStyles.overflow = '';
				}
				$('html').css(windowStyles);
			}
			
			_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
			mfp.ev.off(EVENT_NS);

			// clean up DOM elements that aren't removed
			mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
			mfp.bgOverlay.attr('class', 'mfp-bg');
			mfp.container.attr('class', 'mfp-container');

			// remove close button from target element
			if(mfp.st.showCloseBtn &&
			(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
				if(mfp.currTemplate.closeBtn)
					mfp.currTemplate.closeBtn.detach();
			}


			if(mfp._lastFocusedEl) {
				$(mfp._lastFocusedEl).focus(); // put tab focus back
			}
			mfp.currItem = null;	
			mfp.content = null;
			mfp.currTemplate = null;
			mfp.prevHeight = 0;

			_mfpTrigger(AFTER_CLOSE_EVENT);
		},
		
		updateSize: function(winHeight) {

			if(mfp.isIOS) {
				// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
				var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
				var height = window.innerHeight * zoomLevel;
				mfp.wrap.css('height', height);
				mfp.wH = height;
			} else {
				mfp.wH = winHeight || _window.height();
			}
			// Fixes #84: popup incorrectly positioned with position:relative on body
			if(!mfp.fixedContentPos) {
				mfp.wrap.css('height', mfp.wH);
			}

			_mfpTrigger('Resize');

		},

		/**
		 * Set content of popup based on current index
		 */
		updateItemHTML: function() {
			var item = mfp.items[mfp.index];

			// Detach and perform modifications
			mfp.contentContainer.detach();

			if(mfp.content)
				mfp.content.detach();

			if(!item.parsed) {
				item = mfp.parseEl( mfp.index );
			}

			var type = item.type;	

			_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
			// BeforeChange event works like so:
			// _mfpOn('BeforeChange', function(e, prevType, newType) { });
			
			mfp.currItem = item;

			if(!mfp.currTemplate[type]) {
				var markup = mfp.st[type] ? mfp.st[type].markup : false;

				// allows to modify markup
				_mfpTrigger('FirstMarkupParse', markup);

				if(markup) {
					mfp.currTemplate[type] = $(markup);
				} else {
					// if there is no markup found we just define that template is parsed
					mfp.currTemplate[type] = true;
				}
			}

			if(_prevContentType && _prevContentType !== item.type) {
				mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
			}
			
			var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
			mfp.appendContent(newContent, type);

			item.preloaded = true;

			_mfpTrigger(CHANGE_EVENT, item);
			_prevContentType = item.type;
			
			// Append container back after its content changed
			mfp.container.prepend(mfp.contentContainer);

			_mfpTrigger('AfterChange');
		},


		/**
		 * Set HTML content of popup
		 */
		appendContent: function(newContent, type) {
			mfp.content = newContent;
			
			if(newContent) {
				if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
					mfp.currTemplate[type] === true) {
					// if there is no markup, we just append close button element inside
					if(!mfp.content.find('.mfp-close').length) {
						mfp.content.append(_getCloseBtn());
					}
				} else {
					mfp.content = newContent;
				}
			} else {
				mfp.content = '';
			}

			_mfpTrigger(BEFORE_APPEND_EVENT);
			mfp.container.addClass('mfp-'+type+'-holder');

			mfp.contentContainer.append(mfp.content);
		},
		/**
		 * Creates Magnific Popup data object based on given data
		 * @param  {int} index Index of item to parse
		 */
		parseEl: function(index) {
			var item = mfp.items[index],
				type;

			if(item.tagName) {
				item = { el: $(item) };
			} else {
				type = item.type;
				item = { data: item, src: item.src };
			}

			if(item.el) {
				var types = mfp.types;

				// check for 'mfp-TYPE' class
				for(var i = 0; i < types.length; i++) {
					if( item.el.hasClass('mfp-'+types[i]) ) {
						type = types[i];
						break;
					}
				}

				item.src = item.el.attr('data-mfp-src');
				if(!item.src) {
					item.src = item.el.attr('href');
				}
			}

			item.type = type || mfp.st.type || 'inline';
			item.index = index;
			item.parsed = true;
			mfp.items[index] = item;
			_mfpTrigger('ElementParse', item);

			return mfp.items[index];
		},


		/**
		 * Initializes single popup or a group of popups
		 */
		addGroup: function(el, options) {
			var eHandler = function(e) {
				e.mfpEl = this;
				mfp._openClick(e, el, options);
			};

			if(!options) {
				options = {};
			} 

			var eName = 'click.magnificPopup';
			options.mainEl = el;
			
			if(options.items) {
				options.isObj = true;
				el.off(eName).on(eName, eHandler);
			} else {
				options.isObj = false;
				if(options.delegate) {
					el.off(eName).on(eName, options.delegate , eHandler);
				} else {
					options.items = el;
					el.off(eName).on(eName, eHandler);
				}
			}
		},
		_openClick: function(e, el, options) {
			var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


			if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey ) ) {
				return;
			}

			var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

			if(disableOn) {
				if($.isFunction(disableOn)) {
					if( !disableOn.call(mfp) ) {
						return true;
					}
				} else { // else it's number
					if( _window.width() < disableOn ) {
						return true;
					}
				}
			}
			
			if(e.type) {
				e.preventDefault();

				// This will prevent popup from closing if element is inside and popup is already opened
				if(mfp.isOpen) {
					e.stopPropagation();
				}
			}
				

			options.el = $(e.mfpEl);
			if(options.delegate) {
				options.items = el.find(options.delegate);
			}
			mfp.open(options);
		},


		/**
		 * Updates text on preloader
		 */
		updateStatus: function(status, text) {

			if(mfp.preloader) {
				if(_prevStatus !== status) {
					mfp.container.removeClass('mfp-s-'+_prevStatus);
				}

				if(!text && status === 'loading') {
					text = mfp.st.tLoading;
				}

				var data = {
					status: status,
					text: text
				};
				// allows to modify status
				_mfpTrigger('UpdateStatus', data);

				status = data.status;
				text = data.text;

				mfp.preloader.html(text);

				mfp.preloader.find('a').on('click', function(e) {
					e.stopImmediatePropagation();
				});

				mfp.container.addClass('mfp-s-'+status);
				_prevStatus = status;
			}
		},


		/*
			"Private" helpers that aren't private at all
		 */
		// Check to close popup or not
		// "target" is an element that was clicked
		_checkIfClose: function(target) {

			if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
				return;
			}

			var closeOnContent = mfp.st.closeOnContentClick;
			var closeOnBg = mfp.st.closeOnBgClick;

			if(closeOnContent && closeOnBg) {
				return true;
			} else {

				// We close the popup if click is on close button or on preloader. Or if there is no content.
				if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
					return true;
				}

				// if click is outside the content
				if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
					if(closeOnBg) {
						// last check, if the clicked element is in DOM, (in case it's removed onclick)
						if( $.contains(document, target) ) {
							return true;
						}
					}
				} else if(closeOnContent) {
					return true;
				}

			}
			return false;
		},
		_addClassToMFP: function(cName) {
			mfp.bgOverlay.addClass(cName);
			mfp.wrap.addClass(cName);
		},
		_removeClassFromMFP: function(cName) {
			this.bgOverlay.removeClass(cName);
			mfp.wrap.removeClass(cName);
		},
		_hasScrollBar: function(winHeight) {
			return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
		},
		_setFocus: function() {
			(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
		},
		_onFocusIn: function(e) {
			if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
				mfp._setFocus();
				return false;
			}
		},
		_parseMarkup: function(template, values, item) {
			var arr;
			if(item.data) {
				values = $.extend(item.data, values);
			}
			_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

			$.each(values, function(key, value) {
				if(value === undefined || value === false) {
					return true;
				}
				arr = key.split('_');
				if(arr.length > 1) {
					var el = template.find(EVENT_NS + '-'+arr[0]);

					if(el.length > 0) {
						var attr = arr[1];
						if(attr === 'replaceWith') {
							if(el[0] !== value[0]) {
								el.replaceWith(value);
							}
						} else if(attr === 'img') {
							if(el.is('img')) {
								el.attr('src', value);
							} else {
								el.replaceWith( '<img src="'+value+'" class="' + el.attr('class') + '" />' );
							}
						} else {
							el.attr(arr[1], value);
						}
					}

				} else {
					template.find(EVENT_NS + '-'+key).html(value);
				}
			});
		},

		_getScrollbarSize: function() {
			// thx David
			if(mfp.scrollbarSize === undefined) {
				var scrollDiv = document.createElement("div");
				scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
				document.body.appendChild(scrollDiv);
				mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
				document.body.removeChild(scrollDiv);
			}
			return mfp.scrollbarSize;
		}

	}; /* MagnificPopup core prototype end */




	/**
	 * Public static functions
	 */
	$.magnificPopup = {
		instance: null,
		proto: MagnificPopup.prototype,
		modules: [],

		open: function(options, index) {
			_checkInstance();	

			if(!options) {
				options = {};
			} else {
				options = $.extend(true, {}, options);
			}
				

			options.isObj = true;
			options.index = index || 0;
			return this.instance.open(options);
		},

		close: function() {
			return $.magnificPopup.instance && $.magnificPopup.instance.close();
		},

		registerModule: function(name, module) {
			if(module.options) {
				$.magnificPopup.defaults[name] = module.options;
			}
			$.extend(this.proto, module.proto);			
			this.modules.push(name);
		},

		defaults: {   

			// Info about options is in docs:
			// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options
			
			disableOn: 0,	

			key: null,

			midClick: false,

			mainClass: '',

			preloader: true,

			focus: '', // CSS selector of input to focus after popup is opened
			
			closeOnContentClick: false,

			closeOnBgClick: true,

			closeBtnInside: true, 

			showCloseBtn: true,

			enableEscapeKey: true,

			modal: false,

			alignTop: false,
		
			removalDelay: 0,

			prependTo: null,
			
			fixedContentPos: 'auto', 
		
			fixedBgPos: 'auto',

			overflowY: 'auto',

			closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>',

			tClose: 'Close (Esc)',

			tLoading: 'Loading...'

		}
	};



	$.fn.magnificPopup = function(options) {
		_checkInstance();

		var jqEl = $(this);

		// We call some API method of first param is a string
		if (typeof options === "string" ) {

			if(options === 'open') {
				var items,
					itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
					index = parseInt(arguments[1], 10) || 0;

				if(itemOpts.items) {
					items = itemOpts.items[index];
				} else {
					items = jqEl;
					if(itemOpts.delegate) {
						items = items.find(itemOpts.delegate);
					}
					items = items.eq( index );
				}
				mfp._openClick({mfpEl:items}, jqEl, itemOpts);
			} else {
				if(mfp.isOpen)
					mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
			}

		} else {
			// clone options obj
			options = $.extend(true, {}, options);
			
			/*
			 * As Zepto doesn't support .data() method for objects 
			 * and it works only in normal browsers
			 * we assign "options" object directly to the DOM element. FTW!
			 */
			if(_isJQ) {
				jqEl.data('magnificPopup', options);
			} else {
				jqEl[0].magnificPopup = options;
			}

			mfp.addGroup(jqEl, options);

		}
		return jqEl;
	};


	//Quick benchmark
	/*
	var start = performance.now(),
		i,
		rounds = 1000;

	for(i = 0; i < rounds; i++) {

	}
	console.log('Test #1:', performance.now() - start);

	start = performance.now();
	for(i = 0; i < rounds; i++) {

	}
	console.log('Test #2:', performance.now() - start);
	*/


	/*>>core*/

	/*>>inline*/

	var INLINE_NS = 'inline',
		_hiddenClass,
		_inlinePlaceholder, 
		_lastInlineElement,
		_putInlineElementsBack = function() {
			if(_lastInlineElement) {
				_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
				_lastInlineElement = null;
			}
		};

	$.magnificPopup.registerModule(INLINE_NS, {
		options: {
			hiddenClass: 'hide', // will be appended with `mfp-` prefix
			markup: '',
			tNotFound: 'Content not found'
		},
		proto: {

			initInline: function() {
				mfp.types.push(INLINE_NS);

				_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
					_putInlineElementsBack();
				});
			},

			getInline: function(item, template) {

				_putInlineElementsBack();

				if(item.src) {
					var inlineSt = mfp.st.inline,
						el = $(item.src);

					if(el.length) {

						// If target element has parent - we replace it with placeholder and put it back after popup is closed
						var parent = el[0].parentNode;
						if(parent && parent.tagName) {
							if(!_inlinePlaceholder) {
								_hiddenClass = inlineSt.hiddenClass;
								_inlinePlaceholder = _getEl(_hiddenClass);
								_hiddenClass = 'mfp-'+_hiddenClass;
							}
							// replace target inline element with placeholder
							_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
						}

						mfp.updateStatus('ready');
					} else {
						mfp.updateStatus('error', inlineSt.tNotFound);
						el = $('<div>');
					}

					item.inlineElement = el;
					return el;
				}

				mfp.updateStatus('ready');
				mfp._parseMarkup(template, {}, item);
				return template;
			}
		}
	});

	/*>>inline*/

	/*>>ajax*/
	var AJAX_NS = 'ajax',
		_ajaxCur,
		_removeAjaxCursor = function() {
			if(_ajaxCur) {
				_body.removeClass(_ajaxCur);
			}
		},
		_destroyAjaxRequest = function() {
			_removeAjaxCursor();
			if(mfp.req) {
				mfp.req.abort();
			}
		};

	$.magnificPopup.registerModule(AJAX_NS, {

		options: {
			settings: null,
			cursor: 'mfp-ajax-cur',
			tError: '<a href="%url%">The content</a> could not be loaded.'
		},

		proto: {
			initAjax: function() {
				mfp.types.push(AJAX_NS);
				_ajaxCur = mfp.st.ajax.cursor;

				_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
				_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
			},
			getAjax: function(item) {

				if(_ajaxCur)
					_body.addClass(_ajaxCur);

				mfp.updateStatus('loading');

				var opts = $.extend({
					url: item.src,
					success: function(data, textStatus, jqXHR) {
						var temp = {
							data:data,
							xhr:jqXHR
						};

						_mfpTrigger('ParseAjax', temp);

						mfp.appendContent( $(temp.data), AJAX_NS );

						item.finished = true;

						_removeAjaxCursor();

						mfp._setFocus();

						setTimeout(function() {
							mfp.wrap.addClass(READY_CLASS);
						}, 16);

						mfp.updateStatus('ready');

						_mfpTrigger('AjaxContentAdded');
					},
					error: function() {
						_removeAjaxCursor();
						item.finished = item.loadError = true;
						mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
					}
				}, mfp.st.ajax.settings);

				mfp.req = $.ajax(opts);

				return '';
			}
		}
	});


	/*>>ajax*/

	/*>>image*/
	var _imgInterval,
		_getTitle = function(item) {
			if(item.data && item.data.title !== undefined) 
				return item.data.title;

			var src = mfp.st.image.titleSrc;

			if(src) {
				if($.isFunction(src)) {
					return src.call(mfp, item);
				} else if(item.el) {
					return item.el.attr(src) || '';
				}
			}
			return '';
		};

	$.magnificPopup.registerModule('image', {

		options: {
			markup: '<div class="mfp-figure">'+
						'<div class="mfp-close"></div>'+
						'<figure>'+
							'<div class="mfp-img"></div>'+
							'<figcaption>'+
								'<div class="mfp-bottom-bar">'+
									'<div class="mfp-title"></div>'+
									'<div class="mfp-counter"></div>'+
								'</div>'+
							'</figcaption>'+
						'</figure>'+
					'</div>',
			cursor: 'mfp-zoom-out-cur',
			titleSrc: 'title', 
			verticalFit: true,
			tError: '<a href="%url%">The image</a> could not be loaded.'
		},

		proto: {
			initImage: function() {
				var imgSt = mfp.st.image,
					ns = '.image';

				mfp.types.push('image');

				_mfpOn(OPEN_EVENT+ns, function() {
					if(mfp.currItem.type === 'image' && imgSt.cursor) {
						_body.addClass(imgSt.cursor);
					}
				});

				_mfpOn(CLOSE_EVENT+ns, function() {
					if(imgSt.cursor) {
						_body.removeClass(imgSt.cursor);
					}
					_window.off('resize' + EVENT_NS);
				});

				_mfpOn('Resize'+ns, mfp.resizeImage);
				if(mfp.isLowIE) {
					_mfpOn('AfterChange', mfp.resizeImage);
				}
			},
			resizeImage: function() {
				var item = mfp.currItem;
				if(!item || !item.img) return;

				if(mfp.st.image.verticalFit) {
					var decr = 0;
					// fix box-sizing in ie7/8
					if(mfp.isLowIE) {
						decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
					}
					item.img.css('max-height', mfp.wH-decr);
				}
			},
			_onImageHasSize: function(item) {
				if(item.img) {
					
					item.hasSize = true;

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					
					item.isCheckingImgSize = false;

					_mfpTrigger('ImageHasSize', item);

					if(item.imgHidden) {
						if(mfp.content)
							mfp.content.removeClass('mfp-loading');
						
						item.imgHidden = false;
					}

				}
			},

			/**
			 * Function that loops until the image has size to display elements that rely on it asap
			 */
			findImageSize: function(item) {

				var counter = 0,
					img = item.img[0],
					mfpSetInterval = function(delay) {

						if(_imgInterval) {
							clearInterval(_imgInterval);
						}
						// decelerating interval that checks for size of an image
						_imgInterval = setInterval(function() {
							if(img.naturalWidth > 0) {
								mfp._onImageHasSize(item);
								return;
							}

							if(counter > 200) {
								clearInterval(_imgInterval);
							}

							counter++;
							if(counter === 3) {
								mfpSetInterval(10);
							} else if(counter === 40) {
								mfpSetInterval(50);
							} else if(counter === 100) {
								mfpSetInterval(500);
							}
						}, delay);
					};

				mfpSetInterval(1);
			},

			getImage: function(item, template) {

				var guard = 0,

					// image load complete handler
					onLoadComplete = function() {
						if(item) {
							if (item.img[0].complete) {
								item.img.off('.mfploader');
								
								if(item === mfp.currItem){
									mfp._onImageHasSize(item);

									mfp.updateStatus('ready');
								}

								item.hasSize = true;
								item.loaded = true;

								_mfpTrigger('ImageLoadComplete');
								
							}
							else {
								// if image complete check fails 200 times (20 sec), we assume that there was an error.
								guard++;
								if(guard < 200) {
									setTimeout(onLoadComplete,100);
								} else {
									onLoadError();
								}
							}
						}
					},

					// image error handler
					onLoadError = function() {
						if(item) {
							item.img.off('.mfploader');
							if(item === mfp.currItem){
								mfp._onImageHasSize(item);
								mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
							}

							item.hasSize = true;
							item.loaded = true;
							item.loadError = true;
						}
					},
					imgSt = mfp.st.image;


				var el = template.find('.mfp-img');
				if(el.length) {
					var img = document.createElement('img');
					img.className = 'mfp-img';
					item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
					img.src = item.src;

					// without clone() "error" event is not firing when IMG is replaced by new IMG
					// TODO: find a way to avoid such cloning
					if(el.is('img')) {
						item.img = item.img.clone();
					}

					img = item.img[0];
					if(img.naturalWidth > 0) {
						item.hasSize = true;
					} else if(!img.width) {										
						item.hasSize = false;
					}
				}

				mfp._parseMarkup(template, {
					title: _getTitle(item),
					img_replaceWith: item.img
				}, item);

				mfp.resizeImage();

				if(item.hasSize) {
					if(_imgInterval) clearInterval(_imgInterval);

					if(item.loadError) {
						template.addClass('mfp-loading');
						mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
					} else {
						template.removeClass('mfp-loading');
						mfp.updateStatus('ready');
					}
					return template;
				}

				mfp.updateStatus('loading');
				item.loading = true;

				if(!item.hasSize) {
					item.imgHidden = true;
					template.addClass('mfp-loading');
					mfp.findImageSize(item);
				} 

				return template;
			}
		}
	});



	/*>>image*/

	/*>>zoom*/
	var hasMozTransform,
		getHasMozTransform = function() {
			if(hasMozTransform === undefined) {
				hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
			}
			return hasMozTransform;		
		};

	$.magnificPopup.registerModule('zoom', {

		options: {
			enabled: false,
			easing: 'ease-in-out',
			duration: 300,
			opener: function(element) {
				return element.is('img') ? element : element.find('img');
			}
		},

		proto: {

			initZoom: function() {
				var zoomSt = mfp.st.zoom,
					ns = '.zoom',
					image;
					
				if(!zoomSt.enabled || !mfp.supportsTransition) {
					return;
				}

				var duration = zoomSt.duration,
					getElToAnimate = function(image) {
						var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
							transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
							cssObj = {
								position: 'fixed',
								zIndex: 9999,
								left: 0,
								top: 0,
								'-webkit-backface-visibility': 'hidden'
							},
							t = 'transition';

						cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

						newImg.css(cssObj);
						return newImg;
					},
					showMainContent = function() {
						mfp.content.css('visibility', 'visible');
					},
					openTimeout,
					animatedImg;

				_mfpOn('BuildControls'+ns, function() {
					if(mfp._allowZoom()) {

						clearTimeout(openTimeout);
						mfp.content.css('visibility', 'hidden');

						// Basically, all code below does is clones existing image, puts in on top of the current one and animated it
						
						image = mfp._getItemToZoom();

						if(!image) {
							showMainContent();
							return;
						}

						animatedImg = getElToAnimate(image); 
						
						animatedImg.css( mfp._getOffset() );

						mfp.wrap.append(animatedImg);

						openTimeout = setTimeout(function() {
							animatedImg.css( mfp._getOffset( true ) );
							openTimeout = setTimeout(function() {

								showMainContent();

								setTimeout(function() {
									animatedImg.remove();
									image = animatedImg = null;
									_mfpTrigger('ZoomAnimationEnded');
								}, 16); // avoid blink when switching images 

							}, duration); // this timeout equals animation duration

						}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


						// Lots of timeouts...
					}
				});
				_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
					if(mfp._allowZoom()) {

						clearTimeout(openTimeout);

						mfp.st.removalDelay = duration;

						if(!image) {
							image = mfp._getItemToZoom();
							if(!image) {
								return;
							}
							animatedImg = getElToAnimate(image);
						}
						
						
						animatedImg.css( mfp._getOffset(true) );
						mfp.wrap.append(animatedImg);
						mfp.content.css('visibility', 'hidden');
						
						setTimeout(function() {
							animatedImg.css( mfp._getOffset() );
						}, 16);
					}

				});

				_mfpOn(CLOSE_EVENT+ns, function() {
					if(mfp._allowZoom()) {
						showMainContent();
						if(animatedImg) {
							animatedImg.remove();
						}
						image = null;
					}	
				});
			},

			_allowZoom: function() {
				return mfp.currItem.type === 'image';
			},

			_getItemToZoom: function() {
				if(mfp.currItem.hasSize) {
					return mfp.currItem.img;
				} else {
					return false;
				}
			},

			// Get element postion relative to viewport
			_getOffset: function(isLarge) {
				var el;
				if(isLarge) {
					el = mfp.currItem.img;
				} else {
					el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
				}

				var offset = el.offset();
				var paddingTop = parseInt(el.css('padding-top'),10);
				var paddingBottom = parseInt(el.css('padding-bottom'),10);
				offset.top -= ( $(window).scrollTop() - paddingTop );


				/*
				
				Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

				 */
				var obj = {
					width: el.width(),
					// fix Zepto height+padding issue
					height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
				};

				// I hate to do this, but there is no another option
				if( getHasMozTransform() ) {
					obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
				} else {
					obj.left = offset.left;
					obj.top = offset.top;
				}
				return obj;
			}

		}
	});



	/*>>zoom*/

	/*>>iframe*/

	var IFRAME_NS = 'iframe',
		_emptyPage = '//about:blank',
		
		_fixIframeBugs = function(isShowing) {
			if(mfp.currTemplate[IFRAME_NS]) {
				var el = mfp.currTemplate[IFRAME_NS].find('iframe');
				if(el.length) { 
					// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
					if(!isShowing) {
						el[0].src = _emptyPage;
					}

					// IE8 black screen bug fix
					if(mfp.isIE8) {
						el.css('display', isShowing ? 'block' : 'none');
					}
				}
			}
		};

	$.magnificPopup.registerModule(IFRAME_NS, {

		options: {
			markup: '<div class="mfp-iframe-scaler">'+
						'<div class="mfp-close"></div>'+
						'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
					'</div>',

			srcAction: 'iframe_src',

			// we don't care and support only one default type of URL by default
			patterns: {
				youtube: {
					index: 'youtube.com', 
					id: 'v=', 
					src: '//www.youtube.com/embed/%id%?autoplay=1'
				},
				vimeo: {
					index: 'vimeo.com/',
					id: '/',
					src: '//player.vimeo.com/video/%id%?autoplay=1'
				},
				gmaps: {
					index: '//maps.google.',
					src: '%id%&output=embed'
				}
			}
		},

		proto: {
			initIframe: function() {
				mfp.types.push(IFRAME_NS);

				_mfpOn('BeforeChange', function(e, prevType, newType) {
					if(prevType !== newType) {
						if(prevType === IFRAME_NS) {
							_fixIframeBugs(); // iframe if removed
						} else if(newType === IFRAME_NS) {
							_fixIframeBugs(true); // iframe is showing
						} 
					}// else {
						// iframe source is switched, don't do anything
					//}
				});

				_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
					_fixIframeBugs();
				});
			},

			getIframe: function(item, template) {
				var embedSrc = item.src;
				var iframeSt = mfp.st.iframe;
					
				$.each(iframeSt.patterns, function() {
					if(embedSrc.indexOf( this.index ) > -1) {
						if(this.id) {
							if(typeof this.id === 'string') {
								embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
							} else {
								embedSrc = this.id.call( this, embedSrc );
							}
						}
						embedSrc = this.src.replace('%id%', embedSrc );
						return false; // break;
					}
				});
				
				var dataObj = {};
				if(iframeSt.srcAction) {
					dataObj[iframeSt.srcAction] = embedSrc;
				}
				mfp._parseMarkup(template, dataObj, item);

				mfp.updateStatus('ready');

				return template;
			}
		}
	});



	/*>>iframe*/

	/*>>gallery*/
	/**
	 * Get looped index depending on number of slides
	 */
	var _getLoopedId = function(index) {
			var numSlides = mfp.items.length;
			if(index > numSlides - 1) {
				return index - numSlides;
			} else  if(index < 0) {
				return numSlides + index;
			}
			return index;
		},
		_replaceCurrTotal = function(text, curr, total) {
			return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
		};

	$.magnificPopup.registerModule('gallery', {

		options: {
			enabled: false,
			arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
			preload: [0,2],
			navigateByImgClick: true,
			arrows: true,

			tPrev: 'Previous (Left arrow key)',
			tNext: 'Next (Right arrow key)',
			tCounter: '%curr% of %total%'
		},

		proto: {
			initGallery: function() {

				var gSt = mfp.st.gallery,
					ns = '.mfp-gallery',
					supportsFastClick = Boolean($.fn.mfpFastClick);

				mfp.direction = true; // true - next, false - prev
				
				if(!gSt || !gSt.enabled ) return false;

				_wrapClasses += ' mfp-gallery';

				_mfpOn(OPEN_EVENT+ns, function() {

					if(gSt.navigateByImgClick) {
						mfp.wrap.on('click'+ns, '.mfp-img', function() {
							if(mfp.items.length > 1) {
								mfp.next();
								return false;
							}
						});
					}

					_document.on('keydown'+ns, function(e) {
						if (e.keyCode === 37) {
							mfp.prev();
						} else if (e.keyCode === 39) {
							mfp.next();
						}
					});
				});

				_mfpOn('UpdateStatus'+ns, function(e, data) {
					if(data.text) {
						data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
					}
				});

				_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
					var l = mfp.items.length;
					values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
				});

				_mfpOn('BuildControls' + ns, function() {
					if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
						var markup = gSt.arrowMarkup,
							arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),			
							arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

						var eName = supportsFastClick ? 'mfpFastClick' : 'click';
						arrowLeft[eName](function() {
							mfp.prev();
						});			
						arrowRight[eName](function() {
							mfp.next();
						});	

						// Polyfill for :before and :after (adds elements with classes mfp-a and mfp-b)
						if(mfp.isIE7) {
							_getEl('b', arrowLeft[0], false, true);
							_getEl('a', arrowLeft[0], false, true);
							_getEl('b', arrowRight[0], false, true);
							_getEl('a', arrowRight[0], false, true);
						}

						mfp.container.append(arrowLeft.add(arrowRight));
					}
				});

				_mfpOn(CHANGE_EVENT+ns, function() {
					if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

					mfp._preloadTimeout = setTimeout(function() {
						mfp.preloadNearbyImages();
						mfp._preloadTimeout = null;
					}, 16);
				});


				_mfpOn(CLOSE_EVENT+ns, function() {
					_document.off(ns);
					mfp.wrap.off('click'+ns);
				
					if(mfp.arrowLeft && supportsFastClick) {
						mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick();
					}
					mfp.arrowRight = mfp.arrowLeft = null;
				});

			}, 
			next: function() {
				mfp.direction = true;
				mfp.index = _getLoopedId(mfp.index + 1);
				mfp.updateItemHTML();
			},
			prev: function() {
				mfp.direction = false;
				mfp.index = _getLoopedId(mfp.index - 1);
				mfp.updateItemHTML();
			},
			goTo: function(newIndex) {
				mfp.direction = (newIndex >= mfp.index);
				mfp.index = newIndex;
				mfp.updateItemHTML();
			},
			preloadNearbyImages: function() {
				var p = mfp.st.gallery.preload,
					preloadBefore = Math.min(p[0], mfp.items.length),
					preloadAfter = Math.min(p[1], mfp.items.length),
					i;

				for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
					mfp._preloadItem(mfp.index+i);
				}
				for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
					mfp._preloadItem(mfp.index-i);
				}
			},
			_preloadItem: function(index) {
				index = _getLoopedId(index);

				if(mfp.items[index].preloaded) {
					return;
				}

				var item = mfp.items[index];
				if(!item.parsed) {
					item = mfp.parseEl( index );
				}

				_mfpTrigger('LazyLoad', item);

				if(item.type === 'image') {
					item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
						item.hasSize = true;
					}).on('error.mfploader', function() {
						item.hasSize = true;
						item.loadError = true;
						_mfpTrigger('LazyLoadError', item);
					}).attr('src', item.src);
				}


				item.preloaded = true;
			}
		}
	});

	/*
	Touch Support that might be implemented some day

	addSwipeGesture: function() {
		var startX,
			moved,
			multipleTouches;

			return;

		var namespace = '.mfp',
			addEventNames = function(pref, down, move, up, cancel) {
				mfp._tStart = pref + down + namespace;
				mfp._tMove = pref + move + namespace;
				mfp._tEnd = pref + up + namespace;
				mfp._tCancel = pref + cancel + namespace;
			};

		if(window.navigator.msPointerEnabled) {
			addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
		} else if('ontouchstart' in window) {
			addEventNames('touch', 'start', 'move', 'end', 'cancel');
		} else {
			return;
		}
		_window.on(mfp._tStart, function(e) {
			var oE = e.originalEvent;
			multipleTouches = moved = false;
			startX = oE.pageX || oE.changedTouches[0].pageX;
		}).on(mfp._tMove, function(e) {
			if(e.originalEvent.touches.length > 1) {
				multipleTouches = e.originalEvent.touches.length;
			} else {
				//e.preventDefault();
				moved = true;
			}
		}).on(mfp._tEnd + ' ' + mfp._tCancel, function(e) {
			if(moved && !multipleTouches) {
				var oE = e.originalEvent,
					diff = startX - (oE.pageX || oE.changedTouches[0].pageX);

				if(diff > 20) {
					mfp.next();
				} else if(diff < -20) {
					mfp.prev();
				}
			}
		});
	},
	*/


	/*>>gallery*/

	/*>>retina*/

	var RETINA_NS = 'retina';

	$.magnificPopup.registerModule(RETINA_NS, {
		options: {
			replaceSrc: function(item) {
				return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
			},
			ratio: 1 // Function or number.  Set to 1 to disable.
		},
		proto: {
			initRetina: function() {
				if(window.devicePixelRatio > 1) {

					var st = mfp.st.retina,
						ratio = st.ratio;

					ratio = !isNaN(ratio) ? ratio : ratio();

					if(ratio > 1) {
						_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
							item.img.css({
								'max-width': item.img[0].naturalWidth / ratio,
								'width': '100%'
							});
						});
						_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
							item.src = st.replaceSrc(item, ratio);
						});
					}
				}

			}
		}
	});

	/*>>retina*/

	/*>>fastclick*/
	/**
	 * FastClick event implementation. (removes 300ms delay on touch devices)
	 * Based on https://developers.google.com/mobile/articles/fast_buttons
	 *
	 * You may use it outside the Magnific Popup by calling just:
	 *
	 * $('.your-el').mfpFastClick(function() {
	 *     console.log('Clicked!');
	 * });
	 *
	 * To unbind:
	 * $('.your-el').destroyMfpFastClick();
	 * 
	 * 
	 * Note that it's a very basic and simple implementation, it blocks ghost click on the same element where it was bound.
	 * If you need something more advanced, use plugin by FT Labs https://github.com/ftlabs/fastclick
	 * 
	 */

	(function() {
		var ghostClickDelay = 1000,
			supportsTouch = 'ontouchstart' in window,
			unbindTouchMove = function() {
				_window.off('touchmove'+ns+' touchend'+ns);
			},
			eName = 'mfpFastClick',
			ns = '.'+eName;


		// As Zepto.js doesn't have an easy way to add custom events (like jQuery), so we implement it in this way
		$.fn.mfpFastClick = function(callback) {

			return $(this).each(function() {

				var elem = $(this),
					lock;

				if( supportsTouch ) {

					var timeout,
						startX,
						startY,
						pointerMoved,
						point,
						numPointers;

					elem.on('touchstart' + ns, function(e) {
						pointerMoved = false;
						numPointers = 1;

						point = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0];
						startX = point.clientX;
						startY = point.clientY;

						_window.on('touchmove'+ns, function(e) {
							point = e.originalEvent ? e.originalEvent.touches : e.touches;
							numPointers = point.length;
							point = point[0];
							if (Math.abs(point.clientX - startX) > 10 ||
								Math.abs(point.clientY - startY) > 10) {
								pointerMoved = true;
								unbindTouchMove();
							}
						}).on('touchend'+ns, function(e) {
							unbindTouchMove();
							if(pointerMoved || numPointers > 1) {
								return;
							}
							lock = true;
							e.preventDefault();
							clearTimeout(timeout);
							timeout = setTimeout(function() {
								lock = false;
							}, ghostClickDelay);
							callback();
						});
					});

				}

				elem.on('click' + ns, function() {
					if(!lock) {
						callback();
					}
				});
			});
		};

		$.fn.destroyMfpFastClick = function() {
			$(this).off('touchstart' + ns + ' click' + ns);
			if(supportsTouch) _window.off('touchmove'+ns+' touchend'+ns);
		};
})();

/*>>fastclick*/
 _checkInstance(); })(window.jQuery || window.Zepto);

 /***************************************************************************************/

/*!
 *
 * jQuery collagePlus Plugin v0.3.2
 * https://github.com/ed-lea/jquery-collagePlus
 *
 * Copyright 2012, Ed Lea twitter.com/ed_lea
 *
 * built for http://qiip.me
 *
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 *
 *
 * Heavily modified by Dream-Theme.com
 */


;(function( $ ) {


	$.fn.collagePlus = function( options ) {

		var defaults = {
			// the ideal height you want your images to be
			'targetHeight'			: 400,
			// width of the area the collage will be in
			'albumWidth'			: this.width(),
			// padding between the images
			'padding'				: parseFloat( this.css('padding-left') ),
			// object that contains the images to collage
			'images'				: this.children(),
			// how quickly you want images to fade in once ready can be in ms, "slow" or "fast"
			'fadeSpeed'				: "fast",
			// how the resized block should be displayed. inline-block by default so that it doesn't break the row
			'display'				: "inline-block",
			// which effect you want to use for revealing the images (note CSS3 browsers only),
			'effect'				: 'default',
			// effect delays can either be applied per row to give the impression of descending appearance
			// or horizontally, so more like a flock of birds changing direction
			'direction'				: 'vertical',
			// Sometimes there is just one image on the last row and it gets blown up to a huge size to fit the
			// parent div width. To stop this behaviour, set this to true
			'allowPartialLastRow'	: false
		};

		var settings = $.extend({}, defaults, options);

		return this.each(function() {

			/*
			 *
			 * set up vars
			 *
			 */

				// track row width by adding images, padding and css borders etc
			var row			= 0,
				// collect elements to be re-sized in current row
				elements	= [],
				// track the number of rows generated
				rownum = 1;


			settings.images.each(
				function(index){
					/*
					 *
					 * Cache selector
					 * Even if first child is not an image the whole sizing is based on images
					 * so where we take measurements, we take them on the images
					 *
					 */
					var $this = $(this),
						$img  = ($this.is("img")) ? $this : $(this).find("img").not(".blur-effect").first();

					/*
					 *
					 * get the current image size. Get image size in this order
					 *
					 * 1. from <img> tag
					 * 2. from data set from initial calculation
					 * 3. after loading the image and checking it's actual size
					 *
					 */
					if ($img.attr("width") != 'undefined' && $img.attr("height") != 'undefined') {
						var w = (typeof $img.data("width") != 'undefined') ? $img.data("width") : $img.attr("width"),
							h = (typeof $img.data("height") != 'undefined') ? $img.data("height") : $img.attr("height");
					}
					else {
						var w = (typeof $img.data("width") != 'undefined') ? $img.data("width") : $img.width(),
							h = (typeof $img.data("height") != 'undefined') ? $img.data("height") : $img.height();
					}



					/*
					 *
					 * Get any current additional properties that may affect the width or height
					 * like css borders for example
					 *
					 */
					var imgParams = getImgProperty($img);


					/*
					 *
					 * store the original size for resize events
					 *
					 */
					$img.data("width", w);
					$img.data("height", h);



					/*
					 *
					 * calculate the w/h based on target height
					 * this is our ideal size, but later we'll resize to make it fit
					 *
					 */
					var nw = Math.ceil(w/h*settings.targetHeight),
						nh = Math.ceil(settings.targetHeight);

					/*
					 *
					 * Keep track of which images are in our row so far
					 *
					 */
					elements.push([this, nw, nh, imgParams['w'], imgParams['h']]);

					/*
					 *
					 * calculate the width of the element including extra properties
					 * like css borders
					 *
					 */
					row += nw + imgParams['w'] + settings.padding;

					/*
					 *
					 * if the current row width is wider than the parent container
					 * it's time to make a row out of our images
					 *
					 */
					if( row > settings.albumWidth && elements.length != 0 ){

						// call the method that calculates the final image sizes
						// remove one set of padding as it's not needed for the last image in the row
						resizeRow(elements, row, settings, rownum);

						// reset our row
						delete row;
						delete elements;
						row			= 0;
						elements	= [];
						rownum		+= 1;
					}


					/*
					 *
					 * if the images left are not enough to make a row
					 * then we'll force them to make one anyway
					 *
					 */
					if ( settings.images.length-1 == index && elements.length != 0){
						resizeRow(elements, row, settings, rownum);

						// reset our row
						delete row;
						delete elements;
						row			= 0;
						elements	= [];
						rownum		+= 1;
					}
				}
			);

			// trigger "jgDone" event when all is ready
			$(this).trigger("jgDone");
		});

		function resizeRow(obj, row, settings, rownum) {
			/*
			 *
			 * How much bigger is this row than the available space?
			 * At this point we have adjusted the images height to fit our target height
			 * so the image size will already be different from the original.
			 * The resizing we're doing here is to adjust it to the album width.
			 *
			 * We also need to change the album width (basically available space) by
			 * the amount of padding and css borders for the images otherwise
			 * this will skew the result.
			 *
			 * This is because padding and borders remain at a fixed size and we only
			 * need to scale the images.
			 *
			 */
			var imageExtras			= (settings.padding * obj.length) + (obj.length * obj[0][3]),
				albumWidthAdjusted	= settings.albumWidth - imageExtras,
				overPercent			= albumWidthAdjusted / (row - imageExtras),
				// start tracking our width with know values that will make up the total width
				// like borders and padding
				trackWidth			= imageExtras,
				// guess whether this is the last row in a set by checking if the width is less
				// than the parent width.
				lastRow				= (row < settings.albumWidth  ? true : false);



			/*
			 * Resize the images by the above % so that they'll fit in the album space
			 */
			for (var i = 0; i < obj.length; i++) {



				var $obj		= $(obj[i][0]),
					fw			= Math.floor(obj[i][1] * overPercent),
					fh			= Math.floor(obj[i][2] * overPercent),
				// if the element is the last in the row,
				// don't apply right hand padding (this is our flag for later)
					isNotLast	= !!(( i < obj.length - 1 ));

				/*
				 * Checking if the user wants to not stretch the images of the last row to fit the
				 * parent element size
				 */
				if(settings.allowPartialLastRow === true && lastRow === true){
					 fw = obj[i][1];
					 fh = obj[i][2];
				}


				/*
				 *
				 * Because we use % to calculate the widths, it's possible that they are
				 * a few pixels out in which case we need to track this and adjust the
				 * last image accordingly
				 *
				 */
				trackWidth += fw;


				/*
				 *
				 * here we check if the combined images are exactly the width
				 * of the parent. If not then we add a few pixels on to make
				 * up the difference.
				 *
				 * This will alter the aspect ratio of the image slightly, but
				 * by a noticable amount.
				 *
				 * If the user doesn't want full width last row, we check for that here
				 *
				 */
	/*
				if(!isNotLast && trackWidth < settings.albumWidth){
					if(settings.allowPartialLastRow === true && lastRow === true){
						fw = fw;
					}else{
						fw = fw + (settings.albumWidth - trackWidth);
					}
				}
	*/

				/*
				 *
				 * We'll be doing a few things to the image so here we cache the image selector
				 *
				 *
				 */
				var $img = ( $obj.is("img") ) ? $obj : $obj.find("img").not(".blur-effect").first();

				/*
				 *
				 * Set the width of the image and parent element
				 * if the resized element is not an image, we apply it to the child image also
				 *
				 * We need to check if it's an image as the css borders are only measured on
				 * images. If the parent is a div, we need make the contained image smaller
				 * to accommodate the css image borders.
				 *
				 */
				$img.width(fw);
				if( !$obj.is("img") ){
					$obj.width(fw + obj[i][3]);
				}


				/*
				 *
				 * Set the height of the image
				 * if the resized element is not an image, we apply it to the child image also
				 *
				 */
				$img.height(fh);
				if( !$obj.is("img") ){
					$obj.height(fh + obj[i][4]);
				}


				/*
				 *
				 * Apply the css extras like padding
				 *
				 */
				if (settings.allowPartialLastRow === false &&  lastRow === true) {
					applyModifications($obj, isNotLast, "none");
				}
				else {
					applyModifications($obj, isNotLast, settings.display);
				};


				/*
				 *
				 * Assign the effect to show the image
				 * Default effect is using jquery and not CSS3 to support more browsers
				 * Wait until the image is loaded to do this
				 *
				 */
	/*
				$img
					.load(function(target) {
					return function(){
						if( settings.effect == 'default'){
							target.animate({opacity: '1'},{duration: settings.fadeSpeed});
						} else {
							if(settings.direction == 'vertical'){
								var sequence = (rownum <= 10  ? rownum : 10);
							} else {
								var sequence = (i <= 9	? i+1 : 10);
							}

							target.addClass(settings.effect);
							target.addClass("effect-duration-" + sequence);
						}
					}
					}($obj))
	*/
					/*
					 * fix for cached or loaded images
					 * For example if images are loaded in a "window.load" call we need to trigger
					 * the load call again
					 */
	/*
					.each(function() {
							if(this.complete) $(this).trigger('load');
					});
	*/

			}
		}

		/*
		 *
		 * This private function applies the required css to space the image gallery
		 * It applies it to the parent element so if an image is wrapped in a <div> then
		 * the css is applied to the <div>
		 *
		 */
		function applyModifications($obj, isNotLast, settingsDisplay) {
			var css = {
	/*
					// Applying padding to element for the grid gap effect
					'margin-bottom'		: settings.padding + "px",
					'margin-right'		: (isNotLast) ? settings.padding + "px" : "0px",
	*/
					// Set it to an inline-block by default so that it doesn't break the row
					'display'			: settingsDisplay,
					// Set vertical alignment otherwise you get 4px extra padding
					'vertical-align'	: "bottom",
					// Hide the overflow to hide the caption
					'overflow'			: "hidden"
				};

			return $obj.css(css);
		}


		/*
		 *
		 * This private function calculates any extras like padding, border associated
		 * with the image that will impact on the width calculations
		 *
		 */
		function getImgProperty(img) {
			$img = $(img);
			var params =  new Array();
			params["w"] = (parseFloat($img.css("border-left-width")) + parseFloat($img.css("border-right-width")));
			params["h"] = (parseFloat($img.css("border-top-width")) + parseFloat($img.css("border-bottom-width")));
			return params;
		}

	};



})( jQuery );

/***************************************************************************************/

/**
 * jquery.hoverdir.js v1.1.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */
;( function( $, window, undefined ) {
	
	'use strict';

	$.HoverDir = function( options, element ) {
		
		this.$el = $( element );
		this._init( options );

	};

	// the options
	$.HoverDir.defaults = {
		speed : 300,
		easing : 'ease',
		hoverDelay : 0,
		inverse : false
	};

	$.HoverDir.prototype = {

		_init : function( options ) {
			
			// options
			this.options = $.extend( true, {}, $.HoverDir.defaults, options );
			// transition properties
			this.transitionProp = 'all ' + this.options.speed + 'ms ' + this.options.easing;
			// support for CSS transitions
			this.support = Modernizr.csstransitions;
			// load the events
			this._loadEvents();

		},
		_loadEvents : function() {

			var self = this;
			
			this.$el.on( 'mouseenter.hoverdir, mouseleave.hoverdir', function( event ) {
				
				var $el = $( this ),
					$hoverElem = $el.find( 'div.rollover-content, div.fs-entry-content' ),
					direction = self._getDir( $el, { x : event.pageX, y : event.pageY } ),
					styleCSS = self._getStyle( direction );
				
				if( event.type === 'mouseenter' ) {
					
					$hoverElem.hide().css( styleCSS.from );
					clearTimeout( self.tmhover );

					self.tmhover = setTimeout( function() {
						
						$hoverElem.show( 0, function() {
							
							var $el = $( this );
							if( self.support ) {
								$el.css( 'transition', self.transitionProp );
							}
							self._applyAnimation( $el, styleCSS.to, self.options.speed );

						} );
						
					
					}, self.options.hoverDelay );
					
				}
				else {
				
					if( self.support ) {
						$hoverElem.css( 'transition', self.transitionProp );
					}
					clearTimeout( self.tmhover );
					self._applyAnimation( $hoverElem, styleCSS.from, self.options.speed );
					
				}
					
			} );

		},
		// credits : http://stackoverflow.com/a/3647634
		_getDir : function( $el, coordinates ) {
			
			// the width and height of the current div
			var w = $el.width(),
				h = $el.height(),

				// calculate the x and y to get an angle to the center of the div from that x and y.
				// gets the x value relative to the center of the DIV and "normalize" it
				x = ( coordinates.x - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
				y = ( coordinates.y - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
			
				// the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);
				// first calculate the angle of the point,
				// add 180 deg to get rid of the negative values
				// divide by 90 to get the quadrant
				// add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
				direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 ) % 4;
			
			return direction;
			
		},
		_getStyle : function( direction ) {
			
			var fromStyle, toStyle,
				slideFromTop = { left : '0px', top : '-100%' },
				slideFromBottom = { left : '0px', top : '100%' },
				slideFromLeft = { left : '-100%', top : '0px' },
				slideFromRight = { left : '100%', top : '0px' },
				slideTop = { top : '0px' },
				slideLeft = { left : '0px' };
			
			switch( direction ) {
				case 0:
					// from top
					fromStyle = !this.options.inverse ? slideFromTop : slideFromBottom;
					toStyle = slideTop;
					break;
				case 1:
					// from right
					fromStyle = !this.options.inverse ? slideFromRight : slideFromLeft;
					toStyle = slideLeft;
					break;
				case 2:
					// from bottom
					fromStyle = !this.options.inverse ? slideFromBottom : slideFromTop;
					toStyle = slideTop;
					break;
				case 3:
					// from left
					fromStyle = !this.options.inverse ? slideFromLeft : slideFromRight;
					toStyle = slideLeft;
					break;
			};
			
			return { from : fromStyle, to : toStyle };
					
		},
		// apply a transition or fallback to jquery animate based on Modernizr.csstransitions support
		_applyAnimation : function( el, styleCSS, speed ) {

			$.fn.applyStyle = this.support ? $.fn.css : $.fn.animate;
			el.stop().applyStyle( styleCSS, $.extend( true, [], { duration : speed + 'ms' } ) );

		},

	};
	
	var logError = function( message ) {

		if ( window.console ) {

			window.console.error( message );
		
		}

	};
	
	$.fn.hoverdir = function( options ) {

		var instance = $.data( this, 'hoverdir' );
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			
			this.each(function() {
			
				if ( !instance ) {

					logError( "cannot call methods on hoverdir prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {

					logError( "no such method '" + options + "' for hoverdir instance" );
					return;
				
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
				
				if ( instance ) {

					instance._init();
				
				}
				else {

					instance = $.data( this, 'hoverdir', new $.HoverDir( options, this ) );
				
				}

			});
		
		}
		
		return instance;
		
	};
	
} )( jQuery, window );

/***************************************************************************************/

/*
== malihu jquery custom scrollbars plugin == 
version: 2.8.3 
author: malihu (http://manos.malihu.gr) 
plugin home: http://manos.malihu.gr/jquery-custom-content-scroller 
*/

/*
Copyright 2010-2013 Manos Malihutsakis 

This program is free software: you can redistribute it and/or modify 
it under the terms of the GNU Lesser General Public License as published by 
the Free Software Foundation, either version 3 of the License, or 
any later version. 

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU Lesser General Public License for more details. 

You should have received a copy of the GNU Lesser General Public License 
along with this program.  If not, see http://www.gnu.org/licenses/lgpl.html. 
*/
(function($){
	/*plugin script*/
	var methods={
		init:function(options){
			var defaults={ 
				set_width:false, /*optional element width: boolean, pixels, percentage*/
				set_height:false, /*optional element height: boolean, pixels, percentage*/
				horizontalScroll:false, /*scroll horizontally: boolean*/
				scrollInertia:950, /*scrolling inertia: integer (milliseconds)*/
				mouseWheel:true, /*mousewheel support: boolean*/
				mouseWheelPixels:"auto", /*mousewheel pixels amount: integer, "auto"*/
				autoDraggerLength:true, /*auto-adjust scrollbar dragger length: boolean*/
				autoHideScrollbar:false, /*auto-hide scrollbar when idle*/
				alwaysShowScrollbar:false, /*always show scrollbar even when there's nothing to scroll (disables autoHideScrollbar): boolean*/
				snapAmount:null, /* optional element always snaps to a multiple of this number in pixels */
				snapOffset:0, /* when snapping, snap with this number in pixels as an offset */
				scrollButtons:{ /*scroll buttons*/
					enable:false, /*scroll buttons support: boolean*/
					scrollType:"continuous", /*scroll buttons scrolling type: "continuous", "pixels"*/
					scrollSpeed:"auto", /*scroll buttons continuous scrolling speed: integer, "auto"*/
					scrollAmount:40 /*scroll buttons pixels scroll amount: integer (pixels)*/
				},
				advanced:{
					updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
					updateOnContentResize:false, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
					autoExpandHorizontalScroll:false, /*auto-expand width for horizontal scrolling: boolean*/
					autoScrollOnFocus:true, /*auto-scroll on focused elements: boolean*/
					normalizeMouseWheelDelta:false /*normalize mouse-wheel delta (-1/1)*/
				},
				contentTouchScroll:true, /*scrolling by touch-swipe content: boolean*/
				callbacks:{
					onScrollStart:function(){}, /*user custom callback function on scroll start event*/
					onScroll:function(){}, /*user custom callback function on scroll event*/
					onTotalScroll:function(){}, /*user custom callback function on scroll end reached event*/
					onTotalScrollBack:function(){}, /*user custom callback function on scroll begin reached event*/
					onTotalScrollOffset:0, /*scroll end reached offset: integer (pixels)*/
					onTotalScrollBackOffset:0, /*scroll begin reached offset: integer (pixels)*/
					whileScrolling:function(){} /*user custom callback function on scrolling event*/
				},
				theme:"light" /*"light", "dark", "light-2", "dark-2", "light-thick", "dark-thick", "light-thin", "dark-thin"*/
			},
			options=$.extend(true,defaults,options);
			return this.each(function(){
				var $this=$(this);
				/*set element width/height, create markup for custom scrollbars, add classes*/
				if(options.set_width){
					$this.css("width",options.set_width);
				}
				if(options.set_height){
					$this.css("height",options.set_height);
				}
				if(!$(document).data("mCustomScrollbar-index")){
					$(document).data("mCustomScrollbar-index","1");
				}else{
					var mCustomScrollbarIndex=parseInt($(document).data("mCustomScrollbar-index"));
					$(document).data("mCustomScrollbar-index",mCustomScrollbarIndex+1);
				}
				$this.wrapInner("<div class='mCustomScrollBox"+" mCS-"+options.theme+"' id='mCSB_"+$(document).data("mCustomScrollbar-index")+"' style='position:relative; height:100%; max-width:100%;' />").addClass("mCustomScrollbar _mCS_"+$(document).data("mCustomScrollbar-index"));
				var mCustomScrollBox=$this.children(".mCustomScrollBox");
				if(options.horizontalScroll){
					mCustomScrollBox.addClass("mCSB_horizontal").wrapInner("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />");
					var mCSB_h_wrapper=mCustomScrollBox.children(".mCSB_h_wrapper");
					mCSB_h_wrapper.wrapInner("<div class='mCSB_container' style='position:absolute; left:0;' />").children(".mCSB_container").css({"width":mCSB_h_wrapper.children().outerWidth(),"position":"relative"}).unwrap();
				}else{
					mCustomScrollBox.wrapInner("<div class='mCSB_container' style='top:0;' />");
				}
				var mCSB_container=mCustomScrollBox.children(".mCSB_container");
				if($.support.touch){
					mCSB_container.addClass("mCS_touch");
				}
				mCSB_container.after("<div class='mCSB_scrollTools' style='position:absolute;'><div class='mCSB_draggerContainer'><div class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' style='position:relative;'></div></div><div class='mCSB_draggerRail'></div></div></div>");
				var mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),
					mCSB_draggerContainer=mCSB_scrollTools.children(".mCSB_draggerContainer"),
					mCSB_dragger=mCSB_draggerContainer.children(".mCSB_dragger");
				if(options.horizontalScroll){
					mCSB_dragger.data("minDraggerWidth",mCSB_dragger.width());
				}else{
					mCSB_dragger.data("minDraggerHeight",mCSB_dragger.height());
				}
				if(options.scrollButtons.enable){
					if(options.horizontalScroll){
						mCSB_scrollTools.prepend("<a class='mCSB_buttonLeft' oncontextmenu='return false;'></a>").append("<a class='mCSB_buttonRight' oncontextmenu='return false;'></a>");
					}else{
						mCSB_scrollTools.prepend("<a class='mCSB_buttonUp' oncontextmenu='return false;'></a>").append("<a class='mCSB_buttonDown' oncontextmenu='return false;'></a>");
					}
				}
				/*mCustomScrollBox scrollTop and scrollLeft is always 0 to prevent browser focus scrolling*/
				mCustomScrollBox.bind("scroll",function(){
					if(!$this.is(".mCS_disabled")){ /*native focus scrolling for disabled scrollbars*/
						mCustomScrollBox.scrollTop(0).scrollLeft(0);
					}
				});
				/*store options, global vars/states, intervals*/
				$this.data({
					/*init state*/
					"mCS_Init":true,
					/*instance index*/
					"mCustomScrollbarIndex":$(document).data("mCustomScrollbar-index"),
					/*option parameters*/
					"horizontalScroll":options.horizontalScroll,
					"scrollInertia":options.scrollInertia,
					"scrollEasing":"mcsEaseOut",
					"mouseWheel":options.mouseWheel,
					"mouseWheelPixels":options.mouseWheelPixels,
					"autoDraggerLength":options.autoDraggerLength,
					"autoHideScrollbar":options.autoHideScrollbar,
					"alwaysShowScrollbar":options.alwaysShowScrollbar,
					"snapAmount":options.snapAmount,
					"snapOffset":options.snapOffset,
					"scrollButtons_enable":options.scrollButtons.enable,
					"scrollButtons_scrollType":options.scrollButtons.scrollType,
					"scrollButtons_scrollSpeed":options.scrollButtons.scrollSpeed,
					"scrollButtons_scrollAmount":options.scrollButtons.scrollAmount,
					"autoExpandHorizontalScroll":options.advanced.autoExpandHorizontalScroll,
					"autoScrollOnFocus":options.advanced.autoScrollOnFocus,
					"normalizeMouseWheelDelta":options.advanced.normalizeMouseWheelDelta,
					"contentTouchScroll":options.contentTouchScroll,
					"onScrollStart_Callback":options.callbacks.onScrollStart,
					"onScroll_Callback":options.callbacks.onScroll,
					"onTotalScroll_Callback":options.callbacks.onTotalScroll,
					"onTotalScrollBack_Callback":options.callbacks.onTotalScrollBack,
					"onTotalScroll_Offset":options.callbacks.onTotalScrollOffset,
					"onTotalScrollBack_Offset":options.callbacks.onTotalScrollBackOffset,
					"whileScrolling_Callback":options.callbacks.whileScrolling,
					/*events binding state*/
					"bindEvent_scrollbar_drag":false,
					"bindEvent_content_touch":false,
					"bindEvent_scrollbar_click":false,
					"bindEvent_mousewheel":false,
					"bindEvent_buttonsContinuous_y":false,
					"bindEvent_buttonsContinuous_x":false,
					"bindEvent_buttonsPixels_y":false,
					"bindEvent_buttonsPixels_x":false,
					"bindEvent_focusin":false,
					"bindEvent_autoHideScrollbar":false,
					/*buttons intervals*/
					"mCSB_buttonScrollRight":false,
					"mCSB_buttonScrollLeft":false,
					"mCSB_buttonScrollDown":false,
					"mCSB_buttonScrollUp":false
				});
				/*max-width/max-height*/
				if(options.horizontalScroll){
					if($this.css("max-width")!=="none"){
						if(!options.advanced.updateOnContentResize){ /*needs updateOnContentResize*/
							options.advanced.updateOnContentResize=true;
						}
					}
				}else{
					if($this.css("max-height")!=="none"){
						var percentage=false,maxHeight=parseInt($this.css("max-height"));
						if($this.css("max-height").indexOf("%")>=0){
							percentage=maxHeight,
							maxHeight=$this.parent().height()*percentage/100;
						}
						$this.css("overflow","hidden");
						mCustomScrollBox.css("max-height",maxHeight);
					}
				}
				$this.mCustomScrollbar("update");
				/*window resize fn (for layouts based on percentages)*/
				if(options.advanced.updateOnBrowserResize){
					var mCSB_resizeTimeout,currWinWidth=$(window).width(),currWinHeight=$(window).height();
					$(window).bind("resize."+$this.data("mCustomScrollbarIndex"),function(){
						if(mCSB_resizeTimeout){
							clearTimeout(mCSB_resizeTimeout);
						}
						mCSB_resizeTimeout=setTimeout(function(){
							if(!$this.is(".mCS_disabled") && !$this.is(".mCS_destroyed")){
								var winWidth=$(window).width(),winHeight=$(window).height();
								if(currWinWidth!==winWidth || currWinHeight!==winHeight){ /*ie8 fix*/
									if($this.css("max-height")!=="none" && percentage){
										mCustomScrollBox.css("max-height",$this.parent().height()*percentage/100);
									}
									$this.mCustomScrollbar("update");
									currWinWidth=winWidth; currWinHeight=winHeight;
								}
							}
						},150);
					});
				}
				/*content resize fn (for dynamically generated content)*/
				if(options.advanced.updateOnContentResize){
					var mCSB_onContentResize;
					if(options.horizontalScroll){
						var mCSB_containerOldSize=mCSB_container.outerWidth();
					}else{
						var mCSB_containerOldSize=mCSB_container.outerHeight();
					}
					mCSB_onContentResize=setInterval(function(){
						if(options.horizontalScroll){
							if(options.advanced.autoExpandHorizontalScroll){
								mCSB_container.css({"position":"absolute","width":"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({"width":mCSB_container.outerWidth(),"position":"relative"}).unwrap();
							}
							var mCSB_containerNewSize=mCSB_container.outerWidth();
						}else{
							var mCSB_containerNewSize=mCSB_container.outerHeight();
						}
						if(mCSB_containerNewSize!=mCSB_containerOldSize){
							$this.mCustomScrollbar("update");
							mCSB_containerOldSize=mCSB_containerNewSize;
						}
					},300);
				}
			});
		},
		update:function(){
			var $this=$(this),
				mCustomScrollBox=$this.children(".mCustomScrollBox"),
				mCSB_container=mCustomScrollBox.children(".mCSB_container");
			mCSB_container.removeClass("mCS_no_scrollbar");
			$this.removeClass("mCS_disabled mCS_destroyed");
			mCustomScrollBox.scrollTop(0).scrollLeft(0); /*reset scrollTop/scrollLeft to prevent browser focus scrolling*/
			var mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),
				mCSB_draggerContainer=mCSB_scrollTools.children(".mCSB_draggerContainer"),
				mCSB_dragger=mCSB_draggerContainer.children(".mCSB_dragger");
			if($this.data("horizontalScroll")){
				var mCSB_buttonLeft=mCSB_scrollTools.children(".mCSB_buttonLeft"),
					mCSB_buttonRight=mCSB_scrollTools.children(".mCSB_buttonRight"),
					mCustomScrollBoxW=mCustomScrollBox.width();
				if($this.data("autoExpandHorizontalScroll")){
					mCSB_container.css({"position":"absolute","width":"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({"width":mCSB_container.outerWidth(),"position":"relative"}).unwrap();
				}
				var mCSB_containerW=mCSB_container.outerWidth();
			}else{
				var mCSB_buttonUp=mCSB_scrollTools.children(".mCSB_buttonUp"),
					mCSB_buttonDown=mCSB_scrollTools.children(".mCSB_buttonDown"),
					mCustomScrollBoxH=mCustomScrollBox.height(),
					mCSB_containerH=mCSB_container.outerHeight();
			}
			if(mCSB_containerH>mCustomScrollBoxH && !$this.data("horizontalScroll")){ /*content needs vertical scrolling*/
				mCSB_scrollTools.css("display","block");
				$(".mCSB_container").css("position","relative");
				var mCSB_draggerContainerH=mCSB_draggerContainer.height();
				/*auto adjust scrollbar dragger length analogous to content*/
				if($this.data("autoDraggerLength")){
					var draggerH=Math.round(mCustomScrollBoxH/mCSB_containerH*mCSB_draggerContainerH),
						minDraggerH=mCSB_dragger.data("minDraggerHeight");
					if(draggerH<=minDraggerH){ /*min dragger height*/
						mCSB_dragger.css({"height":minDraggerH});
					}else if(draggerH>=mCSB_draggerContainerH-10){ /*max dragger height*/
						var mCSB_draggerContainerMaxH=mCSB_draggerContainerH-10;
						mCSB_dragger.css({"height":mCSB_draggerContainerMaxH});
					}else{
						mCSB_dragger.css({"height":draggerH});
					}
					mCSB_dragger.children(".mCSB_dragger_bar").css({"line-height":mCSB_dragger.height()+"px"});
				}
				var mCSB_draggerH=mCSB_dragger.height(),
				/*calculate and store scroll amount, add scrolling*/
					scrollAmount=(mCSB_containerH-mCustomScrollBoxH)/(mCSB_draggerContainerH-mCSB_draggerH);
				$this.data("scrollAmount",scrollAmount).mCustomScrollbar("scrolling",mCustomScrollBox,mCSB_container,mCSB_draggerContainer,mCSB_dragger,mCSB_buttonUp,mCSB_buttonDown,mCSB_buttonLeft,mCSB_buttonRight);
				/*scroll*/
				var mCSB_containerP=Math.abs(mCSB_container.position().top);
				$this.mCustomScrollbar("scrollTo",mCSB_containerP,{scrollInertia:0,trigger:"internal"});
			}else if(mCSB_containerW>mCustomScrollBoxW && $this.data("horizontalScroll")){ /*content needs horizontal scrolling*/
				mCSB_scrollTools.css("display","block");
				var mCSB_draggerContainerW=mCSB_draggerContainer.width();
				/*auto adjust scrollbar dragger length analogous to content*/
				if($this.data("autoDraggerLength")){
					var draggerW=Math.round(mCustomScrollBoxW/mCSB_containerW*mCSB_draggerContainerW),
						minDraggerW=mCSB_dragger.data("minDraggerWidth");
					if(draggerW<=minDraggerW){ /*min dragger height*/
						mCSB_dragger.css({"width":minDraggerW});
					}else if(draggerW>=mCSB_draggerContainerW-10){ /*max dragger height*/
						var mCSB_draggerContainerMaxW=mCSB_draggerContainerW-10;
						mCSB_dragger.css({"width":mCSB_draggerContainerMaxW});
					}else{
						mCSB_dragger.css({"width":draggerW});
					}
				}
				var mCSB_draggerW=mCSB_dragger.width(),
				/*calculate and store scroll amount, add scrolling*/
					scrollAmount=(mCSB_containerW-mCustomScrollBoxW)/(mCSB_draggerContainerW-mCSB_draggerW);
				$this.data("scrollAmount",scrollAmount).mCustomScrollbar("scrolling",mCustomScrollBox,mCSB_container,mCSB_draggerContainer,mCSB_dragger,mCSB_buttonUp,mCSB_buttonDown,mCSB_buttonLeft,mCSB_buttonRight);
				/*scroll*/
				var mCSB_containerP=Math.abs(mCSB_container.position().left);
				$this.mCustomScrollbar("scrollTo",mCSB_containerP,{scrollInertia:0,trigger:"internal"});
			}else{ /*content does not need scrolling*/
				/*unbind events, reset content position, hide scrollbars, remove classes*/
				mCustomScrollBox.unbind("mousewheel focusin");
				if($this.data("horizontalScroll")){
					mCSB_dragger.add(mCSB_container).css("left",0);
				}else{
					mCSB_dragger.add(mCSB_container).css("top",0);
				}
				if ($this.data("alwaysShowScrollbar")) {
					if(!$this.data("horizontalScroll")){ /*vertical scrolling*/
						mCSB_dragger.css({"height":mCSB_draggerContainer.height()});
					}else if($this.data("horizontalScroll")){ /*horizontal scrolling*/
						mCSB_dragger.css({"width":mCSB_draggerContainer.width()});
					}
				} else {
					mCSB_scrollTools.css("display","none");

					$(".mCSB_container").css("position","");
					mCSB_container.addClass("mCS_no_scrollbar");
				}
				$this.data({"bindEvent_mousewheel":false,"bindEvent_focusin":false});
			}
		},
		scrolling:function(mCustomScrollBox,mCSB_container,mCSB_draggerContainer,mCSB_dragger,mCSB_buttonUp,mCSB_buttonDown,mCSB_buttonLeft,mCSB_buttonRight){
			var $this=$(this);
			/*scrollbar drag scrolling*/
			if(!$this.data("bindEvent_scrollbar_drag")){
				var mCSB_draggerDragY,mCSB_draggerDragX,
					mCSB_dragger_downEvent,mCSB_dragger_moveEvent,mCSB_dragger_upEvent;
				if($.support.pointer){ /*pointer*/
					mCSB_dragger_downEvent="pointerdown";
					mCSB_dragger_moveEvent="pointermove";
					mCSB_dragger_upEvent="pointerup";
				}else if($.support.msPointer){ /*MSPointer*/
					mCSB_dragger_downEvent="MSPointerDown";
					mCSB_dragger_moveEvent="MSPointerMove";
					mCSB_dragger_upEvent="MSPointerUp";
				}
				if($.support.pointer || $.support.msPointer){ /*pointer, MSPointer*/
					mCSB_dragger.bind(mCSB_dragger_downEvent,function(e){
						e.preventDefault();
						$this.data({"on_drag":true}); mCSB_dragger.addClass("mCSB_dragger_onDrag");
						var elem=$(this),
							elemOffset=elem.offset(),
							x=e.originalEvent.pageX-elemOffset.left,
							y=e.originalEvent.pageY-elemOffset.top;
						if(x<elem.width() && x>0 && y<elem.height() && y>0){
							mCSB_draggerDragY=y;
							mCSB_draggerDragX=x;
						}
					});
					$(document).bind(mCSB_dragger_moveEvent+"."+$this.data("mCustomScrollbarIndex"),function(e){
						e.preventDefault();
						if($this.data("on_drag")){
							var elem=mCSB_dragger,
								elemOffset=elem.offset(),
								x=e.originalEvent.pageX-elemOffset.left,
								y=e.originalEvent.pageY-elemOffset.top;
							scrollbarDrag(mCSB_draggerDragY,mCSB_draggerDragX,y,x);
						}
					}).bind(mCSB_dragger_upEvent+"."+$this.data("mCustomScrollbarIndex"),function(e){
						$this.data({"on_drag":false}); mCSB_dragger.removeClass("mCSB_dragger_onDrag");
					});
				}else{ /*mouse/touch*/
					mCSB_dragger.bind("mousedown touchstart",function(e){
						e.preventDefault(); e.stopImmediatePropagation();
						var	elem=$(this),elemOffset=elem.offset(),x,y;
						if(e.type==="touchstart"){
							var touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
							x=touch.pageX-elemOffset.left; y=touch.pageY-elemOffset.top;
						}else{
							$this.data({"on_drag":true}); mCSB_dragger.addClass("mCSB_dragger_onDrag");
							x=e.pageX-elemOffset.left; y=e.pageY-elemOffset.top;
						}
						if(x<elem.width() && x>0 && y<elem.height() && y>0){
							mCSB_draggerDragY=y; mCSB_draggerDragX=x;
						}
					}).bind("touchmove",function(e){
						e.preventDefault(); e.stopImmediatePropagation();
						var touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0],
							elem=$(this),
							elemOffset=elem.offset(),
							x=touch.pageX-elemOffset.left,
							y=touch.pageY-elemOffset.top;
						scrollbarDrag(mCSB_draggerDragY,mCSB_draggerDragX,y,x);
					});
					$(document).bind("mousemove."+$this.data("mCustomScrollbarIndex"),function(e){
						if($this.data("on_drag")){
							var elem=mCSB_dragger,
								elemOffset=elem.offset(),
								x=e.pageX-elemOffset.left,
								y=e.pageY-elemOffset.top;
							scrollbarDrag(mCSB_draggerDragY,mCSB_draggerDragX,y,x);
						}
					}).bind("mouseup."+$this.data("mCustomScrollbarIndex"),function(e){
						$this.data({"on_drag":false}); mCSB_dragger.removeClass("mCSB_dragger_onDrag");
					});
				}
				$this.data({"bindEvent_scrollbar_drag":true});
			}
			function scrollbarDrag(mCSB_draggerDragY,mCSB_draggerDragX,y,x){
				if($this.data("horizontalScroll")){
					$this.mCustomScrollbar("scrollTo",(mCSB_dragger.position().left-(mCSB_draggerDragX))+x,{moveDragger:true,trigger:"internal"});
				}else{
					$this.mCustomScrollbar("scrollTo",(mCSB_dragger.position().top-(mCSB_draggerDragY))+y,{moveDragger:true,trigger:"internal"});
				}
			}
			/*content touch-drag*/
			if($.support.touch && $this.data("contentTouchScroll")){
				if(!$this.data("bindEvent_content_touch")){
					var touch,
						elem,elemOffset,y,x,mCSB_containerTouchY,mCSB_containerTouchX;
					mCSB_container.bind("touchstart",function(e){
						e.stopImmediatePropagation();
						touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
						elem=$(this);
						elemOffset=elem.offset();
						x=touch.pageX-elemOffset.left;
						y=touch.pageY-elemOffset.top;
						mCSB_containerTouchY=y;
						mCSB_containerTouchX=x;
					});
					mCSB_container.bind("touchmove",function(e){
						e.preventDefault(); e.stopImmediatePropagation();
						touch=e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
						elem=$(this).parent();
						elemOffset=elem.offset();
						x=touch.pageX-elemOffset.left;
						y=touch.pageY-elemOffset.top;
						if($this.data("horizontalScroll")){
							$this.mCustomScrollbar("scrollTo",mCSB_containerTouchX-x,{trigger:"internal"});
						}else{
							$this.mCustomScrollbar("scrollTo",mCSB_containerTouchY-y,{trigger:"internal"});
						}
					});
				}
			}
			/*dragger rail click scrolling*/
			if(!$this.data("bindEvent_scrollbar_click")){
				mCSB_draggerContainer.bind("click",function(e){
					var scrollToPos=(e.pageY-mCSB_draggerContainer.offset().top)*$this.data("scrollAmount"),target=$(e.target);
					if($this.data("horizontalScroll")){
						scrollToPos=(e.pageX-mCSB_draggerContainer.offset().left)*$this.data("scrollAmount");
					}
					if(target.hasClass("mCSB_draggerContainer") || target.hasClass("mCSB_draggerRail")){
						$this.mCustomScrollbar("scrollTo",scrollToPos,{trigger:"internal",scrollEasing:"draggerRailEase"});
					}
				});
				$this.data({"bindEvent_scrollbar_click":true});
			}
			/*mousewheel scrolling*/
			if($this.data("mouseWheel")){
				if(!$this.data("bindEvent_mousewheel")){
					mCustomScrollBox.bind("mousewheel",function(e,delta){
						var scrollTo,mouseWheelPixels=$this.data("mouseWheelPixels"),absPos=Math.abs(mCSB_container.position().top),
							draggerPos=mCSB_dragger.position().top,limit=mCSB_draggerContainer.height()-mCSB_dragger.height();
						if($this.data("normalizeMouseWheelDelta")){
							if(delta<0){delta=-1;}else{delta=1;}
						}
						if(mouseWheelPixels==="auto"){
							mouseWheelPixels=100+Math.round($this.data("scrollAmount")/2);
						}
						if($this.data("horizontalScroll")){
							draggerPos=mCSB_dragger.position().left; 
							limit=mCSB_draggerContainer.width()-mCSB_dragger.width();
							absPos=Math.abs(mCSB_container.position().left);
						}
						if((delta>0 && draggerPos!==0) || (delta<0 && draggerPos!==limit)){e.preventDefault(); e.stopImmediatePropagation();}
						scrollTo=absPos-(delta*mouseWheelPixels);
						$this.mCustomScrollbar("scrollTo",scrollTo,{trigger:"internal"});
					});
					$this.data({"bindEvent_mousewheel":true});
				}
			}
			/*buttons scrolling*/
			if($this.data("scrollButtons_enable")){
				if($this.data("scrollButtons_scrollType")==="pixels"){ /*scroll by pixels*/
					if($this.data("horizontalScroll")){
						mCSB_buttonRight.add(mCSB_buttonLeft).unbind("mousedown touchstart MSPointerDown pointerdown mouseup MSPointerUp pointerup mouseout MSPointerOut pointerout touchend",mCSB_buttonRight_stop,mCSB_buttonLeft_stop);
						$this.data({"bindEvent_buttonsContinuous_x":false});
						if(!$this.data("bindEvent_buttonsPixels_x")){
							/*scroll right*/
							mCSB_buttonRight.bind("click",function(e){
								e.preventDefault();
								PixelsScrollTo(Math.abs(mCSB_container.position().left)+$this.data("scrollButtons_scrollAmount"));
							});
							/*scroll left*/
							mCSB_buttonLeft.bind("click",function(e){
								e.preventDefault();
								PixelsScrollTo(Math.abs(mCSB_container.position().left)-$this.data("scrollButtons_scrollAmount"));
							});
							$this.data({"bindEvent_buttonsPixels_x":true});
						}
					}else{
						mCSB_buttonDown.add(mCSB_buttonUp).unbind("mousedown touchstart MSPointerDown pointerdown mouseup MSPointerUp pointerup mouseout MSPointerOut pointerout touchend",mCSB_buttonRight_stop,mCSB_buttonLeft_stop);
						$this.data({"bindEvent_buttonsContinuous_y":false});
						if(!$this.data("bindEvent_buttonsPixels_y")){
							/*scroll down*/
							mCSB_buttonDown.bind("click",function(e){
								e.preventDefault();
								PixelsScrollTo(Math.abs(mCSB_container.position().top)+$this.data("scrollButtons_scrollAmount"));
							});
							/*scroll up*/
							mCSB_buttonUp.bind("click",function(e){
								e.preventDefault();
								PixelsScrollTo(Math.abs(mCSB_container.position().top)-$this.data("scrollButtons_scrollAmount"));
							});
							$this.data({"bindEvent_buttonsPixels_y":true});
						}
					}
					function PixelsScrollTo(to){
						if(!mCSB_dragger.data("preventAction")){
							mCSB_dragger.data("preventAction",true);
							$this.mCustomScrollbar("scrollTo",to,{trigger:"internal"});
						}
					}
				}else{ /*continuous scrolling*/
					if($this.data("horizontalScroll")){
						mCSB_buttonRight.add(mCSB_buttonLeft).unbind("click");
						$this.data({"bindEvent_buttonsPixels_x":false});
						if(!$this.data("bindEvent_buttonsContinuous_x")){
							/*scroll right*/
							mCSB_buttonRight.bind("mousedown touchstart MSPointerDown pointerdown",function(e){
								e.preventDefault();
								var scrollButtonsSpeed=ScrollButtonsSpeed();
								$this.data({"mCSB_buttonScrollRight":setInterval(function(){
									$this.mCustomScrollbar("scrollTo",Math.abs(mCSB_container.position().left)+scrollButtonsSpeed,{trigger:"internal",scrollEasing:"easeOutCirc"});
								},17)});
							});
							var mCSB_buttonRight_stop=function(e){
								e.preventDefault(); clearInterval($this.data("mCSB_buttonScrollRight"));
							}
							mCSB_buttonRight.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",mCSB_buttonRight_stop);
							/*scroll left*/
							mCSB_buttonLeft.bind("mousedown touchstart MSPointerDown pointerdown",function(e){
								e.preventDefault();
								var scrollButtonsSpeed=ScrollButtonsSpeed();
								$this.data({"mCSB_buttonScrollLeft":setInterval(function(){
									$this.mCustomScrollbar("scrollTo",Math.abs(mCSB_container.position().left)-scrollButtonsSpeed,{trigger:"internal",scrollEasing:"easeOutCirc"});
								},17)});
							});	
							var mCSB_buttonLeft_stop=function(e){
								e.preventDefault(); clearInterval($this.data("mCSB_buttonScrollLeft"));
							}
							mCSB_buttonLeft.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",mCSB_buttonLeft_stop);
							$this.data({"bindEvent_buttonsContinuous_x":true});
						}
					}else{
						mCSB_buttonDown.add(mCSB_buttonUp).unbind("click");
						$this.data({"bindEvent_buttonsPixels_y":false});
						if(!$this.data("bindEvent_buttonsContinuous_y")){
							/*scroll down*/
							mCSB_buttonDown.bind("mousedown touchstart MSPointerDown pointerdown",function(e){
								e.preventDefault();
								var scrollButtonsSpeed=ScrollButtonsSpeed();
								$this.data({"mCSB_buttonScrollDown":setInterval(function(){
									$this.mCustomScrollbar("scrollTo",Math.abs(mCSB_container.position().top)+scrollButtonsSpeed,{trigger:"internal",scrollEasing:"easeOutCirc"});
								},17)});
							});
							var mCSB_buttonDown_stop=function(e){
								e.preventDefault(); clearInterval($this.data("mCSB_buttonScrollDown"));
							}
							mCSB_buttonDown.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",mCSB_buttonDown_stop);
							/*scroll up*/
							mCSB_buttonUp.bind("mousedown touchstart MSPointerDown pointerdown",function(e){
								e.preventDefault();
								var scrollButtonsSpeed=ScrollButtonsSpeed();
								$this.data({"mCSB_buttonScrollUp":setInterval(function(){
									$this.mCustomScrollbar("scrollTo",Math.abs(mCSB_container.position().top)-scrollButtonsSpeed,{trigger:"internal",scrollEasing:"easeOutCirc"});
								},17)});
							});	
							var mCSB_buttonUp_stop=function(e){
								e.preventDefault(); clearInterval($this.data("mCSB_buttonScrollUp"));
							}
							mCSB_buttonUp.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",mCSB_buttonUp_stop);
							$this.data({"bindEvent_buttonsContinuous_y":true});
						}
					}
					function ScrollButtonsSpeed(){
						var speed=$this.data("scrollButtons_scrollSpeed");
						if($this.data("scrollButtons_scrollSpeed")==="auto"){
							speed=Math.round(($this.data("scrollInertia")+100)/40);
						}
						return speed;
					}
				}
			}
			/*scrolling on element focus (e.g. via TAB key)*/
			if($this.data("autoScrollOnFocus")){
				if(!$this.data("bindEvent_focusin")){
					mCustomScrollBox.bind("focusin",function(){
						mCustomScrollBox.scrollTop(0).scrollLeft(0);
						var focusedElem=$(document.activeElement);
						if(focusedElem.is("input,textarea,select,button,a[tabindex],area,object")){
							var mCSB_containerPos=mCSB_container.position().top,
								focusedElemPos=focusedElem.position().top,
								visibleLimit=mCustomScrollBox.height()-focusedElem.outerHeight();
							if($this.data("horizontalScroll")){
								mCSB_containerPos=mCSB_container.position().left;
								focusedElemPos=focusedElem.position().left;
								visibleLimit=mCustomScrollBox.width()-focusedElem.outerWidth();
							}
							if(mCSB_containerPos+focusedElemPos<0 || mCSB_containerPos+focusedElemPos>visibleLimit){
								$this.mCustomScrollbar("scrollTo",focusedElemPos,{trigger:"internal"});
							}
						}
					});
					$this.data({"bindEvent_focusin":true});
				}
			}
			/*auto-hide scrollbar*/
			if($this.data("autoHideScrollbar") && !$this.data("alwaysShowScrollbar")){
				if(!$this.data("bindEvent_autoHideScrollbar")){
					mCustomScrollBox.bind("mouseenter",function(e){
						mCustomScrollBox.addClass("mCS-mouse-over");
						functions.showScrollbar.call(mCustomScrollBox.children(".mCSB_scrollTools"));
					}).bind("mouseleave touchend",function(e){
						mCustomScrollBox.removeClass("mCS-mouse-over");
						if(e.type==="mouseleave"){functions.hideScrollbar.call(mCustomScrollBox.children(".mCSB_scrollTools"));}
					});
					$this.data({"bindEvent_autoHideScrollbar":true});
				}
			}
		},
		scrollTo:function(scrollTo,options){
			var $this=$(this),
				defaults={
					moveDragger:false,
					trigger:"external",
					callbacks:true,
					scrollInertia:$this.data("scrollInertia"),
					scrollEasing:$this.data("scrollEasing")
				},
				options=$.extend(defaults,options),
				draggerScrollTo,
				mCustomScrollBox=$this.children(".mCustomScrollBox"),
				mCSB_container=mCustomScrollBox.children(".mCSB_container"),
				mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),
				mCSB_draggerContainer=mCSB_scrollTools.children(".mCSB_draggerContainer"),
				mCSB_dragger=mCSB_draggerContainer.children(".mCSB_dragger"),
				contentSpeed=draggerSpeed=options.scrollInertia,
				scrollBeginning,scrollBeginningOffset,totalScroll,totalScrollOffset;
			if(!mCSB_container.hasClass("mCS_no_scrollbar")){
				$this.data({"mCS_trigger":options.trigger});
				if($this.data("mCS_Init")){options.callbacks=false;}
				if(scrollTo || scrollTo===0){
					if(typeof(scrollTo)==="number"){ /*if integer, scroll by number of pixels*/
						if(options.moveDragger){ /*scroll dragger*/
							draggerScrollTo=scrollTo;
							if($this.data("horizontalScroll")){
								scrollTo=mCSB_dragger.position().left*$this.data("scrollAmount");
							}else{
								scrollTo=mCSB_dragger.position().top*$this.data("scrollAmount");
							}
							draggerSpeed=0;
						}else{ /*scroll content by default*/
							draggerScrollTo=scrollTo/$this.data("scrollAmount");
						}
					}else if(typeof(scrollTo)==="string"){ /*if string, scroll by element position*/
						var target;
						if(scrollTo==="top"){ /*scroll to top*/
							target=0;
						}else if(scrollTo==="bottom" && !$this.data("horizontalScroll")){ /*scroll to bottom*/
							target=mCSB_container.outerHeight()-mCustomScrollBox.height();
						}else if(scrollTo==="left"){ /*scroll to left*/
							target=0;
						}else if(scrollTo==="right" && $this.data("horizontalScroll")){ /*scroll to right*/
							target=mCSB_container.outerWidth()-mCustomScrollBox.width();
						}else if(scrollTo==="first"){ /*scroll to first element position*/
							target=$this.find(".mCSB_container").find(":first");
						}else if(scrollTo==="last"){ /*scroll to last element position*/
							target=$this.find(".mCSB_container").find(":last");
						}else{ /*scroll to element position*/
							target=$this.find(scrollTo);
						}
						if(target.length===1){ /*if such unique element exists, scroll to it*/
							if($this.data("horizontalScroll")){
								scrollTo=target.position().left;
							}else{
								scrollTo=target.position().top;
							}
							draggerScrollTo=scrollTo/$this.data("scrollAmount");
						}else{
							draggerScrollTo=scrollTo=target;
						}
					}
					/*scroll to*/
					if($this.data("horizontalScroll")){
						if($this.data("onTotalScrollBack_Offset")){ /*scroll beginning offset*/
							scrollBeginningOffset=-$this.data("onTotalScrollBack_Offset");
						}
						if($this.data("onTotalScroll_Offset")){ /*total scroll offset*/
							totalScrollOffset=mCustomScrollBox.width()-mCSB_container.outerWidth()+$this.data("onTotalScroll_Offset");
						}
						if(draggerScrollTo<0){ /*scroll start position*/
							draggerScrollTo=scrollTo=0; clearInterval($this.data("mCSB_buttonScrollLeft"));
							if(!scrollBeginningOffset){scrollBeginning=true;}
						}else if(draggerScrollTo>=mCSB_draggerContainer.width()-mCSB_dragger.width()){ /*scroll end position*/
							draggerScrollTo=mCSB_draggerContainer.width()-mCSB_dragger.width();
							scrollTo=mCustomScrollBox.width()-mCSB_container.outerWidth(); clearInterval($this.data("mCSB_buttonScrollRight"));
							if(!totalScrollOffset){totalScroll=true;}
						}else{scrollTo=-scrollTo;}
						var snapAmount = $this.data("snapAmount");
						if (snapAmount) {
							scrollTo = Math.round(scrollTo / snapAmount) * snapAmount - $this.data("snapOffset");
						}
						/*scrolling animation*/
						functions.mTweenAxis.call(this,mCSB_dragger[0],"left",Math.round(draggerScrollTo),draggerSpeed,options.scrollEasing);
						functions.mTweenAxis.call(this,mCSB_container[0],"left",Math.round(scrollTo),contentSpeed,options.scrollEasing,{
							onStart:function(){
								if(options.callbacks && !$this.data("mCS_tweenRunning")){callbacks("onScrollStart");}
								if($this.data("autoHideScrollbar") && !$this.data("alwaysShowScrollbar")){functions.showScrollbar.call(mCSB_scrollTools);}
							},
							onUpdate:function(){
								if(options.callbacks){callbacks("whileScrolling");}
							},
							onComplete:function(){
								if(options.callbacks){
									callbacks("onScroll");
									if(scrollBeginning || (scrollBeginningOffset && mCSB_container.position().left>=scrollBeginningOffset)){callbacks("onTotalScrollBack");}
									if(totalScroll || (totalScrollOffset && mCSB_container.position().left<=totalScrollOffset)){callbacks("onTotalScroll");}
								}
								mCSB_dragger.data("preventAction",false); $this.data("mCS_tweenRunning",false);
								if($this.data("autoHideScrollbar") && !$this.data("alwaysShowScrollbar")){if(!mCustomScrollBox.hasClass("mCS-mouse-over")){functions.hideScrollbar.call(mCSB_scrollTools);}}
							}
						});
					}else{
						if($this.data("onTotalScrollBack_Offset")){ /*scroll beginning offset*/
							scrollBeginningOffset=-$this.data("onTotalScrollBack_Offset");
						}
						if($this.data("onTotalScroll_Offset")){ /*total scroll offset*/
							totalScrollOffset=mCustomScrollBox.height()-mCSB_container.outerHeight()+$this.data("onTotalScroll_Offset");
						}
						if(draggerScrollTo<0){ /*scroll start position*/
							draggerScrollTo=scrollTo=0; clearInterval($this.data("mCSB_buttonScrollUp"));
							if(!scrollBeginningOffset){scrollBeginning=true;}
						}else if(draggerScrollTo>=mCSB_draggerContainer.height()-mCSB_dragger.height()){ /*scroll end position*/
							draggerScrollTo=mCSB_draggerContainer.height()-mCSB_dragger.height();
							scrollTo=mCustomScrollBox.height()-mCSB_container.outerHeight(); clearInterval($this.data("mCSB_buttonScrollDown"));
							if(!totalScrollOffset){totalScroll=true;}
						}else{scrollTo=-scrollTo;}
						var snapAmount = $this.data("snapAmount");
						if (snapAmount) {
							scrollTo = Math.round(scrollTo / snapAmount) * snapAmount - $this.data("snapOffset");
						}
						/*scrolling animation*/
						functions.mTweenAxis.call(this,mCSB_dragger[0],"top",Math.round(draggerScrollTo),draggerSpeed,options.scrollEasing);
						functions.mTweenAxis.call(this,mCSB_container[0],"top",Math.round(scrollTo),contentSpeed,options.scrollEasing,{
							onStart:function(){
								if(options.callbacks && !$this.data("mCS_tweenRunning")){callbacks("onScrollStart");}
								if($this.data("autoHideScrollbar") && !$this.data("alwaysShowScrollbar")){functions.showScrollbar.call(mCSB_scrollTools);}
							},
							onUpdate:function(){
								if(options.callbacks){callbacks("whileScrolling");}
							},
							onComplete:function(){
								if(options.callbacks){
									callbacks("onScroll");
									if(scrollBeginning || (scrollBeginningOffset && mCSB_container.position().top>=scrollBeginningOffset)){callbacks("onTotalScrollBack");}
									if(totalScroll || (totalScrollOffset && mCSB_container.position().top<=totalScrollOffset)){callbacks("onTotalScroll");}
								}
								mCSB_dragger.data("preventAction",false); $this.data("mCS_tweenRunning",false);
								if($this.data("autoHideScrollbar") && !$this.data("alwaysShowScrollbar")){if(!mCustomScrollBox.hasClass("mCS-mouse-over")){functions.hideScrollbar.call(mCSB_scrollTools);}}
							}
						});
					}
					if($this.data("mCS_Init")){$this.data({"mCS_Init":false});}
				}
			}
			/*callbacks*/
			function callbacks(cb){
				if ($this.data("mCustomScrollbarIndex")) {
					this.mcs = {
						top: mCSB_container.position().top, left: mCSB_container.position().left,
						draggerTop: mCSB_dragger.position().top, draggerLeft: mCSB_dragger.position().left,
						topPct: Math.round((100 * Math.abs(mCSB_container.position().top)) / Math.abs(mCSB_container.outerHeight() - mCustomScrollBox.height())),
						leftPct: Math.round((100 * Math.abs(mCSB_container.position().left)) / Math.abs(mCSB_container.outerWidth() - mCustomScrollBox.width()))
					};
					switch (cb) {
						/*start scrolling callback*/
						case "onScrollStart":
							$this.data("mCS_tweenRunning", true).data("onScrollStart_Callback").call($this, this.mcs);
							break;
						case "whileScrolling":
							$this.data("whileScrolling_Callback").call($this, this.mcs);
							break;
						case "onScroll":
							$this.data("onScroll_Callback").call($this, this.mcs);
							break;
						case "onTotalScrollBack":
							$this.data("onTotalScrollBack_Callback").call($this, this.mcs);
							break;
						case "onTotalScroll":
							$this.data("onTotalScroll_Callback").call($this, this.mcs);
							break;
					}
				}
			}
		},
		stop:function(){
			var $this=$(this),
				mCSB_container=$this.children().children(".mCSB_container"),
				mCSB_dragger=$this.children().children().children().children(".mCSB_dragger");
			functions.mTweenAxisStop.call(this,mCSB_container[0]);
			functions.mTweenAxisStop.call(this,mCSB_dragger[0]);
		},
		disable:function(resetScroll){
			var $this=$(this),
				mCustomScrollBox=$this.children(".mCustomScrollBox"),
				mCSB_container=mCustomScrollBox.children(".mCSB_container"),
				mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),
				mCSB_dragger=mCSB_scrollTools.children().children(".mCSB_dragger");
			mCustomScrollBox.unbind("mousewheel focusin mouseenter mouseleave touchend");
			mCSB_container.unbind("touchstart touchmove")
			if(resetScroll){
				if($this.data("horizontalScroll")){
					mCSB_dragger.add(mCSB_container).css("left",0);
				}else{
					mCSB_dragger.add(mCSB_container).css("top",0);
				}
			}
			mCSB_scrollTools.css("display","none");
			mCSB_container.addClass("mCS_no_scrollbar");
			$this.data({"bindEvent_mousewheel":false,"bindEvent_focusin":false,"bindEvent_content_touch":false,"bindEvent_autoHideScrollbar":false}).addClass("mCS_disabled");
		},
		destroy:function(){
			var $this=$(this);
			$this.removeClass("mCustomScrollbar _mCS_"+$this.data("mCustomScrollbarIndex")).addClass("mCS_destroyed").children().children(".mCSB_container").unwrap().children().unwrap().siblings(".mCSB_scrollTools").remove();
			$(document).unbind("mousemove."+$this.data("mCustomScrollbarIndex")+" mouseup."+$this.data("mCustomScrollbarIndex")+" MSPointerMove."+$this.data("mCustomScrollbarIndex")+" MSPointerUp."+$this.data("mCustomScrollbarIndex"));
			$(window).unbind("resize."+$this.data("mCustomScrollbarIndex"));
		}
	},
	functions={
		/*hide/show scrollbar*/
		showScrollbar:function(){
			this.stop().animate({opacity:1},"fast");
		},
		hideScrollbar:function(){
			this.stop().animate({opacity:0},"fast");
		},
		/*js animation tween*/
		mTweenAxis:function(el,prop,to,duration,easing,callbacks){
			var callbacks=callbacks || {},
				onStart=callbacks.onStart || function(){},onUpdate=callbacks.onUpdate || function(){},onComplete=callbacks.onComplete || function(){};
			var startTime=_getTime(),_delay,progress=0,from=el.offsetTop,elStyle=el.style;
			if(prop==="left"){from=el.offsetLeft;}
			var diff=to-from;
			_cancelTween();
			_startTween();
			function _getTime(){
				if(window.performance && window.performance.now){
					return window.performance.now();
				}else{
					if(window.performance && window.performance.webkitNow){
						return window.performance.webkitNow();
					}else{
						if(Date.now){return Date.now();}else{return new Date().getTime();}
					}
				}
			}
			function _step(){
				if(!progress){onStart.call();}
				progress=_getTime()-startTime;
				_tween();
				if(progress>=el._time){
					el._time=(progress>el._time) ? progress+_delay-(progress- el._time) : progress+_delay-1;
					if(el._time<progress+1){el._time=progress+1;}
				}
				if(el._time<duration){el._id=_request(_step);}else{onComplete.call();}
			}
			function _tween(){
				if(duration>0){
					el.currVal=_ease(el._time,from,diff,duration,easing);
					elStyle[prop]=Math.round(el.currVal)+"px";
				}else{
					elStyle[prop]=to+"px";
				}
				onUpdate.call();
			}
			function _startTween(){
				_delay=1000/60;
				el._time=progress+_delay;
				_request=(!window.requestAnimationFrame) ? function(f){_tween(); return setTimeout(f,0.01);} : window.requestAnimationFrame;
				el._id=_request(_step);
			}
			function _cancelTween(){
				if(el._id==null){return;}
				if(!window.requestAnimationFrame){clearTimeout(el._id);
				}else{window.cancelAnimationFrame(el._id);}
				el._id=null;
			}
			function _ease(t,b,c,d,type){
				switch(type){
					case "linear":
						return c*t/d + b;
						break;
					case "easeOutQuad":
						t /= d; return -c * t*(t-2) + b;
						break;
					case "easeInOutQuad":
						t /= d/2;
						if (t < 1) return c/2*t*t + b;
						t--;
						return -c/2 * (t*(t-2) - 1) + b;
						break;
					case "easeOutCubic":
						t /= d; t--; return c*(t*t*t + 1) + b;
						break;
					case "easeOutQuart":
						t /= d; t--; return -c * (t*t*t*t - 1) + b;
						break;
					case "easeOutQuint":
						t /= d; t--; return c*(t*t*t*t*t + 1) + b;
						break;
					case "easeOutCirc":
						t /= d; t--; return c * Math.sqrt(1 - t*t) + b;
						break;
					case "easeOutSine":
						return c * Math.sin(t/d * (Math.PI/2)) + b;
						break;
					case "easeOutExpo":
						return c * ( -Math.pow( 2, -10 * t/d ) + 1 ) + b;
						break;
					case "mcsEaseOut":
						var ts=(t/=d)*t,tc=ts*t;
						return b+c*(0.499999999999997*tc*ts + -2.5*ts*ts + 5.5*tc + -6.5*ts + 4*t);
						break;
					case "draggerRailEase":
						t /= d/2;
						if (t < 1) return c/2*t*t*t + b;
						t -= 2;
						return c/2*(t*t*t + 2) + b;
						break;
				}
			}
		},
		/*stop js animation tweens*/
		mTweenAxisStop:function(el){
			if(el._id==null){return;}
			if(!window.requestAnimationFrame){clearTimeout(el._id);
			}else{window.cancelAnimationFrame(el._id);}
			el._id=null;
		},
		/*detect requestAnimationFrame and polyfill*/
		rafPolyfill:function(){
			var pfx=["ms","moz","webkit","o"],i=pfx.length;
			while(--i > -1 && !window.requestAnimationFrame){
				window.requestAnimationFrame=window[pfx[i]+"RequestAnimationFrame"];
				window.cancelAnimationFrame=window[pfx[i]+"CancelAnimationFrame"] || window[pfx[i]+"CancelRequestAnimationFrame"];
			}
		}
	}
	/*detect features*/
	functions.rafPolyfill.call(); /*requestAnimationFrame*/
	$.support.touch=!!('ontouchstart' in window); /*touch*/
	$.support.pointer=window.navigator.pointerEnabled; /*pointer support*/
	$.support.msPointer=window.navigator.msPointerEnabled; /*MSPointer support*/
	/*plugin dependencies*/
	/*	var _dlp=("https:"==document.location.protocol) ? "https:" : "http:";
	$.event.special.mousewheel || document.write('<script src="'+_dlp+'//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js"><\/script>');*/
	 /*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
	 * Licensed under the MIT License (LICENSE.txt).
	 *
	 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
	 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
	 * Thanks to: Seamus Leahy for adding deltaX and deltaY
	 *
	 * Version: 3.0.6
	 * 
	 * Requires: 1.2.2+
	 */
	(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery)
	/*plugin fn*/
	$.fn.mCustomScrollbar=function(method){
		if(methods[method]){
			return methods[method].apply(this,Array.prototype.slice.call(arguments,1));
		}else if(typeof method==="object" || !method){
			return methods.init.apply(this,arguments);
		}else{
			$.error("Method "+method+" does not exist");
		}
	};
})(jQuery);

/***************************************************************************************/

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options=$.extend({},options);options.expires=-1;}var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}expires='; expires='+date.toUTCString();}var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}return cookieValue;}};

/***************************************************************************************/

// jquery.event.move
//
// 1.3.6
//
// Stephen Band
//
// Triggers 'movestart', 'move' and 'moveend' events after
// mousemoves following a mousedown cross a distance threshold,
// similar to the native 'dragstart', 'drag' and 'dragend' events.
// Move events are throttled to animation frames. Move event objects
// have the properties:
//
// pageX:
// pageY:   Page coordinates of pointer.
// startX:
// startY:  Page coordinates of pointer at movestart.
// distX:
// distY:  Distance the pointer has moved since movestart.
// deltaX:
// deltaY:  Distance the finger has moved since last event.
// velocityX:
// velocityY:  Average velocity over last few events.


(function (module) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as an anonymous module.
		define(['jquery'], module);
	} else {
		// Browser globals
		module(jQuery);
	}
})(function(jQuery, undefined){

	var // Number of pixels a pressed pointer travels before movestart
			// event is fired.
			threshold = 6,
	
			add = jQuery.event.add,
	
			remove = jQuery.event.remove,

			// Just sugar, so we can have arguments in the same order as
			// add and remove.
			trigger = function(node, type, data) {
				jQuery.event.trigger(type, data, node);
			},

			// Shim for requestAnimationFrame, falling back to timer. See:
			// see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
			requestFrame = (function(){
				return (
					window.requestAnimationFrame ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame ||
					window.oRequestAnimationFrame ||
					window.msRequestAnimationFrame ||
					function(fn, element){
						return window.setTimeout(function(){
							fn();
						}, 25);
					}
				);
			})(),
			
			ignoreTags = {
				textarea: true,
				input: true,
				select: true,
				button: true
			},
			
			mouseevents = {
				move: 'mousemove',
				cancel: 'mouseup dragstart',
				end: 'mouseup'
			},
			
			touchevents = {
				move: 'touchmove',
				cancel: 'touchend',
				end: 'touchend'
			};


	// Constructors
	
	function Timer(fn){
		var callback = fn,
				active = false,
				running = false;
		
		function trigger(time) {
			if (active){
				callback();
				requestFrame(trigger);
				running = true;
				active = false;
			}
			else {
				running = false;
			}
		}
		
		this.kick = function(fn) {
			active = true;
			if (!running) { trigger(); }
		};
		
		this.end = function(fn) {
			var cb = callback;
			
			if (!fn) { return; }
			
			// If the timer is not running, simply call the end callback.
			if (!running) {
				fn();
			}
			// If the timer is running, and has been kicked lately, then
			// queue up the current callback and the end callback, otherwise
			// just the end callback.
			else {
				callback = active ?
					function(){ cb(); fn(); } : 
					fn ;
				
				active = true;
			}
		};
	}


	// Functions
	
	function returnTrue() {
		return true;
	}
	
	function returnFalse() {
		return false;
	}
	
	function preventDefault(e) {
		e.preventDefault();
	}
	
	function preventIgnoreTags(e) {
		// Don't prevent interaction with form elements.
		if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }
		
		e.preventDefault();
	}

	function isLeftButton(e) {
		// Ignore mousedowns on any button other than the left (or primary)
		// mouse button, or when a modifier key is pressed.
		return (e.which === 1 && !e.ctrlKey && !e.altKey);
	}

	function identifiedTouch(touchList, id) {
		var i, l;

		if (touchList.identifiedTouch) {
			return touchList.identifiedTouch(id);
		}
		
		// touchList.identifiedTouch() does not exist in
		// webkit yet… we must do the search ourselves...
		
		i = -1;
		l = touchList.length;
		
		while (++i < l) {
			if (touchList[i].identifier === id) {
				return touchList[i];
			}
		}
	}

	function changedTouch(e, event) {
		var touch = identifiedTouch(e.changedTouches, event.identifier);

		// This isn't the touch you're looking for.
		if (!touch) { return; }

		// Chrome Android (at least) includes touches that have not
		// changed in e.changedTouches. That's a bit annoying. Check
		// that this touch has changed.
		if (touch.pageX === event.pageX && touch.pageY === event.pageY) { return; }

		return touch;
	}


	// Handlers that decide when the first movestart is triggered
	
	function mousedown(e){
		var data;

		if (!isLeftButton(e)) { return; }

		data = {
			target: e.target,
			startX: e.pageX,
			startY: e.pageY,
			timeStamp: e.timeStamp
		};

		add(document, mouseevents.move, mousemove, data);
		add(document, mouseevents.cancel, mouseend, data);
	}

	function mousemove(e){
		var data = e.data;

		checkThreshold(e, data, e, removeMouse);
	}

	function mouseend(e) {
		removeMouse();
	}

	function removeMouse() {
		remove(document, mouseevents.move, mousemove);
		remove(document, mouseevents.cancel, mouseend);
	}

	function touchstart(e) {
		var touch, template;

		// Don't get in the way of interaction with form elements.
		if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

		touch = e.changedTouches[0];
		
		// iOS live updates the touch objects whereas Android gives us copies.
		// That means we can't trust the touchstart object to stay the same,
		// so we must copy the data. This object acts as a template for
		// movestart, move and moveend event objects.
		template = {
			target: touch.target,
			startX: touch.pageX,
			startY: touch.pageY,
			timeStamp: e.timeStamp,
			identifier: touch.identifier
		};

		// Use the touch identifier as a namespace, so that we can later
		// remove handlers pertaining only to this touch.
		add(document, touchevents.move + '.' + touch.identifier, touchmove, template);
		add(document, touchevents.cancel + '.' + touch.identifier, touchend, template);
	}

	function touchmove(e){
		var data = e.data,
				touch = changedTouch(e, data);

		if (!touch) { return; }

		checkThreshold(e, data, touch, removeTouch);
	}

	function touchend(e) {
		var template = e.data,
				touch = identifiedTouch(e.changedTouches, template.identifier);

		if (!touch) { return; }

		removeTouch(template.identifier);
	}

	function removeTouch(identifier) {
		remove(document, '.' + identifier, touchmove);
		remove(document, '.' + identifier, touchend);
	}


	// Logic for deciding when to trigger a movestart.

	function checkThreshold(e, template, touch, fn) {
		var distX = touch.pageX - template.startX,
				distY = touch.pageY - template.startY;

		// Do nothing if the threshold has not been crossed.
		if ((distX * distX) + (distY * distY) < (threshold * threshold)) { return; }

		triggerStart(e, template, touch, distX, distY, fn);
	}

	function handled() {
		// this._handled should return false once, and after return true.
		this._handled = returnTrue;
		return false;
	}

	function flagAsHandled(e) {
		e._handled();
	}

	function triggerStart(e, template, touch, distX, distY, fn) {
		var node = template.target,
				touches, time;

		touches = e.targetTouches;
		time = e.timeStamp - template.timeStamp;

		// Create a movestart object with some special properties that
		// are passed only to the movestart handlers.
		template.type = 'movestart';
		template.distX = distX;
		template.distY = distY;
		template.deltaX = distX;
		template.deltaY = distY;
		template.pageX = touch.pageX;
		template.pageY = touch.pageY;
		template.velocityX = distX / time;
		template.velocityY = distY / time;
		template.targetTouches = touches;
		template.finger = touches ?
			touches.length :
			1 ;

		// The _handled method is fired to tell the default movestart
		// handler that one of the move events is bound.
		template._handled = handled;
			
		// Pass the touchmove event so it can be prevented if or when
		// movestart is handled.
		template._preventTouchmoveDefault = function() {
			e.preventDefault();
		};

		// Trigger the movestart event.
		trigger(template.target, template);

		// Unbind handlers that tracked the touch or mouse up till now.
		fn(template.identifier);
	}


	// Handlers that control what happens following a movestart

	function activeMousemove(e) {
		var timer = e.data.timer;

		e.data.touch = e;
		e.data.timeStamp = e.timeStamp;
		timer.kick();
	}

	function activeMouseend(e) {
		var event = e.data.event,
				timer = e.data.timer;
		
		removeActiveMouse();

		endEvent(event, timer, function() {
			// Unbind the click suppressor, waiting until after mouseup
			// has been handled.
			setTimeout(function(){
				remove(event.target, 'click', returnFalse);
			}, 0);
		});
	}

	function removeActiveMouse(event) {
		remove(document, mouseevents.move, activeMousemove);
		remove(document, mouseevents.end, activeMouseend);
	}

	function activeTouchmove(e) {
		var event = e.data.event,
				timer = e.data.timer,
				touch = changedTouch(e, event);

		if (!touch) { return; }

		// Stop the interface from gesturing
		e.preventDefault();

		event.targetTouches = e.targetTouches;
		e.data.touch = touch;
		e.data.timeStamp = e.timeStamp;
		timer.kick();
	}

	function activeTouchend(e) {
		var event = e.data.event,
				timer = e.data.timer,
				touch = identifiedTouch(e.changedTouches, event.identifier);

		// This isn't the touch you're looking for.
		if (!touch) { return; }

		removeActiveTouch(event);
		endEvent(event, timer);
	}

	function removeActiveTouch(event) {
		remove(document, '.' + event.identifier, activeTouchmove);
		remove(document, '.' + event.identifier, activeTouchend);
	}


	// Logic for triggering move and moveend events

	function updateEvent(event, touch, timeStamp, timer) {
		var time = timeStamp - event.timeStamp;

		event.type = 'move';
		event.distX =  touch.pageX - event.startX;
		event.distY =  touch.pageY - event.startY;
		event.deltaX = touch.pageX - event.pageX;
		event.deltaY = touch.pageY - event.pageY;
		
		// Average the velocity of the last few events using a decay
		// curve to even out spurious jumps in values.
		event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
		event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
		event.pageX =  touch.pageX;
		event.pageY =  touch.pageY;
	}

	function endEvent(event, timer, fn) {
		timer.end(function(){
			event.type = 'moveend';

			trigger(event.target, event);
			
			return fn && fn();
		});
	}


	// jQuery special event definition

	function setup(data, namespaces, eventHandle) {
		// Stop the node from being dragged
		//add(this, 'dragstart.move drag.move', preventDefault);
		
		// Prevent text selection and touch interface scrolling
		//add(this, 'mousedown.move', preventIgnoreTags);
		
		// Tell movestart default handler that we've handled this
		add(this, 'movestart.move', flagAsHandled);

		// Don't bind to the DOM. For speed.
		return true;
	}
	
	function teardown(namespaces) {
		remove(this, 'dragstart drag', preventDefault);
		remove(this, 'mousedown touchstart', preventIgnoreTags);
		remove(this, 'movestart', flagAsHandled);
		
		// Don't bind to the DOM. For speed.
		return true;
	}
	
	function addMethod(handleObj) {
		// We're not interested in preventing defaults for handlers that
		// come from internal move or moveend bindings
		if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
			return;
		}
		
		// Stop the node from being dragged
		add(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid, preventDefault, undefined, handleObj.selector);
		
		// Prevent text selection and touch interface scrolling
		add(this, 'mousedown.' + handleObj.guid, preventIgnoreTags, undefined, handleObj.selector);
	}
	
	function removeMethod(handleObj) {
		if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
			return;
		}
		
		remove(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid);
		remove(this, 'mousedown.' + handleObj.guid);
	}
	
	jQuery.event.special.movestart = {
		setup: setup,
		teardown: teardown,
		add: addMethod,
		remove: removeMethod,

		_default: function(e) {
			var event, data;
			
			// If no move events were bound to any ancestors of this
			// target, high tail it out of here.
			if (!e._handled()) { return; }

			function update(time) {
				updateEvent(event, data.touch, data.timeStamp);
				trigger(e.target, event);
			}

			event = {
				target: e.target,
				startX: e.startX,
				startY: e.startY,
				pageX: e.pageX,
				pageY: e.pageY,
				distX: e.distX,
				distY: e.distY,
				deltaX: e.deltaX,
				deltaY: e.deltaY,
				velocityX: e.velocityX,
				velocityY: e.velocityY,
				timeStamp: e.timeStamp,
				identifier: e.identifier,
				targetTouches: e.targetTouches,
				finger: e.finger
			};

			data = {
				event: event,
				timer: new Timer(update),
				touch: undefined,
				timeStamp: undefined
			};
			
			if (e.identifier === undefined) {
				// We're dealing with a mouse
				// Stop clicks from propagating during a move
				add(e.target, 'click', returnFalse);
				add(document, mouseevents.move, activeMousemove, data);
				add(document, mouseevents.end, activeMouseend, data);
			}
			else {
				// We're dealing with a touch. Stop touchmove doing
				// anything defaulty.
				e._preventTouchmoveDefault();
				add(document, touchevents.move + '.' + e.identifier, activeTouchmove, data);
				add(document, touchevents.end + '.' + e.identifier, activeTouchend, data);
			}
		}
	};

	jQuery.event.special.move = {
		setup: function() {
			// Bind a noop to movestart. Why? It's the movestart
			// setup that decides whether other move events are fired.
			add(this, 'movestart.move', jQuery.noop);
		},
		
		teardown: function() {
			remove(this, 'movestart.move', jQuery.noop);
		}
	};
	
	jQuery.event.special.moveend = {
		setup: function() {
			// Bind a noop to movestart. Why? It's the movestart
			// setup that decides whether other move events are fired.
			add(this, 'movestart.moveend', jQuery.noop);
		},
		
		teardown: function() {
			remove(this, 'movestart.moveend', jQuery.noop);
		}
	};

	add(document, 'mousedown.move', mousedown);
	add(document, 'touchstart.move', touchstart);

	// Make jQuery copy touch event properties over to the jQuery event
	// object, if they are not already listed. But only do the ones we
	// really need. IE7/8 do not have Array#indexOf(), but nor do they
	// have touch events, so let's assume we can ignore them.
	if (typeof Array.prototype.indexOf === 'function') {
		(function(jQuery, undefined){
			var props = ["changedTouches", "targetTouches"],
					l = props.length;
			
			while (l--) {
				if (jQuery.event.props.indexOf(props[l]) === -1) {
					jQuery.event.props.push(props[l]);
				}
			}
		})(jQuery);
	};
});


/*!-Before After*/
(function($){
	if($(".twentytwenty-container").length > 0){
		$.fn.twentytwenty = function(options) {
			var options = $.extend({
				default_offset_pct: 0.5,
				orientation: 'horizontal',
				navigation_follow: false
			}, options);
			return this.each(function() {

				var sliderPct = options.default_offset_pct;
				var container = $(this);
				var sliderOrientation = options.orientation;
				var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
				var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';
				var slideOnHover = options.navigation_follow;

				container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
				var beforeImg = container.find("img:first"),
					afterImg = container.find("img:last"),
					beforeImgAlt = beforeImg.attr("title"),
					afterImgAlt = afterImg.attr("title");
				container.append("<div class='twentytwenty-handle'></div>");
				var slider = container.find(".twentytwenty-handle");
				slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
				slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
				container.addClass("twentytwenty-container");
				beforeImg.addClass("twentytwenty-before");
				afterImg.addClass("twentytwenty-after");
				if(typeof beforeImgAlt != 'undefined' && beforeImgAlt && beforeImgAlt.length > 0) {
					container.append("<div class='twentytwenty-before-label'>" + beforeImgAlt + "</div>");
				};
				if(typeof afterImgAlt != 'undefined' && afterImgAlt && afterImgAlt.length > 0) {
					container.append("<div class='twentytwenty-after-label'>" + afterImgAlt + "</div>");
				}

				var calcOffset = function(dimensionPct) {
					var w = beforeImg.width();
					var h = beforeImg.height();
					return {
						w: w+"px",
						h: h+"px",
						cw: (dimensionPct*w)+"px",
						ch: (dimensionPct*h)+"px"
					};
				};

				var adjustContainer = function(offset) {
					if (sliderOrientation === 'vertical') {
						beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
					}
					else {
						beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
					}
					container.css("height", offset.h);
				};

				var adjustSlider = function(pct) {
					var offset = calcOffset(pct);
					slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
					adjustContainer(offset);
				};

				$(window).on("resize.twentytwenty", function(e) {
					adjustSlider(sliderPct);
				});

				var offsetX = 0;
				var imgWidth = 0;
				slider.on("movestart", function(e) {
					if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
						e.preventDefault();
					}
					else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
						e.preventDefault();
					}
					container.addClass("active");
					container.removeClass("active-click");
					offsetX = container.offset().left;
					offsetY = container.offset().top;
					imgWidth = beforeImg.width(); 
					imgHeight = beforeImg.height();
				});

				slider.on("moveend", function(e) {
					container.removeClass("active");
				});

				slider.on("move", function(e) {
					if (container.hasClass("active")) {
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					}
				});
				if (!slideOnHover && !container.hasClass("active")) {
					container.on("mouseup", function(e) {
						container.removeClass("active-click");
					});
					container.on("mousedown", function(e) {
						//container.addClass("active");
						container.addClass("active-click");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width(); 
						imgHeight = beforeImg.height();
						sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
						if (sliderPct < 0) {
							sliderPct = 0;
						}
						if (sliderPct > 1) {
							sliderPct = 1;
						}
						adjustSlider(sliderPct);
					});
				};

				container.find("img").on("mousedown", function(event) {
					event.preventDefault();
				});

				if (slideOnHover) {
					container.on("mouseenter", function (e) {
						container.addClass("active");
						offsetX = container.offset().left;
						offsetY = container.offset().top;
						imgWidth = beforeImg.width();
						imgHeight = beforeImg.height()
					});
					container.on("mouseleave", function (e) {
						container.removeClass("active")
					});
					container.on("mousemove", function (e) {
						if (container.hasClass("active")) {
							sliderPct = sliderOrientation === "vertical" ? (e.pageY - offsetY) / imgHeight : (e.pageX - offsetX) / imgWidth;
							if (sliderPct < 0) {
								sliderPct = 0
							}
							if (sliderPct > 1) {
								sliderPct = 1
							}
							adjustSlider(sliderPct)
						}
					});
				};

				$(window).trigger("resize.twentytwenty");
			});
		};
	}

$.fn.exists = function() {
		if ($(this).length > 0) {
			return true;
		} else {
			return false;
		}
	}

	$.fn.loaded = function(callback, jointCallback, ensureCallback){
		var len = this.length;
		if (len > 0) {
			return this.each(function() {
				var el    = this,
					$el  = $(el),
					blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

				$el.on("load.dt", function(event) {
					$(this).off("load.dt");
					if (typeof callback == "function") {
						callback.call(this);
					}
					if (--len <= 0 && (typeof jointCallback == "function")){
						jointCallback.call(this);
					}
				});

				if (!el.complete || el.complete === undefined) {
					el.src = el.src;
				} else {
					$el.trigger("load.dt")
				}
			});
		} else if (ensureCallback) {
			if (typeof jointCallback == "function") {
				jointCallback.call(this);
			}
			return this;
		}
	};

	$.rsCSS3Easing = {
		easeOutSine: 'cubic-bezier(0.390, 0.575, 0.565, 1.000)',
		easeInOutSine: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
	};

	$.extend(jQuery.easing, {
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});

	$.thePhotoSlider = function(element, settings) {
		var self = $(element).data("thePhotoSlider");

		if (!self) {
			this._init(element, settings);
		}
		else {
			self.update();
		};
	};

	$.thePhotoSlider.defaults = {
		mode: {
			type: "slider"
		},
		responsive: true,
		height: false,
		width: false,
		sidePaddings: 0,
		storeHTML: false,
		autoPlay: false,
		threshold: 20,
		collapsePoint: 700
	};

	$.thePhotoSlider.prototype = {
		_init: function(element, settings) {
			var self = this;
			self.st = $.extend({}, $.thePhotoSlider.defaults, settings);
			self.ev = $(self);

			self.autoPlay = {
				enabled: false,
				delay: 2000,
				loop: true
			};

			self.currSlide = 0;
			self.noSlide = true;
			self.lockLeft = true;
			self.lockRight = true;

			self.sliderLock = false;
			self.lockTimeout = false;

			self.wrap = {};
			self.wrap.$el = $(element);
			self.wrap.width = 0;
			self.wrap.height = false;
			self.wrap.$el.data("thePhotoSlider", self);

			self.viewport = self.wrap.$el.find(".ts-viewport");

			self.cont = {};
			self.cont.$el = self.viewport.find(".ts-cont");
			self.cont.width = 0;
			self.cont.startX = 0;
			self.cont.instantX = 0;
	 
			self.slides = {};
			self.slides.$items = self.cont.$el.children();
			self.slides.number = self.slides.$items.length;
			self.slides.position = [];
			self.slides.width = [];
			self.slides.isLoaded = [];

			self.drag = {};
			self.drag.isMoving = false;
			self.drag.startX = 0;
			self.drag.startY = 0;
			self.drag.offsetX = 0;
			self.drag.offsetY = 0;
			self.drag.lockX = false;
			self.drag.lockY = false;

			self.features = {};
			self._featureDetection();

			if (self.st.storeHTML) self.origHTML = self.wrap.$el.html();
			self._buildHTML();

			self._calcSliderSize();
			if (!self.wrap.height) self.wrap.$el.addClass("ts-autoHeight");

			self._setSliderWidth();
			self._adjustSlides();
			self._setSliderHeight();

			/* if (self.st.mode.type === "centered") */ self.slideTo(0, true);

			if (!self.noSlide) self._bindEvents();

			setTimeout(function() {
				self.wrap.$el.addClass("ts-ready");
				self.ev.trigger("sliderReady");
			}, 20);

			if (self.st.responsive) {
				if (!("onorientationchange" in window)) {
					var dtResizeTimeout;

					$(window).on("resize", function(e) {
						clearTimeout(dtResizeTimeout);
						dtResizeTimeout = setTimeout(function() {
							self.update();
						}, 200);
					});
				}
				else {
					var scrOrientation = window.orientation;

					$(window).on("orientationchange", function(e) {
						var tempOrientation = window.orientation;

						if (tempOrientation !== scrOrientation) {
							scrOrientation = tempOrientation;
							self.update();
						};
					});
				};
			};

			if(self.st.autoPlay.enabled) {
				self.play();
			};
		},

		_featureDetection: function() {
			var self = this,
				tempStyle = document.createElement('div').style,
				vendors = ['webkit','Moz','ms','O'],
				tempV;
				self.features.vendor = '';


			for (i = 0; i < vendors.length; i++ ) {
				tempV = vendors[i];
				if (!self.features.vendor && (tempV + 'Transform') in tempStyle ) {
					self.features.vendor = "-"+tempV.toLowerCase()+"-";
				}
			}

			if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 && !('ontouchstart' in window)) {
				self.features.css3d = Modernizr.csstransforms3d;
				//self.features.css3d = false;
			}
			else if (typeof Modernizr != "undefined") {
				self.features.css3d = Modernizr.csstransforms3d;
				//self.features.css3d = false;
			}
		},

		_buildHTML: function() {
			var self = this;

			if (self.st.mode.type === "centered") {
				self.wrap.$el.addClass("ts-centered");
			};

			if (self.st.mode.type === "slider") {
				self.slides.$items.addClass("ts-slide");
			}
			else if (self.st.mode.type === "scroller" || self.st.mode.type === "centered" || self.st.mode.type === "carousel") {
				self.slides.$items.addClass("ts-cell");
			};
		},

		_calcSliderSize: function() {
			var self = this,
				typeofWidth = typeof self.st.width,
				typeofHeight = typeof self.st.height,
				tempWidth = false,
				tempHeight = false;

			self.wrap.width = self.wrap.$el.width();

			if (typeofWidth === "function") {
				tempWidth = self.st.width(this);
			}
			else if (typeofWidth === "number") {
				tempWidth = self.st.width;
			};

			if (typeofHeight === "function") {
				tempHeight = self.st.height(this);
			}
			else if (typeofHeight === "number") {
				tempHeight = self.st.height;
			};

			if (tempHeight && !tempWidth) { 
				// Calculate once or on resize (if typeofHeight === "function")
				self.wrap.height = tempHeight;
			}
			else if (tempHeight && tempWidth) {
				// Calculate on resize
				self.wrap.height = ( tempHeight * self.wrap.width ) / tempWidth;
			}
			else {
				// Calculate on every slide change and resize
				self.wrap.height = false;
			};
		},

		_setSliderWidth: function() {
			var self = this;

			if (self.st.mode.type !== "centered") {
				self.viewport.css({
					width: self.wrap.width
				});
			}
			else if (self.wrap.width > self.st.collapsePoint) {
				self.wrap.$el.removeClass("ts-collapsed");
			}
			else {
				self.wrap.$el.addClass("ts-collapsed");
			};
		},

		_setSliderHeight: function() {
			var self = this;

			if (typeof self.wrap.height === "number") {
				// Fixed & proportional height
				self.viewport.css({
					height: self.wrap.height
				});
			}
			else if (self.st.mode.type === "scroller" || self.st.mode.type === "centered" || self.st.mode.type === "carousel") {
				// Auto height; scroller and centered only
				if (self.viewport.css("height") === "0px" || self.viewport.css("height") == 0 || !self.viewport.css("height")) {
					self.viewport.css({
						height: Math.max.apply(null, self.slides.height)
					});
				};
			}
			else if (self.slides.isLoaded[self.currSlide]) {
				// Auto height; current slide is loaded
				var jsHeight = $(self.slides.$items[self.currSlide]).height();

				if (jsHeight > 0) {
					self.viewport.css({
						height: jsHeight
					});
				}
				else {
					// !This will cause "collapsed" slider
					self.viewport.css({
						height: auto
					});
				};
			}
			else {
				// Auto height; current slide is NOT loaded
				var jsHeight = $(self.slides.$items[self.currSlide]).height();

				if (jsHeight > 0) {
					self.viewport.css({
						height: jsHeight
					});
				}
				else {
					// !This will cause "collapsed" slider
					self.viewport.css({
						height: auto
					});
				};

				// !What this doing here (instead of _adjustSlides)
	/*
				self.slides.$items[self.currSlide].find("img").loaded(false, function() {
					$(self.slides.$items[self.currSlide]).addClass("ts-loaded");
					self._setSliderHeight();
				}, true);
	*/
			};
		},

		_adjustSlides: function() {
			var self = this;

			if (self.st.mode.type === "slider") {
				self.cont.width = 0;

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};
					
					self.slides.position[i] = - self.cont.width - self.st.sidePaddings/2;
					self.cont.width = self.cont.width + self.wrap.width + self.st.sidePaddings;
					//if (self.wrap.height) tempCSS.height = self.wrap.height;
					tempCSS.left = -self.slides.position[i];

					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					} else {
					};

					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "centered") {
					self.cont.width = 0;
					self.slides.contRatio = [];
					self.slides.ratio = [];

				if (self.st.mode.lsMinW || self.st.mode.lsMaxW) {
					var lsMinW = self.wrap.width/100 * self.st.mode.lsMinW,
						lsMaxW = self.wrap.width/100 * self.st.mode.lsMaxW;
				};

				if (self.st.mode.ptMinW || self.st.mode.ptMaxW) {
					var ptMinW = self.wrap.width/100 * self.st.mode.ptMinW,
						ptMaxW = self.wrap.width/100 * self.st.mode.ptMaxW;
				};

				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					var dataWidth = $slide.attr("data-width") ? parseFloat($slide.attr("data-width")) : $slide.width(),
						dataHeight = $slide.attr("data-height") ? parseFloat($slide.attr("data-height")) : $slide.height();

					if (!self.slides.contRatio[i]) {
						self.slides.contRatio[i] =  dataWidth / dataHeight;

						if (self.slides.contRatio[i] > 1) {
							$slide.addClass("ts-ls");
						}
						else {
							$slide.addClass("ts-pt");
						};
					};

					if (self.wrap.width > self.st.collapsePoint) {
						dataHeight = self.wrap.height;
						dataWidth = self.wrap.height * self.slides.contRatio[i];
	
						if ((lsMinW || lsMaxW) && (dataWidth > dataHeight)) {
							if (lsMinW === lsMaxW || dataWidth > lsMaxW) {
								dataWidth = lsMaxW;
							}
							else if (dataWidth < lsMinW) {
								dataWidth = lsMinW;
							};
						}
						else if ((ptMinW || ptMaxW) && (dataWidth <= dataHeight)) {
							if (ptMinW === ptMaxW || dataWidth > ptMaxW) {
								dataWidth = ptMaxW;
							}
							else if (dataWidth < ptMinW) {
								dataWidth = ptMinW;
							};            
						};
	
						self.slides.ratio[i] = dataWidth / dataHeight;

						tempCSS.height = self.wrap.height;
						tempCSS.width = self.slides.width[i] = dataWidth;
	
						self.slides.position[i] = - self.cont.width;
						self.cont.width = self.cont.width + self.slides.width[i] + self.st.sidePaddings;
						tempCSS.left = -self.slides.position[i];
					}
					else {
						dataHeight = tempCSS.height = self.wrap.height;
						dataWidth = self.slides.width[i] = tempCSS.width = self.wrap.width;
						self.slides.ratio[i] = dataWidth / dataHeight;

						self.slides.position[i] = - self.cont.width;
						self.cont.width = self.cont.width + self.slides.width[i];

						tempCSS.left = -self.slides.position[i];
					};

					// Adjust position to slide center
					self.slides.position[i] = self.slides.position[i] - (self.slides.width[i]/2);


					if (self.slides.ratio[i] > self.slides.contRatio[i]) {
						$slide.removeClass("ts-narrow");
						$slide.addClass("ts-wide");
					}
					else {
						$slide.removeClass("ts-wide");
						$slide.addClass("ts-narrow");
					};

					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					} 
					else {
					};

					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "scroller") {
				self.cont.width = 0;
				self.slides.ratio = [];
				if (!(typeof self.wrap.height === "number")) {
					self.slides.height = [];
				}
	
				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					var dataWidth = $slide.attr("data-width") ? parseFloat($slide.attr("data-width")) : $slide.width(),
						dataHeight = $slide.attr("data-height") ? parseFloat($slide.attr("data-height")) : $slide.height();
	
					if (dataWidth > 0 && dataHeight > 0) {
						self.slides.ratio[i] =  dataWidth / dataHeight;
					}
					else {
						self.slides.ratio[i] = 1;
					};
	
					if (typeof self.wrap.height === "number") {
						// Fixed & proportional height
						self.slides.width[i] = self.wrap.height * self.slides.ratio[i];
	
						tempCSS.width = self.slides.width[i];
						tempCSS.height = self.slides.width[i] / self.slides.ratio[i]; 
					}
					else if (dataWidth > 0 && dataHeight > 0) {
						// Auto height;
						if (!self.slides.width[i]) tempCSS.width = self.slides.width[i] = dataWidth;
						if (!self.slides.height[i]) { 
							tempCSS.height = "100%";
						};
						self.slides.height[i] = dataHeight;
					}
					else {
						// Auto height;
						$slide.css("height", "auto");

						self.slides.width[i] = $slide.width();
						self.slides.height[i] = $slide.height();

						tempCSS.height = "100%";
					};

					self.slides.position[i] = - self.cont.width;
					self.cont.width = self.cont.width + self.slides.width[i];
					if (i < self.slides.number - 1) self.cont.width += self.st.sidePaddings
					tempCSS.left = -self.slides.position[i]// + self.st.sidePaddings/2;
	
					if (!self.slides.isLoaded[i]) {
						$slide.find("img").loaded(false, function() {
							self.slides.isLoaded[i] = true;
							$slide.addClass("ts-loaded");
						}, true);
					}
					else {
					};
	
					$slide.css(tempCSS);
				});
			}
			else if (self.st.mode.type === "carousel") {
				self.cont.width = 0;

				var perView =  self.st.mode.perView,
					minWidth = self.st.mode.minWidth,
					cellWidth = self.wrap.width/perView;
		
				while (cellWidth < minWidth && perView > 0.31) {
					perView--;
					if (perView < 1) perView = 1;
					cellWidth = self.wrap.width/perView;
				};

				self.perView = perView;
				//self.st.sidePaddings = 0;
		
				self.slides.$items.each(function(i) {
					var $slide = $(self.slides.$items[i]),
						tempCSS = {};

					self.slides.position[i] = - self.cont.width;
					self.cont.width = self.cont.width + cellWidth;
					tempCSS.width = cellWidth - self.st.sidePaddings;
					tempCSS.left = -self.slides.position[i] + self.st.sidePaddings/2;

					$slide.css(tempCSS);
				});
			};

			// Adjusting slides conteiner position and updating navigation
			if ( (self.st.mode.type !== "centered") && (self.cont.width <= self.wrap.width) ) {
				self.noSlide = true;
				self._transitionStart(0, 0, "easeInOutSine", true);
				self.cont.$el.css( "left", (self.wrap.width - self.cont.width) / 2 );

				self.lockLeft = true;
				self.lockRight = true;
				self.ev.trigger("updateNav");
			}
			else if ( (self.st.mode.type === "centered") && (self.slides.number < 2) /* && (self.cont.width <= self.wrap.width / 2) */ ) {
				self.noSlide = true;
				self._transitionStart(0, 0, "easeInOutSine", true);
				self.cont.$el.css( "left", -(self.cont.width) / 2 );

				self.lockLeft = true;
				self.lockRight = true;
				self.ev.trigger("updateNav");
			}
			else {
				self.noSlide = false;
				self.cont.$el.css( "left", "" );

				if (self.lockRight) {
					self.lockLeft = false;
					self.lockRight = true;
					self.ev.trigger("lockRight").trigger("updateNav");
				}
				else if ( self.currSlide <= 0 ) {
					self.lockLeft = true;
					self.lockRight = false;
					self.ev.trigger("lockLeft").trigger("updateNav");
				}
				else if ( self.currSlide > 0 ) {
					self.lockLeft = false;
					self.lockRight = false;
					self.ev.trigger("updateNav");
				};
			};
		},

		_unifiedEvent: function(event) {
			if (event.originalEvent.touches !== undefined && event.originalEvent.touches[0]) {
				event.pageX = event.originalEvent.touches[0].pageX;
				event.pageY = event.originalEvent.touches[0].pageY;
			}
			return event;
		},

		_unifiedX: function() {
			var self = this,
				coord = 0,
				css3dTransform = self.cont.$el.css("transform");

			if (css3dTransform) {
				var css3dArray = css3dTransform.split(", ");
			}

			if (self.features.css3d && css3dTransform !== "none" && css3dArray[0] === "matrix(1") {
				coord = parseFloat(css3dArray[4]);
			}
			else if (self.features.css3d && css3dTransform !== "none" && css3dArray[0] === "matrix3d(1") {
				coord = parseFloat(css3dArray[12]);
			}
			else {
				//coord = self.cont.$el.position().left;
				coord = parseFloat(self.cont.$el.css("left"));
			};

			return coord;
		},

		_bindEvents: function() {
			var self = this;

			self.wrap.$el.on("mousedown.theSlider touchstart.theSlider", function(event) {
				if (event.type != "touchstart") event.preventDefault();

				self._onStart( self._unifiedEvent(event) );

				$(document).on("mousemove.theSlider touchmove.theSlider", function(event) {
					self._onMove( self._unifiedEvent(event) );
				});
				$(document).on("mouseup.theSlider mouseleave.theSlider touchend.theSlider touchcancel.theSlider", function(event) {
					$(document).off("mousemove.theSlider mouseup.theSlider mouseleave.theSlider touchmove.theSlider touchend.theSlider touchcancel.theSlider");
					self._onStop( self._unifiedEvent(event) );
				});
			});
		},

		_unbindEvents: function() {
			var self = this;

			self.wrap.$el.off("mousedown.theSlider touchstart.theSlider");
			$(document).off("mousemove.theSlider mouseup.theSlider mouseleave.theSlider touchmove.theSlider touchend.theSlider touchcancel.theSlider");
		},

		_onStart: function(event) {
			var self = this;

			if (!self.drag.isMoving && !self.sliderLock) {
				//self._transitionEnd();

				self.drag.isMoving = true;
				self.drag.startX = event.pageX;
				self.drag.startY = event.pageY;
				self.cont.startX = self._unifiedX();

				self.drag.offsetX = 0;
				self.drag.offsetY = 0;
				self.drag.lockX = false;
				self.drag.lockY = false;
			}
			else {
				//self._transitionCancel();
			};
		},

		_onMove: function(event) {
			var self = this,
				coord = 0;

			if (self.drag.isMoving) {
				self.drag.offsetX = event.pageX - self.drag.startX;
				self.drag.offsetY = event.pageY - self.drag.startY;

				if ( (Math.abs(self.drag.offsetX) >= self.st.threshold-1) && (Math.abs(self.drag.offsetX) > Math.abs(self.drag.offsetY)) && !self.drag.lockX ) {
					self.drag.lockX = false;
					self.drag.lockY = true;
					if (event.type == "touchmove") self.drag.offsetY = 0;
				} 
				else if( (Math.abs(self.drag.offsetY) >= self.st.threshold-1) && (Math.abs(self.drag.offsetX) < Math.abs(self.drag.offsetY)) && !self.drag.lockY ) {
					self.drag.lockX = true;
					self.drag.lockY = false;
					if (event.type == "touchmove") self.drag.offsetX = 0;
				};

				if (self.drag.lockX && event.type == "touchmove") self.drag.offsetX = 0;
				else if (self.drag.lockY && event.type == "touchmove") self.drag.offsetY = 0;

				if (self.drag.lockY) event.preventDefault();

				self.cont.instantX = self.cont.startX + self.drag.offsetX;

				if ( self.cont.instantX < 0 && self.cont.instantX > -self.cont.width + self.viewport.width()) {
					coord = self.cont.instantX;
				}
				else if (self.cont.instantX >= 0) {
					coord = self.cont.instantX/4;
				}
				else {
					coord = (-self.cont.width + self.viewport.width()) + ((self.cont.width - self.viewport.width() + self.cont.instantX) / 4);
				};

				self._doDrag(coord);
			};

			if (self.st.autoPlay.enabled) {
				self.pause();
			};
		},

		_onStop: function(event) {
			var self = this;

			if (self.drag.isMoving) {
				self.cont.instantX = self.cont.startX + self.drag.offsetX;

				if (Math.abs(self.drag.offsetX) > self.st.threshold) {
					self.wrap.$el.addClass("ts-interceptClicks");
					self.wrap.$el.one("click.preventClick", function(e) {
						e.preventDefault();
						e.stopImmediatePropagation();
						e.stopPropagation();
					}); 
					window.setTimeout(function() {
						self.wrap.$el.off('click.preventClick');
						self.wrap.$el.removeClass("ts-interceptClicks");
					}, 301);
				};

				self._autoAdjust();
				self._setSliderHeight();

				self.cont.startX = 0;
				self.cont.instantX = 0;
		
				self.drag.isMoving = false;
				self.drag.startX = 0;
				self.drag.startY = 0;
				self.drag.offsetX = 0;
				self.drag.offsetY = 0;
				self.drag.lockX = false;
				self.drag.lockY = false;
			};

			if(self.st.autoPlay.enabled) {
				self.play();
			}

			return false;
		},

		_doDrag: function(coord) {
			var self = this;

			if (self.features.css3d) {
				var tempCSS = {};

				tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS[self.vendor+"transition"] = "";
				tempCSS["transition"] = "";

				self.cont.$el.css(tempCSS);
			}
			else {
				self.cont.$el.css({
					"left": coord
				});
			};
		},

		_calcCurrSlide: function(coord) {
			var self = this,
				tempCurrSlide = self.slides.number - 1;

			self.slides.$items.each(function(i) {
				if ( coord > self.slides.position[i] ) {
					tempCurrSlide = i-1;
					return false;
				};
			});
			if (tempCurrSlide < 0) tempCurrSlide = 0;

			return tempCurrSlide;
		},

		_isRightExceed: function(coord) {
			var self = this,
				edge = 0;

			if (self.st.mode.type === "centered") {
				edge = self.slides.position[self.slides.number - 1];
			}
			else {
				edge = -self.cont.width + self.viewport.width();
			};

			if (coord < edge) {
				return true;
			}
			else {
				return false;
			};
		},

		_autoAdjust: function() {
			var self = this,
				adjustTo = 0,
				duration = 0,
				tempCurrSlide = self.slides.number - 1;

			/*
			if (self.drag.offsetX == 0) {
				console.log("No movement. Canceling _autoAdjust.");
				return false;
			}
			*/

			if (self.cont.instantX >= 0) {
				// leftmost edge reached
				adjustTo = self.slides.position[0];
				self.currSlide = 0;

				self.lockLeft = true;
				self.lockRight = false;
				self.ev.trigger("lockLeft").trigger("updateNav");
			}
			else if ( self._isRightExceed(self.cont.instantX) ) {
				// rightmost edge reached
				if (self.st.mode.type === "centered") {
					adjustTo = self.slides.position[self.slides.number-1];
				}
				else {
					adjustTo = -self.cont.width + self.viewport.width();
				};

				self.currSlide = self._calcCurrSlide(adjustTo);

				self.lockLeft = false;
				self.lockRight = true;
				self.ev.trigger("lockRight").trigger("updateNav");
			}
			else {
				// autoadjust to closest slide
				if (self.drag.offsetX < -self.st.threshold) {
					// flick from right to left
					tempCurrSlide = self._calcCurrSlide(self.cont.instantX) + 1;

					if (self._isRightExceed(self.slides.position[tempCurrSlide])) {
						adjustTo = -self.cont.width + self.viewport.width();

						for ( i = tempCurrSlide; i >= 0; i-- ) {
							if (!self._isRightExceed(self.slides.position[i])) {
								tempCurrSlide = i;
								break;
							}
						}

						self.lockLeft = false;
						self.lockRight = true;
						self.ev.trigger("lockRight").trigger("updateNav");
					}
					else {
						adjustTo = self.slides.position[tempCurrSlide];

						if  ( tempCurrSlide < self.slides.number - 1 ) {
							self.lockLeft = false;
							self.lockRight = false;
							self.ev.trigger("updateNav");
						}
						else {
							self.lockLeft = false;
							self.lockRight = true;
							self.ev.trigger("lockRight").trigger("updateNav");
						};
					};

					self.currSlide = tempCurrSlide;
				}
				else if (self.drag.offsetX > self.st.threshold) {
					// flick from left to right
					self.currSlide = self._calcCurrSlide(self.cont.instantX);
					adjustTo = self.slides.position[self.currSlide];

					if ( self.currSlide > 0 ) {
						self.lockLeft = false;
						self.lockRight = false;
						self.ev.trigger("updateNav");
					}
					else {
						self.lockLeft = true;
						self.lockRight = false;
						self.ev.trigger("lockLeft").trigger("updateNav");
					};
				}
				else {
					// flick cenceled, since it's to short
					adjustTo = self.cont.startX;
				};

			};


			//duration = Math.sqrt(Math.abs(self.cont.instantX - adjustTo)) * 15 + 50;
			// duration = Math.abs(self.cont.instantX - adjustTo)/2 + 100;
			duration = Math.sqrt(Math.abs(self.cont.instantX - adjustTo)) * 10 + 100;
			self._transitionStart(adjustTo, duration, "easeOutSine");
		},

		_transitionStart: function(coord, duration, easing, justSet) {
			var self = this,
				tempCSS = {},
				cssEasing = $.rsCSS3Easing[easing];

			self._transitionEnd();
			self.ev.trigger("beforeTransition");

			if (justSet) {
				if (self.features.css3d) {
					tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
					tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
				}
				else {
					//console.log("and, here's the issue");
					tempCSS.left = coord;
				};

				self.cont.$el.css(tempCSS);
				return false;
			}

			self.ev.trigger("beforeTransition");

			self.sliderLock = true;
			clearTimeout(self.lockTimeout);
			self.lockTimeout = setTimeout(function() {
				self.sliderLock = false;
				self.ev.trigger("afterTransition");
			}, duration);

			if (self.features.css3d) {
				tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS["transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS[self.features.vendor+"transition"] = "all "+duration+"ms "+cssEasing;
				tempCSS["transition"] = "all "+duration+"ms "+cssEasing;

				self.cont.$el.css(tempCSS);

				self.cont.$el.one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function() {
					//self.sliderLock = false;
					//console.log("Release slider. sliderLock: "+self.sliderLock);

					//self._transitionEnd();
				});
			}
			else {
				//self.sliderLock = false;
				//console.log("Release slider. sliderLock: "+self.sliderLock);
				self.cont.$el.animate({
					"left": coord
				}, duration, easing);
			};
		},

		_transitionEnd: function() {
			var self = this;

			if (self.features.css3d) {
				var tempCSS = {};
					tempCSS[self.vendor+"transition"] = "";
					tempCSS["transition"] = "";

				self.cont.$el.css(tempCSS);
			}
			else {
				self.cont.$el.stop();
			};
		},

		_transitionCancel: function() {
			var self = this,
				coord = self.cont.$el.position().left,
				tempCSS = {};

			tempCSS[self.vendor+"transition"] = "";
			tempCSS["transition"] = "";

			self.cont.$el.off("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend");

			if (self.features.css3d) {
				var str = self.cont.$el.css("transform"),
					result = str.split(", ");

				coord = result[4];

				tempCSS[self.features.vendor+"transform"] = "translate3d("+coord+"px,0,0)";
				tempCSS["transform"] = "translate3d("+coord+"px,0,0)";

				self.cont.$el.css(tempCSS);
			}
			else {
				self.cont.$el.stop();
				self.cont.$el.animate({
					"left": coord
				}, duration, easing);
			};
		},

		pause: function() {
			var self = this;
			self._autoPlayRunning = false;
			if( self._autoPlayTimeout) {
				clearTimeout(self._autoPlayTimeout);
				self._autoPlayTimeout = null;
			}
			
		},

		slideTo: function(slideID, justSet) {
			var self = this,
				slideToX = self.slides.position[slideID],
				duration = 0,
				oldID = self.currSlide;
			self.pause();

			if (self.noSlide) return false;

			self._transitionEnd();

			if (slideToX >= self.slides.position[0]) {
				// leftmost edge reached
				self.currSlide = 0;

				self.lockLeft = true;
				self.lockRight = false;
				self.ev.trigger("lockLeft").trigger("updateNav");
			}
			else if ( self._isRightExceed(slideToX) || slideID >= self.slides.number - 1 ) {
				// rightmost edge reached
				if (self.st.mode.type === "centered") {
					slideToX = self.slides.position[slideID];
					self.currSlide = slideID;
				}
				else {
					slideToX = -self.cont.width + self.viewport.width();
					self.currSlide = self._calcCurrSlide(slideToX);
				};

				self.lockLeft = false;
				self.lockRight = true;
				self.ev.trigger("lockRight").trigger("updateNav");
			}
			else {
				self.currSlide = slideID;

				self.lockLeft = false;
				self.lockRight = false;
				self.ev.trigger("updateNav");
			};

			//duration = Math.abs(self.slides.position[oldID] - slideToX)/2 + 100;
			duration = Math.sqrt(Math.abs(self.slides.position[oldID] - slideToX)) * 10 + 100;
			self._transitionStart(slideToX, duration, "easeInOutSine", justSet);

			if ( /*$(".auto-play-btn").hasClass('paused')*/self.st.autoPlay.enabled) {
				self.play();
			}
		},

		startPlay: function() {
			var self = this;

			if (self.currSlide + 1 <= self.slides.number - 1 && !self.lockRight) {
				self.slideTo(self.currSlide + 1);
			}
			else if (self.currSlide >= self.slides.number-1 && self.st.autoPlay.loop) {
				self.slideTo(0);
			}
			else if (self.lockRight && self.st.autoPlay.loop) {
				self.slideTo(0);
			}

			/*
			if (self.st.mode.type === "centered") {
				slideToX = self.slides.position[slideID];
				self.currSlide = slideID;
			}
			else {
				slideToX = -self.cont.width + self.viewport.width();
				self.currSlide = self._calcCurrSlide(slideToX);
			};
			*/
		},

		play: function() {
			var self = this;
			self._autoPlayRunning = true;
			if(self._autoPlayTimeout) {
				clearTimeout(self._autoPlayTimeout);
			}
			self._autoPlayTimeout = setTimeout( function() {
				self.startPlay();
			}, self.st.autoPlay.delay );
		},

		slideNext: function() {
			var self = this;

			if (self.currSlide + 1 <= self.slides.number - 1) {
				self.slideTo(self.currSlide + 1);
			}
			else {
				return false;
			};
		},

		slidePrev: function() {
			var self = this;

			if (self.currSlide - 1 >= 0) {
				self.slideTo(self.currSlide - 1);
			}
			else if (self.currSlide == 0 && self.lockLeft == false) {
				self.slideTo(self.currSlide);
			}
			else {
				return false;
			};
		},

		update: function() {
			var self = this;

			self._calcSliderSize();
			self._setSliderWidth();
			self._adjustSlides();
			self._setSliderHeight();
			self._doDrag();

			if (self.noSlide) {
				self.slideTo(0, true);
				self._unbindEvents();
			}
			else {
				self.slideTo(self.currSlide, true);
				self._bindEvents();
			}
		}
	};

	$.fn.thePhotoSlider = function(settings) {
		return this.each(function() {
			new $.thePhotoSlider(this, settings);
		});
	};

})(jQuery);

/***************************************************************************************/

/* !Animation Core */

/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */

(function($) {

	$.belowthefold = function(element, settings) {
		var fold = $(window).height() + $(window).scrollTop();
		return fold <= $(element).offset().top - settings.threshold;
	};
	$.abovethetop = function(element, settings) {
		var top = $(window).scrollTop();
		return top >= $(element).offset().top + $(element).height() - settings.threshold;
	};
	$.rightofscreen = function(element, settings) {
		var fold = $(window).width() + $(window).scrollLeft();
		return fold <= $(element).offset().left - settings.threshold;
	};
	$.leftofscreen = function(element, settings) {
		var left = $(window).scrollLeft();
		return left >= $(element).offset().left + $(element).width() - settings.threshold;
	};
	$.inviewport = function(element, settings) {
		return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
	};

	$.extend($.expr[':'], {
		"below-the-fold": function(a, i, m) {
			return $.belowthefold(a, {threshold : 0});
		},
		"above-the-top": function(a, i, m) {
			return $.abovethetop(a, {threshold : 0});
		},
		"left-of-screen": function(a, i, m) {
			return $.leftofscreen(a, {threshold : 0});
		},
		"right-of-screen": function(a, i, m) {
			return $.rightofscreen(a, {threshold : 0});
		},
		"in-viewport": function(a, i, m) {
			return $.inviewport(a, {threshold : -30});
		}
	});

})(jQuery);

/***************************************************************************************/

jQuery(document).ready(function($) {

	if(!dtGlobals.isMobile){
		$("body").addClass("no-mobile");
	};
	if(dtGlobals.isiPhone){
		$("body").addClass("is-iphone");
	};

	// !- Skills
	$.fn.animateSkills = function() {
		$(".skill-value", this).each(function () {
			var $this = $(this),
				$this_data = $this.data("width");

			$this.css({
				width: $this_data + '%'
			});
		});
	};

	// !- Animation "onScroll" loop
	function doAnimation() {
		if(!dtGlobals.isMobile){
			var j = -1;
			$(".animation-at-the-same-time:in-viewport").each(function () {
				var $this = $(this),
					$thisElem = $this.find(".animate-element");
				//if (!$thisElem.hasClass("start-animation") && !$thisElem.hasClass("animation-triggered")) {
					$thisElem.addClass("animation-triggered");
					$this.find(".animate-element:not(.start-animation)").addClass("start-animation");
				//};
			});
			$(".animate-element:not(.start-animation):in-viewport").each(function () {
				var $this = $(this);
				if (!$this.parents(".animation-at-the-same-time").length > 0) {

					if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
						$this.addClass("animation-triggered");
						j++;
						setTimeout(function () {
							$this.addClass("start-animation");
							if($this.hasClass("skills")){
								$this.animateSkills();
							};
						}, 200 * j);
					};
				};
			});
		}
		else {
			$(".skills").animateSkills();
		};
	};


	// !- Fire animation
	setTimeout(function() {
		doAnimation();
	}, 50);

	if (!dtGlobals.isMobile && !$("html").hasClass("old-ie")){
		$(window).on("scroll", function () {
			doAnimation();
		});
	};


	// !... and ensute it will work in tabs
	/*$(".ui-tabs-anchor").on("click", function(){
		var $this = $(this);
		$(".iso-container").isotope("reLayout");
	});*/
	if($('.wpb_tabs .iso-container').length > 0){
		var tabResizeTimeout;
		$('.wpb_tour_tabs_wrapper').each(function(){
			var $this = $(this),
				isoInside = $this.parents(".wpb_tabs").find(".iso-container");
			$this.tabs( {
				activate: function( event, ui ) {
					//isoInside.imagesLoaded( function() {
						isoInside.isotope("layout");
					//});
				}
			});
			$this.find("li").each(function(){
				$(this).on("click", function(){
					clearTimeout(tabResizeTimeout);
					//tabResizeTimeout = setTimeout(function() {
						$(window).trigger( "debouncedresize" );
						//isoInside.imagesLoaded( function() {
							$(this).parents(".wpb_tabs").find(".iso-container").isotope("layout");
						//});
					//}, 200);
				});
			});
		});

	}


});

/* Sandbox: end */

/*---------------------------------------Plugins:end--------------------------------------------------------*/

// additional scripts
/*!
 * Functions Ordering:
 *	- !-Misc
 *	- !-Masonry initialisation
 *	- !-Main navigation
 *	- !-Navigation widget
 *	- !-SLIDERS
 *	-  --Royal Slider
 *	-  --Revolution slider
 *	-  --Shortcodes scroller
 *	-  --Photo slider
 * 	- !-Smart benefits & logos resize
 *	- !-Instagram style photos
 * 	- !-Filter
 * 	- !-Magnific popup gallery
 * 	- !-Justified Gallery
 *	- !-Misc-2
 *	-  --Accordion Toggle Tooltip
 *	-  --Grayscale
 *	-  --Append tag </i> to rolovers
 *	-  --Animate rolovers in old ie
 *	-  --Hover Direction aware
 *	-  --Fullwidth wrap for shortcodes & templates
 *	-  --Show Hide side header
 *	-  --Mobile top bar
 *	-  --Scroll to Top
 *	-  --Show share buttons
 *	-  --Shopping cart top bar
 *	-  --Skills
 *	-  --Custom select
 *	- !-Onepage template
 *	- !-Floating menu
 *	- !-Custom resize function
 *	- !-Project floating content
 *	- !-Before After
 *	- !-AJAX
 */

jQuery(document).ready(function($) {

	/*!-Misc*/

		/*--Set variable for floating menu*/
		if (dtGlobals.isMobile && !dtGlobals.isiPad) smartMenu = false;

		/*--old ie remove csstransforms3d*/
		if ($.browser.msie) $("html").removeClass("csstransforms3d");

		/*--Detect iphone phone*/
		if(dtGlobals.isiPhone){
			$("body").addClass("is-iphone");
		};
		if(dtGlobals.isWindowsPhone){
			$("body").addClass("windows-phone");
		};
		/*--Detect safari browser*/
		$.browser.safari = ($.browser.webkit && !(/chrome/.test(navigator.userAgent.toLowerCase())));
		if ($.browser.safari) {
			$("body").addClass("is-safari");
		};

		/* !Custom touch events */
		/* !(we need to add swipe events here) */

		dtGlobals.touches = {};
		dtGlobals.touches.touching = false;
		dtGlobals.touches.touch = false;
		dtGlobals.touches.currX = 0;
		dtGlobals.touches.currY = 0;
		dtGlobals.touches.cachedX = 0;
		dtGlobals.touches.cachedY = 0;
		dtGlobals.touches.count = 0;
		dtGlobals.resizeCounter = 0;

		$(document).on("touchstart",function(e) {
			if (e.originalEvent.touches.length == 1) {
				dtGlobals.touches.touch = e.originalEvent.touches[0];

				// caching the current x
				dtGlobals.touches.cachedX = dtGlobals.touches.touch.pageX;
				// caching the current y
				dtGlobals.touches.cachedY = dtGlobals.touches.touch.pageY;
				// a touch event is detected      
				dtGlobals.touches.touching = true;

				// detecting if after 200ms the finger is still in the same position
				setTimeout(function() {

					dtGlobals.touches.currX = dtGlobals.touches.touch.pageX;
					dtGlobals.touches.currY = dtGlobals.touches.touch.pageY;

					if ((dtGlobals.touches.cachedX === dtGlobals.touches.currX) && !dtGlobals.touches.touching && (dtGlobals.touches.cachedY === dtGlobals.touches.currY)) {
						// Here you get the Tap event
						dtGlobals.touches.count++;
						//console.log(dtGlobals.touches.count)
						$(e.target).trigger("tap");
					}
				},200);
			}
		});

		$(document).on("touchend touchcancel",function (e){
			// here we can consider finished the touch event
			dtGlobals.touches.touching = false;
		});

		$(document).on("touchmove",function (e){
			dtGlobals.touches.touch = e.originalEvent.touches[0];

			if(dtGlobals.touches.touching) {
				// here you are swiping
			}
		});

		$(document).on("tap", function(e) {
			$(".dt-hovered").trigger("mouseout");
		});

		/* Custom touch events:end */

		/*--Prevent default dragstart event on images*/
		$("img").on("dragstart", function(event) { event.preventDefault(); });

		/*--Append html tags for elements*/
		$(".no-touch .forward-post .fs-entry-img").each(function(){
			var $this = $(this);
			$this.append('<i></i>')
		});
		/*--Comment form*/
		var $commentForm = $('#commentform');

		$commentForm.on('click', 'a.clear-form', function (e) {
			e.preventDefault();
			$commentForm.find('input[type="text"], textarea').val('');
			return false;
		});

		$commentForm.on('click', ' a.dt-btn.dt-btn-m', function(e) {
			e.preventDefault();
			$commentForm.find('#submit').trigger('click');
			return false;
		});

		/*var $container = $('.iso-container');*/
		/*--Paginator*/
		var $paginator = $('.paginator[role="navigation"]'),
			$dots = $paginator.find('a.dots');
		$dots.on('click', function() {
			$paginator.find('div:hidden').show().find('a').unwrap();
			$dots.remove();
		});

		/*--search widget*/
		$('.widget .searchform .submit').on('click', function(e) {
			e.preventDefault();
			$(this).siblings('input.searchsubmit').click();
			return false;
		});

		// pin it
		$(".soc-ico a.share-button.pinterest").click(function(event){
			event.preventDefault();
			$("#pinmarklet").remove();
			var e = document.createElement('script');
			e.setAttribute('type','text/javascript');
			e.setAttribute('charset','UTF-8');
			e.setAttribute('id','pinmarklet');
			e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e);
		});

		/* !-overlap header for webkit*/

		if ( !$.browser.webkit || dtGlobals.isMobile ){
			$("body").addClass("not-webkit").removeClass("is-webkit");
		}else{
			$("body").removeClass("not-webkit").addClass("is-webkit");
			//$(".overlap #main").prepend("<div class='main-gradient'></div>");
			$(".overlap #content").find(">:first-child").css({
				position: "relative",
				"z-index": "4"
			});
			if( $(".overlap #content").find(">:first-child").height() < 36 ){
				$(".overlap #content").find("> :nth-child(2)").css({
					position: "relative",
					"z-index": "4"
				})
			};
		};

		/* overlap header for webkit:end*/

		/* !-jQuery extensions */

		/* !- Check if element exists */
		$.fn.exists = function() {
			if ($(this).length > 0) {
				return true;
			} else {
				return false;
			}
		}

		/* !- Check if element is loaded */
		$.fn.loaded = function(callback, jointCallback, ensureCallback){
			var len	= this.length;
			if (len > 0) {
				return this.each(function() {
					var	el		= this,
						$el		= $(el),
						blank	= "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

					$el.on("load.dt", function(event) {
						$(this).off("load.dt");
						if (typeof callback == "function") {
							callback.call(this);
						}
						if (--len <= 0 && (typeof jointCallback == "function")){
							jointCallback.call(this);
						}
					});

					if (!el.complete || el.complete === undefined) {
						el.src = el.src;
					} else {
						$el.trigger("load.dt")
					}
				});
			} else if (ensureCallback) {
				if (typeof jointCallback == "function") {
					jointCallback.call(this);
				}
				return this;
			}
		};

		/* jQuery extensions: end */

		/* !Fancy header*/
		var fancyFeaderOverlap = $(".transparent #fancy-header").exists(),
			titleOverlap = $(".transparent .page-title").exists();

		function fancyFeaderCalc() {
			$("#branding .preload-me").loaded(null, function() {
				if (fancyFeaderOverlap) {
					$(".transparent #fancy-header > .wf-wrap").not(".transparent.header-side-left #fancy-header > .wf-wrap").css({
						"padding-top" : $("#header").height()
					});
				};
				if (titleOverlap) {
					$(".transparent .page-title > .wf-wrap").not(".transparent.header-side-left .page-title > .wf-wrap").css({
						"padding-top" : $("#header").height()
					});
					$(".transparent .page-title").css("visibility", "visible");
				};
			}, true);
		}
		/* Fancy header:end*/

		/*Show soc icons*/
		$(".soc-ico a").css("visibility", "visible");

		/*Move side header out of page-inner (bug with sticky footer)*/
		if($(".page-inner").length > 0 && $(".logo-side").length > 0){
			$("#header").insertBefore(".page-inner");
		};

		/*Adding class if footer is empty*/
		if(!$(".footer .widget").length > 0) {
			$(".footer").addClass("empty-footer");
		};

	/*Misc:end*/

	/*!-Masonry initialisation*/

		/*!- Desctop only*/

			if(!dtGlobals.isMobile){
				setTimeout(function(){
					$('.stripe-parallax-bg, .fancy-parallax-bg, .page-title-parallax-bg').each(function(){
						var $_this = $(this),
							speed_prl = $_this.data("prlx-speed");
						$(this).parallax("50%", speed_prl);
						$_this.addClass("parallax-bg-done");
						$_this.css("opacity", "1")
					});
				}, 1000)

				var j = -1;
				$("#fancy-header .fancy-title:not(.start-animation), #fancy-header .fancy-subtitle:not(.start-animation), #fancy-header .breadcrumbs:not(.start-animation)").each(function () {
					var $this = $(this);
					var animateTimeout;
					if (!$this.hasClass("start-animation") && !$this.hasClass("start-animation-done")) {
						$this.addClass("start-animation-done");
						j++;
						setTimeout(function () {
							$this.addClass("start-animation");
							
						}, 300 * j);
					};
				});

				$("body").addClass("no-mobile");


				function doAnimation() {
					if(!dtGlobals.isMobile){
						var j = -1;
						$(".animate-element:not(.start-animation):in-viewport").each(function () {
							var $this = $(this);
				
							if (!$this.hasClass("start-animation") && !$this.hasClass("animation-triggered")) {
								$this.addClass("animation-triggered");
								j++;
								setTimeout(function () {
									$this.addClass("start-animation");
									if($this.hasClass("skills")){
										$this.animateSkills();
									};
								}, 200 * j);
							};
						});
					}
				};
				// !- Fire animation
				doAnimation();
				if (!$("html").hasClass("old-ie")){
					$(window).on("scroll", function () {
						doAnimation();
					});
				};

				$(".tab").on("click", function(){
					if(!dtGlobals.isMobile){
						$(".animate-element", this).each(function (i) {
							var $this = $(this);
							if (!$this.hasClass("start-animation")) {
								setTimeout(function () {
									$this.addClass("start-animation");
								}, 100 * i);
							}
						});
					}
				});

				$(".stripe-video-bg > video").each(function(){
					var $_this = $(this),
						$this_h = $_this.height();
					$_this.css({
						"marginTop": -$this_h/2
					})
				});

				$(".stripe-video-bg:in-viewport").each(function() {
					var $video = $(this).find('video');

					if ( $video.length > 0 ) {
						$video.get(0).play();
					}
				});
				$(window).on("scroll", function () {

					var stripeVideo = $(".stripe-video-bg");
					stripeVideo.each(function() {
						var $this = $(this),
							video = $this.find('video');

						if ( video.length > 0 ) {

							if ( $this.is(':in-viewport') ) {

								video.get(0).play();
							} else {

								video.get(0).pause();
							}
						}
					});
				});

				if ($.browser.msie) {
					$('input[type="text"][placeholder], textarea[placeholder]').each(function () {
						var obj = $(this);

						if (obj.attr('placeholder') != '') {
							obj.addClass('IePlaceHolder');

							if ($.trim(obj.val()) == '' && obj.attr('type') != 'password') {
								obj.val(obj.attr('placeholder'));
							}
						}
					});

					$('.IePlaceHolder').focus(function () {
						var obj = $(this);
						if (obj.val() == obj.attr('placeholder')) {
							obj.val('');
						}
					});

					$('.IePlaceHolder').blur(function () {
						var obj = $(this);
						if ($.trim(obj.val()) == '') {
							obj.val(obj.attr('placeholder'));
						}
					});
				}
			};
		/*Desctop only:end*/

		/*!- Desctop & tablet only*/

			$.fn.calculateColumns = function(minWidth, colNum, padding, mode) {
				return this.each(function() {
					var $container = $(this),
						containerWidth = $container.width(),
						containerPadding = (padding !== false) ? padding : 20,
						containerID = $container.attr("data-cont-id"),
						tempCSS = "",
						first = false;

					if(typeof(minWidth)==='undefined') minWidth = 200;
					if(typeof(colNum)==='undefined') colNum = 6;


					for ( ; Math.floor($container.width()/colNum) < minWidth; ) {
						colNum--;
						if (colNum <= 1) break;
					}

					if (!$("#col-style-id-"+containerID).exists()) {

						if(!$("html").hasClass("old-ie") || !$("html").hasClass("old-ie9")){// IE
							if(!$("html").hasClass("old-ie")){
								var jsStyle = document.createElement("style");
								jsStyle.id = "col-style-id-"+containerID;
								jsStyle.appendChild(document.createTextNode(""));
								document.head.appendChild(jsStyle);
							};
						}
					} else {
						var jsStyle = document.getElementById("col-style-id-"+containerID);
					}


					var $style = $("#col-style-id-"+containerID);

					var singleWidth,
						doubleWidth,
						normalizedPadding,
						normalizedMargin,
						normalizedPaddingTop;

					if (containerPadding < 10) {
						normalizedPadding = 0;
						normalizedPaddingTop = 0;
					}
					else {
						normalizedPaddingTop = containerPadding - 5;
						normalizedPadding = containerPadding - 10;
					};
					if (containerPadding == 0) {
						normalizedMargin = 0;
					}
					else {
						normalizedMargin = -containerPadding;
					};

					if (mode == "px") {
						singleWidth = Math.floor($container.width() / colNum)+"px";
						doubleWidth = Math.floor($container.width() / colNum)*2+"px";
					}
					else {
						singleWidth = Math.floor(100000 / colNum)/1000+"%";
						doubleWidth = Math.floor(100000 / colNum)*2/1000+"%";
					};
					if ( $(".cont-id-"+containerID+"").not(".bg-under-post").hasClass("description-under-image") ) {
						if (colNum > 1) {
							tempCSS = " \
								.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+containerPadding+"px -"+normalizedPadding+"px ; } \
								.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
								.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+containerPadding+"px "+normalizedPadding+"px; } \
								.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
							";
							if($("html").hasClass("old-ie9") || $("html").hasClass("old-ie")){
								$(".cont-id-"+containerID+"").css({
									"margin-top": -normalizedPaddingTop + "px",
									"margin-right": -containerPadding + "px",
									"margin-left": -containerPadding + "px",
									"margin-bottom": -normalizedPadding + "px"
								});
								$(".full-width-wrap .cont-id-"+containerID+"").css({
									"margin-top": -normalizedPaddingTop + "px",
									"margin-right": containerPadding + "px",
									"margin-left": containerPadding + "px",
									"margin-bottom": -normalizedPadding + "px"
								});
								$(".cont-id-"+containerID+" > .wf-cell").css({
									"width": singleWidth,
									"padding-top": normalizedPaddingTop + "px",
									"padding-right": containerPadding + "px",
									"padding-left": containerPadding + "px",
									"padding-bottom": normalizedPadding + "px"
								});
								$(".cont-id-"+containerID+" > .wf-cell.double-width").css({
									"width": doubleWidth
								});
							}
						}
						else {
							tempCSS = " \
								.cont-id-"+containerID+" { margin: -"+normalizedPaddingTop+"px  -"+normalizedPadding+"px -"+containerPadding+"px ; } \
								.full-width-wrap .cont-id-"+containerID+" { margin: "+(-normalizedPaddingTop)+"px "+containerPadding+"px "+(-normalizedPadding)+"px ; } \
								.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+normalizedPaddingTop +"px "+normalizedPadding+"px "+containerPadding+"px; } \
							";
							if($("html").hasClass("old-ie9") || $("html").hasClass("old-ie")){
								$(".cont-id-"+containerID+"").css({
									"margin-top": -normalizedPaddingTop + "px",
									"margin-right": -normalizedPadding + "px",
									"margin-left": -normalizedPadding + "px",
									"margin-bottom": -containerPadding + "px"
								});
								$(".full-width-wrap .cont-id-"+containerID+"").css({
									"margin-top": -normalizedPaddingTop + "px",
									"margin-right": containerPadding + "px",
									"margin-left": containerPadding + "px",
									"margin-bottom": -normalizedPadding + "px"
								});
								$(".cont-id-"+containerID+" > .wf-cell").css({
									"width": singleWidth,
									"padding-top": normalizedPaddingTop + "px",
									"padding-right": normalizedPadding + "px",
									"padding-left": normalizedPadding + "px",
									"padding-bottom": containerPadding + "px"
								});
							}
						};
					}else {
						if (colNum > 1) {
							tempCSS = " \
								.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
								.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px  "+containerPadding+"px; } \
								.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+";  padding: "+containerPadding+"px; } \
								.cont-id-"+containerID+" > .wf-cell.double-width { width: "+doubleWidth+"; } \
							";
							if($("html").hasClass("old-ie") || $("html").hasClass("old-ie9")){
								$(".cont-id-"+containerID+"").css({
									"margin": -containerPadding + "px"
								});
								$(".full-width-wrap .cont-id-"+containerID+"").css({
									"margin-top": normalizedMargin + "px",
									"margin-right": containerPadding + "px",
									"margin-left": containerPadding + "px",
									"margin-bottom": normalizedMargin + "px"
								});
								$(".cont-id-"+containerID+" > .wf-cell").css({
									"width": singleWidth +"px",
									"padding": containerPadding +"px"
								});
								$(".cont-id-"+containerID+" > .wf-cell.double-width").css({
									"width": doubleWidth +"px"
								});
							}
						}
						else {
							tempCSS = " \
								.cont-id-"+containerID+" { margin: -"+containerPadding+"px; } \
								.full-width-wrap .cont-id-"+containerID+" { margin: "+normalizedMargin+"px "+containerPadding+"px; } \
								.cont-id-"+containerID+" > .wf-cell { width: "+singleWidth+"; padding: "+containerPadding+"px; } \
							";
							if($("html").hasClass("old-ie9") || $("html").hasClass("old-ie")){
								$(".cont-id-"+containerID+"").css({
									"margin": -containerPadding + "px"
								});
								$(".full-width-wrap .cont-id-"+containerID+"").css({
									"margin-top": normalizedMargin + "px",
									"margin-right": containerPadding + "px",
									"margin-left": containerPadding + "px",
									"margin-bottom": normalizedMargin + "px"
								});
								$(".cont-id-"+containerID+" > .wf-cell").css({
									"width": singleWidth,
									"padding": containerPadding + "px"
								});
							}
						};
					};
					if(!$("html").hasClass("old-ie") || !$("html").hasClass("old-ie9")){
						if(!$("html").hasClass("old-ie")){
							$style.html(tempCSS);
							var newRuleID = jsStyle.sheet.cssRules.length;
							jsStyle.sheet.insertRule(".webkit-hack { }", newRuleID);
							jsStyle.sheet.deleteRule(newRuleID);
						}
					}

					$container.trigger("columnsReady");

				});
			};

			// !- Initialise slider
			$.fn.initSlider = function() {
				return this.each(function() {
					var $_this = $(this),
						attrW = $_this.data('width'),
						attrH = $_this.data('height'); 

					$_this.royalSlider({
						autoScaleSlider: true,
						autoScaleSliderWidth: attrW,
						autoScaleSliderHeight: attrH,
						imageScaleMode: "fit",
						imageScalePadding: 0,
						slidesOrientation: "horizontal",
						disableResponsiveness: true
					});
				});
			};

			/* !Containers of masonry and grid content */
			var	$isoCollection = $(".iso-container"),
				$gridCollection = $(".iso-grid:not(.jg-container, .iso-container), .blog.layout-grid .wf-container.description-under-image:not(.jg-container, .iso-container), .grid-masonry:not(.iso-container), .shortcode-blog-posts.iso-grid"),
				$combinedCollection = $isoCollection.add($gridCollection),
				$isoPreloader = dtGlobals.isoPreloader = $('<div class="pace pace-active"><div class="pace-activity"></div></div>').appendTo("body").hide();
				$combinedCollection.addClass("dt-isotope");

			/* !Smart responsive columns */
			if ($combinedCollection.exists()) {
				$combinedCollection.each(function(i) {
					var $container = $(this),
						contWidth = parseInt($container.attr("data-width")),
						contNum = parseInt($container.attr("data-columns"));
					var contPadding = parseInt($container.attr("data-padding"));
					
					$container.addClass("cont-id-"+i).attr("data-cont-id", i);
					$container.calculateColumns(contWidth, contNum, contPadding, "px");
					if(contPadding > 10){
						$container.addClass("mobile-paddings");
					}

					$(window).on("debouncedresize", function () {
						$container.calculateColumns(contWidth, contNum, contPadding, "px");

						if(contPadding > 10){
							$container.addClass("mobile-paddings");
						}
					});
				});
			}

			if(!dtGlobals.isPhone){
				// !- Columns width calculation

				// !- Responsive height hack
				$.fn.heightHack = function() {
					return this.each(function() {
						var $img = $(this);
						if ($img.hasClass("height-ready") || $img.parents(".post-rollover").exists()) {
							return;
						}

						var	imgWidth = parseInt($img.attr('width')),
							imgHeight = parseInt($img.attr('height')),
							imgRatio = imgWidth/imgHeight;

						if($img.parents(".testimonial-vcard, .dt-format-gallery, .shortcode-blog-posts.iso-grid ").exists()) {
							$img.wrap("<div />");
						};

						$img.parent().css({
							"padding-bottom" : 100/imgRatio+"%",
							"height" : 0,
							"display" : "block"
						});

						$img.attr("data-ratio", imgRatio).addClass("height-ready");
					});
				};

				// !- Show items
				$.fn.showItems = function() {
					return this.each(function() {
						var $item = $(this),
							$img = $item.find(".preload-me").first();
					});
				};
				/* !Masonry and grid layout */

				/* !Filter: */
				var $container = $('.iso-container, .portfolio-grid');

				$('.filter:not(.without-isotope, .with-ajax) .filter-categories a').on('click.presscorFilterCategories', function(e) {
					var selector = $(this).attr('data-filter');

					$container.isotope({ filter: selector });
					return false;
				});

				// !- filtering
				$('.filter:not(.without-isotope, .with-ajax) .filter-extras .filter-by a').on('click', function(e) {
					var sorting = $(this).attr('data-by'),
						sort = $(this).parents('.filter-extras').find('.filter-sorting > a.act').first().attr('data-sort');

					$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
					return false;
				});

				// !- sorting
				$('.filter:not(.without-isotope, .with-ajax) .filter-extras .filter-sorting a').on('click', function(e) {
					var sort = $(this).attr('data-sort'),
						sorting = $(this).parents('.filter-extras').find('.filter-by > a.act').first().attr('data-by');

					$container.isotope({ sortBy : sorting, sortAscending : 'asc' == sort });
					return false;
				});

				/* !Masonry layout */
				if ($isoCollection.exists() || $gridCollection.exists() ) {

					// Show preloader
					$isoPreloader.fadeIn(50);

					// Collection of masonry instances 
					$isoCollection.each(function(i) {
						var $isoContainer = $(this);

						// Hack to make sure that masonry will correctly calculate columns with responsive images height. 
						$(".preload-me", $isoContainer).heightHack();

						// Slider initialization
						$(".slider-masonry", $isoContainer).initSlider();

						// Masonry initialization

						$isoContainer.one("columnsReady", function() {

							$isoContainer.isotope({
								itemSelector : '.iso-item',
								 transformsEnabled: false,
								isResizeBound: false,
								layoutMode : 'masonry',
								transitionDuration: 0,
								/*animationEngine: typeOfAnimation,*/
								masonry: { columnWidth: 1 },
								getSortData : {
									date : function( $elem ) {
										return $($elem).attr('data-date');
									},
									name : function( $elem ) {
										return $($elem).attr('data-name');
									}
								}
							});

							// Recalculate everything on window resize
							$(window).on("columnsReady", function () {
								$(".royalSlider", $isoContainer).each(function() {
									$(this).data("royalSlider").updateSliderSize();
								});
								$isoContainer.isotope("layout");
								
							});
						});

						// Show item(s) when image inside is loaded
						$("> .iso-item", $isoContainer).showItems();
						
					});

					$gridCollection.each(function(i) {
						var $isoContainer = $(this);

						// Hack to make sure that masonry will correctly calculate columns with responsive images height. 
						$(".preload-me", $isoContainer).heightHack();

						// Slider initialization
						$(".slider-simple", $isoContainer).initSlider();

						// Masonry initialization

						$isoContainer.one("columnsReady", function() {

							$isoContainer.isotope({
								itemSelector : '.wf-cell',
								transformsEnabled: false,
								isResizeBound: false,
								layoutMode : 'fitRows',
								transitionDuration: 0,

								/*animationEngine: typeOfAnimation,*/
								masonry: { columnWidth: 1 },
								getSortData : {
									date : function( $elem ) {
										return $($elem).attr('data-date');
									},
									name : function( $elem ) {
										return $($elem).attr('data-name');
									}
								}
							});

							// Recalculate everything on window resize
							$isoContainer.on("columnsReady", function () {
								$(".royalSlider", $isoContainer).each(function() {
									$(this).data("royalSlider").updateSliderSize();
								});
								$isoContainer.isotope("layout");
							});

						});

						// Show item(s) when image inside is loaded
						$("> .wf-cell", $isoContainer).showItems();
					});

					// Hide preloader
					$isoPreloader.stop().fadeOut(300);

				};
			};
		/*Desctop & tablet only:end*/

		/*!- Phone only*/

			if(dtGlobals.isPhone){
				$(".slider-masonry").initSlider();
				$(window).on("columnsReady", function () {
					$(".royalSlider").each(function() {
						$(this).data("royalSlider").updateSliderSize();
					});

				});

				$(".filter-extras").css("display", "none");

				var $container = $(".filter").next('.iso-container, .portfolio-grid'),
					$items = $(".iso-item, .wf-cell", $container),
					selector = null;

				$(".filter-categories a").each(function(){
					$(this).on('click', function(e) {
						e.preventDefault();
						selector = $(this).attr('data-filter');
						$items.css("display", "none");
						$items.filter(selector).css("display", "block");
					});
				});

			};
		/*Phone only:end*/

	/*Masonry initialisation:end*/

	/* !-Main navigation */

		/* We need to fine-tune timings and do something about the usage of jQuery "animate" function */ 
		$("#mobile-menu").wrap("<div id='dl-menu' class='dl-menuwrapper wf-mobile-visible' />");
		$(".underline-hover > li > a > span").not(".underline-hover > li > a > span.mega-icon").append("<i class='underline'></i>");

		var $mainNav = $("#main-nav, .dl-menu, .mini-nav"),
			$mainMenu = $("header:not(.sub-downwards) #main-nav, .mini-nav"),
			$mainNavMob = $("#main-nav, .dl-menu"),
			isDemo = $(".demo-panel").exists();

		if (isDemo) {
			$mainNav.find(".page-item-112").removeClass("has-children").find("> .sub-nav").remove();
			$mainNav.find(".page-item-112 > ").attr("onclick", "");
			$mainNav.find(".page-item-112 > a").css("cursor", "pointer").click(function(e) {
				e.preventDefault();
				window.location.href = $(this).attr("href");
			})
		}
		$(".act", $mainNav).parents("li").addClass("act");

		var	$mobileNav = $mainNavMob.clone();
		var	$mobileTopNav = $(".mini-nav").clone();
		var backCap = $("#mobile-menu > .menu-back").html();

		$mobileNav
			.attr("id", "")
			.attr("class", "dl-menu")
			.find("li > .sub-nav")
				.addClass("dl-submenu")
				.removeClass("sub-nav")
				.find(" > ul")
				.prepend("<li class='dl-back'><a href='#''><span>"+backCap+"</a></li>");

		$mobileNav.first().appendTo("#dl-menu").wrap("<div class='dl-container' />");
		$( "#mobile-menu" ).wrapInner( "<div class='lines-button x'></div>");
		$(".lines-button").prepend('<span class="lines"></span>');

		if (!$("html").hasClass("old-ie")){
			$( "#dl-menu" ).dlmenu();
		}

		$(".mini-nav select").change(function() {
			window.location.href = $(this).val();
		});


		dtGlobals.isHovering = false;

		$(".sub-nav", $mainMenu).parent().each(function() {
			var $this = $(this);
			if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
				$this.find("> a").on("click", function(e) {
					if (!$(this).hasClass("dt-clicked")) {
						e.preventDefault();
						$mainNav.find(".dt-clicked").removeClass("dt-clicked");
						$(this).addClass("dt-clicked");
					} else {
						e.stopPropagation();
					}

				});
			};

			var menuTimeoutShow,
				menuTimeoutHide;

			if($this.hasClass("dt-mega-menu")){
				
				$this.on("mouseenter tap", function(e) {
					if(e.type == "tap") e.stopPropagation();

					var $this = $(this);
					$this.addClass("dt-hovered");

					dtGlobals.isHovering = true;


					var $_this = $(this),
						$_this_h = $this.height(),
						$_this_ofs_top = $this.position().top;
					if($(".logo-side").length > 0){
						$this.find("> .sub-nav").css({
							top: $_this_ofs_top
						});
					}else{
						$this.find("> .sub-nav").css({
							top: $_this_ofs_top+$_this_h
						});
					}

					
					if($this.hasClass("mega-auto-width")){
						var $_this = $(this),
							$_this_sub = $_this.find(" > .sub-nav > ul > li"),
							coll_width = $("#main .wf-wrap").width()/5,
							$_this_par_width = $_this.parent().width(),
							$_this_parents_ofs = $_this.offset().left - $this.parents("#header .wf-table, .ph-wrap-inner, .logo-center #navigation, .logo-classic #navigation, .logo-classic-centered #navigation").offset().left;
						if(!$(".logo-side").length){
							$_this.find(" > .sub-nav").css({
								left: $_this_parents_ofs,
								"marginLeft": -($_this.find(" > .sub-nav").width()/2 - $_this.width()/2)
							});
						}
					}
					if(!$(".logo-side").length){
						if($this.is(':first-child') && $this.hasClass("mega-auto-width")){
							$this.find(" > .sub-nav").css({
								left: $_this.offset().left - $this.parents("#header .wf-table, .ph-wrap-inner, .logo-center #navigation, .logo-classic #navigation, .logo-classic-centered #navigation").offset().left,
								"marginLeft": 0
							});
						}else if($this.is(':last-child') && $this.hasClass("mega-auto-width")){
							$this.find(" > .sub-nav").css({
								left: "auto",
								right: $this.parents("#header .wf-table, .ph-wrap-inner, .logo-center #navigation, .logo-classic #navigation, .logo-classic-centered #navigation").width() - ( $this.position().left + $this.width() ),
								"marginLeft": 0
							});
						};
					}
					if(!$(".logo-side").length > 0){
						if ($("#page").width() - ($this.children(".sub-nav").offset().left - $("#page").offset().left) - $this.children(".sub-nav").width() < 0) {
							$this.children(".sub-nav").addClass("right-overflow");
						};
						
						if($this.position().left < ($this.children(".sub-nav").width()/2)) {
							$this.children(".sub-nav").addClass("left-overflow");
						}
						if ($(window).height() - ($this.children(".sub-nav").offset().top) - $this.children(".sub-nav").height() < 0) {
							$this.children(".sub-nav").addClass("bottom-overflow");
						};
					}
					clearTimeout(menuTimeoutShow);
					clearTimeout(menuTimeoutHide);

					menuTimeoutShow = setTimeout(function() {
						if($this.hasClass("dt-hovered")){
							$this.find(".sub-nav").stop().css("visibility", "visible").animate({
								"opacity": 1
							}, 150);
						}
					}, 100);
				});

				$this.on("mouseleave", function(e) {
					var $this = $(this);
					$this.removeClass("dt-hovered");

					dtGlobals.isHovering = false;
					clearTimeout(menuTimeoutShow);
					clearTimeout(menuTimeoutHide);

					menuTimeoutHide = setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$this.children(".sub-nav").stop().animate({
								"opacity": 0
							}, 150, function() {
								$(this).css("visibility", "hidden");

								$(this).find(".sub-nav").stop().css("visibility", "hidden").animate({
									"opacity": 0
								}, 10);
							});
							
							setTimeout(function() {
								if(!$this.hasClass("dt-hovered")){
									$this.children(".sub-nav").removeClass("right-overflow");
									$this.children(".sub-nav").removeClass("left-overflow");
									$this.children(".sub-nav").removeClass("bottom-overflow");
								}
							}, 400);
							
						}
					}, 150);

					$this.find("> a").removeClass("dt-clicked");
				});
			}else{
				$this.on("mouseenter tap", function(e) {
					if(e.type == "tap") e.stopPropagation();

					var $this = $(this);
					$this.addClass("dt-hovered");

					if ($("#page").width() - ($this.children(".sub-nav").offset().left - $("#page").offset().left) - $this.find(" > .sub-nav").width() < 0) {
						$this.children(".sub-nav").addClass("right-overflow");
					}

					if ($(window).height() - ($this.children(".sub-nav").offset().top - $(window).scrollTop()) - $this.children(".sub-nav").height() < 0) {
						$this.children(".sub-nav").addClass("bottom-overflow");
					};
					dtGlobals.isHovering = true;
					clearTimeout(menuTimeoutShow);
					clearTimeout(menuTimeoutHide);

					menuTimeoutShow = setTimeout(function() {
						if($this.hasClass("dt-hovered")){
							$this.children('.sub-nav').stop().css("visibility", "visible").animate({
								"opacity": 1
							}, 150);
						}
					}, 100);
				});

				$this.on("mouseleave", function(e) {
					var $this = $(this);
					$this.removeClass("dt-hovered");

					dtGlobals.isHovering = false;
					clearTimeout(menuTimeoutShow);
					clearTimeout(menuTimeoutHide);

					menuTimeoutHide = setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							if(!$this.parents().hasClass("dt-mega-menu")){
								$this.children(".sub-nav").stop().animate({
									"opacity": 0
								}, 150, function() {
									$(this).css("visibility", "hidden");
								});
							}
							
							setTimeout(function() {
								if(!$this.hasClass("dt-hovered")){
									$this.children(".sub-nav").removeClass("right-overflow");
									$this.children(".sub-nav").removeClass("bottom-overflow");
								}
							}, 400);
						}
					}, 150);

					$this.find("> a").removeClass("dt-clicked");
				});
			};

		});

	/* Main navigation: end */

	/* !-Navigation widget */

		var customTimeoutShow;

		if($(".dt-parent-menu-clickable").length > 0){

			var item = $('#main-nav li.has-children > a');
			$("<i class='next-level-button'></i>").insertAfter(item);

			$(".sub-downwards #main-nav li.has-children").each(function(){
				var $this = $(this);
				if($this.find(".sub-nav li").hasClass("act")){
					$this.addClass('active');
				};

				if($this.find(".sub-nav li.act").hasClass("act")){
					$this.addClass('open-sub');
					$this.find(" > .sub-nav").stop(true, true).slideDown(100);
				};
				$this.find(" > .next-level-button").on("click", function(e){
					var $this = $(this).parent();
					if ($this.hasClass("active")){
						$this.find(" > .sub-nav").stop(true, true).slideUp(500);
						$this.removeClass("active");
						$this.removeClass('open-sub');
					}else{
						$this.siblings().find(" .sub-nav").stop(true, true).slideUp(400);
						$this.find(" > .sub-nav").stop(true, true).slideDown(500);
						$this.siblings().removeClass("active");
						$this.addClass('active');
						$this.addClass('open-sub');
					};

					$(".header-side-content").mCustomScrollbar("update");
				})
			});

		}else{
			$(".sub-downwards #main-nav li > a").each(function(){
				var $this = $(this);
				if($this.parent("li").find(".sub-nav li").hasClass("act")){
					$this.addClass('act');
				};
				if($this.parent("li").find(".sub-nav li.act").hasClass("act")){
					$this.parent("li").addClass('open-sub');
					$this.next().stop(true, true).slideDown(100);
				};
				$this.on("click", function(e){
					$menuItem = $this.parent();
					if ($menuItem.hasClass("has-children")) e.preventDefault();
					
					if ($this.hasClass("act")){
						$this.next().stop(true, true).slideUp(500);
						$this.removeClass("act");
						$this.parent("li").removeClass('open-sub');
					}else{
						$this.parent().siblings().find(".sub-nav").stop(true, true).slideUp(400);
						$this.next().stop(true, true).slideDown(500);
						$this.parent().siblings().find("> a").removeClass("act");
						$this.addClass('act');
						$this.parent("li").addClass('open-sub');
					};
					$(".header-side-content").mCustomScrollbar("update");
				});
			});

		};


		$(".custom-nav > li > a").click(function(e){
			$menuItem = $(this).parent();
			if ($menuItem.hasClass("has-children")) e.preventDefault();
			
			
				if ($(this).attr("class") != "active"){
						$(".custom-nav > li > ul").stop(true, true).slideUp(400);
						$(this).next().stop(true, true).slideDown(500);
						$(".custom-nav > li > a").removeClass("active");
						$(this).addClass('active');
				}else{
						$(this).next().stop(true, true).slideUp(500);
						$(this).removeClass("active");
				}

				$menuItem.siblings().removeClass("act");
				$menuItem.addClass("act");
		});

		$(".custom-nav > li > ul").each(function(){
			clearTimeout(customTimeoutShow);
			$this = $(this);
			$thisChildren = $this.find("li");
			if($thisChildren.hasClass("act")){
				$this.prev().addClass("active");
				$this.parent().siblings().removeClass("act");
				$this.parent().addClass("act");
				$(this).slideDown(500);
			}
		});

	/* Navigation widget: end */

	/*!-SLIDERS*/

		/* !-Royal Slider */

			if ($(".rsHomePorthole").exists()) {
				var portholeSlider = {};
					portholeSlider.container = $("#main-slideshow");
					portholeSlider.width = portholeSlider.container.attr("data-width") ? parseInt(portholeSlider.container.attr("data-width")) : 1280;
					portholeSlider.height = portholeSlider.container.attr("data-height") ? parseInt(portholeSlider.container.attr("data-height")) : 720;
					portholeSlider.autoslide = portholeSlider.container.attr("data-autoslide") && parseInt(portholeSlider.container.attr("data-autoslide")) > 999 ? parseInt(portholeSlider.container.attr("data-autoslide")) : 5000;
					portholeSlider.scale = portholeSlider.container.attr("data-scale") ? portholeSlider.container.attr("data-scale") : "fill";
					portholeSlider.paused = portholeSlider.container.attr("data-paused") ? portholeSlider.container.attr("data-paused") : true;
					portholeSlider.hendheld = $(window).width() < 740 && dtGlobals.isMobile ? true : false;
				
				$("#main-slideshow-content").appendTo(portholeSlider.container);

				portholeSlider.api = $(".rsHomePorthole").royalSlider({
					autoScaleSlider: true,
					autoScaleSliderWidth: portholeSlider.width,
					autoScaleSliderHeight: portholeSlider.height,
					autoPlay: {
						enabled: !portholeSlider.hendheld,
						stopAtAction: false,
						pauseOnHover: false,
						delay: portholeSlider.autoslide
					},
					imageScaleMode: portholeSlider.scale,
					imageScalePadding: 0,
					numImagesToPreload: 999,
					slidesOrientation: "horizontal",
					disableResponsiveness: false,
					loopRewind: true,
					arrowsNav: false,
					globalCaption: true,
					controlNavigation: !portholeSlider.hendheld ? 'porthole' : 'none',
					thumbs: {
						orientation: 'vertical',
						drag: false,
						touch: false,
						spacing: 10,
						firstMargin: false,
						appendSpan: false
					},
					block: {
						fadeEffect: true,
						moveEffect: 'bottom',
						moveOffset: 5
					}
				}).data("royalSlider");
				var $_this = portholeSlider.container,
					$_this_childs = $_this.find(".rsSlide").size();
				if ($_this_childs < 2) {
					$(".rsThumbs", $_this).hide();
					portholeSlider.api._isMove = false;
					$_this.find(".rsOverflow").css("cursor", "auto")
				};

				if (portholeSlider.paused == "true") {
					$(".rsHomePorthole").royalSlider("stopAutoPlay");
				}
			};

			$(".slider-post").each(function(){
				$(this).royalSlider({
					autoScaleSlider: true,
					imageScaleMode: "fit",
					autoScaleSliderWidth: $(this).attr("data-width"),
					autoScaleSliderHeight: $(this).attr("data-height"),
					imageScalePadding: 0,
					numImagesToPreload: 6,
					slidesOrientation: "horizontal",
					disableResponsiveness: false,
					globalCaption:true
				});
			});

			$(".slider-simple").each(function(){
				$(this).royalSlider({
					autoScaleSlider: true,
					imageScaleMode: "fit",
					autoScaleSliderWidth: $(this).attr("data-width"),
					autoScaleSliderHeight: $(this).attr("data-height"),
					imageScalePadding: 0,
					numImagesToPreload: 6,
					slidesOrientation: "horizontal",
					disableResponsiveness: false,
					globalCaption:true
				});
			});

			$(".slider-content .preload-me").loaded(null, function() {
				$(".slider-content").each(function(){
					var $this = $(this),
						autoslide = $this.attr("data-autoslide") && parseInt($this.attr("data-autoslide")) > 999 ? parseInt($this.attr("data-autoslide")) : 5000;		
						hendheld = !($(window).width() < 740 && dtGlobals.isMobile) && $this.attr("data-autoslide") ? true : false;

					$this.royalSlider({
						autoPlay: {
							enabled: hendheld,
							stopAtAction: false,
							pauseOnHover: false,
							delay: autoslide
						},
						autoHeight: true,
						controlsInside: false,
						fadeinLoadedSlide: false,
						controlNavigationSpacing: 0,
						controlNavigation: 'bullets',
						imageScaleMode: 'none',
						imageAlignCenter:false,
						loop: false,
						loopRewind: true,
						numImagesToPreload: 6,
						keyboardNavEnabled: true

					}).data("royalSlider");
				});
			}, true);

		/* Royal Slider: end */

		/*!-Revolution slider*/

			if ($(".rev_slider_wrapper").length > 0){
				$("#main-slideshow").each(function(){
					var $this = $(this);
					if( $this.find("> .rev_slider_wrapper")){
						$this.addClass("fix rv-slider");
					};
					if ($(".rev_slider_wrapper").hasClass("fullscreen-container") || $(".rev_slider_wrapper").hasClass("fullwidthbanner-container")){
						$this.removeClass("fix");
					};
				});
			};

		/* Revolution slider: end */

		/* !Shortcodes scroller */

			$(".fullwidth-slider .fs-entry").not(".text-on-img .fullwidth-slider .fs-entry").each(function(i) {
				var $this = $(this),
					$img = $this.find("img").eq(0),
					imgW = parseInt($img.attr("width")),
					imgH = parseInt($img.attr("height"));

				if (!$img.exists()) imgW = 280;

				var leftPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingLeft")),
					rightPadding = parseInt($img.parents(".wf-td").eq(0).css("paddingRight")),
					addedW = 0;

				if (leftPadding > 0 && rightPadding > 0) addedW = leftPadding + rightPadding;

				$this.attr("data-width", imgW + addedW).css({
					width: imgW + addedW,
					opacity: 1
				});

				var $imgPar = $img.parent("a"),
					imgParW = $imgPar.width(),
					imgParH = (imgH * imgParW) / imgW;

				$img.parent("a").css({
					height: imgParH
				});

				$(".fs-entry-content:not(.buttons-on-img)", $this).css("opacity", "1");
			}).find("article").css("height", "100%");

			$(".text-on-img .fullwidth-slider .fs-entry, .description-on-hover .fs-entry, .dt-photos-shortcode .fs-entry").each(function() {
				var $this = $(this);

				$(".rollover-project", $this).css({
					"width": $this.attr("data-width"),
					"height": $this.attr("data-height")
				});
			});

			$.fn.shortcodesScroller = function() {
				var $el = $(this),
					slides = {},
					thumbs = "";

					slides.$items = $el.children(".fs-entry"),
					slides.count = slides.$items.length;

				$el.addClass("ts-cont");
				$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

				var scroller = $el.parents(".ts-wrap"),
					$this_par = $el.parents(".slider-wrapper"),
					windowW = $(window).width(),
					paddings = $this_par.attr("data-padding-side") ? parseInt($this_par.attr("data-padding-side")) : 0,
					$sliderAutoslide = ( 'true' === $this_par.attr("data-autoslide") ) ? true : false,
					$sliderAutoslideDelay = $this_par.attr("data-delay") && parseInt($this_par.attr("data-delay")) > 999 ? parseInt($this_par.attr("data-delay")) : 5000,
					$sliderLoop = ( 'true' === $this_par.attr("data-loop") ) ? true : false;

				var $sliderData = scroller.thePhotoSlider({
					mode: {
						type: "scroller"
					},
					sidePaddings: paddings,
					autoPlay: {
						enabled: $sliderAutoslide,
						delay: $sliderAutoslideDelay,
						loop: $sliderLoop
					}
				}).data("thePhotoSlider");

				$(".prev", $this_par).click(function() {
					if (!$sliderData.noSlide) $sliderData.slidePrev();
				});
				$(".next", $this_par).click(function() {
					if (!$sliderData.noSlide) $sliderData.slideNext();
				});

				$sliderData.ev.on("updateNav sliderReady", function() {
					if ($sliderData.lockRight) {
						$(".next", $this_par).addClass("disabled");
					} else {
						$(".next", $this_par).removeClass("disabled");
					};

					if ($sliderData.lockLeft) {
						$(".prev", $this_par).addClass("disabled");
					} else {
						$(".prev", $this_par).removeClass("disabled");
					};
					if ($sliderData.lockRight && $sliderData.lockLeft) {
						$this_par.addClass("hide-arrows");
					};
				});

				scroller.hover(
					function() {
						if($sliderAutoslide) {
							$sliderData._autoPlayPaused = false;
							$sliderData.pause();
							$sliderData._pausedByHover = true;
						}
					},
					function() {
						if($sliderAutoslide) {
							$sliderData._pausedByHover = false;
							if(!$sliderData._pausedByClick){
								$sliderData.play();
							}
						}
					}
				);
			};

			$(".slider-wrapper .blog-media").css({
				"height": ""
			});

			$(".fullwidth-slider ul.clearfix").each(function(){
				$(this).shortcodesScroller();
			});

			var $sliderWrapper = $(".slider-wrapper");

			$sliderWrapper.css("visibility", "visible");

			$sliderWrapper.each(function(){
				var $this = $(this),
					$thisUl = $this.find(".ts-wrap").data("thePhotoSlider");

				$this.append('<a href="#" class="auto-play-btn"></a>');

				$this.on("mouseenter", function(e) {
					$this.addClass("show-arrows");
				});
				$this.on("mouseleave", function(e) {
					//setTimeout(function(){
						$this.removeClass("show-arrows");
					//}, 200);
				});


				if( $thisUl.st.autoPlay.enabled ){
					$(".auto-play-btn", $this).addClass("paused");
				}
				$(".auto-play-btn", $this).on("click", function(e){
					e.preventDefault();
					var $this = $(this);
					if( $this.hasClass("paused")){
						$this.removeClass("paused");
						$thisUl._pausedByClick = true;
						if (!$thisUl.noSlide) $thisUl.pause();
						$thisUl.st.autoPlay.enabled = false;
					}else{
						$this.addClass("paused");
						$thisUl._pausedByClick = false;
						if (!$thisUl.noSlide) $thisUl.play();
						$thisUl.st.autoPlay.enabled = true;
					}
				});

			});
			
			
		/* Shortcode scroller: end */


		/* !-Photo slider */

			if($(".photo-scroller").length > 0){

				/* !Set slider */
				$.fn.photoSlider = function() {
					var $el = $(this),
						slides = {},
						thumbs = "";
						$elParent = $el.parents(".photo-scroller");

						slides.$items = $el.children("figure");
						slides.count = slides.$items.length;

					slides.$items.each(function(i) {
						var $this = $(this),
							$slide = $this.children().first().remove(),
							src = $slide.attr("href"),
							$thumbImg = $slide.children("img"),
							thumbSrc = $thumbImg.attr("src");

						// !Captions copying
						$this.find("figcaption").addClass("caption-" + (i+1) + "");
						var $thisCaptionClone = $(this).find("figcaption").clone(true);
						$(".slide-caption").append($thisCaptionClone);
						if (parseInt($elParent.attr("data-thumb-width")) > 0) {
							var thisWidth = parseInt($elParent.attr("data-thumb-width")),
								thisHeight = parseInt($elParent.attr("data-thumb-height"));

							$elParent.removeClass("proportional-thumbs");
						}
						else {
							var thisWidth = parseInt($thumbImg.attr("width")),
								thisHeight = parseInt($thumbImg.attr("height"));

							$elParent.addClass("proportional-thumbs");
						};

						thumbs = thumbs + '<div class="ts-cell" data-width="'+(thisWidth+5)+'" data-height="'+(thisHeight+10)+'"><div class="ts-thumb-img"><img src="'+thumbSrc+'" width="'+thisWidth+'" height="'+thisHeight+'"></div></div>'; 

						$this.prepend('<div class="ts-slide-img"><img src="'+src+'" width="'+$this.attr("data-width")+'" height="'+$this.attr("data-height")+'"></div>');
					});
					$elParent.append('<div class="scroller-arrow prev"><i></i><i></i></div><div class="scroller-arrow next"><i></i><i></i></div>')

					$el.addClass("ts-cont");
					$el.wrap('<div class="ts-wrap"><div class="ts-viewport"></div></div>');

					var $slider = $el.parents(".ts-wrap"),
						windowW = $(window).width(),
						$sliderPar = $elParent,
						$sliderAutoslide = ($sliderPar.attr("data-autoslide") == "true") ? true : false,
						$sliderAutoslideDelay = ($sliderPar.attr("data-delay") && parseInt($sliderPar.attr("data-delay")) > 999) ? parseInt($sliderPar.attr("data-delay")) : 5000,
						$sliderLoop = ($sliderPar.attr("data-loop") === "true") ? true : false,
						$thumbHeight = $sliderPar.attr("data-thumb-height") ? parseInt($sliderPar.attr("data-thumb-height"))+10 : 80+10,
						$slideOpacity = $sliderPar.attr("data-transparency") ? $sliderPar.attr("data-transparency") : 0.5,
						$adminBarH = $("#wpadminbar").length > 0? $("#wpadminbar").height() : 0;

					// !New settings for cells;
					var dataLsMin = $sliderPar.attr("data-ls-min") ? parseInt($sliderPar.attr("data-ls-min")) : 0,
						dataLsMax = $sliderPar.attr("data-ls-max") ? parseInt($sliderPar.attr("data-ls-max")) : 100,
						dataLsFillDt = $sliderPar.attr("data-ls-fill-dt") ? $sliderPar.attr("data-ls-fill-dt") : "fill",
						dataLsFillMob = $sliderPar.attr("data-ls-fill-mob") ? $sliderPar.attr("data-ls-fill-mob") : "fit",
						dataPtMin = $sliderPar.attr("data-pt-min") ? parseInt($sliderPar.attr("data-pt-min")) : 0,
						dataPtMax = $sliderPar.attr("data-pt-max") ? parseInt($sliderPar.attr("data-pt-max")) : 100,
						dataPtFillDt = $sliderPar.attr("data-pt-fill-dt") ? $sliderPar.attr("data-pt-fill-dt") : "fill",
						dataPtFillMob = $sliderPar.attr("data-pt-fill-mob") ? $sliderPar.attr("data-pt-fill-mob") : "fit",
						dataSidePaddings  = $sliderPar.attr("data-padding-side") ? parseInt($sliderPar.attr("data-padding-side")) : 0;

					// !Normalize new settings for cells;
					if (dataLsMax <= 0) dataLsMax = 100;
					if (dataPtMax <= 0) dataPtMax = 100;
					if (dataLsMax < dataLsMax) dataLsMax = dataLsMax;
					if (dataPtMax < dataPtMax) dataPtMax = dataPtMax;

					$slider.addClass("ts-ls-"+dataLsFillDt).addClass("ts-ls-mob-"+dataLsFillMob);
					$slider.addClass("ts-pt-"+dataPtFillDt).addClass("ts-pt-mob-"+dataPtFillMob);

					$slider.find(".ts-slide-img").css({
						"opacity": $slideOpacity
					});
					$slider.find(".video-icon").css({
						"opacity": $slideOpacity
					});


					var	$slideTopPadding = ($sliderPar.attr("data-padding-top") && windowW > 760) ? $sliderPar.attr("data-padding-top") : 0,
						$slideBottomPadding = ($sliderPar.attr("data-padding-bottom") && windowW > 760) ? $sliderPar.attr("data-padding-bottom") : 0;

					var $sliderVP = $slider.find(".ts-viewport");
					$sliderVP.css({
						"margin-top": $slideTopPadding+"px",
						"margin-bottom": $slideBottomPadding+"px"
					});
					
					$(window).on("debouncedresize", function() {
						if ($sliderPar.attr("data-padding-top") && $(window).width() > 760) {
							$slideTopPadding = $sliderPar.attr("data-padding-top");
						}
						else {
							$slideTopPadding = 0;
						};

						if ($sliderPar.attr("data-padding-bottom") && $(window).width() > 760) {
							$slideBottomPadding = $sliderPar.attr("data-padding-bottom");
						}
						else {
							$slideBottomPadding = 0;
						};

						if ($(window).width() > 760) {
							$sliderVP.css({
								"margin-top": $slideTopPadding+"px",
								"margin-bottom": $slideBottomPadding+"px"
							});
						}
						else {
							$sliderVP.css({
								"margin-top": 0+"px",
								"margin-bottom": 0+"px"
							});
						};
					});

					/* !Initializinig the main slider */
					var $sliderData = $slider.thePhotoSlider({
						mode: {
							type: "centered",
							lsMinW: dataLsMin,
							lsMaxW: dataLsMax,
							ptMinW: dataPtMin,
							ptMaxW: dataPtMax,
						},
						height: function() {
							if ($(window).width() < 760) {
								return (window.innerHeight);
							}
							else if ($(".logo-side").length > 0 || $("body").hasClass("transparent") || $slider.parents(".photo-scroller").hasClass("full-screen")) {

								if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
									if($("#top-bar").hasClass("top-bar-hide")){
										return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#header").height() + $("#top-bar").height() - $("#wpadminbar").height());
									}
									else {
										return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#header").height()- $("#wpadminbar").height());
									};
								}
								else {
									return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#wpadminbar").height());
								};

							}
							else {
								if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint) {
									if($("#top-bar").hasClass("top-bar-hide") && $("#top-bar").hasClass("top-bar-disabled")){
										return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#header").height() - $("#wpadminbar").height());
									}else if($("#top-bar").hasClass("top-bar-hide")){
										return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#header").height() + $("#top-bar").height() - $("#wpadminbar").height());
									}else {
										return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#header").height()- $("#wpadminbar").height());
									};
								}
								else {
									return ($(window).height() - $slideTopPadding - $slideBottomPadding - $("#header").height() - $("#wpadminbar").height());
								};
							};
						},
						sidePaddings: dataSidePaddings,
						autoPlay: {
							enabled: $sliderAutoslide,
							delay: $sliderAutoslideDelay,
							loop: $sliderLoop
						}
					}).data("thePhotoSlider");


					var $thumbsScroller = $('<div class="ts-wrap"><div class="ts-viewport"><div class="ts-cont ts-thumbs">'+thumbs+'</div></div></div>');
					$slider.after($thumbsScroller);

					/* !Initializinig the thumbnail stripe */
					var $thumbsScrollerData = $thumbsScroller.thePhotoSlider({
						mode: {
							type: "scroller"
						},
						height: $thumbHeight
					}).data("thePhotoSlider");


					$(".prev", $this_par).click(function() {
						if (!$sliderData.noSlide) $sliderData.slidePrev();
					});
					$(".next", $this_par).click(function() {
						if (!$sliderData.noSlide) $sliderData.slideNext();
					});

					$sliderData.ev.on("updateNav sliderReady", function() {
						if ($sliderData.lockRight) {
							$(".next", $elParent).addClass("disabled");
						} else {
							$(".next", $elParent).removeClass("disabled");
						};

						if ($sliderData.lockLeft) {
							$(".prev", $elParent).addClass("disabled");
						} else {
							$(".prev", $elParent).removeClass("disabled");
						};
					});



					// !Active slide indication and thumbnail mechanics: begin */
					$sliderData.ev.on("sliderReady beforeTransition", function() {
						$sliderData.slides.$items.removeClass("act");
						$sliderData.slides.$items.eq($sliderData.currSlide).addClass("act");

						$thumbsScrollerData.slides.$items.removeClass("act");
						$thumbsScrollerData.slides.$items.eq($sliderData.currSlide).addClass("act");

						if($sliderData.slides.$items.eq($sliderData.currSlide).hasClass("ts-video")){
							$sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-overlay");
						}else if($sliderData.slides.$items.eq($sliderData.currSlide).find(".ps-link").length > 0){
							$sliderData.slides.$items.parents(".ts-wrap ").addClass("hide-overlay");
						}else{
							$sliderData.slides.$items.parents(".ts-wrap ").removeClass("hide-overlay");
						};


						var actCaption = $sliderData.slides.$items.eq($sliderData.currSlide).find("figcaption").attr("class");

						$('.slide-caption > figcaption').removeClass("actCaption");
						$('.slide-caption > .'+actCaption).addClass("actCaption");
					});

					$sliderData.ev.on("afterTransition", function() {
						var viewportLeft	= -($thumbsScrollerData._unifiedX()),
							viewportRight	= viewportLeft + $thumbsScrollerData.wrap.width,
							targetLeft		= -$thumbsScrollerData.slides.position[$sliderData.currSlide],
							targetRight		= targetLeft + $thumbsScrollerData.slides.width[$sliderData.currSlide];

						targetLeft = targetLeft - 50;
						targetRight = targetRight + 50;

						if (targetLeft < viewportLeft) {

							for (i = $thumbsScrollerData.currSlide; i >= 0; i--) {
								targetLeft = targetLeft + 50;
								targetRight = targetRight - 50;

								var tempViewportLeft	= -$thumbsScrollerData.slides.position[i],
									tempViewportRight	= tempViewportLeft + $thumbsScrollerData.wrap.width;

								if (targetRight > tempViewportRight) {
									$thumbsScrollerData.slideTo(i+1);
									break;
								} 
								else if (i === 0) {
									$thumbsScrollerData.slideTo(0);
								}
							}
						}
						else if (targetRight > viewportRight) {
							$thumbsScrollerData.slideTo($sliderData.currSlide);
						};
					});

					$thumbsScroller.addClass("scroller-thumbnails");
					$thumbsScrollerData.slides.$items.each(function(i) {
						$(this).on("click", function(event) {
							var $this = $(this);

							if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
							$sliderData.slideTo(i);
						});
					});
					$sliderData.slides.$items.each(function(i) {
						$(this).on("click", function(event) {
							var $this = $(this);

							if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
							$sliderData.slideTo(i);
						});
					});
					// !Active slide indication and thumbnail mechanics: end */



					var $this_par = $slider.parents(".photo-scroller");

					/* !- Autoplay */
					if( $sliderData.st.autoPlay.enabled ){
						$(".auto-play-btn", $this_par).addClass("paused");
					}
					
					$(".auto-play-btn", $this_par).on("click", function(e){
						e.preventDefault();
						var $this = $(this);
						if( $this.hasClass("paused")){
							$this.removeClass("paused");
							if (!$sliderData.noSlide) $sliderData.pause();
							$sliderData.st.autoPlay.enabled = false;
						}else{
							$this.addClass("paused");
							if (!$sliderData.noSlide) $sliderData.play();
							$sliderData.st.autoPlay.enabled = true;
						}
					});

				};

				/* !- Initialize slider */
				$(".photoSlider").photoSlider();
				
				/* !- Show slider*/

				$(".photoSlider").parents(".photo-scroller").css("visibility", "visible");

				$(".photo-scroller").each(function(){
					var $this = $(this);
					$(".btn-cntr, .slide-caption", $this).css({
						"bottom": parseInt($this.attr("data-thumb-height")) + 15
					});
				});

				function launchFullscreen(element) {
					if(element.requestFullscreen) {
						element.requestFullscreen();
					} else if(element.mozRequestFullScreen) {
						element.mozRequestFullScreen();
					} else if(element.webkitRequestFullscreen) {
						element.webkitRequestFullscreen();
					} else if(element.msRequestFullscreen) {
						element.msRequestFullscreen();
					}
				}
				function exitFullscreen() {
					if(document.exitFullscreen) {
						document.exitFullscreen();
					} else if(document.mozCancelFullScreen) {
						document.mozCancelFullScreen();
					} else if(document.webkitExitFullscreen) {
						document.webkitExitFullscreen();
					}
				};


				/* !- Fullscreen button */
				if(!$("html").hasClass("old-ie") || !dtGlobals.isWindowsPhone){
					$(".full-screen-btn").each(function(){
						var $this = $(this),
							$thisParent = $this.parents(".photo-scroller");
						document.addEventListener("fullscreenchange", function () {
							if(!document.fullscreen){
								$this.removeClass("act");
								$thisParent.removeClass("full-screen");
								$("body, html").css("overflow", "");
							}
						}, false);
						document.addEventListener("mozfullscreenchange", function () {
							if(!document.mozFullScreen){
								$this.removeClass("act");
								$thisParent.removeClass("full-screen");
								$("body, html").css("overflow", "");
							}
						}, false);
						document.addEventListener("webkitfullscreenchange", function () {
							if(!document.webkitIsFullScreen){
								$this.removeClass("act");
								$thisParent.removeClass("full-screen");
								$("body, html").css("overflow", "");
								var scroller = $frame.data("thePhotoSlider");
								if(typeof scroller!= "undefined"){
									scroller.update();
								};
							}
						}, false);
					})

					$(".full-screen-btn").on("click", function(e){
						e.preventDefault();
						var $this = $(this),
							$thisParent = $this.parents(".photo-scroller"),
							$frame = $thisParent.find(".ts-wrap"),
							$thumbs = $thisParent.find(".scroller-thumbnails").data("thePhotoSlider"),
							$scroller = $frame.data("thePhotoSlider");
						$this.parents(".photo-scroller").find("figure").animate({"opacity": 0},150);
						if( $this.hasClass("act")){
						
							$this.removeClass("act");
							exitFullscreen();
							$thisParent.removeClass("full-screen");

							setTimeout(function(){
								$this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
							}, 300);
						}else{
							 $this.addClass("act");
							$thisParent.addClass("full-screen");
							launchFullscreen(document.documentElement);
							$("body, html").css("overflow", "hidden");
							setTimeout(function(){
								$this.parents(".photo-scroller").find("figure").delay(600).animate({"opacity": 1},300)
							}, 300)
						}
						var scroller = $frame.data("thePhotoSlider");
						if(typeof scroller!= "undefined"){
							scroller.update();
						};
					});
				}

				/* !- Show/hide thumbs */
				$(".photo-scroller").each(function(){
					var $this = $(this);
					if( $this.hasClass("hide-thumbs")){
						$this.find(".hide-thumb-btn").addClass("act");
						$(".scroller-thumbnails", $this).css({
							"bottom": -(parseInt($this.attr("data-thumb-height")) +20)
						});
						$(".btn-cntr, .slide-caption", $this).css({
							"bottom": 5 + "px"
						});
					}
				});
				$(".hide-thumb-btn").on("click", function(e){
					e.preventDefault();
					var $this = $(this),
						$thisParent = $this.parents(".photo-scroller");
					if( $this.hasClass("act")){
						 $this.removeClass("act");
						$thisParent.removeClass("hide-thumbs");
						$(".scroller-thumbnails", $thisParent).css({
							"bottom": 0
						});
						$(".btn-cntr, .slide-caption", $thisParent).css({
							"bottom": parseInt($thisParent.attr("data-thumb-height")) + 15
						});

					}else{
						 $this.addClass("act");
						$thisParent.addClass("hide-thumbs");
						$(".scroller-thumbnails", $thisParent).css({
							"bottom": -(parseInt($thisParent.attr("data-thumb-height")) +20)
						});
						$(".btn-cntr, .slide-caption", $thisParent).css({
							"bottom": 5 + "px"
						});
					}
				});
			};

		/* Photo slider:end */

	/*SLIDERS:end*/

	/* !Smart benefits & logos resize */

		$.fn.smartGrid = function() {
			return this.each(function() {
				var $this = $(this),
					colNum = parseInt($this.attr("data-columns")),
					colMinWidth = parseInt($this.attr("data-width")),
					contWidth = $this.width();

				for ( ; Math.floor(contWidth/colNum) < colMinWidth; ) {
					colNum--;
					if (colNum <= 1) break;
				}
		
				$("> .wf-cell", $this).css({
					width: (100/colNum).toFixed(6) + "%",
					display: "inline-block"
				});
			});
		};

		var $benLogColl = $(".benefits-grid, .logos-grid");
		$benLogColl.smartGrid();
		$(window).on("debouncedresize", function () {
			$benLogColl.smartGrid();
		});

	/* !-Smart benefits & logos resize:end */

	/*!Instagram style photos*/

		function calcPics(maxitemwidth){
			var $collection = $(".instagram-photos");
			if ($collection.length < 1) return false;

			$collection.each(function(){
				var maxitemwidth = maxitemwidth ? maxitemwidth : parseInt($(this).attr("data-image-max-width")),
					itemmarg = parseInt($(this).find("> a").css("margin-left"));
				$(this).find(" > a").css({
					"max-width": maxitemwidth,
					"opacity": 1
				});

				// Cahce everything
				var $container = $(this),
					containerwidth = $container.width(),
					itemperc = (100/(Math.ceil(containerwidth/maxitemwidth)));
			
				$container.find("a").css({ "width": itemperc+'%' });
			});
		};

	/* Instagram style photos: end */

	/* !Filter */

		$(".filter-categories > a").on("click", function(e) {
			var $this = $(this);
			
			if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
				var $filter = $this.parents(".filter").first();

				if ( $filter.hasClass("without-isotope") ) {
					arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
				} else {
					arguments.callee.dtPreventD = true;
				};
			};

			e.preventDefault();

			$this.trigger("mouseleave");
			
			if ($this.hasClass("act") && !$this.hasClass("show-all")) {
				e.stopImmediatePropagation();
				$this.removeClass("act");
				$this.siblings("a.show-all").trigger("click");//.addClass("act");
			} else {
				$this.siblings().removeClass("act");
				$this.addClass("act");

				if ( !arguments.callee.dtPreventD ) {
					window.location.href = $this.attr("href");
				}
			};
		});
		$(".filter-extras .filter-switch").each(function(){
			var $_this = $(this);
			if($_this.prev('.act').length){
				$_this.addClass('left-act');
			}else if($_this.next('.act').length){
				$_this.addClass('right-act');
			}else{
				$_this.removeClass('right-act');
				$_this.removeClass('left-act');
			};
		});
		$(".filter-extras a").on("click", function(e) {
			var $this = $(this);
			
			if ( typeof arguments.callee.dtPreventD == 'undefined' ) {
				var $filter = $this.parents(".filter").first();

				if ( $filter.hasClass("without-isotope") ) {
					arguments.callee.dtPreventD = $filter.hasClass("with-ajax") ? true: false;
				} else {
					arguments.callee.dtPreventD = true;
				}
			};

			if ( arguments.callee.dtPreventD ) {
				e.preventDefault();
			};

			$this.siblings().removeClass("act");
			$this.addClass("act");

			$(".filter-extras .filter-switch").each(function(){
				var $_this = $(this);
				if($_this.prev($this).hasClass('act')){
					$_this.addClass('left-act');
					$_this.removeClass('right-act');
				}else if($_this.next($this).hasClass('act')){
					$_this.addClass('right-act');
					$_this.removeClass('left-act');
				}else{
					$_this.removeClass('right-act');
					$_this.removeClass('left-act');
				};
			});
		});

	/* Filter: end */

	/* !Magnific popup gallery */

		dtGlobals.magnificPopupBaseConfig = {
			type: 'image',
			tLoading: 'Loading image ...',
			mainClass: 'mfp-img-mobile',
			removalDelay: 300,
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
					return this.st.dt.getItemTitle(item);
				}
			},
			iframe: {
				markup: '<div class="mfp-iframe-scaler">'+
						'<div class="mfp-close"></div>'+
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
						'<div class="mfp-bottom-bar">'+
						'<div class="mfp-title"></div>'+
						'<div class="mfp-counter"></div>'+
						'</div>'+
						'</div>'
			},
			callbacks: {
				markupParse: function(template, values, item) {
					if ( 'iframe' == item.type ) {
						template.find('.mfp-title').html( this.st.dt.getItemTitle(item) );
					}

					if ( !this.ev.attr('data-pretty-share') ) {
						template.addClass("no-share-buttons");
					}
				},
				change: function() {
					if (this.isOpen) {
						/*transition between the images in the gallery*/
						this.wrap.addClass('mfp-open');
					}
				},
				beforeClose: function() {
					$('body, html').css('overflow','');
					this.wrap.removeClass('mfp-open');
					this.content.addClass('mfp-removing');
				},
				close: function() {
					this.content.removeClass('mfp-removing'); 
				},
				beforeOpen: function() {

					var magnificPopup = this;
					// create settings container
					if ( typeof this.st.dt == 'undefined' ) {
						this.st.dt = {};
					}

					// save share buttons array
					this.st.dt.shareButtonsList = this.ev.attr('data-pretty-share') ? this.ev.attr('data-pretty-share').split(',') : new Array();

					// share buttons template
					this.st.dt.shareButtonsTemplates = {
						twitter : '<a href="//twitter.com/home?status={location_href}%20{share_title}" class="share-button twitter" target="_blank" title="twitter"><svg class="icon" viewBox="0 0 22 22"><path d="M17.614,5.604c-0.556,0.325-1.171,0.56-1.822,0.688c-0.526-0.551-1.271-0.895-2.099-0.895c-1.586,0-2.873,1.268-2.873,2.83c0,0.221,0.025,0.438,0.074,0.645C8.508,8.753,6.393,7.625,4.977,5.913C4.729,6.33,4.588,6.816,4.588,7.336c0,0.982,0.508,1.85,1.276,2.354c-0.47-0.014-0.912-0.141-1.3-0.354c0,0.013,0,0.024,0,0.035c0,1.372,0.991,2.514,2.304,2.775c-0.241,0.062-0.495,0.101-0.756,0.101c-0.186,0-0.365-0.019-0.541-0.054c0.365,1.127,1.427,1.945,2.682,1.97c-0.982,0.756-2.222,1.208-3.567,1.208c-0.232,0-0.461-0.016-0.686-0.04c1.271,0.804,2.78,1.272,4.402,1.272c5.286,0,8.171-4.312,8.171-8.053c0-0.123-0.003-0.246-0.009-0.367c0.563-0.397,1.05-0.895,1.436-1.463c-0.516,0.225-1.068,0.378-1.648,0.446C16.943,6.817,17.398,6.262,17.614,5.604z"/></svg></a>',
						facebook : '<a href="//www.facebook.com/sharer.php?s=100&amp;p[url]={location_href}&amp;p[title]={share_title}&amp;p[images][0]={image_src}" class="share-button facebook" target="_blank" title="facebook"><svg class="icon" viewBox="0 0 22 22" ><path d="M13.537,10.513l-1.74,0.001l0.051,6.648H9.395l0.014-6.648H7.816V8.413l1.592-0.001L9.407,7.177c0-1.713,0.485-2.755,2.593-2.755h1.758v2.101H12.66c-0.824,0-0.863,0.292-0.863,0.84l-0.004,1.049h1.975L13.537,10.513z"/></svg></a>',
						google : '<a href="////plus.google.com/share?url={location_href}&amp;title={share_title}" class="share-button google" target="_blank" title="google+"><svg class="icon" viewBox="0 0 22 22" ><path d="M18.02,9.145h-1.953l0.021,1.958h-1.344l-0.022-1.937l-1.854-0.019l-0.024-1.258l1.896-0.008V5.864h1.343V7.86l1.936,0.042L18.02,9.145L18.02,9.145z M12.254,14.303c0,1.217-1.108,2.698-3.9,2.698c-2.043,0-3.748-0.884-3.748-2.364c0-1.146,0.725-2.625,4.107-2.625c-0.5-0.412-0.625-0.984-0.318-1.604c-1.98,0-2.995-1.166-2.995-2.645c0-1.447,1.076-2.762,3.271-2.762c0.557,0,3.54,0,3.54,0l-0.809,0.823h-0.923C11.13,6.241,11.52,6.97,11.52,7.813c0,0.778-0.427,1.407-1.036,1.874c-1.085,0.838-0.807,1.354,0.312,2.133c1.091,0.845,1.464,1.47,1.464,2.482H12.254z M9.863,7.771C9.712,6.847,8.967,6.09,8.095,6.068c-0.872-0.021-1.457,0.687-1.307,1.61C6.939,8.615,7.726,9.24,8.663,9.24c0.848,0.093,1.305-0.531,1.201-1.458L9.863,7.771z M10.544,14.486c0-0.707-0.78-1.379-2.087-1.379c-1.178-0.015-2.179,0.615-2.179,1.354c0,0.729,0.833,1.354,1.978,1.359c1.56-0.031,2.338-0.553,2.338-1.334H10.544z"/></svg></a>',
						pinterest : '<a href="//pinterest.com/pin/create/button/?url={location_href}&amp;description={share_title}&amp;media={image_src}" class="share-button pinterest" target="_blank" title="pin it"><svg class="icon" viewBox="0 0 22 22"><path d="M7.318,12.361c0.703-1.242-0.227-1.515-0.372-2.415c-0.596-3.68,4.244-6.193,6.779-3.622c1.754,1.781,0.599,7.257-2.229,6.688C8.786,12.467,12.82,8.11,10.66,7.255c-1.757-0.696-2.689,2.126-1.856,3.528c-0.489,2.412-1.541,4.683-1.114,7.708c1.381-1.002,1.847-2.923,2.228-4.923c0.695,0.422,1.065,0.859,1.951,0.929c3.264,0.253,5.089-3.258,4.641-6.5c-0.396-2.872-3.259-4.335-6.313-3.992c-2.415,0.27-4.822,2.222-4.922,5.014C5.212,10.723,5.697,12.002,7.318,12.361z"/></svg></a>',
						linkedin : '<a href="//www.linkedin.com/shareArticle?mini=true&url={location_href}&title={share_title}" class="share-button linkedin" target="_blank" ><svg class="icon" viewBox="0 0 22 22"><path d="M9.269 7.02c0 0.714-0.586 1.293-1.307 1.293c-0.722 0-1.307-0.579-1.307-1.293 c0-0.712 0.585-1.291 1.307-1.291C8.683 5.7 9.3 6.3 9.3 7.02H9.269z M9.061 9.279H6.873v7.392h2.188V9.279z M12.91 9.3 h-1.795l-0.027 7.392h2.044c0 0 0-2.742 0-3.879c0-1.04 0.775-1.79 1.7-1.665c0.824 0.1 1.1 0.6 1.1 1.7 c0 1.028-0.021 3.915-0.021 3.89h2.025c0 0 0.025-2.729 0.025-4.708c0-1.981-1.006-2.78-2.604-2.78 c-1.599 0-2.248 1.096-2.248 1.096v-1H12.91z"/></svg></a>'
					};

					// share buttons
					this.st.dt.getShareButtons = function ( itemData ) {

						var shareButtons = magnificPopup.st.dt.shareButtonsList,
							pinterestIndex = -1,
							shareButtonsLemgth = shareButtons.length,
							html = '';

						for( var i = 0; i < shareButtons.length; i++ ) {

							if ( 'pinterest' == shareButtons[i] ) {
								pinterestIndex = i;
								break;
							}
						}

						if ( shareButtonsLemgth <= 0 ) {
							return '';
						}

						for ( var i = 0; i < shareButtonsLemgth; i++ ) {

							// exclude pinterest button for iframes
							if ( 'iframe' == itemData['type'] && pinterestIndex == i ) {
								continue;
							}

							var	itemTitle = itemData['title'],
								itemSrc = itemData['src'],
								itemLocation = itemData['location'];

							if ( 'google' == shareButtons[i] ) {
								itemTitle = itemTitle.replace(' ', '+');
							}

							html += magnificPopup.st.dt.shareButtonsTemplates[ shareButtons[i] ].replace('{location_href}', encodeURIComponent(itemLocation)).replace('{share_title}', itemTitle).replace('{image_src}', itemSrc);
						}

						return '<div class="entry-share"><div class="soc-ico">' + html + '<div></div>';
					}

					// item title
					this.st.dt.getItemTitle = function(item) {
						var imgTitle = item.el.attr('title') || '',
							imgSrc = item.el.attr('href'),
							imgDesc = item.el.attr('data-dt-img-description') || '',
							imgLocation = item.el.attr('data-dt-location') || location.href,
							shareButtons = magnificPopup.st.dt.getShareButtons( { 'title': imgTitle, 'src': imgSrc, 'type': item.type, 'location': imgLocation } );

						return imgTitle + '<small>' + imgDesc + '</small>' + shareButtons;
					}
				}
			}
		};

		// trigger click on first anchor in the gallery container
		// work only for posts list
		$('.dt-gallery-mfp-popup').addClass('mfp-ready').on('click', function(){
			var $this = $(this),
				$container = $this.parents('article.post');
			if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
			if ( $container.length > 0 ) {
				var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

				if ( $target.length > 0 ) {
					$target.first().trigger('click');
				}
			};

			return false;
		});

		// trigger click on first a.dt-mfp-item in the container
		$('.dt-trigger-first-mfp').addClass('mfp-ready').on('click', function(){
			var $this = $(this),
				$container = $this.parents('article.post');
			if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

			if ( $container.length > 0 ) {
				var $target = $container.find('a.dt-mfp-item');

				if ( $target.length > 0 ) {
					$target.first().trigger('click');
				}
			};

			return false;
		});

		// single opup
		$('.dt-single-image').addClass('mfp-ready').magnificPopup({
			type: 'image'
		});

		$('.dt-single-video').addClass('mfp-ready').magnificPopup({
			type: 'iframe'
		});
		$('.dt-single-mfp-popup').on("click", function(e){
			var $this = $(this);
			if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) {
				e.preventDefault();
				e.stopImmediatePropagation();
			};
			if($this.parents(".photo-scroller").length > 0){
				var parScroller = $this.parents(".photo-scroller"),
				parAutoPlay = parScroller.find(".auto-play-btn");

				if( parAutoPlay.hasClass("paused") ){
					parScroller.addClass("mfp-opened");
					parScroller.find(".auto-play-btn.paused").trigger("click");
				};
			};
			if($this.parents(".slider-wrapper").length > 0){
				var parScrollerShor = $this.parents(".slider-wrapper"),
					parAutoPlayShor = parScrollerShor.find(".auto-play-btn");

				if( parAutoPlayShor.hasClass("paused") ){
					parScrollerShor.addClass("mfp-opened");
					parScrollerShor.find(".auto-play-btn.paused").trigger("click");
				};
			}

		});

		$('.dt-single-mfp-popup').addClass('mfp-ready').magnificPopup($.extend( true, dtGlobals.magnificPopupBaseConfig, {
			callbacks: {
				close: function() {
					$(".photo-scroller.mfp-opened").find(".auto-play-btn").trigger("click");
					$(".photo-scroller").removeClass("mfp-opened");
					$(".slider-wrapper.mfp-opened").find(".auto-play-btn").trigger("click");
					$(".slider-wrapper").removeClass("mfp-opened");
				}
			}
		}));


		$(".dt-gallery-container").each(function(){
			if($(this).parents(".slider-wrapper").length > 0){
				var $this = $(this).parents(".slider-wrapper");
			}else{
				var $this = $(this);
			}
			var $thisPlay = $this.find(".auto-play-btn");
			$(this).addClass('mfp-ready').magnificPopup( $.extend( true, dtGlobals.magnificPopupBaseConfig, {
				delegate: 'a.dt-mfp-item',
				tLoading: 'Loading image #%curr%...',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				callbacks: {
					open: function() {
						var stopAutoPlay = ( 'true' === $this.attr("data-autoslide") ) ? true : false;
						if(stopAutoPlay){
							if( $thisPlay.hasClass("paused") ){
								$this.addClass("mfp-opened");
								$this.find(".auto-play-btn.paused").trigger("click");
							};
						}
					},
					close: function() {
						if( $this.hasClass("mfp-opened") ){
							$this.find(".auto-play-btn").trigger("click");
							$this.removeClass("mfp-opened");
						}
					}
				}

			} ) );
		});

	/* Magnific popup gallery: end */

	/* !- Justified Gallery */

		var jgCounter = 0;
		$(".jg-container").each(function() {
			jgCounter++;
			var $jgContainer = $(this),
				$jgItemsPadding = $jgContainer.attr("data-padding"),
				$jgItems = $jgContainer.find(".wf-cell");
			// .iso-item elements are hidden by default, so we show them.

			$jgContainer.attr("id", "jg-container-" + jgCounter + "");

			$("<style type='text/css'>" + ' .content #jg-container-' + jgCounter + ' .wf-cell'  + '{padding:'  + $jgItemsPadding + ';}' + ' .content #jg-container-' + jgCounter + '.wf-container'  + '{'+ 'margin:'  + '-'+ $jgItemsPadding + ';}' + ' .content .full-width-wrap #jg-container-' + jgCounter + '.wf-container'  + '{'+ 'margin-left:'  + $jgItemsPadding + '; '+ 'margin-right:'  + $jgItemsPadding + '; '+ 'margin-top:' + '-' + $jgItemsPadding + '; '+ 'margin-bottom:' + '-' + $jgItemsPadding + ';}' +"</style>").insertAfter($jgContainer);

			$jgContainer.on("jgDone", function() {});
		});

		$.fn.collage = function() {
			return this.each(function() {
				var $this = $(this);
				var $jgContainer = $(this),
					$jgItemsPadding = $jgContainer.attr("data-padding"),
					$jgItems = $jgContainer.find(".wf-cell");
				var jgPadding = parseFloat($jgItems.first().css('padding-left')) + parseFloat($jgItems.first().css('padding-right')),
					jgTargetHeight = parseInt($jgContainer.attr("data-target-height")),
					jdPartRow = true;

				if ($jgContainer.attr("data-part-row") == "false") {
					jdPartRow = false;
				};


				if($jgContainer.parent(".full-width-wrap").length){
					var jgAlbumWidth = $jgContainer.parents(".full-width-wrap").width() - parseInt($jgItemsPadding)*2;
				}else{
					var jgAlbumWidth = $jgContainer.parent().width() + parseInt($jgItemsPadding)*2;
				}
				
				var $jgCont = {
					'albumWidth'			: jgAlbumWidth,
					'targetHeight'			: jgTargetHeight,
					'padding'				: jgPadding,
					'allowPartialLastRow'	: jdPartRow,
					'fadeSpeed'				: 2000,
					'effect'				: 'effect-1',
					'direction'				: 'vertical'
				};
				dtGlobals.jGrid = $jgCont;
				$jgContainer.collagePlus($jgCont);
				$jgContainer.css({
					'width': jgAlbumWidth
				});
			});
		};
		$(window).on("debouncedresize", function() {
			$(".jg-container").collage();
		});

	/* - Justified Gallery: end */

	/*!-Misc-2*/

		$("#parent-element a").live("touchstart",function(e){
			var $link_id = $(this).attr("id");
			if ($(this).parent().data("clicked") == $link_id) {
				// element has been tapped (hovered), reset 'clicked' data flag on parent element and return true (activating the link)
				$(this).parent().data("clicked", null);
				return true;
			} else {
				$(this).trigger("mouseenter").siblings().trigger("mouseout"); //triggers the hover state on the tapped link (because preventDefault(); breaks this) and untriggers the hover state for all other links in the container.
				// element has not been tapped (hovered) yet, set 'clicked' data flag on parent element to id of clicked link, and prevent click
				e.preventDefault(); // return false; on the end of this else statement would do the same
				$(this).parent().data("clicked", $link_id); //set this link's ID as the last tapped link ('clicked')
			}
		});

		/* !- Accordion Toggle Tooltip */
			$(".st-accordion").dtAccordion({
				open: 0,
				oneOpenedItem: true
			});
			simple_tooltip(".shortcode-tooltip","shortcode-tooltip-content");
		/*Accordion Toggle Tooltip: end*/

		/* !- Grayscale */
			$(".filter-grayscale .slider-masonry").on("mouseenter tap", function(e) {
				if(e.type == "tap") {
					e.stopPropagation();
				};
				$(this).addClass("dt-hovered");
			});

			$(".filter-grayscale .slider-masonry").on("mouseleave", function(e) {
				$(this).removeClass("dt-hovered");
			});
		/* Grayscale: end */

		/* !Append tag </i> to rolovers*/
			$(".vc-item .vc-inner > a").each(function(){
				$(this).addClass("rollover");
			});

			$.fn.addRollover = function() {
				return this.each(function() {
					var $this = $(this);
					if ($this.hasClass("this-ready")) {
						return;
					}

					$this.append("<i></i>");
					if($this.find(".rollover-thumbnails").length){
						$this.addClass("rollover-thumbnails-on");
					}

					$this.addClass("this-ready");
				});
			};
			$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content, .vc-item .vc-inner > a").addRollover();

		/* Append tag </i> to rolovers:end*/

		/* !Animate rolovers in old ie*/

			$(".rollover, .post-rollover").not(".no-avatar").each(function(){
				var $this = $(this);
				if( $("html").hasClass("old-ie") ){
					$this.hover(function(){
						$("> i, .rollover-thumbnails", this).stop(true).fadeIn();
					},function(){			
						$(" > i, .rollover-thumbnails", this).stop(true).fadeOut();
					});
				}
			});

			$(".fs-entry, .rollover-project .link").each(function(){
				var $this = $(this);
				if( $("html").hasClass("old-ie") ){
					$(".fs-entry .link, .rollover-project .link i").stop(true).fadeOut();
					$this.hover(function(){
						$(" > .link, i", this).css('display', 'block');
					},function(){			
						$(" > .link, i", this).css('display', 'none');
					});
				}
			});

		/* Animate rolovers in old ie:end*/

		/*!-Hover Direction aware*/

			$('.no-touch .hover-grid .rollover-project, .no-touch .hover-grid .fs-entry-slide ').each( function() { $(this).hoverdir(); } );

		/*Hover Direction aware:end*/

		/*!Change filter appearance when too much categories*/

			function changeFilter(){
				$(".filter-categories").each(function(){
					var width = 0;
					$(".filter-categories a").each(function(){
						var $_this = $(this);
						if($(".style-ios").length > 0){
							width += ($_this.innerWidth()-1);
						}else{
							width += $_this.innerWidth();
						}
					});
					if( width > $(this).width() ){
						$(this).addClass("new-style")
					}else{
						$(this).removeClass("new-style")
					}
				});
			};
			changeFilter();

		/*Change filter appearance when too much categories:end*/

		/* !Fullwidth wrap for shortcodes & templates */

			function fullWidthWrap(){
				if( $(".full-width-wrap").length > 0 ){
					$(".full-width-wrap").each(function(){
						var $_this = $(this),
							windowW = window.innerWidth,
							contentW = $('.content').width();

							var $offset_fs,
								$width_fs;
						 
							if ($('.boxed').length > 0) {
								$offset_fs = ((parseInt($('#main').width()) - parseInt(contentW)) / 2);
							}
							else if ($('.sticky-header .logo-side').length && window.innerWidth > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								var $windowWidth = ($(window).width() <= parseInt(contentW)) ? parseInt(contentW) : $(window).width();
								$offset_fs = Math.ceil( (($(window).width() - parseInt(contentW)) / 2) );
							}
							else if ($('.logo-side').length && window.innerWidth > dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
								var $windowWidth = (windowW <= parseInt(contentW)) ? parseInt(contentW) : ($(window).width() - $('.logo-side').width());
								$offset_fs = Math.ceil( (($windowWidth - parseInt(contentW)) / 2) );
							}
							else {
								var $windowWidth = ($(window).width() <= parseInt(contentW)) ? parseInt(contentW) : $(window).width();
								$offset_fs = Math.ceil( (($(window).width() - parseInt(contentW)) / 2) );
							};

							if($('.sidebar-left').length > 0 || $('.sidebar-right').length > 0){
								$width_fs = $(".content").width();
								$offset_fs = 0;
							}else{
								$width_fs = $("#main").innerWidth();
							}

							$_this.css({
								width: $width_fs,
								"margin-left": -$offset_fs,
								"opacity": 1
							});
							var scroller = $_this.find(".ts-wrap").data("thePhotoSlider");
							if(typeof scroller!= "undefined"){
								scroller.update();
							};
					});
				};
			};

			if( $(".full-width-wrap").length > 0 ){
				if(dtGlobals.isMobile && !dtGlobals.isWindowsPhone){
					$(window).bind("orientationchange", function() {
						fullWidthWrap();
					}).trigger( "orientationchange" );
				}
				else {
					$(window).on("resize", function(){
						fullWidthWrap();
					});
					fullWidthWrap();
				};
				
			};

		/* Fullwidth wrap for shortcodes & templates:end */

		/*!-Show Hide side header*/

			if($(".sticky-header").length > 0 ) {
				$('<div class="menu-btn"><div class="lines-button x"><span class="lines"></span></div></div>').insertBefore(".logo-side");
				$("body").append('<div class="sticky-header-overlay"></div>');

				var scrollDiv = document.createElement("div");
				scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
				document.body.appendChild(scrollDiv);
				var scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;

				$(".menu-btn").on("click", function (){
					var $this = $(this);
					if ($this.hasClass("active")){
						$this.removeClass("active");
						$this.parents("#page").removeClass("show-header");
						$this.parents("body").removeClass("show-sticky-header");
						$(".sticky-header-overlay").removeClass("active");
						$("html").css({
							"margin-right": ""
						})
					}else{
						$this.siblings().removeClass("active");
						$this.addClass('active');
						$this.parents("#page").addClass("show-header");
						$this.parents("body").addClass("show-sticky-header");
						$("html").css({
							"margin-right": scrollbarSize
						});
						$(".sticky-header-overlay").addClass("active");
					};
				});
				$(".sticky-header-overlay").on("click", function (){
					if($(this).hasClass("active")){
						$(".menu-btn").removeClass("active");
						$("#page").removeClass("show-header");
						$("body").removeClass("show-sticky-header");
						$(".sticky-header-overlay").removeClass("active");
						$("html").css({
							"margin-right": ""
						})
					}
				});
			};

		/*Show Hide side header:end*/

		/* !- Right-side header + boxed layout */
			function ofX() {
				if ($("body").hasClass("header-side-right") && $("#page").hasClass("boxed")) {
					$("#header").css({
						right: ($(window).width() - $("#page").innerWidth())/2
					});
				};
			};

			ofX();
			$(window).on("resize", function() {
				ofX();
			});

		/* Right-side header + boxed layout: end */

		/*!-Mobile top bar*/

			/*Append arrow to top-bar*/
				if(!$(".responsive-off").length){
					var topBar = $("#top-bar");
					if(topBar.hasClass("line-content")){
						if( topBar.hasClass("top-bar-opened") ) {
							topBar.find(".wf-container-top").append($("<span class='top-bar-arrow'></span>"));
						}else{
							topBar.find(".wf-container-top").append($("<span class='act top-bar-arrow'></span>"));
						}
						var topSpan = $(".wf-container-top > span", topBar),
							topBarPaddingB = parseInt($(".line-content .wf-container-top").css("padding-bottom"))+3;
					}else{
						if( topBar.hasClass("top-bar-opened") ) {
							topBar.append($("<span class='top-bar-arrow'></span>"));
						}else{
							topBar.append($("<span class='act top-bar-arrow'></span>"));
						}
						var topSpan = $("> span", topBar),
							topBarPaddingB = 0;
					}
				};
				var topBar = $("#top-bar");
				function mobileHeader(){
					var moveBlock = $(".text-near-menu"),
						moveBlockClone = $(".text-near-menu > *").clone(true).addClass("top-text-near-menu"),
						logoTextClone = $(".text-near-logo > *").clone(true).addClass("top-text-near-logo"),
						bottomTextClone = $(".header-bottom-bar .wf-td > *").clone(true).addClass("top-header-bottom-bar")/*,
						topBarClone = $("#top-bar .wf-td > *").clone(true).unwrap().addClass("top-bar-mobile")*/;
						
					if( moveBlock.length > 0 || moveBlockClone.length > 0 || logoTextClone.length > 0 || bottomTextClone.length > 0 ){
						if(!$("#top-bar .wf-td").length > 0){
							$("#top-bar .wf-table").append("<div class='wf-td'></div>");
						}
					}
					if( !moveBlock.length > 0 && !moveBlockClone.length > 0 && !logoTextClone.length > 0 && !bottomTextClone.length > 0 && $("#top-bar.top-bar-empty").length > 0 ){
						topBar.addClass("mobile-top-bar-empty");
					}
					var topBarTd = $("#top-bar .wf-td:last-child");
					if(moveBlock.length){
						$(topBarTd).append(moveBlockClone);
					};
					if($(".text-near-logo").length){
						$(topBarTd).append(logoTextClone);
					}
					if($(".header-side-left").length || $(".header-side-right").length){
						$(topBarTd).append(bottomTextClone);
					}
				};
				mobileHeader();

				function mobileTopBar(){
					if(!$(".responsive-off").length){

						if(topBar.hasClass("line-content")){
							var topBarPaddingB = parseInt($(".wf-container-top").css("padding-bottom"))+3;
						}else{
							var topBarPaddingB = 0;
						};
						if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
							if(topSpan.hasClass("act")){
								topBar.animate({
									"margin-top": -topBar.height() + topBarPaddingB
								}, 200, function() {
									topBar.css({"opacity": "1"});
								});
							}else{
								topBar.animate({
									"margin-top": 0
								}, 200, function() {
									topBar.css({"opacity": "1"});
								});
							}
						};
						var scroller = $(".ts-wrap").data("thePhotoSlider");
						if(typeof scroller!= "undefined"){
							scroller.update();
						};
					}
				};

			/*Side header scrollbar*/
				if($(".logo-side").length > 0){
					$(".header-side-content").mCustomScrollbar({
						scrollInertia:150,
						advanced:{
							updateOnBrowserResize: true,
							updateOnContentResize: true
						}
					});
				};

			/*Show Hide top bar on click*/

			if(!$(".responsive-off").length){
				$(".top-bar-arrow", topBar).on("click", function(){
					var $_this = $(this);
					if(topBar.hasClass("line-content")){
						var topBarPaddingB = parseInt($(".wf-container-top").css("padding-bottom"))+3;
					}else{
						var topBarPaddingB = 0;
					}
					if($_this.hasClass("act")){
						$_this.removeClass("act");
						topBar.removeClass("top-bar-hide");
						topBar.animate({
							"margin-top": 0
						}, 200);
						$.cookie('top-hide', 'false', {expires: 1, path: '/'});
					}else{
						$_this.addClass("act");
						topBar.addClass("top-bar-hide");
						topBar.animate({
							"margin-top": -topBar.height() + topBarPaddingB
						}, 200);
						$.cookie('top-hide', 'true', {expires: 1, path: '/'});
					}

					var scroller = $(".ts-wrap").data("thePhotoSlider");
					if(typeof scroller!= "undefined"){
						scroller.update();
					};
				});
				if(topSpan.hasClass("act")){
					topBar.addClass("top-bar-hide");
				}else{
					topBar.removeClass("top-bar-hide");
				};
			};

			/*Set coockie*/
			if(!$(".responsive-off").length){
				if(window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
					if ($.cookie('top-hide') == "false"){
						topBar.removeClass("top-bar-hide");
						topSpan.removeClass("act");
						topBar.animate({
							"margin-top": 0
						}, 200, function() {
							topBar.css({"opacity": "1"});
						});
						$(".top-bar-arrow", topBar).removeClass("act");
					}
					if ($.cookie('top-hide') == "true"){
						topBar.animate({
							"margin-top": -topBar.height() + topBarPaddingB
						}, 200, function() {
							topBar.css({"opacity": "1"});
						});
						$(".top-bar-arrow", topBar).addClass("act");
					};
				}
			}
		/*Mobile top bar:end*/


		/*!Scroll to Top*/

			$(window).scroll(function () {
				if ($(this).scrollTop() > 500) {
					$('.scroll-top').removeClass('off').addClass('on');
				}
				else {
					$('.scroll-top').removeClass('on').addClass('off');
				}
			});
			$(".scroll-top").click(function(e) {
				e.preventDefault();
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			});

		/*Scroll to Top:end*/

		/*!-Show share buttons*/

			setTimeout(function() {
				$(".album-share-overlay, .project-share-overlay").each(function(){
					var $this = $(this);
						$this.on("mouseenter tap", function(e) {
							if(e.type == "tap") e.stopPropagation();

							var $this = $(this);
							$this.addClass("dt-hovered");

							clearTimeout(menuTimeoutShow);
							clearTimeout(menuTimeoutHide);

							menuTimeoutShow = setTimeout(function() {
								if($this.hasClass("dt-hovered")){
									$this.find('.soc-ico a').css("display", "block");
									$this.find('.soc-ico').stop().css("visibility", "visible").animate({
										"opacity": 1
									}, 200);
								}
							}, 100);
						});

					$this.on("mouseleave ", function(e) {
						var $this = $(this);
						$this.removeClass("dt-hovered");

						clearTimeout(menuTimeoutShow);
						clearTimeout(menuTimeoutHide);

						menuTimeoutHide = setTimeout(function() {
							if(!$this.hasClass("dt-hovered")){
								$this.find('.soc-ico').stop().animate({
									"opacity": 0
								}, 150, function() {
									$this.find('.soc-ico a').css("display", "none");
									$(this).css("visibility", "hidden");
								});
							}
						}, 50);

					});
				});
			}, 150);


		/*Show share buttons:end*/

		/*!Shopping cart top bar*/

			var menuTimeoutShow,
				menuTimeoutHide;

			$(".shopping-cart").each(function(){
				var $this = $(this);

				if(dtGlobals.isMobile || dtGlobals.isWindowsPhone){
					$this.find("> a").on("click", function(e) {
						if (!$(this).hasClass("dt-clicked")) {
							e.preventDefault();
							$(".shopping-cart").find(".dt-clicked").removeClass("dt-clicked");
							$(this).addClass("dt-clicked");
						} else {
							e.stopPropagation();
						}

					});
				};
				$this.on("mouseenter tap", function(e) {
					if(e.type == "tap") e.stopPropagation();

					$this.addClass("dt-hovered");
					if ($("#page").width() - ($this.children('.shopping-cart-wrap').offset().left - $("#page").offset().left) - 230 < 0) {
						$this.children('.shopping-cart-wrap').addClass("right-overflow");
					}

					clearTimeout(menuTimeoutShow);
					clearTimeout(menuTimeoutHide);

					menuTimeoutShow = setTimeout(function() {
						if($this.hasClass("dt-hovered")){
							$this.children('.shopping-cart-wrap').stop().css("visibility", "visible").animate({
								"opacity": 1
							}, 150);
						}
					}, 100);
				});

				$this.on("mouseleave", function(e) {
					var $this = $(this);
					$this.removeClass("dt-hovered");

					clearTimeout(menuTimeoutShow);
					clearTimeout(menuTimeoutHide);

					menuTimeoutHide = setTimeout(function() {
						if(!$this.hasClass("dt-hovered")){
							$this.children('.shopping-cart-wrap').stop().animate({
								"opacity": 0
							}, 150, function() {
								$(this).css("visibility", "hidden");
							});
							setTimeout(function() {
								if(!$this.hasClass("dt-hovered")){
									$this.children('.shopping-cart-wrap').removeClass("right-overflow");
								}
							}, 400);
						}
					}, 150);

				});
			});

		/*Shopping cart top bar:end*/

		/* !- Skills */

			$.fn.animateSkills = function() {
				$(".skill-value", this).each(function () {
					var $this = $(this),
						$this_data = $this.data("width");

					$this.css({
						width: $this_data + '%'
					});
				});
			};

			// !- Animation "onScroll" loop
			function doAnimation() {
				
				if(dtGlobals.isMobile){
					$(".skills").animateSkills();
				}
				if($("html").hasClass("old-ie")){
					$(".skills").animateSkills();
				};
			};
			// !- Fire animation
			doAnimation();

		/* Skills:end */

		/*!-Custom select*/

			// Create the dropdown base
			$("<select />").prependTo(".mini-nav .menu-select");

			// Create default option "Select"
			$("<option />", {
				"selected"  :  "selected",
				"value"     :  "",
				"text"      :  "———"
			}).appendTo(".mini-nav .menu-select select");

			// Populate dropdown with menu items
			$(".mini-nav").each(function() {
				var elPar = $(this),
					thisSelect = elPar.find("select");
				$("a", elPar).each(function() {
					var el = $(this);
					$("<option />", {
						"value"   : el.attr("href"),
						"text"    : el.text(),
						"data-level": el.attr("data-level")
					}).appendTo(thisSelect);
				});
			});

			$(".mini-nav select").change(function() {
				window.location = $(this).find("option:selected").val();
			});
			$(".mini-nav select option").each(function(){
				var $this = $(this),
					winHref = window.location.href;
				 if($this.attr('value') == winHref){
					$this.attr('selected','selected');
				};
			})
			/*!-Appearance for custom select*/
			$('.shipping-calculator-form select, .woocommerce-ordering-div select, .woocommerce.widget_layered_nav select, .mini-nav select, .widget_product_categories select').each(function(){
				$(this).customSelect();
			});
			$(".menu-select select, .mini-nav .customSelect1, .vc_pie_chart .vc_pie_wrapper").css("visibility", "visible");

			$(".mini-nav option").each(function(){
				var $this	= $(this),
					text	= $this.text(),
					prefix	= "";

				switch ( parseInt($this.attr("data-level"))) {
					case 1:
						prefix = "";
					break;
					case 2:
						prefix = "— ";
					break;
					case 3:
						prefix = "—— ";
					break;
					case 4:
						prefix = "——— ";
					break;
					case 5:
						prefix = "———— ";
					break;
				}
				$this.text(prefix+text);
			});
			/*Appearance for custom select:end*/

		/*Custom select:end*/

	/*Misc-2:end*/

	/* !Onepage template */

		jQuery(window).load(function(){

			if($('.one-page-row div[data-anchor^="#"]').length > 0 && $(".one-page-row").length > 0){
				var urlHash = window.location.hash.substring(3);
				if( typeof urlHash != 'undefined' && urlHash.length > 0 ) {
					if(urlHash == "up") {
						$("html, body").animate({
							scrollTop: 0
						}, 600, function(){});
					}else{
						setTimeout(function(){
							$("html, body").animate({
								scrollTop: $("#" + urlHash).offset().top - $("#phantom").height()
							}, 600, function(){});
						},300)
					}
				}else {
					if(urlHash.length == 0 && $( '.menu-item > a[href="#!/up"]' ).length > 0) {
						$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
					}
				}
			}
		});
		var $anchors = $( '.stripe' ),
			$menus = $( '.menu-item > a[href^="#!"]' );

		window.clickAnchorLink = function( $a, e ) {
			var url = $a.attr( 'href' ),
				hash = url,
				$target = url.substring(3),
				base_speed  = 600,
				speed       = base_speed;
			if($("#phantom").css("display")=="block"){
				var floatMenuH = $("#phantom").height();
			}else{
				var floatMenuH = 0;
			}
	
			if ( typeof $target != 'undefined' && $target && $target.length > 0 ) {
				location.hash = url;
				if($("#" + $target).length > 0) {
					var top = $("#" + $target).offset().top,
						this_offset = $a.offset(),
						that_offset = $("#" + $target).offset(),
						offset_diff = Math.abs(that_offset.top - this_offset.top),
						speed = (offset_diff * base_speed) / 1000;
				};

				if($target == "up") {
					$( 'body, html' ).animate({ scrollTop: 0 }, 600 );
				}else {
					$( 'body, html' ).animate({ scrollTop: top - floatMenuH }, speed );
				};

				$('.menu-item a').parent("li").removeClass('act');
				$a.parent("li").addClass('act');
				return false;
				e.preventDefault();
			};

		};

		$( 'body' ).on( 'click', '.anchor-link[href^="#!"], .logo-box a[href^="#!"], #branding a[href^="#!"], #branding-bottom a[href^="#!"]', function( e ) {
			clickAnchorLink( $( this ), e );
		});

		$menus.on( 'click', function( e ) {
			clickAnchorLink( $( this ), e );
		});
		if($('.one-page-row div[data-anchor^="#"]').length > 0 && $(".one-page-row").length > 0){
			$(window).scroll(function (e) {
				var currentNode = null;
				if(!$("body").hasClass("is-scroll")){
					$('.one-page-row div[data-anchor^="#"]').each(function(){
						var $_this = $(this)
							activeSection = $_this,
							currentId = $_this.attr('data-anchor');
						if($(window).scrollTop() >= ($(".one-page-row div[data-anchor='" + currentId + "']").offset().top - 100)){
							currentNode = "#!/" + currentId.substring(1);
						};
					});
					$('.menu-item a').parent("li").removeClass('act');
					if($(window).scrollTop() < ($(".one-page-row div[data-anchor^='#']").first().offset().top - 100)&& $( '.menu-item > a[href="#!/up"]' ).length > 0) {
						$( '.menu-item > a[href="#!/up"]' ).parent("li").addClass("act");
					};
					$('.menu-item a[href="'+currentNode+'"]').parent("li").addClass('act');
					if($('.menu-item a[href="#"]').length && currentNode == null){
						$('.menu-item a[href="#"]').parent("li").addClass('act');
					}
				};
			});
		};

	/* Onepage template:end */

	/*!Floating menu*/

		if (smartMenu && !($(".header-side-left").length || $(".header-side-right").length)) {
			var scrTop = 0,
				scrDir = 0,
				scrUp = false,
				scrDown = false,
				$header = $("#main-nav"),
				$headerClass = $("#header").attr("class"),
				logoURL = $("#branding a").attr("href"),
				$parent = $header.parent(),
				$phantom = $('<div id="phantom" class="'+$headerClass+'"><div class="ph-wrap"><div class="ph-wrap-content"><div class="ph-wrap-inner"><div class="logo-box"></div><div class="menu-box"></div></div></div></div></div>').appendTo("body"),
				$menuBox = $phantom.find(".menu-box"),
				isMoved = false,
				breakPoint = 0,
				threshold = $("#header").offset().top + $("#header").height(),
				doScroll = false,
				animationCooldown;

			if ($("#page").hasClass("boxed")) { $phantom.find(".ph-wrap").addClass("boxed"); $phantom.addClass("boxed");}
			if ($("#header .wf-wrap").hasClass("gradient-hover")) { $phantom.find(".ph-wrap").addClass("gradient-hover"); $phantom.addClass("gradient-hover");}

			if (dtGlobals.logoURL && dtGlobals.logoEnabled) {
				$phantom.find(".ph-wrap").addClass("with-logo");
				if(logoURL == undefined){
					$phantom.find(".logo-box").html('<img src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'">');
				}else{
					$phantom.find(".logo-box").html('<a href="'+logoURL+'"><img src="'+dtGlobals.logoURL+'" height="'+dtGlobals.logoH+'" width="'+dtGlobals.logoW+'"></a>');
				}
			};

			$(window).on("debouncedresize", function() {
				threshold = $("#header").offset().top + $("#header").height();
			});

			$(window).on("scroll", function() {
				
				var tempCSS = {},
					tempScrTop = $(window).scrollTop();

				scrDir = tempScrTop - scrTop;

				if (tempScrTop > threshold && isMoved === false) {
					if( !dtGlobals.isHovering && !$phantom.hasClass('phantom-animate') ) {
						$phantom.addClass('phantom-animate');
						clearTimeout(animationCooldown);

						if( $(".phantom-fade").length > 0 ) {
							$phantom.css({"opacity": 1, "visibility": "visible"});
						};

						if( $(".phantom-slide").length > 0 ) {
							$phantom.css({"opacity": 1, "visibility": "visible", "top": 0 + $("#wpadminbar").height()});
						};

						$menuBox.css("height", "");
						$parent.css("height", $header.height());
						$header.appendTo($menuBox);
						isMoved = true;
					};
				}
				else if (tempScrTop <= threshold && isMoved === true) {
					if($phantom.hasClass('phantom-animate')) {

						$menuBox.css("height", $header.height());
						$header.appendTo($parent);
						$parent.css("height", "");
		
						if($(".logo-classic, .logo-center, .logo-left").length){
							if($(".text-near-menu").length ){
								$header.insertBefore(".text-near-menu");
							}
						}

						$phantom.removeClass('phantom-animate');

						if( $(".phantom-fade").length > 0 ) {
							$phantom.css({"opacity": 0});
							window.clearTimeout(animationCooldown);
							animationCooldown = window.setTimeout(function () {
								$phantom.css({"visibility": ""});
							}, 330);
						};

						if( $(".phantom-slide").length > 0 ) {
							$phantom.css({"opacity": 0});
							window.clearTimeout(animationCooldown);
							animationCooldown = window.setTimeout(function () {
								$phantom.css({"visibility": "", "top": ""});
							}, 330);
						};
		
						isMoved = false;
					};	
				};
				scrTop = $(window).scrollTop();
				
			});
		}

	/*Floating menu:end*/

	/*!-Project floating content variables*/

		var $floatContent = $(".floating-content"),
			projectPost = $(".project-post")
		var $parentHeight,
			$floatContentHeight,
			phantomHeight = 0;

	/*Project floating content variables*/

	/*!- Custom resize function*/

		$(window).on("debouncedresize", function( event ) {
			dtGlobals.resizeCounter++;
			calcPics();
			changeFilter();
			/*!Mobile Top bar*/
			if(!$(".responsive-off").length){
				var topBar = $("#top-bar");
				if(topBar.hasClass("line-content")){
					var topBarPaddingB = parseInt($(".wf-container-top").css("padding-bottom"))+3;
				}else{
					var topBarPaddingB = 0;
				};
			};
			mobileTopBar();
			if(!$(".responsive-off").length){
				if(window.innerWidth >= dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
					topBar.css({
						"margin-top": 0
					});
				}
			};
			
			fancyFeaderCalc();

			if($('#header.logo-side').length > 0 || window.innerWidth < dtLocal.themeSettings.mobileHeader.firstSwitchPoint){
				phantomHeight = 0;
			}else if($('.logo-classic').length > 0 || $('.logo-center').length > 0){
				phantomHeight = $('#phantom').height() + 68;
			}else{
				phantomHeight = $('#phantom').height() + 40;
			};

			/* Side header */
			var headerBottomBar = $("#header .header-bottom-bar"),
				adminBar = $("#wpadminbar");

			if (headerBottomBar.exists() && !adminBar.exists()) {
				headerBottomBar.prev().css({
					paddingBottom: headerBottomBar.height()
				});
			}
			else if (headerBottomBar.exists() && adminBar.exists()) {
				headerBottomBar.prev().css({
					paddingBottom: headerBottomBar.height() + adminBar.height()
				});
				headerBottomBar.css({
					bottom: adminBar.height()
				});
			};

			if($(".logo-side").length > 0){
				$(".header-side-content").mCustomScrollbar("update");
			};

			$(".stripe-video-bg > video").each(function(){
				var $_this = $(this),
					$this_h = $_this.height();
				$_this.css({
					"marginTop": -$this_h/2
				});
			});

			if($.browser.webkit){
				$(".wf-cell .blur-this").each(function(){
					var $_this = $(this);
					if($('canvas', $_this).length){
						var context = $('.blur-effect', $_this)[0].getContext('2d');
						context.beginPath();
						context.moveTo(0,0);
						context.lineTo(0,0);
						context.lineTo(0,0);
						context.strokeStyle="red";
						context.stroke();
					}
				});
			};
			$(".stripe, .wpb_row").each(function(){
				var $_this = $(this),
					$_this_min_height = $_this.attr("data-min-height");
				if($.isNumeric($_this_min_height)){
					$_this.css({
						"minHeight": $_this_min_height + "px"
					});
				}else if(!$_this_min_height){
					$_this.css({
						"minHeight": 0
					});
				}else if($_this_min_height.search( '%' ) > 0){
					$_this.css({
						"minHeight": $(window).height() * (parseInt($_this_min_height)/100) + "px"
					});
				}else{
					$_this.css({
						"minHeight": $_this_min_height
					});
				};
			});

			/*Floating content*/
			
			$(".project-slider .preload-me").loaded(null, function() {

				$parentHeight = projectPost.height();
				$floatContentHeight = $floatContent.height();
			}, true);
			if ( $floatContent.length > 0 && window.innerWidth > 1050 ){
				$(".project-slider .preload-me").loaded(null, function() {
					if ( ($(window).scrollTop() + phantomHeight + $floatContentHeight + 40) > (projectPost.offset().top + $parentHeight)) {
						$floatContent.css({
							top: $parentHeight - $floatContentHeight - 40
						});
					};
				}, true);
			};

			/* Sticky footer */

			$(".mobile-false .footer-overlap .page-inner").css({
				'min-height': window.innerHeight - $(".footer").innerHeight(),
				'margin-bottom': $(".footer").innerHeight()
			});

		}).trigger( "debouncedresize" );

	/*Custom resize function:end*/

	/*!-Project floating content*/

		function setFloatinProjectContent() {
			$(".project-slider .preload-me").loaded(null, function() {
				if ( $floatContent.length > 0 ){
					var $floatContentoffsetTop = $floatContent.offset(),
						$parentOffset = projectPost.offset(),
						$window = $(window);
					$window.on("scroll", function () {
						if ( window.innerWidth > 1050 ) {
							if ( $window.scrollTop() + phantomHeight > $floatContentoffsetTop.top ) {
								if ( ($window.scrollTop() + phantomHeight + $floatContentHeight + 40) < ($parentOffset.top + $parentHeight)) {
									$floatContent.css({
										top: $window.scrollTop() - $floatContentoffsetTop.top + phantomHeight
									});
								}else {
									$floatContent.css({
										top: $parentHeight - $floatContentHeight - 40
									});
								}
							}else {
								$floatContent.css({
									top: 0
								});
							};
						}else {
							$floatContent.css({
								top: 0
							});
						};
					});
				};
			}, true);
		};
		setFloatinProjectContent();

	/*Project floating content:end*/

	// !! Here we can hide the beautifull loading screen already 

		if($("#load").length){
			jQuery("#load").fadeOut().hide();
		};


	/*!Item's description on hover*/

		/*!Description on hover show content on click(albums projects touch device)*/

			$.fn.touchNewHover = function() {
				return this.each(function() {
					var $this = $(this);
					if ($this.hasClass("this-ready")) {
						return;
					}

					if( $(".rollover-content", this).length > 0){
						$("body").on("touchend", function(e) {
							$(".touch .rollover-content, .touch .rollover-project").removeClass("is-clicked");
						});
						
						$this.find(".close-link").on("touchstart", function(){
							$this.removeClass("is-clicked");
							$this.find(".rollover-content").removeClass("is-clicked");
							return false;
						});
						$this.on("touchstart", function(e) {
							origY = e.originalEvent.touches[0].pageY;
							origX = e.originalEvent.touches[0].pageX;
						});
						$this.on("touchend", function(e) {
							var touchEX = e.originalEvent.changedTouches[0].pageX,
								touchEY = e.originalEvent.changedTouches[0].pageY;
							if( origY == touchEY || origX == touchEX ){
								if ($this.hasClass("is-clicked")) {
									$this.find(".rollover-content").on("click.dtAlbums", function(e){
										$this.find(".rollover-content").off("click.dtAlbums");
										$(this).find("a.dt-gallery-mfp-popup, .dt-trigger-first-mfp, .dt-single-mfp-popup, .dt-mfp-item").first().trigger('click');
									});

										if($(this).find(".rollover-click-target.go-to").length > 0){
											window.location.href = $(this).find(".rollover-click-target.go-to").attr('href');
										}
								} else {
									$('.links-container > a', $this).on('touchend', function(e) {
										e.stopPropagation();
										$this.addClass("is-clicked");
									});
									e.preventDefault();
									$(".touch .rollover-content, .touch .rollover-project").removeClass("is-clicked");
									$this.addClass("is-clicked");
									$this.find(".rollover-content").addClass("is-clicked");
									return false;
								};
							};
						});
					};

					$this.addClass("this-ready");
				});
			};
			$(".touch .rollover-project").touchNewHover();

		/*Description on hover show content on click(albums projects touch device):end*/

		$(".touch .rollover-project a.link.show-content, .hover-style-one article:not(.description-off) .rollover-project > a, .hover-style-two article:not(.description-off) .rollover-project > a, .hover-style-three article:not(.description-off) .rollover-project > a").on("click", function(e){
			e.preventDefault();
		});
		$(".no-touch .albums .rollover-content a:not(.portfolio-categories a), .no-touch .media .rollover-content, .no-touch .dt-gallery-container .rollover-content").on("click", function(e){
			if ( $(e.target).is("a") ) {return true};
			$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
		});

	/*Item's description on hover:end*/

	/*!Append tag </span> for round links*/

		$.fn.hoverLinks = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("height-ready")) {
					return;
				}

				$img.on({
					mouseenter: function () {
						if (0 === $(this).children("span").length) {
							var a = $("<span/>").appendTo($(this));
							setTimeout(function () {
								a.addClass("icon-hover")
							}, 20)
						} else $(this).children("span").addClass("icon-hover")
					},
					mouseleave: function () {
						$(this).children("span").removeClass("icon-hover")
					}
				});

				$img.addClass("height-ready");
			});
		};
		$(".links-container a").hoverLinks();

	/*Append tag </span> for round links:end*/

	/*!New rollovers*/

		$.fn.touchHoverImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				$("body").on("touchend", function(e) {
					$(".touch .rollover-content").removeClass("is-clicked");
				});
				var $this = $(this).find(".rollover-content"),
					thisPar = $this.parents(".wf-cell");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
						} else {

							$('.links-container > a', $this).on('touchend', function(e) {
								e.stopPropagation();
								$this.addClass("is-clicked");
							});
							e.preventDefault();
							$(".touch .buttons-on-img .rollover-content").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .buttons-on-img").touchHoverImage();

		$.fn.touchScrollerImage = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				$("body").on("touchend", function(e) {
					$(".touch .fs-entry").removeClass("is-clicked");
				});
				var $this = $(this),
					$thisSingleLink = $this.find("a.rollover-click-target").first(),
					$thisButtonLink = $this.find(".links-container");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
								
						} else {
							if($thisSingleLink.length > 0){
								$thisSingleLink.on("click", function(event) {
									event.stopPropagation();

									if ( $(this).hasClass('go-to') ) {
										window.location.href = $(this).attr('href');
									}
								});
								$thisSingleLink.trigger("click");
							};
							if($thisButtonLink.length > 0){
								$thisButtonLink.find(" > a ").each(function(){
									$(this).on("touchend", function(event) {
										event.stopPropagation();
										$(this).trigger("click");
									});
								});
							}
							e.preventDefault();
							$(".touch .fs-entry").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .fs-entry").touchScrollerImage();

		$.fn.touchHoverLinks = function() {
			return this.each(function() {
				var $img = $(this);
				if ($img.hasClass("hover-ready")) {
					return;
				}

				var $this = $(this);
				$this.on("touchend", function(e) {
					if ($this.hasClass("is-clicked")) {
						return;
					} else {

						if( $this.hasClass("project-zoom") ) {
							$this.trigger("click");
						}else {
							window.location.href = $this.attr("href");
							return false;
						};

						$(".touch .links-container > a").removeClass("is-clicked");
						$this.addClass("is-clicked");
						return false;
					};
				});

				$img.addClass("hover-ready");
			});
		};
		$(".touch .fs-entry .links-container > a").touchHoverLinks();

		/*!Trigger click single link by click on image */
		$.fn.forwardToPost = function() {
			return this.each(function() {
				var $this = $(this);
				if ($this.hasClass("this-ready")) {
					return;
				};
				$this.on("click", function(){
					if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;
					window.location.href = $this.find("a").first().attr("href");
					return false;
				});
				$this.addClass("this-ready");
			});
		};
		$(".no-touch .rollover-project.forward-post").forwardToPost();

		$.fn.touchforwardToPost = function() {
			return this.each(function() {
				var $this = $(this);
				if ($this.hasClass("hover-ready")) {
					return;
				}

				$("body").on("touchend", function(e) {
					$(".touch .rollover-content").removeClass("is-clicked");
				});
				var $this = $(this).find(".rollover-content");
				$this.on("touchstart", function(e) { 
					origY = e.originalEvent.touches[0].pageY;
					origX = e.originalEvent.touches[0].pageX;
				});
				$this.on("touchend", function(e) {
					var touchEX = e.originalEvent.changedTouches[0].pageX,
						touchEY = e.originalEvent.changedTouches[0].pageY;
					if( origY == touchEY || origX == touchEX ){
						if ($this.hasClass("is-clicked")) {
								window.location.href = $this.prev("a").first().attr("href");
						} else {
							e.preventDefault();
							$(".touch .rollover-content").removeClass("is-clicked");
							$this.addClass("is-clicked");
							return false;
						};
					};
				});

				$this.addClass("hover-ready");
			});
		};
		$(".touch .rollover-project.forward-post").touchforwardToPost();

		/*!Trigger click on round links */
		$.fn.followCurentLink = function() {
			return this.each(function() {
				var $this = $(this);
				if ($this.hasClass("this-ready")) {
					return;
				}

				var $thisSingleLink = $this.find(".links-container > a");
				$this.on("click", function(){

					$thisSingleLink.each(function(){
						$thisTarget = $(this).attr("target") ? $(this).attr("target") : "_self";
					});

					if($thisSingleLink.hasClass("project-details") || $thisSingleLink.hasClass("link") || $thisSingleLink.hasClass("project-link")){
						window.open($thisSingleLink.attr("href"), $thisTarget);
						return false;
					}else{
						$thisSingleLink.trigger("click")
						return false;
					}
				});
				$this.addClass("this-ready");
			});
		};
		$(".no-touch .rollover-project.rollover-active").followCurentLink();

		$.fn.triggerAlbumsClick = function() {
			return this.each(function() {
				var $this = $(this);
				if ($this.hasClass("this-ready")) {
					return;
				}

				var $thisSingleLink = $this.find("a.rollover-click-target").first(),
					$thisCategory = $this.find(".category-link a");

				if( $thisSingleLink.length > 0 ){
					$thisSingleLink.on("click", function(event) {
						event.stopPropagation();

						if ( $(this).hasClass('go-to') ) {
							window.location.href = $(this).attr('href');
						}
					});

					var alreadyTriggered = false;

					$this.on("click", function(){

						if ($this.parents(".ts-wrap").hasClass("ts-interceptClicks")) return;

						if ( !alreadyTriggered ) {
							alreadyTriggered = true;
							$thisSingleLink.trigger("click");
							
							alreadyTriggered = false;
						}
						return false;
					})
					$this.find($thisCategory).click(function(e) {
						 e.stopPropagation();
						window.location.href = $thisCategory.attr('href');
					});
				}
				$this.addClass("this-ready");
			});
		};
		$(".albums .rollover-project, .dt-albums-shortcode .rollover-project").triggerAlbumsClick();
		/*Trigger click on album item:end */

	/*New rollovers:end*/

	$(window).load(function() {
	/* !Blur */
		if(!dtGlobals.isMobile){
			$.fn.blurImage = function() {
				return this.each(function() {
					var $_this = $(this);

					if ($_this.hasClass("blur-ready")) {
						return;
					}

					var img = $_this.find("> img");

					$_this.addClass('blur-this');
					img.clone().addClass("blur-effect").css('opacity', '').prependTo(this);
							
					var blur_this = $(".blur-effect", this);
						blur_this.each(function(index, element){
							if (img[index].complete == true) {
								Pixastic.process(blur_this[index], "blurfast", {amount:0.3});
							}
							else {
								blur_this.load(function () {
									Pixastic.process(blur_this[index], "blurfast", {amount:0.3});
								});
							}
						});

					$_this.addClass("blur-ready");
				});
			};

			var total_images = $("body img").length;
			var images_loaded = 0;
			$("img").loaded(null, function() {
				$(".image-blur .fs-entry-img:not(.shortcode-instagram .fs-entry-img), .image-blur .shortcode-instagram a, .image-blur .rollover-project a:not(.hover-style-three .rollover-project a), .image-blur .rollover, .image-blur .rollover > div, .image-blur .post-rollover, .image-blur .rollover-video").blurImage();
			}, true);
			
		};
	/* Blur: end */
	});
});


jQuery(function($){
	// Magic. Do not touch! We're adding this empty invisible element to fix a weird performance issue with Slider Revolution.
	$("body").append('<div style="display:none;"></div>');

	/*!-Share buttons overlay*/
		if($(".mini-search").length > 0){

			$("#header .mini-search .field").fadeOut(100, function(){
				$("#header .mini-search .field").css("visibility", "visible")
			});
			$('body').on("click", function(e){
				var target = $(e.target);
				if(!target.is("#header .mini-search .field")) {
					$("#header .searchform .submit").removeClass("act");
					$("#header .mini-search").removeClass("act");
					$("#header .mini-search .field").fadeOut(100);
				}
			})
			$("#header .searchform .submit").on("click", function(e){
				e.preventDefault();
				e.stopPropagation();
				var $_this = $(this);
				if($_this.hasClass("act")){
					$_this.removeClass("act");
					$_this.parents(".mini-search").removeClass("act");
					$_this.siblings(".searchform-s").fadeOut(200);
				}else{
					$_this.addClass("act");
					$_this.parents(".mini-search").addClass("act");
					$_this.siblings(".searchform-s").fadeIn(250);
				}
			});
		};

	/*Share buttons overlay:end*/


	/*!-Overlap Footer*/

		$(".footer-overlap .footer").css({
			'opacity': 1
		});

	/*Overlap Footer:end*/

	// Prevent a backgroung rendering glitch in Webkit.
		if (!window.bgGlitchFixed && $.browser.webkit) {
			setTimeout(function(){
				$(window).scrollTop($(window).scrollTop() + 1);
				window.bgGlitchFixed = true;
			},10)
		}

		var waitForFinalEvent = (function () {
			var timers = {};
			return function (callback, ms, uniqueId) {
				if (!uniqueId) {
					uniqueId = "Don't call this twice without a uniqueId";
				}
				if (timers[uniqueId]) {
					clearTimeout (timers[uniqueId]);
				}
				timers[uniqueId] = setTimeout(callback, ms);
			};
		})();


	// Usage
	$(window).resize(function () {

		/*Animate iso-items on resize*/
		$(".iso-item, .iso-grid .wf-cell").addClass("animate-position");
		waitForFinalEvent(function(){
			$(".iso-item, .iso-grid .wf-cell").removeClass("animate-position");
		}, 2500, "");
	});

	/*!-Before After*/

		$(".twentytwenty-container .preload-me").loaded(null, function() {
			$(".twentytwenty-container").each(function(){
				var $this = $(this),
					$thisOrient = $this.attr("data-orientation").length > 0 ? $this.attr("data-orientation") : 'horizontal',
					$pctOffset = (typeof $this.attr("data-offset") != 'undefined' && $this.attr("data-offset").length > 0) ? $this.attr("data-offset") : 0.5,
					$navigationType = $this.attr("data-navigation") ? true : false;
				$this.twentytwenty({
					default_offset_pct: $pctOffset,
					orientation: $thisOrient,
					navigation_follow: $navigationType
				});
			});
		}, true);

	/*Before After:end*/

	/*!-AJAX*/

		$.fn.inView = function(){
			//Window Object
			var win = $(window);
			//Object to Check
			obj = $(this);
			//the top Scroll Position in the page
			var scrollPosition = win.scrollTop();
			//the end of the visible area in the page, starting from the scroll position
			var visibleArea = win.scrollTop() + win.height();
			//the end of the object to check
			var objEndPos = (obj.offset().top + 20);
			return(visibleArea >= objEndPos && scrollPosition <= objEndPos ? true : false);
		};

		// 4 Alla & Danil: we need to unify all ajax and masonry and other stuff in this manner:
		function loadingEffects() {
			//if(dtGlobals.isiPhone) return;

			var $isotope = $(".dt-isotope"),
				$grid = $(".iso-grid .wf-cell:not(.shown)");

			if ($grid.exists()) {
				precessEffects($grid);
			}

			if (!$isotope.exists()) {
				var $isoFallback = $(".iso-item:not(.shown)");

				if (!$isoFallback.exists()) return;
				precessEffects($isoFallback);
			}
			else {
				$isotope.each(function() {
					//console.log( $(this).data("isotope").items(element))
					/*var $atoms = $(this).data("isotope").$allAtoms;*/
					var $atoms = $(this).find(".wf-cell");
					if (!$atoms.exists()) return;
					/*if (typeof $atoms == 'undefined') return;*/
					precessEffects($atoms);
				});
			};
		};

		function precessEffects($atoms) {
			var k = 0;

			$atoms.each(function () {
				var $this = $(this);
				if($(".mobile-true").length > 0 || $this.parents(".loading-effect-none").length > 0){
					if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered")) {
						$this.addClass("animation-triggered");
						setTimeout(function () {
							if ($this.hasClass("animation-triggered")) { 
								$this.removeClass("animation-triggered").addClass("shown");
							};
						}, 200);
					};
				}else{
					if (!$this.hasClass("shown") && !$this.hasClass("animation-triggered") && $this.inView()) {
						$this.addClass("animation-triggered");
						k++;
						setTimeout(function () {
							if ($this.hasClass("animation-triggered")) { 
								$this.removeClass("animation-triggered").addClass("shown");
							};
						}, 100 * k);
					};
				}
			});
		};

		function resetEffects() {
			$(".iso-item.shown, .iso-grid .wf-cell.shown").removeClass("start-animation").removeClass("animation-triggered").removeClass("shown");
		};

		var dtAjaxing = {
			xhr: false,
			settings: false,
			lunch: function( settings ) {

				var ajaxObj = this;

				if ( settings ) {
					this.settings = settings;
				}

				if ( this.xhr ) {
					this.xhr.abort();
				}

				var action = 'presscore_template_ajax';

				this.xhr = $.post(
					settings.ajaxurl,
					{
						action : action,
						postID : settings.postID,
						paged : settings.paged,
						targetPage : settings.targetPage,
						term : settings.term,
						orderby : settings.orderBy,
						order : settings.order,
						nonce : settings.nonce,
						visibleItems : settings.visibleItems,
						contentType : settings.contentType,
						pageData : settings.pageData,
						sender : settings.sender
					},
					function( responce ) {

						if ( responce.success ) {

							var $responceItems = jQuery(responce.html),
								$isoContainer = settings.targetContainer,

								contWidth = parseInt($isoContainer.attr("data-width")),
								contMaxWidth = parseInt($isoContainer.attr("data-max-width")),
								contPadding = parseInt($isoContainer.attr("data-padding"));
								isIsotope = 'grid' == settings.layout || 'masonry' == settings.layout,
								itemsToDeleteLength = 0,
								trashItems = new Array(),
								sortBy = responce.orderby.replace('title', 'name'),
								sortAscending = ('asc' == responce.order.toString());

							if ( dtGlobals.isPhone ) {
								isIsotope = false;
							}

							if ( responce.newNonce ) {
								dtLocal.ajaxNonce = responce.newNonce;
							}

							if ( typeof responce.itemsToDelete != 'undefined' ) {
								itemsToDeleteLength = responce.itemsToDelete.length;
							}

							// if not mobile isotope with spare parts
							if ( isIsotope && itemsToDeleteLength > 0 ) {

								for( var i = 0; i < responce.itemsToDelete.length; i++ ) {
									trashItems.push('.wf-cell[data-post-id="' + responce.itemsToDelete[i] + '"]');
								}

								$isoContainer.isotope('remove', $isoContainer.find(trashItems.join(',')));

							// if mobile or not isotope and sender is filter or paginator
							} else if ( !isIsotope && ('filter' == settings.sender || 'paginator' == settings.sender) ) {

								$isoContainer.find('.wf-cell').remove();
							}

							if ( $responceItems.length > 0 ) {

								// append new items
								$isoContainer.append($responceItems);
								dtGlobals.ajaxContainerItems = $isoContainer.find('div.wf-cell').not('.animation-triggered');

								// for isotope - insert new elements
								if ( isIsotope ) {

									$(".preload-me", $isoContainer).heightHack();
									$(".slider-masonry, .slider-simple", $isoContainer).initSlider();
									// $isoContainer.calculateColumns(contWidth, contMaxWidth, contPadding, "px");

									// $isoContainer.one("columnsReady", function() {

										$isoContainer.isotope('addItems', $responceItems);
									///	$isoContainer.imagesLoaded( function() {
											$isoContainer.isotope("layout");
										//});
										if ( 'media' != settings.contentType ) {
											$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
										} else {
											$isoContainer.isotope({ sortBy: 'original-order' });
										}

										if ( 'masonry' == settings.layout ) {
											$("> .iso-item", $isoContainer).showItems();
										} else if ( 'grid' == settings.layout ) {
											$("> .wf-cell", $isoContainer).showItems();
										}

										ajaxObj.init();

									// });

								// all other cases - append new elements
								} else {

									// mobile isotope filtering emulation
									if ( dtGlobals.isPhone && ('masonry' == settings.layout || 'grid' == settings.layout) ) {}

									$(".slider-masonry, .slider-simple", $isoContainer).initSlider();

									if ( 'jgrid' == settings.layout ) {
										$isoContainer.collagePlus(dtGlobals.jGrid);
									}

									ajaxObj.init();

								}

								if ( typeof settings.afterSuccessInit != 'undefined' ) {
									settings.afterSuccessInit( responce );
								}

								$(window).trigger('dt.ajax.content.appended');

							} else if ( isIsotope ) {

								// if no responce items - reorder isotope
								$isoContainer.isotope({ sortBy : sortBy, sortAscending : sortAscending });
							}

						}

						if ( typeof settings.afterResponce != 'undefined' ) {
							settings.afterResponce( responce );
						}

						loadingEffects();
					}
				);
			},
			init : function() {
				switch ( this.settings.contentType ) {
					case 'portfolio' :
						this.initPortfolio();
						break;

					case 'albums' :
						this.initAlbums();
						break;

					case 'media' :
						this.initMedia();
						break;

					case 'blog':
						this.basicInit();
						break;
					 case 'testimonials':
						this.basicInit();
						break;
				}
			},
			initPortfolio : function() {
				this.basicInit();
			},
			initAlbums : function() {
				this.basicInit();
			},
			initMedia : function() {
				this.basicInit();

				$(".no-touch .albums .rollover-content, .no-touch .media .rollover-content").on("click", function(e){
					if ( $(e.target).is("a") ) {
						return true;
					}
					$(this).siblings("a.dt-single-mfp-popup, a.dt-gallery-mfp-popup, a.dt-mfp-item").first().click();
				});

			},
			basicInit : function() {
				retinizer();

				var $container = this.settings.targetContainer;

				$('.dt-gallery-mfp-popup', $container).not('.mfp-ready').on('click', function(){
					var $this = $(this),
						$container = $this.parents('article.post');

					if ( $container.length > 0 ) {
						var $target = $container.find('.dt-gallery-container a.dt-mfp-item');

						if ( $target.length > 0 ) {
							$target.first().trigger('click');
						}
					}

					return false;
				}).addClass('mfp-ready');

				// trigger click on first a.dt-mfp-item in the container
				$('.dt-trigger-first-mfp', $container).not('.mfp-ready').on('click', function(){
					var $this = $(this),
						$container = $this.parents('article.post');

					if ( $container.length > 0 ) {
						var $target = $container.find('a.dt-mfp-item');

						if ( $target.length > 0 ) {
							$target.first().trigger('click');
						}
					}

					return false;
				}).addClass('mfp-ready');

				// single opup
				$('.dt-single-image', $container).not('.mfp-ready').magnificPopup({
					type: 'image'
				}).addClass('mfp-ready');

				$('.dt-single-video', $container).not('.mfp-ready').magnificPopup({
					type: 'iframe'
				}).addClass('mfp-ready');

				$('.dt-single-mfp-popup', $container).not('.mfp-ready').magnificPopup({
					type: 'image'
				}).addClass('mfp-ready');



				$(".dt-gallery-container", $container).not('.mfp-ready').each(function(){
					$(this).addClass('mfp-ready').magnificPopup( $.extend( {}, dtGlobals.magnificPopupBaseConfig, {
						delegate: 'a.dt-mfp-item',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						}
					}));
				});

				$(".rollover, .rollover-video, .post-rollover, .rollover-project .show-content", $container).addRollover();

				$('.no-touch .hover-grid .rollover-project, .no-touch .hover-grid .fs-entry-slide ').each( function() { $(this).hoverdir(); } );

				$(".touch .rollover-project").touchNewHover();

				$(".touch .links-container > a").touchHoverLinks();

				$(".no-touch .rollover-project.forward-post").forwardToPost();

				$(".no-touch .rollover-project.rollover-active").followCurentLink();

				$(".albums .rollover-project").triggerAlbumsClick();

				$(".touch .buttons-on-img").touchHoverImage();

				$(".links-container a").hoverLinks();

				if ( !dtGlobals.isMobile){
					$("img").loaded(null, function() {
						$(".image-blur .rollover-project a:not(.hover-style-two .rollover-project a), .image-blur .rollover, .image-blur .rollover > div, .image-blur .post-rollover, .image-blur .rollover-video").blurImage();
					}, true);
				}
			}
		};

		// get ajax data
		function dtGetAjaxData( $parentContainer ) {
			var	$filtersContainer = $parentContainer.find('.filter.with-ajax').first(),
				$itemsContainer = $parentContainer.find('.wf-container.with-ajax').first(),
				$currentCategory = $filtersContainer.find('.filter-categories a.act'),
				$currentOrderBy = $filtersContainer.find('.filter-by a.act'),
				$currentOrder = $filtersContainer.find('.filter-sorting a.act'),
				paged = parseInt($itemsContainer.attr('data-cur-page')),
				nonce = null,
				visibleItems = new Array(),
				term = ( $currentCategory.length > 0 ) ? $currentCategory.attr('data-filter').replace('.category-', '').replace('*', '') : '';

			if ( '0' == term ) {
				term = 'none';
			}

			if ( $itemsContainer.hasClass('dt-isotope') ) {

				$('.wf-cell', $itemsContainer).each( function(){
					visibleItems.push( $(this).attr('data-post-id') );
				});
			}

			return {
				visibleItems : visibleItems,
				postID : dtLocal.postID,
				paged : paged,
				term : term,
				orderBy : ( $currentOrderBy.length > 0 ) ? $currentOrderBy.attr('data-by') : '',
				order : ( $currentOrder.length > 0 ) ? $currentOrder.attr('data-sort') : '',
				ajaxurl : dtLocal.ajaxurl,
				nonce : dtLocal.ajaxNonce,
				pageData : dtLocal.pageData,
				layout : dtLocal.pageData.layout,
				targetContainer : $itemsContainer,
				isPhone : dtGlobals.isPhone
			}
		}

		// paginator
		$('#content').on('click', '.paginator.with-ajax a', function(e){
			e.preventDefault();

			//resetEffects();

			if ( $(e.target).hasClass('dots') || $(e.target).hasClass('disabled') ) {
				return;
			}

			var $this = $(this),
				$paginatorContainer = $this.closest('.paginator'),
				$parentContainer = $paginatorContainer.parent(),
				$itemsContainer = $parentContainer.find('.wf-container.with-ajax').first(),

				$loadMoreButton = $(".button-load-more"),
				loadMoreButtonCaption = $loadMoreButton.find('.button-caption').text(),

				paginatorType = $paginatorContainer.hasClass('paginator-more-button') ? 'more' : 'paginator',
				isMore = ('more' == paginatorType),

				ajaxData = dtGetAjaxData($parentContainer),
				targetPage = isMore ? ajaxData.paged + 1 : $this.attr('data-page-num'),
				isoPreloaderExists = dtGlobals.isoPreloader;

			$loadMoreButton.addClass("animate-load").find('.button-caption').text(dtLocal.moreButtonText.loading);

			// show preloader
			if ( isoPreloaderExists && !$(".paginator-more-button").length ) {
				dtGlobals.isoPreloader.fadeIn(50);
			}

			if ( !isMore ) {
				var $scrollTo = $parentContainer.find('.filter.with-ajax').first(),
					paddingTop = 44;

				if (!$scrollTo.exists()) {
					$scrollTo = $itemsContainer.parents("#content");
					paddingTop = 50;
				}

				// scroll to top
				$("html, body").animate({
					scrollTop: $scrollTo.offset().top - $("#phantom").height() - paddingTop
				}, 400);
			}

			// lunch ajax
			dtAjaxing.lunch($.extend({}, ajaxData, {
				contentType : ajaxData.pageData.template,
				targetPage : targetPage,
				sender : paginatorType,
				visibleItems : isMore ? new Array() : ajaxData.visibleItems,
				afterResponce : function( responce ) {

					// we have paginator
					if ( $paginatorContainer.length > 0 ) {

						if ( responce.paginationHtml ) {

							// update paginator with responce content
							$paginatorContainer.html($(responce.paginationHtml).html()).show();
						} else {

							if ( false && isMore ) {
								$paginatorContainer.html('<span class="loading-ready">' + dtLocal.moreButtonAllLoadedText + '</span>');
							} else {
								// clear paginator and hide it
								$paginatorContainer.html('').hide();
							}
						}
						setTimeout (function(){
							$(".button-load-more").removeClass("animate-load").find('.button-caption').text(loadMoreButtonCaption);
						}, 200);

					} else if ( responce.paginationHtml ) {

						// if there are no paginator on page but ajax responce have it
						$itemsContainer.parent().append($(responce.paginationHtml));
					}

					// add dots onclick event handler
					$paginatorContainer.find('.dots').on('click', function() {
						$paginatorContainer.find('div:hidden').show().find('a').unwrap();
						$(this).remove();
					});

					// update current page field
					$itemsContainer.attr('data-cur-page', responce.currentPage);

					// hide preloader
					dtGlobals.isoPreloader.stop().fadeOut(300);

					// update load more button
					dtGlobals.loadMoreButton = $(".button-load-more");
				}
			}));
		});

		// filter
		$('.filter.with-ajax .filter-categories a, .filter.with-ajax .filter-extras a').on('click', function(e){
			e.preventDefault();

			resetEffects();

			var $this = $(this),
				$filterContainer = $this.closest('.filter'),
				$parentContainer = $filterContainer.parent(),
				$itemsContainer = $parentContainer.find('.wf-container.with-ajax').first(),
				$paginatorContainer = $parentContainer.find('.paginator').first(),

				ajaxData = dtGetAjaxData($parentContainer),
				isoPreloaderExists = dtGlobals.isoPreloader;

			// show preloader
			if ( isoPreloaderExists ) {
				dtGlobals.isoPreloader.fadeIn(50);
			}
			// lunch ajax
			dtAjaxing.lunch($.extend({}, ajaxData, {
				contentType : ajaxData.pageData.template,
				targetPage : 1,
				paged : 1,
				sender : 'filter',
				afterResponce : function( responce ) {

					// we have paginator
					if ( $paginatorContainer.length > 0 ) {

						if ( responce.paginationHtml ) {

							// update paginator with responce content
							$paginatorContainer.html($(responce.paginationHtml).html()).show();
						} else {

							// clear paginator and hide it
							$paginatorContainer.html('').hide();
						}

					} else if ( responce.paginationHtml ) {

						// if there are no paginator on page but ajax responce have it
						$itemsContainer.parent().append($(responce.paginationHtml));
					}

					// add dots onclick event handler
					$paginatorContainer.find('.dots').on('click', function() {
						$paginatorContainer.find('div:hidden').show().find('a').unwrap();
						$(this).remove();
					});

					// update current page field
					$itemsContainer.attr('data-cur-page', responce.currentPage);

					// hide preloader
					dtGlobals.isoPreloader.stop().fadeOut(300);

					// update load more button
					dtGlobals.loadMoreButton = $(".button-load-more");
				}
			}));
		});

		function lazyLoading() {
			if ( dtGlobals.loadMoreButton && dtGlobals.loadMoreButton.exists() ) {

				var buttonOffset = dtGlobals.loadMoreButton.offset();

				if ( buttonOffset && $(window).scrollTop() > (buttonOffset.top - $(window).height()) / 2 && !dtGlobals.loadMoreButton.hasClass('animate-load') ) {
					dtGlobals.loadMoreButton.trigger('click');
				}

			}
		}

		// lazy loading
		if ( typeof dtLocal.themeSettings.lazyLoading != 'undefined' && dtLocal.themeSettings.lazyLoading ) {

			dtGlobals.loadMoreButton = $(".button-load-more");
			var timer = null;
			$(window).on('scroll', function () {
				lazyLoading();
			});
			lazyLoading();
		}

	/*AJAX:end*/

	var $isotope = $(".dt-isotope"),
		$isoFallback = $(".iso-item:not(.shown)"),
		$grid = $(".iso-grid .wf-cell:not(.shown)");

	if ($isotope.exists() || $isoFallback.exists() || $grid.exists()) {
		setTimeout(function () {
			loadingEffects();
		}, 100);

		$(window).on("scroll", function() {
			loadingEffects();
		});
	};

	var ua = navigator.userAgent,
	event = (ua.match(/iPhone/i)) ? "touchstart" : "click";

	$(".project-navigation a").bind(event, function(e) {
	});

})