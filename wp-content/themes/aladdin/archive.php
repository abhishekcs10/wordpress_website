<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

get_header();

?>
<div class="main-wrapper <?php echo esc_attr( aladdin_content_class( aladdin_get_theme_mod( 'layout_archive_content' ) ) ); ?> <?php echo esc_attr( aladdin_get_theme_mod( 'layout_archive' ) ); ?> ">
	
	<div class="site-content">
		<div class="content"> 
			<?php
				if ( have_posts() ) : 
				?>
					<header class="archive-header">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'aladdin' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'aladdin' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'aladdin' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'aladdin' ), get_the_date( _x( 'Y', 'yearly archives date format', 'aladdin' ) ) );

						else :
							_e( 'Archives', 'aladdin' );

						endif; ?>
					
					</header><!-- .archive-header -->
					
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', aladdin_get_content_prefix() );
						
					endwhile; ?>
						<div class="after-content">
						<?php do_action( 'aladdin_after_content' ); ?>
						</div><!-- .after-content -->

				<?php

					aladdin_paging_nav();
					
				else :  
					get_template_part( 'content', 'none' );
				endif;
				?>
		</div><!-- .content -->
		<div class="clear"></div>

	</div><!-- .site-content -->
	<?php aladdin_get_sidebar( aladdin_get_theme_mod( 'layout_archive' ) ); ?>
</div> <!-- .main-wrapper -->

<?php
get_footer();