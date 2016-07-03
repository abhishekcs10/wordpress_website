<?php
/**
 * Add new fields to widget's form.
 *
 * @since Aladdin 1.0.0
 *
 * @param array $instance widget params.
 * @param array $widget widget.
 */
function aladdin_widget_form_extend( $instance, $widget ) {
		
	if ( ! isset( $instance['aladdin_is_fixed'] ) )
		$instance['aladdin_is_fixed'] = '';
	if ( ! isset( $instance['aladdin_icon'] ) )
		$instance['aladdin_icon'] = null;	
	if ( ! isset( $instance['aladdin_widget_background'] ) )
		$instance['aladdin_widget_background'] = null;
	if ( ! isset( $instance['aladdin_speed'] ) )
		$instance['aladdin_speed'] = 50;
	if ( ! isset( $instance['aladdin_padding_top'] ) )
		$instance['aladdin_padding_top'] = 10;
	if ( ! isset( $instance['aladdin_padding_bottom'] ) )
		$instance['aladdin_padding_bottom'] = 10;	
	if ( ! isset( $instance['is_hide_title'] ) || empty( $instance['is_hide_title'] ) )
		$instance['is_hide_title'] = '';

	aladdin_echo_section_start( __( 'Parallax background', 'aladdin'), $widget->get_field_id( 'aladdin_icon' ) );
	
		aladdin_echo_input_upload_id( $widget, 'aladdin_icon', $instance, __( 'Widget Icon:', 'aladdin' ) );
		aladdin_echo_input_checkbox( $widget, 'aladdin_is_fixed', $instance, __( 'Fixed:', 'aladdin' ), $widget );
		aladdin_echo_input_text( $widget, 'aladdin_speed', $instance, __( 'Speed (10-100):', 'aladdin' ), $widget );
		aladdin_echo_input_text( $widget, 'aladdin_padding_top', $instance, __( 'Padding top (%):', 'aladdin' ), $widget );
		aladdin_echo_input_text( $widget, 'aladdin_padding_bottom', $instance, __( 'Padding bottom (%):', 'aladdin' ), $widget );
		aladdin_echo_input_checkbox( $widget, 'is_hide_title', $instance, __( 'Hide widget title (Background does not work without widget title, but you can hide it here)', 'aladdin' ), $widget );

	aladdin_echo_section_end();

	return $instance;
}
add_filter('widget_form_callback', 'aladdin_widget_form_extend', 10, 2);

/**
 * Update and sanitize widget params.
 *
 * @since Aladdin 1.0.0
 *
 * @param array $instance old params.
 * @param array $new_instance new params.
 * @return array $instance sanitized new params.
 */
function aladdin_widget_update( $instance, $new_instance, $old_instance, $widget ) {

	if ( isset( $new_instance['aladdin_icon'] ) ) {	
		if( strpos( $new_instance['aladdin_icon'], 'http:' ) != false ) {
			$instance['aladdin_icon'] = esc_url_raw( $new_instance['aladdin_icon'] );
		} else {
			$image_attributes = wp_get_attachment_image_src( $new_instance['aladdin_icon'], 'full' );
			if ( $image_attributes ) {
				$instance['aladdin_icon'] = esc_url_raw( $image_attributes[0] );
			} else {
				$instance['aladdin_icon'] = esc_url_raw( $new_instance['aladdin_icon'] );
			}
		}
		
		if( isset( $new_instance['aladdin_is_fixed'] ) && ! empty( $new_instance['aladdin_is_fixed'] ) ) {
			$instance['aladdin_is_fixed'] = 1;
		} else {
			$instance['aladdin_is_fixed'] = '';
		}
		
		if ( isset( $new_instance['is_hide_title'] ) && ! empty( $new_instance['is_hide_title'] ) ) {	
			$instance['is_hide_title'] = '1';
		}
		else {
			$instance['is_hide_title'] = '';
		}
	}
		
	if ( isset( $new_instance['aladdin_speed'] ) ) {	
		$instance['aladdin_speed'] = absint( $new_instance['aladdin_speed'] );
	}
	
	if ( isset( $new_instance['aladdin_padding_top'] ) ) {	
		$instance['aladdin_padding_top'] = absint( $new_instance['aladdin_padding_top'] );
	}
	
	if ( isset( $new_instance['aladdin_padding_bottom'] ) ) {	
		$instance['aladdin_padding_bottom'] = absint( $new_instance['aladdin_padding_bottom'] );
	}	
	
	return $instance;
}
add_filter( 'widget_update_callback', 'aladdin_widget_update', 10, 2 );

/**
 * Add css to widget output.
 *
 * @since Aladdin 1.0.0
 *
 * @param array $params sidebar params.
 */
function aladdin_dynamic_sidebar_params( $params ) {
		
	global $wp_registered_widgets;
	$sidebar_id	= $params[0]['id'];
	$widget_id	= $params[0]['widget_id'];
	$widget_obj	= $wp_registered_widgets[ $widget_id ];
	$widget_opt	= get_option($widget_obj['callback'][0]->option_name);
	$widget_num	= $widget_obj['params'][0]['number'];
	
	if ( isset( $widget_opt[ $widget_num ]['is_hide_title'] ) && ! empty( $widget_opt[ $widget_num]['is_hide_title'] ) ) {
	
		$params[0]['before_title'] = preg_replace( '/<h3 /', '<h3 style="display:none;"', $params[0]['before_title'], 1 );		

	}
	
	if ( isset( $widget_opt[ $widget_num ]['aladdin_icon'] ) && ! empty( $widget_opt[ $widget_num]['aladdin_icon'] ) ) {
	
		$fixed = ( isset( $widget_opt[ $widget_num ]['aladdin_is_fixed'] ) && ! empty( $widget_opt[$widget_num]['aladdin_is_fixed'] ) ? 'background-attachment: fixed;' : '' );
		$speed = ( isset( $widget_opt[ $widget_num ]['aladdin_speed'] ) && ! empty( $widget_opt[$widget_num]['aladdin_speed'] ) ? $widget_opt[$widget_num]['aladdin_speed'] : '' );
		$padding_top = ( isset( $widget_opt[ $widget_num ]['aladdin_padding_top'] ) && ! empty( $widget_opt[$widget_num]['aladdin_padding_top'] ) ? ' ' . $widget_opt[$widget_num]['aladdin_padding_top'] : ' 0' );
		$padding_bottom = ( isset( $widget_opt[ $widget_num ]['aladdin_padding_bottom'] ) && ! empty( $widget_opt[$widget_num]['aladdin_padding_bottom'] ) ? ' ' . $widget_opt[$widget_num]['aladdin_padding_bottom'] : ' 0' );
	
		$params[0]['after_title'] = $params[0]['after_title'] . 
				'<div class="parallax-image ' . esc_attr( $speed ) . esc_attr( $padding_top ) . esc_attr( $padding_bottom ) . '" style="background-image: url(' . esc_url( $widget_opt[ $widget_num ]['aladdin_icon'] ) . ');' . esc_attr( $fixed ) . '"></div>';
	
		if ( ( isset( $widget_opt[ $widget_num ]['aladdin_padding_top'] ) && ! empty( $widget_opt[ $widget_num]['aladdin_padding_top'] ) ) 
		  || ( isset( $widget_opt[ $widget_num ]['aladdin_padding_bottom'] ) && ! empty( $widget_opt[ $widget_num]['aladdin_padding_bottom'] ) ) ) {
		  
			$padding_top = ( isset( $widget_opt[ $widget_num ]['aladdin_padding_top'] ) && ! empty( $widget_opt[$widget_num]['aladdin_padding_top'] ) ? 'padding-top:' . $widget_opt[$widget_num]['aladdin_padding_top'] . '%;' : '' );
			$padding_bottom = ( isset( $widget_opt[ $widget_num ]['aladdin_padding_bottom'] ) && ! empty( $widget_opt[$widget_num]['aladdin_padding_bottom'] ) ? 'padding-bottom: ' . $widget_opt[$widget_num]['aladdin_padding_bottom'] . '%;' : '' );
		
			$params[0]['before_widget'] = preg_replace( '/<section /', "<section style='" . esc_attr( $padding_top ) . esc_attr( $padding_bottom ) . "' ", $params[0]['before_widget'], 1);		

		}
	}


	return $params;

}
add_filter( 'dynamic_sidebar_params', 'aladdin_dynamic_sidebar_params' );