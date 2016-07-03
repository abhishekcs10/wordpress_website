<?php
/**
 * Return array default theme options
 *
 * @since Aladdin 1.0.0
 */
 
function aladdin_get_defaults() {

	global $aladdin_defaults;
	
	if( isset( $aladdin_defaults ) ) {
		return $aladdin_defaults;
	}
	
	$defaults = array();
	$defaults['logotype_url'] =  get_template_directory_uri() . '/img/logo.png';
	$defaults['is_show_top_menu'] = '';
	$defaults['is_show_secont_top_menu'] = '1';
	$defaults['is_show_footer_menu'] = '';
	$defaults['column_background_url'] = '';
	$defaults['post_thumbnail_size'] = '400';
	$defaults['scroll_button'] = 'none';
	$defaults['scroll_animate'] = 'none';
	$defaults['favicon'] = '';
	$defaults['is_header_on_front_page_only'] = '1';
	$defaults['body_font'] = 'Abel';
	$defaults['heading_font'] = 'Abel';
	$defaults['header_font'] = 'Akronim';
	$defaults['body_font_size'] = '18';
	$defaults['heading_font_size'] = '36';
	$defaults['heading_weight'] = 'lighter';
	$defaults['color_scheme'] = 0;
	$defaults['is_text_on_front_page_only'] = '';
	$defaults['top'] = 'top';

	$defaults['front_page_style'] = '';	
	$defaults['is_home_footer'] = '';
	$defaults['unit'] = 1;
	
	$defaults['width_site'] = '1920';
	$defaults['width_main_wrapper'] = '1260';
	$defaults['width_top_widget_area'] = '1260';
	$defaults['width_content_no_sidebar'] = '1260';	
	
	/* Header Image size */
	$defaults['size_image'] = '1260';
	$defaults['size_image_height'] = '600';
	/* Header Image and top sidebar wrapper */
	$defaults['width_image'] = '1260';
	$defaults['width_content'] = '1260';
	
	$defaults['header_style'] = 'full';
	$defaults['image_style'] = 'full';
	$defaults['content_style'] = 'full';
	
	$defaults['width_column_1_rate'] = '20';
	$defaults['width_column_1_left_rate'] = '35';
	$defaults['width_column_1_right_rate'] = '35';
	$defaults['width_column_2_rate'] = '20';
	
	/* post: excerpt/content */
	$defaults['single_style'] = 'none';
	$defaults['is_display_post_image'] = '1';
	$defaults['is_display_post_title'] = '1';
	$defaults['is_display_post_tags'] = '1';
	$defaults['is_display_post_cat'] = '1';

	/* page: excerpt/content */
	$defaults['page_style'] = 'none';
	$defaults['is_display_page_image'] = '1';
	$defaults['is_display_page_title'] = '1';
	
	/* portfolio: excerpt/content */
	$defaults['portfolio_style'] = 'none';
	$defaults['is_display_portfolio_image'] = '1';
	$defaults['is_display_portfolio_title'] = '1';
	$defaults['is_display_portfolio_tags'] = '1';
	$defaults['is_display_portfolio_project'] = '1';
	
	$defaults['empty_image'] = get_template_directory_uri() . '/img/empty.png';
	$defaults['footer_text'] = '<a href="' . __( 'http://wordpress.org/', 'aladdin' ) . '">' . __( 'Powered by WordPress', 'aladdin' ). '</a> | ' . __( 'theme ', 'aladdin' ) . '<a href="' .  __( 'http://wpblogs.ru/themes/blog/theme/aladdin/', 'aladdin') . '">Aladdin</a>';
	
	$defaults['width_mobile_switch'] = '960';
	$defaults['columns_direction'] = 'c_1_2';
	$defaults['is_mobile_column_1'] = '1';
	$defaults['is_mobile_column_2'] = '1';
	
	$defaults['is_display_front_page_widgets'] = '1';
	$defaults['is_display_other_widgets'] = '1';

/* declare theme sidebars */

	$defaults['theme_sidebars']['aladdin-column-1']  = array (
													'title' => __( 'First column', 'aladdin' ), 
													'is_checked' => '', 
													'is_constant' => '');
	$defaults['theme_sidebars']['aladdin-column-2']  = array (
													'title' => __( 'Second column', 'aladdin' ), 
													'is_checked' => '', 
													'is_constant' => '');
	$defaults['theme_sidebars']['aladdin-sidebar-top']  = array (
													'title' => __( 'First Top Sidebar', 'aladdin' ),
													'is_checked' => '',
													'is_constant' => '');	
	$defaults['theme_sidebars']['aladdin-sidebar-before-footer']  = array (
													'title' => __( 'Before Footer Sidebar', 'aladdin' ), 
													'is_checked' => '', 
													'is_constant' => '');												
	$defaults['theme_sidebars']['aladdin-sidebar-footer-1']  = array (
													'title' => __( 'Footer Sidebar 1', 'aladdin' ), 
													'is_checked' => '', 
													'is_constant' => '1');	
	$defaults['theme_sidebars']['aladdin-sidebar-footer-2']  = array (
													'title' => __( 'Footer Sidebar 2', 'aladdin' ), 
													'is_checked' => '', 
													'is_constant' => '1');	
	$defaults['theme_sidebars']['aladdin-sidebar-footer-3']  = array (
													'title' => __( 'Footer Sidebar 3', 'aladdin' ), 
													'is_checked' => '', 
													'is_constant' => '1');

	/* order is important */
	$defaults['defined_sidebars']['static'] = array(
											'use' => '1',
											'callback' => '',
											'param' => '', 
											'title' => __( 'Static', 'aladdin' ), 
											'aladdin-sidebar-footer-1' => '1',
											);//Sidebars, visible on all posts and pages

	$defaults['defined_sidebars']['default'] = array(
											'use' => '1', 
											'callback' => '', 
											'param' => '', 
											'title' => __( 'Default', 'aladdin' ),
											'aladdin-sidebar-top' => '1', 
											'aladdin-column-1' => '1', 
											'aladdin-column-2' => '1',
											'aladdin-sidebar-before-footer' => '1',
											);
	
	$defaults['defined_sidebars']['page'] = array(
											'use' => '', 
											'callback' => 'is_page', 
											'param' => '', 
											'title' => __( 'Pages', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '1',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '1', 
											);
	$defaults['defined_sidebars']['archive'] = array(
											'use' => '', 
											'callback' => 'is_archive', 
											'param' => '', 
											'title' => __( 'Archive', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '1',
											'aladdin-column-1' => '1',
											'aladdin-column-2' => '1', 
											);
	$defaults['defined_sidebars']['portfolio-page'] = array(
											'use' => '1', 
											'callback' => 'aladdin_is_portfolio_page', 
											'param' => '', 
											'title' => __( 'Portfolio (Page)', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '1', 
											);
	$defaults['defined_sidebars']['portfolio'] = array(
											'use' => '1', 
											'callback' => 'aladdin_is_portfolio', 
											'param' => '', 
											'title' => __( 'Portfolio (Archive)', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '1',
											'aladdin-column-1' => '1',
											'aladdin-column-2' => '', 
											);
											
	$defaults['defined_sidebars']['shop-page'] = array(
											'use' => '1', 
											'callback' => 'aladdin_is_shop_page', 
											'param' => '', 
											'title' => __( 'Shop (Page)', 'aladdin' ),
											'aladdin-sidebar-top' => '',
											'aladdin-sidebar-before-footer' => '',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '', 
											);	
	$defaults['defined_sidebars']['shop'] = array(
											'use' => '', 
											'callback' => 'aladdin_is_shop', 
											'param' => '', 
											'title' => __( 'Shop (Archive)', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '1',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '', 
											);
											
	$defaults['defined_sidebars']['blog'] = array(
											'use' => '', 
											'callback' => 'is_home', 
											'param' => '', 
											'title' => __( 'Blog', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '1',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '', 
											);
	$defaults['defined_sidebars']['search'] = array(
											'use' => '', 
											'callback' => 'is_search', 
											'param' => '',
											'title' => __( 'Search', 'aladdin' ),
											'aladdin-sidebar-top' => '',
											'aladdin-sidebar-before-footer' => '',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '', 
											);
	$defaults['defined_sidebars']['home'] = array(
											'use' => '1', 
											'callback' => 'is_front_page', 
											'param' => '', 
											'title' => __( 'Home', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '1',
											'aladdin-column-1' => '1',
											'aladdin-column-2' => '1', 
											);
	$defaults['defined_sidebars']['page404'] = array(
											'use' => '1',
											'callback' => 'is_404',
											'param' => '',
											'title' => __( 'Page 404', 'aladdin' ),
											'aladdin-sidebar-top' => '1',
											'aladdin-sidebar-before-footer' => '',
											'aladdin-column-1' => '',
											'aladdin-column-2' => '',
											);

	$defaults['per_page_sidebars'] = array();

	
	return apply_filters( 'aladdin_option_defaults', $defaults );
}

 /**
 * Fill sidebars by widgets
 *
 * @since Aladdin 1.0.0
*/
function aladdin_widgets() {
	
	if ( '1' == aladdin_get_theme_mod( 'is_display_front_page_widgets' ) ) {
		add_action('aladdin_empty_sidebar_top-home', 'aladdin_the_top_sidebar_widgets', 20);
	}
	if ( '1' == aladdin_get_theme_mod( 'is_display_other_widgets' ) ) {
		add_action( 'aladdin_empty_sidebar_footer-1', 'aladdin_the_footer_1_sidebar_widgets', 20 );
		add_action( 'aladdin_empty_column_2-home', 'aladdin_the_column_2_sidebar_widgets', 20 );
		add_action( 'aladdin_empty_sidebar_footer-2', 'aladdin_the_footer_2_sidebar_widgets', 20 );
		add_action( 'aladdin_empty_sidebar_footer-3', 'aladdin_the_footer_3_sidebar_widgets', 20 );
		add_action('aladdin_empty_sidebar_top-portfolio', 'aladdin_the_top_sidebar_portfolio', 20);
		add_action('aladdin_empty_column_2-default', 'aladdin_right_sidebar_default', 20);
		add_action('aladdin_empty_column_2-portfolio-page', 'aladdin_right_sidebar_portfolio', 20);
		add_action('aladdin_empty_sidebar_top-page404', 'aladdin_404_sidebar', 20);
		add_action('aladdin_empty_column_1-portfolio', 'aladdin_left_sidebar_portfolio', 20);
	}
}
add_action( 'after_setup_theme', 'aladdin_widgets' );

 /**
 * Return theme mod
 *
 * @since Aladdin 1.0.0
*/
function aladdin_get_theme_mod( $name ) {
	$defaults = aladdin_get_defaults();
	return apply_filters ( 'aladdin_theme_mod', get_theme_mod( $name, $defaults[$name] ), $name );
}

/**
 * Add widgets to the top sidebar on the home page
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_top_sidebar_widgets() {
		
	the_widget( 'aladdin_page_aladding', 'is_background=1' .
								'&title=' . __( 'About', 'aladdin' ) .
								'&ttl=' . __( 'Aladdin', 'aladdin' ) .
								'&is_centered=1' .
								'&max_width=600' .
								'&img=' . get_template_directory_uri() . '/img/' . 'logo-2.png' . ''.
								'&is_button=1' .
								'&header_font_size=64' .
								'&background_style=4' .
								'&txt=' . __( 'This is a widget page. This content can be replaced by any page from your website.', 'aladdin' ),
								'before_title=<h2 class="widget-title">&after_title=</h2><div class="parallax-image 40 14 14" style="background-image: url(' . get_template_directory_uri() . '/img/' . '1.jpg' . ')"></div>&before_widget=<section ' . "style='padding-top: 14%; padding-bottom: 14%;' class='widget aladdin_page_aladding'>&after_widget=</section>"
	);
	
	the_widget( 'aladdin_sidebar_nav', 'title=&demo=5' );

	the_widget( 'aladdin_page_aladding', 'is_background=1' .
								'&title=' . __( 'Widget Page', 'aladdin' ) .
								'&ttl=' . __( 'Main features', 'aladdin' ) .
								'&max_width=800' .
								'&is_search=1' .
								'&layout=left-sidebar' .
								'&header_font_size=64' .
								'&background_style=4' .	
								'&img=' . get_template_directory_uri() . '/img/' . 'image.png' . ''.
								'&txt=' . __( '<ul><li>Feature number 1</li><li>Second feature</li><li>One more feature</li><li>Feature number 4</li></ul>', 'aladdin' ),
								'before_title=<h2 class="widget-title">&after_title=</h2><div class="parallax-image 0 10 10" style="background-attachment: fixed; background-image: url(' . get_template_directory_uri() . '/img/' . '2.jpg' . ')"></div>&before_widget=<section ' . "style='padding-top: 10%; padding-bottom: 10%;' class='widget aladdin_page_aladding'>&after_widget=</section>"
	);
	
	the_widget( 'aladdin_image', 'title='.__('Widget Image', 'aladdin').
								'&count=6'.
								'&columns=column-3'.
								'&is_background=1'.
								'&is_margin_0=1'.
								'&is_animate_0='.
								'&is_animate_1='.
								'&is_animate_2='.
								'&is_animate_once=1'.
								'&is_step='.
								'&is_link_0=1'.
								'&is_link_1=1'.
								'&is_link_2=1'.
								'&is_link_3=1'.
								'&is_link_4=1'.
								'&is_link_5=1'.
								'&effect_id_0=effect-4'.
								'&effect_id_1=effect-4'.
								'&effect_id_2=effect-4'.
								'&effect_id_3=effect-4'.
								'&effect_id_4=effect-4'.
								'&effect_id_5=effect-4'.
								'&image_link_0=' . get_template_directory_uri() . '/img/' . 'i1.jpg' . ''.
								'&image_link_1=' . get_template_directory_uri() . '/img/' . 'i2.jpg' . ''.
								'&image_link_2=' . get_template_directory_uri() . '/img/' . 'i3.jpg' . ''.
								'&image_link_3=' . get_template_directory_uri() . '/img/' . 'i4.jpg' . ''.
								'&image_link_4=' . get_template_directory_uri() . '/img/' . 'i5.jpg' . ''.
								'&image_link_5=' . get_template_directory_uri() . '/img/' . 'i6.jpg' . ''.
								'&title_0='.__('Image 1', 'aladdin').
								'&title_1='.__('Image 2', 'aladdin').
								'&title_2='.__('Image 3', 'aladdin').
								'&title_3='.__('Image 4', 'aladdin').
								'&title_4='.__('Image 5', 'aladdin').
								'&title_5='.__('Image 6', 'aladdin').
								'&text_0='.__('Description 1', 'aladdin').
								'&text_1='.__('Description 2', 'aladdin').
								'&text_2='.__('Description 3', 'aladdin').
								'&text_3='.__('Description 4', 'aladdin').
								'&text_4='.__('Description 5', 'aladdin').
								'&text_5='.__('Description 6', 'aladdin'),
								'before_title=<h2 class="widget-title">&after_title=</h2><div class="parallax-image 0 10 10" style="background-attachment: fixed; background-image: url(' . get_template_directory_uri() . '/img/' . '5.jpg' . ')"></div>&before_widget=<section class="widget aladdin_image" style="padding-top: 10%; padding-bottom: 10%;">&after_widget=</section>'
		);
		
	the_widget( 'WP_Widget_Text', 'title=' . __( 'Blog', 'aladdin' ), 'before_title=<h2 style="display:none;">&after_title=</h2>' );

}

/**
 * Add widgets to the first footer sidebar on the home page
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_footer_1_sidebar_widgets() {
	
	the_widget( 'WP_Widget_Categories' );
}

/**
 * Add widgets to the second column on the front page
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_column_2_sidebar_widgets() {
								
	the_widget( 'WP_Widget_Calendar' );
	the_widget( 'WP_Widget_Categories' );
	
}

/**
 * Add widgets to the footer sidebar 2
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_footer_2_sidebar_widgets() {
	the_widget( 'WP_Widget_Recent_Posts' );

}

/**
 * Add widgets to the footer sidebar 3
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_footer_3_sidebar_widgets() {
	$icons = aladdin_social_icons();
	
	$defaults = array( 
					'facebook' => '#',
					'twitter' => '#',
					'wordpress' => '#',
					'rss' => '#',
					);
	$params = null;
	
	foreach( $icons as $id => $icon ) {
		$link = get_theme_mod( $id, null);
		if( isset( $link ) && ! empty ( $link ) ) {
			$params .= '&' . $id . '=' . $link;
		}
	}
	if( ! isset( $params ) ) {
	
		foreach( $defaults as $id => $icon ) {
				$params .= '&' . $id . '=' . $icon;
		}
	}
	
	the_widget( 'aladdin_SocialIcons', 
								'title='.__('Contact us', 'aladdin') .
								$params );
								
	the_widget( 'WP_Widget_Search' );
}

/**
 * Add widgets to top sidebar on portfolio index
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_top_sidebar_portfolio() {

	the_widget( 'aladdin_portfolio_nav', 'title=' . __( 'Projects', 'aladdin' ),
			'before_title=<h2 class="widget-title">&after_title=</h2><div class="parallax-image 50 10 10" style="background-image: url(' . get_template_directory_uri() . '/img/' . 'portfolio.jpg' . ')"></div>&before_widget=<section class="widget jetpack-widget-nav-2" style="padding-top: 10%; padding-bottom: 10%;">&after_widget=</section>'
	);

}

/**
 * Add widgets to the right sidebar on all pages
 *
 * @since Aladdin 1.0.0
 */
function aladdin_right_sidebar_default() {

	the_widget( 'WP_Widget_Calendar',
					'title='.__('Calendar', 'aladdin').
					'&sortby=post_modified');

	the_widget( 'aladdin_items_category', 'title='.__('Recent Posts', 'aladdin').
								'&count=4'.
								'&category=0'.
								'&columns=column-1'.
								'&is_background=1'.
								'&is_margin_0='.
								'&is_link=1'.
								'&effect_id_0=effect-1');
}

/**
 * Add widgets to the right sidebar on portfolio pages
 *
 * @since Aladdin 1.0.0
 */
function aladdin_right_sidebar_portfolio() {

	the_widget( 'aladdin_portfolio_nav', 'title=' . __( 'Projects', 'aladdin' ) );

	the_widget( 'aladdin_items_portfolio', 'title='.__('Recent Projects', 'aladdin').
								'&count=4'.
								'&jetpack-portfolio-type=0'.
								'&columns=column-1'.
								'&is_background=1'.
								'&is_margin_0='.
								'&is_link=1'.
								'&effect_id_0=effect-1');

}

/**
 * Add widgets to the search 404 page
 *
 * @since Aladdin 1.0.0
 */
function aladdin_404_sidebar() {

	the_widget( 'aladdin_page_aladding', 'is_background=1' .
								'&title=' . __( '404 Page', 'aladdin' ) .
								'&ttl=' . __( 'Ooops!', 'aladdin' ) .
								'&is_centered=1' .
								'&max_width=600' .
								'&img=' . get_template_directory_uri() . '/img/' . 'logo.png' . ''.
								'&header_font_size=64' .
								'&background_style=4' .
								'&is_search=1' .
								'&txt=' . __( 'It looks like nothing was found at this location. Maybe try a search?', 'aladdin' ),
								'before_title=<h2 class="widget-title">&after_title=</h2><div class="parallax-image 50 10 10" style="background-image: url(' . get_template_directory_uri() . '/img/' . '1.jpg' . ')"></div>&before_widget=<section ' . "style='padding-top: 10%; padding-bottom: 10%;' class='widget aladdin_page_aladding'>&after_widget=</section>"
	);

}

/**
 * Add widgets to the left sidebar on portfolio archive/index
 *
 * @since Aladdin 1.0.0
 */
function aladdin_left_sidebar_portfolio() {

	the_widget( 'aladdin_portfolio_tag_nav', 'title='.__('Tags', 'aladdin') );
}