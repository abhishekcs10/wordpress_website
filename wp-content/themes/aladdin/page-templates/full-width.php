<?php
/**
 * Template Name: Full Width Template
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
 __( 'Full Width Template', 'aladdin' );

get_header(); 

?>
<div class="main-wrapper">

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
</div> <!-- .main-wrapper -->

<?php
get_footer();
