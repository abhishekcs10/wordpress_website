<?php
/**
* Functions for displaying input fields in widget's admin panel
*
* @since Aladdin 1.0.0
*/

/**
* Output checkbox
 *
 * @since Aladdin 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function aladdin_echo_input_checkbox( $object, $name, $instance, $title ) { ?>
	<p>
		<input type="checkbox" name="<?php echo $object->get_field_name( $name ); ?>" id="<?php echo $object->get_field_id( $name ); ?>"  value="1" <?php checked( $instance[ $name ], '1'); ?> />
		<label for="<?php echo $object->get_field_id( $name ); ?>"><?php echo esc_html( $title ); ?></label>
	</p>
	<?php
}

/**
 * Output text field
 *
 * @since Aladdin 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function aladdin_echo_input_text( $object, $name, $instance, $title ) { ?>
	<p>
		<label for="<?php echo $object->get_field_id( $name );?>"><?php echo esc_html(strtoupper( $title )); ?></label>
		<br>
		<input type="text" name="<?php echo $object->get_field_name( $name ) ?>" id="<?php echo $object->get_field_id( $name ); ?>" value="<?php echo esc_attr( $instance[$name] ); ?>" />		
	</p>
	<hr>
	<?php
}
/**
 * Output hover style select
 *
 * @since Aladdin 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
*/
function aladdin_echo_input_hover_style( $object, $name, $instance ) {
	esc_html_e('Hover Effect Style:', 'aladdin'); ?>
	<select id="<?php echo $object->get_field_id($name); ?>" name="<?php echo $object->get_field_name($name); ?>" style="width:100%;">
	<?php 
		$styles=array( __('Caption (1)', 'aladdin'), __('50% (2)', 'aladdin'), __('Fast (3)', 'aladdin'), 
		__('Slow (4)', 'aladdin'), __('Side (5)', 'aladdin'), __('Round (6)', 'aladdin'), 
		__('Left To Right (7)', 'aladdin'), 
		__('Jump (8)', 'aladdin'), 
		__('Fly (9)', 'aladdin'), 
		__('Zoom In (10)', 'aladdin'), 
		__('Hovered (11)', 'aladdin'), 
		__('Wide Hover (12)', 'aladdin'), 
		__('Top (14)', 'aladdin'), 
		__('Right To Left (15)', 'aladdin'), 
		__('Bottom (16)', 'aladdin'),
		__('Caption Left (17)', 'aladdin'),
		__('Caption Right (18)', 'aladdin'),
		__('Caption Left-2 (19)', 'aladdin'),
		__('Caption Center (20)', 'aladdin'),
		);
		$styles_ids=array('effect-1', 'effect-2', 'effect-3', 'effect-4', 'effect-5', 'effect-6', 'effect-7', 'effect-8', 'effect-9', 'effect-10', 'effect-11', 'effect-12', 'effect-14', 'effect-15', 'effect-16', 'effect-17', 'effect-18', 'effect-19', 'effect-20');

		for ( $i = 0; $i < 19; $i++ ) {
			echo '<option value="'. esc_attr($styles_ids[$i]).'" ';
			selected( $instance[$name], $styles_ids[$i] );
			echo '>'.esc_html($styles[$i]).'</option>';
		}
	?>
	</select>
	<?php 
}
/**
 * Add button for selecting image id from media library
 *
 * @since Aladdin 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function aladdin_echo_input_upload_id( $object, $name, $instance, $title ) { ?>
		<hr>
		<?php
		if( strpos( $instance[ $name ], 'http' ) !== false ) : ?>
			<img class="<?php echo $object->get_field_id( $name ) . '_url'; ?>" src="<?php echo esc_url( $instance[ $name ] ); ?>" />
		<?php
		else : 
			$img = wp_get_attachment_image_src( $instance[ $name] );
			if ( $img ) :
		?>
			<img style="max-width:100%;" class="<?php echo $object->get_field_id( $name ) . '_url'; ?>" src="<?php echo esc_url( $img[0] ); ?>" />
		<?php
			else :
		?>
			<img class="<?php echo $object->get_field_id( $name ) . '_url'; ?>" src="" />
		<?php
			endif;
		endif; 
		
		$widget_id = str_replace( '-' . $name, '', $object->get_field_id( $name ) );
		$widget_id = substr( $widget_id, 7 );
		?>
			
		<br>
		
		<label for="<?php echo $object->get_field_id( $name ); ?>"><?php esc_html_e( 'Image Url or Id:', 'aladdin' ); ?></label>
		<input name="<?php echo $object->get_field_name( $name ); ?>" id="<?php echo $object->get_field_id( $name ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr( $instance[$name] ); ?>" />		
		<input id="<?php echo $object->get_field_id( $name ); ?>_b" class="<?php echo esc_attr( $widget_id ); ?> upload_id_button button button-primary" type="button" value="<?php esc_html_e( 'Upload Image', 'aladdin'); ?>" />
		<hr>
	<?php
}

/**
 * Add button for selecting image url from media library
 *
 * @since Aladdin 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function aladdin_echo_input_upload( $object, $name, $instance, $title ) { ?>
	<hr>
		<?php if( trim($instance[$name]) != '' ) : ?>
			<img src="<?php echo esc_url(($instance[$name])); ?>" style="max-width:100%;" alt="<?php echo esc_attr('Upload', 'aladdin'); ?>" />
		<?php endif; ?>
		
		<br>
		<label for="<?php echo $object->get_field_id( $name ); ?>"><?php esc_html_e( 'Url:', 'aladdin' ); ?></label>
		<input name="<?php echo $object->get_field_name( $name ); ?>" id="<?php echo $object->get_field_id( $name ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $instance[$name] ); ?>" />		
		<input id="<?php echo $object->get_field_id( $name ); ?>_b" class="upload_image_button button button-primary" type="button" value="<?php esc_html_e( 'Upload Image', 'aladdin'); ?>" />
	<hr>
	<?php
}
/**
 * Output textarea field
 *
 * @since Aladdin 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function aladdin_echo_input_textarea( $object, $name, $instance, $title, $rows=10, $cols=20 ) { ?>
	<p>
		<label for="<?php echo $object->get_field_id( $name ); ?>"><?php echo esc_html($title); ?></label>
		<br>
		<textarea name="<?php echo $object->get_field_name( $name ) ?>" rows="<?php echo $rows;?>" id="<?php echo $object->get_field_id( $name ); ?>"><?php echo esc_textarea($instance[$name]); ?></textarea>		
	</p>
	<?php
}
/**
 * Output start of section
 *
 * @since Aladdin 1.0.0
 *
 * @param string $text Title
*/
function aladdin_echo_section_start( $text, $id ) { ?>

	<div class="section-toggle <?php echo esc_attr( $id ); ?>"> <?php echo esc_html( $text ); ?></div>
	<div class="widget-section <?php echo esc_attr( $id ); ?>">	
	
	<?php
}
/**
 * Output end of section
 *
 * @since Aladdin 1.0.0
 *
*/
function aladdin_echo_section_end() { ?>
	</div>
	<?php
}

/**
 * Output start of section
 *
 * @since Aladdin 1.0.0
 *
 * @param string $text Title
*/
function aladdin_echo_section_main_start( $text, $id ) { ?>

	<div class="section-main-toggle <?php echo esc_attr( $id ); ?>"> <?php echo esc_html( $text ); ?></div>
	<div class="widget-main-section <?php echo esc_attr( $id ); ?>">	
	
	<?php
}
/**
 * Output end of section
 *
 * @since Aladdin 1.0.0
 *
*/
function aladdin_echo_section_main_end() { ?>
	</div>
	<?php
}
/**
 * Output color selection
 *
 * @since Aladdin 1.0.0
 *
*/
function aladdin_echo_input_color( $object, $name, $instance, $title, $def_color = '#fff') { ?>
	<p>
		<label for="<?php echo $object->get_field_id( $name ); ?>"><?php echo esc_html( $title ); ?></label>
		<br>
		<input type="text" name="<?php echo $object->get_field_name( $name );?>" id="<?php echo $object->get_field_id( $name ); ?>" value="<?php echo esc_attr( $instance[ $name]  ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( $def_color ); ?>" />		
	</p>
	<?php
}