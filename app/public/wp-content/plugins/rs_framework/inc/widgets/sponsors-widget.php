<?php
/**
 * Widget RS Recent Posts
 *
 * @package khelo
 * @author Rs Theme
 * @link http://rstheme.com
 */

// Register and load the widget
function wpb_load_widget_sponsors() {
    register_widget( 'khelo_sponsors_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget_sponsors' );
 
// Creating the widget 
class khelo_sponsors_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'wpb_widget_sponsors', 
 
// Widget name will appear in UI
__('Khelo Sponsors Widget', 'khelo'), 
 
// Widget description
array( 'description' => __( 'Sponsors widget with different options', 'khelo' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : "";

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
	
    $column = ( ! empty( $instance['column'] ) ) ? absint( $instance['column'] ) : 4;
    if ( ! $column )
      $column = 3;

    if($column =='2'){        
          $col='6';          
    }
    if($column =='4'){
      $col='3';       
    }
   
    if($column =='3'){        
      $col='4';       
    }

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
      		'post_type'       => 'rsclient',
			'ignore_sticky_posts' => true
		) ) );?>
        
    <div class="recent-widget">
   
		<?php
        if ($r->have_posts()) :
        ?>      
        <?php if ( $title )
        {
          echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
        } 

        global $khelo_option;

        $images_style = !empty($khelo_option['images_style']) ? $khelo_option['images_style'] : '';

    ?>
        
        <div class="rs-sponsors recent-post-widget widget clearfix <?php echo esc_attr($images_style);?>">
           <div class="row sponsors-grid"> 
            <?php while ( $r->have_posts() ) : $r->the_post(); 
               $gallery_url = get_the_post_thumbnail_url();
               $sponsor_url = get_post_meta( get_the_ID(), 'url_sponsor', true );
            ?>
           <div class="col-md-<?php echo esc_attr( $col );?> col-sm-4 sponsor-item sponsor-space"> 
                <div class="sponsors-img">
                    <?php if(!empty($sponsor_url)): ?>                                          
                        <a class="img-wrap" href="<?php echo esc_url($sponsor_url);?>" target="_blank">
                            <?php the_post_thumbnail();?>
                        </a>
                    <?php endif; ?>
                    <?php if(empty($sponsor_url)): ?>                                          
                        <a class="img-wrap">
                            <?php the_post_thumbnail();?>
                        </a>
                    <?php endif; ?>
                </div>
          </div>            
        <?php 
           endwhile;  //$args['after_widget']; 
		?>
    </div>
</div>

    <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
        
        endif;
        ?>
    </div>
    <?php
            
    }

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];	
    $instance['column'] = (int) $new_instance['column'];  
		return $instance;
}
         
// Widget Backend 
public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;	
    $column    = isset( $instance['column'] ) ? absint( $instance['column'] ) : 3;  	
?>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
    <?php esc_html_e( 'Title:','khelo' ); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_js($title); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
    <?php esc_html_e( 'Number of Sponsors to show:','khelo' ); ?>
  </label>
  <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_js($number); ?>" size="3" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'column' )); ?>">
    <?php esc_html_e( 'Number Of Column:(Example 2,3,4)','khelo' ); ?>
  </label>
  <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'column' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'column' )); ?>" type="column" step="1" min="1" value="<?php echo esc_js($column); ?>" size="3" />
</p>
<?php
	}

} // Class wpb_widget ends here
