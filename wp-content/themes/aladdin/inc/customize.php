<?php
/**
 * Register postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Aladdin 1.0.0
 */
 
function aladdin_customize_register( $wp_customize ) {	

	global $wp_version;
	if ( version_compare( $wp_version, '4.0.0', '>=' ) ) {

		$wp_customize->add_panel( 'background', array(
			'priority'       => 105,
			'title'          => __( 'Customize Background', 'aladdin' ),
			'description'    => __( 'Background.', 'aladdin' ),
		) );	

		$wp_customize->add_panel( 'navigation', array(
			'priority'       => 106,
			'title'          => __( 'Menu', 'aladdin' ),
			'description'    => __( 'Navigation settings.', 'aladdin' ),
		) );

		//Sets postMessage support
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		$wp_customize->get_section( 'colors' )->panel = 'custom_colors';	
		$wp_customize->get_section( 'colors' )->priority = '1';		
		$wp_customize->get_section( 'nav' )->panel = 'navigation';	
		$wp_customize->get_section( 'nav' )->priority = '1';
		$wp_customize->get_section( 'background_image' )->priority = '90';
	
	}
}
add_action( 'customize_register', 'aladdin_customize_register' );
 
 /**
 * Add custom styles to the header.
 *
 * @since Aladdin 1.0.0
*/
function aladdin_hook_css() {
	$defaults = aladdin_get_defaults();
		
	$position = aladdin_column_dir();
	$top = get_theme_mod('top', $defaults['top']);

?>
	<style type="text/css"> 	
		<?php if ( ! display_header_text() ) : ?>
			.site-title,
			.site-description {
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
		<?php endif; ?>
		
		.site-title h1,
		.site-title a {
			color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
		}
		
		.background-fixed {
			bckground: repeat  <?php echo esc_attr($top); ?> center fixed;
			background-image: url(<?php echo esc_url(aladdin_get_theme_mod('column_background_url')); ?>);		
		}
		
		.site-content {
			-ms-flex-order: <?php echo $position['content']; ?>;     
			-webkit-order: <?php echo $position['content']; ?>;     
			order: <?php echo $position['content']; ?>;
		}
		
		.sidebar-1 {
			-ms-flex-order: <?php echo $position['column-1']; ?>;     
			-webkit-order:  <?php echo $position['column-1']; ?>;  
			order:  <?php echo $position['column-1']; ?>;
		}

		.sidebar-2 {
			-ms-flex-order: <?php echo $position['column-2']; ?>; 
			-webkit-order:  <?php echo $position['column-2']; ?>;  
			order:  <?php echo $position['column-2']; ?>;
		}
		
		<?php if ( '1' != aladdin_get_theme_mod( 'is_mobile_column_1' ) ) : ?>
			.sidebar-1 {
				display: none;
			}
		<?php endif;
		
		if ( '1' != aladdin_get_theme_mod( 'is_mobile_column_2' ) ) : ?>
			.sidebar-2 {
				display: none;
			}
		<?php endif;  ?>
		
		
		.sidebar-before-footer,
		.header-wrap {
			max-width: <?php echo esc_attr(aladdin_get_theme_mod('width_image')); ?>px;
		}
		
		.sidebar-before-footer,
		.header-wrap,
		.site {		
			max-width: <?php echo esc_attr(get_theme_mod('width_site', $defaults['width_site'])); ?>px;
		}	

		.main-wrapper.no-sidebar {
			max-width: <?php echo esc_attr(aladdin_get_theme_mod('width_content_no_sidebar')); ?>px;
		}	
		
		@media screen and (min-width: <?php echo esc_attr(aladdin_get_theme_mod('width_main_wrapper')); ?>px) {
			.image-wrapper {
				max-width: <?php echo esc_attr(aladdin_get_theme_mod('width_main_wrapper')); ?>px;
			}
		}
				
				
		.wide .widget-title,
		.wide .widgettitle,
		.sidebar-footer .widget-area,
		.wide .widget > input,
		.wide .widget > form,
		.sidebar-before-footer .widget > div,
		.sidebar-before-footer .widget-area .widget > ul,
		.sidebar-top-full .widget-area .widget > div,
		.sidebar-top-full .widget-area .widget > ul {
			mkax-width: <?php echo esc_attr(aladdin_get_theme_mod('width_top_widget_area')); ?>px;
			margin-left: auto;
			margin-right: auto;
		}
		
		.site .wide .widget-area .main-wrapper.no-sidebar {
			margin: 0 auto;
			max-width: <?php echo esc_attr(aladdin_get_theme_mod('width_main_wrapper')); ?>px;
		}
		
		.logo-block,
		.max-header-width,
		.max-width,
		.horisontal-navigation {
			margin: 0 auto;
			max-width: <?php echo esc_attr(aladdin_get_theme_mod('width_main_wrapper')); ?>px;
		}
		
		.sidebar-footer-content,
		.wide .widget > input,
		.wide .widget > form,
		.wide .widget > div,
		.wide .widget-area .widget > ul,
		.wide .widget-title,
		.wide .widgettitle,
				
		.text-container,
		.main-wrapper {
			max-width: <?php echo esc_attr(aladdin_get_theme_mod('width_main_wrapper')); ?>px;
		}

		/* set width of column in px */
		@media screen and (min-width: <?php echo esc_attr(aladdin_get_theme_mod('width_mobile_switch')); ?>px) {
	
			.sidebar-2 .column,
			.sidebar-1 .column {
				padding: 0 20px 0 0;
			}
			.sidebar-2 {
				margin: 20px 20px 20px 0;

			}
			.sidebar-1 {
				margin: 20px 0 20px 20px;
			}
			
			.sidebar-2 .column,
			.sidebar-1 .column {
				padding: 0;
			}
			
			.content {
				-ms-flex-order: 1;     
				-webkit-order: 1;  
				order: 1;
			}

			.sidebar-1 {
				-ms-flex-order: 2;     
				-webkit-order: 2;  
				order: 2;
			}

			.sidebar-2 {
				-ms-flex-order: 3;     
				-webkit-order: 3;  
				order: 3;
			}
		
			.main-wrapper {
				-webkit-flex-flow: nowrap;
				-ms-flex-flow: nowrap;
				flex-flow: nowrap;
			}
			
			.sidebar-1,
			.sidebar-2 {
				display: block;
			}
				
			.site-content {
				-ms-flex-order: 2;     
				-webkit-order: 2;  
				order: 2;
			}
	
			.sidebar-1 {
				-ms-flex-order: 1;     
				-webkit-order: 1;  
				order: 1;
			}

			.sidebar-2 {
				-ms-flex-order: 3;     
				-webkit-order: 3;  
				order: 3;
			}
			
			.two-sidebars .sidebar-1 {
				width: <?php echo esc_attr(aladdin_get_theme_mod('width_column_1_rate')); ?>%;
			}

			.two-sidebars .sidebar-2 {
				width: <?php echo esc_attr(aladdin_get_theme_mod('width_column_2_rate')); ?>%;
			}
			.two-sidebars .site-content {
				width: <?php echo esc_attr(100 - aladdin_get_theme_mod('width_column_2_rate') - aladdin_get_theme_mod('width_column_1_rate')); ?>%;
			}
			
			.left-sidebar .sidebar-1 {
				width: <?php echo esc_attr(aladdin_get_theme_mod('width_column_1_left_rate')); ?>%;
			}
			.left-sidebar .site-content {
				width: <?php echo esc_attr(100 - aladdin_get_theme_mod('width_column_1_left_rate')); ?>%;
			}
			
			.right-sidebar .sidebar-2 {
				width: <?php echo esc_attr(aladdin_get_theme_mod('width_column_1_right_rate')); ?>%;
			}	
			.right-sidebar .site-content {
				width: <?php echo esc_attr(100 - aladdin_get_theme_mod('width_column_1_right_rate')); ?>%;
			}				
			
			.widget-page-2-wrap .left-sidebar .sidebar-1 {
				width: 40%;
			}
			.widget-page-2-wrap .left-sidebar .site-content {
				width: 60%;
			}
			
			.widget-page-2-wrap .right-sidebar .sidebar-2 {
				width: 40%;
			}	
			.widget-page-2-wrap .right-sidebar .site-content {
				width: 60%;
			}	
		
	 }

	</style>
	<?php
}
add_action('wp_head', 'aladdin_hook_css');

 /**
 * Add custom css styles for the Customizer screen.
 *
 * @since Aladdin 1.0.0
*/
function aladdin_customize_controls_enqueue_scripts() {
	wp_enqueue_style( 'aladdin-customize-css', get_template_directory_uri() . '/inc/css/customize.css', array(), null );
	wp_enqueue_script( 'aladdin-customize-control-js', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'aladdin-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '2015' );
}
add_action('customize_controls_enqueue_scripts', 'aladdin_customize_controls_enqueue_scripts');

/**
 * Transform hex color to rgba
 *
 * @param string $color hex color. 
 * @param int $opacity opacity. 
 * @return string rgba color.
 * @since Aladdin 1.0.0
 */
function aladdin_hex_to_rgba( $color, $opacity ) {

	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	$hex = array('ffffff');
	
	if ( 6 == strlen($color) ) {
			$hex = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );
	} elseif ( 3 == strlen( $color ) ) {
			$hex = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
	}

	$rgb =  array_map('hexdec', $hex);

	return 'rgba('.implode(",",$rgb).','.$opacity.')';
}

/**
 * Return string Sanitized post thumbnail type
 *
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_post_thumbnail( $value ) {
	$possible_values = array( 'large', 'big', 'small');
	return ( in_array( $value, $possible_values ) ? $value : 'big' );
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_customize_preview_js() {
	wp_enqueue_script( 'aladdin-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), time().'sss', true );
}
add_action( 'customize_preview_init', 'aladdin_customize_preview_js', 99 );

 /**
 * Sanitize bool value.
 *
 * @param string $value Value to sanitize. 
 * @return int 1 or 0.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_checkbox( $value ) {	
	return ( $value == '1' ? '1' : 0 );
} 
 /**
 * Sanitize url value.
 *
 * @param string $value Value to sanitize. 
 * @return string sanitizes url.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_url( $value ) {	
	return esc_url( $value );
}
 /**
 * Sanitize url value.
 *
 * @param string $value Value to sanitize. 
 * @return string sanitizes url.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_background_url( $value ) {	
	$value = esc_url( $value );
	return ( $value == '' ? 'none' : $value );
}
/**
 * Sanitize integer.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @uses absint()
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_int( $value ) {
	return absint( $value );
} 
/**
 * Sanitize text field.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @uses sanitize_text_field()
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_text( $value ) {
	return sanitize_text_field( $value );
}
/**
 * Sanitize hex color.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @uses sanitize_hex_color()
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_hex_color( $value ) {
	return sanitize_hex_color( $value );
}
/**
 * Sanitizehtext.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_kses( $value ) {
	return wp_kses( $value,  array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'ul' => array(),
			'li' => array(),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		));
}
/**
 * Sanitize hex color.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_content_width( $value ) {
	$value = absint($value);
	$value = ($value > 1349 ? 1349 : ($value < 500 ? 500 : $value));
	return $value;
}
/**
 * Sanitize scroll button.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_scroll_button( $value ) {
	$possible_values = array( 'none', 'right', 'left', 'center');
	return ( in_array( $value, $possible_values ) ? $value : 'right' );
}

/**
 * Sanitize scroll css3 effect.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_scroll_effect( $value ) {
	$possible_values = array( 'none', 'move');
	return ( in_array( $value, $possible_values ) ? $value : 'move' );
}
/**
 * Sanitize opacity.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_opacity( $value ) {
	$possible_values = array ( '0',
							   '0.1', 
							   '0.2', 
							   '0.3', 
							   '0.4', 
							   '0.5',
							   '0.6', 
							   '0.7',
							   '0.8',
							   '0.9',
							   '1');
	return ( in_array( $value, $possible_values ) ? $value : '0.3' );
}
/**
 * Return string Sanitized backgroind position
 *
 * @since Aladdin 1.0.0
 */
function aladdin_sanitize_background_position( $value ) {
	$possible_values = array( 'top', 'center', 'bottom');
	return ( in_array( $value, $possible_values ) ? $value : 'top' );
}