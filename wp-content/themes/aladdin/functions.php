<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
*/

/**
 * Set up the content width value.
 *
 * @since Aladdin 1.0.0
 */
      
if ( ! isset( $content_width ) ) {
	$content_width = 1280;
}

if ( ! isset( $aladdin_sidebars ) ) {
	$aladdin_sidebars = array();
}

if ( ! function_exists( 'aladdin_setup' ) ) :

/**
 * aladdin setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @since Aladdin 1.0.0
 */

function aladdin_setup() {

	load_theme_textdomain( 'aladdin', get_template_directory() . '/languages' );
	
	$defaults = aladdin_get_defaults();
	
	global $aladdin_sidebar_slug;
	$aladdin_sidebar_slug = null;

	/* default values */
	global $aladdin_defaults;
	$aladdin_defaults = null;

	/* custom layouts */
	global $aladdin_layout_class;
	$aladdin_layout_class = new aladdin_Layout_Class();	
	
	/* custom colors */
	global $aladdin_colors_class;
	$aladdin_colors_class = new aladdin_Colors_Class();	
		
	if ( get_theme_mod( 'is_show_top_menu', $defaults ['is_show_top_menu']) == '1' )
		register_nav_menu( 'top1', __( 'First Top Menu', 'aladdin' ));
	if ( get_theme_mod( 'is_show_secont_top_menu', $defaults ['is_show_secont_top_menu']) == '1' )
		register_nav_menu( 'top2', __( 'Second Top Menu', 'aladdin' ));
	if ( get_theme_mod( 'is_show_footer_menu', $defaults ['is_show_footer_menu']) == '1' )
		register_nav_menu( 'footer', __( 'Footer Menu', 'aladdin' ));
	
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'eee',
	) );

	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( aladdin_get_theme_mod( 'post_thumbnail_size' ) , 9999 ); 
	
	$args = array(
		'default-image'          => '',
		'header-text'            => true,
		'default-text-color'     => aladdin_text_color(get_theme_mod('color_scheme'), $defaults ['color_scheme']),
		'width'                  => aladdin_get_theme_mod('size_image'),
		'height'                 => aladdin_get_theme_mod('size_image_height'),
		'flex-height'            => true,
		'flex-width'             => true,
	);
	add_theme_support( 'custom-header', $args );
	
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'caption'
	) );
	
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for WooCommerce plugin.
	 */
	 
	add_theme_support( 'woocommerce' );
	
	/*
	 * Enable support for Jetpack Portfolio custom post type.
	 */
	 
	add_theme_support( 'jetpack-portfolio' );

}
add_action( 'after_setup_theme', 'aladdin_setup' );
endif;

if ( ! function_exists( '_wp_render_title_tag' ) ) :
/**
 *  Backwards compatibility for older versions (4.1)
 * 
 * @since Aladdin 1.0.0
 */
	function aladdin_render_title() {
	?>
		 <title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
	}
	add_action( 'wp_head', 'aladdin_render_title' );
	
/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Aladdin 1.0.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function aladdin_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'aladdin' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'aladdin_wp_title', 10, 2 );
	
endif;

/**
 * Return the Google font stylesheet URL if available.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_get_font_url() {
	$font_url = '';
	$font = str_replace( ' ', '+', aladdin_get_theme_mod( 'body_font' ) );
	$heading_font = str_replace( ' ', '+', aladdin_get_theme_mod( 'heading_font' ) );
	$header_font = str_replace( ' ', '+', aladdin_get_theme_mod( 'header_font' ) );
	if ( '0' == $font && '0' == $heading_font && '0' == $header_font ) 
		return $font_url;
		
	if ( '0' != $font && '0' != $heading_font )
		$font .= '%7C';
		
	$font .= $heading_font;	
	
	if ( '0' != $font && '0' != $header_font )
		$font .= '%7C';

	$font .= $header_font;
	
	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, Alegreya Sans, Allerta Stencil fonts, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans, Allerta Stencil, Alegreya Sans fonts: on or off', 'aladdin' ) ) {
		$subsets = 'latin,latin-ext';
		$family = $font . ':300,400';

		/* translators: To add an additional Open Sans character subset specific to your language,	
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Font: add new subset (greek, cyrillic, vietnamese)', 'aladdin' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		}
		if ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		}
		elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$query_args = array(
			'family' => $family,
			'subset' => $subsets,
		);
		$font_url = "//fonts.googleapis.com/css?family=" . $family . '&' . $subsets;
		
	}

	return $font_url;
}
/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_scripts_styles() {

	$defaults = aladdin_get_defaults();
	
	// Add Genericons font.
	wp_enqueue_style( 'aladdin-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '2015' );
	
	$font_url = aladdin_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'aladdin-fonts', esc_url_raw( $font_url ), array(), null );
		
	// Loads our main stylesheet.
	wp_enqueue_style( 'aladdin-style', get_stylesheet_uri() );

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	wp_enqueue_script( 'aladdin-parallax', get_template_directory_uri() . '/js/parallax.js', array( 'jquery'), '201531', true );

	// Adds JavaScript for handing the navigation menu and top sidebars hide-and-show behavior.
	wp_enqueue_script( 'aladdin-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery', 'aladdin-parallax' ), '201531', true );
	
	global $aladdin_colors_class;
	
	wp_enqueue_style( 'aladdin-colors', get_template_directory_uri() . '/css/scheme-' . aladdin_get_theme_mod( 'color_scheme', $defaults['color_scheme'] ) . '.css' );

}
add_action( 'wp_enqueue_scripts', 'aladdin_scripts_styles' );
 
/**
 * Add Editor styles and fonts to Tiny MCE
 *
 * @since Aladdin 1.0.0
 */
function aladdin_add_editor_styles() {
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css' ) );
	
	$font_url = aladdin_get_font_url();
	if ( ! empty( $font_url ) )
		 add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'aladdin_add_editor_styles' );

/**
 * Extend the default WordPress body classes.
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 *
 * @since Aladdin 1.0.0
 */

function aladdin_body_class( $classes ) {

	$background_color = get_background_color();
	$background_image = get_background_image();
	
	$defaults = aladdin_get_defaults();
	
	if(aladdin_get_theme_mod('image_style') == 'boxed'){
		$classes[] = 'boxed-image';
	}	
	if(aladdin_get_theme_mod('content_style') == 'boxed'){
		$classes[] = 'boxed-content';
	}
	
	$classes[] = 'boxed-image';
	
	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background';
		elseif ( in_array( $background_color, array( 'ccc', 'cccccc' ) ) )
			$classes[] = 'custom-background';
	}
	
	// Enable custom class only if the header text enabled.
	if ( display_header_text() ) {
		$classes[] = 'header-text-is-on';
	}	
	
	if( is_front_page() && 'no_content' == aladdin_get_theme_mod('front_page_style') && ! is_home() ) {
		$classes[] = 'no-content';
	}
	
	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'aladdin-fonts', 'queue' ) )
		$classes[] = 'google-fonts-on';

	// Enable custom class only if the logotype is active.
	if ( get_theme_mod( 'logotype_url', $defaults['logotype_url'] ) != '' ) 
		$classes[] = 'logo-is-on';	

	return $classes;
}
add_filter( 'body_class', 'aladdin_body_class' );

/**
 * Create not empty title
 *
 * @since Aladdin 1.0.0
 *
 * @param string $title Default title text.
 * @param int $id.
 * @return string The filtered title.
 */
function aladdin_title( $title, $id = null ) {

    if ( trim($title) == '' && (is_archive() || is_home() || is_search() ) ) {
        return ( esc_html( get_the_date() ) );
    }
	
    return $title;
}
add_filter( 'the_title', 'aladdin_title', 10, 2 );

if ( ! function_exists( 'aladdin_get_header' ) ) :

/**
 * Return default header image url
 *
 * @since Aladdin 1.0.0
 *
 * @param string color_scheme color scheme.
 * @return string header url.
 */
function aladdin_get_header( $color_scheme ) {

    return get_template_directory_uri() . '/img/' . 'header.jpg';
}

endif;

if ( ! function_exists( 'aladdin_text_color' ) ) :

/**
 * Return default header text color
 *
 * @since Aladdin 1.0.0
 *
 * @param string color_scheme color scheme.
 * @return string header url.
 */
function aladdin_text_color( $color_scheme ) {

	switch ($color_scheme) {
		case '0':
			$text_color = 'd0dff4';
		break;		
		case '1':
			$text_color = 'b7ba2a';
		break;
		default:
			$text_color = 'ffffff';
		break;
	}

    return $text_color;
}

endif;

if ( ! function_exists( 'aladdin_post_nav' ) ) :
/**
 * Display navigation to next/previous post.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'aladdin' ); ?></h1>
		<div class="nav-link">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'aladdin' ) );
			else :
				$next = next_post_link( '%link ', __( '<span class="nav-next">%title &rarr;</span>', 'aladdin' ) );
				if ( $next ) :
					previous_post_link( '%link', __( '<span class="nav-previous">&larr; %title</span>', 'aladdin' ) );
					$next;
				else :
					previous_post_link( '%link', __( '<span class="nav-previous-one">&larr; %title</span>', 'aladdin' ) );
				endif;
				
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<div class="clear"></div>
	<?php
}
endif;

if ( ! function_exists( 'aladdin_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_paging_nav() {

	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'aladdin' ),
		'next_text' => __( 'Next &rarr;', 'aladdin' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'aladdin' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
	
}
endif;

if ( ! function_exists( 'aladdin_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_attached_image() {
	$post                = get_post();

	$attachment_size     = apply_filters( 'aladdin_attachment_size', array( 987, 9999 ) );
	$next_attachment_url = wp_get_attachment_url();

	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'aladdin_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . '</span>';
	}

	// Set up and print post meta information.
	printf( '<span class="entry-date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span title="%5$s" class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( '' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
	
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'aladdin' ), __( '1 Comment', 'aladdin' ), __( '% Comments', 'aladdin' ) );
		echo '</span>';
	}
}
endif;


if ( ! function_exists( 'aladdin_content_width' ) ) :
/**
 * Adjust content width in certain contexts.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_content_width() {
	
	global $aladdin_layout_class;
	global $content_width;
	
	$curr_layout = $aladdin_layout_class->get_layout();
	$curr_content_layout = $aladdin_layout_class->get_content_layout();
	$content_columns = preg_replace('/[^0-9]/','',$curr_content_layout);	
	$content_area_width = aladdin_calc_content_width( $curr_layout );
	$content_width = aladdin_calc_content_column_width ($content_area_width, $content_columns); 
}
add_action( 'template_redirect', 'aladdin_content_width' );

endif;

if ( ! function_exists( 'aladdin_calc_content_column_width' ) ) :
/**
 * Calculate width of the content area
 *
 * @param int width of content area.
 * @param int columns count.
 * @return int width of column.
 * @since Aladdin 1.0.0
 */
function aladdin_calc_content_column_width( $width, $columns ) {
	
	switch( $columns ) {
		case 1:
		break;	
		case 2:
			$width = $width/100*48;
		break;	
		case 3:
			$width = $width/100*30;
		break;	
		case 4:
			$width = $width/100*22;
		break;
	}
	$width = absint($width - $width/100*8); 
	
	return $width;
}
endif;

if ( ! function_exists( 'aladdin_calc_content_width' ) ) :
/**
 * Calculate width of the content area
 *
 * @param string current layout.
 * @return int width of the content area.
 * @since Aladdin 1.0.0
 */
function aladdin_calc_content_width( $curr_layout ) {

	$content_width = (aladdin_get_theme_mod( 'width_main_wrapper' ) > aladdin_get_theme_mod( 'width_site' ) ? aladdin_get_theme_mod( 'width_site' ) : aladdin_get_theme_mod( 'width_main_wrapper' ) );
	$unit = aladdin_get_theme_mod('unit');

	if( 'left-sidebar' == $curr_layout) {
		$content_width = $content_width - $content_width/100*aladdin_get_theme_mod('width_column_1_left_rate') - 40;
	} 
	elseif( 'right-sidebar' == $curr_layout) {
		$content_width = $content_width - $content_width/100*aladdin_get_theme_mod('width_column_1_right_rate') - 40;
	}
	elseif( 'two-sidebars' == $curr_layout) {
		$content_width = $content_width - $content_width/100*aladdin_get_theme_mod('width_column_1_rate') - $content_width/100*aladdin_get_theme_mod('width_column_2_rate') - 40;
	}
	else {
		$content_width -= 40;
	}

	$content_width = absint($content_width);
	return $content_width;
}
endif;
 
/**
 * Convert given sidebar id to id from $defaults array
 *
 * @param string $sidebar_id sidebar id with page slug.
 * @return string slug of current sidebar.
 * @since Aladdin 1.0.0
 */
function aladdin_san_sidebar_id( $sidebar_id ) {
	$defaults = aladdin_get_defaults();

	foreach( $defaults['theme_sidebars'] as $id => $value ) {

		if( 0 == strrpos( $sidebar_id, $id ) ) {
			return $id;
		}
	}
	 return false;
}

/**
 * Return width of sidebar
 *
 * @param string $sidebar_id slug of current sidebar with page prefix.
 * @return int max width of sidebar.
 * @since Aladdin 1.0.0
 */
function aladdin_get_sidebar_width( $sidebar_id ) {
	$defaults = aladdin_get_defaults();
	$width = 1366;
	$sidebar_id = aladdin_san_sidebar_id( $sidebar_id );
	if( false == $sidebar_id)
		return $width;
				
	switch ( $sidebar_id ) {
		case 'sidebar-top':
			$width = aladdin_get_theme_mod('width_site');
		break;
		case 'sidebar-before-footer':
			$width = aladdin_get_theme_mod('width_site');
		break;
		case 'sidebar-footer':
			$width = aladdin_get_theme_mod('width_main_wrapper')/3;
		break;
		case 'column-1':
			$width = 300;
		break;		
		case 'column-2':
			$width = 300;
		break;		
	}
		
	return $width;
}

/**
 * Return prefix for content-xxx.php file
 *
 * @since Aladdin 1.0.0
 */
function aladdin_get_content_prefix() {

	$post_type = get_post_type();
	$post_prefix = '';
	if( 'post' == $post_type) {
		$post_prefix = get_post_format();
	} else {
		$post_prefix = $post_type.'-'; 
	}
	if( is_search() || is_archive() || is_home() ) {
		$name = $post_prefix . ( '' == $post_prefix ? '' : '-') . 'archive';
		
		$located = locate_template( $name . '.php' );
		
		if ( ! empty( $located ) ) {
			return $name;
		} else {
			return 'archive';
		}
	}
	return get_post_format();

}

/**
 * Check for 'flex' prefix 
 *
 * @layout string content layout
 *
 * @since Aladdin 1.0.0
 */
function aladdin_content_class( $layout_content ) {
	$is_flex = strrpos($layout_content, 'flex');
	$layout_content = ( false === $is_flex ? $layout_content : 'flex '.$layout_content );
	return $layout_content;
}

 /**
 * Print header html
 *
 * @since Aladdin 1.0.0
 */
function aladdin_header() {
?>
	<div id="sg-site-header" class="sg-site-header">
		<div class="menu-top">
			<!-- First Top Menu -->
			<div class="nav-container top-1-navigation">
				<div class="max-width">
					<?php if ( aladdin_get_theme_mod( 'is_show_top_menu' ) == '1' ) : ?>
						<nav class="horisontal-navigation menu-1" role="navigation">
							<span class="toggle"><span class="menu-toggle"></span></span>
							<?php wp_nav_menu( array( 'theme_location' => 'top1', 'menu_class' => 'nav-horizontal' ) ); ?>
						</nav><!-- .menu-1 .horisontal-navigation -->
					<?php endif; ?>
					<div class="clear"></div>
				</div><!-- .max-width -->
			</div><!-- .top-1-navigation .nav-container -->

			<div class="sg-site-header-1">
				<div class="max-header-width">
				
					<?php if ( '' != aladdin_get_theme_mod( 'logotype_url' ) ) : ?>
						<div class="logo-block">
							<a class="logo-section" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
								<img src='<?php echo esc_url( aladdin_get_theme_mod( 'logotype_url' ) ); ?>' class="logo" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
							</a><!-- .logo-section -->
						</div><!-- .logo-block -->
					<?php endif; ?>
					
					<div class="site-title">
						<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					</div><!-- .site-title -->
					<!-- Dscription -->
					<div class="site-description">
						<h2><?php echo bloginfo( 'description' ); ?></h2>
					</div><!-- .site-description -->
				
				</div><!-- .max-width -->
			</div><!-- .sg-site-header-1 -->
			
			<!-- Second Top Menu -->	
			<?php if ( '1' == aladdin_get_theme_mod( 'is_show_secont_top_menu') ) : ?>

				<div class="nav-container top-navigation">
					<div class="max-width">
						<nav class="horisontal-navigation menu-2" role="navigation">
							<span class="toggle"><span class="menu-toggle"></span></span>
							<?php wp_nav_menu( array( 'theme_location' => 'top2', 'menu_class' => 'nav-horizontal' ) ); ?>
						</nav><!-- .menu-2 .horisontal-navigation -->
						<div class="clear"></div>
					</div><!-- .max-width -->
				</div><!-- .top-navigation.nav-container -->
				
			<?php endif; ?>
		</div><!-- .menu-top  -->
	</div><!-- .sg-site-header -->
<?php
}
add_action( 'aladdin_header', 'aladdin_header' );


 /**
 * Print credit links and scroll to top button
 *
 * @since Aladdin 1.0.0
 */
function aladdin_site_info() {
	$text = aladdin_get_theme_mod( 'footer_text' );
	if ( '' != $text ) :
?>
		<div class="site-info">
			<?php echo wp_kses( $text, array(
									'a' => array(
										'href' => array(),
										'title' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
								)
								); ?>
		</div><!-- .site-info -->
	
	<?php endif; 
	
	if ( 'none' != aladdin_get_theme_mod( 'scroll_button' ) ) : ?>
		<a href="#" class="scrollup <?php echo esc_attr( aladdin_get_theme_mod( 'scroll_button' )).
			esc_attr( 'none' == aladdin_get_theme_mod( 'scroll_animate' ) ? '' : ' ' . aladdin_get_theme_mod( 'scroll_animate' ) ); ?>"></a>
	<?php endif;
}
add_action( 'aladdin_site_info', 'aladdin_site_info' );

/**
 * Print Favicon.
 *
 * @since Aladdin 1.0.0
 */
function aladdin_hook_favicon() {
	$defaults = aladdin_get_defaults();
?>
	<?php if ( get_theme_mod( 'favicon', $defaults['favicon'] ) != '' ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod( 'favicon', $defaults['favicon'] )); ?>" />
	<?php endif;
}
add_action('wp_head', 'aladdin_hook_favicon');

 /**
 * Retrieve the array of ids of all terms for the current archive page 
 *
 * @param string $tax, taxonomy name
 * @since Aladdin 1.0.0
 */
function aladdin_get_tax_ids( $tax ) {
	$tax_names = array();
	
	while ( have_posts() ) : the_post(); 
			
		$terms = get_the_terms( get_the_ID(), $tax );
								
		if ( $terms && ! is_wp_error( $terms ) ) : 

			foreach ( $terms as $id => $term ) {
				$tax_names[ $term->term_id ] = $term->name;
			}

		endif;
		
	endwhile; 
	
	rewind_posts();

	return array_unique( $tax_names );
}

 /**
 * Retrieve the array of ids of terms from the current page
 *
 * @param string $tax, taxonomy name
 * @since Aladdin 1.0.0
 */
function aladdin_get_curr_tax_ids( $tax ) {
	$tax_names = array();
		
	$terms = get_the_terms( get_the_ID(), $tax );
							
	if ( $terms && ! is_wp_error( $terms ) ) : 

		foreach ( $terms as $term ) {
			$tax_names[] = $term->term_id;
		}

	endif;
			
	return array_unique( $tax_names );
}

 /**
 * Retrieve the array of names of terms from the current page
 *
 * @param string $tax, taxonomy name
 * @since Aladdin 1.0.0
 */
function aladdin_get_curr_tax_names( $tax ) {
	$tax_names = array();
		
	$terms = get_the_terms( get_the_ID(), $tax );
							
	if ( $terms && ! is_wp_error( $terms ) ) : 

		foreach ( $terms as $term ) {
			$tax_names[] = $term->name;
		}

	endif;
			
	return array_unique( $tax_names );
}

/**
 * Add new wrapper for woocommerce pages.
 *
 * @since Aladdin 1.0.0
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'aladdin_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'aladdin_wrapper_end', 10);

function aladdin_wrapper_start() {
  echo '<div id="woocommerce-wrapper">';
}

function aladdin_wrapper_end() {
  echo '</div>';
}

/**
 * Change related products number
 *
 * @since Aladdin 1.0.0
 */
add_filter( 'woocommerce_output_related_products_args', 'aladdin_related_products_args' );
function aladdin_related_products_args( $args ) {

	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

/**
 * Echo column sidebars
 *
 * @param string $layout current layout
 *
 * @since Aladdin 1.0.0
 */
function aladdin_get_sidebar( $layout ) {

	if ( 'two-sidebars' == $layout ) {
		get_sidebar();
	} elseif ( 'right-sidebar' == $layout ) {
		get_sidebar( '2' );
	} elseif ( 'left-sidebar' == $layout ) {
		get_sidebar( '1' );
	}
}

/**
 * Echo column sidebars in widget
 *
 * @param string $layout current layout
 *
 * @since Aladdin 1.0.0
 */
function aladdin_get_sidebar_widget( $layout ) {

	if ( 'two-sidebars' == $layout ) {
		get_template_part('sidebar-widget');
	} elseif ( 'right-sidebar' == $layout ) {
		get_template_part( 'sidebar-2-widget' );
	} elseif ( 'left-sidebar' == $layout ) {
		get_template_part( 'sidebar-1-widget' );
	}

}

/**
 * Set excerpt length to 30 words
 *
 * @param string $length current length 
 *
 * @since Aladdin 1.0.0
 */
function aladdin_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'aladdin_custom_excerpt_length', 99999 );

/**
 * Return Trimmed excerpts
 *
 * @param int $charlength length of output
 *
 * @since Aladdin 1.0.0
 */
function aladdin_the_excerpt( $charlength = 120 ) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}


// Add custom widgets and customizer files
/* Insert Page */
require get_template_directory() . '/inc/widget-page-2.php';

/* one page scroll */
require get_template_directory() . '/inc/widget-sidebar-navigation.php';

/* portfolio */
if ( class_exists( 'Jetpack' ) ) {
	require get_template_directory() . '/inc/widget-portfolio.php';
}

/* posts */
require get_template_directory() . '/inc/widget-items-category.php';

if ( class_exists( 'WooCommerce' ) ) {
	/* shop */

}

/* images */
require get_template_directory() . '/inc/widget-image.php';

require get_template_directory() . '/inc/widget-functions.php';

// Add custom social media icons widget.
require get_template_directory() . '/inc/social-media-widget.php';
// Add customize options.
require get_template_directory() . '/inc/customize.php';
// Add sidebar options.
require get_template_directory() . '/inc/customize-sidebars.php';

if ( ! class_exists ( 'aladdin_Layout_Class' ) ) :
	require get_template_directory() . '/inc/customize-layout.php';
endif;

require get_template_directory() . '/inc/customize-widget-forms.php';
require get_template_directory() . '/inc/customize-colors.php';
require get_template_directory() . '/inc/customize-mobile.php';
require get_template_directory() . '/inc/customize-fonts.php';
require get_template_directory() . '/inc/customize-other.php';
require get_template_directory() . '/inc/customize-info.php';

//admin page
require get_template_directory() . '/inc/admin-page.php';
require get_template_directory() . '/inc/theme-options.php';