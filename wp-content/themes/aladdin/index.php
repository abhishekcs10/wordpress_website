<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header(); 

?>
<div class="main-wrapper <?php echo esc_attr( aladdin_content_class( aladdin_get_theme_mod( 'layout_default_content' ) ) ); ?> <?php echo esc_attr( aladdin_get_theme_mod('layout_default') ); ?> ">

	<div class="site-content">
		<div class="content"> 
		<?php
			if ( have_posts() ) : 
			
				while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_format() );
					
				endwhile; 

				aladdin_paging_nav();
				
			else :  
				get_template_part( 'content', 'none' ); 
			
			endif; 
			?>
			
		</div><!-- .content -->
		<div class="clear"></div>
	</div><!-- .site-content -->
	
	<?php aladdin_get_sidebar( aladdin_get_theme_mod( 'layout_default' ) ); ?>
	
</div> <!-- .main-wrapper -->

<?php
get_footer();