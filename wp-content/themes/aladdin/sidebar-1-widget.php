<?php
/**
 * The sidebar containing the main widget area for the widget page
 *
 * @package WordPress
 * @subpackage aladdin
 * @since Aladdin 1.0.0
 */

global $aladdin_curr_page_id;
$aladdin_curr_slug = aladdin_get_page_sidebar_slug( $aladdin_curr_page_id );
$hook_name = 'aladdin_empty_column_1-' . $aladdin_curr_slug;

?>
<div class="sidebar-1">
	<div class="column small">		
		<div class="widget-area recurs">
		<?php if ( is_active_sidebar( 'aladdin-column-1' . '-' . $aladdin_curr_slug ) ) : ?>
		
				<?php dynamic_sidebar( 'aladdin-column-1' . '-' . $aladdin_curr_slug ); ?>

		<?php else : ?>

				<?php do_action( $hook_name ); ?>
		
		<?php endif; ?>
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-1 -->