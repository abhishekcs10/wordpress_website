<?php
/**
 * Add panel mobile and new fields to customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Aladdin 1.0.0
 */
 
function aladdin_mobile_register( $wp_customize ) {

	$defaults = aladdin_get_defaults();
	
	global $wp_version;
	if ( version_compare( $wp_version, '4.0.0', '>=' ) ) {
	
		$wp_customize->add_panel( 'mobile', array(
			'priority'       => 104,
			'title'          => __( 'Mobile', 'aladdin' ),
			'description'    => __( 'Settings for mobile users.', 'aladdin' ),
		) );

	}
	
	$section_priority = 10;
	$priority = 1;
	
	$wp_customize->add_section( 'width_mobile_switch', array(
		'priority'       => $section_priority++,
		'title'          => __( 'Columns', 'aladdin' ),
		'description'    => __( 'Settings for small screens', 'aladdin' ),
		'panel'  => 'mobile',
	) );	
	
	$wp_customize->add_setting( 'width_mobile_switch', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['width_mobile_switch'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_mobile_switch', array(
		'label'      => __( 'Switch point', 'aladdin' ),
		'section'    => 'width_mobile_switch',
		'settings'   => 'width_mobile_switch',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_section( 'columns_direction', array(
		'priority'       => $section_priority++,
		'title'          => __( 'Order', 'aladdin' ),
		'description'    => __( 'Order and visibility for columns on small screens', 'aladdin' ),
		'panel'  => 'mobile',
	) );	
//columns direction
	$wp_customize->add_setting( 'columns_direction', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['columns_direction'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_content_column'
	) );

	$wp_customize->add_control( 'columns_direction', array(
		'label'   => __( 'Content and column-1, column-2 position for small screens', 'aladdin' ),
		'section' => 'columns_direction',
		'settings'   => 'columns_direction',
		'type'       => 'select',
		'priority'   => $priority++,
		'choices'	 => array ('c_1_2' => __('Content-1-2', 'aladdin'),
							   'c_2_1' => __('Content-2-1', 'aladdin'),
							   '1_c_2' => __('1-Content-2', 'aladdin'),
							   '2_c_1' => __('2-Content-1', 'aladdin'),
							   '1_2_c' => __('1-2-Content', 'aladdin'),
							   '2_1_c' => __('2-1-Content', 'aladdin'),
								)
	) );
	
//columns visibility
	$wp_customize->add_setting( 'is_mobile_column_1', array(
		'default'        => $defaults['is_mobile_column_1'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_mobile_column_1', array(
		'label'      => __( 'Check mark to display first column on small screens', 'aladdin' ),
		'section'    => 'columns_direction',
		'settings'   => 'is_mobile_column_1',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
//columns visibility
	$wp_customize->add_setting( 'is_mobile_column_2', array(
		'default'        => $defaults['is_mobile_column_2'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_mobile_column_2', array(
		'label'      => __( 'Check mark to display second column on small screens', 'aladdin' ),
		'section'    => 'columns_direction',
		'settings'   => 'is_mobile_column_2',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
}
add_action( 'customize_register', 'aladdin_mobile_register' );
/**
 * Sanitize content/column direction.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_content_column( $value ) {
	$defaults = aladdin_get_defaults();
	$possible_values = array ('c_1_2',
							   'c_2_1',
							   '1_c_2',
							   '2_c_1',
							   '1_2_c',
							   '2_1_c',
								);
	return ( in_array( $value, $possible_values ) ? $value : $defaults['columns_direction'] );
} 

/**
 * Return array column-content direction .
 *
 * @return array sanitized direction.
 * @since Aladdin 1.0.0
 */
function aladdin_column_dir() {
	$rez = array();
	switch ( aladdin_get_theme_mod( 'columns_direction' ) ) {
		case 'c_1_2':
			$rez['content'] = 1;
			$rez['column-1'] = 2;
			$rez['column-2'] = 3;
		break;
		case '2_1_c':
			$rez['content'] = 3;
			$rez['column-1'] = 2;
			$rez['column-2'] = 1;
		break;
		case 'c_2_1':
			$rez['content'] = 1;
			$rez['column-1'] = 3;
			$rez['column-2'] = 2;
		break;
		case '1_c_2':
			$rez['content'] = 2;
			$rez['column-1'] = 1;
			$rez['column-2'] = 3;
		break;
		case '2_c_1':
			$rez['content'] = 2;
			$rez['column-1'] = 3;
			$rez['column-2'] = 1;
		break;
		case '1_2_c':
			$rez['content'] = 3;
			$rez['column-1'] = 1;
			$rez['column-2'] = 2;
		break;
	}
	return $rez;
} 