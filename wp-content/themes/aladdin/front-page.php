<?php
/**
 * The template for displaying front page
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header(); 
if( ! ( 'no_content' == aladdin_get_theme_mod( 'front_page_style' ) ) ) :

	if( is_home() )
		$aladdin_layout_content = aladdin_get_theme_mod('layout_blog_content');
	else 
		$aladdin_layout_content = 'front_page';
	?>
	<div class="main-wrapper <?php echo esc_attr(aladdin_content_class($aladdin_layout_content)); ?> <?php echo esc_attr( aladdin_get_theme_mod( 'layout_home' ) ); ?> ">

		<div class="site-content"> 
			<div class="content"> 

			<?php
				if ( have_posts() ) : 
				
					while ( have_posts() ) : the_post();

						if( is_page() ) :
							get_template_part( 'content', 'page' );
						else :
							get_template_part( 'content', aladdin_get_content_prefix() );
						endif;
						
					endwhile; 
			?>
					<div class="after-content">
					
						<?php do_action( 'aladdin_after_content' ); ?>
						
					</div><!-- .after-content -->
			
				<?php
					
				else :  

					get_template_part( 'content', 'none' );  ?>
					
					</div><!-- .content -->
				<?php

				endif;
			?>
		</div><!-- .content -->

		<?php aladdin_paging_nav(); ?>

		</div><!-- .site-content -->
		
	<?php aladdin_get_sidebar( aladdin_get_theme_mod( 'layout_home' ) ); ?>
	
</div> <!-- .main-wrapper -->

<?php
endif;
get_footer();