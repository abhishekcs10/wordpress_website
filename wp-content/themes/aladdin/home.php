<?php
/**
 * The template for displaying blog
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header();
?>
<div class="main-wrapper <?php echo esc_attr( aladdin_content_class( aladdin_get_theme_mod('layout_blog_content') ) ); ?> <?php echo esc_attr( aladdin_get_theme_mod('layout_blog') ); ?> ">

	<div class="site-content">
		<div class="content"> 

		<?php
		if ( have_posts() ) : 
		
			while ( have_posts() ) : the_post();

				get_template_part( 'content', aladdin_get_content_prefix() );
				
			endwhile; 
		?>
				
			<div class="after-content">
			
				<?php do_action( 'aladdin_after_content' ); ?>
				
			</div><!-- .after-content -->
				
			
		<?php
			
		else :
		
			get_template_part( 'content', 'none' ); 
			
		endif;
		?>
		
		</div><!-- .content -->	
		
		<?php aladdin_paging_nav(); ?>

	</div><!-- .site-content -->
	<?php aladdin_get_sidebar( aladdin_get_theme_mod( 'layout_blog' ) ); ?>
</div> <!-- .main-wrapper -->

<?php
get_footer();