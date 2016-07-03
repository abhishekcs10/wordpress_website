<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<!-- Header -->
		<?php $defaults = aladdin_get_defaults(); ?>

		<header id="masthead" class="site-header" role="banner">

			<?php do_action( 'aladdin_header' ); ?>
			
		</header><!-- #masthead -->

		<section class="sg-header-area">
			<div class="header-wrap">
			<?php if ( get_header_image() 
						&& ( get_theme_mod( 'is_header_on_front_page_only', $defaults['is_header_on_front_page_only'] ) != '1' || is_front_page())) : ?>		
						
				<!-- Banner -->
				<div style="height: 400px;" class="my-image widget">
					<div class="parallax-image 20 10 10" style="background-image: url(<?php header_image(); ?>);">
					</div><!-- .parallax-image -->
				</div><!-- .my-image -->
						
			<?php 
			endif;
			
			get_sidebar('top');
			
			?>
			
			</div><!-- .header-wrap -->
		</section><!-- .sg-header-area -->
	
		<div class="main-area">