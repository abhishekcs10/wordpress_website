<?php
/**
 * Add new fields to customizer, create panel 'Other' and register postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Aladdin 1.0.0
 */
 
function aladdin_customize_register_other( $wp_customize ) {

	$defaults = aladdin_get_defaults();
	
	global $wp_version;
	if ( version_compare( $wp_version, '4.0.0', '>=' ) ) {
	
		$wp_customize->add_panel( 'other', array(
			'priority'       =>106,
			'title'          => __( 'Other Settings', 'aladdin' ),
			'description'    => __( 'All other settings.', 'aladdin' ),
		) );
	
	}

	$section_priority = 10;
	
//New section in customizer: Logotype
	$wp_customize->add_section( 'aladdin_theme_logotype', array(
		'title'          => __( 'Logotype', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
//New setting in Logotype section: Logo Image
	$wp_customize->add_setting( 'logotype_url', array(
		'default'        => get_template_directory_uri().'/img/logo.png',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'logotype_url', array(
		'label'      => __('Logotype Image', 'aladdin'),
		'section'    => 'aladdin_theme_logotype',
		'settings'   => 'logotype_url',
		'priority'   => '1',
	) ) );
	
//New section in customizer: Navigation Options
	$wp_customize->add_section( 'menu', array(
		'title'          => __( 'Navigation menu settings', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'navigation',
	) );	
	
//New setting in Navigation section: Switch On First Top Menu
	$wp_customize->add_setting( 'is_show_top_menu', array(
		'default'        => $defaults['is_show_top_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_show_top_menu', array(
		'label'      => __( 'Switch On First Top Menu', 'aladdin' ),
		'section'    => 'menu',
		'settings'   => 'is_show_top_menu',
		'type'       => 'checkbox',
		'priority'   => $section_priority++,
		'panel'  => 'other',
	) );
	
//New setting in Navigation section: Switch On Second Top Menu
	$wp_customize->add_setting( 'is_show_secont_top_menu', array(
		'default'        => $defaults['is_show_secont_top_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'aladdin_is_show_secont_top_menu', array(
		'label'      => __( 'Switch On Second Top Menu', 'aladdin' ),
		'section'    => 'menu',
		'settings'   => 'is_show_secont_top_menu',
		'type'       => 'checkbox',
		'priority'       => 22,
	) );
	
//New setting in Navigation section: Switch On Footer Menu
	$wp_customize->add_setting( 'is_show_footer_menu', array(
		'default'        => $defaults['is_show_footer_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'aladdin_is_show_footer_menu', array(
		'label'      => __( 'Switch On Footer Menu', 'aladdin' ),
		'section'    => 'menu',
		'settings'   => 'is_show_footer_menu',
		'type'       => 'checkbox',
		'priority'       => 23,
	) );
	
//New section in the customizer: Scroll To Top Button
	$wp_customize->add_section( 'aladdin_scroll', array(
		'title'          => __( 'Scroll To Top Button', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
	$wp_customize->add_setting( 'scroll_button', array(
		'default'        => $defaults['scroll_button'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'aladdin_sanitize_scroll_button'
	) );
	
	
	$wp_customize->add_control( 'scroll_button', array(
		'label'      => __( 'How to display the scroll to top button', 'aladdin' ),
		'section'    => 'aladdin_scroll',
		'settings'   => 'scroll_button',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('none' => __('None', 'aladdin'),
								'right' => __('Right', 'aladdin'), 
								'left' => __('Left', 'aladdin'),
								'center' => __('Center', 'aladdin'))
	) );
	
	$wp_customize->add_setting( 'scroll_animate', array(
		'default'        => $defaults['scroll_animate'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_scroll_effect'
	) );
	
	$wp_customize->add_control( 'scroll_animate', array(
		'label'      => __( 'How to animate the scroll to top button', 'aladdin' ),
		'section'    => 'aladdin_scroll',
		'settings'   => 'scroll_animate',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('none' => __('None', 'aladdin'),
								'move' => __('Jump', 'aladdin')), 
	) );
	
//New section in the customizer: Favicon
	$wp_customize->add_section( 'aladdin_favicon', array(
		'title'          => __( 'Favicon', 'aladdin' ),
		'description'    => __( 'You can select an Icon to be shown at the top of browser window by uploading from your computer. (Size: [16X16] px)', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
	$wp_customize->add_setting( 'favicon', array(
		'default'        => $defaults['favicon'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'favicon', array(
		'label'      => __('Favicon', 'aladdin'),
		'section'    => 'aladdin_favicon',
		'settings'   => 'favicon',
		'priority'   => '1',
	) ) );
	
	aladdin_create_social_icons_section( $wp_customize );
	
	
	$wp_customize->add_setting( 'is_header_on_front_page_only', array(
		'default'        => $defaults['is_header_on_front_page_only'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	

	$wp_customize->add_control( 'is_header_on_front_page_only', array(
		'label'      => __( 'Display Header Image on the Front Page only', 'aladdin' ),
		'section'    => 'header_image',
		'settings'   => 'is_header_on_front_page_only',
		'type'       => 'checkbox',
		'priority'       => 40,
	) );	
	
//New section in the customizer: Favicon
	$wp_customize->add_section( 'aladdin_widgets', array(
		'title'          => __( 'Theme Widgets', 'aladdin' ),
		'description'    => __( 'You can hide/show predefined widgets in this section', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
	$wp_customize->add_setting( 'is_display_front_page_widgets', array(
		'default'        => $defaults['is_display_front_page_widgets'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_display_front_page_widgets', array(
		'label'      => __( 'Display Widgets On Front Page', 'aladdin' ),
		'section'    => 'aladdin_widgets',
		'settings'   => 'is_display_front_page_widgets',
		'type'       => 'checkbox',
		'priority'   => $section_priority++,
		'panel'  => 'other',
	) );
	
	$wp_customize->add_setting( 'is_display_other_widgets', array(
		'default'        => $defaults['is_display_other_widgets'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_display_other_widgets', array(
		'label'      => __( 'Display Widgets on other pages', 'aladdin' ),
		'section'    => 'aladdin_widgets',
		'settings'   => 'is_display_other_widgets',
		'type'       => 'checkbox',
		'priority'   => $section_priority++,
		'panel'  => 'other',
	) );

}
add_action( 'customize_register', 'aladdin_customize_register_other' );
/**
 * Create icon section in Customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 *
 * @since Aladdin 1.0.0
 */

function aladdin_create_social_icons_section( $wp_customize ){
	$icons = aladdin_social_icons();
	
//New section in customizer: Featured Image
	$wp_customize->add_section( 'aladdin_icons', array(
		'title'          => __( 'Social Media Icons', 'aladdin' ),
		'description'          => __( 'Add your Social Media Links. Use widget Social Icons to add icons to your the site.', 'aladdin' ),
		'priority'       => 101,
		'panel'  => 'other',
	) );
	
	$i = 0;
	foreach($icons as $id => $icon ) {
		$wp_customize->add_setting( $id, array(
			'default'        => '',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'aladdin_sanitize_url'
		) );
		
		$wp_customize->add_control( 'aladdin_icons_'.$id, array(
			'label'      => strtoupper($id),
			'section'    => 'aladdin_icons',
			'settings'   => $id,
			'type'       => 'text',
			'priority'   => $i++,
		) );	
	}
}
/**
 * Return array Default Icons
 *
 * @since Aladdin 1.0.0
 */
function aladdin_social_icons(){
	$icons = array(
					'facebook' => '',
					'twitter' => '',
					'google' => '',
					'wordpress' => '',
					'blogger' => '',
					'yahoo' => '',
					'youtube' => '',
					'myspace' => '',
					'livejournal' => '',
					'linkedin' => '',
					'friendster' => '',
					'friendfeed' => '',
					'digg' => '',
					'delicious' => '',
					'aim' => '',
					'ask' => '',
					'buzz' => '',
					'tumblr' => '',		
					'flickr' => '',						
					'rss' => '',
				  );
	return apply_filters( 'aladdin_icons', $icons);
}
