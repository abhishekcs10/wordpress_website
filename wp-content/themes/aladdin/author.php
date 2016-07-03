<?php
/**
 * The template for displaying archive by Author
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header(); 
$aladdin_layout = aladdin_get_theme_mod( 'layout_archive' );
$aladdin_layout_content = aladdin_get_theme_mod( 'layout_archive_content' );
?>
<div class="main-wrapper <?php echo esc_attr( aladdin_content_class( $aladdin_layout_content ) ); ?> <?php echo esc_attr( $aladdin_layout ); ?> ">
	
	<div class="site-content">
			<?php
				if ( have_posts() ) : 
				?>
					<header class="archive-header">
						<h1 class="archive-title">
									<?php
										the_post();

										printf( __( 'All posts by %s', 'aladdin' ), get_the_author() );
									?>
								</h1>
								<?php if ( get_the_author_meta( 'description' ) ) : ?>
								<div class="author-description"><?php the_author_meta( 'description' ); ?></div>
								<?php endif; ?>
					</header><!-- .archive-header -->
					
					<div class="content"> 

				<?php
				
					rewind_posts();

					while ( have_posts() ) : the_post();

						get_template_part( 'content', aladdin_get_content_prefix() );
						
					endwhile; ?>
						<div class="after-content">
						<?php do_action( 'aladdin_after_content' ); ?>
						</div><!-- .after-content -->
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
	<?php aladdin_get_sidebar( aladdin_get_theme_mod( 'layout_archive' ) ); ?>
</div> <!-- .main-wrapper -->

<?php
get_footer();