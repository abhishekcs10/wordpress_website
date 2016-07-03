<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */
 
$aladdin_curr_slug = aladdin_get_sidebar_slug();
$hook_name = 'aladdin_empty_column_1-' . $aladdin_curr_slug;

?>

<div class="sidebar-1">
	<div class="column small">		
		<div class="widget-area">
		<?php if ( is_active_sidebar( 'aladdin-column-1' . '-' . $aladdin_curr_slug ) ) : ?>
		
				<?php dynamic_sidebar( 'aladdin-column-1' . '-' . $aladdin_curr_slug ); ?>

		<?php else : ?>

				<?php do_action( $hook_name ); ?>
		
		<?php endif; ?>
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-1 -->