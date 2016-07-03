<?php
/**
 * The template for displaying Category pages
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header(); 

?>
<div class="main-wrapper <?php echo esc_attr( aladdin_content_class( aladdin_get_theme_mod( 'layout_portfolio_content' ) ) ); ?> <?php echo esc_attr( aladdin_get_theme_mod( 'layout_portfolio' ) ); ?> ">

	<div class="site-content">

	<?php
		if ( have_posts() ) : ?>
		
			<header class="archive-header">
				<h1 class="archive-title"><?php _e( 'All Projects', 'aladdin' ); ?></h1>
			</header><!-- .archive-header -->
			<div class="content"> 

		<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'content', 'jetpack-portfolio-archive' );
				
			endwhile; ?>
		
			<?php aladdin_paging_nav(); ?>
			
			<div class="after-content">
				<?php do_action( 'aladdin_after_content' ); ?>
			</div><!-- .after-content -->

			
		<?php else : ?>
			<div class="content"> 
			<?php
			get_template_part( 'content', 'none' );
			
		endif;
?>
		</div><!-- .content -->
		<div class="clear"></div>
	</div><!-- .site-content -->
	<?php aladdin_get_sidebar( aladdin_get_theme_mod( 'layout_portfolio' ) ); ?>
</div> <!-- .main-wrapper -->

<?php
get_footer();