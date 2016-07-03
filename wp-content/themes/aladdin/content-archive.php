<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
?>
<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">

			<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<div class="element effect-1">
					<div class="entry-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div><!-- .entry-thumbnail -->
																		
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="link-hover" rel="bookmark">
						<span class="link-button">
							<?php esc_html_e('Read more..', 'aladdin'); ?>
						</span>
					</a>
						
				</div><!-- .element -->
			<?php endif; ?>
			
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

		</header><!-- .entry-header -->
		
		<?php if( 'excerpt' == aladdin_get_theme_mod('single_style') ) : ?>
			
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
				
		<?php elseif( 'content' == aladdin_get_theme_mod('single_style') ) : ?>
			
			<div class="entry-content">
				<?php the_content( __('<div class="meta-nav">Continue reading... &rarr;</div>', 'aladdin' )); ?>
			</div><!-- .entry-content -->
			
		<?php endif; ?>
		
		<footer class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : ?>

				<span class="post-date">
					<?php aladdin_posted_on(); ?>
				</span>
				
			<?php endif; ?>
			
				<?php if( class_exists('Jetpack') && Jetpack::is_module_active('stats') && function_exists ( 'stats_get_csv' ) ) : ?>
					<?php $result = stats_get_csv( 'postviews', 'post_id=' . get_the_ID() . '&limit=-1&summarize');
						echo '<span class="post-views">' . number_format_i18n( $result[0]['views'] ) . '</span>'; ?>
				<?php endif; ?>
			
			<?php edit_post_link( __( 'Edit', 'aladdin' ), '<span title="'.__( 'Edit', 'aladdin' ).'" class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		
	</article><!-- #post -->
	
</div><!-- .content-container -->