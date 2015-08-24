<?php

if ( ! function_exists( 'presscore_header_style' ) ) :

	/**
	 * Output header inline css
	 *
	 * @uses Presscore_Config Global config storage
	 * @uses dt_stylesheet_color_hex2rgba
	 * 
	 * @since 1.0.0
	 */
	function presscore_header_style() {
		$config = Presscore_Config::get_instance();

		$style = array();

		if ( 'background' == $config->get( 'page_title.background.mode' ) || in_array( $config->get( 'header_title' ), array( 'fancy', 'slideshow' ) ) ) {

			if ( 'transparent' == $config->get( 'header_background' ) ) {

				$transparent_bg_color = dt_stylesheet_color_hex2rgba( $config->get( 'header.transparent.background.color' ), $config->get( 'header.transparent.background.opacity' ) );
				switch( $config->get( 'header.transparent.background.style' ) ) {
					case 'full_width_line':
						$style[] = 'border-bottom-color: ' . $transparent_bg_color;
						break;

					case 'solid_background':
						$style[] = 'background-color: ' . $transparent_bg_color;
						break;
				}

			}

		}

		echo $style ? ' style="' . esc_attr( implode( '; ', $style ) ) . '"' : '';
	}

endif;

if ( ! function_exists( 'presscore_header_class' ) ) :

	/**
	 * Display the classes for the header.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function presscore_header_class( $class = '' ) {
		echo 'class="' . esc_attr( implode( ' ', presscore_get_header_class( $class ) ) ) . '"';
	}

endif; // presscore_header_class


if ( ! function_exists( 'presscore_get_header_class' ) ) :

	/**
	 * Retrieve the classes for the top bar as an array.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes
	 */
	function presscore_get_header_class( $class = '' ) {
		$config = Presscore_Config::get_instance();

		$classes = array();

		$header_layout = $config->get( 'header.layout' );

		switch ( $header_layout ) {
			case 'left':

				if ( $config->get( 'header.layout.left.fullwidth' ) ) {
					$classes[] = 'menu-centered';
				}

				break;

			case 'center':

				if ( $menu_bg_mode_class = presscore_get_menu_bg_mode_class( $config->get( 'header.layout.center.menu.background.mode' ) ) ) {
					$classes[] = $menu_bg_mode_class;
				}

				break;

			case 'classic':

				if ( $menu_bg_mode_class = presscore_get_menu_bg_mode_class( $config->get( 'header.layout.classic.menu.background.mode' ) ) ) {
					$classes[] = $menu_bg_mode_class;
				}

				break;

			case 'side':

				if ( 'down' == $config->get( 'header.layout.side.menu.dropdown.style' ) ) {
					$classes[] = 'sub-downwards';
				}

				break;
		}

		// mobile logo
		if ( 'mobile' == $config->get( 'header.mobile.logo.first_switch' ) ) {
			$classes[] = 'show-device-logo';
		}

		if ( 'mobile' == $config->get( 'header.mobile.logo.second_switch' ) ) {
			$classes[] = 'show-mobile-logo';
		}

		// transparent header
		$header_title_mode = $config->get( 'header_title' );

		$is_side_header_layout = ( 'side' == $header_layout );
		$is_transparent_header = ( 'transparent' == $config->get( 'header_background' ) );
		$is_transparent_fancy_header = in_array( $header_title_mode, array( 'slideshow', 'fancy' ) ) && $is_transparent_header;
		$is_transparent_page_title =
			'enabled' == $header_title_mode
			&& 'background' == $config->get( 'page_title.background.mode' )
			&& $is_transparent_header;

		if ( ! $is_side_header_layout && ( $is_transparent_fancy_header || $is_transparent_page_title ) ) {

			$transparent_header_color_modes_html_classes = array(
				'menu_text' => array( 'light' => 'light-menu', 'dark' => 'dark-menu' ),
				'menu_decoration' => array( 'light' => 'light-menu-decoration', 'dark' => 'dark-menu-decoration' ),
				'top_bar' => array( 'light' => 'light-top-bar', 'dark' => 'dark-top-bar' )
			);

			$transparent_header_color_modes = array(
				'menu_text' => $config->get( 'header.transparent.menu_text.color.mode' ),
				'menu_decoration' => $config->get( 'header.transparent.menu_decoration.color.mode' ),
				'top_bar' => $config->get( 'header.transparent.top_bar.color.mode' )
			);

			foreach ( $transparent_header_color_modes as $place=>$mode ) {

				if ( isset( $transparent_header_color_modes_html_classes[ $place ][ $mode ] ) ) {
					$classes[] = $transparent_header_color_modes_html_classes[ $place ][ $mode ];
				}

			}

			switch ( $config->get( 'header.transparent.background.style' ) ) {
				case 'content_width_line':
					$classes[] = 'content-width-line';
					break;

				case 'full_width_line':
					$classes[] = 'full-width-line';
					break;
			}
		}

		if ( $config->get( 'header.menu.submenu.parent_clickable' ) ) {
			$classes[] = 'dt-parent-menu-clickable';
		}

		switch ( $config->get( 'header.decoration' ) ) {
			case 'shadow':
				$classes[] = 'shadow-decoration';
				break;
			case 'line':
				$classes[] = 'line-decoration';
				break;
		}

		if ( ! empty( $class ) ) {

			if ( !is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		return apply_filters( 'presscore_header_classes', $classes, $class );
	}

endif; // presscore_get_header_class

if ( ! function_exists( 'presscore_header_table_style' ) ) :

	function presscore_header_table_style() {
		$config = Presscore_Config::get_instance();

		$style = array();

		if ( 'transparent' == $config->get( 'header_background' ) && 'content_width_line' == $config->get( 'header.transparent.background.style' ) ) {
			$style[] = 'border-bottom-color: ' . dt_stylesheet_color_hex2rgba( $config->get( 'header.transparent.background.color' ), $config->get( 'header.transparent.background.opacity' ) );
		}

		echo $style ? ' style="' . esc_attr( implode( '; ', $style ) ) . '"' : '';
	}

endif;

if ( ! function_exists( 'presscore_get_header_elements_list' ) ) :

	/**
	 * Get header elements list based on current header layout and $field_name.
	 *
	 * @param string $field_name Field name
	 *
	 * @return array Elements list like array( 'element1', 'element2', ... )
	 */
	function presscore_get_header_elements_list( $field_name ) {

		switch ( of_get_option( 'header-layout', 'left' ) ) {
			case 'side' :
				$fields_visibility_option_id = 'header-side_layout_elements_visibility';
				$fields_option_id = 'header-side_layout_elements';
				break;
			case 'center' :
				$fields_visibility_option_id = 'header-center_layout_elements_visibility';
				$fields_option_id = 'header-center_layout_elements';
				break;
			case 'classic' :
				$fields_visibility_option_id = 'header-classic_layout_elements_visibility';
				$fields_option_id = 'header-classic_layout_elements';
				break;
			default : // left
				$fields_visibility_option_id = 'header-left_layout_elements_visibility';
				$fields_option_id = 'header-left_layout_elements';
		}

		if ( 'show' == of_get_option( $fields_visibility_option_id, 'show' ) ) {
			$fields = of_get_option( $fields_option_id, array() );

			if ( array_key_exists($field_name, $fields) && is_array( $fields[ $field_name ] ) && !empty( $fields[ $field_name ] ) ) {
				return $fields[ $field_name ];
			}
		}

		return array();
	}

endif; // presscore_get_header_elements_list


if ( ! function_exists( 'presscore_render_header_elements' ) ) :

	/**
	 * Renders header elements for $field_name header field.
	 *
	 * @param string $field_name Field name
	 */
	function presscore_render_header_elements( $field_name, $class = 'wf-td' ) {

		$field_elements = presscore_get_header_elements_list( $field_name );

		if ( $field_elements ) {

			// render wrap open tags
			switch ( $field_name ) {
				case 'top_bar_right':
					$wrap_class = 'right-block';
					break;
				case 'nav_area':
					$wrap_class = 'right-block text-near-menu';
					break;
				case 'logo_area':
					$wrap_class = 'right-block text-near-logo ' . presscore_get_font_size_class( of_get_option('header-near_logo_font_size', 'small') );
					break;
				default:
					$wrap_class = '';
			}

			$wrap_class .= " {$class}";

			echo '<div class="' . esc_attr( $wrap_class ) . '">';

			// render elements
			foreach ( $field_elements as $element ) {

				switch ( $element ) {
					case 'search':
						dt_get_template_part( 'header/searchform' );
						break;

					case 'social_icons':
						$topbar_soc_icons = presscore_get_topbar_social_icons();

						if ( $topbar_soc_icons ) {
							echo $topbar_soc_icons;
						}
						break;

					case 'cart':
						if ( class_exists( 'Woocommerce' ) ) {
							dt_woocommerce_mini_cart();
						}
						break;

					case 'custom_menu':
						presscore_nav_menu_list('top');
						break;

					case 'login':
						pressocore_render_login_form();
						break;

					case 'text_area':
						$top_text = of_get_option('header-text', '');
						if ( $top_text ) {
							echo '<div class="text-area">' . wpautop($top_text) . '</div>';
						}
						break;

					case 'skype':
						presscore_top_bar_contact_element('skype');
						break;

					case 'email':
						presscore_top_bar_contact_element('email');
						break;

					case 'address':
						presscore_top_bar_contact_element('address');
						break;

					case 'phone':
						presscore_top_bar_contact_element('phone');
						break;

					case 'working_hours':
						presscore_top_bar_contact_element('clock');
						break;

					case 'info':
						presscore_top_bar_contact_element('info');
						break;
				}

				do_action( "presscore_render_header_element-{$element}" );
			}

			// render wrap close tags
			echo '</div>';
		}

		return '';
	}

endif; //presscore_render_header_elements

if ( ! function_exists( 'presscore_get_topbar_bg_mode_class' ) ) :

	/**
	 * Return proper class accordingly to $topbar_bg_mode.
	 *
	 * @uses presscore_get_menu_bg_mode_class
	 *
	 * @param string $topbar_bg_mode Font size f.e. solid
	 *
	 * @return string Class
	 */
	function presscore_get_topbar_bg_mode_class( $topbar_bg_mode = '' ) {
		return presscore_get_menu_bg_mode_class( $topbar_bg_mode );
	}

endif; // presscore_get_topbar_bg_mode_class


if ( ! function_exists( 'presscore_top_bar_class' ) ) :

	/**
	 * Display the classes for the top bar.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function presscore_top_bar_class( $class = '' ) {
		echo 'class="' . implode( ' ', presscore_get_top_bar_class( $class ) ) . '"';
	}

endif; // presscore_top_bar_class


if ( ! function_exists( 'presscore_get_top_bar_class()' ) ) :

	/**
	 * Retrieve the classes for the top bar as an array.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes
	 */
	function presscore_get_top_bar_class( $class = '' ) {

		$classes = array();
		$classes[] = presscore_get_font_size_class( of_get_option('top_bar-font_size') );

		if ( $topbar_bg_mode_class = presscore_get_topbar_bg_mode_class( of_get_option('top_bar-bg_mode') ) ) {
			$classes[] = $topbar_bg_mode_class;
		}

		$config = presscore_get_config();
		switch ( $config->get( 'header.top_bar.mobile.position' ) ) {
			case 'closed':
				$classes[] = 'top-bar-hide';
				break;
			case 'opened':
				$classes[] = 'top-bar-opened';
				break;
			case 'disabled':
				$classes[] = 'top-bar-disabled';
				break;
		}

		if ( ! empty( $class ) ) {

			if ( !is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}

			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = array_map( 'esc_attr', $classes );

		return apply_filters( 'presscore_top_bar_class', $classes, $class );
	}

endif; // presscore_get_top_bar_class

if ( ! function_exists( 'presscore_top_bar_contact_element' ) ) :

	/**
	 * Get contact information element.
	 *
	 * @since 1.0.0
	 */
	function presscore_top_bar_contact_element( $element ){
		$white_list = array(
			'address',
			'phone',
			'email',
			'skype',
			'clock'
		);

		if ( in_array($element, $white_list) ) {

			$contact_content = of_get_option( 'header-contact_' . $element );
			if ( $contact_content ) {
				$class = $element;

				if ( !of_get_option( 'header-contact_' . $element . '_icon', true ) ) {
					$class .= ' icon-off';
				}

				echo '<span class="mini-contacts ' . esc_attr( $class ) . '">' . $contact_content . '</span>';
			}

		}
	}

endif; // presscore_top_bar_contact_element


if ( ! function_exists( 'presscore_get_topbar_social_icons' ) ) :

	/**
	 * Display topbar social icons. Data grabbed from theme options.
	 *
	 */
	function presscore_get_topbar_social_icons() {
		$icons_data = presscore_get_social_icons_data();
		$icons_white_list = array_keys($icons_data);
		$saved_icons = of_get_option('header-soc_icons');
		$clean_icons = array();

		if ( !is_array($saved_icons) || empty($saved_icons) ) {
			return '';
		}

		foreach ( $saved_icons as $saved_icon ) {

			if ( !is_array($saved_icon) ) {
				continue;
			}

			if ( empty($saved_icon['url']) || empty($saved_icon['icon']) || !in_array( $saved_icon['icon'], $icons_white_list ) ) {
				continue;
			}

			$icon = $saved_icon['icon'];

			$clean_icons[] = array(
				'icon' => $icon,
				'title' => $icons_data[ $icon ],
				'link' => $saved_icon['url']
			);
		}

		$output = '';
		if ( $clean_icons ) {

			$class = '';

			switch ( of_get_option( 'header-soc_icon_bg_color_mode' ) ) {
				case 'gradient':
					$class .= ' gradient-bg';
					break;

				case 'outline':
					$class .= ' outline-style';
					break;

				case 'accent':
					$class .= ' accent-bg';
					break;

				case 'color':
					$class .= ' custom-bg';
					break;

				case 'disabled':
					$class .= ' disabled-bg';
					break;
			}

			switch ( of_get_option( 'header-soc_icon_hover_bg_color_mode' ) ) {
				case 'gradient':
					$class .= ' hover-gradient-bg';
					break;

				case 'outline':
					$class .= ' outline-style-hover';
					break;

				case 'accent':
					$class .= ' hover-accent-bg';
					break;

				case 'color':
					$class .= ' hover-custom-bg';
					break;

				case 'disabled':
					$class .= ' hover-disabled-bg';
					break;
			}

			$output .= '<div class="soc-ico' . $class . '">';

			$output .= presscore_get_social_icons( $clean_icons );

			$output .= '</div>';

		}

		return $output;
	}

endif; // presscore_get_topbar_social_icons
