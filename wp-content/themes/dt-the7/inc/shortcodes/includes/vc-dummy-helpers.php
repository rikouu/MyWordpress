<?php
/**
 * Helpers for vc dummies
 *
 * @package the7
 * @since 4.2.0
 */

function presscore_get_shortcode_vc_inline_dummy( $args = array() ) {

	$defaults = array(
		'title' => '',
		'title_tag' => 'h5',
		'fields' => array(),
		'class' => array(),
		'style' => array( 'height' => '250px' )
	);

	$args = wp_parse_args( $args, $defaults );

	extract( $args );

	$fields = (array) $fields;
	$class = (array) $class;
	$style = (array) $style;

	////////////
	// class //
	////////////

	$class[] = 'dt_vc-shortcode_dummy';

	////////////
	// style //
	////////////

	$style_attr = '';
	if ( count( $style ) ) {

		foreach( $style as $rule=>$value ) {
			$style_attr .= "{$rule}: {$value};";
		}

		$style_attr = ' style="' . esc_attr( $style_attr ) . '"';
	}

	/////////////
	// Fields //
	/////////////

	$fields_html = '';
	if ( count( $fields ) ) {

		foreach( $fields as $field_title=>$field_value ) {
			$fields_html .= sprintf( '<p class="text-small"><strong>%s:</strong> %s</p>', $field_title, $field_value );
		}

	}

	$output = sprintf(
		'<div class="%1$s"%2$s><%3$s>%4$s</%3$s>%5$s</div>',
		esc_attr( join( ' ', $class ) ),
		$style_attr,
		$title_tag,
		$title,
		$fields_html
	);

	return $output;
}
