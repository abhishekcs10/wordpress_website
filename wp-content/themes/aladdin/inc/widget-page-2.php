<?php
/**
 * Add a widget for displaying page
 *
 * @since Aladdin 1.0.0
 */
 
class aladdin_page_aladding extends WP_Widget {

	/**
	 * Widget constructor
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function __construct() {

		/* Widget settings. */
		$widget_ops = array(
		'classname' => 'aladdin_page_aladding',
		'description' => __('Display styled page', 'aladdin' ));

		/* Widget control settings. */
		$control_ops = array(
		'width' => 250,
		'height' => 200,
		'id_base' => 'aladdin_page_aladding');

		/* Create the widget. */		
		
		parent::__construct( 'aladdin_page_aladding', __('Al Page Styled (Aladdin)', 'aladdin' ), $widget_ops, $control_ops );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );		
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}
	/**
	 * Fix for the color-picker
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function print_scripts() {
	?>
		<script>
			( function( $ ){
					function initColorPicker( widget ) {
							widget.find( '.color-picker' ).wpColorPicker( {
									change: _.throttle( function() { // For Customizer
											$(this).trigger( 'change' );
									}, 3000 )
							});
					}
						function onFormUpdate( event, widget ) {
							initColorPicker( widget );
					}
					$( document ).on( 'widget-added widget-updated', onFormUpdate );

					$( document ).ready( function() {
							$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
									initColorPicker( $( this ) );
							} );
					} );
			}( jQuery ) );
		</script>
	<?php
	}
	/**
	 * Widget styles
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function enqueue_styles() {
		wp_enqueue_style( 'aladdin-page', get_template_directory_uri() . '/inc/css/page.css');
	}

	/**
	 * Widget scripts
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function enqueue_scripts( $hook_suffix ) {

		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}

	/**
	 * Widget output
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	function widget( $args, $instance ) {
		// Widget output
		extract($args);
		$sidebar_id = ( isset($args['id']) ? $args['id'] : '' );
		
		// Set up some default widget settings. 
						
		$instance = wp_parse_args( (array) $instance, $this->defaults( $instance ) );
		$width = $this->get_width($sidebar_id, 2);
		
		$aladdin_curr_page_id = $instance['page_id'];
		
		/* save current page id in global variable, use it in sidebar-X-widget.php */
		
		$query = new WP_Query( array(
			'order'          => 'DESC',
			'posts_per_page' => 1,
			'no_found_rows'  => true,
			'post_status'    => 'publish',
			'post__in' => array( $aladdin_curr_page_id ),
			'post_type'		 => 'page',
		) );
		
		if ( $query->have_posts() || isset( $instance['ttl'] ) ) :
			$tmp_content_width = $GLOBALS['content_width'];
			$GLOBALS['content_width'] = $width;
			
			//print the widget for the sidebar
			$colors = '';
			
			if ( '1' == $instance['background_style'] || '2' == $instance['background_style'] ) {
			
				$widget_ops = 'background-color: ' . esc_attr( aladdin_hex_to_rgba( $instance['background'], $instance['opacity'] ) ) . '; ';
				
				if ( false !== strrpos( $args['before_widget'], "style='" ) ) {
					$args['before_widget'] = preg_replace( "/<section style='/", "<section style='" . $widget_ops, $args['before_widget'], 1);	
				} else {
					$args['before_widget'] = preg_replace( '/<section /', "<section style='" . $widget_ops . "'", $args['before_widget'], 1);		
				}
				
			} 			
			$widget_ops = '';

			if ( '2' == $instance['background_style'] || '3' == $instance['background_style'] ) {
			
				$colors = 'style="background-color: ' . esc_attr( aladdin_hex_to_rgba( $instance['background'], $instance['opacity'] ) ) . ';"';
				
				$widget_ops = 'background-color: ' . esc_attr( aladdin_hex_to_rgba( $instance['background'], $instance['opacity'] ) ) . '; color: ' . esc_attr( $instance['header_color'] ) . ';';
				
			}
			
			echo $args['before_widget'];

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			
			if ( '' != $widget_ops ) {
				if ( false !== strrpos( $args['before_title'], "style='" ) ) {
					$args['before_title'] = preg_replace( "/<h3 style='/", "<h3 style='" . $widget_ops, $args['before_title'], 1);	
				} else {
					$args['before_title'] = preg_replace( '/<h3 /', "<h3 style='" . $widget_ops . "'", $args['before_title'], 1);
				}	
			}
			
			if( trim( '' !== $title) ) echo $args['before_title'] . esc_html($title) . $args['after_title'];			

			?>

			<div class="widget-page-2-wrap <?php echo ( '1' == $instance['is_centered'] ? 'centered' : '' ); ?>" <?php echo $colors; ?>>
				<div class="main-wrapper <?php echo esc_attr( $instance['layout'] ); ?>" style="max-width:<?php echo esc_attr( $instance['max_width'] ); ?>px;">

					<?php
					if ( $query->have_posts() ) {
						$query->the_post();
					}
					?>
					<div class="site-content"> 

						<header class="entry-header">
						
							<?php if ( '1' != $instance['is_no_title'] ) :
							
								if ( isset( $instance['ttl'] ) ) :
								
									echo '<h1 class="entry-title" style="font-size: ' . esc_attr( $instance['header_font_size'] ) . 'px; color: ' . esc_attr( $instance['header_color'] ) . ';">' . esc_attr( $instance['ttl'] ) . '</h1>';
								
								else :
								
									the_title( '<h1 class="entry-title" style="font-size: ' . esc_attr( $instance['header_font_size'] ) . 'px; color: ' . esc_attr( $instance['header_color'] ) . ';">', '</h1>' );		
								
								endif;
								
							endif;
							
							 ?>	
							
							<?php if ( isset( $instance['img'] ) ) : ?>
								<?php if ( 'no-sidebar' == $instance['layout'] ) : ?>
									<div class="entry-thumbnail">
										<img src="<?php echo esc_url( $instance['img'] ); ?>" alt="">
									</div>
								<?php endif; ?>
							<?php elseif ( has_post_thumbnail() && '1' == $instance['is_post_thumbnail'] && 'no-sidebar' == $instance['layout'] ) : ?>
								<div class="entry-thumbnail">
									<?php the_post_thumbnail(); ?>
								</div>
							<?php endif; ?>
														
						</header><!-- .entry-header -->

						<div class="entry-content" style="font-size: <?php echo esc_attr( $instance['body_font_size'] ); ?>px; color: <?php echo esc_attr( $instance['body_font_color'] ); ?>">
							<?php
								if ( isset( $instance['txt'] ) ) :
									echo aladdin_sanitize_kses( $instance['txt'] );
								else :
									the_content();
								endif;
							?>
						</div><!-- .entry-content -->
						
						<?php edit_post_link( __( 'Edit', 'aladdin' ), '<span title="'.__( 'Edit', 'aladdin' ).'" class="edit-link">', '</span>' ); ?>

					</div><!-- .site-content -->
					
					<?php if ( 'left-sidebar' == $instance['layout'] ) : ?>

						<div class="sidebar-1">
						
						<?php if ( isset( $instance['img'] ) ) : ?>
								<div class="entry-thumbnail">
									<img src="<?php echo esc_url( $instance['img'] ); ?>" alt="">
								</div><!-- .entry-thumbnail -->
						<?php else: ?>
							<div class="widget-image">
								<?php the_post_thumbnail( $instance['image_size'] ); ?>
							</div><!-- .widget-image -->
						<?php endif; ?>
						
						</div><!-- .sidebar-1 -->
						
					<?php elseif( 'right-sidebar' == $instance['layout'] ) : ?>

						<div class="sidebar-2">
						
						<?php if ( isset( $instance['img'] ) ) : ?>
								<div class="entry-thumbnail">
									<img src="<?php echo esc_url( $instance['img'] ); ?>" alt="">
								</div><!-- .entry-thumbnail -->
						<?php else: ?>
							<div class="widget-image">
								<?php the_post_thumbnail( $instance['image_size'] ); ?>
							</div><!-- .widget-image -->
						<?php endif; ?>

						</div><!-- .sidebar-2 -->
						
					<?php endif; ?>

				</div> <!-- .main-wrapper -->
							<?php
							if ( '1' == $instance['is_search'] ) {
								?>
								<div class="search-form"> 
									<?php get_search_form(); ?> 
								</div><!-- .search-form -->
								<?php
							}
							if ( '1' == $instance['is_button'] ) :
							?>
								<ul class="widget-button">
									<li>
										<a href="<?php echo esc_url( $instance['link'] ); ?>">
											<?php echo esc_attr( $instance['caption'] ); ?>
										</a>
									</li>
								</ul>
							<?php
							endif;
							?>
			</div> <!-- .widget-page-wrap -->
			
		<?php
			echo $args['after_widget'];
			wp_reset_postdata();
			$GLOBALS['content_width'] = $tmp_content_width;
	
		endif; 
	}

	/**
	 * Data validation
	 *
	 * @since Aladdin 1.0.0
	 *
	 * @param array $new_instance Array of widget options.
	 * @param array $old_instance Array of old widget options.
	*/
	function update( $new_instance, $old_instance ) {
		// Save widget options
		
		$instance['title'] = esc_html($new_instance['title']); 
		$instance['page_id'] = absint($new_instance['page_id']); 
		
		if( isset($new_instance['is_no_title']) )
			$instance['is_no_title'] = '1';
		
		if( isset($new_instance['is_centered']) )
			$instance['is_centered'] = '1';	

		if( isset($new_instance['is_post_thumbnail']) ) 
			$instance['is_post_thumbnail'] = '1';
			
		if( isset($new_instance['is_search']) )
			$instance['is_search'] = '1';		
			
		if( isset($new_instance['is_button']) )
			$instance['is_button'] = '1';
			
		$possible_values = array('post-thumbnail', 'thumbnail', 'large', 'full');	
		$new_instance['image_size'] = ( in_array( $new_instance['image_size'], $possible_values ) ? $new_instance['image_size'] : 'post-thumbnail' );
			
		$possible_values = array( 'right-sidebar', 
								  'left-sidebar', 
								  'no-sidebar', 
						);
						
		$instance['layout'] =  in_array( $new_instance['layout'], $possible_values ) ? $new_instance['layout'] : 'no-sidebar'; 
		
		$possible_values = array( '1', 
								  '2', 
								  '3', 
								  '4',
						);
		$instance['background_style'] =  in_array( $new_instance['background_style'], $possible_values ) ? $new_instance['background_style'] : '4'; 
		
		$possible_values = array ( '0',
								   '0.1', 
								   '0.2', 
								   '0.3', 
								   '0.4', 
								   '0.5',
								   '0.6', 
								   '0.7',
								   '0.8',
								   '0.9',
								   '1');
		
		$instance['opacity'] = in_array( $new_instance['opacity'], $possible_values ) ? $new_instance['opacity'] : '0.5'; 
		$instance['background'] = $this->sanitize_hex_color( $new_instance['background'] ); 
		$instance['body_font_color'] = $this->sanitize_hex_color( $new_instance['body_font_color'] ); 
		$instance['header_color'] = $this->sanitize_hex_color( $new_instance['header_color'] ); 
		$instance['max_width'] = absint( $new_instance['max_width'] ); 
		$instance['body_font_size'] = absint( $new_instance['body_font_size'] ); 
		$instance['header_font_size'] = absint( $new_instance['header_font_size'] );						  
		
		$instance['caption'] = esc_attr( $new_instance['caption'] );						  
		$instance['link'] = esc_url( $new_instance['link'] );						  
		
		return $instance;
	}

	/**
	 * Widget form
	 *
	 * @since Aladdin 1.0.0
	 *
	 * @param array $instance Array of widget options.
	*/
	function form( $instance ) {
		// Output admin widget options form
		// Set up some default widget settings. 				
		$instance = wp_parse_args( (array) $instance, $this->defaults( $instance ) ); 
		
		aladdin_echo_input_text( $this, 'title', $instance, __( 'Title: ', 'aladdin' ), 0);
		aladdin_echo_input_checkbox( $this, 'is_no_title', $instance, __( 'No Title', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_centered', $instance, __( 'Text align center', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_post_thumbnail', $instance, __( 'Display Image', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_search', $instance, __( 'Add Search', 'aladdin'));
		
		$pages = get_pages(); 
		
		esc_html_e('Page:', 'aladdin'); ?>
		<select id="<?php echo $this->get_field_id('page_id'); ?>" name="<?php echo $this->get_field_name('page_id'); ?>" style="width:100%;">
		<?php 

			foreach ( $pages as $page ) :
				echo '<option value="'. esc_attr( $page->ID ).'" ';
				selected( $instance['page_id'], $page->ID  );
				echo '>'.esc_html( $page->post_title ).'</option>';
			endforeach;
		?>
		</select>
		
		<?php
		esc_html_e('Image position:', 'aladdin'); ?>
		<select id="<?php echo $this->get_field_id('layout'); ?>" name="<?php echo $this->get_field_name('layout'); ?>" style="width:100%;">
		<?php 
			$styles = array( 'right-sidebar' => __('Right', 'aladdin'), 
							'left-sidebar' => __('Left', 'aladdin'), 
							'no-sidebar' => __('Center', 'aladdin'), 
							);
							
			foreach ( $styles as $id => $style ) :
				echo '<option value="'. esc_attr( $id ) . '" ';
				selected( $instance['layout'], $id  );
				echo '>' . esc_html( $style ) . '</option>';
			endforeach;
		?>
		</select>
		
		<?php 
		esc_html_e('Image Size:', 'aladdin'); ?>
		<select id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>" style="width:100%;">
		<?php 
			$styles=array( __('Post Thumbnail', 'aladdin'), __('Thumbnail', 'aladdin'), __('Large', 'aladdin'), __('Full', 'aladdin'));
			$styles_ids=array('post-thumbnail', 'thumbnail', 'large', 'full');

			foreach($styles as $i => $type) {
				echo '<option value="'. esc_attr($styles_ids[$i]).'" ';
				selected( $instance['image_size'], $styles_ids[$i] );
				echo '>'.esc_html($styles[$i]).'</option>';
			}
		?>
		</select>
		
		<?php 
		
		aladdin_echo_section_start( __( 'More options', 'aladdin' ), $this->get_field_id( 'max_width' ) );

			aladdin_echo_input_text( $this, 'max_width', $instance, __( 'Max width: ', 'aladdin' ), 0);
			aladdin_echo_input_text( $this, 'header_font_size', $instance, __( 'Header Font size: ', 'aladdin' ), 0);
			aladdin_echo_input_text( $this, 'body_font_size', $instance, __( 'Body Font size: ', 'aladdin' ), 0);
		
		aladdin_echo_section_end();

		aladdin_echo_section_start( __( 'Widget colors', 'aladdin' ), $this->get_field_id( 'background' ) );
		
			$defaults = $this->defaults( $instance );

			aladdin_echo_input_color( $this, 'background', $instance, __( 'Background color: ', 'aladdin' ), $defaults['background'] );
			esc_html_e('Background Opacity:', 'aladdin'); ?>
			<select id="<?php echo $this->get_field_id( 'opacity' ); ?>" name="<?php echo $this->get_field_name( 'opacity' ); ?>" style="width:100%;">
			<?php 
				$styles = array( '0' => '0',
								   '0.1' => '0.1',
								   '0.2' => '0.2',
								   '0.3' => '0.3',
								   '0.4' => '0.4',
								   '0.5' => '0.5',
								   '0.6' => '0.6', 
								   '0.7' => '0.7',
								   '0.8' => '0.8',
								   '0.9' => '0.9',
								   '1' => '1',
								);
								
				foreach ( $styles as $id => $style ) :
					echo '<option value="'. esc_attr( $id ).'" ';
					selected( $instance['opacity'], $id );
					echo '>' . esc_html( $style ) . '</option>';
				endforeach;
			?>
			</select>
			<?php 
			esc_html_e('Background Style:', 'aladdin'); ?>
			<select id="<?php echo $this->get_field_id('background_style'); ?>" name="<?php echo $this->get_field_name('background_style'); ?>" style="width:100%;">
			<?php 
				$styles = array( '1' => __( 'Full Width Color', 'aladdin' ),
								   '2' => __( 'Both', 'aladdin' ),
								   '3' => __( 'Small', 'aladdin' ),
								   '4' => __( 'Transparent', 'aladdin' ),
								);
								
				foreach ( $styles as $id => $style ) :
					echo '<option value="'. esc_attr( $id ).'" ';
					selected( $instance['background_style'], $id  );
					echo '>'.esc_html( $style ).'</option>';
				endforeach;
			?>
			</select>
			<?php 
			
			aladdin_echo_input_color( $this, 'header_color', $instance, __( 'Header Font Color: ', 'aladdin' ), $defaults['header_color'] );
			aladdin_echo_input_color( $this, 'body_font_color', $instance, __( 'Body Font Color: ', 'aladdin' ), $defaults['body_font_color'] );
	
		aladdin_echo_section_end();
		
		aladdin_echo_section_start( __( 'Button', 'aladdin' ), $this->get_field_id( 'link' ) );

			aladdin_echo_input_checkbox( $this, 'is_button', $instance, __( 'Add Button', 'aladdin'));
			aladdin_echo_input_text( $this, 'caption', $instance, __( 'Caption: ', 'aladdin' ), 0);
			aladdin_echo_input_text( $this, 'link', $instance, __( 'Link: ', 'aladdin' ), 0);
		
		aladdin_echo_section_end();
							  
	}
	
	/**
	 * Return array Defaults
	 *
	 * @since Aladdin 1.0.0
	 */
	function defaults( $instance ){
	
		$defaults = array('title' => __( 'Page', 'aladdin' ),
						  'page_id'   => '',	
						  'is_no_title'   => '',	
						  'is_centered'   => '',	
						  'is_transparent'   => '',	
						  'is_post_thumbnail'   => ( isset( $instance[ 'page_id' ] ) ? '' : '1' ),	
						  'layout'   => 'no-sidebar',	
						  
						  'opacity'   => '0.5',			  
						  'background'   => '#fff',		  
						  'max_width'   => '1366',					  
						  'body_font_size'   => '26',					  
						  'header_font_size'   => '32',					  
						  'body_font_color'   => '#fff',					  
						  'header_color'   => '#fff',					  							  
						  'background_style'   => '1', 
						  'is_search'   => '',				  
						  'is_button'   => '',
						  'caption'   => __( 'Button', 'aladdin' ),			  
						  'link'   => '#',
						  'image_size'   => 'post-thumbnail',
						);
		
		return $defaults;
	}
	
	/* Sanitize hex color.
	 * @param string color.
	 * @return string color.
	 */
	function sanitize_hex_color( $color ) {
		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}
	
	/* widget column width
	 * @param int $sidebar_id sidebar id.
	 * @param int $columns number of $columns.
	 * @param int $i1 widget left margin.
	 * @param int $i2 widget right margin.
	 * @return int width.
	 * @since Aladdin 1.0.0
	 */
	function get_width( $sidebar_id, $columns, $i1 = 0, $i2 = 0 ) {	
		if($columns <= 0) $columns = 1;
		$width = aladdin_get_sidebar_width($sidebar_id);
		$width = ($width - $width*$i1/100 - $width*$i2/100)/$columns;
		return $width;
	}
}

/* Register widget
 *
 * @since Aladdin 1.0.0
 *
 */
function aladdin_register_page_widget_2() {
	register_widget( 'aladdin_page_aladding' );
}
add_action( 'widgets_init', 'aladdin_register_page_widget_2' );