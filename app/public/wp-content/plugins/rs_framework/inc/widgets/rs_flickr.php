<?php 
// Register and load the widget
function khelo_flicker_widget() {
    register_widget('khelo_flickr_widget');
}
add_action( 'widgets_init', 'khelo_flicker_widget' );

class khelo_flickr_widget extends WP_Widget {

	// Widget setup.
	function __construct() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_khelo_flickr',
			'description' => __('Display images from flickr', 'khelo')
		);

		// Widget control settings.
		$control_ops = array(
			'id_base' => 'flicker-flickr-widget'
		);

		// Create the widget.
		parent::__construct('khelo-flickr-widget', __('Khelo - Flickr images', 'khelo') , $widget_ops, $control_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$id = $instance['flickr_id'];
		$flickr_nr = ($instance['flickr_nr'] != '') ? $nr = $instance['flickr_nr'] : $nr = 16;
		echo wp_kses_post($before_widget);
		if ($title) echo wp_kses_post($before_title . $title . $after_title);
		
		$flicker_localize_data = array(
			'limit_f' => $flickr_nr,
			'flicker_id' => $id
		);
		
		wp_localize_script( 'flicker-main', 'flicker_data', $flicker_localize_data );

		echo '<div class="flickr-widget"><ul id="rsflicker" class="flickr-list"></ul></div>'.wp_kses_post($after_widget);
		
	}

	function update($new_instance, $old_instance) {
		$instance              = $old_instance;
		$instance['title']     = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_nr'] = strip_tags($new_instance['flickr_nr']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
		'title' => 'Latest From Flickr',
		'flickr_nr' => '16',
		'flickr_id' => '159794289@N02'
		);
		
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'khelo'); ?></label>
			<input id="<?php  echo esc_attr( $this->get_field_id('title')); ?>" type="text" name="<?php  echo esc_attr( $this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
        
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><?php esc_html_e('Flickr ID:', 'khelo'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" value="<?php echo esc_attr($instance['flickr_id']); ?>" class="widefat" />
            <small class="flick_line_height"><a href="<?php echo esc_url('http://www.idgettr.com');?>" target="_blank"><?php esc_html_e('Find your Flickr user or group id', 'khelo');?></a></small>
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('flickr_nr')); ?>"><?php esc_html_e('Number of photos:', 'khelo'); ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id('flickr_nr')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('flickr_nr')); ?>" value="<?php echo esc_attr($instance['flickr_nr']); ?>" class="widefat" />
		</p>
	<?php
	}
}

