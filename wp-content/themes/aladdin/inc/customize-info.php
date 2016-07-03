<?php
/**
 * Add new fields to customizer, create panel 'Info'
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Aladdin 1.0.0
 */
 
function aladdin_customize_register_info( $wp_customize ) {

	class aladdin_Customize_Button_Control extends WP_Customize_Control {
		public $type = 'button';
	 
		/**
		 * Render the control's content.
		 *
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 *
		 * @since Aladdin 1.0.0
		 */
		public function render_content() {
			?>
			<form>
			<input type="button" value="<?php echo esc_attr( $this->label ); ?>" onclick="window.open('<?php echo esc_url( $this->value() ); ?>')" />
			</form>
			<?php
		}

	}
	
	class aladdin_Customize_Donate_Control extends WP_Customize_Control {
		public $type = 'donate';
	 
		/**
		 * Render the control's content.
		 *
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 *
		 * @since aladdin 1.1.0
		 */
		public function render_content() {
			?>
			<p>
			<?php
				_e( 'Development of this theme takes a lot of time and efforts to makes it all easy in use for you and works correctly. If you find this theme useful please consider supporting it by donation.', 'aladdin' );
			?>
			</p>

			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			</form>

			<?php
			_e( 'You will be transferred to PayPal secure site.', 'aladdin' );

		}

	}

	$defaults = aladdin_get_defaults();
	
	global $wp_version;
	if ( version_compare( $wp_version, '4.0.0', '>=' ) ) {
	
		$wp_customize->add_panel( 'info', array(
			'priority'       => 0,
			'title'          => __( 'Info', 'aladdin' ),
			'description'    => __( 'Info and Links.', 'aladdin' ),
		) );
		
	}

	$section_priority = 10;
	
//New section in customizer: Support
	$wp_customize->add_section( 'support', array(
		'title'          => __( 'Support', 'aladdin' ),
		'description'          => __( 'Got something to say? Need help?', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'info',
	) );
	
//Support button
	$wp_customize->add_setting( 'support_url', array(
		'type'			 => 'empty',
		'default'        => 'https://wordpress.org/support/theme/aladdin',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new aladdin_Customize_Button_Control( $wp_customize, 'support_url', array(
		'label'   => __( 'View Support forum', 'aladdin' ),
		'description'   => __( 'View Support forum', 'aladdin' ),
		'section' => 'support',
		'settings'   => 'support_url',
		'priority'   => 10,
	) ) );
	
//New section in customizer: Rate
	$wp_customize->add_section( 'rate', array(
		'title'          => __( 'Rate on WordPress.org', 'aladdin' ),
		'description'          => __( 'Share your thoughts about this theme. Your opinion is important for further improvement.', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'info',
	) );
	
// Rate button
	$wp_customize->add_setting( 'rate_url', array(
		'type'			 => 'empty',
		'default'        => 'https://wordpress.org/support/view/theme-reviews/aladdin#postform',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new aladdin_Customize_Button_Control( $wp_customize, 'rate_url', array(
		'label'   => __( 'Rate', 'aladdin' ),
		'description'   => __( 'Rate', 'aladdin' ),
		'section' => 'rate',
		'settings'   => 'rate_url',
		'priority'   => 10,
	) ) );
	
// How to use
// New section in customizer: How to use
	$wp_customize->add_section( 'howto', array(
		'title'          => __( 'Help', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'info',
	) );
	
	$wp_customize->add_setting( 'howto', array(
		'type'			 => 'empty',
		'default'        => __( 'http://wpblogs.ru/themes/documentation-aladdin/', 'aladdin' ),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new aladdin_Customize_Button_Control( $wp_customize, 'howto', array(
		'label'   => __( 'How to use.', 'aladdin' ),
		'description'   => __( 'Open', 'aladdin' ),
		'section' => 'howto',
		'settings'   => 'howto',
		'priority'   => 10,
	) ) );
	
// Update
if ( ! defined ( 'ALADDIN' ) ) :

	$wp_customize->add_section( 'pro', array(
		'title'          => __( 'Update to Pro', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'info',
	) );
	
	$wp_customize->add_setting( 'pro', array(
		'type'			 => 'empty',
		'default'        => __( 'http://wpblogs.ru/themes/aladdin-pro/', 'aladdin' ),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new aladdin_Customize_Button_Control( $wp_customize, 'pro', array(
		'label'   => __( 'Update Now', 'aladdin' ),
		'description'   => __( 'Update Now', 'aladdin' ),
		'section' => 'pro',
		'settings'   => 'pro',
		'priority'   => 10,
	) ) );
	

	$wp_customize->add_section( 'more_colors', array(
		'title'          => __( 'More Colors', 'aladdin' ),
		'priority'       => 100,
		'panel'  => 'custom_colors',
	) );
	
	$wp_customize->add_setting( 'more_colors', array(
		'type'			 => 'empty',
		'default'        => __( 'http://wpblogs.ru/themes/aladdin-pro/', 'aladdin' ),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new aladdin_Customize_Button_Control( $wp_customize, 'more_colors', array(
		'label'   => __( 'Update to Pro', 'aladdin' ),
		'description'   => __( 'Update Now', 'aladdin' ),
		'section' => 'more_colors',
		'settings'   => '',
		'priority'   => 1,
	) ) );
	
endif;
	
	$wp_customize->add_section( 'donate', array(
		'title'          => __( 'Donate', 'aladdin' ),
		'priority'       => $section_priority++,
		'panel'  => 'info',
	) );
	
	$wp_customize->add_setting( 'donate', array(
		'type'			 => 'empty',
		'default'        => '',
		'sanitize_callback' => 'aladdin_sanitize_url'
	) );
	
	$wp_customize->add_control( new aladdin_Customize_Donate_Control( $wp_customize, 'donate', array(
		'label'   => __( 'Donate', 'aladdin' ),
		'description'   => __( 'Donate', 'aladdin' ),
		'section' => 'donate',
		'settings'   => 'donate',
		'priority'   => 100,
	) ) );
}
add_action( 'customize_register', 'aladdin_customize_register_info' );