<?php
/**
 * The sidebar containing the before footer widget area.
 *
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

$aladdin_curr_slug = aladdin_get_sidebar_slug();
$hook_name = 'aladdin_empty_sidebar_before_footer-' . $aladdin_curr_slug;
global $wp_filter;
if( ! isset( $wp_filter[ $hook_name ] ) && ! is_active_sidebar( 'sidebar-before-footer' . '-' . $aladdin_curr_slug ) )
	return;
?>

<div class="sidebar-wrap">
	<div class="sidebar-before-footer wide">
		<div class="widget-area">
			<?php if ( is_active_sidebar( 'aladdin-sidebar-before-footer' . '-' . $aladdin_curr_slug ) ) : ?>
			
					<?php dynamic_sidebar( 'aladdin-sidebar-before-footer' . '-' . $aladdin_curr_slug ); ?>

			<?php else : ?>

					<?php do_action( $hook_name ) ?>
			
			<?php endif; ?>
		</div><!-- .widget-area -->
	</div><!-- .sidebar-before-footer .wide -->
</div><!-- .sidebar-wrap -->