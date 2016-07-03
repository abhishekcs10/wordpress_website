<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

?>	
		</div> <!-- .main-area -->
		
		<?php get_sidebar('before-footer'); ?>

			<?php if ( '1' == aladdin_get_theme_mod( 'is_show_footer_menu') ) : ?>

				<div id="footer-navigation" class="nav-container">
					<nav id="menu-4" class="horisontal-navigation" role="navigation">
						<span class="toggle"><span class="menu-toggle"></span></span>
						<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'nav-horizontal' ) ); ?>
					</nav><!-- #menu-4 .horisontal-navigation -->
					<div class="clear"></div>
				</div><!-- #footer-navigation .nav-container -->
				
			<?php endif; 
			if ( ( ! is_front_page() || '1' == aladdin_get_theme_mod( 'is_home_footer' )) && ! is_page_template( 'page-templates/no-content-footer.php' ) )
				get_sidebar('footer');
			 ?>
	
		<footer id="colophon" class="site-footer">

			<?php do_action('aladdin_site_info'); ?>

		</footer><!-- #colophon -->
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>