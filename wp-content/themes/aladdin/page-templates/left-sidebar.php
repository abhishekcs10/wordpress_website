<?php
/**
 * Template Name: Left Sidebar
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
 __( 'Left Sidebar', 'aladdin' );

get_header(); 

?>
<div class="main-wrapper left-sidebar">

	<div class="site-content"> 
			<?php
				if ( have_posts() ) : ?>
				
					<div class="content"> 

				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', 'page' );
						
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						
					endwhile; ?>
					
					</div><!-- .content -->
					<div class="clear"></div>
				
				<?php

					aladdin_paging_nav();
					
				else :  
				?>
					<div class="content"> 
					<?php 
						get_template_part( 'content', 'none' );
					?>
					
					</div><!-- .content -->
				<?php 
				endif;
?>
	</div><!-- .site-content -->
	<?php
		get_sidebar( '1' );
	?>
</div> <!-- .main-wrapper -->

<?php
get_footer();
