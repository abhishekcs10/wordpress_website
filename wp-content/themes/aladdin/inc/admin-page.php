<?php
/**
 * Add menu to Appearance screen
 *
 * @since Aladdin 1.0.0
 */
function aladdin_admin_page() {
	add_theme_page( __( 'About theme', 'aladdin' ), __( 'About Aladdin', 'aladdin' ), 'edit_theme_options', 'aladdin-page', 'aladdin_about_page');
	add_action ( 'wp_before_admin_bar_render', 'aladdin_add_button' );
}
add_action('admin_menu', 'aladdin_admin_page');

/**
 * Add help button
 *
 * @since Aladdin 1.0.1
 */
function aladdin_add_button() {
	if ( current_user_can( 'edit_theme_options' ) ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
		'parent' => 'top-secondary', // Off on the right side
		'id' => 'aladdin-help' ,
		'title' =>  __( 'Help' , 'aladdin' ),
		'href' => admin_url( 'themes.php?page=aladdin-page' ),
		'meta'   => array(
		'title'  => __( 'Need help with Aladdin? Click here!', 'aladdin' ),
		),
		));
	}
}

/**
 * Add admin styles
 *
 * @since Aladdin 1.0.0
 */
function aladdin_custom_admin_style() {

	wp_enqueue_style( 'aladdin-admin', esc_url_raw( get_template_directory_uri() . '/inc/css/admin.css' ) );
		
}
add_action( 'admin_enqueue_scripts', 'aladdin_custom_admin_style' );
 
 /**
 * Add css styles for admin page
 *
 * @since Aladdin 1.0.1
 */
function aladdin_admim_style( $hook ) {
	if ( 'appearance_page_aladdin-page' != $hook ) {
		return;
	}
	wp_enqueue_style( 'aladdin-admin-page-style', get_template_directory_uri() . '/inc/css/admin-page.css', array(), null );
	wp_enqueue_style( '//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038', array(), null );
	
}
add_action( 'admin_enqueue_scripts', 'aladdin_admim_style' );

/**
 * About theme page
 *
 * @since Aladdin 1.0.0
 */
function aladdin_about_page() {
?>
	<div class="main-wrapper">
		<img class="main-image" src="<?php echo get_template_directory_uri() . esc_url( '/img/portfolio.jpg' ); ?>"/>
		<p class="sg-header"><?php esc_html_e( 'Main Info', 'aladdin' ); ?></p>
		<ul class="sg-buttons">
			<li><a href="<?php echo home_url() . esc_url( '/wp-admin/customize.php' ); ?>"><?php esc_html_e( 'Theme Options', 'aladdin' ); ?></a></li>
			<li><a href="<?php echo home_url() . esc_html( '/wp-admin/customize.php?autofocus[panel]=widgets' ); ?>"><?php esc_html_e( 'Widgets', 'aladdin' ); ?></a></li>
			<li><a href="<?php echo __( 'http://wpblogs.ru/themes/documentation-aladdin/', 'aladdin' ); ?>"><?php esc_html_e( 'How to use a theme', 'aladdin' ); ?></a></li>
			<li><a href="<?php echo esc_url( 'https://wordpress.org/support/theme/aladdin' ); ?>"><?php esc_html_e( 'Support forum', 'aladdin' ); ?></a></li>
			<li><a href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/aladdin#postform' ); ?>"><?php esc_html_e( 'Rate on WordPress.org', 'aladdin' ); ?></a></li>
			<?php if ( ! defined ( 'ALADDIN' ) ) : ?>
			<li class="pro"><a href="<?php echo esc_url( 'http://wpblogs.ru/themes/aladdin-pro/' ); ?>"><?php esc_html_e( 'Update to Pro', 'aladdin' ); ?></a></li>
			<?php endif; ?>
			</li>
		</ul>
		<div class="info-wrapper">
			<div class="icon-image">
				<img src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>"/>
			</div><!-- .icon-image -->
			<div class="info">
			<?php if ( ! defined ( 'ALADDIN' ) ) : ?>
				<p><?php esc_html_e( 'You are using light version of Aladdin. Update to Aladdin Pro to have even more features. For Example:', 'aladdin' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Unlimited custom colors.', 'aladdin' ); ?></li>
					<li><?php esc_html_e( 'Site/content width.', 'aladdin' ); ?></li>
					<li><?php esc_html_e( 'More widgets.', 'aladdin' ); ?></li>
					<li><?php esc_html_e( 'Footer copyright text options.', 'aladdin' ); ?></li>
				</ul>
			<?php else: 
				do_action( 'aladdin_admin_page' );
			 endif; ?>

			</div><!-- .info -->
			
		</div><!-- .info-wrapper -->
		<div class="more-info">
			<a href="<?php echo esc_url( 'http://wpblogs.ru/themes/aladdin-pro/' ); ?>"><?php esc_html_e( 'More Info', 'aladdin' ); ?></a>
		</div><!-- .more-info -->
	</div><!-- .main-wrapper -->
<?php
}