<?php
/**
 * The template for displaying woocommerce archive pages.
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
get_header(); 

$aladdin_layout_name = ( is_shop() || is_archive() ? 'layout_shop' : 'layout_shop_page' );
$aladdin_layout = aladdin_get_theme_mod( $aladdin_layout_name );
global $woocommerce_loop;
$aladdin_columns = 4;

if ( ! empty( $woocommerce_loop['columns'] ) )
	$aladdin_columns = apply_filters( 'loop_shop_columns', 4 );
if ( is_singular() )
	$aladdin_columns = 0;
?>

<div class="main-wrapper woo-shop <?php echo esc_attr($aladdin_layout); ?> flex-layout-<?php echo esc_attr( $aladdin_columns ); ?>">

	<div class="site-content"> 
		<div class="content"> 
			<?php if ( is_singular() ) : ?>
			<div class="content-container">
			<?php endif; ?>
	
					<?php woocommerce_breadcrumb(); ?>
					<?php woocommerce_content(); ?>
					<?php do_action( 'aladdin_after_content' ); ?>	

			<?php if ( is_singular() ) : ?>
			</div><!-- .content-container -->
			<?php endif; ?>

		</div><!-- .content -->
	</div><!-- .site-content -->
	<?php aladdin_get_sidebar( $aladdin_layout ); ?>

</div> <!-- .main-wrapper.woo-shop -->

<?php
get_footer();
