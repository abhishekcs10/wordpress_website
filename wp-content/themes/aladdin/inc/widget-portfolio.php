<?php
/**
 * Add a widget for displaying portfolio navigation-filter
 *
 * @since Aladdin 1.0.0
 */
 
class aladdin_portfolio_tag_nav extends WP_Widget {
	/**
	 * Widget constructor
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function __construct() {

		/* Widget settings. */
		$widget_ops = array(
		'classname' => 'aladdin_portfolio_tag_nav',
		'description' => __('Display portfolio tags navigation on both jetpack portfolio index and archive pages', 'aladdin' ));

		/* Widget control settings. */
		$control_ops = array(
		'width' => 250,
		'height' => 200,
		'id_base' => 'aladdin_portfolio_tag_nav');

		/* Create the widget. */		
		parent::__construct( 'aladdin_portfolio_tag_nav', __('Al Portfolio Tags Nav (Aladdin)', 'aladdin' ), $widget_ops, $control_ops );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

	}
	
	public function enqueue_styles() {
		wp_enqueue_script( 'aladdin-portfolio-nav', get_template_directory_uri() . '/inc/js/portfolio-nav.js', array('jquery') );
	}
	/**
	 * Widget output
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	function widget( $args, $instance ) {
	
		/* display widget on portfolio index and archive pages only */
		if( ! ('jetpack-portfolio' == get_post_type()) || is_singular('jetpack-portfolio'))
			return;
	
		$instance = wp_parse_args( (array) $instance, $this->defaults() );	
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$tax = 'jetpack-portfolio-tag';
		
		//print the widget for the sidebar
		if ( have_posts() ) : 
		
		echo $args['before_widget'];

		?>
		<section>
			<header>
		<?php
		
			$tax_names = array();
		
			if(trim( '' !== $title)) echo $args['before_title'] . esc_html($title) . $args['after_title'];
			
			if ( '1' == $instance['is_one_page'] ) :
				$tax_names = aladdin_get_tax_ids( $tax ); 
				
				?><ul class="jetpack-widget-tag-nav">
					<li class="all current"><?php _e( 'All Tags', 'aladdin' ) ?></li>
					<?php
					foreach( $tax_names as $id => $value ) : ?>
					<li class="<?php echo esc_attr( $id ); ?>"><?php echo $value; ?></li>
					<?php
					endforeach;
				?></ul>
				
				<?php
			else :
				$terms = get_terms( $tax );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
					?>
					<ul class="jetpack-widget-tag-nav-2">
						<li <?php echo ( 'jetpack-portfolio' == get_post_type() && ! is_singular( 'jetpack-portfolio' ) && ! is_search() && ! is_tax('jetpack-portfolio-type' && ! is_tax('jetpack-portfolio-tag' )) ? 'class="current"' : '' ); ?>>
							<a href="<?php echo get_post_type_archive_link( 'jetpack-portfolio' ); ?>"><?php _e( 'Portfolio', 'aladdin' ); ?></a>
						</li>					
					<?php
					foreach ( $terms as $term ) :
					?>
						<li <?php echo ( is_tax( $tax, $term ) ? 'class="current"' : '' ); ?>>
							<a href="<?php echo esc_url( get_term_link( $term ) ) . '">' . esc_attr( trim ( $term->name ) ); ?></a>
						</li>
					<?php	
					endforeach;
					?>
					</ul>			
					<?php
				endif;
			endif;
									
		?>
			</header>
		</section>
		<?php echo $args['after_widget']; ?>
		<?php
		endif; // End check for posts.

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
		if( isset($new_instance['is_one_page']) )
			$instance['is_one_page'] = '1';
			
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
		// Set up some default widget settings. 
		$instance = wp_parse_args( (array) $instance, $this->defaults() );

		aladdin_echo_input_text( $this, 'title', $instance, __( 'Title: ', 'aladdin' ));
		aladdin_echo_input_checkbox( $this, 'is_one_page', $instance, __( 'One page navigation (portfolio index)', 'aladdin') );
	}

	/**
	 * Return array Defaults
	 *
	 * @since Aladdin 1.0.0
	 */
	function defaults(){
	
		// Set up some default widget settings. 
		$defaults = array(
							'title' => __( 'Tags', 'aladdin' ), 
							'is_one_page' => __( 'One page navigation', 'aladdin' ),
						);
		
		return $defaults;
	}		
}
/**
 * Register widget
 *
 * @since Aladdin 1.0.0
 */
function aladdin_register_tag_nav_widget() {
	register_widget( 'aladdin_portfolio_tag_nav' );
}
add_action( 'widgets_init', 'aladdin_register_tag_nav_widget' );

/**
 * Add a widget for displaying portfolio navigation-filter
 *
 * @since Aladdin 1.0.0
 */
 
class aladdin_portfolio_nav extends WP_Widget {
	/**
	 * Widget constructor
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function __construct() {

		/* Widget settings. */
		$widget_ops = array(
		'classname' => 'aladdin_portfolio_nav',
		'description' => __('Display portfolio navigation on jetpack portfolio category/index page', 'aladdin' ));

		/* Widget control settings. */
		$control_ops = array(
		'width' => 250,
		'height' => 200,
		'id_base' => 'aladdin_portfolio_nav');

		/* Create the widget. */		
		parent::__construct( 'aladdin_portfolio_nav', __('Al Portfolio Project Nav (Aladdin)', 'aladdin' ), $widget_ops, $control_ops );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

	}
	/**
	 * Widget styles
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function enqueue_styles() {
		wp_enqueue_script( 'aladdin-portfolio-nav', get_template_directory_uri() . '/inc/js/portfolio-nav.js', array('jquery') );
	}
	/**
	 * Widget output
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	function widget( $args, $instance ) {
	
		/* display widget on portfolio index only */
	
		$instance = wp_parse_args( (array) $instance, $this->defaults() );	
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$tax = 'jetpack-portfolio-type';
		
		//print the widget for the sidebar
		if ( have_posts() ) : 
		
		echo $args['before_widget'];

		?>
		<section>
			<header>
		<?php
		
			$tax_names = array();
		
			if( trim( '' !== $title ) ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

			if ( '1' == $instance['is_one_page'] ) :
				$tax_names = aladdin_get_tax_ids( $tax ); 
				
				?><ul class="jetpack-widget-nav">
					<li class="all current"><?php _e('All Projects', 'aladdin') ?></li>
					<?php
					foreach( $tax_names as $id => $value ) : ?>
					<li class="<?php echo esc_attr( $id ); ?>"><?php echo $value; ?></li>
					<?php
					endforeach;
				?></ul>
				
				<?php
			else :
				$terms = get_terms( $tax );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
					?>
					<ul class="jetpack-widget-nav-2">	
						<li <?php echo ( 'jetpack-portfolio' == get_post_type() && ! is_singular( 'jetpack-portfolio' ) && ! is_search() && ! is_tax('jetpack-portfolio-type') && ! is_tax('jetpack-portfolio-tag') ? 'class="current"' : '' ); ?>>
							<a href="<?php echo get_post_type_archive_link( 'jetpack-portfolio' ); ?>"><?php _e( 'All Projects', 'aladdin' ); ?></a>
						</li>					
					<?php
					foreach ( $terms as $term ) :
					?>
						<li <?php echo ( is_tax( $tax, $term ) ? 'class="current"' : '' ); ?>>
							<a href="<?php echo esc_url( get_term_link( $term ) ) . '">' . esc_attr( trim ( $term->name ) ); ?></a>
						</li>
					<?php	
					endforeach;
					?>
					</ul>			
					<?php
				endif;
			endif;
									
		?>
			</header>
		</section>
		<?php
		echo $args['after_widget'];
		endif; // End check for posts.
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
		$tags = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		);
		$instance['title'] = wp_kses($new_instance['title'], $tags);
		if( isset($new_instance['is_one_page']) )
			$instance['is_one_page'] = '1';

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
		// Set up some default widget settings. 
		$instance = wp_parse_args( (array) $instance, $this->defaults() );
	
		aladdin_echo_input_text( $this, 'title', $instance, __( 'Title: ', 'aladdin' )); 
		aladdin_echo_input_checkbox( $this, 'is_one_page', $instance, __( 'One page navigation (portfolio index)', 'aladdin') );

	}

	/**
	 * Return array Defaults
	 *
	 * @since Aladdin 1.0.0
	 */
	function defaults(){
	
		// Set up some default widget settings. 
		$defaults = array(
					'title' => __( 'Projects', 'aladdin' ), 
					'is_one_page' => __( 'One page navigation', 'aladdin' ), 
		);
		
		return $defaults;
	}
	
}
/**
 * Register widget
 *
 * @since Aladdin 1.0.0
 */
 function aladdin_register_nav_widget() {
	register_widget( 'aladdin_portfolio_nav' );
}
add_action( 'widgets_init', 'aladdin_register_nav_widget' );

/**
 * Add a widget for displaying portfolio items
 *
 * @since Aladdin 1.0.0
 */
 
class aladdin_items_portfolio extends WP_Widget {
	/**
	 * Widget constructor
	 *
	 * @since Aladdin 1.0.0
	 *
	*/
	public function __construct() {

		/* Widget settings. */
		$widget_ops = array(
		'classname' => 'aladdin_items_portfolio',
		'description' => __('Display Items from Portfolio.', 'aladdin' ));

		/* Widget control settings. */
		$control_ops = array(
		'width' => 250,
		'height' => 250,
		'id_base' => 'aladdin_items_portfolio_widget');


		/* Create the widget. */		
		parent::__construct( 'aladdin_items_portfolio_widget', __( 'Al Items from Portfolio (Aladdin)', 'aladdin' ), $widget_ops, $control_ops );
		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}
	/* enqueue widget styles */
	public function enqueue_styles() {
		wp_enqueue_style( 'aladdin-image', get_template_directory_uri() . '/inc/css/image.css');
		wp_enqueue_script( 'aladdin-image-script', get_template_directory_uri() . '/inc/js/image-widget.js', array('jquery'), '20151012', true );
	}

	/* enqueue widget scripts */
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_script( 'aladdin-upload-image', get_template_directory_uri() . '/inc/js/meta-box-image.js', array('jquery') );

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
		preg_match_all('!\d+!', $instance['columns'], $matches);
		$width = $this->get_width($sidebar_id, absint(implode(' ', $matches[0])), $instance['padding_right'], $instance['padding_left']);

		global $post;
		$not_in = array();
		if( is_singular() ) {
			$not_in []= $post->ID;
		}
		$not_in = array_merge ( $not_in, get_option( 'sticky_posts' ) );
		$args = array();
		$tax = 'jetpack-portfolio-type';
		if( '0' != $instance['jetpack-portfolio-type'] ) {
			$args =  array(
				array(
					'taxonomy' => $tax,
					'terms'    => array( $instance['jetpack-portfolio-type'] ),
					'field'    => 'term_id',
					'operator' => 'IN',
				),
			);
		}
		
		$query = new WP_Query( array(
			'order'          => 'DESC',
			'posts_per_page' => $instance['count'],
			'no_found_rows'  => true,
			'post_status'    => 'publish',
			'post__not_in'   => $not_in,
			'post_type'		 => 'jetpack-portfolio',
			'tax_query'      => $args,
		) );


		if ( $query->have_posts() ) :
					
			$tmp_content_width = $GLOBALS['content_width'];
			$GLOBALS['content_width'] = $width;

			//print the widget for the sidebar
			echo $before_widget;
			if( '' !== trim($instance['title'])) echo $before_title.esc_html($instance['title']).$after_title;
			
			$pos_class = '';
			if( 0 != $instance['is_has_description'] ) {
				$pos_class = (($instance['is_right']) == 1 ? ' right' : ' left');
			}
			
			?>
			<div class="main-wrapper-image <?php echo $pos_class;?>" style="padding:<?php echo esc_attr($instance['padding_top']);?>px <?php echo esc_attr($instance['padding_right']);?>% <?php echo esc_attr($instance['padding_bottom'])?>px <?php echo esc_attr($instance['padding_left'])?>%">
				<?php if( 0 != $instance['is_has_description'] && '0' != $instance['project']) : ?>
				
				<div class="description">
					<article>
						<header>
							<h3 class="main-title"><?php echo esc_html(get_term( $instance['jetpack-portfolio-type'], $tax )->name);?></h3>
						</header><!-- header -->
						<p><?php echo term_description( $instance['jetpack-portfolio-type'], $tax ) ?></p>
						<a href="<?php echo esc_url( get_term_link( $instance['jetpack-portfolio-type'], $tax ) ); ?>" class="link" rel="bookmark"><?php _e('Open Archive', 'aladdin'); ?></a>
					</article> <!-- article -->
				</div> <!-- .description -->
				
				<?php endif; ?>

				<div class="wrapper-image <?php echo esc_attr($instance['columns']).( $instance['is_step'] ? ' step' : ' all' ).( $instance['is_margin_0'] ? ' margin-0' : '' );?>">
					
					<?php
					while (  $query->have_posts() ) :
						 $query->the_post();
					?>
						
						<div class="element <?php echo esc_attr($instance['effect_id']).( $instance['is_animate_once'] ? ' once' : '' ).( $instance['is_animate'] ? ' animate' : '' ).( $instance['is_zoom'] ? ' zoom' : '' );?>">
							<article>			
					
							<?php 
								if( has_post_thumbnail() && ! post_password_required() ) :
								
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $instance['image_size'] );	
								?>

									<img class="image-item" src="<?php echo esc_url( $image[0] );?>" alt="<?php the_title();?>"/>
									
								<?php
								else :
								?>	
									<div class="entry-thumbnail" style="background-image: url( <?php echo aladdin_get_theme_mod('empty_image'); ?>)">																
									</div>
								<?php endif; ?>

								<div class="hover">
								
									<?php if ( '' != $instance['is_link'] ) : ?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="hover-a">
									<?php endif; ?>		
								
									<header>
									
										<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

									</header><!-- header -->
									
									<p><?php aladdin_the_excerpt(); ?></p>
									
									<?php if ( '' != $instance['is_link'] ) : ?>
									<span class="link"><?php echo esc_html( $instance['link_caption'] ); ?></span>
									<?php endif; ?>
										
									<?php if ( '' != $instance['is_link'] ) : ?>
									</a>
									<?php endif; ?>
									
								</div><!-- .hover -->
								
							</article>
						</div><!-- .element -->
								
					<?php
										
					endwhile; 
					
					$GLOBALS['content_width'] = $tmp_content_width;
					wp_reset_postdata();
					
				?>
				</div><!-- .wrapper -->
				<div class="hide-element"></div>
			</div><!-- .main-wrapper -->
			<?php
			echo $after_widget;	
	
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
		
		$new_instance['count'] = absint($new_instance['count']);
		$new_instance['count'] = ($new_instance['count'] > 0 ? $new_instance['count'] : 1);
		
		$new_instance['title'] = esc_html($new_instance['title']); 
		$new_instance['jetpack-portfolio-type'] = absint($new_instance['jetpack-portfolio-type']); 
		$possible_values = array('column-1', 'column-2', 'column-3', 'column-4');	
		$new_instance['columns'] = ( in_array( $new_instance['columns'], $possible_values ) ? $new_instance['columns'] : 'column-1');
		
		$possible_values = array('post-thumbnail', 'thumbnail', 'large', 'full');	
		$new_instance['image_size'] = ( in_array( $new_instance['image_size'], $possible_values ) ? $new_instance['image_size'] : 'post-thumbnail');
				
		if( isset($new_instance['is_step']) )
			$new_instance['is_step'] = 1;	
		if( isset($new_instance['is_has_description']))
			$new_instance['is_has_description'] = 1;		
		if( isset($new_instance['is_right']))
			$new_instance['is_right'] = 1;	

		$new_instance['padding_right'] = 0;
		$new_instance['padding_left'] = 0;

		$new_instance['padding_top'] = ( 1 == $new_instance['is_margin_0'] ? 0 : 20);
		$new_instance['padding_bottom'] = ( 1 == $new_instance['is_margin_0'] ? 0 : 20);
	
		$possible_values = array('effect-1', 'effect-2', 'effect-3', 'effect-4', 'effect-5', 'effect-6', 'effect-7', 'effect-8', 'effect-9', 'effect-10', 'effect-11', 'effect-12', 'effect-14', 'effect-15', 'effect-16');	
		$new_instance['effect_id'] = ( in_array( $new_instance['effect_id'], $possible_values ) ? $new_instance['effect_id'] : 'effect-1');

		if( isset($new_instance['is_zoom']) )
			$new_instance['is_zoom'] = 1;
		if( isset($new_instance['is_animate']) )
			$new_instance['is_animate'] = 1;
		if( isset($new_instance['is_animate_once']) )
			$new_instance['is_animate_once'] = 1;
		if( isset($new_instance['is_link']) )
			$new_instance['is_link'] = 1;
		
		return $new_instance;
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
		
		$tax = 'jetpack-portfolio-type';
			
		$terms = get_terms( $tax );
								
		if ( $terms && ! is_wp_error( $terms ) ) : 

			esc_html_e('Category:', 'aladdin'); ?>
			<select id="<?php echo $this->get_field_id('jetpack-portfolio-type'); ?>" name="<?php echo $this->get_field_name('jetpack-portfolio-type'); ?>" style="width:100%;">
				<option value="0"><?php esc_html_e('Any', 'aladdin'); ?></option>
			<?php 

				foreach ( $terms as $term ) :
					echo '<option value="'. esc_attr($term->term_id).'" ';
					selected( $instance['jetpack-portfolio-type'], $term->term_id  );
					echo '>'.esc_html($term->name).'</option>';
				endforeach;
			?>
			</select>
			
		<?php endif;
		
		esc_html_e('Columns:', 'aladdin'); ?>
		
		<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" style="width:100%;">
		<?php 
			$styles=array( __('1', 'aladdin'), __('2', 'aladdin'), __('3', 'aladdin'), __('4', 'aladdin'));
			$styles_ids=array('column-1', 'column-2', 'column-3', 'column-4');

			for ($i=0; $i<4; $i++) {
				echo '<option value="'. esc_attr($styles_ids[$i]).'" ';
				selected( $instance['columns'], $styles_ids[$i] );
				echo '>'.esc_html($styles[$i]).'</option>';
			}
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
		
		aladdin_echo_input_hover_style( $this, 'effect_id', $instance);
		aladdin_echo_input_text( $this, 'count', $instance, __( 'Count: ', 'aladdin' ), 0);
		
		?>
		
		<hr>
		
		<?php
		
		aladdin_echo_section_start( __( 'More options', 'aladdin' ), $this->get_field_id( 'is_link' ));
		
		aladdin_echo_input_checkbox( $this, 'is_step', $instance, __( 'Step Animation', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_margin_0', $instance, __( 'No Margins', 'aladdin'));
		
		aladdin_echo_input_checkbox( $this, 'is_zoom', $instance, __( 'Transparent', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_animate', $instance, __( 'Animate', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_animate_once', $instance, __( 'Once', 'aladdin'));
		aladdin_echo_input_checkbox( $this, 'is_link', $instance, __( 'Display Button', 'aladdin'));
		
		aladdin_echo_input_checkbox( $this, 'is_has_description', $instance, __( 'Display description block', 'aladdin'));
		
		if( 0 != $instance['is_has_description'] ) {
			aladdin_echo_input_checkbox( $this, 'is_right', $instance, __( 'Right', 'aladdin'));
		}
		
		aladdin_echo_section_end();
		
	}
	
	/**
	 * Return array Defaults
	 *
	 * @since Aladdin 1.0.0
	 */
	function defaults( $instance ){
	
		$defaults = array('title' =>  __('Recent Projects', 'aladdin'),
						  'jetpack-portfolio-type'   => '0',	
						  'count'   => '4',	
						  'columns'   => 'column-4',
						  'image_size'   => 'post-thumbnail',							  
						  'is_step'   => '',
						  'is_margin_0'   => '',
						  'effect_id'   => 'effect-1',
						  'is_animate'   => '',
						  'is_zoom'   => '',
						  'is_animate_once'   => ($instance == null ? 1 : ''),
						  'link_caption'   => __('More Info', 'aladdin'),
						  'padding_right'   => '0',
						  'padding_left'   => '0',
						  'padding_top'   => '20',
						  'padding_bottom'   => '20',
						  'is_has_description'   => 0,
						  'is_right'   => '',
						  'is_link' => ($instance == null ? 1 : ''),
						);
		
		return $defaults;
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
function aladdin_register_items_portfolio_widgets() {
	register_widget( 'aladdin_items_portfolio' );
}
add_action( 'widgets_init', 'aladdin_register_items_portfolio_widgets' );
