<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
?>
<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">

			<?php if ( '1' == aladdin_get_theme_mod('is_display_page_title') ) : 

				the_title( '<h1 class="entry-title">', '</h1>' );		
			
			 endif; ?>	
			
			<?php if ( has_post_thumbnail() && '1' == aladdin_get_theme_mod('is_display_page_image') ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
			<?php endif; ?>
										
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'aladdin' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
			<div class="clear"></div>
			<footer class="entry-footer">
				<div class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'aladdin' ), '<span class="edit-link">', '</span>' ); ?>
				</div> <!-- .entry-meta -->
				<?php 
				if ( is_page() ) :
					do_action( 'aladdin_after_content' );
				endif; 
				?>	
			</footer><!-- .entry-footer -->
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
</div><!-- .content-container -->