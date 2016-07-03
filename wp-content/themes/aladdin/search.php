<?php
/**
 * The template for displaying search results
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header(); 
?>
<div class="main-wrapper <?php echo esc_attr( aladdin_content_class( aladdin_get_theme_mod('layout_search_content') ) ); ?> <?php echo esc_attr( aladdin_get_theme_mod( 'layout_search' ) ); ?> ">

	<div class="site-content">
			<?php
				if ( have_posts() ) : 
				?>
					<header class="archive-header">
						<h1 class="archive-title"><?php printf( __( 'Search results for: %s', 'aladdin' ), esc_html( get_search_query().' ('.$wp_query->found_posts.')') ); ?></h1>
					</header><!-- .archive-header -->
				
					<div class="content"> 

				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', aladdin_get_content_prefix() );
						
					endwhile; ?>
					
						<div class="after-content">
							<?php do_action( 'aladdin_after_content' ); ?>
						</div><!-- .after-content -->
						
					</div><!-- .content -->
				
				<?php

					aladdin_paging_nav();
					
				else :  
				?>
					<div class="content"> 
						<?php get_template_part( 'content', 'none' ); ?>
					</div><!-- .content -->
					
				<?php 
				endif;
?>
	</div><!-- .site-content -->
	
	<?php aladdin_get_sidebar( aladdin_get_theme_mod('layout_search') ); ?>
	
</div> <!-- .main-wrapper -->

<?php
get_footer();