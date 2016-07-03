<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
?>
<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php
			if ( is_single() ) :

				if ( '1' == aladdin_get_theme_mod('is_display_post_title') ) :

					the_title( '<h1 class="entry-title">', '</h1>' );		
				
				endif;	
				
			else : 
			
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
	
			endif;
			?>
			
			<?php if ( '1' == aladdin_get_theme_mod('is_display_post_cat') ) : ?>

			<div class="category-list">
				<?php echo get_the_category_list(''); ?>
			</div><!-- .category-list -->
			
			<?php endif; ?>
			
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() && '1' == aladdin_get_theme_mod('is_display_post_image') ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>
			
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __('<div class="meta-nav">Read more... &rarr;</div>', 'aladdin' )); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'aladdin'), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
		<footer class="entry-footer">
			<div class="entry-meta">
			
				<?php if ( '1' == aladdin_get_theme_mod('is_display_post_tags') ) : ?>

				<div class="tags">
					<?php echo get_the_tag_list('', ' ');?>
				</div>
				
				<?php endif; ?>
				
				<span class="post-date">
					<?php aladdin_posted_on(); ?>
				</span>
				
				<?php if( class_exists('Jetpack') && Jetpack::is_module_active('stats') && function_exists ( 'stats_get_csv' ) ) : ?>
					<?php $result = stats_get_csv( 'postviews', 'post_id=' . get_the_ID() . '&limit=-1&summarize');
						echo '<span class="post-views">' . number_format_i18n( $result[0]['views'] ) . '</span>'; ?>
				<?php endif; ?>
				
				<?php edit_post_link( __( 'Edit', 'aladdin' ), '<span class="edit-link">', '</span>' ); ?>
			</div> <!-- .entry-meta -->
			<?php 
			if ( is_single() ) :
				do_action( 'aladdin_after_content' );
			endif; 
			?>	
		</footer><!-- .entry-footer -->	
	</article><!-- #post -->
</div><!-- .content-container -->