<?php
$output = $font_color = $el_class = $width = $offset = '';
extract(shortcode_atts(array(
	'font_color' => '',
    'el_class' => '',
    'width' => '1/1',
    'animation' => '',
    'css' => '',
	'offset' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width, false);
$width = vc_column_offset_class_merge($offset, $width);

if ( $animation && 'none' != $animation ) {
	$animation .= ' animate-element';
}

$el_class .= ' wpb_column column_container ' . esc_attr( $animation );
$style = $this->buildStyle( $font_color );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="'.$css_class.'"'.$style.'>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;